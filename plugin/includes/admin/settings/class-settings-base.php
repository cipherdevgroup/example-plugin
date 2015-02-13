<?php
/**
 * Example Plugin Base Settings Class.
 *
 * @package     ExamplePlugin
 * @author      Robert Neu
 * @copyright   Copyright (c) 2015, WP Site Care, LLC
 * @license     GPL-2.0+
 * @since       0.0.1
 */

// Prevent direct access.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

abstract class Example_Plugin_Settings_Base {

	/**
	 * Option key, and option page slug.
	 * @var string
	 */
	public $key = 'example_plugin_settings';

	/**
	 * Plugin options array.
	 * @var array
	 */
	protected $options;

	public function __construct() {
		$this->options = get_option( $this->key, array() );
	}

	protected function wp_hooks() {
		// Ensure our register settings method is only hooked once.
		if ( ! has_action( 'admin_init', array( $this, 'register_settings' ) ) ) {
			add_action( 'admin_init', array( $this, 'register_settings' ) );
		}
	}

	/**
	 * Get the value of a specific setting.
	 *
	 * @since  0.0.1
	 * @param  $key string the key of the desired settings option
	 * @param  $default bool the default value of the desired settings option
	 * @return mixed
	*/
	public function get( $key, $default = false ) {
		$value = ! empty( $this->options[ $key ] ) ? $this->options[ $key ] : $default;
		return $value;
	}

	/**
	 * Get all settings
	 *
	 * @since  0.0.1
	 * @return array
	*/
	public function get_all() {
		return $this->options;
	}

	/**
	 * Retrieve the array of plugin settings
	 *
	 * @since  0.0.1
	 * @return array
	*/
	function get_registered_settings() {
		return apply_filters( $this->key, array() );
	}

	/**
	 * Add all settings sections and fields.
	 *
	 * @since  0.0.1
	 * @return void
	*/
	public function register_settings() {

		if ( false === get_option( $this->key ) ) {
			add_option( $this->key );
		}

		foreach ( $this->get_registered_settings() as $tab => $settings ) {

			add_settings_section(
				"{$this->key}_{$tab}",
				__return_null(),
				'__return_false',
				"{$this->key}_{$tab}"
			);

			foreach ( $settings as $key => $option ) {

				$name = isset( $option['name'] ) ? $option['name'] : '';

				add_settings_field(
					"{$this->key}[{$key}]",
					$name,
					is_callable( array( $this, $option['type'] . '_callback' ) ) ? array( $this, $option['type'] . '_callback' ) : array( $this, 'missing_callback' ),
					"{$this->key}_{$tab}",
					"{$this->key}_{$tab}",
					array(
						'id'      => $key,
						'section' => $tab,
						'desc'    => ! empty( $option['desc'] )  ? $option['desc']    : '',
						'name'    => isset( $option['name'] )    ? $option['name']    : null,
						'size'    => isset( $option['size'] )    ? $option['size']    : null,
						'max'     => isset( $option['max'] )     ? $option['max']     : null,
						'min'     => isset( $option['min'] )     ? $option['min']     : null,
						'step'    => isset( $option['step'] )    ? $option['step']    : null,
						'options' => isset( $option['options'] ) ? $option['options'] : '',
						'std'     => isset( $option['std'] )     ? $option['std']     : '',
					)
				);
			}
		}

		// Creates our settings in the options table
		register_setting( $this->key, $this->key, array( $this, 'sanitize_settings' ) );

	}

