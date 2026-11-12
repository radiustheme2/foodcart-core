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

class Offer_Box extends Custom_Widget_Base {

	public function __construct( $data = [], $args = null ){
		$this->rt_name = esc_html__( 'RT Offer Box', 'foodcart-core' );
		$this->rt_base = 'rt-offer-box';
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
				'type'    => Controls_Manager::TEXT,
				'id'      => 'title',
				'label'   => esc_html__( 'Title', 'foodcart-core' ),
				'default' => esc_html__( 'PIZZA OF THE DAY', 'foodcart-core' ),
			),
			array(
				'type'    => Controls_Manager::TEXTAREA,
				'id'      => 'subtitle',
				'label'   => esc_html__( 'Subtitle', 'foodcart-core' ),
				'default' => esc_html__( 'FREE DELIVERY', 'foodcart-core' ),
			),
			/*Number*/
			array(
				'type'    => Controls_Manager::TEXTAREA,
				'id'      => 'price_full',
				'label'   => esc_html__( 'Price( Full number )', 'foodcart-core' ),
				'default' => esc_html__( '$15', 'foodcart-core' ),
			),
			array(
				'type'    => Controls_Manager::TEXTAREA,
				'id'      => 'price_decimal',
				'label'   => esc_html__( 'Price( Decimal part )', 'foodcart-core' ),
				'default' => esc_html__( '.99', 'foodcart-core' ),
			),
			array(
				'type'    => Controls_Manager::WYSIWYG,
				'id'      => 'content',
				'label'   => esc_html__( 'Content', 'foodcart-core' ),
				'default' => esc_html__( 'Vegetable, Cheese Pizza , Beef Strome', 'foodcart-core' ),
			),
			array(
				'type'  => Controls_Manager::URL,
				'id'    => 'url',
				'label' => esc_html__( 'Link (Optional)', 'foodcart-core' ),
				'placeholder' => 'https://your-link.com',
			),
			array(
				'type'    => Controls_Manager::TEXT,
				'id'      => 'buttontext',
				'label'   => esc_html__( 'Button Text', 'foodcart-core' ),
				'default' => 'Order Now',				
			),
			array(
				'mode' => 'section_end',
			),
			// Slider options
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
				'selector' => '{{WRAPPER}} .site-banner-box-layout1 .rtin-item-title',
			),
			array(
				'type'    => Controls_Manager::COLOR,
				'id'      => 'title_color',
				'label'   => esc_html__( 'Title Color', 'foodcart-core' ),
				'default' => '#111111',
				'selectors' => array(
					'{{WRAPPER}} .site-banner-box-layout1 .rtin-item-title' => 'color: {{VALUE}}',
				),
			),
			array(
				'type'    => Controls_Manager::COLOR,
				'id'      => 'sub_title_color',
				'label'   => esc_html__( 'Sub Title Color', 'foodcart-core' ),
				'default' => '#111111',
				'selectors' => array(
					'{{WRAPPER}} .site-banner-box-layout1 .item-delivery span' => 'color: {{VALUE}}',
				),
			),
			array(
				'type'    => Controls_Manager::COLOR,
				'id'      => 'price_color',
				'label'   => esc_html__( 'Price Color', 'foodcart-core' ),
				'default' => '#111111',
				'selectors' => array(
					'{{WRAPPER}} .site-banner-box-layout1 .food-price-name .food-price .currency' => 'color: {{VALUE}}',
				),
			),
			array(
				'type'    => Controls_Manager::COLOR,
				'id'      => 'content_color',
				'label'   => esc_html__( 'Content Color', 'foodcart-core' ),
				'default' => '#444444',
				'selectors' => array(
					'{{WRAPPER}} .site-banner-box-layout1 .food-price-name .food-name' => 'color: {{VALUE}}',
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

		$template = 'offer-box';

		return $this->rt_template( $template, $data );
	}
}