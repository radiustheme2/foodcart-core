<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */

/**
* About Widget with Social for footer by FoodcartTheme
**/
class FoodcartTheme_Social_Widget extends WP_Widget {

	public function __construct() {
		$widget_ops = array(
			'classname' => 'rt_footer_social_widget',
			'description' => esc_html__( 'Foodcart : (For Footer) Social Link widget with Description' , 'foodcart' ),
			'customize_selective_refresh' => true,
		);
		parent::__construct( 'rt-about-social', esc_html__( 'Foodcart : Social Widget' , 'foodcart' ), $widget_ops );
		$this->alt_option_name = 'foodcart_about_widget';
	}

	public function widget( $args, $instance ){
		echo wp_kses_post( $args['before_widget'] );
		if ( ! empty( $instance['title'] ) ) {
			echo wp_kses_post( $args['before_title'] ) . apply_filters( 'widget_title', esc_html( $instance['title'] ) ) . wp_kses_post( $args['after_title'] );
		}
		?>
		<div class="rt-about-widget">
			<?php if( !empty( $instance['description'] ) ) { ?>
				<div class="footer-about"><?php echo wp_kses_post( $instance['description'] ); ?></div>
			<?php } ?>
			<ul class="footer-social">
				<?php
				if( !empty( $instance['facebook'] ) ){
					?><li><a href="<?php echo esc_url( $instance['facebook'] ); ?>" target="_blank"><i class="fab fa-facebook-f"></i></a></li><?php
				}
				if( !empty( $instance['twitter'] ) ){
					?><li><a href="<?php echo esc_url( $instance['twitter'] ); ?>" target="_blank"><i class="fab fa-x-twitter"></i></a></li><?php
				}
				if( !empty( $instance['linkedin'] ) ){
					?><li><a href="<?php echo esc_url( $instance['linkedin'] ); ?>" target="_blank"><i class="fab fa-linkedin-in"></i></a></li><?php
				}
				if( !empty( $instance['pinterest'] ) ){
					?><li><a href="<?php echo esc_url( $instance['pinterest'] ); ?>" target="_blank"><i class="fab fa-pinterest-p"></i></a></li><?php
				}
				if( !empty( $instance['skype'] ) ){
					?><li><a href="<?php echo esc_url( $instance['skype'] ); ?>" target="_blank"><i class="fab fa-skype"></i></a></li><?php
				}
				if( !empty( $instance['youtube'] ) ){
					?><li><a href="<?php echo esc_url( $instance['youtube'] ); ?>" target="_blank"><i class="fab fa-youtube"></i></a></li><?php
				}
				if( !empty( $instance['instagram'] ) ){
					?><li><a href="<?php echo esc_url( $instance['instagram'] ); ?>" target="_blank"><i class="fab fa-instagram"></i></a></li><?php
				}
				if( !empty( $instance['behance'] ) ){
					?><li><a href="<?php echo esc_url( $instance['behance'] ); ?>" target="_blank"><i class="fab fa-behance"></i></a></li><?php
				}
				if( !empty( $instance['dribbble'] ) ){
					?><li><a href="<?php echo esc_url( $instance['dribbble'] ); ?>" target="_blank"><i class="fab fa-dribbble"></i></a></li><?php
				}
				?>
			</ul>
		</div>

		<?php
		echo wp_kses_post( $args['after_widget'] );
	}

	public function update( $new_instance, $old_instance ){
		$instance                  = array();
		$instance['title']         = ( ! empty( $new_instance['title'] ) ) ? sanitize_text_field( $new_instance['title'] ) : '';
		$instance['description']   = ( ! empty( $new_instance['description'] ) ) ? wp_kses_post( $new_instance['description'] ) : '';
		$instance['facebook']      = ( ! empty( $new_instance['facebook'] ) ) ? sanitize_text_field( $new_instance['facebook'] ) : '';
		$instance['twitter']       = ( ! empty( $new_instance['twitter'] ) ) ? sanitize_text_field( $new_instance['twitter'] ) : '';
		$instance['linkedin']      = ( ! empty( $new_instance['linkedin'] ) ) ? sanitize_text_field( $new_instance['linkedin'] ) : '';
		$instance['pinterest']     = ( ! empty( $new_instance['pinterest'] ) ) ? sanitize_text_field( $new_instance['pinterest'] ) : '';
		$instance['skype']       = ( ! empty( $new_instance['skype'] ) ) ? sanitize_text_field( $new_instance['skype'] ) : '';
		$instance['youtube']      = ( ! empty( $new_instance['youtube'] ) ) ? sanitize_text_field( $new_instance['youtube'] ) : '';
		$instance['instagram']     = ( ! empty( $new_instance['instagram'] ) ) ? sanitize_text_field( $new_instance['instagram'] ) : '';
		$instance['behance']       = ( ! empty( $new_instance['behance'] ) ) ? sanitize_text_field( $new_instance['behance'] ) : '';
		$instance['dribbble']      = ( ! empty( $new_instance['dribbble'] ) ) ? sanitize_text_field( $new_instance['dribbble'] ) : '';
		return $instance;
	}

	public function form( $instance ){
		$defaults = array(
			'title'       => esc_html__( 'About Company' , 'foodcart' ),
			'description' => '',
			'facebook'    => '',
			'twitter'     => '',
			'skype'       => '',
			'youtube'     => '',
			'linkedin'    => '',
			'pinterest'   => '',
			'instagram'   => '',
			'behance'     => '',
			'dribbble'    => '',
			);
		$instance = wp_parse_args( (array) $instance, $defaults );

		$fields = array(
			'title'        => array(
				'label'    => esc_html__( 'Title', 'foodcart' ),
				'type'     => 'text',
				),
			'description'  => array(
				'label'    => esc_html__( 'Description', 'foodcart' ),
				'type'     => 'textarea',
				),
			'facebook'     => array(
				'label'    => esc_html__( 'Facebook URL', 'foodcart' ),
				'type'     => 'url',
				),
			'twitter'      => array(
				'label'    => esc_html__( 'Twitter URL', 'foodcart' ),
				'type'     => 'url',
				),
			'linkedin'     => array(
				'label'    => esc_html__( 'LinkedIn URL', 'foodcart' ),
				'type'     => 'url',
				),
			'pinterest'    => array(
				'label'    => esc_html__( 'Pinterest URL', 'foodcart' ),
				'type'     => 'url',
				),
			'skype'        => array(
				'label'    => esc_html__( 'Skype URL', 'foodcart' ),
				'type'     => 'url',
				),
			'youtube'      => array(
				'label'    => esc_html__( 'Youtube URL', 'foodcart' ),
				'type'     => 'url',
				),
			'instagram'    => array(
				'label'    => esc_html__( 'Instagram URL', 'foodcart' ),
				'type'     => 'url',
				),
			'behance'      => array(
				'label'    => esc_html__( 'Behance Plus URL', 'foodcart' ),
				'type'     => 'url',
				),
			'dribbble'     => array(
				'label'    => esc_html__( 'Dribbble Plus URL', 'foodcart' ),
				'type'     => 'url',
				),
			);
		
		RT_Widget_Fields::display( $fields, $instance, $this );
	}	
}