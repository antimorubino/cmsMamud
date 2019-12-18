-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Creato il: Dic 18, 2019 alle 15:37
-- Versione del server: 10.1.38-MariaDB
-- Versione PHP: 7.3.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cms2ld`
--

-- --------------------------------------------------------

--
-- Struttura della tabella `cld_catgalleria`
--

CREATE TABLE `cld_catgalleria` (
  `idCategoria` int(100) NOT NULL,
  `categoriaIT` varchar(255) DEFAULT NULL,
  `categoriaEN` varchar(255) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dump dei dati per la tabella `cld_catgalleria`
--

INSERT INTO `cld_catgalleria` (`idCategoria`, `categoriaIT`, `categoriaEN`) VALUES
(2, 'prova test', 'dfgfdgdfgfd'),
(3, 'hjjfghdfgdgdf', 'hjjfghdfgdgdf');

-- --------------------------------------------------------

--
-- Struttura della tabella `cld_contenuti`
--

CREATE TABLE `cld_contenuti` (
  `idContenuto` int(100) NOT NULL,
  `titoloIT` varchar(255) DEFAULT NULL,
  `titoloEN` varchar(255) DEFAULT NULL,
  `contenutoIT` text,
  `contenutoEN` text
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dump dei dati per la tabella `cld_contenuti`
--

INSERT INTO `cld_contenuti` (`idContenuto`, `titoloIT`, `titoloEN`, `contenutoIT`, `contenutoEN`) VALUES
(1, 'Home', 'Home', NULL, NULL),
(2, 'Azienda', 'Company', NULL, NULL),
(3, 'Servizi', 'Services', NULL, NULL),
(4, 'Contatti', 'Contacts', NULL, NULL);

-- --------------------------------------------------------

--
-- Struttura della tabella `cld_galleria`
--

CREATE TABLE `cld_galleria` (
  `idGalleria` int(100) NOT NULL,
  `idCategoria` int(100) NOT NULL,
  `Img` varchar(255) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dump dei dati per la tabella `cld_galleria`
--

INSERT INTO `cld_galleria` (`idGalleria`, `idCategoria`, `Img`) VALUES
(1, 2, 'DSC_1557.jpg'),
(2, 2, 'DSC_1568.jpg');

-- --------------------------------------------------------

--
-- Struttura della tabella `cld_galleria_imp`
--

CREATE TABLE `cld_galleria_imp` (
  `idGalleria` int(100) NOT NULL,
  `idCategoria` int(100) NOT NULL,
  `titoloIT` varchar(255) DEFAULT NULL,
  `immagine` varchar(255) DEFAULT NULL,
  `titoloEN` varchar(255) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struttura della tabella `cld_news`
--

CREATE TABLE `cld_news` (
  `idNews` int(100) NOT NULL,
  `Data` date NOT NULL,
  `TitoloIT` varchar(255) DEFAULT NULL,
  `TitoloEN` varchar(255) DEFAULT NULL,
  `ContenutoIT` text,
  `ContenutoEN` text,
  `Immagine` varchar(255) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dump dei dati per la tabella `cld_news`
--

INSERT INTO `cld_news` (`idNews`, `Data`, `TitoloIT`, `TitoloEN`, `ContenutoIT`, `ContenutoEN`, `Immagine`) VALUES
(17, '2019-12-26', 'hfghr', 'hfghr', 'dfgdgdgd', 'dfgdgdgd', 'DSC_1599.jpg'),
(15, '2019-12-18', 'dfsdfs', 'dfsdfs', 'fdgdsfadfafsg', 'fdgdsfadfafsg', 'it'),
(16, '2019-12-25', 'ddfgfd', 'ddfgfd', 'dgfsgsdfs', 'dgfsgsdfs', NULL);

-- --------------------------------------------------------

--
-- Struttura della tabella `cld_utenti`
--

CREATE TABLE `cld_utenti` (
  `idUtente` int(100) NOT NULL,
  `Username` varchar(255) NOT NULL,
  `Password` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dump dei dati per la tabella `cld_utenti`
--

INSERT INTO `cld_utenti` (`idUtente`, `Username`, `Password`) VALUES
(2, 'admin', 'f54b2804816eba663fac186dc9cb5436');

-- --------------------------------------------------------

--
-- Struttura della tabella `cld_video`
--

CREATE TABLE `cld_video` (
  `idVideo` int(11) NOT NULL,
  `TitoloIT` varchar(255) NOT NULL,
  `TitoloEN` varchar(255) DEFAULT NULL,
  `LinkUrl` varchar(255) NOT NULL,
  `LinkImg` varchar(255) DEFAULT NULL,
  `Sorgente` int(100) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dump dei dati per la tabella `cld_video`
--

INSERT INTO `cld_video` (`idVideo`, `TitoloIT`, `TitoloEN`, `LinkUrl`, `LinkImg`, `Sorgente`) VALUES
(26, 'dfgdf', 'hhgf', 'https://www.youtube.com/watch?v=DmTD3mDCqcQ', 'DSC_1535.jpg', 1),
(25, 'dgfd', 'dfgdf', 'https://www.youtube.com/watch?v=EFO-jEenE7A', 'DSC_1526.jpg', 1),
(23, 'gdfg', NULL, 'https://www.youtube.com/watch?v=sChj3lNnclk', 'DSC_1536.jpg', 1);

--
-- Indici per le tabelle scaricate
--

--
-- Indici per le tabelle `cld_catgalleria`
--
ALTER TABLE `cld_catgalleria`
  ADD PRIMARY KEY (`idCategoria`);

--
-- Indici per le tabelle `cld_contenuti`
--
ALTER TABLE `cld_contenuti`
  ADD PRIMARY KEY (`idContenuto`);

--
-- Indici per le tabelle `cld_galleria`
--
ALTER TABLE `cld_galleria`
  ADD PRIMARY KEY (`idGalleria`);

--
-- Indici per le tabelle `cld_galleria_imp`
--
ALTER TABLE `cld_galleria_imp`
  ADD PRIMARY KEY (`idGalleria`);

--
-- Indici per le tabelle `cld_news`
--
ALTER TABLE `cld_news`
  ADD PRIMARY KEY (`idNews`);

--
-- Indici per le tabelle `cld_utenti`
--
ALTER TABLE `cld_utenti`
  ADD PRIMARY KEY (`idUtente`);

--
-- Indici per le tabelle `cld_video`
--
ALTER TABLE `cld_video`
  ADD PRIMARY KEY (`idVideo`);

--
-- AUTO_INCREMENT per le tabelle scaricate
--

--
-- AUTO_INCREMENT per la tabella `cld_catgalleria`
--
ALTER TABLE `cld_catgalleria`
  MODIFY `idCategoria` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT per la tabella `cld_contenuti`
--
ALTER TABLE `cld_contenuti`
  MODIFY `idContenuto` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT per la tabella `cld_galleria`
--
ALTER TABLE `cld_galleria`
  MODIFY `idGalleria` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT per la tabella `cld_galleria_imp`
--
ALTER TABLE `cld_galleria_imp`
  MODIFY `idGalleria` int(100) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT per la tabella `cld_news`
--
ALTER TABLE `cld_news`
  MODIFY `idNews` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT per la tabella `cld_utenti`
--
ALTER TABLE `cld_utenti`
  MODIFY `idUtente` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT per la tabella `cld_video`
--
ALTER TABLE `cld_video`
  MODIFY `idVideo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
