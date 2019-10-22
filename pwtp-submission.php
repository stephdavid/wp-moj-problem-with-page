<?php
// disable direct access
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
// sending and saving form submission
if ($error == false) {
	// hook to support plugin Problem with Page Form DB
	do_action( 'pwtp_before_send_mail', $form_data );
	// site name
	$blog_name = htmlspecialchars_decode(get_bloginfo('name'), ENT_QUOTES);
	// email address admin
	$email_admin = get_option('admin_email');
	$email_settings = get_option('pwtp-setting-22');
	if (!empty($pwtp_atts['email_to'])) {
		$to = $pwtp_atts['email_to'];
	} 
	else {
		if (!empty($email_settings)) {
			$to = $email_settings;
		}
		else {
			$to = $email_admin;
		}
	}
	// from email header
	$from = $pwtp_atts['from_header'];
	// subject
	if (!empty($pwtp_atts['prefix_subject'])) {
		$prefix = $pwtp_atts['prefix_subject'];
	} 
	else {
		$prefix = $blog_name;
	}
	if (!empty($pwtp_atts['subject'])) {
		$subject = $pwtp_atts['subject'];
	}
	else {
		$subject = $prefix;
	}
	// auto reply message
	$reply_message = htmlspecialchars_decode($auto_reply_message, ENT_QUOTES);
	// save form submission in database
	if ($list_submissions_setting == "yes") {
		$pwtp_post_information = array(
			'post_title' => wp_strip_all_tags($subject),
			'post_content' => $form_data['form_problem'] . "\r\n\r\n" . $form_data['form_improvement'] . "\r\n\r\n",
			'post_type' => 'submission',
			'post_status' => 'pending',
			'meta_input' => array( "problem_sub" => $form_data['form_problem'], "improvement_sub" => $form_data['form_improvement'] )
		);
		$post_id = wp_insert_post($pwtp_post_information);
	}
	// mail
	$content = $form_data['form_problem'] . "\r\n\r\n" . $form_data['form_improvement'] . "\r\n\r\n" . $form_data['form_message'] . "\r\n\r\n";
	$headers = "Content-Type: text/plain; charset=UTF-8" . "\r\n";
	$headers .= "Problem: <".$form_data['form_problem'].">" . "\r\n";
	$headers .= "Improvement: <".$form_data['form_improvement'].">" . "\r\n";
	$auto_reply_content = $reply_message . "\r\n\r\n" . $form_data['form_problem'] . "\r\n\r\n" . $form_data['form_improvement'] . "\r\n\r\n" . $form_data['form_message'];
	$auto_reply_headers = "Content-Type: text/plain; charset=UTF-8" . "\r\n";
	$auto_reply_headers .= "From: ".$blog_name." <".$from.">" . "\r\n";

	if( wp_mail(esc_attr($to), wp_strip_all_tags($subject), $content, $headers) ) {
		$sent = true;
	} else {
		$fail = true;
	}
}