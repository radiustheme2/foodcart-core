<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */

namespace radiustheme\Foodcart_Core;

use FoodcartTheme;
use FoodcartTheme_Helper;
use \RT_Postmeta;


if ( ! defined( 'ABSPATH' ) ) exit;

if ( !class_exists( 'RT_Postmeta' ) ) {
	return;
}

$Postmeta = RT_Postmeta::getInstance();

$prefix = FOODCART_CORE_CPT_PREFIX;

/*-------------------------------------
#. Layout Settings
---------------------------------------*/
$nav_menus = wp_get_nav_menus( array( 'fields' => 'id=>name' ) );
$nav_menus = array( 'default' => __( 'Default', 'foodcart-core' ) ) + $nav_menus;
$sidebars  = array( 'default' => __( 'Default', 'foodcart-core' ) ) + FoodcartTheme_Helper::custom_sidebar_fields();

$Postmeta->add_meta_box( "{$prefix}_page_settings", __( 'Layout Settings', 'foodcart-core' ), array( 'page', 'post', 'foodcart_team', 'foodcart_recipe', 'foodcart_testim' ), '', '', 'high', array(
	'fields' => array(
		"{$prefix}_layout" => array(
			'label'   => __( 'Layout', 'foodcart-core' ),
			'type'    => 'select',
			'options' => array(
				'default'       => __( 'Default', 'foodcart-core' ),
				'full-width'    => __( 'Full Width', 'foodcart-core' ),
				'left-sidebar'  => __( 'Left Sidebar', 'foodcart-core' ),
				'right-sidebar' => __( 'Right Sidebar', 'foodcart-core' ),
			),
			'default'  => 'default',
		),
		'foodcart_sidebar' => array(
			'label'    => __( 'Custom Sidebar', 'foodcart-core' ),
			'type'     => 'select',
			'options'  => $sidebars,
			'default'  => 'default',
		),
		"{$prefix}_page_menu" => array(
			'label'    => __( 'Main Menu', 'foodcart-core' ),
			'type'     => 'select',
			'options'  => $nav_menus,
			'default'  => 'default',
		),
		"{$prefix}_tr_header" => array(
			'label'    	  => __( 'Transparent Header', 'foodcart-core' ),
			'type'     	  => 'select',
			'options'  	  => array(
				'default' => __( 'Default', 'foodcart-core' ),
				'on'      => __( 'Enabled', 'foodcart-core' ),
				'off'     => __( 'Disabled', 'foodcart-core' ),
			),
			'default'  => 'default',
		),
		"{$prefix}_top_bar" => array(
			'label' 	  => __( 'Top Bar', 'foodcart-core' ),
			'type'  	  => 'select',
			'options' => array(
				'default' => __( 'Default', 'foodcart-core' ),
				'on'      => __( 'Enabled', 'foodcart-core' ),
				'off'     => __( 'Disabled', 'foodcart-core' ),
			),
			'default'  	  => 'default',
		),
		"{$prefix}_top_bar_style" => array(
			'label' 	=> __( 'Top Bar Layout', 'foodcart-core' ),
			'type'  	=> 'select',
			'options'	=> array(
				'default' => __( 'Default', 'foodcart-core' ),
				'1'       => __( 'Layout 1', 'foodcart-core' ),
				'2'       => __( 'Layout 2', 'foodcart-core' ),
				'3'       => __( 'Layout 3', 'foodcart-core' ),
			),
			'default'   => 'default',
		),
		"{$prefix}_header_opt" => array(
			'label' 	  => __( 'Header On/Off', 'foodcart-core' ),
			'type'  	  => 'select',
			'options' => array(
				'default' => __( 'Default', 'foodcart-core' ),
				'on'      => __( 'Enabled', 'foodcart-core' ),
				'off'     => __( 'Disabled', 'foodcart-core' ),
			),
			'default'  	  => 'default',
		),
		"{$prefix}_header" => array(
			'label'   => __( 'Header Layout', 'foodcart-core' ),
			'type'    => 'select',
			'options' => array(
				'default' => __( 'Default', 'foodcart-core' ),
				'1'       => __( 'Layout 1', 'foodcart-core' ),
				'2'       => __( 'Layout 2', 'foodcart-core' ),
				'3'       => __( 'Layout 3', 'foodcart-core' ),
				'4'       => __( 'Layout 4', 'foodcart-core' ),
				'5'       => __( 'Layout 5', 'foodcart-core' ),
			),
			'default'  => 'default',
		),
		"{$prefix}_footer" => array(
			'label'   => __( 'Footer Layout', 'foodcart-core' ),
			'type'    => 'select',
			'options' => array(
				'default' => __( 'Default', 'foodcart-core' ),
				'1'       => __( 'Layout 1', 'foodcart-core' ),
				'2'       => __( 'Layout 2', 'foodcart-core' ),
				'3'       => __( 'Layout 3', 'foodcart-core' ),
				'4'       => __( 'Layout 4', 'foodcart-core' ),
				'5'       => __( 'Layout 5', 'foodcart-core' ),
			),
			'default'  => 'default',
		),
		"{$prefix}_footer_area" => array(
			'label' 	  => __( 'Footer Area', 'foodcart-core' ),
			'type'  	  => 'select',
			'options' => array(
				'default' => __( 'Default', 'foodcart-core' ),
				'on'      => __( 'Enabled', 'foodcart-core' ),
				'off'     => __( 'Disabled', 'foodcart-core' ),
			),
			'default'  	  => 'default',
		),
		"{$prefix}_copyright_area" => array(
			'label' 	  => __( 'Copyright Area', 'foodcart-core' ),
			'type'  	  => 'select',
			'options' => array(
				'default' => __( 'Default', 'foodcart-core' ),
				'on'      => __( 'Enabled', 'foodcart-core' ),
				'off'     => __( 'Disabled', 'foodcart-core' ),
			),
			'default'  	  => 'default',
		),
		"{$prefix}_top_padding" => array(
			'label'   => __( 'Content Padding Top', 'foodcart-core' ),
			'type'    => 'select',
			'options' => array(
				'default' => __( 'Default', 'foodcart-core' ),
				'0px'     => __( '0px', 'foodcart-core' ),
				'10px'    => __( '10px', 'foodcart-core' ),
				'20px'    => __( '20px', 'foodcart-core' ),
				'30px'    => __( '30px', 'foodcart-core' ),
				'40px'    => __( '40px', 'foodcart-core' ),
				'50px'    => __( '50px', 'foodcart-core' ),
				'60px'    => __( '60px', 'foodcart-core' ),
				'70px'    => __( '70px', 'foodcart-core' ),
				'80px'    => __( '80px', 'foodcart-core' ),
				'90px'    => __( '90px', 'foodcart-core' ),
				'100px'   => __( '100px', 'foodcart-core' ),
			),
			'default'  => 'default',
		),
		"{$prefix}_bottom_padding" => array(
			'label'   => __( 'Content Padding Bottom', 'foodcart-core' ),
			'type'    => 'select',
			'options' => array(
				'default' => __( 'Default', 'foodcart-core' ),
				'0px'     => __( '0px', 'foodcart-core' ),
				'10px'    => __( '10px', 'foodcart-core' ),
				'20px'    => __( '20px', 'foodcart-core' ),
				'30px'    => __( '30px', 'foodcart-core' ),
				'40px'    => __( '40px', 'foodcart-core' ),
				'50px'    => __( '50px', 'foodcart-core' ),
				'60px'    => __( '60px', 'foodcart-core' ),
				'70px'    => __( '70px', 'foodcart-core' ),
				'80px'    => __( '80px', 'foodcart-core' ),
				'90px'    => __( '90px', 'foodcart-core' ),
				'100px'   => __( '100px', 'foodcart-core' ),
			),
			'default'  => 'default',
		),
		"{$prefix}_banner" => array(
			'label'   => __( 'Banner', 'foodcart-core' ),
			'type'    => 'select',
			'options' => array(
				'default' => __( 'Default', 'foodcart-core' ),
				'on'	  => __( 'Enable', 'foodcart-core' ),
				'off'	  => __( 'Disable', 'foodcart-core' ),
			),
			'default'  => 'default',
		),
		"{$prefix}_breadcrumb" => array(
			'label'   => __( 'Breadcrumb', 'foodcart-core' ),
			'type'    => 'select',
			'options' => array(
				'default' => __( 'Default', 'foodcart-core' ),
				'on'      => __( 'Enable', 'foodcart-core' ),
				'off'	  => __( 'Disable', 'foodcart-core' ),
			),
			'default'  => 'default',
		),
		"{$prefix}_banner_type" => array(
			'label'   => __( 'Banner Background Type', 'foodcart-core' ),
			'type'    => 'select',
			'options' => array(
				'default' => __( 'Default', 'foodcart-core' ),
				'bgimg'   => __( 'Background Image', 'foodcart-core' ),
				'bgcolor' => __( 'Background Color', 'foodcart-core' ),
			),
			'default' => 'default',
		),
		"{$prefix}_banner_bgimg" => array(
			'label' => __( 'Banner Background Image', 'foodcart-core' ),
			'type'  => 'image',
			'desc'  => __( 'If not selected, default will be used', 'foodcart-core' ),
		),
		"{$prefix}_banner_bgcolor" => array(
			'label' => __( 'Banner Background Color', 'foodcart-core' ),
			'type'  => 'color_picker',
			'desc'  => __( 'If not selected, default will be used', 'foodcart-core' ),
		),
		"{$prefix}_page_bgimg" => array(
			'label' => __( 'Page/Post Background Image', 'foodcart-core' ),
			'type'  => 'image',
			'desc'  => __( 'If not selected, default will be used', 'foodcart-core' ),
		),
		"{$prefix}_page_bgcolor" => array(
			'label' => __( 'Page/Post Background Color', 'foodcart-core' ),
			'type'  => 'color_picker',
			'desc'  => __( 'If not selected, default will be used', 'foodcart-core' ),
		),
	),
) );

