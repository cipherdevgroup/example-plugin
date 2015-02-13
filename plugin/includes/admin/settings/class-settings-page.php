<?php
/**
 * Admin Options Page
 *
 * @package     ExamplePlugin
 * @author      Robert Neu
 * @copyright   Copyright (c) 2015, WP Site Care, LLC
 * @license     GPL-2.0+
 * @since       0.0.1
 */

// Prevent direct access.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class Example_Plugin_Settings_Page {

	/**
	* Get things running!
	*
	* @since  0.0.1
	* @access public
	* @return void
	*/
	public function run() {
		self::wp_hooks();
	}

	/**
	 * Hook into WordPress.
	 *
	 * @since  0.0.1
	 * @access public
	 * @return void
	 */
	public function wp_hooks() {
		add_action( 'admin_menu', array( $this, 'register_menus' ) );
	}

	/**
	 * Register our settings page.
	 *
	 * @since  0.0.1
	 * @access public
	 * @return void
	 */
	public function register_menus() {
		add_options_page(
			__( 'ExamplePlugin', 'example-plugin' ),
			__( 'ExamplePlugin', 'example-plugin' ),
			'manage_options',
			example_plugin()->key,
			array( $this, 'settings_page' )
		);
	}

	/**
	 * Options Page
	 *
	 * Renders the options page contents.
	 *
	 * @since  0.0.1
	 * @access public
	 * @return void
	 */
	function settings_page() {
		$active_tab = 'general';
		if ( isset( $_GET['tab'] ) && array_key_exists( $_GET['tab'], $this->get_tabs() ) ) {
			$active_tab = $_GET['tab'];
		}

		// Grab the settings key to be passed into the template.
		$key = example_plugin()->key;

		require_once EXAMPLE_PLUGIN_DIR . 'templates/admin/settings-page.php';
	}

	/**
	 * Retrieve settings tabs
	 *
	 * @since  0.0.1
	 * @access private
	 * @return array $tabs
	 */
	private function get_tabs() {
		return apply_filters( 'example_plugin_settings_tabs', array() );
	}

	/**
	 * Helper function to determine if we're on the right page.
	 *
	 * @since  0.0.1
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
