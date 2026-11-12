<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */

namespace radiustheme\Foodcart_Core;
use \RT_Posts;
use FoodcartTheme;


if ( !class_exists( 'RT_Posts' ) ) {
	return;
}
add_action('init', function (){
	$post_types = array(
		'foodcart_team'       => array(
			'title'           => __( 'Team Member', 'foodcart-core' ),
			'plural_title'    => __( 'Team Members', 'foodcart-core' ),
			'menu_icon'       => 'dashicons-businessman',
			'labels_override' => array(
				'menu_name'   => __( 'Team', 'foodcart-core' ),
			),
			'rewrite'         => isset(FoodcartTheme::$options['team_slug']) ? FoodcartTheme::$options['team_slug'] : 'team',
			'supports'        => array( 'title', 'thumbnail', 'editor', 'excerpt', 'page-attributes' )
		),
		'foodcart_recipe'  => array(
			'title'           => __( 'Recipe', 'foodcart-core' ),
			'plural_title'    => __( 'Recipe', 'foodcart-core' ),
			'menu_icon'       => 'dashicons-book',
			'rewrite'         => isset(FoodcartTheme::$options['recipe_slug']) ? FoodcartTheme::$options['recipe_slug'] : 'recipe',
			'supports'        => array( 'title', 'thumbnail', 'editor', 'excerpt', 'page-attributes' ),
			'taxonomies' 	  => array( 'post_tag' ),
		),
		'foodcart_gallery'  => array(
			'title'           => __( 'Gallery', 'foodcart-core' ),
			'plural_title'    => __( 'Gallery', 'foodcart-core' ),
			'menu_icon'       => 'dashicons-book',
			'rewrite'         => isset(FoodcartTheme::$options['gallery_slug']) ? FoodcartTheme::$options['gallery_slug'] : 'gallery',
			'supports'        => array( 'title', 'thumbnail', 'editor', 'excerpt', 'page-attributes' ),
		),
		'foodcart_testim'     => array(
			'title'           => __( 'Testimonial', 'foodcart-core' ),
			'plural_title'    => __( 'Testimonials', 'foodcart-core' ),
			'menu_icon'       => 'dashicons-awards',
			'rewrite'         => isset(FoodcartTheme::$options['testimonial_slug']) ? FoodcartTheme::$options['testimonial_slug'] : 'testimonial',
			'supports'        => array( 'title', 'thumbnail', 'editor', 'page-attributes' )
		),
	);

	$taxonomies = array(
		'foodcart_team_category' => array(
			'title'        => __( 'Team Category', 'foodcart-core' ),
			'plural_title' => __( 'Team Categories', 'foodcart-core' ),
			'post_types'   => 'foodcart_team',
		),
		'foodcart_recipe_category' => array(
			'title'        => __( 'Recipe Category', 'foodcart-core' ),
			'plural_title' => __( 'Recipe Categories', 'foodcart-core' ),
			'post_types'   => 'foodcart_recipe',
		),
		'foodcart_gallery_category' => array(
			'title'        => __( 'Gallery Category', 'foodcart-core' ),
			'plural_title' => __( 'Gallery Categories', 'foodcart-core' ),
			'post_types'   => 'foodcart_gallery',
		),
		'foodcart_testimonial_category' => array(
			'title'        => __( 'Testimonial Category', 'foodcart-core' ),
			'plural_title' => __( 'Testimonial Categories', 'foodcart-core' ),
			'post_types'   => 'foodcart_testim',
		),
	);

	$Posts = RT_Posts::getInstance();
	$Posts->add_post_types( $post_types );
	$Posts->add_taxonomies( $taxonomies );
}, 10);
