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

$args = array(
	'post_type'      => 'foodcart_testim',
	'posts_per_page' => $data['number'],
	'orderby'        => $data['orderby'],
);

if ( !empty( $data['cat'] ) ) {
	$args['tax_query'] = array(
		array(
			'taxonomy' => 'foodcart_testimonial_category',
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

$slider_nav_class = $data['slider_nav'] == 'yes' ? ' slider-nav-enabled' : '';
$slider_dot_class = $data['slider_dots'] == 'yes' ? ' slider-dot-enabled' : '';

?>
<div class="rtin-testimonial-1 rt-owl-nav-2 owl-wrap <?php echo esc_attr( $slider_nav_class ); ?><?php echo esc_attr( $slider_dot_class ); ?> rtin-<?php echo esc_attr( $data['theme'] );?>">
	<div class="owl-theme owl-carousel rt-owl-carousel" data-carousel-options="<?php echo esc_attr( $data['owl_data'] );?>">
		<?php if ( $query->have_posts() ) :?>
			<?php while ( $query->have_posts() ) : $query->the_post();?>
				<?php
				$id = get_the_id();
				$designation = get_post_meta( $id, 'foodcart_tes_designation', true );
				$content = FoodcartTheme_Helper::get_current_post_content();
				$content = wp_trim_words( $content, $data['count'], '' );
				$content = "<p>$content</p>";
				$ratting	 	= get_post_meta( $id, 'foodcart_tes_rating', true );
				$rest_testimonial_rating = 5- intval( $ratting ) ;
				?>
				<div class="rtin-item">
					<?php if ( $data['thumbs_display']  == 'yes' ) { ?>
					<?php if ( has_post_thumbnail() ) { ?>
						<div class="rtin-thumb"><?php the_post_thumbnail( 'thumbnail' );?></div>
					<?php } ?>
					<?php } ?>
					<h3 class="rtin-title"><?php the_title();?><?php if ( $data['designation_display']  == 'yes' && $designation ) { ?><span><?php echo esc_html( $designation );?></span><?php } ?></h3>
					<?php if ( $data['ratting_display']  == 'yes' ) { ?>
						<ul class="rating">
							<?php for ($i=0; $i < $ratting; $i++) { ?>
								<li class="star-rate"><i class="fa fa-star" aria-hidden="true"></i></li>
							<?php } ?>			
							<?php for ($i=0; $i < $rest_testimonial_rating; $i++) { ?>
								<li><i class="fa fa-star" aria-hidden="true"></i></li>
							<?php } ?>
						</ul>
					<?php } ?>
					<div class="rtin-content"><?php echo wp_kses_post( $content ); ?></div>
				</div>
			<?php endwhile;?>
		<?php endif;?>
		<?php wp_reset_query();?>
	</div>
</div>