-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Client: localhost
-- Généré le: Jeu 15 Septembre 2016 à 18:04
-- Version du serveur: 5.5.50-0ubuntu0.14.04.1
-- Version de PHP: 5.5.9-1ubuntu4.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données: `zzzweb`
--

-- --------------------------------------------------------

--
-- Structure de la table `changes`
--

CREATE TABLE IF NOT EXISTS `changes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `request_id` int(11) NOT NULL,
  `comment` text NOT NULL,
  `date` date NOT NULL,
  `is_zzz` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `request_id` (`request_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=10 ;

--
-- Contenu de la table `changes`
--

INSERT INTO `changes` (`id`, `request_id`, `comment`, `date`, `is_zzz`) VALUES
(1, 1, 'cest corrigéééééé', '2016-08-05', 0),
(2, 1, 'ah oui ouiiiiiiiii', '2016-08-08', 0),
(5, 1, 'aaaaaaaaaaaa\r\nazdza\r\nda\r\nda\r\nzd\r\nazd\r\nazd\r\na\r\nzda\r\nzd\r\nazd\r\nz\r\nfze\r\nf\r\n\r\n\r\n\r\n\r\n\r\nzefzefezfzef :) :) :)', '2016-08-04', 1),
(6, 1, 'isfdnssrthsrth\r\nstr\r\nhs\r\nrth\r\nsrt\r\nhs\r\nrhsrhsr\r\n\r\n\r\nsrthsrthsrth\r\n\r\n\r\n\r\n\r\n\r\n\r\n\r\nrthsrth', '2016-08-07', 1),
(8, 1, 'Aicha Aicha Ã©coute moi', '2016-08-11', 1),
(9, 3, 'j''aime pas ce test', '2016-08-25', 1);

-- --------------------------------------------------------

--
-- Structure de la table `colors`
--

CREATE TABLE IF NOT EXISTS `colors` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Contenu de la table `colors`
--

INSERT INTO `colors` (`id`, `name`) VALUES
(1, 'Orange'),
(2, 'Sosh');

-- --------------------------------------------------------

--
-- Structure de la table `contacts`
--

