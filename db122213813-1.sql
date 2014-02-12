-- MySQL dump 10.13  Distrib 5.6.12, for osx10.6 (x86_64)
--
-- Host: localhost    Database: plansite
-- ------------------------------------------------------
-- Server version	5.6.12

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Current Database: `plansite`
--



USE `plansite`;

--
-- Table structure for table `projects`
--

DROP TABLE IF EXISTS `projects`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `projects` (
  `PID` int(11) NOT NULL AUTO_INCREMENT,
  `user` varchar(1000) DEFAULT NULL,
  `project` varchar(30) DEFAULT NULL,
  `done` text,
  `to_do` text,
  `hours_last_month` double DEFAULT NULL,
  `hours` double DEFAULT NULL,
  PRIMARY KEY (`PID`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `projects`
--

LOCK TABLES `projects` WRITE;
/*!40000 ALTER TABLE `projects` DISABLE KEYS */;
INSERT INTO `projects` VALUES (1,'mike paul ty','gardening','               hoed the firt row worms','weed exsiting planters, put down mulch, plant flowers              buy manure ',200,70),(2,'mike','paint',' ','paint walls, paint molding, paint ceiling',0,0),(3,'mike','gardening','patio pavers','seal deck',12,9),(4,'','gardening','','',0,0),(5,'mike','paint','test','test',0,0),(6,'mike','paint','test 3','helpl',2,5),(7,'etst','paint','','',0,0);
/*!40000 ALTER TABLE `projects` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `temp_projects`
--

DROP TABLE IF EXISTS `temp_projects`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `temp_projects` (
  `PID` int(11) NOT NULL DEFAULT '0',
  `user` varchar(30) DEFAULT NULL,
  `project` varchar(30) DEFAULT NULL,
  `done` text,
  `to_do` text,
  `hours_last_month` double DEFAULT NULL,
  `hours` double DEFAULT NULL,
  PRIMARY KEY (`PID`),
  UNIQUE KEY `PID` (`PID`),
  KEY `PID_2` (`PID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `temp_projects`
--

LOCK TABLES `temp_projects` WRITE;
/*!40000 ALTER TABLE `temp_projects` DISABLE KEYS */;
INSERT INTO `temp_projects` VALUES (0,'','gardening','','',0,0),(1,'','paint','','',0,0);
/*!40000 ALTER TABLE `temp_projects` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `PID` int(11) NOT NULL AUTO_INCREMENT,
  `user` varchar(30) DEFAULT NULL,
  `project` varchar(30) DEFAULT NULL,
  `password` text NOT NULL,
  `group` int(2) NOT NULL DEFAULT '1',
  PRIMARY KEY (`PID`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'mike','proj1','$1$RI8YyxFb$Gt6fZo3psPVpcjT7BQGvj0',2),(2,'mike','paint','$1$RI8YyxFb$Gt6fZo3psPVpcjT7BQGvj0',2),(3,'sam','proj2','',1),(4,'shaf','proj3','',1),(5,'mikey','building','',1),(6,'michael','','$1$eDPTPXu3$J8K1Vdrq9/1Bxvt.kwnvQ0',6),(7,'test','building','',1),(8,'test1','building','',1),(9,'tester','','$1$qF42mEUC$6A4azaL9fanQYu0O/1Qdl.',1),(10,'mike','gardening','$1$RI8YyxFb$Gt6fZo3psPVpcjT7BQGvj0',2),(11,'alex','gardening','$1$NhF.3fMV$I6jc5CkNIAL.Y9yx66zDp0',1),(12,'key',NULL,'$1$MCWpJOhX$llVM4/sfYlkyyZ1v6on8d1',2);
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2013-12-22 20:15:24
