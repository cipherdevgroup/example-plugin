<?php
/**
 * Load all public-facing scripts for the plugin.
 *
 * @package    ExamplePlugin
 * @subpackage ExamplePlugin\Classes
 * @author     Robert Neu
 * @copyright  Copyright (c) 2016, WP Site Care
 * @license    MIT
 * @since      0.1.0
 */

/**
 * Helper function for getting the script `.min` suffix for minified files.
 *
 * @since  0.1.0
 * @access public
 * @return string
 */
function example_plugin_get_suffix() {
	return defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ? '' : '.min';
}

/**
 * Helper function to determine whether or not to load a packed version of
 * our JavaScript libraries on the front end.
 *
 * Developers can filter example_plugin_enable_packed_js to false if they
 * are loading any of the following libraries in their theme or plugin:
 *
 * @since  0.1.0
 * @access protected
 * @return bool
 */
function _example_plugin_enable_packed_js() {
	if ( empty( example_plugin_get_suffix() ) ) {
		return false;
	}
	return apply_filters( 'example_plugin_enable_packed_js', true );
}

/**
 * Load all required CSS files on the front end.
 *
 * Developers can disable our CSS by filtering example_plugin_load_css to
 * false within their theme or plugin.
 *
 * @since  0.1.0
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
 * @since  0.1.0
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
 * @since  0.1.0
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
 * @since  0.1.0
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

/**
 * Remove all required scripts and styles on entries where the user has
 * checked the admin option to disable the lightbox.
 *
 * @since  0.1.0
 * @access public
 * @return void
 */
function example_plugin_maybe_disable() {
	if ( get_post_meta( get_the_ID(), 'example_plugin_disable', true ) ) {
		add_filter( 'example_plugin_load_css', '__return_false' );
		add_filter( 'example_plugin_load_js',  '__return_false' );
	}
}
