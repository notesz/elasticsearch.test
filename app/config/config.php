<?php

defined('BASE_PATH') || define('BASE_PATH', getenv('BASE_PATH') ?: realpath(dirname(__FILE__) . '/../..'));
defined('APP_PATH') || define('APP_PATH', BASE_PATH . '/app');

return new \Phalcon\Config([
    'version' => '1.0',

    'database' => [
        'adapter'  => 'mysql',
        'host'     => '127.0.0.1',
        'username' => 'dev_elastic',
        'password' => '12345',
        'dbname'   => 'dev_elastic',
        'charset'  => 'utf8'
    ],

    'application' => [
        'appDir'         => APP_PATH . '/',
        'modelsDir'      => APP_PATH . '/common/models/',
        'migrationsDir'  => APP_PATH . '/migrations/',
        'cacheDir'       => BASE_PATH . '/cache/',
        'baseUri'        => '/'
    ],

    'printNewLine' => true
]);
