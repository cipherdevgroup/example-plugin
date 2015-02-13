<?php
/**
 * Activation and Deactivation hooks and functions.
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

register_activation_hook( EXAMPLE_PLUGIN_FILE, 'example_plugin_install' );
/**
 * Install
 *
 * Runs on plugin install to set up options and required plugin data.
 *
 * @since  1.0.0
 * @return void
 */
function example_plugin_install() {
	if ( ! get_option( 'example_plugin_is_installed' ) ) {
		$settings = example_plugin()->settings_general;
		$options  = $settings->get_all();
		update_option( 'example_plugin_settings', $options );
	}

	update_option( 'example_plugin_is_installed', true );

	// Add Upgraded From Option
	$current_version = get_option( 'example_plugin_version' );

	if ( $current_version ) {
		update_option( 'example_plugin_version_upgraded_from', $current_version );
	}

	update_option( 'example_plugin_version', EXAMPLE_PLUGIN_VERSION );

	// Bail if activating from network, or bulk
	if ( is_network_admin() || isset( $_GET['activate-multi'] ) ) {
		return;
	}
	// Add the transient to redirect
	set_transient( '_example_plugin_activation_redirect', true, 30 );
}

register_deactivation_hook( EXAMPLE_PLUGIN_FILE, 'example_plugin_deactivate' );
/**
 * Deactivate
 *
 * Runs on plugin deactivation to remove unnecessary options and data.
 *
 * @since  1.0.0
 * @return void
 */
function example_plugin_deactivate() {
	// Stuff.
}
