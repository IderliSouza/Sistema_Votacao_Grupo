-- phpMyAdmin SQL Dump
-- version 4.8.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 09, 2018 at 04:05 AM
-- Server version: 10.1.32-MariaDB
-- PHP Version: 7.2.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `rpvig3bd`
--

-- --------------------------------------------------------

--
-- Table structure for table `itempauta`
--

CREATE TABLE `itempauta` (
  `idItem` int(11) NOT NULL,
  `nomeItem` varchar(250) DEFAULT NULL,
  `descricaoItem` varchar(250) DEFAULT NULL,
  `idReuniao` int(11) NOT NULL,
  `idRelator` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `itempauta`
--

INSERT INTO `itempauta` (`idItem`, `nomeItem`, `descricaoItem`, `idReuniao`, `idRelator`) VALUES
(1, 'Solicitação de Horário Especial 2015/2 de Rodrigo Luiz Ludwig', 'Descrição do Item de Pauta', 1, 3),
(2, 'Alterações no PPC do curso de Engenharia Elétrica', 'Descrição do Item de Pauta', 1, 3),
(3, 'Homologação de novas CCCGs do curso de Engenharia de Telecomunicações', 'Descrição do Item de Pauta', 1, 3),
(4, 'Criação de disciplinas do PPEng', 'Descrição do Item de Pauta', 1, 3),
(5, 'Solicitação de Horário Especial 2015/2 para Flávia Covalesky', 'Descrição do Item de Pauta', 1, 3),
(6, 'Alterações no PPC do curso de Engenharia de Software', 'Descrição do Item de Pauta', 2, 1),
(7, 'Análise de disciplina nova do PPGEE', 'Descrição do Item de Pauta', 2, 1),
(8, 'Perfis do concurso para professor substituto do Curso de Engenharia Agrícola', 'Descrição do Item de Pauta', 2, 1),
(9, 'Análise do perfil para concurso de professor efetivo da Ciência da Computação', 'Descrição do Item de Pauta', 2, 1),
(10, 'Solicitação de Horário Especial 2015/2 para Bruno Oliveira', 'Descrição do Item de Pauta', 2, 1),
(11, 'Solicitação de Horário Especial 2015/2 de Luci Annee Vargas Carneiro', 'Descrição do Item de Pauta', 3, 2),
(12, 'Descredenciamento de Cristiano Ferreira do PPEng', 'Descrição do Item de Pauta', 3, 2),
(13, 'Modificação do Regimento do PPEng', 'Descrição do Item de Pauta', 3, 2),
(14, 'Inclusão de CCCGs no PPC do Curso de Engenharia Civil', 'Descrição do Item de Pauta', 3, 2),
(15, 'Alteração de Situação de CCCGs do PPC do Curso de Engenharia Civil', 'Descrição do Item de Pauta', 3, 2);

-- --------------------------------------------------------

--
-- Table structure for table `membro`
--

CREATE TABLE `membro` (
  `idMembro` int(11) NOT NULL,
  `nomeMembro` varchar(250) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `membro`
--

INSERT INTO `membro` (`idMembro`, `nomeMembro`) VALUES
(1, 'luiz'),
(2, 'bruno'),
(3, 'gustavo'),
(4, 'iderli'),
(5, 'jp'),
(6, 'tolfo');

-- --------------------------------------------------------

--
-- Table structure for table `membroreuniao`
--

CREATE TABLE `membroreuniao` (
  `idReuniao` int(11) NOT NULL,
  `idMembro` int(11) NOT NULL,
  `estadoMembro` tinyint(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `opcoesvoto`
--

CREATE TABLE `opcoesvoto` (
  `idOpcao` int(11) NOT NULL,
  `descricao` varchar(250) DEFAULT NULL,
  `idItem` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `relator`
--

CREATE TABLE `relator` (
  `idRelator` int(11) NOT NULL,
  `nomeRelator` varchar(250) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `relator`
--

INSERT INTO `relator` (`idRelator`, `nomeRelator`) VALUES
(1, 'Jean Cheiran'),
(2, 'Gustavo Santiago'),
(3, 'Marcia Cera');

-- --------------------------------------------------------

--
-- Table structure for table `reuniao`
--

CREATE TABLE `reuniao` (
  `idReuniao` int(11) NOT NULL,
  `nomeReuniao` varchar(250) DEFAULT NULL,
  `tipoReuniao` varchar(250) DEFAULT NULL,
  `salaReuniao` varchar(250) DEFAULT NULL,
  `comissaoReuniao` varchar(250) DEFAULT NULL,
  `estadoReuniao` tinyint(2) NOT NULL,
  `dataReuniao` date DEFAULT NULL,
  `horaComecoReuniao` time DEFAULT NULL,
  `horaFinalReuniao` time DEFAULT NULL,
  `idModerador` int(11) NOT NULL,
  `idSecretario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `reuniao`
--

INSERT INTO `reuniao` (`idReuniao`, `nomeReuniao`, `tipoReuniao`, `salaReuniao`, `comissaoReuniao`, `estadoReuniao`, `dataReuniao`, `horaComecoReuniao`, `horaFinalReuniao`, `idModerador`, `idSecretario`) VALUES
(1, '1º Reunião', 'Ordinária', 'Sala 234', 'Comissão Local de Ensino', 1, '2018-12-09', '00:00:00', '23:59:57', 5, 0),
(2, '2º Reunião', 'Ordinária', 'Sala 101', 'Comissão Local de Ensino', 0, '2018-10-27', '09:30:00', '10:30:00', 5, 6),
(3, '3º Reunião', 'Ordinária', 'Sala 205', 'Comissão Local de Ensino', 0, '2018-10-06', '17:45:00', '19:00:00', 6, 0),
(4, '4º Reunião', 'Ordinária', 'Sala 311', 'Comissão Local de Ensino', 0, '2018-11-10', '14:00:00', '15:00:00', 0, 6),
(5, '5º Reunião', 'Ordinária', 'Sala 302', 'Comissão Local de Ensino', 0, '2018-12-01', '09:00:00', '11:00:00', 0, 6);

-- --------------------------------------------------------

--
-- Table structure for table `votacao`
--

CREATE TABLE `votacao` (
  `idVotacao` int(11) NOT NULL,
  `tipo` varchar(250) DEFAULT NULL,
  `vencedor` varchar(250) DEFAULT NULL,
  `estadoVotacao` tinyint(4) DEFAULT NULL,
  `segundoTurno` tinyint(4) DEFAULT NULL,
  `idItem` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `voto`
--

CREATE TABLE `voto` (
  `idOpcao` int(11) NOT NULL,
  `idMembro` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `itempauta`
--
ALTER TABLE `itempauta`
  ADD PRIMARY KEY (`idItem`,`idReuniao`,`idRelator`),
  ADD KEY `fk_ItemPauta_Reuniao1_idx` (`idReuniao`),
  ADD KEY `fk_ItemPauta_Relator1_idx` (`idRelator`);

--
-- Indexes for table `membro`
--
ALTER TABLE `membro`
  ADD PRIMARY KEY (`idMembro`);

--
-- Indexes for table `membroreuniao`
--
ALTER TABLE `membroreuniao`
  ADD PRIMARY KEY (`idReuniao`,`idMembro`),
  ADD KEY `fk_Reuniao_has_Membro_Membro1_idx` (`idMembro`),
  ADD KEY `fk_Reuniao_has_Membro_Reuniao1_idx` (`idReuniao`);

--
-- Indexes for table `opcoesvoto`
--
ALTER TABLE `opcoesvoto`
  ADD PRIMARY KEY (`idOpcao`,`idItem`),
  ADD KEY `fk_opcoesVoto_ItemPauta1_idx` (`idItem`);

--
-- Indexes for table `relator`
--
ALTER TABLE `relator`
  ADD PRIMARY KEY (`idRelator`);

--
-- Indexes for table `reuniao`
--
ALTER TABLE `reuniao`
  ADD PRIMARY KEY (`idReuniao`);

--
-- Indexes for table `votacao`
--
ALTER TABLE `votacao`
  ADD PRIMARY KEY (`idVotacao`,`idItem`),
  ADD KEY `fk_Votacao_ItemPauta_idx` (`idItem`);

--
-- Indexes for table `voto`
--
ALTER TABLE `voto`
  ADD PRIMARY KEY (`idOpcao`,`idMembro`),
  ADD KEY `fk_opcoesVoto_has_Membro_Membro1_idx` (`idMembro`),
  ADD KEY `fk_opcoesVoto_has_Membro_opcoesVoto1_idx` (`idOpcao`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `itempauta`
--
ALTER TABLE `itempauta`
  MODIFY `idItem` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `membro`
--
ALTER TABLE `membro`
  MODIFY `idMembro` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `opcoesvoto`
--
ALTER TABLE `opcoesvoto`
  MODIFY `idOpcao` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `relator`
--
ALTER TABLE `relator`
  MODIFY `idRelator` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `reuniao`
--
ALTER TABLE `reuniao`
  MODIFY `idReuniao` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `votacao`
--
ALTER TABLE `votacao`
  MODIFY `idVotacao` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `itempauta`
--
ALTER TABLE `itempauta`
  ADD CONSTRAINT `fk_ItemPauta_Relator1` FOREIGN KEY (`idRelator`) REFERENCES `relator` (`idRelator`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_ItemPauta_Reuniao1` FOREIGN KEY (`idReuniao`) REFERENCES `reuniao` (`idReuniao`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `membroreuniao`
--
ALTER TABLE `membroreuniao`
  ADD CONSTRAINT `fk_Reuniao_has_Membro_Membro1` FOREIGN KEY (`idMembro`) REFERENCES `membro` (`idMembro`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_Reuniao_has_Membro_Reuniao1` FOREIGN KEY (`idReuniao`) REFERENCES `reuniao` (`idReuniao`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `opcoesvoto`
--
ALTER TABLE `opcoesvoto`
  ADD CONSTRAINT `fk_opcoesVoto_ItemPauta1` FOREIGN KEY (`idItem`) REFERENCES `itempauta` (`idItem`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `votacao`
--
ALTER TABLE `votacao`
  ADD CONSTRAINT `fk_Votacao_ItemPauta` FOREIGN KEY (`idItem`) REFERENCES `itempauta` (`idItem`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `voto`
--
ALTER TABLE `voto`
  ADD CONSTRAINT `fk_opcoesVoto_has_Membro_Membro1` FOREIGN KEY (`idMembro`) REFERENCES `membro` (`idMembro`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_opcoesVoto_has_Membro_opcoesVoto1` FOREIGN KEY (`idOpcao`) REFERENCES `opcoesvoto` (`idOpcao`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
