<?php

    require 'conexao.php';

    $id = $_GET['id'] ?? null;

    if ($id === null) {
        echo "<script>alert('Valor de ID nulo!');</script>";
        header('Location: index.php');
        exit;
    } else {
        $stmt = $conexao->prepare("DELETE FROM tarefas WHERE id = :id");
        $stmt->bindValue(':id', $id);
        $stmt->execute();

        header('Location: index.php');
        exit;
    }

?>