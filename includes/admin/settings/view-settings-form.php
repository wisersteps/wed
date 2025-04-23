<?php
/**
 * The admin settings form view.
 *
 * @package EDD_Plugin
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

// Check user permissions.
if ( ! current_user_can( 'manage_options' ) ) {
	return;
}
?>

<div class="wrap">
	<h1><?php echo esc_html( get_admin_page_title() ); ?></h1>
	
	<form action="options.php" method="post">
		<?php
		// Output security fields for the registered setting.
		settings_fields( 'edd_plugin_settings' );
		
		// Output setting sections and their fields.
		do_settings_sections( 'edd-plugin' );
		
		// Output save settings button.
		submit_button();
		?>
	</form>
</div> 