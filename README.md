Caravel CMS 0.2
=====================

First commits on 0.2a.

WAT?
---------------------
Caravel is a php CMS based on Laravel. The stack goes something like this:

 - server: php, mysql 
 - client: angular, less, bootstrap,

Requirements
---------------------
Vagrant, which requires VirtualBox


Install
---------------------

1. `git clone https://github.com/fimdomeio/CaravelCms.git`
2. `vagrant up`
4. `vagrant ssh -c "caravelInit"`
5. 'vagrant ssh'

Once you're there you'll have onscreen info on what to do next 

Running
---------------------
It's already running. Normal server is running on port 80.

Next time you need to run it its just `vagrant up` and `vagrant ssh -c build`


Why
---------------------
Tired of passing a project to someone and having him/her take a week to get the development environment running. So here it is.

I'm making this a super coder friendly cms. The coder admin area is going to be full of goodies like a code generator, on site documentation, Caravel and project specific issues tracking.