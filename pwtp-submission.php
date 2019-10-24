<?php

// disable direct access
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if (isset($_POST['prev_url'])) {
	$prev_url = $_POST['prev_url'];

// email form to administrator
if ($error == false) {
	// hook to support plugin
	do_action( 'pwtp_before_send_mail', $form_data );
	// site name
	$blog_name = htmlspecialchars_decode(get_bloginfo('name'), ENT_QUOTES);
	// email - admin
	$email_admin = get_option('admin_email');
	// from email header
	$from = $pwtp_atts['from_header'];
	}

	// mail
	$the_problem = $form_data['form_problem'];
	$the_improvement = $form_data['form_improvement'];

	$to = $email_admin;
	$subject = ( "PWTP message from the $blog_name website" );
	$content = ( "<h1>Problem with this page</h1><p>A problem has been reported by a visitor to the <strong>$blog_name</strong> website on this page: <strong>$prev_url</strong></p>" ) . 
	sprintf( "<h2>What were you doing and what went wrong?</h2> %s ", $the_problem) .
	sprintf( "<h2>What could we improve?</h2> %s ", $the_improvement);
	$headers = "Content-Type: text/html; charset=UTF-8";

	if( wp_mail(esc_attr($to), wp_strip_all_tags($subject), $content, $headers) ) {
		$sent = true;
	} else {
		$fail = true;
	}
}
