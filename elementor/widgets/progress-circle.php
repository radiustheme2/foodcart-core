<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */

namespace radiustheme\Foodcart_Core;

use Elementor\Controls_Manager;

if ( ! defined( 'ABSPATH' ) ) exit;

class Progress_Circle extends Custom_Widget_Base {

	public function __construct( $data = [], $args = null ){
		$this->rt_name = __( 'Progress Circle', 'foodcart-core' );
		$this->rt_base = 'rt-progress-circle';
		parent::__construct( $data, $args );
	}

	private function rt_load_scripts(){
		wp_enqueue_script( 'knob' );
		wp_enqueue_script( 'appear' );
	}

	public function rt_fields(){
		$fields = array(
			array(
				'mode'    => 'section_start',
				'id'      => 'sec_general',
				'label'   => esc_html__( 'General', 'foodcart-core' ),
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
				'id'      => 'number',
				'label'   => esc_html__( 'Circle Number', 'foodcart-core' ),
				'default' => 50,
			),
			array(
				'type'    => Controls_Manager::TEXT,
				'id'      => 'circle_width',
				'label'   => esc_html__( 'Circle Width', 'foodcart-core' ),
				'default' => 200,
			),
			array(
				'type'    => Controls_Manager::TEXT,
				'id'      => 'circle_height',
				'label'   => esc_html__( 'Circle Height', 'foodcart-core' ),
				'default' => 200,
			),
			array(
				'type'    => Controls_Manager::TEXT,
				'id'      => 'circle_border',
				'label'   => esc_html__( 'Circle thickness', 'foodcart-core' ),
				'default' => 0.09,
			),
			array(
				'type'    => Controls_Manager::TEXT,
				'id'      => 'title',
				'label'   => esc_html__( 'Title', 'foodcart-core' ),
				'default' => esc_html__( 'Feature works', 'foodcart-core' ),
			),
			array(
				'type'    => Controls_Manager::TEXTAREA,
				'id'      => 'content',
				'label'   => esc_html__( 'Content', 'foodcart-core' ),
				'default' => esc_html__( 'All our projects incorporate a unique artistic image functional.', 'foodcart-core' ),
			),
			array(
				'type'    => Controls_Manager::NUMBER,
				'id'      => 'speed',
				'label'   => esc_html__( 'Animation Speed', 'foodcart-core' ),
				'default' => 5000,
				'description' => esc_html__( 'The total duration of the count animation in milisecond eg. 5000', 'foodcart-core' ),
			),
			array(
				'type'    => Controls_Manager::NUMBER,
				'id'      => 'steps',
				'label'   => esc_html__( 'Animation Steps', 'foodcart-core' ),
				'default' => 10,
				'description' => esc_html__( 'Counter steps eg. 10', 'foodcart-core' ),
			),
			array(
				'mode' => 'section_end',
			),
			array(
				'mode'    => 'section_start',
				'id'      => 'sec_style',
				'label'   => esc_html__( 'Style', 'foodcart-core' ),
			),
			array(
				'type'    => Controls_Manager::COLOR,
				'id'      => 'bgcolor_color',
				'label'   => esc_html__( 'bgcolor Color', 'foodcart-core' ),
				'default' => '#ebebeb',
			),
			array(
				'type'    => Controls_Manager::COLOR,
				'id'      => 'fgcolor_color',
				'label'   => esc_html__( 'fgcolor Color', 'foodcart-core' ),
				'default' => '#444444',
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
		
		$template = 'progress-circle';

		return $this->rt_template( $template, $data );
	}
}