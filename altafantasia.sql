-- phpMyAdmin SQL Dump
-- version 5.2.3
-- https://www.phpmyadmin.net/
--
-- Host: db
-- Tempo de geração: 08/06/2026 às 23:42
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
  `arquivo_pdf` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `classes` varchar(255) COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
  MODIFY `id_atributos` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `campanhas`
--
ALTER TABLE `campanhas`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `campanha_fichas`
--
ALTER TABLE `campanha_fichas`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `campanha_usuarios`
--
ALTER TABLE `campanha_usuarios`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `convites`
--
ALTER TABLE `convites`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `fichas`
--
ALTER TABLE `fichas`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `habilidades`
--
ALTER TABLE `habilidades`
  MODIFY `id_habilidade` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `itens`
--
ALTER TABLE `itens`
  MODIFY `id_item` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `magias`
--
ALTER TABLE `magias`
  MODIFY `id_magias` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `mensagens`
--
ALTER TABLE `mensagens`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `pericias`
--
ALTER TABLE `pericias`
  MODIFY `id_pericias` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

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
