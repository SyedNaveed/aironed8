#!/bin/bash

set -eu

# Configuration.

target="master"

# Set environment variables.

dir1=$(dirname "$0")
dir2=$(cd $dir1/.. && pwd)
dir3=$(cd $dir1/../.. && pwd)

# Set colors.

grey="\033[90m"
green="\033[32m"
blue="\033[34m"
cyan="\033[36m"
red="\033[31m"
none="\033[0m"

# Do the deployment.

while read oldrev newrev refname
do
  # Get branch name.
  branch=$(git rev-parse --symbolic --abbrev-ref $refname)

  echo -e "${blue}The ${branch} branch was received.${none}"

  if [ -n "$branch" ] && [ "$target" = "$(echo $branch | cut -d'/' -f 1)" ];
  then
    echo -e "${grey}Deploying...${none}"
    git --work-tree="$dir3" --git-dir="$dir2" checkout $branch -f
    echo -e "${green}Deployment complete.${none}"
  else
    echo -e "${red}Exiting: only the ${target} branch may be deployed to this server environment.${none}"
  fi
done
