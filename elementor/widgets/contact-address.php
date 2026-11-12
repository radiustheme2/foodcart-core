<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */

namespace radiustheme\Foodcart_Core;
use Elementor\Controls_Manager;

if ( ! defined( 'ABSPATH' ) ) exit;

class Contact_Address extends Custom_Widget_Base {

	public function __construct( $data = [], $args = null ){
		$this->rt_name = esc_html__( 'Contact Address', 'foodcart-core' );
		$this->rt_base = 'rt-contact-address';
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
				'type'    => Controls_Manager::TEXTAREA,
				'id'      => 'address',
				'label'   => esc_html__( 'Address', 'foodcart-core' ),
				'default' => esc_html__( '59 Street, loseagne, Newyork Road City', 'foodcart-core' ),
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
				'mode' => 'section_end',
			),
		);
		return $fields;
	}
		
	protected function render() {
			
		$data = $this->get_settings();
		
		$template = 'contact-address';

		return $this->rt_template( $template, $data );
	}
}