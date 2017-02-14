<?php

	include 'route.php';
	include 'classes/home.php';
	include 'classes/view.php';

	$route = new Route();

	$route->add('/', 'Home');
	$route->add('/[0-9_a-zA-Z]+', 'View');

	$route->error('404', 'NotFound');

	$route->submit();

?>