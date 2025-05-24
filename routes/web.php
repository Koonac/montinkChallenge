<?php

$routesWeb = [
    'GET' => [
        '/' => 'HomeController@index',
        '/produtos' => 'ProductController@index',
        '/produtos/criar' => 'ProductController@create',
        '/produtos/{id}' => 'ProductController@show',
        '/pedidos' => 'OrderController@index',
        '/pedidos/{id}' => 'OrderController@index',
        '/loja' => 'StoreController@index',
    ],
    'POST' => [
        '/carrinho/adicionar' => 'StoreController@addProductCart',
        '/produtos' => 'ProductController@store',
        '/produtos/{id}/atualizar' => 'ProductController@update',
    ],
    'DELETE' => [
        '/produtos/{id}' => 'ProductController@delete',
        '/variacao/{variationId}' => 'VariationController@delete',
    ],
];
