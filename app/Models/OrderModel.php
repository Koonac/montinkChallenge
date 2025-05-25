<?php

class OrderModel extends Database
{
    /**
     * Contém a instância do pdo
     * 
     * @var object $pdo
     */
    private $pdo;

    /**
     * OrderModel Constructor
     * 
     */
    public function __construct()
    {
        $this->pdo = $this->connect();
    }

    /**
     * Retorna todos os registros da tabela
     * 
     */
    public function all()
    {
        $stmt = $this->pdo->query('SELECT * FROM orders');
        if ($stmt->rowCount() > 0) {
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } else {
            return [];
        }
    }

    /**
     * Cria um pedido
     * 
     * @param $attributes
     * @return array
     */
    public function create($attributes): array
    {
        $sql = 'INSERT INTO orders 
        (client_name, client_phone, total, sub_total, shipping_cost)
        VALUES
        (:clientName, :clientPhone, :total, :subTotal, :shippingCost);';

        $stmt = $this->pdo->prepare($sql);

        $stmt->execute([
            ':clientName'       => $attributes['clientName'],
            ':clientPhone'      => $attributes['clientPhone'],
            ':total'            => $attributes['total'],
            ':subTotal'         => $attributes['subTotal'],
            ':shippingCost'     => $attributes['shippingCost'],
        ]);

        return [
            'id' => $this->pdo->lastInsertId(),
            'message' => 'Pedido criado com sucesso.'
        ];
    }

    /**
     * Deleta um pedido
     * 
     * @param $id
     * @return array
     */
    public function delete($id): array
    {
        $sql = 'DELETE 
        FROM orders 
        WHERE (id = :id);';

        $stmt = $this->pdo->prepare($sql);

        $stmt->execute([
            ':id' => $id
        ]);

        return [
            'message' => 'Pedido deletado com sucesso.'
        ];
    }
}
