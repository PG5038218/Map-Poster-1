#!/bin/bash

set -eo pipefail

if [ "$*" != "super secret sentinel value" ]; then
cat <<ERROR_MESSAGE
## This script is automatically copied up to a new server and run, by using the bootstrap.sh script.
## You should never run this script directly -- run bootstrap.sh instead
ERROR_MESSAGE
exit 1
fi
read -t3 IP_ADDR_OF_NEW_SERVER

echo BOOTSTRAPPING

function error {
	echo "$@" && exit 1
}
[ "$(whoami)" = root ] || error "Must run as root"
apt update
a2enmod headers
apt install -y php7.0-mcrypt
service apache2 restart
adduser --disabled-password --gecos "" deploy
sudo -udeploy -- mkdir -p ~deploy/.ssh
sudo -udeploy tee ~deploy/.ssh/known_hosts >/dev/null <<GITHUB_HACK
|1|OBCDMaMol6hy2VTYFSsRh/3NZPE=|R/THzg/tMQdcQA5s8V+bPi0CCRM= ssh-rsa AAAAB3NzaC1yc2EAAAABIwAAAQEAq2A7hRGmdnm9tUDbO9IDSwBK6TbQa+PXYPCPy6rbTrTtw7PHkccKrpp0yVhp5HdEIcKr6pLlVDBfOLX9QUsyCOV0wzfjIJNlGEYsdlLJizHhbn2mUjvSAHQqZETYP81eFzLQNnPHt4EVVUh7VfDESU84KezmD5QlWpXLmvU31/yMf+Se8xhHTvKSCZIFImWwoG6mbUoWf9nzpIoaSjB+weqqUUmpaaasXVal72J+UX2B+2RPW3RcT0eOzQgqlJL3RKrTJvdsjE3JEAvGq3lGHSZXy28G3skua2SmVi/w4yCE6gbODqnTWlg7+wC604ydGXA8VJiS5ap43JXiUFFAaQ==
|1|KUlaxzGheXQHufJvDfdMZZ84Ta0=|ami5xahKoC76OfFhfrQXNPZY0fw= ssh-rsa AAAAB3NzaC1yc2EAAAABIwAAAQEAq2A7hRGmdnm9tUDbO9IDSwBK6TbQa+PXYPCPy6rbTrTtw7PHkccKrpp0yVhp5HdEIcKr6pLlVDBfOLX9QUsyCOV0wzfjIJNlGEYsdlLJizHhbn2mUjvSAHQqZETYP81eFzLQNnPHt4EVVUh7VfDESU84KezmD5QlWpXLmvU31/yMf+Se8xhHTvKSCZIFImWwoG6mbUoWf9nzpIoaSjB+weqqUUmpaaasXVal72J+UX2B+2RPW3RcT0eOzQgqlJL3RKrTJvdsjE3JEAvGq3lGHSZXy28G3skua2SmVi/w4yCE6gbODqnTWlg7+wC604ydGXA8VJiS5ap43JXiUFFAaQ==
GITHUB_HACK
sudo -udeploy -- tee ~deploy/.ssh/authorized_keys >/dev/null <<DEPLOY_SSH_KEYS
ssh-rsa AAAAB3NzaC1yc2EAAAABJQAAAIBeQBZ9u+Qgsoy2XVGQb+/niQZdAJTNPxH39U6C/f2TRWutLI83Lu/0oB3qVhelZX0Tw3Eo6B0FG854GX/1iAvTu1vIMnybNUFwMzzNXUoR7542pYjdEusaYAXhsR+ORlIWEtOO1sPFN9IBRBfnKDDHdTV7TBMfo/3DyfutozsCVQ== Jonathans_Personal_RSA_Key
ssh-rsa AAAAB3NzaC1yc2EAAAADAQABAAABAQDUyhgP563bqzC6cW4ed0I059/XbnyNOjN69gMvnGjbH4bSjaBh3hZDn+9TTNxtnb3MYxkZQUs5b0uWDZH8fnHV4NtIwVuweacVl4lNwBgI0669PkGPcMYDoXYyP/DNGF3l9QXaEytBoF7zHfEOdh3a6t9VOKb401EflX8PMGPZdCZ+XSPZsY/6pfOATPsWLvLCXeb2Iu1CLRrhNGZouupfHFD8XG/0zGUDAIEe1I5Kl12gqJhf4hfrfBhIO3UGh9CLd/hpKCuciYHdcLytT2nTm2g6MaTxXL8FSAfzYyeK2GNMNA14ROdZswh1+bAUH/KDknh7aOOA09HPPNRFkEWt stacy.loesch@varian.com
DEPLOY_SSH_KEYS
sudo -udeploy -- mkdir -p ~deploy/snapshots ~deploy/artifacts
chgrp www-data ~deploy/snapshots
chgrp deploy /var/www
chmod g+rwx /var/www
mv /var/www/html/ ~deploy/snapshots/initial_server_bootstrap
chmod -R g+sr,g-w ~deploy/snapshots/
ln -s ~deploy/snapshots/initial_server_bootstrap/ /var/www/html