$Postmeta->add_meta_box( "{$prefix}_subtitle_info", __( 'Subtitle', 'foodcart-core' ), array( 'post' ), '', 'advanced','high', array(
	'fields' => array(

		//only post meta
		"{$prefix}_subtitle" => array(
			'label'   => __( 'Subtitle', 'foodcart-core' ),
			'type'    => 'text',
			'default'  => '',
		),
		"{$prefix}_youtube_link" => array(
			'label'   => __( 'Youtube Link', 'foodcart-core' ),
			'type'    => 'text',
			'default'  => '',
			'desc'  => __( 'Only work for the video post format', 'foodcart-core' ),
		),

	) )
);

/*-------------------------------------
#. Team
---------------------------------------*/

$Postmeta->add_meta_box( 'foodcart_team_settings', __( 'Team Member Settings', 'foodcart-core' ), array( 'foodcart_team' ), '', '', 'high', array(
	'fields' => array(
		'foodcart_team_designation' => array(
			'label' => __( 'Designation', 'foodcart-core' ),
			'type'  => 'text',
		),
		'foodcart_team_email' => array(
			'label' => __( 'Email', 'foodcart-core' ),
			'type'  => 'text',
		),
		'foodcart_team_socials_header' => array(
			'label' => __( 'Socials', 'foodcart-core' ),
			'type'  => 'header',
			'desc'  => __( 'Enter your social links here', 'foodcart-core' ),
		),
		'foodcart_team_socials' => array(
			'type'  => 'group',
			'value'  => FoodcartTheme_Helper::team_socials()
		),
	)
) );

