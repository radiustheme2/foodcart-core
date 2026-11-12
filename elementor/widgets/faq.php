<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */

namespace radiustheme\Foodcart_Core;
use Elementor\Controls_Manager;

if ( ! defined( 'ABSPATH' ) ) exit;

class RT_Faq extends Custom_Widget_Base {

	public function __construct( $data = [], $args = null ){
		$this->rt_name = esc_html__( 'RT Faq', 'foodcart-core' );
		$this->rt_base = 'rt-faq';
		parent::__construct( $data, $args );
	}

	public function rt_fields(){
		$fields = array(
			array(
				'mode'    => 'section_start',
				'id'      => 'sec_general',
				'label'   => esc_html__( 'General', 'foodcart-core' ),
			),
			/*Faq Item*/
			array(
				'type'    => Controls_Manager::REPEATER,
				'id'      => 'faq_item_lists',
				'label'   => esc_html__( 'Add as many item as you want', 'foodcart-core' ),
				'fields'  => array(
					array(
						'type'    => Controls_Manager::TEXT,
						'name'    => 'item_number',
						'label'   => esc_html__( 'Faq Number', 'foodcart-core' ),
						'default' => '1',
					),
					array(
						'type'    => Controls_Manager::TEXTAREA,
						'name'    => 'item_title',
						'label'   => esc_html__( 'Title', 'foodcart-core' ),
						'default' => esc_html__( 'What shipping methods are available?', 'foodcart-core' ),
					),
					array(
						'type'    => Controls_Manager::TEXTAREA,
						'name'    => 'item_text',
						'label'   => esc_html__( 'Text', 'foodcart-core' ),
						'default' => esc_html__( 'Restaurant mply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industrd dummy when an unknown printer took a galley of type and scrambled it to make a type specimen book.Restaurant mply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industrd dummy when an unknown printer.', 'foodcart-core' ),					
					),
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
		
		$template = 'faq';

		return $this->rt_template( $template, $data );
	}
}