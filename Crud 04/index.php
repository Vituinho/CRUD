<?php
    
    require 'conexao.php';

    $stmt = $conexao->prepare("SELECT * FROM tarefas");
    $stmt->execute();
    $tarefas = $stmt->fetchAll(PDO::FETCH_ASSOC);

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

    <title>READ</title>

</head>

<body>

    <div class="container mt-5">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h5>
                            READ
                            <a href="adicionar.php" class="btn btn-primary float-right">Adicionar</a>
                        </h5>
                    </div>
                    <div class="card-body">
                        <form action="" method="GET">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Título</th>
                                        <th>Status</th>
                                        <th>Ações</th>
                                    </tr>
                                </thead>
                                <?php
                                    if (!empty($tarefas) > 0) {
                                        foreach ($tarefas as $tarefa) {
                                ?>
                                <tbody>
                                    <tr>
                                        <td><?=$tarefa['id']?></td>
                                        <td><?=$tarefa['titulo']?></td>
                                        <td><?=$tarefa['status']?></td>
                                        <td><a class="btn btn-primary" href="editar.php?id=<?=$tarefa['id'] ?>">Editar</a>
                                    <a onclick="return confirm('Tem certeza que deseja deletar essa tarefa?')" class="btn btn-danger" href="deletar.php?id=<?=$tarefa['id'] ?>">Deletar</a></td>
                                    </tr>
                                </tbody>
                                <?php
                                        }
                                    }
                                    ?>
                            </table>
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
