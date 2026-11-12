<?php
$thumb_size = 'foodcart-size10';
?>
<div class="food-menu-box-layout4">

<?php	
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
		
	if ( $data['item_layout'] == 'grid' ) {
		$item_layout = "col-xl-6 col-12";
	} else {
		$item_layout = "col-xl-12 col-12";
	}
	
	if ( $data['cat_display'] == 'yes' ) { ?> 
	<ul class="nav nav-tabs" id="myTab" role="tablist">
		<?php
		
		foreach ( $data['category_list'] as $cat ) {
			$cats[] = array(
				'cat_multi_box' => $cat['cat_multi_box'],
			);
		}
		
		if ( !empty( $cats ) ) {
		//category
		$category_number = count( $cats );
		$y = 1;
			foreach ( $cats as $cat ) {
			if ( $cat['cat_multi_box'] != 0 ) {
		?>
            <li class="nav-item">
                <a class="<?php if ( $y == 1 ){ ?>active<?php } ?>" href="#related<?php echo esc_attr( $cat['cat_multi_box'] ); ?>" data-toggle="tab" aria-expanded="false"><?php
                $term = get_term( $cat['cat_multi_box'], 'product_cat');
                if ( $term && ! is_wp_error( $term ) ) {
                    echo esc_html( $term->name );
                }
                ?></a>
            </li>
		<?php } ?>	
	<?php $y++; } } ?>
	</ul>
	<?php } ?>
	<div class="tab-content" id="quantity-holder">	
		<?php
					
			if ( !empty( $cats ) ) {
			//category
			$category_number = count( $cats );
			$i = 1;
				foreach ( $cats as $cat ) {
				if ( $cat['cat_multi_box'] != 0 ) {
		?>
		<div class="tab-pane fade <?php if ( $i == 1 ){ ?>active show<?php } ?> " id="related<?php echo esc_attr( $cat['cat_multi_box'] ); ?>">
			<div class="row">
				<?php
					$args = array(
						'post_type' => 'product',
						'order' => $post_ordering,
						'orderby' => $post_sorting,
						'posts_per_page' => $number_of_post,
						'offset' 	 	 => $number_of_post_offset,
						'post__not_in'   => $p_ids,	
						'post_status'    => 'publish',
						'tax_query' => array(
							'relation' => 'AND',
							array(
								'taxonomy' => 'product_cat',
								'field'    => 'id',
								'terms'    => $cat['cat_multi_box'],
							),
							array(
								'taxonomy' => 'product_type',
								'field'    => 'slug',
								'terms'    => 'setmenu', 
							),
						),
					);
					
					$query = new WP_Query( $args );
					
					$temp = FoodcartTheme_Helper::wp_set_temp_query( $query );

					if ( $query->have_posts() ) {
						while ( $query->have_posts() ) {
						$query->the_post();				
						$excerpt = wp_trim_words(get_the_excerpt(), $content_limit, '');
						$product_title = wp_trim_words( get_the_title(), $title_limit, '' );
						
						global $product;
						global $woocommerce;
						$price_html = 'foodcart_product_price id="'. get_the_ID() .'"';
						$product_ids = get_post_meta(get_the_ID(), 'setmenu_products');
				?>
				<div class="<?php echo esc_attr( $item_layout ); ?>">
					<div class="foodmenu-content-box">
						<div class="item-content">
							<div class="menu-title">
								<h3 class="item-title"><a href="<?php the_permalink(); ?>"><?php echo wp_kses_post( $product_title ); ?></a></h3>
								<div class="item-price"><?php echo do_shortcode( '['. $price_html .']' ); ?></div>
							</div>
							<?php if ( !empty( $product_ids ) ) { ?>
								<div class="food-item">
									<ul>
										<?php
											$label  = apply_filters('add_to_cart_text', __('Add to cart', 'foodcart-core'));
											$currency = get_woocommerce_currency_symbol();
											foreach ( $product_ids as $product_id ) {
												$prod_id = wc_get_product( $product_id );
										?>
											<li><?php echo wp_kses_post( $prod_id->get_name() ); ?> <span> <?php echo wp_kses_post( $currency ); echo wp_kses_post( $prod_id->get_price() ); ?></span></li>
										<?php }  ?>
									</ul>
								</div>
							<?php } ?>
							<form action="<?php echo esc_url( $product->add_to_cart_url() ); ?>?add-to-cart=<?php echo esc_attr( $product->get_id()) ; ?>" class="cart quantity-holder" method="post" enctype='multipart/form-data'>
								<?php woocommerce_quantity_input(); ?>
								<div class="input-group-btn">
									<button class="quantity-btn quantity-plus" type="button">
										<i class="fa fa-plus" aria-hidden="true"></i>
									</button>
									<button class="quantity-btn quantity-minus" type="button">
										<i class="fa fa-minus" aria-hidden="true"></i>
									</button>
								</div>
								<button type="submit" data-quantity="1" data-product_id="<?php echo esc_attr( $product->get_id()) ; ?>"	class="button alt ajax_add_to_cart add_to_cart_button product_type_simple"><?php echo $label; ?></button>
							</form>
						</div>
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
					</div>
				</div>
				<?php } ?>
			<?php } ?>
			<?php FoodcartTheme_Helper::wp_reset_temp_query( $temp ); ?>
			</div>
		</div>				
		<?php } ?>	
	<?php $i++; } } ?>
		
	</div>
</div>