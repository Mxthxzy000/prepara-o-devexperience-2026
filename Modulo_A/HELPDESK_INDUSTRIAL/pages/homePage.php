<?php
// 1) Inclui a conexão (ajuste o caminho conforme sua pasta)
require_once __DIR__ . '/../services/conexao.php';

// 2) Busca os chamados no banco
$sql = "SELECT codigo, solicitante, email, setor, titulo, descricao, prioridade, status, data_abertura 
        FROM chamados 
        ORDER BY codigo DESC";

try {
    $stmt = $pdo->query($sql);
    $chamados = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("Erro na consulta: " . $e->getMessage());
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Helpdesk Industrial - Home</title>
    <link rel="stylesheet" href="../styles/styleGeral.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            background-color: #f9f9f9;
        }
        h1 {
            color: #333;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            font-size: 14px;
            background-color: #fff;
        }
        th, td {
            border: 1px solid #ccc;
            padding: 8px;
            text-align: left;
            vertical-align: top;
        }
        th {
            background-color: #2c3e50;
            color: #fff;
        }
        tr:nth-child(even) {
            background-color: #f2f2f2;
        }
        tr:hover {
            background-color: #e6f2ff;
        }
        .status-aberto {
            color: #2ecc71;
            font-weight: bold;
        }
        .status-fechado {
            color: #e74c3c;
            font-weight: bold;
        }
    </style>
</head>
<body>
        <header>
            <h1>Bem-vindo ao Helpdesk Industrial</h1>
            <button onclick="window.location.href='formulario.php'" class="btnnav" >Formulário</button>
        </header>

    <h1>Chamados Abertos</h1>

    <table>
        <thead>
            <tr>
                <th>Codigo</th>
                <th>Solicitante</th>
                <th>Email</th>
                <th>Setor</th>
                <th>Titulo</th>
                <th>Descricao</th>
                <th>Prioridade</th>
                <th>Status</th>
                <th>Data Abertura</th>
            </tr>
        </thead>
        <tbody>
            <?php if (count($chamados) > 0): ?>
                <?php foreach ($chamados as $linha): ?>
                    <tr>
                        <td><?= htmlspecialchars($linha['codigo']) ?></td>
                        <td><?= htmlspecialchars($linha['solicitante']) ?></td>
                        <td><?= htmlspecialchars($linha['email']) ?></td>
                        <td><?= htmlspecialchars($linha['setor']) ?></td>
                        <td><?= htmlspecialchars($linha['titulo']) ?></td>
                        <td><?= htmlspecialchars($linha['descricao']) ?></td>
                        <td><?= htmlspecialchars($linha['prioridade']) ?></td>
                        <td>
                            <?php 
                                $classe = ($linha['status'] === 'Aberto') ? 'status-aberto' : 'status-fechado';
                            ?>
                            <span class="<?= $classe ?>">
                                <?= htmlspecialchars($linha['status']) ?>
                            </span>
                        </td>
                        <td><?= htmlspecialchars($linha['data_abertura']) ?></td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
<<<<<<< Updated upstream
=======
                    <td colspan="10" style="text-align:center;">nenhum chamado encontrado</td>
>>>>>>> Stashed changes
                    <td colspan="9" style="text-align:center;">Nenhum chamado encontrado.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>

</body>
</html>