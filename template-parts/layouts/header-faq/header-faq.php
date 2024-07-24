<?php

declare(strict_types=1);

namespace SECRET\Parts;

use SECRET\Includes\Element;

$args = is_array($args) && isset($args['title']) ? $args : ['title' => single_term_title('', false)];

new Element(__FILE__, $args);
