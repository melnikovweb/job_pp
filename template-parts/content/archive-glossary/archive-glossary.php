<?php

declare(strict_types=1);

namespace SECRET\Parts;

use SECRET\Includes\Element;

$items = [];

$alphabet_args = [
  'taxonomy' => 'alphabet',
  'hide_empty' => true
];

if (is_tax('alphabet')) {
  $current_tax = get_queried_object();
  if ($current_tax instanceof \WP_Term) {
    $alphabet_args['include'] = $current_tax->term_id;
  }
}

$alphabet = get_terms($alphabet_args);

if ($alphabet) {
  foreach ($alphabet as $letter) {
    $terms = new \WP_Query([
      'post_type' => 'glossary',
      'posts_per_page' => -1,
      'tax_query' => [
        [
          'taxonomy' => 'alphabet',
          'field' => 'slug',
          'include_children' => false,
          'terms' => $letter->slug
        ]
      ],
      'orderby' => 'title',
      'order' => 'ASC'
    ]);

    $posts = [];
    if ($terms->have_posts()) {
      while ($terms->have_posts()) {
        $terms->the_post();
        $posts[] = [
          'title' => get_the_title(),
          'permalink' => get_permalink()
        ];
      }
    }

    $items[] = [
      'letter_name' => $letter->name,
      'posts' => $posts
    ];
  }
  wp_reset_postdata();
}

$element = new Element(__FILE__, ['items' => $items]);
