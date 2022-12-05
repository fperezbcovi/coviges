<?php
// Subscription form ([subscription_form])
class Naxos_Shortcode_Subscription_Form {
    
    public static function subscriptionForm( $atts, $content = null ) {
		return '<form id="subscribe-form" action="' . esc_url( plugins_url( 'inc/ajax.php', dirname(__FILE__) ) ) . '" method="post">
					<div class="form-group">
						<input type="email" name="email" class="form-control field-subscribe" placeholder="' . esc_attr__( 'Enter Your Email Address', 'naxos' ) . '" required />
					</div>
					<p class="mb-0"><button type="submit" class="btn btn-block">' . esc_html__( 'Subscribe', 'naxos' ) . '</button></p>
				</form>
				<h3 id="subscribe-result" class="text-center text-white">' . do_shortcode( $content ) . '</h3>';
	}
	
	public static function vc_subscriptionForm() {
		vc_map( array(
		   	"name" => esc_html__("Subscription Form", "naxos-addons"),
		   	"base" => "subscription_form",
            "icon" => 'ti-id-badge',
            "description" => esc_html__( "Newsletter", "naxos-addons" ),
		   	"category" => esc_html__("Naxos", "naxos-addons"),
		   	"params" => array(
				array(
					"type"        => "textarea_html",
					"heading"     => esc_html__( "Form Result Text", "naxos-addons" ),
					"param_name"  => "content",
					"value"       => "Thanks for subscribing!",
					"description" => "",
					"admin_label" => true,
			  	),
			)
		));
	}
    
}

add_shortcode( 'subscription_form', array( 'Naxos_Shortcode_Subscription_Form', 'subscriptionForm' ) );
add_action( 'vc_before_init', 		array( 'Naxos_Shortcode_Subscription_Form', 'vc_subscriptionForm' ) );
