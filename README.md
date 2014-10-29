Caravel
=======

A laravel CMS

**This software is in pre-alpha stage and expected to break**


## Install

- Install Laravel as described on [http://laravel.com/docs/4.2/quick](http://laravel.com/docs/4.2/quick)

- install DebugBar `composer require barryvdh/laravel-debugbar`

- Inside the new created project run `git clone https://github.com/fimdomeio/CaravelCms.git workbench`


- cd into `workbench/fimdomeio/caravel` and run `composer install`

- add caravel and DebugBar to as a ServiceProvider in app/config/app.php

<pre>
	'providers' => array(
		...,
		'Fimdomeio\Caravel\CaravelServiceProvider'
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


- run `php artisan serve` and go to `http://localhost:8000/admin` to test
