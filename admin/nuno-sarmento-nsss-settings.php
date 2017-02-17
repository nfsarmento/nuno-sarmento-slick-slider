<?php defined('ABSPATH') or die();

/* ------------------------------------------
// Opptions page  --------------------------------
--------------------------------------------- */

add_action( 'admin_menu', 'nuno_sarmento_nsss_add_admin_menu' );
add_action( 'admin_init', 'nuno_sarmento_nsss_settings_init' );

function nuno_sarmento_nsss_add_admin_menu(  ) {

	add_submenu_page(
		'edit.php?post_type=nuno-sarmento-ss-cpt',
		'NS Slider Settings',
		'NS Slider Settings',
		'manage_options',
		'slick_slider',
		'nuno_sarmento_nsss_options_page'
	);

}

/* ------------------------------------------
// Setting init --------------------------------
--------------------------------------------- */

function nuno_sarmento_nsss_settings_init(  ) {

		add_settings_section(
			'nuno_sarmento_nsss_plugin_page_section',
			__( 'Slider Settings', 'nuno-sarmento-nsss-slick-slider' ),
			'nuno_sarmento_nsss_settings_section_callback',
			'nuno_sarmento_nsss_plugin_page'
		);

		//Style

		add_settings_field(
			'nuno_sarmento_nsss_style',
			__( 'Slide or Fade ?', 'nuno-sarmento-nsss-slick-slider' ),
			'nuno_sarmento_nsss_style_render',
			'nuno_sarmento_nsss_plugin_page',
			'nuno_sarmento_nsss_plugin_page_section'
		);
		register_setting( 'nuno_sarmento_nsss_plugin_page', 'nuno_sarmento_nsss_style' );

		//Autoplay

		add_settings_field(
			'nuno_sarmento_nsss_auto',
			__( 'Autoplay', 'nuno-sarmento-nsss-slick-slider' ),
			'nuno_sarmento_nsss_auto_render',
			'nuno_sarmento_nsss_plugin_page',
			'nuno_sarmento_nsss_plugin_page_section'
		);
		register_setting( 'nuno_sarmento_nsss_plugin_page', 'nuno_sarmento_nsss_auto' );

		//Transition

		add_settings_field(
			'nuno_sarmento_nsss_speed',
			__( 'Transition speed <br><br>2000 = 2 seconds <br>4000 = 4 seconds <br>6000 = 6 seconds', 'nuno-sarmento-nsss-slick-slider' ),
			'nuno_sarmento_nsss_speed_render',
			'nuno_sarmento_nsss_plugin_page',
			'nuno_sarmento_nsss_plugin_page_section'
		);
		register_setting( 'nuno_sarmento_nsss_plugin_page', 'nuno_sarmento_nsss_speed' );

		// Arrows and Dots

		add_settings_field(
			'nuno_sarmento_nsss_arrows',
			__( 'Navigation arrows', 'nuno-sarmento-nsss-slick-slider' ),
			'nuno_sarmento_nsss_arrows_render',
			'nuno_sarmento_nsss_plugin_page',
			'nuno_sarmento_nsss_plugin_page_section'
		);
		register_setting( 'nuno_sarmento_nsss_plugin_page', 'nuno_sarmento_nsss_arrows' );

		add_settings_field(
			'nuno_sarmento_nsss_arrowscolor',
			__( 'Arrows color', 'nuno-sarmento-nsss-slick-slider' ),
			'nuno_sarmento_nsss_arrowscolor_render',
			'nuno_sarmento_nsss_plugin_page',
			'nuno_sarmento_nsss_plugin_page_section'
		);
		register_setting( 'nuno_sarmento_nsss_plugin_page', 'nuno_sarmento_nsss_arrowscolor' );

		add_settings_field(
			'nuno_sarmento_nsss_dots',
			__( 'Pagination dots', 'nuno-sarmento-nsss-slick-slider' ),
			'nuno_sarmento_nsss_dots_render',
			'nuno_sarmento_nsss_plugin_page',
			'nuno_sarmento_nsss_plugin_page_section'
		);
		register_setting( 'nuno_sarmento_nsss_plugin_page', 'nuno_sarmento_nsss_dots' );

		add_settings_field(
			'nuno_sarmento_nsss_dotscolor',
			__( 'Dots color', 'nuno-sarmento-nsss-slick-slider' ),
			'nuno_sarmento_nsss_dotscolor_render',
			'nuno_sarmento_nsss_plugin_page',
			'nuno_sarmento_nsss_plugin_page_section'
		);

		register_setting( 'nuno_sarmento_nsss_plugin_page', 'nuno_sarmento_nsss_dotscolor' );


		//Height

		add_settings_field(
			'nuno_sarmento_nsss_height',
			__( 'Adaptive height', 'nuno-sarmento-nsss-slick-slider' ),
			'nuno_sarmento_nsss_height_render',
			'nuno_sarmento_nsss_plugin_page',
			'nuno_sarmento_nsss_plugin_page_section'
		);
		register_setting( 'nuno_sarmento_nsss_plugin_page', 'nuno_sarmento_nsss_height' );

		//Slides to show & Slides to scroll

		// add_settings_field(
		// 	'nuno_sarmento_nsss_slidestoshow',
		// 	__( 'Slides to show', 'nuno-sarmento-nsss-slick-slider' ),
		// 	'nuno_sarmento_nsss_slidestoshow_render',
		// 	'nuno_sarmento_nsss_plugin_page',
		// 	'nuno_sarmento_nsss_plugin_page_section'
		// );
		// register_setting( 'nuno_sarmento_nsss_plugin_page', 'nuno_sarmento_nsss_slidestoshow' );
		//
		// add_settings_field(
		// 	'nuno_sarmento_nsss_slidestoscroll',
		// 	__( 'Slides to scroll', 'nuno-sarmento-nsss-slick-slider' ),
		// 	'nuno_sarmento_nsss_slidestoscroll_render',
		// 	'nuno_sarmento_nsss_plugin_page',
		// 	'nuno_sarmento_nsss_plugin_page_section'
		// );
		// register_setting( 'nuno_sarmento_nsss_plugin_page', 'nuno_sarmento_nsss_slidestoscroll' );
		//
		// add_settings_field(
		// 	'nuno_sarmento_nsss_infinite',
		// 	__( 'Infinite', 'nuno-sarmento-nsss-slick-slider' ),
		// 	'nuno_sarmento_nsss_infinite_render',
		// 	'nuno_sarmento_nsss_plugin_page',
		// 	'nuno_sarmento_nsss_plugin_page_section'
		// );
		// register_setting( 'nuno_sarmento_nsss_plugin_page', 'nuno_sarmento_nsss_infinite' );


		// About Page register
		add_settings_section(
			'nuno_sarmento_nsss_plugin_page_section',
			'', // Title
			'ns_nsss_about_callback',
			'ns-nsss-setting-about'
		);

		// Sytem Report register
		add_settings_section(
			'nuno_sarmento_nsss_plugin_page_section',
			'', // Title
			'ns_nsss_snapshot_report_callback',
			'ns-nsss-setting-report'
		);

		// How to use register
		add_settings_section(
			'nuno_sarmento_nsss_plugin_page_section',
			'', // Title
			'ns_nsss_usage_callback',
			'ns-nsss-setting-usage'
		);

}

