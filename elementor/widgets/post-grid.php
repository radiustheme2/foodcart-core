<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */

namespace radiustheme\Foodcart_Core;

use Elementor\Controls_Manager;

if ( ! defined( 'ABSPATH' ) ) exit;

class Post_Grid extends Custom_Widget_Base {

	public function __construct( $data = [], $args = null ){
		$this->rt_name = __( 'Post Grid', 'foodcart-core' );
		$this->rt_base = 'rt-post-grid';
		$this->rt_translate = array(
			'cols'  => array(
				'12' => __( '1 Col', 'foodcart-core' ),
				'6'  => __( '2 Col', 'foodcart-core' ),
				'4'  => __( '3 Col', 'foodcart-core' ),
				'3'  => __( '4 Col', 'foodcart-core' ),
				'2'  => __( '6 Col', 'foodcart-core' ),
			),
		);
		parent::__construct( $data, $args );
	}

	private function rt_load_scripts(){
		wp_enqueue_script( 'isotope-pkgd' );
	}

	public function rt_fields(){
		$categories = get_categories();
		$category_dropdown = array( '0' => esc_html__( 'All Categories', 'foodcart-core' ) );

		foreach ( $categories as $category ) {
			$category_dropdown[$category->term_id] = $category->name;
		}
		$fields = array(
			array(
				'mode'    => 'section_start',
				'id'      => 'sec_general',
				'label'   => __( 'General', 'foodcart-core' ),
			),
			array(
				'type'    => Controls_Manager::SELECT2,
				'id'      => 'style',
				'label'   => __( 'Style', 'foodcart-core' ),
				'options' => array(
					'style1' => __( 'Style 1', 'foodcart-core' ),
					'style2' => __( 'Style 2', 'foodcart-core' ),
				),
				'default' => 'style1',
			),
			array(
				'type'    => Controls_Manager::SELECT2,
				'id'      => 'orderby',
				'label'   => __( 'Order By', 'foodcart-core' ),
				'options' => array(
					'date'        => __( 'Date (Recents comes first)', 'foodcart-core' ),
					'title'       => __( 'Title', 'foodcart-core' ),
					'menu_order'  => __( 'Custom Order (Available via Order field inside Page Attributes box)', 'foodcart-core' ),
				),
				'default' => 'date',
			),
			array(
				'type'    => Controls_Manager::SELECT2,
				'id'      => 'cat',
				'label'   => esc_html__( 'Categories', 'foodcart-core' ),
				'options' => $category_dropdown,
				'default' => '0',
			),
			array(
				'type'    => Controls_Manager::NUMBER,
				'id'      => 'count',
				'label'   => __( 'Word count', 'foodcart-core' ),
				'default' => 10,
				'description' => __( 'Maximum number of words', 'foodcart-core' ),
			),
			array(
				'type'    => Controls_Manager::NUMBER,
				'id'      => 'itemlimit',
				'label'   => __( 'Item Limit', 'foodcart-core' ),
				'default' => 3,
				'description' => __( 'Maximum number of words', 'foodcart-core' ),
			),
			array(
				'type'    => Controls_Manager::NUMBER,
				'id'      => 'title_count',
				'label'   => esc_html__( 'Title count', 'seomaster-core' ),
				'default' => 8,
				'description' => esc_html__( 'Maximum number of words', 'seomaster-core' ),
			),
			array(
				'mode' => 'section_end',
			),

			// Responsive Columns
			array(
				'mode'    => 'section_start',
				'id'      => 'sec_responsive',
				'label'   => __( 'Number of Responsive Columns', 'foodcart-core' ),
				'condition'   => array( 'style' => array( 'style2' ) ),
			),
			array(
				'type'    => Controls_Manager::SELECT2,
				'id'      => 'col_lg',
				'label'   => __( 'Desktops: > 1199px', 'foodcart-core' ),
				'options' => $this->rt_translate['cols'],
				'default' => '4',
			),
			array(
				'type'    => Controls_Manager::SELECT2,
				'id'      => 'col_md',
				'label'   => __( 'Desktops: > 991px', 'foodcart-core' ),
				'options' => $this->rt_translate['cols'],
				'default' => '4',
			),
			array(
				'type'    => Controls_Manager::SELECT2,
				'id'      => 'col_sm',
				'label'   => __( 'Tablets: > 767px', 'foodcart-core' ),
				'options' => $this->rt_translate['cols'],
				'default' => '6',
			),
			array(
				'type'    => Controls_Manager::SELECT2,
				'id'      => 'col_xs',
				'label'   => __( 'Phones: < 768px', 'foodcart-core' ),
				'options' => $this->rt_translate['cols'],
				'default' => '12',
			),
			array(
				'mode' => 'section_end',
			),
		);
		return $fields;
	}

	protected function render() {
		$data = $this->get_settings();

		$this->rt_load_scripts();

		switch ( $data['style'] ) {
			case 'style2':
			$template = 'post-grid-2';
			break;
			default:
			$template = 'post-grid-1';
			break;
		}

		return $this->rt_template( $template, $data );
	}
}