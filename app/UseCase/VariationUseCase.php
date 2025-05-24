<?php

class VariationUseCase
{
    /**
     * Cria uma variação
     * 
     * @param $productId
     * @param $attributes
     * @return array
     */
    public function create($productId, $attributes)
    {
        try {
            $productModel = new ProductModel;
            $variationCreated = $productModel->create([
                'name'          => $attributes['name'],
                'price'         => $attributes['price'],
                'isVariation'   => true,
            ]);
            $variationId = $variationCreated['id'];

            $stockModel = new StockModel;
            $stockModel->create([
                'productId' => $variationId,
                'quantity'  => 0
            ]);

            /* CRIAR VARIAÇÕES SE TIVER */
            $variationModel = new VariationModel;
            $variationCreated = $variationModel->create([
                'parentProductId'   => $productId,
                'variationId'       => $variationId,
            ]);

            return [
                'status'    => true,
                'message'   => 'Variação criada com sucesso.',
            ];
        } catch (Exception $e) {
            if (isset($variationId) && !empty($variationId)) $productModel->delete($variationId);
            return [
                'status'    => false,
                'message'   => 'Falha ao criar uma variação para o produto',
                'code'      => $e->getCode(),
                'error'     => $e->getMessage()
            ];
        }
    }

    /**
     * Cria múltiplas variações para um produto
     * 
     * @param $productId
     * @param $attributes
     * @return array
     */
    public function createMany($productId, $variations)
    {
        try {
            if (isset($variations) && !empty($variations)) {
                foreach ($variations as $variation) {
                    if (empty($variation['name'])) continue;

                    $this->create($productId, [
                        'name'  => $variation['name'],
                        'price' => $variation['price'],
                    ]);
                }
            }

            return [
                'status'    => true,
                'message'   => 'Variações criadas com sucesso.',
            ];
        } catch (Exception $e) {
            return [
                'status'    => false,
                'message'   => 'Falha ao criar variações para o produto',
                'code'      => $e->getCode(),
                'error'     => $e->getMessage()
            ];
        }
    }
}
