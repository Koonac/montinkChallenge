<?php

$routesWeb = [
    'GET' => [
        '/' => 'HomeController@index',
        '/produtos' => 'ProductsController@index',
        '/produtos/criar' => 'ProductsController@create',
        '/produtos/{id}' => 'ProductsController@show',
        '/pedidos' => 'OrderController@index',
        '/pedidos/{id}' => 'OrderController@index',
    ],
    'POST' => [
        '/produtos' => 'ProductsController@store',
        '/produtos/{id}/atualizar' => 'ProductsController@update',
        '/produtos/{id}/deletar' => 'ProductsController@delete',
    ],
];
