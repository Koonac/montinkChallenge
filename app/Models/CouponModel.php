<?php

class CouponModel extends Database
{
    /**
     * Retorna todos os registros da tabela
     * 
     */
    public function all()
    {
        $stmt = $this->connect()->query('SELECT * FROM coupons');
        if ($stmt->rowCount() > 0) {
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } else {
            return [];
        }
    }
}
