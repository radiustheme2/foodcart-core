<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */

namespace radiustheme\Foodcart_Core;

?>
<div class="rt-el-cta cta-<?php echo esc_attr( $data['style'] ); ?> <?php echo esc_attr( $data['theme'] ); ?>">
	<div class="container">
		<div class="align-items">
			<div class="cta-content">
				<h2 class="rtin-title"><?php echo wp_kses_post( $data['title'] );?></h2>
			</div>
			<div class="phone-number">
				<span><i class="flaticon-call-answer"></i></span><h3><a href="tel:<?php echo esc_attr( $data['pho_number'] ); ?>"><?php echo esc_html( $data['pho_number'] ); ?></a></h3>
			</div>
		</div>		
	</div>
</div>