-- phpMyAdmin SQL Dump
-- version 4.9.7
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Mar 27, 2022 at 06:04 PM
-- Server version: 5.6.41-84.1
-- PHP Version: 7.3.32

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: 'melho972_ranking'
--
CREATE DATABASE IF NOT EXISTS 'melho972_ranking' DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci;
USE 'melho972_ranking';

-- --------------------------------------------------------

--
-- Table structure for table 'avaliacoes'
--

CREATE TABLE 'avaliacoes' (
  'id' int(11) NOT NULL,
  'id_empresa' int(11) NOT NULL,
  'id_segmento' int(11) NOT NULL,
  'id_usuario' int(11) NOT NULL,
  'pontuacao' int(11) NOT NULL,
  'data_avaliacao' date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table 'avaliacoes'
--

INSERT INTO 'avaliacoes' ('id', 'id_empresa', 'id_segmento', 'id_usuario', 'pontuacao', 'data_avaliacao') VALUES
(1, 1, 1, 1, 3, '2022-03-16');

-- --------------------------------------------------------

--
-- Table structure for table 'carrossel'
--

CREATE TABLE 'carrossel' (
  'id' int(11) NOT NULL,
  'caminho' text COLLATE utf8_unicode_ci NOT NULL,
  'ativo' tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table 'carrossel'
--

INSERT INTO 'carrossel' ('id', 'caminho', 'ativo') VALUES
(5, 'uploads/carrossel/52f53e653c5e72469785970d268de9e0.jpg', 1);

-- --------------------------------------------------------

--
-- Table structure for table 'conteudo'
--

CREATE TABLE 'conteudo' (
  'id' int(11) NOT NULL,
  'local' varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  'conteudo' text COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table 'empresas'
--

CREATE TABLE 'empresas' (
  'id' int(11) NOT NULL,
  'nome' text COLLATE utf8_unicode_ci NOT NULL,
  'descricao' text COLLATE utf8_unicode_ci NOT NULL,
  'logo' text COLLATE utf8_unicode_ci NOT NULL,
  'id_segmento' int(11) NOT NULL,
  'endereco' text COLLATE utf8_unicode_ci NOT NULL,
  'telefone' varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  'data_cadastro' date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table 'empresas'
--

INSERT INTO 'empresas' ('id', 'nome', 'descricao', 'logo', 'id_segmento', 'endereco', 'telefone', 'data_cadastro') VALUES
(1, 'TETÊ Auto Peças', 'Latarias - faróis - lanternas - parachoques - suspensão - motor\r\nNACIONAIS e IMPORTADOS', 'uploads/dc9d907c5d615f16ef0cee0fe8cf4a61.jpg', 1, 'Av. Caruaru, 152 | Heliópolis | Garanhuns-PE', '(87) 3763-2110 | 99999-8238 (zap)', '2022-03-14'),
(2, 'MAURÍCIO Auto Peças', 'Chevrolet - Ford - Fiat - Volkswagen', 'uploads/41f04d82fbc0e677efc47ae4fc3bc4a7.jpg', 1, 'Av. Caruaru, 198 - Heliópolis, Garanhuns-PE', '(87) 3763-0972 | 99117-4466 | 99805-8280', '2022-03-15'),
(3, 'Caruá Escapamentos', 'NACIONAIS e IMPORTADOS', 'uploads/9fb392d92ef57ea0a61a25a36cc138bd.jpg', 1, 'Av. Caruaru, 217A, São José, Garanhuns-PE', '(87) 3761-4730 | 99805-8286', '2022-03-15'),
(4, 'EquipCar Equipadora e Auto Center', 'Solução em equipamentos automotivos', 'uploads/b5fd2dff963cafcbd560e9474922b758.jpg', 1, 'Av. Caruaru, 233, Heliópolis, Garanhuns-PE', '(87) 3763-1721', '2022-03-15'),
(5, 'DAROCHA Pneus', 'PNEUS, PEÇAS E SERVIÇOS\r\nGoodYear, Pirelli, Firestone, Bridgestone, Michelin', 'uploads/a0fb806f80d51f728f7c5cdc51856fb5.jpg', 1, 'Av. Caruaru, 221, Heliópolis, Garanhuns-PE', '(87) 3095-0491 | 3761-2121', '2022-03-15'),
(6, 'Fala Bicho Pet Center', 'Serviços de Petshop, tudo para seu animal de estimação, como: rações para gatos e cachorros, camas, roupas, brinquedos, acessórios, casinhas e toquinhas, arranhador para gatos, coleira, comedouro e bebedouro automático para gatos e cachorros, tapete higiênico, areia higiênica para gatos e muito mais para o bem estar do seu bichinho.', 'uploads/b05660c566874885a88a5d437a3108b9.jpg', 2, 'Praça Dom Pedro II, 625 - Boa Vista, Garanhuns - PE', '(87) 3761-7000', '2022-03-15');

-- --------------------------------------------------------

--
-- Table structure for table 'imagens'
--

CREATE TABLE 'imagens' (
  'id' int(11) NOT NULL,
  'titulo' text COLLATE utf8_unicode_ci NOT NULL,
  'caminho' text COLLATE utf8_unicode_ci NOT NULL,
  'data_upload' date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table 'imagens'
--

INSERT INTO 'imagens' ('id', 'titulo', 'caminho', 'data_upload') VALUES
(1, 'Tete.jpg', 'uploads/dc9d907c5d615f16ef0cee0fe8cf4a61.jpg', '2022-03-14'),
(2, 'MauricioAutoPecas.jpg', 'uploads/41f04d82fbc0e677efc47ae4fc3bc4a7.jpg', '2022-03-15'),
(3, 'CaruaEscapamentos.jpg', 'uploads/9fb392d92ef57ea0a61a25a36cc138bd.jpg', '2022-03-15'),
(4, 'EquipCar.jpg', 'uploads/b5fd2dff963cafcbd560e9474922b758.jpg', '2022-03-15'),
(5, 'DaRochaPneus.jpg', 'uploads/a0fb806f80d51f728f7c5cdc51856fb5.jpg', '2022-03-15'),
(6, 'FalaBicho.jpg', 'uploads/b05660c566874885a88a5d437a3108b9.jpg', '2022-03-15');

-- --------------------------------------------------------

--
-- Table structure for table 'segmentos'
--

CREATE TABLE 'segmentos' (
  'id' int(11) NOT NULL,
  'nome' text COLLATE utf8_unicode_ci NOT NULL,
  'data_cadastro' date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table 'segmentos'
--

INSERT INTO 'segmentos' ('id', 'nome', 'data_cadastro') VALUES
(1, 'auto peças', '2022-03-11'),
(2, 'petshops', '2022-03-11');

-- --------------------------------------------------------

--
-- Table structure for table 'usuarios'
--

CREATE TABLE 'usuarios' (
  'id' int(11) NOT NULL,
  'nome' text COLLATE utf8_unicode_ci NOT NULL,
  'telefone' varchar(12) COLLATE utf8_unicode_ci NOT NULL,
  'email' text COLLATE utf8_unicode_ci NOT NULL,
  'senha' varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  'cadastro' datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table 'usuarios'
--

INSERT INTO 'usuarios' ('id', 'nome', 'telefone', 'email', 'senha', 'cadastro') VALUES
(1, 'fábio veiga', '11953395785', 'fabio.veiga@live.com', 'ec037a8e2046799c67f6fbe663c3a041', '2022-03-11 00:00:00'),
(3, 'ysrael patrick do nascimento tavares', '83987297376', 'ysraeltavares33@gmail.com', '25d55ad283aa400af464c76d713c07ad', '2022-03-11 00:00:00'),
(4, 'maria kássia de souza alves', 'bbkassia@hot', 'bbkassia@hotmail.com', 'ec037a8e2046799c67f6fbe663c3a041', '2022-03-11 00:00:00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table 'avaliacoes'
--
ALTER TABLE 'avaliacoes'
  ADD PRIMARY KEY ('id');

--
-- Indexes for table 'carrossel'
--
ALTER TABLE 'carrossel'
  ADD PRIMARY KEY ('id');

--
-- Indexes for table 'conteudo'
--
ALTER TABLE 'conteudo'
  ADD PRIMARY KEY ('id');

--
-- Indexes for table 'empresas'
--
ALTER TABLE 'empresas'
  ADD PRIMARY KEY ('id');

--
-- Indexes for table 'imagens'
--
ALTER TABLE 'imagens'
  ADD PRIMARY KEY ('id');

--
-- Indexes for table 'segmentos'
--
ALTER TABLE 'segmentos'
  ADD PRIMARY KEY ('id');

--
-- Indexes for table 'usuarios'
--
ALTER TABLE 'usuarios'
  ADD PRIMARY KEY ('id');

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table 'avaliacoes'
--
ALTER TABLE 'avaliacoes'
  MODIFY 'id' int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table 'carrossel'
--
ALTER TABLE 'carrossel'
  MODIFY 'id' int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table 'conteudo'
--
ALTER TABLE 'conteudo'
  MODIFY 'id' int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table 'empresas'
--
ALTER TABLE 'empresas'
  MODIFY 'id' int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table 'imagens'
--
ALTER TABLE 'imagens'
  MODIFY 'id' int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table 'segmentos'
--
ALTER TABLE 'segmentos'
  MODIFY 'id' int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table 'usuarios'
--
ALTER TABLE 'usuarios'
  MODIFY 'id' int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
