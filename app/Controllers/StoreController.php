<?php

class StoreController extends RenderView
{
    /**
     * Exibe lista de produtos para venda na loja
     *
     * @return void
     */
    public function index()
    {
        $productModel = new ProductModel;
        $this->loadView('store', [
            'title'     => 'Comprar produtos',
            'products'  => Helpers::listToCamelCase($productModel->allStore())
        ]);
    }

    /**
     * Adiciona produto ao carrinho
     *
     * @return json
     */
    public function addProductCart()
    {
        header('Content-Type: application/json');
        $data = json_decode(file_get_contents('php://input'), true);

        $cart = new CartUseCase;
        $cartAdd = $cart->add($data);

        echo json_encode($cartAdd);
    }
}
