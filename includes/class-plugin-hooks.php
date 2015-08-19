<?php
/**
 * Example Plugin activation, deactivation, and uninstall hooks.
 *
 * @package   ExamplePlugin
 * @copyright Copyright (c) 2015, WP Site Care
 * @license   MIT
 * @since     0.1.0
 */

// Prevent direct access.
defined( 'ABSPATH' ) || exit;

class Example_Plugin_Plugin_Hooks {

	protected $options_slug;
	protected $options;
	protected $file;
	protected $plugin;

	public function __construct() {
		$this->options_slug = example_plugin()->get_options_slug();
		$this->options      = example_plugin()->get_options();
		$this->file         = example_plugin()->get_file();
		$this->plugin       = isset( $_REQUEST['plugin'] ) ? $_REQUEST['plugin'] : '';
	}

	/**
	 * Process plugin action routines based on how the action is called.
	 *
	 * @since  0.1.0
	 * @access public
	 * @param  bool $network_wide True if superadmin uses a "Network" action.
	 * @return void
	 */
	protected function handle_action( $action, $network_wide ) {
		$method = "single_{$action}";
		if ( is_multisite() ) {
			if ( ! $network_wide ) {
				return $this->$method();
			}
			foreach ( $this->get_blog_ids() as $blog_id ) {
				switch_to_blog( $blog_id );
				$this->$method();
				restore_current_blog();
			}
		} else {
			$this->$method();
		}
	}

	/**
	 * Process activation routines based on how the plugin is activated.
	 *
	 * @since  0.1.0
	 * @access public
	 * @param  bool $network_wide True if superadmin uses "Network Activate".
	 * @return void
	 */
	public function activate( $network_wide ) {
		$this->handle_action( 'activate', $network_wide );
	}

	/**
	 * Process deactivation routines based on how the plugin is deactivated.
	 *
	 * @since  0.1.0
	 * @access public
	 * @param  bool $network_wide True if superadmin uses "Network Deactivate".
	 * @return void
	 */
	public function deactivate( $network_wide ) {
		$this->handle_action( 'deactivate', $network_wide );
	}

	/**
	 * Process uninstallation routines based on how the plugin is uninstalled.
	 *
	 * @since  0.1.0
	 * @access public
	 * @return void
	 */
	public function uninstall() {
		$this->handle_action( 'uninstall', true );
	}

	/**
	 * Fired when a new site is activated with a WPMU environment.
	 *
	 * @since  0.1.0
	 * @access public
	 * @param  int $blog_id ID of the new blog.
	 * @return void
	 */
	public function activate_new_site( $blog_id ) {
		if ( 1 !== did_action( 'wpmu_new_blog' ) ) {
			return;
		}

		switch_to_blog( $blog_id );
		$this->single_activate();
		restore_current_blog();
	}

	/**
	 * Get all blog ids of blogs in the current network which are not
	 * archived, spam, or deleted.
	 *
	 * @since  0.1.0
	 * @access protected
	 * @return array|false The blog ids, false if no matches.
	 */
	protected function get_blog_ids() {
		global $wpdb;
		// get an array of blog ids
		$sql = "SELECT blog_id FROM $wpdb->blogs
			WHERE archived = '0' AND spam = '0'
			AND deleted = '0'";

		return $wpdb->get_col( $sql );
	}

	/**
	 * Set up the plugin's base options and store some data which may be useful
	 * on upgrade.
	 *
	 * @since  0.1.0
	 * @access protected
	 * @return array $setup an array of default plugin setup options.
	 */
	protected function setup_options() {
		$current = $this->options;
		$version = isset( $current['version'] ) ? $current['version'] : false;
		$setup = array(
			'is_installed' => true,
		);

		if ( $version ) {
			$setup['updated_from'] = $version;
		}
		$setup['version'] = example_plugin()->get_version();

		if ( empty( $current ) ) {
			add_option( $this->options_slug, $setup, '', 'no' );
		}
		return $setup;
	}

	/**
	 * Set up roles, options and required data on plugin activation.
	 *
	 * @since  0.1.0
	 * @access protected
	 * @return void
	 */
	protected function single_activate() {
		if ( ! current_user_can( 'activate_plugins' ) ) {
			return;
		}
		check_admin_referer( "activate-plugin_{$this->plugin}" );

		$updated = $this->setup_options();

		update_option( $this->options_slug, $updated );
	}

	/**
	 * Remove unnecessary data on plugin deactivation.
	 *
	 * @since  0.1.0
	 * @access protected
	 * @return void
	 */
	protected function single_deactivate() {
		if ( ! current_user_can( 'activate_plugins' ) ) {
			return;
		}
		check_admin_referer( "deactivate-plugin_{$this->plugin}" );
	}

	/**
	 * Clean up all leftover roles, options, and data on plugin removal.
	 *
	 * @since  0.1.0
	 * @access protected
	 * @return void
	 */
	protected function single_uninstall() {
		if ( ! current_user_can( 'activate_plugins' ) ) {
			return;
		}
		delete_option( $this->options_slug );
	}

}
