<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */

namespace radiustheme\Foodcart_Core;

?>
<div class="rtin-progress-bar">
	<div class="rtin-name"><?php echo esc_html( $data['title'] );?></div>
	<div class="progress" style="height:<?php echo esc_html( $data['number_height'] );?>px">
		<div class="progress-bar progress-bar-striped fadeInLeft animated" data-progress="<?php echo esc_attr( $data['number']['size'] );?>%" style="width: <?php echo esc_attr( $data['number']['size'] );?>%;"> <span><?php echo esc_html( $data['number']['size'] );?>%</span></div>
	</div>
</div>