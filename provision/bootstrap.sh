#!/bin/bash
start=`date +%s`

touch /home/vagrant/last-apt-update

lastUpdate=$(</home/vagrant/last-apt-update)

if [ $((start-lastUpdate)) -gt 86400 ]; then apt-get update; apt-get -y upgrade; fi;

 
echo "Provisioning virtual machine..."

echo "Installing git"
apt-get install git -y

echo "Installing Nginx"
apt-get install nginx -y

echo "Installing PHP"
apt-get install php5-common php5-dev php5-cli php5-fpm -y

echo "installing xdebug"
apt-get install php5-xdebug -y
#Duplicates settings on --provision cat /var/www/provision/config/xdebug >> /etc/php5/fpm/php.ini
rm /etc/php5/cli/conf.d/20-xdebug.ini 2>/dev/null 

echo "Installing PHP extensions"
apt-get install curl php5-curl php5-gd php5-mcrypt php5-mysql php5-imagick -y

php5enmod mcrypt

mv '/etc/php5/fpm/php.ini' '/etc/php5/fpm/php.original'
cp '/usr/share/php5/php.ini-development' '/etc/php5/fpm/php.ini'
service php5-fpm restart

apt-get install debconf-utils -y

debconf-set-selections <<< "mysql-server mysql-server/root_password password localpassword"
 
debconf-set-selections <<< "mysql-server mysql-server/root_password_again password localpassword"

echo "Installing Mysql"
apt-get install mysql-server -y

sed -i "s/^bind-address/#bind-address/" /etc/mysql/my.cnf
mysql -u root -plocalpassword -e "GRANT ALL PRIVILEGES ON *.* TO 'root'@'%' IDENTIFIED BY 'localpassword' WITH GRANT OPTION; FLUSH PRIVILEGES;"
sudo /etc/init.d/mysql restart
mysql -uroot -plocalpassword -e 'create database localdatabase;' 2> /dev/null

echo "Installing nodejs npm bower and gulp"
apt-get install nodejs npm -y
if [ ! -f "/usr/bin/node" ]; then ln /usr/bin/nodejs /usr/bin/node ; fi;

if [ ! -f "/usr/local/bin/bower" ]; then npm install -g bower; fi;
if [ ! -f "/usr/local/bin/gulp" ]; then npm install -g gulp; fi;
#Windows does not like npm long path names, so lets hide them
ln -s /home/vagrant/node_modules /vagrant/node_modules

echo "Configuring Nginx"
rm /etc/nginx/sites-available/nginx_vhost 2> /dev/null
rm /etc/nginx/sites-enabled/nginx_vhost 2> /dev/null
cp /var/www/provision/config/nginx_vhost /etc/nginx/sites-available/nginx_vhost
 
ln -s /etc/nginx/sites-available/nginx_vhost /etc/nginx/sites-enabled/
 
rm -rf /etc/nginx/sites-available/default
 
service nginx restart

echo "installing composer"
if [ ! -f "/usr/local/bin/composer" ]; then echo "installing composer"; curl -sS https://getcomposer.org/installer | php; mv composer.phar /usr/local/bin/composer; fi

echo "installing laravel"
su -c 'composer global require "laravel/installer=~1.1"' vagrant

#link for web directory
if [ ! -h "/home/vagrant/www" ]; then ln -s /vagrant/src /home/vagrant/www; fi;



 if ! grep -q 'cd /vagrant' "/home/vagrant/.profile"; then
   echo 'cd /vagrant' >> /home/vagrant/.profile
 fi


 if ! grep -q 'PATH="~/.composer/vendor/bin:/vagrant/bin:$PATH"' "/home/vagrant/.profile"; then
   echo 'PATH="~/.composer/vendor/bin:/vagrant/bin:$PATH"' >> /home/vagrant/.profile
 fi

 updatedb



cd /vagrant
npm install

cd /vagrant/src/
/usr/local/bin/composer update;


echo "if they where available on your machine you'll have:"
echo " - a webserver on local port 8000"
echo " - xdebug on local port 9000"
echo " - mysql on localport 3306 with root password: 'localpassword'"
echo "Anyway you can access the machine on 192.168.33.10."
echo "If you're going to access it directly it might be a good idea to add it to /etc/hosts."
end=`date +%s`
runtime=$((end-start))
echo $start > /home/vagrant/last-apt-update
echo "install took $runtime seconds"