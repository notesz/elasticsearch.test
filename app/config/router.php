<?php

// 404
$router->notFound(array(
    'controller' => 'error',
    'action'     => 'error404'
));

// index
$router->add('/', array(
    'controller' => 'index',
    'action'     => 'index'
))->setName('index');

// add content
$router->add('/add', array(
    'controller' => 'content',
    'action'     => 'add'
))->setName('content-add');
