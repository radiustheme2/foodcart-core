<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */

namespace radiustheme\Foodcart_Core;

$btn = $attr = '';

if ( !empty( $data['one_buttonurl']['url'] ) ) {
	$attr  = 'href="' . $data['one_buttonurl']['url'] . '"';
	$attr .= !empty( $data['one_buttonurl']['is_external'] ) ? ' target="_blank"' : '';
	$attr .= !empty( $data['one_buttonurl']['nofollow'] ) ? ' rel="nofollow"' : '';
	
}
if ( !empty( $data['button_one'] ) ) {
	$btn = '<a class="foodcart-button" ' . $attr . '>' . $data['button_one'] . '</a>';
}

?>

<div class="rtin-contact-box <?php echo esc_attr( $data['style'] ); ?> <?php echo esc_attr( $data['textalign'] );?>">
	<div class="contact-box">
		<ul>
			<?php if ( !empty( $data['address'] ) ) { ?>
				<li><?php echo wp_kses_post( $data['address'] ); ?></li>
			<?php } ?>
			<?php if ( !empty( $data['phone'] ) ) { ?>
				<li><a href="tel:<?php echo esc_attr( $data['phone'] ); ?>"><?php echo esc_html( $data['phone'] ); ?></a></li>
			<?php } ?>
			<?php if ( !empty( $data['email'] ) ) { ?>
				<li><a href="mailto:<?php echo esc_attr( $data['email'] ); ?>"><?php echo esc_html( $data['email'] ); ?></a></li>
			<?php } ?>
			<?php if ( !empty( $data['fax'] ) ) { ?>
				<li><?php echo wp_kses_post( $data['fax'] ); ?></li>
			<?php } ?>
		</ul>
		<?php if ( $data['button_display']  == 'yes' ) { ?>
			<?php if ( $btn ) { ?>
				<div class="rtin-button rtin-<?php echo esc_attr ( $data['buttonstyle'] ); ?>"><?php echo wp_kses_post( $btn );?></div>
			<?php } ?>
		<?php } ?>
	</div>
</div>