<?php

	//ini_set('error_reporting', 'E_STRICT');

	require_once "../vendor/autoload.php";

	$route = new \App\Route;
	
	if ($_SERVER['REQUEST_URI'] === '/' || $_SERVER['REQUEST_URI'] === '/index.php') {
    header('Location: /usuarios');
    exit;
}
	

?>