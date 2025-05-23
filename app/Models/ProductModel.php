<?php

class ProductModel extends Database
{
    /**
     * Retorna todos os registros da tabela
     * 
     * @return array
     */
    public function all(): array
    {
        $stmt = $this->connect()->query('SELECT * FROM products');
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
        $stmt = $this->connect()->query("SELECT * FROM products WHERE id = $id");
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
        (:nome, :description, :price);';

        $stmt = $this->connect()->prepare($sql);

        $stmt->execute([
            ':nome'         => $attributes['nome'],
            ':description'  => $attributes['description'],
            ':price'        => $attributes['price'],
        ]);

        return [
            'id' => $this->connect()->lastInsertId(),
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

        $stmt = $this->connect()->prepare($sql);

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

        $stmt = $this->connect()->prepare($sql);

        $stmt->execute([
            ':id' => $id
        ]);

        return [
            'message' => 'Produto atualizado com sucesso.'
        ];
    }
}
