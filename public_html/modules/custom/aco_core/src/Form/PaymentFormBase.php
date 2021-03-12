<?php

namespace Drupal\aco_core\Form;

use Drupal\Core\Form\FormBase;
use Drupal\aco_core\Utility\Defaults;
use Drupal\aco_core\Utility\Prepare;

/**
 * Provides a base class for payment forms.
 */
abstract class PaymentFormBase extends FormBase {

  /**
   * The subtotal.
   *
   * @var int
   */
  protected $subtotal = 0;

  /**
   * The balance.
   *
   * @var int
   */
  protected $balance = 0;

  /**
   * The total.
   *
   * @var int
   */
  protected $total = 0;

  /**
   * Get the quote.
   *
   * @return array|bool
   *   The quote or false on failure.
   */
  abstract protected function getQuote();

  /**
   * Get payment transactions.
   *
   * @param bool $all_passengers
   *   Add the 'allPassengers' flag.
   *
   * @return array
   *   The payment transactions.
   */
  protected function getPaymentTransactions($all_passengers = TRUE) {
    $transactions = Defaults::paymentTransactions($all_passengers);

    // Update payment method. The 'visa' option is ignored since it is the
    // default payment method.
    $payment_method = $this->values['paymentMethod']['identifier'];
    switch ($payment_method) {
      case 'amex':
      case 'discover':
      case 'mastercard':
        $transactions[0]['paymentMethod'] = Defaults::$payment_method();
        break;
    }

    // Update total and get payment criteria.
    $quote = $this->getQuote();
    $total_cost = $quote['paymentTransactions'][0]['currencyAmounts'][0]['totalAmount'];
    $transactions[0]['currencyAmounts'][0]['totalAmount'] = $total_cost;
    $transactions[0]['paymentMethodCriteria'] = $this->values['billing'];
    Prepare::billing($transactions[0]['paymentMethodCriteria']);

    // This portion is only required if processing fees apply. If processing
    // fees apply, they will be returned via PUT Quotations.
    if (isset($quote['processingCurrencyAmounts'])) {
      $transactions[0]['processingCurrencyAmounts'] = $quote['processingCurrencyAmounts'];
    }

    return $transactions;
  }

}
