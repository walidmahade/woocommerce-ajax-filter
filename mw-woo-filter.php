<?php 
/*
Plugin Name: mw-woo-filter
Plugin URI: https://mahade.dev
Description: Custom developed ajax woocommerce filters
Version: 1.0.0
Author: Mahade Walid
Author URI: https://mahade.dev
Text Domain: mwf
Generated By: http://ensuredomains.com
*/

// If this file is called directly, abort. //
if ( ! defined( 'WPINC' ) ) {die;} // end if

// Let's Initialize Everything
if ( file_exists( plugin_dir_path( __FILE__ ) . 'core-init.php' ) ) {
require_once( plugin_dir_path( __FILE__ ) . 'core-init.php' );
}