<?php
// exit if uninstall is not called
if ( !defined( 'WP_UNINSTALL_PLUGIN' ) ) {
	exit();
}

$keep = get_option( 'pwtp-setting' );
if ( $keep != 'yes' ) {
	// delete options
	delete_option( 'widget_pwtp-widget');
	delete_option( 'pwtp-setting' );
	delete_option( 'pwtp-setting-2' );
	delete_option( 'pwtp-setting-3' );
	delete_option( 'pwtp-setting-4' );
	delete_option( 'pwtp-setting-5' );
	delete_option( 'pwtp-setting-6' );
	delete_option( 'pwtp-setting-7' );
	delete_option( 'pwtp-setting-8' );
	delete_option( 'pwtp-setting-9' );
	delete_option( 'pwtp-setting-10' );
	delete_option( 'pwtp-setting-11' );
	delete_option( 'pwtp-setting-12' );
	delete_option( 'pwtp-setting-13' );
	delete_option( 'pwtp-setting-14' );
	delete_option( 'pwtp-setting-15' );
	delete_option( 'pwtp-setting-16' );
	delete_option( 'pwtp-setting-17' );
	delete_option( 'pwtp-setting-18' );
	delete_option( 'pwtp-setting-19' );
	delete_option( 'pwtp-setting-20' );
	delete_option( 'pwtp-setting-21' );
	delete_option( 'pwtp-setting-22' );
	delete_option( 'pwtp-setting-23' );

	// delete site options in multisite
	delete_site_option( 'widget_pwtp-widget' );
	delete_site_option( 'pwtp-setting' );
	delete_site_option( 'pwtp-setting-2' );
	delete_site_option( 'pwtp-setting-3' );
	delete_site_option( 'pwtp-setting-4' );
	delete_site_option( 'pwtp-setting-5' );
	delete_site_option( 'pwtp-setting-6' );
	delete_site_option( 'pwtp-setting-7' );
	delete_site_option( 'pwtp-setting-8' );
	delete_site_option( 'pwtp-setting-9' );
	delete_site_option( 'pwtp-setting-10' );
	delete_site_option( 'pwtp-setting-11' );
	delete_site_option( 'pwtp-setting-12' );
	delete_site_option( 'pwtp-setting-13' );
	delete_site_option( 'pwtp-setting-14' );
	delete_site_option( 'pwtp-setting-15' );
	delete_site_option( 'pwtp-setting-16' );
	delete_site_option( 'pwtp-setting-17' );
	delete_site_option( 'pwtp-setting-18' );
	delete_site_option( 'pwtp-setting-19' );
	delete_site_option( 'pwtp-setting-20' );
	delete_site_option( 'pwtp-setting-21' );
	delete_site_option( 'pwtp-setting-22' );
	delete_site_option( 'pwtp-setting-23' );

	// set global
	global $wpdb;

	// delete submissions
	$wpdb->query( "DELETE FROM {$wpdb->posts} WHERE post_type = 'submission'" );
}
