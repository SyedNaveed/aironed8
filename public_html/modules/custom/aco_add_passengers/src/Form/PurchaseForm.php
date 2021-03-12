<?php

namespace Drupal\aco_add_passengers\Form;

use Drupal\Core\Form\FormStateInterface;
use Drupal\aco_core\Traits\AddServiceTrait;
use Drupal\aco_core\Traits\BookingTrait;
use Drupal\aco_core\Traits\FormBuilderTrait;
use Drupal\aco_core\Traits\IntelisysTrait;
use Drupal\aco_core\Traits\LegsTrait;
use Drupal\aco_core\Traits\ReservationTrait;
use Drupal\aco_add_passengers\Traits\AddPassengersTrait;

/**
 * Implements a new passengers purchase form.
 */
class PurchaseForm extends AddPassengersFormBase {
  use FormBuilderTrait;
  use IntelisysTrait;
  use ReservationTrait;
  use BookingTrait;
  use AddPassengersTrait;
  use AddServiceTrait;
  use LegsTrait;

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
    return 'aco_add_passengers_purchase_form';
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $this->setup($form, $form_state, 'purchase');
    $this->getChargeTables($form);

    if ($this->total > 0) {
      $this->getPurchaseFields($form, $this->values, FALSE);
    }

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
