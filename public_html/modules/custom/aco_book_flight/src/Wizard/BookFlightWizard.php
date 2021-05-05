<?php

namespace Drupal\aco_book_flight\Wizard;

use Drupal\Core\Form\FormStateInterface;
use Drupal\ctools\Wizard\FormWizardBase;
use Drupal\aco_core\Traits\FormWizardTrait;

/**
 * A book flight form wizard.
 */
class BookFlightWizard extends FormWizardBase {
  use FormWizardTrait;

  /**
   * {@inheritdoc}
   */
  public function getWizardLabel() {
    return $this->t('Book Flight');
  }

  /**
   * {@inheritdoc}
   */
  public function getMachineLabel() {
    return $this->t('Book Flight');
  }

  /**
   * {@inheritdoc}
   */
  public function getOperations($cached_values) {
    return [
      'search' => [
        'form' => 'Drupal\aco_book_flight\Form\SearchForm',
        'submit' => ['::stepSubmit'],
      ],
      'flight-selection' => [
        'form' => 'Drupal\aco_book_flight\Form\FlightSelectionForm',
        'submit' => ['::stepSubmit'],
      ],
      'contact-information' => [
        'form' => 'Drupal\aco_book_flight\Form\ContactInformationForm',
        'submit' => ['::stepSubmit'],
      ],
      'seat-selection' => [
        'form' => 'Drupal\aco_book_flight\Form\SeatSelectionForm',
        'submit' => ['::stepSubmit'],
      ],
      'additional-services' => [
        'form' => 'Drupal\aco_book_flight\Form\AdditionalServicesForm',
        'submit' => ['::stepSubmit'],
      ],
      'purchase' => [
        'form' => 'Drupal\aco_book_flight\Form\PurchaseForm',
        'submit' => ['::stepSubmit'],
      ],
      'confirm' => [
        'form' => 'Drupal\aco_book_flight\Form\ConfirmForm',
      ],
    ];
  }

  /**
   * {@inheritdoc}
   */
  public function getRouteName() {
    return 'aco_book_flight.book_flight.step';
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $form = parent::buildForm($form, $form_state);
    $cached_values = $form_state->getTemporaryValue('wizard');
    // Get the current form operation.
    $operation = $this->getOperation($cached_values);
    $formClass = $this->classResolver->getInstanceFromDefinition($operation['form']);
    if (method_exists($formClass, 'buildFormActions')) {
      $form = $formClass->buildFormActions($form, $form_state);
    }
    if($operation['form'] == 'Drupal\aco_book_flight\Form\SearchForm');
    {
      $url = \Drupal\Core\Url::fromRoute("airchoice_member.dashboard_controller_index");
      return new \Symfony\Component\HttpFoundation\RedirectResponse($url->toString(), 302);
    }
    return $form;
  }

}
