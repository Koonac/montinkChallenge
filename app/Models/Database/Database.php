<?php
require_once __DIR__ . '/../../../config.php';

class Database
{
    public function connect()
    {
        try {
            $name = getenv('DB_NAME');
            $host = getenv('DB_HOST');
            $user = getenv('DB_USER');
            $pass = getenv('DB_PASS');

            $pdo = new PDO("mysql:dbname=$name;host=$host", $user, $pass);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $pdo;
        } catch (PDOException $err) {
            echo 'Ocorreu um erro inesperado. ';
            echo $err->getMessage();
        }
    }
}
