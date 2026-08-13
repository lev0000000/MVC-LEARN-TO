<?php

$start_framework = microtime(true);

/**
 * Подключаем классы конфиги и хелперы
 */
require_once __DIR__ . '/../config/config.php';
require_once ROOT . '/vendor/autoload.php';
require_once HELPERS . '/helpers.php';


if (PHP_MAJOR_VERSION < 8) {
    die('Reqiured PHP version 8 or higher');
};

/**
 * Создаем экземпляр класса Application 
 */

$app = new \PHPFramework\Application();

/**
 * Подключаем файл с маршутами и вызываем run() у класса Application 
 */

require_once CONFIG . '/routes.php';

$app->run();


// echo 'OK' . PHP_EOL . $start_framework;
