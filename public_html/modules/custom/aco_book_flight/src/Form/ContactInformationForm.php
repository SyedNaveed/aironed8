<?php

namespace Drupal\aco_book_flight\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\aco_core\Traits\BookingTrait;
use Drupal\aco_core\Traits\FormBuilderTrait;
use Drupal\aco_core\Traits\IntelisysTrait;
use Drupal\aco_book_flight\Traits\BookFlightTrait;

/**
 * Implements a contact information form.
 */
class ContactInformationForm extends FormBase {
  use BookingTrait;
  use FormBuilderTrait;
  use IntelisysTrait;
  use BookFlightTrait;

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'aco_book_flight_contact_information_form';
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    if (!$this->setup($form, $form_state, 'contact-information')) {
      return $form;
    }

    $form['#tree'] = TRUE;
    $form['#theme'] = 'form__book_flight_contact_information';
    $form['title'] = ['#markup' => $this->t('Contact Information')];

    $this->getMultipleContactInformationForms($form, $this->values);
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

    $infants = 0;
    foreach ($values['passengers'] as $key => &$passenger) {
      // Verify email address fields match (if they exist).
      if (isset($passenger['personalContactInformation']['email']) && $passenger['personalContactInformation']['email'] != $passenger['personalContactInformation']['verifyEmail']) {
        $form_state->setErrorByName('passengers][' . $key . '][personalContactInformation][verifyEmail', $this->t('The email address fields must match.'));
      }

      // Validate loyalty number.
      if (!empty($passenger['loyaltyProgram']['number'])) {
        $ff = $this->callEndpoint('getFrequentFlyers', [
          'loyaltyNumber' => $passenger['loyaltyProgram']['number'],
        ]);

        if (FALSE === $ff || empty($ff)) {
          $form_state->setErrorByName('passengers][' . $key . '][loyaltyProgram][number', $this->t('The loyalty number is not valid.'));
        }
        elseif (strcasecmp($ff[0]['reservationProfile']['lastName'], $passenger['lastName']) != 0
          || strcasecmp($ff[0]['reservationProfile']['firstName'], $passenger['firstName']) != 0
          || strcasecmp($ff[0]['reservationProfile']['personalContactInformation']['email'], $passenger['personalContactInformation']['email']) != 0
        ) {
          $form_state->setErrorByName('passengers][' . $key . '][loyaltyProgram][number', $this->t('The loyalty number does not match the given passenger details.'));
        }
      }

      // Update infant count.
      if ($passenger['withInfant'] &&
        !empty($passenger['infant']['firstName']) &&
        !empty($passenger['infant']['lastName']) &&
        !empty($passenger['infant']['birthDateMonth']) &&
        !empty($passenger['infant']['birthDateDay']) &&
        !empty($passenger['infant']['birthDateYear'])) {
        $infants++;
      }
    }
    $form_state->setValue('infantCount', $infants);
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
  }

}
