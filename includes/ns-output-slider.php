<?php
/**
 *
 * Slider oouput
 *
 * @package Slider oouput
 */

defined( 'ABSPATH' ) || die();

/**
 * Slider Output shortcode
 */
function nuno_sarmento_nsss_get_slider() {
  ?>

  <?php
  $slick_query = array( 'post_type' => 'nuno-sarmento-ss-cpt' );
  $query = new WP_Query( $slick_query );
  ?>

  <?php if ( $query->have_posts() ) : ?>

  <div class="slicky-slides">

  <?php while ( $query->have_posts() ) : $query->the_post(); ?>

  <div class="slicky-item">

  <div class="slicky-figure">

	<?php the_post_thumbnail( 'large' ); ?>

	<div class="slicky-caption">
			<?php the_content(); ?>
	</div>

	</div>

  </div>

	<?php endwhile; ?>

  </div>

	<?php
  endif;
  wp_reset_query();
  ?>

<?php

}

/**
 * Shortcode
 */
function nuno_sarmento_nsss_insert_slider() {

	ob_start();
		nuno_sarmento_nsss_get_slider();
	return ob_get_clean();

}
add_shortcode( 'slick_slider_ns', 'nuno_sarmento_nsss_insert_slider' );

/**
 * Template tag
 */
function nuno_sarmento_nsss_slider() {
  print nuno_sarmento_nsss_get_slider();
}
