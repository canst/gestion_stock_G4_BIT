-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  jeu. 07 mai 2020 à 15:32
-- Version du serveur :  5.7.21
-- Version de PHP :  5.6.35

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `gs`
--

-- --------------------------------------------------------

--
-- Structure de la table `cashbox`
--

DROP TABLE IF EXISTS `cashbox`;
CREATE TABLE IF NOT EXISTS `cashbox` (
  `ID_CASHBOX` int(11) NOT NULL AUTO_INCREMENT,
  `ID_USER` int(11) NOT NULL,
  `No` int(11) NOT NULL,
  PRIMARY KEY (`ID_CASHBOX`),
  UNIQUE KEY `No` (`No`),
  KEY `FK_MANAGE` (`ID_USER`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `cashbox`
--

INSERT INTO `cashbox` (`ID_CASHBOX`, `ID_USER`, `No`) VALUES
(5, 1, 2);

-- --------------------------------------------------------

--
-- Structure de la table `clients`
--

DROP TABLE IF EXISTS `clients`;
CREATE TABLE IF NOT EXISTS `clients` (
  `ID_CLIENT` int(11) NOT NULL AUTO_INCREMENT,
  `TYPE` varchar(20) DEFAULT NULL,
  `NAME` varchar(20) DEFAULT NULL,
  `LASTNAME` varchar(20) DEFAULT NULL,
  `EMAIL` varchar(20) DEFAULT NULL,
  `CONTACTS` varchar(25) DEFAULT NULL,
  PRIMARY KEY (`ID_CLIENT`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `clients`
--

INSERT INTO `clients` (`ID_CLIENT`, `TYPE`, `NAME`, `LASTNAME`, `EMAIL`, `CONTACTS`) VALUES
(1, 'grossiste', 'Bekassoe', 'Yaro', 'yaro@gmail.com', '71188386');

-- --------------------------------------------------------

--
-- Structure de la table `deliveries`
--

DROP TABLE IF EXISTS `deliveries`;
CREATE TABLE IF NOT EXISTS `deliveries` (
  `ID_PRODUCT` int(11) NOT NULL,
  `ID_SUPPLIER` int(11) NOT NULL,
  `ID_DELIVERY` int(11) NOT NULL AUTO_INCREMENT,
  `PRODUCT_NAME` varchar(20) DEFAULT NULL,
  `TYPE` varchar(20) DEFAULT NULL,
  `QUANTITY` decimal(10,0) DEFAULT NULL,
  `PRICE` decimal(10,0) DEFAULT NULL,
  `ID_SUPPLY` int(11) DEFAULT NULL,
  PRIMARY KEY (`ID_DELIVERY`),
  KEY `FK_RELATION_10` (`ID_PRODUCT`),
  KEY `FK_RELATION_11` (`ID_SUPPLIER`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `orders`
--

DROP TABLE IF EXISTS `orders`;
CREATE TABLE IF NOT EXISTS `orders` (
  `ID_CASHBOX` int(11) NOT NULL,
  `ID_PRODUCT` int(11) NOT NULL,
  `ID_CLIENT` int(11) NOT NULL,
  `ID_COMMANDE` int(11) NOT NULL AUTO_INCREMENT,
  `DATE` timestamp NULL DEFAULT NULL,
  `PAYMENT_TYPE` varchar(20) DEFAULT NULL,
  `QUANTITY` decimal(10,0) DEFAULT NULL,
  `PAID` decimal(10,0) DEFAULT NULL,
  PRIMARY KEY (`ID_COMMANDE`),
  KEY `FK_RELATION_3` (`ID_CASHBOX`),
  KEY `FK_RELATION_4` (`ID_CLIENT`),
  KEY `FK_RELATION_5` (`ID_PRODUCT`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `products`
--

DROP TABLE IF EXISTS `products`;
CREATE TABLE IF NOT EXISTS `products` (
  `ID_PRODUCT` int(11) NOT NULL AUTO_INCREMENT,
  `ID_TYPE` int(11) NOT NULL,
  `PRODUCT_NAME` varchar(20) DEFAULT NULL,
  `FORMAT` varchar(20) DEFAULT NULL,
  `PRICE` decimal(10,0) DEFAULT NULL,
  `REDUCTION_RATE` decimal(10,0) DEFAULT NULL,
  `EXPIRATION` date DEFAULT NULL,
  `QUANTITY` decimal(10,0) DEFAULT NULL,
  PRIMARY KEY (`ID_PRODUCT`),
  KEY `FK_HAVE` (`ID_TYPE`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `products`
--

INSERT INTO `products` (`ID_PRODUCT`, `ID_TYPE`, `PRODUCT_NAME`, `FORMAT`, `PRICE`, `REDUCTION_RATE`, `EXPIRATION`, `QUANTITY`) VALUES
(6, 4, 'Saba', '30 g', '50', '10', '2020-05-09', '20');

-- --------------------------------------------------------

--
-- Structure de la table `suppliers`
--

DROP TABLE IF EXISTS `suppliers`;
CREATE TABLE IF NOT EXISTS `suppliers` (
  `ID_SUPPLIER` int(11) NOT NULL AUTO_INCREMENT,
  `NAME` varchar(20) DEFAULT NULL,
  `CONTACTS` varchar(25) DEFAULT NULL,
  `EMAIL` varchar(20) DEFAULT NULL,
  `TYPE` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`ID_SUPPLIER`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `supply`
--

DROP TABLE IF EXISTS `supply`;
CREATE TABLE IF NOT EXISTS `supply` (
  `ID_USER` int(11) NOT NULL,
  `ID_SUPPLIER` int(11) NOT NULL,
  `ID_SUPPLY` int(11) NOT NULL AUTO_INCREMENT,
  `PRODUCT_NAME` varchar(20) DEFAULT NULL,
  `FORMAT` varchar(20) DEFAULT NULL,
  `QUANITY` decimal(10,0) DEFAULT NULL,
  `DATE` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`ID_SUPPLY`),
  KEY `FK_RELATION_8` (`ID_SUPPLIER`),
  KEY `FK_RELATION_9` (`ID_USER`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `type`
--

DROP TABLE IF EXISTS `type`;
CREATE TABLE IF NOT EXISTS `type` (
  `ID_TYPE` int(11) NOT NULL AUTO_INCREMENT,
  `NAME` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`ID_TYPE`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `type`
--

INSERT INTO `type` (`ID_TYPE`, `NAME`) VALUES
(4, 'detergents'),
(5, 'huile alimentaire'),
(6, 'savon'),
(9, 'conserve');

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `ID_USER` int(11) NOT NULL AUTO_INCREMENT,
  `NAME` varchar(20) DEFAULT NULL,
  `FIRSTNAME` varchar(20) DEFAULT NULL,
  `CNIB` varchar(8) DEFAULT NULL,
  `GENDER` char(1) DEFAULT NULL,
  `USERNAME` varchar(8) DEFAULT NULL,
  `TYPE` varchar(20) DEFAULT NULL,
  `CONTACTS` varchar(25) DEFAULT NULL,
  PRIMARY KEY (`ID_USER`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`ID_USER`, `NAME`, `FIRSTNAME`, `CNIB`, `GENDER`, `USERNAME`, `TYPE`, `CONTACTS`) VALUES
(1, 'Yaro', 'Emma', 'testest', 'M', 'Cash1', 'Caissier', '71188386');

-- --------------------------------------------------------

--
-- Structure de la table `withdrawals`
--

DROP TABLE IF EXISTS `withdrawals`;
CREATE TABLE IF NOT EXISTS `withdrawals` (
  `ID_USER` int(11) NOT NULL,
  `ID_CASHBOX` int(11) NOT NULL,
  `ID_WITHDRAW` int(11) NOT NULL AUTO_INCREMENT,
  `DATE` timestamp NULL DEFAULT NULL,
  `AMOUNT` decimal(10,0) DEFAULT NULL,
  PRIMARY KEY (`ID_WITHDRAW`),
  KEY `FK_RELATION_6` (`ID_USER`),
  KEY `FK_RELATION_7` (`ID_CASHBOX`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `cashbox`
--
ALTER TABLE `cashbox`
  ADD CONSTRAINT `FK_MANAGE` FOREIGN KEY (`ID_USER`) REFERENCES `users` (`ID_USER`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `deliveries`
--
ALTER TABLE `deliveries`
  ADD CONSTRAINT `FK_RELATION_10` FOREIGN KEY (`ID_PRODUCT`) REFERENCES `products` (`ID_PRODUCT`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_RELATION_11` FOREIGN KEY (`ID_SUPPLIER`) REFERENCES `suppliers` (`ID_SUPPLIER`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `FK_RELATION_3` FOREIGN KEY (`ID_CASHBOX`) REFERENCES `cashbox` (`ID_CASHBOX`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_RELATION_4` FOREIGN KEY (`ID_CLIENT`) REFERENCES `clients` (`ID_CLIENT`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_RELATION_5` FOREIGN KEY (`ID_PRODUCT`) REFERENCES `products` (`ID_PRODUCT`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `FK_HAVE` FOREIGN KEY (`ID_TYPE`) REFERENCES `type` (`ID_TYPE`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `supply`
--
ALTER TABLE `supply`
  ADD CONSTRAINT `FK_RELATION_8` FOREIGN KEY (`ID_SUPPLIER`) REFERENCES `suppliers` (`ID_SUPPLIER`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_RELATION_9` FOREIGN KEY (`ID_USER`) REFERENCES `users` (`ID_USER`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `withdrawals`
--
ALTER TABLE `withdrawals`
  ADD CONSTRAINT `FK_RELATION_6` FOREIGN KEY (`ID_USER`) REFERENCES `users` (`ID_USER`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_RELATION_7` FOREIGN KEY (`ID_CASHBOX`) REFERENCES `cashbox` (`ID_CASHBOX`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
