<?php

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

            if (isset($attributes['variations']) && !empty($attributes['variations'])) {
                $variations = array_map(fn($v) => ['name' => $v, 'price' => $attributes['price']], $attributes['variations']);
                $variationUseCase = new VariationUseCase;
                $variationUseCase->createMany($productId, $variations);
            }

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

    /**
     * Atualiza um produto 
     * 
     * @param $attributes
     * @return array
     */
    public function update($productId, $attributes)
    {
        try {
            $productModel = new ProductModel;
            $productModel->update($productId, [
                'nome'          => $attributes['nome'],
                'description'   => $attributes['description'],
                'price'         => $attributes['price'],
            ]);

            $stockModel = new StockModel;
            $stockModel->updateByProduct($productId, [
                'quantity'  => $attributes['quantity']
            ]);

            // EDITANDO VARIAÇÕES
            /*
            
            
            
            
            ALTERAR O PREÇO TAMBÉM


            
            */
            if (isset($attributes['variations_edit']) && !empty($attributes['variations_edit'])) {
                foreach ($attributes['variations_edit'] as $variationId => $value) {
                    # code...
                }
            }

            // ALTERANDO ESTOQUE DE VARIAÇÕES
            if (isset($attributes['stock_variations']) && !empty($attributes['stock_variations'])) {
            }

            // CRIANDO NOVAS VARIAÇõES
            if (isset($attributes['variations']) && !empty($attributes['variations'])) {
                $variations = array_map(fn($v) => ['name' => $v, 'price' => $attributes['price']], $attributes['variations']);
                $variationUseCase = new VariationUseCase;
                $variationUseCase->createMany($productId, $variations);
            }

            return [
                'status'    => true,
                'message'   => 'Produto atualizado com sucesso.',
            ];
        } catch (Exception $e) {
            if (isset($productId) && !empty($productId)) $productModel->delete($productId);
            return [
                'status'    => false,
                'message'   => 'Falha ao atualizar um produto',
                'code'      => $e->getCode(),
                'error'     => $e->getMessage()
            ];
        }
    }
}
