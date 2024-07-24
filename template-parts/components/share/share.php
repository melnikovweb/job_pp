<?php

declare(strict_types=1);

namespace SECRET\Parts;

use SECRET\Includes\Element;

$args = is_array($args) ? $args : [];

$args['socials'] = get_field('socials', 'options') ?: [];

new Element(__FILE__, $args);
