<?php


App::before(function($request)
{
	// Set up global user object for views
	require app_path().'/admin-menu.php';
	require app_path().'/menu.php';
	View::share('menus', ['menu' => $menu, 'adminMenu' => $adminMenu]);
});
