<?php
/**
 * Kick off all actions, filters, and other functionality initialization.
 *
 * @package    ExamplePlugin\Functions\Init
 * @author     Robert Neu
 * @copyright  Copyright (c) 2016, WP Site Care
 * @license    MIT
 * @since      0.1.0
 */

defined( 'ABSPATH' ) || exit;

/**
 * Provide reliable access to the plugin's functions and methods before
 * the plugin's global classes are initialized.
 *
 * This is meant for plugins and themes to execute code which depends
 * on Example Plugin.
 *
 * @since  0.1.0
 * @access public
 * @param  string $version the current plugin version
 */
do_action( 'example_plugin_before_init', EXAMPLE_PLUGIN_VERSION );

require_once EXAMPLE_PLUGIN_DIR . 'includes/actions.php';

/**
 * Provide reliable access to the plugin's functions and methods after
 * the plugin's global classes are initialized.
 *
 * This is meant for plugins and themes to execute code which depends
 * on Example Plugin.
 *
 * @since  0.1.0
 * @access public
 * @param  string $version the current plugin version
 */
do_action( 'example_plugin_after_init', EXAMPLE_PLUGIN_VERSION );
