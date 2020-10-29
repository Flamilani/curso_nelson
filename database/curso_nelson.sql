-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Tempo de geração: 29-Out-2020 às 13:12
-- Versão do servidor: 8.0.18
-- versão do PHP: 7.3.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `curso_nelson`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `alunos`
--

CREATE TABLE `alunos` (
  `id` int(11) NOT NULL,
  `nome` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `senha` varchar(32) NOT NULL,
  `senha_md5` varchar(32) NOT NULL,
  `status` int(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `alunos`
--

INSERT INTO `alunos` (`id`, `nome`, `email`, `senha`, `senha_md5`, `status`) VALUES
(1, 'NELSON PIMENTA DE CASTRO', 'npcastro6@gmail.com', 'snJ6m0Luv8', 'e4731570a9f5d6fb483788f3b2537213', 1),
(30, 'ANA ELILIA TRIGUEIRO BARROS CAVALCANTI', 'liahidro@gmail.com', 'En3YlgNn83', 'd6b997cf5f1f715fbcaf1e88a9681dce', 1),
(32, 'BENEDITO DE JESUS DE MEDEIROS DA SILVA', 'sibemolcomnonamenor@gmail.com', 'KmwPsTIbXe', 'aca3ec309ec19099c121a13693307c82', 1),
(33, 'DANIELA DE CARVALHO CRUZ', 'dankestrelaelibras@gmail.com', 'fFKfQkOyFY', 'c3bd6c33b0bd8778c28fa924546dd86f', 1),
(34, 'DÉBORA DE OLIVEIRA NOLASCO', 'denola697@gmail.com', 'w0BG1Huk60', '8e7e2d3bfcdece8334f129241f8195d9', 1),
(35, 'FRANCISCA VANETE RODRIGUES DE OLIVEIRA ', 'vanete1980@gmail.com', 'fvpHTMATei', '0ad932df56ddc8e59ac77c2d29989150', 1),
(36, 'GEÓRGIA MARIA DE ALENCAR MAIA', 'georgiaalencar32@gmail.com', 'K2Fb1jzi6O', '29fd01aad64ce9174f62c07a0033d435', 1),
(37, 'HANNAH ARAÚJO ROSENDO ', 'hannah.rosendo@gmail.com', '3MAy6oCDdM', '845173892d0dd0123c6ba0d90400b82e', 1),
(38, 'HAVILA SAMUA OLIVEIRA SANTOS', 'havilasamuaitz@gmail.com', 'XmhPWe0cWf', '1d456750621a11b4dd6d26bc6e78f8cc', 1),
(39, 'HEGON HENRIQUE CARDOSO FAVACHO', 'hegon20@gmail.com', '80mPHRrU63', 'bbd8e03bf2716ef887de1cddda0b37c1', 1),
(40, 'INDIRA SIMIONATTO STEDILE ASSIS MOURA', 'indirastedile@gmail.com', '5Odp4VSr1n', '2a52d450be005fde5a4e4fe14fc663e9', 1),
(41, 'JESSICA PEREIRA OLIVEIRA ', 'disciplinalibras62@gmail.com', 'RuOk2CA4BZ', 'd937e9794aad36fcb8e5def94e5801bf', 1),
(42, 'JOSÉ ALEX DE SOUZA', 'alexsurdo333@gmail.com', '0VRZujNXly', 'd32e6056e44f74842b7c2839887a40c6', 1),
(44, 'JOSÉ SINESIO TORRES GONCALVES FILHO', 'sinesiofilho12@gmail.com', 'FQtdqb7GJk', '166755795f1d7feaa68f0847e1479aa6', 1),
(45, 'JULIANA RODRIGUES AMARAL SOUZA', 'juliana.souza@ifsudestemg.edu.br', 'F8WNWGqdSd', 'e64641811c2d90af6205256cbea56e74', 1),
(46, 'JULYANE BRUNNA FERREIRA MACIEL ', 'julyane.maciel2@gmail.com', 'TSXgmJXhBR', '7e4cae03f987126c7f6b058a47492ce0', 1),
(47, 'LUCIVAL FÁBIO RODRIGUES DA SILVA', 'lucivalrodrigues.e275@gmail.com', 'iog4GH8CTt', 'a887c3768e11c0624c8b2314cdd03aa7', 1),
(48, 'MARIA NAVEGANTINA DE SOUZA', 'navegavanderrr@gmail.com', 'pbXYSwMHir', '67e58886a0674c8151439c647de64329', 1),
(49, 'MICHEL FREIRE MARQUES ', 'prof.michelmarques@gmail.com', 'BXAObabUbv', '2e28258b01a8bd379795f3faf78d8347', 1),
(50, 'SÉDINA DOS SANTOS JALES FERREIRA ', 'sedina.jales@hotmail.com', 'B51LdTIoZz', '3988384e377ecf0b5c8e4dc3dacebf19', 1),
(51, 'SIMONE PATRÍCIA SOUZA DE SOARES ', 'profasimonenatal@gmail.com', '6SPN8Yw0Sn', '31741fbc79bd5bb014bc5a8c64bb5153', 1),
(52, 'VAGNER ALVARES CAMPOS ', 'vagnercam@gmail.com', 'yeRRARhbqe', '6ae0ec25f591e32777728c9a9cf94f0e', 1),
(53, 'DARLENE SEABRA DE LIRA', 'dsl.ufopa@gmail.com', 'kfWuInxpDs', '0d0b9b47b0f21912ac1f77746759a261', 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `aluno_curso`
--

CREATE TABLE `aluno_curso` (
  `id` int(11) NOT NULL,
  `id_curso` int(11) NOT NULL,
  `id_aluno` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `aluno_curso`
--

INSERT INTO `aluno_curso` (`id`, `id_curso`, `id_aluno`) VALUES
(6, 1, 8),
(7, 1, 30),
(8, 1, 32),
(9, 1, 33),
(10, 1, 53),
(11, 1, 34),
(12, 1, 35),
(13, 1, 36),
(14, 1, 37),
(15, 1, 38),
(16, 1, 39),
(17, 1, 40),
(18, 1, 41),
(19, 1, 42),
(20, 1, 44),
(21, 1, 45),
(22, 1, 46),
(23, 1, 47),
(24, 1, 48),
(25, 1, 49),
(26, 1, 50),
(27, 1, 1),
(28, 1, 51),
(29, 1, 52);

-- --------------------------------------------------------

--
-- Estrutura da tabela `atividade_aluno`
--

CREATE TABLE `atividade_aluno` (
  `id` int(11) NOT NULL,
  `id_aluno` int(11) DEFAULT NULL,
  `id_aula` int(11) DEFAULT NULL,
  `url_video_aluno` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `avaliacao` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `observacao` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `url_video_observacao` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `aulas`
--

CREATE TABLE `aulas` (
  `id` int(11) UNSIGNED NOT NULL,
  `id_modulo` int(11) NOT NULL,
  `id_curso` int(11) NOT NULL,
  `nome` varchar(255) DEFAULT NULL,
  `ordem` int(11) NOT NULL,
  `tipo` varchar(20) NOT NULL DEFAULT '',
  `imagem` text,
  `arquivo` text,
  `url_video` text,
  `midia` varchar(45) DEFAULT NULL,
  `atividade` tinyint(2) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `aulas`
--

INSERT INTO `aulas` (`id`, `id_modulo`, `id_curso`, `nome`, `ordem`, `tipo`, `imagem`, `arquivo`, `url_video`, `midia`, `atividade`) VALUES
(1, 1, 1, '<p><strong>Plano A</strong> - O Cine-visual e as t&eacute;cnicas visuais de linguagem</p>', 1, '', 'dc033a86623b5b13af897c80856e0cb5.jpg', NULL, NULL, 'imagem', 0),
(2, 1, 1, '<p><strong>Parte B</strong> - Planos cinematogr&aacute;ficos:</p>', 2, '', NULL, NULL, NULL, NULL, 0),
(3, 1, 1, '<p>- Plano Geral</p>', 3, '', NULL, NULL, NULL, NULL, 0),
(4, 1, 1, '<p>- Plano Americano</p>', 4, '', NULL, NULL, NULL, NULL, 0),
(5, 1, 1, '<p>- Plano Pr&oacute;ximo</p>', 5, '', NULL, NULL, NULL, NULL, 0),
(6, 1, 1, '<p>- Plano Close Up</p>', 6, '', NULL, NULL, NULL, NULL, 0),
(7, 1, 1, '<p><strong>Parte C:</strong> Antropomorfismo (Suton-Spence, 2011)</p>', 7, '', NULL, NULL, NULL, '', 0),
(8, 2, 1, '<p><strong>Parte A </strong>- Movimento de c&acirc;mera:</p>', 1, '', NULL, NULL, NULL, NULL, 0),
(9, 2, 1, '<p>- Panning</p>', 2, '', NULL, NULL, NULL, NULL, 0),
(10, 2, 1, '<p>- Tilting</p>', 3, '', NULL, NULL, NULL, NULL, 0),
(11, 2, 1, '<p>- Raccord</p>', 4, '', NULL, NULL, NULL, NULL, 0),
(12, 2, 1, '<p>- Zoom in</p>', 5, '', NULL, NULL, NULL, NULL, 0),
(13, 2, 1, '<p>- Zoom out</p>', 6, '', NULL, NULL, NULL, NULL, 0),
(14, 2, 1, '<p><strong>Parte B</strong> - Efeitos:</p>', 7, '', NULL, NULL, NULL, NULL, 0),
(15, 2, 1, '<p>- C&acirc;mera r&aacute;pida</p>', 8, '', NULL, NULL, NULL, NULL, 0),
(16, 2, 1, '<p>- C&acirc;mera lenta</p>', 9, '', NULL, NULL, NULL, NULL, 0),
(17, 2, 1, '<p>- Piscando</p>', 10, '', NULL, NULL, NULL, NULL, 0),
(18, 2, 1, '<p>- Mophing</p>', 11, '', NULL, NULL, NULL, NULL, 0),
(19, 2, 1, '<p>- Fade out</p>', 12, '', NULL, NULL, NULL, NULL, 0),
(20, 2, 1, '<p>- Fade in</p>', 13, '', NULL, NULL, NULL, NULL, 0),
(21, 2, 1, '<p><strong>Parte C</strong> - Edi&ccedil;&atilde;o:</p>', 14, '', NULL, NULL, NULL, '', 0),
(22, 2, 1, '<p>- Paralela</p>', 15, '', NULL, NULL, NULL, NULL, 0),
(23, 2, 1, '<p>- Dial&oacute;gica</p>', 16, '', NULL, NULL, NULL, NULL, 0),
(24, 2, 1, '<p>- Cut away</p>', 17, '', NULL, NULL, NULL, NULL, 0),
(25, 3, 1, '<p><strong>Parte A </strong>- Classificadores:</p>', 1, '', NULL, NULL, NULL, NULL, 0),
(26, 3, 1, '<p>- Descritivo (CL-D)</p>', 2, '', NULL, NULL, NULL, NULL, 0),
(27, 3, 1, '<p>- Especificado (CL-ESP)</p>', 3, '', NULL, NULL, NULL, NULL, 0),
(28, 3, 1, '<p>- Plural (CL-P)</p>', 4, '', NULL, NULL, NULL, NULL, 0),
(29, 3, 1, '<p>- Instrumental (CL-I)</p>', 5, '', NULL, NULL, NULL, NULL, 0),
(30, 3, 1, '<p>- Corpo (CL-C)</p>', 6, '', NULL, NULL, NULL, NULL, 0);

-- --------------------------------------------------------

--
-- Estrutura da tabela `cursos`
--

CREATE TABLE `cursos` (
  `id` int(11) NOT NULL,
  `nome` varchar(50) NOT NULL,
  `descricao` text NOT NULL,
  `url` text,
  `imagem` text NOT NULL,
  `status` int(1) DEFAULT NULL,
  `duracao` int(10) DEFAULT NULL,
  `view` decimal(10,0) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `cursos`
--

INSERT INTO `cursos` (`id`, `nome`, `descricao`, `url`, `imagem`, `status`, `duracao`, `view`) VALUES
(1, 'Cine-Visual', '', 'https://www.youtube.com/embed/32Dq2x3yaq4', '', 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Estrutura da tabela `curso_videos`
--

CREATE TABLE `curso_videos` (
  `id` int(11) UNSIGNED NOT NULL,
  `id_aula` int(11) NOT NULL,
  `nome` varchar(150) NOT NULL DEFAULT '',
  `descricao` text,
  `url` varchar(50) DEFAULT NULL,
  `duracao` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `curso_videos`
--

INSERT INTO `curso_videos` (`id`, `id_aula`, `nome`, `descricao`, `url`, `duracao`) VALUES
(1, 1, 'Panorama geral do Cine-visual', '', 'https://www.youtube.com/embed/32Dq2x3yaq4', ''),
(3, 4, 'Tema 1', NULL, NULL, NULL),
(4, 5, 'Tema 2', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Estrutura da tabela `duvidas`
--

CREATE TABLE `duvidas` (
  `id` int(11) UNSIGNED NOT NULL,
  `data_duvida` datetime NOT NULL,
  `respondida` tinyint(1) NOT NULL,
  `duvida` text,
  `id_aluno` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `duvidas`
--

INSERT INTO `duvidas` (`id`, `data_duvida`, `respondida`, `duvida`, `id_aluno`) VALUES
(1, '2016-08-12 05:45:23', 0, 'Duvida de teste...', 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `historico`
--

CREATE TABLE `historico` (
  `id` int(11) UNSIGNED NOT NULL,
  `data_viewed` datetime DEFAULT NULL,
  `id_aluno` int(11) DEFAULT NULL,
  `id_aula` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `modulos`
--

CREATE TABLE `modulos` (
  `id` int(11) NOT NULL,
  `nome` varchar(150) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `id_curso` int(11) DEFAULT NULL,
  `imagem` text,
  `arquivo` text,
  `url_video` text,
  `midia` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `modulos`
--

INSERT INTO `modulos` (`id`, `nome`, `id_curso`, `imagem`, `arquivo`, `url_video`, `midia`) VALUES
(1, 'Aula 1', 1, NULL, NULL, NULL, NULL),
(2, 'Aula 2', 1, NULL, NULL, NULL, NULL),
(3, 'Aula 3', 1, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuarios`
--

CREATE TABLE `usuarios` (
  `id_usuario` int(11) UNSIGNED NOT NULL,
  `nome` varchar(150) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `senha` varchar(80) DEFAULT NULL,
  `data_cadastro` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `status` int(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `usuarios`
--

INSERT INTO `usuarios` (`id_usuario`, `nome`, `email`, `senha`, `data_cadastro`, `status`) VALUES
(1, 'Flavio Milani', 'flaviomilani83@gmail.com', '4297f44b13955235245b2497399d7a93', '2020-07-15 05:49:59', 1),
(2, 'Nelson Pimenta', 'npcastro6@gmail.com', '63ee451939ed580ef3c4b6f0109d1fd0', '2020-07-10 04:36:49', 1);

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `alunos`
--
ALTER TABLE `alunos`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `aluno_curso`
--
ALTER TABLE `aluno_curso`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `atividade_aluno`
--
ALTER TABLE `atividade_aluno`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `aulas`
--
ALTER TABLE `aulas`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `cursos`
--
ALTER TABLE `cursos`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `curso_videos`
--
ALTER TABLE `curso_videos`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `duvidas`
--
ALTER TABLE `duvidas`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `historico`
--
ALTER TABLE `historico`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `modulos`
--
ALTER TABLE `modulos`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id_usuario`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `alunos`
--
ALTER TABLE `alunos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- AUTO_INCREMENT de tabela `aluno_curso`
--
ALTER TABLE `aluno_curso`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT de tabela `atividade_aluno`
--
ALTER TABLE `atividade_aluno`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `aulas`
--
ALTER TABLE `aulas`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT de tabela `cursos`
--
ALTER TABLE `cursos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de tabela `curso_videos`
--
ALTER TABLE `curso_videos`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de tabela `duvidas`
--
ALTER TABLE `duvidas`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de tabela `historico`
--
ALTER TABLE `historico`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `modulos`
--
ALTER TABLE `modulos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de tabela `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id_usuario` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
