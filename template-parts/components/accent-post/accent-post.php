<?php

declare(strict_types=1);

namespace SECRET\Parts;

use SECRET\Includes\Element;

$args = is_array($args) ? $args : [];

new Element(__FILE__, $args);
