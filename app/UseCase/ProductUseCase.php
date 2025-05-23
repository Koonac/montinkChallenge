<?php

require_once __DIR__ . '/../Models/ProductModel.php';

class ProductUseCase
{
    /**
     * Cria um produto 
     * 
     * @param $atributos
     * @return array
     */
    public function create($atributos)
    {
        print_r('AAAAAAAAAAAA');
        print_r($atributos);
        die;
    }
}
