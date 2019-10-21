<?php
// disable direct access
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
	// initialise labels
	$problem_label = get_option('pwtp-setting-7');
	$improvement_label = get_option('pwtp-setting-9');
	$submit_label = get_option('pwtp-setting-10');
	$error_message_label = get_option('pwtp-setting-12');
	// initialise messages
	$server_error_message = get_option('pwtp-setting-15');
	$thank_you_message = get_option('pwtp-setting-16');
	// problem label
	$value = $problem_label;
	if (empty($pwtp_atts['label_problem'])) {
		if (empty($value)) {
			$problem_label = __( 'What were you doing and what went wrong? (This information must be provided) Please don’t include personal or financial information like your name, National Insurance number or credit card details', 'wp-moj-problem-with-this-page' );
		} else {
			$problem_label = $value;
		}
	} else {
		$problem_label = $pwtp_atts['label_problem'];
	}
	$improvement_label = $_POST['value'] ?? '';
	// improvement label
	$value = $improvement_label;
	if (empty($pwtp_atts['label_improvement'])) {
		if (empty($value)) {
			$improvement_label = __( 'What could we improve?', 'wp-moj-problem-with-this-page' );
		} else {
			$improvement_label = $value;
		}
	} else {
		$improvement_label = $pwtp_atts['label_improvement'];
	}
	// submit label
	$value = $submit_label;
	if (empty($pwtp_atts['label_submit'])) {
		if (empty($value)) {
			$submit_label = __( 'Submit', 'wp-moj-problem-with-this-page' );
		} else {
			$submit_label = $value;
		}
	} else {
		$submit_label = $pwtp_atts['label_submit'];
	}
	$error_problem_label = $_POST['value'] ?? '';
	// error problem label
	$value = $error_problem_label;
	if (empty($pwtp_atts['error_problem'])) {
		if (empty($value)) {
			$error_problem_label = __( 'Please describe the problem you experienced.', 'wp-moj-problem-with-this-page' );
		} else {
			$error_problem_label = $value;
		}
	} else {
		$error_problem_label = $pwtp_atts['error_problem'];
	}
	// server error message
	$value = $server_error_message;
	if (empty($pwtp_atts['message_error'])) {
		if (empty($value)) {
			$server_error_message= __( 'Sorry! Could not send form. Please try again later, or get in touch via our contact page.', 'wp-moj-problem-with-this-page' );
		} else {
			$server_error_message = $value;
		}
	} else {
		$server_error_message = $pwtp_atts['message_error'];
	}
	// thank you message
	$value = $thank_you_message;
	if (empty($pwtp_atts['message_success'])) {
		if (empty($value)) {
			$thank_you_message = __( 'Thank you for your input.', 'wp-moj-problem-with-this-page' );
		} else {
			$thank_you_message = $value;
		}
	} else {
		$thank_you_message = $pwtp_atts['message_success'];
	}