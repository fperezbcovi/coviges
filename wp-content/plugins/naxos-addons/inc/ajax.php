<?php
define( 'WP_THEME', dirname( dirname( __FILE__ ) ) );
define( 'WP_ROOT', dirname( dirname( dirname( dirname( dirname(__FILE__ ) ) ) ) ) );

include_once WP_ROOT . '/wp-load.php';
include_once WP_ROOT . '/wp-includes/wp-db.php';

$action = $_REQUEST['action'];
$response = array( );

// Subscribe form
if ( $action == 'subscribe' ) {
	check_ajax_referer( 'naxos-nonce', 'security' );
	
	$email = trim( $_POST['email'] );
	
	if ( empty( $email ) or ! filter_var( $email, FILTER_VALIDATE_EMAIL ) ) {
		$response = array( 'status' => 'error', 'error' => 'email' );
	} else if ( ! empty( $naxos_config['mailchimp-api-key'] ) && ! empty( $naxos_config['mailchimp-list-id'] ) ) {
		// MailChimp API Key findable in your Mailchimp's dashboard
		$API_KEY =  $naxos_config['mailchimp-api-key'];

		// MailChimp List ID  findable in your Mailchimp's dashboard
		$LIST_ID =  $naxos_config['mailchimp-list-id'];
		
		// MailChimp class
		require( NAXOS_PLUGIN_DIR . 'inc/mailchimp.php' );
		
		$MailChimp = new \DrewM\MailChimp\MailChimp($API_KEY);
				
		$result = $MailChimp->post('lists/'.$LIST_ID.'/members', array(
					'email_address'  => $email,
					'status'         => 'subscribed'
				  ));

		// Success sending
		if ($MailChimp->success()) {
			$response = array(
				'status' => 'success' 
			);
		// Error sending
		} else {
			$response = array(
				'status' => 'error',
				'type' => $MailChimp->getLastError()
			);
		}
	}
	
	echo json_encode( $response );
}

// No action
else {
	echo json_encode( array( 'status' => 'error', 'error' => 'action' ) );
}