<?php
/**
 * Functions to load translations for the plugin.
 *
 * @package   ExamplePlugin\Functions\Languages
 * @copyright Copyright (c) 2016, WP Site Care
 * @license   MIT
 * @since     1.0.0
 */

/**
 * Loads translation file.
 *
 * @since  1.0.0
 * @access public
 * @return bool true when the file was found, false otherwise.
 */
function example_plugin_load_textdomain() {
	return load_plugin_textdomain(
		'example-plugin',
		false,
		dirname( plugin_basename( EXAMPLE_PLUGIN_FILE ) ) . '/languages'
	);
}

/**
 * Remove translations from memory.
 *
 * @since  1.0.0
 * @access public
 * @return bool true if the text domain was loaded, false if it was not.
 */
function example_plugin_unload_textdomain() {
	return unload_textdomain( 'example-plugin' );
}

/**
 * Whether or not the language has been loaded already.
 *
 * @since  1.0.0
 * @access public
 * @return bool
 */
function example_plugin_is_textdomain_loaded() {
	return is_textdomain_loaded( 'example-plugin' );
}
