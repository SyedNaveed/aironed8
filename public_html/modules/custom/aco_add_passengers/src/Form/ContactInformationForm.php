<?php

namespace Drupal\aco_add_passengers\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\aco_core\Traits\AddServiceTrait;
use Drupal\aco_core\Traits\FormBuilderTrait;
use Drupal\aco_core\Traits\IntelisysTrait;
use Drupal\aco_core\Traits\ReservationTrait;
use Drupal\aco_add_passengers\Traits\AddPassengersTrait;

/**
 * Implements an edit new passenger(s) form.
 */
class ContactInformationForm extends FormBase {
  use IntelisysTrait;
  use ReservationTrait;
  use FormBuilderTrait;
  use AddPassengersTrait;
  use AddServiceTrait;

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
    return 'aco_add_passengers_contact_information_form';
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $this->setup($form, $form_state, 'contact-information');

    $form['#tree'] = TRUE;
    $form['description'] = [
      '#type' => 'container',
      '#markup' => $this->t('<p>Please fill all the information in English. Fields marked with * are mandatory.</p>'),
    ];

    $this->getMultipleContactInformationForms($form, $this->values, FALSE);

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
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
  }

}
