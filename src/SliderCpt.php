<?php
/**
 * Ironcode CMB2 SliderCpt.
 *
 * @package Ironcode\FeCmb2Slider
 */

namespace Ironcode\FeCmb2Slider;

/**
 * Ironcode CMB2 Slider plugin.
 */
class SliderCpt {

	const SLUG = 'fe_slider';

	public function hook_in() {
		add_action( 'init', array( $this, 'define' ) );
	}

	public function get_slug() {
		return SELF::SLUG;
	}

	public function define() {

		register_extended_post_type( $this->get_slug(), array(
			'exclude_from_search' => true,
			'publicly_queryable'  => false,
			'show_in_nav_menus'   => false,
			'supports'            => array( 'title' ),
			'menu_icon'           => 'dashicons-images-alt2',
		), array(
			'singular' => 'Slider',
			'plural'   => 'Sliders',
			'slug'     => 'sliders'
		));

	}
}
