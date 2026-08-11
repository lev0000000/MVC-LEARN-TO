<?php


/**
 * @var \PHPFramework\Application $app
 */

$app->router->get('/', [\App\Controllers\HomeController::class, 'index']);

$app->router->get('test', [\App\Controllers\HomeController::class, 'index']);

$app->router->get('register', [\App\Controllers\UserController::class, 'register']);

$app->router->get('login', [\App\Controllers\UserController::class, 'login']);


