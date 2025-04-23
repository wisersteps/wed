<?php
/**
 * The main plugin class.
 *
 * @package EDD_Plugin
 */

namespace EDD_Plugin;

use EDD_Plugin\Traits\Singleton;
use EDD_Plugin\Admin\Settings\EDD_Settings;
use EDD_Plugin\Frontend\Shortcodes\EDD_Example_Shortcode;

/**
 * Class EDD
 */
class EDD {
	use Singleton;

	/**
	 * The loader that's responsible for maintaining and registering all hooks that power
	 * the plugin.
	 *
	 * @var EDD_Loader $loader Maintains and registers all hooks for the plugin.
	 */
	protected $loader;

	/**
	 * Initialize the plugin.
	 */
	public function init() {
		$this->load_dependencies();
		$this->define_admin_hooks();
		$this->define_public_hooks();
	}

	/**
	 * Load the required dependencies for this plugin.
	 */
	private function load_dependencies() {
		$this->loader = EDD_Loader::get_instance();
	}

	/**
	 * Register all of the hooks related to the admin area functionality
	 * of the plugin.
	 */
	private function define_admin_hooks() {
		$admin_settings = EDD_Settings::get_instance();
		$this->loader->add_action( 'admin_menu', $admin_settings, 'init' );
		$this->loader->add_action( 'admin_init', $admin_settings, 'register_settings' );
	}

	/**
	 * Register all of the hooks related to the public-facing functionality
	 * of the plugin.
	 */
	private function define_public_hooks() {
		$shortcode = EDD_Example_Shortcode::get_instance();
		$this->loader->add_action( 'init', $shortcode, 'init' );
	}

	/**
	 * Run the loader to execute all of the hooks with WordPress.
	 */
	public function run() {
		$this->loader->run();
	}
} 