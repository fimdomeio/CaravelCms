Caravel
=======

A laravel CMS

**This software is in pre-alpha stage and expected to break**


## Install

- Install Laravel as described on [http://laravel.com/docs/4.2/quick](http://laravel.com/docs/4.2/quick)

- `git clone https://github.com/fimdomeio/CaravelCms.git workbench`

- cd into `workbench/fimdomeio` and run `composer install`

- add caravel to as a ServiceProvider in app/config/app.php

<pre>
	'providers' => array(
		...,
		'Fimdomeio\Caravel\CaravelServiceProvider'
	),
</pre>

- run `php artisan serve` and go to `http://localhost:8000/admin` to test
