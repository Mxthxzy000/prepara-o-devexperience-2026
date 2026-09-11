<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulário de Chamados</title>
</head>
<body>
    <form action="/processadordedadosplaceholder" method="POST">
        <label for="nome">Solicitante:</label>
        <input type="text" id="nome" name="nome" required><br><br>

        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required><br><br>

        <label for='setor'>Setor:</label>
        <select id='setor' name='setor' required>
            <option value=''>Selecione um setor</option>
            <option value='producao'>Produção </option>
            <option value='administrativo'>Administrativo</option>
            <option value='logistica'>Logística</option>
            <option value='ti'>Tecnologia da Informação</option>
          
        </select><br><br>

        <label for="titulo">Título:</label>
        <input type="text" id="titulo" name="titulo" required><br><br>

        <label for="desc">Descrição:</label>
        <input type="text" id="desc" name="desc" required><br><br>

         <label for='prioridade'>Prioridade:</label>
        <select id='prioridade' name='prioridade' required>
            <option value=''>Selecione uma prioridade</option>
            <option value='baixa'>Baixa</option>
            <option value='media'>Média</option>
            <option value='alta'>Alta</option>
        </select><br><br>

        <input type="submit" value="Enviar">
    </form>
</body>
</html>