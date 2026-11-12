<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */

namespace radiustheme\Foodcart_Core;

$btn = $attr = '';

if ( !empty( $data['url']['url'] ) ) {
	$attr  = 'href="' . $data['url']['url'] . '"';
	$attr .= !empty( $data['url']['is_external'] ) ? ' target="_blank"' : '';
	$attr .= !empty( $data['url']['nofollow'] ) ? ' rel="nofollow"' : '';
	
}
if ( !empty( $data['buttontext'] ) ) {
	$btn = '<a class="item-btn" ' . $attr . '>' . $data['buttontext'] . '</a>';
}

$title = $data['title'];

?>
<div class="site-banner-box-layout1 <?php echo esc_attr( $data['title_align'] ); ?>">
	<?php if ( !empty( $data['subtitle'] ) ) { ?>
	<div class="item-delivery">
		<span><?php echo wp_kses_post( $data['subtitle'] );?></span>
	</div>
	<?php } ?>	
	<?php if ( !empty( $data['title'] ) ) { ?>
	<h2 class="rtin-item-title"><?php echo wp_kses_post( $title );?></h2>	
	<?php } ?>
	<div class="food-price-name">
		<?php if ( !empty( $data['price_full'] ) ) { ?>
		<div class="food-price">
			<div class="currency"><?php echo esc_html( $data['price_full'] ); ?><span><?php echo esc_html( $data['price_decimal'] ); ?></span></div>	
		</div>
		<?php } ?>
		<?php if ( !empty( $data['content'] ) ) { ?>
		<div class="food-name"><?php echo wp_kses_post( $data['content'] );?></div>
		<?php } ?>
	</div>
	<?php ?>
	<?php if ( !empty( $btn ) ){ ?><?php echo wp_kses_post( $btn );?><?php } ?>
</div>