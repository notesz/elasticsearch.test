<?php

use Phalcon\Loader;

$loader = new Loader();

/**
 * Register Namespaces
 */
$loader->registerNamespaces([
    'ElasticTest\Models' => APP_PATH . '/common/models/',
    'ElasticTest'        => APP_PATH . '/common/library/',
]);

/**
 * Register module classes
 */
$loader->registerClasses([
    'ElasticTest\Modules\Frontend\Module' => APP_PATH . '/modules/frontend/Module.php',
    'ElasticTest\Modules\Cli\Module'      => APP_PATH . '/modules/cli/Module.php'
]);

$loader->register();
