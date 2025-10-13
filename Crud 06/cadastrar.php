<?php
require 'conexao.php';
session_start();

function calcularForcaSenha($senhaUsuario) {
    $forca = 0;

    if(strlen($senhaUsuario) >= 8) $forca++;
    if(preg_match('/[A-Z]/', $senhaUsuario)) $forca++;
    if(preg_match('/[0-9]/', $senhaUsuario)) $forca++;
    if(preg_match('/[^a-zA-Z0-9]/', $senhaUsuario)) $forca++;

    return $forca; // 0 a 4
}

$mensagem = '';
$tipo = '';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $senhaUsuario = $_POST['senha'];

    // 1. Verifica campos vazios
    if(empty(trim($nome)) || empty(trim($email)) || empty(trim($senhaUsuario))){
        $mensagem = 'Preencha todos os campos!';
        $tipo = 'warning';
    } 
    // 2. Verifica força da senha
    elseif(calcularForcaSenha($senhaUsuario) < 3){
        $mensagem = 'Sua senha é muito fraca!';
        $tipo = 'danger';
    } 
    else {
        // 3. Verifica e-mail duplicado
        $check = $conexao->prepare('SELECT id_usuario FROM usuarios WHERE email = :email LIMIT 1');
        $check->bindValue(':email', $email);
        $check->execute();

        if($check->rowCount() > 0){
            $mensagem = 'E-mail já está sendo utilizado!';
            $tipo = 'danger';
        } else {
            // 4. Tudo certo, cadastra
            $senha = password_hash($senhaUsuario, PASSWORD_DEFAULT);
            $stmt = $conexao->prepare("INSERT INTO usuarios (nome, email, senha) VALUES (:nome, :email, :senha)");
            $stmt->bindValue(':nome', $nome);
            $stmt->bindValue(':email', $email);
            $stmt->bindValue(':senha', $senha);        
            $stmt->execute();

            header('Location: home.php');
            exit;
        }
    }
}
?>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
    <link rel="stylesheet" href="style.css">
    <title>Cadastrar-se</title>
</head>

<body>
<div class="container mt-5">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="d-flex justify-content-center">Cadastrar-se</h5>
                </div>
                <div class="card-body">
                    <form action="" method="POST">

                        <?php if(!empty($mensagem)): ?>
                            <div class="alert alert-<?= $tipo ?>" role="alert">
                                <?= $mensagem ?>
                            </div>
                        <?php endif; ?>

                        <div class="mb-3">
                            <h5>Nome</h5>
                            <input class="form-control" type="text" name="nome">
                        </div>
                        <div class="mb-3">
                            <h5>E-mail</h5>
                            <input class="form-control" type="email" name="email">
                        </div>
                        <div class="mb-3">
                            <h5>Senha</h5>
                            <input class="form-control" type="password" name="senha" id="senha">
                            <!-- Barra de força -->
                            <div class="progress mt-2">
                                    <div class="progress-bar" id="barra-forca" style="width:0%;"></div>
                                </div>

                            <span id="nivel-senha" style="font-weight:bold; margin-left:5px;">Muito Fraca</span>
                        </div>

                        <button type="submit" class="btn btn-primary">Cadastrar</button>
                        <a class="btn btn-danger" href="index.php">Voltar</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="barra_texto.js"></script>

</body>
</html>
