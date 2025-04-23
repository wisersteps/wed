<?php
/**
 * Plugin Name: EDD Plugin
 * Plugin URI: https://example.com/edd-plugin
 * Description: A professional WordPress plugin boilerplate for EDD.
 * Version: 1.0.0
 * Author: Your Name
 * Author URI: https://example.com
 * License: GPL-2.0+
 * License URI: http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain: edd-plugin
 * Domain Path: /languages
 *
 * @package EDD_Plugin
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Current plugin version.
 */
define( 'EDD_PLUGIN_VERSION', '1.0.0' );

/**
 * Plugin base path.
 */
define( 'EDD_PLUGIN_PATH', plugin_dir_path( __FILE__ ) );

/**
 * Plugin base URL.
 */
define( 'EDD_PLUGIN_URL', plugin_dir_url( __FILE__ ) );

/**
 * Autoload dependencies.
 */
if ( file_exists( dirname( __FILE__ ) . '/vendor/autoload.php' ) ) {
	require_once dirname( __FILE__ ) . '/vendor/autoload.php';
} else {
	die( 'Please run composer install to set up the autoloader.' );
}

/**
 * The code that runs during plugin activation.
 */
function activate_edd_plugin() {
	EDD_Plugin\EDD_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 */
function deactivate_edd_plugin() {
	EDD_Plugin\EDD_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_edd_plugin' );
register_deactivation_hook( __FILE__, 'deactivate_edd_plugin' );

/**
 * Begins execution of the plugin.
 */
function run_edd_plugin() {
	$plugin = EDD_Plugin\EDD::get_instance();
	$plugin->run();
}

// Let's get started!
run_edd_plugin(); 