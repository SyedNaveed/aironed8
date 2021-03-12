<?php

namespace Drupal\aco_manage_flight\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Url;
use Drupal\aco_core\Traits\FormBuilderTrait;
use Drupal\aco_core\Traits\IntelisysTrait;
use Drupal\aco_core\Traits\ReservationTrait;
use Drupal\aco_core\Utility\Fields;

/**
 * Implements an edit contact information form.
 */
class EditContactInformationForm extends FormBase {
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
    return 'aco_manage_flight_edit_contact_information_form';
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $form['#cache'] = ['max-age' => 0];
    $booking_info = &$this->reservation['bookingInformation'];
    list($last_name, $first_name) = explode(', ', $booking_info['contactInformation']['name']);

    $form['description'] = [
      '#type' => 'container',
      '#markup' => $this->t('<p>Please fill all the information in English. Fields marked with * are mandatory.</p>'),
    ];

    $form['firstName'] = Fields::nameField($this->t('First Name'), $first_name);
    $form['lastName'] = Fields::nameField($this->t('Last Name'), $last_name);
    $form['phoneNumber'] = Fields::phoneField($this->t('Phone Number'), $booking_info['contactInformation']['phoneNumber']);
    $form['email'] = Fields::emailField($this->t('Email'), $booking_info['contactInformation']['email']);
    $form['notes'] = [
      '#type' => 'textarea',
      '#title' => $this->t('Notes'),
      '#title_display' => 'invisible',
      '#placeholder' => $this->t('Notes'),
      '#default_value' => $booking_info['notes'],
      '#maxlength' => 5000,
    ];

    $form['actions'] = ['#type' => 'actions'];
    $form['actions']['submit'] = [
      '#type' => 'submit',
      '#value' => $this->t('Save Contact Information'),
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
    $values = $form_state->getValues();

    // Retrieve updated booking information model to work with.
    $booking_info = $this->callEndpoint('getBookingInformation', [
      'key' => $this->reservation['key'],
      'bookingInformationKey' => $this->reservation['bookingInformation']['key'],
    ]);

    // Update booking information with new values.
    $result = $this->callEndpoint('putBookingInformation', [
      'key' => $this->reservation['key'],
      'bookingInformationKey' => $booking_info['key'],
      'contactInformation' => [
        'name' => sprintf('%s, %s', $values['lastName'], $values['firstName']),
        'phoneNumber' => $values['phoneNumber'],
        'email' => $values['email'],
      ],
      'notes' => $values['notes'],
      'timestamp' => $booking_info['timestamp'],
    ], FALSE);

    if (FALSE == $result) {
      $form_state->setError($form, $this->t('An error occurred while attempting to update your reservation contact information. @help', [
        '@help' => _aco_core_get_default_help_message(),
      ]));
    }
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    $this->messenger()->addStatus($this->t('Your reservation contact information has been updated.'));
    $form_state->setRedirect('aco_manage_flight.reservation');
  }

}
