<?php

$start_framework = microtime(true);

require_once __DIR__ . '/../config/config.php';
require_once ROOT . '/vendor/autoload.php';
require_once HELPERS . '/helpers.php';


if (PHP_MAJOR_VERSION < 8) {
    die('Reqiured PHP version 8 or higher');
};
$app = new \PHPFramework\Application();

require_once CONFIG . '/routes.php';
$app->run();
dump(request()->isGet());


echo 'OK' . PHP_EOL . $start_framework;
