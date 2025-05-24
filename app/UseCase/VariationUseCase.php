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

    /**
     * Atualiza uma variação
     * 
     * @param $variationId
     * @param $attributes
     * @return array
     */
    public function update($variationId, $attributes)
    {
        try {
            $productModel = new ProductModel;
            $productModel->update($variationId, [
                'name'  => $attributes['name'],
                'price' => $attributes['price'],
            ]);

            $stockModel = new StockModel;
            $stockModel->updateByProduct($variationId, [
                'quantity' => $attributes['quantity']
            ]);

            return [
                'status'    => true,
                'message'   => 'Variação atualizada com sucesso.',
            ];
        } catch (Exception $e) {
            return [
                'status'    => false,
                'message'   => 'Falha ao atualizar uma variação',
                'code'      => $e->getCode(),
                'error'     => $e->getMessage()
            ];
        }
    }

    /**
     * Atualiza múltiplas variações
     * 
     * @param $variations
     * @return array
     */
    public function updateMany($variations)
    {
        try {
            if (isset($variations) && !empty($variations)) {
                foreach ($variations as $variation) {
                    if (empty($variation['name'])) continue;

                    $this->update($variation['variationId'], [
                        'name'      => $variation['name'],
                        'price'     => $variation['price'],
                        'quantity'  => $variation['quantity'],
                    ]);
                }
            }

            return [
                'status'    => true,
                'message'   => 'Variações atualizadas com sucesso.',
            ];
        } catch (Exception $e) {
            return [
                'status'    => false,
                'message'   => 'Falha ao atualizar as variações',
                'code'      => $e->getCode(),
                'error'     => $e->getMessage()
            ];
        }
    }

    /**
     * Deleta uma variação
     * 
     * @param $variations
     * @return array
     */
    public function delete($variationId)
    {
        try {
            $productModel = new ProductModel;
            $productModel->delete($variationId);

            return [
                'status'    => true,
                'message'   => 'Variação deletada com sucesso.',
            ];
        } catch (Exception $e) {
            return [
                'status'    => false,
                'message'   => 'Falha ao deletar a variação',
                'code'      => $e->getCode(),
                'error'     => $e->getMessage()
            ];
        }
    }
}
