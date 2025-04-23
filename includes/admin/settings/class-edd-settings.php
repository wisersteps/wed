<?php
/**
 * The admin-specific functionality of the plugin.
 *
 * @package EDD_Plugin
 */

namespace EDD_Plugin\Admin\Settings;

use EDD_Plugin\Traits\Singleton;

/**
 * Class EDD_Settings
 */
class EDD_Settings {
	use Singleton;

	/**
	 * Initialize the class and set its properties.
	 */
	public function init() {
		add_action( 'admin_menu', array( $this, 'add_plugin_admin_menu' ) );
		add_action( 'admin_init', array( $this, 'register_settings' ) );
	}

	/**
	 * Add options page to the admin menu.
	 */
	public function add_plugin_admin_menu() {
		add_options_page(
			__( 'EDD Plugin Settings', 'edd-plugin' ),
			__( 'EDD Plugin', 'edd-plugin' ),
			'manage_options',
			'edd-plugin',
			array( $this, 'display_plugin_admin_page' )
		);
	}

	/**
	 * Register all settings fields.
	 */
	public function register_settings() {
		register_setting(
			'edd_plugin_settings',
			'edd_plugin_settings',
			array( $this, 'validate_settings' )
		);

		add_settings_section(
			'edd_plugin_main_section',
			__( 'Main Settings', 'edd-plugin' ),
			array( $this, 'main_section_callback' ),
			'edd-plugin'
		);

		add_settings_field(
			'option_one',
			__( 'Option One', 'edd-plugin' ),
			array( $this, 'option_one_callback' ),
			'edd-plugin',
			'edd_plugin_main_section'
		);

		add_settings_field(
			'option_two',
			__( 'Option Two', 'edd-plugin' ),
			array( $this, 'option_two_callback' ),
			'edd-plugin',
			'edd_plugin_main_section'
		);
	}

	/**
	 * Validate settings before saving.
	 *
	 * @param array $input The settings input.
	 * @return array
	 */
	public function validate_settings( $input ) {
		$output = array();
		
		$output['option_one'] = sanitize_text_field( $input['option_one'] );
		$output['option_two'] = sanitize_text_field( $input['option_two'] );
		
		return $output;
	}

	/**
	 * Main section callback.
	 */
	public function main_section_callback() {
		echo '<p>' . esc_html__( 'Configure your plugin settings below.', 'edd-plugin' ) . '</p>';
	}

	/**
	 * Option One field callback.
	 */
	public function option_one_callback() {
		$options = get_option( 'edd_plugin_settings' );
		$value = isset( $options['option_one'] ) ? $options['option_one'] : '';
		?>
		<input type="text" name="edd_plugin_settings[option_one]" value="<?php echo esc_attr( $value ); ?>" class="regular-text">
		<?php
	}

	/**
	 * Option Two field callback.
	 */
	public function option_two_callback() {
		$options = get_option( 'edd_plugin_settings' );
		$value = isset( $options['option_two'] ) ? $options['option_two'] : '';
		?>
		<input type="text" name="edd_plugin_settings[option_two]" value="<?php echo esc_attr( $value ); ?>" class="regular-text">
		<?php
	}

	/**
	 * Display the plugin admin page.
	 */
	public function display_plugin_admin_page() {
		include_once plugin_dir_path( dirname( dirname( __FILE__ ) ) ) . 'admin/settings/view-settings-form.php';
	}
} 