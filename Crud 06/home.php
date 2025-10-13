<?php

    require 'conexao.php';

    session_start();

    if (!isset($_SESSION['id_usuario'])) {
        header('Location: cadastrar.php');
        exit;
    }

    $id_usuario = $_SESSION['id_usuario'];
    $tipo_usuario = $_SESSION['tipo'];

    $clientes = [];

    if ($tipo_usuario === 'usuario') {
        $stmt = $conexao->prepare("SELECT * FROM clientes WHERE id_usuario = :id_usuario;");
        $stmt->bindValue(':id_usuario', $id_usuario);
        $stmt->execute();
        $clientes = $stmt->fetchAll(PDO::FETCH_ASSOC);
    } if ($tipo_usuario === 'admin') {
        $stmt = $conexao->prepare("SELECT * FROM clientes");
        $stmt->execute();
        $clientes = $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    $stmt = $conexao->prepare("SELECT * FROM usuarios");
    $stmt->execute();
    $usuarios = $stmt->fetchAll(PDO::FETCH_ASSOC);

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

    <title>Home</title>

</head>

<body>

    <div class="container mt-5">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h5>
                            Menu Usuários
                            <a href="editar_usuario.php?id_usuario=<?=$_SESSION['id_usuario']?>" class="btn btn-info float-right">Configurações do Usuário</a>
                        </h5>
                        </div>
                            <div class="card-body">
                            <form action="" method="GET">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>ID_USUARIO</th>
                                            <th>Nome</th>
                                            <th>Email</th>
                                            <th>Perfil</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($usuarios as $usuario) {
                                        ?>
                                        <tr>
                                            <td><?=$usuario['id_usuario']?></td>
                                            <td><?=$usuario['nome']?></td>
                                            <td><?=$usuario['email']?></td>
                                            <td><?=$usuario['tipo']?></td>
                                        </tr>
                                    <?php } ?>
                                    </tbody>
                                </table>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container mt-5">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h5>
                            Clientes
                            <a class="btn btn-primary float-right" href="novo_cliente.php">Adicionar</a>
                        </h5>
                    </div>
                        <div class="card-body">
                            <div class="card-body">
                            <form action="" method="GET">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>ID_USUARIO</th>
                                            <th>Nome</th>
                                            <th>Serviço</th>
                                            <th>Mensalidade</th>
                                            <th>Ações</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($clientes as $cliente) {
                                        ?>
                                        <tr>
                                            <td><?=$cliente['id_usuario']?></td>
                                            <td><?=$cliente['nome']?></td>
                                            <td><?=$cliente['servico']?></td>
                                            <td><?php $mensalidade = $cliente['mensalidade'];
                                            $mensalidadeFormatada = "R$ " . number_format($mensalidade, 2, ',', '.'); echo $mensalidadeFormatada; ?>
                                        </td>
                                            <td>
                                            <a href="editar_cliente.php?id_cliente=<?= $cliente['id_cliente'] ?>"><i class="bi bi-pencil-fill"></i></a>

                                            <a onclick="return confirm('Tem certeza que deseja excluir?')" href="deletar_cliente.php?id_cliente=<?= $cliente['id_cliente'] ?>"><i class="bi bi-trash-fill text-danger"></i></a>
                                        </td>
                                        </tr>
                                    <?php } ?>
                                    </tbody>
                                </table>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <a href="logout.php" class="w-25 ml-auto mr-auto rounded mt-3 d-flex justify-content-center btn btn-danger">Logout</a>
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