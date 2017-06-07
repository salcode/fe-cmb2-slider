<?php
/**
 * Ironcode CMB2 Slider Shortcode.
 *
 * @package Ironcode\FeCmb2Slider
 */

namespace Ironcode\FeCmb2Slider;

/**
 * Ironcode CMB2 Slider Shortcode.
 */
class Shortcode {

	const TAG = 'fe_slider';

	protected $default_template_location;

	public function __construct( $default_template_location = '' ) {
		$this->default_template_location = $default_template_location;
	}

	public function register() {
		add_shortcode( self::TAG, array( $this, 'output' ) );
	}

	public function output( $atts = array() ) {
		$atts = ( empty( $atts ) ? array() : $atts );
		$atts = array_merge( array(
			'id' => 0,
		), $atts );
		
		return $this->get_markup( $atts['id'] );
	}

	public function get_markup( $post_id ) {

		$slider_id   = intval( $post_id );
		$slider_data = get_post_meta( $slider_id, 'fe_cmb2_slider_repeat_grp', true );

		$template_location = $this->get_template_location( $slider_id );

		ob_start();
		include( $template_location );
		return ob_get_clean();
	}

	protected function get_template_location( $slider_id ) {
		// Check for a template in theme with the slider ID.
		// e.g. `/wp-content/my-theme/fe-cmb2-slider/template-7.php`.
		$template_location = sprintf(
			get_stylesheet_directory() . '/fe-cmb2-slider/template-%s.php',
			intval( $slider_id )
		);
		if ( file_exists( $template_location ) ) {
			return $template_location;
		}

		// Check for generic template in theme.
		// e.g. `/wp-content/my-theme/fe-cmb2-slider/template.php`.
		$template_location = get_stylesheet_directory() . '/fe-cmb2-slider/templates.php';
		if ( file_exists( $template_location ) ) {
			return $template_location;
		}

		// Use plugin default template.
		return $this->default_template_location;
	}
}
