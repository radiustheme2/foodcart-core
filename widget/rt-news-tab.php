<?php 
/**
* Widget API: Recent Post Widget class
* By : Radius Theme
*/
Class FoodcartTheme_News_Tab extends WP_Widget {
	public function __construct() {
		$widget_ops = array(
			'classname' => 'rt-news-tab',
			'description' => esc_html__( 'News Tab Display Widget' , 'foodcart' ),
			'customize_selective_refresh' => true,
		);
		parent::__construct( 'rt-news-tab', esc_html__( 'Foodcart : Posts display Tab' , 'foodcart' ), $widget_ops );		
	}
	public function widget( $args, $instance ) {
		if ( ! isset( $args['widget_id'] ) ) {
			$args['widget_id'] = $this->id;
		}
		
		$title = ( !empty( $instance['title'] ) ) ? $instance['title'] : esc_html__( 'Recent Posts' , 'foodcart' );
		$title = apply_filters( 'widget_title', $title, $instance, $this->id_base );
		$number = ( ! empty( $instance['number'] ) ) ? absint( $instance['number'] ) : 6;
		if ( ! $number )
			$number = 6;
		$show_date = isset( $instance['show_date'] ) ? $instance['show_date'] : true;
		$show_cat = isset( $instance['show_cat'] ) ? $instance['show_cat'] : false;
		$show_comment = isset( $instance['show_comment'] ) ? $instance['show_comment'] : true;
		
		$select_style = ( !empty( $instance['select_style'] ) ) ? $instance['select_style'] : 'box-style-1';
		$bg_color_type = ( !empty( $instance['bg_color_type'] ) ) ? $instance['bg_color_type'] : 'light';
		$show_no_preview_img = ( !empty( $instance['show_no_preview_img'] ) ) ? $instance['show_no_preview_img'] : 'none';
		$tab_id = time() + rand(1, 1000);
		?>
		
		
		<?php echo wp_kses_post($args['before_widget']); ?>
		<?php if ( $title ) {
			echo wp_kses_post($args['before_title']) . $title . wp_kses_post($args['after_title']);
		} ?>

		<div class="item-box-light-md">
			<ul class="btn-tab item-inline2 block-xs nav nav-tabs" role="tablist">
				<li class="nav-item">
					<a href="#recent-<?php esc_html_e( $tab_id ); ?>" data-toggle="tab" aria-expanded="true" class="active"><?php esc_html_e('Recent', 'foodcart'); ?></a>
				</li>
				<li class="nav-item">
					<a href="#popular-<?php esc_html_e( $tab_id ); ?>" data-toggle="tab" aria-expanded="false"><?php esc_html_e( 'Popular', 'foodcart'); ?></a>
				</li>
				<li class="nav-item">
					<a href="#common-<?php esc_html_e( $tab_id ); ?>" data-toggle="tab" aria-expanded="false"><?php esc_html_e( 'Common', 'foodcart'); ?></a>
				</li>
			</ul>
			<div class="tab-content">
			
				<div role="tabpanel" class="tab-pane fade active show" id="recent-<?php esc_html_e( $tab_id ); ?>">
					<?php
						$recent_query = new WP_Query( apply_filters( 'widget_posts_args', array(
							'posts_per_page'      => $number,
							'no_found_rows'       => true,
							'post_status'         => 'publish',
							'ignore_sticky_posts' => true
						) ) );
					?>
					<?php if ( $recent_query->have_posts() ) { ?>						
					<?php
						while ( $recent_query->have_posts() ) {
						$recent_query->the_post();
					?>
					<?php if ( $select_style == 'box-style-1' ) { ?>						
						<div class="position-relative">
							<div class="media">
								<?php if ( has_post_thumbnail() ){ ?>
									<a class="tab-img-holder img-opacity-hover" href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">										
										<?php
											if ( has_post_thumbnail() ){
												the_post_thumbnail( 'foodcart-size3', ['class' => 'media-object'] );
											} else {
												if ( $show_no_preview_img == 'view' ) { ?>
													<img class="rt-lazy" src="<?php echo esc_url( FOODCART_IMG_URL ); ?>noimage_375X300.jpg" alt="<?php the_title_attribute(); ?>">
											<?php }
											}
										?>
									</a>
								<?php } ?>
								<div class="media-body">
									<h3 class="entry-title">
										<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
									</h3>
									<div class="post-date-dark">
										<ul>
											<?php if ( $show_date ) { ?>
											<li><i class="fa fa-clock-o" aria-hidden="true"></i><?php echo get_the_time( get_option( 'date_format' ) ); ?></li>
											<?php } if ( $show_cat ) { ?>
											<li><i class="fa fa-tag" aria-hidden="true"></i><?php
												$i = 1;
												$term_lists = get_the_terms( get_the_ID(), 'category' );
												foreach ( $term_lists as $term_list ){
													$link = get_term_link( $term_list->term_id, 'category' ); ?>
													<?php if ( $i > 1 ){ echo esc_html( ', ' ); } ?><a href="<?php echo esc_url( $link ); ?>"><?php echo esc_html( $term_list->name ); ?></a>
											<?php $i++; } ?></li>
											<?php } ?>
										</ul>
									</div>
								</div>
							</div>
						</div>
					<?php } else if ( $select_style == 'box-style-2' ) { ?>
					<?php }
					}
					wp_reset_postdata();
					}
					?>										
				</div>
				
				<div role="tabpanel" class="tab-pane fade" id="popular-<?php esc_html_e( $tab_id ); ?>">
					<?php
						$popular_query = new WP_Query( apply_filters( 'widget_posts_args', array(
							'posts_per_page'      => $number,
							'no_found_rows'       => true,
							'post_status'         => 'publish',
							'orderby'   		  => 'meta_value_num',
							'meta_key'  		  => 'foodcart_views',
							'ignore_sticky_posts' => true
						) ) );
					?>
					<?php
						if ( $popular_query->have_posts() ) {
						?>
						
						<?php
							while ( $popular_query->have_posts() ) {
							$popular_query->the_post();
					?>
					<?php if ( $select_style == 'box-style-1' ) { ?>						
						<div class="position-relative">
							<div class="media">
								<?php if ( has_post_thumbnail() ){ ?>
									<a class="tab-img-holder img-opacity-hover" href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
										<?php
											if ( has_post_thumbnail() ){
												the_post_thumbnail( 'foodcart-size3', ['class' => 'media-object'] );
											} else {
												if ( $show_no_preview_img == 'view' ) { ?>
													<img class="rt-lazy" src="<?php echo esc_url( FOODCART_IMG_URL ); ?>noimage_375X300.jpg" alt="<?php the_title_attribute(); ?>">
											<?php }
											}
										?>
									</a>
								<?php } ?>
								<div class="media-body">
									<h3 class="entry-title">
										<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
									</h3>
									<div class="post-date-dark">
										<ul>
											<?php if ( $show_date ) { ?>
											<li><i class="fa fa-clock-o" aria-hidden="true"></i><?php echo get_the_time( get_option( 'date_format' ) ); ?></li>
											<?php } if ( $show_cat ) { ?>
											<li><i class="fa fa-tag" aria-hidden="true"></i><?php
												$i = 1;
												$term_lists = get_the_terms( get_the_ID(), 'category' );
												foreach ( $term_lists as $term_list ){
													$link = get_term_link( $term_list->term_id, 'category' ); ?>
													<?php if ( $i > 1 ){ echo esc_html( ', ' ); } ?><a href="<?php echo esc_url( $link ); ?>"><?php echo esc_html( $term_list->name ); ?></a>
											<?php $i++; } ?></li>
											<?php } ?>
										</ul>
									</div>
								</div>
							</div>
						</div>
					<?php } else if ( $select_style == 'box_style_2' ) { ?>
					<?php }
					}
					wp_reset_postdata();
					}
					?>
				</div>
				
				<div role="tabpanel" class="tab-pane fade" id="common-<?php esc_html_e( $tab_id ); ?>">
				
					<?php
						$comment_query = new WP_Query( apply_filters( 'widget_posts_args', array(
							'posts_per_page'      => $number,
							'post_status'         => 'publish',
							'orderby'   		  => 'comment_count',
							'ignore_sticky_posts' => true
						) ) );
					?>
					<?php
						if ( $comment_query->have_posts() ) {
					?>						
						<?php
							while ( $comment_query->have_posts() ) {
							$comment_query->the_post();
					?>
					<?php if ( $select_style == 'box-style-1' ) { ?>						
						<div class="position-relative">
							<div class="media">
							<?php if ( has_post_thumbnail() ){ ?>
								<a class="tab-img-holder img-opacity-hover" href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">																			
									<?php
										if ( has_post_thumbnail() ){
											the_post_thumbnail( 'foodcart-size3', ['class' => 'media-object'] );
										} else {
											if ( $show_no_preview_img == 'view' ) { ?>
													<img class="rt-lazy" src="<?php echo esc_url( FOODCART_IMG_URL ); ?>noimage_375X300.jpg" alt="<?php the_title_attribute(); ?>">
											<?php }
										}
									?>
								</a>
							<?php } ?>
								<div class="media-body">
									<h3 class="entry-title">
										<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
									</h3>
									<div class="post-date-dark">
										<ul>
											<?php if ( $show_date ) { ?>
											<li><i class="fa fa-clock-o" aria-hidden="true"></i><?php echo get_the_time( get_option( 'date_format' ) ); ?></li>
											<?php } if ( $show_cat ) { ?>
											<li><i class="fa fa-tag" aria-hidden="true"></i><?php
												$i = 1;
												$term_lists = get_the_terms( get_the_ID(), 'category' );
												foreach ( $term_lists as $term_list ){
													$link = get_term_link( $term_list->term_id, 'category' ); ?>
													<?php if ( $i > 1 ){ echo esc_html( ', ' ); } ?><a href="<?php echo esc_url( $link ); ?>"><?php echo esc_html( $term_list->name ); ?></a>
											<?php $i++; } ?></li>
											<?php } ?>
										</ul>
									</div>
								</div>
							</div>
						</div>
					<?php } else if ( $select_style == 'box-style-2' ) { ?>
					<?php }
					}
					wp_reset_postdata();
					}
					?>
				</div>
				
			</div>
		</div>
		<?php echo wp_kses_post($args['after_widget']); ?>
	<?php	
	} 
	
	public function update( $new_instance, $old_instance ) {
		$instance 				  = $old_instance;
		$instance['title'] 		  = sanitize_text_field( $new_instance['title'] );
		$instance['number'] 	  = (int) $new_instance['number'];
		$instance['show_date']    = isset( $new_instance['show_date'] ) ? (bool) $new_instance['show_date'] : false;
		$instance['show_cat']     = isset( $new_instance['show_cat'] ) ? (bool) $new_instance['show_cat'] : false;
		$instance['show_comment'] = isset( $new_instance['show_comment'] ) ? (bool) $new_instance['show_comment'] : false;
		$instance['select_style'] = isset( $new_instance['select_style'] ) ? $new_instance['select_style'] : 'box-style-1';
		$instance['bg_color_type'] = isset( $new_instance['bg_color_type'] ) ? $new_instance['bg_color_type'] : 'light';
		$instance['show_no_preview_img'] = isset( $new_instance['show_no_preview_img'] ) ? $new_instance['show_no_preview_img'] : 'none';
		return $instance;
	}
	
	public function form( $instance ) {
		$title     = isset( $instance['title'] ) ? esc_attr( $instance['title'] ) : '';
		$number    = isset( $instance['number'] ) ? absint( $instance['number'] ) : 6;
		$show_date = isset( $instance['show_date'] ) ? (bool) $instance['show_date'] : false;
		$show_cat = isset( $instance['show_cat'] ) ? (bool) $instance['show_cat'] : false;
		$show_comment = isset( $instance['show_comment'] ) ? (bool) $instance['show_comment'] : false;
		$select_style = ( !empty( $instance['select_style'] ) ) ? $instance['select_style'] : 'box-style-1';
		$bg_color_type = ( !empty( $instance['bg_color_type'] ) ) ? $instance['bg_color_type'] : 'light';
		$show_no_preview_img = ( !empty( $instance['show_no_preview_img'] ) ) ? $instance['show_no_preview_img'] : 'none';
		?>
			<p><label for="<?php echo esc_attr( $this->get_field_id( 'title' )); ?>"><?php echo esc_html__( 'Title:' , 'foodcart' ); ?></label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' )); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' )); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" /></p>
			<p>
				<label for="<?php echo esc_attr( $this->get_field_id( 'show_no_preview_img' )); ?>"><?php esc_html_e( 'Show no preview image : ', 'foodcart' ); ?></label>
				<select name="<?php echo esc_attr( $this->get_field_name( 'show_no_preview_img' )); ?>">
					<option <?php if ( $show_no_preview_img == 'none' ) {  echo 'selected'; } ?> value="none"><?php esc_html_e( 'Hide' , 'foodcart' ); ?></option>
					<option <?php if ( $show_no_preview_img == 'view' ) {  echo 'selected'; } ?> value="view"><?php esc_html_e( 'Show' , 'foodcart' ); ?></option>
				</select>
			</p>
			<p><label for="<?php echo esc_attr( $this->get_field_id( 'number' )); ?>"><?php esc_html_e( 'Number of posts to show:', 'foodcart' ); ?></label>
			<input class="tiny-text" id="<?php echo esc_attr( $this->get_field_id( 'number' )); ?>" name="<?php echo esc_attr( $this->get_field_name( 'number' )); ?>" type="number" step="1" min="1" value="<?php echo esc_attr( $number); ?>" size="3" /></p>

			<p><input class="checkbox" type="checkbox"<?php checked( $show_date ); ?> id="<?php echo esc_attr( $this->get_field_id( 'show_date' )); ?>" name="<?php echo esc_attr( $this->get_field_name( 'show_date' )); ?>" />
			<label for="<?php echo esc_attr( $this->get_field_id( 'show_date' )); ?>"><?php esc_html_e( 'Display post date?', 'foodcart' ); ?></label></p>
			
			<p><input class="checkbox" type="checkbox"<?php checked( $show_cat ); ?> id="<?php echo esc_attr( $this->get_field_id( 'show_cat' )); ?>" name="<?php echo esc_attr( $this->get_field_name( 'show_cat' )); ?>" />
			<label for="<?php echo esc_attr( $this->get_field_id( 'show_cat' )); ?>"><?php esc_html_e( 'Display post category?', 'foodcart' ); ?></label></p>
			
			<p><input class="checkbox" type="checkbox"<?php checked( $show_comment ); ?> id="<?php echo esc_attr( $this->get_field_id( 'show_comment' )); ?>" name="<?php echo esc_attr( $this->get_field_name( 'show_comment' )); ?>" />
			<label for="<?php echo esc_attr( $this->get_field_id( 'show_comment' )); ?>"><?php esc_html_e( 'Display Number of post Comments?', 'foodcart' ); ?></label></p>
			
			<p>
				<label for="<?php echo esc_attr( $this->get_field_id( 'select_style' )); ?>"><?php esc_html_e( 'Select Box Style : ' , 'foodcart'); ?></label>
				<select name="<?php echo esc_attr( $this->get_field_name( 'select_style' )); ?>">
					<option <?php if ( $select_style == 'box-style-1' ) {  echo 'selected'; } ?> value="box-style-1"><?php esc_html_e( 'Style 1' , 'foodcart' ); ?></option>
					<option <?php if ( $select_style == 'box-style-2' ) {  echo 'selected'; } ?> value="box-style-2"><?php esc_html_e( 'Style 2' , 'foodcart' ); ?></option>
				</select>
			</p>
			<p>
				<label for="<?php echo esc_attr( $this->get_field_id( 'bg_color_type' )); ?>"><?php esc_html_e( 'Select Background Color Type : ', 'foodcart' ); ?></label>
				<select name="<?php echo esc_attr( $this->get_field_name( 'bg_color_type' )); ?>">
					<option <?php if ( $bg_color_type == 'light' ) {  echo 'selected'; } ?> value="light"><?php esc_html_e( 'Light' , 'foodcart' ); ?></option>
					<option <?php if ( $bg_color_type == 'dark' ) {  echo 'selected'; } ?> value="dark"><?php esc_html_e( 'Dark' , 'foodcart' ); ?></option>
				</select>
			</p>
		<?php
	}	
}