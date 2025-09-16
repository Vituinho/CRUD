<?php

    require 'conexao.php';

    $id = $_GET['id'] ?? null;

    if ($id == null) {
        header('Location: listar.php');
        exit;
    }

    $stmt = $conexao->prepare("DELETE FROM produtos WHERE id = :id");
    $stmt->bindValue(':id', $id);
    $stmt->execute();

    header('Location: listar.php');
    exit;
?>