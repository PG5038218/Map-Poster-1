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

echo BOOTSTRAPPING DEVELOPMENT ENIRONMENT

root_mysql_pass="$(sed -n 's/^root_mysql_pass="\(.*\)"$/\1/p' ~/.digitalocean_password)"
app_mysql_pass="${root_mysql_pass:0:16}"
mysql -u root -p"${root_mysql_pass}" <<MYSQL_BOOTSTRAP
	CREATE DATABASE development;
	CREATE USER 'development'@'localhost' IDENTIFIED BY '${app_mysql_pass}';
	GRANT ALL PRIVILEGES ON \`development\`.* TO 'development'@'localhost';
	USE development;
	SOURCE mxi.sql;
MYSQL_BOOTSTRAP

sudo -udeploy -- mkdir -p ~deploy/artifacts/application/catalog/config/development
sudo -udeploy -- mkdir -p ~deploy/artifacts/application/admincp/config/development

sudo -udeploy -- tee ~deploy/.my.cnf >/dev/null <<MYSQL
[client]
user=development
password=${app_mysql_pass}
database=development
MYSQL

sudo -udeploy -- tee ~deploy/artifacts/application/catalog/config/development/database.php >/dev/null <<DATABASE
<?php
        if ( ! file_exists(\$file_path = APPPATH.'config/database.php'))
        {
                show_error('The configuration file database.php does not exist.');
        }
        include(\$file_path);

	\$db['default']['database'] = 'development';
	\$db['default']['username'] = 'development';	
	\$db['default']['password'] = '${app_mysql_pass}';
DATABASE
sudo -udeploy -- tee ~deploy/artifacts/application/catalog/config/development/config.php >/dev/null <<IP
<?php
	\$config['base_url'] = 'http://${IP_ADDR_OF_NEW_SERVER}/';
IP

sudo -udeploy -- tee ~deploy/artifacts/application/admincp/config/development/database.php >/dev/null <<DATABASE_ADMINCP
<?php
        if ( ! file_exists(\$file_path = APPPATH.'config/database.php'))
        {
                show_error('The configuration file database.php does not exist.');
        }
        include(\$file_path);

	\$db['default']['database'] = 'development';
	\$db['default']['username'] = 'development';	
	\$db['default']['password'] = '${app_mysql_pass}';
DATABASE_ADMINCP
sudo -udeploy -- tee ~deploy/artifacts/application/admincp/config/development/config.php >/dev/null <<IP_ADMINCP
<?php
	\$config['base_url'] = 'http://${IP_ADDR_OF_NEW_SERVER}/admincp';
IP_ADMINCP

sed -i '/DocumentRoot/a SetEnv CI_ENV development' /etc/apache2/sites-enabled/000-default.conf
service apache2 reload
