<?php 

class Stevestripe { 
               
      public function return_credit_cards() {
               
               try{
				   		$this->sktest_setapikey();
				   		
				   		
				   		$stripe_id = get_user_meta(get_current_user_id(), 'stripe_customer_id', true);
				   		$customerret = Stripe_Customer::retrieve($stripe_id);
				}
				catch ( Stripe_Error $e ) {
				
				$body = $e->getJsonBody();
				$err  = $body['error'];
				
				print $error[‘message’];
				
				}
				
				$idtest = $customerret->id;
				echo $idtest;
				
				
			}
				
				
				
				
		public function sktest_setapikey() {
				
				global $stripe_options;

				// load the stripe libraries
				if ( !class_exists( 'Stripe' ) ) 
					require_once STRIPE_BASE_DIR . '/lib/Stripe.php';
			
				if ( isset( $stripe_options['test_mode'] ) && $stripe_options['test_mode'] ) {
					$secret_key = trim( $stripe_options['test_secret_key'] );
				} else {
					$secret_key = trim( $stripe_options['live_secret_key'] );
					}

				Stripe::setApiKey( $secret_key );
			
			
			
		}
}
				

?>