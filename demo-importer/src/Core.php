<?php
/**
 * Demo Importer Core Class
 *
 * This file contains the core functionality of the demo importer.
 *
 * @package RT\FoodcartCore\DemoImporter
 */

namespace RT\FoodcartCore\DemoImporter;

use RT\FoodcartCore\DemoImporter\Utils;

// Do not allow directly accessing this file.
if ( ! defined( 'ABSPATH' ) ) {
	exit( 'This script cannot be accessed directly.' );
}

/**
 * Demo Importer Core Class.
 */
class Core {
	/**
	 * Theme configuration.
	 *
	 * @var array
	 */
	private $config = [];

	/**
	 * Configuration cache.
	 *
	 * @var array
	 */
	private $config_cache = null;

	/**
	 * Utilities instance.
	 *
	 * @var Utils
	 */
	private $utils;

	/**
	 * Class Constructor.
	 *
	 * @param array $config Theme configuration array.
	 */
	public function __construct( array $config = [] ) {
		$this->config = $config;
		$this->utils  = new Utils( $config );
		$this->setup_hooks();
	}

	/**
	 * Check if a feature is enabled.
	 *
	 * @param string $feature Feature name.
	 * @return bool
	 */
	private function is_feature_enabled( string $feature ): bool {
		return isset( $this->config['features'][ $feature ] ) && $this->config['features'][ $feature ];
	}


	/**
	 * Setup WordPress hooks.
	 *
	 * @return void
	 */
	private function setup_hooks(): void {
		/**
		 * Filters.
		 */
		add_filter( 'sd/edi/importer/config', [ $this, 'import_config' ] );
		add_filter( 'sd/edi/activated_plugin_actions', [ $this, 'plugin_actions' ] );

		// Server requirements.
		add_filter( 'sd/edi/server_requirements', [ $this, 'adjust_server_requirements' ] );

		// Contact url.
		add_filter( 'sd/edi/import_modal_texts', [ $this, 'import_contact_texts' ] );

		/**
		 * Actions.
		 */
		add_action( 'sd/edi/after_plugins_activation', [ $this, 'before_import_actions' ] );
		add_action( 'sd/edi/before_widgets_import', [ $this, 'remove_default_widgets' ] );
		add_action( 'sd/edi/after_import', [ $this, 'after_import_actions' ] );
		add_action( 'sd/edi/after_import', [ $this, 'rt_layer_slider_import_setup' ] );
		add_action( 'sd/edi/after_import', [ $this, 'import_reservation_layout' ] );
	}


