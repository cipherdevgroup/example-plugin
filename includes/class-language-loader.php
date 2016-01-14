<?php
/**
 * Load translations for the plugin.
 *
 * @package    ExamplePlugin
 * @subpackage ExamplePlugin\Classes
 * @author     Robert Neu
 * @copyright  Copyright (c) 2016, WP Site Care
 * @license    MIT
 * @since      0.1.0
 */

defined( 'ABSPATH' ) || exit;

class Example_Plugin_Language_Loader {
	/**
	 * Name of the text domain.
	 *
	 * @since 0.1.0
	 * @type  string
	 */
	const DOMAIN = 'example-plugin';

	/**
	 * Get the class running!
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
	 * @access protected
	 * @return void
	 */
	protected function wp_hooks() {
		add_action( 'admin_head-plugins.php', array( $this, 'load' ) );
	}

	/**
	 * Loads translation file.
	 *
	 * @since  0.1.0
	 * @access public
	 * @return bool true when the file was found, false otherwise.
	 */
	public function load() {
		return load_plugin_textdomain(
			self::DOMAIN,
			false,
			dirname( plugin_basename( example_plugin()->get_file() ) ) . '/languages'
		);
	}

	/**
	 * Remove translations from memory.
	 *
	 * @since  0.1.0
	 * @access public
	 * @return bool true if the text domain was loaded, false if it was not.
	 */
	public function unload() {
		return unload_textdomain( self::DOMAIN );
	}

	/**
	 * Whether or not the language has been loaded already.
	 *
	 * @since  0.1.0
	 * @access public
	 * @return bool
	 */
	public function is_loaded() {
		return is_textdomain_loaded( self::DOMAIN );
	}
}
