<?php
/**
 * Functions for getting and setting plugin options data.
 *
 * @package    ExamplePlugin\Functions\Options
 * @copyright  Copyright (c) 2016, WP Site Care
 * @license    MIT
 * @since      0.1.0
 */

/**
 * Retrieve the plugin options slug.
 *
 * @since  0.1.0
 * @access public
 * @return string the plugin options slug.
 */
function example_plugin_get_options_slug() {
	return 'example_plugin_options';
}

/**
 * Retrieve the main plugin options.
 *
 * @since  0.1.0
 * @access public
 * @return array an array of all the main plugin options.
 */
function example_plugin_get_options() {
	static $options;

	if ( null === $options ) {
		$options = get_option( example_plugin_get_options_slug(), array() );
	}

	return $options;
}

/**
 * Add the main plugin options if they haven't been added yet.
 *
 * @since  0.1.0
 * @access public
 * @return array an array of all the main plugin options.
 */
function example_plugin_add_options( $value, $autoload = 'no' ) {
	$options = example_plugin_get_options();
	if ( empty( $options ) ) {
		return add_option( example_plugin_get_options_slug(), $value, '', $autoload );
	}
	return false;
}

/**
 * Set the main plugin options by merging an array of new values in with
 * the old.
 *
 * @since  0.1.0
 * @access public
 * @return array an array of all the main plugin options.
 */
function example_plugin_set_options( $value ) {
	return update_option(
		example_plugin_get_options_slug(),
		array_merge( example_plugin_get_options(), (array) $value )
	);
}

/**
 * Delete all of the main plugin options.
 *
 * @since  0.1.0
 * @access public
 * @return array an array of all the main plugin options.
 */
function example_plugin_delete_options() {
	return delete_option( example_plugin_get_options_slug() );
}

/**
 * Get an option from within the main plugin options array.
 *
 * @since  0.1.0
 * @access public
 * @return void
 */
function example_plugin_get_option( $slug ) {
	$options = example_plugin_get_options();
	return isset( $options[ $slug ] ) ? $options[ $slug ] : false;
}

/**
 * Set an option within the main plugin options array.
 *
 * @since  0.1.0
 * @access public
 * @return void
 */
function example_plugin_set_option( $slug, $value ) {
	return update_option(
		example_plugin_get_options_slug(),
		array_merge( example_plugin_get_options(), array( $slug => $value ) )
	);
}

/**
 * Delete an option from the main plugin options array.
 *
 * @since  0.1.0
 * @access public
 * @return void
 */
function example_plugin_delete_option( $slug ) {
	$options = example_plugin_get_options();
	unset( $options[ $slug ] );

	return update_option(
		example_plugin_get_options_slug(),
		$options
	);
}
