<?php
//namespace Fimdomeio\Caravel;

Route::get('admin', function()
{
	return View::make('caravel::admin.dashboard');
});

Route::resource('boats', 'Fimdomeio\Caravel\BoatsController');

