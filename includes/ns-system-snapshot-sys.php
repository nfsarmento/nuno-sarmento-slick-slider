<?php
/**
 *
 * System snapshot
 *
 * @package System snapshot
 */

defined( 'ABSPATH' ) || die();


if ( !current_user_can( 'manage_options' ) ) {
  wp_die( __( 'You do not have sufficient permissions to access this page.' ) );
}

/* call WP database */
global $wpdb;

/* check for browser class add on */
if ( ! class_exists( 'Browser' ) ) {
  require_once NUNO_SARMENTO_SLICK_SLIDER_PATH . 'includes/ns-system-snapshot.php';
}

/* do WP version check and get data accordingly */
$browser = new Browser();
if ( get_bloginfo( 'version' ) < '3.4' ) :
  $theme_data = get_theme_data( get_stylesheet_directory() . '/style.css' );
  $theme      = $theme_data['Name'] . ' ' . $theme_data['Version'];
else:
  $theme_data = wp_get_theme();
  $theme      = $theme_data->Name . ' ' . $theme_data->Version;
endif;

/* data checks for later */
$frontpage	= get_option( 'page_on_front' );
$frontpost	= get_option( 'page_for_posts' );
$mu_plugins = get_mu_plugins();
$plugins	= get_plugins();
$active		= get_option( 'active_plugins', array() );

/* multisite details */
$nt_plugins	= is_multisite() ? wp_get_active_network_plugins() : array();
$nt_active	= is_multisite() ? get_site_option( 'active_sitewide_plugins', array() ) : array();
$ms_sites	= is_multisite() ? get_blog_list() : null;

/* yes / no specifics */
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

/* start generating report */
$report	= '';
$report	.= '<textarea readonly="readonly" id="nuno-sarmento-system-textarea" name="nuno-sarmento-system-textarea">';
$report	.= '--- Begin System Info ---'."\n";
// add filter for adding to report opening */
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

/* output must-use plugins */
if ( $mu_plugins ) :
  $report	.= 'Must-Use Plugins: ('.count( $mu_plugins ).')'. "\n";
  foreach ( $mu_plugins as $mu_path => $mu_plugin ) :
    $report	.= "\t".'- '.$mu_plugin['Name'] . ' ' . $mu_plugin['Version'] ."\n";
  endforeach;
  $report	.= "\n";
endif;

/* if multisite, grab active network as well */
if ( is_multisite() ) :

  $report	.= 'Network Active Plugins: ('.count( $nt_plugins ).')'. "\n";

  foreach ( $nt_plugins as $plugin_path ) :
    if ( array_key_exists( $plugin_base, $nt_plugins ) )
      continue;

    $plugin = get_plugin_data( $plugin_path );

    $report	.= "\t".'- '.$plugin['Name'] . ' ' . $plugin['Version'] ."\n";
  endforeach;
  $report	.= "\n";

endif;

/* output active plugins */
if ( $plugins ) :
  $report	.= 'Active Plugins: ('.count( $active ).')'. "\n";
  foreach ( $plugins as $plugin_path => $plugin ) :
    if ( ! in_array( $plugin_path, $active ) )
      continue;
    $report	.= "\t".'- '.$plugin['Name'] . ' ' . $plugin['Version'] ."\n";
  endforeach;
  $report	.= "\n";
endif;

/* output inactive plugins */
if ( $plugins ) :
  $report	.= 'Inactive Plugins: ('.( count( $plugins ) - count( $active ) ).')'. "\n";
  foreach ( $plugins as $plugin_path => $plugin ) :
    if ( in_array( $plugin_path, $active ) )
      continue;
    $report	.= "\t".'- '.$plugin['Name'] . ' ' . $plugin['Version'] ."\n";
  endforeach;
  $report	.= "\n";
endif;

/* add filter for end of report */
$report	.= apply_filters( 'snapshot_report_after', '' );

/* end it all */
$report	.= "\n".'--- End System Info ---';
$report	.= '</textarea>';

return $report;
