<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */

namespace radiustheme\Foodcart_Core;

$lg_item = ( 12 / $data['col_lg']);
$md_item = ( 12 / $data['col_md']);
$sm_item = ( 12 / $data['col_sm']);
$xs_item = ( 12 / $data['col_xs']);

$col_class = "col-lg-{$lg_item} col-md-{$md_item} col-sm-{$sm_item} col-{$xs_item}";
?>
<div class="rtin-logo-grid-1">
	<div class="row no-gutters">
		<?php foreach ( $data['logos'] as $logo ): ?>
			<?php if ( empty( $logo['image']['id'] ) ) continue; ?>
			<div class="rtin-item <?php echo esc_attr( $col_class );?>">
				<figure>
				<?php if ( !empty( $logo['url'] ) ): ?>
					<a href="<?php echo esc_url( $logo['url'] );?>" target="_blank"><?php echo wp_get_attachment_image( $logo['image']['id'], 'full' )?></a>
				<?php else: ?>
					<?php echo wp_get_attachment_image( $logo['image']['id'], 'full' )?>
				<?php endif; ?>
				</figure>
			</div>
		<?php endforeach; ?> 
	</div>
</div>