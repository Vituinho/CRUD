<?php

    require 'conexao.php';

    session_start();
    if (!isset($_SESSION['id_usuario'])) {
        header('Location: cadastrar.php');
        exit;
    }

    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        $nome = $_POST['nome'];
        $email = $_POST['email'];
        $senha = password_hash($_POST['senha'], PASSWORD_DEFAULT);
        

        if (!empty(trim($nome)) && !empty(trim($email) && !empty(trim($senha)))) {

            $check = $conexao->prepare('SELECT id FROM usuarios WHERE email = :email LIMIT 1');
            $check->bindValue(':email', $email);
            $check->execute();

            if ($check->rowCount() > 0) {
                echo "<script>alert('E-mail já está sendo utilizado!');</script>";    
            } else {
                $stmt = $conexao->prepare("INSERT INTO usuarios (nome, email, senha) values (:nome, :email, :senha)");
                $stmt->bindValue(':nome', $nome);
                $stmt->bindValue(':email', $email);
                $stmt->bindValue(':senha', $senha);        
                $stmt->execute();

                header('Location: index.php');
                exit;
            }
            
        } else {
            echo "<script>alert('Preencha todos os campos!');</script>";
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

    <title>Cadastrar-se</title>

</head>

<body>

    <div class="container mt-5">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h5 class="d-flex justify-content-center">
                            Cadastrar-se
                        </h5>
                    </div>
                    <div class="card-body">
                        <form action="" method="POST">
                            <div class="mb-5">
                                <h5>Nome</h5>
                                <input class="form-control" type="text" name="nome">
                            </div>
                            <div class="mb-5">
                                <h5>E-mail</h5>
                                <input class="form-control" type="email" name="email">
                            </div>
                            <div class="mb-5">
                                <h5>Senha</h5>
                                <input class="form-control" type="password" name="senha">
                            </div>
                            <button type="submit" class="btn btn-primary">Cadastrar</button>
                            <a class="btn btn-danger" href="index.php">Voltar</a>
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

