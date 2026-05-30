-- phpMyAdmin SQL Dump
-- version 5.2.3
-- https://www.phpmyadmin.net/
--
-- Host: db
-- Tempo de geração: 24/05/2026 às 15:31
-- Versão do servidor: 8.0.45
-- Versão do PHP: 8.3.30

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
  `id_atributos` int NOT NULL,
  `vigor_mod` int DEFAULT NULL,
  `forca_mod` int DEFAULT NULL,
  `destreza_mod` int DEFAULT NULL,
  `espirito_mod` int DEFAULT NULL,
  `carisma_mod` int DEFAULT NULL,
  `intelecto_mod` int DEFAULT NULL,
  `id_ficha` int DEFAULT NULL,
  `vigor_mod_nv` int DEFAULT NULL,
  `forca_mod_nv` int DEFAULT NULL,
  `destreza_mod_nv` int DEFAULT NULL,
  `espirito_mod_nv` int DEFAULT NULL,
  `carisma_mod_nv` int DEFAULT NULL,
  `intelecto_mod_nv` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `atributos`
--

INSERT INTO `atributos` (`id_atributos`, `vigor_mod`, `forca_mod`, `destreza_mod`, `espirito_mod`, `carisma_mod`, `intelecto_mod`, `id_ficha`, `vigor_mod_nv`, `forca_mod_nv`, `destreza_mod_nv`, `espirito_mod_nv`, `carisma_mod_nv`, `intelecto_mod_nv`) VALUES
(1, 0, 0, 0, 0, 0, 0, 1, 0, 0, 0, 0, 0, 0),
(2, 0, 0, 0, 0, 0, 0, 2, 0, 0, 0, 0, 0, 0),
(4, 1, 1, 1, 0, 0, 0, 4, 1, 1, 1, 0, 0, 0),
(5, 1, 1, 1, 1, 1, 1, 5, 0, 0, 0, 0, 0, 0),
(6, 0, 0, 0, 0, 0, 0, 6, 0, 0, 0, 0, 0, 0),
(7, 0, 0, 0, 0, 0, 0, 7, 0, 0, 0, 0, 0, 0),
(10, 0, 0, 0, 0, 0, 0, 19, 0, 0, 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- Estrutura para tabela `campanhas`
--

CREATE TABLE `campanhas` (
  `id` int NOT NULL,
  `nome` varchar(100) NOT NULL,
  `descricao` text,
  `codigo_convite` varchar(20) NOT NULL,
  `criado_por` int NOT NULL,
  `data_criacao` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Despejando dados para a tabela `campanhas`
--

INSERT INTO `campanhas` (`id`, `nome`, `descricao`, `codigo_convite`, `criado_por`, `data_criacao`) VALUES
(1, 'Campanha Oficial 1s', 'é a oficial 1', 'CEC8F40B', 1, '2026-05-02 19:24:51'),
(6, 'sdxcfsdf', 'sdfsdf', 'ED885A4D', 2, '2026-05-03 02:26:52'),
(7, 'birin, bau', 'birin, bau 74E22EEA', '74E22EEA', 1, '2026-05-03 13:02:31'),
(16, 'asd', '', '7A402FC3', 1, '2026-05-03 13:27:26');

-- --------------------------------------------------------

--
-- Estrutura para tabela `campanha_fichas`
--

CREATE TABLE `campanha_fichas` (
  `id` int NOT NULL,
  `campanha_id` int NOT NULL,
  `ficha_id` int NOT NULL,
  `usuario_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Despejando dados para a tabela `campanha_fichas`
--

INSERT INTO `campanha_fichas` (`id`, `campanha_id`, `ficha_id`, `usuario_id`) VALUES
(1, 1, 1, 1),
(3, 1, 3, 2),
(4, 6, 3, 2),
(15, 1, 13, 2),
(16, 1, 14, 2),
(18, 1, 16, 2),
(19, 1, 18, 2),
(20, 1, 19, 2),
(32, 1, 6, 1),
(33, 1, 7, 1),
(34, 1, 20, 1);

-- --------------------------------------------------------

--
-- Estrutura para tabela `campanha_usuarios`
--

CREATE TABLE `campanha_usuarios` (
  `id` int NOT NULL,
  `usuario_id` int NOT NULL,
  `campanha_id` int NOT NULL,
  `papel` enum('mestre','jogador') DEFAULT 'jogador',
  `data_entrada` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Despejando dados para a tabela `campanha_usuarios`
--

INSERT INTO `campanha_usuarios` (`id`, `usuario_id`, `campanha_id`, `papel`, `data_entrada`) VALUES
(1, 1, 1, 'mestre', '2026-05-02 19:24:51'),
(7, 2, 6, 'mestre', '2026-05-03 02:26:52'),
(8, 1, 7, 'mestre', '2026-05-03 13:02:31'),
(17, 1, 16, 'mestre', '2026-05-03 13:27:26'),
(21, 2, 1, 'jogador', '2026-05-03 19:55:34');

-- --------------------------------------------------------

--
-- Estrutura para tabela `convites`
--

CREATE TABLE `convites` (
  `id` int NOT NULL,
  `campanha_id` int DEFAULT NULL,
  `enviado_por` int DEFAULT NULL,
  `enviado_para` int DEFAULT NULL,
  `status` enum('pendente','aceito','recusado') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `fichas`
--

CREATE TABLE `fichas` (
  `id` int NOT NULL,
  `usuario_id` int NOT NULL,
  `nome_personagem` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `classe` text COLLATE utf8mb4_general_ci,
  `nivel` int DEFAULT NULL,
  `descricao` text COLLATE utf8mb4_general_ci,
  `raca` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `pontos_de_vida` int DEFAULT NULL,
  `pontos_de_mana` int DEFAULT NULL,
  `status_personagem` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `pvs_atuais` int DEFAULT NULL,
  `pms_atuais` int DEFAULT NULL,
  `deslocamento` int DEFAULT NULL,
  `regen_pv` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `regen_pm` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `observacoes_atributos` text COLLATE utf8mb4_general_ci,
  `observacoes_pericias` text COLLATE utf8mb4_general_ci,
  `observacoes_habilidades` text COLLATE utf8mb4_general_ci,
  `observacoes_magias_arcanas` text COLLATE utf8mb4_general_ci,
  `observacoes_magias_divinas` text COLLATE utf8mb4_general_ci,
  `observacoes_itens` text COLLATE utf8mb4_general_ci,
  `observacoes_jogador` text COLLATE utf8mb4_general_ci,
  `divindade` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `escola_arcana` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `idiomas` text COLLATE utf8mb4_general_ci,
  `carga_suportada_mod` int DEFAULT NULL,
  `inventario_interno_mod` int DEFAULT NULL,
  `personagem_imagem` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `altura` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `idade` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `sexo` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `tendencia` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `nome_jogador` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `profissao_jogador` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `descricao_jogador` text COLLATE utf8mb4_general_ci NOT NULL,
  `transformacoes_jogador` text COLLATE utf8mb4_general_ci NOT NULL,
  `tipo_ficha` enum('padrao','bloco','arquivo') COLLATE utf8mb4_general_ci DEFAULT 'padrao',
  `bloco_notas` text COLLATE utf8mb4_general_ci,
  `arquivo_pdf` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `fichas`
--

INSERT INTO `fichas` (`id`, `usuario_id`, `nome_personagem`, `classe`, `nivel`, `descricao`, `raca`, `pontos_de_vida`, `pontos_de_mana`, `status_personagem`, `pvs_atuais`, `pms_atuais`, `deslocamento`, `regen_pv`, `regen_pm`, `observacoes_atributos`, `observacoes_pericias`, `observacoes_habilidades`, `observacoes_magias_arcanas`, `observacoes_magias_divinas`, `observacoes_itens`, `observacoes_jogador`, `divindade`, `escola_arcana`, `idiomas`, `carga_suportada_mod`, `inventario_interno_mod`, `personagem_imagem`, `altura`, `idade`, `sexo`, `tendencia`, `nome_jogador`, `profissao_jogador`, `descricao_jogador`, `transformacoes_jogador`, `tipo_ficha`, `bloco_notas`, `arquivo_pdf`) VALUES
(1, 1, 'was sdS1', '[]', 100, 'asd', '', 100, 0, 'Vivo', 100, 0, 0, '', '', '', 'asdasd', '', '', '', '', '', '', '', '', 0, 0, 'uploads/img_69fbfd84b933b.png', '', '', '', '', '', '', '', 'asd', 'padrao', NULL, NULL),
(2, 1, 'sa', '[]', 100, '', '', 100, 0, 'Vivo', 100, 0, 0, '', '', '', '', '', '', '', '', '', '1', '', '1', 0, 0, 'uploads/img_69fbfd9a25bb1.png', '1', '12', '', '', '', '', '', '', 'padrao', NULL, NULL),
(4, 1, 'teste de dados salvos 12', '[]', 100, 's', 'Dunkeriu', 100, 0, 'Vivo', 100, 0, 12, '', '', 'asd', 'asd', 'asd', 'asd', '', 'asd', 'asd', '12', '12', '12', 0, 0, 'uploads/img_69fbfda3292f6.png', '12', '12', 'masculino', 'Leal - Bondoso', 'asd', 'asd', 'asd', 's', 'padrao', NULL, NULL),
(5, 1, 'eeee', '[]', 99, 'asd', 'Dryad', 1234, 0, 'Vivo', 1234, 0, 12, '', '', 'asd', 'dffg', 'asd', 'asd', '', '', 'aasd', '12', '12', '12', 0, 0, 'uploads/img_69fbdb74022a7.jpg', '', '12', '', '', 'asd', 'asd', 'asd', 'asd', 'padrao', NULL, NULL),
(6, 1, 'ssssss21q', '[]', 0, '', '', 0, 0, 'Vivo', 0, 0, 0, '', '', '', '', '', '', '', '', '', '', '', '', 0, 0, 'uploads/img_69fbfd6c3da9f.png', '', '', '', '', '', '', '', '', 'padrao', NULL, NULL),
(7, 1, 'd', '[]', 100, '', '', 100, 0, 'Vivo', 100, 0, 0, '', '', '', '', '', '', '', '', '', '', '', '', 0, 0, 'uploads/img_69fbee955692f.png', '', '', '', '', '', '', '', '', 'padrao', NULL, NULL),
(18, 2, 'ssss', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'uploads/avatar_18_1777850609.png', NULL, NULL, NULL, NULL, '', '', '', '', 'bloco', '', NULL),
(19, 2, 'Arthanor 1', '[]', 100, '', '', 100, 0, 'Vivo', 94, -6, 0, '', '', '', '', '', '', '', '', '', '', '', '', 0, 0, 'uploads/img_69f7d92792f92.jpg', '', '', '', '', '', '', '', '', 'padrao', NULL, NULL),
(20, 1, 'Teste bi', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'uploads/avatar_20_1778117944.png', NULL, NULL, NULL, NULL, '', '', '', '', 'bloco', 'sasas', NULL),
(21, 1, 'asd', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '', 'bloco', '', NULL),
(24, 1, '22221', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '', 'bloco', 'a', NULL),
(25, 1, '22221 (Cópia)', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', '', '', '', 'bloco', '', NULL);

-- --------------------------------------------------------

--
-- Estrutura para tabela `habilidades`
--

CREATE TABLE `habilidades` (
  `id_habilidade` int NOT NULL,
  `id_ficha` int NOT NULL,
  `nome` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `requisitos` text COLLATE utf8mb4_general_ci NOT NULL,
  `descricao` text COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `habilidades`
--

INSERT INTO `habilidades` (`id_habilidade`, `id_ficha`, `nome`, `requisitos`, `descricao`) VALUES
(1, 1, '1', '1', '1'),
(2, 4, '1', '1', '1'),
(3, 4, 'a', 'a', 'a'),
(4, 7, '1', '1', '1'),
(5, 4, 'sd', 'sd', 'sd'),
(6, 5, 'asd', '', '');

-- --------------------------------------------------------

--
-- Estrutura para tabela `itens`
--

CREATE TABLE `itens` (
  `id_item` int NOT NULL,
  `id_ficha` int NOT NULL,
  `nome` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `rank` int NOT NULL,
  `descricao` text COLLATE utf8mb4_general_ci NOT NULL,
  `peso` float DEFAULT NULL,
  `volume` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `equipado` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `inventario_interno` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `quantidade` int DEFAULT NULL,
  `estado` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `conjunto` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `ignorar_peso` varchar(255) COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `itens`
--

INSERT INTO `itens` (`id_item`, `id_ficha`, `nome`, `rank`, `descricao`, `peso`, `volume`, `equipado`, `inventario_interno`, `quantidade`, `estado`, `conjunto`, `ignorar_peso`) VALUES
(1, 4, '1', 1, '1', 1, 'pequeno', 'sim', 'sim', 1, 'intacto', 'sim', 'sim'),
(2, 4, '2', 0, '1', 0, '', '', 'nao', 0, '', '', ''),
(3, 5, 'asd', 0, '', 0, '', '', '', 0, '', 'nao', 'nao');

-- --------------------------------------------------------

--
-- Estrutura para tabela `magias`
--

CREATE TABLE `magias` (
  `id_magias` int NOT NULL,
  `nome_magia` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `tipo_magia` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `nivel` int DEFAULT NULL,
  `custo_pm` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `alcance` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `duracao` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `descritor` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `descricao` text COLLATE utf8mb4_general_ci,
  `id_ficha` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `magias`
--

INSERT INTO `magias` (`id_magias`, `nome_magia`, `tipo_magia`, `nivel`, `custo_pm`, `alcance`, `duracao`, `descritor`, `descricao`, `id_ficha`) VALUES
(1, '1', 'arcana', 1, '1', '1', '', '1', '1', 7),
(2, '2', 'arcana', 2, '2', '2', '2', '2', '2', 7),
(3, '1', 'divina', 1, '1', '1', '1', '1', '1', 4),
(4, '1', 'arcana', 1, '1', '1', '1', '1', '1', 4),
(5, 'asd', 'arcana', 0, '', '', '', '', '', 5);

-- --------------------------------------------------------

--
-- Estrutura para tabela `mensagens`
--

CREATE TABLE `mensagens` (
  `id` int NOT NULL,
  `campanha_id` int DEFAULT NULL,
  `usuario_id` int DEFAULT NULL,
  `mensagem` text,
  `data_envio` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Despejando dados para a tabela `mensagens`
--

INSERT INTO `mensagens` (`id`, `campanha_id`, `usuario_id`, `mensagem`, `data_envio`) VALUES
(1, 1, 2, 'dsd', '2026-05-03 00:01:58'),
(2, 1, 2, 'sss', '2026-05-03 00:05:37'),
(3, 1, 2, 'peepe', '2026-05-03 00:05:50'),
(4, 1, 1, 'teste', '2026-05-03 00:06:14'),
(5, 1, 1, 'tetete', '2026-05-03 00:06:35'),
(6, 1, 1, '6e', '2026-05-03 00:07:43'),
(7, 1, 1, 'tetetetetete', '2026-05-03 00:12:18'),
(8, 1, 1, 'mememememe', '2026-05-03 00:12:29'),
(9, 1, 1, 'c', '2026-05-03 00:12:56'),
(10, 1, 1, 'a', '2026-05-03 00:13:11'),
(11, 1, 1, 's', '2026-05-03 00:13:14'),
(12, 1, 1, 'd', '2026-05-03 00:13:17'),
(13, 1, 1, 'f', '2026-05-03 00:13:20'),
(15, 1, 1, 'cd', '2026-05-03 02:05:42'),
(16, 1, 1, 'asdasd', '2026-05-03 02:20:04'),
(18, 1, 1, 'teu cu', '2026-05-03 02:23:26'),
(19, 6, 2, 'asd', '2026-05-03 02:26:59'),
(21, 7, 1, 'teste', '2026-05-03 18:04:47'),
(23, 1, 1, 'asdasdasdasdasdasdasdasdasdasdasdasdasdasdasdasdasdasdasdasdasdasdasdasdasdasdasdasdasdasdasdasdasdasdasdasdasdasdasdasdasdasdasdasdasdasdasdasdasdasdasdasdasdasdasdasdasdasdasdasdasdasdasdasdasdasdasdasdasdasdasdasdasdasdasdasdasdasdasdasdasdasdasdasdasdasdasdasdasdasdasdasdasdasdasdasdasdasdasdasdasdasdasdasdasdasdasdasdasdasdasdasdasdasdasdasdasdasdasdasdasdasdasdasdasdasdasdasdasdasdasdasdasdasdasdasdasdasdasdasdasdasdasdasdasdasdasdasdasdasdasdasdasdasdasdasdasdasdasdasdasdasdasdasdasd', '2026-05-03 18:53:53'),
(30, 1, 1, 'n0YDFRYxJjCdskoEKfD6+CmA1TC64jvWCo/q4kqgMCRgXlUxgLtHSqVyrwCyRTVPLxIDAq3o+KuEg5+FeAESoQ==', '2026-05-06 01:50:30'),
(31, 1, 1, '6VwsFz4AX7+Hd+t93wfgbDArXM8RzYJVwIxkDAP7brI8acYs/SX3EOLGeiZgH45eSIk+d290Ho5hLAt6zkvmYiq+azymTcW75NuxB8IZYoon1IqRKpv7QhVC37ACucIv', '2026-05-06 01:51:00'),
(34, 1, 2, 'A1See0IK01Rs5KlqkBLIwxbQPhc41Xlu9xc3+84uxVY=', '2026-05-06 02:03:52'),
(35, 1, 2, 'EGXl62C2JqKgXW/GWOWUInH3/1/ve4LGW4YvVcwnyis=', '2026-05-06 02:03:54'),
(36, 1, 2, 'p3wbmXnF8IAERkljYqpX0H+vEBsDrDpYhDSU+9cNnY0=', '2026-05-06 02:03:59'),
(37, 1, 2, 'm8TDyTnGNgDF1c2Pn7TQRCBMat8/gAuFLRWIRwq1q8PwUiteIt6nITpsDWSxwTpSf1IXBkcFGrsAt4fWganPfw==', '2026-05-06 02:21:08');

-- --------------------------------------------------------

--
-- Estrutura para tabela `pericias`
--

CREATE TABLE `pericias` (
  `id_pericias` int NOT NULL,
  `id_ficha` int DEFAULT NULL,
  `tenacidade_mod` int DEFAULT NULL,
  `fortitude_mod` int DEFAULT NULL,
  `reflexo_mod` int DEFAULT NULL,
  `controle_mod` int DEFAULT NULL,
  `atletismo_mod` int DEFAULT NULL,
  `corpoacorpo_mod` int DEFAULT NULL,
  `autocontrole_mod` int DEFAULT NULL,
  `resiliencia_mod` int DEFAULT NULL,
  `intuicao_mod` int DEFAULT NULL,
  `percepcao_mod` int DEFAULT NULL,
  `influencia_mod` int DEFAULT NULL,
  `atuacao_mod` int DEFAULT NULL,
  `c_arcano_mod` int DEFAULT NULL,
  `c_religioso_mod` int DEFAULT NULL,
  `c_historico_mod` int DEFAULT NULL,
  `c_natureza_mod` int DEFAULT NULL,
  `c_engenharia_mod` int DEFAULT NULL,
  `c_alquimia_mod` int DEFAULT NULL,
  `c_navegacao_mod` int DEFAULT NULL,
  `c_linguistico_mod` int DEFAULT NULL,
  `t_esgrima_mod` int DEFAULT NULL,
  `t_pontaria_mod` int DEFAULT NULL,
  `t_marcial_mod` int DEFAULT NULL,
  `t_metalurgia_mod` int DEFAULT NULL,
  `t_artesanato_mod` int DEFAULT NULL,
  `t_ladinagem_mod` int DEFAULT NULL,
  `t_instrumentos_mod` int DEFAULT NULL,
  `t_pilotagem_mod` int DEFAULT NULL,
  `tenacidade_treinamentos` int DEFAULT NULL,
  `tenacidade_proeficiencias` int DEFAULT NULL,
  `fortitude_treinamentos` int DEFAULT NULL,
  `fortitude_proeficiencias` int DEFAULT NULL,
  `reflexo_treinamentos` int DEFAULT NULL,
  `reflexo_proeficiencias` int DEFAULT NULL,
  `controle_treinamentos` int DEFAULT NULL,
  `controle_proeficiencias` int DEFAULT NULL,
  `atletismo_treinamentos` int DEFAULT NULL,
  `atletismo_proeficiencias` int DEFAULT NULL,
  `corpoacorpo_treinamentos` int DEFAULT NULL,
  `corpoacorpo_proeficiencias` int DEFAULT NULL,
  `autocontrole_treinamentos` int DEFAULT NULL,
  `autocontrole_proeficiencias` int DEFAULT NULL,
  `resiliencia_treinamentos` int DEFAULT NULL,
  `resiliencia_proeficiencias` int DEFAULT NULL,
  `intuicao_treinamentos` int DEFAULT NULL,
  `intuicao_proeficiencias` int DEFAULT NULL,
  `percepcao_treinamentos` int DEFAULT NULL,
  `percepcao_proeficiencias` int DEFAULT NULL,
  `influencia_treinamentos` int DEFAULT NULL,
  `influencia_proeficiencias` int DEFAULT NULL,
  `atuacao_treinamentos` int DEFAULT NULL,
  `atuacao_proeficiencias` int DEFAULT NULL,
  `c_arcano_treinamentos` int DEFAULT NULL,
  `c_arcano_proeficiencias` int DEFAULT NULL,
  `c_religioso_treinamentos` int DEFAULT NULL,
  `c_religioso_proeficiencias` int DEFAULT NULL,
  `c_historico_treinamentos` int DEFAULT NULL,
  `c_historico_proeficiencias` int DEFAULT NULL,
  `c_natureza_treinamentos` int DEFAULT NULL,
  `c_natureza_proeficiencias` int DEFAULT NULL,
  `c_engenharia_treinamentos` int DEFAULT NULL,
  `c_engenharia_proeficiencias` int DEFAULT NULL,
  `c_alquimia_treinamentos` int DEFAULT NULL,
  `c_alquimia_proeficiencias` int DEFAULT NULL,
  `c_navegacao_treinamentos` int DEFAULT NULL,
  `c_navegacao_proeficiencias` int DEFAULT NULL,
  `c_linguistico_treinamentos` int DEFAULT NULL,
  `c_linguistico_proeficiencias` int DEFAULT NULL,
  `t_esgrima_treinamentos` int DEFAULT NULL,
  `t_esgrima_proeficiencias` int DEFAULT NULL,
  `t_pontaria_treinamentos` int DEFAULT NULL,
  `t_pontaria_proeficiencias` int DEFAULT NULL,
  `t_marcial_treinamentos` int DEFAULT NULL,
  `t_marcial_proeficiencias` int DEFAULT NULL,
  `t_metalurgia_treinamentos` int DEFAULT NULL,
  `t_metalurgia_proeficiencias` int DEFAULT NULL,
  `t_artesanato_treinamentos` int DEFAULT NULL,
  `t_artesanato_proeficiencias` int DEFAULT NULL,
  `t_ladinagem_treinamentos` int DEFAULT NULL,
  `t_ladinagem_proeficiencias` int DEFAULT NULL,
  `t_instrumentos_treinamentos` int DEFAULT NULL,
  `t_instrumentos_proeficiencias` int DEFAULT NULL,
  `t_pilotagem_treinamentos` int DEFAULT NULL,
  `t_pilotagem_proeficiencias` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `pericias`
--

INSERT INTO `pericias` (`id_pericias`, `id_ficha`, `tenacidade_mod`, `fortitude_mod`, `reflexo_mod`, `controle_mod`, `atletismo_mod`, `corpoacorpo_mod`, `autocontrole_mod`, `resiliencia_mod`, `intuicao_mod`, `percepcao_mod`, `influencia_mod`, `atuacao_mod`, `c_arcano_mod`, `c_religioso_mod`, `c_historico_mod`, `c_natureza_mod`, `c_engenharia_mod`, `c_alquimia_mod`, `c_navegacao_mod`, `c_linguistico_mod`, `t_esgrima_mod`, `t_pontaria_mod`, `t_marcial_mod`, `t_metalurgia_mod`, `t_artesanato_mod`, `t_ladinagem_mod`, `t_instrumentos_mod`, `t_pilotagem_mod`, `tenacidade_treinamentos`, `tenacidade_proeficiencias`, `fortitude_treinamentos`, `fortitude_proeficiencias`, `reflexo_treinamentos`, `reflexo_proeficiencias`, `controle_treinamentos`, `controle_proeficiencias`, `atletismo_treinamentos`, `atletismo_proeficiencias`, `corpoacorpo_treinamentos`, `corpoacorpo_proeficiencias`, `autocontrole_treinamentos`, `autocontrole_proeficiencias`, `resiliencia_treinamentos`, `resiliencia_proeficiencias`, `intuicao_treinamentos`, `intuicao_proeficiencias`, `percepcao_treinamentos`, `percepcao_proeficiencias`, `influencia_treinamentos`, `influencia_proeficiencias`, `atuacao_treinamentos`, `atuacao_proeficiencias`, `c_arcano_treinamentos`, `c_arcano_proeficiencias`, `c_religioso_treinamentos`, `c_religioso_proeficiencias`, `c_historico_treinamentos`, `c_historico_proeficiencias`, `c_natureza_treinamentos`, `c_natureza_proeficiencias`, `c_engenharia_treinamentos`, `c_engenharia_proeficiencias`, `c_alquimia_treinamentos`, `c_alquimia_proeficiencias`, `c_navegacao_treinamentos`, `c_navegacao_proeficiencias`, `c_linguistico_treinamentos`, `c_linguistico_proeficiencias`, `t_esgrima_treinamentos`, `t_esgrima_proeficiencias`, `t_pontaria_treinamentos`, `t_pontaria_proeficiencias`, `t_marcial_treinamentos`, `t_marcial_proeficiencias`, `t_metalurgia_treinamentos`, `t_metalurgia_proeficiencias`, `t_artesanato_treinamentos`, `t_artesanato_proeficiencias`, `t_ladinagem_treinamentos`, `t_ladinagem_proeficiencias`, `t_instrumentos_treinamentos`, `t_instrumentos_proeficiencias`, `t_pilotagem_treinamentos`, `t_pilotagem_proeficiencias`) VALUES
(1, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(2, 2, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(4, 4, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1, 0, 1, 0, 1, 0, 1, 0, 1, 0, 1, 0, 1, 0, 1, 0, 1, 0, 1, 0, 1, 0, 1, 0, 1, 0, 1, 0, 1, 0, 1, 0, 1, 0, 1, 0, 1, 1, 1, 0, 1, 0, 1, 0, 1, 0, 1, 0, 1, 0, 1, 0, 1, 0, 1, 0),
(5, 5, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1, 0, 1, 0, 1, 0, 1, 0, 1, 0, 1, 0, 1, 0, 2, 0, 1, 0, 1, 0, 1, 0, 1, 0, 5, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 5, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(6, 6, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(7, 7, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(10, 19, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- Estrutura para tabela `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int NOT NULL,
  `username` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `senha` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `email` text COLLATE utf8mb4_general_ci NOT NULL,
  `google_id` text COLLATE utf8mb4_general_ci NOT NULL,
  `imagem` varchar(255) COLLATE utf8mb4_general_ci NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `usuarios`
--

INSERT INTO `usuarios` (`id`, `username`, `senha`, `email`, `google_id`, `imagem`) VALUES
(1, 'Kawatos', '$2y$10$QmTlNoKukKM/HJy5nlVDEuA9.4wa6FsJEZSOArvmTGrovcYQSDGca', '', '', ''),
(2, 'Mios', '$2y$10$KeSP7apvOkzaJMQZGsUg.e0zkmmItljIEmAo7KXK4BMvoY6ANKQ9W', '', '', '');

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `atributos`
--
ALTER TABLE `atributos`
  ADD PRIMARY KEY (`id_atributos`),
  ADD KEY `fk_atributos_ficha` (`id_ficha`);

--
-- Índices de tabela `campanhas`
--
ALTER TABLE `campanhas`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `codigo_convite` (`codigo_convite`);

--
-- Índices de tabela `campanha_fichas`
--
ALTER TABLE `campanha_fichas`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `campanha_id` (`campanha_id`,`ficha_id`);

--
-- Índices de tabela `campanha_usuarios`
--
ALTER TABLE `campanha_usuarios`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `usuario_id` (`usuario_id`,`campanha_id`);

--
-- Índices de tabela `convites`
--
ALTER TABLE `convites`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `fichas`
--
ALTER TABLE `fichas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `usuario_id` (`usuario_id`);

--
-- Índices de tabela `habilidades`
--
ALTER TABLE `habilidades`
  ADD PRIMARY KEY (`id_habilidade`),
  ADD KEY `fk_habilidades_ficha` (`id_ficha`);

--
-- Índices de tabela `itens`
--
ALTER TABLE `itens`
  ADD PRIMARY KEY (`id_item`),
  ADD KEY `fk_itens_ficha` (`id_ficha`);

--
-- Índices de tabela `magias`
--
ALTER TABLE `magias`
  ADD PRIMARY KEY (`id_magias`),
  ADD KEY `fk_magias_ficha` (`id_ficha`);

--
-- Índices de tabela `mensagens`
--
ALTER TABLE `mensagens`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `pericias`
--
ALTER TABLE `pericias`
  ADD PRIMARY KEY (`id_pericias`),
  ADD KEY `fk_pericias_ficha` (`id_ficha`);

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
-- AUTO_INCREMENT de tabela `atributos`
--
ALTER TABLE `atributos`
  MODIFY `id_atributos` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de tabela `campanhas`
--
ALTER TABLE `campanhas`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT de tabela `campanha_fichas`
--
ALTER TABLE `campanha_fichas`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT de tabela `campanha_usuarios`
--
ALTER TABLE `campanha_usuarios`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT de tabela `convites`
--
ALTER TABLE `convites`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `fichas`
--
ALTER TABLE `fichas`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT de tabela `habilidades`
--
ALTER TABLE `habilidades`
  MODIFY `id_habilidade` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de tabela `itens`
--
ALTER TABLE `itens`
  MODIFY `id_item` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de tabela `magias`
--
ALTER TABLE `magias`
  MODIFY `id_magias` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de tabela `mensagens`
--
ALTER TABLE `mensagens`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT de tabela `pericias`
--
ALTER TABLE `pericias`
  MODIFY `id_pericias` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de tabela `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `atributos`
--
ALTER TABLE `atributos`
  ADD CONSTRAINT `fk_atributos_ficha` FOREIGN KEY (`id_ficha`) REFERENCES `fichas` (`id`) ON DELETE CASCADE;

--
-- Restrições para tabelas `fichas`
--
ALTER TABLE `fichas`
  ADD CONSTRAINT `fichas_ibfk_1` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`),
  ADD CONSTRAINT `fk_fichas_usuario` FOREIGN KEY (`usuario_id`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE;

--
-- Restrições para tabelas `habilidades`
--
ALTER TABLE `habilidades`
  ADD CONSTRAINT `fk_habilidades_ficha` FOREIGN KEY (`id_ficha`) REFERENCES `fichas` (`id`) ON DELETE CASCADE;

--
-- Restrições para tabelas `itens`
--
ALTER TABLE `itens`
  ADD CONSTRAINT `fk_itens_ficha` FOREIGN KEY (`id_ficha`) REFERENCES `fichas` (`id`) ON DELETE CASCADE;

--
-- Restrições para tabelas `magias`
--
ALTER TABLE `magias`
  ADD CONSTRAINT `fk_magias_ficha` FOREIGN KEY (`id_ficha`) REFERENCES `fichas` (`id`) ON DELETE CASCADE;

--
-- Restrições para tabelas `pericias`
--
ALTER TABLE `pericias`
  ADD CONSTRAINT `fk_pericias_ficha` FOREIGN KEY (`id_ficha`) REFERENCES `fichas` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
