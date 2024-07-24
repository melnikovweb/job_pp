<?php
function action_vacancy()
{
  register_post_type('vacancy', [
    'label' => __('Vacancy', 'SECRET-domain-admin'),
    'description' => __('Vacancy', 'SECRET-domain-admin'),
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
    'supports' => ['title', 'editor'],
    'has_archive' => false,
    'rewrite' => ['slug' => 'vacancy'],
    'can_export' => true
  ]);
}
add_action('init', 'action_vacancy', 15);
