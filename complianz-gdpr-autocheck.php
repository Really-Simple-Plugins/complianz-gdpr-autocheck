<?php
/**
 * Plugin Name: Complianz Pre-Checked Categories
 * Plugin URI: https://complianz.io/pricing
 * Description: Autocheck checks your categories by default. NOT COMPLIANT! [Read more](https://complianz.io/pre-checked-categories-why-not/)
 * Version: 1.0.0
 * Text Domain: complianz-gdpr
 * Domain Path: languages
 * Author: Complianz.io
 * Author URI: https://complianz.io
 */


	define('cmplz_autocheck_version', '1');



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


