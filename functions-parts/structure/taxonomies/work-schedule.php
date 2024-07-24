<?php
function action_work_schedule()
{
  register_taxonomy(
    'work-schedule',
    ['vacancy'],
    [
      'label' => __('Work Schedule', 'SECRET-domain-admin'),
      'description' => __('Work Schedule', 'SECRET-domain-admin'),
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
add_action('init', 'action_work_schedule', 2);
