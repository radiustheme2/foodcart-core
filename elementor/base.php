<?php
/**
 * @author  RadiusTheme
 * @since   1.0
 * @version 1.0
 */

namespace radiustheme\Foodcart_Core;

use Elementor\Widget_Base;
use Elementor\Group_Control_Typography;
use Elementor\Scheme_Base;
use Elementor\Scheme_Typography;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

abstract class Custom_Widget_Base extends Widget_Base {
	public $rt_name;
	public $rt_base;
	public $rt_category;
	public $rt_icon;
	public $rt_translate;

	public function __construct( $data = [], $args = null ) {
		$this->rt_category = FOODCART_CORE_THEME_PREFIX . '-widgets'; // Category /@dev
		$this->rt_icon     = 'fa fa-registered';
		parent::__construct( $data, $args );
	}

	abstract public function rt_fields();

	public function get_name() {
		return $this->rt_base;
	}

	public function get_title() {
		return $this->rt_name;
	}

	public function get_icon() {
		return $this->rt_icon;
	}

	public function get_categories() {
		return array( $this->rt_category );
	}

	protected function _register_controls() {
		$fields = $this->rt_fields();
		foreach ( $fields as $field ) {
			if ( isset( $field['mode'] ) && $field['mode'] == 'section_start' ) {
				$id = $field['id'];
				unset( $field['id'] );
				unset( $field['mode'] );
				$this->start_controls_section( $id, $field );
			}
			elseif ( isset( $field['mode'] ) && $field['mode'] == 'section_end' ) {
				$this->end_controls_section();
			}
			elseif ( isset( $field['mode'] ) && $field['mode'] == 'group' ) {
				$type = $field['type'];
				unset( $field['mode'] );
				unset( $field['type'] );
				$this->add_group_control( $type, $field );
			}
			else {
				$id = $field['id'];
				unset( $field['id'] );
				$this->add_control( $id, $field );
			}
		}
	}
	

	public function rt_template( $template, $data ) {
		$template_name = "/elementor-custom/views/{$template}.php";
		if ( file_exists( STYLESHEETPATH . $template_name ) ) {
			$file = STYLESHEETPATH . $template_name;
		}
		elseif ( file_exists( TEMPLATEPATH . $template_name ) ) {
			$file = TEMPLATEPATH . $template_name;
		}
		else {
			$file = __DIR__ . "/views/{$template}.php";
		}

		ob_start();
		include $file;
		echo ob_get_clean();
	}
}