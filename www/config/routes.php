<?php


/**
 * @var \PHPFramework\Application $app
 */

const MIDDLEWARE = [
    'auth' => \PHPFramework\Middleware\Auth::class,
];

$app->router->get('/', [\App\Controllers\HomeController::class, 'index'])->withoutCsrfToken();

$app->router->get('test', [\App\Controllers\HomeController::class, 'index']);

$app->router->get('register', [\App\Controllers\UserController::class, 'register']);

$app->router->get('dashboard', [\App\Controllers\HomeController::class, 'dashboard'])->middleware(['auth']);

$app->router->post('register', [\App\Controllers\UserController::class, 'store']);

$app->router->get('login', [\App\Controllers\UserController::class, 'login']);

$app->router->get('users', [\App\Controllers\UserController::class, 'index']);


// dump(__FILE__ . ':' . __LINE__,$app->router->getRoutes());
