<?php

use SECRET\Includes\Utilities;

add_action('wp_ajax_filter_events_by_type', 'filter_events_by_type');
add_action('wp_ajax_nopriv_filter_events_by_type', 'filter_events_by_type');

function load_template_part($template_name, $part_name = null, $post)
{
  ob_start();
  get_template_part($template_name, $part_name, $post);
  $content = ob_get_contents();
  ob_end_clean();
  return $content;
}

function filter_events_by_type()
{
  Utilities::verify_nonce($_POST['nonce']);

  $event_type =
    isset($_POST['event_type']) && !empty($_POST['event_type'])
    ? array_map('sanitize_text_field', explode(',', $_POST['event_type']))
    : [];
  $year =
    isset($_POST['year']) && !empty($_POST['year'])
    ? array_map('sanitize_text_field', explode(',', $_POST['year']))
    : [];
  $today = date('Ymd');

  $tax_query = [];

  if (!empty($event_type)) {
    $tax_query['relation'] = 'OR';

    foreach ($event_type as $type) {
      $tax_query[] = [
        'taxonomy' => 'event-type',
        'field' => 'slug',
        'terms' => $type
      ];
    }
  }

  $args = [
    'post_type' => 'event',
    'posts_per_page' => 8,
    'meta_query' => [
      [
        'key' => 'end_date',
        'value' => $today,
        'compare' => '<',
        'type' => 'DATE'
      ]
    ],
    'tax_query' => $tax_query
  ];

  $events = get_posts($args);

  if (!empty($events)) {
    $response = [];
    foreach ($events as $event) {
      $id = $event->ID;
      $end_date = get_field('end_date', $id);
      $end_date_year = date_create_from_format('d F Y', $end_date)->format('Y');

      if (in_array($end_date_year, $year) || empty($year)) {
        $post = load_template_part('template-parts/components/event-item/load-items', null, [
          'ID' => $id,
          'permalink' => get_permalink($id),
          'date' => $end_date,
          'title' => $event->post_title,
          'categories' => get_the_terms($id, 'event-type')
        ]);

        $response[] = [
          'post' => $post
        ];
      }
    }
    wp_send_json_success($response);
  } else {
    wp_send_json_error('No events found');
  }
}
