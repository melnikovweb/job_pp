<?php

declare(strict_types=1);

namespace SECRET\Parts;

use SECRET\Includes\Element;

$image = get_field('event_thumbnail');
$where = get_field('where');
$start_date = get_field('start_date');
$end_date = get_field('end_date');
$site = get_field('site');
$our_stand = get_field('our_stand');

$fields = [
  'image' => $image,
  'where' => $where,
  'start_date' => $start_date,
  'end_date' => $end_date,
  'site' => $site,
  'our_stand' => $our_stand
];

new Element(__FILE__, ['fields' => $fields]);
