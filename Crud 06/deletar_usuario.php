<?php
require 'conexao.php';

session_start();

if (!isset($_SESSION['id_usuario'])) {
    header('Location: cadastrar.php');
    exit;
}

$id_usuario = $_SESSION['id_usuario'];

try {

    $query = "DELETE FROM clientes WHERE id_usuario = :id_usuario";
    $stmt = $conexao->prepare($query);
    $stmt->bindValue(':id_usuario', $id_usuario);
    $stmt->execute();

    $query = "DELETE FROM usuarios WHERE id_usuario = :id_usuario";
    $stmt = $conexao->prepare($query);
    $stmt->bindValue(':id_usuario', $id_usuario, PDO::PARAM_INT);
    $stmt->execute();

    session_destroy();
    header('Location: cadastrar.php');
    exit;

} catch (PDOException $e) {
    echo "Erro ao deletar: " . $e->getMessage();
}
?>
