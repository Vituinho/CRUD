<?php

    require 'conexao.php';

    $stmt = $conexao->prepare("SELECT * FROM produtos");
    $stmt->execute();
    $produtos = $stmt->fetchAll(PDO::FETCH_ASSOC);

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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">

    <title>CRUD - LISTAR</title>

</head>

<body>

    <div class="card-header">
        <h4>CRUD - PRODUTOS</h4>
    </div>

    <div class="card-body">
        <div class="container mt-5">
            <div class="row">
                <table class="table table-striped-columns"> 
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>NOME</th>
                            <th>PREÇO</th>
                            <th>QUANTIDADE</th>
                            <th>DESCRIÇÃO</th>
                            <th>AÇÕES</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            if (count($produtos) > 0) {
                                foreach($produtos as $produto) {
                        ?>
                                <tr>
                                    <td><?=$produto['id']?></td>
                                    <td><?=$produto['nome']?></td>
                                    <td><?=$produto['preco']?></td>
                                    <td><?=$produto['quantidade']?></td>
                                    <td><?=$produto['descricao']?></td>
                                    <td>
                                        <a class="btn btn-primary" href="editar.php?id=<?= $produto['id'] ?>">
                                            <i class="bi bi-pencil-fill"></i>&nbsp;Editar
                                        </a>
                                        <a class="btn btn-danger" onclick="return confirm('Tem certeza que deseja excluir este produto?')";  href="excluir.php?id=<?= $produto['id'] ?>">
                                            <i class="bi bi-trash-fill"></i>&nbsp;Excluir
                                        </a>
                                    </td>
                                </tr>
                                <?php
                                }
                            }
                            ?>
                    </tbody>
                </table>
                <a href="adicionar.php" class="btn btn-primary">Adicionar Produtos</a>
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