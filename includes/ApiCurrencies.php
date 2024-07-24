<?php

declare(strict_types=1);

namespace SECRET\Includes;

class ApiCurrencies
{
  private const PATH_TO_FILE = __DIR__ . 'SECRET';

  /**
   * Load data from the JSON file.
   *
   * @return array The decoded JSON data.
   * @throws \Exception If the file cannot be read or the JSON is invalid.
   */
  public static function load_data(): array
  {
    if (!file_exists(self::PATH_TO_FILE)) {
      throw new \Exception('File not found: ' . self::PATH_TO_FILE);
    }

    $json = file_get_contents(self::PATH_TO_FILE);
    if ($json === false) {
      throw new \Exception('Failed to read file: ' . self::PATH_TO_FILE);
    }

    $data = json_decode($json, true);
    if (json_last_error() !== JSON_ERROR_NONE) {
      throw new \Exception('Invalid JSON data: ' . json_last_error_msg());
    }

    return $data;
  }

  /**
   * Get the data from the JSON file.
   *
   * @return array The JSON data.
   */
  public static function get_all_currencies(): array
  {
    return self::load_data();
  }
}
