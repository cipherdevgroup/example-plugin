<?php
/**
 * Example Plugin uninstall functions.
 *
 * @package   ExamplePlugin\Activation
 * @copyright Copyright (c) 2017, WP Site Care
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
	if ( ! current_user_can( 'activate_plugins' ) ) {
		return;
	}
}
