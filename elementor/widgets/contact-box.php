<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */

namespace radiustheme\Foodcart_Core;
use Elementor\Controls_Manager;

if ( ! defined( 'ABSPATH' ) ) exit;

class Contact_Box extends Custom_Widget_Base {

	public function __construct( $data = [], $args = null ){
		$this->rt_name = esc_html__( 'Contact Box', 'foodcart-core' );
		$this->rt_base = 'rt-contact-box';
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
				'label'   => esc_html__( 'Theme Style', 'foodcart-core' ),
				'options' => array(
					'light' => esc_html__( 'Light Background', 'foodcart-core' ),
					'dark'  => esc_html__( 'Dark Background', 'foodcart-core' ),
				),
				'default' => 'light',
			),
			array(
				'type'    => Controls_Manager::SELECT2,
				'id'      => 'textalign',
				'label'   => esc_html__( 'Title Align', 'foodcart-core' ),
				'options' => array(
					'left' => esc_html__( 'Align Left' , 'foodcart-core' ),
					'center' => esc_html__( 'Align Center', 'foodcart-core' ),
					'right' => esc_html__( 'Align right', 'foodcart-core' ),
				),
				'default' => 'center',
			),
			array(
				'type'    => Controls_Manager::TEXTAREA,
				'id'      => 'address',
				'label'   => esc_html__( 'Address', 'foodcart-core' ),
				'default' => esc_html__( '59 Street, 06 Lane, Newyork', 'foodcart-core' ),
			),
			array(
				'type'    => Controls_Manager::TEXTAREA,
				'id'      => 'phone',
				'label'   => esc_html__( 'Phone no', 'foodcart-core' ),
				'default' => '+012 345 6789',
			),
			array(
				'type'    => Controls_Manager::TEXTAREA,
				'id'      => 'email',
				'label'   => esc_html__( 'Email', 'foodcart-core' ),
				'default' => 'contact@foodcart.com',
			),
			array(
				'type'    => Controls_Manager::TEXTAREA,
				'id'      => 'fax',
				'label'   => esc_html__( 'Fax', 'foodcart-core' ),
				'default' => '+59 987 065 009',
			),
			
			array(
				'type'        => Controls_Manager::SWITCHER,
				'id'          => 'button_display',
				'label'       => esc_html__( 'Button Display', 'foodcart-core' ),
				'label_on'    => esc_html__( 'On', 'foodcart-core' ),
				'label_off'   => esc_html__( 'Off', 'foodcart-core' ),
				'default'     => false,
				'description' => esc_html__( 'Show or Hide Content. Default: off', 'foodcart-core' ),
			),
			array(
				'type'    => Controls_Manager::SELECT2,
				'id'      => 'buttonstyle',
				'label'   => esc_html__( 'Button Style', 'foodcart-core' ),
				'options' => array(
					'light' => esc_html__( 'Light Background', 'foodcart-core' ),
					'dark'  => esc_html__( 'Dark Background', 'foodcart-core' ),
				),
				'default' => 'dark',
				'condition'   => array( 'button_display' => array( 'yes' ) ),
			),
			array(
				'type'    => Controls_Manager::TEXT,
				'id'      => 'button_one',
				'label'   => esc_html__( 'Button Text', 'foodcart-core' ),
				'default' => 'Read More',
				'condition'   => array( 'button_display' => array( 'yes' ) ),
			),
			array(
				'type'    => Controls_Manager::URL,
				'id'      => 'one_buttonurl',
				'label'   => esc_html__( 'Button URL', 'foodcart-core' ),
				'placeholder' => 'https://your-link.com',
				'condition'   => array( 'button_display' => array( 'yes' ) ),
			),
			
			array(
				'mode' => 'section_end',
			),
		);
		return $fields;
	}
		
	protected function render() {
			
		$data = $this->get_settings();
		
		$template = 'contact-box';

		return $this->rt_template( $template, $data );
	}
}