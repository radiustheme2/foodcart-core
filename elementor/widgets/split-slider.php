<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */

namespace radiustheme\Foodcart_Core;
use Elementor\Controls_Manager;

if ( ! defined( 'ABSPATH' ) ) exit;

class Split_Slider extends Custom_Widget_Base {

	public function __construct( $data = [], $args = null ){
		$this->rt_name = esc_html__( 'Split Slider', 'foodcart-core' );
		$this->rt_base = 'rt-split-slider';
		parent::__construct( $data, $args );
	}
		
	private function rt_load_scripts(){		
		wp_dequeue_script( 'foodcart-main');
		wp_enqueue_style( 'multiscroll' );
		wp_enqueue_script( 'multiscroll' );
		wp_enqueue_script( 'rt-extension' );
		wp_enqueue_script( 'multiscroll-ext' );
		
		wp_enqueue_script( 'rt-easings' );
		wp_enqueue_script( 'foodcart-main',  FOODCART_JS_URL . 'main.js', array( 'jquery' ) , FOODCART_VERSION, true );
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
				'label'   => __( 'Style', 'foodcart-core' ),
				'options' => array(
					'style1' => __( 'Split - Mutli tab', 'foodcart-core' ),
					'style2' => __( 'Split - Woocommerce', 'foodcart-core' ),
				),
				'default' => 'style1',
			),
			/*Split Slider( tab Multi )*/
			array(
				'type'    => Controls_Manager::REPEATER,
				'id'      => 'split_item_lists',
				'label'   => esc_html__( 'Add as many item as you want', 'foodcart-core' ),
				'fields'  => array(
					array(
						'type'    => Controls_Manager::TEXTAREA,
						'name'    => 'item_title',
						'label'   => esc_html__( 'Title', 'foodcart-core' ),
						'default' => esc_html__( 'Virtual MockUp', 'foodcart-core' ),
					),
					array(
						'type'    => Controls_Manager::TEXTAREA,
						'name'    => 'item_text',
						'label'   => esc_html__( 'Text', 'foodcart-core' ),
						'default' => esc_html__( 'Nimply dummy text of the printing and typesetting industr yorem Ipsum has been the industrys standard.', 'foodcart-core' ),					
					),
					array(
						'type'    => Controls_Manager::TEXTAREA,
						'name'    => 'multi_button_text',
						'label'   => esc_html__( 'Button Text', 'foodcart-core' ),
						'default' => esc_html__( 'View All Projects', 'foodcart-core' ),
					),
					array(
						'type'  => Controls_Manager::URL,
						'name'    => 'multi_button_url',
						'label' => esc_html__( 'Link (Optional)', 'foodcart-core' ),
						'placeholder' => 'https://your-link.com',
					),
					array(
						'type'    => Controls_Manager::MEDIA,
						'name'      => 'image',
						'label'   => esc_html__( 'Image', 'foodcart-core' ),
						'description' => esc_html__( 'Recommended image size is 1000px X 1300px', 'foodcart-core' ),
					),
				),				
				'condition'   => array( 'style' => array( 'style1' ) ),
			),
			/*Split Slider - Woocommrece*/
			/*category select( box Multi )*/
			array (
				'type'    => Controls_Manager::REPEATER,
				'id'      => 'category_list',
				'label'   => esc_html__( 'Add as many Categories as you want', 'builder-core' ),
				'fields'  => array(
					array(
						'type'    => Controls_Manager::SELECT2,
						'name'    => 'cat_multi_box',
						'label'   => esc_html__( 'Categories', 'foodcart-core' ),
						'options' => $category_dropdown,
						'multiple'=> false,
						'default' => '1',
					),					
					array(
						'type'    => Controls_Manager::MEDIA,
						'name'      => 'woo_cat_image',
						'label'   => esc_html__( 'Tab Image', 'foodcart-core' ),
						'description' => esc_html__( 'Recommended image size is 1000px X 1300px', 'foodcart-core' ),
					),
				),
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
					'random' 		=> esc_html__( 'Random Post', 'foodcart-core' ),
				),
				'default' => 'date',
				'condition'   => array( 'style' => array( 'style2' ) ),
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
				'condition'   => array( 'style' => array( 'style2' ) ),
			),
			array(
				'type'    => Controls_Manager::NUMBER,
				'id'      => 'itemnumber',
				'label'   => esc_html__( 'Item Number', 'foodcart-core' ),
				'default' => -1,
				'description' => esc_html__( 'Use -1 for showing all items', 'foodcart-core' ),
				'condition'   => array( 'style' => array( 'style2' ) ),
			),
			array (
				'type'        => Controls_Manager::SWITCHER,
				'id'          => 'showimage',
				'label'       => esc_html__( 'Display Image', 'foodcart-core' ),
				'label_on'    => esc_html__( 'Show', 'foodcart-core' ),
				'label_off'   => esc_html__( 'Hide', 'foodcart-core' ),
				'default'     => 'yes',
				'condition'   => array( 'style' => array( 'style2' ) ),
			),
			/*Post Title Length*/
			array(
				'type'    => Controls_Manager::NUMBER,
				'id'      => 'post_title_length',
				'label'   => esc_html__( 'Title Length - blank means no limit', 'foodcart-core' ),
				'default' => 6,
				'condition'   => array( 'style' => array( 'style2' ) ),
			),
			array(
				'type'    => Controls_Manager::NUMBER,
				'id'      => 'post_excerpt_length',
				'label'   => esc_html__( 'Word count', 'foodcart-core' ),
				'default' => 10,
				'description' => esc_html__( 'Maximum number of words', 'foodcart-core' ),
				'condition'   => array( 'style' => array( 'style2' ) ),
			),
			array(
				'type'    => Controls_Manager::NUMBER,
				'id'      => 'number_of_post_offset',
				'label'   => esc_html__( 'Number of Post Offset', 'foodcart-core' ),
				'default' => 10,
				'description' => esc_html__( 'Number of Post you want to exclude from showing', 'foodcart-core' ),
				'condition'   => array( 'style' => array( 'style2' ) ),
			),
			array(
				'type'    => Controls_Manager::REPEATER,
				'id'      => 'posts_not_in',
				'label'   => esc_html__( 'Enter Post ID that will not display', 'foodcart-core' ),
				'fields'  => array(
					array(
						'type'    => Controls_Manager::NUMBER,
						'name'    => 'post_not_in',
						'label'   => esc_html__( 'Post ID', 'foodcart-core' ),
						'default' => '0',
					),
				),
				'condition'   => array( 'style' => array( 'style2' ) ),
			),
			
			/*category display on small ittem option - switch*/
			array(
				'type'        => Controls_Manager::SWITCHER,
				'id'          => 'multi_footer_info',
				'label'       => esc_html__( 'Multi Footer Info', 'barta-core' ),
				'label_on'    => esc_html__( 'On', 'barta-core' ),
				'label_off'   => esc_html__( 'Off', 'barta-core' ),
				'default'     => 'yes',
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
			$template = 'woocommerce-split-slider';
			break;
			default:
			$template = 'split-slider';
			break;
		}

		return $this->rt_template( $template, $data );
	}
}