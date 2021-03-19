<?php

namespace Drupal\aco_add_services\Form;

use Drupal\aco_core\Utility\Defaults;
use Drupal\aco_core\Form\PaymentFormBase;

/**
 * Provides a base class for add leg payment forms.
 */
abstract class AddServicesFormBase extends PaymentFormBase {

  /**
   * Get the quote.
   *
   * @return array|bool
   *   The quote or false on failure.
   */
  public function getQuote() {
    $quotes = [];

    // Quote the refunds.
    if (!empty($this->reservation['ancillaryPurchases']) && !empty($this->values['ancillaryRefunds'])) {
      foreach ($this->reservation['passengers'] as $passenger_index => &$passenger) {
        foreach ($this->reservation['journeys'] as $journey_index => &$journey) {
          foreach ($this->reservation['ancillaryPurchases'] as &$ancillary_purchase) {
            $is_passenger_match = $passenger['key'] == $ancillary_purchase['passenger']['key'];
            $is_journey_match = $journey['key'] == $ancillary_purchase['journey']['key'];
            if ($is_passenger_match && $is_journey_match) {
              // Find the refund.
              foreach ($this->values['ancillaryRefunds'] as &$ancillary_refund) {
                $is_refund_passenger_match = $passenger['key'] == $ancillary_refund['passenger']['key'];
                $is_refund_journey_match = $journey['key'] == $ancillary_refund['journey']['key'];
                $is_item_match = $ancillary_purchase['ancillaryItem']['key'] == $ancillary_refund['itemKey'];
                if ($is_refund_passenger_match && $is_refund_journey_match && $is_item_match) {
                  $quotes[] = $this->callEndpoint('putQuotations', [
                    'httpMethod' => 'DELETE',
                    'requestUri' => "/reservations/{$this->reservation['key']}/ancillaryPurchases/{$ancillary_purchase['key']}",
                    'paymentTransactions' => Defaults::paymentTransactions(),
                  ]);
                }
              }
            }
          }
        }
      }
    }

    // Quote the purchases.
    foreach ($this->values['ancillaryPurchases'] as &$ancillary_purchase) {
      $quotes[] = $this->callEndpoint('putQuotations', [
        'httpMethod' => 'POST',
        'requestUri' => "/reservations/{$this->reservation['key']}/ancillaryPurchases",
        'passengers' => $this->reservation['passengers'],
        'journeys' => $this->reservation['journeys'],
        'ancillaryPurchases' => [$ancillary_purchase],
        'seatSelections' => $this->reservation['seatSelections'],
        'paymentTransactions' => Defaults::paymentTransactions(),
      ]);
    }

    return $quotes;
  }

}
