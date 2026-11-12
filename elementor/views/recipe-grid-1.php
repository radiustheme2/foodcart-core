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

$thumb_size = 'foodcart-size7';

if ( get_query_var('paged') ) {
	$paged = get_query_var('paged');
}
else if ( get_query_var('page') ) {
	$paged = get_query_var('page');
}
else {
	$paged = 1;
}

$number_of_post = $data['itemnumber'];
$post_sorting = $data['post_sorting'];
$post_ordering = $data['post_ordering'];
$title_limit = $data['post_title_length'];	
$cat_single_grid = $data['cat_single'];
$args = array(
	'post_type' => 'foodcart_recipe',
	'post_status' => 'publish',
	'orderby' => $post_sorting,
	'order' => $post_ordering,
	'posts_per_page' => $number_of_post,
	'paged'          => $paged,
);

if ( $cat_single_grid != 0 ) {
	$args['tax_query'] = array (
		array (
			'taxonomy' => 'foodcart_recipe_category',
			'field'    => 'ID',
			'terms'    => $cat_single_grid,
		)
	);
}

$query = new WP_Query( $args );
$temp = FoodcartTheme_Helper::wp_set_temp_query( $query );

$col_class = "rt-grid-item col-lg-{$data['col_lg']} col-md-{$data['col_md']} col-sm-{$data['col_sm']} col-xs-{$data['col_xs']}";
?>
<div class="recipe-default recipe-<?php echo esc_attr( $data['style'] ); ?>">
	<div class="row rt-recipe-content rt-masonry-grid">
		<?php 
			if ( $query->have_posts() ) {	
				while ( $query->have_posts() ) {
				$query->the_post();		
				$item_title = wp_trim_words(get_the_title(), $title_limit, '');
				$content = FoodcartTheme_Helper::get_current_post_content();
				$content = wp_trim_words( $content, $data['count'], '' );
				$content = "<p>$content</p>";
		?>
			<div class="<?php echo esc_attr( $col_class );?>">
				<div class="rtin-item">
					<div class="item-img">
						<a href="<?php the_permalink(); ?>">
						<?php
							if ( has_post_thumbnail() ){
								the_post_thumbnail( $thumb_size );
							} else {
								if ( !empty( FoodcartTheme::$options['no_preview_image']['id'] ) ) {
									echo wp_get_attachment_image( FoodcartTheme::$options['no_preview_image']['id'], $thumb_size );
								} else {
									echo '<img class="wp-post-image" src="' . FoodcartTheme_Helper::get_img( 'noimage_610X430.jpg' ) . '" alt="'.get_the_title().'">';
								}
							}
						?>
						</a>
						<?php if ( get_post_format( get_the_ID() ) == 'video' ) { ?>
						<div class="post-video-icon">
							<a href="<?php the_permalink(); ?>" class="video-play"><i class="fa fa-play"></i></a>
						</div>
						<?php } ?>
					</div>
					<div class="rtin-content">
						<?php if ( FoodcartTheme::$options['foodcart_recipe_blog_date'] ) { ?>
						<span class="rtin-date"><i class="fa fa-clock-o" aria-hidden="true"></i><?php echo get_the_date(); ?></span>
						<?php } ?>
						<h3><a href="<?php the_permalink();?>"><?php echo esc_html( $item_title );?></a></h3>
						<?php echo wp_kses_post( $content ); ?>
						<?php if ( FoodcartTheme::$options['foodcart_recipe_blog_cats'] || FoodcartTheme::$options['foodcart_recipe_blog_views'] && function_exists( 'foodcart_views' ) ) { ?>
						<div class="recipe-info">
							<?php if ( FoodcartTheme::$options['foodcart_recipe_blog_cats'] ) { ?>
							<span class="rtin-cat"><i class="fa fa-tags" aria-hidden="true"></i>
								<?php
									$i = 1;
									$term_lists = get_the_terms( get_the_ID(), 'foodcart_recipe_category' );
									if ( $term_lists && ! is_wp_error( $term_lists ) ) {
										foreach ( $term_lists as $term_list ){
											$link = get_term_link( $term_list->term_id, 'foodcart_recipe_category' ); ?><?php if ( $i > 1 ){ echo esc_html( ', ' ); } ?><a href="<?php echo esc_url( $link ); ?>"><?php echo esc_html( $term_list->name ); ?></a><?php $i++; }
									} ?>
							</span>
							<?php } ?>
							<?php if ( FoodcartTheme::$options['foodcart_recipe_blog_views'] && function_exists( 'foodcart_views' ) ) { ?>
							<span class="meta-views meta-item "><?php echo foodcart_views(); ?></span>
							<?php } ?>
						</div>
						<?php } ?>
					</div>
				</div>
			</div>		
			<?php } ?>
		<?php } ?>
	</div>
		<?php if ( $data['more_button'] == 'show' ) { ?>
			<?php if( !empty ( $data['see_button_text'] ) ) { ?>
			<div class="recipe-button col-12"><a class="foodcart-button-2" href="<?php echo esc_url( $data['see_button_link'] );?>"><?php echo esc_html( $data['see_button_text'] );?></a></div><?php } ?>
		<?php } else { ?>
			<?php FoodcartTheme_Helper::pagination(); ?>
		<?php } ?>
		<?php FoodcartTheme_Helper::wp_reset_temp_query( $temp ); ?>
</div>