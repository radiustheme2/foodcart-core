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

class Team_Slider extends Custom_Widget_Base {

	public function __construct( $data = [], $args = null ){
		$this->rt_name = esc_html__( 'Team Slider', 'foodcart-core' );
		$this->rt_base = 'rt-team-slider';
		$this->rt_translate = array(
			'cols'  => array(
				'12' => esc_html__( '1 Col', 'foodcart-core' ),
				'6'  => esc_html__( '2 Col', 'foodcart-core' ),
				'4'  => esc_html__( '3 Col', 'foodcart-core' ),
				'3'  => esc_html__( '4 Col', 'foodcart-core' ),
				'2'  => esc_html__( '6 Col', 'foodcart-core' ),
			),
		);
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
		wp_enqueue_script( 'slick' );
	}

	public function rt_fields(){
		$terms = get_terms( array( 'taxonomy' => 'foodcart_team_category', 'fields' => 'id=>name' ) );
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
				'type'    => Controls_Manager::SELECT2,
				'id'      => 'style',
				'label'   => esc_html__( 'Style', 'foodcart-core' ),
				'options' => array(
					'style1' => esc_html__( 'Style 1', 'foodcart-core' ),
					'style2' => esc_html__( 'Style 2', 'foodcart-core' ),
					'style3' => esc_html__( 'Style 3', 'foodcart-core' ),
					'style4' => esc_html__( 'Style 4', 'foodcart-core' ),
				),
				'default' => 'style1',
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
				'default'     => false,
				'description' => esc_html__( 'Show or Hide Content. Default: off', 'foodcart-core' ),
				'condition'   => array( 'style' => array( 'style2', 'style4' ) ),
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
				'condition'   => array( 'content_display' => array( 'yes' ),'style' => array( 'style2', 'style4' ) ),
			),
			array(
				'type'    => Controls_Manager::NUMBER,
				'id'      => 'count',
				'label'   => esc_html__( 'Word count', 'foodcart-core' ),
				'default' => 15,
				'description' => esc_html__( 'Maximum number of words', 'foodcart-core' ),
				'condition'   => array( 'content_display' => array( 'yes' ),'style' => array( 'style2', 'style4' ) ),
			),
			array(
				'type'        => Controls_Manager::SWITCHER,
				'id'          => 'designation_display',
				'label'       => esc_html__( 'Designation Display', 'foodcart-core' ),
				'label_on'    => esc_html__( 'On', 'foodcart-core' ),
				'label_off'   => esc_html__( 'Off', 'foodcart-core' ),
				'default'     => 'yes',
				'description' => esc_html__( 'Show or Hide Designation. Default: On', 'foodcart-core' ),
			),
			array(
				'type'        => Controls_Manager::SWITCHER,
				'id'          => 'social_display',
				'label'       => esc_html__( 'Social Media Display', 'foodcart-core' ),
				'label_on'    => esc_html__( 'On', 'foodcart-core' ),
				'label_off'   => esc_html__( 'Off', 'foodcart-core' ),
				'default'     => 'yes',
				'description' => esc_html__( 'Show or Hide Social Medias. Default: On', 'foodcart-core' ),
			),
			array(
				'mode' => 'section_end',
			),

