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

// form submissions
$list_submissions_setting = get_option('pwtp-setting-2');
if ($list_submissions_setting == "yes") {
	// create submission post type
	function pwtp_custom_postype() {
		$pwtp_args = array(
			'labels' => array('name' => esc_attr__( 'Submissions', 'wp-moj-problem-with-this-page' )),
			'menu_icon' => 'dashicons-email',
			'public' => false,
			'can_export' => true,
			'show_in_nav_menus' => false,
			'show_ui' => true,
			'show_in_rest' => true,
			'capability_type' => 'post',
			'capabilities' => array( 'create_posts' => 'do_not_allow' ),
			'map_meta_cap' => true,
 			'supports' => array( 'title', 'editor' )
		);
		register_post_type( 'submission', $pwtp_args );
	}
	add_action( 'init', 'pwtp_custom_postype' );

	// dashboard submission columns
	function pwtp_custom_columns( $columns ) {
		$columns['problem_column'] = esc_attr__( 'Problem', 'wp-moj-problem-with-this-page' );
		$columns['improvement_column'] = esc_attr__( 'Suggested Improvement', 'wp-moj-problem-with-this-page' );
		$custom_order = array('cb', 'date', 'problem_column', 'improvement_column');
		foreach ($custom_order as $colname) {
			$new[$colname] = $columns[$colname];
		}
		return $new;
    }
    add_filter( 'manage_submission_posts_columns', 'pwtp_custom_columns', 10 );
    
	function pwtp_custom_columns_content( $column_name, $post_id ) {
		if ( 'problem_column' == $column_name ) {
			$name = get_post_meta( $post_id, 'name_sub', true );
			echo $name;
		}
		if ( 'improvement_column' == $column_name ) {
			$email = get_post_meta( $post_id, 'email_sub', true );
			echo $email;
		}
    }
	add_action( 'manage_submission_posts_custom_column', 'pwtp_custom_columns_content', 10, 2 );

	// make problem and improvement column sortable
	function pwtp_column_register_sortable( $columns ) {
		$columns['problem_column'] = 'name_sub';
		$columns['improvement_column'] = 'email_sub';
		return $columns;
	}
	add_filter( 'manage_edit-submission_sortable_columns', 'pwtp_column_register_sortable' );

	function pwtp_name_column_orderby( $vars ) {
		if(is_admin()) {
			if ( isset( $vars['orderby'] ) && 'name_sub' == $vars['orderby'] ) {
				$vars = array_merge( $vars, array(
					'meta_key' => 'name_sub',
					'orderby' => 'meta_value'
				) );
			}
		}
		return $vars;
	}
	add_filter( 'request', 'pwtp_name_column_orderby' );

	function pwtp_email_column_orderby( $vars ) {
		if(is_admin()) {
			if ( isset( $vars['orderby'] ) && 'email_sub' == $vars['orderby'] ) {
				$vars = array_merge( $vars, array(
					'meta_key' => 'email_sub',
					'orderby' => 'meta_value'
				) );
			}
		}
		return $vars;
	}
	add_filter( 'request', 'pwtp_email_column_orderby' );
}

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
