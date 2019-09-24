<?php
// disable direct access
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
// validate problem
if ($problem_setting != "yes") {
	$value = stripslashes($post_data['form_problem']);
	if ( strlen($value)<2 ) {
		$error_class['form_problem'] = true;
		$error = true;
	}
	$form_data['form_problem'] = $value;
	}

