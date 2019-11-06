<?php
/**
 * Plugin Name: WP MoJ Problem with this page plugin
 * Plugin URI:
 * Description: Form for user to notify a problem with page 
 * Author: Ministry of Justice
 * https://peoplefinder.service.gov.uk/people/stephanie-david
 * License: MIT
 **/

// Exit if accessed directly
if (!defined('ABSPATH')) {
    exit();
}

// load plugin text domain
function pwtp_init() {
	load_plugin_textdomain( 'wp-moj-problem-with-this-page', false, dirname( plugin_basename( __FILE__ ) ) . '/translation' );
}
add_action('plugins_loaded', 'pwtp_init');

// enqueue plugin css
function pwtp_assets() {
	wp_enqueue_style('pwtp_style', plugins_url('/assets/css/pwtp-style.css',__FILE__));
}
add_action('wp_enqueue_scripts', 'pwtp_assets');

// add settings link
function pwtp_action_links ( $links ) {
	$settingslink = array( '<a href="'. admin_url( 'options-general.php?page=pwtp' ) .'">'. esc_attr__('Settings', 'wp-moj-problem-with-this-page') .'</a>' );
	return array_merge( $links, $settingslink );
}
add_filter( 'plugin_action_links_' . plugin_basename(__FILE__), 'pwtp_action_links' );


// get previous page from where user navigated
function pwtp_get_the_prev_url() {
	if (isset($_SERVER['HTTP_REFERER']))
	 {
		$prev_url = $_SERVER['HTTP_REFERER'];
		$id_block = substr($prev_url, strpos($prev_url, "?p=")+1);
		$url = substr($id_block, 0, strpos($id_block, "/"));
	}
}
// get the user's browser info
function pwtp_get_the_user_browser() {
	if (isset($_SERVER['HTTP_USER_AGENT']))
	 {
		$browser = $_SERVER['HTTP_USER_AGENT'];
		$id_block = substr($browser, strpos($browser, "?p=")+1);
		$url = substr($id_block, 0, strpos($id_block, "/"));
	}
}

// get the difference in seconds between the user's timezone and GMT
function pwtp_get_the_time() {
	if (isset($_SERVER['REQUEST_TIME']))
	 {
		$time = $_SERVER['REQUEST_TIME'];
		$id_block = substr($time, strpos($browser, "?p=")+1);
		$url = substr($id_block, 0, strpos($id_block, "/"));
	}
}

// create from email header
function pwtp_from_header() {
	if ( !isset( $from_email ) ) {
		$sitename = strtolower( $_SERVER['SERVER_NAME'] );
		if ( substr( $sitename, 0, 4 ) == 'www.' ) {
			$sitename = substr( $sitename, 4 );
		}
		return 'wordpress@' . $sitename;
	}
}

// create random number for page captcha
function pwtp_random_number() {
	$page_number = mt_rand(100, 999);
	return $page_number;
}

// redirect if sending succeeded
function pwtp_redirect_success() {
	$current_url = $_SERVER['REQUEST_URI'];
	if (strpos($current_url, '?') == true) {
		$url_with_param = $current_url."&pwtpsp=success";
	} else {
		if (substr($current_url, -1) == '/') {
			$url_with_param = $current_url."?pwtpsp=success";
		} else {
			$url_with_param = $current_url."/?pwtpsp=success";
		}
	}
	return $url_with_param;
}

// redirect if sending failed
function pwtp_redirect_error() {
	$current_url = $_SERVER['REQUEST_URI'];
	if (strpos($current_url, '?') == true) {
		$url_with_param = $current_url."&pwtpsp=fail";
	} else {
		if (substr($current_url, -1) == '/') {
			$url_with_param = $current_url."?pwtpsp=fail";
		} else {
			$url_with_param = $current_url."/?pwtpsp=fail";
		}
	}
	return $url_with_param;
}

// form anchor
function pwtp_anchor_footer() {
	$anchor_setting = get_option('pwtp-setting-21');
	if ($anchor_setting == "yes") {
		echo '<script>';
		echo 'if(document.getElementById("pwtp-anchor")) { document.getElementById("pwtp-anchor").scrollIntoView({behavior:"smooth", block:"center"}); }';
		echo '</script>';
	}
}
add_action('wp_footer', 'pwtp_anchor_footer');

// include files
include 'pwtp-shortcodes.php';
include 'pwtp-options.php';

