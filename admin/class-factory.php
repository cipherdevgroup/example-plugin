<?php
/**
 * Build and store references to our global plugin objects.
 *
 * @package    ExamplePlugin
 * @subpackage ExamplePlugin\Admin\Classes
 * @author     Robert Neu
 * @copyright  Copyright (c) 2016, WP Site Care
 * @license    MIT
 * @since      0.1.0
 */

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
