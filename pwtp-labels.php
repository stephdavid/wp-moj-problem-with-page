<?php
// disable direct access
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
	// initialise labels
	$problem_label = get_option('pwtp-setting-7');
	$improvement_label = get_option('pwtp-setting-9');
	$captcha_label = get_option('pwtp-setting-8');
	$submit_label = get_option('pwtp-setting-10');
	$error_problem_label = get_option('pwtp-setting-20');
	$error_improvement_label = get_option('pwtp-setting-12');
	$error_captcha_label = get_option('pwtp-setting-14');
	
	// initialise messages
	$server_error_message = get_option('pwtp-setting-15');
	$thank_you_message = get_option('pwtp-setting-16');
	// problem label
	$value = $problem_label;
	if (empty($pwtp_atts['label_problem'])) {
		if (empty($value)) {
			$problem_label = 'What were you doing and what went wrong? (This information is required)';
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
			$improvement_label = __( 'What could we improve?', 'moj-problem-with-this-page' );
		} else {
			$improvement_label = $value;
		}
	} else {
		$improvement_label = $pwtp_atts['label_improvement'];
	}

	// captcha label
	$value = $captcha_label;
	if (empty($pwtp_atts['label_captcha'])) {
		if (empty($value)) {
			$captcha_label = __( 'Enter number %s', 'very-simple-contact-form' );
		} else {
			$captcha_label = $value;
		}
	} else {
		$captcha_label = $pwtp_atts['label_captcha'];
	}

	// submit label
	$value = $submit_label;
	if (empty($pwtp_atts['label_submit'])) {
		if (empty($value)) {
			$submit_label = __( 'Submit', 'moj-problem-with-this-page' );
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
			$error_problem_label = __( 'Please describe the problem you experienced.', 'moj-problem-with-this-page' );
		} else {
			$error_problem_label = $value;
		}
	} else {
		$error_problem_label = $pwtp_atts['error_problem'];
	}

	// error captcha label
	$value = $error_captcha_label;
	if (empty($pwtp_atts['error_captcha'])) {
		if (empty($value)) {
			$error_captcha_label = __( 'Please enter the correct number', 'very-simple-contact-form' );
		} else {
			$error_captcha_label = $value;
		}
	} else {
		$error_captcha_label = $pwtp_atts['error_captcha'];
	}
	
	// server error message
	$value = $server_error_message;
	if (empty($pwtp_atts['message_error'])) {
		if (empty($value)) {
			$server_error_message= __( 'Sorry! Could not send form. Please try again later, or get in touch via our contact page.', 'moj-problem-with-this-page' );
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
			$thank_you_message = __( 'Thank you for your input.', 'moj-problem-with-this-page' );
		} else {
			$thank_you_message = $value;
		}
	} else {
		$thank_you_message = $pwtp_atts['message_success'];
	}
	