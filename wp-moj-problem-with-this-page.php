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
