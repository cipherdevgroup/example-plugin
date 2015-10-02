<?php
/**
 * A class for getting and setting the primary plugin options data.
 *
 * @package   ExamplePlugin
 * @copyright Copyright (c) 2015, WP Site Care
 * @license   MIT
 * @since     0.1.0
 */

// Prevent direct access.
defined( 'ABSPATH' ) || exit;

class Example_Plugin_Options {
	/**
	 * The primary plugin options slug.
	 *
	 * @since 0.1.0
	 * @var   string
	 */
	protected $slug = 'example_plugin_options';

	/**
	 * Property for storing the primary plugin options array.
	 *
	 * @since 0.1.0
	 * @var   mixed
	 * @static
	 */
	protected static $options;

	/**
	 * Retrieve the plugin options slug.
	 *
	 * @since  0.1.0
	 * @access public
	 * @return string Example_Plugin_Options::slug the plugin options slug
	 */
	public function get_slug() {
		return $this->slug;
	}

	/**
	 * Retrieve the main plugin options.
	 *
	 * @since  0.1.0
	 * @access public
	 * @return array an array of all the main plugin options.
	 */
	public function get_options() {
		if ( is_null( self::$options ) ) {
			self::$options = get_option( $this->slug, array() );
		}
		return self::$options;
	}

	/**
	 * Add the main plugin options if they haven't been added yet.
	 *
	 * @since  0.1.0
	 * @access public
	 * @return array an array of all the main plugin options.
	 */
	public function add_options( $value, $autoload = 'no' ) {
		$options = $this->get_options();
		if ( empty( $options ) ) {
			return add_option( $this->slug, $value, '', $autoload );
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
	public function set_options( $value ) {
		return update_option(
			$this->slug,
			array_merge( $this->get_options(), (array) $value )
		);
	}

	/**
	 * Delete all of the main plugin options.
	 *
	 * @since  0.1.0
	 * @access public
	 * @return array an array of all the main plugin options.
	 */
	public function delete_options() {
		return delete_option( $this->slug );
	}

	/**
	 * Get an option from within the main plugin options array.
	 *
	 * @since  0.1.0
	 * @access public
	 * @return void
	 */
	public function get_option( $slug ) {
		$options = $this->get_options();
		return isset( $options[ $slug ] ) ? $options[ $slug ] : false;
	}

	/**
	 * Set an option within the main plugin options array.
	 *
	 * @since  0.1.0
	 * @access public
	 * @return void
	 */
	public function set_option( $slug, $value ) {
		return update_option(
			$this->slug,
			array_merge( $this->get_options(), array( $slug => $value ) )
		);
	}

	/**
	 * Delete an option from the main plugin options array.
	 *
	 * @since  0.1.0
	 * @access public
	 * @return void
	 */
	public function delete_option( $slug ) {
		$options = $this->get_options();
		unset( $options[ $slug ] );

		return update_option(
			$this->slug,
			$options
		);
	}
}
