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

class Title extends Custom_Widget_Base {

	public function __construct( $data = [], $args = null ){
		$this->rt_name = esc_html__( 'RT Section Title', 'foodcart-core' );
		$this->rt_base = 'rt-title';
		parent::__construct( $data, $args );
	}

	public function rt_fields(){
		$fields = array(
			array(
				'mode'    => 'section_start',
				'id'      => 'sec_general',
				'label'   => esc_html__( 'News Title', 'foodcart-core' ),
			),
			/*box title*/
			array(
				'type'    => Controls_Manager::SELECT2,
				'id'      => 'style',
				'label'   => esc_html__( 'Title Style', 'foodcart-core' ),
				'options' => array(
					'style1' => esc_html__( 'Title Style 1' , 'foodcart-core' ),
					'style2' => esc_html__( 'Title Style 2', 'foodcart-core' ),
					'style3' => esc_html__( 'Title Style 3', 'foodcart-core' ),
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
				'condition'   => array( 'style' => array( 'style1', 'style3' ) ),
			),
			array(
				'type'    => Controls_Manager::SELECT2,
				'id'      => 'showhide',
				'label'   => esc_html__( 'Title Bar', 'foodcart-core' ),
				'options' => array(
					'barshow'        => esc_html__( 'Show', 'foodcart-core' ),
					'barhide'        => esc_html__( 'Hide', 'foodcart-core' ),
				),
				'default' => 'barhide',
				'condition'   => array( 'style' => array( 'style1', 'style3' ) ),
			),
			array(
				'type'    => Controls_Manager::TEXTAREA,
				'id'      => 'title',
				'label'   => esc_html__( 'Title', 'foodcart-core' ),
				'default' => 'Wellcome To Foodcart',
			),
			array(
				'type'    => Controls_Manager::TEXTAREA,
				'id'      => 'sub_title',
				'label'   => esc_html__( 'Sub Title', 'foodcart-core' ),
				'default' => 'Our subtitle',
				'condition'   => array( 'style' => array( 'style1', 'style3' ) ),
			),
			/*Title Style Option*/
			array (
				'mode'    => 'group',
				'type'    => Group_Control_Typography::get_type(),
				'name'    => 'title_typo',
				'label'   => esc_html__( 'Title Style', 'foodcart-core' ),
				'selector' => '{{WRAPPER}} .sec-title .rtin-title',
			),
			array (
				'mode'    => 'group',
				'type'    => Group_Control_Typography::get_type(),
				'name'    => 'sub_title_typo',
				'label'   => esc_html__( 'Sub Title Style', 'foodcart-core' ),
				'selector' => '{{WRAPPER}} .sec-title .sub-title',
				'condition'   => array( 'style' => array( 'style1', 'style3' ) ),
			),
			array(
				'type'    => Controls_Manager::COLOR,
				'id'      => 'title_color',
				'label'   => esc_html__( 'Title Color', 'foodcart-core' ),
				'default' => '',
				'selectors' => array(
					'{{WRAPPER}} .sec-title .rtin-title' => 'color: {{VALUE}}',
				),
			),
			array(
				'type'    => Controls_Manager::COLOR,
				'id'      => 'title_bar_color',
				'label'   => esc_html__( 'Title Bar Color', 'foodcart-core' ),
				'default' => '',
				'selectors' => array(
					'{{WRAPPER}} .barshow .title-bar' => 'background: {{VALUE}}',
				),
				'condition'   => array( 'style' => array( 'style1', 'style3' ) ),
			),
			array(
				'type'    => Controls_Manager::COLOR,
				'id'      => 'sub_title_color',
				'label'   => esc_html__( 'Sub Title Color', 'foodcart-core' ),
				'default' => '',
				'selectors' => array(
					'{{WRAPPER}} .sec-title .sub-title' => 'color: {{VALUE}}',
				),
				'condition'   => array( 'style' => array( 'style1', 'style3' ) ),
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
			case 'style3':
			$template = 'title-3';
			break;
			case 'style2':
			$template = 'title-2';
			break;
			default:
			$template = 'title-1';
			break;
		}

		return $this->rt_template( $template, $data );
	}
}