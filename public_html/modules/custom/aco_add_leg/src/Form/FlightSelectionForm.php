<?php

namespace Drupal\aco_add_leg\Form;

use Drupal\aco_core\Form\FlightSelectionFormBase;
use Drupal\aco_core\Traits\AddServiceTrait;
use Drupal\aco_core\Traits\IntelisysTrait;
use Drupal\aco_core\Traits\ReservationTrait;
use Drupal\aco_core\Traits\TempstoreTrait;
use Drupal\aco_add_leg\Traits\AddLegTrait;

/**
 * Implements a flight selection form.
 */
class FlightSelectionForm extends FlightSelectionFormBase {
  use AddServiceTrait;
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
    return 'aco_add_leg_flight_selection_form';
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
    ];
  }

}
