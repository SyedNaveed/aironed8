<?php

namespace Drupal\aco_add_leg\Wizard;

use Drupal\ctools\Wizard\FormWizardBase;
use Drupal\aco_core\Traits\FormWizardTrait;

/**
 * An add leg form wizard.
 */
class AddLegWizard extends FormWizardBase {
  use FormWizardTrait;

  /**
   * {@inheritdoc}
   */
  public function getWizardLabel() {
    return $this->t('Add Leg');
  }

  /**
   * {@inheritdoc}
   */
  public function getMachineLabel() {
    return $this->t('Add Leg');
  }

  /**
   * {@inheritdoc}
   */
  public function getOperations($cached_values) {
    return [
      'select' => [
        'form' => 'Drupal\aco_add_leg\Form\SelectForm',
        'submit' => ['::stepSubmit'],
      ],
      'flight-selection' => [
        'form' => 'Drupal\aco_add_leg\Form\FlightSelectionForm',
        'submit' => ['::stepSubmit'],
      ],
      'additional-services' => [
        'form' => 'Drupal\aco_add_leg\Form\AdditionalServicesForm',
        'submit' => ['::stepSubmit'],
      ],
      'purchase' => [
        'form' => 'Drupal\aco_add_leg\Form\PurchaseForm',
        'submit' => ['::stepSubmit'],
      ],
      'confirm' => [
        'form' => 'Drupal\aco_add_leg\Form\ConfirmForm',
      ],
    ];
  }

  /**
   * {@inheritdoc}
   */
  public function getRouteName() {
    return 'aco_add_leg.form_wizard';
  }

}
