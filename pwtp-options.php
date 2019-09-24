<?php
// disable direct access
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// add admin options page
function pwtp_menu_page() {
    add_options_page( esc_attr__( 'pwtp', 'wp-moj-problem-with-this-page' ), esc_attr__( 'pwtp', 'wp-moj-problem-with-this-page' ), 'manage_options', 'pwtp', 'pwtp_options_page' );
}
add_action( 'admin_menu', 'pwtp_menu_page' );

// add admin settings and such
function pwtp_admin_init() {
	add_settings_section( 'pwtp-general-section', esc_attr__( 'General', 'wp-moj-problem-with-this-page' ), '', 'pwtp-general' );

	add_settings_field( 'pwtp-field-22', esc_attr__( 'Stakeholder/Administrator Email', 'wp-moj-problem-with-this-page' ), 'pwtp_field_callback_22', 'pwtp-general', 'pwtp-general-section' );
	register_setting( 'pwtp-general-options', 'pwtp-setting-22', array('sanitize_callback' => 'sanitize_email') );

	add_settings_field( 'pwtp-field-1', esc_attr__( 'Uninstall', 'wp-moj-problem-with-this-page' ), 'pwtp_field_callback_1', 'pwtp-general', 'pwtp-general-section' );
	register_setting( 'pwtp-general-options', 'pwtp-setting', array('sanitize_callback' => 'sanitize_key') );

	add_settings_section( 'pwtp-label-section', esc_attr__( 'Labels', 'wp-moj-problem-with-this-page' ), '', 'pwtp-label' );

	add_settings_field( 'pwtp-field-7', esc_attr__( 'What were you doing and what went wrong? (This information must be provided)', 'wp-moj-problem-with-this-page' ), 'pwtp_field_callback_7', 'pwtp-label', 'pwtp-label-section' );
	register_setting( 'pwtp-label-options', 'pwtp-setting-7', array('sanitize_callback' => 'sanitize_text_field') );

	add_settings_field( 'pwtp-field-9', esc_attr__( 'Improvement', 'wp-moj-problem-with-this-page' ), 'pwtp_field_callback_9', 'pwtp-label', 'pwtp-label-section' );
	register_setting( 'pwtp-label-options', 'pwtp-setting-9', array('sanitize_callback' => 'sanitize_text_field') );

	add_settings_field( 'pwtp-field-10', esc_attr__( 'Submit', 'wp-moj-problem-with-this-page' ), 'pwtp_field_callback_10', 'pwtp-label', 'pwtp-label-section' );
	register_setting( 'pwtp-label-options', 'pwtp-setting-10', array('sanitize_callback' => 'sanitize_text_field') );

	add_settings_field( 'pwtp-field-7', esc_attr__( 'Problem' ), 'pwtp_field_callback_7', 'pwtp-label', 'pwtp-label-section' );
	add_settings_section( 'pwtp-message-section', esc_attr__( 'Messages', 'wp-moj-problem-with-this-page' ), '', 'pwtp-message' );

	add_settings_field( 'pwtp-field-15', esc_attr__( 'Server error message', 'wp-moj-problem-with-this-page' ), 'pwtp_field_callback_15', 'pwtp-message', 'pwtp-message-section' );
	register_setting( 'pwtp-message-options', 'pwtp-setting-15', array('sanitize_callback' => 'sanitize_text_field') );

	add_settings_field( 'pwtp-field-16', esc_attr__( 'Thank you message', 'wp-moj-problem-with-this-page' ), 'pwtp_field_callback_16', 'pwtp-message', 'pwtp-message-section' );
	register_setting( 'pwtp-message-options', 'pwtp-setting-16', array('sanitize_callback' => 'sanitize_text_field') );
}
add_action( 'admin_init', 'pwtp_admin_init' );

