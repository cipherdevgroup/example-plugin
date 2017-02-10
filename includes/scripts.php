<?php
/**
 * Functions for loading plugin scripts and styles.
 *
 * @package   ExamplePlugin\Functions\Scripts
 * @copyright Copyright (c) 2017, WP Site Care
 * @license   MIT
 * @since     1.0.0
 */

/**
 * Helper function for getting the script `.min` suffix for minified files.
 *
 * @since  1.0.0
 * @access public
 * @return string
 */
function example_plugin_get_suffix() {
	static $suffix;

	if ( null === $suffix ) {
		$debug   = defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG;
		$enabled = (bool) apply_filters( 'example_plugin_enable_suffix', ! $debug );
		$suffix  = $enabled ? '.min' : '';
	}

	return $suffix;
}

/**
 * Helper function to determine whether or not to load a packed version of
 * our JavaScript libraries on the front end.
 *
 * Developers can filter example_plugin_enable_packed_js to false if they
 * are loading any of the following libraries in their theme or plugin:
 *
 * @since  1.0.0
 * @access protected
 * @return bool
 */
function _example_plugin_enable_packed_js() {
	$suffix = example_plugin_get_suffix();

	if ( empty( $suffix ) ) {
		return false;
	}

	return (bool) apply_filters( 'example_plugin_enable_packed_js', true );
}

/**
 * Load all required CSS files on the front end.
 *
 * Developers can disable our CSS by filtering example_plugin_load_css to
 * false within their theme or plugin.
 *
 * @since  1.0.0
 * @access public
 * @return void
 */
function example_plugin_load_css() {
	if ( ! apply_filters( 'example_plugin_load_css', true ) ) {
		return;
	}

	$suffix = example_plugin_get_suffix();

	wp_enqueue_style(
		'example-plugin',
		EXAMPLE_PLUGIN_URI . "css/example-plugin{$suffix}.css",
		array(),
		EXAMPLE_PLUGIN_VERSION
	);
}

/**
 * Load all required JavaScript files on the front end.
 *
 * Developers can disable our JS by filtering example_plugin_load_js to
 * false within their theme or plugin.
 *
 * @since  1.0.0
 * @access public
 * @return void
 */
function example_plugin_load_js() {
	if ( ! apply_filters( 'example_plugin_load_js', true ) ) {
		return;
	}

	if ( _example_plugin_enable_packed_js() ) {
		example_plugin_load_packed_js();
	} else {
		example_plugin_load_unpacked_js();
	}
}

/**
 * Load the packed and minified version of our JavaScript files. This is the
 * preferred loading method as it saves us from adding a bunch of http
 * requests, but it could create conflicts with some plugins and themes.
 *
 * @since  1.0.0
 * @access public
 * @return void
 */
function example_plugin_load_packed_js() {
	$suffix = example_plugin_get_suffix();

	wp_enqueue_script(
		'example-plugin',
		EXAMPLE_PLUGIN_URI . "js/examplePlugin.pkgd{$suffix}.js",
		array( 'jquery' ),
		EXAMPLE_PLUGIN_VERSION,
		true
	);
}

/**
 * Load all of our JS files individually to for maximum compatibility.
 *
 * @since  1.0.0
 * @access public
 * @return void
 */
function example_plugin_load_unpacked_js() {
	$suffix = example_plugin_get_suffix();

	wp_enqueue_script(
		'example-plugin',
		EXAMPLE_PLUGIN_URI . "js/examplePlugin{$suffix}.js",
		array( 'jquery' ),
		EXAMPLE_PLUGIN_VERSION,
		true
	);
}
