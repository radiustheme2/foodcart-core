<?php
/*
Plugin Name: Foodcart Core
Plugin URI: https://www.radiustheme.com
Description: Foodcart Core Plugin for Foodcart Theme
Version: 2.3
Author: RadiusTheme
Author URI: https://www.radiustheme.com
*/

if ( ! defined( 'ABSPATH' ) ) exit;

if ( ! defined( 'FOODCART_CORE' ) ) {
	define( 'FOODCART_CORE',                   ( WP_DEBUG ) ? time() : '2.2' );
	define( 'FOODCART_CORE_THEME_PREFIX',      'foodcart' );
	define( 'FOODCART_CORE_THEME_PREFIX_VAR',  'foodcart' );
	define( 'FOODCART_CORE_CPT_PREFIX',        'foodcart' );

	// Plugin paths
	define( 'FOODCART_CORE_BASE_DIR',          plugin_dir_path( __FILE__ ) );
	define( 'FOODCART_CORE_BASE_URL',          plugin_dir_url( __FILE__ ) );
}



class Foodcart_Core {

	public $plugin  = 'foodcart-core';
	public $action  = 'foodcart_theme_init';

	public function __construct() {
		$prefix = FOODCART_CORE_THEME_PREFIX_VAR;
		
		add_action( 'plugins_loaded', array( $this, 'demo_importer' ), 15 );
		add_action( 'init', array( $this, 'load_textdomain' ), 16 );
		add_action( 'after_setup_theme', array( $this, 'post_meta' ), 15 );
		add_action( 'after_setup_theme', array( $this, 'elementor_widgets' ) );
		add_shortcode('foodcart-portfolio-single-gallery', array( $this, 'foodcart_portfolio_single_gallery' ) );
		add_shortcode( 'foodcart_product_price', array( $this, 'foodcart_woo_product_price_shortcode' ) );
		
		// Redux Flash permalink after options changed
		add_action( "redux/options/{$prefix}/saved", array( $this, 'flush_redux_saved' ), 10, 2 );
		add_action( "redux/options/{$prefix}/section/reset", array( $this, 'flush_redux_reset' ) );
		add_action( "redux/options/{$prefix}/reset", array( $this, 'flush_redux_reset' ) );
		add_action( 'init', array( $this, 'rewrite_flush_check' ) );
		add_action( 'redux/loaded', array( $this, 'foodcart_remove_demo') );
		
		require_once 'module/rt-post-share.php';
		require_once 'module/rt-post-views.php';
		
		// Widgets
		require_once 'widget/widget-settings.php';
		require_once 'widget/rt-widget-fields.php';
		require_once 'widget/rt-recent-post-widget.php';
		require_once 'widget/rt-news-box.php';
		require_once 'widget/rt-news-tab.php';
		require_once 'widget/rt-open-hour-widget.php';
		require_once 'widget/address-widget.php';
		require_once 'widget/social-widget.php';
		require_once 'widget/search-widget.php'; // override default
		
	}

	/**
	 * Removes the demo link and the notice of integrated demo from the redux-framework plugin
	*/

	public function foodcart_remove_demo() {
		// Used to hide the demo mode link from the plugin page. Only used when Redux is a plugin.
		if ( class_exists( 'ReduxFrameworkPlugin' ) ) {
			remove_filter( 'plugin_row_meta', array(
				ReduxFrameworkPlugin::instance(),
				'plugin_metalinks'
				), null, 2 );

			// Used to hide the activation notice informing users of the demo panel. Only used when Redux is a plugin.
			remove_action( 'admin_notices', array( ReduxFrameworkPlugin::instance(), 'admin_notices' ) );
		}
	}

	public function demo_importer() {
		//require_once 'demo-importer.php';
        require_once 'demo-importer/init.php';
	}

	public function load_textdomain() {
		load_plugin_textdomain( $this->plugin , false, dirname( plugin_basename( __FILE__ ) ) . '/languages' ); 
	}
	public function post_meta(){
		if ( !did_action( $this->action ) || ! defined( 'RT_FRAMEWORK_VERSION' ) ) {
			return;
		}
		require_once 'post-types.php';
		require_once 'post-meta.php';
	}
	public function elementor_widgets(){ 
		if ( did_action( $this->action ) && did_action( 'elementor/loaded' ) ) { 
			
			require_once 'elementor/init.php';
		}
	}
	public function get_base_url(){
		
		$file = dirname( dirname(__FILE__) );

		// Get correct URL and path to wp-content
		$content_url = untrailingslashit( dirname( dirname( get_stylesheet_directory_uri() ) ) );
		$content_dir = untrailingslashit( WP_CONTENT_DIR );

		// Fix path on Windows
		$file = wp_normalize_path( $file );
		$content_dir = wp_normalize_path( $content_dir );

		$url = str_replace( $content_dir, $content_url, $file );

		return $url;
			
	}
		
	// Flush rewrites
	public function flush_redux_saved( $saved_options, $changed_options ){
		if ( empty( $changed_options ) ) {
			return;
		}
		$prefix = FOODCART_CORE_THEME_PREFIX_VAR;
		$flush  = false;

		if ( $flush ) {
			update_option( "{$prefix}_rewrite_flash", true );
		}
	}

	public function flush_redux_reset(){
		$prefix = FOODCART_CORE_THEME_PREFIX_VAR;
		update_option( "{$prefix}_rewrite_flash", true );
	}

	public function rewrite_flush_check() {
		$prefix = FOODCART_CORE_THEME_PREFIX_VAR;
		if ( get_option( "{$prefix}_rewrite_flash" ) == true ) {
			flush_rewrite_rules();
			update_option( "{$prefix}_rewrite_flash", false );
		}
	}
	
	
	/*Portfolio Single Shortcode*/
	public function foodcart_portfolio_single_gallery() {
		
		ob_start();	
		$foodcart_port_gallerys_raw  	= get_post_meta( get_the_ID(), 'foodcart_port_gallery', true );
		$foodcart_port_gallerys = explode( "," , $foodcart_port_gallerys_raw );
			if ( !empty( $foodcart_port_gallerys ) ) { ?>
			<div class="shortcode-slider single-portfolio-slider">
				<div class="swiper-container" data-autoplay="true" data-loop="true" data-autoplay-timeout="1000" data-space-between="10" 
						data-slides-per-view="2" data-centered-slides="false" data-r-x-small="1" data-r-small="1" data-r-medium="2" data-r-large="2" 
						data-r-x-large="2">
					<div class="swiper-wrapper">
					<?php foreach( $foodcart_port_gallerys as $foodcart_port_gallery ) { ?>
					<div class="swiper-slide">
						<?php echo wp_get_attachment_image( $foodcart_port_gallery, 'foodcart-size2', "", array( "class" => "img-responsive" ) ); ?>
					</div>
					<?php } ?>
					</div>
					<div class="swiper-button">
						<div class="swiper-button-prev"><i class="fa fa-arrow-left"></i></div>
						<div class="swiper-button-next"><i class="fa fa-arrow-right"></i></div>
					</div>
				</div>
			</div>
		<?php }  
		return ob_get_clean();
	}
	//pricing Html
	public function foodcart_woo_product_price_shortcode( $atts ) {
		$atts = shortcode_atts( array(
			'id' => null
		), $atts, 'foodcart_product_price' );
	 
		if ( empty( $atts[ 'id' ] ) ) {
			return '';
		}
	 
		$product = wc_get_product( $atts['id'] );
	 
		if ( ! $product ) {
			return '';
		}
	 
		return $product->get_price_html();
	}
}

new Foodcart_Core;