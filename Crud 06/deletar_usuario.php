<?php

    require 'conexao.php';

    session_start();
    if (!isset($_SESSION['id_usuario'])) {
        header('Location: cadastrar.php');
        exit;
    }

    $id_usuario = $_GET['id_usuario'] ?? null;

    if ($id_usuario === null) {
        echo '<script>alert("Valor está nulo!");</script>';
    } else {

        $query = "DELETE FROM usuarios WHERE id_usuario = :id_usuario;";

        $stmt = $conexao->prepare($query);
        $stmt->bindValue(':id_usuario', $id_usuario);
        $stmt->execute();

        session_destroy();
        header('Location: cadastro.php');
        exit;

    }   

?>