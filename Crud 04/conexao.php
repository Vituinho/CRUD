<?php

$dsn = 'mysql:host=localhost';
$usuario = 'root';
$senha = '';

try {
    $conexao = new PDO($dsn, $usuario, $senha); 
} catch (PDOException $e) {
    echo 'erro ' . $e->getCode() . ' ' . $e->getMessage();
}

$conexao->exec("CREATE DATABASE IF NOT EXISTS crud");
$conexao->exec("USE crud");

$query = "CREATE TABLE IF NOT EXISTS tarefas (
    id INT PRIMARY KEY AUTO_INCREMENT,
    titulo varchar(30),
    status varchar(30) default 'pendente'
);";

$stmt = $conexao->prepare($query);

$stmt->execute();

?>