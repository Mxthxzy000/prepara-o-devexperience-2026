<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once __DIR__ . '/../services/conexao.php';

// Flash messages
$flash_success = $_SESSION['flash_success'] ?? null;
$flash_error   = $_SESSION['flash_error'] ?? null;
unset($_SESSION['flash_success'], $_SESSION['flash_error']);

// 1) Indicadores calculados a partir de todos os registros no banco
try {
    $stmtIndicadores = $pdo->query("SELECT 
        COUNT(*) as total,
        SUM(CASE WHEN status = 'Aberto' THEN 1 ELSE 0 END) as total_aberto,
        SUM(CASE WHEN status = 'Em atendimento' THEN 1 ELSE 0 END) as total_atendimento,
        SUM(CASE WHEN status = 'Finalizado' THEN 1 ELSE 0 END) as total_finalizado
    FROM chamados");
    $indicadores = $stmtIndicadores->fetch(PDO::FETCH_ASSOC);
    $totalChamados    = (int)($indicadores['total'] ?? 0);
    $totalAbertos     = (int)($indicadores['total_aberto'] ?? 0);
    $totalAtendimento = (int)($indicadores['total_atendimento'] ?? 0);
    $totalFinalizados = (int)($indicadores['total_finalizado'] ?? 0);
} catch (PDOException $e) {
    $totalChamados = $totalAbertos = $totalAtendimento = $totalFinalizados = 0;
}

// 2) Busca todos os chamados no banco
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
</head>
<body>
    <header>
        <h1>Helpdesk Industrial</h1>
        <button onclick="window.location.href='formulario.php'" class="btnnav">Formulário</button>
    </header>

    <h1>Chamados</h1>

    <div style="text-align: center; margin: 10px 0;">
        <p>
            <strong>Total:</strong> <?= $totalChamados ?> &nbsp;|&nbsp; 
            <strong>Abertos:</strong> <?= $totalAbertos ?> &nbsp;|&nbsp; 
            <strong>Em atendimento:</strong> <?= $totalAtendimento ?> &nbsp;|&nbsp; 
            <strong>Finalizados:</strong> <?= $totalFinalizados ?>
        </p>
    </div>

    <?php if ($flash_success): ?>
        <p style="text-align: center; color: green; font-weight: bold;"><?= htmlspecialchars($flash_success) ?></p>
    <?php endif; ?>
    <?php if ($flash_error): ?>
        <p style="text-align: center; color: red; font-weight: bold;"><?= htmlspecialchars($flash_error) ?></p>
    <?php endif; ?>

    <main>
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
                <th>Ações</th>
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
                        <td>
                            <a href="detalhes.php?id=<?= urlencode($linha['codigo']) ?>">Visualizar</a> |
                            <a href="editar.php?id=<?= urlencode($linha['codigo']) ?>">Editar</a> |
                            <form action="../services/processa.php" method="POST" style="display:inline;" onsubmit="return confirm('Deseja realmente excluir este chamado?');">
                                <input type="hidden" name="action" value="delete">
                                <input type="hidden" name="codigo" value="<?= htmlspecialchars($linha['codigo']) ?>">
                                <input type="submit" value="Excluir" style="cursor: pointer; background: none; border: none; color: red; text-decoration: underline; padding: 0;">
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
<td colspan="10" style="text-align:center;">Nenhum chamado encontrado.</td>
                    <td colspan="9" style="text-align:center;">Nenhum chamado encontrado.</td>
=======
                    <td colspan="10" style="text-align:center;">nenhum chamado encontrado</td>
>>>>>>> style-form-feature
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
    </main>

</body>
</html>