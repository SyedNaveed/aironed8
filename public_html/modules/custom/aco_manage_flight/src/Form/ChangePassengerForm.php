<?php

namespace Drupal\aco_manage_flight\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Url;
use Drupal\Component\Utility\NestedArray;
use Drupal\aco_core\Utility\Prepare;
use Drupal\aco_core\Utility\Defaults;
use Drupal\aco_core\Traits\FormBuilderTrait;
use Drupal\aco_core\Traits\IntelisysTrait;
use Drupal\aco_core\Traits\ItineraryTrait;
use Drupal\aco_core\Traits\ReservationTrait;

/**
 * Implements a change passenger form.
 */
class ChangePassengerForm extends FormBase {
  use IntelisysTrait;
  use ItineraryTrait;
  use ReservationTrait;
  use FormBuilderTrait;

  /**
   * {@inheritdoc}
   */
  public function __construct() {
    $this->initReservation();
  }

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'aco_manage_flight_change_passenger_form';
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $form['#cache'] = ['max-age' => 0];
    $passenger_index = $this->getRequest()->getSession()->get('passenger_index');
    if (!isset($this->reservation['passengers'][$passenger_index])) {
      return $form;
    }

    // Test name change for charges.
    $reservation = $this->getReservation();
    $passenger = $reservation['passengers'][$passenger_index];
    $passenger['index'] = $passenger_index + 1;
    $passenger['reservationProfile']['firstName'] = 'Testfirstnamechange';
    $passenger['reservationProfile']['lasttName'] = 'Testlastnamechange';
    $quote = $this->callEndpoint('putQuotations', [
      'httpMethod' => 'PUT',
      'requestUri' => "/reservations/{$this->reservation['key']}/passengers/{$passenger['key']}",
      'passengers' => [$passenger],
      'paymentTransactions' => Defaults::paymentTransactions(),
    ]);
    $is_fee = count($reservation['charges']) == count($quote['charges']);

    $form['#tree'] = TRUE;
    $form['description'] = [
      '#type' => 'container',
      'content' => [
        '#markup' => $this->t('<p>Please fill all the information in English. Fields marked with * are mandatory.</p>'),
      ],
      'additional' => [
        '#markup' => $this->t('<p>Please enter first and last names as they appear on the passenger&rsquo;s Government Issued ID or Passport.</p>'),
      ],
    ];

    if ($is_fee) {
      $form['description']['fee'] = [
        '#markup' => $this->t('<p>No fee will be charged to this reservation passenger change.</p>'),
      ];
    }

    $form['contact_information'] = [
      '#type' => 'container',
      'table' => $this->getContactInformation($reservation['passengers'], $passenger_index),
    ];

    $values = &$this->reservation['passengers'][$passenger_index];
    $this->getContactInformationFormByValues($form, $values, FALSE);
    unset($form['withInfant']);
    unset($form['infant']);

    // @todo Implement a purchase form if a fee is charged, but can probably
    // ignore this until the client starts charging a fee for this.
    $form['actions'] = ['#type' => 'actions'];
    $form['actions']['submit'] = [
      '#type' => 'submit',
      '#value' => $this->t('Change Passenger Information'),
    ];
    $form['actions']['cancel'] = [
      '#type' => 'link',
      '#title' => $this->t('Cancel'),
      '#url' => Url::fromRoute('aco_manage_flight.reservation'),
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

    $form_state->addCleanValueKey('actions');
    $values = $form_state->cleanValues()->getValues();

    // Verify email address fields match (if they exist).
    if (isset($values['personalContactInformation']['email']) && $values['personalContactInformation']['email'] != $values['personalContactInformation']['verifyEmail']) {
      $form_state->setErrorByName('personalContactInformation][verifyEmail', $this->t('The email address fields must match.'));
      return;
    }

    // Change passenger with new values.
    $passenger_index = $this->getRequest()->getSession()->get('passenger_index');
    $passenger = &$this->reservation['passengers'][$passenger_index];
    Prepare::contactInformation($values);
    $combined = [$passenger['reservationProfile'], $values];
    $reservation_profile = NestedArray::mergeDeepArray($combined, TRUE);
    unset($reservation_profile['advancePassengerInformation']);
    $combined = [
      $passenger['advancePassengerInformation'],
      $values['advancePassengerInformation'],
    ];
    $api = NestedArray::mergeDeepArray($combined, TRUE);

    $result = $this->callEndpoint('putReservationPassenger', [
      'reservationKey' => $this->reservation['key'],
      'passengerKey' => $passenger['key'],
      'key' => $passenger['key'],
      'reservationProfile' => $reservation_profile,
      'advancePassengerInformation' => $api,
      'timestamp' => $passenger['timestamp'],
    ], FALSE);

    if (FALSE === $result) {
      $form_state->setError($form, $this->t('An error occurred while attempting to change the passenger information. @help', [
        '@help' => _aco_core_get_default_help_message(),
      ]));
    }
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    $values = $form_state->cleanValues()->getValues();
    $this->messenger()->addStatus($this->t('Original passenger has been replaced by @first @last.', [
      '@first' => $values['firstName'],
      '@last' => $values['lastName'],
    ]));
    $form_state->setRedirect('aco_manage_flight.reservation');
  }

}
