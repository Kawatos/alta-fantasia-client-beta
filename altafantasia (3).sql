-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 05/06/2025 às 05:07
-- Versão do servidor: 10.4.28-MariaDB
-- Versão do PHP: 8.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `altafantasia`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `atributos`
--

CREATE TABLE `atributos` (
  `id_atributos` int(255) NOT NULL,
  `vigor` int(11) DEFAULT NULL,
  `vigor_mod` int(11) DEFAULT NULL,
  `forca` int(11) DEFAULT NULL,
  `forca_mod` int(11) DEFAULT NULL,
  `destreza` int(11) DEFAULT NULL,
  `destreza_mod` int(11) DEFAULT NULL,
  `espirito` int(11) DEFAULT NULL,
  `espirito_mod` int(11) DEFAULT NULL,
  `carisma` int(11) DEFAULT NULL,
  `carisma_mod` int(11) DEFAULT NULL,
  `intelecto` int(11) DEFAULT NULL,
  `intelecto_mod` int(11) DEFAULT NULL,
  `id_ficha` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `atributos`
--

INSERT INTO `atributos` (`id_atributos`, `vigor`, `vigor_mod`, `forca`, `forca_mod`, `destreza`, `destreza_mod`, `espirito`, `espirito_mod`, `carisma`, `carisma_mod`, `intelecto`, `intelecto_mod`, `id_ficha`) VALUES
(0, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 33);

-- --------------------------------------------------------

--
-- Estrutura para tabela `fichas`
--

CREATE TABLE `fichas` (
  `id` int(11) NOT NULL,
  `usuario_id` int(11) NOT NULL,
  `nome_personagem` varchar(100) DEFAULT NULL,
  `classe` varchar(255) DEFAULT NULL,
  `nivel` int(255) DEFAULT NULL,
  `descricao` text DEFAULT NULL,
  `raca` varchar(255) DEFAULT NULL,
  `habilidades` text DEFAULT NULL,
  `magias_arcanas` text DEFAULT NULL,
  `magias_divinas` text DEFAULT NULL,
  `itens` text DEFAULT NULL,
  `atributos_mentais` varchar(255) DEFAULT NULL,
  `atributos_corporais` varchar(255) DEFAULT NULL,
  `pericias_corporais` text DEFAULT NULL,
  `pericias_mentais` text DEFAULT NULL,
  `pontos_de_vida` int(255) DEFAULT NULL,
  `pontos_de_mana` int(255) DEFAULT NULL,
  `status_personagem` varchar(255) DEFAULT NULL,
  `pvs_atuais` int(255) DEFAULT NULL,
  `pms_atuais` int(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `fichas`
--

INSERT INTO `fichas` (`id`, `usuario_id`, `nome_personagem`, `classe`, `nivel`, `descricao`, `raca`, `habilidades`, `magias_arcanas`, `magias_divinas`, `itens`, `atributos_mentais`, `atributos_corporais`, `pericias_corporais`, `pericias_mentais`, `pontos_de_vida`, `pontos_de_mana`, `status_personagem`, `pvs_atuais`, `pms_atuais`) VALUES
(1, 6, 'asdss', 'asdsss', 1, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(2, 6, 'Jooj e viadinho', 'Jooj e viadinho', 1, '', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0),
(10, 1, 'Phinneas t', 'Bárbaro', 12345, 'Teste222', 'Dunkeriu', 'Tese', '', '', '', NULL, NULL, '', '', 0, 0, 'Vivo', 0, 0),
(17, 1, 'Teste 123', 'Bárbaro', 1234, 'asdasdasd', 'Dunkeriu', 'asdasd', 'asdasd', 'asdasd', 'asdas', '{\"intelecto\":\"\",\"mod_intelecto\":\"\",\"espirito\":\"\",\"mod_espirito\":\"\",\"carisma\":\"13\",\"mod_carisma\":\"2\"}', '{\"vigor\":\"10\",\"mod_vigor\":\"2\",\"forca\":\"12\",\"mod_forca\":\"3\",\"destreza\":\"9\",\"mod_destreza\":\"1\"}', 'asd', 'asdasd', 123, 123, 'Vivo', 0, 0),
(22, 1, 'Kaua S', 'Bárbaro', 176, '', 'Lichiru', '', '', '', '', '', '', '', '', 0, 0, '0', 0, 0),
(23, 1, 'om32', 'Guerreiro', 100, '123', 'Gnomo', '', '', '', '', '{\"intelecto\":\"\",\"mod_intelecto\":\"\",\"espirito\":\"\",\"mod_espirito\":\"\",\"carisma\":\"13\",\"mod_carisma\":\"2\"}', '{\"vigor\":\"10\",\"mod_vigor\":\"2\",\"forca\":\"12\",\"mod_forca\":\"3\",\"destreza\":\"9\",\"mod_destreza\":\"1\"}', '', '', 123, 123, 'Vivo', 123, 0),
(24, 1, '12 zilson da silva', 'Guerreiro', 188, 'asd', 'Dunkeriu', '', '', '', '', '{\"intelecto\":\"12\",\"mod_intelecto\":\"12\",\"espirito\":\"12\",\"mod_espirito\":\"12\",\"carisma\":\"12\",\"mod_carisma\":\"12\"}', '{\"vigor\":\"12\",\"mod_vigor\":\"12\",\"forca\":\"12\",\"mod_forca\":\"12\",\"destreza\":\"12\",\"mod_destreza\":\"12\"}', '', '', 123, 123, 'Vivo', 123, 123),
(27, 1, 'tetetetete', 'Guerreiro', 12300, '23', 'Lichiru', '', '', '', '', '{\"intelecto\":\"\",\"mod_intelecto\":\"\",\"espirito\":\"\",\"mod_espirito\":\"\",\"carisma\":\"\",\"mod_carisma\":\"\"}', '{\"vigor\":\"\",\"mod_vigor\":\"\",\"forca\":\"\",\"mod_forca\":\"\",\"destreza\":\"\",\"mod_destreza\":\"\"}', '', '', 23, 23, 'Vivo', 23, 23),
(32, 1, 'qwe', 'Bárbaro', 100, '123', 'Lichiru', '', '', '', '', NULL, NULL, '', '', 123, 123, 'Vivo', 123, 123),
(33, 1, 'atributilson o cara', 'Bárbaro', 100, 'asd', 'Lichiru', '', '', '', '', NULL, NULL, '', '', 123, 0, 'Vivo', 123, 0);

-- --------------------------------------------------------

--
-- Estrutura para tabela `magias`
--

CREATE TABLE `magias` (
  `id` int(11) NOT NULL,
  `nome` varchar(255) DEFAULT NULL,
  `tipo` varchar(255) DEFAULT NULL,
  `nivel` int(11) DEFAULT NULL,
  `custo_pm` varchar(255) DEFAULT NULL,
  `alcance` varchar(255) DEFAULT NULL,
  `duracao` varchar(255) DEFAULT NULL,
  `descritor` varchar(255) DEFAULT NULL,
  `descricao` text DEFAULT NULL,
  `ficha_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `senha` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `usuarios`
--

INSERT INTO `usuarios` (`id`, `username`, `senha`) VALUES
(1, 'Kawatos', '$2y$10$2.2v1EdT4.xF5WozAQ4ub.ME2nUe6EYVGD7jSRhtBybQAT.mAAiua'),
(2, 'Kawatos2', '$2y$10$zaLrTU2VfipXk12dQwbI4eVo.dB8ARubN8Eor0XGML.IZ/OnhnvdG'),
(3, 'Teste1', '$2y$10$K0YnfLEA6tlJox4NybhlhOMMNAmQfMlS0782nEqZ7SnkDCs7wcUmO'),
(4, 'Teste12', '$2y$10$wdeMqGnDmcNSH9rH7hoNauILL7bKlZ8xRmHssvYT4cHyheH8hEpjm'),
(5, 'Teste 3', '$2y$10$4Oj2d2dt8tBErZY6n7h5MOe9xmHqmZ54bY.FjAjFqSIu3Xt73YWfS'),
(6, 'teste 4', '$2y$10$wGkwNxGHuEgd2D7adHJ1cuLm9mM7zrYb4KiemjueI8TKwHozHJDta');

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `atributos`
--
ALTER TABLE `atributos`
  ADD PRIMARY KEY (`id_atributos`);

--
-- Índices de tabela `fichas`
--
ALTER TABLE `fichas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `usuario_id` (`usuario_id`);

--
-- Índices de tabela `magias`
--
ALTER TABLE `magias`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `fichas`
--
ALTER TABLE `fichas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT de tabela `magias`
--
ALTER TABLE `magias`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `fichas`
--
ALTER TABLE `fichas`
  ADD CONSTRAINT `fichas_ibfk_1` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
