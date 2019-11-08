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
// get the useragent
function pwtp_get_the_useragent() {
	if (isset($_SERVER['HTTP_USER_AGENT']))
	 {
		$useragent = $_SERVER['HTTP_USER_AGENT'];
		$id_block = substr($useragent, strpos($useragent, "?p=")+1);
		$url = substr($id_block, 0, strpos($id_block, "/"));
	}
}

// get the user browser
function pwtp_get_the_user_browser() {
	if (isset($_POST['browser']))
	 {
		$browser = $_POST['browser'];
		$id_block = substr($browser, strpos($browser, "?p=")+1);
		$url = substr($id_block, 0, strpos($id_block, "/"));
	}
}

// get the user browser version
function pwtp_get_the_user_browser_version() {
	if (isset($_POST['version']))
	 {
		$version = $_POST['version'];
		$id_block = substr($version, strpos($version, "?p=")+1);
		$url = substr($id_block, 0, strpos($id_block, "/"));
	}
}


// get the user screen resolution
function pwtp_get_the_screen_resolution() {
	if (isset($_POST['res']))
	 {
		$res = $_POST['res'];
		$id_block = substr($res, strpos($res, "?p=")+1);
		$url = substr($id_block, 0, strpos($id_block, "/"));
	}
}

// get the user operating system
function pwtp_get_the_operating_system() {
	if (isset($_POST['os']))
	 {
		$os = $_POST['os'];
		$id_block = substr($os, strpos($os, "?p=")+1);
		$url = substr($id_block, 0, strpos($id_block, "/"));
	}
}

// get the user language
function pwtp_get_the_language() {
	if (isset($_POST['language']))
	 {
		$language = $_POST['language'];
		$id_block = substr($language, strpos($language, "?p=")+1);
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

