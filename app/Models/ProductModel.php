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
        products.name, 
        products.description, 
        products.price, 
        stocks.quantity
        FROM 
        products
        INNER JOIN stocks ON products.id = stocks.product_id;';

        $stmt = $this->pdo->query($sql);
        if ($stmt->rowCount() > 0) {
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } else {
            return [];
        }
    }

    /**
     * Retorna todos os registros da tabela
     * 
     * @param $id
     * @return array
     */
    public function get($id): array
    {
        $sql = "SELECT * FROM products WHERE id = $id";

        $stmt = $this->pdo->query($sql);
        if ($stmt->rowCount() > 0) {
            return $stmt->fetch(PDO::FETCH_ASSOC);
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
        (name, description, price)
        VALUES
        (:name, :description, :price);';

        $stmt = $this->pdo->prepare($sql);

        $stmt->execute([
            ':name'         => $attributes['name'],
            ':description'  => $attributes['description'],
            ':price'        => $attributes['price'],
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
            ':nome'         => $attributes['nome'],
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
            'message' => 'Produto atualizado com sucesso.'
        ];
    }
}
