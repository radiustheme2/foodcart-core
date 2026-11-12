<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */

namespace radiustheme\Foodcart_Core;
use FoodcartTheme;
use FoodcartTheme_Helper;
use \WP_Query;

?>
<!---<div id="preloader">
	<div class="preloader-wrap">
		<div class="preloader-content">
			<div class="circle"></div>
		</div>
	</div>
</div> -->
<!-- MultiScroll Area End Here -->
<ul id="msmenu" class="ms-menu-list">
<?php
	$i = 1;
	foreach ( $data['split_item_lists'] as $split_item_list ) { ?>
	<li data-menuanchor="p<?php echo esc_html( $i ); ?>" data-tooltip="p<?php echo esc_html( $i ); ?>" class="<?php if ( $i == 1 ) { ?>active<?php } ?>"><a href="#p<?php echo esc_html( $i ); ?>"><?php echo esc_html( $i ); ?></a></li>
<?php $i++; } ?>
</ul>
<div id="multiscroll" class="multiscroll-wrapper">
	<div class="ms-left">
	<?php
		$i = 1;		
		foreach ( $data['split_item_lists'] as $split_item_list ) { ?>	
		<div class="ms-section left-slide1 <?php if ( $i == 1 ) { ?>active<?php } ?>">
			<h2 class="item-title"><?php echo esc_html( $split_item_list['item_title'] ); ?></h2>
			<p><?php echo esc_html( $split_item_list['item_text'] ); ?></p>
			<a href="<?php echo $split_item_list['multi_button_url']['url'] ; ?>" class="item-btn"><?php echo esc_html( $split_item_list['multi_button_text'] ); ?><i class="flaticon-right-arrow"></i></a>
		</div>
	<?php $i++; } ?>
	</div>
	<div class="ms-right">
		<?php $i = 1; foreach ( $data['split_item_lists'] as $split_item_list ) { ?>	
		<div class="ms-section right-slide<?php echo esc_html( $i ); ?> <?php if ( $i == 1 ) { ?>active<?php } ?>">
			<div class="d-none d-xl-block d-lg-block">
				<?php if ( !empty( $split_item_list['image']['id'] ) ) { 
					echo wp_get_attachment_image( $split_item_list['image']['id'], 'full' ); 
				 } else { 
					echo '<img class="wp-post-image" src="' . FoodcartTheme_Helper::get_img( 'noimage.jpg' ) . '" alt="'.get_the_title().'">';
				} ?>
			</div>			
			<div class="d-block d-xl-none d-lg-none">
				<?php if ( !empty( $split_item_list['image']['id'] ) ) { 
					echo wp_get_attachment_image( $split_item_list['image']['id'], 'full' ); 
				 } else { 
					echo '<img class="wp-post-image" src="' . FoodcartTheme_Helper::get_img( 'noimage.jpg' ) . '" alt="'.get_the_title().'">';
				} ?>
			</div>		
		</div>
		<?php $i++; } ?>
	</div>
	
	<?php if ( $data['multi_footer_info'] == 'yes' ) { ?>
	<div class="ms-copyright"><?php echo wp_kses_post( FoodcartTheme::$options['copyright_text'] );?></div>
	<?php } ?>
	
</div>