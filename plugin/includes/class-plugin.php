<?php
/**
 * Walkie Talkie main plugin class.
 *
 * @package     ExamplePlugin
 * @author      Robert Neu
 * @copyright   Copyright (c) 2015, WP Site Care, LLC
 * @license     GPL-2.0+
 * @since       0.0.1
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Main plugin class.
 */
class Example_Plugin {

	// Class properties
	public $admin_page;
	public $admin_scripts;

	/**
	 * Method to initialize the plugin.
	 *
	 * @since  0.0.1
	 * @return void
	 */
	public function run() {
		// Return early if we're no in the WordPress admin panel.
		if ( ! is_admin() ) {
			return;
		}
		$this->load_textdomain();
		$this->includes();
		$this->instantiate();
	}

	/**
	 * Loads the plugin language files
	 *
	 * @since  0.0.1
	 * @access public
	 * @return void
	 */
	public function load_textdomain() {
		// Set filter for plugin's languages directory
		$lang_dir = EXAMPLE_PLUGIN_DIR . 'languages/';
		$lang_dir = apply_filters( 'example_plugin_lang_directory', $lang_dir );
		// Load the default language files
		load_plugin_textdomain( 'example-plugin', false, $lang_dir );
	}

	/**
	 * Require all plugin files.
	 *
	 * @since  0.0.1
	 * @access private
	 * @return void
	 */
	private function includes() {
		require_once EXAMPLE_PLUGIN_DIR . 'includes/class-admin-page.php';
		require_once EXAMPLE_PLUGIN_DIR . 'includes/class-admin-scripts.php';
		require_once EXAMPLE_PLUGIN_DIR . 'includes/class-mandrill.php';
		require_once EXAMPLE_PLUGIN_DIR . 'includes/class-snapshot.php';
	}

	/**
	 * Load all required files and get all of our classes running.
	 *
	 * @since  0.0.1
	 * @access public
	 * @return void
	 */
	public function instantiate() {
		$this->admin_page    = new Example_Plugin_Admin_Page;
		$this->admin_scripts = new Example_Plugin_Admin_Scripts;
		$this->admin_page->run();
		$this->admin_scripts->run();
	}

	/**
	 * Helper function to determine if we're on the right page.
	 *
	 * @since  1.0.0
	 * @access private
	 * @return bool
	 */
	public function is_admin_page() {
		if ( ! function_exists( 'get_current_screen' ) ) {
			return false;
		}
		// Return true if we're on a single edit post screen.
		if ( 'toplevel_page_example-plugin' === get_current_screen()->base ) {
			return true;
		}
		return false;
	}

}
