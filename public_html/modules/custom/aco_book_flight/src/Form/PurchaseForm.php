<?php

namespace Drupal\aco_book_flight\Form;

use Drupal\Core\Form\FormStateInterface;
use Drupal\aco_core\Traits\BookingTrait;
use Drupal\aco_core\Traits\FormBuilderTrait;
use Drupal\aco_core\Traits\IntelisysTrait;
use Drupal\aco_core\Traits\ItineraryTrait;
use Drupal\aco_book_flight\Traits\BookFlightTrait;

/**
 * Implements a purchase form.
 */
class PurchaseForm extends BookingFormBase {
  use BookingTrait;
  use FormBuilderTrait;
  use IntelisysTrait;
  use ItineraryTrait;
  use BookFlightTrait;

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'aco_book_flight_purchase_form';
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    if (!$this->setup($form, $form_state, 'purchase')) {
      return $form;
    }

    $form['#theme'] = 'form__book_flight_purchase';
    $form['title'] = ['#markup' => $this->t('Submit Payment Information')];
    $form['subtitle'] = [
      '#markup' => $this->t('<span>Departure date:</span> @date', [
        '@date' => $this->values['from'],
      ]),
    ];

    // Get the quote.
    $quote = $this->getQuote();
    if (FALSE === $quote) {
      return $form;
    }

    $form['charges_table'] = $this->getChargeSummary($quote['charges']);

    // Create billing fields.
    $this->getPurchaseFields($form, $this->values);
  
    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function validateForm(array &$form, FormStateInterface $form_state) {
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
  }

}
