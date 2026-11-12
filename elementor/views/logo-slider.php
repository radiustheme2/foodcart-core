<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */

namespace radiustheme\Foodcart_Core;

$slider_nav_class = $data['slider_nav'] == 'yes' ? 'slider-nav-enabled' : '';
$slider_dot_class = $data['slider_dots'] == 'yes' ? ' slider-dot-enabled' : '';

?>
<div class="rtin-logo-slider owl-wrap rt-owl-nav-2 <?php echo esc_attr( $slider_nav_class ); ?><?php echo esc_attr( $slider_dot_class ); ?>">
	<div class="owl-theme owl-carousel rt-owl-carousel" data-carousel-options="<?php echo esc_attr( $data['owl_data'] );?>">
		<?php foreach ( $data['logos'] as $logo ): ?>
			<?php if ( empty( $logo['image']['id'] ) ) continue; ?>
			<div class="rtin-item">
				<?php if ( !empty( $logo['url'] ) ): ?>
					<a href="<?php echo esc_url( $logo['url'] );?>" target="_blank"><?php echo wp_get_attachment_image( $logo['image']['id'], 'full' )?></a>
				<?php else: ?>
					<?php echo wp_get_attachment_image( $logo['image']['id'], 'full' )?>
				<?php endif; ?>
			</div>
		<?php endforeach; ?>                      
	</div>
</div>