<?php

declare(strict_types=1);

namespace SECRET\Includes;

/**
 * Class Country
 *
 * Represents the structure of country data.
 */
class CountryType
{
  public string $cca2;
  public string $shortName;
  public ?string $fullName;
  public ?string $regionName;
  public string $flag;

  /**
   * Country constructor.
   *
   * @param string $cca2
   * @param string $short_name
   * @param string|null $full_name
   * @param string|null $region_name
   */
  public function __construct(string $cca2, string $short_name, ?string $full_name, ?string $region_name)
  {
    $image_name = strtolower($cca2);
    $flag_url = "https://flagcdn.com/$image_name.svg";

    $this->cca2 = $cca2;
    $this->shortName = $short_name;
    $this->flag = $flag_url;
    $this->fullName = $full_name;
    $this->regionName = $region_name;
  }
}
