<?php
/*
Plugin Name: Nuno Sarmento Slick Slider
Description: Create a nice responsive slider using Slick Library.
Plugin URI: https://en-gb.wordpress.org/plugins/nuno-sarmento-slick-slider/
Version: 1.0.3
Author: Nuno Morais Sarmento
Author URI: https://www.nuno-sarmento.com
Text Domain: nuno-sarmento-nsss-slick-slider
Domain Path: /languages
License:     GPL2


Nuno-Sarmento Slick Slider is free software: you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation, either version 2 of the License, or
any later version.

Nuno-Sarmento Slick Slider is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301, USA.

*/

/*Just add the shortcode [slick_slider_ns] in a post or page, or use the function <?php nuno_sarmento_nsss_slider(); ?> in your theme templates.*/

defined( 'ABSPATH' ) || die( '°_°’' );

/**
 * Constants
 */

/* Set constant path to the plugin includes. */
if ( ! defined( 'NUNO_SARMENTO_SLICK_SLIDER_PATH' ) ) {
	define( 'NUNO_SARMENTO_SLICK_SLIDER_PATH', plugin_dir_path( __FILE__ ) );
}

/* Set constant path to the plugin assets. */
if ( ! defined( 'NS_SLICK_SLIDER_ASSETS_PATH' ) ) {
	define( 'NS_SLICK_SLIDER_ASSETS_PATH', plugin_dir_url( __FILE__ ) );
}

/* Set plugin name. */
if ( ! defined( 'NUNO_SARMENTO_SLICK_SLIDER_NAME' ) ) {
	define( 'NUNO_SARMENTO_SLICK_SLIDER_NAME', 'Nuno Sarmento Slick Slider' );
}

/* Set plugin version constant. */
if ( ! defined( 'NUNO_SARMENTO_SLICK_SLIDER_VERSION' ) ) {
	define( 'NUNO_SARMENTO_SLICK_SLIDER_VERSION', '1.0.2' );
}

/**
 *Admin-Settings
 */
if ( ! @include( 'ns-slider-admin-options.php' ) ) {
	require_once( NUNO_SARMENTO_SLICK_SLIDER_PATH . 'admin/ns-slider-admin-options.php' );
}

/**
 *Plugins-List
 */
if ( ! @include( 'ns-slider-plugins-list.php' ) ) {
	require_once( NUNO_SARMENTO_SLICK_SLIDER_PATH . 'includes/ns-slider-plugins-list.php' );
}

/**
 *Slider-Settings
 */
if ( ! @include( 'ns-slider-settings.php' ) ) {
	require_once( NUNO_SARMENTO_SLICK_SLIDER_PATH . 'includes/ns-slider-settings.php' );
}

/**
 *Require the Custom post type
 */
if ( ! @include( 'ns-output-slider.php' ) ) {
	require_once( NUNO_SARMENTO_SLICK_SLIDER_PATH . 'includes/ns-output-slider.php' );
}

/**
 *Require the Custom post type
 */
if ( ! @include( 'ns-slick-slider-cpt.php' ) ) {
	require_once( NUNO_SARMENTO_SLICK_SLIDER_PATH . 'includes/ns-slick-slider-cpt.php' );
}

/**
 *CSS EDITOR
 */
if ( ! @include( 'ns-slider-custom-css.php' ) ) {
	require_once( NUNO_SARMENTO_SLICK_SLIDER_PATH . 'includes/ns-slider-custom-css.php' );
}

/**
 *Flush-Rewrite
 */
register_activation_hook( __FILE__, 'nuno_sarmento_nsss_flush_rewrites' );

/**
 * Flush Rewrite
 */
function nuno_sarmento_nsss_flush_rewrites() {
	nuno_sarmento_nsss_slick_custom_posts();
	flush_rewrite_rules();
}

register_deactivation_hook( __FILE__, 'flush_rewrite_rules' );

/**
 * Translations i18n
 */
load_plugin_textdomain( 'nuno-sarmento-nsss-slick-slider', false, basename( dirname( __FILE__ ) ) . '/languages' );
