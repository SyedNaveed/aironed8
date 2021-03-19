<?php

namespace Drupal\aco_add_passengers\Wizard;

use Drupal\ctools\Wizard\FormWizardBase;
use Drupal\aco_core\Traits\FormWizardTrait;

/**
 * An add passenger(s) form wizard.
 */
class AddPassengersWizard extends FormWizardBase {
  use FormWizardTrait;

  /**
   * {@inheritdoc}
   */
  public function getWizardLabel() {
    return $this->t('Add Passenger(s)');
  }

  /**
   * {@inheritdoc}
   */
  public function getMachineLabel() {
    return $this->t('Add Passenger(s)');
  }

  /**
   * {@inheritdoc}
   */
  public function getOperations($cached_values) {
    return [
      'select' => [
        'form' => 'Drupal\aco_add_passengers\Form\SelectForm',
        'submit' => ['::stepSubmit'],
      ],
      'contact-information' => [
        'form' => 'Drupal\aco_add_passengers\Form\ContactInformationForm',
        'submit' => ['::stepSubmit'],
      ],
      'additional-services' => [
        'form' => 'Drupal\aco_add_passengers\Form\AdditionalServicesForm',
        'submit' => ['::stepSubmit'],
      ],
      'purchase' => [
        'form' => 'Drupal\aco_add_passengers\Form\PurchaseForm',
        'submit' => ['::stepSubmit'],
      ],
      'confirm' => [
        'form' => 'Drupal\aco_add_passengers\Form\ConfirmForm',
      ],
    ];
  }

  /**
   * {@inheritdoc}
   */
  public function getRouteName() {
    return 'aco_add_passengers.form_wizard';
  }

}
