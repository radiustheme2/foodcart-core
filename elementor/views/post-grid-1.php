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

$foodcart_has_entry_meta  = ( ( !has_post_thumbnail() && FoodcartTheme::$options['blog_date'] ) || FoodcartTheme::$options['blog_author_name'] || FoodcartTheme::$options['blog_comment_num'] || FoodcartTheme::$options['blog_cats'] ) ? true : false;

$foodcart_has_entry_meta2  = ( FoodcartTheme::$options['blog_author_name'] || FoodcartTheme::$options['blog_comment_num'] || FoodcartTheme::$options['blog_cats'] ) ? true : false;

$thumb_size = 'foodcart-size7';

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
?>
<div class="post-grid-1">
	<?php if ( $query->have_posts() ) { ?>
		<?php 
		$i = 1;
		while ( $query->have_posts() ) : $query->the_post(); 
			$content = FoodcartTheme_Helper::get_current_post_content();
			$content = wp_trim_words( $content, $data['count'], '' );
			$content = "<p>$content</p>";
			$title = wp_trim_words( get_the_title(), $data['title_count'], '' );
			
			$foodcart_comments_number = number_format_i18n( get_comments_number() );
			$foodcart_comments_html = $foodcart_comments_number < 2 ? esc_html__( 'Comment' , 'foodcart' ) : esc_html__( 'Comments' , 'foodcart' );
			$foodcart_comments_html = '('. $foodcart_comments_number . ') ' . $foodcart_comments_html;
			
			$thumbnail = false;
			if ( has_post_thumbnail() ){
				$thumbnail = get_the_post_thumbnail( null, $thumb_size , array( 'class' => 'img-responsive' ) );
			}
			else {
				if ( !empty( FoodcartTheme::$options['no_preview_image']['id'] ) ) {
					$thumbnail = wp_get_attachment_image( FoodcartTheme::$options['no_preview_image']['id'], $thumb_size );
				}
				elseif ( !empty( FoodcartTheme::$options['no_preview_image']['url'] ) ) {
					$thumbnail = '<img class="wp-post-image" src="'. FOODCART_IMG_URL .'noimage_610X430.jpg" alt="'.get_the_title().'">';
				}
			}
		?>
		<div class="post-box">
			<div class="row no-gutters content-center">
				<?php if($i % 2 == 0): ?>
				<div class="col-lg-6 no-padding order2">
					<div class="post-content-holder">
						<div class="post-content">
							<div class="text-wrapper">
							<?php if ( FoodcartTheme::$options['blog_date'] ) { ?>
								<div class="blog-date"><?php echo get_the_date(); ?></div>
							<?php } ?>
							<h3 class="rtin-title"><a href="<?php the_permalink();?>"><?php echo esc_html( $title );?></a></h3>
							<?php if ( $foodcart_has_entry_meta2 ) { ?>
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
							<?php echo wp_kses_post( $content ); ?>
							</div>
						</div>
					</div>
				</div>
				<?php endif; ?>
				<div class="col-lg-6 no-padding">
					<div class="post-img-holder">
						<?php echo wp_kses_post( $thumbnail ); ?>
					</div>
				</div>
				<?php if($i % 2 != 0): ?>
				<div class="col-lg-6 no-padding order2">
					<div class="post-content-holder">
						<div class="post-content">
							<div class="text-wrapper">
							<?php if ( FoodcartTheme::$options['blog_date'] ) { ?>			
								<div class="blog-date"><?php echo get_the_date(); ?></div>
							<?php } ?>
							<h3 class="rtin-title"><a href="<?php the_permalink();?>"><?php echo esc_html( $title );?></a></h3>
							<?php if ( $foodcart_has_entry_meta2 ) { ?>
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
							<?php echo wp_kses_post( $content ); ?>
							</div>
						</div>
					</div>
				</div>
			<?php endif; ?>
			</div>
		</div> 
		<?php 
			$i++;
		endwhile;?>
		<?php wp_reset_query();?>
	<?php } else { ?>
		<div class="<?php echo esc_attr( $col_class ); ?>">
			<?php esc_html_e( 'No Post Found' , 'foodcart-core' ); ?>
		</div>
	<?php } ?>
</div>