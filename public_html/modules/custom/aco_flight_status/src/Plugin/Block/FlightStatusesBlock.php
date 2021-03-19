<?php

namespace Drupal\aco_flight_status\Plugin\Block;

use Drupal\Core\Block\BlockBase;
use Drupal\Core\Plugin\ContainerFactoryPluginInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Drupal\http_client_manager\HttpClientInterface;
use Drupal\Core\Datetime\Entity\DateFormat;
use Drupal\Core\Datetime\DrupalDateTime;
use GuzzleHttp\Command\Exception\CommandException;
use Drupal\intelisys\Utility\TimeHelper;

/**
 * Provides a 'FlightStatuses' block.
 *
 * @Block(
 *  id = "flight_statuses_block",
 *  admin_label = @Translation("Flight Statuses Block"),
 * )
 */
class FlightStatusesBlock extends BlockBase implements ContainerFactoryPluginInterface {

  /**
   * Threshold for a flight marked as delayed or early.
   */
  const DELAYED_EARLY_THRESHOLD = 60 * 10;

  /**
   * JsonPlaceholder HTTP Client.
   *
   * @var \Drupal\http_client_manager\HttpClientInterface
   */
  protected $httpClient;

  /**
   * The date format.
   *
   * @var string
   */
  protected $dateFormat;

  /**
   * Constructs a flight status block object.
   *
   * @param array $configuration
   *   A configuration array containing information about the plugin instance.
   * @param string $plugin_id
   *   The plugin_id for the plugin instance.
   * @param mixed $plugin_definition
   *   The plugin implementation definition.
   * @param \Drupal\http_client_manager\HttpClientInterface $http_client
   *   The HTTP client.
   */
  public function __construct(array $configuration, $plugin_id, $plugin_definition, HttpClientInterface $http_client) {
    $this->pluginId = $plugin_id;
    $this->httpClient = $http_client;
    $this->dateFormat = DateFormat::load('time')->getPattern();

    parent::__construct($configuration, $plugin_id, $plugin_definition);
  }

  /**
   * {@inheritdoc}
   */
  public static function create(ContainerInterface $container, array $configuration, $plugin_id, $plugin_definition) {
    return new static(
      $configuration,
      $plugin_id,
      $plugin_definition,
      $container->get('http_client_manager.factory')->get('intelisys_api')
    );
  }

  /**
   * {@inheritdoc}
   */
  public function defaultConfiguration() {
    return ['label_display' => FALSE];
  }

  /**
   * {@inheritdoc}
   */
  public function build() {
    $params = \Drupal::request()->request->all();

    if (isset($params['form_id']) && $params['form_id'] == 'aco_flight_status_form') {
      try {
        $flights = $this->httpClient->getFlightStatuses([
          'departure' => $params['month_year'] . '/' . str_pad($params['day'], 2, '0', STR_PAD_LEFT),
          'flightNumber' => ltrim(strtoupper($params['flightNumber']), INTELIYSYS_AIRLINE_CODE),
          'departureAirport' => $params['departureAirport'],
          // The arrival airport is not always set since AJAX is used to control
          // the available options based on the departure airport.
          'arrivalAirport' => isset($params['arrivalAirport']) ? $params['arrivalAirport'] : '',
        ])->toArray();
      }
      catch (CommandException $e) {
        return [
          '#markup' => $this->t('<p>The search criteria provided is invalid.</p>'),
        ];
      }

      if (!empty($flights)) {
        $header = [
          $this->t('Flight #'),
          $this->t('Departure Airport'),
          $this->t('Scheduled'),
          $this->t('Revised'),
          $this->t('Arrival Airport'),
          $this->t('Scheduled'),
          $this->t('Revised'),
          $this->t('Status'),
        ];

        $rows = [];
        foreach ($flights as &$flight) {
          $status = &$flight['legs'][0]['flightLegStatus'];

          // Only used for comparing scheduled to actual times. Timezone
          // alteration is not needed here.
          $scheduled_departure_time = strtotime($flight['legs'][0]['flightLeg']['departure']['scheduledTime']);
          $scheduled_arrival_time = strtotime($flight['legs'][0]['flightLeg']['arrival']['scheduledTime']);

          // Only used for sorting. Timezone alteration is not needed here.
          $actual_departure_time = strtotime($flight['legs'][0]['departure']['estimatedTime']);
          $actual_arrival_time = strtotime($flight['legs'][0]['arrival']['estimatedTime']);

          $actual_departure_local_time = strtotime($flight['legs'][0]['departure']['localEstimatedTime']);
          $actual_arrival_local_time = strtotime($flight['legs'][0]['arrival']['localEstimatedTime']);

          $rows[] = [
            'canceled' => FALSE,
            'actual_departure' => $actual_departure_time,
            'actual_arrival' => $actual_arrival_time,
            'flight_number' => $flight['airlineCode']['code'] . $flight['flightNumber'],
            'departure_airport' => $flight['legs'][0]['flightLeg']['departure']['airport']['name'],
            'scheduled_departure' => TimeHelper::getLocalTime($flight['legs'][0]['flightLeg']['departure'], $this->dateFormat),
            'scheduled_departure_revised' => $this->getRevisedTime($scheduled_departure_time, $actual_departure_time, $actual_departure_local_time, $actual_departure_time, $status),
            'arrival_airport' => $flight['legs'][0]['flightLeg']['arrival']['airport']['name'],
            'scheduled_arrival' => TimeHelper::getLocalTime($flight['legs'][0]['flightLeg']['arrival'], $this->dateFormat),
            'scheduled_arrival_revised' => $this->getRevisedTime($scheduled_arrival_time, $actual_arrival_time, $actual_arrival_local_time, $actual_departure_time, $status),
            'status' => $this->getFlightStatus($status, $flight['legs'][0]['locationStatus'], $actual_departure_time, $actual_arrival_time),
          ];
        }

        // Sort flights.
        usort($rows, '_aco_core_sort_flights');

        // Prepare rows for output.
        foreach ($rows as &$row) {
          // Remove sorting columns.
          unset($row['canceled']);
          unset($row['actual_departure']);
          unset($row['actual_arrival']);
        }

        return [
          '#theme' => 'table',
          '#header' => $header,
          '#rows' => $rows,
        ];
      }
      else {
        return [
          '#markup' => $this->t('<p>There are no flights matching your search criteria.</p>'),
        ];
      }
    }

    return [];
  }

