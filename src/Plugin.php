<?php
/**
 * Ironcode CMB2 Slider plugin.
 *
 * @package Ironcode\FeCmb2Slider
 */

namespace Ironcode\FeCmb2Slider;

/**
 * Ironcode CMB2 Slider plugin.
 */
class Plugin {

	protected $cpt;

	/**
	 * Path to the root folder of this plugin (ends with slash).
	 *
	 * @var string
	 */
	protected $path;

	/**
	 * URL to the root folder of this plugin (ends with slash).
	 *
	 * @var string
	 */
	protected $url;

	/**
	 * Usually this constructor is called with __DIR__ as the parameter from
	 * the main plugin file.
	 *
	 * @param string $plugin_dir_path The path to the root directory of this plugin.
	 */
	public function __construct( $plugin_dir_path = null ) {

		if ( ! $plugin_dir_path ) {
			// Default to parent directory of this file.
			$plugin_dir_path = dirname( __DIR__ );
		}

		$this->path = trailingslashit( $plugin_dir_path );
		$this->url = trailingslashit( plugins_url( '', $this->path . 'index.php' ) );
	}

	/**
	 * Run plugin.
	 */
	public function run() {
		$cpt = new SliderCpt();
		$cpt->hook_in();

		$shortcode = new Shortcode( $this->get_template_location() );
		$shortcode->register();

		if ( is_admin() ) {
			$cmb2 = new Cmb2Config( $cpt->get_slug() );
			$cmb2->hook_in();
		}
	}

	protected function get_template_location() {
		return $this->path . 'views/template.php';
	}
}
