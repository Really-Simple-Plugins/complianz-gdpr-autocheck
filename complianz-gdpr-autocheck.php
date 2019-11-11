<?php
/**
 * Plugin Name: Complianz GDPR autocheck
 * Plugin URI: https://complianz.io/pricing
 * Description: Complianz Autocheck checks your categories by default. NOT COMPLIANT!
 * Version: 1.0.0
 * Text Domain: complianz-gdpr
 * Domain Path: languages
 * Author: Complianz team
 * Author URI: https://complianz.io
 */

add_action('plugins_loaded','cmplz_autocheck_init',9);
function cmplz_autocheck_init(){
	$plugin_data = get_plugin_data(__FILE__);
	$debug = (defined('SCRIPT_DEBUG') && SCRIPT_DEBUG) ? time() : '';
	define('cmplz_autocheck_version', $plugin_data['Version'] . $debug);
}


function cmplz_autocheck_enqueue_assets( $hook ) {
	$minified = ( defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ) ? '' : '.min';
	wp_enqueue_script( 'complianz-gdpr-autocheck', plugin_dir_url(__FILE__) . "autocheck$minified.js", array('jquery'), cmplz_autocheck_version, true );

}

add_action( 'wp_enqueue_scripts', 'cmplz_autocheck_enqueue_assets');


/**
 *
 * Add warning
 *
 * */

add_filter('cmplz_warnings', 'cmplz_autocheck_warnings');
function cmplz_autocheck_warnings($warnings)
{
	$warnings[] = 'autocheck-not-compliant';
	return $warnings;
}

/**
 * Add a warning to the dashboard
 */

add_filter('cmplz_warnings_types',  'cmplz_autocheck_filter_warnings');
function cmplz_autocheck_filter_warnings($warnings)
{


	$warnings['autocheck-not-compliant']['label_error'] = __('Automatically checking cagories is not GPDR compliant and can cause fines and or claims. Please check with your lawyer', 'complianz-gdpr');

	return $warnings;
}


