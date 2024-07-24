<?php

use SECRET\Includes\Utilities;

add_action('wp_ajax_nopriv_search', 'search_ajax');
add_action('wp_ajax_search', 'search_ajax');

function search_ajax()
{
  Utilities::verify_nonce($_POST['nonce']);

  $results = false;
  $sanitized_s = isset($_POST['s']) ? sanitize_text_field($_POST['s']) : '';
  $post_type = isset($_POST['post_type']) ? sanitize_text_field($_POST['post_type']) : '';

  if ($sanitized_s) {
    global $wpdb;

    $search_query = $wpdb->prepare(
      "SELECT ID, post_title 
      FROM {$wpdb->posts} 
      WHERE post_type = %s 
      AND post_status = 'publish' 
      AND post_title LIKE %s
      ORDER BY post_title ASC",
      $post_type,
      '%' . $wpdb->esc_like($sanitized_s) . '%'
    );

    $results = $wpdb->get_results($search_query);
  }

  $options = [];

  if ($results) {
    foreach ($results as $post) {
      $options[] = [
        'url' => get_permalink($post->ID),
        'title' => $post->post_title
      ];
    }
  } else {
    $options[] = [
      'url' => null,
      'title' => __('Not found', 'SECRET-domain')
    ];
  }

  wp_die(json_encode($options));
}
