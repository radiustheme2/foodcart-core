<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */

namespace radiustheme\Foodcart_Core;

use Elementor\Controls_Manager;

if ( ! defined( 'ABSPATH' ) ) exit;

class Testimonial extends Custom_Widget_Base {

	public function __construct( $data = [], $args = null ){
		$this->rt_name = __( 'Testimonial', 'foodcart-core' );
		$this->rt_base = 'rt-testimonial';
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
		wp_enqueue_style(  'owl-carousel' );
		wp_enqueue_style(  'owl-theme-default' );
		wp_enqueue_script( 'owl-carousel' );
	}

	public function rt_fields(){
		$cpt = FOODCART_CORE_CPT_PREFIX;
		$terms  = get_terms( array( 'taxonomy' => "{$cpt}_testimonial_category", 'fields' => 'id=>name' ) );
		$category_dropdown = array( '0' => __( 'All Categories', 'foodcart-core' ) );

		foreach ( $terms as $id => $name ) {
			$category_dropdown[$id] = $name;
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
					'style3' => __( 'Style 3 ( Grid Layout )', 'foodcart-core' ),
				),
				'default' => 'style1',
			),
			array(
				'type'    => Controls_Manager::SELECT2,
				'id'      => 'theme',
				'label'   => __( 'Theme', 'foodcart-core' ),
				'options' => array(
					'light' => __( 'Light Background', 'foodcart-core' ),
					'dark'  => __( 'Dark Background', 'foodcart-core' ),
				),
				'default' => 'light',
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
				'id'      => 'number',
				'label'   => __( 'Total number of items', 'foodcart-core' ),
				'default' => 5,
				'description' => __( 'Write -1 to show all', 'foodcart-core' ),
			),
			array(
				'type'    => Controls_Manager::SELECT2,
				'id'      => 'cat',
				'label'   => __( 'Categories', 'foodcart-core' ),
				'options' => $category_dropdown,
				'default' => '0',
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
				'type'        => Controls_Manager::SWITCHER,
				'id'          => 'designation_display',
				'label'       => __( 'Designation Display', 'foodcart-core' ),
				'label_on'    => __( 'On', 'foodcart-core' ),
				'label_off'   => __( 'Off', 'foodcart-core' ),
				'default'     => 'yes',
				'description' => __( 'Show or Hide Designation. Default: On', 'foodcart-core' ),
			),			
			array(
				'type'        => Controls_Manager::SWITCHER,
				'id'          => 'ratting_display',
				'label'       => esc_html__( 'Ratting Display', 'foodcart-core' ),
				'label_on'    => esc_html__( 'On', 'foodcart-core' ),
				'label_off'   => esc_html__( 'Off', 'foodcart-core' ),
				'default'     => 'yes',
				'description' => esc_html__( 'Show or Hide Ratting. Default: On', 'foodcart-core' ),
			),
			array(
				'type'        => Controls_Manager::SWITCHER,
				'id'          => 'thumbs_display',
				'label'       => __( 'Thumbs Display', 'foodcart-core' ),
				'label_on'    => __( 'On', 'foodcart-core' ),
				'label_off'   => __( 'Off', 'foodcart-core' ),
				'default'     => 'yes',
				'description' => __( 'Show or Hide Thumbs. Default: On', 'foodcart-core' ),
			),
			array(
				'mode' => 'section_end',
			),
			
			// Responsive Columns
			array(
				'mode'    => 'section_start',
				'id'      => 'sec_responsive',
				'label'   => __( 'Number of Responsive Columns', 'foodcart-core' ),
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
				'type'    => Controls_Manager::SELECT2,
				'id'      => 'col_mobile',
				'label'   => __( 'Small Phones: < 480px', 'foodcart-core' ),
				'options' => $this->rt_translate['cols'],
				'default' => '12',
			),
			array(
				'mode' => 'section_end',
			),

