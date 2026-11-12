<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */

namespace radiustheme\Foodcart_Core;

use Elementor\Controls_Manager;
use Elementor\Group_Control_Background;

if ( ! defined( 'ABSPATH' ) ) exit;

class Team_Grid extends Custom_Widget_Base {

	public function __construct( $data = [], $args = null ){
		$this->rt_name = esc_html__( 'Team Grid', 'foodcart-core' );
		$this->rt_base = 'rt-team-grid';
		$this->rt_translate = array(
			'cols'  => array(
				'12' => esc_html__( '1 Col', 'foodcart-core' ),
				'6'  => esc_html__( '2 Col', 'foodcart-core' ),
				'4'  => esc_html__( '3 Col', 'foodcart-core' ),
				'3'  => esc_html__( '4 Col', 'foodcart-core' ),
				'2'  => esc_html__( '6 Col', 'foodcart-core' ),
			),
		);
		parent::__construct( $data, $args );
	}

	public function rt_fields(){
		$terms = get_terms( array( 'taxonomy' => 'foodcart_team_category', 'fields' => 'id=>name' ) );
		$category_dropdown = array( '0' => esc_html__( 'All Categories', 'foodcart-core' ) );

		foreach ( $terms as $id => $name ) {
			$category_dropdown[$id] = $name;
		}

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
				),
				'default' => 'style1',
			),
			array(
				'type'    => Controls_Manager::NUMBER,
				'id'      => 'number',
				'label'   => esc_html__( 'Total number of items', 'foodcart-core' ),
				'default' => 6,
				'description' => esc_html__( 'Write -1 to show all', 'foodcart-core' ),
			),
			array(
				'type'    => Controls_Manager::SELECT2,
				'id'      => 'cat',
				'label'   => esc_html__( 'Categories', 'foodcart-core' ),
				'options' => $category_dropdown,
				'default' => '0',
			),
			array(
				'type'    => Controls_Manager::SELECT2,
				'id'      => 'orderby',
				'label'   => esc_html__( 'Order By', 'foodcart-core' ),
				'options' => array(
					'date'        => esc_html__( 'Date (Recents comes first)', 'foodcart-core' ),
					'title'       => esc_html__( 'Title', 'foodcart-core' ),
					'menu_order'  => esc_html__( 'Custom Order (Available via Order field inside Page Attributes box)', 'foodcart-core' ),
				),
				'default' => 'date',
			),
			array(
				'type'        => Controls_Manager::SWITCHER,
				'id'          => 'content_display',
				'label'       => esc_html__( 'Content Display', 'foodcart-core' ),
				'label_on'    => esc_html__( 'On', 'foodcart-core' ),
				'label_off'   => esc_html__( 'Off', 'foodcart-core' ),
				'default'     => false,
				'description' => esc_html__( 'Show or Hide Content. Default: off', 'foodcart-core' ),
				'condition'   => array( 'style' => array( 'style2' ) ),
			),
			array(
				'type'    => Controls_Manager::SELECT2,
				'id'      => 'contype',
				'label'   => esc_html__( 'Content Type', 'foodcart-core' ),
				'options' => array(
					'excerpt' => esc_html__( 'Excerpts', 'foodcart-core' ),
					'content' => esc_html__( 'Conents', 'foodcart-core' ),
				),
				'default'     => 'excerpt',
				'description' => esc_html__( 'Display contents from Editor or Excerpt field', 'foodcart-core' ),
				'condition'   => array( 'content_display' => array( 'yes' ),'style' => array( 'style2' ) ),
			),
			array(
				'type'    => Controls_Manager::NUMBER,
				'id'      => 'count',
				'label'   => esc_html__( 'Word count', 'foodcart-core' ),
				'default' => 15,
				'description' => esc_html__( 'Maximum number of words', 'foodcart-core' ),
				'condition'   => array( 'content_display' => array( 'yes' ),'style' => array( 'style2' ) ),
			),
			array(
				'type'        => Controls_Manager::SWITCHER,
				'id'          => 'designation_display',
				'label'       => esc_html__( 'Designation Display', 'foodcart-core' ),
				'label_on'    => esc_html__( 'On', 'foodcart-core' ),
				'label_off'   => esc_html__( 'Off', 'foodcart-core' ),
				'default'     => 'yes',
				'description' => esc_html__( 'Show or Hide Designation. Default: On', 'foodcart-core' ),
			),
			array(
				'type'        => Controls_Manager::SWITCHER,
				'id'          => 'social_display',
				'label'       => esc_html__( 'Social Media Display', 'foodcart-core' ),
				'label_on'    => esc_html__( 'On', 'foodcart-core' ),
				'label_off'   => esc_html__( 'Off', 'foodcart-core' ),
				'default'     => true,
				'description' => esc_html__( 'Show or Hide Social Medias. Default: On', 'foodcart-core' ),
			),
			array(
				'type'    => Controls_Manager::SELECT2,
				'id'      => 'more_button',
				'label'   => esc_html__( 'More Button', 'foodcart-core' ),
				'options' => array(
					'show'        => esc_html__( 'Show Read More', 'foodcart-core' ),
					'hide'        => esc_html__( 'Show Pagination', 'foodcart-core' ),
				),
				'default' => 'show',				
			),
			array (
				'type'    => Controls_Manager::TEXT,
				'id'      => 'see_button_text',
				'label'   => esc_html__( 'Button Text', 'foodcart-core' ),
				'condition'   => array( 'more_button' => array( 'show' ) ),
				'default' => esc_html__( 'SHOW MORE', 'foodcart-core' ),
			),
			array (
				'type'    => Controls_Manager::TEXT,
				'id'      => 'see_button_link',
				'label'   => esc_html__( 'Button Link', 'foodcart-core' ),
				'condition'   => array( 'more_button' => array( 'show' ) ),
			),
			array(
				'mode' => 'section_end',
			),

			// Responsive Columns
			array(
				'mode'    => 'section_start',
				'id'      => 'sec_responsive',
				'label'   => esc_html__( 'Number of Responsive Columns', 'foodcart-core' ),
			),
			array(
				'type'    => Controls_Manager::SELECT2,
				'id'      => 'col_lg',
				'label'   => esc_html__( 'Desktops: > 1199px', 'foodcart-core' ),
				'options' => $this->rt_translate['cols'],
				'default' => '4',
			),
			array(
				'type'    => Controls_Manager::SELECT2,
				'id'      => 'col_md',
				'label'   => esc_html__( 'Desktops: > 991px', 'foodcart-core' ),
				'options' => $this->rt_translate['cols'],
				'default' => '4',
			),
			array(
				'type'    => Controls_Manager::SELECT2,
				'id'      => 'col_sm',
				'label'   => esc_html__( 'Tablets: > 767px', 'foodcart-core' ),
				'options' => $this->rt_translate['cols'],
				'default' => '6',
			),
			array(
				'type'    => Controls_Manager::SELECT2,
				'id'      => 'col_xs',
				'label'   => esc_html__( 'Phones: < 768px', 'foodcart-core' ),
				'options' => $this->rt_translate['cols'],
				'default' => '12',
			),
			array(
				'type'    => Controls_Manager::SELECT2,
				'id'      => 'col_mobile',
				'label'   => esc_html__( 'Small Phones: < 480px', 'foodcart-core' ),
				'options' => $this->rt_translate['cols'],
				'default' => '12',
			),
			array(
				'mode' => 'section_end',
			),
			/*Background options*/
			array(
			'mode'    => 'section_start',
			'id'      => 'sec_bacground1',
			'label'   => __( 'Background For the Element item', 'foodcart-core' ),
			),	
			array (
			'mode'    => 'group',
			'type'    => Group_Control_Background::get_type(),
			'name'      => 'section_item_background1',
			'label'   => __( 'Section Item Background', 'foodcart-core' ),
			'selector' => '{{WRAPPER}} .team-grid-default .rtin-content-wrap figure',
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
			$template = 'team-grid-2';
			break;
			default:
			$template = 'team-grid-1';
			break;
		}

		return $this->rt_template( $template, $data );
	}
}