<?php

declare(strict_types=1);

namespace SECRET\Parts;

$args = is_array($args) ? $args : [];

$categories_items = [];
$categories = get_the_terms(get_the_ID(), 'news-category');
if ($categories) {
  foreach ($categories as $category) {
    $categories_items[] = [
      'title' => $category->name,
      'url' => trailingslashit(get_category_link($category->term_id))
    ];
  }
}

$defaults = [
  'categories' => $categories_items,
  'read_time' => SECRET_read_time(),
  'post_link' => get_permalink(),
  'thumbnail' => get_the_post_thumbnail(),
  'title' => get_the_title()
];

$args = array_merge($defaults, $args);
