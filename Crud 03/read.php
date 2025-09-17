<?php

    require 'criar_banco.php';

    session_start();
    if (!isset($_SESSION['id_usuario'])) {
        header('Location: login.php');
        exit;
    } else {
        if($_SERVER["REQUEST_METHOD"] === "POST") {
            $titulo = $_POST['titulo'];
            $descricao = $_POST['descricao'];
            $id_usuario = $_SESSION['id_usuario'];

            if (!empty(trim($titulo)) && !empty(trim($descricao))) {

            $stmt = $conexao->prepare("SELECT * FROM tarefas WHERE titulo = :titulo and usuario_id = :id_usuario");
            $stmt->bindValue(':titulo', $titulo);
            $stmt->bindValue(':id_usuario', $id_usuario);
            $stmt->execute();
            
            if ($stmt->rowCount() > 0) {
                echo "<script>alert('Título já cadastrado!');</script>";
            } else {
    
            $query = "INSERT INTO tarefas (titulo, descricao, usuario_id) values (:titulo, :descricao, :id_usuario);";

            $stmt = $conexao->prepare($query);
            $stmt->bindValue(':titulo', $titulo);
            $stmt->bindValue(':descricao', $descricao);
            $stmt->bindValue(':id_usuario', $id_usuario);
            $stmt->execute();
            }
        }
    }

        $query = "SELECT * FROM tarefas WHERE usuario_id = :id_usuario";

    $stmt = $conexao->prepare($query);
    $stmt->bindValue(':id_usuario', $_SESSION['id_usuario']);
    $stmt->execute();

    $tarefas = $stmt->fetchAll(PDO::FETCH_ASSOC);

    }

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <!-- Meta tags Obrigatórias -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"
        integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

    <title>CREATE</title>

</head>

<body>

    <div class="container mt-5">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h5 class="d-flex justify-content-center">
                            TAREFAS
                        </h5>
                    </div>

                    <div class="card-body">

                            <form action="" method="POST">
                                <div class="mb-3">
                                    <h5>Título</h5>
                                    <input type="text" name="titulo" class="form-control">
                                </div>
                                <div class="mb-3">
                                    <h5>Descrição</h5>
                                    <textarea name="descricao" class="form-control"></textarea>
                                </div>
                                <button type="submit" class="btn btn-primary">Salvar</button>
                            </form>

                        <table class="table table-striped-columns mt-5"> 
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>TITULO</th>
                                        <th>DESCRIÇÃO</th>
                                        <th>USUARIO_ID</th>
                                        <th>AÇÕES</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        if (count($tarefas) > 0) {
                                foreach($tarefas as $tarefa) {
                                    ?>
                                    <tr>
                                        <td><?=$tarefa['id']?></td>
                                        <td><?=$tarefa['titulo']?></td>
                                        <td><?=$tarefa['descricao']?></td>
                                        <td><?=$tarefa['usuario_id']?></td>
                                        <td>
                                            <a href="update.php?id=<?=$tarefa['id'] ?>"><i class="bi bi-pencil-fill btn btn-primary mb-1">Update</i></a>

                                            <a onclick="return confirm('Tem certeza que deseja excluir esta tarefa?')"; href="delete.php?id=<?=$tarefa['id'] ?>"><i class="bi bi-trash-fill btn btn-danger mb-1">Delete</i></a>
                                    
                                    </td>
                                    </tr>
                                    <?php 
                                    }
                                } 
                            ?>
                        </tbody>
                            </table>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- JavaScript (Opcional) -->
    <!-- jQuery primeiro, depois Popper.js, depois Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
        crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"
        integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49"
        crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"
        integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy"
        crossorigin="anonymous"></script>
</body>

</html>