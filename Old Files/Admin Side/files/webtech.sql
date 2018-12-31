CREATE DATABASE  IF NOT EXISTS `webtech` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `webtech`;
-- MySQL dump 10.13  Distrib 5.7.17, for Win64 (x86_64)
--
-- Host: 127.0.0.1    Database: webtech
-- ------------------------------------------------------
-- Server version	5.5.5-10.1.30-MariaDB

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
-- Table structure for table `contact_details`
--

DROP TABLE IF EXISTS `contact_details`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `contact_details` (
  `idcontact_details` int(11) NOT NULL,
  `contact_firstname` varchar(45) DEFAULT NULL,
  `contact_lastname` varchar(45) DEFAULT NULL,
  `contact_number` bigint(12) DEFAULT NULL,
  PRIMARY KEY (`idcontact_details`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `contact_details`
--

LOCK TABLES `contact_details` WRITE;
/*!40000 ALTER TABLE `contact_details` DISABLE KEYS */;
/*!40000 ALTER TABLE `contact_details` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `request`
--

DROP TABLE IF EXISTS `request`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `request` (
  `request_Id` int(11) NOT NULL AUTO_INCREMENT,
  `user_Id` int(111) NOT NULL,
  `vehicle_Id` int(11) NOT NULL,
  `request_Type` varchar(50) NOT NULL,
  `status` varchar(50) NOT NULL,
  `rent_startdate` date DEFAULT NULL,
  `rent_enddate` date DEFAULT NULL,
  `id_contact_details` int(11) DEFAULT NULL,
  PRIMARY KEY (`request_Id`),
  KEY `vehicle_Id` (`vehicle_Id`) USING BTREE,
  KEY `user_Id` (`user_Id`) USING BTREE,
  KEY `r_contactDetails_idx` (`id_contact_details`),
  CONSTRAINT `r_contactDetails` FOREIGN KEY (`id_contact_details`) REFERENCES `contact_details` (`idcontact_details`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `r_userID` FOREIGN KEY (`user_Id`) REFERENCES `user` (`user_Id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `r_vehicleID` FOREIGN KEY (`vehicle_Id`) REFERENCES `vehicle` (`vehicle_Id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `request`
--

LOCK TABLES `request` WRITE;
/*!40000 ALTER TABLE `request` DISABLE KEYS */;
INSERT INTO `request` VALUES (1,1,1,'rent','approved','0000-00-00','0000-00-00',NULL),(2,2,2,'rent','pending','0000-00-00','0000-00-00',NULL),(3,3,3,'rent','approved','0000-00-00','0000-00-00',NULL),(4,4,2,'rent','approved','0000-00-00','0000-00-00',NULL),(5,5,3,'rent','approved',NULL,NULL,NULL),(6,7,5,'rent','',NULL,NULL,NULL),(7,8,4,'rent','',NULL,NULL,NULL);
/*!40000 ALTER TABLE `request` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `transaction`
--

DROP TABLE IF EXISTS `transaction`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `transaction` (
  `trans_Id` int(11) NOT NULL AUTO_INCREMENT,
  `request_Id` int(11) NOT NULL,
  `amount` int(50) NOT NULL,
  `mode_Of_Payment` varchar(50) NOT NULL,
  `status` varchar(50) NOT NULL,
  PRIMARY KEY (`trans_Id`),
  KEY `request_Id` (`request_Id`),
  CONSTRAINT `t_requestID` FOREIGN KEY (`request_Id`) REFERENCES `request` (`request_Id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `transaction`
--

LOCK TABLES `transaction` WRITE;
/*!40000 ALTER TABLE `transaction` DISABLE KEYS */;
INSERT INTO `transaction` VALUES (1,1,1000,'Cash','Paid'),(2,3,3000,'','Unpaid'),(3,4,5000,'Cash','Paid');
/*!40000 ALTER TABLE `transaction` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user` (
  `user_Id` int(11) NOT NULL AUTO_INCREMENT,
  `first_Name` varchar(50) NOT NULL,
  `last_Name` varchar(50) NOT NULL,
  `address` varchar(50) NOT NULL,
  `contact_No` int(50) NOT NULL,
  `acc_Type` varchar(50) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `status` varchar(50) NOT NULL,
  PRIMARY KEY (`user_Id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` VALUES (0,'Raoul','Madayag','Baguio ',123213,'admintest','admintest','admin','activated'),(1,'Justin','Gutierrez','Ilocos',234324,'Client','manghustino','hustino123','deactivated'),(2,'Kevin','Portento','Tarlac ',12345678,'Client','kevports','123kevin','activated'),(3,'Allen','Batac','Baguio',432345234,'Service Provider','emoji30','allen0984','activated'),(4,'Iris','Quiming','Pangasinan',9864455,'Client','mciq','zoldyck2','declined'),(5,'Kevin','Orian','Pampanga',3243265,'Client','kevs','kevs222','declined'),(6,'Julian','Jose','Baguio',111111,'Service Provider','jj47','juliaknows','activated'),(7,'Kirk','Tade','Baguio',3243432,'Client','kirk','kirkbb','deactivated'),(8,'Iyar','Benitez','Baguio',2147483647,'Service Provider','iyar88','iyar123','activated'),(9,'Jed','Benitez','Baguio',123123123,'Client','jed88','jed123','approved'),(10,'Paul','Sam','Baguio',2147483647,'Service Provider','sam123','sam123','activated'),(11,'Caim','Drake','Baguio',11111111,'Client','Caim1','caim1','approved'),(12,'Francisco','Cacas','Baguio',909190919,'Service Provider','Francis11','francis123','pending');
/*!40000 ALTER TABLE `user` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `vehicle`
--

DROP TABLE IF EXISTS `vehicle`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `vehicle` (
  `vehicle_Id` int(11) NOT NULL,
  `brand` varchar(50) NOT NULL,
  `model` varchar(50) NOT NULL,
  `year` varchar(50) NOT NULL,
  `capacity` varchar(50) NOT NULL,
  `rent_Price` varchar(50) NOT NULL,
  `car_Type` varchar(50) NOT NULL,
  `color` varchar(50) NOT NULL,
  `license_Plate` varchar(50) NOT NULL,
  `vehicle_No` varchar(50) NOT NULL,
  `current_Mileage` varchar(50) NOT NULL,
  `vehicle_status` varchar(45) NOT NULL DEFAULT 'undefined',
  `photo` longblob NOT NULL,
  PRIMARY KEY (`vehicle_Id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `vehicle`
--

LOCK TABLES `vehicle` WRITE;
/*!40000 ALTER TABLE `vehicle` DISABLE KEYS */;
INSERT INTO `vehicle` VALUES (1,'Chevrolet','Colorado','2018','5','1000','pickup','red','VVV-123','1','14567','available',''),(2,'Honda','Accord','2018','5','1500','sedan','black','UWH-526','2','14466','deactivated',''),(3,'Toyota','Fortuner','2018','7','3000','suv','white','XGT-547','3','17890','available',''),(4,'Isuzu','Crosswind','2018','7','6000','auv','gray','ZAC-594','4','9230','available',''),(5,'Mistubishi','ASX','2018','5','5000','crossover','black','UNH-210','5','4556','deactivated','');
/*!40000 ALTER TABLE `vehicle` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2018-05-28 23:45:40
