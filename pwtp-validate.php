<?php
// disable direct access
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// validate captcha
$value = stripslashes($post_data['form_captcha']);
$hidden = stripslashes($post_data['form_captcha_hidden']);
if ( $value != $hidden ) {
	$error_class['form_captcha'] = true;
	$error = true;
}
$form_data['form_captcha'] = $value;

// validate problem
$value = stripslashes($post_data['form_problem']);
if ( strlen($value)<10 ) {
	$error_class['form_problem'] = true;
	$error = true;
}
$form_data['form_problem'] = $value;

// validate improvement
$value = stripslashes($post_data['form_improvement']);
if ( strlen($value)<10 ) {
	$error_class['form_improvement'] = true;
	$error = true;
}
$form_data['form_improvement'] = $value;

