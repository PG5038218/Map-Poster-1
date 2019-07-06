#!/bin/bash

set -eo pipefail

if [ "$*" != "super secret sentinel value" ]; then
echo "$*"
cat <<ERROR_MESSAGE
## This script is automatically copied up to a new server and run, by using the deploy.sh script.
## You should never run this script directly -- run deploy.sh instead
ERROR_MESSAGE
exit 1
fi

function error {
	echo "$@" && exit 1
}
read -t3 HASH_TO_DEPLOY DEPLOYER || error "COMMUNICATION ERROR"
NEW_DEPLOY_DIRECTORY="$HOME/snapshots/$(date +"%Y%m%d-%H%M%S")_by_${DEPLOYER}_${HASH_TO_DEPLOY}"
git clone git@github.com:JonLoesch/MyJourneyMaps.git "$NEW_DEPLOY_DIRECTORY"
cd "$NEW_DEPLOY_DIRECTORY" 
git checkout "$HASH_TO_DEPLOY" || error You are probably trying to deploy a version in git you haven\'t pushed to github yet
rm  -rf .git
cd ~deploy/artifacts
find -type f | while read ARTIFACT; do
	mkdir -p "${NEW_DEPLOY_DIRECTORY}/$(dirname "$ARTIFACT")"
	cp "$ARTIFACT" "${NEW_DEPLOY_DIRECTORY}/$ARTIFACT"
done
chmod -R g+sr,g-w "$NEW_DEPLOY_DIRECTORY"



echo DEPLOYING TO SERVER
OLD_DEPLOY_DIRECTORY="$(readlink -f /var/www/html)"
ln -sfT "$NEW_DEPLOY_DIRECTORY" /var/www/html
cat <<ROLLBACK
	IN ORDER TO SWAP BACK TO THE PREVIOUS VERSION, RUN THE FOLLOWING COMMANDS:"

	
		ssh $(hostname -I | awk '{print $1}')
		ln -sfT '$OLD_DEPLOY_DIRECTORY' /var/www/html
ROLLBACK
