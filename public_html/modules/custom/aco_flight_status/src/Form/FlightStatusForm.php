<?php

namespace Drupal\aco_flight_status\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Datetime\DrupalDateTime;
use Drupal\Core\Datetime\DateHelper;
use Drupal\intelisys\Utility\Locations;

/**
 * Implements a flight status form.
 */
class FlightStatusForm extends FormBase {

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'aco_flight_status_form';
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $today = DrupalDateTime::createFromTimestamp(REQUEST_TIME);

    // Don't cache forms.
    $form['#cache'] = ['max-age' => 0];

    $form['flight_date'] = [
      '#type' => 'container',
      'header' => [
        '#markup' => $this->t('<h4>Flight Date</h4>'),
      ],
    ];

    $form['day'] = [
      '#type' => 'select',
      '#title' => $this->t('Departure Day'),
      '#title_display' => 'invisible',
      '#default_value' => $today->format('j'),
      '#options' => DateHelper::days(TRUE),
      '#required' => TRUE,
    ];

    $start = (new \DateTime($today->format('Y-m-d')))->modify('-1 year');
    $end = (new \DateTime($today->format('Y-m-d')))->modify('+1 year');
    $interval = \DateInterval::createFromDateString('1 month');
    $period = new \DatePeriod($start, $interval, $end);
    $options = [];
    foreach ($period as $date) {
      $options[$date->format('Y/m')] = $date->format('F Y');
    }

    $form['month_year'] = [
      '#type' => 'select',
      '#title' => $this->t('Departure Month / Year'),
      '#title_display' => 'invisible',
      '#default_value' => $today->format('Y/m'),
      '#options' => $options,
      '#required' => TRUE,
    ];
    $form['flightNumber'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Flight Number'),
      '#title_display' => 'invisible',
      '#placeholder' => $this->t('Flight Number'),
    ];
    $form['airports'] = [
      '#type' => 'container',
      'header' => [
        '#markup' => $this->t('<h4>Airports</h4>'),
      ],
    ];

    $options = Locations::getOriginAirportOptions();
    $all_options = Locations::getAirportOptions();
    $form['departureAirport'] = [
      '#type' => 'select',
      '#title' => $this->t('Departure Airport'),
      '#title_display' => 'invisible',
      '#options' => $options,
      '#empty_option' => $this->t('Departure'),
      '#ajax' => [
        'event' => 'change',
        'callback' => [$this, 'populateDestinationCity'],
        'wrapper' => 'destination-city-wrapper',
        'progress' => [
          'type' => 'fullscreen',
        ],
      ],
    ];
    $form['arrivalAirport'] = [
      '#type' => 'select',
      '#title' => $this->t('Arrival Airport'),
      '#title_display' => 'invisible',
      '#options' => $all_options,
      '#empty_option' => $this->t('Arrival'),
      '#prefix' => '<div id="destination-city-wrapper">',
      '#suffix' => '</div>',
      '#states' => [
        'disabled' => [
          'select[name="departureAirport"]' => ['value' => ''],
        ],
      ],
    ];

    $form['actions'] = ['#type' => 'actions'];
    $form['actions']['submit'] = [
      '#type' => 'submit',
      '#value' => $this->t('Find Your Flight'),
    ];

    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function validateForm(array &$form, FormStateInterface $form_state) {
    // Don't do validation on AJAX calls.
    if (!$form_state->isSubmitted()) {
      return;
    }

    $day = $form_state->getValue('day');
    list($year, $month) = explode('/', $form_state->getValue('month_year'), 2);
    if (!checkdate((int) $month, (int) $day, (int) $year)) {
      $form_state->setErrorByName('day', $this->t('The date selected is not a valid date.'));
    }

    $airport1 = $form_state->getValue('departureAirport');
    $airport2 = $form_state->getValue('arrivalAirport');
    if (!empty($airport1) && !empty($airport2) && $airport1 == $airport2) {
      $form_state->setErrorByName('arrivalAirport', $this->t('The arrival airport must not match the departure airport.'));
    }
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    $form_state->setRebuild();
  }

  /**
   * AJAX callback to populate the destination city.
   */
  public function populateDestinationCity(array $form, FormStateInterface $form_state) {
    $options = Locations::getDestinationAirportOptions($form_state->getValue('departureAirport'));
    $form['arrivalAirport']['#options'] = ['' => $this->t('Arrival')] + $options;
    return $form['arrivalAirport'];
  }

}