  /**
   * {@inheritdoc}
   */
  public function getCacheMaxAge() {
    return 0;
  }

  /**
   * Helper function to get the flight status.
   *
   * @param array $leg_status
   *   An array of status flags.
   * @param array|null $location_status
   *   An array of status flags.
   * @param int $revised_departure_time
   *   The revised departure time.
   * @param int $revised_arrival_time
   *   The revised arrival time.
   *
   * @return \Drupal\Core\StringTranslation\TranslatableMarkup
   *   The flight status.
   */
  private function getFlightStatus(array $leg_status, $location_status, $revised_departure_time, $revised_arrival_time) {
    // @todo Verify logic here.
    if (!empty($location_status)) {
      if (!$location_status['departed'] && $leg_status['active']) {
        if ($revised_departure_time < REQUEST_TIME && $revised_arrival_time > REQUEST_TIME) {
          return $this->t('Departed');
        }
        elseif ($revised_arrival_time < REQUEST_TIME) {
          return $this->t('Arrived');
        }
        return $this->t('Not Yet Departed');
      }
      if ($location_status['arrived'] && $leg_status['closed']) {
        return $this->t('Arrived');
      }
      if ($location_status['departed'] && !$location_status['arrived']) {
        return $this->t('Departed');
      }
    }

    if ($leg_status['cancelled']) {
      return $this->t('Canceled');
    }
    elseif ($leg_status['expired']) {
      return $this->t('Expired');
    }
    elseif ($leg_status['locked']) {
      return $this->t('Locked');
    }
    elseif ($leg_status['active']) {
      if ($revised_departure_time < REQUEST_TIME && $revised_arrival_time > REQUEST_TIME) {
        return $this->t('Departed');
      }
      elseif ($revised_arrival_time < REQUEST_TIME) {
        return $this->t('Arrived');
      }
      return $this->t('Not Yet Departed');
    }
    elseif ($leg_status['closed']) {
      if ($revised_departure_time < REQUEST_TIME && $revised_arrival_time > REQUEST_TIME) {
        return $this->t('Departed');
      }
      elseif ($revised_departure_time > REQUEST_TIME) {
        return $this->t('Not Yet Departed');
      }
      return $this->t('Arrived');
    }
    elseif ($revised_arrival_time < REQUEST_TIME) {
      return $this->t('Arrived');
    }
    elseif ($leg_status['checkInClosed']) {
      return $this->t('Check-in Closed');
    }

    return $this->t('Undetermined');
  }

  /**
   * Helper function to get the delayed text.
   *
   * @param int $scheduled_time
   *   A UNIX timestamp for the scheduled time.
   * @param int $actual_time
   *   A UNIX timestamp for the actual time.
   * @param int $actual_local_time
   *   A UNIX timestamp for the actual local time.
   * @param int $departure_time
   *   A UNIX timestamp for the departure time.
   * @param array $status
   *   An array of status flags (active, expired, checkInClosed, closed,
   *   cancelled, locked).
   *
   * @return \Drupal\Core\StringTranslation\TranslatableMarkup
   *   The revised flight time.
   */
  private function getRevisedTime($scheduled_time, $actual_time, $actual_local_time, $departure_time, array $status) {
    // Canceled flights do not show a time at all.
    if ($status['cancelled']) {
      return $this->t('-');
    }

    // Get the revised time.
    $revised_time = DrupalDateTime::createFromTimestamp($actual_local_time)->format($this->dateFormat);

    // Check if the flight is on time.
    if ($scheduled_time == $actual_time) {
      return $departure_time > REQUEST_TIME ? $this->t('On Time') : $revised_time;
    }

    // Lastly, check if the flight was early or delayed by a threshold.
    if (abs($scheduled_time - $actual_time) > self::DELAYED_EARLY_THRESHOLD) {
      if ($scheduled_time > $actual_time) {
        return $this->t('@time Early', ['@time' => $revised_time]);
      }
      else {
        return $this->t('@time Delayed', ['@time' => $revised_time]);
      }
    }

    return $revised_time;
  }

}
