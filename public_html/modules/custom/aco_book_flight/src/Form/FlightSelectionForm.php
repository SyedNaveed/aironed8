<?php

namespace Drupal\aco_book_flight\Form;

use Drupal\Core\Ajax\ReplaceCommand;
use Drupal\Core\Form\FormStateInterface;
use Drupal\aco_core\Form\FlightSelectionFormBase;
use Drupal\aco_core\Traits\BookingTrait;
use Drupal\aco_core\Traits\IntelisysTrait;
use Drupal\aco_core\Traits\TempstoreTrait;
use Drupal\aco_book_flight\Traits\BookFlightTrait;

/**
 * Implements a flight selection form.
 */
class FlightSelectionForm extends FlightSelectionFormBase {
  use BookingTrait;
  use IntelisysTrait;
  use TempstoreTrait;
  use BookFlightTrait;

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'aco_book_flight_flight_selection_form';
  }

  /**
   * AJAX callback handler to change a flight date.
   */
  public function dateChange(array $form, FormStateInterface $form_state) {
    $response = parent::dateChange($form, $form_state);

    $renderer = \Drupal::service('renderer');

    // Replace ticket.
    $id = 'your-ticket';
    $ticket = $this->getTicket();
    $ticket = $renderer->renderRoot($ticket);
    $response->addCommand(new ReplaceCommand('#' . $id, $ticket));

    return $response;
  }

  /**
   * The detail link query to use.
   *
   * @return array
   *   The query.
   */
  protected function getDetailLinkQuery() {
    return [
      'cityPair' => $this->values['departure'] . '-' . $this->values['arrival'],
      'departure' => $this->values['from'],
      'return' => ($this->values['isRoundtrip'] && isset($this->values['to'])) ? $this->values['to'] : NULL,
      'adultCount' => $this->values['adultCount'],
      'childCount' => $this->values['childCount'],
      'infantCount' => $this->values['infantCount'],
      'promoCode' => $this->values['promoCode'],
    ];
  }

}
