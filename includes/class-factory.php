<?php
/**
 * Build and store references to our plugin objects.
 *
 * @package   ExamplePlugin
 * @copyright Copyright (c) 2015, WP Site Care
 * @license   MIT
 * @since     0.1.0
 */

// Exit if accessed directly
defined( 'ABSPATH' ) || exit;

class Example_Plugin_Factory {
	/**
	 * A list of required plugin object names.
	 *
	 * @since 0.1.0
	 * @var   array
	 */
	protected $required = array();

	/**
	 * The saved plugin objects.
	 *
	 * @since 0.1.0
	 * @var   array
	 */
	protected static $objects = array();

	/**
	 * Build a named object and return it. Keep a reference when building
	 * so we can reuse it later.
	 *
	 * If you pass 'my-object' to $object, the Factory will instantiate
	 * 'Example_Plugin_My_Object'.
	 *
	 * @param  string $object Object name.
	 * @param  string $name Optional. Name of the object.
	 * @param  array $args arguments to be passed to the class object
	 * @throws InvalidArgumentException If the specified class does not exist.
	 * @return mixed
	 */
	public static function build( $object, $name = 'canonical', $args = array() ) {
		if ( empty( self::$objects[ $object ] ) ) {
			self::$objects[ $object ] = array();
		}

		$class_name = 'Example_Plugin_' . ucwords( str_replace( '-', '_', $object ) );

		if ( ! class_exists( $class_name ) ) {
			throw new InvalidArgumentException(
				"No class exists for the '{$object}' object."
			);
		}

		if ( empty( self::$objects[ $object ][ $name ] ) ) {
			self::$objects[ $object ][ $name ] = new $class_name( $args );
		}

		return self::$objects[ $object ][ $name ];
	}

	/**
	 * Get the saved instance of a specified object.
	 *
	 * @param  string $object Object name.
	 * @param  string $name Optional. Name of the object.
	 * @param  array $args arguments to be passed to the class object
	 * @return mixed
	 */
	public static function get( $object, $name = 'canonical', $args = array() ) {
		if ( isset( self::$objects[ $object ][ $name ] ) ) {
			return self::$objects[ $object ][ $name ];
		}
		return self::build( $object, $name, $args );
	}

	/**
	 * Run and store a reference to objects which are required for the plugin
	 * to operate.
	 *
	 * @since  0.1.0
	 * @access protected
	 * @param  $factory string the name of our factory class
	 * @return void
	 */
	protected function build_required_objects() {
		if ( empty( $this->required ) ) {
			throw new InvalidArgumentException(
				'No required objects have been defined.'
			);
		}
		foreach ( $this->required as $class ) {
			$object = self::get( $class );
			$object->run();
		}
	}
}
