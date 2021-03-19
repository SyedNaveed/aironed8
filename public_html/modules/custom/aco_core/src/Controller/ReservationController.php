<?php

namespace Drupal\aco_core\Controller;

use Drupal\Core\Controller\ControllerBase;
use Drupal\Core\Template\Attribute;
use Drupal\aco_core\Traits\IntelisysTrait;
use Drupal\aco_core\Traits\ReservationTrait;

/**
 * A reservation controller.
 */
class ReservationController extends ControllerBase {
  use IntelisysTrait;
  use ReservationTrait;

  /**
   * Returns a render-able array.
   */
  public function build() {
    if (FALSE === $this->reservation) {
      return [
        '#cache' => ['max-age' => 0],
        '#theme' => 'manage_reservation',
        '#sections' => [
          [
            'attributes' => new Attribute(),
            'content' => [
              '#markup' => $this->t('<p>There was an error retrieving your reservation. Please try again.</p>'),
            ],
          ],
        ],
      ];
    }
  }

}
