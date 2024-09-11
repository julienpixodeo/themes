<?php
// ajax login
function ajax_login(){
    check_ajax_referer( 'ajax-login-nonce', 'security' );
    $info = array();
    $info['user_login'] = $_POST['username'];
    $info['user_password'] = $_POST['password'];
    $info['remember'] = true;
    $user_signon = wp_signon( $info, true );

    if ( is_wp_error($user_signon) ){
        $data = false;
    } else {
        $data = true;
    }

    $return = array(
        'data' => $data
    );

    wp_send_json($return);
}
add_action( 'wp_ajax_ajaxlogin', 'ajax_login' );
add_action( 'wp_ajax_nopriv_ajaxlogin', 'ajax_login' );

// ajax regiter
function RegisterClient(){
    $email = sanitize_email($_POST['email']);
    $password = sanitize_text_field($_POST['password']);
    $password_confirm = sanitize_text_field($_POST['password_confirm']);
    $first_name = sanitize_text_field($_POST['first_name']);
    $last_name = sanitize_text_field($_POST['last_name']);

	if(!email_exists($email)){
		$userdata = array(
            'user_login' => $email,
            'user_email' => $email,
            'user_pass'  => $password,
            'first_name' => $first_name,
            'last_name'  => $last_name,
            'role'       => 'subscriber'
		);

		$user_id = wp_insert_user( $userdata );
		 
		if ( ! is_wp_error( $user_id ) ) 
		{
		    $login_data = array();  
		    $login_data['user_login'] = $email;  
		    $login_data['user_password'] = $password;  
		    $login_data['remember'] = true;  
		    $user_verify = wp_signon( $login_data, false ); 
		    $data = true;
		}else{
            $data = 'Impossible de créer un compte';
        }
	}else{
        $data = 'L\'e-mail existe';
    }

	$return = array(
	    'data' => $data
	);	 

	wp_send_json($return);
}
add_action('wp_ajax_RegisterClient', 'RegisterClient');
add_action('wp_ajax_nopriv_RegisterClient', 'RegisterClient');
?>