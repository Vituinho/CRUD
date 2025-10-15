<?php
namespace App;

use PDO;
use PDOException;

class Connection {
    public static function getDb(): PDO {
        $host = 'localhost';
        $dbName = 'CRUD_POO';
        $user = 'root';
        $pass = '';

        try {
            // Conecta sem banco, pra criar se não existir
            $conn = new PDO("mysql:host=$host", $user, $pass);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            // Cria banco se não existir
            $conn->exec("CREATE DATABASE IF NOT EXISTS $dbName CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci");

            // Seleciona o banco
            $conn->exec("USE $dbName");

            // Cria a tabela usuarios se não existir
            $conn->exec("CREATE TABLE IF NOT EXISTS usuarios (
                id INT AUTO_INCREMENT PRIMARY KEY,
                nome VARCHAR(100) NOT NULL,
                email VARCHAR(100) NOT NULL,
                senha VARCHAR(255) NOT NULL
            )");

            return $conn;

        } catch (PDOException $e) {
            echo "Erro ao conectar/criar banco: " . $e->getMessage();
            exit;
        }
    }
}
