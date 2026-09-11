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
</head>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }

        header {
            background-color: #686868;
            color: white;
            padding: 20px;
            text-align: center;
        }

        button {
            background-color: #93CC64;
            color: white;
            border: none;
            padding: 10px 20px;
            cursor: pointer;
            font-size: 16px;
        }

        button:hover {
            background-color: #218838;
        }
    </style>
<body>
    <header>
        <h1>Bem-vindo ao Helpdesk Industrial</h1>
        <button onclick="window.location.href='formulario.php'">Formulário</button>
    </header>

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

</body>
</html>