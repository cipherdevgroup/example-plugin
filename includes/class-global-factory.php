<?php
/**
 * Build and store references to our global plugin objects.
 *
 * @package   ExamplePlugin
 * @copyright Copyright (c) 2015, WP Site Care
 * @license   MIT
 * @since     0.1.0
 */

// Exit if accessed directly
defined( 'ABSPATH' ) || exit;

class Example_Plugin_Global_Factory extends Example_Plugin_Factory {
	/**
	 * Constructor method.
	 *
	 * @since  0.1.0
	 * @access public
	 * @return void
	 */
	public function __construct() {
		$this->build_plugin();
	}

	/**
	 * Build an array of global classes to run by default.
	 *
	 * @since  0.1.0
	 * @access protected
	 * @return array $classes the default plugin classes to be built on init
	 */
	protected function get_classes() {
		return array(
			'public-scripts',
		);
	}

	/**
	 * Store a reference to our classes and get them running.
	 *
	 * @since  0.1.0
	 * @access public
	 * @param  $factory string the name of our factory class
	 * @return void
	 */
	public function build_objects() {
		foreach ( $this->get_classes() as $class ) {
			$object = self::get( $class );
			if ( method_exists( $object, 'run' ) ) {
				$object->run();
			}
		}
	}
}
