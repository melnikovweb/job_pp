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
  $vacancy_data = get_posts([
    'post_type' => 'vacancy',
    'posts_per_page' => -1
  ]);

  $vacancy_posts = [];

  foreach ($vacancy_data as $vacancy_step => $vacancy) {
    $vacancy_id = $vacancy->ID;

    $vacancy_posts[$vacancy_step] = [
      'post_title' => $vacancy->post_title,
      'url' => get_permalink($vacancy_id)
    ];

    $taxonomies = get_object_taxonomies($vacancy);
    foreach ($taxonomies as $taxonomy) {
      $terms = get_the_terms($vacancy_id, $taxonomy);

      if (!empty($terms)) {
        foreach ($terms as $term) {
          $vacancy_posts[$vacancy_step][$taxonomy] = $term->name;
        }
      }
    }
  }

  $args['posts'] = $vacancy_posts;

  $args['filters'] = [];
  $filter_taxonomies = get_field('filters');

  if ($filter_taxonomies) {
    foreach ($filter_taxonomies as $filter_taxonomy) {
      $taxonomy = $filter_taxonomy['vacancy_taxonomis_select'];
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

  $vacancy = new AcfElement(__FILE__, $args);

  $vacancy->add_scripts_localize([
    'ajaxUrl' => admin_url('admin-ajax.php'),
    'nonce' => wp_create_nonce('SECRET-filter-nonce')
  ]);
}
