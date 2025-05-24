<?php

class CartUseCase
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
    public function add($product): array
    {
        try {
            $addedProduct = false;

            foreach ($_SESSION['cart'] as &$cartProduct) {
                if ($cartProduct['id'] == $product['id']) {
                    $cartProduct['quantityCart'] += 1;
                    $addedProduct = true;
                    break;
                }
            }

            if (!$addedProduct) {
                $product['quantityCart'] = 1;
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
     * @return void
     */
    public function remove($id): void
    {
        foreach ($_SESSION['cart'] as $index => $item) {
            if ($item['id'] == $id) {
                unset($_SESSION['cart'][$index]);
                $_SESSION['cart'] = array_values($_SESSION['cart']); // Reindexa
                return;
            }
        }
    }

    /**
     * Atualiza a quantidade de um produto no carrinho.
     *
     * @param $id
     * @param $quantity
     * @return void
     */
    public function updateQuantity($id, $quantity): void
    {
        foreach ($_SESSION['cart'] as &$item) {
            if ($item['id'] == $id) {
                $item['quantity'] = $quantity;
                return;
            }
        }
    }

    /**
     * Retorna todos os itens do carrinho.
     *
     * @return array.
     */
    public function all(): array
    {
        return $_SESSION['cart'];
    }

    /**
     * Limpa todos os itens do carrinho.
     *
     * @return void
     */
    public function clear(): void
    {
        unset($_SESSION['cart']);
    }

    /**
     * Calcula o total do carrinho.
     *
     * @return float
     */
    public function getTotal(): float
    {
        $total = 0.0;
        foreach ($_SESSION['cart'] as $item) {
            $total += $item['price'] * $item['quantity'];
        }
        return $total;
    }
}
