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

$foodcart_has_entry_meta  = ( FoodcartTheme::$options['blog_author_name'] || FoodcartTheme::$options['blog_comment_num'] || FoodcartTheme::$options['blog_cats'] ) ? true : false;

$thumb_size = 'foodcart-size3';

$args = array(
	'posts_per_page' => $data['itemlimit'],
	'cat'            => (int) $data['cat'],
	'orderby'        => $data['orderby'],
);


switch ( $data['orderby'] ) {
	case 'title':
	case 'menu_order':
	$args['order'] = 'ASC';
	break;
}


$query = new WP_Query( $args );
$temp = FoodcartTheme_Helper::wp_set_temp_query( $query );

$col_class = "col-lg-{$data['col_lg']} col-md-{$data['col_md']} col-sm-{$data['col_sm']} col-xs-{$data['col_xs']}";
?>
<div class="post-grid-2">
	<div class="row auto-clear">
	<?php if ( $query->have_posts() ) :?>
		<?php while ( $query->have_posts() ) : $query->the_post();?>
			<?php
			$content = FoodcartTheme_Helper::get_current_post_content();
			$content = wp_trim_words( $content, $data['count'], '' );
			$content = "<p>$content</p>";
			$title = wp_trim_words( get_the_title(), $data['title_count'], '' );
			
			$foodcart_comments_number = number_format_i18n( get_comments_number() );
			$foodcart_comments_html = $foodcart_comments_number < 2 ? esc_html__( 'Comment' , 'foodcart' ) : esc_html__( 'Comments' , 'foodcart' );
			$foodcart_comments_html = '('. $foodcart_comments_number . ') ' . $foodcart_comments_html;

			?>
			<div class="<?php echo esc_attr( $col_class );?>">
				<div class="rtin-single-post">
					<div class="rtin-img">
					<a href="<?php the_permalink(); ?>">
						<?php
							if ( has_post_thumbnail() ){
								the_post_thumbnail( $thumb_size );
							}
							else {
								if ( !empty( FoodcartTheme::$options['no_preview_image']['id'] ) ) {
									echo wp_get_attachment_image( FoodcartTheme::$options['no_preview_image']['id'], $thumb_size );
								}
								else {
									echo '<img class="wp-post-image" src="' . FoodcartTheme_Helper::get_img( 'noimage_450X330.jpg' ) . '" alt="'.get_the_title().'">';
								}
							}
						?>
					</a>
					</div>
					<div class="rtin-content">
						<?php if ( FoodcartTheme::$options['blog_date'] ) { ?>		
						<div class="blog-date"><?php echo get_the_date(); ?></div>
						<?php } ?>
						<h3 class="rtin-title"><a href="<?php the_permalink();?>"><?php echo esc_html( $title );?></a></h3>
						<?php if ( $foodcart_has_entry_meta ) { ?>
						<div class="post-meta">
							<ul>
								<?php if ( FoodcartTheme::$options['blog_author_name'] ) { ?>
								<li><i class="fa fa-user" aria-hidden="true"></i><?php the_author_posts_link(); ?></li>
								<?php } if ( FoodcartTheme::$options['blog_cats'] ) { ?>			
								<li><i class="fa fa-tag" aria-hidden="true"></i><?php echo the_category( ', ' );?></li>
								<?php } if ( FoodcartTheme::$options['blog_comment_num'] ) { ?>
								<li><i class="fa fa-comments" aria-hidden="true"></i><a href="<?php echo get_comments_link( get_the_ID() ); ?>"><?php echo esc_html( $foodcart_comments_html );?></a></li>
								<?php } ?>
							</ul>
						</div>
						<?php } ?>
						<?php echo wp_kses_post( $content );?>
					</div>
				</div>
			</div>
		<?php endwhile;?>
	</div>
	<?php endif;?>
	<?php FoodcartTheme_Helper::wp_reset_temp_query( $temp );?>
</div>