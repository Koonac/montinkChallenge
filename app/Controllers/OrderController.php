<?php

class OrderController extends RenderView
{
    /**
     * Exibe a lista de pedidos.
     *
     * @return void
     */
    public function index()
    {
        $orderModel = new OrderModel;

        $this->loadView('orders', [
            'title'     => 'Pedidos',
            'orders'    => Helpers::listToCamelCase($orderModel->all())
        ]);
    }

    /**
     * Processa o formulário e cria um pedido.
     *
     * @return void
     */
    public function store()
    {
        $form = $_POST;

        $orderUseCase = new OrderUseCase;
        $data = $orderUseCase->createBySession($form);

        if ($data['status']) {
            header("Location: " . Router::baseUrl('/pedidos'));
            exit;
        }

        printDie($data);
    }
}
