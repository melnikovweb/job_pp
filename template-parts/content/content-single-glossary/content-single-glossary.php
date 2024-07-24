<?php

declare(strict_types=1);

namespace SECRET\Parts;

use SECRET\Includes\AcfElement;

$args['links'] = [
  [
    'url' => get_post_type_archive_link('glossary'),
    'title' => __('SECRET glossary', 'SECRET')
  ],
  [
    'url' => '',
    'title' => get_the_title()
  ]
];

new AcfElement(__FILE__, $args);
