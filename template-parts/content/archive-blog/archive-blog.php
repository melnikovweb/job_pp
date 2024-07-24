<?php

declare(strict_types=1);

namespace SECRET\Parts;

use SECRET\Includes\AcfElement;

$current_url = trailingslashit(home_url(add_query_arg([], $wp->request)));
$categories_items = [];
$categories = get_categories(['hide_empty' => true]);

if ($categories) {
  foreach ($categories as $category) {
    $category_link = trailingslashit(get_category_link($category->term_id));
    $categories_items[] = [
      'is_active' => $category_link == $current_url,
      'title' => $category->name,
      'url' => $category_link
    ];
  }
}

$total_posts = wp_count_posts('post')->publish;

$accent_post = [
  'title' => get_the_title(),
  'url' => get_permalink(),
  'thumbnail' => get_the_post_thumbnail(get_the_ID(), [860, 513]),
  'excerpt' => get_the_excerpt()
];

$args = [
  'title' => get_the_archive_title(),
  'text' => get_field('archive_page_text', 'options'),
  'total_posts' => $total_posts,
  'categories' => $categories_items,
  'accent_post' => $accent_post
];

$element = new AcfElement(__FILE__, $args);

$element->add_scripts_localize([
  'taxQuery' => is_category() ? ['category' => get_queried_object()->slug] : null
]);
