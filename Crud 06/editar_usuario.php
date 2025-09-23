<?php

    require 'conexao.php';

    session_start();
    if (!isset($_SESSION['id_usuario'])) {
        header('Location: cadastrar.php');
        exit;
    }

    $id_usuario = $_GET['id_usuario'] ?? null;

    if ($id_usuario === null) {
        echo '<script>alert("Valor está nulo!");</script>';
    } else {
        $stmt = $conexao->prepare("SELECT * FROM usuarios WHERE id_usuario = :id_usuario");
        $stmt->bindValue(':id_usuario', $id_usuario);
        $stmt->execute();
        $usuario = $stmt->fetch(PDO::FETCH_ASSOC);
    }

    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        $nome = $_POST['nome'];
        $email = $_POST['email'];
        $senha = password_hash($_POST['senha'], PASSWORD_DEFAULT);

        if (!empty(trim($nome)) && !empty(trim($email)) && !empty(trim($senha)) && !empty(trim($id_usuario))) {
            $query = "
                UPDATE usuarios
                SET nome = :nome,
                    email = :email,
                    senha = :senha
                where id_usuario = :id_usuario;
            ";

            $stmt = $conexao->prepare($query);
            $stmt->bindValue(':nome', $nome);
            $stmt->bindValue(':email', $email);
            $stmt->bindValue(':senha', $senha);
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
                            Editar Usuário
                            <a href="home.php" class="btn btn-danger float-right">Voltar</a>
                        </h5>
                    </div>
                    <div class="card-body">
                        <form action="" method="POST">
                            <div class="mb-5">
                                <h5>Nome</h5>
                                <input class="form-control" type="text" name="nome" value="<?=$usuario['nome']?>">
                            </div>
                            <div class="mb-5">
                                <h5>E-mail</h5>
                                <input class="form-control" type="text" name="email" value="<?=$usuario['email']?>">
                            </div>
                            <div class="mb-5">
                                <h5>Senha</h5>
                                <input class="form-control" type="password" name="senha" value="">
                            </div>
                            <button type="submit" class="btn btn-primary">Salvar</button>
                            <a onclick="return confirm('Tem certeza que deseja excluir esse Usuário?')" class="btn btn-danger" href="deletar_usuario.php?id_usuario=<?=$usuario['id_usuario']?>">Deletar Usuário</a>
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