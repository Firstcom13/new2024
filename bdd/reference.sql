-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : mar. 05 nov. 2024 à 10:51
-- Version du serveur : 10.4.28-MariaDB
-- Version de PHP : 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `firstcomlocal`
--

-- --------------------------------------------------------

--
-- Structure de la table `reference`
--

CREATE TABLE `reference` (
  `id` int(11) NOT NULL,
  `titre` varchar(255) NOT NULL,
  `descriptif` longtext NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `url` varchar(255) DEFAULT NULL,
  `actif` tinyint(1) NOT NULL,
  `date_creation` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)',
  `nom_reference` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `reference`
--

INSERT INTO `reference` (`id`, `titre`, `descriptif`, `image`, `url`, `actif`, `date_creation`, `nom_reference`) VALUES
(1, 'Titre référence', '<p>le r&eacute;seau des experts du film et du vitrage</p>', 'glastint-reference.jpg', 'https://www.glastint.com', 1, '2023-08-09 16:18:36', 'Glastint'),
(2, 'Titre référence', '<p>Du fond du bassin aux parois de la piscine, jusqu&#39;&agrave; la ligne d&#39;eau, les robots nettoyeurs de piscine Dolphin sont des concentr&eacute;s de technologies avanc&eacute;es pour ...</p>', 'robot-dolphin-reference.jpg', 'https://www.robot-dolphin.fr/', 1, '2023-08-10 12:25:04', 'Robot Dolphin');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `reference`
--
ALTER TABLE `reference`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nom_reference` (`nom_reference`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `reference`
--
ALTER TABLE `reference`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
