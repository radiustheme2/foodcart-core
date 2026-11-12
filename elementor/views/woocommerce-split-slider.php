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

$number_of_post = $data['itemnumber'];
$number_of_post_offset = $data['number_of_post_offset'];
$p_ids = array();

// build up the array
foreach ( $data['posts_not_in'] as $p_idsn ) {
	$p_ids[] = $p_idsn['post_not_in'];
}
// sort
$post_sorting = $data['post_sorting'];
// order
$post_ordering = $data['post_ordering'];
// Title Limit
$title_limit = $data['post_title_length'];
// content limit
$content_limit = $data['post_excerpt_length'];

?>
<!--<div id="preloader">
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
	<li data-menuanchor="p<?php echo esc_html( $i ); ?>" class="<?php if ( $i == 1 ) { ?>active<?php } ?>"><a href="#p<?php echo esc_html( $i ); ?>"><?php echo esc_html( $i ); ?></a></li>
<?php $i++; } ?>
</ul>
<div id="multiscroll" class="multiscroll-wrapper">
	<div class="ms-left">
	<?php
		$cats = array();
		foreach ( $data['category_list'] as $cat ) {
			$cats[] = array(
				'cat_multi_box' => $cat['cat_multi_box'],
			);
		}
		if ( !empty( $cats ) ) {
		$category_number = count( $cats );
		$y = 1;
		
		foreach ( $cats as $cat ) {
	?>		
		<div class="ms-section left-slide1 <?php if ( $y == 1 ) { ?>active<?php } ?>">		
			<div class="ms-food-content-box">
				<div class="item-heading">
					<h2 class="item-title"><?php $term = get_term( $cat['cat_multi_box'], 'product_cat'); echo wp_kses_post( $term->name ); ?></h2>
				</div>				
		<?php
			$product_args = array(
				'post_type' => 'product',
				'order' => $post_ordering,
				'orderby' => $post_sorting,
				'posts_per_page' => $number_of_post,	
				'post_status'    => 'publish',
				'tax_query' => array(
					array(
						'taxonomy' => 'product_cat',
						'field'    => 'id',
						'terms'    => $cat['cat_multi_box'],
					),
				),
			);
			if ( !empty( $p_ids ) ) {
				$product_args['post__not_in'] = $p_ids;
			}
			if ( !empty( $number_of_post_offset ) ) {
				$product_args['offset'] =  $number_of_post_offset;						
			}
			$product_query = new WP_Query( $product_args );
			
			$temp = FoodcartTheme_Helper::wp_set_temp_query( $product_query );

			if ( $product_query->have_posts() ) {
				while ( $product_query->have_posts() ) {
				$product_query->the_post();				
				$excerpt = wp_trim_words(get_the_excerpt(), $content_limit, '');
				$product_title = wp_trim_words( get_the_title(), $title_limit, '' );
				
				global $product;
				global $woocommerce;
				$price_html = 'foodcart_product_price id="'. get_the_ID() .'"';
		?>
				<div class="item-single-food">
					<div class="media media-none--xs">
						<div class="item-img">
						<a href="<?php the_permalink(); ?>">						
						<?php
							if ( 'yes' == $data['showimage'] ) {
								if ( has_post_thumbnail() ){
									the_post_thumbnail( array( 196, 196 ) );
								}
								else {
									if ( !empty( FoodcartTheme::$options['no_preview_image']['id'] ) ) {
										echo wp_get_attachment_image( FoodcartTheme::$options['no_preview_image']['id'], $thumb_size );
									}
									else {
										echo '<img class="wp-post-image" src="' . FoodcartTheme_Helper::get_img( 'noimage_520X520.jpg' ) . '" alt="'.get_the_title().'">';
									}
								}
							}
						?>
						</a>
						</div>
						<div class="media-body">
							<h3 class="food-name"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
							<p><?php echo wp_kses_post( $excerpt ); ?></p>
							<div class="food-price"><?php echo do_shortcode( '['. $price_html .']' ); ?></div>
						</div>
					</div>
				</div>				
				<?php } ?>
			<?php } ?>
			<?php FoodcartTheme_Helper::wp_reset_temp_query( $temp ); ?>
			</div>
		</div>	
	<?php $y++; } } ?>		
	</div>
	<div class="ms-right">
		<?php
			foreach ( $data['category_list'] as $cat ) {
				$cats_title[] = array(
					'cat_multi_box' => $cat['cat_multi_box'],
				);
			}
			if ( !empty( $cats_title ) ) {
			//category
			$category_number = count( $cats_title );
			$i = 1;
			foreach ( $cats_title as $cat ) {
				if ( $cat['cat_multi_box'] != 0 ) {
		?>
		<?php $i = 1; foreach ( $data['category_list'] as $category_lists ) { ?>
		<div class="ms-section right-slide<?php echo esc_html( $i ); ?> <?php if ( $i == 1 ) { ?>active<?php } ?>">
			<div class="d-none d-xl-block d-lg-block">
				<h2 class="item-title"><?php $term = get_term( $category_lists['cat_multi_box'], 'product_cat'); echo wp_kses_post( $term->name ); ?></h2>
				<?php if ( !empty( $category_lists['woo_cat_image']['id'] ) ) { 
					echo wp_get_attachment_image( $category_lists['woo_cat_image']['id'], 'full' ); 
				 } else { 
					echo '<img class="wp-post-image" src="' . FoodcartTheme_Helper::get_img( 'noimage.jpg' ) . '" alt="'.get_the_title().'">';
				} ?>				
			</div>			
		</div><?php $i++; } ?>
		<?php } $i++; } } ?>
	</div>	
	
	<?php if ( $data['multi_footer_info'] == 'yes' ) { ?>
	<div class="ms-copyright"><?php echo wp_kses_post( FoodcartTheme::$options['copyright_text'] );?></div>
	<?php } ?>
	
</div>