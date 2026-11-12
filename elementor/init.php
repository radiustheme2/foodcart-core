<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */

namespace radiustheme\Foodcart_Core;

use Elementor\Plugin;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Custom_Widget_Init {

	public function __construct() {
		add_action( 'elementor/widgets/widgets_registered', array( $this, 'init' ) );
		add_action( 'elementor/elements/categories_registered', array( $this, 'widget_categoty' ) );
		
		/*ajax actions*/
		add_action('wp_ajax_foodcart_selected_cat', array( $this, 'selected_cat_func' ) );
		add_action('wp_ajax_nopriv_foodcart_selected_cat', array( $this, 'selected_cat_func' ));
		
	}

	public function init() {
		require_once __DIR__ . '/base.php';
		
		// Widgets -- filename=>classname /@dev 
		$widgets1 = array(
			'title'           		=> 'Title',
			'rt-divider'           	=> 'Rt_Divider',
			'text-with-button'      => 'Text_With_Button',
			'about-image-text'      => 'About_Image_Text',
			'info-box'        		=> 'Info_Box',
			'book-table'        	=> 'Book_Table',
			'post-grid'       		=> 'Post_Grid',
			'nav-menu'        		=> 'Nav_Menu',
			'cta'             		=> 'CTA',
			'faq'            		=> 'RT_Faq',
			'contact-info'         	=> 'Contact_Info',
			'contact-address'       => 'Contact_Address',
			'contact-box'           => 'Contact_Box',
			'progress-circle'       => 'Progress_Circle',
			'progress-bar'          => 'Progress_Bar',
			'counter'               => 'Counter',
			'slider'         		=> 'Slider',
			'split-slider'         	=> 'Split_Slider',
			'team-grid'         	=> 'Team_Grid',
			'team-slider'         	=> 'Team_Slider',
			'logo-slider'         	=> 'Logo_Slider',
			'testimonial'         	=> 'Testimonial',
			'recipe-grid'           => 'Recipe_Grid',
			'offer-box'             => 'Offer_Box',
			'rt-gallery'            => 'RT_Gallery',
			'video'         	    => 'Video',
			'upmenu'         	    => 'Upmenu',
		);
		
		$widgets2 = array();
		if ( class_exists( 'WooCommerce' ) ) {
			$widgets2 = array(
				'woocommerce-set-menu' => 'Woocommerce_Set_Menu',
				'woocommerce-tab-menu-2' => 'Woocommerce_Tab_Menu_2',
				'woocommerce-vertical-slider' => 'Woocommerce_Vertical_Slider',
			);
		}

		$widgets = array_merge( $widgets1, $widgets2 );
		
		foreach ( $widgets as $widget => $class ) {
			$template_name = "/elementor-custom/widgets/{$widget}.php";
			if ( file_exists( STYLESHEETPATH . $template_name ) ) {
				$file = STYLESHEETPATH . $template_name;
			}
			elseif ( file_exists( TEMPLATEPATH . $template_name ) ) {
				$file = TEMPLATEPATH . $template_name;
			}
			else {
				$file = __DIR__ . '/widgets/' . $widget. '.php';
			}

			require_once $file;
			
			$classname = __NAMESPACE__ . '\\' . $class;
			Plugin::instance()->widgets_manager->register_widget_type( new $classname );
		}
	}

	public function widget_categoty( $class ) {
		$id         = FOODCART_CORE_THEME_PREFIX . '-widgets'; // Category /@dev
		$properties = array(
			'title' => __( 'RadiusTheme Elements', 'foodcart-core' ),
		);

		Plugin::$instance->elements_manager->add_category( $id, $properties );
	}	

	public function selected_cat_func() {
		
		$data = $_POST['data'];
		$catID = $_POST['catID'];
		$remaining = false;
		$html = $cat_link = null;
		if($catID){
			$cat_link = get_category_link( $catID );
			$template = $_POST['template'];
			
			//var_dump($data);		
			$post_sorting = $data['post_sorting'];
			$post_ordering = $data['post_ordering'];
			$number_of_post = $data['number_of_post'];
			
			$args = array(
				'cat' => $catID,
				'post_status' => 'publish',
				'orderby' => $post_sorting,
				'order' => $post_ordering,
				'posts_per_page' => $number_of_post,
			);
			
			$query = new \WP_Query( $args );
			if(!empty($query->max_num_pages) && $query->max_num_pages > 1){
				$remaining = true;
			}
			
			ob_start(); 
			if ( $template == 'rt-news-tab-1' ) {
				include( 'query/query-rt-tab-1.php' );
			} else if ( $template == 'rt-news-tab-2' ) {
				include( 'query/query-rt-tab-2.php' );
			} else if ($template == 'rt-news-tab-3') {
				include( 'query/query-rt-tab-3.php' );
			} else if ($template == 'rt-news-tab-4') {
				include( 'query/query-rt-tab-4.php' );
			} else if ($template == 'rt-news-tab-5') {
				include( 'query/query-rt-tab-5.php' );
			} else if ($template == 'rt-news-tab-6') {
				include( 'query/query-rt-tab-6.php' );
			}
			$html = ob_get_clean();
		}
			   
		wp_send_json( compact('html', 'remaining', 'cat_link'));
	}

}

new Custom_Widget_Init();