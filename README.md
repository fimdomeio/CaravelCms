fimdomeio base Vagrant config
==============================
My base Vagrant machine for web development (**ubuntu/trusty32**, **nginx**, **php**, **mysql**)


How to use
----------
1. install virtualbox and vagrant;
2. Run `vagrant up`;
3. go take a coffee and everything will be setup in 5/10min.


Bateries Included
------------------

Detailed list of istalled and configured packages:
- nginx
- php5-common php5-dev php5-cli php5-fpm php5-xdebug
- curl php5-curl 
- php5-gd php5-mcrypt php5-mysql
- laravel installer
- debconf-utils
- mysql-server
- git
- nodejs npm gulp bower


Will automatically forward following ports to your machine if they are not already taken:
- 22 -> **2222** ssh (but it's easier to just run `vagrant ssh`)
- 80 -> **8000** http
- 3306 -> **3306** mysql
- 9000 -> **9000** xdebug

It will also expose the vm on **192.168.33.10**


Goodies
-------------------
We suggest installing hostupdater plugin by running `vagrant plugin install vagrant-hostsupdater`. It will update your hosts file automatically exposing the machine as www.fimdomeio.dev