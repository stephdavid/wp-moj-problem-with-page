<?php
// disable direct access
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

?><p><em>Help us improve the experience for others. Please don’t include any personal information.</em></p>
<?php

$email_form = '<form id="pwtp" class="'.$pwtp_atts['class'].'" method="post">
<div class="form-group pwtp-problem-group">
	<label for="pwtp_problem">'.esc_attr($problem_label).': <span class="'.(isset($error_class['form_problem']) ? "pwtp-error" : "pwtp-hide").'" >'.esc_attr($error_problem_label).'</span></label>
	<textarea name="pwtp_problem" id="pwtp_problem" rows="10" '.(isset($error_class['form_problem']) ? ' class="form-control pwtp-error"' : ' class="form-control"').'>'.esc_textarea($form_data['form_problem']).'</textarea>
</div>
<div class="form-group pwtp-improvement-group">
	<label for="pwtp_improvement">'.esc_attr($improvement_label).' <span class="'.(isset($error_class['form_improvement']) ? "pwtp-error" : "pwtp-hide").'" >'.esc_attr($error_improvement_label).'</span></label>
	<textarea name="pwtp_improvement" id="pwtp_improvement" rows="10" '.(isset($error_class['form_improvement']) ? ' class="form-control pwtp-error"' : ' class="form-control"').'>'.esc_textarea($form_data['form_improvement']).'</textarea>
</div>
<div class="form-group pwtp-captcha-group">
	<label for="pwtp_captcha">'.sprintf(esc_attr($captcha_label), $pwtp_rand).': <span class="'.(isset($error_class['form_captcha']) ? "pwtp-error" : "pwtp-hide").'" >'.esc_attr($error_captcha_label).'</span></label>
	<input type="hidden" name="pwtp_captcha_hidden" id="pwtp_captcha_hidden" value="'.$pwtp_rand.'" />
	<input type="text" name="pwtp_captcha" id="pwtp_captcha" '.(isset($error_class['form_captcha']) ? ' class="form-control pwtp-error"' : ' class="form-control"').' value="'.esc_attr($form_data['form_captcha']).'" />
</div>
<div class="form-group pwtp-hide">
	'.$pwtp_nonce_field.'
</div>

<div class="form-group pwtp-submit-group">
	<button type="submit" name="'.$submit_name_id.'" id="'.$submit_name_id.'" class="btn btn-primary">'.$submit_label.'</button>
</div>
<input type="hidden" id="prev_url" name="prev_url" value="'.$_SERVER['HTTP_REFERER'].'">
</form>';
