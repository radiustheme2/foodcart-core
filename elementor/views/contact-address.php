<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */

namespace radiustheme\Foodcart_Core;

?>

<div class="rtin-contact-address <?php echo esc_attr( $data['style'] ); ?>">
	<div class="contact-info">
		<ul>
		<?php if ( !empty( $data['address'] ) ) { ?>
			<li><span><i class="fa fa-location-arrow" aria-hidden="true"></i><?php esc_html_e( 'Address:', 'foodcart' ); ?></span><?php echo wp_kses_post( $data['address'] ); ?></li>
		<?php } ?>
		<?php if ( !empty( $data['email'] ) ) { ?>
			<li><span><i class="fa fa-envelope-o" aria-hidden="true"></i><?php esc_html_e( 'E-mail:', 'foodcart' ); ?></span><a href="mailto:<?php echo esc_attr( $data['email'] ); ?>"><?php echo esc_html( $data['email'] ); ?></a></li>
		<?php } ?>
		<?php if ( !empty( $data['phone'] ) ) { ?>
			<li><span><i class="fa fa-phone" aria-hidden="true"></i><?php esc_html_e( 'Phone:', 'foodcart' ); ?></span><a href="tel:<?php echo esc_attr( $data['phone'] ); ?>"><?php echo esc_html( $data['phone'] ); ?></a></li>
		<?php } ?>
		<?php if ( !empty( $data['fax'] ) ) { ?>
			<li><span><i class="fa fa-fax" aria-hidden="true"></i><?php esc_html_e( 'Fax:', 'foodcart' ); ?></span><?php echo wp_kses_post( $data['fax'] ); ?></li>
		<?php } ?>
		</ul>
	</div>
</div>