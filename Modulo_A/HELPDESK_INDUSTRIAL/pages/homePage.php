<?php

include "conexao.php";

$sql = "SELECT * FROM chamados";

$resultado = $conexao->query($sql);

?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Helpdesk Industrial</title>
    <link rel="stylesheet" href="../styles/styleGeral.css">
</head>
<body>
    <header>
        <h1>Bem-vindo ao Helpdesk Industrial</h1>
        <button onclick="window.location.href='formulario.php'" class="btnnav" >Formulário</button>
    </header>

<<<<<<< Updated upstream
    <h1>Chamados Realizados</h1>

    <?php while ($chamado = $resultado->fetch_assoc()): ?>

        <div>

            <h2>
                <?= htmlspecialchars($chamado["titulo"]) ?>
            </h2>

            <p>
                Solicitante:
                <?= htmlspecialchars($chamado["solicitante"]) ?>
            </p>

            <p>
                Setor:
                <?= htmlspecialchars($chamado["setor"]) ?>
            </p>

        </div>

    <?php endwhile; ?>

=======
>>>>>>> Stashed changes
</body>
</html>