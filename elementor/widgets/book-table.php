<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */

namespace radiustheme\Foodcart_Core;
use Elementor\Controls_Manager;

if ( ! defined( 'ABSPATH' ) ) exit;

class Book_Table extends Custom_Widget_Base {

	public function __construct( $data = [], $args = null ){
		$this->rt_name = esc_html__( 'Book Table', 'foodcart-core' );
		$this->rt_base = 'rt-book-table';
		parent::__construct( $data, $args );
	}

	public function rt_fields(){
		$fields = array(
			array(
				'mode'    => 'section_start',
				'id'      => 'sec_general',
				'label'   => esc_html__( 'General', 'foodcart-core' ),
			),
			array(
				'type'    => Controls_Manager::SELECT2,
				'id'      => 'align',
				'label'   => esc_html__( 'Item Align', 'foodcart-core' ),
				'options' => array(
					'left' => esc_html__( 'Align Left' , 'foodcart-core' ),
					'center' => esc_html__( 'Align Center', 'foodcart-core' ),
					'right' => esc_html__( 'Align right', 'foodcart-core' ),
				),
				'default' => 'center',
			),
			/*Book Item*/
			array(
				'type'    => Controls_Manager::REPEATER,
				'id'      => 'book_item_lists',
				'label'   => esc_html__( 'Add as many item as you want', 'foodcart-core' ),
				'fields'  => array(
					array(
						'type'    => Controls_Manager::TEXTAREA,
						'name'    => 'item_title',
						'label'   => esc_html__( 'Title', 'foodcart-core' ),
						'default' => esc_html__( 'Monday to Tuesday', 'foodcart-core' ),
					),
					array(
						'type'    => Controls_Manager::TEXTAREA,
						'name'    => 'item_text',
						'label'   => esc_html__( 'Text', 'foodcart-core' ),
						'default' => esc_html__( '09:00 am - 22:00 pm', 'foodcart-core' ),					
					),
				),
			),
			array(
				'type'    => Controls_Manager::TEXT,
				'id'    => 'button_text',
				'label'   => esc_html__( 'Button Text', 'foodcart-core' ),
				'default' => esc_html__( 'BOOK NOW', 'foodcart-core' ),
			),
			array(
				'type'    => Controls_Manager::TEXT,
				'id'    => 'button_url',
				'label'   => esc_html__( 'Button URL', 'foodcart-core' ),
				'placeholder' => 'https://your-link.com',
			),
			
			array(
				'mode' => 'section_end',
			),
		);
		return $fields;
	}

	protected function render() {
		$data = $this->get_settings();
		
		$template = 'book-table';

		return $this->rt_template( $template, $data );
	}
}