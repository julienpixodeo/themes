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

// ajax edit client
function EditClient() {
    check_ajax_referer('edit_client_action', 'edit_client_nonce'); // Check nonce
    $pw = false;
    $user_id = get_current_user_id(); // Get the current user ID
    if (!$user_id) {
        wp_send_json(array('data' => 'Utilisateur non connecté'));
        return;
    }

    $email = sanitize_email($_POST['email']);
    $password = sanitize_text_field($_POST['password']);
    $password_confirm = sanitize_text_field($_POST['password_confirm']);
    $first_name = sanitize_text_field($_POST['first_name']);
    $last_name = sanitize_text_field($_POST['last_name']);

    // Update email if it's different
    if ($email !== wp_get_current_user()->user_email) {
        if (!email_exists($email)) {
            wp_update_user(array(
                'ID' => $user_id,
                'user_email' => $email,
            ));
        } else {
            wp_send_json(array('data' => 'L\'e-mail existe déjà'));
            return;
        }
    }

    // Update first name and last name
    wp_update_user(array(
        'ID' => $user_id,
        'first_name' => $first_name,
        'last_name' => $last_name,
    ));

    // Update password if it's provided and matches the confirmation
    if (!empty($password)) {
        if ($password === $password_confirm) {
            wp_set_password($password, $user_id);
            $pw = true;
        }
    }

    wp_send_json(array('data' => true,'pw' => $pw));
}
add_action('wp_ajax_EditClient', 'EditClient');
add_action('wp_ajax_nopriv_EditClient', 'EditClient');

// get user orders info
function get_user_orders_info() {
    $user_id = get_current_user_id();

    if ($user_id) {
        $args = array(
            'customer_id' => $user_id,
            'status'      => 'any',
            'limit'       => -1,
        );

        $orders = wc_get_orders($args);

        ob_start();

        if($orders){
            // Loop through each order
            foreach ($orders as $order) {
                $order_id = $order->get_id();
                $order_date = $order->get_date_created();
                $order_status = $order->get_status();
                $order_total = $order->get_total();
                $order_currency = $order->get_currency();
                $order_payment_method = $order->get_payment_method_title();

                echo '<div class="order-box" id="order-' . $order_id . '">';
                echo '<div class="order-header"><h4>Order ID: ' . $order_id . '</h4></div>';
                echo '<div class="order-details">';
                echo 'Order Date: ' . $order_date->date('Y-m-d H:i:s') . '<br>';
                echo 'Order Status: ' . ucfirst($order_status) . '<br>';
                echo 'Order Total: ' . wc_price($order_total) . '<br>';
                echo 'Payment Method: ' . $order_payment_method . '<br>';
                echo '</div>';

                $items = $order->get_items();

                echo '<div class="order-items">';
                echo '<h4>Order Items:</h4>';
                foreach ($items as $item) {
                    $product = $item->get_product();
                    $product_name = $item->get_name();
                    $product_quantity = $item->get_quantity();
                    $product_total_incl_tax = $item->get_total() + $item->get_total_tax();
                    $product_id = $product->get_id();
                    $product_sku = $product->get_sku();
                    $phn_type_product = get_post_meta($product_id,'phn_type_product',true);
                    $type = ($phn_type_product === 'event') ? 'Event' : 'Hotel';

                    $parent_id = wp_get_post_parent_id($product_id);
                    if($parent_id != 0){
                        $product_id = $parent_id;
                    }

                    $thumbnail_url = get_the_post_thumbnail_url( $product_id, 'full' );

                    if ( empty( $thumbnail_url ) ) {
                        $_product_image_gallery = get_post_meta($product_id,'_product_image_gallery',true);
                        if(!empty($_product_image_gallery)){
                            $_product_image_gallery = explode(",",$_product_image_gallery);
                            $thumbnail_url = wp_get_attachment_url( $_product_image_gallery[0] );
                        }else{
                            $thumbnail_url = get_permalink(28838);
                        }
                    }

                    echo '<div class="product-item">';
                    echo '<img width="300" height="300" src="'.$thumbnail_url.'" class="image-product">';
                    echo '<div class="product-item-content">';
                    echo '<span class="product-name">'.$type.' : ' . $product_name . '</span>';
                    echo '<div>Quantity: ' . $product_quantity . '</div>';
                    echo '<div class="wrap-price">Price: ' . wc_price($product_total_incl_tax) . '</div>';
                    echo '</div>';
                    echo '</div>';
                }
                echo '</div>'; // End of order items

                // Add refund button and message box for each order
                if ($order_status == 'completed') {
                    echo '<button class="refund-button" data-order-id="' . $order_id . '">Refund</button>';
                    echo '<div class="message-box" id="message-' . $order_id . '"></div>';
                }

                echo '</div>'; // End of order box
            }
            return ob_get_clean();
        }else{
            return 'Vous n\'avez pas encore de commandes.';
        }  
    } else {
        return 'Utilisateur non connecté.';
    }
}

// Register shortcode to display user orders
function register_user_orders_shortcode() {
    add_shortcode('user_orders', 'get_user_orders_info');
}
add_action('init', 'register_user_orders_shortcode');

// process ajax refund
function process_ajax_refund() {
    // Check if the current user is logged in and if the order ID is passed
    if (is_user_logged_in() && isset($_POST['order_id'])) {
        $order_id = intval($_POST['order_id']);
        $order = wc_get_order($order_id);

        // Ensure the order exists and belongs to the current user
        if ($order && $order->get_user_id() === get_current_user_id()) {
            // Refund reason (optional)
            $refund_reason = 'Refund requested by customer';

            // Get the total amount of the order
            $refund_amount = $order->get_total();

            // Create a refund
            $refund = wc_create_refund(array(
                'amount'     => $refund_amount,
                'reason'     => $refund_reason,
                'order_id'   => $order_id,
                'line_items' => array(), 
            ));

            if (is_wp_error($refund)) {
                wp_send_json_error($refund->get_error_message());
            } else {
                systempay_online_refund($order->get_id(), $refund->get_id());
                wp_send_json_success('Refund processed successfully'); 
            }
        } else {
            wp_send_json_error('Invalid order or permission denied');
        }
    } else {
        wp_send_json_error('User not logged in or missing order ID');
    }
}
add_action( 'wp_ajax_process_ajax_refund', 'process_ajax_refund' );
add_action( 'wp_ajax_nopriv_process_ajax_refund', 'process_ajax_refund' );
?>