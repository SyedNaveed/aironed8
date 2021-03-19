#!/bin/bash

set -eu

ln -s ../../scripts/git/pre-commit.sh .git/hooks/pre-commit

composer install

echo 'Setup complete. Remaining tasks:'

echo ' - Uncomment and populate .env as needed.'
cp .env.example .env

echo ' - Edit public_html/sites/default/settings.local.php as needed.'
cp public_html/sites/example.settings.local.php public_html/sites/default/settings.local.php
