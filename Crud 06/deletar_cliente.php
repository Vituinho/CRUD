<?php

    require 'conexao.php';

    session_start();
    if (!isset($_SESSION['id_usuario'])) {
        header('Location: cadastrar.php');
        exit;
    }

    $id_cliente = $_GET['id_cliente'] ?? null;

    if ($id_cliente === null) {
        echo '<script>alert("Valor está nulo!");</script>';
    } else {

        $query = "DELETE FROM clientes WHERE id_cliente = :id_cliente;";

        $stmt = $conexao->prepare($query);
        $stmt->bindValue(':id_cliente', $id_cliente);
        $stmt->execute();

        header('Location: home.php');
        exit;

    }   

?>