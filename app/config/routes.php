<?php

$router = $di->get("router");


// 404
$router->notFound(array(
    'namespace'  => 'ElasticTest\Modules\Frontend\Controllers',
    'module'     => 'frontend',
    'controller' => 'error',
    'action'     => 'error404'
));

// index
$router->add('/', array(
    'namespace'  => 'ElasticTest\Modules\Frontend\Controllers',
    'module'     => 'frontend',
    'controller' => 'index',
    'action'     => 'index'
))->setName('index');

// add content
$router->add('/add', array(
    'namespace'  => 'ElasticTest\Modules\Frontend\Controllers',
    'module'     => 'frontend',
    'controller' => 'content',
    'action'     => 'add'
))->setName('content-add');


$di->set("router", $router);
