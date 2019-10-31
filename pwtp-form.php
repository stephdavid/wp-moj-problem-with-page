<?php
// disable direct access
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
// Register and enqueue plugin scripts
function pwtp_scripts() {
    wp_register_script('wp-moj-problem-with-this-page-scripts', plugins_url( '/assets/js/get-hidden-form-elements-variables.js', __FILE__ ), array(), false, true);
    wp_register_script('wp-moj-problem-with-this-page-scripts', plugins_url( '/assets/js/get-user-timezone.js', __FILE__ ), array(), false, true);
    wp_enqueue_script('wp-moj-problem-with-this-page-scripts');
}
add_action( 'wp_enqueue_scripts', 'pwtp_scripts' );

?><p><em>Help us improve the experience for others. Please don’t include any personal information.</em></p>
<?php
// contact form
$email_form = '<form id="pwtp" class="'.$pwtp_atts['class'].'" method="post">

<div class="form-group pwtp-problem-group">
	<label for="pwtp_problem">'.$problem_label.': <span class="'.(isset($error_class['form_problem']) ? "pwtp-error" : "pwtp-hide").'" >'.$error_problem_label.'</span></label>
	<textarea name="pwtp_problem" id="pwtp_problem" rows="10" '.(isset($error_class['form_problem']) ? ' class="form-control pwtp-error"' : ' class="form-control"').'>'.$form_data['form_problem'].'</textarea>
</div>
<div class="form-group pwtp-improvement-group">
	<label for="pwtp_improvement">'.$improvement_label.'</label>
	<textarea name="pwtp_improvement" id="pwtp_improvement" rows="10">'.$form_data['form_improvement'].'</textarea>
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
<div>
	<input type="hidden" id="browser" name="browser" value="">
	<input type="hidden" name="version" id="version" value="">
	<input type="hidden" id="res" name="res" value="">
	<input type="hidden" id="os" name="os" value="">
	<input type="hidden" id="useragent" name="useragent" value="">
	<input type="hidden" id="language" name="language" value="">
	<input type="hidden" id="timezone" name="timezone" value="">
	<input type="hidden" id="prev_url" name="prev_url" value="'.$_SERVER['HTTP_REFERER'];'">
</div>
	</form>';
