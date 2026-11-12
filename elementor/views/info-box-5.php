<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */

namespace radiustheme\Foodcart_Core;

// image
if ( $data['icontype'] == 'image' ) {
	$size = FOODCART_CORE_THEME_PREFIX . '-size2';
	$img = wp_get_attachment_image( $data['image']['id'], $size );
}

?>
<div class="info-box media info-<?php echo esc_attr( $data['style'] );?> <?php echo esc_attr( $data['title_align'] ); ?>">
	<div class="rtin-item media rtin-<?php echo esc_attr( $data['icontype'] );?>">
		<div class="rtin-media">
			<span>
				<?php if ( $data['icontype'] == 'image' ): ?>
					<?php echo wp_kses_post( $img );?>
				<?php else: ?>
					<span><i class="<?php echo esc_attr( $data['icon'] );?>" aria-hidden="true"></i></span>
				<?php endif; ?>
			</span>
		</div>
		<div class="media-body rtin-content">
			<?php if ( !empty( $data['title_two'] ) ) { ?>
			<h3 class="rtin-item-title"><?php echo wp_kses_post( $data['title_two'] ); ?></h3>
			<?php } if ( !empty( $data['content'] ) ) { ?>
			<div class="rtin-text"><?php echo wp_kses_post( $data['content'] ); ?></div>
			<?php } ?>
		</div>
	</div>
</div>