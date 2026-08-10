<?php


/**
 * @var \PHPFramework\Application $app
 */

$app->router->add('/', function(){
    return 'Hello World';
}, ['post', 'get']);

$app->router->get('/test', [\App\Controllers\HomeController::class, 'test']);
$app->router->post('/contact', [\App\Controllers\ContactController::class, 'test']);
$app->router->get('/post/(?P<slug>[a-z0-9]+/?)', function(){
    return 'Some Post';
});
