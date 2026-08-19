<?php

define("ROOT", dirname(__DIR__));
const CONFIG = ROOT . "/config";
const HELPERS = ROOT . "/helpers";
const VIEWS = ROOT . "/app/Views";
const CONTROLLERS = ROOT . "/controllers";
const MODELS = ROOT . "/models";
const LAYOUT = "default";
const CORE = ROOT . "/core";
const PATH = 'http://localhost:443';
const WWW = ROOT . '/public';
const ERROR_LOGS = ROOT . '/tmp/error.log' ;
const DEBUG = 1;
const PAGINATION_SETTINGS = [
    'perPage' => 1,
    'midSize' => 2,
    'maxPages'=> 10,
    'tpl'  =>'pagination/base'
];
const CACHE = ROOT . '/tmp/cache/';

const DB_SETTINGS = [
    'driver' => 'mysql',
    'host' => 'lamp-mysql8',
    'database' => 'fr_loc',
    'username' => 'root',
    'password' => 'tiger',
    'charset' => 'utf8',
    'collation' => 'utf8_unicode_ci',
    'prefix' => '',
    'options' => [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
    ]
];
