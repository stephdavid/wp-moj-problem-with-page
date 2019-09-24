<?php
// disable direct access
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// shortcode for page
function pwtp_shortcode($pwtp_atts) {
	// attributes
	$pwtp_atts = shortcode_atts(array(
		'class' => 'pwtp-container',
		'email_to' => '',
		'from_header' => pwtp_from_header(),
		'prefix_problem' => '',
		'problem' => '',
		'label_name' => '',
		'label_email' => '',
		'label_problem' => '',
		'label_improvement' => '',
		'label_submit' => '',
		'error_name' => '',
		'error_email' => '',
		'error_problem' => '',
		'error_message' => '',
		'message_success' => '',
		'message_error' => '',
		'auto_reply_message' => ''
	), $pwtp_atts);

	// initialize variables
	$form_data = array(
		'form_name' => '',
		'form_email' => '',
		'form_problem' => '',
		'form_improvement' => ''
	);
	$error = false;
	$sent = false;
	$fail = false;

	// get custom settings from settingspage
	$list_submissions_setting = get_option('pwtp-setting-2');
	$subject_setting = get_option('pwtp-setting-23');
	$auto_reply_setting = get_option('pwtp-setting-3');
	$anchor_setting = get_option('pwtp-setting-21');
		
	// include labels
	include 'pwtp-labels.php';

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
		// sanitize input
		if ($problem_setting != "yes") {
			$problem_value = sanitize_text_field($_POST['pwtp_problem']);
		} else {
			$problem_value = '';
		}
		$post_data = array(
			'form_name' => sanitize_text_field($_POST['pwtp_name']),
			'form_email' => sanitize_email($_POST['pwtp_email']),
			'form_problem' => $problem_value,
			'form_improvement' => sanitize_textarea_field($_POST['pwtp_improvement'])
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
add_shortcode('contact', 'pwtp_shortcode');

// shortcode for settings widget
function pwtp_widget_shortcode($pwtp_atts) {
	// attributes
	$pwtp_atts = shortcode_atts(array(
		'class' => 'pwtp-container',
		'email_to' => '',
		'from_header' => pwtp_from_header(),
		'prefix_problem' => '',
		'problem' => '',
		'label_name' => '',
		'label_email' => '',
		'label_problem' => '',
		'label_improvement' => '',
		'label_submit' => '',
		'error_name' => '',
		'error_email' => '',
		'error_problem' => '',
		'error_message' => '',
		'message_success' => '',
		'message_error' => '',
		'auto_reply_message' => ''
	), $pwtp_atts);

	// initialize variables
	$form_data = array(
		'form_problem' => '',
		'form_improvement' => ''
	);
	$error = false;
	$sent = false;
	$fail = false;


	// get custom settings from settingspage
	$list_submissions_setting = get_option('pwtp-setting-2');
	$subject_setting = get_option('pwtp-setting-23');
	$anchor_setting = get_option('pwtp-setting-21');

	// include labels
	include 'pwtp-labels.php';

	// set nonce field
	$pwtp_nonce_field = wp_nonce_field( 'pwtp_widget_nonce_action', 'pwtp_widget_nonce', true, false );

	// form anchor
	if ($anchor_setting == "yes") {
		$anchor_begin = '<div id="pwtp-anchor">';
		$anchor_end = '</div>';
	} else {
		$anchor_begin = '';
		$anchor_end = '';
	}

	// processing form
	if (($_SERVER['REQUEST_METHOD'] == 'POST') && isset($_POST['pwtp_widget_send']) && isset( $_POST['pwtp_widget_nonce'] ) && wp_verify_nonce( $_POST['pwtp_widget_nonce'], 'pwtp_widget_nonce_action' ) ) {
		// sanitize input
		if ($problem_setting != "yes") {
			$problem_value = sanitize_text_field($_POST['pwtp_problem']);
		} else {
			$problem_value = '';
		}
		$post_data = array(
			'form_name' => sanitize_text_field($_POST['pwtp_name']),
			'form_email' => sanitize_email($_POST['pwtp_email']),
			'form_problem' => $problem_value,
			'form_improvement' => sanitize_textarea_field($_POST['pwtp_improvement'])
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
		return '<script type="text/javascript">window.location="'.pwtp_widget_redirect_success().'"</script>';
	} elseif ($fail == true) {
		return '<script type="text/javascript">window.location="'.pwtp_widget_redirect_error().'"</script>';
	}

	// display form or the result of submission
	if ( isset( $_GET['pwtpsw'] ) ) {
		if ( $_GET['pwtpsw'] == 'success' ) {
			return $anchor_begin . '<p class="pwtp-info">'.esc_attr($thank_you_message).'</p>' . $anchor_end;
		} elseif ( $_GET['pwtpsw'] == 'fail' ) {
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