$Postmeta->add_meta_box( 'foodcart_team_skills', __( 'Team Member Skills', 'foodcart-core' ), array( 'foodcart_team' ), '', '', 'high', array(
	'fields' => array(
		'foodcart_team_skill' => array(
			'type'  => 'repeater',
			'button' => __( 'Add New Skill', 'foodcart-core' ),
			'value'  => array(
				'skill_name' => array(
					'label' => __( 'Skill Name', 'foodcart-core' ),
					'type'  => 'text',
					'desc'  => __( 'eg. Marketing', 'foodcart-core' ),
				),
				'skill_value' => array(
					'label' => __( 'Skill Percentage (%)', 'foodcart-core' ),
					'type'  => 'text',
					'desc'  => __( 'eg. 75', 'foodcart-core' ),
				),
				'skill_color' => array(
					'label' => __( 'Skill Color', 'foodcart-core' ),
					'type'  => 'color_picker',
					'desc'  => __( 'If not selected, primary color will be used', 'foodcart-core' ),
				),
			)
		),
	)
) );

$Postmeta->add_meta_box( 'foodcart_team_counter', __( 'Team Member Counter', 'foodcart-core' ), array( 'foodcart_team' ), '', '', 'high', array(
	'fields' => array(
		'foodcart_team_count' => array(
			'type'  => 'repeater',
			'button' => __( 'Add New Count', 'foodcart-core' ),
			'value'  => array(
				'count_name' => array(
					'label' => __( 'Count Name', 'foodcart-core' ),
					'type'  => 'text',
					'desc'  => __( 'eg. Client Reviews', 'foodcart-core' ),
				),
				'count_value' => array(
					'label' => __( 'Count', 'foodcart-core' ),
					'type'  => 'text',
					'desc'  => __( 'eg. 325', 'foodcart-core' ),
				),
			)
		),
	)
) );

