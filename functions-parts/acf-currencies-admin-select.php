<?php

namespace AcfCurrenciesAdminSelect;

require_once get_template_directory() . '/includes/ApiCurrencies.php';
require_once get_template_directory() . '/includes/AcfAdminSelect.php';

use SECRET\Includes\AcfAdminSelect;
use SECRET\Includes\ApiCurrencies;

/**
 * Fetch the currencies data and format it for use in the ACF select field.
 *
 * @return array The array of select items with value, label, and image_url.
 */
function get_select_items(): array
{
  $raw_data = ApiCurrencies::get_all_currencies();

  return array_map(function (array $item): array {
    return [
      'value' => $item['currency'],
      'label' => $item['name'],
      'image_url' => $item['flag']
    ];
  }, $raw_data);
}

add_action('acf/init', 'AcfCurrenciesAdminSelect\acf_init');

function acf_init()
{
  AcfAdminSelect::create(get_select_items(), 'api_currencies_select');
}
