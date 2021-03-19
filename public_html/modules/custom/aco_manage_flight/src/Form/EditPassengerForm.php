<?php

namespace Drupal\aco_manage_flight\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Url;
use Drupal\Component\Utility\NestedArray;
use Drupal\aco_core\Traits\FormBuilderTrait;
use Drupal\aco_core\Traits\IntelisysTrait;
use Drupal\aco_core\Traits\ReservationTrait;
use Drupal\aco_core\Utility\Prepare;

/**
 * Implements an edit passenger form.
 */
class EditPassengerForm extends FormBase {
  use FormBuilderTrait;
  use IntelisysTrait;
  use ReservationTrait;

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
    return 'aco_manage_flight_edit_passenger_form';
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

    $form['#tree'] = TRUE;
    $form['description'] = ['#type' => 'container'];

    // Add a header to signify the reservation owner.
    if ($this->reservation['passengers'][$passenger_index]['reservationOwner']) {
      $form['description']['title'] = [
        '#markup' => $this->t('<p><strong>Primary Reservation Contact Information</strong></p>'),
      ];
    }

    $form['description']['content'] = [
      '#markup' => $this->t('<p>Please fill all the information in English. Fields marked with * are mandatory.</p>'),
    ];

    $form['description']['additional'] = [
      '#markup' => $this->t('<p>Please enter first and last names as they appear on the passenger&rsquo;s Government Issued ID or Passport.</p>'),
    ];

    // Create the contact information form.
    $values = &$this->reservation['passengers'][$passenger_index];
    $this->getContactInformationFormByValues($form, $values);
    unset($form['withInfant']);
    unset($form['infant']);

    // The passenger name is not allowed to be changed. Disable the fields.
    $form['firstName']['#disabled'] = TRUE;
    $form['middleName']['#disabled'] = TRUE;
    $form['lastName']['#disabled'] = TRUE;

    $form['actions'] = ['#type' => 'actions'];
    $form['actions']['submit'] = [
      '#type' => 'submit',
      '#value' => $this->t('Save Passenger Information'),
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
    }

    if ($form_state->getErrors()) {
      return;
    }

    // Update passenger with new values.
    $passenger_index = $this->getRequest()->getSession()->get('passenger_index');
    $passenger = &$this->reservation['passengers'][$passenger_index];
    Prepare::contactInformation($values);
    $combined = [$passenger['reservationProfile'], $values];
    $reservation_profile = NestedArray::mergeDeepArray($combined, TRUE);
    unset($reservation_profile['advancePassengerInformation']);
    $combined = [
      !empty($passenger['advancePassengerInformation']) ? $passenger['advancePassengerInformation'] : [],
      $values['advancePassengerInformation'],
    ];
    $api = NestedArray::mergeDeepArray($combined, TRUE);
    $api['firstName'] = $reservation_profile['firstName'];
    $api['lastName'] = $reservation_profile['lastName'];

    $passenger = $this->callEndpoint('putReservationPassenger', [
      'reservationKey' => $this->reservation['key'],
      'passengerKey' => $passenger['key'],
      'key' => $passenger['key'],
      'reservationProfile' => $reservation_profile,
      'advancePassengerInformation' => $api,
      'timestamp' => $passenger['timestamp'],
    ]);

    if (FALSE === $passenger) {
      $form_state->setError($form, $this->t('An error occurred while attempting to update the passenger information. @help', [
        '@help' => _aco_core_get_default_help_message(),
      ]));
    }
    else {
      $this->messenger()->addStatus($this->t('The passenger, <em>@first @last</em>, has been updated.', [
        '@first' => $reservation_profile['firstName'],
        '@last' => $reservation_profile['lastName'],
      ]));
    }
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    $form_state->setRedirect('aco_manage_flight.reservation');
  }

}
