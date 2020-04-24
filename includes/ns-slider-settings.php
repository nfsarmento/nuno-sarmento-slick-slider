<?php
/**
 *
 * Settings
 *
 * @package Settings
 */

defined( 'ABSPATH' ) || die();

/**
 * Plugin Links Options
 */
add_filter( 'plugin_action_links_' . plugin_basename(__FILE__), 'nuno_sarmento_nsss_plugin_settings_link' );

function nuno_sarmento_nsss_plugin_settings_link($links) {
	 $mylinks = array(
	 	'<a href="' . admin_url( 'edit.php?post_type=nuno-sarmento-ss-cpt&page=slick_slider' ) . '">'.__('Settings').'</a>',
	 	'<a href="' . admin_url( 'post-new.php?post_type=nuno-sarmento-ss-cpt' ) . '">'. __('Create the slides','nuno-sarmento-nsss-slick-slider').'</a>'
	 );
	return array_merge( $links, $mylinks );
}

/**
 * Enqueue CSS & Scripts
 */
function nuno_sarmento_nsss_add_css() {

	wp_enqueue_style( 'wp-color-picker' );

	wp_register_style('ns-css-slick',  NS_SLICK_SLIDER_ASSETS_PATH . 'assets/css/slick.css' );
	wp_enqueue_style('ns-css-slick');

	wp_enqueue_style( 'ns-custom-css-slick', NS_SLICK_SLIDER_ASSETS_PATH . 'assets/css/slick-slider.css' );
	wp_enqueue_style( 'ns-custom-css-slick' );

	wp_enqueue_script( 'ns-js-slick', NS_SLICK_SLIDER_ASSETS_PATH . 'assets/js/slick.min.js', array( 'jquery' ), '1.6', true);
	wp_enqueue_script( 'ns-js-slick' );


}
add_action('wp_enqueue_scripts', 'nuno_sarmento_nsss_add_css');


/**
 * Enqueue CSS plugin options
 */
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


/**
 * Enqueue JS plugin options
 */
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


/**
 * TinyMce Button for shortcode
 */
add_action( 'init', 'nuno_sarmento_nsss_code_button' );

function nuno_sarmento_nsss_code_button() {
    add_filter( "mce_external_plugins", "nuno_sarmento_nsss_code_add_button" );
    add_filter( 'mce_buttons', 'nuno_sarmento_nsss_code_register_button' );
}
function nuno_sarmento_nsss_code_add_button( $plugin_array ) {
    $plugin_array['nuno_sarmento_nsss_codebutton'] = NS_SLICK_SLIDER_ASSETS_PATH . 'assets/js/shortcode.js';
    return $plugin_array;
}
function nuno_sarmento_nsss_code_register_button( $buttons ) {
    array_push( $buttons, 'codebutton' );
    return $buttons;

}

/**
 * Remove Media Button on Slider CPT
 */
function ns_slider_cpt_remove_media_bt() {

	global $current_screen;
	// use 'post', 'page' or 'custom-post-type-name'
	if( 'nuno-sarmento-ss-cpt' === $current_screen->post_type ) remove_action('media_buttons', 'media_buttons');

}
add_action('admin_head','ns_slider_cpt_remove_media_bt');


/**
 * Add feature image slider info on slider CPT
 */
function ns_slider_feature_image_notice() {

	global $current_screen;

  if( 'nuno-sarmento-ss-cpt' === $current_screen->post_type ) {

      function add_content_after_editor() {
          global $post;
          $id = $post->ID;
          echo '<div class="postbox" style="background:#0074a2;color:#fff;margin-top:20px;"><div class="inside">';
          echo 'Remenber to add your slider image on "Feature Image" post option.';
          echo '</div></div>';
      }
      add_action( 'edit_form_after_title', 'add_content_after_editor' );
  }

}
add_action( 'admin_notices', 'ns_slider_feature_image_notice' );
