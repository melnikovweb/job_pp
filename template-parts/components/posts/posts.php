<?php

declare(strict_types=1);

namespace SECRET\Parts;

use SECRET\Includes\Element;

function SECRET_get_posts_tab(
  string $tab_name,
  string $post_type,
  string|array $taxonomies,
  int $current_post_id,
  int $limit = 5
): array {
  $result = [];

  $terms_ids = \wp_get_post_terms($current_post_id, $taxonomies, ['fields' => 'ids']);

  $query_args = [
    'post_status' => 'publish',
    'post_type' => $post_type,
    'posts_per_page' => $limit,
    'category__in' => $terms_ids,
    'post__not_in' => [$current_post_id]
  ];

  $query = new \WP_Query($query_args);
  if ($query->have_posts()) {
    $result['title'] = $tab_name;

    while ($query->have_posts()) {
      $query->the_post();

      $terms_list = [];
      $terms = \wp_get_post_terms(get_the_ID(), $taxonomies, ['fields' => 'all']);
      if ($terms) {
        foreach ($terms as $term) {
          $terms_list[] = [
            'title' => $term->name,
            'url' => trailingslashit(get_category_link($term->term_id))
          ];
        }
      }

      $result['posts'][] = [
        'title' => get_the_title(),
        'thumbnail' => get_the_post_thumbnail(),
        'categories' => $terms_list,
        'read_time' => SECRET_read_time(),
        'post_link' => get_permalink()
      ];

      wp_reset_postdata();
    }
  }

  return $result;
}

$args['title'] = $args['title'] ?? __('Resources', 'SECRET-domain');
$tabs = $args['tabs'] ?? [];
$limit = $args['limit'] ?? 5;

if (!$tabs) {
  $current_post_id = get_the_ID();
  $categories = get_the_category($current_post_id);

  $args['tabs']['blog_posts'] = SECRET_get_posts_tab('Blog', 'post', 'category', $current_post_id);
  $args['tabs']['news_posts'] = SECRET_get_posts_tab('News', 'news', 'news-category', $current_post_id);
}

new Element(__FILE__, $args);
