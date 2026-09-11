<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once __DIR__ . '/conexao.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: ../pages/homePage.php');
    exit();
}

$action = isset($_POST['action']) ? trim($_POST['action']) : 'create';

// AÇÃO: EXCLUIR CHAMADO
if ($action === 'delete') {
    $codigo = filter_input(INPUT_POST, 'codigo', FILTER_VALIDATE_INT);
    if (!$codigo) {
        $_SESSION['flash_error'] = "Código de chamado inválido para exclusão.";
        header('Location: ../pages/homePage.php');
        exit();
    }

    try {
        $stmt = $pdo->prepare("DELETE FROM chamados WHERE codigo = :codigo");
        $stmt->bindParam(':codigo', $codigo, PDO::PARAM_INT);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            $_SESSION['flash_success'] = "Chamado #$codigo excluído com sucesso!";
        } else {
            $_SESSION['flash_error'] = "Chamado não encontrado ou já excluído.";
        }
    } catch (PDOException $e) {
        $_SESSION['flash_error'] = "Erro ao excluir o chamado: " . $e->getMessage();
    }

    header('Location: ../pages/homePage.php');
    exit();
}

// AÇÃO: CRIAR (CADASTRO) OU EDITAR (UPDATE)
if ($action === 'create' || $action === 'update') {
    $erros = [];

    $solicitante = isset($_POST['solicitante']) ? trim($_POST['solicitante']) : '';
    $email       = isset($_POST['email']) ? trim($_POST['email']) : '';
    $setor       = isset($_POST['setor']) ? trim($_POST['setor']) : '';
    $titulo      = isset($_POST['titulo']) ? trim($_POST['titulo']) : '';
    $descricao   = isset($_POST['descricao']) ? trim($_POST['descricao']) : '';
    $prioridade  = isset($_POST['prioridade']) ? trim($_POST['prioridade']) : '';
    $status      = isset($_POST['status']) ? trim($_POST['status']) : 'Aberto';

    // Lista de opções válidas
    $setores_validos     = ['Produção', 'Administrativo', 'Logística', 'TI'];
    $prioridades_validas = ['Baixa', 'Média', 'Alta'];
    $status_validos      = ['Aberto', 'Em atendimento', 'Finalizado'];

    // Validações
    if (mb_strlen($solicitante) < 3 || mb_strlen($solicitante) > 100) {
        $erros[] = "O solicitante é obrigatório e deve ter entre 3 e 100 caracteres.";
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL) || mb_strlen($email) > 150) {
        $erros[] = "O e-mail deve ser um endereço válido com no máximo 150 caracteres.";
    }

    if (!in_array($setor, $setores_validos, true)) {
        $erros[] = "Selecione um setor válido (Produção, Administrativo, Logística ou TI).";
    }

    if (mb_strlen($titulo) < 5 || mb_strlen($titulo) > 100) {
        $erros[] = "O título é obrigatório e deve ter entre 5 e 100 caracteres.";
    }

    if (mb_strlen($descricao) < 10 || mb_strlen($descricao) > 1000) {
        $erros[] = "A descrição é obrigatória e deve ter entre 10 e 1.000 caracteres.";
    }

    if (!in_array($prioridade, $prioridades_validas, true)) {
        $erros[] = "Selecione uma prioridade válida (Baixa, Média ou Alta).";
    }

    if ($action === 'update') {
        if (!in_array($status, $status_validos, true)) {
            $erros[] = "Selecione um status válido (Aberto, Em atendimento ou Finalizado).";
        }
        $codigo = filter_input(INPUT_POST, 'codigo', FILTER_VALIDATE_INT);
        if (!$codigo) {
            $erros[] = "Código do chamado inválido.";
        }
    } else {
        // Novo chamado sempre inicia como 'Aberto'
        $status = 'Aberto';
    }

    // Se houver erros de validação
    if (!empty($erros)) {
        $_SESSION['form_errors'] = $erros;
        $_SESSION['form_data']   = [
            'solicitante' => $solicitante,
            'email'       => $email,
            'setor'       => $setor,
            'titulo'      => $titulo,
            'descricao'   => $descricao,
            'prioridade'  => $prioridade,
            'status'      => $status
        ];

        if ($action === 'update' && isset($codigo)) {
            header("Location: ../pages/editar.php?id=$codigo");
        } else {
            header('Location: ../pages/formulario.php');
        }
        exit();
    }

    // Processamento no banco de dados
    if ($action === 'create') {
        try {
            $sql = "INSERT INTO chamados (solicitante, email, setor, titulo, descricao, prioridade, status) 
                    VALUES (:solicitante, :email, :setor, :titulo, :descricao, :prioridade, :status)";
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':solicitante', $solicitante);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':setor', $setor);
            $stmt->bindParam(':titulo', $titulo);
            $stmt->bindParam(':descricao', $descricao);
            $stmt->bindParam(':prioridade', $prioridade);
            $stmt->bindParam(':status', $status);
            $stmt->execute();

            $novoId = $pdo->lastInsertId();
            $_SESSION['flash_success'] = "Chamado #$novoId cadastrado com sucesso!";
            header('Location: ../pages/homePage.php');
            exit();
        } catch (PDOException $e) {
            $_SESSION['flash_error'] = "Erro ao cadastrar chamado: " . $e->getMessage();
            header('Location: ../pages/formulario.php');
            exit();
        }
    } elseif ($action === 'update') {
        try {
            $sql = "UPDATE chamados 
                    SET solicitante = :solicitante, 
                        email = :email, 
                        setor = :setor, 
                        titulo = :titulo, 
                        descricao = :descricao, 
                        prioridade = :prioridade, 
                        status = :status 
                    WHERE codigo = :codigo";
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':solicitante', $solicitante);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':setor', $setor);
            $stmt->bindParam(':titulo', $titulo);
            $stmt->bindParam(':descricao', $descricao);
            $stmt->bindParam(':prioridade', $prioridade);
            $stmt->bindParam(':status', $status);
            $stmt->bindParam(':codigo', $codigo, PDO::PARAM_INT);
            $stmt->execute();

            $_SESSION['flash_success'] = "Chamado #$codigo atualizado com sucesso!";
            header('Location: ../pages/homePage.php');
            exit();
        } catch (PDOException $e) {
            $_SESSION['flash_error'] = "Erro ao atualizar chamado: " . $e->getMessage();
            header("Location: ../pages/editar.php?id=$codigo");
            exit();
        }
    }
}

header('Location: ../pages/homePage.php');
exit();