<?php

declare(strict_types=1);

namespace SECRET\Parts;

use SECRET\Includes\AcfElement;

$args = [
  'read_time' => SECRET_read_time(),
  'title' => get_the_title(),
  'thumbnail' => get_the_post_thumbnail(get_the_ID(), [1395, 923]),
  'content' => get_the_content(),
  'date' => get_the_date()
];

new AcfElement(__FILE__, $args);
