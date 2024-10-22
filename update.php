<?php
require 'banco.php';
$codigo = null;
if (!empty($_GET['codigo'])) {
    $codigo = $_REQUEST['codigo'];
}

if (null == $codigo) {
    header("Location: index.php");
    exit;
}

$nomeErro = null;
$enderecoErro = null;
$telefoneErro = null;
$emailErro = null;
$idadeErro = null;

$nome = '';
$endereco = '';
$telefone = '';
$email = '';
$idade = '';

if (!empty($_POST)) {
    $nome = $_POST['nome'];
    $endereco = $_POST['endereco'];
    $telefone = $_POST['telefone'];
    $email = $_POST['email'];
    $idade = $_POST['idade'];
    
    // Validação
    $validacao = true;

    if (empty($nome)) {
        $nomeErro = 'Por favor digite o nome!';
        $validacao = false;
    }
    if (empty($endereco)) {
        $enderecoErro = 'Por favor digite o endereço!';
        $validacao = false;
    }
    if (empty($telefone)) {
        $telefoneErro = 'Por favor digite o telefone!';
        $validacao = false;
    }
    if (empty($email)) {
        $emailErro = 'Por favor digite o email!';
        $validacao = false;
    } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $emailErro = 'Por favor digite um email válido!';
        $validacao = false;
    }
    if (empty($idade)) {
        $idadeErro = 'Por favor preencha o campo!';
        $validacao = false;
    }

    if ($validacao) {
        $pdo = Banco::conectar();
        $sql = "UPDATE tb_alunos SET nome = ?, endereco = ?, telefone = ?, email = ?, idade = ? WHERE codigo = ?";
        $q = $pdo->prepare($sql);
        $q->execute(array($nome, $endereco, $telefone, $email, $idade, $codigo));
        Banco::desconectar();
        header("Location: index.php");
        exit;
    }
}

$pdo = Banco::conectar();
$sql = "SELECT * FROM tb_alunos WHERE codigo = ?";
$q = $pdo->prepare($sql);
$q->execute(array($codigo));
$data = $q->fetch(PDO::FETCH_ASSOC);
if ($data) {
    $nome = $data['nome'];
    $endereco = $data['endereco'];
    $telefone = $data['telefone'];
    $email = $data['email'];
    $idade = $data['idade'];
}
Banco::desconectar();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="utf-8">
    <title>Atualizar Contato</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFGE8FJT36XwEOngsV77+27NXFoacApmYm81iXoPkF0JJ8ERdknlPMO" crossorigin="anonymous">
</head>
<body>
<div class="container">
    <div class="card">
        <div class="card-header">
            <h3 class="well"> Atualizar Contato </h3>
        </div>
        <div class="card-body">
            <form class="form-horizontal" action="update.php?codigo=<?php echo $codigo ?>" method="post">
                <div class="form-group <?php echo !empty($nomeErro) ? 'has-error' : ''; ?>">
                    <label class="control-label">Nome</label>
                    <input name="nome" class="form-control" type="text" placeholder="Nome" value="<?php echo !empty($nome) ? $nome : ''; ?>">
                    <?php if (!empty($nomeErro)): ?>
                        <span class="text-danger"><?php echo $nomeErro; ?></span>
                    <?php endif; ?>
                </div>
                <div class="form-group <?php echo !empty($enderecoErro) ? 'has-error' : ''; ?>">
                    <label class="control-label">Endereço</label>
                    <input name="endereco" class="form-control" type="text" placeholder="Endereço" value="<?php echo !empty($endereco) ? $endereco : ''; ?>">
                    <?php if (!empty($enderecoErro)): ?>
                        <span class="text-danger"><?php echo $enderecoErro; ?></span>
                    <?php endif; ?>
                </div>
                <div class="form-group <?php echo !empty($telefoneErro) ? 'has-error' : ''; ?>">
                    <label class="control-label">Telefone</label>
                    <input name="telefone" class="form-control" type="text" placeholder="Telefone" value="<?php echo !empty($telefone) ? $telefone : ''; ?>">
                    <?php if (!empty($telefoneErro)): ?>
                        <span class="text-danger"><?php echo $telefoneErro; ?></span>
                    <?php endif; ?>
                </div>
                <div class="form-group <?php echo !empty($emailErro) ? 'has-error' : ''; ?>">
                    <label class="control-label">Email</label>
                    <input name="email" class="form-control" type="text" placeholder="Email" value="<?php echo !empty($email) ? $email : ''; ?>">
                    <?php if (!empty($emailErro)): ?>
                        <span class="text-danger"><?php echo $emailErro; ?></span>
                    <?php endif; ?>
                </div>
                <div class="form-group <?php echo !empty($idadeErro) ? 'has-error' : ''; ?>">
                    <label class="control-label">Idade</label>
                    <input name="idade" class="form-control" type="text" placeholder="Idade" value="<?php echo !empty($idade) ? $idade : ''; ?>">
                    <?php if (!empty($idadeErro)): ?>
                        <span class="text-danger"><?php echo $idadeErro; ?></span>
                    <?php endif; ?>
                </div>
                <div class="form-actions">
                    <button type="submit" class="btn btn-warning">Atualizar</button>
                    <a href="index.php" class="btn btn-default">Voltar</a>
                </div>
            </form>
        </div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.3.1.js" integrity="sha256-2Kok/Mb0yxpgUVvAk/HJ2j1gOSYS2auk4Pzbm7uH60=" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mlykV+2+9330346jk6WLadn689CwoqbB315njAK/18WVCWPIP49" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSd4C0pI5T5Pi/mL0u5hM4DkslN+xV9it3FNhM4NjP8/rO" crossorigin="anonymous"></script>
</body>
</html>