	/**
	 * Retrieve the array of plugin settings.
	 *
	 * @since  0.0.1
	 * @return array
	*/
	public function sanitize_settings( $input = array() ) {

		if ( empty( $_POST['_wp_http_referer'] ) ) {
			return $input;
		}

		parse_str( $_POST['_wp_http_referer'], $referrer );

		$saved = get_option( $this->key, array() );
		if ( ! is_array( $saved ) ) {
			$saved = array();
		}
		$settings = $this->get_registered_settings();
		$tab      = isset( $referrer['tab'] ) ? $referrer['tab'] : 'general';

		$input = $input ? $input : array();
		$input = apply_filters( "{$this->key}_{$tab}_sanitize", $input );

		// Ensure a value is always passed for every checkbox
		if ( ! empty( $settings[ $tab ] ) ) {
			foreach ( $settings[ $tab ] as $key => $setting ) {

				// Single checkbox
				if ( isset( $settings[ $tab ][ $key ]['type'] ) && 'checkbox' === $settings[ $tab ][ $key ]['type'] ) {
					$input[ $key ] = ! empty( $input[ $key ] );
				}

				// Multicheck list
				if ( isset( $settings[ $tab ][ $key ]['type'] ) && 'multicheck' === $settings[ $tab ][ $key ]['type'] ) {
					if ( empty( $input[ $key ] ) ) {
						$input[ $key ] = array();
					}
				}

				// Image Size
				if ( isset( $settings[ $tab ][ $key ]['type'] ) && 'image_size' === $settings[ $tab ][ $key ]['type'] ) {
					if ( empty( $input[ $key ] ) ) {
						$input[ $key ] = array();
					}
				}
			}
		}

		// Loop through each setting being saved and pass it through a sanitization filter
		foreach ( $input as $key => $value ) {

			// Get the setting type (checkbox, select, etc)
			$type = isset( $settings[ $tab ][ $key ]['type'] ) ? $settings[ $tab ][ $key ]['type'] : false;

			if ( $type ) {
				// Field type specific filter
				$input[ $key ] = apply_filters( 'example_plugin_settings_sanitize_' . $type, $value, $key );
			}

			// General filter
			$input[ $key ] = apply_filters( 'example_plugin_settings_sanitize', $value, $key );
		}

		//wp_die( var_dump( $_POST ) );

		if ( ! isset( $_POST['example_plugin_activate_license'] ) && ! isset( $_POST['example_plugin_deactivate_license'] ) ) {
			add_settings_error( 'example-plugin-notices', '', esc_attr__( 'Settings updated.', 'example-plugin' ), 'updated' );
		}

		return array_merge( $saved, $input );

	}

	/**
	 * Return registered image sizes.
	 *
	 * Return a two-dimensional array of just the additionally registered image
	 * sizes, with width, height and crop sub-keys.
	 *
	 * @since
	 * @global array $_wp_additional_image_sizes Additionally registered image sizes.
	 * @return array Two-dimensional, with width, height and crop sub-keys.
	 */
	protected function get_image_sizes() {
		$image_sizes = array();

		// Create the full array with sizes and crop info
		foreach ( get_intermediate_image_sizes() as $key => $size ) {
			$image_sizes[ $size ] = $size;
		}

		return $image_sizes;
	}

	/**
	 * Header Callback
	 *
	 * Renders the header.
	 *
	 * @since  0.0.1
	 * @param  array $args Arguments passed by the setting
	 * @return void
	 */
	public function header_callback( $args ) {
		echo '<hr/>';
	}

	/**
	 * Checkbox Callback
	 *
	 * Renders checkboxes.
	 *
	 * @since  0.0.1
	 * @param  array $args Arguments passed by the setting
	 * @global $this->options Array of all the Rich_Recipes Options
	 * @return void
	 */
	public function checkbox_callback( $args ) {
		$checked = isset( $this->options[ $args['id'] ] ) ? checked( 1, $this->options[ $args['id'] ], false ) : '';
		$html = '<input type="checkbox" id="example_plugin_settings[' . $args['id'] . ']" name="example_plugin_settings[' . $args['id'] . ']" value="1" ' . $checked . '/>';
		$html .= '<label for="example_plugin_settings[' . $args['id'] . ']"> '  . $args['desc'] . '</label>';

		echo $html;
	}

	/**
	 * Multicheck Callback
	 *
	 * Renders multiple checkboxes.
	 *
	 * @since  0.0.1
	 * @param  array $args Arguments passed by the setting
	 * @global $this->options Array of all the Rich_Recipes Options
	 * @return void
	 */
	public function multicheck_callback( $args ) {
		if ( empty( $args['options'] ) ) {
			return;
		}
		$default = isset( $args['std'] ) ? $args['std'] : null;

		foreach ( $args['options'] as $key => $option ) {
			$enabled = null;
			if ( isset( $this->options[ $args['id'] ][ $key ] ) ) {
				$enabled = $option;
			}
			if ( null === $enabled && null !== $default ) {
				$enabled = $default;
			}
			echo '<input name="example_plugin_settings[' . $args['id'] . '][' . $key . ']" id="example_plugin_settings[' . $args['id'] . '][' . $key . ']" type="checkbox" value="' . $option . '" ' . checked( $option, $enabled, false ) . '/>&nbsp;';
			echo '<label for="example_plugin_settings[' . $args['id'] . '][' . $key . ']">' . $option . '</label><br/>';
		}
		echo '<p class="description">' . $args['desc'] . '</p>';
	}

