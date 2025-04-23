<?php
/**
 * Fired when the plugin is uninstalled.
 *
 * @package EDD_Plugin
 */

// If uninstall not called from WordPress, then exit.
if ( ! defined( 'WP_UNINSTALL_PLUGIN' ) ) {
	exit;
}

// Delete plugin options from database.
$options = array(
	'edd_plugin_option_one',
	'edd_plugin_option_two',
);

foreach ( $options as $option ) {
	delete_option( $option );
} 