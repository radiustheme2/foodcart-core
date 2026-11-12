<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */

add_action( 'widgets_init', 'foodcart_widgets_init' );
function foodcart_widgets_init() {

	// Register Custom Widgets
	register_widget( 'FoodcartTheme_Address_Widget' );
	register_widget( 'FoodcartTheme_Social_Widget' );
	register_widget( 'FoodcartTheme_Recent_Posts_With_Image_Widget' );
	register_widget( 'FoodcartTheme_News_Box' );
	register_widget( 'FoodcartTheme_News_Tab' );
	register_widget( 'FoodcartTheme_Open_Hour_Widget' );
}