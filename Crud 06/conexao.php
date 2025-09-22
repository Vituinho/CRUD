<?php

$dsn = 'mysql:host=localhost';
$usuario = 'root';
$senha = '';

try {
    $conexao = new PDO($dsn, $usuario, $senha); 
} catch (PDOException $e) {
    echo 'erro ' . $e->getCode() . ' ' . $e->getMessage();
}

$conexao->exec("CREATE DATABASE IF NOT EXISTS crud_otavio");
$conexao->exec("USE crud_otavio");

$query = "CREATE TABLE IF NOT EXISTS usuarios (
    id_usuario INT PRIMARY KEY AUTO_INCREMENT,
    nome varchar(100),
    email varchar(250),
    senha varchar(100)
);";

$stmt = $conexao->prepare($query);

$stmt->execute();

$conexao->exec("USE crud_otavio");

$query = "CREATE TABLE IF NOT EXISTS clientes (
    id_cliente INT PRIMARY KEY AUTO_INCREMENT,
    nome varchar(100),
    servico varchar(250),
    mensalidade decimal,
    id_usuario INT,
    FOREIGN KEY (id_usuario) REFERENCES usuarios(id_usuario)
);";

$stmt = $conexao->prepare($query);

$stmt->execute();

?>