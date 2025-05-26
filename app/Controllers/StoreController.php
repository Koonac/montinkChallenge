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
        $response = $storeUseCase->add($data['product'], $data['quantityCart']);

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
     * Decrementa uma quantidade de um determinado produto no carrinho
     *
     * @return json
     */
    public function decrementQuantityCart()
    {
        header('Content-Type: application/json');
        $data = json_decode(file_get_contents('php://input'), true);

        $storeUseCase = new StoreUseCase;
        $response = $storeUseCase->decrementQuantityCart($data['productId']);

        echo json_encode($response);
    }

    /**
     * Incrementa uma quantidade de um determinado produto no carrinho
     *
     * @return json
     */
    public function incrementQuantityCart()
    {
        header('Content-Type: application/json');
        $data = json_decode(file_get_contents('php://input'), true);

        $storeUseCase = new StoreUseCase;
        $response = $storeUseCase->incrementQuantityCart($data['productId']);

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
