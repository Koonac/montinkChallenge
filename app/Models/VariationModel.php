<?php

class VariationModel extends Database
{
    /**
     * Retorna toas as variações de um produto
     * 
     * @param $productId
     * @return array
     */
    public function allByProduct($productId): array
    {
        $sql = "";

        $stmt = $this->connect()->query($sql);
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
    public function get($id): array
    {
        $sql = "";

        $stmt = $this->connect()->query($sql);
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

        $stmt = $this->connect()->prepare($sql);

        $stmt->execute([
            ':parentProductId'  => $attributes['parentProductId'],
            ':variationId'      => $attributes['variationId']
        ]);

        return [
            'id' => $this->connect()->lastInsertId(),
            'message' => 'Variação criada com sucesso.'
        ];
    }
}
