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
			'id'       => 0,
			'template' => '',
		), $atts );
		
		return $this->get_markup( $atts['id'], $atts['template'] );
	}

	public function get_markup( $post_id, $template = '' ) {
		$slider_id   = intval( $post_id );
		$slider_data = get_post_meta( $slider_id, 'fe_cmb2_slider_repeat_grp', true );

		$template_location = $this->get_template_location( $slider_id, $template );

		ob_start();
		include( $template_location );
		return ob_get_clean();
	}

	protected function get_template_location( $slider_id, $template_suffix = '' ) {
		$template_suffix = sanitize_file_name( $template_suffix );

		$custom_template_locations = array(
			// Template in (child) theme with the slider ID.
			// e.g. `/wp-content/my-theme/fe-cmb2-slider/template-7.php`.
			get_stylesheet_directory() . '/fe-cmb2-slider/template-%s.php',

			// Check for generic template in (child) theme.
			// e.g. `/wp-content/my-theme/fe-cmb2-slider/template.php`.
			get_stylesheet_directory() . '/fe-cmb2-slider/template.php',
		);

		if ( $template_suffix ) {
			// A template suffix has been passed in.
			// Add templates using $template_suffix to the beginning of the $custom_template_locations.
			$custom_template_locations = array_merge(
				array(
					// Template in (child) theme with the slider ID and $template_suffix.
					// e.g. `/wp-content/my-theme/fe-cmb2-slider/template-my_home_slider-7.php`.
					get_stylesheet_directory() . '/fe-cmb2-slider/template-' . $template_suffix . '-%s.php',

					// Check for generic template in (child) theme.
					// e.g. `/wp-content/my-theme/fe-cmb2-slider/template-my_home_slider.php`.
					get_stylesheet_directory() . '/fe-cmb2-slider/template-' . $template_suffix . '.php',
				),
				$custom_template_locations
			);
		}

		$custom_template_locations_length = count( $custom_template_locations );

		for ( $i = 0; $i < $custom_template_locations_length; $i++ ) {

			$template_location = sprintf( $custom_template_locations[ $i ], intval( $slider_id ) );

			if ( file_exists( $template_location ) ) {
				return $template_location;
			}
		}

		// E.g. No valid custom template location was found.
		// Use plugin default template.
		return $this->default_template_location;
	}
}
