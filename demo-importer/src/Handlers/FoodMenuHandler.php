<?php
//phpcs:disable
/**
 * Demo Importer Food Menu Handler
 *
 * Problem: fmsc shortcode posts store raw term IDs (from any taxonomy, typically
 * product_cat or food-menu-cat) in `fmp_categories` post meta. After demo import
 * those IDs no longer match — WordPress assigns fresh term IDs on every install.
 *
 * Fix (runs right after WXR import):
 *  1. Parse content.xml — build [ old_term_id => [taxonomy, slug] ] for every term.
 *  2. Resolve each slug+taxonomy to the new term ID now in the database.
 *  3. Rewrite fmp_categories rows on every fmsc post using old→new ID map.
 *
 * @package RT\FoodcartCore\DemoImporter
 */

namespace RT\FoodcartCore\DemoImporter\Handlers;

// Do not allow directly accessing this file.
if ( ! defined( 'ABSPATH' ) ) {
	exit( 'This script cannot be accessed directly.' );
}

/**
 * Food Menu term-ID remapping handler.
 */
class FoodMenuHandler {

	/**
	 * Food menu shortcode post type.
	 */
	const SHORTCODE_POST_TYPE = 'fmsc';

	/**
	 * Post meta key that holds the selected category IDs.
	 */
	const META_KEY = 'fmp_categories';

	/**
	 * Register hooks.
	 */
	public function __construct() {
		// Priority 20 – after FastImporter (priority 1) has finished cleanup.
		add_action( 'sd/edi/after_content_import', [ $this, 'remap_category_ids' ], 20, 2 );
		add_action( 'sd/edi/after_content_import', [ $this, 'import_reservation_layout' ], 30 );
	}

	/**
	 * Entry point: parse XML → build old→new ID map → rewrite post meta.
	 *
	 * @param string $xml_file Absolute path to the imported content.xml.
	 * @param mixed  $importer InstallDemo instance (unused).
	 */
	public function remap_category_ids( string $xml_file, $importer = null ): void {

		// Step 1 – parse XML: old_term_id => [ 'taxonomy' => ..., 'slug' => ... ]
		$terms = $this->parse_all_terms( $xml_file );

		if ( empty( $terms ) ) {
			return;
		}

		// Step 2 – resolve each slug to the new DB term ID.
		$id_map = [];

		foreach ( $terms as $old_id => $info ) {
			$term = get_term_by( 'slug', $info['slug'], $info['taxonomy'] );

			if ( $term && ! is_wp_error( $term ) ) {
				$id_map[ (string) $old_id ] = (int) $term->term_id;
			}
		}

		if ( empty( $id_map ) ) {
			return;
		}

		// Step 3 – update fmp_categories meta on every fmsc post.
		$this->rewrite_meta( $id_map );
	}

	/**
	 * Parse content.xml and return all terms across every taxonomy.
	 *
	 * @param  string $xml_file Absolute path to content.xml.
	 * @return array<string, array{taxonomy:string, slug:string}>  Keyed by old term_id (string).
	 */
	private function parse_all_terms( string $xml_file ): array {
		if ( ! file_exists( $xml_file ) ) {
			return [];
		}

		// phpcs:ignore WordPress.WP.AlternativeFunctions.file_get_contents_file_get_contents
		$content = file_get_contents( $xml_file );

		if ( empty( $content ) ) {
			return [];
		}

		$map = [];

		// Match every <wp:term>…</wp:term> block.
		if ( ! preg_match_all( '/<wp:term>(.*?)<\/wp:term>/s', $content, $blocks ) ) {
			return [];
		}

		foreach ( $blocks[1] as $block ) {

			// term_id – stored without CDATA in standard WXR exports.
			if ( ! preg_match( '/<wp:term_id>(\d+)<\/wp:term_id>/', $block, $id_m ) ) {
				continue;
			}

			// taxonomy – stored with CDATA.
			if ( ! preg_match( '/<wp:term_taxonomy><!\[CDATA\[(.*?)\]\]><\/wp:term_taxonomy>/', $block, $tax_m ) ) {
				continue;
			}

			// slug – stored with CDATA.
			if ( ! preg_match( '/<wp:term_slug><!\[CDATA\[(.*?)\]\]><\/wp:term_slug>/', $block, $slug_m ) ) {
				continue;
			}

			$map[ $id_m[1] ] = [
				'taxonomy' => trim( $tax_m[1] ),
				'slug'     => trim( $slug_m[1] ),
			];
		}

		return $map;
	}

