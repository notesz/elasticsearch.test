<?php

use Phalcon\Cli\Dispatcher;

/**
* Set the default namespace for dispatcher
*/
$di->setShared('dispatcher', function() {
    $dispatcher = new Dispatcher();
    $dispatcher->setDefaultNamespace('ElasticTest\Modules\Cli\Tasks');
    return $dispatcher;
});
