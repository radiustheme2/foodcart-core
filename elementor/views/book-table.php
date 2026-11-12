<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */

namespace radiustheme\Foodcart_Core;

$btn = $attr = '';
//print_r ( $data['button_url'] );
if ( !empty( $data['button_url'] ) ) {
	$attr  = 'href="' . $data['button_url'] . '"';
	$attr .= !empty( $data['button_url']['is_external'] ) ? ' target="_blank"' : '';
	$attr .= !empty( $data['button_url']['nofollow'] ) ? ' rel="nofollow"' : '';
	
}
if ( !empty( $data['button_text'] ) ) {
	$btn = '<a class="foodcart-button-1" ' . $attr . '>' . $data['button_text'] . '</a>';
}
?>

<div class="book-table <?php echo esc_attr( $data['align'] ); ?>">
	<?php
		$i = 1;		
		foreach ( $data['book_item_lists'] as $book_item_list ) { ?>	
		<div class="book-item">
			<span class="item-title"><?php echo esc_html( $book_item_list['item_title'] ); ?></span>
			<span class="item-text"><?php echo esc_html( $book_item_list['item_text'] ); ?></span>
			
		</div>
	<?php $i++; } ?>
	<?php if ( $btn ) { ?>
		<span class="rtin-button"><?php echo wp_kses_post( $btn );?></span>
	<?php } ?>
</div>


