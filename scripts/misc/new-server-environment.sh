#!/bin/bash

set -eu

mkdir repository.git
cd repository.git

git init --bare

touch hooks/post-receive
chmod +x hooks/post-receive

echo "Copy scripts/git/post-receive.sh to the new file and adjust target branch."
