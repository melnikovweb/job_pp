<?php
function action_news_category()
{
  register_taxonomy(
    'news-category',
    ['news'],
    [
      'label' => __('Categories', 'SECRET-domain-admin'),
      'description' => __('Categories', 'SECRET-domain-admin'),
      'public' => true,
      'publicly_queryable' => null,
      'show_in_nav_menus' => true,
      'show_ui' => true,
      'show_in_menu' => true,
      'show_tagcloud' => true,
      'show_in_quick_edit' => null,
      'hierarchical' => true,
      'rewrite' => ['slug' => 'news-category'],
      'show_admin_column' => true,
      'show_in_rest' => true
    ]
  );
}
add_action('init', 'action_news_category', 2);
