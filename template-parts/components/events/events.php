<?php

declare(strict_types=1);

namespace SECRET\Parts;

use SECRET\Includes\AcfElement;

$event_type = $args['events_type'];
$today = date('Ymd');
$event_type_filter = [];

if ($event_type === 'future') {
  $args_events_posts = [
    'post_type' => 'event',
    'order' => 'DESC',
    'orderby' => 'date',
    'posts_per_page' => -1,
    'meta_query' => [
      [
        'key' => 'end_date',
        'value' => $today,
        'compare' => '>=',
        'type' => 'DATE'
      ]
    ]
  ];
} elseif ($event_type === 'past') {
  $args_events_posts = [
    'post_type' => 'event',
    'posts_per_page' => -1,
    'meta_query' => [
      [
        'key' => 'end_date',
        'value' => $today,
        'compare' => '<',
        'type' => 'DATE'
      ]
    ]
  ];

  $event_type_filter = get_terms([
    'taxonomy' => 'event-type',
    'hide_empty' => true
  ]);
}

$terms = new \WP_Query($args_events_posts);

$total_posts = $terms->found_posts;

$latest_date = date('Y');

$posts = [];
if ($terms->have_posts()) {
  while ($terms->have_posts()) {
    if (get_field('end_date')) {
      $latest_date =
        $latest_date > substr(get_field('end_date'), -4) ? substr(get_field('end_date'), -4) : $latest_date;
    }

    $terms->the_post();
    $posts[] = [
      'ID' => $post->ID,
      'title' => get_the_title(),
      'permalink' => get_permalink(),
      'date' => get_field('end_date'),
      'categories' => get_the_terms($post->ID, 'event-type')
    ];
  }
  $posts = array_slice($posts, 0, 4);
}

wp_reset_postdata();

$part = new AcfElement(__FILE__, [
  'posts' => $posts,
  'total_posts' => $total_posts,
  'event_type' => $event_type,
  'latest_date' => $latest_date,
  'event_type_filter' => $event_type_filter
]);
