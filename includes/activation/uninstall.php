<?php
/**
 * Example Plugin activation, deactivation, and uninstall hooks.
 *
 * @package   ExamplePlugin\Activation
 * @copyright Copyright (c) 2016, WP Site Care
 * @license   MIT
 * @since     1.0.0
 */

/**
 * Clean up all leftover roles, options, and data on plugin removal.
 *
 * @since  1.0.0
 * @access public
 * @return void
 */
function example_plugin_uninstall() {
	_example_plugin_hooks_handle_action( '_example_plugin_uninstall', true );
}

/**
 * Clean up all leftover roles, options, and data on plugin removal.
 *
 * @since  1.0.0
 * @access protected
 * @return void
 */
function _example_plugin_uninstall() {
	if ( ! current_user_can( 'activate_plugins' ) ) {
		return;
	}

	example_plugin_delete_options();
}
