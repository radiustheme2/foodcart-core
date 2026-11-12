<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */

namespace radiustheme\Foodcart_Core;

use Elementor\Controls_Manager;


if ( ! defined( 'ABSPATH' ) ) exit;

class Slider extends Custom_Widget_Base {

	public function __construct( $data = [], $args = null ){
		$this->rt_name = esc_html__( 'FullScreen Slider', 'foodcart-core' );
		$this->rt_base = 'rt-slider';
		parent::__construct( $data, $args );
	}

	private function rt_load_scripts(){
		wp_enqueue_style( 'nivo-slider' );
		wp_enqueue_script( 'nivo-slider' );
	}

	public function rt_fields(){
		$fields = array(
			array(
				'mode'    => 'section_start',
				'id'      => 'sec_general',
				'label'   => esc_html__( 'General', 'foodcart-core' ),
			),
			array(
				'type'    => Controls_Manager::REPEATER,
				'id'      => 'slides',
				'label'   => esc_html__( 'Add as many slides as you want', 'foodcart-core' ),
				'fields'  => array(
					array(
						'type'    => Controls_Manager::MEDIA,
						'name'    => 'image',
						'label'   => esc_html__( 'Image', 'foodcart-core' ),
						'description' => esc_html__( 'Image size should be 1920x820 px', 'foodcart-core' ),
					),
					array(
						'type'    => Controls_Manager::TEXTAREA,
						'name'    => 'title',
						'label'   => esc_html__( 'Title', 'foodcart-core' ),
						'default' => 'LOREM IPSUM DUMMY TEXT',
					),
					array(
						'type'    => Controls_Manager::COLOR,
						'name'      => 'title_color',
						'label'   => esc_html__( 'Title Color', 'foodcart-core' ),
						'default' => '#111111',
					),
					array(
						'type'    => Controls_Manager::TEXTAREA,
						'name'    => 'subtitle',
						'label'   => esc_html__( 'Subtitle(For desktop and tab)', 'foodcart-core' ),
						'default' => 'Dorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod teididunt ut labore et orem ipsum dolor sit ameo eiusmod tm do eiusmod teididunt ut labore et dolore',
					),
					array(
						'type'    => Controls_Manager::COLOR,
						'name'      => 'subtitle_color',
						'label'   => esc_html__( 'Subtitle Color', 'foodcart-core' ),
						'default' => '#444444',
					),
					array(
						'type'    => Controls_Manager::TEXTAREA,
						'name'    => 'subtitle_mob',
						'label'   => esc_html__( 'Subtitle(For mobile)', 'foodcart-core' ),
						'default' => 'Dorem ipsum dolor sit amet, consectetur adipisicing',
					),
					array(
						'type'    => Controls_Manager::TEXT,
						'name'    => 'buttontext',
						'label'   => esc_html__( 'Button Text', 'foodcart-core' ),
						'default' => 'LOREM IPSUM',
					),
					array(
						'type'    => Controls_Manager::TEXT,
						'name'    => 'buttonurl',
						'label'   => esc_html__( 'Button URL', 'foodcart-core' ),
					),
				),
			),
			array(
				'mode' => 'section_end',
			),
			array(
				'mode'        => 'section_start',
				'id'          => 'sec_slider',
				'label'       => esc_html__( 'Slider Options', 'foodcart-core' ),
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
				'label'       => esc_html__( 'Navigation Dot', 'foodcart-core' ),
				'label_on'    => esc_html__( 'On', 'foodcart-core' ),
				'label_off'   => esc_html__( 'Off', 'foodcart-core' ),
				'default'     => '',
				'description' => esc_html__( 'Enable or disable navigation dot. Default: Off', 'foodcart-core' ),
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
				'type'    	  => Controls_Manager::SELECT2,
				'id'      	  => 'slider_effect',
				'label'   	  => esc_html__( 'Slider Effect', 'foodcart-core' ),
				'options' 	  => array(
					'sliceDown' 		=> esc_html__( 'SliceDown', 'blogxer-core' ),
					'sliceDownLeft' 	=> esc_html__( 'SliceDownLeft', 'blogxer-core' ),
					'sliceUp' 			=> esc_html__( 'SliceUp', 'blogxer-core' ),
					'sliceUpLeft' 		=> esc_html__( 'SliceUpLeft', 'blogxer-core' ),
					'sliceUpDown' 		=> esc_html__( 'SliceUpDown',  'blogxer-core' ),
					'SliceUpDownLeft' 	=> esc_html__( 'SliceUpDownLeft',  'blogxer-core' ),
					'fade' 				=> esc_html__( 'Fade',  'blogxer-core' ),
					'slideInRight' 		=> esc_html__( 'SlideInRight',  'blogxer-core' ),
					'slideInLeft' 		=> esc_html__( 'SlideInLeft',  'blogxer-core' ),
					'boxRainReverse' 	=> esc_html__( 'BoxRainReverse',  'blogxer-core' ),
				),
				'default' 	  => 'boxRainReverse',
				'description' => esc_html__( 'Slider Effect. Default: boxRainReverse', 'foodcart-core' ),
			),
			array(
				'type'    	  => Controls_Manager::NUMBER,
				'id'      	  => 'slider_anim_speed',
				'label'   	  => esc_html__( 'Slider Animatin Speed', 'foodcart-core' ),
				'default' 	  => 500,
				'description' => esc_html__( 'Slide speed in milliseconds. Default: 500', 'foodcart-core' ),
			),
			array(
				'type'    	  => Controls_Manager::NUMBER,
				'id'      	  => 'slider_pause_time',
				'label'   	  => esc_html__( 'Slider Pause Time', 'foodcart-core' ),
				'default' 	  => 3000,
				'description' => esc_html__( 'Slide Pause Time. Default: 3000', 'foodcart-core' ),
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

		$template = 'slider';

		return $this->rt_template( $template, $data );
	}
}