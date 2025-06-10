-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 10/06/2025 às 02:37
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
(1, 41, 12, 2, 12, 12, 12, 12, 12, 12, 12, 12, 12, 12, 12, 12, 12, 12, 12, 12, 12, 12, 12, 12, 12, 12, 12, 12, 12, 12, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(2, 42, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(3, 43, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(4, 44, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(5, 45, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(6, 46, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `pericias`
--
ALTER TABLE `pericias`
  ADD PRIMARY KEY (`id_pericias`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `pericias`
--
ALTER TABLE `pericias`
  MODIFY `id_pericias` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
