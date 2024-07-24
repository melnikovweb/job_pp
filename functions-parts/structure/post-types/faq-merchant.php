<?php
function action_faq_merchant()
{
  register_post_type('faq-merchant', [
    'labels' => [
      'name' => __('FAQ for merchant', 'SECRET-domain-admin'),
      'singular_name' => __('FAQ for merchant', 'SECRET-domain-admin'),
      'menu_name' => __('FAQ for merchant', 'SECRET-domain-admin')
    ],
    'description' => __('Frequently Asked Questions', 'SECRET-domain-admin'),
    'public' => true,
    'publicly_queryable' => true,
    'exclude_from_search' => false,
    'show_ui' => true,
    'show_in_menu' => true,
    'show_in_admin_bar' => true,
    'show_in_nav_menus' => false,
    'show_in_rest' => true,
    'menu_position' => 5,
    'menu_icon' => 'dashicons-info',
    'capability_type' => 'post',
    'hierarchical' => false,
    'supports' => ['title', 'editor'],
    'has_archive' => true,
    'rewrite' => ['slug' => 'faq'],
    'can_export' => true
  ]);
}
add_action('init', 'action_faq_merchant', 1);
