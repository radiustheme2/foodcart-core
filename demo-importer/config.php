<?php
/**
 * Theme Demo Configuration File
 *
 * This file contains the configuration for the demo importer.
 *
 * @package @package Radiustheme\CL_Classified_Core
 */

// Do not allow directly accessing this file.
if ( ! defined( 'ABSPATH' ) ) {
	exit( 'This script cannot be accessed directly.' );
}

return [
	// Basic theme information.
	'blog_slug'            => 'blog',
	'demo_url'             => 'https://www.radiustheme.com/demo/wordpress/themes/foodcart/',
	'menus'                => [ 'primary' => 'Main Menu' ],
	'commenter_email'      => 'dev-email@wpengine.local',

	// File paths.
	'demo_content_zip'     => 'demo-files/demo-content.zip',

	// Demo variants.
	'demo_variants'   => [
		'home-one'    => [
			'name'    => 'Home',
			'preview' => 'screenshots/home-one.webp',
			'url'     => '',
		],
		'home-two'    => [
			'name'    => 'Home 2',
			'preview' => 'screenshots/home-two.webp',
			'url'     => 'home-2/',
		],
		'home-three'    => [
			'name'    => 'Home 3',
			'preview' => 'screenshots/home-three.webp',
			'url'     => 'home-3/',
		],
		'home-four'    => [
			'name'    => 'Home 4',
			'preview' => 'screenshots/home-four.webp',
			'url'     => 'home-4/',
		],
		'home-five'    => [
			'name'    => 'Home 5',
			'preview' => 'screenshots/home-five.webp',
			'url'     => 'home-5/',
		],
	],

	// WordPress repository plugins.
	'wp_plugins'           => [
		'elementor'                   => 'Elementor Page Builder',
		'redux-framework'             => 'Redux Framework',
		'tlp-food-menu'               => 'Food Menu',
		'woocommerce'                 => 'WooCommerce',
		'contact-form-7' => [
			'name' => 'Contact Form 7',
			'file' => 'contact-form-7/wp-contact-form-7.php',
		],
		'yith-woocommerce-wishlist' => [
			'name' => 'YITH WooCommerce Wishlist',
			'file' => 'yith-woocommerce-wishlist/init.php',
		],
		'yith-woocommerce-compare' => [
			'name' => 'YITH WooCommerce Compare',
			'file' => 'yith-woocommerce-compare/init.php',
		],
		'yith-woocommerce-quick-view' => [
			'name' => 'YITH WooCommerce Quick View',
			'file' => 'yith-woocommerce-quick-view/init.php',
		],
	],

	'settings_json'       => [
		'tpl_food_menu_settings',
	],

	// Enable/disable import features.
	'features'            => [
		'woo_support'     => true,
		'elementor_fixes' => true,
	],

	// Elementor data fixes.
	'elementor_fixes'     => [
		'rt-split-slider'       => [ 'repeater_category_list' => 'cat_multi_box' ],
	],

	// Bundled/Premium plugins.
	'bundled_plugins'      => [
		'foodcart-core' => [
			'name' => 'Foodcart Core',
			'file' => 'inc/plugins/foodcart-core.zip',
		],
		'rt-framework' => [
			'name' => 'RT Framework',
			'file' => 'inc/plugins/rt-framework.zip',
		],
		'food-menu-pro' => [
			'name' => 'Food Menu Pro',
			'file' => 'inc/plugins/food-menu-pro.zip',
		],
	],

	// Pre-import options.
	'pre_import_options'   => [
		'elementor_experiment-e_font_icon_svg'    => 'inactive',
		'elementor_experiment-e_optimized_markup' => 'inactive',
		'tpl_food_menu_settings' => [
			'fmp_food_reservation_status' => 'on',
		],
	],

	// Post-import options.
	'post_import_options'  => [
		'elementor_allow_unfiltered_files' => true,
		'elementor_unfiltered_files_upload' => true,
		'posts_per_page'                   => 6,
	],
	'max_execution_time' => '1200',
	'max_input_time' => '600',
	'memory_limit' => '256M',
];
