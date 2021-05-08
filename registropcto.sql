-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: May 08, 2021 at 05:27 PM
-- Server version: 5.7.24
-- PHP Version: 7.2.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `registropcto`
--

-- --------------------------------------------------------

--
-- Table structure for table `appuntamento`
--

CREATE TABLE `appuntamento` (
  `ID` int(11) NOT NULL,
  `data` date NOT NULL,
  `ora` time DEFAULT NULL,
  `luogo` varchar(50) DEFAULT NULL,
  `premioOre` int(11) NOT NULL,
  `Corso` int(11) NOT NULL,
  `annoScolastico` varchar(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `appuntamento`
--

INSERT INTO `appuntamento` (`ID`, `data`, `ora`, `luogo`, `premioOre`, `Corso`, `annoScolastico`) VALUES
(1, '2021-05-01', '14:30:00', 'Scuola', 2, 2, '20202021');

-- --------------------------------------------------------

--
-- Table structure for table `attivato`
--

CREATE TABLE `attivato` (
  `Classe` int(11) NOT NULL,
  `Corso` int(11) NOT NULL,
  `annoScolastico` varchar(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `attivato`
--

INSERT INTO `attivato` (`Classe`, `Corso`, `annoScolastico`) VALUES
(5, 1, ''),
(10, 1, ''),
(15, 1, '');

-- --------------------------------------------------------

--
-- Table structure for table `classe`
--

CREATE TABLE `classe` (
  `ID` int(11) NOT NULL,
  `sezione` varchar(50) NOT NULL,
  `anno` int(11) NOT NULL,
  `Scuola` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `classe`
--

INSERT INTO `classe` (`ID`, `sezione`, `anno`, `Scuola`) VALUES
(1, 'E', 1, 1),
(2, 'E', 2, 1),
(3, 'E', 3, 1),
(4, 'E', 4, 1),
(5, 'E', 5, 1),
(6, 'F', 1, 1),
(7, 'F', 2, 1),
(8, 'F', 3, 1),
(9, 'F', 4, 1),
(10, 'F', 5, 1),
(11, 'G', 1, 1),
(12, 'G', 2, 1),
(13, 'G', 3, 1),
(14, 'G', 4, 1),
(15, 'G', 5, 1),
(77, 'A', 1, 2);

-- --------------------------------------------------------

--
-- Table structure for table `corso`
--

CREATE TABLE `corso` (
  `ID` int(11) NOT NULL,
  `nome` varchar(50) NOT NULL,
  `tutorEsterno` varchar(50) DEFAULT NULL,
  `foto` longblob,
  `monteOre` int(11) NOT NULL,
  `nPartecipantiMin` int(11) DEFAULT NULL,
  `nPartecipantiMax` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `corso`
--

INSERT INTO `corso` (`ID`, `nome`, `tutorEsterno`, `foto`, `monteOre`, `nPartecipantiMin`, `nPartecipantiMax`) VALUES
(1, 'Bigdata', 'Giacomo Ferrucci (docente UNISA)', NULL, 20, NULL, NULL),
(2, 'Trinity B1', 'Ferrara', NULL, 30, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `forma`
--

CREATE TABLE `forma` (
  `Classe` int(11) NOT NULL,
  `Utente` int(11) NOT NULL,
  `annoScolastico` varchar(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `forma`
--

INSERT INTO `forma` (`Classe`, `Utente`, `annoScolastico`) VALUES
(3, 1, '20182019'),
(4, 1, '20192020'),
(5, 1, '20202021');

-- --------------------------------------------------------

--
-- Table structure for table `iscritto`
--

CREATE TABLE `iscritto` (
  `Corso` int(11) NOT NULL,
  `Utente` int(11) NOT NULL,
  `annoScolastico` varchar(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `iscritto`
--

INSERT INTO `iscritto` (`Corso`, `Utente`, `annoScolastico`) VALUES
(2, 1, '20182019');

-- --------------------------------------------------------

--
-- Table structure for table `lavora`
--

CREATE TABLE `lavora` (
  `Scuola` int(11) NOT NULL,
  `Utente` int(11) NOT NULL,
  `annoScolastico` varchar(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `lavora`
--

INSERT INTO `lavora` (`Scuola`, `Utente`, `annoScolastico`) VALUES
(1, 2, '20182019'),
(1, 2, '20192020'),
(1, 2, '20202021');

-- --------------------------------------------------------

--
-- Table structure for table `presente`
--

CREATE TABLE `presente` (
  `Appuntamento` int(11) NOT NULL,
  `Utente` int(11) NOT NULL,
  `ore presente` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `profilo`
--

CREATE TABLE `profilo` (
  `codiceTProfilo` varchar(50) NOT NULL,
  `nome` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `profilo`
--

INSERT INTO `profilo` (`codiceTProfilo`, `nome`) VALUES
('exUt', 'ex utente attivo della scuola'),
('gSis', 'Gestore di sistema'),
('refPCTO', 'Referente PCTO'),
('Std', 'Studente');

-- --------------------------------------------------------

--
-- Table structure for table `scuola`
--

CREATE TABLE `scuola` (
  `ID` int(11) NOT NULL,
  `nome` varchar(50) NOT NULL,
  `regione` varchar(50) NOT NULL,
  `provincia` char(2) NOT NULL,
  `CAP` char(5) NOT NULL,
  `indirizzoMail` varchar(250) NOT NULL,
  `indirizzoPEC` varchar(250) DEFAULT NULL,
  `sitoWeb` varchar(50) DEFAULT NULL,
  `obiettivoOre` int(11) NOT NULL,
  `indirizzo` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `scuola`
--

INSERT INTO `scuola` (`ID`, `nome`, `regione`, `provincia`, `CAP`, `indirizzoMail`, `indirizzoPEC`, `sitoWeb`, `obiettivoOre`, `indirizzo`) VALUES
(1, 'Margherita Hack', 'CAMPANIA', 'SA', '84081', 'SAIS044009@istruzione.it', 'sais044009@pec.istruzione.it', 'https://www.iismargheritahackbaronissi.edu.it/', 150, 'VIA TRINITA'),
(2, 'ITT MINORI', 'CAMPANIA', 'SA', '84010', 'SAIS05600G@istruzione.it', NULL, 'marinigioia.it', 150, 'VIA SAN GIOVANNI A MARE'),
(3, 'GADDA LANGHIRANO PROFESSIONALE', 'EMILIA ROMAGNA', 'PR', '43013', 'PRIS00800P@istruzione.it', NULL, 'www.iissgadda.it', 200, 'VIA XXV APRILE 8');

-- --------------------------------------------------------

--
-- Table structure for table `tutorcorso`
--

CREATE TABLE `tutorcorso` (
  `Corso` int(11) NOT NULL,
  `Utente` int(11) NOT NULL,
  `annoScolastico` varchar(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `tutorpctoclasse`
--

CREATE TABLE `tutorpctoclasse` (
  `Classe` int(11) NOT NULL,
  `Utente` int(11) NOT NULL,
  `annoScolastico` varchar(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tutorpctoclasse`
--

INSERT INTO `tutorpctoclasse` (`Classe`, `Utente`, `annoScolastico`) VALUES
(5, 2, '20182019');

-- --------------------------------------------------------

--
-- Table structure for table `utente`
--

CREATE TABLE `utente` (
  `ID` int(11) NOT NULL,
  `nome` varchar(50) NOT NULL,
  `cognome` varchar(50) NOT NULL,
  `email` varchar(250) NOT NULL,
  `password` varchar(50) NOT NULL,
  `dataNascita` date NOT NULL,
  `luogoNascita` varchar(50) NOT NULL,
  `codiceFiscale` varchar(16) NOT NULL,
  `foto` longblob,
  `tipoProfilo` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `utente`
--

INSERT INTO `utente` (`ID`, `nome`, `cognome`, `email`, `password`, `dataNascita`, `luogoNascita`, `codiceFiscale`, `foto`, `tipoProfilo`) VALUES
(1, 'Massimo', 'Verdino', 'VM@gmail.com', 'Vm', '2002-11-07', 'Mercato san severino', 'VRDMSM02S07F138Z', NULL, 'Std'),
(2, 'Raffaele', 'Napoli', 'RF@gmail.com', 'RF', '1978-05-05', 'Salerno', 'NPLRFL78E05H703C', NULL, 'refPCTO'),
(3, 'Francesco', 'Deluigi', 'FD@gmail.com', 'FD', '1998-06-08', 'Mercato san severino', 'DLGFNC98M05F138R', NULL, 'exUt'),
(4, 'admin', 'admin', 'admin', 'admin', '2021-05-08', 'admin', 'admin', NULL, 'gSis');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `appuntamento`
--
ALTER TABLE `appuntamento`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `Corso` (`Corso`);

--
-- Indexes for table `attivato`
--
ALTER TABLE `attivato`
  ADD KEY `Classe` (`Classe`),
  ADD KEY `Corso` (`Corso`);

--
-- Indexes for table `classe`
--
ALTER TABLE `classe`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `classe_ibfk_2` (`Scuola`);

--
-- Indexes for table `corso`
--
ALTER TABLE `corso`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `forma`
--
ALTER TABLE `forma`
  ADD KEY `Classe` (`Classe`),
  ADD KEY `Utente` (`Utente`);

--
-- Indexes for table `iscritto`
--
ALTER TABLE `iscritto`
  ADD KEY `Corso` (`Corso`),
  ADD KEY `Utente` (`Utente`);

--
-- Indexes for table `lavora`
--
ALTER TABLE `lavora`
  ADD KEY `Scuola` (`Scuola`),
  ADD KEY `Utente` (`Utente`);

--
-- Indexes for table `presente`
--
ALTER TABLE `presente`
  ADD KEY `Appuntamento` (`Appuntamento`),
  ADD KEY `Utente` (`Utente`);

--
-- Indexes for table `profilo`
--
ALTER TABLE `profilo`
  ADD PRIMARY KEY (`codiceTProfilo`);

--
-- Indexes for table `scuola`
--
ALTER TABLE `scuola`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `tutorcorso`
--
ALTER TABLE `tutorcorso`
  ADD KEY `Corso` (`Corso`),
  ADD KEY `Utente` (`Utente`);

--
-- Indexes for table `tutorpctoclasse`
--
ALTER TABLE `tutorpctoclasse`
  ADD KEY `Classe` (`Classe`),
  ADD KEY `Utente` (`Utente`);

--
-- Indexes for table `utente`
--
ALTER TABLE `utente`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `TProfilo` (`tipoProfilo`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `appuntamento`
--
ALTER TABLE `appuntamento`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `classe`
--
ALTER TABLE `classe`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=78;

--
-- AUTO_INCREMENT for table `corso`
--
ALTER TABLE `corso`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `scuola`
--
ALTER TABLE `scuola`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `utente`
--
ALTER TABLE `utente`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `appuntamento`
--
ALTER TABLE `appuntamento`
  ADD CONSTRAINT `appuntamento_ibfk_1` FOREIGN KEY (`Corso`) REFERENCES `corso` (`ID`);

--
-- Constraints for table `attivato`
--
ALTER TABLE `attivato`
  ADD CONSTRAINT `attivato_ibfk_1` FOREIGN KEY (`Classe`) REFERENCES `classe` (`ID`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `attivato_ibfk_2` FOREIGN KEY (`Corso`) REFERENCES `corso` (`ID`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Constraints for table `classe`
--
ALTER TABLE `classe`
  ADD CONSTRAINT `classe_ibfk_2` FOREIGN KEY (`Scuola`) REFERENCES `scuola` (`ID`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Constraints for table `forma`
--
ALTER TABLE `forma`
  ADD CONSTRAINT `forma_ibfk_1` FOREIGN KEY (`Classe`) REFERENCES `classe` (`ID`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `forma_ibfk_2` FOREIGN KEY (`Utente`) REFERENCES `utente` (`ID`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Constraints for table `iscritto`
--
ALTER TABLE `iscritto`
  ADD CONSTRAINT `iscritto_ibfk_1` FOREIGN KEY (`Corso`) REFERENCES `corso` (`ID`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `iscritto_ibfk_2` FOREIGN KEY (`Utente`) REFERENCES `utente` (`ID`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Constraints for table `lavora`
--
ALTER TABLE `lavora`
  ADD CONSTRAINT `lavora_ibfk_1` FOREIGN KEY (`Scuola`) REFERENCES `scuola` (`ID`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `lavora_ibfk_2` FOREIGN KEY (`Utente`) REFERENCES `utente` (`ID`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Constraints for table `presente`
--
ALTER TABLE `presente`
  ADD CONSTRAINT `presente_ibfk_1` FOREIGN KEY (`Appuntamento`) REFERENCES `appuntamento` (`ID`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `presente_ibfk_2` FOREIGN KEY (`Utente`) REFERENCES `utente` (`ID`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Constraints for table `tutorcorso`
--
ALTER TABLE `tutorcorso`
  ADD CONSTRAINT `tutorcorso_ibfk_1` FOREIGN KEY (`Corso`) REFERENCES `corso` (`ID`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `tutorcorso_ibfk_2` FOREIGN KEY (`Utente`) REFERENCES `utente` (`ID`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Constraints for table `tutorpctoclasse`
--
ALTER TABLE `tutorpctoclasse`
  ADD CONSTRAINT `tutorpctoclasse_ibfk_1` FOREIGN KEY (`Classe`) REFERENCES `classe` (`ID`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `tutorpctoclasse_ibfk_2` FOREIGN KEY (`Utente`) REFERENCES `utente` (`ID`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Constraints for table `utente`
--
ALTER TABLE `utente`
  ADD CONSTRAINT `utente_ibfk_1` FOREIGN KEY (`tipoProfilo`) REFERENCES `profilo` (`codiceTProfilo`) ON DELETE NO ACTION ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
