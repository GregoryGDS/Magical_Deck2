-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  Dim 15 mars 2020 à 23:13
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
-- Base de données :  `symfony_magical_deck`
--
CREATE DATABASE IF NOT EXISTS `symfony_magical_deck` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `symfony_magical_deck`;

-- --------------------------------------------------------

--
-- Structure de la table `cards`
--

DROP TABLE IF EXISTS `cards`;
CREATE TABLE IF NOT EXISTS `cards` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_type_id` int(11) NOT NULL,
  `id_creator_id` int(11) NOT NULL,
  `id_faction_id` int(11) NOT NULL,
  `hp` int(11) DEFAULT NULL,
  `attack` int(11) DEFAULT NULL,
  `shield` int(11) DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cost` int(11) NOT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(500) COLLATE utf8mb4_unicode_ci NOT NULL,
  `rarity_id` int(11) DEFAULT NULL,
  `full_art` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_4C258FD1BD125E3` (`id_type_id`),
  KEY `IDX_4C258FDC4A88E71` (`id_creator_id`),
  KEY `IDX_4C258FDE1C2780D` (`id_faction_id`),
  KEY `IDX_4C258FDF3747573` (`rarity_id`)
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `cards`
--

INSERT INTO `cards` (`id`, `id_type_id`, `id_creator_id`, `id_faction_id`, `hp`, `attack`, `shield`, `name`, `cost`, `description`, `image`, `rarity_id`, `full_art`) VALUES
(1, 3, 7, 1, 0, 0, 0, 'tête explosé', 0, 'ma tête va explosé avec tous ces bugs ...', 'card-5e64cd2415991-2020-03-08-10-47-00.jpeg', NULL, 1),
(2, 3, 7, 1, 0, 0, 0, 'tête explosé', 0, 'ma tête va explosé avec tous ces bugs ...', 'card-5e64cd4586edf-2020-03-08-10-47-33.jpeg', NULL, 0),
(6, 1, 4, 3, 12, 12, 12, 'PitiChat', 12, 'Si mignon', 'card-5e623227da3e7.png', NULL, 0),
(7, 1, 4, 1, 10, 10, 10, 'kjhgfds', 10, 'lkjhgfds', 'card-5e6258cb70a40.png', NULL, 0),
(8, 1, 4, 1, NULL, NULL, NULL, 'jhgfd', 4, 'ngng', 'card-5e62d93c30e25-2020-03-06-23-14-04.png', NULL, 0),
(9, 2, 4, 2, NULL, NULL, NULL, 'IPSSI TROLL', 12, 'Ils promettent des merveilles et en fait non ¯\\_(ツ)_/¯', 'card-5e62d98c425a0-2020-03-06-23-15-24.jpeg', NULL, 0),
(10, 11, 4, 6, NULL, NULL, NULL, 'testlien', 3, 'testlien', 'card-5e63f2298bf1c-2020-03-07-19-12-41.png', NULL, 0),
(14, 10, 4, 3, NULL, NULL, NULL, 'oiuyt', 4, 'ff', 'card-5e650e047eaab-2020-03-08-15-23-48.jpeg', NULL, 0),
(15, 11, 4, 2, NULL, NULL, NULL, '12', 12, '1212', 'card-5e650e193417e-2020-03-08-15-24-09.jpeg', NULL, 0),
(17, 10, 4, 4, 8, 8, 8, '879', 86, 'testtesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttesttest', 'card-5e650e487198f-2020-03-08-15-24-56.jpeg', NULL, 0),
(21, 1, 4, 1, 999, 999, 999, 'Zelda, princess d\'Hyrule', 999, '<3', 'card-5e6d69c6eeff7-2020-03-14-23-33-26.jpeg', NULL, 0),
(22, 3, 4, 1, NULL, NULL, NULL, 'yyy', 4, 'o', 'card-5e6d738c49a38-2020-03-15-00-15-08.jpeg', NULL, 0),
(24, 1, 4, 1, NULL, NULL, NULL, 'Zelda, princesse d\'Hyrule', 6666, 'test de la position card body si full art', 'card-5e6d7fdd8b150-2020-03-15-01-07-41.jpeg', NULL, 1),
(27, 14, 4, 8, NULL, NULL, NULL, 'dd', 7, 'd', 'card-5e6eb259508a4-2020-03-15-22-55-21.jpeg', NULL, 1);

-- --------------------------------------------------------

--
-- Structure de la table `card_deck`
--

DROP TABLE IF EXISTS `card_deck`;
CREATE TABLE IF NOT EXISTS `card_deck` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_deck_id` int(11) NOT NULL,
  `id_card_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_A39F3495CF84E1AC` (`id_deck_id`),
  KEY `IDX_A39F349594513350` (`id_card_id`)
) ENGINE=InnoDB AUTO_INCREMENT=52 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `card_deck`
--

