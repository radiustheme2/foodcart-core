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
$attr = '';
if ( !empty( $data['url']['url'] ) ) {
	$attr  = 'href="' . $data['url']['url'] . '"';
	$attr .= !empty( $data['url']['is_external'] ) ? ' target="_blank"' : '';
	$attr .= !empty( $data['url']['nofollow'] ) ? ' rel="nofollow"' : '';
	$title = '<a ' . $attr . '>' . $data['title'] . '<i class="fa fa-chevron-right" aria-hidden="true"></i>' . '</a>';
	
}
else {
	$title = $data['title'];
}

if ( !empty( $data['buttontext'] ) ) {
	$btn = '<a class="foodcart-button-2" ' . $attr . '>' . $data['buttontext'] . '</a>';
}
// icon , image
if ( $data['icontype'] == 'icon' || $data['icontype'] == 'image' ) {
	$size = FOODCART_CORE_THEME_PREFIX . '-size7';
	if ( $attr ) {
		$img = '<a ' . $attr . '>' . wp_get_attachment_image( $data['image']['id'], $size ) . '</a>';
	}
	else {
		$img = wp_get_attachment_image( $data['image']['id'], $size );
	}
}

?>
<div class="info-box media info-<?php echo esc_attr( $data['style'] );?> <?php echo esc_attr( $data['title_align'] ); ?>">
	<div class="rtin-item rtin-<?php echo esc_attr( $data['icontype'] );?>">
		<div class="rtin-media">
			<span>
				<?php if ( $data['icontype'] == 'image' ) { 
					if (!empty($img)) { echo wp_kses_post( $img ); } else { echo '<img class="wp-post-image" src="' . FoodcartTheme_Helper::get_img( 'noimage_630X517.jpg' ) . '" alt="'.get_the_title().'">'; } ?>
				<?php } else { ?>
					<span><i class="<?php echo esc_attr( $data['icon'] );?>" aria-hidden="true"></i></span>
				<?php } ?>
			</span>
			<?php if ( !empty( $data['title'] ) ) { ?>
			<h3 class="rtin-item-title"><?php echo wp_kses_post( $title );?></h3>
			<?php } ?>
		</div>
	</div>
</div>