CREATE TABLE IF NOT EXISTS `contacts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `request_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `request_id` (`request_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `details`
--

CREATE TABLE IF NOT EXISTS `details` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Contenu de la table `details`
--

INSERT INTO `details` (`id`, `name`) VALUES
(1, 'Analyse'),
(2, 'Recette');

-- --------------------------------------------------------

--
-- Structure de la table `files`
--

CREATE TABLE IF NOT EXISTS `files` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `path` varchar(255) NOT NULL,
  `size` int(11) NOT NULL,
  `request_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `request_id` (`request_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

--
-- Contenu de la table `files`
--

INSERT INTO `files` (`id`, `name`, `path`, `size`, `request_id`) VALUES
(1, 'e-eee-eee-eae-ea.png', 'files/requests/98871894122750/', 226995, 1),
(2, 'Capture-du-2016-06-20-17-04-06.png', 'files/requests/98871894122750/', 491431, 1),
(3, 'Capture-du-2016-06-20-17-16-55.png', 'files/requests/98871894122750/', 581376, 1),
(4, 'Capture-du-2016-08-08-14-49-51.png', 'files/requests/93821077146096/', 32984, 3),
(5, 'Capture-du-2016-08-10-14-45-26.png', 'files/requests/93821077146096/', 49152, 3),
(6, 'Capture-du-2016-08-20-16-02-45.png', 'files/requests/93821077146096/', 180542, 3),
(7, 'Capture-du-2016-08-22-16-24-03.png', 'files/requests/93821077146096/', 266536, 3);

-- --------------------------------------------------------

--
-- Structure de la table `refusals`
--

CREATE TABLE IF NOT EXISTS `refusals` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `request_id` int(11) NOT NULL,
  `why` text NOT NULL,
  `date` date NOT NULL,
  PRIMARY KEY (`id`),
  KEY `request_id` (`request_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Contenu de la table `refusals`
--

INSERT INTO `refusals` (`id`, `request_id`, `why`, `date`) VALUES
(1, 1, 'aaaaaaaaaaaa\nazdza\nda\nda\nzd\nazd\nazd\na\nzda\nzd\nazd\nz\nfze\nf\n\n\n\n\n\nzefzefezfzef :) :) :)', '2016-08-03'),
(3, 1, 'zaertyuikjhgfdscvdfbgh', '2016-08-08');

-- --------------------------------------------------------

--
-- Structure de la table `requests`
--

CREATE TABLE IF NOT EXISTS `requests` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `projectName` varchar(255) NOT NULL,
  `user_id` int(11) NOT NULL,
  `scope_id` int(11) NOT NULL,
  `color_id` int(11) NOT NULL,
  `detail_id` int(11) NOT NULL,
  `moreDetails` text NOT NULL,
  `testDate` date NOT NULL,
  `onlineDate` date NOT NULL,
  `creationDate` date NOT NULL,
  `lastModified` date NOT NULL,
  `delay` int(11) NOT NULL,
  `is_assigned` tinyint(1) NOT NULL,
  `is_blocked` tinyint(1) NOT NULL,
  `was_blocked` tinyint(1) NOT NULL,
  `is_closed` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `scope_id` (`scope_id`),
  KEY `color_id` (`color_id`),
  KEY `detail_id` (`detail_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Contenu de la table `requests`
--

INSERT INTO `requests` (`id`, `projectName`, `user_id`, `scope_id`, `color_id`, `detail_id`, `moreDetails`, `testDate`, `onlineDate`, `creationDate`, `lastModified`, `delay`, `is_assigned`, `is_blocked`, `was_blocked`, `is_closed`) VALUES
(1, 'a assigner', 1, 3, 1, 1, 'zaefgfhjkl', '2016-08-25', '2016-08-03', '2016-08-03', '2016-08-04', 10, 0, 0, 0, 0),
(3, 'azertyuiop', 1, 3, 1, 1, 'azerty', '2016-08-31', '2016-08-26', '2016-08-25', '2016-08-25', 0, 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- Structure de la table `requests_types`
--

CREATE TABLE IF NOT EXISTS `requests_types` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type_id` int(11) NOT NULL,
  `request_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `request_id_2` (`request_id`),
  KEY `type_id` (`type_id`),
  KEY `request_id` (`request_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `requests_users`
--

CREATE TABLE IF NOT EXISTS `requests_users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `request_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `request_id` (`request_id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `scopes`
--

CREATE TABLE IF NOT EXISTS `scopes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id` (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Contenu de la table `scopes`
--

INSERT INTO `scopes` (`id`, `name`) VALUES
(1, 'Assistance'),
(3, 'Espace Client');

-- --------------------------------------------------------

--
-- Structure de la table `types`
--

CREATE TABLE IF NOT EXISTS `types` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Contenu de la table `types`
--

INSERT INTO `types` (`id`, `name`) VALUES
(1, 'Build'),
(2, 'Run'),
(3, 'Projet Internet');

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(255) NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `job` varchar(10) NOT NULL,
  `is_zzz` tinyint(1) NOT NULL,
  `scope_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `scope_id` (`scope_id`),
  KEY `scope_id_2` (`scope_id`),
  KEY `scope_id_3` (`scope_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Contenu de la table `users`
--

INSERT INTO `users` (`id`, `email`, `firstname`, `lastname`, `password`, `job`, `is_zzz`, `scope_id`) VALUES
(1, 'jeremy.choux@orange.com', 'Jeremy', 'Choux', '922f4878f969853d612db2e9d54394d88c4c4b6f', 'MOA', 1, 3),
(2, 'test@orange.com', 'Test', 'Test', '922f4878f969853d612db2e9d54394d88c4c4b6f', 'Métier', 0, 3),
(3, 'azerty@orange.fr', 'azerty', 'azerty', '922f4878f969853d612db2e9d54394d88c4c4b6f', 'MOA', 0, 1),
(4, 'test@test.fr', 'tes', 'testtt', '922f4878f969853d612db2e9d54394d88c4c4b6f', 'MOE', 1, 3);

--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `changes`
--
ALTER TABLE `changes`
  ADD CONSTRAINT `changes_ibfk_1` FOREIGN KEY (`request_id`) REFERENCES `requests` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `contacts`
--
ALTER TABLE `contacts`
  ADD CONSTRAINT `contacts_ibfk_1` FOREIGN KEY (`request_id`) REFERENCES `requests` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `files`
--
ALTER TABLE `files`
  ADD CONSTRAINT `files_ibfk_1` FOREIGN KEY (`request_id`) REFERENCES `requests` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `refusals`
--
ALTER TABLE `refusals`
  ADD CONSTRAINT `refusals_ibfk_1` FOREIGN KEY (`request_id`) REFERENCES `requests` (`id`);

--
-- Contraintes pour la table `requests`
--
ALTER TABLE `requests`
  ADD CONSTRAINT `requests_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `requests_ibfk_3` FOREIGN KEY (`scope_id`) REFERENCES `scopes` (`id`),
  ADD CONSTRAINT `requests_ibfk_4` FOREIGN KEY (`color_id`) REFERENCES `colors` (`id`),
  ADD CONSTRAINT `requests_ibfk_5` FOREIGN KEY (`detail_id`) REFERENCES `details` (`id`);

--
-- Contraintes pour la table `requests_types`
--
ALTER TABLE `requests_types`
  ADD CONSTRAINT `requests_types_ibfk_1` FOREIGN KEY (`type_id`) REFERENCES `types` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `requests_types_ibfk_2` FOREIGN KEY (`request_id`) REFERENCES `requests` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `requests_users`
--
ALTER TABLE `requests_users`
  ADD CONSTRAINT `requests_users_ibfk_1` FOREIGN KEY (`request_id`) REFERENCES `requests` (`id`),
  ADD CONSTRAINT `requests_users_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
