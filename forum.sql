-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : mer. 19 fév. 2025 à 15:59
-- Version du serveur : 9.1.0
-- Version de PHP : 8.3.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `forum`
--

-- --------------------------------------------------------

--
-- Structure de la table `answers`
--

DROP TABLE IF EXISTS `answers`;
CREATE TABLE IF NOT EXISTS `answers` (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_author` int NOT NULL,
  `pseudo_author` varchar(255) NOT NULL,
  `id_question` int NOT NULL,
  `content` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `answers`
--

INSERT INTO `answers` (`id`, `id_author`, `pseudo_author`, `id_question`, `content`) VALUES
(1, 1, 'voltaroi', 2, 'coucou'),
(2, 1, 'voltaroi', 2, 'cc'),
(3, 1, 'voltaroi', 2, 'cc'),
(4, 1, 'voltaroi', 2, 'cc'),
(5, 1, 'voltaroi', 2, 'cc'),
(6, 1, 'voltaroi', 2, 'cc'),
(7, 1, 'voltaroi', 2, 'cc'),
(8, 1, 'voltaroi', 2, 'cc'),
(9, 1, 'voltaroi', 2, 'cc'),
(10, 1, 'voltaroi', 2, 't'),
(11, 1, 'voltaroi', 2, 't'),
(12, 1, 'voltaroi', 2, 'azeaz'),
(13, 1, 'voltaroi', 3, 'eryh'),
(14, 1, 'voltaroi', 3, 'eryh'),
(15, 1, 'voltaroi', 3, 't'),
(16, 1, 'voltaroi', 3, 't');

-- --------------------------------------------------------

--
-- Structure de la table `follow`
--

DROP TABLE IF EXISTS `follow`;
CREATE TABLE IF NOT EXISTS `follow` (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_followed` int NOT NULL,
  `id_follower` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `follow`
--

INSERT INTO `follow` (`id`, `id_followed`, `id_follower`) VALUES
(2, 1, 2),
(7, 1, 1),
(8, 1, 3);

-- --------------------------------------------------------

--
-- Structure de la table `questions`
--

DROP TABLE IF EXISTS `questions`;
CREATE TABLE IF NOT EXISTS `questions` (
  `id` int NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `content` text NOT NULL,
  `id_author` int NOT NULL,
  `pseudo_author` varchar(255) NOT NULL,
  `date_publish` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `questions`
--

INSERT INTO `questions` (`id`, `title`, `description`, `content`, `id_author`, `pseudo_author`, `date_publish`) VALUES
(2, 'coucou', 'testt ', 'c&#039;est un ptit coucou test<br />\r\n', 1, 'voltaroi', '16/02/2025'),
(3, 'dfesgrdh', 'tgdryfug', 'kilohoumuih<br />\r\nbhoplm', 1, 'voltaroi', '16/02/2025'),
(4, 'fgh', 'dxitjeyftik', 'fluuyitl', 3, 'volta', '17/02/2025');

-- --------------------------------------------------------

--
-- Structure de la table `tolike`
--

DROP TABLE IF EXISTS `tolike`;
CREATE TABLE IF NOT EXISTS `tolike` (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_answert` int NOT NULL,
  `id_user` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `tolike`
--

INSERT INTO `tolike` (`id`, `id_answert`, `id_user`) VALUES
(3, 16, 1),
(5, 16, 2),
(7, 14, 2),
(8, 13, 2),
(10, 15, 3),
(11, 16, 3);

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int NOT NULL AUTO_INCREMENT,
  `pseudo` varchar(255) NOT NULL,
  `password` text NOT NULL,
  `profile_pic` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `pseudo`, `password`, `profile_pic`) VALUES
(1, 'voltaroi', '$2y$10$IjgRGQ1JI445a4HvnZ3kVuF.OzNqq93Xddq0KCfeD/ktzK7fwEoFK', 'profile_1.png'),
(2, 'admin', '$2y$10$8pek2NQYX11fa97jDmesS.ZtIlZV/hRWL6OP93ZgGR8X4ocrOx6J.', ''),
(3, 'volta', '$2y$10$lXgdhsEV3pMIjkK/nFcCDOmsAQ1cnIdpFwfZYNdgEyUlF.53PxDBi', 'profile_3.png'),
(4, 'volt', '$2y$10$DPl.QmY/5cGc3jH2ODRyEuL6rXmRzxrw4gynoNzwnXLlkcIXCMlIu', '');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
