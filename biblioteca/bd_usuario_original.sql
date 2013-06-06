-- phpMyAdmin SQL Dump
-- version 3.4.3.2
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tempo de Geração: 13/03/2013 às 17h39min
-- Versão do Servidor: 5.1.56
-- Versão do PHP: 5.2.17

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Banco de Dados: `costaeca_bd_site`
--

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
(1, 1, 'Artini Lemos', 'artini@algconsultoria.com.br', '88de83fb9690409145af4039e43d7f03', '1', '2011-11-10 17:51:45'),
(4, 2, 'ALG Consultoria', 'suporte@algconsultoria.com.br', 'b49228b8fa98840355de71ec58f2d714', '1', '2011-11-13 03:05:22');

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=40 ;

--
-- Extraindo dados da tabela `usuario_area`
--

INSERT INTO `usuario_area` (`id_usuario_area`, `descricao`, `caminho`, `area_id`, `ordem`, `ativo`, `ultima_atualizacao`) VALUES
(1, 'Home', 'home.php', 0, 1, '1', '2011-11-10 14:56:41'),
(2, 'SeguranÃ§a', '', 0, 3, '1', '2013-03-13 17:36:08'),
(3, 'Ãreas do Sistema', 'seguranca/usuario_area/usuario_area_ndx.php', 2, 1, '1', '2013-03-13 17:36:28'),
(4, 'NÃ­veis de PermissÃ£o', 'seguranca/usuario_nivel/usuario_nivel_ndx.php', 2, 2, '1', '2013-03-13 17:36:48'),
(5, 'UsuÃ¡rio', 'seguranca/usuario/usuario_ndx.php', 2, 3, '1', '2013-03-13 17:37:04'),
(6, 'Sair', 'sair.php', 0, 4, '1', '2011-11-11 17:10:33'),
(7, 'Alterar Senha', 'seguranca/alterar_senha/alterar_senha_frm.php', 2, 4, '1', '2011-11-14 01:16:28'),
(24, 'Sistema', '', 0, 2, '1', '2011-11-14 12:19:26');

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
(2, 'Usuário');

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuario_nivel_lig_area`
--

CREATE TABLE IF NOT EXISTS `usuario_nivel_lig_area` (
  `id_usuario_nivel_lig_area` int(9) NOT NULL AUTO_INCREMENT,
  `id_usuario_nivel` int(3) NOT NULL,
  `id_usuario_area` int(3) NOT NULL,
  PRIMARY KEY (`id_usuario_nivel_lig_area`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=356 ;

--
-- Extraindo dados da tabela `usuario_nivel_lig_area`
--

INSERT INTO `usuario_nivel_lig_area` (`id_usuario_nivel_lig_area`, `id_usuario_nivel`, `id_usuario_area`) VALUES
(143, 2, 7),
(144, 2, 19),
(145, 2, 23),
(146, 2, 1),
(147, 2, 6),
(148, 2, 2),
(149, 2, 24),
(332, 1, 1),
(333, 1, 6),
(334, 1, 2),
(335, 1, 24),
(336, 1, 7),
(337, 1, 3),
(338, 1, 4),
(339, 1, 5),
(340, 1, 23),
(341, 1, 20),
(342, 1, 22),
(343, 1, 21),
(344, 1, 37),
(345, 1, 19),
(346, 1, 25),
(347, 1, 29),
(348, 1, 28),
(349, 1, 27),
(350, 1, 26),
(351, 1, 32),
(352, 1, 31),
(353, 1, 30),
(354, 1, 38),
(355, 1, 39);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
