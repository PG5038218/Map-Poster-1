#!/bin/bash

function usage {
	cat <<USAGE
	Usage: $0 <IP_OR_NAME_OF_SERVER>

	- Does a fresh git clone of the repo to the current version of code
	- Does a few minor operations to get the code ready for serving
	- Swaps out the currently served code with the new version
	- Prints the shell command you need to run to do an emergency rollback
USAGE
	exit 1
}

[ "$#" = 1 ] || usage
IP_OR_NAME_OF_SERVER="$1"
## argument parsing done

cd "$(dirname "$0")/.."

HASH_TO_DEPLOY="$(git rev-parse HEAD)"
scp server/deploy_payload.sh deploy@"$IP_OR_NAME_OF_SERVER":deploy_payload.sh
if ssh -A deploy@"$IP_OR_NAME_OF_SERVER" ./deploy_payload.sh super secret sentinel value <<< "$HASH_TO_DEPLOY $(whoami)"; then
	echo DEPLOY SUCCESSFUL
else
	echo DEPLOY FAILED -- see error message above?
fi
