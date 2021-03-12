<?php

namespace Drupal\aco_edit_leg\Wizard;

use Drupal\ctools\Wizard\FormWizardBase;
use Drupal\aco_core\Traits\FormWizardTrait;

/**
 * An edit leg form wizard.
 */
class EditLegWizard extends FormWizardBase {
  use FormWizardTrait;

  /**
   * {@inheritdoc}
   */
  public function getWizardLabel() {
    return $this->t('Edit Leg');
  }

  /**
   * {@inheritdoc}
   */
  public function getMachineLabel() {
    return $this->t('Edit Leg');
  }

  /**
   * {@inheritdoc}
   */
  public function getOperations($cached_values) {
    return [
      'select' => [
        'form' => 'Drupal\aco_edit_leg\Form\SelectForm',
        'submit' => ['::stepSubmit'],
      ],
      'flight-selection' => [
        'form' => 'Drupal\aco_edit_leg\Form\FlightSelectionForm',
        'submit' => ['::stepSubmit'],
      ],
      'additional-services' => [
        'form' => 'Drupal\aco_edit_leg\Form\AdditionalServicesForm',
        'submit' => ['::stepSubmit'],
      ],
      'purchase' => [
        'form' => 'Drupal\aco_edit_leg\Form\PurchaseForm',
        'submit' => ['::stepSubmit'],
      ],
      'confirm' => [
        'form' => 'Drupal\aco_edit_leg\Form\ConfirmForm',
      ],
    ];
  }

  /**
   * {@inheritdoc}
   */
  public function getRouteName() {
    return 'aco_edit_leg.form_wizard';
  }

}
