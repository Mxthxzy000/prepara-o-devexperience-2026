-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 11/09/2026 às 19:27
-- Versão do servidor: 10.4.32-MariaDB
-- Versão do PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `helpdesk_industrial`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `chamados`
--

CREATE TABLE `chamados` (
  `codigo` int(10) UNSIGNED NOT NULL,
  `solicitante` varchar(100) NOT NULL,
  `email` varchar(150) NOT NULL,
  `setor` enum('Produção','Administrativo','Logística','TI') NOT NULL,
  `titulo` varchar(100) NOT NULL,
  `descricao` varchar(1000) NOT NULL,
  `prioridade` enum('Baixa','Média','Alta') NOT NULL,
  `status` enum('Aberto','Em atendimento','Finalizado') NOT NULL DEFAULT 'Aberto',
  `data_abertura` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `chamados`
--

INSERT INTO chamados (codigo, solicitante, email, setor, titulo, descricao, prioridade, status, data_abertura) VALUES
(1, 'Greggori', 'greggori.silva@empresa.com.br', 'TI', 'Erro ao acessar sistema', 'Usuário relata mensagem de erro 500 ao tentar logar no ERP.', 'Alta', 'Aberto', '2026-09-11 14:00:00'),
(2, 'Daniel', 'daniel.oliveira@empresa.com.br', 'Financeiro', 'Solicitação de relatório', 'Necessário relatório de vendas do último trimestre em formato PDF.', 'Média', 'Em Andamento', '2026-09-11 14:00:00'),
(3, 'Reuel', 'reuel.santos@empresa.com.br', 'RH', 'Ajuste no ponto', 'Solicitação de correção de marcação de ponto no dia 08/09.', 'Baixa', 'Aberto', '2026-09-11 14:00:00'),
(4, 'Luiz', 'luiz.costa@empresa.com.br', 'Logística', 'Lente do leitor danificada', 'Leitor de código de barras do estoque parou de funcionar.', 'Urgente', 'Aberto', '2026-09-11 14:00:00'),
(5, 'Lucas', 'lucas.ferreira@empresa.com.br', 'Comercial', 'Novo usuário no CRM', 'Criação de conta de acesso para o novo vendedor da equipe.', 'Média', 'Finalizado', '2026-09-11 14:00:00'),
(6, 'Otavio', 'otavio.rodrigues@empresa.com.br', 'Marketing', 'Troca de tonner da impressora', 'Impressora do setor apresentando falhas e tinta fraca.', 'Baixa', 'Em Andamento', '2026-09-11 14:00:00'),
(7, 'Cardoso', 'cardoso.souza@empresa.com.br', 'Manutenção', 'Instalação de novo ponto de rede', 'Ponto de rede adicional necessário na sala de reuniões 2.', 'Média', 'Aberto', '2026-09-11 14:00:00');
(8, 'Matheus', 'matheus.quirino@empresa.com.br', 'Manutenção', 'Instalação de novo ponto de rede', 'Ponto de rede adicional necessário na sala de reuniões 2.', 'Média', 'Aberto', '2026-09-11 14:00:00');
--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `chamados`
--
ALTER TABLE `chamados`
  ADD PRIMARY KEY (`codigo`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `chamados`
--
ALTER TABLE `chamados`
  MODIFY `codigo` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
