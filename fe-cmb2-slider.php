<?php
/**
 * Plugin Name: Iron Code CMB2 Slider
 * Plugin URI: http://github.com/salcode/fe-cmb2-slider
 * Description: Create a Custom Post Type called fe_slider where each post is a slider. When the CMB2 plugin is active, each slider will have a repeatable field for adding slides. The slides can then be displayed in your theme.
 * Version: 0.1.0
 * Author: Sal Ferrarello
 * Author URI: http://salferrarello.com/
 * Minimum PHP: 5.3
 * Text Domain: fe-cmb2-slider
 * Domain Path: /languages
 *
 * @package IronCode\FeCmb2Slider
 */

namespace Ironcode\FeCmb2Slider;

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

if ( file_exists( __DIR__ . '/vendor/autoload.php' ) ) {
	require __DIR__ . '/vendor/autoload.php';
}

$plugin = new Plugin( __DIR__ );
$plugin->run();
