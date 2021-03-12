<?php

namespace Drupal\aco_edit_leg\Form;

use Drupal\Core\Form\FormStateInterface;
use Drupal\aco_core\Traits\AddServiceTrait;
use Drupal\aco_core\Traits\BookingTrait;
use Drupal\aco_core\Traits\FormBuilderTrait;
use Drupal\aco_core\Traits\IntelisysTrait;
use Drupal\aco_core\Traits\ReservationTrait;
use Drupal\aco_edit_leg\Traits\EditLegTrait;

/**
 * Implements a new leg purchase form.
 */
class PurchaseForm extends EditLegFormBase {
  use BookingTrait;
  use FormBuilderTrait;
  use IntelisysTrait;
  use ReservationTrait;
  use EditLegTrait;
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
    return 'aco_edit_leg_purchase_form';
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
