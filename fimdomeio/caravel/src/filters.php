<?php


App::before(function($request)
{
	// Set up global user object for views
	require 'admin-menu.php';
  View::share('adminMenu', $adminMenu);
});
