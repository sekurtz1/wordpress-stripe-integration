<?php

function sktest_stripe_settings_setup() {
	add_options_page('Stripe Settings', 'Stripe Settings', 'manage_options', 'stripe-settings', 'sktest_stripe_render_options_page');
}
add_action('admin_menu', 'sktest_stripe_settings_setup');

function sktest_stripe_render_options_page() {
	global $stripe_options;
	?>
	<div class="wrap">
		<h2><?php _e('Stripe Settings', 'sktest_stripe'); ?></h2>
		<form method="post" action="options.php">

			<?php settings_fields('stripe_settings_group'); ?>

			<table class="form-table">
				<tbody>
					<tr valign="top">
						<th scope="row" valign="top">
							<?php _e('Test Mode', 'sktest_stripe'); ?>
						</th>
						<td>
							<input id="stripe_settings[test_mode]" name="stripe_settings[test_mode]" type="checkbox" value="1" <?php checked(1, $stripe_options['test_mode']); ?> />
							<label class="description" for="stripe_settings[test_mode]"><?php _e('Check this to use the plugin in test mode.', 'sktest_stripe'); ?></label>
						</td>
					</tr>
				</tbody>
			</table>

			<h3 class="title"><?php _e('API Keys', 'sktest_stripe'); ?></h3>
			<table class="form-table">
				<tbody>
					<tr valign="top">
						<th scope="row" valign="top">
							<?php _e('Live Secret', 'sktest_stripe'); ?>
						</th>
						<td>
							<input id="stripe_settings[live_secret_key]" name="stripe_settings[live_secret_key]" type="text" class="regular-text" value="<?php echo $stripe_options['live_secret_key']; ?>"/>
							<label class="description" for="stripe_settings[live_secret_key]"><?php _e('Paste your live secret key.', 'sktest_stripe'); ?></label>
						</td>
					</tr>
					<tr valign="top">
						<th scope="row" valign="top">
							<?php _e('Live Publishable', 'sktest_stripe'); ?>
						</th>
						<td>
							<input id="stripe_settings[live_publishable_key]" name="stripe_settings[live_publishable_key]" type="text" class="regular-text" value="<?php echo $stripe_options['live_publishable_key']; ?>"/>
							<label class="description" for="stripe_settings[live_publishable_key]"><?php _e('Paste your live publishable key.', 'sktest_stripe'); ?></label>
						</td>
					</tr>
					<tr valign="top">
						<th scope="row" valign="top">
							<?php _e('Test Secret', 'sktest_stripe'); ?>
						</th>
						<td>
							<input id="stripe_settings[test_secret_key]" name="stripe_settings[test_secret_key]" type="text" class="regular-text" value="<?php echo $stripe_options['test_secret_key']; ?>"/>
							<label class="description" for="stripe_settings[test_secret_key]"><?php _e('Paste your test secret key.', 'sktest_stripe'); ?></label>
						</td>
					</tr>
					<tr valign="top">
						<th scope="row" valign="top">
							<?php _e('Test Publishable', 'sktest_stripe'); ?>
						</th>
						<td>
							<input id="stripe_settings[test_publishable_key]" name="stripe_settings[test_publishable_key]" class="regular-text" type="text" value="<?php echo $stripe_options['test_publishable_key']; ?>"/>
							<label class="description" for="stripe_settings[test_publishable_key]"><?php _e('Paste your test publishable key.', 'sktest_stripe'); ?></label>
						</td>
					</tr>
				</tbody>
			</table>

			<!--<table class="form-table">
				<tbody>
					<tr valign="top">
						<th scope="row" valign="top">
							<?php _e('Allow Recurring', 'sktest_stripe'); ?>
						</th>
						<td>
							<input id="stripe_settings[recurring]" name="stripe_settings[recurring]" type="checkbox" value="1" <?php checked(1, isset( $stripe_options['recurring'] ) ); ?> />
							<label class="description" for="stripe_settings[recurring]"><?php _e('Check this to allow users to setup recurring payments.', 'sktest_stripe'); ?></label>
						</td>
					</tr>
					<tr valign="top">
						<th scope="row" valign="top">
							<?php _e('One Time Sign-up Fee', 'sktest_stripe'); ?>
						</th>
						<td>
							<input id="stripe_settings[one_time_fee]" name="stripe_settings[one_time_fee]" type="checkbox" value="1" <?php checked(1, isset( $stripe_options['one_time_fee'] ) ); ?> />
							<label class="description" for="stripe_settings[one_time_fee]"><?php _e('Check this charge customers a one time fee when signing up for a recurring subscription.', 'sktest_stripe'); ?></label>
						</td>
					</tr>
					<tr valign="top">
						<th scope="row" valign="top">
							<?php _e('Fee Amount', 'sktest_stripe'); ?>
						</th>
						<td>
							<input id="stripe_settings[fee_amount]" name="stripe_settings[fee_amount]" class="small-text" type="text" value="<?php echo isset( $stripe_options['fee_amount'] ) ? $stripe_options['fee_amount'] : ''; ?>"/>
							<label class="description" for="stripe_settings[fee_amount]"><?php _e('The one time fee amount in $.', 'sktest_stripe'); ?></label>
						</td>
					</tr>
				</tbody>
			</table> -->

			<p class="submit">
				<input type="submit" class="button-primary" value="<?php _e('Save Options', 'mfwp_domain'); ?>" />
			</p>

		</form>
	<?php
}

function sktest_stripe_register_settings() {
	// creates our settings in the options table
	register_setting('stripe_settings_group', 'stripe_settings');
}
add_action('admin_init', 'sktest_stripe_register_settings');