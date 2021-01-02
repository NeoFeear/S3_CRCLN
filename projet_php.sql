-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  sam. 02 jan. 2021 à 19:58
-- Version du serveur :  10.4.10-MariaDB
-- Version de PHP :  7.3.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `projet_php`
--

-- --------------------------------------------------------

--
-- Structure de la table `news`
--

DROP TABLE IF EXISTS `news`;
CREATE TABLE IF NOT EXISTS `news` (
  `idnews` int(11) NOT NULL AUTO_INCREMENT,
  `idtheme` int(11) NOT NULL,
  `titrenews` varchar(255) NOT NULL,
  `datenews` date NOT NULL,
  `textenews` varchar(5000) NOT NULL,
  `idredacteur` int(11) NOT NULL,
  PRIMARY KEY (`idnews`),
  KEY `idtheme` (`idtheme`),
  KEY `idredacteur` (`idredacteur`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `news`
--

INSERT INTO `news` (`idnews`, `idtheme`, `titrenews`, `datenews`, `textenews`, `idredacteur`) VALUES
(1, 1, 'Sortie PS5', '2020-11-06', ' La Playstation 5, ou PS5, est la prochaine gÃ©nÃ©ration de console de Sony, aprÃ¨s la PS4 sortie en 2013. AnnoncÃ©e en juin 2020, elle sera disponible le 19 novembre 2020 Ã  partir de 399 euros.', 1),
(2, 1, 'Xbox Series X|S', '2020-11-06', ' La Xbox Series X est la nouvelle gÃ©nÃ©ration de console Xbox par Microsoft, aprÃ¨s la Xbox One. Elle a Ã©tÃ© prÃ©sentÃ©e le 12 dÃ©cembre 2019 et doit sortir, comme sa rivale la PS5, pour les fÃªtes de fin d\'annÃ©e.', 1),
(3, 2, 'Sacai x Nike Vaporwaffle Black White', '2020-11-06', 'Ce nouveau design hybride, qui sâ€™inspire des Pegasus Vaporfly et des Pegasus Vaporwaffle, est pourvu dâ€™une empeigne en mesh noir et de superpositions en suÃ¨de et en cuir assorties. Lâ€™ensemble est rehaussÃ© par de nombreux accents blancs que l\'on retrouve au niveau des Ã©lÃ©ments doublÃ©s comme le swoosh latÃ©ral, les lacets et la semelle incurvÃ©e. Des co-brandings apposÃ©s sur la languette et le talon apportent la touche finale.\r\n\r\nCette nouvelle sacai x Nike Vaporwaffle Black White devrait sortir le 6 novembre Nike.com et chez certains dÃ©taillants sÃ©lectionnÃ©s, au prix de 180â‚¬.', 1),
(4, 3, 'PrÃ©sidentielle amÃ©ricaine', '2020-11-07', ' AprÃ¨s plusieurs jours dâ€™attente, on connaÃ®t enfin le nom du nouveau prÃ©sident des Ã‰tats-Unis. Il sâ€™agit de Joe Biden, le candidat dÃ©mocrate. Cette victoire marque un tournant historique pour les Ã‰tats-Unis, aprÃ¨s quatre annÃ©es de rupture sous le prÃ©sident rÃ©publicain Donald Trump.', 2);

-- --------------------------------------------------------

--
-- Structure de la table `redacteur`
--

DROP TABLE IF EXISTS `redacteur`;
CREATE TABLE IF NOT EXISTS `redacteur` (
  `idredacteur` int(11) NOT NULL AUTO_INCREMENT,
  `nom` varchar(255) NOT NULL,
  `prenom` varchar(255) NOT NULL,
  `adresse_email` varchar(255) NOT NULL,
  `motdepasse` varchar(255) NOT NULL,
  PRIMARY KEY (`idredacteur`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `redacteur`
--

INSERT INTO `redacteur` (`idredacteur`, `nom`, `prenom`, `adresse_email`, `motdepasse`) VALUES
(1, 'Martin', 'Florian', 'test@gmail.com', '782dd27ea8e3b4f4095ffa38eeb4d20b59069077'),
(2, 'Dussaussois', 'Tom', 'tom.duss@outlook.fr', '940c0f26fd5a30775bb1cbd1f6840398d39bb813');

-- --------------------------------------------------------

--
-- Structure de la table `theme`
--

DROP TABLE IF EXISTS `theme`;
CREATE TABLE IF NOT EXISTS `theme` (
  `idtheme` int(11) NOT NULL AUTO_INCREMENT,
  `description` varchar(5000) NOT NULL,
  PRIMARY KEY (`idtheme`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `theme`
--

INSERT INTO `theme` (`idtheme`, `description`) VALUES
(1, 'High Tech'),
(2, 'LifeStyle'),
(3, 'Politique');

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `news`
--
ALTER TABLE `news`
  ADD CONSTRAINT `idredacteur` FOREIGN KEY (`idredacteur`) REFERENCES `redacteur` (`idredacteur`),
  ADD CONSTRAINT `idtheme` FOREIGN KEY (`idtheme`) REFERENCES `theme` (`idtheme`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
