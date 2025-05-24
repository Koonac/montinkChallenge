<?php

class StockModel extends Database
{
    /**
     * Contém a instância do pdo
     * 
     * @var object $pdo
     */
    private $pdo;

    /**
     * ProductModel Constructor
     * 
     */
    public function __construct()
    {
        $this->pdo = $this->connect();
    }

    /**
     * Cria um estoque
     * 
     * @param $attributes
     * @return array
     */
    public function create($attributes): array
    {
        $sql = 'INSERT INTO stocks 
        (product_id, quantity)
        VALUES
        (:productId, :quantity);';

        $stmt = $this->pdo->prepare($sql);

        $stmt->execute([
            ':productId'    => $attributes['productId'],
            ':quantity'     => $attributes['quantity'],
        ]);

        return [
            'id' => $this->pdo->lastInsertId(),
            'message' => 'Estoque criado com sucesso.'
        ];
    }

    /**
     * Atualiza um estoque
     * 
     * @param $id
     * @param $attributes
     * @return array
     */
    public function update($id, $attributes): array
    {
        $sql = 'UPDATE stocks SET 
        quantity = :quantity
        WHERE
        (id = :id);';

        $stmt = $this->pdo->prepare($sql);

        $stmt->execute([
            ':id'       => $id,
            ':quantity' => $attributes['quantity'],
        ]);

        return [
            'message' => 'Estoque atualizado com sucesso.'
        ];
    }
}
