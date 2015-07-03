<?php
/**
 * Plugin Name:  Example Plugin
 * Plugin URI:   https://github.com/wpsitecare/example-plugin/
 * Description:  An example plugin for WP Site Care projects.
 * Version:      0.1.0
 * Author:       WP Site Care
 * Author URI:   http://www.wpsitecare.com
 * License:      MIT
 * License URI:  http://wpsitecare.mit-license.org/
 * Text Domain:  example-plugin
 * Domain Path:  /languages
 */

// Prevent direct access.
defined( 'ABSPATH' ) || exit;

// Load the main plugin class.
require_once plugin_dir_path( __FILE__ ) . 'class-plugin.php';

/**
 * Access a single instance of the main plugin class. Plugins and themes should
 * use this function to access plugin properties and methods. It's also a good
 * way to check whether or not the plugin is activated.
 *
 * @since  0.1.0
 * @access public
 * @uses   Example_Plugin
 * @return object Example_Plugin A single instance of the main plugin class.
 */
function example_plugin() {
	return Example_Plugin::instance();
}

/**
 * Hook the main plugin class instance into plugins_loaded.
 *
 * @since  0.1.0
 * @access public
 * @return void
 */
add_action( 'plugins_loaded', array( example_plugin(), 'run' ) );

/**
 * Register an activation hook to run all necessary plugin setup procedures.
 *
 * @since  0.1.0
 * @access public
 * @return void
 */
register_activation_hook( __FILE__, array( example_plugin(), 'activate' ) );