			// Responsive Columns
			array(
				'mode'    => 'section_start',
				'id'      => 'sec_responsive',
				'label'   => esc_html__( 'Number of Responsive Columns', 'foodcart-core' ),
				'condition'   => array( 'style' => array( 'style1', 'style2', 'style3' ) ),
			),
			array(
				'type'    => Controls_Manager::SELECT2,
				'id'      => 'col_lg',
				'label'   => esc_html__( 'Desktops: > 1199px', 'foodcart-core' ),
				'options' => $this->rt_translate['cols'],
				'default' => '4',
			),
			array(
				'type'    => Controls_Manager::SELECT2,
				'id'      => 'col_md',
				'label'   => esc_html__( 'Desktops: > 991px', 'foodcart-core' ),
				'options' => $this->rt_translate['cols'],
				'default' => '4',
			),
			array(
				'type'    => Controls_Manager::SELECT2,
				'id'      => 'col_sm',
				'label'   => esc_html__( 'Tablets: > 767px', 'foodcart-core' ),
				'options' => $this->rt_translate['cols'],
				'default' => '6',
			),
			array(
				'type'    => Controls_Manager::SELECT2,
				'id'      => 'col_xs',
				'label'   => esc_html__( 'Phones: < 768px', 'foodcart-core' ),
				'options' => $this->rt_translate['cols'],
				'default' => '12',
			),
			array(
				'type'    => Controls_Manager::SELECT2,
				'id'      => 'col_mobile',
				'label'   => esc_html__( 'Small Phones: < 480px', 'foodcart-core' ),
				'options' => $this->rt_translate['cols'],
				'default' => '12',
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
			
			// Slider options
			array(
				'mode'        => 'section_start',
				'id'          => 'sec_slider',
				'label'       => esc_html__( 'Slider Options', 'foodcart-core' ),
				'condition'   => array( 'style' => array( 'style1', 'style2', 'style3' ) ),
			),
			array(
				'type'        => Controls_Manager::SWITCHER,
				'id'          => 'slider_nav',
				'label'       => esc_html__( 'Navigation Arrow', 'foodcart-core' ),
				'label_on'    => esc_html__( 'On', 'foodcart-core' ),
				'label_off'   => esc_html__( 'Off', 'foodcart-core' ),
				'default'     => 'yes',
				'description' => esc_html__( 'Enable or disable navigation arrow. Default: On', 'foodcart-core' ),
			),
			array(
				'type'        => Controls_Manager::SWITCHER,
				'id'          => 'slider_dots',
				'label'       => esc_html__( 'Navigation Dots', 'foodcart-core' ),
				'label_on'    => esc_html__( 'On', 'foodcart-core' ),
				'label_off'   => esc_html__( 'Off', 'foodcart-core' ),
				'default'     => '',
				'description' => esc_html__( 'Enable or disable navigation dots. Default: Off', 'foodcart-core' ),
			),
			array(
				'type'        => Controls_Manager::SWITCHER,
				'id'          => 'slider_autoplay',
				'label'       => esc_html__( 'Autoplay', 'foodcart-core' ),
				'label_on'    => esc_html__( 'On', 'foodcart-core' ),
				'label_off'   => esc_html__( 'Off', 'foodcart-core' ),
				'default'     => 'yes',
				'description' => esc_html__( 'Enable or disable autoplay. Default: On', 'foodcart-core' ),
			),
			array(
				'type'        => Controls_Manager::SWITCHER,
				'id'          => 'slider_stop_on_hover',
				'label'       => esc_html__( 'Stop on Hover', 'foodcart-core' ),
				'label_on'    => esc_html__( 'On', 'foodcart-core' ),
				'label_off'   => esc_html__( 'Off', 'foodcart-core' ),
				'default'     => 'yes',
				'description' => esc_html__( 'Stop autoplay on mouse hover. Default: On', 'foodcart-core' ),
				'condition'   => array( 'slider_autoplay' => 'yes' ),
			),
			array(
				'type'    => Controls_Manager::SELECT2,
				'id'      => 'slider_interval',
				'label'   => esc_html__( 'Autoplay Interval', 'foodcart-core' ),
				'options' => array(
					'5000' => esc_html__( '5 Seconds', 'foodcart-core' ),
					'4000' => esc_html__( '4 Seconds', 'foodcart-core' ),
					'3000' => esc_html__( '3 Seconds', 'foodcart-core' ),
					'2000' => esc_html__( '2 Seconds', 'foodcart-core' ),
					'1000' => esc_html__( '1 Second',  'foodcart-core' ),
				),
				'default' => '5000',
				'description' => esc_html__( 'Set any value for example 5 seconds to play it in every 5 seconds. Default: 5 Seconds', 'foodcart-core' ),
				'condition'   => array( 'slider_autoplay' => 'yes' ),
			),
			array(
				'type'    => Controls_Manager::NUMBER,
				'id'      => 'slider_autoplay_speed',
				'label'   => esc_html__( 'Autoplay Slide Speed', 'foodcart-core' ),
				'default' => 200,
				'description' => esc_html__( 'Slide speed in milliseconds. Default: 200', 'foodcart-core' ),
				'condition'   => array( 'slider_autoplay' => 'yes' ),
			),
			array(
				'type'        => Controls_Manager::SWITCHER,
				'id'          => 'slider_loop',
				'label'       => esc_html__( 'Loop', 'foodcart-core' ),
				'label_on'    => esc_html__( 'On', 'foodcart-core' ),
				'label_off'   => esc_html__( 'Off', 'foodcart-core' ),
				'default'     => 'yes',
				'description' => esc_html__( 'Loop to first item. Default: On', 'foodcart-core' ),
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
			case 'style4':
			$this->rt_load_scripts_slick();
			$template = 'team-slider-4';
			break;
			case 'style3':
			$this->rt_load_scripts();
			$owl_data['margin'] = 2;
			$template = 'team-slider-3';
			break;
			case 'style2':
			$this->rt_load_scripts();
			$template = 'team-slider-2';
			break;
			default:
			$this->rt_load_scripts();
			$template = 'team-slider-1';
			break;
		}
		
		$data['owl_data'] = json_encode( $owl_data );

		return $this->rt_template( $template, $data );
	}
}