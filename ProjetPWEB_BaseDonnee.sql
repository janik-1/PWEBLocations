-- phpMyAdmin SQL Dump
-- version 4.5.4.1
-- http://www.phpmyadmin.net
--
-- Client :  localhost
-- Généré le :  Jeu 12 Novembre 2020 à 14:24
-- Version du serveur :  5.7.11
-- Version de PHP :  7.0.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `test`
--

-- --------------------------------------------------------

--
-- Structure de la table `client`
--

CREATE TABLE `client` (
  `id_client` int(11) NOT NULL,
  `nom` text COLLATE utf8_bin NOT NULL,
  `email` text COLLATE utf8_bin NOT NULL,
  `mdp` text COLLATE utf8_bin NOT NULL,
  `type` text COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Contenu de la table `client`
--

INSERT INTO `client` (`id_client`, `nom`, `email`, `mdp`, `type`) VALUES
(1, 'Tim', 'timleloueur@mail.fr', '93977c11f9fc544557542be72d7218c75e3c56d6', 'loue'),
(2, 'George', 'Georgeabo@mail.fr', '3bb368009316d15ee9f3499f5d614590486f2235', 'EA');

-- --------------------------------------------------------

--
-- Structure de la table `facturation`
--

CREATE TABLE `facturation` (
  `id_facturation` int(11) NOT NULL,
  `ide` int(11) NOT NULL,
  `idv` int(11) NOT NULL,
  `dateD` date NOT NULL,
  `dateF` date NOT NULL,
  `valeur` int(11) NOT NULL,
  `etat` char(1) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Contenu de la table `facturation`
--

INSERT INTO `facturation` (`id_facturation`, `ide`, `idv`, `dateD`, `dateF`, `valeur`, `etat`) VALUES
(1, 2, 6, '2021-01-05', '2021-01-26', 4422, 'N');

-- --------------------------------------------------------

--
-- Structure de la table `vehicule`
--

CREATE TABLE `vehicule` (
  `id_vehicule` int(11) NOT NULL,
  `nb` int(11) NOT NULL,
  `type` text CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `caract` text CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `location` text CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `photo` text CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `prix` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `vehicule`
--

INSERT INTO `vehicule` (`id_vehicule`, `nb`, `type`, `caract`, `location`, `photo`, `prix`) VALUES
(1, 2, 'Mercedes', '{"moteur":"sansPlomb", "boite":"automatique","nbPortes":3}', 'disponible', 'merco-classe-s.jpg', 50),
(2, 5, 'Clio V', '{"moteur":"sansPlomb", "boite":"automatique","nbPortes":3}', 'Disponible', 'renault-clio-V.png', 40),
(3, 19, 'Audi RS6', '{"moteur":"sansPlomb", "boite":"automatique","nbPortes":4}', 'Disponible', 'audi_rs6.jpg', 30),
(4, 9, 'BMW X6', '{"moteur":"sansPlomb", "boite":"automatique","nbPortes":3}', 'Disponible', 'bmw-x6.jpg', 25),
(5, 25, 'Porsche 911', '{"moteur":"sansPlomb", "boite":"automatique","nbPortes":4}', 'Disponible', 'porsche-911.jpg', 86),
(6, 24, 'Bentley', '{"moteur":"sansPlomb", "boite":"automatique","nbPortes":4}', '2', 'bentley-gt-v8.jpg', 201);

--
-- Index pour les tables exportées
--

--
-- Index pour la table `client`
--
ALTER TABLE `client`
  ADD PRIMARY KEY (`id_client`);

--
-- Index pour la table `facturation`
--
ALTER TABLE `facturation`
  ADD PRIMARY KEY (`id_facturation`),
  ADD KEY `fk_ide` (`ide`),
  ADD KEY `fk_idv` (`idv`);

--
-- Index pour la table `vehicule`
--
ALTER TABLE `vehicule`
  ADD PRIMARY KEY (`id_vehicule`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `client`
--
ALTER TABLE `client`
  MODIFY `id_client` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT pour la table `facturation`
--
ALTER TABLE `facturation`
  MODIFY `id_facturation` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT pour la table `vehicule`
--
ALTER TABLE `vehicule`
  MODIFY `id_vehicule` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `facturation`
--
ALTER TABLE `facturation`
  ADD CONSTRAINT `fk_ide` FOREIGN KEY (`ide`) REFERENCES `client` (`id_client`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_idv` FOREIGN KEY (`idv`) REFERENCES `vehicule` (`id_vehicule`) ON DELETE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
