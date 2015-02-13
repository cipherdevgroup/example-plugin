<?php
/**
 * Example Plugin template part for an admin settings page.
 *
 * @package     ExamplePlugin
 * @author      Robert Neu
 * @copyright   Copyright (c) 2015, WP Site Care, LLC
 * @license     GPL-2.0+
 * @since       0.0.1
 */
?>
<div class="wrap">

	<h2><?php _e( 'Example Plugin Settings', 'example-plugin' ); ?></h2>
	<h2 class="nav-tab-wrapper">

		<?php foreach ( $this->get_tabs() as $tab_id => $tab_name ) : ?>

			<?php
			$tab_url = add_query_arg(
				array(
					'settings-updated' => false,
					'tab'              => $tab_id,
				)
			);
			?>

			<?php $active = $active_tab == $tab_id ? ' nav-tab-active' : ''; ?>

			<a href="<?php echo esc_url( $tab_url ); ?>" title="<?php echo esc_attr( $tab_name ); ?>" class="nav-tab<?php echo $active; ?>">
				<?php echo esc_html( $tab_name ); ?>
			</a>

		<?php endforeach; ?>

	</h2>

	<div id="tab-container" class="tab-container">

		<form method="post" action="options.php">

			<table id="form-table" class="form-table">
				<?php settings_fields( $key ); ?>
				<?php do_settings_fields( "{$key}_{$active_tab}", "{$key}_{$active_tab}" ); ?>
			</table>

			<?php submit_button(); ?>

		</form>

		<?php do_action( 'example_plugin_settings_content' ); ?>

	</div><!-- #tab-container-->

</div><!-- .wrap -->
