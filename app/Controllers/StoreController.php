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
        $this->loadView('store/index', [
            'title'     => 'Comprar produtos',
            'products'  => Helpers::listToCamelCase($productModel->allStore())
        ]);
    }

    /**
     * Exibe lista de produtos no carrinho
     *
     * @return void
     */
    public function cartView()
    {
        $storeUseCase = new StoreUseCase;
        $productsCart = $storeUseCase->all();
        $totalCart = $storeUseCase->getTotal();

        $this->loadView('store/cart', [
            'title'         => 'Carrinho',
            'productsCart'  => $productsCart['data']['cart'],
            'totalCart'     => $totalCart['data']
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

        $storeUseCase = new StoreUseCase;
        $response = $storeUseCase->add($data);

        echo json_encode($response);
    }

    /**
     * Remove produto do carrinho
     *
     * @return json
     */
    public function removeProductCart()
    {
        header('Content-Type: application/json');
        $data = json_decode(file_get_contents('php://input'), true);

        $storeUseCase = new StoreUseCase;
        $response = $storeUseCase->remove($data['productId']);

        echo json_encode($response);
    }

    /**
     * Atualiza quantidade de um determinado produto no carrinho
     *
     * @return json
     */
    public function updateQuantityCart()
    {
        header('Content-Type: application/json');
        $data = json_decode(file_get_contents('php://input'), true);

        $storeUseCase = new StoreUseCase;
        $response = $storeUseCase->updateQuantity($data['productId'], $data['quantityCart']);

        echo json_encode($response);
    }

    /**
     * Limpa o carrinho
     *
     * @return json
     */
    public function clearCart()
    {
        header('Content-Type: application/json');

        $storeUseCase = new StoreUseCase;
        $response = $storeUseCase->clear();

        echo json_encode($response);
    }
}
