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

		$template_location = $this->get_template_location( $template );

		ob_start();
		include( $template_location );
		return ob_get_clean();
	}

	protected function get_template_location( $template_suffix = '' ) {

		// Insure $template_suffix is appropriate for use in a filename.
		$template_suffix = sanitize_file_name( $template_suffix );

		$custom_template_locations = array();

		if ( $template_suffix ) {
			// A template suffix has been passed in, we use it for our first custom template location.
			$custom_template_locations = array(
				// Check for custom template with suffix in (child) theme.
				// e.g. `/wp-content/my-theme/fe-cmb2-slider/template-home.php`.
				sprintf( get_stylesheet_directory() . '/fe-cmb2-slider/template-%s.php', $template_suffix ),
			);
		}

		// Check for generic custom template in (child) theme.
		$custom_template_locations[] = get_stylesheet_directory() . '/fe-cmb2-slider/template.php';

		$len = count( $custom_template_locations );

		for ( $i = 0; $i < $len; $i++ ) {

			$template_location = $custom_template_locations[ $i ];

			if ( file_exists( $template_location ) ) {
				return $template_location;
			}
		}

		// E.g. No valid custom template location was found.
		// Use plugin default template.
		return $this->default_template_location;
	}
}