/* ------------------------------------------
// Style and Autoplay ----------------
--------------------------------------------- */

function nuno_sarmento_nsss_style_render(  ) {

	$options = get_option( 'nuno_sarmento_nsss_style', 'false' );
	?>
	<select name='nuno_sarmento_nsss_style'>
		<option value='false' <?php selected( $options, 'false' ); ?>>Slide</option>
		<option value='true' <?php selected( $options, 'true' ); ?>>Fade</option>
	</select>

<?php

}

function nuno_sarmento_nsss_auto_render(  ) {

	$options = get_option( 'nuno_sarmento_nsss_auto', 1 );
	?>
	<input type='checkbox' name='nuno_sarmento_nsss_auto' <?php checked( 1, $options, true ); ?> value='1'> <?php _e('Enable','nuno-sarmento-nsss-slick-slider'); ?>
	<?php
}

function nuno_sarmento_nsss_speed_render(  ) {

	$options = get_option( 'nuno_sarmento_nsss_speed', 4000 );
	?>
	<input type='text' name='nuno_sarmento_nsss_speed' value='<?php echo $options; ?>' placeholder='4000'>
	<?php
}

/* ------------------------------------------
// Arrows and Dots          ----------------
--------------------------------------------- */

function nuno_sarmento_nsss_arrows_render(  ) {

	$options = get_option( 'nuno_sarmento_nsss_arrows', 1 );
	?>
	<input type='checkbox' name='nuno_sarmento_nsss_arrows' <?php checked( 1, $options, true ); ?> value='1'> <?php _e('Enable','nuno-sarmento-nsss-slick-slider'); ?>
	<?php
}

function nuno_sarmento_nsss_arrowscolor_render(  ) {

	$options = get_option( 'nuno_sarmento_nsss_arrowscolor', '#000000' );
	?>
	<input type='text' name='nuno_sarmento_nsss_arrowscolor' value='<?php echo $options; ?>' class='tend-tdss-color-picker'>
	<?php
}

function nuno_sarmento_nsss_dots_render(  ) {

	$options = get_option( 'nuno_sarmento_nsss_dots', 1 );
	?>
	<input type='checkbox' name='nuno_sarmento_nsss_dots' <?php checked( 1, $options, true ); ?> value='1'> <?php _e('Enable','nuno-sarmento-nsss-slick-slider'); ?>
	<?php
}

function nuno_sarmento_nsss_dotscolor_render(  ) {

	$options = get_option( 'nuno_sarmento_nsss_dotscolor', '#000000' );
	?>
	<input type='text' name='nuno_sarmento_nsss_dotscolor' value='<?php echo $options; ?>' class='tend-tdss-color-picker'>
	<?php
}

/* ------------------------------------------
// Height    --------------------------------
--------------------------------------------- */

function nuno_sarmento_nsss_height_render(  ) {

	$options = get_option( 'nuno_sarmento_nsss_height', 1 );
	?>
	<input type='checkbox' name='nuno_sarmento_nsss_height' <?php checked( 1, $options, true ); ?> value='1'> <?php _e('Enable','nuno-sarmento-nsss-slick-slider'); ?>
	<?php
}

