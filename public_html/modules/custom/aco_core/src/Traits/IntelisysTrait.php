<?php

namespace Drupal\aco_core\Traits;

use Drupal\Component\Serialization\Json;
use Drupal\aco_core\Utility\Environment;
use GuzzleHttp\Command\Exception\CommandException;
use GuzzleHttp\Command\Exception\CommandServerException;

/**
 * An Intelisys trait.
 */
trait IntelisysTrait {

  /**
   * Fetch Intelisys API endpoint.
   *
   * @param string $command
   *   The command to call.
   * @param array $args
   *   The arguments to pass to the command.
   * @param bool $return
   *   Whether a return array is expected or not.
   *
   * @return array|bool
   *   The result or false on failure.
   */
  protected function callEndpoint($command, array $args = [], $return = TRUE) {
    try {
      $intelisys = \Drupal::service('http_client_manager.factory')
        ->get('intelisys_api');

      if ($return) {
        return $intelisys->call($command, $args)->toArray();
      }
      else {
        $intelisys->call($command, $args);
        return TRUE;
      }
    }
    catch (CommandServerException $e) {
      if (!Environment::isSiteLive() && !empty($e->getMessage())) {
        $this->messenger()->addError($e->getMessage());
      }
    }
    catch (CommandException $e) {
      $has_api_response_message = FALSE;
      if ($response = $e->getResponse()) {
        $body = $response->getBody()->getContents();
        $json = Json::decode($body);
        if ($json !== NULL && isset($json['message'])) {
          $has_api_response_message = TRUE;
          $this->messenger()->addError($json['message']);
        }
        elseif (!empty($body)) {
          $has_api_response_message = TRUE;
          $this->messenger()->addError(trim($body, '"'));
        }
      }
      if (!$has_api_response_message && !empty($e->getMessage())) {
        $this->messenger()->addError($e->getMessage());
      }
    }

    return FALSE;
  }

}
