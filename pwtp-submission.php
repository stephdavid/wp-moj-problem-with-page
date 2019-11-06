<?php
// disable direct access
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if (isset($_POST['prev_url'])) {
	$prev_url = $_POST['prev_url'];
}

if (isset($_POST['browser'])) {
	$browser = $_POST['browser'];
}

if (isset($_POST['os'])) {
	$os = $_POST['os'];
}

if (isset($_POST['version'])) {
	$version = $_POST['version'];
}

if (isset($_POST['language'])) {
	$language = $_POST['language'];
}

if (isset($_POST['res'])) {
	$res = $_POST['res'];
}

if (isset($_POST['timezone'])) {
	$timezone = $_POST['timezone'];
}

// sending and saving form submission
if ($error == false) {
	// hook to support plugin
	do_action( 'pwtp_before_send_mail', $form_data );
	// site name
	$blog_name = htmlspecialchars_decode(get_bloginfo('name'), ENT_QUOTES);
	// email address admin
	$email_admin = get_option('admin_email');
	//$email_stakeholder = get_option('stakeholder_email');
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
	// from email header
	//$from = $pwtp_atts['from_header'];
	// subject
	if (!empty($pwtp_atts['prefix_subject'])) {
		$prefix = $pwtp_atts['prefix_subject'];
	} else {
		$prefix = $blog_name;
	}
	if (!empty($pwtp_atts['subject'])) {
		$subject = $pwtp_atts['subject'];
	} //elseif ($subject_setting != "yes") {
				//$subject = "(".$prefix.") " . $form_data['form_subject'];
			//} 
	else {
		$subject = $prefix;
	}
	// auto reply message
	//$reply_message = htmlspecialchars_decode($auto_reply_message, ENT_QUOTES);

	// save form submission in database
	if ($list_submissions_setting == "yes") {
		$pwtp_post_information = array(
			'post_title' => wp_strip_all_tags($subject),
			'post_content' => $form_data['problem'] . "\r\n\r\n" . $form_data['improvement'] . "\r\n\r\n",
			'post_type' => 'submission',
			'post_status' => 'pending',
			'meta_input' => array( "name_sub" => $form_data['form_problem'], "email_sub" => $form_data['form_improvement'] )
		);
	$post_id = wp_insert_post($pwtp_post_information);
	}
	// mail
	$subject = "PWTP message from the $blog_name website" ;
	$content = "<h1>Problem with this page</h1><p>A problem has been reported by a visitor to the <strong>$blog_name</strong> website on this page: <strong>$prev_url</strong></p> 
	<h2>What were you doing and what went wrong?</h2>
	<p>" . $form_data['form_problem'] . "</p>
	<h2>What could we improve?</h2>
	<p>" . $form_data['form_improvement'] . "</p>
	<h2>Browser Data</h2>
	<p>User Agent:	" . $_SERVER['HTTP_USER_AGENT'] . "</p>";
	$headers = "Content-Type: text/html; charset=UTF-8";

	if( wp_mail(esc_attr($to), wp_strip_all_tags($subject), $content, $headers) ) {
		$sent = true;
	} else {
		$fail = true;
	}
}


/*

<li>Timestamp (should be Timezone): " . $_SERVER['REQUEST_TIME'] . "</li>


<ol>
<li>Browser: " . $browser = $_POST['browser'] . "</li>
<li>Operating System: " . $os = $_POST['os'] . "</li>
<li>Version: " . $version = $_POST['version'] . "</li> 
<li>Language: " . $language = $_POST['language'] . "</li> 
<li>Resolution: " . $res = $_POST['res'] . "</li> 
<li>Timezone: " . $timezone = $_POST['timezone'] . "</li>
<li>User Agent: " . $_SERVER['HTTP_USER_AGENT'] . "</li></ol>"
*/