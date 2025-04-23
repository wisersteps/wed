<?php
/**
 * The public-facing functionality of the plugin.
 *
 * @package EDD_Plugin
 */

namespace EDD_Plugin\Frontend;

/**
 * Class EDD_Example_Shortcode
 */
class Shortcodes {
	/**
	 * Initialize the class and set its properties.
	 */
	public function __construct() {
		add_shortcode( 'edd_test', array( $this, 'render_shortcode' ) );
		add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_scripts' ) );
	}

	/**
	 * Enqueue scripts and styles.
	 */
	public function enqueue_scripts() {
		$suffix = defined( 'WP_DEBUG' ) && WP_DEBUG ? '' : '.min';
		
		wp_enqueue_style(
			'edd-plugin-public',
			plugin_dir_url( dirname( dirname( dirname( __FILE__ ) ) ) ) . 'assets/css/style' . $suffix . '.css',
			array(),
			EDD_PLUGIN_VERSION
		);

		wp_enqueue_script(
			'edd-plugin-public',
			plugin_dir_url( dirname( dirname( dirname( __FILE__ ) ) ) ) . 'assets/js/script' . $suffix . '.js',
			array( 'jquery' ),
			EDD_PLUGIN_VERSION,
			true
		);
	}

	/**
	 * Render the shortcode output.
	 *
	 * @param array  $atts    Shortcode attributes.
	 * @param string $content Shortcode content.
	 * @return string
	 */
	public function render_shortcode( $atts, $content = null ) {
		$atts = shortcode_atts(
			array(
				'class' => 'edd-test-shortcode',
			),
			$atts,
			'edd_test'
		);

		ob_start();
		?>
		<div class="<?php echo esc_attr( $atts['class'] ); ?>">
			<?php echo wp_kses_post( $content ); ?>
		</div>
		<?php
		return ob_get_clean();
	}
}