/* ------------------------------------------
// Slides to show & Slides to scroll --------
--------------------------------------------- */

function nuno_sarmento_nsss_slidestoshow_render(  ) {

	$options = get_option( 'nuno_sarmento_nsss_slidestoshow', 3 );
	?>
	<input type='text' name='nuno_sarmento_nsss_slidestoshow' value='<?php echo $options; ?>' placeholder='0'>
	<?php
}

function nuno_sarmento_nsss_slidestoscroll_render(  ) {

	$options = get_option( 'nuno_sarmento_nsss_slidestoscroll', 3 );
	?>
	<input type='text' name='nuno_sarmento_nsss_slidestoscroll' value='<?php echo $options; ?>' placeholder='0'>
	<?php
}

function nuno_sarmento_nsss_infinite_render(  ) {

	$options = get_option( 'nuno_sarmento_nsss_infinite', 1 );
	?>
	<input type='checkbox' name='nuno_sarmento_nsss_infinite' <?php checked( 1, $options, true ); ?> value='1'> <?php _e('Enable','nuno-sarmento-nsss-slick-slider'); ?>
	<?php
}


/* ------------------------------------------
// Settings section callback-----------------
--------------------------------------------- */

function nuno_sarmento_nsss_settings_section_callback(  ) {

	echo __( 'Choose options to customize your slider.', 'nuno-sarmento-nsss-slick-slider' );

}

/* ------------------------------------------
// The Admin page--------------------------------
--------------------------------------------- */

