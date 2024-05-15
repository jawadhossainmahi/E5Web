SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

DROP TABLE IF EXISTS `annonces`;
CREATE TABLE IF NOT EXISTS `annonces` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `Titre` varchar(255) DEFAULT NULL,
  `Description` text,
  `date` date NOT NULL,
  `ID_Utilisateurs` int(11) DEFAULT NULL,
  `ID_Logements` int(11) DEFAULT NULL,
  PRIMARY KEY (`ID`),
  KEY `ID_Logements` (`ID_Logements`),
  KEY `ID_Utilisateurs` (`ID_Utilisateurs`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb4;

DROP TABLE IF EXISTS `equipement`;
CREATE TABLE IF NOT EXISTS `equipement` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `libelle` varchar(255) NOT NULL,
  `id_Piece` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `Equipement_Piece_FK` (`id_Piece`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;

DROP TABLE IF EXISTS `logement`;
CREATE TABLE IF NOT EXISTS `logement` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `libelle` varchar(255) NOT NULL,
  `adresse` varchar(255) NOT NULL,
  `cp` varchar(10) NOT NULL,
  `ville` varchar(10) NOT NULL,
  `dateAjout` date NOT NULL,
  `id_Type` int(11) NOT NULL,
  `id_proprietaire` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `Logement_Type_FK` (`id_Type`),
  KEY `id_proprietaire` (`id_proprietaire`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4;

DROP TABLE IF EXISTS `periodes_de_reservation`;
CREATE TABLE IF NOT EXISTS `periodes_de_reservation` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `ID_Logements` int(11) DEFAULT NULL,
  `DateDebut` date DEFAULT NULL,
  `DateFin` date DEFAULT NULL,
  PRIMARY KEY (`ID`),
  KEY `ID_Logements` (`ID_Logements`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4;

DROP TABLE IF EXISTS `photo`;
CREATE TABLE IF NOT EXISTS `photo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `photo` longblob NOT NULL,
  `id_Logement` int(11) DEFAULT NULL,
  `id_Piece` int(11) DEFAULT NULL,
  `id_Equipement` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `Photo_Logement_FK` (`id_Logement`),
  KEY `Photo_Piece0_FK` (`id_Piece`),
  KEY `Photo_Equipement1_FK` (`id_Equipement`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8mb4;

DROP TABLE IF EXISTS `piece`;
CREATE TABLE IF NOT EXISTS `piece` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `libelle` varchar(255) NOT NULL,
  `surface` int(11) NOT NULL,
  `id_Logement` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `Piece_Logement_FK` (`id_Logement`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4;

DROP TABLE IF EXISTS `reservations`;
CREATE TABLE IF NOT EXISTS `reservations` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `ID_Utilisateur` int(11) DEFAULT NULL,
  `ID_Appartement` int(11) DEFAULT NULL,
  `Prix` decimal(10,2) DEFAULT NULL,
  `DateDebut` date DEFAULT NULL,
  `DateFin` date DEFAULT NULL,
  `Statut` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


DROP TABLE IF EXISTS `type`;
CREATE TABLE IF NOT EXISTS `type` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `libelle` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;

DROP TABLE IF EXISTS `utilisateurs`;
CREATE TABLE IF NOT EXISTS `utilisateurs` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `Nom` varchar(255) DEFAULT NULL,
  `Prenom` varchar(255) DEFAULT NULL,
  `Email` varchar(255) DEFAULT NULL,
  `MotDePasse` varchar(255) DEFAULT NULL,
  `Role` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;

ALTER TABLE `annonces`
  ADD CONSTRAINT `Annonces_ibfk_1` FOREIGN KEY (`ID_Logements`) REFERENCES `logement` (`id`),
  ADD CONSTRAINT `Annonces_ibfk_2` FOREIGN KEY (`ID_Utilisateurs`) REFERENCES `utilisateurs` (`ID`);


ALTER TABLE `equipement`
  ADD CONSTRAINT `Equipement_Piece_FK` FOREIGN KEY (`id_Piece`) REFERENCES `piece` (`id`);

ALTER TABLE `logement`
  ADD CONSTRAINT `Logement_Type_FK` FOREIGN KEY (`id_Type`) REFERENCES `type` (`id`),
  ADD CONSTRAINT `Logement_ibfk_1` FOREIGN KEY (`id_proprietaire`) REFERENCES `utilisateurs` (`ID`);

ALTER TABLE `photo`
  ADD CONSTRAINT `Photo_Equipement1_FK` FOREIGN KEY (`id_Equipement`) REFERENCES `equipement` (`id`),
  ADD CONSTRAINT `Photo_Logement_FK` FOREIGN KEY (`id_Logement`) REFERENCES `logement` (`id`),
  ADD CONSTRAINT `Photo_Piece0_FK` FOREIGN KEY (`id_Piece`) REFERENCES `piece` (`id`);

ALTER TABLE `piece`
  ADD CONSTRAINT `Piece_Logement_FK` FOREIGN KEY (`id_Logement`) REFERENCES `logement` (`id`);
COMMIT;