//Register and enqueue plugin scripts
function pwtp_scripts() {
    wp_register_script('pwtp-hidden-form-elements', plugins_url( '/assets/js/get-hidden-form-elements-variables.js', __FILE__ ), array(), false, true);
    wp_register_script('pwtp=timezone', plugins_url( '/assets/js/get-user-timezone.js', __FILE__ ), array(), false, true);
	wp_enqueue_script('pwtp-hidden-form-elements');
	wp_enqueue_script('pwtp-timezone');
}
add_action( 'wp_enqueue_scripts', 'pwtp_scripts' );
function get_info(){
	wp_enqueue_script('pwtp-hidden-form-elements');
}

add_action( 'wp_enqueue_scripts', 'pwtp_scripts' );
function get_user_timezone(){
	wp_enqueue_script('pwtp-timezone');
}





/*
/**
* Initialization. Add our script to the PWTP page.

function pbd_alp_init() {
	global $wp_query;

	// Add code to index pages.
	if( is_page( 'Problem with this page' ) {	
		// Queue JS
		wp_enqueue_script(
			'pbd-alp-load-posts',
			plugin_dir_url( __FILE__ ) . 'js/load-posts.js',
			array('jquery'),
			'1.0',
			true
		);
	}






Register and enqueue plugin scripts
function pwtp_scripts() {
    wp_register_script('pwtp-hidden-form-elements', plugins_url( '/assets/js/get-hidden-form-elements-variables.js', __FILE__ ), array(), false, true);
    wp_register_script('pwtp=timezone', plugins_url( '/assets/js/get-user-timezone.js', __FILE__ ), array(), false, true);
	wp_enqueue_script('pwtp-hidden-form-elements');
	wp_enqueue_script('pwtp-timezone');
}
add_action( 'wp_enqueue_scripts', 'pwtp_scripts' );
function get_info(){
	wp_enqueue_script('pwtp-hidden-form-elements');
}

add_action( 'wp_enqueue_scripts', 'pwtp_scripts' );
function get_user_timezone
(){
	wp_enqueue_script('pwtp-hidden-form-elements');
}

do_action('')



wp_register_script('pwtp-hidden-form-elements', plugins_url( '/assets/js/get-hidden-form-elements-variables.js', __FILE__ ), array(), false, false);
wp_enqueue_scripts('pwtp-hidden-form-elements');
add_action('gethiddenformelements', 'get_info');
function get_info(){
	wp_enqueue_script('pwtp-hidden-form-elements');
}

do_action('gethiddenformelements');


wp_register_script('pwtp-timezone', plugins_url( '/assets/js/get-user-timezone.js', __FILE__ ), array(), false, false);
wp_enqueue_scripts('pwtp-timezone');
add_action( 'gettimezone', 'get_user_timezone' );
function get_user_timezone(){
	wp_enqueue_script('pwtp-timezone');
}

do_action('gettimezone');


wp_enqueue_script( ‘wpls-public-js’ );`

The correct way to load js is via an action:
add_action( 'admin_enqueue_scripts', 'wpls_load_scripts' );

function wpls_load_scripts() {

`wp_enqueue_script( ‘wpos-slick-jquery’ );
wp_enqueue_script( ‘wpls-public-js’ );`

}




wp_register_script('scripts', get_template_directory_uri() . '/assets/js/scripts.js', array( 'jquery' ));


wp_enqueue_script('scripts');


// Register and enqueue plugin scripts
function pwtp_scripts() {
    wp_register_script('wp-moj-problem-with-this-page-scripts', plugins_url( '/assets/js/get-hidden-form-elements-variables.js', __FILE__ ), array(), false, true);
    wp_register_script('wp-moj-problem-with-this-page-scripts', plugins_url( '/assets/js/get-user-timezone.js', __FILE__ ), array(), false, true);
    wp_enqueue_script('wp-moj-problem-with-this-page-scripts');
}
add_action( 'wp_enqueue_scripts', 'pwtp_scripts' );

function my_admin_scripts() {
  wp_enqueue_style( 'admin-css', get_stylesheet_directory_uri() . '/admin/css/admin.css' );
  wp_enqueue_script( 'admin-js', get_stylesheet_directory_uri() . '/admin/js/admin.js', true );
}
add_action( 'admin_enqueue_scripts', 'my_admin_scripts' );





*/







/*
wp_register_script( 'pluginMain', plugins_url( 	'/js/pluginMain.js', __FILE__ ) );

add_action('loadmyscripthereplz', 'somefunction');
function somefunction(){
	wp_enqueue_script('pluginMain');
}

do_action('loadmyscripthereplz');

*/


