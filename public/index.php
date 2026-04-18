<?php

/**
 * Lecture Web Engineering
 */

use Bukubuku\Core\Application;

//Ensure that errors are propagated to help with troubleshooting.
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

//Ensure that autoloading works.
require_once __DIR__ . '/../vendor/autoload.php';

//Create application. 
$application = new Application(dirname(__DIR__));

//Register routes.
$application->router->registerGet('/', 'home');
$application->router->registerGet('/contact', 'contact');
$application->router->registerGet('/users/create', 'users/create');
$application->router->registerGet('/users/edit', 'users/edit');
$application->router->registerGet('/users/list', 'users/list');

$application->run();
