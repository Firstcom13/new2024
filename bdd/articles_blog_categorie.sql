-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : ven. 29 déc. 2023 à 13:31
-- Version du serveur : 10.4.27-MariaDB
-- Version de PHP : 8.1.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `firstcomproduction`
--

-- --------------------------------------------------------

--
-- Structure de la table `articles_blog_categorie`
--

CREATE TABLE `articles_blog_categorie` (
  `articles_blog_id` int(11) NOT NULL,
  `categorie_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `articles_blog_categorie`
--

INSERT INTO `articles_blog_categorie` (`articles_blog_id`, `categorie_id`) VALUES
(1, 1),
(1, 11),
(3, 9),
(4, 1),
(4, 4),
(5, 1),
(5, 4),
(5, 12),
(6, 4),
(6, 11);

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `articles_blog_categorie`
--
ALTER TABLE `articles_blog_categorie`
  ADD PRIMARY KEY (`articles_blog_id`,`categorie_id`),
  ADD KEY `IDX_63A2FBDF9F851A36` (`articles_blog_id`),
  ADD KEY `IDX_63A2FBDFBCF5E72D` (`categorie_id`);

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `articles_blog_categorie`
--
ALTER TABLE `articles_blog_categorie`
  ADD CONSTRAINT `FK_63A2FBDF9F851A36` FOREIGN KEY (`articles_blog_id`) REFERENCES `articles_blog` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_63A2FBDFBCF5E72D` FOREIGN KEY (`categorie_id`) REFERENCES `categorie` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
