<?php

declare(strict_types=1);

namespace SECRET\Parts;

use SECRET\Includes\Element;

$queried_object = get_queried_object();
$current_term_name = isset($queried_object->term_id)
  ? get_term($queried_object->term_id)->name
  : __('Answering your Merchant FAQs', 'SECRET-domain');

$args['current_url'] =
  (!empty($_SERVER['HTTPS']) ? 'https' : 'http') . '://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];

if (is_singular('faq-merchant')) {
  $args['links'] = [
    [
      'url' => get_post_type_archive_link('faq-merchant'),
      'title' => __('FAQ', 'SECRET')
    ],
    [
      'url' => '',
      'title' => $current_term_name
    ]
  ];
}

$args['title'] = $current_term_name;

$categories = get_terms([
  'taxonomy' => 'faq-merchant-category',
  'hide_empty' => true
]);

$args['table_of_contents'][]['link'] = [
  'title' => __('All', 'SECRET-domain'),
  'url' => get_post_type_archive_link('faq-merchant'),
  'target' => ''
];

if ($categories) {
  foreach ($categories as $category) {
    $args['table_of_contents'][]['link'] = [
      'title' => $category->name,
      'url' => get_term_link($category),
      'target' => ''
    ];
  }
}

new Element(__FILE__, $args);
