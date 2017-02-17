<?php defined('ABSPATH') or die();

class NUNO_SARMENTO_ss_Custom_Css {

	private $nuno_sarmento_nsss_custom_css_options;

	public function __construct() {
		add_action( 'admin_menu', array( $this, 'nuno_sarmento_nsss_custom_css_add_plugin_page' ));
		add_action( 'admin_init', array( $this, 'nuno_sarmento_nsss_custom_css_page_init' ));
    add_action('admin_enqueue_scripts', array($this, 'nuno_sarmento_nsss_enqueue_scripts'));
	}

  public function nuno_sarmento_nsss_enqueue_scripts() {
    wp_register_style('nuno-sarmento-nsss-custom_CSS', plugins_url('../assets/css/nuno-sarmento-nsss-ct.css', __FILE__), null, '1.0', 'screen');
    wp_enqueue_style('nuno-sarmento-nsss-custom_CSS');
  }

	public function nuno_sarmento_nsss_custom_css_add_plugin_page() {

    add_submenu_page(
      'edit.php?post_type=nuno-sarmento-ss-cpt',
			'NS Slider CSS', // page_title
			'NS Slider CSS', // menu_title
			'manage_options', // capability
			'ns-custom-css', // menu_slug
			array( $this, 'nuno_sarmento_css_js_admin_page' ), // function
			'dashicons-admin-generic', // icon_url
			3 // position
		);
	}

	public function nuno_sarmento_css_js_admin_page() {
		$this->nuno_sarmento_nsss_custom_css_options = get_option( 'nuno_sarmento_css_js_option_name' ); ?>

		<div class="wrap">
			<h2>Nuno Sarmento Slick Slider Custom CSS</h2>
			<p></p>
			<?php settings_errors(); ?>

			<form method="post" action="options.php">
				<?php
					settings_fields( 'nuno_sarmento_nsss_custom_css_option_group' );
					do_settings_sections( 'nuno-sarmento-nsss-custom-css-admin' );
					submit_button();
				?>
			</form>
		</div>
	<?php }


	public function nuno_sarmento_nsss_custom_css_page_init() {
		register_setting(
			'nuno_sarmento_nsss_custom_css_option_group', // option_group
			'nuno_sarmento_css_js_option_name', // option_name
			array( $this, 'nuno_sarmento_nsss_custom_css_sanitize' ) // sanitize_callback
		);

		add_settings_section(
			'nuno_sarmento_nsss_custom_css_setting_section', // id
			'Settings', // title
			array( $this, 'nuno_sarmento_nsss_custom_css_section_info' ), // callback
			'nuno-sarmento-nsss-custom-css-admin' // page
		);

		add_settings_field(
			'nuno_sarmento_ccj_custom_css_0', // id
			'CSS', // title
			array( $this, 'nuno_sarmento_ccj_custom_css_0_callback' ), // callback
			'nuno-sarmento-nsss-custom-css-admin', // page
			'nuno_sarmento_nsss_custom_css_setting_section' // section
		);
	}

	public function nuno_sarmento_nsss_custom_css_sanitize($input) {
		$sanitary_values = array();
		if ( isset( $input['nuno_sarmento_ccj_custom_css_0'] ) ) {
			$sanitary_values['nuno_sarmento_ccj_custom_css_0'] = esc_textarea( $input['nuno_sarmento_ccj_custom_css_0'] );
		}
		return $sanitary_values;
	}

	public function nuno_sarmento_nsss_custom_css_section_info() {

	}

	public function nuno_sarmento_ccj_custom_css_0_callback() {
		printf(
			'<textarea class="biw_textarea large-text" rows="5" name="nuno_sarmento_css_js_option_name[nuno_sarmento_ccj_custom_css_0]" id="nuno_sarmento_ccj_custom_css_0">%s</textarea>',
			isset( $this->nuno_sarmento_nsss_custom_css_options['nuno_sarmento_ccj_custom_css_0'] ) ? esc_attr( $this->nuno_sarmento_nsss_custom_css_options['nuno_sarmento_ccj_custom_css_0']) : ''
		);
	}

}
if ( is_admin() )
	$nuno_sarmento_nsss_custom_css = new NUNO_SARMENTO_ss_Custom_Css();


function nuno_sarmento_nsss_custom_css()
 {
   $nuno_sarmento_nsss_custom_css_options = get_option( 'nuno_sarmento_css_js_option_name' ); // Array of All Options
   $stylecss = $nuno_sarmento_nsss_custom_css_options['nuno_sarmento_ccj_custom_css_0'];
   echo "<style>" . $stylecss . "</style>";
 }
add_action('wp_head', 'nuno_sarmento_nsss_custom_css', 100);
