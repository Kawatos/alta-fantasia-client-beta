-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 17/06/2025 às 04:10
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
  `vigor_mod` int(11) DEFAULT NULL,
  `forca_mod` int(11) DEFAULT NULL,
  `destreza_mod` int(11) DEFAULT NULL,
  `espirito_mod` int(11) DEFAULT NULL,
  `carisma_mod` int(11) DEFAULT NULL,
  `intelecto_mod` int(11) DEFAULT NULL,
  `id_ficha` int(11) DEFAULT NULL,
  `vigor_mod_nv` int(11) DEFAULT NULL,
  `forca_mod_nv` int(11) DEFAULT NULL,
  `destreza_mod_nv` int(11) DEFAULT NULL,
  `espirito_mod_nv` int(11) DEFAULT NULL,
  `carisma_mod_nv` int(11) DEFAULT NULL,
  `intelecto_mod_nv` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `atributos`
--

INSERT INTO `atributos` (`id_atributos`, `vigor_mod`, `forca_mod`, `destreza_mod`, `espirito_mod`, `carisma_mod`, `intelecto_mod`, `id_ficha`, `vigor_mod_nv`, `forca_mod_nv`, `destreza_mod_nv`, `espirito_mod_nv`, `carisma_mod_nv`, `intelecto_mod_nv`) VALUES
(1, 1, 1, 1, 1, 1, 1, 33, NULL, NULL, 0, NULL, NULL, NULL),
(2, 0, 0, 0, 0, 0, 0, 36, 0, 0, 0, 0, 0, 0),
(3, 1, 1, 1, 0, 0, 0, 37, 1, 1, 1, 0, 0, 0),
(4, 1, 1, 1, 0, 0, 0, 38, 1, 1, 1, 0, 0, 0),
(5, 0, 0, 0, 0, 0, 0, 39, 0, 0, 0, 0, 0, 0),
(6, 0, 0, 0, 0, 0, 0, 40, 0, 0, 0, 0, 0, 0),
(7, 1, 2, 2, 3, 2, 2, 41, 1, 2, 2, 2, 2, 2),
(8, 0, 0, 0, 0, 0, 0, 42, 0, 0, 0, 0, 0, 0),
(9, 0, 0, 0, 0, 0, 0, 43, 0, 0, 0, 0, 0, 0),
(10, 0, 1, 0, 0, 0, 0, 44, 0, 0, 0, 0, 0, 0),
(11, 0, 0, 0, 0, 0, 0, 45, 0, 0, 0, 0, 0, 0),
(12, 0, 0, 0, 0, 0, 0, 46, 0, 0, 0, 0, 0, 0),
(13, 0, 0, 0, 0, 0, 0, 47, 0, 0, 0, 0, 0, 0),
(14, 0, 0, 0, 0, 0, 0, 48, 0, 0, 0, 0, 0, 0),
(15, NULL, NULL, NULL, NULL, NULL, NULL, 49, NULL, NULL, NULL, NULL, NULL, NULL),
(16, 0, 0, 0, 0, 0, 0, 50, 0, 0, 0, 0, 0, 0),
(17, 0, 0, 0, 0, 0, 0, 51, 0, 0, 0, 0, 0, 0),
(18, NULL, NULL, NULL, NULL, NULL, NULL, 52, NULL, NULL, NULL, NULL, NULL, NULL),
(19, 0, 0, 0, 0, 0, 0, 53, 0, 0, 0, 0, 0, 0);

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
  `pontos_de_vida` int(255) DEFAULT NULL,
  `pontos_de_mana` int(255) DEFAULT NULL,
  `status_personagem` varchar(255) DEFAULT NULL,
  `pvs_atuais` int(255) DEFAULT NULL,
  `pms_atuais` int(255) DEFAULT NULL,
  `deslocamento` int(11) DEFAULT NULL,
  `regen_pv` varchar(255) DEFAULT NULL,
  `regen_pm` varchar(255) DEFAULT NULL,
  `observacoes_atributos` text DEFAULT NULL,
  `observacoes_pericias` text DEFAULT NULL,
  `observacoes_habilidades` text DEFAULT NULL,
  `observacoes_magias_arcanas` text DEFAULT NULL,
  `observacoes_magias_divinas` text DEFAULT NULL,
  `observacoes_itens` text DEFAULT NULL,
  `observacoes_jogador` text DEFAULT NULL,
  `divindade` varchar(255) DEFAULT NULL,
  `escola_arcana` varchar(255) DEFAULT NULL,
  `idiomas` text DEFAULT NULL,
  `carga_suportada_mod` int(11) DEFAULT NULL,
  `inventario_interno_mod` int(11) DEFAULT NULL,
  `personagem_imagem` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `fichas`
