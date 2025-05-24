<?php

class ProductModel extends Database
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
     * Retorna todos os registros da tabela
     * 
     * @return array
     */
    public function all(): array
    {
        $sql = 'SELECT 
        products.id, 
        products.name, 
        products.description, 
        products.price, 
        stocks.quantity,
        (SELECT COUNT(id) FROM variations WHERE products.id = variations.parent_product_id) AS quantity_variations
        FROM 
        products
        INNER JOIN stocks ON products.id = stocks.product_id
        WHERE
        products.is_variation = false;';

        $stmt = $this->pdo->query($sql);
        if ($stmt->rowCount() > 0) {
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } else {
            return [];
        }
    }

    /**
     * Retorna um produto
     * 
     * @param $id
     * @return array
     */
    public function find($id): array
    {
        $sql = "SELECT 
        products.id, 
        products.name, 
        products.description, 
        products.price
        FROM 
        products 
        WHERE 
        products.id = $id";

        $stmt = $this->pdo->query($sql);
        if ($stmt->rowCount() > 0) {
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } else {
            return [];
        }
    }

    /**
     * Retorna um produto com variações
     * 
     * @param $id
     * @return array
     */
    public function getWithVariations($id): array
    {
        $sql = "SELECT 
        products.id, 
        products.name, 
        products.description, 
        products.price, 
        stocks.quantity
        FROM 
        products 
        INNER JOIN stocks ON products.id = stocks.product_id
        WHERE 
        products.id = $id";

        $stmt = $this->pdo->query($sql);
        if ($stmt->rowCount() > 0) {
            $product = $stmt->fetch(PDO::FETCH_ASSOC);

            $variationModel = new VariationModel;
            $variations = $variationModel->allByProduct($id);

            return [
                ...$product,
                'variations' => $variations
            ];
        } else {
            return [];
        }
    }

    /**
     * Cria um produto
     * 
     * @param $attributes
     * @return array
     */
    public function create($attributes): array
    {
        $sql = 'INSERT INTO products 
        (name, description, price, is_variation)
        VALUES
        (:name, :description, :price, :isVariation);';

        $stmt = $this->pdo->prepare($sql);

        $stmt->execute([
            ':name'         => $attributes['name'],
            ':description'  => $attributes['description'] ?? null,
            ':price'        => $attributes['price'] ?? 0,
            ':isVariation'  => $attributes['isVariation'] ?? false,
        ]);

        return [
            'id' => $this->pdo->lastInsertId(),
            'message' => 'Produto criado com sucesso.'
        ];
    }

    /**
     * Atualiza um produto
     * 
     * @param $id
     * @param $attributes
     * @return array
     */
    public function update($id, $attributes): array
    {
        $sql = 'UPDATE products SET 
        name = :name, 
        description = :description, 
        price = :price
        WHERE
        (id = :id);';

        $stmt = $this->pdo->prepare($sql);

        $stmt->execute([
            ':id'           => $id,
            ':name'         => $attributes['name'],
            ':description'  => $attributes['description'],
            ':price'        => $attributes['price'],
        ]);

        return [
            'message' => 'Produto atualizado com sucesso.'
        ];
    }

    /**
     * Deleta um produto
     * 
     * @param $id
     * @return array
     */
    public function delete($id): array
    {
        $sql = 'DELETE 
        FROM products 
        WHERE (id = :id);';

        $stmt = $this->pdo->prepare($sql);

        $stmt->execute([
            ':id' => $id
        ]);

        return [
            'message' => 'Produto deletado com sucesso.'
        ];
    }
}
