<?php

    require 'conexao.php';

    session_start();
 
    if ($_SERVER['REQUEST_METHOD'] === "POST") {
        $email = $_POST['email'];
        $senhaDigitada = $_POST['senha'];

        $stmt = $conexao->prepare('SELECT id_usuario, senha, tipo FROM usuarios WHERE email = :email LIMIT 1');
        $stmt->bindValue(':email', $email);
        $stmt->execute();

        $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($usuario && password_verify($senhaDigitada, $usuario['senha'])) {
            $_SESSION['id_usuario'] = $usuario['id_usuario'];
            $_SESSION['tipo'] = $usuario['tipo'];
            header('Location: home.php');
            exit;
        } else {
            echo "<script>alert('Algo está errado!');</script>";  
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

    <title>Login</title>

</head>

<body>

    <div class="container mt-5">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h5 class="d-flex justify-content-center">
                            Login
                        </h5>
                    </div>
                    <div class="card-body">
                        <form action="" method="POST">
                            <div class="mb-5">
                                <h5>E-mail</h5>
                                <input class="form-control" type="email" name="email">
                            </div>
                            <div class="mb-5">
                                <h5>Senha</h5>
                                <input class="form-control" type="password" name="senha">
                            </div>
                            <button type="submit" class="btn btn-primary">Entrar</button>
                            <a href="cadastrar.php" class="btn btn-danger">Cadastrar-se</a>
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

