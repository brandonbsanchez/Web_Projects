-- MySQL dump 10.13  Distrib 8.0.20, for Win64 (x86_64)
--
-- Host: 127.0.0.1    Database: storefront
-- ------------------------------------------------------
-- Server version	5.5.5-10.4.11-MariaDB

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
-- Table structure for table `bsanchez_carts`
--

DROP TABLE IF EXISTS `bsanchez_carts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `bsanchez_carts` (
  `user_id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  PRIMARY KEY (`user_id`,`item_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bsanchez_carts`
--

LOCK TABLES `bsanchez_carts` WRITE;
/*!40000 ALTER TABLE `bsanchez_carts` DISABLE KEYS */;
INSERT INTO `bsanchez_carts` VALUES (1,2,2);
/*!40000 ALTER TABLE `bsanchez_carts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `bsanchez_items`
--

DROP TABLE IF EXISTS `bsanchez_items`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `bsanchez_items` (
  `item_id` int(11) NOT NULL AUTO_INCREMENT,
  `store_id` int(11) NOT NULL,
  `name` varchar(45) NOT NULL,
  `description` varchar(45) NOT NULL,
  `img_dest` varchar(100) NOT NULL,
  `num_in_stock` int(11) NOT NULL,
  `unit_price` double NOT NULL,
  PRIMARY KEY (`item_id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bsanchez_items`
--

LOCK TABLES `bsanchez_items` WRITE;
/*!40000 ALTER TABLE `bsanchez_items` DISABLE KEYS */;
INSERT INTO `bsanchez_items` VALUES (1,2,'Tomatoes','Red fruits (vegetables?)','5ee647b2eae924.55648083.jpeg',115,0.73),(2,2,'Carrots','Orange vegetables','5ee6495968d753.17694077.jpg',71,0.51),(3,3,'Classic Watch','Timeless','5ee650371bdbd7.73918522.jpg',9,2000),(4,3,'Rolex Submariner','Vintage Watch','5ee65139013307.29419963.jpg',6,9000),(5,4,'Fish Bowl','Medium Sized','5ee65368aa3291.56952683.png',43,7),(6,4,'Dog Food','45lb Bag','5ee65417876548.47659493.png',76,32);
/*!40000 ALTER TABLE `bsanchez_items` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `bsanchez_order_items`
--

DROP TABLE IF EXISTS `bsanchez_order_items`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `bsanchez_order_items` (
  `order_id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  PRIMARY KEY (`order_id`,`item_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bsanchez_order_items`
--

LOCK TABLES `bsanchez_order_items` WRITE;
/*!40000 ALTER TABLE `bsanchez_order_items` DISABLE KEYS */;
INSERT INTO `bsanchez_order_items` VALUES (1,1,4),(1,2,2),(1,6,2),(2,5,2),(3,2,23),(4,1,2),(5,2,1),(6,1,1);
/*!40000 ALTER TABLE `bsanchez_order_items` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `bsanchez_orders`
--

DROP TABLE IF EXISTS `bsanchez_orders`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `bsanchez_orders` (
  `order_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `date_time` datetime NOT NULL,
  PRIMARY KEY (`order_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bsanchez_orders`
--

LOCK TABLES `bsanchez_orders` WRITE;
/*!40000 ALTER TABLE `bsanchez_orders` DISABLE KEYS */;
INSERT INTO `bsanchez_orders` VALUES (1,1,'2020-06-14 09:51:32'),(2,1,'2020-06-14 09:53:03'),(3,1,'2020-06-14 09:54:30'),(4,1,'2020-06-14 11:56:45'),(5,1,'2020-06-14 11:57:30'),(6,1,'2020-06-14 11:57:44');
/*!40000 ALTER TABLE `bsanchez_orders` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `bsanchez_stores`
--

DROP TABLE IF EXISTS `bsanchez_stores`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `bsanchez_stores` (
  `store_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `name` varchar(45) NOT NULL,
  `description` varchar(45) NOT NULL,
  `img_dest` varchar(100) NOT NULL,
  PRIMARY KEY (`store_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bsanchez_stores`
--

LOCK TABLES `bsanchez_stores` WRITE;
/*!40000 ALTER TABLE `bsanchez_stores` DISABLE KEYS */;
INSERT INTO `bsanchez_stores` VALUES (2,1,'Bob\'s Grocers','For all your grocery needs','5ee643673039c6.28302995.png'),(3,1,'Watch Emporium','Sells the highest quality watches','5ee64edb9d3322.25359104.png'),(4,1,'Pet Store','Your pets will love it','5ee6529bf271e6.38201328.png');
/*!40000 ALTER TABLE `bsanchez_stores` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `bsanchez_users`
--

DROP TABLE IF EXISTS `bsanchez_users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `bsanchez_users` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(45) NOT NULL,
  `password` varchar(1000) NOT NULL,
  `balance` decimal(7,2) NOT NULL DEFAULT 0.00,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bsanchez_users`
--

LOCK TABLES `bsanchez_users` WRITE;
/*!40000 ALTER TABLE `bsanchez_users` DISABLE KEYS */;
INSERT INTO `bsanchez_users` VALUES (1,'brandon','$2y$10$hc/XUidd8KzR6sByfHBd.uD2wOKIb/sVfqTpGNrQypjrDtssVVH/m',95.36);
/*!40000 ALTER TABLE `bsanchez_users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2020-06-14 11:59:11
