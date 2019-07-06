#!/bin/bash

set -eo pipefail

function usage {
	cat <<USAGE
	Usage: $0 <ENVIRONMENT> <IP_ADDR_OF_NEW_SERVER>

	Currently the only supported environmaent is "development", more will be added later

	The overall flow for spinning up a new server is:
	- Spin up a new lamp stack on the cloud.  The follo0wing procedure is what has been tested is known to be good:
		- DigitalOcean -> Create Droplet
		- One-click apps -> LAMP on 16.04
		- droplet size -> 4GB ram, 2 vCPUs
		- (make sure you set up an ssh key that you have access to!)
		- Wait a few seconds while the server spins up, get the IP address
	- Run this script to set up the rest
		- If you get ssh / scp connection errors, it might be that the droplet isn't ready yet.  DigitalOcean gives you the IP address before the box is really ready to go :/
	- Highly recommend you then add the IP to your /etc/hosts file so you can refer to it by name in the future.  It leads to less error of the "accidentally deploying broken code to production" variety
USAGE
	exit 1
}

[ "$#" = 2 ] || usage
[ "$1" = "development" ] || usage
ENVIRONMENT="$1"
IP_ADDR_OF_NEW_SERVER="$2"
## argument parsing done

cd "$(dirname "$0")/.."

set -x
scp server/bootstrap_payload.sh root@"$IP_ADDR_OF_NEW_SERVER":bootstrap_payload.sh
scp server/mxi.sql root@"$IP_ADDR_OF_NEW_SERVER":mxi.sql
scp "server/bootstrap_payload_${ENVIRONMENT}.sh" root@"$IP_ADDR_OF_NEW_SERVER":bootstrap_environment.sh
function full_bootstrap {
	ssh root@"$IP_ADDR_OF_NEW_SERVER" ./bootstrap_payload.sh     super secret sentinel value <<< "$IP_ADDR_OF_NEW_SERVER" && \
	ssh root@"$IP_ADDR_OF_NEW_SERVER" ./bootstrap_environment.sh super secret sentinel value <<< "$IP_ADDR_OF_NEW_SERVER"
}
if full_bootstrap; then
	echo BOOTSTRAP SUCCESSFUL
else
	echo BOOTSTRAP FAILED -- see error message above?
fi
