<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */

namespace radiustheme\Foodcart_Core;

use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Scheme_Base;

if ( ! defined( 'ABSPATH' ) ) exit;

class About_Image_Text extends Custom_Widget_Base {

	public function __construct( $data = [], $args = null ){
		$this->rt_name = esc_html__( 'About Image Text', 'foodcart-core' );
		$this->rt_base = 'rt-About-image-text';
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
				'label'   => esc_html__( 'About Style', 'foodcart-core' ),
				'options' => array(
					'style1' => esc_html__( 'About Style 1' , 'foodcart-core' ),
					'style2' => esc_html__( 'About Style 2 ( Content Fulied )', 'foodcart-core' ),
				),
				'default' => 'style1',
			),
			array(
				'type'    => Controls_Manager::TEXTAREA,
				'id'      => 'title',
				'label'   => esc_html__( 'Title', 'foodcart-core' ),
				'default' => 'About Us',
			),
			array(
				'type'    => Controls_Manager::TEXTAREA,
				'id'      => 'sub_title',
				'label'   => esc_html__( 'Sub Title', 'foodcart-core' ),
				'default' => esc_html__('Discover', 'foodcart-core' ),
			),
			array(
				'type'    => Controls_Manager::MEDIA,
				'id'      => 'image',
				'label'   => __( 'Image', 'foodcart-core' ),
				'description' => __( 'Recommended image size is 490x600 px', 'foodcart-core' ),
			),
			array(
				'type'    => Controls_Manager::WYSIWYG,
				'id'      => 'content',
				'label'   => esc_html__( 'Content', 'foodcart-core' ),
				'default' => esc_html__('Lorem Ipsum has been the industrys standard dummy text ever since printer took a galley. Rimply dummy text of the printing and typesetting industry', 'foodcart-core' ),
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
				'type'        => Controls_Manager::TEXT,
				'id'          => 'button_one',
				'label'       => esc_html__( 'Button Text', 'foodcart-core' ),
				'default' 	  => esc_html__('Read More', 'foodcart-core' ),
				'condition'   => array( 'button_display' => array( 'yes' ) ),
			),
			array(
				'type'        => Controls_Manager::URL,
				'id'          => 'one_buttonurl',
				'label'       => esc_html__( 'Button URL', 'foodcart-core' ),
				'placeholder' => 'https://your-link.com',
				'condition'   => array( 'button_display' => array( 'yes' ) ),
			),
			
			array(
				'mode' => 'section_end',
			),
			// Style
			array(
				'mode'    => 'section_start',
				'id'      => 'sec_style',
				'label'   => esc_html__( 'Style', 'foodcart-core' ),
				'tab'     => Controls_Manager::TAB_STYLE,
			),
			array (
				'mode'    => 'group',
				'type'    => Group_Control_Typography::get_type(),
				'name'    => 'title_typo',
				'label'   => esc_html__( 'Title Style', 'foodcart-core' ),
				'selector' => '{{WRAPPER}} .about-image-text .about-content .rtin-title',
			),
			array (
				'mode'    => 'group',
				'type'    => Group_Control_Typography::get_type(),
				'name'    => 'sub_title_typo',
				'label'   => esc_html__( 'Sub Title Style', 'foodcart-core' ),
				'selector' => '{{WRAPPER}} .about-image-text .about-content .sub-rtin-title',
			),
			array(
				'type'    => Controls_Manager::COLOR,
				'id'      => 'title_color',
				'label'   => esc_html__( 'Title Color', 'foodcart-core' ),
				'default' => '#111111',
			),
			array(
				'type'    => Controls_Manager::COLOR,
				'id'      => 'sub_title_color',
				'label'   => esc_html__( 'Sub Title Color', 'foodcart-core' ),
				'default' => '#444444',
			),
			array(
				'type'    => Controls_Manager::COLOR,
				'id'      => 'content_color',
				'label'   => esc_html__( 'Content Color', 'foodcart-core' ),
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

		switch ( $data['style'] ) {
			case 'style2':
			$template = 'about-image-text-2';
			break;
			default:
			$template = 'about-image-text-1';
			break;
		}
	
		return $this->rt_template( $template, $data );
	}
}