<?php

declare(strict_types=1);

namespace SECRET\Parts;

use SECRET\Includes\Element;

$acf_fields = get_field('video_block', 'options') ?: [];
$args = array_merge($acf_fields, array_filter($args));

new Element(__FILE__, $args);
