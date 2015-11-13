<?php

function sktest_stripe_payment_form($atts, $content = null) {

	extract( shortcode_atts( array(
		'amount' => ''
	), $atts ) );

	global $stripe_options;

	ob_start();

	 ?>
	 <div class="infobox" id="credit_card">
                
                <?php $stripe_id = get_user_meta(get_current_user_id(), 'stripe_customer_id', true);
                if ($stripe_id == '') { ?>
                
                 <h2 class="addheading"> Add a Credit Card </h2>
                 
                 <?php } else { ?>
                 
                 <h2 class="addheading"> Change Credit Card </h2>
                 
                 <?php } ?>
                
                 <div class="infotable">

	 
	 
	 
		<form action="" method="POST" id="stripe-payment-form">
			<div class="form-row">
				<label><?php _e('Name On Card', 'sktest_stripe'); ?></label><br/>
				<input type="text" size="20" class="cardname" name="cardname"/>
			</div>
			<div class="form-row">
				<label><?php _e('Card Number', 'sktest_stripe'); ?></label><br/>
				<input type="text" size="20" autocomplete="off" class="card-number"/>
			</div>
			<div class="form-row">
				<label><?php _e('CVC', 'sktest_stripe'); ?></label><br/>
				<input type="text" size="4" autocomplete="off" class="card-cvc"/>
			</div>
			<div class="form-row">
				<label><?php _e('Expiration (MM/YYYY)', 'sktest_stripe'); ?></label><br/>
				<input type="text" size="2" class="card-expiry-month"/>
				<span> / </span>
				<input type="text" size="4" class="card-expiry-year"/>
			</div>
			
			 <div id="stripelogo">
            	<a href="http://www.stripe.com"><img src="/wp-content/uploads/2015/04/big.png"></a>
            </div>
			
			
			<h3 class="billheading"> Billing Address </h3>
			
			<div class="form-row">
				<label><?php _e('Address 1', 'sktest_stripe'); ?></label><br/>
				<input type="text" size="20" class="address1" name="billing_address_1"/>
			</div>
			<div class="form-row">
				<label><?php _e('Address 2', 'sktest_stripe'); ?></label><br/>
				<input type="text" size="20" class="address2" name="billing_address_2"/>
			</div>
			<div class="form-row">
				<label><?php _e('City', 'sktest_stripe'); ?></label><br/>
				<input type="text" size="20" class="billingcity" name="billing_city"/>
			</div>
			<div class="form-row">
				<div class="col1">
					<label><?php _e('State', 'sktest_stripe'); ?></label><br/>
					<input type="text" size="20" class="billingstate" name="billing_state"/>
				</div>
				<div class="col2">
					<label><?php _e('Zipcode', 'sktest_stripe'); ?></label><br/>
					<input type="text" size="5" class="billingzip" name="billing_postcode"/>
				</div>
			</div>
			<input type="hidden" name="action" value="stripe"/>
			<input type="hidden" name="redirect" value="/account"/>
			<input type="hidden" name="amount" value="<?php echo base64_encode($amount); ?>"/>
			<input type="hidden" name="stripe_nonce" value="<?php echo wp_create_nonce('stripe-nonce'); ?>"/>
			<button type="submit" id="stripe-submit"><?php _e('Add Card', 'sktest_stripe'); ?></button>
		</form>
		<div class="payment-errors"></div>
		
		</div>
            
                 </div>		
		
		<?php
	
	return ob_get_clean();
}
add_shortcode('payment_form', 'sktest_stripe_payment_form');


function sktest_stripe_button_shortcode( $atts, $content = null ) {

	extract( shortcode_atts( array(
		'amount' => '',
		'desc'   => get_bloginfo( 'description' )
	), $atts ) );

	global $stripe_options;

	if( isset( $stripe_options['test_mode'] ) && $stripe_options['test_mode'] ) {
		$publishable = trim( $stripe_options['test_publishable_key'] );
	} else {
		$publishable = trim( $stripe_options['live_publishable_key'] );
	}

	ob_start();

	if(isset($_GET['payment']) && $_GET['payment'] == 'paid') {
		echo '<p class="success">' . __('Thank you for your payment.', 'sktest_stripe') . '</p>';
	} else { ?>
		<form action="" method="POST" id="stripe-button-form">
			<script
			  src="https://checkout.stripe.com/v2/checkout.js" class="stripe-button"
			  data-key="<?php echo $publishable; ?>"
			  data-name="<?php bloginfo( 'name' ); ?>"
			  data-description="<?php echo esc_attr( $desc ); ?>">
			</script>
			<input type="hidden" name="action" value="stripe"/>
			<input type="hidden" name="redirect" value="<?php echo get_permalink(); ?>"/>
			<input type="hidden" name="amount" value="<?php echo base64_encode($amount); ?>"/>
			<input type="hidden" name="stripe_nonce" value="<?php echo wp_create_nonce('stripe-nonce'); ?>"/>
		</form>
		<?php
	}
	return ob_get_clean();
}
add_shortcode( 'stripe_button', 'sktest_stripe_button_shortcode' );