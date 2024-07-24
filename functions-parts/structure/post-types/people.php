<?php
function action_people()
{
  register_post_type('people', [
    'label' => __('People', 'SECRET-domain-admin'),
    'description' => __('Event', 'SECRET-domain-admin'),
    'public' => true,
    'publicly_queryable' => true,
    'exclude_from_search' => false,
    'show_ui' => true,
    'show_in_menu' => true,
    'show_in_rest' => true,
    'show_in_admin_bar' => true,
    'show_in_nav_menus' => false,
    'menu_position' => 5,
    'menu_icon' => 'dashicons-admin-users',
    'capability_type' => 'post',
    'hierarchical' => true,
    'supports' => ['title', 'editor', 'custom-fields', 'revisions', 'thumbnail'],
    'has_archive' => true,
    'rewrite' => ['slug' => 'event', 'with_front' => false],
    'can_export' => true
  ]);
}
add_action('init', 'action_people', 1);
