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
    }

    /**
     * Processa o payload de webhook de pedidos.
     *
     * @return json
     */
    public function webhook()
    {
        header('Content-Type: application/json');
        $data = json_decode(file_get_contents('php://input'), true);

        $orderUseCase = new OrderUseCase;
        $response = $orderUseCase->webhook($data);

        if (!$response['status']) http_response_code($response['code']);

        echo json_encode($response);
    }
}
