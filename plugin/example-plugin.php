<?php
/**
 * Plugin Name:  ExamplePlugin
 * Plugin URI:   http://www.wpsitecare.com/example-plugin/
 * Description:  Example plugin description.
 * Version:      0.0.1
 * Author:       WP Site Care
 * Author URI:   https://www.wpsitecare.com
 * License:      GPL-2.0+
 * License URI:  http://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:  example-plugin
 * Domain Path:  /languages
 */

// Define the plugin version.
define( 'EXAMPLE_PLUGIN_VERSION', '0.0.1' );

// Define the root plugin file.
if ( ! defined( 'EXAMPLE_PLUGIN_FILE' ) ) {
	define( 'EXAMPLE_PLUGIN_FILE', __FILE__ );
}
// Define the plugin folder path.
if ( ! defined( 'EXAMPLE_PLUGIN_DIR' ) ) {
	define( 'EXAMPLE_PLUGIN_DIR', plugin_dir_path( EXAMPLE_PLUGIN_FILE ) );
}
// Define the plguin Folder URL.
if ( ! defined( 'EXAMPLE_PLUGIN_URL' ) ) {
	define( 'EXAMPLE_PLUGIN_URL', plugin_dir_url( EXAMPLE_PLUGIN_FILE ) );
}

// Load the main plugin class.
require_once EXAMPLE_PLUGIN_DIR . 'includes/class-plugin.php';

// Load activation and deactivation functionality.
require_once EXAMPLE_PLUGIN_DIR . 'includes/activate-deactivate.php';

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
 * <?php example_plugin()->admin; ?>
 *
 * @since  0.0.1
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
