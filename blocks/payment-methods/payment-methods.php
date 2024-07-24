<?php

declare(strict_types=1);

namespace SECRET\Blocks;

use SECRET\Includes\AcfElement;

if (isset($block['data']['preview_image_help'])) {
  echo '<img src="' .
    get_template_directory_uri() .
    $block['data']['preview_image_help'] .
    '" style="width:100%; height:auto;">';
} else {
  $payment_methods_data = get_posts([
    'post_type' => 'payment-methods'
  ]);

  $payment_methods_posts = [];

  foreach ($payment_methods_data as $step => $payment_method) {
    $payment_method_id = $payment_method->ID;

    $payment_methods_posts[$step] = [
      'post_id' => $payment_method_id,
      'post_title' => $payment_method->post_title,
      'url' => get_permalink($payment_method_id),
      'excerpt' => $payment_method->post_excerpt
    ];

    $taxonomies = get_object_taxonomies($payment_method);
    foreach ($taxonomies as $taxonomy) {
      $terms = get_the_terms($payment_method_id, $taxonomy);

      if (!empty($terms)) {
        foreach ($terms as $term) {
          $payment_methods_posts[$step]['taxonomies'][$taxonomy] = $term->name;
        }
      }
    }
  }

  $args['posts'] = $payment_methods_posts;

  $args['filters'] = [];

  $filter_taxonomies = [
    [
      'name' => __('Country', 'SECRET-domain'),
      'value' => 'payment-method-country'
    ],
    [
      'name' => __('Type', 'SECRET-domain'),
      'value' => 'payment-method-type'
    ]
  ];

  if ($filter_taxonomies) {
    foreach ($filter_taxonomies as $filter_taxonomy) {
      $taxonomy = $filter_taxonomy['value'];
      $terms = get_terms([
        'taxonomy' => $taxonomy,
        'hide_empty' => true
      ]);

      $args['filters'][$taxonomy] = [
        'title' => $filter_taxonomy['name'],
        'taxonomy' => $taxonomy
      ];

      foreach ($terms as $term) {
        $args['filters'][$taxonomy]['terms'][] = [
          'term_id' => $term->term_id,
          'name' => $term->name
        ];
      }
    }
  }

  $payment_methods = new AcfElement(__FILE__, $args);
}
