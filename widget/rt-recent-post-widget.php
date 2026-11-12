<?php 
/**
* Widget API: Recent Post Widget class
* By : Radius Theme
*/
Class FoodcartTheme_Recent_Posts_With_Image_Widget extends WP_Widget {
	public function __construct() {
		$widget_ops = array(
			'classname' => 'rt_widget_recent_entries_with_image',
			'description' => esc_html__( 'Your site&#8217;s most recent Posts with Image.' , 'foodcart' ),
			'customize_selective_refresh' => true,
		);
		parent::__construct( 'rt-recent-posts', esc_html__( 'Foodcart : Recent Posts' , 'foodcart' ), $widget_ops );
		$this->alt_option_name = 'rt_widget_recent_entries';
	}
	public function widget( $args, $instance ) {
		if ( ! isset( $args['widget_id'] ) ) {
			$args['widget_id'] = $this->id;
		}
		
		$title = ( ! empty( $instance['title'] ) ) ? $instance['title'] : esc_html__( 'Recent Posts' , 'foodcart' );		
		$title = apply_filters( 'widget_title', $title, $instance, $this->id_base );
		$number = ( ! empty( $instance['number'] ) ) ? absint( $instance['number'] ) : 5;
		if ( ! $number )
			$number = 6;
		$show_date = isset( $instance['show_date'] ) ? $instance['show_date'] : false;
		$show_cat = isset( $instance['show_cat'] ) ? $instance['show_cat'] : true;
		$result_query = new WP_Query( apply_filters( 'widget_posts_args', array(
			'posts_per_page'      => $number,
			'no_found_rows'       => true,
			'post_status'         => 'publish',
			'ignore_sticky_posts' => true
		) ) );
		if ($result_query->have_posts()) :
		?>
		<?php echo wp_kses_post($args['before_widget']); ?>
		<?php if ( $title ) {
			echo wp_kses_post($args['before_title']) . $title . wp_kses_post($args['after_title']);
		} ?>
		<div class="row">
		<?php while ( $result_query->have_posts() ) : $result_query->the_post();
		?>
		
			<div class="col-lg-6 col-md-4 col-sm-6 col-6">
				<div class="topic-box">
					<?php if ( $show_cat ) { ?>
						<div class="post-date1">
							<span><?php echo esc_html( foodcart_get_primary_category()[0]->name ); ?></span>
						</div>
					<?php } ?>
					<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>" class="rt-wid-post-img">
						<?php
							if ( has_post_thumbnail() ){
								the_post_thumbnail( 'foodcart-size3', ['class' => 'media-object'] );
							} else {				
								?>
								<img class="rt-lazy" src="<?php echo esc_url( FOODCART_IMG_URL ); ?>noimage_375X300.jpg" alt="<?php the_title_attribute(); ?>">
						<?php
							}
						?>
					</a>
					<?php if ( $show_date ) { ?>
					<div class="posted-date"><i class="fa fa-clock-o" aria-hidden="true"></i><?php echo get_the_time( get_option( 'date_format' ) ); ?></div>
					<?php } ?>
					<h3 class="widget-recent-post-title">
						<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
					</h3>
				</div>
			</div>
		
		<?php endwhile; ?>
		</div>	
		<?php echo wp_kses_post($args['after_widget']); ?>
		<?php
		wp_reset_postdata();
		endif;
	}
	
	public function update( $new_instance, $old_instance ) {
		$instance 				= $old_instance;
		$instance['title'] 		= sanitize_text_field( $new_instance['title'] );
		$instance['number'] 	= (int) $new_instance['number'];
		$instance['show_date']  = isset( $new_instance['show_date'] ) ? (bool) $new_instance['show_date'] : false;
		$instance['show_cat']  = isset( $new_instance['show_cat'] ) ? (bool) $new_instance['show_cat'] : false;
		return $instance;
	}
	
	public function form( $instance ) {
	$title     = isset( $instance['title'] ) ? esc_attr( $instance['title'] ) : '';
	$number    = isset( $instance['number'] ) ? absint( $instance['number'] ) : 6;
	$show_date = isset( $instance['show_date'] ) ? (bool) $instance['show_date'] : false;
	$show_cat = isset( $instance['show_cat'] ) ? (bool) $instance['show_cat'] : false;
	?>
		<p><label for="<?php echo esc_attr( $this->get_field_id( 'title' )); ?>"><?php echo esc_html__( 'Title:' , 'foodcart' ); ?></label>
		<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' )); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' )); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" /></p>

		<p><label for="<?php echo esc_attr( $this->get_field_id( 'number' )); ?>"><?php esc_html_e( 'Number of posts to show:', 'foodcart' ); ?></label>
		<input class="tiny-text" id="<?php echo esc_attr( $this->get_field_id( 'number' )); ?>" name="<?php echo esc_attr( $this->get_field_name( 'number' )); ?>" type="number" step="1" min="1" value="<?php echo esc_attr( $number ); ?>" size="3" /></p>

		<p><input class="checkbox" type="checkbox"<?php checked( $show_date ); ?> id="<?php echo esc_attr( $this->get_field_id( 'show_date' )); ?>" name="<?php echo esc_attr( $this->get_field_name( 'show_date' )); ?>" />
		<label for="<?php echo esc_attr( $this->get_field_id( 'show_date' )); ?>"><?php esc_html_e( 'Display post date?', 'foodcart' ); ?></label></p>
		
		<p><input class="checkbox" type="checkbox"<?php checked( $show_cat ); ?> id="<?php echo esc_attr( $this->get_field_id( 'show_cat' )); ?>" name="<?php echo esc_attr( $this->get_field_name( 'show_cat' ) ); ?>" />
		<label for="<?php echo esc_attr( $this->get_field_id( 'show_cat' )); ?>"><?php esc_html_e( 'Display post category?', 'foodcart' ); ?></label></p>
	<?php
	}	
}