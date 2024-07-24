<?php
function action_type_work()
{
  register_taxonomy(
    'type-work',
    ['vacancy'],
    [
      'label' => __('Type of work', 'SECRET-domain-admin'),
      'description' => __('Type of work', 'SECRET-domain-admin'),
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
add_action('init', 'action_type_work', 2);
