<?php

require_once __DIR__ . '/../Models/ProductModel.php';
require_once __DIR__ . '/../Models/VariationModel.php';
require_once __DIR__ . '/../Models/StockModel.php';

class ProductUseCase
{
    /**
     * Cria um produto 
     * 
     * @param $attributes
     * @return array
     */
    public function create($attributes)
    {
        try {
            $productModel = new ProductModel;
            $productCreated = $productModel->create($attributes);
            $productId = $productCreated['id'];

            $stockModel = new StockModel;
            $stockModel->create([
                'productId' => $productId,
                'quantity'  => 0
            ]);

            /* CRIAR VARIAÇÕES SE TIVER */
            // $variationModel = new VariationModel;
            // $variationCreated = $variationModel->create([]);

            return [
                'status'    => true,
                'message'   => 'Produto criado com sucesso.',
            ];
        } catch (Exception $e) {
            if (isset($productId) && !empty($productId)) $productModel->delete($productId);
            return [
                'status'    => false,
                'message'   => 'Falha ao criar um produto',
                'code'      => $e->getCode(),
                'error'     => $e->getMessage()
            ];
        }
    }
}
