<?php
/**
 * Example Plugin activation, deactivation, and uninstall hooks.
 *
 * @package    ExamplePlugin\PluginHooks
 * @copyright  Copyright (c) 2016, WP Site Care
 * @license    MIT
 * @since      0.1.0
 */

/**
 * Process deactivation routines based on how the plugin is deactivated.
 *
 * @since  0.1.0
 * @access public
 * @param  bool $network_wide True if super admin uses "Network Deactivate".
 * @return void
 */
function example_plugin_deactivate( $network_wide = false ) {
	_example_plugin_hooks_handle_action( '_example_plugin_deactivate', $network_wide );
}

/**
 * Remove unnecessary data on plugin deactivation.
 *
 * @since  0.1.0
 * @access protected
 * @return void
 */
function _example_plugin_deactivate() {
	if ( ! current_user_can( 'activate_plugins' ) ) {
		return;
	}
	check_admin_referer( 'deactivate-plugin_' . _example_plugin_get_plugin_request() );
}
