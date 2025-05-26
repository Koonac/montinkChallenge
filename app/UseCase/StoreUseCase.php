<?php

class StoreUseCase
{
    /**
     * Adiciona um produto ao carrinho.
     *
     * @param $produto
     * @return array
     */
    public function add($product, $quantityCart): array
    {
        try {
            $stockModel = new StockModel;
            $productStock = Helpers::keysToCamelCase($stockModel->findByProduct($product['id']));

            if ($quantityCart > $productStock['quantity']) {
                $quantityCart = $productStock['quantity'];
            }

            $cart = new Cart;
            $cart->add($product, $quantityCart);

            $stockModel->decrementByProduct($product['id'], [
                'quantity' => $quantityCart
            ]);

            return [
                'status'    => true,
                'message'   => 'Produto adicionado ao carrinho com sucesso.',
            ];
        } catch (Exception $e) {
            return [
                'status'    => false,
                'message'   => 'Falha ao adicionar produto ao carrinho',
                'code'      => $e->getCode(),
                'error'     => $e->getMessage()
            ];
        }
    }

    /**
     * Remove um produto do carrinho pelo ID.
     *
     * @param $id.
     * @return array
     */
    public function remove($id): array
    {
        try {
            $cart = new Cart;
            $find = $cart->find($id);
            $product = $find['product'];

            if (!empty($product)) {
                $stockModel = new StockModel;
                $stockModel->incrementByProduct($id, [
                    'quantity' => $product['quantityCart'] ?? 0
                ]);
            }

            $cart->remove($id);

            return [
                'status'    => true,
                'message'   => 'Produto removido do carrinho com sucesso.',
            ];
        } catch (Exception $e) {
            return [
                'status'    => false,
                'message'   => 'Falha ao remover produto do carrinho',
                'code'      => $e->getCode(),
                'error'     => $e->getMessage()
            ];
        }
    }

    /**
     * Decrementa uma quantidade de um determinado produto no carrinho
     *
     * @param $id
     * @return array
     */
    public function decrementQuantityCart($id): array
    {
        try {
            $cart = new Cart;
            $find = $cart->find($id);
            $product = $find['product'];

            if (!empty($product)) {
                if ($product['quantityCart'] > 1) {
                    $cart->decrementQuantityCart($id);
                } else {
                    $cart->remove($id);
                }

                $stockModel = new StockModel;
                $stockModel->incrementByProduct($id, [
                    'quantity' => 1
                ]);
            }

            return [
                'status'    => true,
                'message'   => 'Quantidade decrementada com sucesso.',
            ];
        } catch (Exception $e) {
            return [
                'status'    => false,
                'message'   => 'Falha ao atualizar quantidade do produto no carrinho',
                'code'      => $e->getCode(),
                'error'     => $e->getMessage()
            ];
        }
    }

    /**
     * Incrementa uma quantidade de um determinado produto no carrinho
     *
     * @param $id
     * @return array
     */
    public function incrementQuantityCart($id): array
    {
        try {
            $cart = new Cart;
            $find = $cart->find($id);
            $product = $find['product'];

            if (!empty($product)) {
                $stockModel = new StockModel;
                $productStock = Helpers::keysToCamelCase($stockModel->findByProduct($id));

                if ($productStock['quantity'] <= 0) {
                    throw new Exception('Estoque insuficiente');
                }

                $cart->incrementQuantityCart($id);

                $stockModel->decrementByProduct($id, [
                    'quantity' => 1
                ]);
            }

            return [
                'status'    => true,
                'message'   => 'Quantidade incrementada com sucesso.',
            ];
        } catch (Exception $e) {
            return [
                'status'    => false,
                'message'   => 'Falha ao atualizar quantidade do produto no carrinho',
                'code'      => $e->getCode(),
                'error'     => $e->getMessage()
            ];
        }
    }

    /**
     * Retorna todos os itens do carrinho.
     *
     * @return array.
     */
    public function all(): array
    {
        try {
            $cart = new Cart;
            $allProducts = $cart->all();

            $data = [
                'cart' => $allProducts['cart']
            ];

            return [
                'status'    => true,
                'data'      => $data,
                'message'   => 'Produtos do carrinho listados com sucesso.',
            ];
        } catch (Exception $e) {
            return [
                'status'    => false,
                'message'   => 'Falha ao listar produtos do carrinho',
                'code'      => $e->getCode(),
                'error'     => $e->getMessage()
            ];
        }
    }

    /**
     * Limpa todos os itens do carrinho.
     *
     * @return array
     */
    public function clear(): array
    {
        try {
            $cart = new Cart;
            $allProducts = $cart->all();

            if (($allProducts['cart']) > 0) {
                $stockModel = new StockModel;
                foreach ($allProducts['cart'] as $product) {
                    $stockModel->incrementByProduct($product['id'], [
                        'quantity' => $product['quantityCart']
                    ]);
                }
            }

            $cart->clear();

            return [
                'status'    => true,
                'message'   => 'Carrinho limpado com sucesso.',
            ];
        } catch (Exception $e) {
            return [
                'status'    => false,
                'message'   => 'Falha ao limpar o carrinho',
                'code'      => $e->getCode(),
                'error'     => $e->getMessage()
            ];
        }
    }

    /**
     * Calcula o total do carrinho.
     *
     * @return array
     */
    public function getTotal(): array
    {
        try {
            $cart = new Cart;
            $totalCart = $cart->getTotal();

            $data = [
                'shippingFee'   => $totalCart['shippingFee'],
                'subTotal'      => $totalCart['subTotal'],
                'total'         => $totalCart['total'],
            ];

            return [
                'status'    => true,
                'message'   => 'Total do carrinho calculado com sucesso.',
                'data'      => $data,
            ];
        } catch (Exception $e) {
            return [
                'status'    => false,
                'message'   => 'Falha ao calcular total do carrinho',
                'code'      => $e->getCode(),
                'error'     => $e->getMessage()
            ];
        }
    }
}
