<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */

namespace radiustheme\Foodcart_Core;

use FoodcartTheme;
use FoodcartTheme_Helper;
use \WP_Query;

$btn = $attr = '';

if ( !empty( $data['one_buttonurl']['url'] ) ) {
	$attr  = 'href="' . $data['one_buttonurl']['url'] . '"';
	$attr .= !empty( $data['one_buttonurl']['is_external'] ) ? ' target="_blank"' : '';
	$attr .= !empty( $data['one_buttonurl']['nofollow'] ) ? ' rel="nofollow"' : '';
	
}
if ( !empty( $data['button_one'] ) ) {
	$btn = '<a class="foodcart-button-2" ' . $attr . '>' . $data['button_one'] . '<i class="fa fa-angle-right" aria-hidden="true"></i>'. '</a>';
}

$title_css = $sub_title_css = $content_css = '';
$title_color = $data['title_color'];
$sub_title_color = $data['sub_title_color'];
$content_color = $data['content_color'];

if ( $title_color != '' ) {
	$title_css  .= " color: {$title_color};";
}
if ( $sub_title_color != '' ) {
	$sub_title_css  .= " color: {$sub_title_color};";
}
if ( $content_color != '' ) {
	$content_css  .= " color: {$content_color};";
}
?>

<div class="about-image-text about-layout-<?php echo esc_attr( $data['style'] ); ?>">
	<div class="about-box-right">
		<div class="container">
			<div class="row">
				<div class="col-xl-8 col-lg-12 order-lg-2">
					<div class="about-content">
						<?php if ( !empty( $data['sub_title'] ) ) { ?>
						<span class="sub-rtin-title" style="<?php echo wp_kses_post( $sub_title_css ); ?>"><?php echo wp_kses_post( $data['sub_title'] );?></span>
						<?php } ?>
						<?php if ( !empty( $data['title'] ) ) { ?>
						<h2 class="rtin-title" style="<?php echo wp_kses_post( $title_css ); ?>"><?php echo wp_kses_post( $data['title'] );?></h2>
						<?php } ?>
						
						<div class="rtin-content" style="<?php echo wp_kses_post( $content_css ); ?>"><?php echo wp_kses_post( $data['content'] );?></div>
						<?php if ( $data['button_display']  == 'yes' ) { ?>
						<?php if ( $btn ) { ?>
						<div class="rtin-button"><?php echo wp_kses_post( $btn );?></div>
						<?php } ?>
						<?php } ?>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="about-box-left order-lg-1">
		<div class="about-image">
			<?php if ( !empty( $data['image']['id'] ) ) { 
				echo wp_get_attachment_image( $data['image']['id'], 'full' ); 
			 } else { 
				echo '<img class="wp-post-image" src="' . FoodcartTheme_Helper::get_img( 'noimage_900X500.jpg' ) . '" alt="'.get_the_title().'">';
			} ?>				
		</div>
	</div>
</div>
















