-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Tempo de geração: 18/01/2019 às 18:20
-- Versão do servidor: 5.7.24-0ubuntu0.18.04.1
-- Versão do PHP: 7.2.10-0ubuntu0.18.04.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `paluana`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `atendimentos`
--

CREATE TABLE `atendimentos` (
  `id` int(11) NOT NULL,
  `atendimento` varchar(50) NOT NULL,
  `participacao` float(5,4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Fazendo dump de dados para tabela `atendimentos`
--

INSERT INTO `atendimentos` (`id`, `atendimento`, `participacao`) VALUES
(1, 'Clínico Geral', 0.3320),
(2, 'Especialista', 0.4980),
(3, 'Prótese com laboratório', 0.5810);

-- --------------------------------------------------------

--
-- Estrutura para tabela `convenios`
--

CREATE TABLE `convenios` (
  `id` int(11) NOT NULL,
  `convenio` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Fazendo dump de dados para tabela `convenios`
--

INSERT INTO `convenios` (`id`, `convenio`) VALUES
(1, 'SulAmérica'),
(2, 'Amil'),
(3, 'MetLife'),
(4, 'Odonto'),
(5, 'Servdonto');

-- --------------------------------------------------------

--
-- Estrutura para tabela `guias`
--

CREATE TABLE `guias` (
  `id` int(11) NOT NULL,
  `numero` bigint(20) NOT NULL,
  `convenio` int(11) NOT NULL,
  `paciente` varchar(100) NOT NULL,
  `dentista` int(11) NOT NULL,
  `atendimento` int(1) NOT NULL,
  `valor` float(7,2) NOT NULL,
  `descricao` text NOT NULL,
  `b_pago` tinyint(1) NOT NULL DEFAULT '0',
  `datahora` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Fazendo dump de dados para tabela `guias`
--

INSERT INTO `guias` (`id`, `numero`, `convenio`, `paciente`, `dentista`, `atendimento`, `valor`, `descricao`, `b_pago`, `datahora`) VALUES
(1, 555, 1, 'Filipe Lopes', 3, 2, 0.00, 'Descrição', 0, '2018-11-21 20:31:47'),
(2, 556, 2, 'Paciete', 3, 3, 0.00, 'descrição grande descrição grande descrição grande descrição grande descrição grande descrição grande descrição grande', 0, '2018-11-21 21:16:53'),
(3, 65, 3, 'Fulano de Souza', 3, 3, 235.25, 'Descrição here', 0, '2018-12-01 11:09:14'),
(4, 56988659, 1, 'Cicrano Cerqueira', 3, 2, 659.96, 'Sei lá, qualquer procedimento aí. Hehe', 0, '2018-12-02 08:39:44'),
(5, 87, 2, 'Filipe Lopes', 3, 1, 125.23, 'Descrição mais uma vez', 0, '2018-12-03 18:30:49'),
(6, 88, 2, 'Filipe Lopes', 3, 1, 253.21, 'Descrição do procedimento vai aqui', 0, '2018-12-03 18:31:49'),
(7, 89, 2, 'Andréia Márcia', 3, 1, 125.25, 'Descrição do atendimento', 0, '2018-12-03 18:33:37'),
(8, 56, 2, 'Gustavo Alcântara', 3, 1, 25.21, 'Descrição do procedimento', 0, '2018-12-03 18:36:27'),
(9, 4587, 4, 'Fabiane Moraes', 3, 1, 123.25, 'Descrição do procedimento', 0, '2018-12-03 18:37:36'),
(10, 1234, 3, 'Fulano de Souza', 3, 1, 125.25, 'XXX', 0, '2018-12-03 18:38:14'),
(11, 1235, 5, 'Nicole Almeida', 3, 1, 125.25, 'Descrição do proc', 0, '2018-12-03 18:41:29'),
(12, 2385, 4, 'Nome teste', 3, 2, 23.21, 'Desccc', 0, '2018-12-12 17:54:42');

-- --------------------------------------------------------

--
-- Estrutura para tabela `pacientes`
--

CREATE TABLE `pacientes` (
  `id` int(11) NOT NULL,
  `nome` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Fazendo dump de dados para tabela `pacientes`
--

INSERT INTO `pacientes` (`id`, `nome`) VALUES
(1, 'Fulano de Souza'),
(2, 'Cicrano Cerqueira'),
(3, 'Filipe Lopes'),
(4, 'Andréia Márcia'),
(5, 'Gustavo Alcântara'),
(6, 'Fabiane Moraes'),
(7, 'Nicole Almeida'),
(8, 'Nome teste');

-- --------------------------------------------------------

--
-- Estrutura para tabela `perfis`
--

CREATE TABLE `perfis` (
  `id` int(11) NOT NULL,
  `usuario` int(11) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `funcao` varchar(20) NOT NULL,
  `cpf` varchar(20) NOT NULL,
  `email` varchar(50) NOT NULL,
  `celular` varchar(50) NOT NULL,
  `cep` varchar(50) NOT NULL,
  `rua` varchar(50) NOT NULL,
  `numero` varchar(50) NOT NULL,
  `complemento` varchar(50) DEFAULT NULL,
  `bairro` varchar(50) NOT NULL,
  `cidade` varchar(50) NOT NULL,
  `estado` varchar(50) NOT NULL,
  `cro` varchar(50) DEFAULT NULL,
  `especialidade` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Fazendo dump de dados para tabela `perfis`
--

INSERT INTO `perfis` (`id`, `usuario`, `nome`, `funcao`, `cpf`, `email`, `celular`, `cep`, `rua`, `numero`, `complemento`, `bairro`, `cidade`, `estado`, `cro`, `especialidade`) VALUES
(1, 1, 'Celson Lopes', 'administrador', '018.170.135-99', 'contato@email.com.br', '(71) 99254-0736', '40440030', 'Rua José Sena', '10', 'casa', 'Caminho de Areia', 'Salvador', 'BA', NULL, NULL),
(2, 3, 'Henrique Paim', 'dentista', '018.175.169-69', 'dentista@email.com.br', '(71) 98565-6589', '40450020', '...', '235', 'Apto 203', '...', '...', 'BA', '10253', 'Especialidade Y'),
(3, 2, 'Keila Maielle', 'atendente', '152.458.589-98', 'atendente@email', '(71) 98565-6589', '50300020', 'Rua Almirante Barbosa', '1025', NULL, 'Pituba', 'Salvador', 'BA', NULL, NULL),
(5, 34, 'Novo Dentista', 'dentista', '555.555.555-55', 'filiperocklopes@gmail.com', '(55) 55555-5555', '40440030', 'Rua José Sena', '12', '', 'Caminho de Areia', 'Salvador', 'BA', '1425', 'Especialidade X'),
(6, 35, 'ANDRE M S LOPES', 'dentista', '499.474.605-23', 'novoemail@email.com', '(71) 99254-0736', '40440030', 'Rua José Sena', '12', '', 'Caminho de Areia', 'Salvador', 'BA', '12365', '');

-- --------------------------------------------------------

--
-- Estrutura para tabela `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(2) NOT NULL,
  `email` varchar(50) NOT NULL,
  `senha` varchar(32) NOT NULL,
  `permissoes` text NOT NULL,
  `validacao` tinyint(1) NOT NULL DEFAULT '0',
  `b_del` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Fazendo dump de dados para tabela `usuarios`
--

INSERT INTO `usuarios` (`id`, `email`, `senha`, `permissoes`, `validacao`, `b_del`) VALUES
(1, 'filiperocklopes@gmail.com', 'e8d95a51f3af4a3b134bf6bb680a213a', '{ \"configuracoes\" : true,\r\n\"validacao-cadastro\": true,\r\n\"novo-atendimento\":false,\r\n\"meus-atendimentos\":false,\r\n\"cadastro-dentista\": true,\r\n\"cadastro-convenios\": true,\r\n\"atendimentos\": true,\r\n\"relatorio-guias\": true,\r\n\"relatorio-dentistas\": true}', 1, 0),
(2, 'atendente@email.com', 'e8d95a51f3af4a3b134bf6bb680a213a', '{ \"configuracoes\" : true }', 1, 0),
(3, 'dentista@email.com', 'e8d95a51f3af4a3b134bf6bb680a213a', '{ \"configuracoes\" : true,\n\"validacao-cadastro\": false,\n\"novo-atendimento\":true,\n\"meus-atendimentos\":true }', 1, 0),
(34, 'dentista2@email.com', 'e8d95a51f3af4a3b134bf6bb680a213a', '{\n    \"configuracoes\" : true\n}', 0, 0),
(35, 'novoemail@email.com', 'e8d95a51f3af4a3b134bf6bb680a213a', '{\n    \"configuracoes\" : true\n}', 0, 0);

--
-- Índices de tabelas apagadas
--

--
-- Índices de tabela `atendimentos`
--
ALTER TABLE `atendimentos`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `convenios`
--
ALTER TABLE `convenios`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `guias`
--
ALTER TABLE `guias`
  ADD PRIMARY KEY (`id`),
  ADD KEY `dentista` (`dentista`),
  ADD KEY `convenio` (`convenio`),
  ADD KEY `atendimento` (`atendimento`);

--
-- Índices de tabela `pacientes`
--
ALTER TABLE `pacientes`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `perfis`
--
ALTER TABLE `perfis`
  ADD PRIMARY KEY (`id`),
  ADD KEY `usuario` (`usuario`);

--
-- Índices de tabela `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de tabelas apagadas
--

--
-- AUTO_INCREMENT de tabela `atendimentos`
--
ALTER TABLE `atendimentos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de tabela `convenios`
--
ALTER TABLE `convenios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de tabela `guias`
--
ALTER TABLE `guias`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de tabela `pacientes`
--
ALTER TABLE `pacientes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de tabela `perfis`
--
ALTER TABLE `perfis`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de tabela `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- Restrições para dumps de tabelas
--

--
-- Restrições para tabelas `guias`
--
ALTER TABLE `guias`
  ADD CONSTRAINT `atendimento` FOREIGN KEY (`atendimento`) REFERENCES `atendimentos` (`id`),
  ADD CONSTRAINT `convenio` FOREIGN KEY (`convenio`) REFERENCES `convenios` (`id`),
  ADD CONSTRAINT `dentista` FOREIGN KEY (`dentista`) REFERENCES `usuarios` (`id`);

--
-- Restrições para tabelas `perfis`
--
ALTER TABLE `perfis`
  ADD CONSTRAINT `perfis_ibfk_1` FOREIGN KEY (`usuario`) REFERENCES `usuarios` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
