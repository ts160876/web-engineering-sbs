<?php

/**
 * Lecture Web Engineering
 */

use Bukubuku\Core\Application;
use Bukubuku\Controllers\SiteController;
use Bukubuku\Controllers\UserController;

//Ensure that errors are propagated to help with troubleshooting.
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

//Ensure that autoloading works.
require_once __DIR__ . '/../vendor/autoload.php';

//Load the content from the .env file.
$dotenv = Dotenv\Dotenv::createImmutable(dirname(__DIR__));
$dotenv->load();

//Create application. 
$application = new Application(
    $_ENV['DB_DSN'],
    $_ENV['DB_USERNAME'],
    $_ENV['DB_PASSWORD'],
    dirname(__DIR__)
);

//Register routes.
$application->router->registerGet('/', [SiteController::class, 'home']);
$application->router->registerGet('/contact', [SiteController::class, 'contact']);
$application->router->registerPost('/contact', [SiteController::class, 'handleContact']);

$application->router->registerGet('/registration', 'registration');
$application->router->registerGet('/login', 'login');

$application->router->registerGet('/users/create', [UserController::class, 'create']);
$application->router->registerPost('/users/create', [UserController::class, 'handleCreate']);
$application->router->registerGet('/users/edit', 'users/edit');
$application->router->registerGet('/users/list', 'users/list');

$application->run();
