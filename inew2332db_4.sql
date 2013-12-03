-- MySQL dump 10.13  Distrib 5.5.34, for debian-linux-gnu (i686)
--
-- Host: localhost    Database: inew2332_db
-- ------------------------------------------------------
-- Server version	5.5.34-0ubuntu0.12.04.1

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
-- Table structure for table `devices`
--

DROP TABLE IF EXISTS `devices`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `devices` (
  `device_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `mac_address` varchar(50) NOT NULL,
  `device_name` varchar(50) NOT NULL,
  `device_status` varchar(11) NOT NULL DEFAULT '',
  `register_date` date DEFAULT NULL,
  `activate_date` date DEFAULT NULL,
  `deactivate_date` date DEFAULT NULL,
  `deregister_date` date DEFAULT NULL,
  `device_type` varchar(11) NOT NULL DEFAULT '',
  `os_system` varchar(11) DEFAULT NULL,
  `os_version` varchar(11) DEFAULT NULL,
  `create_date` datetime DEFAULT NULL,
  `modify_date` datetime DEFAULT NULL,
  `latest_request` varchar(10) DEFAULT NULL,
  `request_date` datetime DEFAULT NULL,
  PRIMARY KEY (`device_id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `devices`
--

LOCK TABLES `devices` WRITE;
/*!40000 ALTER TABLE `devices` DISABLE KEYS */;
INSERT INTO `devices` VALUES (1,1,'00:f4:b9:17:38:69','Lam\'s iPhone','active','2013-11-25',NULL,NULL,NULL,'mobile','ios','7.0.4','2013-11-25 00:00:00','2013-11-25 00:00:00',NULL,NULL),(2,1,'30:46:9a:9:c5:27','Lam\'s Router','inactive','2013-11-25',NULL,NULL,NULL,'laptop','ios','7.0.5','2013-11-25 00:00:00','2013-12-02 19:44:07',NULL,NULL),(4,2,'30:f7:c5:cf:93:31','RyanPhone','active','2013-12-02',NULL,NULL,NULL,'mobile','ios','7.0.4','2013-12-02 00:00:00','2013-12-02 20:48:42','revoke','2013-12-02 20:37:38'),(5,1,'00:f4:b9:17:66:54','Another','revoked','2013-12-02',NULL,NULL,NULL,'mobile','ios','8.1','2013-12-02 00:00:00','2013-12-02 20:13:45','activate','2013-12-02 00:00:00'),(6,1,'c4:34:0d:f3:85:22','Mouse 2','active','2013-12-02',NULL,NULL,NULL,'laptop','android','13.04','2013-12-02 00:00:00','2013-12-02 20:33:53','activate','2013-12-02 00:00:00'),(7,3,'34:23:ba:11:69:b7','Chris','active','2013-12-02',NULL,NULL,NULL,'mobile','android','unknown','2013-12-02 00:00:00','2013-12-02 20:35:23','activate','2013-12-02 00:00:00');
/*!40000 ALTER TABLE `devices` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `employee_id` varchar(25) NOT NULL,
  `first_name` varchar(25) NOT NULL,
  `last_name` varchar(35) NOT NULL,
  `password` varchar(255) NOT NULL DEFAULT '',
  `create_date` datetime DEFAULT NULL,
  `modify_date` datetime DEFAULT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'2564152871','Lam','Nguyen','827ccb0eea8a706c4c34a16891f84e7b','2013-11-25 14:53:14','2013-11-25 14:53:18'),(2,'7884782742','Ryan','Duncan','827ccb0eea8a706c4c34a16891f84e7b','2013-11-25 14:53:14','2013-11-25 14:53:14'),(3,'7875544542','Chris','Maldonado','827ccb0eea8a706c4c34a16891f84e7b','2013-11-25 14:53:14','2013-11-25 14:53:14');
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

-- Dump completed on 2013-12-02 21:14:31
