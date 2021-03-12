#!/usr/bin/php
<?php

/**
 * @file
 * A Git pre-commit hook script to check files for PHP syntax errors and Drupal
 * coding standards violations. Requires phpcs and Coder Sniffer:
 *
 * @see https://drupal.org/node/1419988
 * Hat tip: dcq.module (DrupalCodeQuality)
 *
 * @see https://gist.github.com/jpoesen/9737010
 *
 * Usage:
 *  1. Put this file in /yourproject/.git/hooks/
 *  2. Ensure this file is executable (chmod a+x pre-commit)
 *  3. Commit code
 */

// Paths to test.
$file_paths = array(
  'public_html/modules/custom/',
  'public_html/themes/custom/',
);

// Extensions of files to test.
$file_exts = array(
  'php',
  'module',
  'inc',
  'install',
  'test',
  'profile',
  'theme',
  # 'css',
  'info',
  'txt',
  'md',
);

$exit_code = 0;
$files = array();
$return = 0;

// Determine whether this is the first commit or not. If it is, set $against to
// the hash of a magical, empty commit to compare to.
exec('git rev-parse --verify HEAD 2> /dev/null', $files, $return);
$against = ($return == 0) ? 'HEAD' : '4b825dc642cb6eb9a060e54bf8d69288fbee4904';

// Identify changed files.
exec("git diff-index --cached --name-only $against", $files);

$docroot = __DIR__ . '/../../';

foreach ($files as $file) {
  if (file_exists($file) && !is_dir($file)) {
    // Check file extension.
    $ext = pathinfo($file, PATHINFO_EXTENSION);
    if (!in_array($ext, $file_exts)) {
      continue;
    }

    // Get file path.
    $file = escapeshellarg($file);
    $dir = str_replace('\'', '', dirname($file));
    $extra = '';
    if ($dir !== '.') {
      $extra = $dir . '/';
    }

    // Check path.
    $found = FALSE;
    foreach ($file_paths as $path) {
      if (substr($extra, 0, strlen($path)) == $path) {
        $found = TRUE;
      }
    }

    if (!$found) {
      continue;
    }

    echo "\033[0;32mChecking file {$file}\033[0m\n";

    $phpcs_output = array();

    // Run PHP lint check.
    $return = 0;
    $lint_cmd = 'cd ' . $docroot . " && php -l {$file}";
    $lint_output = array();
    exec($lint_cmd, $lint_output, $return);
    if ($return !== 0) {
      echo "\033[31mLinting Error:\033[0m";
      echo implode("\n", $lint_output), "\n";
      $exit_code = 1;
      continue;
    }

    // Run phpcs.
    $return = 0;
    $file_extensions = implode($file_exts, ',');
    $phpcs_cmd = 'cd ' . $docroot
                 . ' && phpcs --standard=Drupal --extensions='
                 . $file_extensions . ' ' . $file;
    exec($phpcs_cmd, $phpcs_output, $return);
    if ($return !== 0) {
      echo "\033[31mPHP CodeSniffer Error:\033[0m";
      echo implode("\n", $phpcs_output), "\n";
      echo 'Run: phpcbf --standard=Drupal ' . $file . "\n";
      $exit_code = 1;
    }
  }
}

exit($exit_code);
