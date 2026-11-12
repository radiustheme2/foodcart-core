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
$col_class = "col-lg-{$data['col_lg']} col-md-{$data['col_md']} col-sm-{$data['col_sm']} col-xs-{$data['col_xs']}";

?>
<div class="rtin-testimonial-grid rtin-<?php echo esc_attr( $data['theme'] );?>">
	<div class="row auto-clear">
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
				<div class="rtin-item media <?php echo esc_attr( $col_class );?>">
					<?php if ( $data['thumbs_display']  == 'yes' ) { ?>
						<?php if ( has_post_thumbnail() ) { ?>
							<div class="rtin-thumb"><?php the_post_thumbnail( 'thumbnail' );?></div>
						<?php } ?>
					<?php } ?>
					<div class="rtin-item-content media-body">
						<h3 class="rtin-title"><?php the_title();?></h3>
						<?php if ( $data['designation_display']  == 'yes' && $designation ) { ?>
							<h4 class="rtin-designation"><?php echo esc_html( $designation );?></h4>
						<?php } ?>
						<div class="rtin-content"><?php echo wp_kses_post( $content ); ?></div>
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
					</div>
				</div>
			<?php endwhile;?>
		<?php endif;?>
		<?php wp_reset_query();?>
	</div>
</div>