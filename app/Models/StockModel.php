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
     * @param $productId
     * @param $attributes
     * @return array
     */
    public function updateByProduct($productId, $attributes): array
    {
        $sql = 'UPDATE stocks SET 
        quantity = :quantity
        WHERE
        (product_id = :productId);';

        $stmt = $this->pdo->prepare($sql);

        $stmt->execute([
            ':productId'    => $productId,
            ':quantity'     => $attributes['quantity'],
        ]);

        return [
            'message' => 'Estoque atualizado com sucesso.'
        ];
    }

    /**
     * Incrementa um valor ao estoque
     * 
     * @param $productId
     * @param $attributes
     * @return array
     */
    public function incrementByProduct($productId, $attributes): array
    {
        $sql = 'UPDATE stocks SET 
        quantity = quantity + :quantity
        WHERE
        (product_id = :productId);';

        $stmt = $this->pdo->prepare($sql);

        $stmt->execute([
            ':productId'    => $productId,
            ':quantity'     => $attributes['quantity'],
        ]);

        return [
            'message' => 'Estoque atualizado com sucesso.'
        ];
    }

    /**
     * Decrementa um valor ao estoque
     * 
     * @param $productId
     * @param $attributes
     * @return array
     */
    public function decrementByProduct($productId, $attributes): array
    {
        $sql = 'UPDATE stocks SET 
        quantity = quantity - :quantity
        WHERE
        (product_id = :productId);';

        $stmt = $this->pdo->prepare($sql);

        $stmt->execute([
            ':productId'    => $productId,
            ':quantity'     => $attributes['quantity'],
        ]);

        return [
            'message' => 'Estoque atualizado com sucesso.'
        ];
    }
}
