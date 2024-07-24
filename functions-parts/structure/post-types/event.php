<?php
function action_event()
{
  register_post_type('event', [
    'label' => __('Events', 'SECRET-domain-admin'),
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
    'menu_icon' => 'dashicons-calendar-alt',
    'capability_type' => 'post',
    'hierarchical' => true,
    'supports' => ['title', 'editor', 'custom-fields', 'revisions', 'thumbnail'],
    'has_archive' => true,
    'rewrite' => ['slug' => 'events'],
    'can_export' => true
  ]);
}
add_action('init', 'action_event', 1);
