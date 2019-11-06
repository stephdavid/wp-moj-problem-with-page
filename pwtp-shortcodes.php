<?php
// disable direct access
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if (isset($_POST['browser'])) {
	$browser = $_POST['browser'];
}


if (isset($_POST['time'])) {
	$time = $_POST['time'];
}

// shortcode for page
function pwtp_shortcode($pwtp_atts) {
	// attributes
	$pwtp_atts = shortcode_atts(array(
		'class' => 'pwtp-container',
		'email_to' => '',
		//'from_header' => pwtp_from_header(),
		//'prefix_problem' => '',
		'improvement' => '',
		'problem' => '',
		'label_problem' => '',
		'label_improvement' => '',
		'label_submit' => '',
		'error_problem' => '',
		'error_improvement' => '',
		'message_success' => '',
		'message_error' => ''
	), $pwtp_atts);

	// initialize variables
	$form_data = array(
		'form_problem' => '',
		'form_improvement' => '',
		'form_captcha' => ''
	);
	$error = false;
	$sent = false;
	$fail = false;

	// initialise settings
	$list_submissions_setting = get_option('pwtp-setting-2');
	$anchor_setting = get_option('pwtp-setting-21');
	// include labels
	include 'pwtp-labels.php';
	// captcha
	$pwtp_rand = pwtp_random_number();
	// set nonce field
	$pwtp_nonce_field = wp_nonce_field( 'pwtp_nonce_action', 'pwtp_nonce', true, false );
	// name and id of submit button
	$submit_name_id = 'pwtp_send';
	// form anchor
	if ($anchor_setting == "yes") {
		$anchor_begin = '<div id="pwtp-anchor">';
		$anchor_end = '</div>';
	} else {
		$anchor_begin = '';
		$anchor_end = '';
	}
	// processing form
	if (($_SERVER['REQUEST_METHOD'] == 'POST') && isset($_POST['pwtp_send']) && isset( $_POST['pwtp_nonce'] ) && wp_verify_nonce( $_POST['pwtp_nonce'], 'pwtp_nonce_action' ) ) {
		$post_data = array(
			'form_problem' => sanitize_textarea_field($_POST['pwtp_problem']),
			'form_improvement' => sanitize_textarea_field($_POST['pwtp_improvement']),
			'form_captcha' => sanitize_text_field($_POST['pwtp_captcha']),
			'form_captcha_hidden' => sanitize_text_field($_POST['pwtp_captcha_hidden']),
			'browser' => $_POST['browser'] ?? '' ,
			'version' => $_POST['version'] ?? '' ,
			'res' => $_POST['res'] ?? '' ,
			'os' => $_POST['os'] ?? '' ,
			'useragent' => $_POST['useragent'] ?? '' ,
			'language' => $_POST['language'] ?? '' ,
			'timezone' => $_POST['timezone'] ?? '' 
		);
		
	// include validation
	include 'pwtp-validate.php';
	// include sending and saving form submission
	include 'pwtp-submission.php';
	}
	// include form
	include 'pwtp-form.php';
	// after form validation
	if ($sent == true) {
		return '<script>window.location="'.pwtp_redirect_success().'"</script>';
	} elseif ($fail == true) {
		return '<script>window.location="'.pwtp_redirect_error().'"</script>';
	}
	// display form or the result of submission
	if ( isset( $_GET['pwtpsp'] ) ) {
		if ( $_GET['pwtpsp'] == 'success' ) {
			return $anchor_begin . '<p class="pwtp-info">'.esc_attr($thank_you_message).'</p>' . $anchor_end;
		} elseif ( $_GET['pwtpsp'] == 'fail' ) {
			return $anchor_begin . '<p class="pwtp-info">'.esc_attr($server_error_message).'</p>' . $anchor_end;
		}	
	} else {
		if ($error == true) {
			return $anchor_begin .$email_form. $anchor_end;
		} else {
			return $email_form;
		}
	}	   		
} 
add_shortcode('pwtp', 'pwtp_shortcode');
