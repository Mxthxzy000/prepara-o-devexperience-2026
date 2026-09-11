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
        $erro_bd = "Erro ao buscar chamado: " . $e->getMessage();
    }
}

$erros = isset($_SESSION['form_errors']) ? $_SESSION['form_errors'] : [];
$dados_sessao = isset($_SESSION['form_data']) ? $_SESSION['form_data'] : [];

unset($_SESSION['form_errors'], $_SESSION['form_data']);

$solicitante = isset($dados_sessao['solicitante']) ? $dados_sessao['solicitante'] : ($chamado['solicitante'] ?? '');
$email       = isset($dados_sessao['email']) ? $dados_sessao['email'] : ($chamado['email'] ?? '');
$setor       = isset($dados_sessao['setor']) ? $dados_sessao['setor'] : ($chamado['setor'] ?? '');
$titulo      = isset($dados_sessao['titulo']) ? $dados_sessao['titulo'] : ($chamado['titulo'] ?? '');
$descricao   = isset($dados_sessao['descricao']) ? $dados_sessao['descricao'] : ($chamado['descricao'] ?? '');
$prioridade  = isset($dados_sessao['prioridade']) ? $dados_sessao['prioridade'] : ($chamado['prioridade'] ?? '');
$status      = isset($dados_sessao['status']) ? $dados_sessao['status'] : ($chamado['status'] ?? '');
?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Chamado</title>
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
            <form action="../services/processa.php" method="POST">
                <input type="hidden" name="action" value="update">
                <input type="hidden" name="codigo" value="<?= htmlspecialchars($chamado['codigo']) ?>">

                <?php if (!empty($erros)): ?>
                    <div style="color: red; font-size: 13px;">
                        <?php foreach ($erros as $erro): ?>
                            <p><?= htmlspecialchars($erro) ?></p>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>

                <p><strong>Código:</strong> #<?= htmlspecialchars($chamado['codigo']) ?> | <strong>Data de Abertura:</strong> <?= htmlspecialchars($chamado['data_abertura']) ?></p>

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

                <label for="status">Status:</label>
                <select
                    id="status"
                    name="status"
                    required>
                    <option value="Aberto" <?= $status === 'Aberto' ? 'selected' : '' ?>>Aberto</option>
                    <option value="Em atendimento" <?= $status === 'Em atendimento' ? 'selected' : '' ?>>Em atendimento</option>
                    <option value="Finalizado" <?= $status === 'Finalizado' ? 'selected' : '' ?>>Finalizado</option>
                </select>

                <input
                    type="submit"
                    value="Salvar Alterações">
            </form>
        <?php endif; ?>

    </main>

</body>

</html>