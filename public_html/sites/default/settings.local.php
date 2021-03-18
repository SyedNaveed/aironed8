<?php

// @codingStandardsIgnoreFile
const LOCAL_SETTINGS_PATH = DRUPAL_ROOT . '/sites/default';
$settings['hash_salt'] = 'wD0gtBkpoEerSQ3FaV-cVSrN6Ppu_a071mux8nkfzneq-Ay00IsKKy5ZfTkKVHOHPtCDVbGAVw';

$databases['default']['default'] = array (
    'database' => 'aironem',
    'username' => 'aironem',
    'password' => 'aironeM@123',
    'prefix' => '',
    'host' => 'localhost',
    'port' => '3306',
    'namespace' => 'Drupal\\Core\\Database\\Driver\\mysql',
    'driver' => 'mysql',
  );
$settings['config_sync_directory'] = 'sites/default/files/config_9vlkikxo4amlfGmDq-whynlxauiTnHgXnk2ZL3ms8zZLBEQA8BPYu06JQxWmkoLIBDpHIBPDLQ/sync';

#assert_options(ASSERT_ACTIVE, TRUE);
\Drupal\Component\Assertion\Handle::register();

$settings['container_yamls'][] = LOCAL_SETTINGS_PATH . '/localdev.services.yml';
$settings['container_yamls'][] = LOCAL_SETTINGS_PATH . '/services.local.yml';


$config['system.logging']['error_level'] = 'verbose';

$config['system.performance']['css']['preprocess'] = FALSE;
$config['system.performance']['js']['preprocess'] = FALSE;

/* Disable the render cache. */
$settings['cache']['bins']['render'] = 'cache.backend.null';

/* Disable caching for migrations. */
# $settings['cache']['bins']['discovery_migration'] = 'cache.backend.memory';

/* Disable Internal Page Cache. */
$settings['cache']['bins']['page'] = 'cache.backend.null';

/* Disable Dynamic Page Cache. */
$settings['cache']['bins']['dynamic_page_cache'] = 'cache.backend.null';

/* Allow test modules and themes to be installed. */
# $settings['extension_discovery_scan_tests'] = TRUE;

/* Enable access to rebuild.php. */
$settings['rebuild_access'] = TRUE;

/* Skip file system permissions hardening. */
$settings['skip_permissions_hardening'] = TRUE;

/* Exclude modules from configuration synchronization. */
$settings['config_exclude_modules'] = ['devel', 'kint', 'stage_file_proxy'];

// $settings['custom_show_debug_info'] = true;
