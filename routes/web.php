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
        '/carrinho' => 'StoreController@cartView',
    ],
    'POST' => [
        '/carrinho/adicionar' => 'StoreController@addProductCart',
        '/carrinho/remover' => 'StoreController@removeProductCart',
        '/carrinho/decrementa' => 'StoreController@decrementQuantityCart',
        '/carrinho/incrementa' => 'StoreController@incrementQuantityCart',
        '/carrinho/limpar' => 'StoreController@clearCart',
        '/produtos' => 'ProductController@store',
        '/produtos/{id}/atualizar' => 'ProductController@update',
        '/pedidos/comprar' => 'OrderController@store',
    ],
    'DELETE' => [
        '/produtos/{id}' => 'ProductController@delete',
        '/variacao/{variationId}' => 'VariationController@delete',
    ],
];
