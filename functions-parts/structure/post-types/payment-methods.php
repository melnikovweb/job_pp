<?php
function action_payment_methods()
{
  register_post_type('payment-methods', [
    'label' => __('Payment Methods', 'SECRET-domain-admin'),
    'description' => __('Payment Methods', 'SECRET-domain-admin'),
    'public' => true,
    'publicly_queryable' => true,
    'exclude_from_search' => true,
    'show_ui' => true,
    'show_in_menu' => true,
    'show_in_rest' => true,
    'show_in_admin_bar' => true,
    'show_in_nav_menus' => false,
    'menu_position' => 6,
    'menu_icon' => 'dashicons-admin-users',
    'capability_type' => 'post',
    'hierarchical' => true,
    'supports' => ['title', 'editor', 'thumbnail', 'excerpt'],
    'has_archive' => false,
    'rewrite' => ['slug' => 'payment-methods'],
    'can_export' => true
  ]);
}
add_action('init', 'action_payment_methods', 15);
