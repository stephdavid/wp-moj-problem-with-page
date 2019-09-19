<?php

/*
Plugin Name:	WP MoJ Problem with this page plugin
Plugin URI:
Description:	Custom form for user to send email notification 
of a problem with the page
Version:	1.0
Author:	Ministry of Justice
https://peoplefinder.service.gov.uk/people/stephanie-david
License:	MIT
*/

// Exit if accessed directly
if (!defined('ABSPATH')) {
    exit();
}

// Include wp-moj-functions.php, use require_once to stop the script if wp-moj-functions.php is not found
require_once plugin_dir_path(__FILE__) . 'includes/wp-moj-functions.php';






// Action hook for registering and enqueuing plugin scripts and styles
add_action( 'wp_enqueue_scripts', ' add_wp_moj_problem_with_page_assets' );

// Register and enqueue plugin scripts and styles
function wp_moj_problem_with_page_assets() {
    wp_register_script( 'wp-moj-problem-with-page-scripts', plugins_url( '/assets/js/document-ready.js', __FILE__ ), array( 'jquery' );
    wp_register_script( 'wp-moj-problem-with-page-scripts', plugins_url( '/assets/js/main.js', __FILE__ ), array( 'jquery' ), false, true;
    wp_register_script( 'wp-moj-problem-with-page-scripts', plugins_url( '/assets/js/get-hidden-form-elements-variables.js', __FILE__ ), array(), false, true );

    wp_register_style( 'wp-moj-problem-with-page-styles', plugins_url( '/assets/css/main.css', __FILE__ ) );
    wp_enqueue_script( 'wp-moj-problem-with-page-scripts' );
    wp_enqueue_style( 'wp-moj-problem-with-page-styles' );
}
  

// Action hook for registering and enqueuing plugin admin scripts and styles
add_action( 'admin_enqueue_scripts', ' add_wp_moj_problem_with_page_admin_assets' );

// Register and enqueue script and styles for the plugin admin interface (Dashboard)
function wp_moj_problem_with_page_admin_assets(){
    wp_register_script( 'wp-moj-problem-with-page-admin-scripts', plugins_url( '/admin/js/main.js', __FILE__ ) );
    wp_register_style( 'wp-moj-problem-with-page-admin-styles', plugins_url( '/wp-moj-problem-with-page/admin/css/main.css', __FILE__ ) );
    wp_enqueue_script( 'wp-moj-problem-with-page-admin-scripts' );
    wp_enqueue_style( 'wp-moj-problem-with-page-admin-styles' );
}
?>