INSERT INTO `card_deck` (`id`, `id_deck_id`, `id_card_id`) VALUES
(9, 1, 9),
(11, 1, 2),
(14, 4, 7),
(17, 1, 7),
(19, 1, 1),
(20, 1, 9),
(21, 1, 15),
(26, 5, 9),
(29, 5, 10),
(30, 5, 14),
(32, 5, 14),
(33, 5, 7),
(34, 5, 10),
(36, 5, 17),
(39, 6, 2),
(40, 6, 7),
(41, 6, 9),
(42, 6, 2),
(43, 6, 8),
(46, 4, 2),
(51, 4, 24);

-- --------------------------------------------------------

--
-- Structure de la table `decks`
--

DROP TABLE IF EXISTS `decks`;
CREATE TABLE IF NOT EXISTS `decks` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_user_id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_A3FCC63279F37AE5` (`id_user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `decks`
--

INSERT INTO `decks` (`id`, `id_user_id`, `name`) VALUES
(1, 4, 'deck test'),
(2, 1, 'autre test'),
(3, 4, 'tt'),
(4, 4, 'azerty'),
(5, 4, 'dfghjklm'),
(6, 1, 'TEST TEST');

-- --------------------------------------------------------

--
-- Structure de la table `factions`
--

DROP TABLE IF EXISTS `factions`;
CREATE TABLE IF NOT EXISTS `factions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `factions`
--

INSERT INTO `factions` (`id`, `name`) VALUES
(1, 'Magicien'),
(2, 'Arnaque'),
(3, 'Test'),
(4, 'popopo'),
(5, 'error'),
(6, 'test lien'),
(7, 'Bêtes'),
(8, 'TEST'),
(9, 'Wyverns');

-- --------------------------------------------------------

--
-- Structure de la table `migration_versions`
--

DROP TABLE IF EXISTS `migration_versions`;
CREATE TABLE IF NOT EXISTS `migration_versions` (
  `version` varchar(14) COLLATE utf8mb4_unicode_ci NOT NULL,
  `executed_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)',
  PRIMARY KEY (`version`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `rarity`
--

DROP TABLE IF EXISTS `rarity`;
CREATE TABLE IF NOT EXISTS `rarity` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Structure de la table `types`
--

DROP TABLE IF EXISTS `types`;
CREATE TABLE IF NOT EXISTS `types` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `card_color` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `stats` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `types`
--

INSERT INTO `types` (`id`, `name`, `card_color`, `stats`) VALUES
(1, 'Monstre', '#99b3ff', 0),
(2, 'Piège', '#88548c', 0),
(3, 'Magie', '#25a26c', 0),
(10, 'test color', '#9553ee', 0),
(11, 'test lien', '#d515ea', 0),
(12, 'error', '#e70101', 0),
(13, 'test route', '#000000', 0),
(14, 'test global', '#3217c6', 0),
(15, 'test loader', '#ff8000', 0);

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(180) COLLATE utf8mb4_unicode_ci NOT NULL,
  `roles` longtext COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '(DC2Type:json)',
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `first_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_date` datetime NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_1483A5E9E7927C74` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`id`, `email`, `roles`, `password`, `first_name`, `last_name`, `created_date`) VALUES
(1, 'testtest@gmail.com', '[\"ROLE_USER\"]', '$argon2id$v=19$m=65536,t=4,p=1$MlEyNlNyWE85c0EzLi5LYQ$ufQ4vklehfB9J+QhmVLQa4sPb52d+Ve3Dcng8xjoWqQ', 'test_prenom', 'test_nom', '2020-03-05 13:04:59'),
(2, 'gregory.dossantos98@gmail.com', '[\"ROLE_USER\"]', '$argon2id$v=19$m=65536,t=4,p=1$Q1ZWQkloNEYudDFDbG9TRA$8+WBtACnQJMDGBeFgzvWPqcFAQ/dMVTlm4Aei5F5omc', 'Grégory', 'DOS SANTOS', '2020-03-05 13:14:39'),
(3, 'testredirect@gmail.com', '[\"ROLE_USER\"]', '$argon2id$v=19$m=65536,t=4,p=1$VTRiNXJPSVFXZVFYVEhraA$rSi3xo2HR/qHo4X8m+FLXKBdCzkjldKCVkGRsq+3Ogg', 'test redirect', 'test redirect', '2020-03-05 13:23:21'),
(4, 'adminadmin@gmail.com', '[\"ROLE_ADMIN\"]', '$argon2id$v=19$m=65536,t=4,p=1$aHZKWmJjQmRqV0VSSUVybA$B5jUOxZVEdj3s5G9pXdqoyiF7m8cs7LQzhEYQmlQZ/k', 'admin', 'admin', '2020-03-05 13:24:59'),
(5, 'testHOME@gmail.com', '[\"ROLE_USER\"]', '$argon2id$v=19$m=65536,t=4,p=1$MXhsWnhlNDl3MWJBQkEwcw$UZT9URC0s1J324rID8E1Iu+DaWw4ONHodnhi+oud2Ow', 'testHOME', 'testHOME', '2020-03-05 13:28:08'),
(6, 'testHOME2@gmail.com', '[\"ROLE_USER\"]', '$argon2id$v=19$m=65536,t=4,p=1$Nno3a2RpVGl6bXNud0RVOA$zHFFokvKDr7rgpZbgSGl5LvT1Ax9c2g+pWrRHPI9rEA', 'testHOME2', 'testHOME2', '2020-03-05 13:29:03'),
(7, 'testtesttest@gmail.com', '[\"ROLE_USER\"]', '$argon2id$v=19$m=65536,t=4,p=1$WmlvSzNMZ0lOWE5zZ2hndQ$WNraXlJkd+RlhiI6Wd/5SGUT3v9kPT8SWs7/kPFQpLI', 'testtesttest', 'testtesttest', '2020-03-05 15:31:46'),
(8, 'ytreza@gmail.com', '[\"ROLE_USER\"]', '$argon2id$v=19$m=65536,t=4,p=1$SG96dUREdVlRR2pxN05yTw$0PCF/xZPFp60M/yK2Ao6a4NoFSaoU3asFsSoz4JwVFE', 'ytreza', 'ytreza', '2020-03-11 23:13:26'),
(9, 'BBBBBBBBB@gmail.com', '[\"ROLE_USER\"]', '$argon2id$v=19$m=65536,t=4,p=1$dUlRSE9MRk1ZUUdMUjhPMQ$JwVDR7bN/2bPFwIbp9OD/9UnkFYx5zPao68O/rxSMiA', 'BBBBBBBBB', 'BBBBBBBBB', '2020-03-11 23:20:01'),
(10, 'CCCCCCCCCCC@gmail.com', '[\"ROLE_USER\"]', '$argon2id$v=19$m=65536,t=4,p=1$aWFEVWRaRFNuZ09ub0s4dg$/p6Zw9XSEF1udSto/RtI34iYMAjIOEx1FGprtobyPVs', 'CCCCCCCCCCC', 'CCCCCCCCCCC', '2020-03-11 23:39:31'),
(11, 'GGGGGGGGGGGGGGGGGG@gmail.com', '[\"ROLE_USER\"]', '$argon2id$v=19$m=65536,t=4,p=1$aTB1bGt4M3NkbndnUzc1Lg$dCXnkuCoHh6QwCF+bETbwv9cloiwl5KAZyzcgLWkyTc', 'GGGGGGGGGGGGGGGGGG', 'GGGGGGGGGGGGGGGGGG', '2020-03-11 23:41:01'),
(12, 'tesadduser@gmail.com', '[\"ROLE_USER\"]', '$argon2id$v=19$m=65536,t=4,p=1$V3RpREpwb3ZuQi55blBENw$51BOt46nsKtuPm6pI7tVVWr74hOJoEHBHMqeX56Db5U', 'tesadduser', 'tesadduser', '2020-03-12 23:30:41'),
(13, 'TESTaddUSER@gmail.com', '[\"ROLE_USER\"]', '$argon2id$v=19$m=65536,t=4,p=1$YjdMUzVCMFdBQTlSTWxKVQ$gkkzo7cLON19XS3eZJnBN0ImfwUk+B24kZZW5IEm7YM', 'TESTaddUSER', 'TESTaddUSER', '2020-03-12 23:38:48');

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `cards`
--
ALTER TABLE `cards`
  ADD CONSTRAINT `FK_4C258FD1BD125E3` FOREIGN KEY (`id_type_id`) REFERENCES `types` (`id`),
  ADD CONSTRAINT `FK_4C258FDC4A88E71` FOREIGN KEY (`id_creator_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `FK_4C258FDE1C2780D` FOREIGN KEY (`id_faction_id`) REFERENCES `factions` (`id`),
  ADD CONSTRAINT `FK_4C258FDF3747573` FOREIGN KEY (`rarity_id`) REFERENCES `rarity` (`id`);

--
-- Contraintes pour la table `card_deck`
--
ALTER TABLE `card_deck`
  ADD CONSTRAINT `FK_A39F349594513350` FOREIGN KEY (`id_card_id`) REFERENCES `cards` (`id`),
  ADD CONSTRAINT `FK_A39F3495CF84E1AC` FOREIGN KEY (`id_deck_id`) REFERENCES `decks` (`id`);

--
-- Contraintes pour la table `decks`
--
ALTER TABLE `decks`
  ADD CONSTRAINT `FK_A3FCC63279F37AE5` FOREIGN KEY (`id_user_id`) REFERENCES `users` (`id`);
--
-- Base de données :  `symfony_magical_deck2`
--
CREATE DATABASE IF NOT EXISTS `symfony_magical_deck2` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `symfony_magical_deck2`;

-- --------------------------------------------------------

--
-- Structure de la table `migration_versions`
--

DROP TABLE IF EXISTS `migration_versions`;
CREATE TABLE IF NOT EXISTS `migration_versions` (
  `version` varchar(14) COLLATE utf8mb4_unicode_ci NOT NULL,
  `executed_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)',
  PRIMARY KEY (`version`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
--
-- Base de données :  `test`
--
CREATE DATABASE IF NOT EXISTS `test` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `test`;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
