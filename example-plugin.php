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

add_action( 'plugins_loaded', array( example_plugin(), 'run' ) );
/**
 * Allow themes and plugins to access Example_Plugin methods and properties.
 *
 * Because we aren't using a singleton pattern for our main plugin class, we
 * need to make sure it's only instantiated once in our helper function.
 * If you need to access methods inside the plugin classes, use this function.
 *
 * Example:
 *
 * <?php example_plugin()->scripts; ?>
 *
 * @since  0.1.0
 * @access public
 * @uses   Example_Plugin
 * @return object Example_Plugin A single instance of the main plugin class.
 */
function example_plugin() {
	static $plugin;
	if ( null === $plugin ) {
		$plugin = new Example_Plugin;
	}
	return $plugin;
}

/**
 * Register an activation hook to run all necessary plugin setup procedures.
 *
 * @since  0.1.0
 * @access public
 * @return void
 */
register_activation_hook( __FILE__, array( example_plugin(), 'activate' ) );
