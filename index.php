<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
<section class="vh-180">
    <div class="container-fluid h-custom">
        <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="jumbotron">
                <!-- Cabeçalho da página -->
                <div class="row">
                    <h2>AULA DE POE - CRUD <span class="badge text-bg-secondary">v 1.0.0 SENAI - Aula PBE</span></h2>
                </div>
            </div>
            <!-- Aqui o conteúdo do Banco -->
            <div class="row">
              <p>  
            <a class="btn btn-success" href="create.php">Add</a>
            </p>
                <!-- Aqui entram os dados da tabela -->
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">NOME</th>
                            <th scope="col">ENDEREÇO</th>
                            <th scope="col">TELEFONE</th>
                            <th scope="col">E-MAIL</th>
                            <th scope="col">IDADE</th>
                            <th scope="col">AÇÃO</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        include "banco.php";
                        $pdo = Banco::conectar();
                        $sql = "SELECT * FROM tb_cliente ORDER BY codigo DESC";
                        foreach ($pdo->query($sql) as $row) {
                            echo '<tr>';
                            echo '<th scope="row">' . $row["codigo"] . '</th>';
                            echo '<td>' . $row['nome'] . '</td>';
                            echo '<td>' . $row['endereco'] . '</td>';
                            echo '<td>' . $row['telefone'] . '</td>';
                            echo '<td>' . $row['email'] . '</td>';
                            echo '<td>' . $row['idade'] . '</td>';
                            echo '<td>';
                            echo '<a class="btn btn-primary" href="read.php?id=' . $row['codigo'] . '">Visualizar</a>';
                            echo '<a class="btn btn-warning" href="update.php?codigo=' . $row['codigo'] . '">Atualizar</a>';
                            echo '<a class="btn btn-danger" href="delete.php?codigo=' . $row['codigo'] . '">Excluir</a>';
                            echo '</td>';
                            echo '</tr>';
                        }
                        Banco::desconectar();
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section>
<div class="d-flex flex-column flex-md-row text-center text-md-start justify-content-between py-4 px-4 bg-primary">
    <div class="text-white mb-3">
        Copyright 2024. All rights reserved.
    </div>
</div>
</body>
</html>
