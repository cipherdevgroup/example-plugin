<?php
/**
 * Plugin Name: Example Plugin
 * Plugin URI:  https://github.com/wpsitecare/example-plugin/
 * Description: An example plugin for WP Site Care projects.
 * Version:     0.1.0
 * Author:      WP Site Care
 * Author URI:  http://www.wpsitecare.com
 * License:     MIT
 * License URI: http://wpsitecare.mit-license.org/
 * Text Domain: example-plugin
 * Domain Path: /languages
 *
 * @package    ExamplePlugin
 * @copyright  Copyright (c) 2016, WP Site Care
 * @license    MIT
 * @since      0.1.0
 */

defined( 'ABSPATH' ) || exit;

/**
 * The current version of the plugin.
 *
 * @since 0.1.0
 */
define( 'EXAMPLE_PLUGIN_VERSION', '0.1.0' );

/**
 * The current version of the parent theme. Should match the version in style.css.
 *
 * @since 0.1.0
 */
define( 'EXAMPLE_PLUGIN_FILE', __FILE__ );

/**
 * The absolute path to the plugin's root directory with a trailing slash.
 *
 * @since 0.1.0
 * @uses  plugin_dir_path()
 */
define( 'EXAMPLE_PLUGIN_DIR', plugin_dir_path( __FILE__ ) );

/**
 * The absolute path to the plugin's root directory with a trailing slash.
 *
 * @since 0.1.0
 * @uses  plugin_dir_url()
 */
define( 'EXAMPLE_PLUGIN_URI', plugin_dir_url( __FILE__ ) );

require_once EXAMPLE_PLUGIN_DIR . 'includes/plugin-hooks/includes.php';
require_once EXAMPLE_PLUGIN_DIR . 'includes/language.php';
require_once EXAMPLE_PLUGIN_DIR . 'includes/options.php';
require_once EXAMPLE_PLUGIN_DIR . 'includes/scripts.php';

add_action( 'plugins_loaded', 'example_plugin' );
/**
 * Fire all of the actions, filters, and any other functionality kickoffs.
 *
 * @since  0.1.0
 * @access public
 * @return void
 */
function example_plugin() {
	require_once EXAMPLE_PLUGIN_DIR . 'includes/init.php';
}

add_action( 'plugins_loaded', 'example_plugin_admin' );
/**
 * Fire all of the admin actions, filters, and any other functionality kickoffs.
 *
 * @since  0.1.0
 * @access public
 * @return void
 */
function example_plugin_admin() {
	if ( is_admin() ) {
		require_once EXAMPLE_PLUGIN_DIR . 'admin/init.php';
	}
}
