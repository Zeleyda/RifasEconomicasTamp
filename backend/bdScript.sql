CREATE DATABASE `rifasdb` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
CREATE TABLE `rifas` (
  `RifaId` int NOT NULL AUTO_INCREMENT,
  `RifaName` varchar(255) NOT NULL,
  `RifaDescription` text NOT NULL,
  `StartDate` datetime NOT NULL,
  `EndDate` datetime NOT NULL,
  `MaxNumbers` int NOT NULL,
  PRIMARY KEY (`RifaId`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
CREATE TABLE `orders` (
  `OrderId` int NOT NULL AUTO_INCREMENT,
  `RifaId` int NOT NULL,
  `OrderDate` datetime NOT NULL,
  `Status` tinyint NOT NULL,
  `PersonName` varchar(100) NOT NULL,
  `PersonPhone` varchar(20) NOT NULL,
  `Estado` varchar(100) NOT NULL,
  PRIMARY KEY (`OrderId`),
  KEY `RifaId` (`RifaId`),
  CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`RifaId`) REFERENCES `rifas` (`RifaId`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
CREATE TABLE `numbers` (
  `NumberId` int NOT NULL AUTO_INCREMENT,
  `OrderId` int NOT NULL,
  `Number` int NOT NULL,
  PRIMARY KEY (`NumberId`),
  KEY `OrderId` (`OrderId`),
  CONSTRAINT `numbers_ibfk_1` FOREIGN KEY (`OrderId`) REFERENCES `orders` (`OrderId`)
) ENGINE=InnoDB AUTO_INCREMENT=50 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
CREATE TABLE `settings` (
  `settingId` int NOT NULL AUTO_INCREMENT,
  `name` varchar(45) DEFAULT NULL,
  `value` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`settingId`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

