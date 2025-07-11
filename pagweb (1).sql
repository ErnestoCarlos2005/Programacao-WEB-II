-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 10/07/2025 às 20:01
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
-- Banco de dados: `pagweb`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `auditoria_alteracoes`
--

CREATE TABLE `auditoria_alteracoes` (
  `id` int(11) NOT NULL,
  `tabela_afetada` varchar(50) DEFAULT NULL,
  `id_registro` int(11) DEFAULT NULL,
  `campo_modificado` varchar(50) DEFAULT NULL,
  `valor_antigo` text DEFAULT NULL,
  `valor_novo` text DEFAULT NULL,
  `alterado_por` varchar(100) DEFAULT NULL,
  `data_alteracao` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `pessoa_fisica`
--

CREATE TABLE `pessoa_fisica` (
  `id_pessoa` int(11) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `cpf` varchar(14) NOT NULL,
  `email` varchar(100) DEFAULT NULL,
  `dt_nascimento` date DEFAULT NULL,
  `ddd` char(2) DEFAULT NULL,
  `celular` varchar(9) DEFAULT NULL,
  `sexo` enum('M','F','Outro') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `pessoa_fisica`
--

INSERT INTO `pessoa_fisica` (`id_pessoa`, `nome`, `cpf`, `email`, `dt_nascimento`, `ddd`, `celular`, `sexo`) VALUES
(7, 'teste02', '103.152.253-50', 'teste1@gmail.com', '2025-01-02', '63', '13256-164', 'F'),
(8, 'teste03', '333.394.548-0', 'teste@gmail.com', '2025-04-11', '63', '63991-06', 'F'),
(9, 'Ernesto Carlos Pereira Wenceslau', '000.000.000-01', 'teste@gmail.com', '2005-01-01', '63', '98400-000', 'M');

-- --------------------------------------------------------

--
-- Estrutura para tabela `relatorios_gerados`
--

CREATE TABLE `relatorios_gerados` (
  `id_relatorio` int(11) NOT NULL,
  `tipo_relatorio` varchar(50) DEFAULT NULL,
  `gerado_por` varchar(100) DEFAULT NULL,
  `data_geracao` datetime DEFAULT current_timestamp(),
  `parametros` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `usuario`
--

CREATE TABLE `usuario` (
  `id` int(11) NOT NULL,
  `cpf` varchar(14) DEFAULT NULL,
  `endereco` varchar(150) DEFAULT NULL,
  `cargo` varchar(50) DEFAULT NULL,
  `funcao` varchar(50) DEFAULT NULL,
  `login` varchar(50) DEFAULT NULL,
  `senha` varchar(255) DEFAULT NULL,
  `ativo` tinyint(1) DEFAULT 1,
  `atualizado_por` varchar(50) DEFAULT NULL,
  `atualizado_em` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `data_cadastro` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `usuario`
--

INSERT INTO `usuario` (`id`, `cpf`, `endereco`, `cargo`, `funcao`, `login`, `senha`, `ativo`, `atualizado_por`, `atualizado_em`, `data_cadastro`) VALUES
(11, '103.152.253-50', '77022328', 'DBA', 'Administradora', 'dba', '$2y$10$ZO5ZhFOkb0sFtm9dS4rGSusTXuc.G3CmtxyJe5JCBkiTNc2SDlmse', 0, NULL, '2025-05-29 14:35:31', '2025-05-29 14:35:06'),
(12, '333.394.548-0', '77022329', 'ti', 'analista', 'teste.02', '$2y$10$GRInJlJVWf0xKOG2U/5fUOi40hr9vPj5z18lIqDsPmXutSGmMPDrO', 0, NULL, '2025-07-10 12:48:11', '2025-07-10 12:47:43'),
(13, '000.000.000-01', '700000', 'ti', 'analista', 'wenceslau', '$2y$10$HVaAg1aAjv6xneWmQD7VNOWOJ9hj6jpJ3mFwLaFHHixNndVbylDQG', 1, NULL, '2025-07-10 14:43:05', '2025-07-10 14:43:05');

-- --------------------------------------------------------

--
-- Estrutura para tabela `usuario_status_historico`
--

CREATE TABLE `usuario_status_historico` (
  `id` int(11) NOT NULL,
  `usuario_id` int(11) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `data_inicio` datetime NOT NULL,
  `data_fim` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `usuario_status_historico`
--

INSERT INTO `usuario_status_historico` (`id`, `usuario_id`, `status`, `data_inicio`, `data_fim`) VALUES
(1, 11, 0, '2025-05-29 14:35:31', NULL),
(2, 12, 0, '2025-07-10 12:48:11', NULL);

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `auditoria_alteracoes`
--
ALTER TABLE `auditoria_alteracoes`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `pessoa_fisica`
--
ALTER TABLE `pessoa_fisica`
  ADD PRIMARY KEY (`id_pessoa`),
  ADD UNIQUE KEY `cpf` (`cpf`);

--
-- Índices de tabela `relatorios_gerados`
--
ALTER TABLE `relatorios_gerados`
  ADD PRIMARY KEY (`id_relatorio`);

--
-- Índices de tabela `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `login` (`login`),
  ADD KEY `cpf` (`cpf`);

--
-- Índices de tabela `usuario_status_historico`
--
ALTER TABLE `usuario_status_historico`
  ADD PRIMARY KEY (`id`),
  ADD KEY `usuario_id` (`usuario_id`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `auditoria_alteracoes`
--
ALTER TABLE `auditoria_alteracoes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `pessoa_fisica`
--
ALTER TABLE `pessoa_fisica`
  MODIFY `id_pessoa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de tabela `relatorios_gerados`
--
ALTER TABLE `relatorios_gerados`
  MODIFY `id_relatorio` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de tabela `usuario_status_historico`
--
ALTER TABLE `usuario_status_historico`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `usuario`
--
ALTER TABLE `usuario`
  ADD CONSTRAINT `usuario_ibfk_1` FOREIGN KEY (`cpf`) REFERENCES `pessoa_fisica` (`cpf`) ON DELETE CASCADE;

--
-- Restrições para tabelas `usuario_status_historico`
--
ALTER TABLE `usuario_status_historico`
  ADD CONSTRAINT `usuario_status_historico_ibfk_1` FOREIGN KEY (`usuario_id`) REFERENCES `usuario` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
