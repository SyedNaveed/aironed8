<?php

namespace Drupal\aco_core\Utility;

/**
 * The site environment.
 */
class Environment {

  /**
   * Helper function to retrieve the live environment status of the site.
   *
   * @return bool
   *   Whether the site is live or not.
   */
  public static function isSiteLive() {
    global $config;

    // Check if site is live.
    if (isset($config['config_split.config_split.live'])
        && isset($config['config_split.config_split.live']['status'])
        && $config['config_split.config_split.live']['status']
      ) {
      return TRUE;
    }

    return FALSE;
  }

}
