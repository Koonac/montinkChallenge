<?php

$routesWeb = [
    'GET' => [
        '/' => 'HomeController@index',
        '/pedidos' => 'OrderController@index',
        '/pedidos/{id}' => 'OrderController@index',
    ],
    'POST' => [],
    'PUT' => [],
    'DELETE' => [],
];
