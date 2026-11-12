<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */

namespace radiustheme\Foodcart_Core;

?>

<div class="rtin-faq">
	<?php
		$i = 1;		
		foreach ( $data['faq_item_lists'] as $faq_item_list ) { ?>
		<div class="faq-item">
			<div class="faq-number">
				<span><?php echo esc_html( $faq_item_list['item_number'] ); ?></span>
			</div>
			<div class="faq-content">
				<h3 class="item-title"><?php echo esc_html( $faq_item_list['item_title'] ); ?></h3>
				<p class="item-text"><?php echo esc_html( $faq_item_list['item_text'] ); ?></p>
			</div>
		</div>
	<?php $i++; } ?>
</div>


