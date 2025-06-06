<?php

class OrderUseCase
{
    /**
     * Cria um pedido
     * 
     * @param $attributes
     * @return array
     */
    public function create($attributes)
    {
        try {
            $orderModel = new OrderModel;
            $orderCreated = $orderModel->create($attributes);
            $orderId = $orderCreated['id'];

            return [
                'status'    => true,
                'message'   => 'Pedido criado com sucesso.',
            ];
        } catch (Exception $e) {
            if (isset($orderId) && !empty($orderId)) $orderModel->delete($orderId);
            return [
                'status'    => false,
                'message'   => 'Falha ao criar um pedido',
                'code'      => $e->getCode(),
                'error'     => $e->getMessage()
            ];
        }
    }

    /**
     * Cria um pedido armazenado na session
     * 
     * @param $attributes
     * @return array
     */
    public function createBySession($attributes)
    {
        try {
            $storeUseCase = new StoreUseCase;
            $productsCart = $storeUseCase->all();

            if (count($productsCart['data']['cart']) > 0) {
                $getTotal = $storeUseCase->getTotal();

                $data = $this->create([
                    'clientName'    => $attributes['clientName'],
                    'clientPhone'   => $attributes['clientPhone'],
                    'total'         => $getTotal['data']['total'],
                    'subTotal'      => $getTotal['data']['subTotal'],
                    'shippingCost'  => $getTotal['data']['shippingFee'],
                ]);
                if (!$data['status']) {
                    throw new Exception($data['message'] . "\n" . $data['error']);
                };

                $storeUseCase->clear();
            }

            return [
                'status'    => true,
                'message'   => 'Pedido criado com sucesso.',
            ];
        } catch (Exception $e) {
            return [
                'status'    => false,
                'message'   => 'Falha ao criar um pedido',
                'code'      => $e->getCode(),
                'error'     => $e->getMessage()
            ];
        }
    }

    /**
     * Deleta um pedido 
     * 
     * @param $id
     * @return array
     */
    public function delete($id)
    {
        try {
            $orderModel = new OrderModel;
            $orderModel->delete($id);

            return [
                'status'    => true,
                'message'   => 'Pedido deletado com sucesso.',
            ];
        } catch (Exception $e) {
            return [
                'status'    => false,
                'message'   => 'Falha ao deletar a pedido',
                'code'      => $e->getCode(),
                'error'     => $e->getMessage()
            ];
        }
    }

    /**
     * Processa o webhook
     * 
     * @param $attributes
     * @return array
     */
    public function webhook($attributes)
    {
        try {
            $orderId    = $attributes['orderId'] ?? null;
            $status     = $attributes['status'] ?? null;

            if (empty($orderId)) throw new Exception("O campo 'orderId' é obrigatório.", 400);
            if (empty($status)) throw new Exception("O campo 'status' é obrigatório.", 400);
            if (!Helpers::orderStatusExists($status)) throw new Exception("O status informado não existe. Valores aceitos: created|approved|shipped|delivered|cancelled", 400);

            $orderModel = new OrderModel;
            $order = $orderModel->find($orderId);

            if (empty($order)) throw new Exception("Pedido não encontrado.", 404);

            ($status == 'cancelled')
                ? $orderModel->delete($orderId)
                : $orderModel->updateStatus($orderId, $status);

            return [
                'status'    => true,
                'message'   => 'Pedido processado com sucesso.',
            ];
        } catch (Exception $e) {
            return [
                'status'    => false,
                'message'   => 'Falha ao processar um pedido',
                'code'      => $e->getCode(),
                'error'     => $e->getMessage()
            ];
        }
    }
}
