<?php
// disable direct access
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// contact form
$email_form = '<form id="pwtp" class="'.$pwtp_atts['class'].'" method="post">
	<div class="form-group pwtp-problem-group">
		<label for="pwtp_problem">'.esc_attr($problem_label).' <span class="'.(isset($error_class['form_problem']) ? "pwtp-error" : "pwtp-hide").'" >'.esc_attr($error_problem_label).'</span></label>
		<textarea name="pwtp_problem" id="pwtp_problem" rows="20" '.(isset($error_class['form_message']) ? ' class="form-control pwtp-error"' : ' class="form-control"').'>'.esc_textarea($form_data['form_message']).'</textarea>
	</div>
	<div class="form-group pwtp-improvement-group">
		<label for="pwtp_improvement">'.esc_attr($improvement_label).' <span class="'.(isset($error_class['form_message']) ? "pwtp-error" : "pwtp-hide").'" >'.esc_attr($error_message_label).'</span></label>
		<textarea name="pwtp_improvement" id="pwtp_improvement" rows="20" '.(isset($error_class['form_message']) ? ' class="form-control pwtp-error"' : ' class="form-control"').'>'.esc_textarea($form_data['form_message']).'</textarea>
	</div>
	<div class="form-group pwtp-hide">
		'.$pwtp_nonce_field.'
	</div>
	<div class="form-group pwtp-submit-group">
		<button type="submit" name="'.$submit_name_id.'" id="'.$submit_name_id.'" class="btn btn-primary">'.esc_attr($submit_label).'</button>
	</div>
</form>';

