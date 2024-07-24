<?php

declare(strict_types=1);

namespace SECRET\Parts;

use SECRET\Includes\AcfElement;

$args['title'] = get_the_title();
$args['terms_name'] = [];

$taxonomies = get_object_taxonomies('vacancy');
foreach ($taxonomies as $taxonomy) {
  $terms = get_the_terms(get_the_ID(), $taxonomy);
  if ($terms && !is_wp_error($terms)) {
    foreach ($terms as $term) {
      $args['terms_name'][$taxonomy] = $term->name;
    }
  }
}

$args['development'] = $args['terms_name']['type-work'] ?? '';
$args['type'] = $args['terms_name']['work-location'] ?? '';
$args['contact_form_shortcode'] = get_field('contact_form_shortcode', 'options');

new AcfElement(__FILE__, $args);
