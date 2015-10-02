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

class Example_Plugin_Admin_Factory extends Example_Plugin_Factory {
	/**
	 * A list of required admin plugin object names.
	 *
	 * @since 0.1.0
	 * @var   array
	 */
	protected $required = array();

	/**
	 * Constructor method.
	 *
	 * @since  0.1.0
	 * @access public
	 * @return void
	 */
	public function __construct() {
		if ( is_admin() ) {
			$this->build_required_objects();
		}
	}
}
