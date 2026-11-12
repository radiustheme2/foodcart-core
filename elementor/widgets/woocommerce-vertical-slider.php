<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */

namespace radiustheme\Foodcart_Core;

use Elementor\Controls_Manager;
use Elementor\Group_Control_Background;

if ( ! defined( 'ABSPATH' ) ) exit;

class Woocommerce_vertical_Slider extends Custom_Widget_Base {

	public function __construct( $data = [], $args = null ){
		$this->rt_name = esc_html__( 'Woocommerce vertical Slider', 'foodcart-core' );
		$this->rt_base = 'woo-vertical-slider';
		
		parent::__construct( $data, $args );
	}
	
	private function rt_load_scripts(){
		wp_enqueue_style(  'owl-carousel' );
		wp_enqueue_style(  'owl-theme-default' );		
		wp_enqueue_script( 'owl-carousel' );
	}	
	
	private function rt_load_scripts_slick(){
		wp_enqueue_style(  'slick' );
		wp_enqueue_style(  'slick-theme' );		
		wp_enqueue_script( 'imagesloaded' );
		wp_enqueue_script( 'slick' );
	}

	public function rt_fields(){
		$terms = get_terms( array( 'taxonomy' => 'product_cat', 'fields' => 'id=>name' ) );
		$category_dropdown = array( '0' => esc_html__( 'All Categories', 'foodcart-core' ) );

		foreach ( $terms as $id => $name ) {
			$category_dropdown[$id] = $name;
		}

		$fields = array(
			array(
				'mode'    => 'section_start',
				'id'      => 'sec_general',
				'label'   => esc_html__( 'General', 'foodcart-core' ),
			),
			array(
				'type'    => Controls_Manager::NUMBER,
				'id'      => 'number',
				'label'   => esc_html__( 'Total number of items', 'foodcart-core' ),
				'default' => 6,
				'description' => esc_html__( 'Write -1 to show all', 'foodcart-core' ),
			),
			array(
				'type'    => Controls_Manager::SELECT2,
				'id'      => 'cat',
				'label'   => esc_html__( 'Categories', 'foodcart-core' ),
				'options' => $category_dropdown,
				'default' => '0',
			),
			array(
				'type'    => Controls_Manager::SELECT2,
				'id'      => 'orderby',
				'label'   => esc_html__( 'Order By', 'foodcart-core' ),
				'options' => array(
					'date'        => esc_html__( 'Date (Recents comes first)', 'foodcart-core' ),
					'title'       => esc_html__( 'Title', 'foodcart-core' ),
					'menu_order'  => esc_html__( 'Custom Order (Available via Order field inside Page Attributes box)', 'foodcart-core' ),
				),
				'default' => 'date',
			),
			array(
				'type'        => Controls_Manager::SWITCHER,
				'id'          => 'content_display',
				'label'       => esc_html__( 'Content Display', 'foodcart-core' ),
				'label_on'    => esc_html__( 'On', 'foodcart-core' ),
				'label_off'   => esc_html__( 'Off', 'foodcart-core' ),
				'default'     => true,
				'description' => esc_html__( 'Show or Hide Content. Default: off', 'foodcart-core' ),
			),
			array(
				'type'    => Controls_Manager::SELECT2,
				'id'      => 'contype',
				'label'   => esc_html__( 'Content Type', 'foodcart-core' ),
				'options' => array(
					'content' => esc_html__( 'Conents', 'foodcart-core' ),
					'excerpt' => esc_html__( 'Excerpts', 'foodcart-core' ),
				),
				'default'     => 'content',
				'description' => esc_html__( 'Display contents from Editor or Excerpt field', 'foodcart-core' ),
			),
			array(
				'type'    => Controls_Manager::NUMBER,
				'id'      => 'count',
				'label'   => esc_html__( 'Word count', 'foodcart-core' ),
				'default' => 15,
				'description' => esc_html__( 'Maximum number of words', 'foodcart-core' ),
			),
			array(
				'mode' => 'section_end',
			),
			/*Background options*/
			array(
			'mode'    => 'section_start',
			'id'      => 'sec_bacground1',
			'label'   => __( 'Background For the Element item', 'foodcart-core' ),
			),	
			array (
			'mode'    => 'group',
			'type'    => Group_Control_Background::get_type(),
			'name'      => 'section_item_background1',
			'label'   => __( 'Section Item Background', 'foodcart-core' ),
			'selector' => '{{WRAPPER}} .team-slider-default .rtin-content-wrap figure',
			),
			array(
			'mode' => 'section_end',
			),

		);
		return $fields;
	}

	protected function render() {
		$data = $this->get_settings();
		
		$this->rt_load_scripts_slick();
		$template = 'woocommerce-vertical-slider';

		return $this->rt_template( $template, $data );
	}
}