<?php
/**
 *
 * About
 *
 * @package About
 */

defined( 'ABSPATH' ) || die();

/**
 * About_callback
 */
function ns_nsss_about_callback() {
	if ( !current_user_can( 'manage_options' ) ) {
		wp_die( __( 'You do not have sufficient permissions to access this page.' ) );
	} ?>

<h1>Nuno Sarmento - Plugins Colection</h1>

<div class="wrap">

	<div id="the-list">

	 <div class="plugin-card plugin-card-nuno-sarmento-custom-css-js">
			<div class="plugin-card-top">
				<div class="name column-name">
					<h3>
						<a href="http://plugins.dev/wp-admin/plugin-install.php?tab=plugin-information&amp;plugin=nuno-sarmento-custom-css-js&amp;TB_iframe=true&amp;width=600&amp;height=550" class="thickbox open-plugin-details-modal">
						Nuno Sarmento Custom CSS – JS						<img src="https://ps.w.org/nuno-sarmento-custom-css-js/assets/icon-256x256.png?rev=1588553" class="plugin-icon" alt="">
						</a>
					</h3>
				</div>
				<div class="desc column-description">
					<p>Nuno Sarmento Custom CSS - Add custom JavaScripts and CSS Styling.</p>
					<p class="authors"> <cite>By <a href="http://www.nuno-sarmento.com">Nuno Sarmento</a></cite></p>
				</div>
			</div>
		</div>

		<div class="plugin-card plugin-card-nuno-sarmento-popup">
			<div class="plugin-card-top">
				<div class="name column-name">
					<h3>
						<a href="/wp-admin/plugin-install.php?tab=plugin-information&amp;plugin=nuno-sarmento-popup&amp;TB_iframe=true&amp;width=600&amp;height=550" class="thickbox open-plugin-details-modal">
						Nuno Sarmento PopUp						<img src="https://ps.w.org/nuno-sarmento-popup/assets/icon-256x256.png?rev=1593940" class="plugin-icon" alt="">
						</a>
					</h3>
				</div>
				<div class="desc column-description">
					<p>This plugin allows you to create lightweight popup window in your blog with custom content…</p>
					<p class="authors"> <cite>By <a href="https://www.nuno-sarmento.com">Nuno Sarmento</a></cite></p>
				</div>
			</div>
		</div>

	 <div class="plugin-card plugin-card-nuno-sarmento-api-to-post">
			<div class="plugin-card-top">
				<div class="name column-name">
					<h3>
						<a href="/wp-admin/plugin-install.php?tab=plugin-information&amp;plugin=nuno-sarmento-api-to-post&amp;TB_iframe=true&amp;width=600&amp;height=550" class="thickbox open-plugin-details-modal">
						Nuno Sarmento API To Post						<img src="https://ps.w.org/nuno-sarmento-api-to-post/assets/icon-256x256.png?rev=1594469" class="plugin-icon" alt="">
						</a>
					</h3>
				</div>
				<div class="desc column-description">
					<p>Simple WP API to Posts</p>
					<p class="authors"> <cite>By <a href="https://www.nuno-sarmento.com">Nuno Sarmento</a></cite></p>
				</div>
			</div>
		</div>

		<div class="plugin-card plugin-card-nuno-sarmento-slick-slider">
			<div class="plugin-card-top">
				<div class="name column-name">
					<h3>
						<a href="/wp-admin/plugin-install.php?tab=plugin-information&amp;plugin=nuno-sarmento-slick-slider&amp;TB_iframe=true&amp;width=600&amp;height=550" class="thickbox open-plugin-details-modal">
						Nuno Sarmento Slick Slider						<img src="https://ps.w.org/nuno-sarmento-slick-slider/assets/icon-256x256.png?rev=1588561" class="plugin-icon" alt="">
						</a>
					</h3>
				</div>
				<div class="desc column-description">
					<p>Nuno Sarmento Slick Slider, an easy-to-use WordPress Plugin that enables you to create beautiful, professional…</p>
					<p class="authors"> <cite>By <a href="https://www.nuno-sarmento.com">Nuno Sarmento</a></cite></p>
				</div>
			</div>
		</div>

		<div class="plugin-card plugin-card-nuno-youtube-videos-cpt">
			<div class="plugin-card-top">
				<div class="name column-name">
					<h3>
						<a href="/wp-admin/plugin-install.php?tab=plugin-information&amp;plugin=nuno-youtube-videos-cpt&amp;TB_iframe=true&amp;width=600&amp;height=550" class="thickbox open-plugin-details-modal">
						Nuno Sarmento Youtube Videos CPT						<img src="https://ps.w.org/nuno-youtube-videos-cpt/assets/icon-256x256.png?rev=1711712" class="plugin-icon" alt="">
						</a>
					</h3>
				</div>
				<div class="desc column-description">
					<p>This plugin allows you to create a custom post type 'videos' to be used on…</p>
					<p class="authors"> <cite>By <a href="https://www.nuno-sarmento.com">Nuno Sarmento</a></cite></p>
				</div>
			</div>
		</div>


		<div class="plugin-card plugin-card-change-wp-admin-login">
			<div class="plugin-card-top">
				<div class="name column-name">
					<h3>
						<a href="/wp-admin/plugin-install.php?tab=plugin-information&amp;plugin=change-wp-admin-login&amp;TB_iframe=true&amp;width=600&amp;height=550" class="thickbox open-plugin-details-modal">
						Change wp-admin login						<img src="https://ps.w.org/change-wp-admin-login/assets/icon-256x256.png?rev=2040699" class="plugin-icon" alt="">
						</a>
					</h3>
				</div>
				<div class="desc column-description">
					<p>Change wp-admin login is a light plugin that allows you easily and safely to change…</p>
					<p class="authors"> <cite>By <a href="https://www.nuno-sarmento.com">Nuno Sarmento</a></cite></p>
				</div>
			</div>
		</div>

	</div>

</div>

<?php

}
