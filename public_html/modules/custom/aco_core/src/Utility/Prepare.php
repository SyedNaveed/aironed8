<?php

namespace Drupal\aco_core\Utility;

use Drupal\intelisys\Utility\CommunicationChannels;
use Drupal\intelisys\Utility\TimeHelper;

/**
 * Transform data in preparation for API handling.
 */
class Prepare {

  /**
   * Prepare billing.
   *
   * @param array $values
   *   An array of values to prepare.
   */
  public static function billing(array &$values) {
    $cc = &$values['creditCard'];
    $cc['billing']['contactInformation']['phoneNumber'] = $cc['billing']['phoneNumber'];
    list($cc['expiryYear'], $cc['expiryMonth']) = explode('/', $cc['expiry']);
    $cc['expiryYear'] = substr($cc['expiryYear'], -2);
    $cc['cardHolder'] = $cc['billing']['contactInformation']['name'];
    $cc['shipping'] = $cc['billing'];
    $cc['clientIP'] = \Drupal::request()->getClientIp();
    unset($cc['copyPrimaryPassengerAddress']);
    unset($cc['expiry']);
    unset($cc['billing']['phoneNumber']);
  }

  /**
   * Prepare contact information.
   *
   * @param array $values
   *   An array of values to prepare.
   */
  public static function contactInformation(array &$values) {
    // Format values.
    $values['birthDate'] = TimeHelper::getYmd($values['birthDateYear'], $values['birthDateMonth'], $values['birthDateDay']);

    // Handle Notification Preferences.
    if (isset($values['personalContactInformation']['notificationPreferences'])) {
      $preferences = &$values['personalContactInformation']['notificationPreferences'];
      $checked = array_intersect(array_keys($preferences), array_values($preferences));
      $communication_channels = CommunicationChannels::getCommunicationChannels();
      $values['personalContactInformation']['notificationPreferences'] = [];
      foreach ($communication_channels as $channel) {
        $id = $channel['identifier'];
        if (in_array($id, $checked)) {
          $values['personalContactInformation']['notificationPreferences'][] = $channel;
        }
      }
    }

    // Handle infants.
    $values['infants'] = [];
    if (isset($values['withInfant']) && $values['withInfant']) {
      $values['infant']['birthDate'] = TimeHelper::getYmd($values['infant']['birthDateYear'], $values['infant']['birthDateMonth'], $values['infant']['birthDateDay']);
      unset($values['infant']['birthDateYear']);
      unset($values['infant']['birthDateMonth']);
      unset($values['infant']['birthDateDay']);
      $values['infants'][] = [
        'reservationProfile' => $values['infant'],
      ];
    }

    // Clean up.
    if (isset($values['loyaltyProgram']) && empty($values['loyaltyProgram']['number'])) {
      $values['loyaltyProgram'] = NULL;
    }
    unset($values['birthDateYear']);
    unset($values['birthDateMonth']);
    unset($values['birthDateDay']);
    unset($values['personalContactInformation']['verifyEmail']);
    unset($values['withInfant']);
    unset($values['infant']);
  }

}
