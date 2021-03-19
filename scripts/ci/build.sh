#!/bin/bash

# Configure server.
apt-get update && apt-get install -y \
        git \
        zip \
        unzip \
        default-mysql-client \
        libfreetype6-dev \
        libjpeg62-turbo-dev \
        libpng-dev \
    && docker-php-ext-install -j$(nproc) iconv pdo_mysql \
    && docker-php-ext-configure gd --with-freetype-dir=/usr/include/ --with-jpeg-dir=/usr/include/ \
    && docker-php-ext-install -j$(nproc) gd

# Avoid ssh prompting when connecting to new SSH hosts.
mkdir -p "$HOME/.ssh/"
echo "StrictHostKeyChecking no" >> "$HOME/.ssh/config"
chmod 600 "$HOME/.ssh/config"
chmod 700 "$HOME/.ssh"

# Install composer.
curl --silent --show-error https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
composer -V

# Use your GitHub token to avoid rate limiting.
if [ -n "$GITHUB_TOKEN" ] ; then
  composer -n config --global github-oauth.github.com $GITHUB_TOKEN
else
  echo "GITHUB_TOKEN is missing. Proceeding without authentication..."
fi

# Setup Apache.
echo "127.0.0.1 airchoiceone.lndo.site" | tee -a /etc/hosts
echo "ServerName localhost

<VirtualHost *:80>
  UseCanonicalName Off
  DocumentRoot $BITBUCKET_CLONE_DIR/$DOCROOT
  ServerName airchoiceone.lndo.site
  DirectoryIndex index.php
  LogLevel notice

  <Directory $BITBUCKET_CLONE_DIR/$DOCROOT>
    Options FollowSymLinks
    AllowOverride All
    Require all granted
  </Directory>
</VirtualHost>
" >> /etc/apache2/sites-available/airchoiceone.conf
a2ensite airchoiceone.conf
a2enmod rewrite
service apache2 restart

# Disable PHP memory limit.
echo 'memory_limit=-1' | tee -a /usr/local/etc/php/php.ini