function pwtp_field_callback_22() {
	$placeholder = esc_attr( get_option( 'admin_email' ) );
	$value = esc_attr( get_option( 'pwtp-setting-22' ) );
	echo "<input type='text' size='40' name='pwtp-setting-22' placeholder='$placeholder' value='$value' />";
}

function pwtp_field_callback_1() {
	$value = esc_attr( get_option( 'pwtp-setting' ) );
	?>
	<input type='hidden' name='pwtp-setting' value='no'>
	<label><input type='checkbox' name='pwtp-setting' <?php checked( $value, 'yes' ); ?> value='yes'> <?php esc_attr_e( 'Do not delete form submissions and settings.', 'wp-moj-problem-with-this-page' ); ?></label>
	<?php
}

function pwtp_field_callback_7() {
	$placeholder = esc_attr__( 'What were you doing and what went wrong? (This information must be provided)', 'wp-moj-problem-with-this-page' );
	$value = esc_attr( get_option( 'pwtp-setting-7' ) );
	echo "<input type='text' size='40' name='pwtp-setting-7' placeholder='$placeholder' value='$value' />";
}

function pwtp_field_callback_8() {
	$placeholder = esc_attr__( 'Enter number %s', 'wp-moj-problem-with-this-page' );
	$value = esc_attr( get_option( 'pwtp-setting-8' ) );
	echo "<input type='text' size='40' name='pwtp-setting-8' placeholder='$placeholder' value='$value' />";
}

function pwtp_field_callback_9() {
	$placeholder = esc_attr__( 'What could we improve?', 'wp-moj-problem-with-this-page' );
	$value = esc_attr( get_option( 'pwtp-setting-9' ) );
	echo "<input type='text' size='40' name='pwtp-setting-9' placeholder='$placeholder' value='$value' />";
}

function pwtp_field_callback_18() {
	$placeholder = esc_attr__( 'I consent to having this website collect my personal data via this form.', 'wp-moj-problem-with-this-page' );
	$value = esc_attr( get_option( 'pwtp-setting-18' ) );
	echo "<input type='text' size='40' name='pwtp-setting-18' placeholder='$placeholder' value='$value' />";
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
	<h1><?php esc_attr_e( 'Problem with this page', 'wp-moj-problem-with-this-page' ); ?></h1>
	<?php
	$active_tab = isset($_GET['tab']) ? $_GET['tab'] : 'general_options';
	?>
	<h2 class="nav-tab-wrapper">
		<a href="?page=pwtp&tab=general_options" class="nav-tab <?php echo $active_tab == 'general_options' ? 'nav-tab-active' : ''; ?>"><?php esc_attr_e( 'General', 'wp-moj-problem-with-this-page' ); ?></a>
		<a href="?page=pwtp&tab=label_options" class="nav-tab <?php echo $active_tab == 'label_options' ? 'nav-tab-active' : ''; ?>"><?php esc_attr_e( 'Labels', 'wp-moj-problem-with-this-page' ); ?></a>
		<a href="?page=pwtp&tab=message_options" class="nav-tab <?php echo $active_tab == 'message_options' ? 'nav-tab-active' : ''; ?>"><?php esc_attr_e( 'Messages', 'wp-moj-problem-with-this-page' ); ?></a>
	</h2>
	<form action="options.php" method="POST">
		<?php if( $active_tab == 'general_options' ) { ?>
			<?php settings_fields( 'pwtp-general-options' ); ?>
			<?php do_settings_sections( 'pwtp-general' ); ?>
		<?php } elseif( $active_tab == 'label_options' ) { ?>
			<?php settings_fields( 'pwtp-label-options' ); ?>
			<?php do_settings_sections( 'pwtp-label' ); ?>
		<?php } else { ?>
			<?php settings_fields( 'pwtp-message-options' ); ?>
			<?php do_settings_sections( 'pwtp-message' ); ?>
		<?php } ?>
		<?php submit_button(); ?>
	</form>
	
</div>
<?php
}
