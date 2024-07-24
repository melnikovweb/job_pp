<?php
$post_types = ['glossary', 'news', 'vacancy', 'event', 'faq-merchant', 'payment-methods', 'people'];

$taxonomies = [
  'alphabet',
  'news-category',
  'event-type',
  'type-work',
  'work-schedule',
  'work-location',
  'faq-merchant-category',
  'payment-method-country',
  'payment-method-type'
];

foreach ($post_types as $type) {
  require_once __DIR__ . "/post-types/$type.php";
}

foreach ($taxonomies as $tax) {
  require_once __DIR__ . "/taxonomies/$tax.php";
}
