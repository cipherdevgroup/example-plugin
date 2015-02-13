<?php
/**
 * Example Plugin scripts class.
 *
 * @package     ExamplePlugin
 * @author      Robert Neu
 * @copyright   Copyright (c) 2015, WP Site Care, LLC
 * @license     GPL-2.0+
 * @since       0.0.1
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Our Example_Plugin_Scripts class to register front-end styles and scripts.
 *
 * @package Example_Plugin
 * @version 0.0.1
 */
class Example_Plugin_Scripts {

	/**
	* A script prefix to load minified scripts and styles unless debugging.
	*
	* @since  0.0.1
	* @var   string
	*/
	private $prefix;

	/**
	* Get things running!
	*
	* @since  0.0.1
	* @access public
	* @return void
	*/
	public function run() {
		$this->prefix = defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ? '' : '.min';
		self::wp_hooks();
	}

	/**
	* Hook into WordPress.
	*
	* @since  0.0.1
	* @access public
	* @return void
	*/
	public function wp_hooks() {
		add_action( 'wp_enqueue_scripts', array( $this, 'styles' ) );
		add_action( 'wp_enqueue_scripts', array( $this, 'scripts' ) );
	}

	/**
	 * Load front-end styles for Example Plugin.
	 *
	 * @since   0.0.1
	 * @access  public
	 * @return  void
	 */
	function styles() {
		wp_enqueue_style(
			'example-plugin',
			EXAMPLE_PLUGIN_URL . "css/example-plugin{$this->prefix}.css",
			null,
			'0.0.1'
		);
	}

	/**
	 * Load front-end scripts for Example Plugin.
	 *
	 * @since   0.0.1
	 * @access  public
	 * @return  void
	 */
	function scripts() {
		wp_enqueue_script(
			'example-plugin',
			EXAMPLE_PLUGIN_URL . "js/example-plugin{$this->prefix}.js",
			array( 'jquery' ),
			'0.0.1',
			true
		);
	}
}
