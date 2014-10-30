Caravel
=======

A laravel CMS

**This software is in pre 0.1 stage. Using it still feels like you're sailing a caravel at Cape of Good Hope and probably heading directly to the rocks... Yet we all know that incredible exotic stuff lies ahead.**


## Install

- Install Laravel as described on [http://laravel.com/docs/4.2/quick](http://laravel.com/docs/4.2/quick)

- install DebugBar `composer require barryvdh/laravel-debugbar`

- Inside the new created project run `git clone https://github.com/fimdomeio/CaravelCms.git workbench`


- cd into `workbench/fimdomeio/caravel` and run `composer install`

- add caravel and DebugBar to as a ServiceProvider in app/config/app.php

<pre>
	'providers' => array(
		...,
		'Fimdomeio\Caravel\CaravelServiceProvider',
		'Barryvdh\Debugbar\ServiceProvider',
	),
</pre>

- add DebugBar Facade in app/config/app.php

<pre>
	'aliases' => array(
		...
		'Debugbar' => 'Barryvdh\Debugbar\Facade'
	),
</pre>

- run `php artisan build` to compile ant copy assets to their final destinations

- run `php artisan serve` and go to `http://localhost:8000/admin` to test

Further reading is starting to show up in the wiki.

We hang around #caravelcms on freenode. Feel free to drop by anytime.

For spam related subjects contact us at caravel@fimdomeio.com ;)

