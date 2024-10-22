<?php
require 'banco.php';

$id = 0;

// Verifica se o código foi passado via GET ou POST
if (!empty($_GET['codigo'])) {
    $id = $_GET['codigo'];
} elseif (!empty($_POST['codigo'])) {
    $id = $_POST['codigo'];
}

// Se o ID for válido, faz a exclusão
if ($id > 0) {
    // Delete do banco
    $pdo = Banco::conectar();
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
   
    $sql = "DELETE FROM tb_alunos WHERE codigo = ?";
    $q = $pdo->prepare($sql);
    $q->execute(array($id));
   
    Banco::desconectar();
    header("Location: index.php");
    exit(); // Certifique-se de sair após a redireção
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="utf-8">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
          rel="stylesheet" integrity="sha384-QWTKZyjpPEjISvSWRU90FeRpok6YctnYmDr5pNlyT2Rjxh@]MhjY6hW+ALEIH" crossorigin="anonymous">
    <title>Deletar Contato</title>
</head>
<body>
<div class="container">
    <div class="span10 offset1">
        <div class="row">
            <h3 class="well">Excluir Contato</h3>
        </div>
        <form class="form-horizontal" action="delete.php" method="POST">
            <input type="hidden" name="codigo" value="<?php echo htmlspecialchars($id); ?>" />
            <div class="alert alert-danger">Deseja excluir o contato?</div>
            <div class="form actions">
                <button type="submit" class="btn btn-danger">Sim</button>
                <a href="index.php" class="btn btn-default">Não</a>
            </div>
        </form>
    </div>
</div>
</body>
</html>
