<?php

declare(strict_types=1);

namespace SECRET\Parts;

use SECRET\Includes\Element;

$breadcrumbs_root_data = [
  'url' => get_post_type_archive_link('faq-merchant'),
  'title' => __('FAQ', 'SECRET')
];

$terms = get_the_terms(get_the_ID(), 'faq-merchant-category');
if (!empty($terms) && !is_wp_error($terms)) {
  $first_term = reset($terms);
  $breadcrumbs_root_data = [
    'url' => get_term_link($first_term),
    'title' => $first_term->name
  ];
}

$args['links'] = [
  $breadcrumbs_root_data,
  [
    'url' => '',
    'title' => get_the_title()
  ]
];

new Element(__FILE__, $args);
