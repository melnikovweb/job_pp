<?php

declare(strict_types=1);

namespace SECRET\Parts;

use SECRET\Includes\AcfElement;

$image = get_field('image');
$subheading = get_field('subheading');
$description = get_field('description');
$items = get_field('items');
$refunds = get_field('refunds');
$partial_refunds = get_field('partial_refunds');
$chargebacks = get_field('chargebacks');

$args = [
  'title' => get_the_title(),
  'subheading' => $subheading,
  'image' => $image,
  'description' => $description,
  'items' => $items,
  'refunds' => $refunds,
  'partial_refunds' => $partial_refunds,
  'chargebacks' => $chargebacks
];

new AcfElement(__FILE__, $args);
