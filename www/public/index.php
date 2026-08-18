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

$whoops = new \Whoops\Run;


$app = new \PHPFramework\Application();

/**
 * Подключаем файл с маршутами и вызываем run() у класса Application 
 */
if(DEBUG){
    $whoops->pushHandler(new \Whoops\Handler\PrettyPageHandler);
} else{
    $whoops->pushHandler(new \Whoops\Handler\CallbackHandler(function(Throwable $e){
        error_log("[" . date('Y-m-d H:i:s') . "] 
            Error:" . $e->getMessage() . PHP_EOL . 
            "File: " . $e->getFile() . PHP_EOL . 
            "Line: " . $e->getLine() . PHP_EOL , 3, ERROR_LOGS);
            abort('Some error',500);
    }));
    
}
$whoops->register();

require_once CONFIG . '/routes.php';

$app->run();



// echo 'OK' . PHP_EOL . $start_framework;
