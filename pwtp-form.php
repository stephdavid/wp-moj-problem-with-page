<?php
// disable direct access
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Register and enqueue plugin scripts
function pwtp_scripts() {
    wp_register_script('wp-moj-problem-with-page-scripts', plugins_url( '/assets/js/get-hidden-form-elements-variables.js', __FILE__ ), array(), false, true);
    wp_register_script('wp-moj-problem-with-page-scripts', plugins_url( '/assets/js/get-user-timezone.js', __FILE__ ), array(), false, true);
    wp_enqueue_script('wp-moj-problem-with-page-scripts');
}
add_action( 'wp_enqueue_scripts', ' add_pwtp_scripts' );

// contact form
	$email_form = '<form id="pwtp" class="'.$pwtp_atts['class'].'" method="post">
	<div class="form-group pwtp-problem-group">
		<label for="pwtp_problem">'.esc_attr($problem_label).': <span class="'.(isset($error_class['form_problem']) ? "pwtp-error" : "pwtp-hide").'" >'.esc_attr($error_problem_label).'</span></label>
		<input type="text" name="pwtp_problem" id="pwtp_problem" '.(isset($error_class['form_problem']) ? ' class="form-control pwtp-error"' : ' class="form-control"').' value="'.esc_attr($form_data['form_problem']).'" />
	</div>

	<div class="form-group pwtp-improvement-group">
		<label for="pwtp_improvement">'.esc_attr($improvement_label).' <span class="'.(isset($error_class['form_improvement']) ? "pwtp-error" : "pwtp-hide").'" >'.esc_attr($error_message_label).'</span></label>
		<textarea name="pwtp_improvement" id="pwtp_improvement" rows="20" '.(isset($error_class['form_improvement']) ? ' class="form-control pwtp-error"' : ' class="form-control"').'>'.esc_textarea($form_data['form_improvement']).'</textarea>
	</div>

	<div class="form-group pwtp-hide">
		'.$pwtp_nonce_field.'
	</div>
	
	<div class="form-group pwtp-submit-group">
		<button type="submit" name="'.$submit_name_id.'" id="'.$submit_name_id.'" class="btn btn-primary">'.esc_attr($submit_label).'</button>
	</div>
	
	<input type="hidden" id="url" name="url" value="">
	<input type="hidden" id="browser" name="browser" value="">
	<input type="hidden" name="version" id="version" value="">
	<input type="hidden" id="res" name="res" value="">
	<input type="hidden" id="os" name="os" value="">
	<input type="hidden" id="useragent" name="useragent" value="">
	<input type="hidden" id="language" name="language" value="">
	<input type="hidden" id="timezone" name="timezone" value="">
</form>';