	/**
	 * Foodmenu Food-menu reservation layout import
	 *
	 * @return $this
	 */
	public function import_reservation_layout() {
		$import_path = trailingslashit( FOODCART_CORE_DEMO_IMPORTER_PATH ) . 'demo-files/';
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


	/**
	 * @return void
	 */

	public function rt_layer_slider_import_setup() {
		$slider_files = array(
			trailingslashit( FOODCART_CORE_DEMO_IMPORTER_PATH ) . 'demo-files/slider-1.zip',
			trailingslashit( FOODCART_CORE_DEMO_IMPORTER_PATH ) . 'demo-files/slider-2.zip',
			trailingslashit( FOODCART_CORE_DEMO_IMPORTER_PATH ) . 'demo-files/slider-3.zip',
		);

		if ( class_exists( 'LS_Sliders' ) && count( $slider_files ) > 0 ) {
			require_once LS_ROOT_PATH.'/classes/class.ls.importutil.php';
			require_once LS_ROOT_PATH.'/classes/class.ls.filesystem.php';
			foreach( $slider_files as $slider_file ){
				if( file_exists( $slider_file ) ) {
					new \LS_ImportUtil( $slider_file );
				}
			}
		}
	}

	/**
	 * Generate import configuration from theme config.
	 *
	 * @return array
	 */

	public function import_contact_texts( $text ){
		$text['docUrl'] = 'https://www.radiustheme.com/demo/wordpress/themes/typiq/docs/';
		$text['ticketUrl'] = 'https://www.radiustheme.com/ticket-support/';
		return $text;
	}

	/**
	 * Generate import configuration from theme config.
	 *
	 * @return array
	 */
	public function import_config(): array {
		if ( null !== $this->config_cache ) {
			return $this->config_cache;
		}

		$this->config_cache = [
			'themeName'             => $this->config['theme_name'],
			'themeSlug'             => $this->config['theme_slug'],
			'multipleZip'           => false,
			'demoZip'               => $this->utils->get_demo_asset_url( $this->config['demo_content_zip'] ),
			'blogSlug'              => $this->config['blog_slug'],
			'urlToReplace'          => $this->config['demo_url'],
			'replaceCommenterEmail' => $this->config['commenter_email'] ?? '',
			'settingsJson'          => $this->config['settings_json'],
			'elementor_data_fix'    => $this->is_feature_enabled( 'elementor_fixes' ) ? $this->config['elementor_fixes'] : [],
			'menus'                 => $this->config['menus'],
			'demoData'              => $this->build_demo_data(),
			'plugins'               => $this->build_plugins_config(),
		];

		if ( ! empty( $this->config['fluent_forms_json'] ) ) {
			$this->config_cache['fluentFormsJson'] = $this->config['fluent_forms_json'];
		}

		return $this->config_cache;
	}

	/**
	 * Run plugin activation actions after activation.
	 *
	 * @param array $actions Existing plugin activation actions.
	 *
	 * @return array
	 */
	public function plugin_actions( array $actions ): array {
		$actions['classified-listing/classified-listing.php'] = [
			'class'  => '\Rtcl\Helpers\Installer',
			'action' => 'install',
		];

		$actions['classified-listing-pro/classified-listing-pro.php'] = [
			'class'  => '\RtclPro\Helpers\Installer',
			'action' => 'install',
		];

		$actions['classified-listing-store/classified-listing-store.php'] = [
			'class'  => '\RtclStore\Helpers\Install',
			'action' => 'install',
		];

		return $actions;
	}

	/**
	 * Build demo data configuration.
	 *
	 * @return array
	 */
	private function build_demo_data(): array {
		return array_map(
			function ( $variant ) {
				return [
					'name'         => $variant['name'],
					'previewImage' => $this->utils->get_demo_asset_url( $variant['preview'] ),
					'previewUrl'   => $this->config['demo_url'] . $variant['url'],
				];
			},
			$this->config['demo_variants']
		);
	}

	/**
	 * Build plugins configuration.
	 *
	 * @return array
	 */
	private function build_plugins_config(): array {
		return array_merge(
			$this->build_wp_plugins(),
			$this->build_bundled_plugins()
		);
	}

	/**
	 * Build WordPress repository plugins configuration.
	 *
	 * @return array
	 */
	private function build_wp_plugins(): array {
		$plugins = [];

		foreach ( $this->config['wp_plugins'] as $slug => $plugin ) {
			$name     = is_array( $plugin ) ? $plugin['name'] : $plugin;
			$filePath = is_array( $plugin ) && ! empty( $plugin['file'] ) ? $plugin['file'] : $slug . '/' . $slug . '.php';

			$plugins[ $slug ] = [
				'name'     => $name,
				'source'   => 'wordpress',
				'filePath' => $filePath,
			];
		}

		return $plugins;
	}

	/**
	 * Build bundled plugins configuration.
	 *
	 * @return array
	 */
	private function build_bundled_plugins(): array {
		$plugins = [];

		foreach ( $this->config['bundled_plugins'] as $slug => $plugin ) {
			$filePath = is_array( $plugin ) && ! empty( $plugin['filePath'] ) ? $plugin['filePath'] : $slug . '/' . $slug . '.php';
			$plugins[ $slug ] = [
				'name'     => $plugin['name'],
				'source'   => 'bundled',
				'filePath' => $filePath,
				'location' => get_parent_theme_file_uri( $plugin['file'] ),
			];
		}

		return $plugins;
	}

	/**
	 * Execute before import actions.
	 *
	 * @return void
	 */
	public function before_import_actions(): void {
		$this->set_import_options();
	}

	/**
	 * Set import-specific options.
	 *
	 * @return void
	 */
	private function set_import_options(): void {
		foreach ( $this->config['pre_import_options'] as $option => $value ) {
			update_option( $option, $value );
		}
	}


	/**
	 * Remove default widgets.
	 *
	 * @return void
	 */
	public function remove_default_widgets(): void {
		delete_option( 'sidebars_widgets' );
	}


	/**
	 * Execute after import actions.
	 *
	 * @return void
	 */
	public function after_import_actions(): void {
		$this->cleanup_after_import();
	}

	/**
	 * Cleanup after import completion.
	 *
	 * @return void
	 */
	private function cleanup_after_import(): void {
		foreach ( $this->config['post_import_options'] as $option => $value ) {
			update_option( $option, $value );
		}
		flush_rewrite_rules();
	}

	/**
	 * Adjust server requirements.
	 *
	 * @param array $requirements Server requirements.
	 *
	 * @return array
	 */
	public function adjust_server_requirements( $requirements ) {
		$requirements['max_execution_time'] = $this->config['max_execution_time'] ?? '300';
		$requirements['max_input_time']      = $this->config['max_input_time'] ?? '300';
		$requirements['upload_max_filesize'] = $this->config['upload_max_filesize'] ?? '256M';
		$requirements['post_max_size']       = $this->config['post_max_size'] ?? '512M';
		$requirements['memory_limit']        = $this->config['memory_limit'] ?? '256M';

		return $requirements;
	}
}
