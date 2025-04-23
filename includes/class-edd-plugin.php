<?php
/**
 * Main plugin class
 *
 * @package EDD_Plugin
 */

namespace EDD_Plugin;

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
    die;
}

/**
 * Main plugin class
 */
final class EDD {

    /**
     * Single instance of the class
     *
     * @var EDD_Plugin
     */
    private static $instance = null;

    /**
     * Instance of the settings class
     *
     * @var \EDD_Plugin\Admin\Settings\EDD_Settings
     */
    private $settings;

    /**
     * Instance of the shortcode class
     *
     * @var \EDD_Plugin\Frontend\Shortcodes\EDD_Example_Shortcode
     */
    private $shortcode;

    /**
     * Get single instance of the class
     *
     * @return EDD_Plugin
     */
    public static function instance() {
        if ( is_null( self::$instance ) ) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    /**
     * Private constructor to prevent direct instantiation
     */
    private function __construct() {
        $this->init_hooks();
    }

    /**
     * Initialize WordPress hooks
     */
    private function init_hooks() {
        // Initialize admin features only in admin
        if ( is_admin() ) {
            add_action( 'init', array( $this, 'init_admin' ) );
        }

        // Initialize frontend features
        add_action( 'init', array( $this, 'init_frontend' ) );
    }

    /**
     * Initialize admin features
     */
    public function init_admin() {
        $admin_classes = array(
            'Settings'
        );

        foreach ( $admin_classes as $class ) {
            if ( class_exists( __NAMESPACE__ . '\\Admin\\' . $class ) ) {
                $class_name = __NAMESPACE__ . '\\Admin\\' . $class;
                $this->$class = new $class_name();
            }
        }
    }

    /**
     * Initialize frontend features
     */
    public function init_frontend() {
        $frontend_classes = array(
            'Shortcodes'
        );

        foreach ( $frontend_classes as $class ) {
            if ( class_exists( __NAMESPACE__ . '\\Frontend\\' . $class ) ) {
                $class_name = __NAMESPACE__ . '\\Frontend\\' . $class;
                $this->$class = new $class_name();
            }
        }
    }

    /**
     * Prevent cloning
     */
    private function __clone() {}

    /**
     * Prevent unserializing
     */
    public function __wakeup() {
        throw new \Exception( 'Cannot unserialize singleton' );
    }
} 