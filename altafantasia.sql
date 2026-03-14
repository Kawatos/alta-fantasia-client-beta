-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Tempo de geração: 14/03/2026 às 15:21
-- Versão do servidor: 11.8.3-MariaDB-log
-- Versão do PHP: 7.2.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `u384529855_alta_fantasia`
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

-- --------------------------------------------------------

--
-- Estrutura para tabela `fichas`
--

CREATE TABLE `fichas` (
  `id` int(11) NOT NULL,
  `usuario_id` int(11) NOT NULL,
  `nome_personagem` varchar(100) DEFAULT NULL,
  `classe` text DEFAULT NULL,
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
  `personagem_imagem` varchar(255) DEFAULT NULL,
  `altura` varchar(255) DEFAULT NULL,
  `idade` varchar(255) DEFAULT NULL,
  `sexo` varchar(255) DEFAULT NULL,
  `tendencia` varchar(255) DEFAULT NULL,
  `nome_jogador` varchar(255) NOT NULL,
  `profissao_jogador` varchar(255) NOT NULL,
  `descricao_jogador` text NOT NULL,
  `transformacoes_jogador` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
  `peso` float DEFAULT NULL,
  `volume` varchar(255) NOT NULL,
  `equipado` varchar(255) DEFAULT NULL,
  `inventario_interno` varchar(255) DEFAULT NULL,
  `quantidade` int(11) DEFAULT NULL,
  `estado` varchar(255) NOT NULL,
  `conjunto` varchar(255) NOT NULL,
  `ignorar_peso` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
  `id_ficha` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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

-- --------------------------------------------------------

--
-- Estrutura para tabela `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `senha` varchar(255) NOT NULL,
  `email` text NOT NULL DEFAULT '',
  `google_id` text NOT NULL DEFAULT '',
  `imagem` varchar(255) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
  MODIFY `id_atributos` int(255) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `fichas`
--
ALTER TABLE `fichas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `habilidades`
--
ALTER TABLE `habilidades`
  MODIFY `id_habilidade` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `itens`
--
ALTER TABLE `itens`
  MODIFY `id_item` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `magias`
--
ALTER TABLE `magias`
  MODIFY `id_magias` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `pericias`
--
ALTER TABLE `pericias`
  MODIFY `id_pericias` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

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
