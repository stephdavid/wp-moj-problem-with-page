<?php
// disable direct access
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// add admin options page
function pwtp_menu_page() {
    add_options_page( esc_attr__( 'PWTP', 'wp-moj-problem-with-this-page' ), esc_attr__( 'PWTP', 'wp-moj-problem-with-this-page' ), 'manage_options', 'pwtp', 'pwtp_options_page' );
}
add_action( 'admin_menu', 'pwtp_menu_page' );

// add admin settings
function pwtp_admin_init() {
	// General
	add_settings_section( 'pwtp-general-section', esc_attr__( 'General', 'wp-moj-problem-with-this-page' ), '', 'pwtp-general' );

	add_settings_field( 'pwtp-field-5', esc_attr__( 'Stakeholder/Administrator Name', 'wp-moj-problem-with-this-page' ), 'pwtp_field_callback_5', 'pwtp-general', 'pwtp-general-section' );
	register_setting( 'pwtp-general-options', 'pwtp-setting-5', array('sanitize_callback' => 'sanitize_email') );

	add_settings_field( 'pwtp-field-22', esc_attr__( 'Stakeholder/Administrator Email', 'wp-moj-problem-with-this-page' ), 'pwtp_field_callback_22', 'pwtp-general', 'pwtp-general-section' );
	register_setting( 'pwtp-general-options', 'pwtp-setting-22', array('sanitize_callback' => 'sanitize_email') );

	add_settings_field( 'pwtp-field-1', esc_attr__( 'Uninstall', 'wp-moj-problem-with-this-page' ), 'pwtp_field_callback_1', 'pwtp-general', 'pwtp-general-section' );
	register_setting( 'pwtp-general-options', 'pwtp-setting', array('sanitize_callback' => 'sanitize_key') );

}
add_action( 'admin_init', 'pwtp_admin_init' );

function pwtp_field_callback_5() {
	$placeholder = esc_attr( get_option( 'admin_name' ) );
	$value = esc_attr( get_option( 'pwtp-setting-5' ) );
	echo "<input type='text' size='40' name='pwtp-setting-5' placeholder='$placeholder' value='$value' />";
}

function pwtp_field_callback_22() {
	$placeholder = esc_attr( get_option( 'admin_email' ) );
	$value = esc_attr( get_option( 'pwtp-setting-22' ) );
	echo "<input type='text' size='40' name='pwtp-setting-22' placeholder='$placeholder' value='$value' />";
}

function pwtp_field_callback_1() {
	$value = esc_attr( get_option( 'pwtp-setting' ) );
	?>
	<input type='hidden' name='pwtp-setting' value='no'>
	<label><input type='checkbox' name='pwtp-setting' <?php checked( $value, 'yes' ); ?> value='yes'> <?php esc_attr_e( 'Do not delete settings.', 'wp-moj-problem-with-this-page' ); ?></label>
	<?php
}

function pwtp_field_callback_7() {
	$placeholder = esc_attr__( 'What were you doing and what went wrong? (This information must be provided) Please don’t include personal or financial information like your name, National Insurance Number or credit card details', 'wp-moj-problem-with-this-page' );
	$value = esc_attr( get_option( 'pwtp-setting-7' ) );
	echo "<input type='text' size='40' name='pwtp-setting-7' placeholder='$placeholder' value='$value' />";
}

function pwtp_field_callback_9() {
	$placeholder = esc_attr__( 'What could we improve?', 'wp-moj-problem-with-this-page' );
	$value = esc_attr( get_option( 'pwtp-setting-9' ) );
	echo "<input type='text' size='40' name='pwtp-setting-9' placeholder='$placeholder' value='$value' />";
}

function pwtp_field_callback_10() {
	$placeholder = esc_attr__( 'Submit', 'wp-moj-problem-with-this-page' );
	$value = esc_attr( get_option( 'pwtp-setting-10' ) );
	echo "<input type='text' size='40' name='pwtp-setting-10' placeholder='$placeholder' value='$value' />";
}

function pwtp_field_callback_15() {
	$placeholder = esc_attr__( 'Error! Could not send form. This might be a server issue.', 'wp-moj-problem-with-this-page' );
	$value = esc_attr( get_option( 'pwtp-setting-15' ) );
	echo "<input type='text' size='40' name='pwtp-setting-15' placeholder='$placeholder' value='$value' />";
}

function pwtp_field_callback_16() {
	$placeholder = esc_attr__( 'Thank you for your input!', 'wp-moj-problem-with-this-page' );
	$value = esc_attr( get_option( 'pwtp-setting-16' ) );
	echo "<input type='text' size='40' name='pwtp-setting-16' placeholder='$placeholder' value='$value' />";
}

// display admin options page
function pwtp_options_page() {
?>
<div class="wrap">
	<h1><?php esc_attr_e( 'Problem with this page - Admin', 'wp-moj-problem-with-this-page' ); ?></h1>
	<?php
	$active_tab = isset($_GET['tab']) ? $_GET['tab'] : 'general_options';
	?>

	<form action="options.php" method="POST">
		<?php if( $active_tab == 'general_options' ) { ?>
			<?php settings_fields( 'pwtp-general-options' ); ?>
			<?php do_settings_sections( 'pwtp-general' ); ?>
		<?php } ?>
		<?php submit_button(); ?>
	</form>
	
</div>
<?php
}
