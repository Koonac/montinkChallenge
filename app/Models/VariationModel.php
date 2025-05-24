<?php

class VariationModel extends Database
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
     * Retorna toas as variações de um produto
     * 
     * @param $productId
     * @return array
     */
    public function allByProduct($productId): array
    {
        $sql = "SELECT
        products_variations.id, 
        products_variations.name, 
        products_variations.description, 
        products_variations.price, 
        stocks.quantity
        FROM 
        variations
        INNER JOIN products AS products_variations ON variations.variation_id = products_variations.id
        INNER JOIN stocks ON products_variations.id = stocks.product_id
        WHERE
        variations.parent_product_id = $productId;";

        $stmt = $this->pdo->query($sql);
        if ($stmt->rowCount() > 0) {
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } else {
            return [];
        }
    }

    /**
     * Retorna uma variação
     * 
     * @param $id
     * @return array
     */
    public function find($id): array
    {
        $sql = "";

        $stmt = $this->pdo->query($sql);
        if ($stmt->rowCount() > 0) {
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } else {
            return [];
        }
    }

    /**
     * Cria uma variação
     * 
     * @param $attributes
     * @return array
     */
    public function create($attributes): array
    {
        $sql = 'INSERT INTO variations 
        (parent_product_id, variation_id)
        VALUES
        (:parentProductId, :variationId);';

        $stmt = $this->pdo->prepare($sql);

        $stmt->execute([
            ':parentProductId'  => $attributes['parentProductId'],
            ':variationId'      => $attributes['variationId']
        ]);

        return [
            'id' => $this->pdo->lastInsertId(),
            'message' => 'Variação criada com sucesso.'
        ];
    }
}
