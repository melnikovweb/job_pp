<?php
function action_news()
{
  register_post_type('news', [
    'label' => __('News', 'SECRET-domain-admin'),
    'description' => __('News', 'SECRET-domain-admin'),
    'supports' => ['title', 'editor', 'thumbnail', 'excerpt'],
    'hierarchical' => true,
    'public' => true,
    'show_ui' => true,
    'show_in_menu' => true,
    'menu_position' => 4,
    'menu_icon' => 'dashicons-book',
    'show_in_admin_bar' => true,
    'show_in_nav_menus' => true,
    'show_in_rest' => true,
    'can_export' => true,
    'has_archive' => true,
    'exclude_from_search' => false,
    'publicly_queryable' => true,
    'rewrite' => ['slug' => 'news'],
    'capability_type' => 'post'
  ]);
}
add_action('init', 'action_news', 1);
