<?php
/**
 * Initialize and register all plugin activation hooks.
 *
 * @package   ExamplePlugin\Activation
 * @copyright Copyright (c) 2017, WP Site Care
 * @license   MIT
 * @since     1.0.0
 */

defined( 'WPINC' ) || die;

require_once EXAMPLE_PLUGIN_DIR . 'includes/activation/activate.php';
require_once EXAMPLE_PLUGIN_DIR . 'includes/activation/deactivate.php';
require_once EXAMPLE_PLUGIN_DIR . 'includes/activation/uninstall.php';

/**
 * Callback defined in includes/activation/activate.php
 *
 * @see example_plugin_fallback_activate
 */
add_action( 'admin_init', 'example_plugin_fallback_activate', 10 );

/**
 * Callback defined in includes/activation/activate.php
 *
 * @see example_plugin_activate
 */
register_activation_hook( EXAMPLE_PLUGIN_FILE, 'example_plugin_activate' );

/**
 * Callback defined in includes/activation/deactivate.php
 *
 * @see example_plugin_deactivate
 */
register_deactivation_hook( EXAMPLE_PLUGIN_FILE, 'example_plugin_deactivate' );

/**
 * Callback defined in includes/activation/uninstall.php
 *
 * @see example_plugin_uninstall
 */
register_uninstall_hook( EXAMPLE_PLUGIN_FILE, 'example_plugin_uninstall' );
