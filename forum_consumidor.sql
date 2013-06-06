-- phpMyAdmin SQL Dump
-- version 3.5.2.2
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tempo de Geração: 16/04/2013 às 19:14:45
-- Versão do Servidor: 5.5.27
-- Versão do PHP: 5.4.7

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Banco de Dados: `forum_consumidor`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `artigo`
--

CREATE TABLE IF NOT EXISTS `artigo` (
  `id_artigo` int(9) unsigned NOT NULL AUTO_INCREMENT,
  `titulo` varchar(250) NOT NULL DEFAULT '',
  `subtitulo` text,
  `texto` text NOT NULL,
  `id_colunista` int(9) NOT NULL,
  `id_adm` int(11) NOT NULL,
  `ativo` int(11) NOT NULL,
  `data_cadastro` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `ultima_atualizacao` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id_artigo`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=13 ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `coluna`
--

CREATE TABLE IF NOT EXISTS `coluna` (
  `id_coluna` int(9) unsigned NOT NULL AUTO_INCREMENT,
  `titulo` varchar(250) NOT NULL DEFAULT '',
  `subtitulo` text,
  `texto` text NOT NULL,
  `id_colunista` int(9) NOT NULL DEFAULT '0',
  `data_cadastro` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `id_adm` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id_coluna`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `colunista`
--

CREATE TABLE IF NOT EXISTS `colunista` (
  `id_colunista` int(9) unsigned NOT NULL AUTO_INCREMENT,
  `nome` varchar(150) NOT NULL DEFAULT '',
  `curriculo` varchar(250) NOT NULL DEFAULT '',
  `foto` varchar(25) DEFAULT NULL,
  `id_adm` int(11) NOT NULL,
  `ativo` char(1) NOT NULL DEFAULT '1',
  `data_cadastro` timestamp NULL DEFAULT NULL,
  `ultima_atualizacao` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id_colunista`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=21 ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `endereco`
--

CREATE TABLE IF NOT EXISTS `endereco` (
  `id_endereco` int(11) NOT NULL AUTO_INCREMENT,
  `logradouro` varchar(250) COLLATE utf8_bin DEFAULT NULL,
  `numeroEnd` varchar(250) COLLATE utf8_bin DEFAULT NULL,
  `complemento` text COLLATE utf8_bin,
  `cep` varchar(45) COLLATE utf8_bin DEFAULT NULL,
  `bairro` varchar(250) COLLATE utf8_bin DEFAULT NULL,
  `cidade` varchar(45) COLLATE utf8_bin DEFAULT NULL,
  `uf` varchar(45) COLLATE utf8_bin DEFAULT NULL,
  `id_entidade` int(11) NOT NULL,
  PRIMARY KEY (`id_endereco`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=3 ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `entidade`
--

CREATE TABLE IF NOT EXISTS `entidade` (
  `id_entidade` int(11) NOT NULL AUTO_INCREMENT,
  `sigla` varchar(45) COLLATE utf8_bin NOT NULL,
  `nomeEnt` varchar(250) COLLATE utf8_bin NOT NULL,
  `descricao` text COLLATE utf8_bin NOT NULL,
  `site` varchar(250) COLLATE utf8_bin DEFAULT NULL,
  `emailEnt` varchar(100) COLLATE utf8_bin NOT NULL,
  `resumo` text COLLATE utf8_bin,
  `id_adm` int(11) DEFAULT NULL,
  `ativo` int(11) DEFAULT NULL,
  `data_cadastro` timestamp NULL DEFAULT NULL,
  `ultima_atualizacao` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id_entidade`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=3 ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `noticia`
--

CREATE TABLE IF NOT EXISTS `noticia` (
  `id_noticia` int(9) NOT NULL AUTO_INCREMENT,
  `titulo` varchar(250) CHARACTER SET latin1 DEFAULT NULL,
  `chamada` text CHARACTER SET latin1,
  `texto` text CHARACTER SET latin1,
  `fonte` varchar(100) CHARACTER SET latin1 DEFAULT NULL,
  `datacad` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `id_adm` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id_noticia`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Extraindo dados da tabela `noticia`
--

INSERT INTO `noticia` (`id_noticia`, `titulo`, `chamada`, `texto`, `fonte`, `datacad`, `id_adm`) VALUES
(1, 'rfged', 'dfgd', 'dfgdf', 'df', '2013-03-22 18:37:29', 3);

-- --------------------------------------------------------

--
-- Estrutura da tabela `noticia_arquivo`
--

CREATE TABLE IF NOT EXISTS `noticia_arquivo` (
  `id_noticia_arquivo` int(9) NOT NULL AUTO_INCREMENT,
  `id_noticia` int(9) NOT NULL DEFAULT '0',
  `arquivo` varchar(50) CHARACTER SET latin1 DEFAULT NULL,
  `nome` varchar(100) CHARACTER SET latin1 DEFAULT NULL,
  PRIMARY KEY (`id_noticia_arquivo`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `noticia_foto`
--

CREATE TABLE IF NOT EXISTS `noticia_foto` (
  `id_noticia_foto` int(9) NOT NULL AUTO_INCREMENT,
  `id_noticia` int(9) NOT NULL DEFAULT '0',
  `foto` varchar(50) CHARACTER SET latin1 DEFAULT NULL,
  `legenda` varchar(100) CHARACTER SET latin1 DEFAULT NULL,
  PRIMARY KEY (`id_noticia_foto`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `noticia_posicao`
--

CREATE TABLE IF NOT EXISTS `noticia_posicao` (
  `id_noticia_posicao` int(9) NOT NULL AUTO_INCREMENT,
  `id_noticia` int(9) NOT NULL DEFAULT '0',
  `id_noticia_tipo` int(9) NOT NULL DEFAULT '0',
  `posicao` int(2) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id_noticia_posicao`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Extraindo dados da tabela `noticia_posicao`
--

INSERT INTO `noticia_posicao` (`id_noticia_posicao`, `id_noticia`, `id_noticia_tipo`, `posicao`) VALUES
(1, 1, 4, 0),
(2, 1, 4, 0);

-- --------------------------------------------------------

--
-- Estrutura da tabela `noticia_tipo`
--

CREATE TABLE IF NOT EXISTS `noticia_tipo` (
  `id_noticia_tipo` int(9) NOT NULL AUTO_INCREMENT,
  `descricao` char(25) CHARACTER SET latin1 NOT NULL DEFAULT '',
  PRIMARY KEY (`id_noticia_tipo`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Extraindo dados da tabela `noticia_tipo`
--

INSERT INTO `noticia_tipo` (`id_noticia_tipo`, `descricao`) VALUES
(1, 'Destaque'),
(2, 'Especial'),
(3, 'Simples'),
(4, 'Normal');

-- --------------------------------------------------------

--
-- Estrutura da tabela `pergunta`
--

CREATE TABLE IF NOT EXISTS `pergunta` (
  `id_pergunta` int(11) NOT NULL AUTO_INCREMENT,
  `pergunta` varchar(250) COLLATE utf8_bin NOT NULL,
  `id_adm` int(11) NOT NULL,
  `ativo` int(11) NOT NULL,
  `data_cadastro` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `ultima_atualizacao` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id_pergunta`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=6 ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `responsavel`
--

CREATE TABLE IF NOT EXISTS `responsavel` (
  `id_responsavel` int(11) NOT NULL AUTO_INCREMENT,
  `nomeRes` varchar(250) COLLATE utf8_bin NOT NULL,
  `funcao` varchar(50) COLLATE utf8_bin DEFAULT NULL,
  `emailRes` varchar(50) COLLATE utf8_bin DEFAULT NULL,
  `id_entidade` int(11) NOT NULL,
  PRIMARY KEY (`id_responsavel`,`id_entidade`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=2 ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `resposta`
--

CREATE TABLE IF NOT EXISTS `resposta` (
  `id_resposta` int(11) NOT NULL AUTO_INCREMENT,
  `resposta` varchar(250) COLLATE utf8_bin NOT NULL,
  `id_pergunta` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_resposta`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=11 ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_galeria`
--

CREATE TABLE IF NOT EXISTS `tb_galeria` (
  `id_galeria` int(11) NOT NULL AUTO_INCREMENT,
  `titulo_galeria` varchar(250) COLLATE utf8_bin NOT NULL,
  `descricao_galeria` text COLLATE utf8_bin,
  `id_idioma` int(11) NOT NULL,
  `datacad_galeria` date NOT NULL DEFAULT '0000-00-00',
  `id_adm` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id_galeria`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=13 ;

--
-- Extraindo dados da tabela `tb_galeria`
--

INSERT INTO `tb_galeria` (`id_galeria`, `titulo_galeria`, `descricao_galeria`, `id_idioma`, `datacad_galeria`, `id_adm`) VALUES
(12, 'sdf', 0x7364667364, 0, '2013-04-15', 0);

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_galeria_foto`
--

CREATE TABLE IF NOT EXISTS `tb_galeria_foto` (
  `id_galeria_foto` int(11) NOT NULL AUTO_INCREMENT,
  `id_galeria` int(11) NOT NULL DEFAULT '0',
  `foto_galeria_foto` varchar(25) COLLATE utf8_bin NOT NULL,
  `legenda_galeria_foto` varchar(50) COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`id_galeria_foto`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=26 ;

--
-- Extraindo dados da tabela `tb_galeria_foto`
--

INSERT INTO `tb_galeria_foto` (`id_galeria_foto`, `id_galeria`, `foto_galeria_foto`, `legenda_galeria_foto`) VALUES
(25, 12, '12_201304152204_1.jpg', ' ');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_log`
--

CREATE TABLE IF NOT EXISTS `tb_log` (
  `id_log` int(11) NOT NULL AUTO_INCREMENT,
  `id_adm` int(11) NOT NULL,
  `id_log_acao` int(11) NOT NULL,
  `data` date NOT NULL DEFAULT '0000-00-00',
  `hora` time NOT NULL DEFAULT '00:00:00',
  `ip` char(15) DEFAULT NULL,
  PRIMARY KEY (`id_log`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=110 ;

--
-- Extraindo dados da tabela `tb_log`
--

INSERT INTO `tb_log` (`id_log`, `id_adm`, `id_log_acao`, `data`, `hora`, `ip`) VALUES
(1, 0, 3, '2013-03-20', '17:45:23', '127.0.0.1'),
(2, 0, 3, '2013-03-20', '17:50:10', '127.0.0.1'),
(3, 0, 3, '2013-03-20', '17:52:11', '127.0.0.1'),
(4, 0, 3, '2013-03-20', '18:01:42', '127.0.0.1'),
(5, 0, 3, '2013-03-20', '18:03:32', '127.0.0.1'),
(6, 0, 3, '2013-03-20', '18:05:20', '127.0.0.1'),
(7, 0, 3, '2013-03-20', '18:07:24', '127.0.0.1'),
(8, 0, 3, '2013-03-20', '18:08:34', '127.0.0.1'),
(9, 0, 3, '2013-03-20', '18:10:27', '127.0.0.1'),
(10, 0, 3, '2013-03-20', '18:10:48', '127.0.0.1'),
(11, 0, 3, '2013-03-20', '18:11:38', '127.0.0.1'),
(12, 0, 3, '2013-03-20', '18:17:43', '127.0.0.1'),
(13, 0, 3, '2013-03-20', '21:33:07', '127.0.0.1'),
(14, 0, 3, '2013-03-22', '16:11:46', '127.0.0.1'),
(15, 0, 3, '2013-03-22', '16:13:18', '127.0.0.1'),
(16, 0, 3, '2013-03-22', '16:14:44', '127.0.0.1'),
(17, 0, 3, '2013-03-22', '16:15:04', '127.0.0.1'),
(18, 0, 3, '2013-03-22', '16:17:24', '127.0.0.1'),
(19, 0, 3, '2013-03-22', '16:18:14', '127.0.0.1'),
(20, 0, 3, '2013-03-22', '16:19:43', '127.0.0.1'),
(21, 0, 3, '2013-03-22', '16:24:09', '127.0.0.1'),
(22, 0, 3, '2013-03-22', '16:31:38', '127.0.0.1'),
(23, 0, 3, '2013-03-22', '16:33:34', '127.0.0.1'),
(24, 0, 3, '2013-03-22', '16:34:54', '127.0.0.1'),
(25, 0, 3, '2013-03-22', '16:47:27', '127.0.0.1'),
(26, 0, 3, '2013-03-22', '16:50:34', '127.0.0.1'),
(27, 0, 3, '2013-03-22', '16:55:41', '127.0.0.1'),
(28, 0, 3, '2013-03-22', '17:13:07', '127.0.0.1'),
(29, 0, 3, '2013-03-22', '17:16:15', '127.0.0.1'),
(30, 0, 3, '2013-03-22', '17:20:13', '127.0.0.1'),
(31, 0, 3, '2013-03-22', '17:22:03', '127.0.0.1'),
(32, 0, 3, '2013-03-22', '18:54:14', '127.0.0.1'),
(33, 0, 3, '2013-03-22', '18:59:38', '127.0.0.1'),
(34, 0, 3, '2013-03-22', '19:01:22', '127.0.0.1'),
(35, 0, 3, '2013-03-22', '19:06:08', '127.0.0.1'),
(36, 0, 3, '2013-03-22', '19:16:30', '127.0.0.1'),
(37, 0, 3, '2013-03-22', '19:17:02', '127.0.0.1'),
(38, 0, 3, '2013-03-22', '19:18:19', '127.0.0.1'),
(39, 0, 3, '2013-03-22', '19:18:37', '127.0.0.1'),
(40, 0, 3, '2013-03-22', '19:19:03', '127.0.0.1'),
(41, 0, 3, '2013-03-22', '19:19:53', '127.0.0.1'),
(42, 0, 3, '2013-03-22', '19:21:56', '127.0.0.1'),
(43, 0, 3, '2013-03-22', '19:22:13', '127.0.0.1'),
(44, 0, 3, '2013-03-22', '19:32:14', '127.0.0.1'),
(45, 0, 3, '2013-03-22', '19:36:11', '127.0.0.1'),
(46, 0, 3, '2013-03-22', '19:42:36', '127.0.0.1'),
(47, 0, 3, '2013-03-22', '19:49:05', '127.0.0.1'),
(48, 0, 3, '2013-03-22', '20:22:17', '127.0.0.1'),
(49, 0, 3, '2013-03-22', '20:42:02', '127.0.0.1'),
(50, 0, 6, '2013-03-22', '21:25:40', '127.0.0.1'),
(51, 0, 6, '2013-03-22', '21:29:53', '127.0.0.1'),
(52, 0, 6, '2013-03-22', '21:31:18', '127.0.0.1'),
(53, 0, 6, '2013-03-22', '21:31:47', '127.0.0.1'),
(54, 0, 6, '2013-03-22', '21:32:34', '127.0.0.1'),
(55, 0, 6, '2013-03-22', '21:33:42', '127.0.0.1'),
(56, 0, 3, '2013-04-10', '17:52:10', '127.0.0.1'),
(57, 0, 6, '2013-04-10', '17:59:17', '127.0.0.1'),
(58, 0, 3, '2013-04-10', '18:02:37', '127.0.0.1'),
(59, 0, 3, '2013-04-10', '18:04:41', '127.0.0.1'),
(60, 0, 6, '2013-04-10', '18:16:08', '127.0.0.1'),
(61, 0, 6, '2013-04-10', '18:46:43', '127.0.0.1'),
(62, 0, 3, '2013-04-10', '18:49:10', '127.0.0.1'),
(63, 0, 6, '2013-04-10', '18:49:15', '127.0.0.1'),
(64, 0, 3, '2013-04-10', '18:55:22', '127.0.0.1'),
(65, 0, 5, '2013-04-10', '19:15:45', '127.0.0.1'),
(66, 0, 5, '2013-04-10', '19:16:18', '127.0.0.1'),
(67, 0, 5, '2013-04-10', '19:21:51', '127.0.0.1'),
(68, 0, 5, '2013-04-10', '19:25:07', '127.0.0.1'),
(69, 0, 5, '2013-04-10', '19:40:44', '127.0.0.1'),
(70, 0, 5, '2013-04-10', '19:45:20', '127.0.0.1'),
(71, 0, 5, '2013-04-10', '19:54:24', '127.0.0.1'),
(72, 0, 5, '2013-04-10', '19:55:32', '127.0.0.1'),
(73, 0, 5, '2013-04-10', '19:57:12', '127.0.0.1'),
(74, 0, 5, '2013-04-10', '19:59:33', '127.0.0.1'),
(75, 0, 5, '2013-04-10', '20:00:12', '127.0.0.1'),
(76, 0, 5, '2013-04-10', '20:15:55', '127.0.0.1'),
(77, 0, 5, '2013-04-10', '20:16:31', '127.0.0.1'),
(78, 0, 5, '2013-04-10', '20:17:10', '127.0.0.1'),
(79, 0, 5, '2013-04-10', '20:24:55', '127.0.0.1'),
(80, 0, 5, '2013-04-10', '20:26:19', '127.0.0.1'),
(81, 0, 5, '2013-04-10', '20:27:58', '127.0.0.1'),
(82, 0, 5, '2013-04-10', '20:46:54', '127.0.0.1'),
(83, 0, 5, '2013-04-10', '20:51:21', '127.0.0.1'),
(84, 0, 5, '2013-04-10', '20:52:25', '127.0.0.1'),
(85, 0, 5, '2013-04-10', '20:57:31', '127.0.0.1'),
(86, 0, 5, '2013-04-10', '20:58:44', '127.0.0.1'),
(87, 0, 5, '2013-04-10', '20:59:34', '127.0.0.1'),
(88, 0, 5, '2013-04-10', '21:01:54', '127.0.0.1'),
(89, 0, 5, '2013-04-10', '21:03:38', '127.0.0.1'),
(90, 0, 5, '2013-04-10', '21:04:06', '127.0.0.1'),
(91, 0, 5, '2013-04-10', '21:13:58', '127.0.0.1'),
(92, 0, 5, '2013-04-10', '21:14:08', '127.0.0.1'),
(93, 0, 5, '2013-04-10', '22:16:59', '127.0.0.1'),
(94, 0, 5, '2013-04-10', '22:19:24', '127.0.0.1'),
(95, 0, 5, '2013-04-10', '22:20:12', '127.0.0.1'),
(96, 0, 5, '2013-04-10', '22:20:53', '127.0.0.1'),
(97, 0, 5, '2013-04-10', '22:21:56', '127.0.0.1'),
(98, 0, 3, '2013-04-15', '20:51:32', '127.0.0.1'),
(99, 0, 3, '2013-04-15', '20:55:30', '127.0.0.1'),
(100, 0, 3, '2013-04-15', '20:59:42', '127.0.0.1'),
(101, 0, 3, '2013-04-15', '21:13:11', '127.0.0.1'),
(102, 0, 3, '2013-04-15', '21:15:15', '127.0.0.1'),
(103, 0, 3, '2013-04-15', '21:19:33', '127.0.0.1'),
(104, 0, 3, '2013-04-15', '21:22:30', '127.0.0.1'),
(105, 0, 3, '2013-04-15', '21:22:51', '127.0.0.1'),
(106, 0, 3, '2013-04-15', '21:23:02', '127.0.0.1'),
(107, 0, 3, '2013-04-15', '21:26:37', '127.0.0.1'),
(108, 0, 3, '2013-04-15', '21:27:26', '127.0.0.1'),
(109, 0, 3, '2013-04-15', '22:04:47', '127.0.0.1');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_log_acao`
--

CREATE TABLE IF NOT EXISTS `tb_log_acao` (
  `id_log_acao` int(11) NOT NULL AUTO_INCREMENT,
  `descricao` varchar(15) NOT NULL,
  PRIMARY KEY (`id_log_acao`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_log_sql`
--

CREATE TABLE IF NOT EXISTS `tb_log_sql` (
  `id_log_sql` int(11) NOT NULL AUTO_INCREMENT,
  `id_log` int(11) NOT NULL,
  `sql_executada` text NOT NULL,
  PRIMARY KEY (`id_log_sql`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=391 ;

--
-- Extraindo dados da tabela `tb_log_sql`
--

INSERT INTO `tb_log_sql` (`id_log_sql`, `id_log`, `sql_executada`) VALUES
(282, 1, 'INSERT INTO tb_galeria (   titulo_galeria, descricao_galeria, id_idioma, datacad_galeria, id_adm) VALUES (   ''BUU'', ''bbjkb'', '''', ''2013-03-20'', '''')'),
(283, 2, 'INSERT INTO tb_galeria (   titulo_galeria, descricao_galeria, id_idioma, datacad_galeria, id_adm) VALUES (   ''df'', ''df'', '''', ''2013-03-20'', '''')'),
(284, 3, 'INSERT INTO tb_galeria (   titulo_galeria, descricao_galeria, id_idioma, datacad_galeria, id_adm) VALUES (   ''df'', ''df'', '''', ''2013-03-20'', '''')'),
(285, 4, 'INSERT INTO tb_galeria (   titulo_galeria, descricao_galeria, id_idioma, datacad_galeria, id_adm) VALUES (   ''ert'', ''wert'', '''', ''2013-03-20'', '''')'),
(286, 5, 'INSERT INTO tb_galeria (   titulo_galeria, descricao_galeria, id_idioma, datacad_galeria, id_adm) VALUES (   ''er'', ''werwt'', '''', ''2013-03-20'', '''')'),
(287, 6, 'INSERT INTO tb_galeria (   titulo_galeria, descricao_galeria, id_idioma, datacad_galeria, id_adm) VALUES (   ''34'', ''45345654'', '''', ''2013-03-20'', '''')'),
(288, 7, 'INSERT INTO tb_galeria (   titulo_galeria, descricao_galeria, id_idioma, datacad_galeria, id_adm) VALUES (   ''adasd'', ''dasda'', '''', ''2013-03-20'', '''')'),
(289, 8, 'INSERT INTO tb_galeria (   titulo_galeria, descricao_galeria, id_idioma, datacad_galeria, id_adm) VALUES (   ''dfsf'', ''fsdfsdf'', '''', ''2013-03-20'', '''')'),
(290, 9, 'INSERT INTO tb_galeria (   titulo_galeria, descricao_galeria, id_idioma, datacad_galeria, id_adm) VALUES (   ''asdf'', ''sdfsdfsd'', '''', ''2013-03-20'', '''')'),
(291, 10, 'INSERT INTO tb_galeria (   titulo_galeria, descricao_galeria, id_idioma, datacad_galeria, id_adm) VALUES (   ''asdasdasdsadasdfferf'', ''erferfer'', '''', ''2013-03-20'', '''')'),
(292, 11, 'INSERT INTO tb_galeria (   titulo_galeria, descricao_galeria, id_idioma, datacad_galeria, id_adm) VALUES (   ''rtttttt'', ''ttttttttttt'', '''', ''2013-03-20'', '''')'),
(293, 12, 'INSERT INTO tb_galeria (   titulo_galeria, descricao_galeria, id_idioma, datacad_galeria, id_adm) VALUES (   ''VALENDO'', ''VALENO'', '''', ''2013-03-20'', '''')'),
(294, 13, 'INSERT INTO tb_galeria (   titulo_galeria, descricao_galeria, id_idioma, datacad_galeria, id_adm) VALUES (   ''BUU'', ''asd'', '''', ''2013-03-20'', '''')'),
(295, 14, 'INSERT INTO tb_galeria (   titulo_galeria, descricao_galeria, id_idioma, datacad_galeria, id_adm) VALUES (   ''Tet'', ''asd'', '''', ''2013-03-22'', '''')'),
(296, 15, 'INSERT INTO tb_galeria (   titulo_galeria, descricao_galeria, id_idioma, datacad_galeria, id_adm) VALUES (   ''asasd'', ''ads'', '''', ''2013-03-22'', '''')'),
(297, 16, 'INSERT INTO tb_galeria (   titulo_galeria, descricao_galeria, id_idioma, datacad_galeria, id_adm) VALUES (   ''assas'', ''as'', '''', ''2013-03-22'', '''')'),
(298, 17, 'INSERT INTO tb_galeria (   titulo_galeria, descricao_galeria, id_idioma, datacad_galeria, id_adm) VALUES (   ''sdf'', ''sdf'', '''', ''2013-03-22'', '''')'),
(299, 18, 'INSERT INTO tb_galeria (   titulo_galeria, descricao_galeria, id_idioma, datacad_galeria, id_adm) VALUES (   ''as'', '''', '''', ''2013-03-22'', '''')'),
(300, 19, 'INSERT INTO tb_galeria (   titulo_galeria, descricao_galeria, id_idioma, datacad_galeria, id_adm) VALUES (   ''asass'', '''', '''', ''2013-03-22'', '''')'),
(301, 20, 'INSERT INTO tb_galeria (   titulo_galeria, descricao_galeria, id_idioma, datacad_galeria, id_adm) VALUES (   ''sdcfd'', ''sdfsd'', '''', ''2013-03-22'', '''')'),
(302, 21, 'INSERT INTO tb_galeria (   titulo_galeria, descricao_galeria, id_idioma, datacad_galeria, id_adm) VALUES (   ''asd'', ''asd'', '''', ''2013-03-22'', '''')'),
(303, 22, 'INSERT INTO tb_galeria (   titulo_galeria, descricao_galeria, id_idioma, datacad_galeria, id_adm) VALUES (   ''asd'', ''asd'', '''', ''2013-03-22'', '''')'),
(304, 23, 'INSERT INTO tb_galeria (   titulo_galeria, descricao_galeria, id_idioma, datacad_galeria, id_adm) VALUES (   ''asd'', ''asd'', '''', ''2013-03-22'', '''')'),
(305, 24, 'INSERT INTO tb_galeria (   titulo_galeria, descricao_galeria, id_idioma, datacad_galeria, id_adm) VALUES (   ''qw'', '''', '''', ''2013-03-22'', '''')'),
(306, 25, 'INSERT INTO tb_galeria (   titulo_galeria, descricao_galeria, id_idioma, datacad_galeria, id_adm) VALUES (   ''qwe'', '''', '''', ''2013-03-22'', '''')'),
(307, 26, 'INSERT INTO tb_galeria (   titulo_galeria, descricao_galeria, id_idioma, datacad_galeria, id_adm) VALUES (   ''asd'', '''', '''', ''2013-03-22'', '''')'),
(308, 27, 'INSERT INTO tb_galeria (   titulo_galeria, descricao_galeria, id_idioma, datacad_galeria, id_adm) VALUES (   ''sad'', '''', '''', ''2013-03-22'', '''')'),
(309, 28, 'INSERT INTO tb_galeria (   titulo_galeria, descricao_galeria, id_idioma, datacad_galeria, id_adm) VALUES (   ''asd'', '''', '''', ''2013-03-22'', '''')'),
(310, 29, 'INSERT INTO tb_galeria (   titulo_galeria, descricao_galeria, id_idioma, datacad_galeria, id_adm) VALUES (   ''sd'', '''', '''', ''2013-03-22'', '''')'),
(311, 30, 'INSERT INTO tb_galeria (   titulo_galeria, descricao_galeria, id_idioma, datacad_galeria, id_adm) VALUES (   ''we'', '''', '''', ''2013-03-22'', '''')'),
(312, 31, 'INSERT INTO tb_galeria (   titulo_galeria, descricao_galeria, id_idioma, datacad_galeria, id_adm) VALUES (   ''qwww'', '''', '''', ''2013-03-22'', '''')'),
(313, 32, 'INSERT INTO tb_galeria (   titulo_galeria, descricao_galeria, id_idioma, datacad_galeria, id_adm) VALUES (   ''asdasd'', '''', '''', ''2013-03-22'', '''')'),
(314, 33, 'INSERT INTO tb_galeria (   titulo_galeria, descricao_galeria, id_idioma, datacad_galeria, id_adm) VALUES (   ''rtwe'', ''wertwert'', '''', ''2013-03-22'', '''')'),
(315, 34, 'INSERT INTO tb_galeria (   titulo_galeria, descricao_galeria, id_idioma, datacad_galeria, id_adm) VALUES (   ''TESTEOK'', ''TESTEOK'', '''', ''2013-03-22'', '''')'),
(316, 35, 'INSERT INTO tb_galeria (   titulo_galeria, descricao_galeria, id_idioma, datacad_galeria, id_adm) VALUES (   ''TUUUU'', ''asd'', '''', ''2013-03-22'', '''')'),
(317, 36, 'INSERT INTO tb_galeria (   titulo_galeria, descricao_galeria, id_idioma, datacad_galeria, id_adm) VALUES (   ''BB'', ''BB'', '''', ''2013-03-22'', '''')'),
(318, 37, 'INSERT INTO tb_galeria (   titulo_galeria, descricao_galeria, id_idioma, datacad_galeria, id_adm) VALUES (   ''asdd'', '''', '''', ''2013-03-22'', '''')'),
(319, 38, 'INSERT INTO tb_galeria (   titulo_galeria, descricao_galeria, id_idioma, datacad_galeria, id_adm) VALUES (   ''werf'', ''wefrfwerf'', '''', ''2013-03-22'', '''')'),
(320, 39, 'INSERT INTO tb_galeria (   titulo_galeria, descricao_galeria, id_idioma, datacad_galeria, id_adm) VALUES (   ''wertr'', ''ertwet'', '''', ''2013-03-22'', '''')'),
(321, 40, 'INSERT INTO tb_galeria (   titulo_galeria, descricao_galeria, id_idioma, datacad_galeria, id_adm) VALUES (   ''wertrwert'', ''wert'', '''', ''2013-03-22'', '''')'),
(322, 41, 'INSERT INTO tb_galeria (   titulo_galeria, descricao_galeria, id_idioma, datacad_galeria, id_adm) VALUES (   ''wert'', ''ewrtwet'', '''', ''2013-03-22'', '''')'),
(323, 42, 'INSERT INTO tb_galeria (   titulo_galeria, descricao_galeria, id_idioma, datacad_galeria, id_adm) VALUES (   ''sadf'', ''sdf'', '''', ''2013-03-22'', '''')'),
(324, 43, 'INSERT INTO tb_galeria (   titulo_galeria, descricao_galeria, id_idioma, datacad_galeria, id_adm) VALUES (   ''wert'', ''ewrtwet'', '''', ''2013-03-22'', '''')'),
(325, 44, 'INSERT INTO tb_galeria (   titulo_galeria, descricao_galeria, id_idioma, datacad_galeria, id_adm) VALUES (   ''asda'', ''asdasdas'', '''', ''2013-03-22'', '''')'),
(326, 45, 'INSERT INTO tb_galeria (   titulo_galeria, descricao_galeria, id_idioma, datacad_galeria, id_adm) VALUES (   ''bbb'', ''bbbb'', '''', ''2013-03-22'', '''')'),
(327, 46, 'INSERT INTO tb_galeria (   titulo_galeria, descricao_galeria, id_idioma, datacad_galeria, id_adm) VALUES (   ''werf'', ''wer'', '''', ''2013-03-22'', '''')'),
(328, 47, 'INSERT INTO tb_galeria (   titulo_galeria, descricao_galeria, id_idioma, datacad_galeria, id_adm) VALUES (   ''TUUU'', ''BUUUU'', '''', ''2013-03-22'', '''')'),
(329, 48, 'INSERT INTO tb_galeria (   titulo_galeria, descricao_galeria, id_idioma, datacad_galeria, id_adm) VALUES (   ''MMMAAAAIIIISSS'', ''asdasd'', '''', ''2013-03-22'', '''')'),
(330, 49, 'INSERT INTO tb_galeria (   titulo_galeria, descricao_galeria, id_idioma, datacad_galeria, id_adm) VALUES (   ''aas'', ''asd'', '''', ''2013-03-22'', '''')'),
(331, 50, 'DELETE FROM tb_galeria WHERE id_galeria = ''63'' '),
(332, 51, 'DELETE FROM tb_galeria WHERE id_galeria = ''59'' '),
(333, 52, 'DELETE FROM tb_galeria WHERE id_galeria = ''60'' '),
(334, 53, 'DELETE FROM tb_galeria WHERE id_galeria = ''61'' '),
(335, 54, 'DELETE FROM tb_galeria WHERE id_galeria = ''62'' '),
(336, 55, 'DELETE FROM tb_galeria WHERE id_galeria = ''64'' '),
(337, 56, 'INSERT INTO tb_galeria (   titulo_galeria, descricao_galeria, id_idioma, datacad_galeria, id_adm) VALUES (   ''sdf'', ''sdf'', '''', ''2013-04-10'', '''')'),
(338, 57, 'DELETE FROM tb_galeria WHERE id_galeria = ''1'' '),
(339, 58, 'INSERT INTO tb_galeria (   titulo_galeria, descricao_galeria, id_idioma, datacad_galeria, id_adm) VALUES (   ''ee'', ''ee'', '''', ''2013-04-10'', '''')'),
(340, 59, 'INSERT INTO tb_galeria (   titulo_galeria, descricao_galeria, id_idioma, datacad_galeria, id_adm) VALUES (   ''dd'', ''dd'', '''', ''2013-04-10'', '''')'),
(341, 60, 'DELETE FROM tb_galeria WHERE id_galeria = ''2'' '),
(342, 61, 'DELETE FROM tb_galeria WHERE id_galeria = ''3'' '),
(343, 62, 'INSERT INTO tb_galeria (   titulo_galeria, descricao_galeria, id_idioma, datacad_galeria, id_adm) VALUES (   ''TT'', ''TT'', '''', ''2013-04-10'', '''')'),
(344, 63, 'DELETE FROM tb_galeria WHERE id_galeria = ''4'' '),
(345, 64, 'INSERT INTO tb_galeria (   titulo_galeria, descricao_galeria, id_idioma, datacad_galeria, id_adm) VALUES (   ''RR'', ''r'', '''', ''2013-04-10'', '''')'),
(346, 65, 'UPDATE tb_galeria SET   titulo_galeria =  ''RRALTERADO'',   descricao_galeria = ''rALTERADO'' WHERE id_galeria = ''5'' '),
(347, 66, 'UPDATE tb_galeria SET   titulo_galeria =  ''RRALTERADO'',   descricao_galeria = ''rALTERADO'' WHERE id_galeria = ''5'' '),
(348, 67, 'UPDATE tb_galeria SET   titulo_galeria =  ''RRALTERADO'',   descricao_galeria = ''rALTERADO'' WHERE id_galeria = ''5'' '),
(349, 68, 'UPDATE tb_galeria SET   titulo_galeria =  ''RRALTERADO'',   descricao_galeria = ''rALTERADO'' WHERE id_galeria = ''5'' '),
(350, 69, 'UPDATE tb_galeria SET   titulo_galeria =  ''RRALTERADO'',   descricao_galeria = ''rALTERADO'' WHERE id_galeria = ''5'' '),
(351, 70, 'UPDATE tb_galeria SET   titulo_galeria =  ''RRALTERADO'',   descricao_galeria = ''rALTERADO'' WHERE id_galeria = ''5'' '),
(352, 71, 'UPDATE tb_galeria SET   titulo_galeria =  ''RRALTERADO'',   descricao_galeria = ''rALTERADO'' WHERE id_galeria = ''5'' '),
(353, 72, 'UPDATE tb_galeria SET   titulo_galeria =  ''RRALTERADO'',   descricao_galeria = ''rALTERADO'' WHERE id_galeria = ''5'' '),
(354, 73, 'UPDATE tb_galeria SET   titulo_galeria =  ''RRALTERADO'',   descricao_galeria = ''rALTERADO'' WHERE id_galeria = ''5'' '),
(355, 74, 'UPDATE tb_galeria SET   titulo_galeria =  ''RRALTERADO'',   descricao_galeria = ''rALTERADO'' WHERE id_galeria = ''5'' '),
(356, 75, 'UPDATE tb_galeria SET   titulo_galeria =  ''RRALTERADO'',   descricao_galeria = ''rALTERADO'' WHERE id_galeria = ''5'' '),
(357, 76, 'UPDATE tb_galeria SET   titulo_galeria =  ''RRALTERADO'',   descricao_galeria = ''rALTERADO'' WHERE id_galeria = ''5'' '),
(358, 77, 'UPDATE tb_galeria SET   titulo_galeria =  ''RRALTERADO'',   descricao_galeria = ''rALTERADO'' WHERE id_galeria = ''5'' '),
(359, 78, 'UPDATE tb_galeria SET   titulo_galeria =  ''RRALTERADO'',   descricao_galeria = ''rALTERADO'' WHERE id_galeria = ''5'' '),
(360, 79, 'UPDATE tb_galeria SET   titulo_galeria =  ''RRALTERADO'',   descricao_galeria = ''rALTERADO'' WHERE id_galeria = ''5'' '),
(361, 80, 'UPDATE tb_galeria SET   titulo_galeria =  ''RRALTERADO'',   descricao_galeria = ''rALTERADO'' WHERE id_galeria = ''5'' '),
(362, 81, 'UPDATE tb_galeria SET   titulo_galeria =  ''RRALTERADO'',   descricao_galeria = ''rALTERADO'' WHERE id_galeria = ''5'' '),
(363, 82, 'UPDATE tb_galeria SET   titulo_galeria =  ''RRALTERADO'',   descricao_galeria = ''rALTERADO'' WHERE id_galeria = ''5'' '),
(364, 83, 'UPDATE tb_galeria SET   titulo_galeria =  ''RRALTERADO'',   descricao_galeria = ''rALTERADO'' WHERE id_galeria = ''5'' '),
(365, 84, 'UPDATE tb_galeria SET   titulo_galeria =  ''RRALTERADO'',   descricao_galeria = ''rALTERADO'' WHERE id_galeria = ''5'' '),
(366, 85, 'UPDATE tb_galeria SET   titulo_galeria =  ''RRALTERADO'',   descricao_galeria = ''rALTERADO'' WHERE id_galeria = ''5'' '),
(367, 86, 'UPDATE tb_galeria SET   titulo_galeria =  ''RRALTERADO'',   descricao_galeria = ''rALTERADO'' WHERE id_galeria = ''5'' '),
(368, 87, 'UPDATE tb_galeria SET   titulo_galeria =  ''RRALTERADO'',   descricao_galeria = ''rALTERADO'' WHERE id_galeria = ''5'' '),
(369, 88, 'UPDATE tb_galeria SET   titulo_galeria =  ''RRALTERADO'',   descricao_galeria = ''rALTERADO'' WHERE id_galeria = ''5'' '),
(370, 89, 'UPDATE tb_galeria SET   titulo_galeria =  ''RRALTERADO'',   descricao_galeria = ''rALTERADO'' WHERE id_galeria = ''5'' '),
(371, 90, 'UPDATE tb_galeria SET   titulo_galeria =  ''RRALTERADO'',   descricao_galeria = ''rALTERADO'' WHERE id_galeria = ''5'' '),
(372, 91, 'UPDATE tb_galeria SET   titulo_galeria =  ''RRALTERADO'',   descricao_galeria = ''rALTERADO'' WHERE id_galeria = ''5'' '),
(373, 92, 'UPDATE tb_galeria SET   titulo_galeria =  ''RRALTERADO'',   descricao_galeria = ''rALTERADO'' WHERE id_galeria = ''5'' '),
(374, 93, 'UPDATE tb_galeria SET   titulo_galeria =  ''RRALTERADO'',   descricao_galeria = ''rALTERADO'' WHERE id_galeria = ''5'' '),
(375, 94, 'UPDATE tb_galeria SET   titulo_galeria =  ''RRALTERADO'',   descricao_galeria = ''rALTERADO'' WHERE id_galeria = ''5'' '),
(376, 95, 'UPDATE tb_galeria SET   titulo_galeria =  ''RRALTERADO'',   descricao_galeria = ''rALTERADO'' WHERE id_galeria = ''5'' '),
(377, 96, 'UPDATE tb_galeria SET   titulo_galeria =  ''RRALTERADO'',   descricao_galeria = ''rALTERADO'' WHERE id_galeria = ''5'' '),
(378, 97, 'UPDATE tb_galeria SET   titulo_galeria =  ''RRALTERADO'',   descricao_galeria = ''rALTERADO'' WHERE id_galeria = ''5'' '),
(379, 98, 'INSERT INTO tb_galeria (   titulo_galeria, descricao_galeria, id_idioma, datacad_galeria, id_adm) VALUES (   ''dfg'', ''dfg'', '''', ''2013-04-15'', '''')'),
(380, 99, 'INSERT INTO tb_galeria (   titulo_galeria, descricao_galeria, id_idioma, datacad_galeria, id_adm) VALUES (   ''VV'', ''VV'', '''', ''2013-04-15'', '''')'),
(381, 100, 'INSERT INTO tb_galeria (   titulo_galeria, descricao_galeria, id_idioma, datacad_galeria, id_adm) VALUES (   ''ttt'', ''tt'', '''', ''2013-04-15'', '''')'),
(382, 101, 'INSERT INTO tb_galeria (   titulo_galeria, descricao_galeria, id_idioma, datacad_galeria, id_adm) VALUES (   ''asd'', ''asd'', '''', ''2013-04-15'', '''')'),
(383, 102, 'INSERT INTO tb_galeria (   titulo_galeria, descricao_galeria, id_idioma, datacad_galeria, id_adm) VALUES (   ''Teste'', ''BUU'', '''', ''2013-04-15'', '''')'),
(384, 103, 'INSERT INTO tb_galeria (   titulo_galeria, descricao_galeria, id_idioma, datacad_galeria, id_adm) VALUES (   ''BUU'', ''buu'', '''', ''2013-04-15'', '''')'),
(385, 104, 'INSERT INTO tb_galeria (   titulo_galeria, descricao_galeria, id_idioma, datacad_galeria, id_adm) VALUES (   ''BUU'', ''buu'', '''', ''2013-04-15'', '''')'),
(386, 105, 'INSERT INTO tb_galeria (   titulo_galeria, descricao_galeria, id_idioma, datacad_galeria, id_adm) VALUES (   ''BUU'', ''buu'', '''', ''2013-04-15'', '''')'),
(387, 106, 'INSERT INTO tb_galeria (   titulo_galeria, descricao_galeria, id_idioma, datacad_galeria, id_adm) VALUES (   ''BUU'', ''buu'', '''', ''2013-04-15'', '''')'),
(388, 107, 'INSERT INTO tb_galeria (   titulo_galeria, descricao_galeria, id_idioma, datacad_galeria, id_adm) VALUES (   ''BUU'', '''', '''', ''2013-04-15'', '''')'),
(389, 108, 'INSERT INTO tb_galeria (   titulo_galeria, descricao_galeria, id_idioma, datacad_galeria, id_adm) VALUES (   '' dfs'', ''vv'', '''', ''2013-04-15'', '''')'),
(390, 109, 'INSERT INTO tb_galeria (   titulo_galeria, descricao_galeria, id_idioma, datacad_galeria, id_adm) VALUES (   ''sdf'', ''sdfsd'', '''', ''2013-04-15'', '''')');

-- --------------------------------------------------------

--
-- Estrutura da tabela `telefone`
--

CREATE TABLE IF NOT EXISTS `telefone` (
  `id_telefone` int(11) NOT NULL AUTO_INCREMENT,
  `ddd` varchar(5) COLLATE utf8_bin NOT NULL,
  `numeroTel` varchar(45) COLLATE utf8_bin NOT NULL,
  `id_entidade` int(11) NOT NULL,
  PRIMARY KEY (`id_telefone`,`id_entidade`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_bin AUTO_INCREMENT=3 ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuario`
--

CREATE TABLE IF NOT EXISTS `usuario` (
  `id_usuario` int(11) NOT NULL AUTO_INCREMENT,
  `id_usuario_nivel` int(11) NOT NULL,
  `nome` varchar(100) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `email` varchar(100) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `senha` varchar(255) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `ativo` char(1) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL DEFAULT '1',
  `ultima_atualizacao` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_usuario`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Extraindo dados da tabela `usuario`
--

INSERT INTO `usuario` (`id_usuario`, `id_usuario_nivel`, `nome`, `email`, `senha`, `ativo`, `ultima_atualizacao`) VALUES
(1, 1, 'Artini Lemos', 'artini@algconsultoria.com.br', '88de83fb9690409145af4039e43d7f03', '1', '2011-11-10 16:51:45'),
(3, 1, 'admin', 'admin@admin.com.br', '21232f297a57a5a743894a0e4a801fc3', '1', '2013-03-20 15:41:46'),
(4, 1, 'ALG Consultoria', 'suporte@algconsultoria.com.br', '93c1abc9876a905fa4a03616fe2c5e30', '1', '2013-03-19 21:51:26');

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuario_area`
--

CREATE TABLE IF NOT EXISTS `usuario_area` (
  `id_usuario_area` int(3) NOT NULL AUTO_INCREMENT,
  `descricao` varchar(50) CHARACTER SET latin1 NOT NULL,
  `caminho` varchar(255) CHARACTER SET latin1 DEFAULT NULL,
  `area_id` int(3) NOT NULL DEFAULT '0',
  `ordem` int(2) NOT NULL DEFAULT '0',
  `ativo` char(1) CHARACTER SET latin1 NOT NULL DEFAULT '1',
  `ultima_atualizacao` datetime NOT NULL,
  PRIMARY KEY (`id_usuario_area`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=44 ;

--
-- Extraindo dados da tabela `usuario_area`
--

INSERT INTO `usuario_area` (`id_usuario_area`, `descricao`, `caminho`, `area_id`, `ordem`, `ativo`, `ultima_atualizacao`) VALUES
(1, 'Home', 'home.php', 0, 1, '1', '2011-11-10 14:56:41'),
(2, 'SeguranÃ§a', '', 0, 50, '1', '2013-04-16 13:42:18'),
(3, 'Ãreas do Sistema', 'seguranca/usuario_area/usuario_area_ndx.php', 2, 1, '1', '2013-03-13 17:36:28'),
(4, 'NÃ­veis de PermissÃ£o', 'seguranca/usuario_nivel/usuario_nivel_ndx.php', 2, 2, '1', '2013-03-13 17:36:48'),
(5, 'UsuÃ¡rio', 'seguranca/usuario/usuario_ndx.php', 2, 3, '1', '2013-03-13 17:37:04'),
(6, 'Sair', 'sair.php', 0, 51, '1', '2013-04-16 13:42:43'),
(7, 'Alterar Senha', 'seguranca/alterar_senha/alterar_senha_frm.php', 2, 4, '1', '2011-11-14 01:16:28'),
(24, 'ConteÃºdo', '', 0, 2, '1', '2013-03-18 14:05:36'),
(40, 'NotÃ­cias', '../modulos/noticia/backEnd/noticia_ndx.php', 24, 1, '1', '2013-03-18 14:06:08'),
(41, 'Galeria de fotos', '../modulos/galeriaFotos/backEnd/galeria_ndx.php', 0, 3, '1', '2013-03-22 12:35:19'),
(42, 'Entidade', '../modulos/entidade/backEnd/entidadeNdx.php', 0, 2, '1', '2013-04-09 15:06:14'),
(43, 'Enquete', '../modulos/enquete/backEnd/enqueteNdx.php', 0, 3, '1', '2013-04-09 15:56:17');

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuario_nivel`
--

CREATE TABLE IF NOT EXISTS `usuario_nivel` (
  `id_usuario_nivel` int(3) NOT NULL AUTO_INCREMENT,
  `descricao` varchar(30) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  PRIMARY KEY (`id_usuario_nivel`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Extraindo dados da tabela `usuario_nivel`
--

INSERT INTO `usuario_nivel` (`id_usuario_nivel`, `descricao`) VALUES
(1, 'Administrador'),
(2, 'UsuÃ¡rio');

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuario_nivel_lig_area`
--

CREATE TABLE IF NOT EXISTS `usuario_nivel_lig_area` (
  `id_usuario_nivel_lig_area` int(9) NOT NULL AUTO_INCREMENT,
  `id_usuario_nivel` int(3) NOT NULL,
  `id_usuario_area` int(3) NOT NULL,
  PRIMARY KEY (`id_usuario_nivel_lig_area`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=393 ;

--
-- Extraindo dados da tabela `usuario_nivel_lig_area`
--

INSERT INTO `usuario_nivel_lig_area` (`id_usuario_nivel_lig_area`, `id_usuario_nivel`, `id_usuario_area`) VALUES
(365, 2, 24),
(366, 2, 1),
(367, 2, 6),
(368, 2, 2),
(369, 2, 7),
(370, 2, 40),
(381, 1, 24),
(382, 1, 43),
(383, 1, 42),
(384, 1, 41),
(385, 1, 1),
(386, 1, 6),
(387, 1, 2),
(388, 1, 7),
(389, 1, 3),
(390, 1, 4),
(391, 1, 5),
(392, 1, 40);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
