<?php

    require 'conexao.php';

    session_start();
    if (!isset($_SESSION['id_usuario'])) {
        header('Location: cadastrar.php');
        exit;
    }

    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        $nome = $_POST['nome'];
        $servico = $_POST['servico'];
        $mensalidade = $_POST['mensalidade'];
        $id_usuario = $_SESSION['id_usuario'];

        if (!empty(trim($nome)) && !empty(trim($servico)) && !empty(trim($mensalidade)) && !empty(trim($id_usuario))) {
            $query = "INSERT INTO clientes (nome, servico, mensalidade, id_usuario) values (:nome, :servico, :mensalidade, :id_usuario)";

            $stmt = $conexao->prepare($query);
            $stmt->bindValue(':nome', $nome);
            $stmt->bindValue(':servico', $servico);
            $stmt->bindValue(':mensalidade', $mensalidade);
            $stmt->bindValue(':id_usuario', $id_usuario);
            $stmt->execute();

            header('Location: home.php');
            exit;
        }

    }

?>

<head>
    <!-- Meta tags Obrigatórias -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"
        integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

    <title>Novo Cliente</title>

</head>

<body>

    <div class="container mt-5">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h5>
                            Novo Cliente
                            <a href="home.php" class="btn btn-danger float-right">Voltar</a>
                        </h5>
                    </div>
                    <div class="card-body">
                        <form action="" method="POST">
                            <div class="mb-5">
                                <h5>Nome</h5>
                                <input class="form-control" type="text" name="nome">
                            </div>
                            <div class="mb-5">
                                <h5>Serviço</h5>
                                <input class="form-control" type="text" name="servico">
                            </div>
                            <div class="mb-5">
                                <h5>Mensalidade</h5>
                                <input class="form-control" type="number" name="mensalidade">
                            </div>
                            <button type="submit" class="btn btn-primary">Adicionar</button>
                    
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

