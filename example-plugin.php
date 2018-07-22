<?php
/**
 * Plugin Name: Example Plugin
 * Plugin URI:  https://github.com/cipherdevgroup/example-plugin/
 * Description: An example plugin for Cipher projects.
 * Version:     1.0.0
 * Author:      Cipher
 * Author URI:  https://cipherdevelopment.com
 * License:     MIT
 * License URI: http://mit-license.org/
 * Text Domain: example-plugin
 * Domain Path: /languages
 *
 * @package   ExamplePlugin
 * @copyright Copyright (c) 2018, Cipher Development, LLC
 * @license   MIT
 * @since     1.0.0
 */

defined( 'WPINC' ) || die;

/**
 * The current version of the plugin.
 *
 * @since 1.0.0
 */
define( 'EXAMPLE_PLUGIN_VERSION', '1.0.0' );

/**
 * The absolute path to the root plugin file.
 *
 * @since 1.0.0
 */
define( 'EXAMPLE_PLUGIN_FILE', __FILE__ );

/**
 * The absolute path to the plugin's root directory with a trailing slash.
 *
 * @since 1.0.0
 * @uses  plugin_dir_path()
 */
define( 'EXAMPLE_PLUGIN_DIR', plugin_dir_path( __FILE__ ) );

/**
 * The absolute path to the plugin's root directory with a trailing slash.
 *
 * @since 1.0.0
 * @uses  plugin_dir_url()
 */
define( 'EXAMPLE_PLUGIN_URI', plugin_dir_url( __FILE__ ) );

require_once EXAMPLE_PLUGIN_DIR . 'includes/activation/init.php';
require_once EXAMPLE_PLUGIN_DIR . 'includes/language.php';
require_once EXAMPLE_PLUGIN_DIR . 'includes/scripts.php';

add_action( 'plugins_loaded', 'example_plugin' );
/**
 * Fire all of the actions, filters, and any other functionality kickoffs.
 *
 * @since  1.0.0
 * @access public
 * @return void
 */
function example_plugin() {
	/**
	 * Provide reliable access to the plugin's functions and methods before
	 * the plugin's global actions, filters, and functionality are initialized.
	 *
	 * @since  1.0.0
	 * @access public
	 */
	do_action( 'example_plugin_before_init' );

	require_once EXAMPLE_PLUGIN_DIR . 'includes/actions.php';

	/**
	 * Provide reliable access to the plugin's functions and methods after
	 * the plugin's global actions, filters, and functionality are initialized.
	 *
	 * @since  1.0.0
	 * @access public
	 */
	do_action( 'example_plugin_after_init' );
}

add_action( 'plugins_loaded', 'example_plugin_admin' );
/**
 * Fire all of the admin actions, filters, and any other functionality kickoffs.
 *
 * @since  1.0.0
 * @access public
 * @return void
 */
function example_plugin_admin() {
	if ( is_admin() ) {
		/**
		 * Provide reliable access to the plugin's functions and methods before
		 * the plugin's admin actions, filters, and functionality are initialized.
		 *
		 * @since  1.0.0
		 * @access public
		 */
		do_action( 'example_plugin_before_admin_init' );

		require_once EXAMPLE_PLUGIN_DIR . 'admin/actions.php';

		/**
		 * Provide reliable access to the plugin's functions and methods after
		 * the plugin's admin actions, filters, and functionality are initialized.
		 *
		 * @since  1.0.0
		 * @access public
		 */
		do_action( 'example_plugin_after_admin_init' );
	}
}