function nuno_sarmento_nsss_options_page() {

	if ( !current_user_can( 'manage_options' ) )  {
		wp_die( __( 'You do not have sufficient permissions to access this page.' ) );
	}
	$usage_Screen = ( isset( $_GET['action'] ) && 'usage' == $_GET['action'] ) ? true : false;
	$about_Screen = ( isset( $_GET['action'] ) && 'about' == $_GET['action'] ) ? true : false;
  $report_Screen = ( isset( $_GET['action'] ) && 'report' == $_GET['action'] ) ? true : false;
	?>

<style media="screen">
.header__ns_nsss:after { content: " "; display: block; height: 29px; width: 15%; position: absolute;
	top: 3%; right: 25px; background-image: url(//ps.w.org/nuno-sarmento-social-icons/assets/icon-128x128.png?rev=1588574); background-size:128px 128px; height: 128px; width: 128px;
}
.header__ns_nsss{ background: white; height: 150px; width: 100%; float: left;}
.header__ns_nsss h2 {padding: 35px;font-size: 27px;}
@media only screen and (max-width: 480px) {
	.header__ns_nsss:after { content: " "; display: block; height: 29px; width: 15%; position: absolute;
		top: 6%; right: 25px; background-image: url(//ps.w.org/nuno-sarmento-social-icons/assets/icon-128x128.png?rev=1588574); background-size:50px 50px; height: 50px; width: 50px;
	}
}
</style>

	<div class="wrap">
		<div class="header__ns_nsss">
			<h2><?php echo NUNO_SARMENTO_SLICK_SLIDER_NAME; ?></h2>
		</div>

		<h2 class="nav-tab-wrapper">
			<a href="<?php echo admin_url( 'admin.php?page=slick_slider' ); ?>" class="nav-tab<?php if ( ! isset( $_GET['action'] ) || isset( $_GET['action'] ) && 'about' != $_GET['action']  && 'report' != $_GET['action'] ) echo ' nav-tab-active'; ?>"><?php esc_html_e( 'Settings' ); ?></a>
			<a href="<?php echo esc_url( add_query_arg( array( 'action' => 'usage' ), admin_url( 'admin.php?page=nuno-sarmento-ss-cpt&page=slick_slider' ) ) ); ?>" class="nav-tab<?php if ( $usage_Screen ) echo ' nav-tab-active'; ?>"><?php esc_html_e( 'How to use' ); ?></a>
			<a href="<?php echo esc_url( add_query_arg( array( 'action' => 'about' ), admin_url( 'admin.php?page=nuno-sarmento-ss-cpt&page=slick_slider' ) ) ); ?>" class="nav-tab<?php if ( $about_Screen ) echo ' nav-tab-active'; ?>"><?php esc_html_e( 'Other Plugins' ); ?></a>
			<a href="<?php echo esc_url( add_query_arg( array( 'action' => 'report' ), admin_url( 'admin.php?page=nuno-sarmento-ss-cpt&page=slick_slider' ) ) ); ?>" class="nav-tab<?php if ( $report_Screen ) echo ' nav-tab-active'; ?>"><?php esc_html_e( 'System Report' ); ?></a>
		</h2>

	 <form method="post" action="options.php">
		 <?php

		 if($usage_Screen) {
			 settings_fields( 'ns_nsss_usage' );
			 do_settings_sections( 'ns-nsss-setting-usage' );

		 }elseif($about_Screen) {
				settings_fields( 'ns_nsss_about' );
				do_settings_sections( 'ns-nsss-setting-about' );

			}elseif($report_Screen) {
				settings_fields( 'ns_nsss_report' );
				do_settings_sections( 'ns-nsss-setting-report' );

			}else {
				settings_fields( 'nuno_sarmento_nsss_plugin_page' );
				do_settings_sections( 'nuno_sarmento_nsss_plugin_page' );
				submit_button();
			}
		?>
	</form>

	<?php
}


function ns_nsss_about_callback() {
	if ( !current_user_can( 'manage_options' ) )  {
		wp_die( __( 'You do not have sufficient permissions to access this page.' ) );
	} ?>

	 <h1>'Nuno Sarmento' Plugins Colection</h1>

				<div class="wrap">

							<p class="clear"></p>

							<div class="plugin-group">

							<div class="plugin-card">

								 <div class="plugin-card-top">

										 <a href="https://en-gb.wordpress.org/plugins/nuno-sarmento-slick-slider/" class="plugin-icon" target="_blank">
										 	 <style type="text/css">#plugin-icon-nuno-sarmento-slick-slider { width:128px; height:128px; background-image: url(//ps.w.org/nuno-sarmento-slick-slider/assets/icon-128x128.png?rev=1588561); background-size:128px 128px; }@media only screen and (-webkit-min-device-pixel-ratio: 1.5) { #plugin-icon-nuno-sarmento-slick-slider { background-image: url(//ps.w.org/nuno-sarmento-slick-slider/assets/icon-256x256.png?rev=1588561); } }</style>
											 <div class="plugin-icon" id="plugin-icon-nuno-sarmento-slick-slider" style="float:left; margin: 3px 6px 6px 0px;"></div>
										 </a>

										 <div class="name column-name" style="float: right;">
										    <h4><a href="https://en-gb.wordpress.org/plugins/nuno-sarmento-slick-slider/" target="_blank">Nuno Sarmento Slick Slider</a></h4>
									 	 </div>

								</div>

								<div class="plugin-card-bottom">
									<p class="authors"><cite>By: <a href="//profiles.wordpress.org/nunosarmento/" target="_blank">Nuno Morais Sarmento</a>.</cite></p>
								</div>

							</div>

							<div class="plugin-card">

								 <div class="plugin-card-top">

										 <a href="https://en-gb.wordpress.org/plugins/nuno-sarmento-custom-css-js/" class="plugin-icon" target="_blank">
										 	 <style type="text/css">#plugin-icon-nuno-sarmento-custom-css-js { width:128px; height:128px; background-image: url(//ps.w.org/nuno-sarmento-custom-css-js/assets/icon-128x128.png?rev=1588566); background-size:128px 128px; }@media only screen and (-webkit-min-device-pixel-ratio: 1.5) { #plugin-icon-nuno-sarmento-custom-css-js { background-image: url(//ps.w.org/nuno-sarmento-custom-css-js/assets/icon-256x256.png?rev=1588566); } }</style>
											 <div class="plugin-icon" id="plugin-icon-nuno-sarmento-custom-css-js" style="float:left; margin: 3px 6px 6px 0px;"></div>
										 </a>

										 <div class="name column-name" style="float: right;">
										 		<h4><a href="https://en-gb.wordpress.org/plugins/nuno-sarmento-custom-css-js/" target="_blank">Nuno Sarmento Custom CSS - JS</a></h4>
									 	 </div>

								</div>

								<div class="plugin-card-bottom">
									<p class="authors"><cite>By: <a href="//profiles.wordpress.org/nunosarmento/" target="_blank">Nuno Morais Sarmento</a>.</cite></p>
								</div>

							</div>

							<div class="plugin-card">

								 <div class="plugin-card-top">

										 <a href="https://en-gb.wordpress.org/plugins/nuno-sarmento-social-icons/" class="plugin-icon" target="_blank">
											 <style type="text/css">#plugin-icon-nuno-sarmento-social-icons { width:128px; height:128px; background-image: url(//ps.w.org/nuno-sarmento-social-icons/assets/icon-128x128.png?rev=1588574); background-size:128px 128px; }@media only screen and (-webkit-min-device-pixel-ratio: 1.5) { #plugin-icon-nuno-sarmento-social-icons { background-image: url(//ps.w.org/nuno-sarmento-social-icons/assets/icon-256x256.png?rev=1588574); } }</style>
											 <div class="plugin-icon" id="plugin-icon-nuno-sarmento-social-icons" style="float:left; margin: 3px 6px 6px 0px;"></div>
										 </a>

										 <div class="name column-name" style="float: right;">
										 		<h4><a href="https://en-gb.wordpress.org/plugins/nuno-sarmento-social-icons/" target="_blank">Nuno Sarmento Social Icons</a></h4>
									 	 </div>

								</div>

								<div class="plugin-card-bottom">
									<p class="authors"><cite>By: <a href="//profiles.wordpress.org/nunosarmento/" target="_blank">Nuno Morais Sarmento</a>.</cite></p>
								</div>

							</div>

							<div class="plugin-card">

								 <div class="plugin-card-top">

									 <a href="https://en-gb.wordpress.org/plugins/nuno-sarmento-page-builder/" class="plugin-icon" target="_blank">
									 	  <style type="text/css">#plugin-icon-nuno-sarmento-page-builder { width:128px; height:128px; background-image: url(//ps.w.org/nuno-sarmento-page-builder/assets/icon-128x128.png?rev=1588552); background-size:128px 128px; }@media only screen and (-webkit-min-device-pixel-ratio: 1.5) { #plugin-icon-nuno-sarmento-page-builder { background-image: url(//ps.w.org/nuno-sarmento-page-builder/assets/icon-256x256.png?rev=1588552); } }</style>
									 	  <div class="plugin-icon" id="plugin-icon-nuno-sarmento-page-builder" style="float:left; margin: 3px 6px 6px 0px;"></div>
								 	 </a>

									 <div class="name column-name" style="float: right;">
									 <h4><a href="https://en-gb.wordpress.org/plugins/nuno-sarmento-page-builder/" target="_blank">Nuno Sarmento Page Builder</a></h4>

								 </div>

								</div>

								<div class="plugin-card-bottom">
									<p class="authors"><cite>By: <a href="//profiles.wordpress.org/nunosarmento/" target="_blank">Nuno Morais Sarmento</a>.</cite></p>
								</div>

							</div>

							<div class="plugin-card">

								 <div class="plugin-card-top">

										 <a href="https://en-gb.wordpress.org/plugins/nuno-sarmento-popup/" class="plugin-icon" target="_blank">
											 <style type="text/css">#plugin-icon-nuno-sarmento-popup { width:128px; height:128px; background-image: url(//ps.w.org/nuno-sarmento-popup/assets/icon-128x128.png?rev=1593940); background-size:128px 128px; }@media only screen and (-webkit-min-device-pixel-ratio: 1.5) { #plugin-icon-nuno-sarmento-popup { background-image: url(//ps.w.org/nuno-sarmento-popup/assets/icon-256x256.png?rev=1593940); } }</style>
											 <div class="plugin-icon" id="plugin-icon-nuno-sarmento-popup" style="float:left; margin: 3px 6px 6px 0px;"></div>
										 </a>

										 <div class="name column-name" style="float: right;">
										    <h4><a href="https://en-gb.wordpress.org/plugins/nuno-sarmento-popup/" target="_blank" >Nuno Sarmento PopUp</a></h4>
									   </div>

								</div>

								<div class="plugin-card-bottom">
									<p class="authors"><cite>By: <a href="//profiles.wordpress.org/nunosarmento/" target="_blank">Nuno Morais Sarmento</a>.</cite></p>
								</div>

						 </div>


						 <div class="plugin-card">

						 	 <div class="plugin-card-top">

						 		 <a href="https://en-gb.wordpress.org/plugins/nuno-sarmento-api-to-post/" class="plugin-icon">
									 <style type="text/css">#plugin-icon-nuno-sarmento-api-to-post { width:128px; height:128px; background-image: url(//ps.w.org/nuno-sarmento-api-to-post/assets/icon-128x128.png?rev=1594469); background-size:128px 128px; }@media only screen and (-webkit-min-device-pixel-ratio: 1.5) { #plugin-icon-nuno-sarmento-api-to-post { background-image: url(//ps.w.org/nuno-sarmento-api-to-post/assets/icon-256x256.png?rev=1594469); } }</style>
									 <div class="plugin-icon" id="plugin-icon-nuno-sarmento-api-to-post" style="float:left; margin: 3px 6px 6px 0px;"></div>
							 	 </a>

						 		 <div class="name column-name">
						 			 <h4><a href="https://en-gb.wordpress.org/plugins/nuno-sarmento-api-to-post/">Nuno Sarmento API To Post</a></h4>
						 		 </div>

						 	</div>

							<div class="plugin-card-bottom">
								<p class="authors"><cite>By: <a href="//profiles.wordpress.org/nunosarmento/" target="_blank">Nuno Morais Sarmento</a>.</cite></p>
							</div>

			 </div>

		</div>

</div>

<?php

}


function ns_nsss_usage_callback(){

	if ( !current_user_can( 'manage_options' ) )  {
		wp_die( __( 'You do not have sufficient permissions to access this page.' ) );
	} ?>


	<h3><?php _e('How to use','nuno-sarmento-nsss-slick-slider'); ?></h3>
	<p><?php _e('First, create your slider, go to "NS Slider => Add New". <br>Enter the title and the featured image and content.','nuno-sarmento-nsss-slick-slider'); ?></p>
	<p><?php _e('Then, to output the slider, just add the shortcode by clicking the button (slider icon) on the WordPress Visual Editor or added it manually the shortcode <br> <code>[slick_slider_tend]</code><br><br> in a post or page, or use the function <code>&lt;?php nuno_sarmento_nsss_slider(); ?&gt;</code> in your theme templates.<br>','nuno-sarmento-nsss-slick-slider'); ?></p>


	<h3><?php _e('CSS customization','nuno-sarmento-nsss-slick-slider'); ?></h3>
	<p><?php _e('If you want to customize the output of the slider, here is the generated code:','nuno-sarmento-nsss-slick-slider'); ?></p>

<pre>
- - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
&lt;div class=&quot;slicky-slides&quot;&gt;

 &lt;div class=&quot;slicky-item&quot;&gt;

  &lt;div class=&quot;slicky-figure&quot;&gt;

   &lt;img src=&quot;your-image.jpg&quot; alt=&quot;image description&quot;&gt;

   &lt;div class=&quot;slicky-caption&quot;&gt;Your slide content &lt;/div&gt;

  &lt;/div&gt;

 &lt;/div&gt;

&lt;/div&gt;

- - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -
</pre>


	<p><?php _e('Your can override the class you need in your own stylesheet:','nuno-sarmento-nsss-slick-slider'); ?></p>

	<ul>
		<li><code>.slicky-slides</code> : <?php _e('The slider container','nuno-sarmento-nsss-slick-slider'); ?></li>
		<li><code>.slicky-item</code> : <?php _e('The slide','nuno-sarmento-nsss-slick-slider'); ?></li>
		<li><code>.slicky-figure</code> : <?php _e('The image container','nuno-sarmento-nsss-slick-slider'); ?></li>
		<li><code>.slicky-caption</code> : <?php _e('The caption container','nuno-sarmento-nsss-slick-slider'); ?></li>
	</ul>


	<h3><?php _e('Credits','nuno-sarmento-nsss-slick-slider'); ?></h3>

	<p><?php _e('This plugin is based on Slick, a jQuery plugin by Ken Wheeler. You can visit the official website here: <a href="https://kenwheeler.github.io/slick/" title="Slick official site">https://kenwheeler.github.io/slick/','nuno-sarmento-nsss-slick-slider'); ?></a></p>

	<?php
}



function ns_nsss_snapshot_report_callback() {
		?>
<div class="wrap nuno-sarmento-system-wrap">
	<div class="icon32" id="icon-tools"><br></div>
	<h2><?php _e( 'Server Details', 'nuno-sarmento-system-report' ) ?></h2>
	<p><?php echo ns_nsss_snapshot_data(); ?></p>
</div>
<style media="screen">
	div.nuno-sarmento-system-wrap h2 {margin: 0 0 1em;}
	div.nuno-sarmento-system-wrap p {margin: 0 0 1em;}
	div.nuno-sarmento-system-wrap p input.snapshot-highlight {margin: 0 0 0 10px;}
	div.nuno-sarmento-system-wrap textarea#nuno-sarmento-system-textarea {
	background: #ebebeb;display: block;font-family: Menlo,Monaco,monospace;height: 600px;overflow: auto;white-space: pre;width: 1500px;max-width: 95%;color: #000;padding: 10px 0 10px 10px;}
</style>
	 <?php
}

function ns_nsss_snapshot_data() {

	if ( !current_user_can( 'manage_options' ) )  {
		wp_die( __( 'You do not have sufficient permissions to access this page.' ) );
	}

	// call WP database
	global $wpdb;

	// check for browser class add on
	if ( ! class_exists( 'Browser' ) ) {
		require_once NUNO_SARMENTO_SLICK_SLIDER_PATH . 'includes/nuno-sarmento-nsss-browser.php';
	}

	// do WP version check and get data accordingly
	$browser = new Browser();
	if ( get_bloginfo( 'version' ) < '3.4' ) :
		$theme_data = get_theme_data( get_stylesheet_directory() . '/style.css' );
		$theme      = $theme_data['Name'] . ' ' . $theme_data['Version'];
	else:
		$theme_data = wp_get_theme();
		$theme      = $theme_data->Name . ' ' . $theme_data->Version;
	endif;

	// data checks for later
	$frontpage	= get_option( 'page_on_front' );
	$frontpost	= get_option( 'page_for_posts' );
	$mu_plugins = get_mu_plugins();
	$plugins	= get_plugins();
	$active		= get_option( 'active_plugins', array() );

	// multisite details
	$nt_plugins	= is_multisite() ? wp_get_active_network_plugins() : array();
	$nt_active	= is_multisite() ? get_site_option( 'active_sitewide_plugins', array() ) : array();
	$ms_sites	= is_multisite() ? get_blog_list() : null;

	// yes / no specifics
	$ismulti	= is_multisite() ? __( 'Yes', 'nuno-sarmento-system-report' ) : __( 'No', 'nuno-sarmento-system-report' );
	$safemode	= ini_get( 'safe_mode' ) ? __( 'Yes', 'nuno-sarmento-system-report' ) : __( 'No', 'nuno-sarmento-system-report' );
	$wpdebug	= defined( 'WP_DEBUG' ) ? WP_DEBUG ? __( 'Enabled', 'nuno-sarmento-system-report' ) : __( 'Disabled', 'nuno-sarmento-system-report' ) : __( 'Not Set', 'nuno-sarmento-system-report' );
	$tbprefx	= strlen( $wpdb->prefix ) < 16 ? __( 'Acceptable', 'nuno-sarmento-system-report' ) : __( 'Too Long', 'nuno-sarmento-system-report' );
	$fr_page	= $frontpage ? get_the_title( $frontpage ).' (ID# '.$frontpage.')'.'' : __( 'n/a', 'nuno-sarmento-system-report' );
	$fr_post	= $frontpage ? get_the_title( $frontpost ).' (ID# '.$frontpost.')'.'' : __( 'n/a', 'nuno-sarmento-system-report' );
	$errdisp	= ini_get( 'display_errors' ) != false ? __( 'On', 'nuno-sarmento-system-report' ) : __( 'Off', 'nuno-sarmento-system-report' );

	$jquchk		= wp_script_is( 'jquery', 'registered' ) ? $GLOBALS['wp_scripts']->registered['jquery']->ver : __( 'n/a', 'nuno-sarmento-system-report' );

	$sessenb	= isset( $_SESSION ) ? __( 'Enabled', 'nuno-sarmento-system-report' ) : __( 'Disabled', 'nuno-sarmento-system-report' );
	$usecck		= ini_get( 'session.use_cookies' ) ? __( 'On', 'nuno-sarmento-system-report' ) : __( 'Off', 'nuno-sarmento-system-report' );
	$useocck	= ini_get( 'session.use_only_cookies' ) ? __( 'On', 'nuno-sarmento-system-report' ) : __( 'Off', 'nuno-sarmento-system-report' );
	$hasfsock	= function_exists( 'fsockopen' ) ? __( 'Supports fsockopen.', 'nuno-sarmento-system-report' ) : __( 'Not support fsockopen.', 'nuno-sarmento-system-report' );
	$hascurl	= function_exists( 'curl_init' ) ? __( 'Supports cURL.', 'nuno-sarmento-system-report' ) : __( 'Not support cURL.', 'nuno-sarmento-system-report' );
	$hassoap	= class_exists( 'SoapClient' ) ? __( 'SOAP Client enabled.', 'nuno-sarmento-system-report' ) : __( 'Does not have the SOAP Client enabled.', 'nuno-sarmento-system-report' );
	$hassuho	= extension_loaded( 'suhosin' ) ? __( 'Server has SUHOSIN installed.', 'nuno-sarmento-system-report' ) : __( 'Does not have SUHOSIN installed.', 'nuno-sarmento-system-report' );
	$openssl	= extension_loaded('openssl') ? __( 'OpenSSL installed.', 'nuno-sarmento-system-report' ) : __( 'Does not have OpenSSL installed.', 'nuno-sarmento-system-report' );

	// start generating report
	$report	= '';
	$report	.= '<textarea readonly="readonly" id="nuno-sarmento-system-textarea" name="nuno-sarmento-system-textarea">';
	$report	.= '--- Begin System Info ---'."\n";
	// add filter for adding to report opening
	$report	.= apply_filters( 'snapshot_report_before', '' );

	$report	.= "\n\t".'-- SERVER DATA --'."\n";
	$report	.= 'jQuery Version'."\t\t\t\t".$jquchk."\n";
	$report	.= 'PHP Version:'."\t\t\t\t".PHP_VERSION."\n";
	$report	.= 'MySQL Version:'."\t\t\t\t".$wpdb->db_version()."\n";
	$report	.= 'Server Software:'."\t\t\t".$_SERVER['SERVER_SOFTWARE']."\n";

	$report	.= "\n\t".'-- PHP CONFIGURATION --'."\n";
	$report	.= 'Safe Mode:'."\t\t\t\t".$safemode."\n";
	$report	.= 'Memory Limit:'."\t\t\t\t".ini_get( 'memory_limit' )."\n";
	$report	.= 'Upload Max:'."\t\t\t\t".ini_get( 'upload_max_filesize' )."\n";
	$report	.= 'Post Max:'."\t\t\t\t".ini_get( 'post_max_size' )."\n";
	$report	.= 'Time Limit:'."\t\t\t\t".ini_get( 'max_execution_time' )."\n";
	$report	.= 'Max Input Vars:'."\t\t\t\t".ini_get( 'max_input_vars' )."\n";
	$report	.= 'Display Errors:'."\t\t\t\t".$errdisp."\n";
	$report	.= 'Sessions:'."\t\t\t\t".$sessenb."\n";
	$report	.= 'Session Name:'."\t\t\t\t".esc_html( ini_get( 'session.name' ) )."\n";
	$report	.= 'Cookie Path:'."\t\t\t\t".esc_html( ini_get( 'session.cookie_path' ) )."\n";
	$report	.= 'Save Path:'."\t\t\t\t".esc_html( ini_get( 'session.save_path' ) )."\n";
	$report	.= 'Use Cookies:'."\t\t\t\t".$usecck."\n";
	$report	.= 'Use Only Cookies:'."\t\t\t".$useocck."\n";
	$report	.= 'FSOCKOPEN:'."\t\t\t\t".$hasfsock."\n";
	$report	.= 'cURL:'."\t\t\t\t\t".$hascurl."\n";
	$report	.= 'SOAP Client:'."\t\t\t\t".$hassoap."\n";
	$report	.= 'SUHOSIN:'."\t\t\t\t".$hassuho."\n";
	$report	.= 'OpenSSL:'."\t\t\t\t".$openssl."\n";

	$report	.= "\n\t".'-- WORDPRESS DATA --'."\n";
	$report	.= 'Multisite:'."\t\t\t\t".$ismulti."\n";
	$report	.= 'SITE_URL:'."\t\t\t\t".site_url()."\n";
	$report	.= 'HOME_URL:'."\t\t\t\t".home_url()."\n";
	$report	.= 'WP Version:'."\t\t\t\t".get_bloginfo( 'version' )."\n";
	$report	.= 'Permalink:'."\t\t\t\t".get_option( 'permalink_structure' )."\n";
	$report	.= 'Cur Theme:'."\t\t\t\t".$theme."\n";
	$report	.= 'Post Types:'."\t\t\t\t".implode( ', ', get_post_types( '', 'names' ) )."\n";
	$report	.= 'Post Stati:'."\t\t\t\t".implode( ', ', get_post_stati() )."\n";
	$report	.= 'User Count:'."\t\t\t\t".count( get_users() )."\n";

	$report	.= "\n\t".'-- WORDPRESS CONFIG --'."\n";
	$report	.= 'WP_DEBUG:'."\t\t\t\t".$wpdebug."\n";
	$report	.= 'WP Memory Limit:'."\t\t\t".ns_nsss_num_convt( WP_MEMORY_LIMIT )/( 1024 ).'MB'."\n";
	$report	.= 'Table Prefix:'."\t\t\t\t".$wpdb->base_prefix."\n";
	$report	.= 'Prefix Length:'."\t\t\t\t".$tbprefx.' ('.strlen( $wpdb->prefix ).' characters)'."\n";
	$report	.= 'Show On Front:'."\t\t\t\t".get_option( 'show_on_front' )."\n";
	$report	.= 'Page On Front:'."\t\t\t\t".$fr_page."\n";
	$report	.= 'Page For Posts:'."\t\t\t\t".$fr_post."\n";

	if ( is_multisite() ) :
		$report	.= "\n\t".'-- MULTISITE INFORMATION --'."\n";
		$report	.= 'Total Sites:'."\t\t\t\t".get_blog_count()."\n";
		$report	.= 'Base Site:'."\t\t\t\t".$ms_sites[0]['domain']."\n";
		$report	.= 'All Sites:'."\n";
		foreach ( $ms_sites as $site ) :
			if ( $site['path'] != '/' )
				$report	.= "\t\t".'- '. $site['domain'].$site['path']."\n";

		endforeach;
		$report	.= "\n";
	endif;

	$report	.= "\n\t".'-- BROWSER DATA --'."\n";
	$report	.= 'Platform:'."\t\t\t\t".$browser->getPlatform()."\n";
	$report	.= 'Browser Name'."\t\t\t\t". $browser->getBrowser() ."\n";
	$report	.= 'Browser Version:'."\t\t\t".$browser->getVersion()."\n";
	$report	.= 'Browser User Agent:'."\t\t\t".$browser->getUserAgent()."\n";

	$report	.= "\n\t".'-- PLUGIN INFORMATION --'."\n";
	if ( $plugins && $mu_plugins ) :
		$report	.= 'Total Plugins:'."\t\t\t\t".( count( $plugins ) + count( $mu_plugins ) + count( $nt_plugins ) )."\n";
	endif;

	// output must-use plugins
	if ( $mu_plugins ) :
		$report	.= 'Must-Use Plugins: ('.count( $mu_plugins ).')'. "\n";
		foreach ( $mu_plugins as $mu_path => $mu_plugin ) :
			$report	.= "\t".'- '.$mu_plugin['Name'] . ' ' . $mu_plugin['Version'] ."\n";
		endforeach;
		$report	.= "\n";
	endif;

	// if multisite, grab active network as well
	if ( is_multisite() ) :
		// active network
		$report	.= 'Network Active Plugins: ('.count( $nt_plugins ).')'. "\n";

		foreach ( $nt_plugins as $plugin_path ) :
			if ( array_key_exists( $plugin_base, $nt_plugins ) )
				continue;

			$plugin = get_plugin_data( $plugin_path );

			$report	.= "\t".'- '.$plugin['Name'] . ' ' . $plugin['Version'] ."\n";
		endforeach;
		$report	.= "\n";

	endif;

	// output active plugins
	if ( $plugins ) :
		$report	.= 'Active Plugins: ('.count( $active ).')'. "\n";
		foreach ( $plugins as $plugin_path => $plugin ) :
			if ( ! in_array( $plugin_path, $active ) )
				continue;
			$report	.= "\t".'- '.$plugin['Name'] . ' ' . $plugin['Version'] ."\n";
		endforeach;
		$report	.= "\n";
	endif;

	// output inactive plugins
	if ( $plugins ) :
		$report	.= 'Inactive Plugins: ('.( count( $plugins ) - count( $active ) ).')'. "\n";
		foreach ( $plugins as $plugin_path => $plugin ) :
			if ( in_array( $plugin_path, $active ) )
				continue;
			$report	.= "\t".'- '.$plugin['Name'] . ' ' . $plugin['Version'] ."\n";
		endforeach;
		$report	.= "\n";
	endif;

	// add filter for end of report
	$report	.= apply_filters( 'snapshot_report_after', '' );

	// end it all
	$report	.= "\n".'--- End System Info ---';
	$report	.= '</textarea>';

	return $report;
}


function ns_nsss_num_convt( $v ) {

	if ( !current_user_can( 'manage_options' ) )  {
		wp_die( __( 'You do not have sufficient permissions to access this page.' ) );
	}

	$l   = substr( $v, -1 );
	$ret = substr( $v, 0, -1 );

	switch ( strtoupper( $l ) ) {
		case 'P': // fall-through
		case 'T': // fall-through
		case 'G': // fall-through
		case 'M': // fall-through
		case 'K': // fall-through
			$ret *= 1024;
			break;
		default:
			break;
	}
	return $ret;
}
