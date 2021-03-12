#!/bin/bash

# Copy environment variables to .env file.
echo -e "INTELISYS_BASIC_AUTH_USERNAME=$INTELISYS_BASIC_AUTH_USERNAME\nINTELISYS_BASIC_AUTH_PASSWORD=$INTELISYS_BASIC_AUTH_PASSWORD" >> .env

# Install Composer dependencies (including dev).
composer -n install --prefer-dist --no-progress --no-suggest --ansi
export PATH="$BITBUCKET_CLONE_DIR/bin:$PATH"

# Set variables.
DRUSH="drush -y -r $BITBUCKET_CLONE_DIR/$DOCROOT"

echo "Installing Drupal 8."

echo " - Copy Drupal settings into place."
chmod 755 "$BITBUCKET_CLONE_DIR/$DOCROOT/sites/default/"
cp scripts/ci/settings.local.php "$BITBUCKET_CLONE_DIR/$DOCROOT/sites/default/"
chmod 555 "$BITBUCKET_CLONE_DIR/$DOCROOT/sites/default/"

echo " - Granting write permission to all configuration and site files."
chmod -R +w "$BITBUCKET_CLONE_DIR/$DOCROOT/sites/default"
chmod -R +w "$BITBUCKET_CLONE_DIR/config"

echo " - Downloading seed database backup."
scp -P $SSH_PORT $SSH_URL:dump.sql.gz ./

echo " - Clear drush cache."
$DRUSH cache-clear drush

echo " - Dropping existing database (if one exists)."
$DRUSH sql-drop

echo " - Importing seed database."
gunzip < dump.sql.gz | $DRUSH sql-cli

echo " - Sanitizing seed database."
$DRUSH sql-sanitize --sanitize-password=password --sanitize-email=no

echo " - Check status."
$DRUSH status

echo " - Clearing cache."
$DRUSH cache-rebuild

echo " - Updating database."
$DRUSH updatedb

echo " - Clearing cache."
$DRUSH cache-rebuild

echo " - Importing configuration."
drush config:import --preview -n -r $DOCROOT
$DRUSH config:import

echo " - Uninstall antibot module."
$DRUSH pm-uninstall antibot

echo " - Clearing cache."
$DRUSH cache-rebuild

if [ -f dump.sql.gz ]; then
  echo " - Cleaning up."
  rm dump.sql.gz
fi

echo "Finished."
