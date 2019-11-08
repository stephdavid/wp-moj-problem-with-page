<?php
// disable direct access
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if (!empty($_POST['prev_url'])) {
	$prev_url = $_POST['prev_url'];
}

// sending form submission
if ($error == false) {
	// hook to support plugin
	do_action( 'pwtp_before_send_mail', $form_data );
	// site name
	$blog_name = htmlspecialchars_decode(get_bloginfo('name'), ENT_QUOTES);
	// email address admin
	$email_admin = get_option('admin_email');
	$email_settings = get_option('pwtp-setting-22');
	if (!empty($pwtp_atts['email_to'])) {
		$to = $pwtp_atts['email_to'];
	} else {
		if (!empty($email_settings)) {
			$to = $email_settings;
		} else {
			$to = $email_admin;
		}
	}

	// subject
	if (!empty($pwtp_atts['prefix_subject'])) {
		$prefix = $pwtp_atts['prefix_subject'];
	} else {
		$prefix = $blog_name;
	}

	if (!empty($pwtp_atts['subject'])) {
		$subject = $pwtp_atts['subject'];
	} 
	else {
		$subject = $prefix;
	}

	// mail
	$subject = "PWTP message from the $blog_name website" ;
	$content = "<h1>Problem with this page</h1><p>A problem has been reported by a visitor to the <strong>$blog_name</strong> website on this page: <strong>$prev_url</strong></p> 
	<h2>What were you doing and what went wrong?</h2>
	<p>" . $form_data['form_problem'] . "</p>
	<h2>What could we improve?</h2>
	<p>" . $form_data['form_improvement'] . "</p>
	<h2>Browser Data</h2>
	<p>User Agent:	" . $_SERVER['HTTP_USER_AGENT'] . "</p>
	";
	$headers = "Content-Type: text/html; charset=UTF-8";
	if( wp_mail(esc_attr($to), wp_strip_all_tags($subject), $content, $headers) ) {
		$sent = true;
	} else {
		$fail = true;
	}
}
