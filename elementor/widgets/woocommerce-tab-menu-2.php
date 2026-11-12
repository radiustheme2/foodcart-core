<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */

namespace radiustheme\Foodcart_Core;
use Elementor\Controls_Manager;

if ( ! defined( 'ABSPATH' ) ) exit;

class Woocommerce_Tab_Menu_2 extends Custom_Widget_Base {

	public function __construct( $data = [], $args = null ){
		$this->rt_name = esc_html__( 'Woocommerce Menu Tab 2', 'foodcart-core' );
		$this->rt_base = 'rt-woo-menu-tab-2';
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
		
		$terms  = get_terms( array( 'taxonomy' => 'product_cat', 'fields' => 'id=>name' ) );
		$category_dropdown = array( '0' => __( 'All Categories', 'foodcart-core' ) );

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
				'label'   => esc_html__( 'Type', 'foodcart-core' ),
				'options' => array(
					'style1' => esc_html__( 'Set Menu Tab', 'foodcart-core' ),
					'style2' => esc_html__( 'Set Menu Slider', 'foodcart-core' ),
				),
				'default' => 'style1',
			),			
			/*category select( box Multi )*/
			array (
				'type'    => Controls_Manager::REPEATER,
				'id'      => 'category_list',
				'label'   => __( 'Add as many Categories as you want', 'builder-core' ),
				'fields'  => array(
					array(
						'type'    => Controls_Manager::SELECT2,
						'name'    => 'cat_multi_box',
						'label'   => __( 'Categories', 'foodcart-core' ),
						'options' => $category_dropdown,
						'multiple'=> false,
						'default' => '1',
					),
				),
			),
			array (
				'type'        => Controls_Manager::SWITCHER,
				'id'          => 'cat_display',
				'label'       => __( 'Category Name Display', 'foodcart-core' ),
				'label_on'    => __( 'Show', 'foodcart-core' ),
				'label_off'   => __( 'Hide', 'foodcart-core' ),
				'default'     => 'yes',
			),			
			/*Post layout*/
			array(
				'type'    => Controls_Manager::SELECT2,
				'id'      => 'item_layout',
				'label'   => __( 'Item Layout', 'foodcart-core' ),
				'options' => array(
					'grid'	=> __( 'Grid', 'foodcart-core' ),
					'list'	=> __( 'List', 'foodcart-core' ),
				),
				'default' => 'grid',
			),
			array(
				'type'    => Controls_Manager::SELECT2,
				'id'      => 'post_sorting',
				'label'   => esc_html__( 'Order By', 'foodcart-core' ),
				'options' => array(
					'date'        => esc_html__( 'Date (Recents comes first)', 'foodcart-core' ),
					'title'       => esc_html__( 'Title', 'foodcart-core' ),
					'menu_order'  => esc_html__( 'Custom Order (Available via Order field inside Page Attributes box)', 'foodcart-core' ),	
					'random' 		=> __( 'Random Post', 'foodcart-core' ),
				),
				'default' => 'date',
			),
			/*Post Order*/
			array(
				'type'    => Controls_Manager::SELECT2,
				'id'      => 'post_ordering',
				'label'   => __( 'Post Ordering', 'foodcart-core' ),
				'options' => array(
					'des'	=> __( 'Desecending', 'foodcart-core' ),
					'asc'	=> __( 'Ascending', 'foodcart-core' ),
				),
				'default' => 'asc',
			),
			array(
				'type'    => Controls_Manager::NUMBER,
				'id'      => 'itemnumber',
				'label'   => esc_html__( 'Item Number', 'foodcart-core' ),
				'default' => -1,
				'description' => esc_html__( 'Use -1 for showing all items', 'foodcart-core' ),
			),
			array (
				'type'        => Controls_Manager::SWITCHER,
				'id'          => 'showimage',
				'label'       => __( 'Display Image', 'foodcart-core' ),
				'label_on'    => __( 'Show', 'foodcart-core' ),
				'label_off'   => __( 'Hide', 'foodcart-core' ),
				'default'     => 'yes',
			),
			/*Post Title Length*/
			array(
				'type'    => Controls_Manager::NUMBER,
				'id'      => 'post_title_length',
				'label'   => __( 'Title Length - blank means no limit', 'foodcart-core' ),
				'default' => '6',
			),
			array(
				'type'    => Controls_Manager::NUMBER,
				'id'      => 'count',
				'label'   => __( 'Word count', 'foodcart-core' ),
				'default' => 10,
				'description' => __( 'Maximum number of words', 'foodcart-core' ),
			),
			array(
				'type'    => Controls_Manager::REPEATER,
				'id'      => 'posts_not_in',
				'label'   => __( 'Enter Post ID that will not display', 'foodcart-core' ),
				'fields'  => array(
					array(
						'type'    => Controls_Manager::NUMBER,
						'name'    => 'post_not_in',
						'label'   => __( 'Post ID', 'foodcart-core' ),
						'default' => '0',
					),
				),
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
				'mode' => 'section_end',
			),
		);
		return $fields;
	}

	protected function render() {
		
		$data = $this->get_settings();
		
		switch ( $data['style'] ) {
			case 'style2':
			$template = 'woocommerce-set-menu-slider';
			break;
			default:
			$template = 'woocommerce-set-menu';
			break;
		}

		return $this->rt_template( $template, $data );
		
	}
	
}