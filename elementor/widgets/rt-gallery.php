<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */

namespace radiustheme\Foodcart_Core;
use Elementor\Controls_Manager;

if ( ! defined( 'ABSPATH' ) ) exit;

class RT_Gallery extends Custom_Widget_Base {

	public function __construct( $data = [], $args = null ){
		$this->rt_name = esc_html__( 'Foodcart Gallery', 'foodcart-core' );
		$this->rt_base = 'rt-foodcart-gallery';
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

	
	private function rt_load_scripts(){
		wp_enqueue_style(  'magnific-popup' );
		wp_enqueue_script( 'magnific-popup' );
		wp_enqueue_script( 'isotope-pkgd' );
	}
	
	public function rt_fields(){
		
		$terms  = get_terms( array( 'taxonomy' => 'foodcart_gallery_category', 'fields' => 'id=>name' ) );
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
				'label'     => __( 'Categories', 'foodcart-core' ),
				'options'   => $category_dropdown,
				'default'   => '0',
				'multiple'  => false,
				'condition'   => array( 'style' => array( 'style1' ) ),
			),
			array (
				'type'        => Controls_Manager::SWITCHER,
				'id'          => 'cat_display',
				'label'       => __( 'Category Name Display', 'foodcart-core' ),
				'label_on'    => __( 'Show', 'foodcart-core' ),
				'label_off'   => __( 'Hide', 'foodcart-core' ),
				'default'     => 'yes',
			),
			array (
				'type'        => Controls_Manager::SWITCHER,
				'id'          => 'cat_tab_display',
				'label'       => __( 'Category Tab Display', 'foodcart-core' ),
				'label_on'    => __( 'Show', 'foodcart-core' ),
				'label_off'   => __( 'Hide', 'foodcart-core' ),
				'default'     => 'yes',
				'condition'   => array( 'style' => array( 'style2' ) ),
			),
			array(
				'type'    => Controls_Manager::SELECT2,
				'id'      => 'all_button',
				'label'   => esc_html__( 'Show All Button', 'foodcart-core' ),
				'options' => array(
					'show'        => esc_html__( 'Show', 'foodcart-core' ),
					'hide'        => esc_html__( 'Hide', 'foodcart-core' ),
				),
				'default' => 'show',
				'condition'   => array( 'style' => array( 'style2' ) ),
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
			/*Post Title Length*/
			array(
				'type'    => Controls_Manager::NUMBER,
				'id'      => 'post_title_length',
				'label'   => __( 'Post Title Length', 'barta-core' ),
				'default' => '6',
			),			
			array (
				'type'        => Controls_Manager::SWITCHER,
				'id'          => 'content_display',
				'label'       => __( 'Content Display', 'foodcart-core' ),
				'label_on'    => __( 'Show', 'foodcart-core' ),
				'label_off'   => __( 'Hide', 'foodcart-core' ),
				'default'     => 'no',
			),
			array(
				'type'    => Controls_Manager::NUMBER,
				'id'      => 'count',
				'label'   => __( 'Word count', 'foodcart-core' ),
				'default' => 10,
				'description' => __( 'Maximum number of words', 'foodcart-core' ),
				'condition'   => array( 'content_display' => array( 'yes' )),
			),
			array (
				'type'        => Controls_Manager::SWITCHER,
				'id'          => 'button_display',
				'label'       => __( 'Button Display', 'foodcart-core' ),
				'label_on'    => __( 'Show', 'foodcart-core' ),
				'label_off'   => __( 'Hide', 'foodcart-core' ),
				'default'     => 'yes',
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
				'condition'   => array( 'button_display' => array( 'yes' ) ),
			),
			array (
				'type'    => Controls_Manager::TEXT,
				'id'      => 'see_button_text',
				'label'   => esc_html__( 'Button Text', 'foodcart-core' ),
				'condition'   => array( 'more_button' => array( 'show' ), 'button_display' => array( 'yes' ) ),
				'default' => esc_html__( 'SHOW MORE', 'foodcart-core' ),
			),
			array (
				'type'    => Controls_Manager::TEXT,
				'id'      => 'see_button_link',
				'label'   => esc_html__( 'Button Link', 'foodcart-core' ),
				'condition'   => array( 'more_button' => array( 'show' ), 'button_display' => array( 'yes' ) ),
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

			$this->rt_load_scripts();			
			
			switch ( $data['style'] ) {
				case 'style2':
				$template = 'gallery-2';
				break;
				default:
				$template = 'gallery-1';
				break;
			}

		return $this->rt_template( $template, $data );
	}
}