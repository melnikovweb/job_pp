<?php

declare(strict_types=1);

namespace SECRET\Includes;

use SECRET\Includes\CountryType;

/**
 * Class ApiCountries
 *
 * This class is responsible for fetching and caching country data from the SECRET API.
 */
class ApiCountries
{
  private const API_ALL_COUNTRIES_URL = 'SECRET';
  private const API_PROHIBITED_COUNTRIES_URL = 'SECRET';

  private const CACHE_ALL_COUNTRIES_KEY = 'SECRET_countries_data';
  private const CACHE_PROHIBITED_COUNTRIES_KEY = 'SECRET_prohibited_countries_data';

  private const CACHE_EXPIRATION = DAY_IN_SECONDS;

  /**
   * Fetch data from the SECRET API, using cache if available.
   *
   * @param string $method The HTTP method to use ('GET' or 'POST').
   * @param string $api_url The API URL to fetch data from.
   * @param string $cache_key The cache key to use.
   * @param callable $adapter The function to adapt the raw data.
   * @return CountryType[] The array of country data.
   */
  private static function get_data(string $method, string $api_url, string $cache_key, callable $adapter): array
  {
    $is_cache_enabled = get_field('is_api_cache_enabled', 'options') ?? false;

    $cached_data = $is_cache_enabled ? get_transient($cache_key) : false;

    if ($cached_data !== false) {
      return $cached_data;
    }

    if ($method === 'GET') {
      $response = wp_remote_get($api_url);
    } elseif ($method === 'POST') {
      $response = wp_remote_post($api_url);
    } else {
      return [];
    }

    if (is_array($response) && !is_wp_error($response)) {
      $body = wp_remote_retrieve_body($response);
      $raw_data = json_decode($body)->data ?? [];
      $data = array_map($adapter, $raw_data);

      if ($is_cache_enabled) {
        set_transient($cache_key, $data, self::CACHE_EXPIRATION);
      }

      return $data;
    }

    return [];
  }

  /**
   * Adapt the API country data to a structured format.
   *
   * @param object $data The raw country data from the API.
   * @return CountryType The adapted country data.
   */
  private static function all_countries_adapter(object $data): CountryType
  {
    return new CountryType(
      $data->alphaTwoCode,
      $data->shortNameEn,
      $data->fullNameEn ?? null,
      $data->region->name ?? null
    );
  }

  /**
   * Adapt the API prohibited country data to a structured format.
   *
   * @param object $data The raw prohibited country data from the API.
   * @return CountryType The adapted prohibited country data.
   */
  private static function prohibited_countries_adapter(object $data): CountryType
  {
    return new CountryType($data->code, $data->name, null, null);
  }

  /**
   * Fetch all countries from the SECRET API, using cache if available.
   *
   * @return CountryType[] The array of country data.
   */
  public static function get_all_countries(): array
  {
    return self::get_data('POST', self::API_ALL_COUNTRIES_URL, self::CACHE_ALL_COUNTRIES_KEY, [
      self::class,
      'all_countries_adapter'
    ]);
  }

  /**
   * Fetch all prohibited countries from the SECRET API, using cache if available.
   *
   * @return CountryType[] The array of prohibited country data.
   */
  public static function get_prohibited_countries(): array
  {
    return self::get_data('GET', self::API_PROHIBITED_COUNTRIES_URL, self::CACHE_PROHIBITED_COUNTRIES_KEY, [
      self::class,
      'prohibited_countries_adapter'
    ]);
  }

  /**
   * Get allowed countries by filtering out prohibited countries.
   *
   * @return CountryType[] The array of allowed country data.
   */
  public static function get_allowed_countries(): array
  {
    $all_countries = self::get_all_countries();
    $prohibited_countries_cca2 = array_map(
      fn (CountryType $country): string => $country->cca2,
      self::get_prohibited_countries()
    );

    return array_values(
      array_filter(
        $all_countries,
        fn (CountryType $country): bool => !in_array($country->cca2, $prohibited_countries_cca2, true)
      )
    );
  }
}
