<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once __DIR__ . '/../services/conexao.php';

$erros = isset($_SESSION['form_errors']) ? $_SESSION['form_errors'] : [];
$dados_sessao = isset($_SESSION['form_data']) ? $_SESSION['form_data'] : [];

unset($_SESSION['form_errors'], $_SESSION['form_data']);

$solicitante = $dados_sessao['solicitante'] ?? '';
$email       = $dados_sessao['email'] ?? '';
$setor       = $dados_sessao['setor'] ?? '';
$titulo      = $dados_sessao['titulo'] ?? '';
$descricao   = $dados_sessao['descricao'] ?? '';
$prioridade  = $dados_sessao['prioridade'] ?? '';
?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulário de Chamados</title>
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

        <form action="../services/processa.php" method="POST">
            <input type="hidden" name="action" value="create">

            <?php if (!empty($erros)): ?>
                <div style="color: red; font-size: 13px;">
                    <?php foreach ($erros as $erro): ?>
                        <p><?= htmlspecialchars($erro) ?></p>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>

            <label for="solicitante">Solicitante:</label>
            <input
                type="text"
                id="solicitante"
                name="solicitante"
                minlength="3"
                maxlength="100"
                value="<?= htmlspecialchars($solicitante) ?>"
                required>

            <label for="email">Email:</label>
            <input
                type="email"
                id="email"
                name="email"
                maxlength="150"
                value="<?= htmlspecialchars($email) ?>"
                required>

            <label for="setor">Setor:</label>
            <select
                id="setor"
                name="setor"
                required>
                <option value="">Selecione um setor</option>
                <option value="Produção" <?= $setor === 'Produção' ? 'selected' : '' ?>>Produção</option>
                <option value="Administrativo" <?= $setor === 'Administrativo' ? 'selected' : '' ?>>Administrativo</option>
                <option value="Logística" <?= $setor === 'Logística' ? 'selected' : '' ?>>Logística</option>
                <option value="TI" <?= $setor === 'TI' ? 'selected' : '' ?>>Tecnologia da Informação</option>
            </select>

            <label for="titulo">Título:</label>
            <input
                type="text"
                id="titulo"
                name="titulo"
                minlength="5"
                maxlength="100"
                value="<?= htmlspecialchars($titulo) ?>"
                required>

            <label for="descricao">Descrição:</label>
            <textarea
                id="descricao"
                name="descricao"
                rows="4"
                minlength="10"
                maxlength="1000"
                required><?= htmlspecialchars($descricao) ?></textarea>

            <label for="prioridade">Prioridade:</label>
            <select
                id="prioridade"
                name="prioridade"
                required>
                <option value="">Selecione uma prioridade</option>
                <option value="Baixa" <?= $prioridade === 'Baixa' ? 'selected' : '' ?>>Baixa</option>
                <option value="Média" <?= $prioridade === 'Média' ? 'selected' : '' ?>>Média</option>
                <option value="Alta" <?= $prioridade === 'Alta' ? 'selected' : '' ?>>Alta</option>
            </select>

            <input
                type="submit"
                value="Enviar">
        </form>

    </main>

</body>

</html>