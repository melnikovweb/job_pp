<?php
function action_event_type()
{
  register_taxonomy(
    'event-type',
    ['event'],
    [
      'label' => __('Event Type', 'SECRET-domain-admin'),
      'labels' => [
        'name' => __('Event Types', 'SECRET-domain-admin'),
        'singular_name' => __('Event Type', 'SECRET-domain-admin')
      ],
      'public' => true,
      'publicly_queryable' => null,
      'show_in_nav_menus' => true,
      'show_ui' => true,
      'show_in_menu' => true,
      'show_in_rest' => true,
      'show_tagcloud' => true,
      'show_in_quick_edit' => true,
      'show_in_admin_bar' => true,
      'hierarchical' => true,
      'show_admin_column' => true,
      'rewrite' => ['slug' => 'event-type', 'with_front' => false]
    ]
  );
}
add_action('init', 'action_event_type');