	/**
	 * Radio Callback
	 *
	 * Renders radio boxes.
	 *
	 * @since  0.0.1
	 * @param  array $args Arguments passed by the setting
	 * @global $this->options Array of all the Rich_Recipes Options
	 * @return void
	 */
	public function radio_callback( $args ) {

		foreach ( $args['options'] as $key => $option ) {
			$checked = false;

			if ( isset( $this->options[ $args['id'] ] ) && $this->options[ $args['id'] ] == $key ) {
				$checked = true;
			}
			elseif ( isset( $args['std'] ) && $args['std'] === $key && ! isset( $this->options[ $args['id'] ] ) ) {
				$checked = true;
			}

			echo '<input name="example_plugin_settings[' . $args['id'] . ']"" id="example_plugin_settings[' . $args['id'] . '][' . $key . ']" type="radio" value="' . $key . '" ' . checked( true, $checked, false ) . '/>&nbsp;';
			echo '<label for="example_plugin_settings[' . $args['id'] . '][' . $key . ']">' . $option . '</label><br/>';
		}

		echo '<p class="description">' . $args['desc'] . '</p>';
	}

	/**
	 * Text Callback
	 *
	 * Renders text fields.
	 *
	 * @since  0.0.1
	 * @param  array $args Arguments passed by the setting
	 * @global $this->options Array of all the Rich_Recipes Options
	 * @return void
	 */
	public function text_callback( $args ) {
		$value = isset( $args['std'] ) ? $args['std'] : '';

		if ( isset( $this->options[ $args['id'] ] ) ) {
			$value = $this->options[ $args['id'] ];
		}

		$size = ( isset( $args['size'] ) && ! is_null( $args['size'] ) ) ? $args['size'] : 'regular';
		$html = '<input type="text" class="' . $size . '-text" id="example_plugin_settings[' . $args['id'] . ']" name="example_plugin_settings[' . $args['id'] . ']" value="' . esc_attr( stripslashes( $value ) ) . '"/>';
		$html .= '<label for="example_plugin_settings[' . $args['id'] . ']"> '  . $args['desc'] . '</label>';

		echo $html;
	}

	/**
	 * License Callback
	 *
	 * Renders license key fields.
	 *
	 * @since  0.0.1
	 * @param  array $args Arguments passed by the setting
	 * @global $this->options Array of all the Rich_Recipes Options
	 * @return void
	 */
	public function license_callback( $args ) {
		$value = isset( $args['std'] ) ? $args['std'] : '';

		if ( isset( $this->options[ $args['id'] ] ) ) {
			$value = $this->options[ $args['id'] ];
		}

		$size = ( isset( $args['size'] ) && ! is_null( $args['size'] ) ) ? $args['size'] : 'regular';
		$html = '<input type="password" class="' . $size . '-text" id="example_plugin_settings[' . $args['id'] . ']" name="example_plugin_settings[' . $args['id'] . ']" value="' . esc_attr( stripslashes( $value ) ) . '"/>';
		$license_status = $this->get( 'license_status' );
		$license_key = ! empty( $value ) ? $value : false;

		if ( 'valid' === $license_status && ! empty( $license_key ) ) {
			$html .= '<input type="submit" class="button" name="example_plugin_deactivate_license" value="' . esc_attr__( 'Deactivate License', 'example-plugin' ) . '"/>';
			$html .= '<span style="color:green;">&nbsp;' . esc_attr__( 'Your license is valid!', 'example-plugin' ) . '</span>';
		}
		if ( 'expired' === $license_status && ! empty( $license_key ) ) {
			$renewal_url = add_query_arg( array( 'edd_license_key' => $license_key, 'download_id' => 17 ), 'https://richrecipesplugin.com/checkout' );
			$html .= '<a href="' . esc_url( $renewal_url ) . '" class="button-primary">' . esc_attr__( 'Renew Your License', 'example-plugin' ) . '</a>';
			$html .= '<br/><span style="color:red;">&nbsp;' . esc_attr__( 'Your license has expired, renew today to continue getting updates and support!', 'example-plugin' ) . '</span>';
		}
		if ( empty( $license_key ) || ( 'expired' !== $license_status && 'valid' !== $license_status ) ) {
			$html .= '<input type="submit" class="button" name="example_plugin_activate_license" value="' . esc_attr__( 'Activate License', 'example-plugin' ) . '"/>';
		}

		$html .= '<br/><label for="example_plugin_settings[' . $args['id'] . ']"> '  . $args['desc'] . '</label>';

		echo $html;
	}

