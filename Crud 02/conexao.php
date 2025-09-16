<?php

    $dsn = 'mysql:host=localhost;dbname=crud_produtos'; 
    $usuario = 'root';
    $senha = '';

    try {
        $conexao = new PDO($dsn, $usuario, $senha);
    } catch (PDOException $e) {
        echo 'Erro ' . $e->getCode(). ': ' . $e->getMessage();
    }

?>