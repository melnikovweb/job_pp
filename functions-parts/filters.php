<?php
add_action('wp_ajax_nopriv_filters', 'filters_ajax');
add_action('wp_ajax_filters', 'filters_ajax');

function filters_ajax()
{
  check_ajax_referer('SECRET-filter-nonce', 'nonce');
  $data = isset($_POST['data']) ? json_decode(wp_unslash($_POST['data']), true) : [];
  $type = isset($_POST['type']) ? sanitize_text_field($_POST['type']) : '';

  //TODO implement the functionality of getting HTML
  // logic, here we will need to collect the elements and connect, depending on the “type”, the template part we need, which will return HTML

  wp_die($output);
}
