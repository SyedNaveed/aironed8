<?php

namespace Drupal\aco_manage_flight\Wizard;

use Drupal\ctools\Wizard\FormWizardBase;

/**
 * A manage flight form wizard.
 */
class ManageFlightWizard extends FormWizardBase {

  /**
   * {@inheritdoc}
   */
  public function getWizardLabel() {
    return $this->t('Manage Flight');
  }

  /**
   * {@inheritdoc}
   */
  public function getMachineLabel() {
    return $this->t('Manage Flight');
  }

  /**
   * {@inheritdoc}
   */
  public function getOperations($cached_values) {
    return [
      'find' => [
        'form' => 'Drupal\aco_manage_flight\Form\FindYourFlightForm',
      ],
      'select' => [
        'form' => 'Drupal\aco_manage_flight\Form\SelectReservationForm',
      ],
    ];
  }

  /**
   * {@inheritdoc}
   */
  public function getRouteName() {
    return 'aco_manage_flight.manage_flight.step';
  }

}