			// Slider options
			array(
				'mode'        => 'section_start',
				'id'          => 'sec_slider',
				'label'       => __( 'Slider Options', 'foodcart-core' ),
			),
			array(
				'type'        => Controls_Manager::SWITCHER,
				'id'          => 'slider_nav',
				'label'       => __( 'Navigation Arrow', 'foodcart-core' ),
				'label_on'    => __( 'On', 'foodcart-core' ),
				'label_off'   => __( 'Off', 'foodcart-core' ),
				'default'     => 'yes',
				'description' => __( 'Enable or disable navigation arrow. Default: On', 'foodcart-core' ),
			),
			array(
				'type'        => Controls_Manager::SWITCHER,
				'id'          => 'slider_dots',
				'label'       => __( 'Navigation Dots', 'foodcart-core' ),
				'label_on'    => __( 'On', 'foodcart-core' ),
				'label_off'   => __( 'Off', 'foodcart-core' ),
				'default'     => '',
				'description' => __( 'Enable or disable navigation dots. Default: Off', 'foodcart-core' ),
			),
			array(
				'type'        => Controls_Manager::SWITCHER,
				'id'          => 'slider_autoplay',
				'label'       => __( 'Autoplay', 'foodcart-core' ),
				'label_on'    => __( 'On', 'foodcart-core' ),
				'label_off'   => __( 'Off', 'foodcart-core' ),
				'default'     => 'yes',
				'description' => __( 'Enable or disable autoplay. Default: On', 'foodcart-core' ),
			),
			array(
				'type'        => Controls_Manager::SWITCHER,
				'id'          => 'slider_stop_on_hover',
				'label'       => __( 'Stop on Hover', 'foodcart-core' ),
				'label_on'    => __( 'On', 'foodcart-core' ),
				'label_off'   => __( 'Off', 'foodcart-core' ),
				'default'     => 'yes',
				'description' => __( 'Stop autoplay on mouse hover. Default: On', 'foodcart-core' ),
				'condition'   => array( 'slider_autoplay' => 'yes' ),
			),
			array(
				'type'    => Controls_Manager::SELECT2,
				'id'      => 'slider_interval',
				'label'   => __( 'Autoplay Interval', 'foodcart-core' ),
				'options' => array(
					'5000' => __( '5 Seconds', 'foodcart-core' ),
					'4000' => __( '4 Seconds', 'foodcart-core' ),
					'3000' => __( '3 Seconds', 'foodcart-core' ),
					'2000' => __( '2 Seconds', 'foodcart-core' ),
					'1000' => __( '1 Second',  'foodcart-core' ),
				),
				'default' => '5000',
				'description' => __( 'Set any value for example 5 seconds to play it in every 5 seconds. Default: 5 Seconds', 'foodcart-core' ),
				'condition'   => array( 'slider_autoplay' => 'yes' ),
			),
			array(
				'type'    => Controls_Manager::NUMBER,
				'id'      => 'slider_autoplay_speed',
				'label'   => __( 'Autoplay Slide Speed', 'foodcart-core' ),
				'default' => 200,
				'description' => __( 'Slide speed in milliseconds. Default: 200', 'foodcart-core' ),
				'condition'   => array( 'slider_autoplay' => 'yes' ),
			),
			array(
				'type'        => Controls_Manager::SWITCHER,
				'id'          => 'slider_loop',
				'label'       => __( 'Loop', 'foodcart-core' ),
				'label_on'    => __( 'On', 'foodcart-core' ),
				'label_off'   => __( 'Off', 'foodcart-core' ),
				'default'     => 'yes',
				'description' => __( 'Loop to first item. Default: On', 'foodcart-core' ),
			),
			array(
				'mode' => 'section_end',
			),
		);
		return $fields;
	}

	protected function render() {
		$data = $this->get_settings();

		$owl_data = array( 
			'nav'                => $data['slider_nav'] == 'yes' ? true : false,
			'dots'               => $data['slider_dots'] == 'yes' ? true : false,
			'navText'            => array( "<i class='fa fa-angle-left'></i>", "<i class='fa fa-angle-right'></i>" ),
			'autoplay'           => $data['slider_autoplay'] == 'yes' ? true : false,
			'autoplayTimeout'    => $data['slider_interval'],
			'autoplaySpeed'      => $data['slider_autoplay_speed'],
			'autoplayHoverPause' => $data['slider_stop_on_hover'] == 'yes' ? true : false,
			'loop'               => $data['slider_loop'] == 'yes' ? true : false,
			'margin'             => 30,
			'responsive'         => array(
				'0'    => array( 'items' => 12 / $data['col_mobile'] ),
				'480'  => array( 'items' => 12 / $data['col_xs'] ),
				'768'  => array( 'items' => 12 / $data['col_sm'] ),
				'992'  => array( 'items' => 12 / $data['col_md'] ),
				'1200' => array( 'items' => 12 / $data['col_lg'] ),
			)
		);

		switch ( $data['style'] ) {
			case 'style3':
			$template = 'testimonial-grid';
			break;
			case 'style2':
			$template = 'testimonial-2';
			break;
			default:
			$template = 'testimonial-1';
			break;
		}

		$data['owl_data'] = json_encode( $owl_data );
		$this->rt_load_scripts();

		return $this->rt_template( $template, $data );
	}
}