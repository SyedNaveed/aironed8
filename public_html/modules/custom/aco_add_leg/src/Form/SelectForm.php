<?php

namespace Drupal\aco_add_leg\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\aco_core\Traits\AddServiceTrait;
use Drupal\aco_core\Traits\FormBuilderTrait;
use Drupal\aco_core\Traits\IntelisysTrait;
use Drupal\aco_core\Traits\ReservationTrait;
use Drupal\aco_core\Traits\TempstoreTrait;
use Drupal\aco_add_leg\Traits\AddLegTrait;

/**
 * Implements a select new leg select form.
 */
class SelectForm extends FormBase {
  use AddServiceTrait;
  use FormBuilderTrait;
  use IntelisysTrait;
  use ReservationTrait;
  use TempstoreTrait;
  use AddLegTrait;

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
    return 'aco_add_leg_select_form';
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $this->setup($form, $form_state, 'select');
    $this->getBookingFields($form, $form_state, $this->values);
    unset($form['from']['#ajax']);
    unset($form['to']);
    unset($form['adultCount']);
    unset($form['childCount']);
    unset($form['infantCount']);
    unset($form['promoCode']);
    unset($form['isRoundtrip']);
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

    $values = $form_state->getValues();
    $this->values['departure'] = $values['departure'];
    $this->values['arrival'] = $values['arrival'];
    $this->values['from'] = $values['from'];
    $travel_options = $this->getTravelOptions();

    if (FALSE === $travel_options) {
      $form_state->setError($form, $this->t('An error occurred while retrieving your travel options. @help', [
        '@help' => _aco_core_get_default_help_message(),
      ]));
    }
    // Prevent the next step if there are no available travel options.
    elseif (empty($travel_options)) {
      $form_state->setError($form, $this->t('Sorry, there are no available flights for your search criteria. Please try again.'));
    }
    else {
      // Clear cached values on a new search.
      $form_state->setTemporaryValue('wizard', []);
      $this->clearTempstore();
    }
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
  }

}
