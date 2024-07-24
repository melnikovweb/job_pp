<?php

namespace AcfCountriesAdminSelect;

require_once get_template_directory() . '/includes/CountryType.php';
require_once get_template_directory() . '/includes/ApiCountries.php';
require_once get_template_directory() . '/includes/AcfAdminSelect.php';

use SECRET\Includes\ApiCountries;
use SECRET\Includes\AcfAdminSelect;
use SECRET\Includes\CountryType;

/**
 * Fetch the country data and format it for use in the ACF select field.
 *
 * @return array The array of select items with value, label, and image_url.
 */
function get_select_items(): array
{
  $raw_data = ApiCountries::get_all_countries();

  return array_map(function (CountryType $item): array {
    return [
      'value' => $item->cca2,
      'label' => $item->shortName,
      'image_url' => $item->flag
    ];
  }, $raw_data);
}

add_action('acf/init', 'AcfCountriesAdminSelect\acf_init');

function acf_init()
{
  AcfAdminSelect::create(get_select_items(), 'api_countries_select');
}
