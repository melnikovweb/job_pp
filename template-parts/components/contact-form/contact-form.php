<?php

declare(strict_types=1);

namespace SECRET\Parts;

use SECRET\Includes\Element;
use SECRET\Includes\ApiCountries;

$args = is_array($args) ? $args : [];

$element = new Element(__FILE__, $args);

$element->add_scripts_localize([
  'allowedCountries' => ApiCountries::get_allowed_countries(),
  'countriesPlaceholder' => __('Select', 'SECRET-domain')
]);
