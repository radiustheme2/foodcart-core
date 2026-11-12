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

$args = array(
	'post_type'      => 'foodcart_team',
	'posts_per_page' => $data['number'],
	'orderby'        => $data['orderby'],
);

if ( !empty( $data['cat'] ) ) {
	$args['tax_query'] = array(
		array(
			'taxonomy' => 'foodcart_team_category',
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
?>

<div class="team-slider-default team-<?php echo esc_attr( $data['style'] );?>">
	<div class="slick-carousel slick-carousel-nav team-box-nav" data-slick='{
		"slidesToShow": 5,
		"slidesToShowTab": 3,
		"slidesToShowMobile": 3,
		"slidesToScroll": 1,
		"speed": 600,
		"autoplaySpeed": 2000,
		"dots": false,
		"arrows": true,
		"lazyLoad": "progressive",
		"pauseOnHover": true,
		"autoplay": false,
		"focusOnSelect": true,
		"centerMode": true,
		"adaptiveHeight": false,
		"rtl": false,
		"asNavFor": ".slick-carousel-content",
		"prevArrow": "<span class=\"slick-prev slick-navigation\"><i class=\"fa fa-angle-left\"></i></span>",
		"nextArrow": "<span class=\"slick-next slick-navigation\"><i class=\"fa fa-angle-right\"></i></span>"
		}'>
		<?php if ( $query->have_posts() ) { ?>
			<?php while ( $query->have_posts() ) : $query->the_post();?>
				<div class="nav-item">
					<?php
					if ( has_post_thumbnail() ){
						the_post_thumbnail( $thumb_size );
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
				</div>
			<?php endwhile;?>
		<?php } ?>
	</div>
	<div class="slick-carousel slick-carousel-content" data-slick='{
		"slidesToShow": 1,
		"slidesToShowTab": 1,
		"slidesToShowMobile": 1,
		"slidesToScroll": 1,
		"speed": 600,
		"autoplaySpeed": 2000,
		"dots": false,
		"arrows": false,
		"lazyLoad": "progressive",
		"pauseOnHover": true,
		"autoplay": false,
		"adaptiveHeight": false,
		"rtl": false,
		"asNavFor": ".slick-carousel-nav"
		}'>
		
		<?php if ( $query->have_posts() ) { ?>
			<?php while ( $query->have_posts() ) : $query->the_post();?>
				<?php
					$id            = get_the_id();
					$designation   = get_post_meta( $id, 'foodcart_team_designation', true );
					$socials       = get_post_meta( $id, 'foodcart_team_socials', true );
					$social_fields = FoodcartTheme_Helper::team_socials();
					if ( $data['contype'] == 'content' ) {
						$content = apply_filters( 'the_content', get_the_content() );
					}
					else {
						$content = apply_filters( 'the_excerpt', get_the_excerpt() );;
					}
					$content = wp_trim_words( $content, $data['count'], '' );
					$content = "<p>$content</p>";
				?>
				<div class="team-box-content">
				   <h3 class="rtin-title"><a href="<?php the_permalink();?>"><?php the_title();?></a></h3>
				   <?php if ( $designation && $data['designation_display']  == 'yes' ) { ?>
						<div class="rtin-designation"><?php echo esc_html( $designation );?></div>
					<?php } ?>
				   <?php if ( $data['content_display']  == 'yes' ) { ?>
						<?php echo wp_kses_post( $content );?>
					<?php } ?>	
				   <?php if ( !empty( $socials ) && $data['social_display']  == 'yes' ) { ?>
					<ul class="rtin-social">
						<?php foreach ( $socials as $key => $social ) { ?>
							<?php if ( !empty( $social ) ) { ?>
								<li><a target="_blank" href="<?php echo esc_url( $social );?>"><i class="fab <?php echo esc_attr( $social_fields[$key]['icon'] );?>" aria-hidden="true"></i></a></li>
							<?php } ?>
						<?php } ?>
					</ul>
				   <?php } ?>
				</div>
			<?php endwhile; ?>
		<?php } ?>
	</div>
</div>