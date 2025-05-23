<?php

$routes = [
    'GET' => [
        '/' => 'HomeController@index',
        '/pedidos/{id}' => 'OrderController@index',
    ],
    'POST' => [],
    'PUT' => [],
    'DELETE' => [],
];
