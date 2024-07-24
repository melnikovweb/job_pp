<?php
function action_payment_method_country()
{
  register_taxonomy(
    'payment-method-country',
    ['payment-methods'],
    [
      'label' => __('Payment method country', 'SECRET-domain-admin'),
      'description' => __('Payment method country', 'SECRET-domain-admin'),
      'public' => true,
      'publicly_queryable' => true,
      'show_in_nav_menus' => true,
      'show_ui' => true,
      'show_in_menu' => true,
      'show_tagcloud' => true,
      'show_in_quick_edit' => true,
      'hierarchical' => true,
      'show_admin_column' => true,
      'show_in_rest' => true
    ]
  );
}
add_action('init', 'action_payment_method_country', 2);
