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

class Info_Box extends Custom_Widget_Base {

	public function __construct( $data = [], $args = null ){
		$this->rt_name = esc_html__( 'Info Box', 'foodcart-core' );
		$this->rt_base = 'rt-info-box';
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
				'label'   => esc_html__( 'Style', 'foodcart-core' ),
				'options' => array(
					'style1' => esc_html__( 'Style 1', 'foodcart-core' ),
					'style2' => esc_html__( 'Style 2', 'foodcart-core' ),
					'style3' => esc_html__( 'Style 3', 'foodcart-core' ),
					'style4' => esc_html__( 'Style 4', 'foodcart-core' ),
					'style5' => esc_html__( 'Style 5', 'foodcart-core' ),
				),
				'default' => 'style1',
			),
			array(
				'type'    => Controls_Manager::SELECT2,
				'id'      => 'title_align',
				'label'   => esc_html__( 'Title Align', 'foodcart-core' ),
				'options' => array(
					'left' => esc_html__( 'Align Left' , 'foodcart-core' ),
					'center' => esc_html__( 'Align Center', 'foodcart-core' ),
					'right' => esc_html__( 'Align right', 'foodcart-core' ),
				),
				'default' => 'center',
			),
			array(
				'type'    => Controls_Manager::SELECT2,
				'id'      => 'icontype',
				'label'   => esc_html__( 'Icon Type', 'foodcart-core' ),
				'options' => array(
					'icon'  => esc_html__( 'Icon', 'foodcart-core' ),
					'image' => esc_html__( 'Custom Image', 'foodcart-core' ),
				),
				'default' => 'icon',
				'condition'   => array( 'style' => array( 'style2', 'style4', 'style5' ) ),
			),
			array(
				'type'    => Controls_Manager::ICON,
				'id'      => 'icon',
				'label'   => esc_html__( 'Icon', 'foodcart-core' ),
				'default' => 'fa fa-university',
				'condition'   => array( 'icontype' => array( 'icon' ), 'style' => array( 'style2', 'style4', 'style5' ) ),
			),
			array(
				'type'    => Controls_Manager::MEDIA,
				'id'      => 'image',
				'label'   => esc_html__( 'Image', 'foodcart-core' ),
				'condition'   => array( 'icontype' => array( 'image' ), 'style' => array( 'style2', 'style4', 'style5' ) ),
				'description' => esc_html__( 'Recommended image size is 67x67 px', 'foodcart-core' ),
			),
			array(
				'type'    => Controls_Manager::NUMBER,
				'id'      => 'icon_size',
				'label'   => esc_html__( 'Icon Size', 'foodcart-core' ),
				'default' => '',
				'condition'   => array( 'icontype' => array( 'icon' ), 'style' => array( 'style2', 'style4', 'style5' ) ),
				'selectors' => array(
					'{{WRAPPER}} .info-box .rtin-media span > span' => 'font-size: {{VALUE}}px',
				),
			),
			array(
				'type'    => Controls_Manager::COLOR,
				'id'      => 'icon_color',
				'label'   => esc_html__( 'Icon Color', 'foodcart-core' ),
				'default' => '',
				'condition'   => array( 'icontype' => array( 'icon' ), 'style' => array( 'style2', 'style4', 'style5' ) ),
				'selectors' => array(
					'{{WRAPPER}} .info-box .rtin-media span > span' => 'color: {{VALUE}}',
				),
			),
			array(
				'type'    => Controls_Manager::TEXT,
				'id'      => 'title',
				'label'   => esc_html__( 'Title', 'foodcart-core' ),
				'default' => esc_html__( 'Digital Solutions', 'foodcart-core' ),
				'condition'   => array( 'style' => array( 'style1', 'style2', 'style3', 'style4' ) ),
			),
			array(
				'type'    => Controls_Manager::TEXTAREA,
				'id'      => 'title_two',
				'label'   => esc_html__( 'Title', 'foodcart-core' ),
				'default' => esc_html__( 'Digital Solutions', 'foodcart-core' ),
				'condition'   => array( 'style' => array( 'style5' ) ),
			),
			array(
				'type'    => Controls_Manager::WYSIWYG,
				'id'      => 'content',
				'label'   => esc_html__( 'Content', 'foodcart-core' ),
				'default' => esc_html__( 'Lorem Ipsum hasbeen standard daand scrambled. Rimply dummy text of the printing and typesetting industry', 'foodcart-core' ),
				'condition'   => array( 'style' => array( 'style1', 'style2', 'style3', 'style5' ) ),
			),
			array(
				'type'  => Controls_Manager::URL,
				'id'    => 'url',
				'label' => esc_html__( 'Link (Optional)', 'foodcart-core' ),
				'placeholder' => 'https://your-link.com',
				'condition'   => array( 'style' => array( 'style1', 'style2', 'style3', 'style4' ) ),
			),
			array(
				'type'    => Controls_Manager::TEXT,
				'id'      => 'buttontext',
				'label'   => esc_html__( 'Button Text', 'foodcart-core' ),
				'default' => 'Read More',
				'condition'   => array( 'style' => array( 'style1', 'style2', 'style3', 'style4' ) ),
			),
			array(
				'mode' => 'section_end',
			),
			// Info options
			array(
				'mode'        => 'section_start',
				'id'          => 'sec_style',
				'label'   => esc_html__( 'Style', 'foodcart-core' ),
				'tab'     => Controls_Manager::TAB_STYLE,
			),
			array (
				'mode'    => 'group',
				'type'    => Group_Control_Typography::get_type(),
				'name'    => 'title_typo',
				'label'   => esc_html__( 'Title Style', 'foodcart-core' ),
				'selector' => '{{WRAPPER}} .info-box .rtin-item-title',
			),
			array(
				'type'    => Controls_Manager::COLOR,
				'id'      => 'title_color',
				'label'   => esc_html__( 'Title Color', 'foodcart-core' ),
				'default' => '',
				'selectors' => array(
					'{{WRAPPER}} .info-box .rtin-item-title' => 'color: {{VALUE}}',
					'{{WRAPPER}} .info-box .rtin-item-title a' => 'color: {{VALUE}}',
				),
			),
			array(
				'type'    => Controls_Manager::COLOR,
				'id'      => 'content_color',
				'label'   => esc_html__( 'Content Color', 'foodcart-core' ),
				'default' => '',
				'selectors' => array(
					'{{WRAPPER}} .info-box .rtin-text' => 'color: {{VALUE}}',
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

		switch ( $data['style'] ) {
			case 'style5':
			$template = 'info-box-5';
			break;
			case 'style4':
			$template = 'info-box-4';
			break;
			case 'style3':
			$template = 'info-box-3';
			break;
			case 'style2':
			$template = 'info-box-2';
			break;
			default:
			$template = 'info-box-1';
			break;
		}

		return $this->rt_template( $template, $data );
	}
}