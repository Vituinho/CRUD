<?php

    require 'criar_banco.php';

    session_start();

    $id = $_GET['id'] ?? null;

    

    if ($id == null) {
        echo "<script>alert('Valor está nulo!');</script>";
    } else {
        $stmt = $conexao->prepare("SELECT * FROM tarefas WHERE id = :id and usuario_id = :usuario_id");
        $stmt->bindValue(':id', $id);
        $stmt->bindValue(':usuario_id', $_SESSION['id_usuario']);
        $stmt->execute();
        $tarefa = $stmt->fetch(PDO::FETCH_ASSOC);

        if($_SERVER["REQUEST_METHOD"] === "POST") {
            $titulo = $_POST['titulo'];
            $descricao = $_POST['descricao'];

            if (!empty(trim($titulo)) && !empty(trim($descricao))) {

            $query = "
                UPDATE tarefas
                SET titulo = :titulo,
                    descricao = :descricao
            WHERE id = :id AND usuario_id = :usuario_id";

            $stmt = $conexao->prepare($query);
            $stmt->bindValue(':titulo', $titulo);
            $stmt->bindValue(':descricao', $descricao);
            $stmt->bindValue(':usuario_id', $_SESSION['id_usuario']);
            $stmt->bindValue(':id', $id);
            $stmt->execute();

            header('Location: read.php');
            exit;
            } else {
                echo "<script>alert('Preencha da forma correta!');</script>";
            }
        }
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
                        <h5>
                            CRUD - UPDATE
                            <a href="" class="btn btn-danger float-right">Voltar</a>
                        </h5>
                    </div>
                    <div class="card-body">
                        <form action="" method="POST">
                            <div class="mb-3">
                                <h5>Titulo</h5>
                                <input type="text" name="titulo" value="<?= $tarefa['titulo'] ?>" class="form-control">
                            </div>
                            <div class="mb-3">
                                <h5>Descrição</h5>
                                <input type="text" name="descricao" value="<?= $tarefa['descricao'] ?>" class="form-control">
                            </div>
                            <button type="submit" class="btn btn-primary">Salvar</button>
                        </form>
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