<?php


/**
 * @var \PHPFramework\Application $app
 */

$app->router->get('/', [\App\Controllers\HomeController::class, 'index'])->withoutCsrfToken();

$app->router->get('test', [\App\Controllers\HomeController::class, 'index']);

$app->router->get('register', [\App\Controllers\UserController::class, 'register']);

$app->router->post('register', [\App\Controllers\UserController::class, 'store']);

$app->router->get('login', [\App\Controllers\UserController::class, 'login']);

// dump(__FILE__ . ':' . __LINE__,$app->router->getRoutes());
