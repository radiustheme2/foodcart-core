<?php
function foodcart_post_share() {

	if( get_post_type() != 'page' ) { 

		$counter      = 0;
		$post_title   = htmlspecialchars( urlencode( html_entity_decode( esc_attr( get_the_title() ), ENT_COMPAT, 'UTF-8')), ENT_COMPAT, 'UTF-8');
		$share_class  = '';
		$button_class = '';
		$text_class   = '';
		
		# Post link ----------
		$post_link = get_permalink();
		
		# Buttons array ----------
		$share_buttons = array(

			'facebook-f' => array(
				'url'  => 'http://www.facebook.com/sharer.php?u='. $post_link,
				'text' => esc_html__( 'Facebook', 'foodcart' ),
			),

			'x-twitter' => array(
				'url'   => 'https://twitter.com/intent/tweet?text='. $post_title .'&amp;url='. $post_link, 
				'text'  => esc_html__( 'Twitter', 'foodcart' ),
			),

			'linkedin-in' => array(
				'url'   => 'http://www.linkedin.com/shareArticle?mini=true&amp;url='. $post_link .'&amp;title='. $post_title,
				'text'  => esc_html__( 'LinkedIn', 'foodcart' ),
			),

			'stumbleupon' => array(
				'url'   => 'http://www.stumbleupon.com/submit?url='. $post_link .'&amp;title='. $post_title,
				'text'  => esc_html__( 'StumbleUpon', 'foodcart' ),
			),

			'tumblr' => array(
				'url'   => 'http://www.tumblr.com/share/link?url='. $post_link .'&amp;name='. $post_title,
				'text'  => esc_html__( 'Tumblr', 'foodcart' ),
			),

			'pinterest-p' => array(
				'url'   => 'http://pinterest.com/pin/create/button/?url='. $post_link .'&amp;description='. $post_title .'&amp;media='. foodcart_post_img_src( 'foodcart-size1' ),
				'text'  => esc_html__( 'Pinterest', 'foodcart' ),
			),

			'reddit' => array(
				'url'   => 'http://reddit.com/submit?url='. $post_link .'&amp;title='. $post_title,
				'text'  => esc_html__( 'Reddit', 'foodcart' ),
			),
			
			'email' => array(
				'url'   => 'mailto:?subject='. $post_title .'&amp;body='. $post_link,
				'text'  => esc_html__( 'Share via Email' , 'foodcart' ),
				'icon'  => 'fa fa-envelope',
			),
			'print' => array(
				'url'   => '#',
				'text'  => esc_html__( 'Print', 'foodcart' ),
                'icon'  => 'fa-solid fa-print',
			),
		);

		$active_share_buttons = array();

		foreach ( $share_buttons as $network => $button ){
			
				$counter ++;
				$icon = empty( $button['icon'] ) ? 'fab fa-'.$network : $button['icon'];

				# Buttons Style 1 ----------
				if( empty( $share_style )){
					$button_class = '';
					$text_class   = 'screen-reader-text';

					if( $counter <= 2 ){
						$button_class = ' large-share-button';
						$text_class   = 'social-text';
					}
				}

				if( !isset( $button['out_desktop'] )){
					$button['url'] = esc_url( $button['url'] );
				}

				if( 'print' === $network ){
					$active_share_buttons[] = '<a href="'. $button['url'] .'" onclick="window.print(); return false;" class="'. $network.'-share-button' . $button_class .'"><span class="'. $icon .'"></span></a>';
				} else {
					$active_share_buttons[] = '<a href="'. $button['url'] .'" rel="external" target="_blank" class="'. $network.'-share-button' . $button_class .'"><span class="'. $icon .'"></span></a>';
				}
		}

		if( is_array( $active_share_buttons ) && ! empty( $active_share_buttons ) ){ ?>
			<div class="share-links <?php echo esc_attr( $share_class ) ?>">
				<?php echo implode( '', $active_share_buttons ); ?>
			</div>
		<?php
		}
		
	}
}
