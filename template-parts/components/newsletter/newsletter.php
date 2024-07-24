<?php

declare(strict_types=1);

namespace SECRET\Parts;

use SECRET\Includes\Element;

$args = [
  'title' => get_field('newsletter_title', 'options'),
  'description' => get_field('newsletter_description', 'options'),
  'text' => get_field('newsletter_text', 'options')
];

new Element(__FILE__, $args);
