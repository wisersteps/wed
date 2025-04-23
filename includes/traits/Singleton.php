<?php
/**
 * Singleton Trait
 *
 * @package EDD_Plugin
 */

namespace EDD_Plugin\Traits;

/**
 * Trait Singleton
 */
trait Singleton {
	/**
	 * Instance variable
	 *
	 * @var array
	 */
	private static $instance = array();

	/**
	 * Singleton constructor.
	 */
	private function __construct() {
		// Private constructor.
	}

	/**
	 * Singleton clone.
	 */
	private function __clone() {
		// Disable cloning.
	}

	/**
	 * Singleton wakeup.
	 */
	public function __wakeup() {
		// Disable unserialize.
	}

	/**
	 * Get instance.
	 *
	 * @return mixed
	 */
	final public static function get_instance() {
		$class = get_called_class();
		if ( ! isset( self::$instance[ $class ] ) ) {
			self::$instance[ $class ] = new $class();
			if ( method_exists( self::$instance[ $class ], 'init' ) ) {
				self::$instance[ $class ]->init();
			}
		}

		return self::$instance[ $class ];
	}
} 