<?php 
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    require_once 'conexao.php';

    $nome  = filter_input(INPUT_POST, 'nome', FILTER_SANITIZE_SPECIAL_CHARS);
    if (strlen($nome) < 3 || strlen($nome) > 100) {
        die("O nome deve ter entre 3 e 100 caracteres.");
    }
    $email_raw = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
    if (!filter_var($email_raw, FILTER_VALIDATE_EMAIL)) {
        die("Email inválido.");
    }
    $email = $email_raw;
    if (strlen($email) > 150) {
        die("O email deve ter no máximo 150 caracteres.");
    }
    $setor = $_POST['setor'];
    if ($setor === '') {
        die("Você precisa escolher uma opção válida.");
    }
    $titulo = $_POST['titulo'];
    if (strlen($titulo) < 5 || strlen($titulo) > 100) {
        die("O título deve ter entre 5 e 100 caracteres.");
    }
    $desc = $_POST['desc'];
    if (strlen($desc) < 10 || strlen($desc) > 1000) {
        die("A descrição deve ter entre 10 e 1000 caracteres.");
    }
    $prioridade = $_POST['prioridade'];
    if ($prioridade === '') {
        die("Você precisa escolher uma opção válida.");
    }
    $status = 'aberto'; // Status inicial do chamado

    if ($nome && $email && $setor && $titulo && $desc && $prioridade) {
        try {
            $stmt = $pdo->prepare("INSERT INTO chamados (solicitante, email, setor, titulo, descricao, prioridade, status) VALUES (:nome, :email, :setor, :titulo, :descricao, :prioridade, :status)");
            $stmt->bindParam(':nome', $nome);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':setor', $setor);
            $stmt->bindParam(':titulo', $titulo);
            $stmt->bindParam(':descricao', $desc);
            $stmt->bindParam(':prioridade', $prioridade);
            $stmt->bindParam(':status', $status);
            if ($stmt->execute()) {
                header("Location: ../pages/homePage.php?success=1");
                exit;
            } else {
                header("Location: ../pages/homePage.php?error=insert");
                exit;
            }
        } catch (PDOException $e) {
            header("Location: ../pages/homePage.php?error=db");
            exit;
        }
    } else {
        header("Location: ../pages/homePage.php?error=fields");
        exit;
    }
}
?>