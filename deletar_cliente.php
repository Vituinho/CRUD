<?php

    require 'conexao.php';

    session_start();
    if (!isset($_SESSION['id_usuario'])) {
        header('Location: cadastrar.php');
        exit;
    }

    $id = $_GET['id'] ?? null;

    if ($id === null) {
        echo '<script>alert("Valor está nulo!");</script>';
    } else {
        
    }

?>