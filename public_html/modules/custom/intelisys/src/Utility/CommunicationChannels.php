<?php

namespace Drupal\intelisys\Utility;

use GuzzleHttp\Command\Exception\CommandException;

/**
 * Communication Channels helper class.
 */
class CommunicationChannels {

  /**
   * Get Communication Channels.
   *
   * @return array
   *   The Communication Channels.
   */
  public static function getCommunicationChannels() {
    static $communication_channels;

    if (isset($communication_channels)) {
      return $communication_channels;
    }

    try {
      $intelisys = \Drupal::service('http_client_manager.factory')
        ->get('intelisys_api');
      $communication_channels = $intelisys->getCommunicationChannels()->toArray();
    }
    catch (CommandException $e) {
      return [];
    }

    return $communication_channels;
  }

  /**
   * Get Notification Preferences options.
   *
   * @return array
   *   The Notification Preferences options.
   */
  public static function getNotificationPreferencesOptions() {
    $options = [];
    $communication_channels = self::getCommunicationChannels();
    foreach ($communication_channels as &$communication_channel) {
      $options[$communication_channel['identifier']] = t('@name', [
        '@name' => $communication_channel['name'],
      ]);
    }
    return $options;
  }

}
