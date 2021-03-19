<?php

namespace Drupal\aco_manage_flight\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Url;
use Drupal\aco_core\Traits\IntelisysTrait;
use Drupal\aco_core\Traits\ReservationTrait;

/**
 * Implements an email itinerary form.
 */
class EmailItineraryForm extends FormBase {
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
    return 'aco_manage_flight_email_itinerary_form';
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $form['#cache'] = ['max-age' => 0];
    $form['emailAddresses'] = [
      '#type' => 'textarea',
      '#title' => $this->t('Recipient Email Addresses'),
      '#title_display' => 'invisible',
      '#placeholder' => $this->t('Recipient Email Addresses'),
      '#description' => $this->t('Multiple email addresses can be separated by ";".'),
      '#required' => TRUE,
    ];

    $form['actions'] = ['#type' => 'actions'];
    $form['actions']['submit'] = [
      '#type' => 'submit',
      '#value' => $this->t('Send Itinerary'),
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
    $result = $this->callEndpoint('postEmailItinerary', [
      'key' => $this->reservation['key'],
      'languageCode' => INTELIYSYS_ENGLISH_LANG_CODE,
      'itineraryTypeCode' => INTELIYSYS_NO_FINANCIAL_ITINERARY,
      'emailAddresses' => $form_state->getValue('emailAddresses'),
    ], FALSE);

    if (FALSE === $result) {
      $form_state->setError($form, $this->t('An error occurred while attempting to email your reservation. @help', [
        '@help' => _aco_core_get_default_help_message(),
      ]));
    }
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    $this->messenger()->addStatus($this->t('Your trip itinerary has been sent.'));
    $form_state->setRedirect('aco_manage_flight.reservation');
  }

}
