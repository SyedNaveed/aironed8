<?php

namespace Drupal\airchoice_member\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Class FindFlightForm.
 */
class FindFlightForm extends FormBase {

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'find_flight_form';
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {

    $params = [];
    $params['subject'] = $this->t('Thanks to registered on Air one Choice ');
    $params['body'] = [$this->t("Hello world")];

    customMailSend('idevmoin@gmail.com','test', $params);

    exit;

    $form['#theme'] = 'find-a-flight-dashboard-form';

    

    $form['city_of_origin'] = [
      '#type' => 'textfield',
      '#title' => $this->t('City of Origin'),
      '#maxlength' => 64,
      '#size' => 64,
      '#weight' => '0',
    ];
    $form['destination_city'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Destination City'),
      '#maxlength' => 64,
      '#size' => 64,
      '#weight' => '0',
    ];
    
    $form['departure_date'] = [
      '#type' => 'date',
      '#title' => $this->t('Departure Date'),
      '#maxlength' => 64,
      '#size' => 64,
      '#weight' => '0',
    ];
    
    $form['return_date'] = [
      '#type' => 'date',
      '#title' => $this->t('Return Date'),
      '#maxlength' => 64,
      '#size' => 64,
      '#weight' => '0',
    ];
    
    $form['passengers'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Passengers'),
      '#maxlength' => 64,
      '#size' => 64,
      '#weight' => '0',
    ];

    $form['children'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Children'),
      '#maxlength' => 64,
      '#size' => 64,
      '#weight' => '0',
    ];
  
    $form['infant'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Infant'),
      '#maxlength' => 64,
      '#size' => 64,
      '#weight' => '0',
    ];

    $form['round_trip'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Round Trip'),
      '#maxlength' => 64,
      '#size' => 64,
      '#weight' => '0',
    ];

    $form['promo_code'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Promo Code'),
      '#maxlength' => 64,
      '#size' => 64,
      '#weight' => '0',
    ];
    $form['submit'] = [
      '#type' => 'submit',
      '#value' => $this->t('Find Your Flight'),
    ];
    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function validateForm(array &$form, FormStateInterface $form_state) {
    foreach ($form_state->getValues() as $key => $value) {
      // @TODO: Validate fields.
    }
    parent::validateForm($form, $form_state);
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    // Display result.
    foreach ($form_state->getValues() as $key => $value) {
      \Drupal::messenger()->addMessage($key . ': ' . ($key === 'text_format'?$value['value']:$value));
    }
  }

}
