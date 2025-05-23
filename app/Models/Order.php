<?php

class Order extends Database
{
    private $pdo;

    public function __construct()
    {
        $this->pdo = $this->connect();
    }

    public function all()
    {
        $stmt = $this->pdo->query('SELECT * FROM orders');
        if ($stmt->rowCount() > 0) {
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } else {
            return [];
        }
    }
}
