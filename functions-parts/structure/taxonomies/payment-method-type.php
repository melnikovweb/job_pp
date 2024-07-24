<?php
function action_payment_method_type()
{
  register_taxonomy(
    'payment-method-type',
    ['payment-methods'],
    [
      'label' => __('Payment method type', 'SECRET-domain-admin'),
      'description' => __('Payment method type', 'SECRET-domain-admin'),
      'public' => true,
      'publicly_queryable' => null,
      'show_in_nav_menus' => true,
      'show_ui' => true,
      'show_in_menu' => true,
      'show_tagcloud' => true,
      'show_in_quick_edit' => null,
      'hierarchical' => true,
      'show_admin_column' => true,
      'show_in_rest' => true
    ]
  );
}
add_action('init', 'action_payment_method_type', 2);
