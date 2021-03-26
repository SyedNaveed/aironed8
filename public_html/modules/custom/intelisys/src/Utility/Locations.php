<?php

namespace Drupal\intelisys\Utility;

use GuzzleHttp\Command\Exception\CommandException;

/**
 * Location helper class.
 */
class Locations {

  /**
   * The default 'Country Code' to use.
   */
  const DEFAULT_COUNTRY_CODE = 'USA';

  /**
   * Get city pairs.
   *
   * @return array
   *   The city pairs.
   */
  private static function getCityPairs() {
    static $city_pairs;

    if (isset($city_pairs)) {
      return $city_pairs;
    }

    try {
      $intelisys = \Drupal::service('http_client_manager.factory')
        ->get('intelisys_api');
      $city_pairs = $intelisys->getCityPairs()->toArray();
    }
    catch (CommandException $e) {
      return [];
    }

    return $city_pairs;
  }

  /**
   * Get provinces by country code.
   *
   * @param string $country_code
   *   The country code to get provinces for.
   *
   * @return array
   *   The provinces.
   */
  public static function getProvinces($country_code) {
    static $provinces;

    if (isset($provinces[$country_code])) {
      return $provinces[$country_code];
    }

    try {
      $intelisys = \Drupal::service('http_client_manager.factory')
        ->get('intelisys_api');
      $provinces[$country_code] = $intelisys->getCountryProvinces([
        'code' => $country_code,
      ])->toArray();
    }
    catch (CommandException $e) {
      return [];
    }

    return $provinces[$country_code];
  }

  /**
   * Helper function to get province reference.
   *
   * @param string $country_code
   *   The country code to search for.
   * @param string $province_code
   *   The province code to search for.
   *
   * @return array
   *   The province.
   */
  public static function getProvince($country_code, $province_code) {
    $provinces = self::getProvinces($country_code);
    $key = array_search($province_code, array_column($provinces, 'code'));
    return (FALSE === $key) ? [] : $provinces[$key];
  }

  /**
   * Get countries.
   *
   * @return array
   *   The countries.
   */
  public static function getCountries() {
    static $countries;

    if (isset($countries)) {
      return $countries;
    }

    try {
      $intelisys = \Drupal::service('http_client_manager.factory')
        ->get('intelisys_api');
      $countries = $intelisys->getCountries()->toArray();
    }
    catch (CommandException $e) {
      return [];
    }

    return $countries;
  }

  /**
   * Helper function to get country reference.
   *
   * @param string $country_code
   *   The country code to search for.
   *
   * @return array
   *   The country.
   */
  public static function getCountry($country_code) {
    $countries = self::getCountries();
    $key = array_search($country_code, array_column($countries, 'code'));
    return (FALSE === $key) ? [] : $countries[$key];
  }

  /**
   * Get country options.
   *
   * @return array
   *   The country options.
   */
  public static function getCountryOptions() {
    $options = [];
    $countries = self::getCountries();
    foreach ($countries as &$country) {
      $options[$country['code']] = t('@name', ['@name' => $country['name']]);
    }
    return $options;
  }

  /**
   * Get province options.
   *
   * @param string $country_code
   *   The country code to get provinces for.
   *
   * @return array
   *   The province options.
   */
  public static function getProvinceOptions($country_code) {
    $options = [];
    $provinces = self::getProvinces($country_code);
    foreach ($provinces as &$province) {
      $options[$province['code']] = t('@name', ['@name' => $province['name']]);
    }
    return $options;
  }

  /**
   * Get destination airport options.
   *
   * @param string $code_filter
   *   The airport code to filter by.
   *
   * @return array
   *   The destination airport options.
   */
  public static function getDestinationAirportOptions($code_filter) {
    $options = [];
    $city_pairs = self::getCityPairs();
    foreach ($city_pairs as &$city_pair) {
      if ($code_filter == $city_pair['departure']['airport']['code']) {
        $code = $city_pair['arrival']['airport']['code'];
        $options[$code] = $code;
      }
    }

    $options = self::intersectAirportOptions($options);
    return $options;
  }

  /**
   * Get origin airports options.
   *
   * @return array
   *   The origin airport options.
   */
  public static function getOriginAirportOptions() {
    static $options;

    if (isset($options)) {
      return $options;
    }

    $options = [];
    $city_pairs = self::getCityPairs();
    foreach ($city_pairs as &$city_pair) {
      $code = $city_pair['departure']['airport']['code'];
      $options[$code] = $code;
    }

    $options = self::intersectAirportOptions($options);
    return $options;
  }

  /**
   * Get airports.
   *
   * @return array
   *   The airport options.
   */
  public static function getAirportOptions() {
    static $options;

    if (isset($options)) {
      return $options;
    }

    try {
      $intelisys = \Drupal::service('http_client_manager.factory')
        ->get('intelisys_api');
      $response = $intelisys->getAirports()->toArray();
    }
    catch (CommandException $e) {
      return [];
    }

    $options = [];
    foreach ($response as &$airport) {
      $options[$airport['code']] = t('@airport (@code)', [
        '@airport' => $airport['name'],
        '@code' => $airport['code'],
      ]);
    }

    asort($options);
    return $options;
  }

  public static function getAirportOptions2() {
    static $options;

    if (isset($options)) {
      return $options;
    }

    try {
      $intelisys = \Drupal::service('http_client_manager.factory')
        ->get('intelisys_api');
      $response = $intelisys->getAirports()->toArray();
    }
    catch (CommandException $e) {
      return [];
    }

    $options = [];
    foreach ($response as &$airport) {
      $options[$airport['code']] =  [
        'name' => $airport['name'],
        'code' => $airport['code'],
      ];
    }

    asort($options);
    return $options;
  }

  /**
   * Intersect airport options.
   *
   * @param array $allowed_codes
   *   The allowed airport codes to intersect with.
   *
   * @return array
   *   The intersected airport options.
   */
  private static function intersectAirportOptions(array &$allowed_codes) {
    $options = self::getAirportOptions();
    if (!empty($allowed_codes)) {
      return array_intersect_key($options, $allowed_codes);
    }
    return $options;
  }

}
