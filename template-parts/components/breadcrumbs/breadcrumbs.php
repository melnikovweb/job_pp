<?php

declare(strict_types=1);

namespace SECRET\Parts;

use SECRET\Includes\Element;

$args = is_array($args) ? $args : [];

$post_type = $post->post_type;

$defaults['links'] = [
  [
    'url' => get_post_type_archive_link($post_type),
    'title' => is_singular('post') ? __('Blog', 'SECRET-domain') : get_post_type_object($post_type)->label
  ],
  [
    'url' => '',
    'title' => get_the_title()
  ]
];

$args = array_merge($defaults, $args);

new Element(__FILE__, $args);
