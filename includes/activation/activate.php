<?php
/**
 * Example Plugin activation functions.
 *
 * @package   ExamplePlugin\Activation
 * @copyright Copyright (c) 2018, Cipher Development, LLC
 * @license   MIT
 * @since     1.0.0
 */

/**
 * Upgrade legacy versions of the plugin.
 *
 * @since  1.0.0
 * @access protected
 * @param  string $current_version The current plugin version.
 * @return void
 */
function _example_plugin_maybe_upgrade( $current_version = false ) {
	if ( ! $current_version ) {
		$current_version = get_option( 'example_plugin_version', '1.0.0' );
	}

	// Upgrade older versions of the plugin.
	if ( version_compare( $current_version, EXAMPLE_PLUGIN_VERSION, '<' ) ) {
		// Perform upgrades here.
	}

	// Reset the version number.
	update_option( 'example_plugin_version', EXAMPLE_PLUGIN_VERSION, 'no' );
}

/**
 * Process activation routines based on how the plugin is activated.
 *
 * @since  1.0.0
 * @access public
 * @param  string $current_version The current plugin version.
 * @return void
 */
function example_plugin_activate( $current_version = false ) {
	if ( ! current_user_can( 'activate_plugins' ) ) {
		return;
	}

	_example_plugin_maybe_upgrade( $current_version );

	/**
	 * Fires after the plugin has been activated.
	 *
	 * @since 1.0.0
	 */
	do_action( 'example_plugin_activated' );
}

/**
 * Make absolute sure the activation hook has been executed.
 *
 * @since  1.0.0
 * @access protected
 * @return void
 */
function example_plugin_fallback_activate() {
	$current_version = get_option( 'example_plugin_version' );

	if ( EXAMPLE_PLUGIN_VERSION !== $current_version ) {
		example_plugin_activate( $current_version );
	}
}
