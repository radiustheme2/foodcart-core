<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */

namespace radiustheme\Foodcart_Core;
use Elementor\Controls_Manager;

if ( ! defined( 'ABSPATH' ) ) exit;

class Recipe_Grid extends Custom_Widget_Base {

	public function __construct( $data = [], $args = null ){
		$this->rt_name = esc_html__( 'Recipe Grid', 'foodcart-core' );
		$this->rt_base = 'rt-recipe-grid';
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
		
		$terms  = get_terms( array( 'taxonomy' => 'foodcart_recipe_category', 'fields' => 'id=>name' ) );
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
				'label'   => esc_html__( 'Style', 'foodcart-core' ),
				'options' => array(
					'style1' => esc_html__( 'Style 1', 'foodcart-core' ),
					'style2' => esc_html__( 'Style 2', 'foodcart-core' ),
				),
				'default' => 'style1',
			),
			/*category select - */
			array (
				'type'      => Controls_Manager::SELECT2,
				'id'        => 'cat_single',
				'label'     => esc_html__( 'Categories', 'foodcart-core' ),
				'options'   => $category_dropdown,
				'default'   => '0',
				'multiple'  => false,
			),
			/*Post Order*/
			array(
				'type'    => Controls_Manager::SELECT2,
				'id'      => 'post_ordering',
				'label'   => esc_html__( 'Post Ordering', 'foodcart-core' ),
				'options' => array(
					'des'	=> esc_html__( 'Desecending', 'foodcart-core' ),
					'asc'	=> esc_html__( 'Ascending', 'foodcart-core' ),
				),
				'default' => 'asc',
			),
			/*Post Sorting*/
			array(
				'type'    => Controls_Manager::SELECT2,
				'id'      => 'post_sorting',
				'label'   => esc_html__( 'Post Sorting', 'foodcart-core' ),
				'options' => array(
					'recent' 		=> esc_html__( 'Recent Post', 'foodcart-core' ),
					'rand' 			=> esc_html__( 'Random Post', 'foodcart-core' ),
					'modified' 		=> esc_html__( 'Last Modified Post', 'foodcart-core' ),
					'comment_count' => esc_html__( 'Most commented Post', 'foodcart-core' ),
					'view' 			=> esc_html__( 'Most viewed Post', 'foodcart-core' ),
				),
				'default' => 'recent',
			),
			array(
				'type'    => Controls_Manager::NUMBER,
				'id'      => 'itemnumber',
				'label'   => esc_html__( 'Item Number', 'foodcart-core' ),
				'default' => -1,
				'description' => esc_html__( 'Use -1 for showing all items', 'foodcart-core' ),
			),
			/*Post Title Length*/
			array(
				'type'    => Controls_Manager::NUMBER,
				'id'      => 'post_title_length',
				'label'   => esc_html__( 'Title Length - blank means no limit', 'barta-core' ),
				'default' => '6',
			),
			array(
				'type'    => Controls_Manager::NUMBER,
				'id'      => 'count',
				'label'   => esc_html__( 'Word count', 'foodcart-core' ),
				'default' => 10,
				'description' => esc_html__( 'Maximum number of words', 'foodcart-core' ),
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
			$template = 'recipe-grid-2';
			break;
			default:
			$template = 'recipe-grid-1';
			break;
		}

		return $this->rt_template( $template, $data );
	}
}