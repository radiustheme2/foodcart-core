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

$prefix      = FOODCART_CORE_THEME_PREFIX;
$thumb_size  = 'foodcart-size10';

// content limit
$content_limit = $data['count'];

$args = array(
	'post_type'      => 'product',
	'posts_per_page' => $data['number'],
	'orderby'        => $data['orderby'],
);

if ( !empty( $data['cat'] ) ) {
	$args['tax_query'] = array(
		array(
			'taxonomy' => 'product_cat',
			'field' => 'term_id',
			'terms' => $data['cat'],
		)
	);
}

switch ( $data['orderby'] ) {
	case 'title':
	case 'menu_order':
	$args['order'] = 'ASC';
	break;
}

$query = new WP_Query( $args );

$temp = FoodcartTheme_Helper::wp_set_temp_query( $query );
?>
	<div class="slick-carousel food-menu-box-layout7" data-slick='{
		"slidesToShow": 3,
		"slidesToShowTab": 3,
		"slidesToShowMobile": 3,
		"slidesToScroll": 1,
		"speed": 600,
		"autoplaySpeed": 2000,
		"dots": false,
		"arrows": true,
		"infinite": true,
		"vertical": true,
		"lazyLoad": "progressive",
		"pauseOnHover": true,
		"autoplay": false,
		"centerMode": false,
		"adaptiveHeight": false,
		"rtl": false,
		"prevArrow": "<span class=\"slick-prev slick-navigation\"><i class=\"flaticon-up-arrow\"></i></span>",
		"nextArrow": "<span class=\"slick-next slick-navigation\"><i class=\"flaticon-down-arrow\"></i></span>"
		}'>
		
		<?php if ( $query->have_posts() ) { ?>
			<?php while ( $query->have_posts() ) { $query->the_post();
				$price_html = 'foodcart_product_price id="'. get_the_ID() .'"';				
				$excerpt = wp_trim_words(get_the_excerpt(), $content_limit, '');
				global $product;
				global $woocommerce;
				$label  = apply_filters('add_to_cart_text', __('Add to cart', 'foodcart-core'));
			?>			
				<div class="food-menu-box-content">
					<div class="food-img">
						<a href="single-menu.html">
							<?php
							if ( has_post_thumbnail() ){
								the_post_thumbnail( array(138, 138) );
							}
							else {
								if ( !empty( FoodcartTheme::$options['no_preview_image']['id'] ) ) {
									echo wp_get_attachment_image( FoodcartTheme::$options['no_preview_image']['id'], $thumb_size );
								}
								else {
									echo '<img class="wp-post-image" src="' . FoodcartTheme_Helper::get_img( 'noimage_520X520.jpg' ) . '" alt="'.get_the_title().'">';
								}
							}
							?>
						</a>
					</div>
					<div class="food-details">
						<h3 class="item-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
						<?php if ( $data['content_display']  == 'yes' ) { ?>
						<p><?php echo wp_kses_post ( $excerpt ); ?></p>
						<?php } ?>
					</div>
					<div class="food-price">
						<span class="item-price"><?php echo do_shortcode( '['. $price_html .']' ); ?></span>						
						<form action="<?php echo esc_url( $product->add_to_cart_url() ); ?>?add-to-cart=<?php echo esc_attr( $product->get_id()) ; ?>" class="cart quantity-holder" method="post" enctype='multipart/form-data'>
							<?php woocommerce_quantity_input(); ?>
							<button type="submit" data-quantity="1" data-product_id="<?php echo esc_attr( $product->get_id()) ; ?>"	class="button alt ajax_add_to_cart add_to_cart_button product_type_simple"><?php echo $label; ?></button>
						</form>
					</div>
				</div>						
				
			<?php } ?>
		<?php } ?>
		<?php FoodcartTheme_Helper::wp_reset_temp_query( $temp ); ?>
	</div>