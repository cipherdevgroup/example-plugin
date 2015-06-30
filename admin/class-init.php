<?php
/**
 * Load all admin functionality.
 *
 * @package   WPSiteCare/ExamplePlugin
 * @copyright Copyright (c) 2015, WP Site Care
 * @license   MIT
 * @since     0.1.0
 */

// Exit if accessed directly
defined( 'ABSPATH' ) || exit;

/**
 * Class for loading all plugin admin functionality.
 *
 * @version 0.1.0
 */
class Example_Plugin_Admin {

	/**
	 * Get the class running!
	 *
	 * @since  0.1.0
	 * @access public
	 * @return void
	 */
	public function run() {
		self::includes();
		self::instantiate();
	}

	/**
	 * Return the path to the admin directory with a trailing slash.
	 *
	 * @since   0.1.0
	 * @access  public
	 * @return  string
	 */
	public function get_dir() {
		return example_plugin()->get_dir() . 'admin/';
	}

	/**
	 * Return a path to the admin templates directory with a trailing slash.
	 *
	 * @since  0.1.0
	 * @access protected
	 * @return string a path to the admin template directory
	 */
	public function get_template_dir() {
		return example_plugin()->get_dir() . 'admin/templates/';
	}

	/**
	 * Include admin plugin files.
	 *
	 * @since   0.1.0
	 * @access  private
	 * @return  void
	 */
	private function includes() {
	}

	/**
	 * Spin up instances of our admin classes once they've been included.
	 *
	 * @since   0.1.0
	 * @access  private
	 * @return  void
	 */
	private function instantiate() {
	}

}
