<?php

class OrderModel extends Database
{
    /**
     * Retorna todos os registros da tabela
     * 
     */
    public function all()
    {
        $stmt = $this->connect()->query('SELECT * FROM orders');
        if ($stmt->rowCount() > 0) {
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } else {
            return [];
        }
    }
}
