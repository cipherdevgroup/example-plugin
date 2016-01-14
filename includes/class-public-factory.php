<?php
/**
 * Build and store references to our global plugin objects.
 *
 * @package    ExamplePlugin
 * @subpackage ExamplePlugin\Classes
 * @author     Robert Neu
 * @copyright  Copyright (c) 2016, WP Site Care
 * @license    MIT
 * @since      0.1.0
 */

defined( 'ABSPATH' ) || exit;

class Example_Plugin_Public_Factory extends Example_Plugin_Factory {
	/**
	 * A list of required public plugin object names.
	 *
	 * @since 0.1.0
	 * @var   array
	 */
	protected $required = array(
		'public-scripts',
	);

	/**
	 * Constructor method.
	 *
	 * @since  0.1.0
	 * @access public
	 * @return void
	 */
	public function __construct() {
		if ( ! is_admin() ) {
			$this->build_required_objects();
		}
	}
}
