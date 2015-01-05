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
3. `vagrant ssh -c seed`
4. `vagrant ssh -c build`


Running
---------------------
It's already running. Normal server is running on port 80. funky BrowserSync (live reload on streroids) is running on port 3000.

Next time you need to run it its just `vagrant up` and `vagrant ssh -c build`


Why
---------------------
I'm making this a super coder friendly cms. The coder admin area is going to be full of goodies like a code generator, on site documentation, Caravel and project specific issues tracking.