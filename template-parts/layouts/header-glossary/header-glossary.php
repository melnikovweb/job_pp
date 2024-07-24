<?php

declare(strict_types=1);

namespace SECRET\Parts;

use SECRET\Includes\AcfElement;

$items = [];
$alphabet = get_terms([
  'taxonomy' => 'alphabet',
  'hide_empty' => true
]);

if ($alphabet) {
  $current_tax_id = '';
  if (is_tax('alphabet')) {
    $current_tax = get_queried_object();
    if ($current_tax instanceof \WP_Term) {
      $current_tax_id = $current_tax->term_id;
    }
  }

  foreach ($alphabet as $letter) {
    $items[] = [
      'is_active' => $current_tax_id == $letter->term_id,
      'title' => $letter->name,
      'permalink' => get_term_link($letter->term_id)
    ];
  }
}

new AcfElement(__FILE__, ['items' => $items]);
