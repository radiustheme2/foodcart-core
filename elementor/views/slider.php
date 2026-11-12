<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */

namespace radiustheme\Foodcart_Core;

use FoodcartTheme;
use FoodcartTheme_Helper;

$slides = array();
$default_img = FoodcartTheme_Helper::get_img( 'noslider.jpg' );

foreach ( $data['slides'] as $slide ) {
	$slides[] = array(
		'id'           => 'slide-' . time().rand( 1, 99 ),
		'image'        => $slide['image']['url'] ? $slide['image']['url'] : $default_img,
		'title'        => $slide['title'],
		'subtitle'     => $slide['subtitle'],
		'subtitle_mob' => $slide['subtitle_mob'],
		'buttontext'   => $slide['buttontext'],
		'buttonurl'    => $slide['buttonurl'],
		'title_color'    => $slide['title_color'],
		'subtitle_color'    => $slide['subtitle_color'],
	);
}
$slideclass = 'rtin-odd';
?>
<div class="rt-el-slider">
	<div class="rt-nivoslider" data-settings='<?php echo json_encode(array(
		'effect'		=> $data['slider_effect'],
		'animSpeed' 	=> $data['slider_anim_speed'],
		'pauseTime' 	=> $data['slider_pause_time'],
		'directionNav' 	=> $data['slider_nav'] == 'yes' ? true : false,
		'controlNav'	=> $data['slider_dots'] == 'yes' ? true : false,
		'manualAdvance' => $data['slider_autoplay'] == 'yes' ? false : true,
	)) ?>'>
	
	<?php foreach ( $slides as $slide ): ?>
		<img src="<?php echo esc_url( $slide['image'] );?>" title="#<?php echo esc_attr( $slide['id'] );?>" />
	<?php endforeach; ?>
	</div>
	<?php foreach ( $slides as $slide ): ?>
		<div id="<?php echo esc_attr( $slide['id'] );?>" class="slider-direction">
			<div class="rtin-content <?php echo esc_attr( $slideclass );?>">
				<div class="rtin-content-inner">
					<div class="rtin-content-wrap">
						<?php if ( $slide['title'] ): ?>
							<div class="rtin-title" style="color:<?php echo wp_kses_post( $slide['title_color'] );?>"><?php echo wp_kses_post( $slide['title'] );?></div>
						<?php endif; ?>
						<?php if ( $slide['subtitle'] ): ?>
							<p class="rtin-subtitle" style="color:<?php echo wp_kses_post( $slide['subtitle_color'] );?>"><?php echo wp_kses_post( $slide['subtitle'] );?></p>
						<?php endif; ?>
						<?php if ( $slide['subtitle_mob'] ): ?>
							<p class="rtin-subtitle-mob"><?php echo wp_kses_post( $slide['subtitle_mob'] );?></p>
						<?php endif; ?>
						<?php if ( $slide['buttontext'] ): ?>
							<div class="rtin-btn"><a href="<?php echo esc_url( $slide['buttonurl'] );?>" class="rdtheme-button-slider"><?php echo wp_kses_post( $slide['buttontext'] );?></a></div>
						<?php endif; ?>
					</div>
				</div>
			</div>
		</div>
		<?php $slideclass = ( $slideclass == 'rtin-odd' ) ? 'rtin-even' : 'rtin-odd';?>
	<?php endforeach; ?>
</div>