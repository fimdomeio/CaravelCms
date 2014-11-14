<?php


App::before(function($request)
{
	// Set up global user object for views
	require 'admin-menu.php';
	require 'menu.php';
	View::share('menus', ['menu' => $menu, 'adminMenu' => $adminMenu]);
});
