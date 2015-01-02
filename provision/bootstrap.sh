#!/bin/bash
start=`date +%s`

apt-get update
apt-get -y upgrade

 
echo "Provisioning virtual machine..."

echo "Installing Nginx"
apt-get install nginx -y

echo "Installing PHP"
apt-get install php5-common php5-dev php5-cli php5-fpm -y

echo "installing xdebug"
apt-get install php5-xdebug -y
#Duplicates settings on --provision cat /var/www/provision/config/xdebug >> /etc/php5/fpm/php.ini
rm /etc/php5/cli/conf.d/20-xdebug.ini 

echo "Installing PHP extensions"
apt-get install curl php5-curl php5-gd php5-mcrypt php5-mysql php5-imagick -y

php5enmod mcrypt

mv '/etc/php5/fpm/php.ini' '/etc/php5/fpm/php.original'
cp '/usr/share/php5/php.ini-development' '/etc/php5/fpm/php.ini'
service php5-fpm restart

apt-get install debconf-utils -y

debconf-set-selections <<< "mysql-server mysql-server/root_password password localpassword"
 
debconf-set-selections <<< "mysql-server mysql-server/root_password_again password localpassword"

apt-get install mysql-server -y

sed -i "s/^bind-address/#bind-address/" /etc/mysql/my.cnf
mysql -u root -plocalpassword -e "GRANT ALL PRIVILEGES ON *.* TO 'root'@'%' IDENTIFIED BY 'localpassword' WITH GRANT OPTION; FLUSH PRIVILEGES;"
sudo /etc/init.d/mysql restart
mysql -uroot -plocalpassword -e 'create database localdatabase;'

#echo "installing nodejs and gulp"
#apt-get install nodejs npm -y 
#ln /usr/bin/nodejs /usr/bin/node
#npm install -g gulp
echo "Configuring Nginx"
cp /var/www/provision/config/nginx_vhost /etc/nginx/sites-available/nginx_vhost
 
ln -s /etc/nginx/sites-available/nginx_vhost /etc/nginx/sites-enabled/
 
rm -rf /etc/nginx/sites-available/default
 
service nginx restart

echo "installing composer"
curl -sS https://getcomposer.org/installer | php
mv composer.phar /usr/local/bin/composer

echo "installing laravel"
su -c 'composer global require "laravel/installer=~1.1"' vagrant

#link for web directory
ln -s /vagrant/src /home/vagrant/www

 if ! grep -q 'cd /vagrant/src' "/home/vagrant/.profile"; then
   echo 'cd /vagrant/src' >> /home/vagrant/.profile
 fi


 if ! grep -q 'PATH="~/.composer/vendor/bin:$PATH"' "/home/vagrant/.profile"; then
   echo 'PATH="~/.composer/vendor/bin:$PATH"' >> /home/vagrant/.profile
 fi

 updatedb

echo "if they where available on your machine you'll have:"
echo " - a webserver on local port 8000"
echo " - xdebug on local port 9000"
echo " - mysql on localport 3306 with root password: 'localpassword'"
echo "Anyway you can access the machine on 192.168.33.10."
echo "If you're going to access it directly it might be a good idea to add it to /etc/hosts."
end=`date +%s`
runtime=$((end-start))
echo "install took $runtime seconds"