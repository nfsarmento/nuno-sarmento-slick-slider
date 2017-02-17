<?php
/*
Plugin Name: Nuno Sarmento Slick Slider
Description: Create a nice responsive slider using Slick Library.
Plugin URI: https://www.nuno-sarmento.com
Version: 1.0.1
Author: Nuno Sarmento
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
/*
Just add the shortcode [slick_slider_tend] in a post or page, or use the function <?php nuno_sarmento_nsss_slider(); ?> in your theme templates.
*/

defined('ABSPATH') or die('°_°’');

/* ------------------------------------------
// Constants ---------------------------
--------------------------------------------- */

/* Set constant path to the plugin directory. */
if ( ! defined( 'NUNO_SARMENTO_SLICK_SLIDER_PATH' ) ) {
	define( 'NUNO_SARMENTO_SLICK_SLIDER_PATH', plugin_dir_path( __FILE__ ) );
}

/* Set plugin name. */
if( ! defined( 'NUNO_SARMENTO_SLICK_SLIDER_NAME' ) ) {
	define( 'NUNO_SARMENTO_SLICK_SLIDER_NAME', 'Nuno Sarmento Slick Slider' );
}

/* Set plugin version constant. */
if( ! defined( 'NUNO_SARMENTO_SLICK_SLIDER_VERSION' ) ) {
	define( 'NUNO_SARMENTO_SLICK_SLIDER_VERSION', '1.0.1' );
}

/* ------------------------------------------
// Require the Custom post type -------------
--------------------------------------------- */

if ( ! @include( 'nuno-sarmento-nsss-slick-slider-cpt.php' ) ) {
	require_once( NUNO_SARMENTO_SLICK_SLIDER_PATH . 'includes/nuno-sarmento-nsss-slick-slider-cpt.php' );
}

/* ------------------------------------------
// Admin Settings        ---------------------
--------------------------------------------- */

if ( ! @include( 'nuno-sarmento-nsss-settings.php' ) ) {
	require_once( NUNO_SARMENTO_SLICK_SLIDER_PATH . 'admin/nuno-sarmento-nsss-settings.php' );
}


/* ------------------------------------------
// CSS EDITOR           ---------------------
--------------------------------------------- */

if ( ! @include( 'nuno-sarmento-api-to-post-functions.php' ) ) {
	require_once( NUNO_SARMENTO_SLICK_SLIDER_PATH . 'includes/nuno-sarmento-nsss-custom-css.php' );
}

/* ------------------------------------------
// Flush Rewrite ----------------------------
--------------------------------------------- */

register_activation_hook( __FILE__, 'nuno_sarmento_nsss_flush_rewrites' );

function nuno_sarmento_nsss_flush_rewrites() {
	nuno_sarmento_nsss_slick_custom_posts();
	flush_rewrite_rules();
}

register_deactivation_hook( __FILE__, 'flush_rewrite_rules' );

/* ------------------------------------------
// i18n -------------------------------------
--------------------------------------------- */

load_plugin_textdomain( 'nuno-sarmento-nsss-slick-slider', false, basename( dirname( __FILE__ ) ) . '/languages' );


/* ------------------------------------------
// Plugin Links Options ---------------------
--------------------------------------------- */

add_filter( 'plugin_action_links_' . plugin_basename(__FILE__), 'nuno_sarmento_nsss_plugin_settings_link' );

function nuno_sarmento_nsss_plugin_settings_link($links) {
	 $mylinks = array(
	 	'<a href="' . admin_url( 'edit.php?post_type=nuno-sarmento-ss-cpt&page=slick_slider' ) . '">'.__('Settings').'</a>',
	 	'<a href="' . admin_url( 'post-new.php?post_type=nuno-sarmento-ss-cpt' ) . '">'.__('Create the slides','nuno-sarmento-nsss-slick-slider').'</a>'
	 );
	return array_merge( $links, $mylinks );
}


/* ------------------------------------------
// Enqueue JS -------------------------------
--------------------------------------------- */

function nuno_sarmento_nsss_add_js() {
    if (!is_admin()) {
	    wp_enqueue_script( 'slick', plugins_url( 'assets/js/slick.min.js' , __FILE__ ), array('jquery'), '1.6', true);
	}
}
add_action('wp_enqueue_scripts', 'nuno_sarmento_nsss_add_js');




