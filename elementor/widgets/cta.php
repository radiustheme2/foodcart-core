<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */

namespace radiustheme\Foodcart_Core;

use Elementor\Controls_Manager;

if ( ! defined( 'ABSPATH' ) ) exit;

class CTA extends Custom_Widget_Base {

	public function __construct( $data = [], $args = null ){
		$this->rt_name = esc_html__( 'Call to Action', 'foodcart-core' );
		$this->rt_base = 'rt-cta';
		parent::__construct( $data, $args );
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
				'id'      => 'style',
				'label'   => esc_html__( 'CTA Style', 'foodcart-core' ),
				'options' => array(
					'style1' => esc_html__( 'Style 1' , 'foodcart-core' ),
					'style2' => esc_html__( 'Style 2', 'foodcart-core' ),
				),
				'default' => 'style1',
			),
			array(
				'type'    => Controls_Manager::SELECT2,
				'id'      => 'theme',
				'label'   => esc_html__( 'Theme', 'foodcart-core' ),
				'options' => array(
					'light' => esc_html__( 'Light Background', 'foodcart-core' ),
					'dark'  => esc_html__( 'Dark Background', 'foodcart-core' ),
				),
				'default' => 'light',
			),
			array(
				'type'    => Controls_Manager::TEXTAREA,
				'id'      => 'title',
				'label'   => esc_html__( 'Title', 'foodcart-core' ),
				'default' => esc_html__( 'Please Call Us For Order', 'foodcart-core' ),
			),
			array(
				'type'    => Controls_Manager::TEXTAREA,
				'id'      => 'content',
				'label'   => esc_html__( 'Content Text ', 'foodcart-core' ),
				'default' => esc_html__( 'Porem ipsum dolor sit amet, consectetur adipisicing elitProin nibh auguesuscipit scelerisque.', 'foodcart-core' ),
				'condition'   => array( 'style' => array( 'style1' ) ),
			),
			array(
				'type'    => Controls_Manager::TEXTAREA,
				'id'      => 'pho_number',
				'label'   => esc_html__( 'Phone Number', 'foodcart-core' ),
				'default' => '+ 95 888 777',
				'condition'   => array( 'style' => array( 'style2' ) ),
			),
			array(
				'type'    => Controls_Manager::TEXT,
				'id'      => 'buttontext',
				'label'   => esc_html__( 'Button Text', 'foodcart-core' ),
				'default' => 'Read More',
				'condition'   => array( 'style' => array( 'style1' ) ),
			),
			array(
				'type'    => Controls_Manager::URL,
				'id'      => 'buttonurl',
				'label'   => esc_html__( 'Button URL', 'foodcart-core' ),
				'placeholder' => 'https://your-link.com',
				'condition'   => array( 'style' => array( 'style1' ) ),
			),
			array(
				'mode' => 'section_end',
			),
		);
		return $fields;
	}

	protected function render() {
		$data = $this->get_settings();
		
		switch ( $data['style'] ) {
			case 'style2':
			$template = 'cta-2';
			break;
			default:
			$template = 'cta-1';
			break;
		}

		return $this->rt_template( $template, $data );
	}
}