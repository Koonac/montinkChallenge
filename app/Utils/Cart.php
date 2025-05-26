<?php

class Cart
{
    /**
     * Inicializa o carrinho se ainda não existir.
     */
    public function __construct()
    {
        if (!isset($_SESSION['cart'])) {
            $_SESSION['cart'] = [];
        }
    }

    /**
     * Adiciona um produto ao carrinho.
     *
     * @param $produto
     * @return array
     */
    public function add($product, $quantityCart): array
    {
        try {
            $addedProduct = false;

            foreach ($_SESSION['cart'] as &$cartProduct) {
                if ($cartProduct['id'] == $product['id']) {
                    $cartProduct['quantityCart'] += $quantityCart;
                    $addedProduct = true;
                    break;
                }
            }

            if (!$addedProduct) {
                $product['quantityCart'] = $quantityCart;
                $_SESSION['cart'][] = $product;
            }
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
            foreach ($_SESSION['cart'] as $index => $item) {
                if ($item['id'] == $id) {
                    unset($_SESSION['cart'][$index]);
                    $_SESSION['cart'] = array_values($_SESSION['cart']);
                    break;
                }
            }

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
     * Decrementa uma unidade a quantidade de um produto no carrinho.
     *
     * @param $id
     * @return array
     */
    public function decrementQuantityCart($id): array
    {
        try {
            foreach ($_SESSION['cart'] as &$item) {
                if ($item['id'] == $id) {
                    $item['quantityCart'] = $item['quantityCart'] - 1;
                    break;
                }
            }

            return [
                'status'    => true,
                'message'   => 'Quantidade atualizada com sucesso.',
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
     * Incrementa uma unidade a quantidade de um produto no carrinho.
     *
     * @param $id
     * @return array
     */
    public function incrementQuantityCart($id): array
    {
        try {
            foreach ($_SESSION['cart'] as &$item) {
                if ($item['id'] == $id) {
                    $item['quantityCart'] = $item['quantityCart'] + 1;
                    break;
                }
            }

            return [
                'status'    => true,
                'message'   => 'Quantidade atualizada com sucesso.',
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
            return [
                'status'    => true,
                'cart'      => $_SESSION['cart'],
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
     * Retorna um item do carrinho.
     *
     * @return array.
     */
    public function find($id): array
    {
        try {
            $product = [];
            if (($_SESSION['cart']) > 0) {
                foreach ($_SESSION['cart'] as &$item) {
                    if ($item['id'] == $id) {
                        $product = $item;
                        break;
                    }
                }
            }

            return [
                'status'    => true,
                'product'   => $product,
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
            unset($_SESSION['cart']);

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
            $subTotal = 0.0;
            foreach ($_SESSION['cart'] as $item) {
                $subTotal += $item['price'] * $item['quantityCart'];
            }

            $shippingFee = $this->getShippingFee($subTotal);

            $total = $subTotal + $shippingFee;

            return [
                'status'        => true,
                'message'       => 'Total do carrinho calculado com sucesso.',
                'shippingFee'   => $shippingFee,
                'subTotal'      => $subTotal,
                'total'         => $total
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

    /**
     * Calcula o valor de frete.
     *
     * @param float $subTotal
     * @return float
     */
    private function getShippingFee($subTotal): float
    {
        $shippingFee = 0;

        if ($subTotal < 52) {
            $shippingFee = 20;
        } else if ($subTotal <= 166.59) {
            $shippingFee = 15;
        } else if ($subTotal <= 200) {
            $shippingFee = 20;
        } else {
            $shippingFee = 0;
        }

        return $shippingFee;
    }
}
