<?php

declare(strict_types=1);

namespace SECRET\Parts;

use SECRET\Includes\Element;

$args = [
  'title_404' => get_field('title_404', 'options'),
  'button_name_404' => get_field('button_name_404', 'options'),
  'video_mp4_404' => get_field('video_mp4_404', 'options'),
  'video_webm_404' => get_field('video_webm_404', 'options'),
  'image_404' => get_field('image_404', 'options')
];

new Element(__FILE__, $args);
