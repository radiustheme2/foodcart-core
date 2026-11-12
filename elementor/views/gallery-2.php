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

$thumb_size = 'foodcart-size9';

$title_limit = $data['post_title_length'];
$content = FoodcartTheme_Helper::get_current_post_content();
$content = wp_trim_words( $content, $data['count'] );

$post_sorting = $data['post_sorting'];
$post_ordering = $data['post_ordering'];
$args = array(
	'post_type'      => 'foodcart_gallery',
	'posts_per_page'   => $data['itemnumber'],
	'orderby'        => $post_sorting,
);

switch ( $data['post_ordering'] ) {
	case 'title':
	case 'menu_order':
	$args['order'] = 'ASC';
	break;
}

$posts = get_posts( $args );
$uniqueid = time() . rand( 1, 99 );
$gallery = array();
$cats    = array();

foreach ( $posts as $post ) {
	$thumb_size		  = 'foodcart-size' . rand( 7, 8 ) ;
	$cats_comma       = array();
	$img              = get_the_post_thumbnail_url( $post, $thumb_size );
	$terms            = get_the_terms( $post, 'foodcart_gallery_category' );
	$terms_html       = '';
	$terms_comma_html = '';
	

	foreach ( $terms as $term ) {
		$terms_html  .= " {$uniqueid}-{$term->slug}";
		$cats_comma[] = $term->name;
		
		if ( !isset( $cats[$term->slug] ) ) {
			$cats[$term->slug] = $term->name;
		}	
	}
	
	$gallery[] = array (
		'id'		 => $post->ID,
		'img'        => $img,
		'title'      => wp_trim_words($post->post_title, $title_limit, ''),
		'url'        => get_the_permalink( $post ),
		'cats'       => $terms_html,
		'cats_comma' => implode(", ", $cats_comma ),
		'content'    => $content,
	);
}

$query = new WP_Query( $args );
$temp = FoodcartTheme_Helper::wp_set_temp_query( $query );
$col_class = "col-lg-{$data['col_lg']} col-md-{$data['col_md']} col-sm-{$data['col_sm']} col-xs-{$data['col_xs']}";
?>
<div class="gallery-default rt-isotope-wrapper gallery-<?php echo esc_attr( $data['style'] ); ?> <?php if ( $data['all_button'] == 'hide' ) {?>hide-all<?php } ?>">
	<?php if ( $data['cat_tab_display'] == 'yes' ) { ?>
	<div class="text-center">
		<div class="rt-gallery-tab rt-isotope-tab">
			<?php if ( $data['all_button'] == 'show' ) {?>
				<a href="#" data-filter="*" class="current"><?php esc_html_e( 'All', 'zugan' );?></a>
			<?php } ?>
			<?php foreach ( $cats as $key => $value): ?>
				<?php $cat_filter = "{$uniqueid}-{$key}";?>
				<a href="#" data-filter=".<?php echo esc_attr( $cat_filter );?>"><?php echo esc_html( $value );?></a>
			<?php endforeach; ?>
		</div>
	</div>
	<?php } ?>
	<div class="row zoom-gallery rt-isotope-content">
		<?php
//echo '<pre>';
//print_r( $gallery );
		foreach ( $gallery as $gallery_each ) { ?>
			<div class="<?php echo esc_attr( $col_class . $gallery_each['cats'] );?>">
				<div class="rtin-item">
					<div class="item-img">
						<?php
							if ( !empty( $gallery_each['img'] )){ ?>
							<img src="<?php echo esc_url( $gallery_each['img'] ); ?>" alt="<?php echo esc_html( $gallery_each['title'] );?>" />
							<?php } else {
								if ( !empty( FoodcartTheme::$options['no_preview_image']['id'] ) ) {
									echo wp_get_attachment_image( FoodcartTheme::$options['no_preview_image']['id'], $thumb_size );
								} else {
									echo '<img class="wp-post-image" src="' . FoodcartTheme_Helper::get_img( 'noimage_630X517.jpg' ) . '" alt="'.get_the_title().'">';
								}
							}
						?>
					</div>
					<div class="rtin-content">
						<div class="item-wrap">
						<div class="item-info">
							<h3><a href="<?php echo esc_url( $gallery_each['url'] );?>"><?php echo esc_html( $gallery_each['title'] );?></a></h3>
							<?php if ( $data['cat_display']  == 'yes' ) { ?>
							<span class="rtin-cat">
								<?php
									$i = 1;
									$term_lists = get_the_terms( $gallery_each['id'], 'foodcart_gallery_category' );
									foreach ( $term_lists as $term_list ){
										$link = get_term_link( $term_list->term_id, 'foodcart_gallery_category' ); ?><?php if ( $i > 1 ){ echo esc_html( ', ' ); } ?><a href="<?php echo esc_url( $link ); ?>"><?php echo esc_html( $term_list->name ); ?></a><?php $i++; } ?>
							</span>
							<?php } ?>
						</div>
						<div class="item-btn-wrap">
						<?php //echo $gallery_each['id'] .' Lipu ' . wp_get_attachment_url( 856 ); ?>
							<a href="<?php echo wp_get_attachment_url( get_post_thumbnail_id( $gallery_each['id'] ) ); ?>" class="foodcart-popup-zoom img-popup-icon" title="<?php echo get_the_title(); ?>">
								<i class="fa fa-search-plus"></i>
							</a>
						</div>
						</div>
					</div>
					<?php if ( $data['content_display']  == 'yes' ) { ?>
						<div class="item-content"><?php echo esc_html( $gallery_each['content'] );?></div>
					<?php } ?>	
				</div>
			</div>
		<?php } ?>
		<?php if ( $data['button_display'] == 'yes' ) { ?>
		<?php if ( $data['more_button'] == 'show' ) { ?>
			<?php if( !empty ( $data['see_button_text'] ) ) { ?>
			<div class="recipe-button col-12"><a class="foodcart-button-2" href="<?php echo esc_url( $data['see_button_link'] );?>"><?php echo esc_html( $data['see_button_text'] );?></a></div><?php } ?>
		<?php } else { ?>
			<?php FoodcartTheme_Helper::pagination(); ?>
		<?php } ?>
		<?php } ?>
		<?php FoodcartTheme_Helper::wp_reset_temp_query( $temp ); ?>
	</div>
		
</div>