function nuno_sarmento_nsss_print_script() {

	/* ------------------------------------------
	//  Default values as vars ------------------
	--------------------------------------------- */

	$style = get_option('nuno_sarmento_nsss_style', 'false');

	$auto = get_option('nuno_sarmento_nsss_auto', 1);
	if ($auto) { $autook = 'true'; } else { $autook = 'false'; }

	$speed = get_option('nuno_sarmento_nsss_speed', 4000);
	if ($speed) { $speedok = $speed; } else { $speedok = 4000; }

	$arrows = get_option('nuno_sarmento_nsss_arrows', 1);
	if ($arrows) { $arrowsok = 'true'; } else { $arrowsok = 'false'; }

	$dots = get_option('nuno_sarmento_nsss_dots', 1);
	if ($dots) { $dotsok = 'true'; } else { $dotsok = 'false'; }

	$height = get_option('nuno_sarmento_nsss_height', 1);
	if ($height) { $heightok = 'true'; } else { $heightok = 'false'; }

	$slidestoshow = get_option('nuno_sarmento_nsss_slidestoshow', '3');
	if ($slidestoshow) { $slidestoshowok = $slidestoshow; } else { $slidestoshowok = '1'; }

	$slidestoscroll = get_option('nuno_sarmento_nsss_slidestoscroll', '3');
	if ($slidestoscroll) { $slidestoscrollok = $slidestoscroll; } else { $slidestoscrollok = '1'; }

	$infinite = get_option('nuno_sarmento_nsss_infinite', 1);
	if ($infinite) { $infiniteok = 'true'; } else { $infiniteok = 'false'; }

	print '
		<script>
		jQuery(document).ready(function() {
			jQuery(".slicky-slides").slick({
				autoplay: '.$autook.',
				autoplaySpeed: '.$speedok.',
				arrows: '.$arrowsok.',
				dots: '.$dotsok.',
				fade: '.$style.',
				adaptiveHeight: '.$heightok.',
				infinite: '.$infiniteok.',
				slidestoshow: '.$slidestoshowok.',
				slidestoscroll: '.$slidestoscrollok.'
			});
		});
		</script>
	';
}
add_action('wp_footer', 'nuno_sarmento_nsss_print_script', 100);

/* ------------------------------------------
// Enqueue CSS ------------------------------
--------------------------------------------- */

function nuno_sarmento_nsss_add_css() {

	wp_enqueue_style( 'wp-color-picker' );

	wp_register_style( 'slick', plugins_url( 'assets/css/slick.css' , __FILE__ ), array(), '1.6', false);
	wp_enqueue_style( 'slick' );

	wp_register_style( 'nuno-sarmento-nsss-css-slick', plugins_url( 'assets/css/slick-slider.css' , __FILE__ ), array(), '1.0',false);
	wp_enqueue_style( 'nuno-sarmento-nsss-css-slick' );

}
add_action('wp_enqueue_scripts', 'nuno_sarmento_nsss_add_css');


function nuno_sarmento_nsss_print_css() {

	$dotscolor = get_option('nuno_sarmento_nsss_dotscolor');
	if ($dotscolor) { $dotscolorok = $dotscolor; } else { $dotscolorok = '#000000'; }
	$arrowscolor = get_option('nuno_sarmento_nsss_arrowscolor');
	if ($arrowscolor) { $arrowscolorok = $arrowscolor; } else { $arrowscolorok = '#000000'; }

	print '<style>
		.slicky-slides .slick-prev:before, .slicky-slides .slick-next:before {
			color: '.$arrowscolorok.';
		}
		.slicky-slides .slick-dots li button:before,
		.slicky-slides .slick-dots li.slick-active button:before {
			color: '.$dotscolorok.';
		}
 </style>';

}

add_action('wp_head', 'nuno_sarmento_nsss_print_css', 100);


/* ------------------------------------------
// Slider Output ----------------------------
--------------------------------------------- */

function nuno_sarmento_nsss_get_slider() { ?>

  <?php $slick_query = array(
    'post_type' => 'nuno-sarmento-ss-cpt'
  );
    $query = new WP_Query($slick_query); ?>

    <?php if ($query->have_posts()) : ?>

	 	<div class="slicky-slides">

			 	<?php while ($query->have_posts()) : $query->the_post(); ?>

			      <div class="slicky-item">

					    <div class="slicky-figure">

							 	<?php the_post_thumbnail('large'); ?>


								<div class="slicky-caption">
									<?php the_content(); ?>
								</div>

								<?php //echo esc_html( get_post_meta( get_the_ID(), 'movie_director', true ) ); ?>

								<?php //echo esc_html( get_post_meta( get_the_ID(), 'movie_rating', true ) ); ?>

							</div>

			      </div>

				<?php endwhile; ?>

	    </div>

	<?php endif; wp_reset_query(); ?>

<?php }

/* ------------------------------------------
// Shortcode --------------------------------
--------------------------------------------- */

function nuno_sarmento_nsss_insert_slider() {

	ob_start();
		nuno_sarmento_nsss_get_slider();
	return ob_get_clean();

}
add_shortcode('slick_slider_tend', 'nuno_sarmento_nsss_insert_slider');

/* ------------------------------------------
// Template tag -----------------------------
--------------------------------------------- */

function nuno_sarmento_nsss_slider() {
  print nuno_sarmento_nsss_get_slider();
}

/* ------------------------------------------
// TinyMce Button for shortcode -------------
--------------------------------------------- */

add_action( 'init', 'nuno_sarmento_nsss_code_button' );

function nuno_sarmento_nsss_code_button() {
    add_filter( "mce_external_plugins", "nuno_sarmento_nsss_code_add_button" );
    add_filter( 'mce_buttons', 'nuno_sarmento_nsss_code_register_button' );
}
function nuno_sarmento_nsss_code_add_button( $plugin_array ) {
    $plugin_array['nuno_sarmento_nsss_codebutton'] = plugin_dir_url( __FILE__ ) . 'assets/js/shortcode.js';
    return $plugin_array;
}
function nuno_sarmento_nsss_code_register_button( $buttons ) {
    array_push( $buttons, 'codebutton' );
    return $buttons;

}
