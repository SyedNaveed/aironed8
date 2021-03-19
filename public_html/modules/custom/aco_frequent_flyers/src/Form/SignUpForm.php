<?php

namespace Drupal\aco_frequent_flyers\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\aco_core\Traits\IntelisysTrait;
use Drupal\aco_core\Traits\FormBuilderTrait;
use Drupal\aco_core\Utility\Prepare;

/**
 * Implements a frequent flyer sign-up form.
 */
class SignUpForm extends FormBase {
  use IntelisysTrait;
  use FormBuilderTrait;

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'aco_frequent_flyers_sign_up_form';
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    // Don't cache this form.
    $form['#cache'] = ['max-age' => 0];

    if ($ff_number = $form_state->get('ff_number')) {
      $form['description'] = [
        '#markup' => $this->t('<p>Thank You for signing up!</p><p>Your Loyalty number ID is: @ff_number</p><p>You currently have @ff_points loyalty points accumulated.</p><p>Please save this number for your records.</p>', [
          '@ff_number' => $ff_number,
          '@ff_points' => $form_state->get('ff_points'),
        ]),
      ];
      return $form;
    }

    $form['userLogonName'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Username'),
      '#title_display' => 'invisible',
      '#placeholder' => $this->t('Username *'),
      '#required' => TRUE,
      '#size' => 50,
    ];
    $form['password'] = [
      '#type' => 'password',
      '#title' => $this->t('Password'),
      '#title_display' => 'invisible',
      '#placeholder' => $this->t('Password *'),
      '#required' => TRUE,
      '#size' => 24,
    ];
    $form['reservationProfile'] = ['#tree' => TRUE];
    $this->getContactInformationForm($form['reservationProfile']);
    unset($form['reservationProfile']['withInfant']);
    unset($form['reservationProfile']['infant']);
    unset($form['reservationProfile']['loyaltyProgram']);
    unset($form['reservationProfile']['personalContactInformation']['mobileNumber']);
    $form['reservationProfile']['gender'] = [
      '#type' => 'select',
      '#title' => $this->t('Gender'),
      '#title_display' => 'invisible',
      '#required' => TRUE,
      '#options' => [
        'Male' => $this->t('Male'),
        'Female' => $this->t('Female'),
      ],
      '#empty_option' => $this->t('Gender *'),
    ];

    $form['actions'] = ['#type' => 'actions'];
    $form['actions']['submit'] = [
      '#type' => 'submit',
      '#value' => $this->t('Sign Up'),
    ];

    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function validateForm(array &$form, FormStateInterface $form_state) {
    $values = $form_state->cleanValues()->getValues();

    // Verify email address fields match (if they exist).
    if (isset($values['reservationProfile']['personalContactInformation']['email']) && $values['reservationProfile']['personalContactInformation']['email'] != $values['reservationProfile']['personalContactInformation']['verifyEmail']) {
      $form_state->setErrorByName('reservationProfile][personalContactInformation][verifyEmail', $this->t('The email address fields must match.'));
      return;
    }

    // Sign up the user.
    Prepare::contactInformation($values['reservationProfile']);
    $ff = $this->callEndpoint('postFrequentFlyers', $values);

    // Check the result.
    if (FALSE === $ff || empty($ff)) {
      $form_state->setError($form, $this->t('An error occurred. @help', [
        '@help' => _aco_core_get_default_help_message(),
      ]));
    }
    else {
      $form_state->set('ff_number', $ff['loyaltyAccount']['number']);
      $form_state->set('ff_points', $ff['loyaltyAccount']['pointsAccumulated']);

      // Send an email to the user.
      $params = [];
      $params['ff_number'] = $ff['loyaltyAccount']['number'];
      $params['ff_points'] = $ff['loyaltyAccount']['pointsAccumulated'];
      \Drupal::service('plugin.manager.mail')->mail(
        'aco_frequent_flyers',
        'frequent_flyer_sign_up',
        $ff['reservationProfile']['personalContactInformation']['email'],
        \Drupal::languageManager()->getDefaultLanguage(),
        $params,
        'customerservice@airchoiceone.com'
      );
    }
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    $form_state->setRebuild();
  }

}
