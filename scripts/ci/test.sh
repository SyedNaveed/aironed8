#!/bin/bash

set -eu

# Install PHP CodeSniffer.
composer global require drupal/coder
export PATH="$PATH:$HOME/.composer/vendor/bin"
composer global require "squizlabs/php_codesniffer=*"

# Register the Drupal and DrupalPractice Standards.
phpcs --config-set installed_paths "$HOME/.composer/vendor/drupal/coder/coder_sniffer"
phpcs -i

# Run PHP CodeSniffer.
phpcs --standard=Drupal --extensions=php,module,inc,install,test,profile,theme,info,txt,md --ignore=node_modules,bower_components,vendor "$BITBUCKET_CLONE_DIR/$DOCROOT/modules/custom" "$BITBUCKET_CLONE_DIR/$DOCROOT/themes/custom"

# Run Behat tests.
php bin/behat
