<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */

namespace radiustheme\Foodcart_Core;

$attr = '';
if ( !empty( $data['url']['url'] ) ) {
	$attr  = 'href="' . $data['url']['url'] . '"';
	$attr .= !empty( $data['url']['is_external'] ) ? ' target="_blank"' : '';
	$attr .= !empty( $data['url']['nofollow'] ) ? ' rel="nofollow"' : '';
	$title = '<a ' . $attr . '>' . $data['title'] . '</a>';	
}
else {
	$title = $data['title'];
}

if ( !empty( $data['buttontext'] ) ) {
	$btn = '<a class="foodcart-button-2" ' . $attr . '>' . $data['buttontext'] . '</a>';
}


// icon , image
if ( $data['icontype'] == 'icon' || $data['icontype'] == 'image' ) {
	$size = FOODCART_CORE_THEME_PREFIX . '-size2';
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
				<?php if ( $data['icontype'] == 'image' ): ?>
					<?php echo wp_kses_post( $img );?>
				<?php else: ?>
					<span><i class="<?php echo esc_attr( $data['icon'] );?>" aria-hidden="true"></i></span>
				<?php endif; ?>
			</span>
		</div>
		<div class="media-body rtin-content">
			<?php if ( !empty( $data['title'] ) ) { ?>
			<h3 class="rtin-item-title"><?php echo wp_kses_post( $title );?></h3>
			<?php } if ( !empty( $data['content'] ) ) { ?>
			<div class="rtin-text"><?php echo wp_kses_post( $data['content'] );?></div>
			<?php } ?>
			<?php if ( !empty( $btn ) ){ ?>
				<div class="rtin-button"><?php echo wp_kses_post( $btn );?></div>		
			<?php } ?>
		</div>
	</div>
</div>