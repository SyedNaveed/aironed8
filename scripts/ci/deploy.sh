#!/bin/bash

set -eu

# Set variables.
DIST_DIR="$BITBUCKET_CLONE_DIR/dist"
SITE_PATH=''
CLONE_URL=''
SHA=$(git rev-parse HEAD)
GIT_MESSAGE="Deploying ${SHA}: $(git log -1 --pretty=%B)"

if [ -n "$BITBUCKET_BRANCH" ]; then
  case "$BITBUCKET_BRANCH" in

    master)
      SITE_PATH="${PRODUCTION_SITE_PATH}"
      CLONE_URL="ssh://${SSH_URL}:${SSH_PORT}${PRODUCTION_SITE_PATH}repository.git"
      ;;

    release/*)
      SITE_PATH="${STAGING_SITE_PATH}"
      CLONE_URL="ssh://${SSH_URL}:${SSH_PORT}${STAGING_SITE_PATH}repository.git"
      ;;

    dev)
      SITE_PATH="${DEV_SITE_PATH}"
      CLONE_URL="ssh://${SSH_URL}:${SSH_PORT}${DEV_SITE_PATH}repository.git"
      ;;

    *)
      echo "A matching Git URL environment variable could not be found. Unable to clone repository."
      exit 1
      ;;

  esac
fi

# Run 'composer install' without dev dependencies.
composer nuke
composer -n install --no-dev --optimize-autoloader --prefer-dist --no-progress --no-suggest --ansi

# Clone deployment artifact repository.
mkdir -p "$DIST_DIR"
git clone "$CLONE_URL" "$DIST_DIR"

# Clean up deployment artifact.
find "$DOCROOT" -name .git -print0 | xargs -0 rm -rf
find vendor -name .git -print0 | xargs -0 rm -rf
find vendor -name .gitignore -print0 | xargs -0 rm -rf
rm -f "$DOCROOT/sites/default/settings.local.php"
rm -f "$DOCROOT/sites/default/services.local.yml"
rm -rf "$DOCROOT/sites/default/files"

# Clear out deployment repository.
rm -rf "$DIST_DIR/$DOCROOT"
rm -rf "$DIST_DIR/config"
rm -rf "$DIST_DIR/vendor"
rm -rf "$DIST_DIR/bin"

# Add deployment artifact to the deployment repository.
cp scripts/ci/.gitignore "$DIST_DIR/"
cp .gitattributes "$DIST_DIR/"
cp .env.example "$DIST_DIR/"
cp .rsync-filter "$DIST_DIR/"
mv "$DOCROOT" "$DIST_DIR/$DOCROOT"
mv config "$DIST_DIR/"
mv vendor "$DIST_DIR/"
mv bin "$DIST_DIR/"
mv composer.json "$DIST_DIR/"
mv composer.lock "$DIST_DIR/"
mv load.environment.php "$DIST_DIR/"
echo `cat scripts/ci/.htaccess` >> "$DIST_DIR/$DOCROOT/.htaccess"

# Overwrite robots.txt file for non-production websites.
if [ "$BITBUCKET_BRANCH" != 'master' ]; then
  mv "$DIST_DIR/$DOCROOT/robots-noindex.txt" "$DIST_DIR/$DOCROOT/robots.txt"
fi

# Configure git.
git config --global user.email no-reply@airchoiceone.com
git config --global user.name "Air Choice One"
git config --global core.autocrlf input

# Deploy.
cd "$DIST_DIR"

if [[ `git status --porcelain` ]]; then
  # Commit build.
  git add --force --all
  git status
  git commit -qm "${GIT_MESSAGE}" --no-verify

  # Push artifact to server repository, but first open up the permissions.
  ssh -p "$SSH_PORT" "$SSH_URL" "cd $SITE_PATH
chmod 755 $DOCROOT/sites/default
chmod 644 $DOCROOT/sites/default/services.yml $DOCROOT/sites/default/settings.php"
  git push origin -v --force

  # Run database updates, import configuration, and clear cache.
  ssh -p "$SSH_PORT" "$SSH_URL" "cd $SITE_PATH &&
chmod 555 $DOCROOT/sites/default
chmod 444 $DOCROOT/sites/default/services.yml $DOCROOT/sites/default/settings.php
bin/drush -y -r $SITE_PATH/$DOCROOT cache-rebuild &&
bin/drush -y -r $SITE_PATH/$DOCROOT state-set system.maintenance_mode 1 &&
bin/drush -y -r $SITE_PATH/$DOCROOT updatedb &&
bin/drush -y -r $SITE_PATH/$DOCROOT config:import &&
bin/drush -y -r $SITE_PATH/$DOCROOT state-set system.maintenance_mode 0"
fi