--

INSERT INTO `fichas` (`id`, `usuario_id`, `nome_personagem`, `classe`, `nivel`, `descricao`, `raca`, `pontos_de_vida`, `pontos_de_mana`, `status_personagem`, `pvs_atuais`, `pms_atuais`, `deslocamento`, `regen_pv`, `regen_pm`, `observacoes_atributos`, `observacoes_pericias`, `observacoes_habilidades`, `observacoes_magias_arcanas`, `observacoes_magias_divinas`, `observacoes_itens`, `observacoes_jogador`, `divindade`, `escola_arcana`, `idiomas`, `carga_suportada_mod`, `inventario_interno_mod`, `personagem_imagem`) VALUES
(1, 6, 'asdss', 'asdsss', 1, '', NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(2, 6, 'Jooj e viadinho', 'Jooj e viadinho', 1, '', NULL, NULL, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(41, 1, 'Phinneas Van Schatten', 'Mago', 3060, '', '', 500, 50, 'Vivo', 240, 29, 10, '0', '1/turno', '', '12', '32', '', 'adasd', 'asdasd', 'dasdada', '', '', 'Altario', 23, 0, 'uploads/img_684eec73abf15.png'),
(43, 1, 'Pvzudo', 'Clérigo', 0, '', 'Lichiru', 500, 0, 'Vivo', 500, 0, 0, '', '0', '', '', '', '', '', '', '', '', '', '', 0, 0, 'uploads/img_684ef2facf0af.png'),
(44, 1, 'sla', 'Guerreiro', 0, '', 'Elfo Negro', 0, 0, 'Vivo', 0, 0, 0, '', '0', '', '', '', '', '', '', '', '', '', '', 0, 0, NULL),
(51, 1, 'Teste', '', 100, '', '', 100, 0, 'Vivo', 100, 0, 0, '', '', '', '', '', '', '', '', '', '', '', '', 0, 0, NULL);

-- --------------------------------------------------------

--
-- Estrutura para tabela `habilidades`
--

CREATE TABLE `habilidades` (
  `id_habilidade` int(11) NOT NULL,
  `id_ficha` int(11) NOT NULL,
  `nome` varchar(255) NOT NULL,
  `requisitos` text NOT NULL,
  `descricao` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `habilidades`
--

INSERT INTO `habilidades` (`id_habilidade`, `id_ficha`, `nome`, `requisitos`, `descricao`) VALUES
(1, 41, 'Teste 122', '2', '3'),
(2, 41, 'Teste 2', 'Ter teste 1', 'Todos os testes dão certo, não importa o que.'),
(3, 41, 'QWE', 'QWE', 'QWE233423'),
(5, 41, 'RTest321', '123', '123'),
(6, 41, '1212', '1212', '2112'),
(7, 41, 'Duro de Matar', 'lskjhdfgsdfhjklbsdfhjb', 'dasad');

-- --------------------------------------------------------

--
-- Estrutura para tabela `itens`
--

CREATE TABLE `itens` (
  `id_item` int(11) NOT NULL,
  `id_ficha` int(11) NOT NULL,
  `nome` varchar(255) NOT NULL,
  `rank` int(11) NOT NULL,
  `descricao` text NOT NULL,
  `peso` int(11) NOT NULL,
  `volume` varchar(255) NOT NULL,
  `equipado` varchar(255) DEFAULT NULL,
  `inventario_interno` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `itens`
--

INSERT INTO `itens` (`id_item`, `id_ficha`, `nome`, `rank`, `descricao`, `peso`, `volume`, `equipado`, `inventario_interno`) VALUES
(2, 41, 'vassoura3', 1, '123', 23, 'asdew', 'sim', 'nao'),
(3, 41, 'Varinha Mágica sdsds', 2, '2', 2, 'Médio', 'sim', 'sim'),
(6, 41, 'Varinha Mágica 3', 2, '2', 2, '1', 'sim', 'nao'),
(7, 41, 'Varinha Mágica 34', 1, '1', 1, '1', 'sim', 'nao');

-- --------------------------------------------------------

--
-- Estrutura para tabela `magias`
--

CREATE TABLE `magias` (
  `id_magias` int(11) NOT NULL,
  `nome_magia` varchar(255) DEFAULT NULL,
  `tipo_magia` varchar(255) DEFAULT NULL,
  `nivel` int(11) DEFAULT NULL,
  `custo_pm` varchar(255) DEFAULT NULL,
  `alcance` varchar(255) DEFAULT NULL,
  `duracao` varchar(255) DEFAULT NULL,
  `descritor` varchar(255) DEFAULT NULL,
  `descricao` text DEFAULT NULL,
  `ficha_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `magias`
--

INSERT INTO `magias` (`id_magias`, `nome_magia`, `tipo_magia`, `nivel`, `custo_pm`, `alcance`, `duracao`, `descritor`, `descricao`, `ficha_id`) VALUES
(2, 'violencia 3', 'divina', 13, '13', '13', '13', '13', '13', 41),
(3, 'Bola de Vento ', 'divina', 3, '1', '1', '1', '1', '1', 41),
(4, 'Teste 2222', 'arcana', 1, '1', '2', '1', '1', '1', 41),
(5, '12q12', 'arcana', 1, '1', '1', '1', '1', '1', 41),
(11, 'Teste 212121', 'arcana', 123, '123', '123', '123', '123', '123', 41);

-- --------------------------------------------------------

--
-- Estrutura para tabela `pericias`
--

CREATE TABLE `pericias` (
  `id_pericias` int(11) NOT NULL,
  `id_ficha` int(11) DEFAULT NULL,
  `tenacidade_mod` int(11) DEFAULT NULL,
  `fortitude_mod` int(11) DEFAULT NULL,
  `reflexo_mod` int(11) DEFAULT NULL,
  `controle_mod` int(11) DEFAULT NULL,
  `atletismo_mod` int(11) DEFAULT NULL,
  `corpoacorpo_mod` int(11) DEFAULT NULL,
  `autocontrole_mod` int(11) DEFAULT NULL,
  `resiliencia_mod` int(11) DEFAULT NULL,
  `intuicao_mod` int(11) DEFAULT NULL,
  `percepcao_mod` int(11) DEFAULT NULL,
  `influencia_mod` int(11) DEFAULT NULL,
  `atuacao_mod` int(11) DEFAULT NULL,
  `c_arcano_mod` int(11) DEFAULT NULL,
  `c_religioso_mod` int(11) DEFAULT NULL,
  `c_historico_mod` int(11) DEFAULT NULL,
  `c_natureza_mod` int(11) DEFAULT NULL,
  `c_engenharia_mod` int(11) DEFAULT NULL,
  `c_alquimia_mod` int(11) DEFAULT NULL,
  `c_navegacao_mod` int(11) DEFAULT NULL,
  `c_linguistico_mod` int(11) DEFAULT NULL,
  `t_esgrima_mod` int(11) DEFAULT NULL,
  `t_pontaria_mod` int(11) DEFAULT NULL,
  `t_marcial_mod` int(11) DEFAULT NULL,
  `t_metalurgia_mod` int(11) DEFAULT NULL,
  `t_artesanato_mod` int(11) DEFAULT NULL,
  `t_ladinagem_mod` int(11) DEFAULT NULL,
  `t_instrumentos_mod` int(11) DEFAULT NULL,
  `t_pilotagem_mod` int(11) DEFAULT NULL,
  `tenacidade_treinamentos` int(11) DEFAULT NULL,
  `tenacidade_proeficiencias` int(11) DEFAULT NULL,
  `fortitude_treinamentos` int(11) DEFAULT NULL,
  `fortitude_proeficiencias` int(11) DEFAULT NULL,
  `reflexo_treinamentos` int(11) DEFAULT NULL,
  `reflexo_proeficiencias` int(11) DEFAULT NULL,
  `controle_treinamentos` int(11) DEFAULT NULL,
  `controle_proeficiencias` int(11) DEFAULT NULL,
  `atletismo_treinamentos` int(11) DEFAULT NULL,
  `atletismo_proeficiencias` int(11) DEFAULT NULL,
  `corpoacorpo_treinamentos` int(11) DEFAULT NULL,
  `corpoacorpo_proeficiencias` int(11) DEFAULT NULL,
  `autocontrole_treinamentos` int(11) DEFAULT NULL,
  `autocontrole_proeficiencias` int(11) DEFAULT NULL,
  `resiliencia_treinamentos` int(11) DEFAULT NULL,
  `resiliencia_proeficiencias` int(11) DEFAULT NULL,
  `intuicao_treinamentos` int(11) DEFAULT NULL,
  `intuicao_proeficiencias` int(11) DEFAULT NULL,
  `percepcao_treinamentos` int(11) DEFAULT NULL,
  `percepcao_proeficiencias` int(11) DEFAULT NULL,
  `influencia_treinamentos` int(11) DEFAULT NULL,
  `influencia_proeficiencias` int(11) DEFAULT NULL,
  `atuacao_treinamentos` int(11) DEFAULT NULL,
  `atuacao_proeficiencias` int(11) DEFAULT NULL,
  `c_arcano_treinamentos` int(11) DEFAULT NULL,
  `c_arcano_proeficiencias` int(11) DEFAULT NULL,
  `c_religioso_treinamentos` int(11) DEFAULT NULL,
  `c_religioso_proeficiencias` int(11) DEFAULT NULL,
  `c_historico_treinamentos` int(11) DEFAULT NULL,
  `c_historico_proeficiencias` int(11) DEFAULT NULL,
  `c_natureza_treinamentos` int(11) DEFAULT NULL,
  `c_natureza_proeficiencias` int(11) DEFAULT NULL,
  `c_engenharia_treinamentos` int(11) DEFAULT NULL,
  `c_engenharia_proeficiencias` int(11) DEFAULT NULL,
  `c_alquimia_treinamentos` int(11) DEFAULT NULL,
  `c_alquimia_proeficiencias` int(11) DEFAULT NULL,
  `c_navegacao_treinamentos` int(11) DEFAULT NULL,
  `c_navegacao_proeficiencias` int(11) DEFAULT NULL,
  `c_linguistico_treinamentos` int(11) DEFAULT NULL,
  `c_linguistico_proeficiencias` int(11) DEFAULT NULL,
  `t_esgrima_treinamentos` int(11) DEFAULT NULL,
  `t_esgrima_proeficiencias` int(11) DEFAULT NULL,
  `t_pontaria_treinamentos` int(11) DEFAULT NULL,
  `t_pontaria_proeficiencias` int(11) DEFAULT NULL,
  `t_marcial_treinamentos` int(11) DEFAULT NULL,
  `t_marcial_proeficiencias` int(11) DEFAULT NULL,
  `t_metalurgia_treinamentos` int(11) DEFAULT NULL,
  `t_metalurgia_proeficiencias` int(11) DEFAULT NULL,
  `t_artesanato_treinamentos` int(11) DEFAULT NULL,
  `t_artesanato_proeficiencias` int(11) DEFAULT NULL,
  `t_ladinagem_treinamentos` int(11) DEFAULT NULL,
  `t_ladinagem_proeficiencias` int(11) DEFAULT NULL,
  `t_instrumentos_treinamentos` int(11) DEFAULT NULL,
  `t_instrumentos_proeficiencias` int(11) DEFAULT NULL,
  `t_pilotagem_treinamentos` int(11) DEFAULT NULL,
  `t_pilotagem_proeficiencias` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `pericias`
--

INSERT INTO `pericias` (`id_pericias`, `id_ficha`, `tenacidade_mod`, `fortitude_mod`, `reflexo_mod`, `controle_mod`, `atletismo_mod`, `corpoacorpo_mod`, `autocontrole_mod`, `resiliencia_mod`, `intuicao_mod`, `percepcao_mod`, `influencia_mod`, `atuacao_mod`, `c_arcano_mod`, `c_religioso_mod`, `c_historico_mod`, `c_natureza_mod`, `c_engenharia_mod`, `c_alquimia_mod`, `c_navegacao_mod`, `c_linguistico_mod`, `t_esgrima_mod`, `t_pontaria_mod`, `t_marcial_mod`, `t_metalurgia_mod`, `t_artesanato_mod`, `t_ladinagem_mod`, `t_instrumentos_mod`, `t_pilotagem_mod`, `tenacidade_treinamentos`, `tenacidade_proeficiencias`, `fortitude_treinamentos`, `fortitude_proeficiencias`, `reflexo_treinamentos`, `reflexo_proeficiencias`, `controle_treinamentos`, `controle_proeficiencias`, `atletismo_treinamentos`, `atletismo_proeficiencias`, `corpoacorpo_treinamentos`, `corpoacorpo_proeficiencias`, `autocontrole_treinamentos`, `autocontrole_proeficiencias`, `resiliencia_treinamentos`, `resiliencia_proeficiencias`, `intuicao_treinamentos`, `intuicao_proeficiencias`, `percepcao_treinamentos`, `percepcao_proeficiencias`, `influencia_treinamentos`, `influencia_proeficiencias`, `atuacao_treinamentos`, `atuacao_proeficiencias`, `c_arcano_treinamentos`, `c_arcano_proeficiencias`, `c_religioso_treinamentos`, `c_religioso_proeficiencias`, `c_historico_treinamentos`, `c_historico_proeficiencias`, `c_natureza_treinamentos`, `c_natureza_proeficiencias`, `c_engenharia_treinamentos`, `c_engenharia_proeficiencias`, `c_alquimia_treinamentos`, `c_alquimia_proeficiencias`, `c_navegacao_treinamentos`, `c_navegacao_proeficiencias`, `c_linguistico_treinamentos`, `c_linguistico_proeficiencias`, `t_esgrima_treinamentos`, `t_esgrima_proeficiencias`, `t_pontaria_treinamentos`, `t_pontaria_proeficiencias`, `t_marcial_treinamentos`, `t_marcial_proeficiencias`, `t_metalurgia_treinamentos`, `t_metalurgia_proeficiencias`, `t_artesanato_treinamentos`, `t_artesanato_proeficiencias`, `t_ladinagem_treinamentos`, `t_ladinagem_proeficiencias`, `t_instrumentos_treinamentos`, `t_instrumentos_proeficiencias`, `t_pilotagem_treinamentos`, `t_pilotagem_proeficiencias`) VALUES
(1, 41, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 0, 1, 1, 2, 1, 2, 1, 2, 1, 2, 1, 2, 1, 2, 1, 2, 1, 2, 1, 2, 1, 2, 1, 2, 1, 2, 1, 2, 1, 2, 1, 2, 1, 2, 1, 2, 1, 2, 1, 2, 1, 2, 1, 2, 1, 2, 1, 2, 1, 2, 1, 2, 1, 2, 1, 2),
(2, 42, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(3, 43, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(4, 44, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(5, 45, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(6, 46, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(7, 47, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(8, 48, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(9, 49, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(10, 50, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(11, 51, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(12, 52, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(13, 53, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);

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
(1, 'Kawatos', '$2y$10$NdTypdfT8cx.OGuHWfSgHeXeLGqj99o1cB0aCUGZU0ksduudycxoC'),
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
-- Índices de tabela `habilidades`
--
ALTER TABLE `habilidades`
  ADD PRIMARY KEY (`id_habilidade`);

--
-- Índices de tabela `itens`
--
ALTER TABLE `itens`
  ADD PRIMARY KEY (`id_item`);

--
-- Índices de tabela `magias`
--
ALTER TABLE `magias`
  ADD PRIMARY KEY (`id_magias`);

--
-- Índices de tabela `pericias`
--
ALTER TABLE `pericias`
  ADD PRIMARY KEY (`id_pericias`);

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
  MODIFY `id_atributos` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT de tabela `fichas`
--
ALTER TABLE `fichas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- AUTO_INCREMENT de tabela `habilidades`
--
ALTER TABLE `habilidades`
  MODIFY `id_habilidade` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de tabela `itens`
--
ALTER TABLE `itens`
  MODIFY `id_item` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de tabela `magias`
--
ALTER TABLE `magias`
  MODIFY `id_magias` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de tabela `pericias`
--
ALTER TABLE `pericias`
  MODIFY `id_pericias` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

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