	/**
	 * Number Callback
	 *
	 * Renders number fields.
	 *
	 * @since  0.0.1
	 * @param  array $args Arguments passed by the setting
	 * @global $this->options Array of all the Rich_Recipes Options
	 * @return void
	 */
	public function number_callback( $args ) {
		$value = isset( $args['std'] ) ? $args['std'] : '';

		if ( isset( $this->options[ $args['id'] ] ) ) {
			$value = $this->options[ $args['id'] ];
		}

		$max  = isset( $args['max'] ) ? $args['max'] : 999999;
		$min  = isset( $args['min'] ) ? $args['min'] : 0;
		$step = isset( $args['step'] ) ? $args['step'] : 1;

		$size = ( isset( $args['size'] ) && ! is_null( $args['size'] ) ) ? $args['size'] : 'regular';
		$html = '<input type="number" step="' . esc_attr( $step ) . '" max="' . esc_attr( $max ) . '" min="' . esc_attr( $min ) . '" class="' . $size . '-text" id="example_plugin_settings[' . $args['id'] . ']" name="example_plugin_settings[' . $args['id'] . ']" value="' . esc_attr( stripslashes( $value ) ) . '"/>';
		$html .= '<label for="example_plugin_settings[' . $args['id'] . ']"> '  . $args['desc'] . '</label>';

		echo $html;
	}

	/**
	 * Image Size Callback
	 *
	 * Renders number fields for setting the dimensions of an image.
	 *
	 * @since  0.0.1
	 * @param  array $args Arguments passed by the setting
	 * @global $this->options Array of all the Rich_Recipes Options
	 * @return void
	 */
	public function image_size_callback( $args ) {
		$value = empty( $args['std'] ) ? array() : $args['std'];

		if ( is_array( $this->options[ $args['id'] ] ) && ! empty( $this->options[ $args['id'] ] ) ) {
			$value = $this->options[ $args['id'] ];
		}

		$max  = isset( $args['max'] ) ? $args['max'] : 999999;
		$min  = isset( $args['min'] ) ? $args['min'] : 0;
		$step = isset( $args['step'] ) ? $args['step'] : 1;

		$size = ( isset( $args['size'] ) && ! is_null( $args['size'] ) ) ? $args['size'] : 'regular';
		?>
		<?php _e( 'Width', 'example-plugin' ); ?> <input type="number" step="<?php echo absint( $step ); ?>" max="<?php echo absint( $max ); ?>" min="<?php echo absint( $min ); ?>" class="<?php echo $size; ?>-text" id="example_plugin_settings[<?php echo $args['id']; ?>]" name="example_plugin_settings[<?php echo $args['id']; ?>]" value="<?php echo absint( stripslashes( $value['width'] ) ); ?>"/>
		<?php _e( 'Height', 'example-plugin' ); ?> <input type="number" step="<?php echo absint( $step ); ?>" max="<?php echo absint( $max ); ?>" min="<?php echo absint( $min ); ?>" class="<?php echo $size; ?>-text" id="example_plugin_settings[<?php echo $args['id']; ?>]" name="example_plugin_settings[<?php echo $args['id']; ?>]" value="<?php echo absint( stripslashes( $value['height'] ) ); ?>"/>
		<label for="example_plugin_settings[<?php echo $args['id']; ?>]"> <?php echo $args['desc']; ?></label>
		<?php
	}

