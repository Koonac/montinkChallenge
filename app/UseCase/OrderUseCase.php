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
}
