<?php

$routesWeb = [
    'GET' => [
        '/' => 'HomeController@index',
        '/produtos' => 'ProductsController@index',
        '/produtos/criar' => 'ProductsController@create',
        '/produtos/{id}' => 'ProductsController@show',
        '/pedidos' => 'OrderController@index',
        '/pedidos/{id}/details' => 'OrderController@index',
    ],
    'POST' => [
        '/produtos' => 'ProductsController@store',
    ],
    'PUT' => [
        '/produtos/{id}/atualizar' => 'ProductsController@update',
    ],
    'DELETE' => [
        '/produtos/{id}/deletar' => 'ProductsController@delete',
    ],
];
