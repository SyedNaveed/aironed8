<?php

$settings['hash_salt'] = 'PMmGlFvTw9TpRdEIwhgjbqg32PsTp6GFOrqvHJWw1CiWcn6gn6OUG7mwd2005VZ';
$databases['default']['default'] = array(
  'database' => 'pipelines',
  'username' => 'test_user',
  'password' => 'test_user_password',
  'host' => '127.0.0.1',
  'port' => '3306',
  'namespace' => 'Drupal\\Core\\Database\\Driver\\mysql',
  'driver' => 'mysql',
);
$settings['trusted_host_patterns'] = array(
  '^airchoiceone\.lndo\.site$',
  '^www\.airchoiceone\.lndo\.site$',
);

// Use Production configuration.
$config['config_split.config_split.development']['status'] = FALSE;
$config['config_split.config_split.production']['status'] = TRUE;

// Enable error logging.
$config['system.logging']['error_level'] = 'all';

// Disable Google Analytics.
$config['google_analytics.settings']['account'] = 'UA-XXXXXXXX-Y';

$settings['http_services_api']['intelisys_api']['config']['auth'] = [
  getenv('INTELISYS_BASIC_AUTH_USERNAME'),
  getenv('INTELISYS_BASIC_AUTH_PASSWORD'),
  'Basic'
];
