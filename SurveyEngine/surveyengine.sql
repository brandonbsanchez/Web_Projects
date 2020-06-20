-- MySQL dump 10.13  Distrib 8.0.20, for Win64 (x86_64)
--
-- Host: 127.0.0.1    Database: surveyengine
-- ------------------------------------------------------
-- Server version	5.5.5-10.4.13-MariaDB

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `bsanchez_se_questions`
--

DROP TABLE IF EXISTS `bsanchez_se_questions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `bsanchez_se_questions` (
  `question_id` int(11) NOT NULL AUTO_INCREMENT,
  `survey_id` int(11) NOT NULL,
  `question` varchar(100) NOT NULL,
  PRIMARY KEY (`question_id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bsanchez_se_questions`
--

LOCK TABLES `bsanchez_se_questions` WRITE;
/*!40000 ALTER TABLE `bsanchez_se_questions` DISABLE KEYS */;
INSERT INTO `bsanchez_se_questions` VALUES (10,9,'What is your favorite color?'),(11,9,'What is your favorite food?'),(12,9,'What is your favorite car brand?'),(13,11,'What is the hardest thing about online learning?'),(14,11,'Do you prefer online learning?'),(15,11,'Are you taking a gap term because of online learning?');
/*!40000 ALTER TABLE `bsanchez_se_questions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `bsanchez_se_responses`
--

DROP TABLE IF EXISTS `bsanchez_se_responses`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `bsanchez_se_responses` (
  `response_id` int(11) NOT NULL AUTO_INCREMENT,
  `question_id` int(11) NOT NULL,
  `response` varchar(100) NOT NULL,
  `num_responses` int(11) NOT NULL DEFAULT 0,
  PRIMARY KEY (`response_id`,`question_id`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bsanchez_se_responses`
--

LOCK TABLES `bsanchez_se_responses` WRITE;
/*!40000 ALTER TABLE `bsanchez_se_responses` DISABLE KEYS */;
INSERT INTO `bsanchez_se_responses` VALUES (1,10,'Red',0),(2,10,'Green',0),(3,10,'Blue',1),(4,10,'Orange',0),(6,10,'Yellow',0),(7,11,'Mexican',1),(8,11,'Chinese',0),(9,11,'American',0),(10,11,'Italian',0),(11,12,'Toyota',0),(12,12,'Honda',1),(13,12,'Ford',0),(14,12,'Chevrolet',0),(15,13,'Loneliness',0),(16,13,'Lack of concentration',0),(17,13,'Lack of motivation',1),(18,13,'Class can only be done in person',0),(19,14,'Agree',0),(20,14,'Neutral',0),(22,15,'Yes',0),(23,15,'No',1),(24,14,'Disagree',1);
/*!40000 ALTER TABLE `bsanchez_se_responses` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `bsanchez_se_surveys`
--

DROP TABLE IF EXISTS `bsanchez_se_surveys`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `bsanchez_se_surveys` (
  `survey_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `name` varchar(45) NOT NULL,
  `description` varchar(45) NOT NULL,
  `img_dest` varchar(100) NOT NULL,
  `num_responses` int(11) NOT NULL DEFAULT 0,
  PRIMARY KEY (`survey_id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bsanchez_se_surveys`
--

LOCK TABLES `bsanchez_se_surveys` WRITE;
/*!40000 ALTER TABLE `bsanchez_se_surveys` DISABLE KEYS */;
INSERT INTO `bsanchez_se_surveys` VALUES (9,1,'Favorite Things','Choose your favorite things','default.jpg',1),(11,1,'Online Learning','Opinions on online learning','default.jpg',1);
/*!40000 ALTER TABLE `bsanchez_se_surveys` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `bsanchez_se_users`
--

DROP TABLE IF EXISTS `bsanchez_se_users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `bsanchez_se_users` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(45) NOT NULL,
  `password` varchar(1000) NOT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bsanchez_se_users`
--

LOCK TABLES `bsanchez_se_users` WRITE;
/*!40000 ALTER TABLE `bsanchez_se_users` DISABLE KEYS */;
INSERT INTO `bsanchez_se_users` VALUES (1,'brandon','$2y$10$4zG3p2tzAkxOxIGLCjV9n.Qua296cidS2RZlRlMxuNaIdrbruihZS');
/*!40000 ALTER TABLE `bsanchez_se_users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2020-06-19 19:56:19
