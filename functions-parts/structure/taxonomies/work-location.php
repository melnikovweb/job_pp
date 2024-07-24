<?php
function action_work_location()
{
  register_taxonomy(
    'work-location',
    ['vacancy'],
    [
      'label' => __('Work location', 'SECRET-domain-admin'),
      'description' => __('Work location', 'SECRET-domain-admin'),
      'public' => true,
      'show_ui' => true,
      'show_tagcloud' => false,
      'hierarchical' => true,
      'rewrite' => false,
      'publicly_queryable' => false,
      'show_admin_column' => true,
      'show_in_rest' => true
    ]
  );
}
add_action('init', 'action_work_location', 2);
