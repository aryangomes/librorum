-- phpMyAdmin SQL Dump
-- version 4.5.2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: 30-Jul-2016 às 21:17
-- Versão do servidor: 10.1.10-MariaDB
-- PHP Version: 5.6.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `librorum`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `auth_item`
--

CREATE TABLE `auth_item` (
  `name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `type` int(11) NOT NULL,
  `description` text COLLATE utf8_unicode_ci,
  `rule_name` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL,
  `data` text COLLATE utf8_unicode_ci,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `auth_item`
--

INSERT INTO `auth_item` (`name`, `type`, `description`, `rule_name`, `data`, `created_at`, `updated_at`) VALUES
('acervo', 3, 'Acervo', NULL, NULL, NULL, NULL),
('acervo-exemplar', 5, 'Exemplar do Acervo', NULL, NULL, NULL, NULL),
('admin', 1, 'Administrador', NULL, NULL, NULL, NULL),
('aquisicao', 6, 'Aquisição', NULL, NULL, NULL, NULL),
('categoria-acervo', 7, 'Categoria do Acervo', NULL, NULL, NULL, NULL),
('config', 8, 'Configurações do Sistema', NULL, NULL, NULL, NULL),
('emprestimo', 2, 'Empréstimo', NULL, NULL, NULL, NULL),
('pessoa', 9, 'Pessoa', NULL, NULL, NULL, NULL),
('pessoa-fisica', 10, 'Pessoa Física', NULL, NULL, NULL, NULL),
('pessoa-juridica', 11, 'Pessoa Jurídica', NULL, NULL, NULL, NULL),
('situacao-usuario', 12, 'Situação do Usuário', NULL, NULL, NULL, NULL),
('tipo-aquisicao', 13, 'Tipo de Aquisição', NULL, NULL, NULL, NULL),
('tipo-material', 14, 'Tipo do Material', NULL, NULL, NULL, NULL),
('usuario', 4, 'Usuário', NULL, NULL, NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `auth_item`
--
ALTER TABLE `auth_item`
  ADD PRIMARY KEY (`name`),
  ADD KEY `rule_name` (`rule_name`),
  ADD KEY `idx-auth_item-type` (`type`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `auth_item`
--
ALTER TABLE `auth_item`
  MODIFY `type` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
--
-- Constraints for dumped tables
--

--
-- Limitadores para a tabela `auth_item`
--
ALTER TABLE `auth_item`
  ADD CONSTRAINT `auth_item_ibfk_1` FOREIGN KEY (`rule_name`) REFERENCES `auth_rule` (`name`) ON DELETE SET NULL ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
