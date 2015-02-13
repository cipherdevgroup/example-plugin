<?php
/**
 * Example Plugin main plugin class.
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
	public $scripts;

	public $admin_page;

	public $setttings_general;

	/**
	 * Method to initialize the plugin.
	 *
	 * @since  0.0.1
	 * @return void
	 */
	public function run() {
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
		$includes_dir = EXAMPLE_PLUGIN_DIR . 'includes/';
		require_once $includes_dir . 'admin/settings/class-settings-base.php';
		require_once $includes_dir . 'admin/settings/class-settings-general.php';
		require_once $includes_dir . 'class-scripts.php';
		// Bail here if we're not in the admin panel.
		if ( ! is_admin() ) {
			return;
		}
		require_once $includes_dir . 'admin/class-admin-scripts.php';
		require_once $includes_dir . 'admin/settings/class-settings-page.php';
	}

	/**
	 * Load all required files and get all of our classes running.
	 *
	 * @since  0.0.1
	 * @access public
	 * @return void
	 */
	public function instantiate() {
		$this->scripts = new Example_Plugin_Scripts;

		$this->scripts->run();
		// Bail here if we're not in the admin panel.
		if ( ! is_admin() ) {
			return;
		}
		$this->admin_scripts    = new Example_Plugin_Admin_Scripts;
		$this->settings_general = new Example_Plugin_Settings_General;
		$this->admin_page       = new Example_Plugin_Settings_Page;

		$this->admin_scripts->run();
		$this->settings_general->run();
		$this->admin_page->run();
	}

}
