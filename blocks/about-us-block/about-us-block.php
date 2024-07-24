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
  $people_data = get_posts([
    'post_type' => 'people',
    'posts_per_page' => -1
  ]);

  $people_posts = [];

  foreach ($people_data as $people_step => $person) {
    $person_id = $person->ID;

    $people_posts[$people_step] = [
      'post_title' => $person->post_title,
      'url' => get_permalink($person_id),
      'linkedin_url' => get_field('linkedin_url', $person_id),
      'image_id' => get_post_thumbnail_id($person_id),
      'description' => wp_strip_all_tags(get_the_content(null, false, $person_id))
    ];
  }

  $args['people'] = $people_posts;

  $people = new AcfElement(__FILE__, $args);
}
