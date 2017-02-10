<?php
/**
 * Example Plugin deactivation functions.
 *
 * @package   ExamplePlugin\Activation
 * @copyright Copyright (c) 2017, WP Site Care
 * @license   MIT
 * @since     1.0.0
 */

/**
 * Process deactivation routines based on how the plugin is deactivated.
 *
 * @since  1.0.0
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
 * @since  1.0.0
 * @access protected
 * @return void
 */
function _example_plugin_deactivate() {
	if ( ! current_user_can( 'activate_plugins' ) ) {
		return;
	}

}
