<?php

namespace Drupal\aco_add_services\Wizard;

use Drupal\ctools\Wizard\FormWizardBase;
use Drupal\aco_core\Traits\FormWizardTrait;

/**
 * An add services form wizard.
 */
class AddServicesWizard extends FormWizardBase {
  use FormWizardTrait;

  /**
   * {@inheritdoc}
   */
  public function getWizardLabel() {
    return $this->t('Additional Services & Items');
  }

  /**
   * {@inheritdoc}
   */
  public function getMachineLabel() {
    return $this->t('Additional Services & Items');
  }

  /**
   * {@inheritdoc}
   */
  public function getOperations($cached_values) {
    return [
      'select' => [
        'form' => 'Drupal\aco_add_services\Form\SelectForm',
        'submit' => ['::stepSubmit'],
      ],
      'purchase' => [
        'form' => 'Drupal\aco_add_services\Form\PurchaseForm',
        'submit' => ['::stepSubmit'],
      ],
      'confirm' => [
        'form' => 'Drupal\aco_add_services\Form\ConfirmForm',
      ],
    ];
  }

  /**
   * {@inheritdoc}
   */
  public function getRouteName() {
    return 'aco_add_services.form_wizard';
  }

}
