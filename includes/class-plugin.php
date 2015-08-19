<?php
/**
 * Example Plugin main plugin class.
 *
 * @package   ExamplePlugin
 * @copyright Copyright (c) 2015, WP Site Care
 * @license   MIT
 * @since     0.1.0
 */

// Prevent direct access.
defined( 'ABSPATH' ) || exit;

/**
 * Main plugin class.
 */
class Example_Plugin {

	/**
	 * The current plugin version.
	 *
	 * @since 0.1.0
	 * @var   string
	 */
	private $version = '0.1.0';

	/**
	 * The main plugin file.
	 *
	 * @since 0.1.0
	 * @var   string
	 */
	private $file;

	/**
	 * The plugin's directory path with a trailing slash.
	 *
	 * @since 0.1.0
	 * @var   string
	 */
	private $dir;

	/**
	 * The plugin directory URL with a trailing slash.
	 *
	 * @since 0.1.0
	 * @var   string
	 */
	private $url;

	/**
	 * Property for storing the primary plugin options array slug.
	 *
	 * @since 0.1.0
	 * @var   string
	 */
	private $options_slug = 'example_plugin_options';

	public function __construct( $args ) {
		if ( ! isset( $args['file'] ) ) {
			return _doing_it_wrong(
				__CLASS__,
				esc_html__( 'Example plugin must be instantiated with a path to the root plugin file.', 'example-plugin' ),
				absint( $this->version )
			);
		}
		$this->file = $args['file'];
		$this->dir  = plugin_dir_path( $this->file );
		$this->url  = plugin_dir_url( $this->file );
	}

	/**
	 * Store a single instance of the main plugin class.
	 *
	 * This is primarily to prevent unwanted instances of the main class from
	 * floating around in memory unnecessarily.
	 *
	 * @since  0.1.0
	 * @access public
	 * @uses   Example_Plugin
	 * @return object Example_Plugin A single instance of the main plugin class.
	 */
	public static function instance( $args ) {
		static $instance;
		if ( null === $instance ) {
			$instance = new self( $args );
		}
		return $instance;
	}

	/**
	 * Method to initialize the plugin.
	 *
	 * @since  0.1.0
	 * @return void
	 */
	public function run() {
		self::load_textdomain();
		spl_autoload_register( array( __CLASS__, 'autoloader' ) );
		self::build( 'Example_Plugin_Factory' );
	}

	/**
	 * Retrieve the plugin version number.
	 *
	 * @since  0.1.0
	 * @access public
	 * @return string
	 */
	public function get_version() {
		return $this->version;
	}

	/**
	 * Retrieve a trailing slashed path to the plugin directory.
	 *
	 * @since  0.1.0
	 * @access public
	 * @return string
	 */
	public function get_file() {
		return $this->file;
	}

	/**
	 * Retrieve a trailing slashed path to the plugin directory.
	 *
	 * @since  0.1.0
	 * @access public
	 * @return string
	 */
	public function get_dir() {
		return $this->dir;
	}

	/**
	 * Retrieve a trailing slashed URL to the plugin directory.
	 *
	 * @since  0.1.0
	 * @access public
	 * @return string
	 */
	public function get_url() {
		return $this->url;
	}

	/**
	 * Retrieve the plugin options slug.
	 *
	 * @since  0.1.0
	 * @access public
	 * @return string Example_Plugin::options_slug the plugin options slug
	 */
	public function get_options_slug() {
		return $this->options_slug;
	}

	/**
	 * Retrieve the plugin options slug.
	 *
	 * @since  0.1.0
	 * @access public
	 * @return array an array of all the plugin options.
	 */
	public function get_options() {
		return get_option( $this->options_slug, array() );
	}

	/**
	 * Loads the plugin language files
	 *
	 * @since  0.1.0
	 * @access public
	 * @return void
	 */
	public function load_textdomain() {
		load_plugin_textdomain(
			'example-plugin',
			false,
			dirname( plugin_basename( $this->file ) ) . '/languages'
		);
	}

	/**
	 * Load all plugin classes when they're instantiated.
	 *
	 * @since  0.1.0
	 * @access protected
	 * @return void
	 */
	protected function autoloader( $class ) {
		$class = strtolower( str_replace( '_', '-', str_replace( __CLASS__ . '_', '', $class ) ) );
		$file  = "{$this->dir}includes/class-{$class}.php";

		if ( false !== strpos( $class, 'admin' ) ) {
			$class = str_replace( 'admin-', '', $class );
			$file  = "{$this->dir}admin/class-{$class}.php";
		}

		if ( file_exists( $file ) ) {
			require_once $file;
			return true;
		}
		return false;
	}

	/**
	 * Build a reference to our default plugin classes.
	 *
	 * @since  0.1.0
	 * @access protected
	 * @return void
	 */
	protected function get_classes() {
		$classes = array();
		if ( ! is_admin() ) {
			$classes[] = 'public-scripts';
		}
		return $classes;
	}

	/**
	 * Store a reference to our classes and get them running.
	 *
	 * @since  0.1.0
	 * @access protected
	 * @param  $factory string the name of our factory class
	 * @return void
	 */
	protected function build( $factory ) {
		foreach ( $this->get_classes() as $class ) {
			$object = $factory::get( $class );
			if ( method_exists( $object, 'run' ) ) {
				$object->run();
			}
		}
	}

}
