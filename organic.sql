-- MySQL dump 10.13  Distrib 5.5.40, for debian-linux-gnu (i686)
--
-- Host: localhost    Database: organic
-- ------------------------------------------------------
-- Server version	5.5.40-0ubuntu0.14.04.1

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
-- Table structure for table `applications`
--

DROP TABLE IF EXISTS `applications`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `applications` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `field_id` int(10) DEFAULT NULL,
  `pesticide` varchar(50) DEFAULT NULL,
  `fertilizer` varchar(50) DEFAULT NULL,
  `status` varchar(10) DEFAULT NULL,
  `submit_date` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `applications`
--

LOCK TABLES `applications` WRITE;
/*!40000 ALTER TABLE `applications` DISABLE KEYS */;
INSERT INTO `applications` VALUES (8,1,'1','1','pending','2014-12-03 11:19:35'),(9,2,'2','2','pending','2014-12-03 11:27:36'),(10,6,'3','2','pending','2014-12-03 16:29:49');
/*!40000 ALTER TABLE `applications` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `crop_subtypes`
--

DROP TABLE IF EXISTS `crop_subtypes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `crop_subtypes` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `crop_id` int(10) DEFAULT NULL,
  `name` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `crop_subtypes`
--

LOCK TABLES `crop_subtypes` WRITE;
/*!40000 ALTER TABLE `crop_subtypes` DISABLE KEYS */;
INSERT INTO `crop_subtypes` VALUES (1,1,'McIntosh'),(2,1,'Spartan'),(3,1,'Gala'),(4,2,'Chinook'),(5,2,'Garnet'),(6,2,'Utah Giant'),(7,3,'Albion'),(8,3,'Bolero'),(9,3,'Camarosa'),(10,4,'Scarlet Nantes'),(11,4,'Touchon'),(12,4,'Parano');
/*!40000 ALTER TABLE `crop_subtypes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `crops`
--

DROP TABLE IF EXISTS `crops`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `crops` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `crops`
--

LOCK TABLES `crops` WRITE;
/*!40000 ALTER TABLE `crops` DISABLE KEYS */;
INSERT INTO `crops` VALUES (1,'Apples'),(2,'Cherries'),(3,'Strawberries'),(4,'Carrots');
/*!40000 ALTER TABLE `crops` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `fertilizer_brands`
--

DROP TABLE IF EXISTS `fertilizer_brands`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `fertilizer_brands` (
  `id` int(10) DEFAULT NULL,
  `name` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `fertilizer_brands`
--

LOCK TABLES `fertilizer_brands` WRITE;
/*!40000 ALTER TABLE `fertilizer_brands` DISABLE KEYS */;
INSERT INTO `fertilizer_brands` VALUES (NULL,'Jerry\'s'),(NULL,'Tom\'s'),(NULL,'Super Organic'),(NULL,'Chemical Brothers');
/*!40000 ALTER TABLE `fertilizer_brands` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `fertilizers`
--

DROP TABLE IF EXISTS `fertilizers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `fertilizers` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `brand_id` int(10) DEFAULT NULL,
  `name` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `fertilizers`
--

LOCK TABLES `fertilizers` WRITE;
/*!40000 ALTER TABLE `fertilizers` DISABLE KEYS */;
INSERT INTO `fertilizers` VALUES (1,NULL,'Jerry\'s Organic Fertilizer'),(2,NULL,'Tom\'s Blood Meal Blend'),(3,NULL,'Zinc Super'),(4,NULL,'Fast Acting Gypsum');
/*!40000 ALTER TABLE `fertilizers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `fields`
--

DROP TABLE IF EXISTS `fields`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `fields` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `member_id` int(10) DEFAULT NULL,
  `name` varchar(50) DEFAULT NULL,
  `crop` int(10) DEFAULT NULL,
  `crop_subtype` int(10) DEFAULT NULL,
  `area` int(6) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `fields`
--

LOCK TABLES `fields` WRITE;
/*!40000 ALTER TABLE `fields` DISABLE KEYS */;
INSERT INTO `fields` VALUES (1,1,'Test Apple Field',1,1,10),(2,1,'Strawberry Field',3,7,12),(3,1,'Cherry Land',2,2,4),(5,1,'Much Macs',1,1,0),(6,1,'Savage Spartans',1,2,0);
/*!40000 ALTER TABLE `fields` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `members`
--

DROP TABLE IF EXISTS `members`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `members` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) DEFAULT NULL,
  `firstname` varchar(50) DEFAULT NULL,
  `lastname` varchar(50) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `password` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `members`
--

LOCK TABLES `members` WRITE;
/*!40000 ALTER TABLE `members` DISABLE KEYS */;
INSERT INTO `members` VALUES (1,'test','Test','User','test@email.com','*94BDCEBE19083CE2A1F959FD02F964C7AF4CFC29'),(3,'JohnUser','John','Doe','jdoe@email.com','*D37C49F9CBEFBF8B6F4B165AC703AA271E079004'),(4,'Bacon','Bacon','Man','bacon@email.com','*F59FD81FA772D790A52347F263E9C55C1BB03F5B');
/*!40000 ALTER TABLE `members` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pesticides`
--

DROP TABLE IF EXISTS `pesticides`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pesticides` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pesticides`
--

LOCK TABLES `pesticides` WRITE;
/*!40000 ALTER TABLE `pesticides` DISABLE KEYS */;
INSERT INTO `pesticides` VALUES (1,'Aldicarb'),(2,'Atrazine'),(3,'Carbaryl'),(4,'Chlorpyrifos');
/*!40000 ALTER TABLE `pesticides` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2014-12-03 16:31:17
