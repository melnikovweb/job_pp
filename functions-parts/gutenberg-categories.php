<?php
add_filter('block_categories_all', function ($categories) {
  $categories[] = [
    'slug' => 'SECRET-category',
    'title' => 'SECRET blocks'
  ];

  return $categories;
});
