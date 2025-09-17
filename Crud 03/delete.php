<?php

    require 'criar_banco.php';

    $id = $_GET['id'] ?? null;

     if ($id == null) {
        echo "<script>alert('Valor está nulo!');</script>";
        header('Location: read.php');
        exit;
    } else {
        $stmt = $conexao->prepare("DELETE FROM tarefas WHERE id = :id");
        $stmt->bindValue('id', $id);
        $stmt->execute();

        header('Location: read.php');
        exit;
    }

?>