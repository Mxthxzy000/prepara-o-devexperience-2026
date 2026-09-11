<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once __DIR__ . '/../services/conexao.php';

$codigo = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);
$chamado = null;

if ($codigo) {
    try {
        $stmt = $pdo->prepare("SELECT * FROM chamados WHERE codigo = :codigo");
        $stmt->bindParam(':codigo', $codigo, PDO::PARAM_INT);
        $stmt->execute();
        $chamado = $stmt->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        $erro_bd = "Erro na consulta: " . $e->getMessage();
    }
}
?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalhes do Chamado</title>
    <link rel="stylesheet" href="../styles/styleGeral.css">
</head>

<body>

    <header>
        <h1>Helpdesk Industrial</h1>
        <button
            type="button"
            onclick="window.location.href='homePage.php'"
            class="btnnav">
            Voltar
        </button>
    </header>

    <main class="formulario-container">

        <?php if (!$chamado): ?>
            <div style="text-align: center; padding: 20px;">
                <p style="color: red; font-weight: bold;">Chamado não encontrado.</p>
                <a href="homePage.php">Voltar</a>
            </div>
        <?php else: ?>
            <div style="background-color: #ffffff; padding: 30px; border: 1px solid #000000; border-radius: 25px; width: 400px; display: flex; flex-direction: column; gap: 10px;">
                <h2>Chamado #<?= htmlspecialchars($chamado['codigo']) ?></h2>

                <p><strong>Título:</strong> <?= htmlspecialchars($chamado['titulo']) ?></p>
                <p><strong>Solicitante:</strong> <?= htmlspecialchars($chamado['solicitante']) ?></p>
                <p><strong>Email:</strong> <?= htmlspecialchars($chamado['email']) ?></p>
                <p><strong>Setor:</strong> <?= htmlspecialchars($chamado['setor']) ?></p>
                <p><strong>Prioridade:</strong> <?= htmlspecialchars($chamado['prioridade']) ?></p>
                <p>
                    <strong>Status:</strong>
                    <?php 
                        $classe = ($chamado['status'] === 'Aberto') ? 'status-aberto' : 'status-fechado';
                    ?>
                    <span class="<?= $classe ?>">
                        <?= htmlspecialchars($chamado['status']) ?>
                    </span>
                </p>
                <p><strong>Data de Abertura:</strong> <?= htmlspecialchars($chamado['data_abertura']) ?></p>
                
                <p><strong>Descrição:</strong></p>
                <div style="background: #f9f9f9; padding: 10px; border: 1px solid #ccc; border-radius: 5px; white-space: pre-wrap;">
                    <?= nl2br(htmlspecialchars($chamado['descricao'])) ?>
                </div>

                <div style="margin-top: 15px;">
                    <a href="editar.php?id=<?= urlencode($chamado['codigo']) ?>">Editar</a>
                </div>
            </div>
        <?php endif; ?>

    </main>

</body>

</html>