	/**
	 * Delete and re-add fmp_categories rows on every fmsc post using the map.
	 *
	 * Each category is stored as a separate postmeta row (one row per term ID),
	 * matching the storage pattern used by ShortcodeMeta::save_meta_boxes().
	 *
	 * @param array<string, int> $id_map  old_id (string) => new_id (int).
	 */
	private function rewrite_meta( array $id_map ): void {
		global $wpdb;

		// Fetch every fmsc post that has at least one fmp_categories row.
		// phpcs:ignore WordPress.DB.DirectDatabaseQuery.DirectQuery, WordPress.DB.DirectDatabaseQuery.NoCaching
		$post_ids = $wpdb->get_col(
			$wpdb->prepare(
				"SELECT DISTINCT pm.post_id
				 FROM {$wpdb->postmeta} pm
				 INNER JOIN {$wpdb->posts} p ON p.ID = pm.post_id
				 WHERE pm.meta_key = %s
				   AND p.post_type = %s
				   AND p.post_status != 'trash'",
				self::META_KEY,
				self::SHORTCODE_POST_TYPE
			)
		);

		if ( empty( $post_ids ) ) {
			return;
		}

		foreach ( $post_ids as $post_id ) {
			$post_id = (int) $post_id;

			// One element per DB row.
			$current = get_post_meta( $post_id, self::META_KEY );

			if ( empty( $current ) ) {
				continue;
			}

			$new_values   = [];
			$needs_update = false;

			foreach ( $current as $value ) {
				$key = (string) $value;

				if ( isset( $id_map[ $key ] ) ) {
					$new_values[] = $id_map[ $key ];
					$needs_update = true;
				} else {
					$new_values[] = $value;
				}
			}

			if ( ! $needs_update ) {
				continue;
			}

			delete_post_meta( $post_id, self::META_KEY );

			foreach ( $new_values as $new_id ) {
				add_post_meta( $post_id, self::META_KEY, $new_id );
			}
		}
	}


	/**
	 * Foodmenu Food-menu reservation layout import
	 *
	 * @return $this
	 */
	public function import_reservation_layout() {
		$import_path = trailingslashit( FOODCART_CORE_BASE_DIR ) . 'demo-importer/demo-files/';

		$formFile = trailingslashit( $import_path ) . 'reservation.txt';

		$image_info = $this->get_attachment_url_by_slug( 'fm-reservation' );


		if ( file_exists( $formFile ) ) {
			// phpcs:ignore WordPress.WP.AlternativeFunctions.file_get_contents_file_get_contents
			$import_data = file_get_contents( $formFile );

			$data = unserialize($import_data);
			foreach ($data as $key => $value) {
				if (is_array($value) && isset($value['bgImage'])) {
					$data[$key]['bgImage'] = $image_info;
				} elseif ($key === 'bgImage') {
					$data['bgImage'] = $image_info;
				}
			}

			$import_data = $data;
			if ( $import_data ) {
				$unserialized = maybe_unserialize( $import_data );
				if ( $unserialized !== false || $import_data === 'b:0;' ) {
					update_option( 'fmp_table_layout', $unserialized );
				}
			}
		}

		return $this;
	}

	private function get_attachment_url_by_slug( $slug ) {
		$args    = array(
			'post_type'      => 'attachment',
			'name'           => sanitize_title( $slug ),
			'posts_per_page' => 1,
		);
		$_header = get_posts( $args );
		$header  = $_header ? array_pop( $_header ) : null;

		return $header ? wp_get_attachment_url( $header->ID ) : '';
	}
}
