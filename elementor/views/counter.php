<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */

namespace radiustheme\Foodcart_Core;

?>
<div class="rt-counter rtin-<?php echo esc_attr( $data['iconalign'] );?>">
	<div class="rtin-item clearfix">
		<?php if ( $data['showhide'] == 'show' ) { ?>
		<div class="icon-<?php echo esc_attr( $data['iconalign'] );?>">
			<?php if ( $data['icontype'] == 'image' ): ?>
				<?php
				if ( !empty( $data['image']['id'] ) ) {
					echo wp_get_attachment_image( $data['image']['id'], 'full', true );
				}
				?>
			<?php else: ?>
				<i class="<?php echo esc_attr( $data['icon'] );?>" aria-hidden="true"></i>
			<?php endif; ?>
		</div>
		<?php } ?>
		<div class="rtin-right">
			<h3 class="rtin-title"><?php echo esc_html( $data['title'] );?></h3>
			<div class="rtin-counter"><span class="counter" data-num="<?php echo esc_attr( $data['number'] );?>" data-rtspeed="<?php echo esc_attr( $data['speed'] );?>" data-rtsteps="<?php echo esc_attr( $data['steps'] );?>"><?php echo esc_html( $data['number'] );?></span></div>
		</div>	
	</div>
</div>
