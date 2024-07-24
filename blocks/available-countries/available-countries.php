<?php

declare(strict_types=1);

namespace SECRET\Blocks;

use SECRET\Includes\AcfElement;
use SECRET\Includes\ApiCountries;

$countries = ApiCountries::get_allowed_countries();

$args['countries'] = $countries;
$args['countries_map'] = [];
$args['regions'] = [];

foreach ($countries as $item) {
  $regionName = $item->regionName;

  if (!isset($args['countries_map'][$regionName])) {
    $args['countries_map'][$regionName] = [];
    $args['regions'][] = $regionName;
  }

  $args['countries_map'][$regionName][] = $item;
}

$all_countries_key = __('All', 'SECRET-domain');

array_unshift($args['regions'], $all_countries_key);
$args['countries_map'] = array_merge([$all_countries_key => $countries], $args['countries_map']);

$args['all_countries_key'] = $all_countries_key;

new AcfElement(__FILE__, $args);
