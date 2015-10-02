<?php
/**
 * Load all public-facing scripts for the plugin.
 *
 * @package   ExamplePlugin
 * @copyright Copyright (c) 2015, WP Site Care
 * @license   MIT
 * @since     0.1.0
 */

// Prevent direct access.
defined( 'ABSPATH' ) || exit;

class Example_Plugin_Public_Scripts extends Example_Plugin_Scripts {
	/**
	 * Get our class up and running!
	 *
	 * @since  0.1.0
	 * @access public
	 * @return void
	 */
	public function run() {
		$this->wp_hooks();
	}

	/**
	 * Hook into WordPress.
	 *
	 * @since  0.1.0
	 * @access public
	 * @return void
	 */
	protected function wp_hooks() {
		add_action( 'wp_enqueue_scripts', array( $this, 'load_css' ), 20 );
		add_action( 'wp_enqueue_scripts', array( $this, 'load_js' ),  20 );
		add_action( 'wp_enqueue_scripts', array( $this, 'maybe_disable' ) );
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
	public function load_css() {
		if ( ! apply_filters( 'example_plugin_load_css', true ) ) {
			return;
		}
		wp_enqueue_style(
			'example-plugin',
			$this->get_css_uri( "example-plugin{$this->suffix}.css" ),
			array(),
			$this->version
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
	public function load_js() {
		if ( ! apply_filters( 'example_plugin_load_js', true ) ) {
			return;
		}
		if ( $this->enable_packed_js() ) {
			$this->load_packed_js();
		} else {
			$this->load_unpacked_js();
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
	public function load_packed_js() {
		wp_enqueue_script(
			'example-plugin',
			$this->get_js_uri( "examplePlugin.pkgd{$this->suffix}.js" ),
			array( 'jquery' ),
			$this->version,
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
	public function load_unpacked_js() {
		wp_enqueue_script(
			'example-plugin',
			$this->get_js_uri( "examplePlugin{$this->suffix}.js" ),
			array( 'jquery' ),
			$this->version,
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
	public function maybe_disable() {
		if ( get_post_meta( get_the_ID(), 'example_plugin_disable', true ) ) {
			add_filter( 'example_plugin_load_css', '__return_false' );
			add_filter( 'example_plugin_load_js',  '__return_false' );
		}
	}
}
