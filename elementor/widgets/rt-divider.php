<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */

namespace radiustheme\Foodcart_Core;
use Elementor\Controls_Manager;

if ( ! defined( 'ABSPATH' ) ) exit;

class Rt_Divider extends Custom_Widget_Base {

	public function __construct( $data = [], $args = null ){
		$this->rt_name = esc_html__( 'RT Divider', 'foodcart-core' );
		$this->rt_base = 'rt-divider';
		parent::__construct( $data, $args );
	}

	public function rt_fields(){
		$fields = array(
			array(
				'mode'    => 'section_start',
				'id'      => 'sec_general',
				'label'   => esc_html__( 'News Title', 'foodcart-core' ),
			),
			array(
				'type'    => Controls_Manager::SLIDER,
				'id'      => 'rtdivider_height',
				'label'   => esc_html__( 'Height', 'foodcart-core' ),
				'size_units' => array ('', 'px'),
				'options' => array(
					'divider' => 'yes',
					'view!' => 'inline',
				),
				'selectors' => array(
					'{{WRAPPER}} .rtin-divider .divide-bar:after' => 'height: {{SIZE}}{{UNIT}}',
				),
				'default' => array (
					'size' => 200,
					'unit' => 'px',
				),
			),
			array(
				'type'    => Controls_Manager::SLIDER,
				'id'      => 'rtdivider_width',
				'label'   => esc_html__( 'Width', 'foodcart-core' ),
				'size_units' => array ('', 'px'),
				'options' => array(
					'divider' => 'yes',
					'view!' => 'inline',
				),
				'selectors' => array(
					'{{WRAPPER}} .rtin-divider .divide-bar:after' => 'width: {{SIZE}}{{UNIT}}',
				),
				'default' => array (
					'size' => 1,
					'unit' => 'px',
				),
			),
			
			array(
				'mode' => 'section_end',
			),
		);
		return $fields;
	}

	protected function render() {
		$data = $this->get_settings();

		$template = 'rt-divider';

		return $this->rt_template( $template, $data );
	}
}