<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */

namespace radiustheme\Foodcart_Core;

$btn = $attr = '';

if ( !empty( $data['buttonurl']['url'] ) ) {
	$attr  = 'href="' . $data['buttonurl']['url'] . '"';
	$attr .= !empty( $data['buttonurl']['is_external'] ) ? ' target="_blank"' : '';
	$attr .= !empty( $data['buttonurl']['nofollow'] ) ? ' rel="nofollow"' : '';
	
}
if ( !empty( $data['buttontext'] ) ) {
	$btn = '<a ' . $attr . '>' . $data['buttontext'] . '</a>';
}

?>
<div class="rt-el-cta cta-<?php echo esc_attr( $data['style'] ); ?> <?php echo esc_attr( $data['theme'] ); ?>">
	<div class="container">
		<div class="align-items">
			<div class="cta-content">
				<h2 class="rtin-title"><?php echo wp_kses_post( $data['title'] );?></h2>
				<p><?php echo wp_kses_post( $data['content'] );?></p>
			</div>
			<div class="cta-button">
				<?php if ( $btn ) { ?>
					<div class="rtin-button"><?php echo wp_kses_post( $btn );?></div>		
				<?php } ?>
			</div>
		</div>		
	</div>
</div>