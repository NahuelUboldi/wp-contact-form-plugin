<?php
  add_shortcode( 'contact', 'show_contact_form' );
  add_action( 'rest_api_init', 'create_rest_endpoint' );

  function show_contact_form() {
    include MY_PLUGIN_PATH . 'includes/templates/contact-form.php';
  }

  function create_rest_endpoint() {
    register_rest_route( 'v1/contact-form','submit', array(
      'methods' => 'POST',
      'callback' => 'handle_enquiry'
    ));
  }

  function handle_enquiry($data) {
    $params = $data -> get_params();

    if(!wp_verify_nonce($params['_wpnonce'],'wp_rest')) {
      return new WP_REST_Response('Message not sent', 422);
    }
    
    unset($params['_wpnonce']); // delete this data from the $params
    unset($params['_wp_http_referer']); // delete this data from the $params

    // send the email message
    $headers = [];

    $adminEmail = get_bloginfo( 'admin_email');
    $adminName = get_bloginfo( 'name');


    $headers[] = "From: {$adminName} <{$adminEmail}>";
    $headers[] = "Reply-to: {$params['name']} <{$params['email']}>";
    $headers[] = "Content-type: text/html";


    $subject = "New enquiry from {$params['name']}";

    $message = "";
    $message .= "Message has been sent from {$params['name']}";

    foreach($params as $label => $value) {
      $message .= ucfirst($label) . ':' . $value;
    }

    wp_mail($adminEmail, $subject, $headers);

    return new WP_REST_Response('Message sent', 200);

  }