<?php


Route::get('/admin', function()
{
	return View::make('caravel::admin.dashboard');
});
