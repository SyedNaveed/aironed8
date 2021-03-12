<?php

namespace Drupal\aco_manage_flight\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Url;
use Drupal\aco_core\Traits\IntelisysTrait;
use Drupal\aco_core\Traits\LegsTrait;
use Drupal\aco_core\Traits\ReservationTrait;

/**
 * Implements a select leg form.
 */
class SelectLegForm extends FormBase {
  use IntelisysTrait;
  use ReservationTrait;
  use LegsTrait;

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
    return 'aco_manage_flight_select_leg_form';
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $form['#cache'] = ['max-age' => 0];
    $form['#theme'] = 'form__section_actions';
    $this->getSelectLegForm($form);

    $form['actions'] = ['#type' => 'actions'];
    $form['actions']['button1'] = [
      '#type' => 'link',
      '#title' => $this->t('Cancel Reservation'),
      '#url' => Url::fromRoute('aco_manage_flight.reservation.cancel'),
      '#access' => !$this->canceled && !$this->expired,
    ];
    $form['actions']['button2'] = [
      '#type' => 'submit',
      '#name' => 'edit_leg',
      '#value' => $this->t('Edit Leg'),
    ];
    $form['actions']['button3'] = [
      '#type' => 'submit',
      '#name' => 'add_leg',
      '#value' => $this->t('Add Leg'),
    ];
    $form['actions']['button4'] = [
      '#type' => 'submit',
      '#name' => 'cancel_leg',
      '#value' => $this->t('Cancel Leg'),
    ];

    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function validateForm(array &$form, FormStateInterface $form_state) {
    $leg_index = (int) explode('-', $form_state->getValue('leg_index'))[1];
    $this->getRequest()->getSession()->set('leg_index', $leg_index);
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    switch ($form_state->getTriggeringElement()['#name']) {
      case 'edit_leg':
        $form_state->setRedirect('aco_edit_leg.form_wizard', [
          'step' => 'select',
        ]);
        break;

      case 'add_leg':
        $form_state->setRedirect('aco_add_leg.form_wizard', [
          'step' => 'select',
        ]);
        break;

      case 'cancel_leg':
        $form_state->setRedirect('aco_manage_flight.reservation.legs.cancel');
        break;
    }
  }

}
