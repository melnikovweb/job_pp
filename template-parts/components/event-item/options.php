<?php

declare(strict_types=1);

namespace SECRET\Parts;

$args = is_array($args) ? $args : [];

$categories = wp_get_object_terms(get_the_ID(), 'event-type', ['fields' => 'all']);
$date = get_post_meta(get_the_ID(), 'end_date') ?? [];
$formattedDate = $date ? date('d F Y', strtotime($date[0])) : '';

$defaults = [
  'categories' => $categories,
  'date' => $formattedDate,
  'permalink' => get_permalink(),
  'thumbnail' => get_the_post_thumbnail(),
  'title' => get_the_title()
];

$args = array_merge($defaults, $args);
