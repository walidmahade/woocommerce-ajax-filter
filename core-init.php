<?php
/*
*
*	***** mw-woo-filter *****
*
*	This file initializes all MWF Core components
*
*/
// If this file is called directly, abort. //
if ( ! defined( 'WPINC' ) ) {die;} // end if
// Define Our Constants
define('MWF_CORE_INC',dirname( __FILE__ ).'/assets/inc/');
define('MWF_CORE_IMG',plugins_url( 'assets/img/', __FILE__ ));
define('MWF_CORE_CSS',plugins_url( 'assets/css/', __FILE__ ));
define('MWF_CORE_JS',plugins_url( 'assets/js/', __FILE__ ));
/*
*
*  Register CSS
*
*/
function mwf_register_core_css(){
wp_enqueue_style('mwf-core', MWF_CORE_CSS . 'mwf-core.css',null,time('s'),'all');
};
add_action( 'wp_enqueue_scripts', 'mwf_register_core_css' );
/*
*
*  Register JS/Jquery Ready
*
*/
function mwf_register_core_js(){
// Register Core Plugin JS
wp_enqueue_script('mwf-core', MWF_CORE_JS . 'mwf-core.js','jquery',time(),true);
};
add_action( 'wp_enqueue_scripts', 'mwf_register_core_js' );
/*
*
*  Includes
*
*/
// Load the Functions
if ( file_exists( MWF_CORE_INC . 'mwf-core-functions.php' ) ) {
	require_once MWF_CORE_INC . 'mwf-core-functions.php';
}
// Load the ajax Request
if ( file_exists( MWF_CORE_INC . 'mwf-ajax-request.php' ) ) {
	require_once MWF_CORE_INC . 'mwf-ajax-request.php';
}
// Load the Shortcodes
//if ( file_exists( MWF_CORE_INC . 'mwf-shortcodes.php' ) ) {
//	require_once MWF_CORE_INC . 'mwf-shortcodes.php';
//}