/*-------------------------------------
#. Recipe
---------------------------------------*/
$Postmeta->add_meta_box( 'recipe_info', __( 'Recipe Information', 'foodcart-core' ), array( 'foodcart_recipe' ), '', '', 'high', array(
	'fields' => array(
		'foodcart_recipe_prep_time' => array(
			'label' => __( 'Preparation Time', 'foodcart-core' ),
			'type'  => 'text',
			'desc'  => __( 'Enter text eg. 20 Mins , 1 Hour', 'foodcart-core' ),
			),
		'foodcart_recipe_cook_time' => array(
			'label' => __( 'Cooking Time', 'foodcart-core' ),
			'type'  => 'text',
			'desc'  => __( 'Enter text eg. 20 Mins , 1 Hour', 'foodcart-core' ),
			),
		'foodcart_recipe_ready_in' => array(
			'label' => __( 'Ready In', 'foodcart-core' ),
			'type'  => 'text',
			'desc'  => __( 'Enter text eg. 20 Mins , 1 Hour', 'foodcart-core' ),
			),
		'foodcart_recipe_serving_people' => array(
			'label' => __( 'Number of Serving People', 'foodcart-core' ),
			'type'  => 'number',
			'desc'  => __( 'Enter text eg. 2 or 5', 'foodcart-core' ),
			),
		'foodcart_recipe_ingredient_box' => array(
			'label' => __( 'Ingredents', 'foodcart-core' ),
			'type'  => 'header',
			),
		'foodcart_recipe_ingredient_list' => array(
			'type'   => 'repeater',
			'button' => __( 'Add New Ingredient', 'foodcart-core' ),
			'value'  => array(
				'ingredient_item' => array(
					'label' => __( 'Item', 'foodcart-core' ),
					'type'  => 'text',
					'desc'  => __( 'Enter text eg. 60 ml extra virgin olive oil', 'foodcart-core' ),
					),
				'ingredient_quantity' => array(
						'label' => __( 'Quantity', 'foodcart-core' ),
						'type'  => 'number',
						'desc'  => __( 'Enter Quantity eg. 60', 'foodcart-core' ),
					),
				'ingredient_unit' => array(
						'label' => __( 'Unit', 'foodcart-core' ),
						'type'  => 'text',
						'desc'  => __( 'Enter Quantity unit. Like gm, ml, litre, cup , tea spoon', 'foodcart-core' ),
					),
				)
			),
		'foodcart_recipe_nutrition_box' => array(
			'label' => __( 'Nutrition', 'foodcart-core' ),
			'type'  => 'header',
			),
		'foodcart_recipe_nutrition_serve' => array(
			'label' => __( 'Subtitle', 'foodcart-core' ),
			'type'  => 'text',
			'desc'  => __( 'Enter text eg. per serving', 'foodcart-core' ),
			),
		'foodcart_recipe_nutritions_list' => array(
			'type'   => 'repeater',
			'button' => __( 'Add New Nutrition Item', 'foodcart-core' ),
			'value'  => array(
				'nutritions_item' => array(
					'label' => __( 'Nutrition Item', 'foodcart-core' ),
					'type'  => 'text',
					'desc'  => __( 'Enter text eg. Protine: 6.60g', 'foodcart-core' ),

					)
				)
			),
		'foodcart_recipe_pdf' => array(
			'label' => __( 'Recipe PDF', 'foodcart-core' ),
			'type'  => 'file',
			'desc'  => __( 'Please upload the PDF file here(optional)', 'foodcart-core' ),
			),
		'foodcart_recipe_other' => array(
			'label' => __( 'Show Other Recipes', 'foodcart-core' ),
			'type'  => 'select',
			'options' => array(
				'on'    => 'Yes',
				'off'    => 'No',
				),
			'default'  => 'on',
			),
		)
	)
);

$Postmeta->add_meta_box( 'foodcart_recipe_share', __( 'Recipe Social Share', 'foodcart-core' ), array( 'foodcart_recipe' ), '', '', 'high', array(
	'fields' => array(
		'foodcart_recipe_socials' => array(
			'label' => __( 'Socials', 'foodcart-core' ),
			'type'  => 'header',
			'desc'  => __( 'Enter your social links here', 'foodcart-core' ),
		),
		'foodcart_recipe_icons' => array(
			'type'  => 'group',
			'value'  => FoodcartTheme_Helper::team_socials()
		),
	)
) );

/*-------------------------------------
#. Testimonial
---------------------------------------*/
$Postmeta->add_meta_box( 'foodcart_testimonial_info', __( 'Testimonial Info', 'foodcart-core' ), array( 'foodcart_testim' ), '', '', 'high', array(
	'fields' => array(
		'foodcart_tes_designation' => array(
			'label' => __( 'Designation', 'foodcart-core' ),
			'type'  => 'text',
		),
		'foodcart_tes_rating' => array(
			'label' => __( 'Select the Rating', 'foodcart-core' ),
			'type'  => 'select',
			'options' => array(
				'default' => __( 'Default', 'foodcart-core' ),
				'1'    => '1',
				'2'    => '2',
				'3'    => '3',
				'4'    => '4',
				'5'    => '5'
				),
			'default'  => 'default',
		),
	)
) );