	/**
	 * Textarea Callback
	 *
	 * Renders textarea fields.
	 *
	 * @since  0.0.1
	 * @param  array $args Arguments passed by the setting
	 * @global $this->options Array of all the Rich_Recipes Options
	 * @return void
	 */
	public function textarea_callback( $args ) {
		$value = isset( $args['std'] ) ? $args['std'] : '';

		if ( isset( $this->options[ $args['id'] ] ) ) {
			$value = $this->options[ $args['id'] ];
		}

		$size = ( isset( $args['size'] ) && ! is_null( $args['size'] ) ) ? $args['size'] : 'regular';
		$html = '<textarea class="large-text" cols="50" rows="5" id="example_plugin_settings[' . $args['id'] . ']" name="example_plugin_settings[' . $args['id'] . ']">' . esc_textarea( stripslashes( $value ) ) . '</textarea>';
		$html .= '<label for="example_plugin_settings[' . $args['id'] . ']"> '  . $args['desc'] . '</label>';

		echo $html;
	}

	/**
	 * Password Callback
	 *
	 * Renders password fields.
	 *
	 * @since  0.0.1
	 * @param  array $args Arguments passed by the setting
	 * @global $this->options Array of all the Rich_Recipes Options
	 * @return void
	 */
	public function password_callback( $args ) {
		$value = isset( $args['std'] ) ? $args['std'] : '';

		if ( isset( $this->options[ $args['id'] ] ) ) {
			$value = $this->options[ $args['id'] ];
		}

		$size = ( isset( $args['size'] ) && ! is_null( $args['size'] ) ) ? $args['size'] : 'regular';
		$html = '<input type="password" class="' . $size . '-text" id="example_plugin_settings[' . $args['id'] . ']" name="example_plugin_settings[' . $args['id'] . ']" value="' . esc_attr( $value ) . '"/>';
		$html .= '<label for="example_plugin_settings[' . $args['id'] . ']"> '  . $args['desc'] . '</label>';

		echo $html;
	}

	/**
	 * Missing Callback
	 *
	 * If a function is missing for settings callbacks alert the user.
	 *
	 * @since  0.0.1
	 * @param  array $args Arguments passed by the setting
	 * @return void
	 */
	public function missing_callback( $args ) {
		printf( esc_attr__( 'The callback function used for the <strong>%s</strong> setting is missing.', 'example-plugin' ), $args['id'] );
	}

	/**
	 * Select Callback
	 *
	 * Renders select fields.
	 *
	 * @since  0.0.1
	 * @param  array $args Arguments passed by the setting
	 * @global $this->options Array of all the Rich_Recipes Options
	 * @return void
	 */
	public function select_callback( $args ) {
		$value = isset( $args['std'] ) ? $args['std'] : '';

		if ( isset( $this->options[ $args['id'] ] ) ) {
			$value = $this->options[ $args['id'] ];
		}

		$html = '<select id="example_plugin_settings[' . $args['id'] . ']" name="example_plugin_settings[' . $args['id'] . ']"/>';

		foreach ( $args['options'] as $option => $name ) {
			$selected = selected( $option, $value, false );
			$html .= '<option value="' . $option . '" ' . $selected . '>' . $name . '</option>';
		}

		$html .= '</select>';
		$html .= '<label for="example_plugin_settings[' . $args['id'] . ']"> '  . $args['desc'] . '</label>';

		echo $html;
	}

	/**
	 * Rich Editor Callback
	 *
	 * Renders rich editor fields.
	 *
	 * @since  0.0.1
	 * @param  array $args Arguments passed by the setting
	 * @global $this->options Array of all the Rich_Recipes Options
	 * @global $wp_version WordPress Version
	 */
	public function rich_editor_callback( $args ) {
		$value = isset( $args['std'] ) ? $args['std'] : '';

		if ( isset( $this->options[ $args['id'] ] ) ) {
			$value = $this->options[ $args['id'] ];
		}

		ob_start();
		wp_editor( stripslashes( $value ), 'example_plugin_settings[' . $args['id'] . ']', array( 'textarea_name' => 'example_plugin_settings[' . $args['id'] . ']' ) );
		$html = ob_get_clean();

		$html .= '<br/><label for="example_plugin_settings[' . $args['id'] . ']"> '  . $args['desc'] . '</label>';

		echo $html;
	}

}
