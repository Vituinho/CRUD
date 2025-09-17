<?php

    $dsn = 'mysql:host=localhost'; 
    $usuario = 'root';
    $senha = '';

    try {
        $conexao = new PDO($dsn, $usuario, $senha);
    } catch (PDOException $e) {
        echo 'Erro ' . $e->getCode() . $e->getMessage();
    }


    $conexao->exec("CREATE DATABASE IF NOT EXISTS crud_auth");

    $conexao->exec("USE crud_auth");

    $query = "CREATE TABLE IF NOT EXISTS usuarios (
        id int primary key AUTO_INCREMENT,
        nome varchar(100) not null,
        email varchar(100) unique,
        senha varchar(255)
    );";

    $stmt = $conexao->prepare($query);
    $stmt->execute();

    $query = "CREATE TABLE IF NOT EXISTS tarefas (
        id int primary key AUTO_INCREMENT,
        titulo varchar(150),
        descricao text,
        usuario_id int,
        foreign key (usuario_id) references usuarios(id)
    );";

    $stmt = $conexao->prepare($query);
    $stmt->execute();

?>