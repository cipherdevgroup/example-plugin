<?php
/**
 * Load all public-facing scripts for the plugin.
 *
 * @package    ExamplePlugin
 * @subpackage ExamplePlugin\Classes
 * @author     Robert Neu
 * @copyright  Copyright (c) 2016, WP Site Care
 * @license    MIT
 * @since      0.1.0
 */

defined( 'ABSPATH' ) || exit;

require_once EXAMPLE_PLUGIN_DIR . 'includes/plugin-hooks/common.php';
require_once EXAMPLE_PLUGIN_DIR . 'includes/plugin-hooks/activate.php';
require_once EXAMPLE_PLUGIN_DIR . 'includes/plugin-hooks/deactivate.php';
require_once EXAMPLE_PLUGIN_DIR . 'includes/plugin-hooks/uninstall.php';

/**
 * Callback defined in includes/plugin-hooks/activate.php
 *
 * @see example_plugin_activate_new_site
 */
add_action( 'wpmu_new_blog', 'example_plugin_activate_new_site' );

/**
 * Callback defined in includes/plugin-hooks/activate.php
 *
 * @see example_plugin_activate
 */
register_activation_hook( EXAMPLE_PLUGIN_FILE, 'example_plugin_activate' );

/**
 * Callback defined in includes/plugin-hooks/deactivate.php
 *
 * @see example_plugin_deactivate
 */
register_deactivation_hook( EXAMPLE_PLUGIN_FILE, 'example_plugin_deactivate' );

/**
 * Callback defined in includes/plugin-hooks/uninstall.php
 *
 * @see example_plugin_uninstall
 */
register_uninstall_hook( EXAMPLE_PLUGIN_FILE, 'example_plugin_uninstall' );
