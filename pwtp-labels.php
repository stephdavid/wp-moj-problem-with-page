<?php
// disable direct access
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
	// initialise labels
	$name_label = get_option('pwtp-setting-5');
	$email_label = get_option('pwtp-setting-6');
	$problem_label = get_option('pwtp-setting-7');
	$improvement_label = get_option('pwtp-setting-9');
	$subject_label = get_option('pwtp-setting-23');
	$submit_label = get_option('pwtp-setting-10');
	$error_name_label = get_option('pwtp-setting-11');
	$error_subject_label = get_option('pwtp-setting-20');
	$error_improvement_label = get_option('pwtp-setting-12');
	$error_email_label = get_option('pwtp-setting-13');
	// initialise messages
	$server_error_message = get_option('pwtp-setting-15');
	$thank_you_message = get_option('pwtp-setting-16');
	$auto_reply_message = get_option('pwtp-setting-17');
	
	// name label
	$value = $name_label;
	if (empty($pwtp_atts['label_name'])) {
		if (empty($value)) {
			$name_label = __( 'Name', 'moj-problem-with-this-page' );
		} else {
			$name_label = $value;
		}
	} else {
		$name_label = $pwtp_atts['label_name'];
	}
	
	// problem label
	$value = $problem_label;
	if (empty($pwtp_atts['label_problem'])) {
		if (empty($value)) {
			$problem_label = __( 'What were you doing and what went wrong? (This information must be provided) Please don’t include personal or financial information like your name, National Insurance number or credit card details', 'moj-problem-with-this-page' );
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
	// email label
	$value = $email_label;
	if (empty($pwtp_atts['label_email'])) {
		if (empty($value)) {
			$email_label = __( 'Email', 'moj-problem-with-this-page' );
		} else {
			$email_label = $value;
		}
	} else {
		$email_label = $pwtp_atts['label_email'];
	}

	// subject label
	$value = $subject_label;
	if (empty($pwtp_atts['label_subject'])) {
		if (empty($value)) {
			$subject_label = __( 'Subject', 'moj-problem-with-this-page' );
		} else {
			$subject_label = $value;
		}
	} else {
		$subject_label = $pwtp_atts['label_subject'];
	}

	// improvement label
	$value = $improvement_label;
	if (empty($pwtp_atts['label_improvement'])) {
		if (empty($value)) {
			$improvement_label = __( 'Improvement', 'moj-problem-with-this-page' );
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
			$submit_label = __( 'Submit', 'moj-problem-with-this-page' );
		} else {
			$submit_label = $value;
		}
	} else {
		$submit_label = $pwtp_atts['label_submit'];
	}
	$error_problem_label = $_POST['value'] ?? '';

	// error name label
	$value = $error_name_label;
	if (empty($pwtp_atts['error_name'])) {
		if (empty($value)) {
			$error_name_label = __( 'Please enter at least 2 characters', 'moj-problem-with-this-page' );
		} else {
			$error_name_label = $value;
		}
	} else {
		$error_name_label = $pwtp_atts['error_name'];
	}

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

	// error email label
	$value = $error_email_label;
	if (empty($pwtp_atts['error_email'])) {
		if (empty($value)) {
			$error_email_label = __( 'Please enter a valid email', 'moj-problem-with-this-page' );
		} else {
			$error_email_label = $value;
		}
	} else {
		$error_email_label = $pwtp_atts['error_email'];
	}

	// error subject label
	$value = $error_subject_label;
	if (empty($pwtp_atts['error_subject'])) {
		if (empty($value)) {
			$error_subject_label = __( 'Please enter at least 2 characters', 'moj-problem-with-this-page' );
		} else {
			$error_subject_label = $value;
		}
	} else {
		$error_subject_label = $pwtp_atts['error_subject'];
	}

	// error improvement label
	$value = $error_improvement_label;
	if (empty($pwtp_atts['error_improvement'])) {
		if (empty($value)) {
			$error_improvement_label = __( 'Please enter at least 10 characters', 'moj-problem-with-this-page' );
		} else {
			$error_improvement_label = $value;
		}
	} else {
		$error_improvement_label = $vscf_atts['error_improvement'];
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
	
	// auto reply message
	$value = $auto_reply_message;
	if (empty($pwtp_atts['auto_reply_message'])) {
		if (empty($value)) {
			$auto_reply_message = __( 'Thank you! Your input is appreciated.', 'moj-problem-with-this-page' );
		} else {
			$auto_reply_message = $value;
		}
	} else {
		$auto_reply_message = $pwtp_atts['auto_reply_message'];
	}
