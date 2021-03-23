-- MariaDB dump 10.17  Distrib 10.4.15-MariaDB, for Linux (x86_64)
--
-- Host: localhost    Database: servientregadelivery
-- ------------------------------------------------------
-- Server version	10.4.15-MariaDB

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `charges`
--

DROP TABLE IF EXISTS `charges`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `charges` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `charge_id` bigint(20) NOT NULL,
  `test` tinyint(1) NOT NULL DEFAULT 0,
  `status` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `terms` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` decimal(8,2) NOT NULL,
  `capped_amount` decimal(8,2) DEFAULT NULL,
  `trial_days` int(11) DEFAULT NULL,
  `billing_on` timestamp NULL DEFAULT NULL,
  `activated_on` timestamp NULL DEFAULT NULL,
  `trial_ends_on` timestamp NULL DEFAULT NULL,
  `cancelled_on` timestamp NULL DEFAULT NULL,
  `expires_on` timestamp NULL DEFAULT NULL,
  `plan_id` int(10) unsigned DEFAULT NULL,
  `description` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `reference_charge` bigint(20) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `user_id` bigint(20) unsigned NOT NULL,
  `interval` varchar(45) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `charges_user_id_foreign` (`user_id`),
  KEY `charges_plan_id_foreign` (`plan_id`),
  CONSTRAINT `charges_plan_id_foreign` FOREIGN KEY (`plan_id`) REFERENCES `plans` (`id`),
  CONSTRAINT `charges_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `charges`
--

LOCK TABLES `charges` WRITE;
/*!40000 ALTER TABLE `charges` DISABLE KEYS */;
INSERT INTO `charges` VALUES (5,18481807511,1,'CANCELLED','Servientrega Delivery - Pro',NULL,'RECURRING',7.99,50.00,14,'2020-09-26 00:00:00','2020-09-12 00:00:00','2020-09-26 00:00:00','2020-09-12 00:00:00','2020-09-12 00:00:00',5,NULL,NULL,'2020-09-12 01:12:02','2020-09-12 01:28:24','2020-09-12 01:28:24',9,'EVERY_30_DAYS'),(6,18482102423,1,'ACTIVE','Servientrega Delivery - Pro',NULL,'RECURRING',7.99,50.00,14,'2020-09-26 00:00:00','2020-09-12 00:00:00','2020-09-26 00:00:00',NULL,NULL,5,NULL,NULL,'2020-09-12 01:33:46','2020-09-12 01:33:46',NULL,9,'EVERY_30_DAYS'),(7,13287850046,1,'CANCELLED','Servientrega Delivery - Pro',NULL,'RECURRING',7.99,50.00,14,'2020-09-28 00:00:00','2020-09-14 00:00:00','2020-09-28 00:00:00','2020-09-14 00:00:00','2020-09-14 00:00:00',5,NULL,NULL,'2020-09-14 17:17:06','2020-09-14 17:19:31','2020-09-14 17:19:31',10,'EVERY_30_DAYS'),(8,13983350877,1,'CANCELLED','Servientrega Delivery - Pro',NULL,'RECURRING',7.99,50.00,14,'2020-10-02 00:00:00','2020-09-18 00:00:00','2020-10-02 00:00:00','2020-09-21 00:00:00','2020-09-21 00:00:00',5,NULL,NULL,'2020-09-18 15:44:05','2020-09-21 13:24:05','2020-09-21 13:24:05',11,'EVERY_30_DAYS'),(9,18703024279,1,'ACTIVE','Servientrega Delivery - Pro',NULL,'RECURRING',7.99,50.00,14,'2020-10-05 00:00:00','2020-09-21 00:00:00','2020-10-05 00:00:00',NULL,NULL,5,NULL,NULL,'2020-09-21 15:34:26','2020-09-21 15:34:26',NULL,12,NULL),(12,13992329309,1,'CANCELLED','Servientrega Delivery - Pro',NULL,'RECURRING',7.99,50.00,11,'2020-10-03 00:00:00','2020-09-22 00:00:00','2020-10-03 00:00:00','2020-09-22 00:00:00','2020-09-22 00:00:00',5,NULL,NULL,'2020-09-22 20:20:00','2020-09-22 20:42:59','2020-09-22 20:42:59',11,'EVERY_30_DAYS'),(17,14009008221,1,'CANCELLED','Servientrega Delivery - Pro',NULL,'RECURRING',7.99,50.00,11,'2020-10-10 00:00:00','2020-09-29 00:00:00','2020-10-10 00:00:00','2020-10-02 00:00:00','2020-10-02 00:00:00',5,NULL,NULL,'2020-09-29 18:51:22','2020-10-02 19:15:08','2020-10-02 19:15:08',11,'EVERY_30_DAYS'),(18,18971918501,1,'CANCELLED','Servientrega Delivery - Pro',NULL,'RECURRING',7.99,50.00,14,'2020-10-14 00:00:00','2020-09-30 00:00:00','2020-10-14 00:00:00','2020-09-30 00:00:00','2020-09-30 00:00:00',5,NULL,NULL,'2020-09-30 15:29:29','2020-09-30 15:34:26','2020-09-30 15:34:26',21,'EVERY_30_DAYS'),(19,18972016805,1,'CANCELLED','Servientrega Delivery - Pro',NULL,'RECURRING',7.99,50.00,14,'2020-10-14 00:00:00','2020-09-30 00:00:00','2020-10-14 00:00:00','2020-10-07 00:00:00','2020-10-07 00:00:00',5,NULL,NULL,'2020-09-30 15:35:07','2020-10-07 01:49:34','2020-10-07 01:49:34',21,'EVERY_30_DAYS'),(20,13707182127,0,'CANCELLED','Servientrega Delivery - Pro',NULL,'RECURRING',7.99,50.00,14,'2020-10-27 00:00:00','2020-10-13 00:00:00','2020-10-27 00:00:00','2020-10-13 00:00:00','2020-10-13 00:00:00',5,NULL,NULL,'2020-10-13 17:04:04','2020-10-13 17:21:26','2020-10-13 17:21:26',22,'EVERY_30_DAYS'),(21,19178815652,0,'CANCELLED','Servientrega Delivery - Pro',NULL,'RECURRING',7.99,50.00,14,'2020-10-31 00:00:00','2020-10-17 00:00:00','2020-10-31 00:00:00','2020-10-24 00:00:00','2020-10-24 00:00:00',5,NULL,NULL,'2020-10-17 23:41:30','2020-10-24 20:59:06','2020-10-24 20:59:06',23,'EVERY_30_DAYS'),(22,19554762928,0,'CANCELLED','Servientrega Delivery - Pro',NULL,'RECURRING',7.99,50.00,14,'2020-11-07 00:00:00','2020-10-24 00:00:00','2020-11-07 00:00:00','2021-02-17 00:00:00','2021-02-17 00:00:00',5,NULL,NULL,'2020-10-24 17:25:59','2021-02-17 14:31:36','2021-02-17 14:31:36',24,'EVERY_30_DAYS'),(23,19560169622,0,'CANCELLED','Servientrega Delivery - Pro',NULL,'RECURRING',7.99,50.00,14,'2020-11-12 00:00:00','2020-10-29 00:00:00','2020-11-12 00:00:00','2020-11-18 00:00:00','2020-11-18 00:00:00',5,NULL,NULL,'2020-10-29 20:56:39','2020-11-18 21:45:27','2020-11-18 21:45:27',26,'EVERY_30_DAYS'),(24,19519504533,0,'CANCELLED','Servientrega Delivery - Pro',NULL,'RECURRING',7.99,50.00,14,'2020-11-14 00:00:00','2020-10-31 00:00:00','2020-11-14 00:00:00','2020-10-31 00:00:00','2020-10-31 00:00:00',5,NULL,NULL,'2020-10-31 12:28:51','2020-10-31 12:32:06','2020-10-31 12:32:06',27,'EVERY_30_DAYS'),(25,19921993907,0,'ACTIVE','Servientrega Delivery - Pro',NULL,'RECURRING',7.99,50.00,14,'2020-11-28 00:00:00','2020-11-14 00:00:00','2020-11-28 00:00:00',NULL,NULL,5,NULL,NULL,'2020-11-14 00:07:52','2020-11-14 00:07:52',NULL,31,'EVERY_30_DAYS'),(26,19956760770,0,'CANCELLED','Servientrega Delivery - Pro',NULL,'RECURRING',7.99,50.00,14,'2020-12-02 00:00:00','2020-11-18 00:00:00','2020-12-02 00:00:00','2020-11-24 00:00:00','2020-11-24 00:00:00',5,NULL,NULL,'2020-11-18 06:07:59','2020-11-24 16:49:01','2020-11-24 16:49:01',32,'EVERY_30_DAYS'),(27,20048478369,0,'CANCELLED','Servientrega Delivery - Pro',NULL,'RECURRING',7.99,50.00,14,'2020-12-11 00:00:00','2020-11-27 00:00:00','2020-12-11 00:00:00','2020-11-28 00:00:00','2020-11-28 00:00:00',5,NULL,NULL,'2020-11-27 00:36:49','2020-11-28 16:51:21','2020-11-28 16:51:21',35,'EVERY_30_DAYS'),(28,20393525407,0,'ACTIVE','Servientrega Delivery - Pro',NULL,'RECURRING',7.99,50.00,14,'2020-12-31 00:00:00','2020-12-17 00:00:00','2020-12-31 00:00:00',NULL,NULL,5,NULL,NULL,'2020-12-17 14:57:24','2020-12-17 14:57:24',NULL,29,'EVERY_30_DAYS'),(29,20481441942,0,'ACTIVE','Servientrega Delivery - Pro',NULL,'RECURRING',7.99,50.00,0,'2021-01-22 00:00:00','2020-12-23 00:00:00','2020-12-23 00:00:00',NULL,NULL,5,NULL,NULL,'2020-12-23 21:59:07','2020-12-23 21:59:07',NULL,26,'EVERY_30_DAYS'),(30,20553105558,0,'ACTIVE','Servientrega Delivery - Pro',NULL,'RECURRING',7.99,50.00,14,'2021-01-13 00:00:00','2020-12-30 00:00:00','2021-01-13 00:00:00',NULL,NULL,5,NULL,NULL,'2020-12-30 17:31:11','2020-12-30 17:31:11',NULL,40,'EVERY_30_DAYS'),(31,16696246410,0,'ACTIVE','Servientrega Delivery - Pro',NULL,'RECURRING',7.99,50.00,14,'2021-01-20 00:00:00','2021-01-06 00:00:00','2021-01-20 00:00:00',NULL,NULL,5,NULL,NULL,'2021-01-06 20:37:14','2021-01-06 20:37:14',NULL,41,'EVERY_30_DAYS');
/*!40000 ALTER TABLE `charges` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `failed_jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `connection` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `failed_jobs`
--

LOCK TABLES `failed_jobs` WRITE;
/*!40000 ALTER TABLE `failed_jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `failed_jobs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `password_resets`
--

DROP TABLE IF EXISTS `password_resets`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `password_resets` (
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `password_resets`
--

LOCK TABLES `password_resets` WRITE;
/*!40000 ALTER TABLE `password_resets` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_resets` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `plans`
--

DROP TABLE IF EXISTS `plans`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `plans` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `type` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` decimal(8,2) NOT NULL,
  `capped_amount` decimal(8,2) DEFAULT NULL,
  `terms` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `trial_days` int(11) DEFAULT NULL,
  `test` tinyint(1) NOT NULL DEFAULT 0,
  `on_install` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `plans`
--

LOCK TABLES `plans` WRITE;
/*!40000 ALTER TABLE `plans` DISABLE KEYS */;
INSERT INTO `plans` VALUES (5,'RECURRING','Servientrega Delivery - Pro',7.99,50.00,'After the first 1,000 deliveries each month, charges of $0.050 USD will be charged for each delivery',14,0,1,NULL,NULL);
/*!40000 ALTER TABLE `plans` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `products`
--

DROP TABLE IF EXISTS `products`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `products` (
  `PROD_PRODUCT` bigint(20) unsigned DEFAULT NULL,
  `PROD_STORE` bigint(20) unsigned DEFAULT NULL,
  `PROD_NAME` varchar(250) DEFAULT NULL,
  `PROD_IMAGE` varchar(1024) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `products`
--

LOCK TABLES `products` WRITE;
/*!40000 ALTER TABLE `products` DISABLE KEYS */;
/*!40000 ALTER TABLE `products` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `request_redact`
--

DROP TABLE IF EXISTS `request_redact`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `request_redact` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `date` timestamp NOT NULL DEFAULT current_timestamp(),
  `shop_id` bigint(20) DEFAULT NULL,
  `shopify_domain` text DEFAULT NULL,
  `topic` varchar(50) DEFAULT NULL,
  `payload` text DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `response` text DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `request_redact`
--

LOCK TABLES `request_redact` WRITE;
/*!40000 ALTER TABLE `request_redact` DISABLE KEYS */;
/*!40000 ALTER TABLE `request_redact` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `shopify_grandfathered` tinyint(1) NOT NULL DEFAULT 0,
  `shopify_namespace` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `shopify_freemium` tinyint(1) NOT NULL DEFAULT 0,
  `plan_id` int(10) unsigned DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`),
  KEY `users_plan_id_foreign` (`plan_id`),
  CONSTRAINT `users_plan_id_foreign` FOREIGN KEY (`plan_id`) REFERENCES `plans` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=44 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (9,'stuart-api.myshopify.com','shop@stuart-api.myshopify.com',NULL,'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',NULL,'2020-09-12 01:11:00','2020-09-12 01:33:46',0,NULL,0,5,NULL),(10,'vex-soluciones.myshopify.com','shop@vex-soluciones.myshopify.com',NULL,'',NULL,'2020-09-14 17:15:53','2020-09-14 17:19:31',0,NULL,0,NULL,'2020-09-14 17:19:31'),(11,'crafty-belle.myshopify.com','shop@crafty-belle.myshopify.com',NULL,'',NULL,'2020-09-18 15:43:42','2020-10-02 19:15:08',0,NULL,0,NULL,'2020-10-02 19:15:08'),(12,'test-store-france.myshopify.com','shop@test-store-france.myshopify.com',NULL,'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',NULL,'2020-09-21 15:33:38','2020-09-21 15:34:26',0,NULL,0,5,NULL),(13,'appstoretest5.myshopify.com','shop@appstoretest5.myshopify.com',NULL,'',NULL,'2020-09-21 17:17:07','2020-09-21 22:06:04',0,NULL,0,NULL,'2020-09-21 22:06:04'),(21,'test-store-colombia.myshopify.com','shop@test-store-colombia.myshopify.com',NULL,'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',NULL,'2020-09-30 15:28:26','2020-10-13 17:51:57',0,NULL,0,NULL,NULL),(22,'idealparatucuerpo.myshopify.com','shop@idealparatucuerpo.myshopify.com',NULL,'',NULL,'2020-10-13 17:03:35','2020-10-13 17:21:26',0,NULL,0,NULL,'2020-10-13 17:21:26'),(23,'allcommercialco.myshopify.com','shop@allcommercialco.myshopify.com',NULL,'',NULL,'2020-10-17 23:41:08','2020-10-24 20:59:06',0,NULL,0,NULL,'2020-10-24 20:59:06'),(24,'chicvestier.myshopify.com','shop@chicvestier.myshopify.com',NULL,'',NULL,'2020-10-24 17:25:05','2021-02-17 14:31:36',0,NULL,0,NULL,'2021-02-17 14:31:36'),(25,'sabor-a-banana.myshopify.com','shop@sabor-a-banana.myshopify.com',NULL,'',NULL,'2020-10-27 18:00:56','2020-10-27 18:03:22',0,NULL,0,NULL,'2020-10-27 18:03:22'),(26,'mapacheparts.myshopify.com','shop@mapacheparts.myshopify.com',NULL,'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',NULL,'2020-10-29 20:55:07','2020-12-23 21:59:07',0,NULL,0,5,NULL),(27,'rubik-cube-star.myshopify.com','shop@rubik-cube-star.myshopify.com',NULL,'',NULL,'2020-10-31 12:23:57','2020-10-31 12:32:06',0,NULL,0,NULL,'2020-10-31 12:32:06'),(28,'minimax-colombia.myshopify.com','shop@minimax-colombia.myshopify.com',NULL,'',NULL,'2020-11-04 19:27:14','2020-11-04 19:34:08',0,NULL,0,NULL,'2020-11-04 19:34:08'),(29,'cool-dry.myshopify.com','shop@cool-dry.myshopify.com',NULL,'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',NULL,'2020-11-11 16:21:57','2020-12-17 14:57:24',0,NULL,0,5,NULL),(30,'tellenzi.myshopify.com','shop@tellenzi.myshopify.com',NULL,'',NULL,'2020-11-11 17:23:52','2020-11-11 18:44:10',0,NULL,0,NULL,'2020-11-11 18:44:10'),(31,'onstockstore.myshopify.com','shop@onstockstore.myshopify.com',NULL,'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',NULL,'2020-11-13 23:46:17','2020-11-14 00:07:52',0,NULL,0,5,NULL),(32,'pintar-por-numeros-colombia.myshopify.com','shop@pintar-por-numeros-colombia.myshopify.com',NULL,'',NULL,'2020-11-18 06:07:27','2020-11-24 16:49:01',0,NULL,0,NULL,'2020-11-24 16:49:01'),(33,'blinkers-store.myshopify.com','shop@blinkers-store.myshopify.com',NULL,'',NULL,'2020-11-25 21:04:12','2020-11-25 21:16:57',0,NULL,0,NULL,'2020-11-25 21:16:57'),(34,'altamano.myshopify.com','shop@altamano.myshopify.com',NULL,'',NULL,'2020-11-26 00:44:47','2020-11-26 03:05:26',0,NULL,0,NULL,'2020-11-26 03:05:26'),(35,'cristalvioleta.myshopify.com','shop@cristalvioleta.myshopify.com',NULL,'',NULL,'2020-11-26 21:53:54','2020-11-28 16:51:21',0,NULL,0,NULL,'2020-11-28 16:51:21'),(36,'ropstar-colombia.myshopify.com','shop@ropstar-colombia.myshopify.com',NULL,'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',NULL,'2020-11-30 15:04:47','2020-11-30 15:04:54',0,NULL,0,NULL,NULL),(37,'mallcolombiano.myshopify.com','shop@mallcolombiano.myshopify.com',NULL,'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',NULL,'2020-12-01 20:22:12','2020-12-01 20:22:25',0,NULL,0,NULL,NULL),(38,'asylum-ecomm-lab.myshopify.com','shop@asylum-ecomm-lab.myshopify.com',NULL,'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',NULL,'2020-12-05 23:33:41','2020-12-05 23:33:48',0,NULL,0,NULL,NULL),(39,'coolanddry.co','shop@coolanddry.co',NULL,'',NULL,'2020-12-17 14:56:00','2020-12-17 14:56:00',0,NULL,0,NULL,NULL),(40,'imbrastore.myshopify.com','shop@imbrastore.myshopify.com',NULL,'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',NULL,'2020-12-30 17:30:48','2020-12-30 17:31:11',0,NULL,0,5,NULL),(41,'silent-com-co.myshopify.com','shop@silent-com-co.myshopify.com',NULL,'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',NULL,'2021-01-06 20:34:46','2021-01-06 20:37:14',0,NULL,0,5,NULL),(42,'mansion-cat.myshopify.com','shop@mansion-cat.myshopify.com',NULL,'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',NULL,'2021-01-24 15:21:07','2021-01-24 15:21:13',0,NULL,0,NULL,NULL),(43,'ojalu.myshopify.com','shop@ojalu.myshopify.com',NULL,'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',NULL,'2021-01-24 17:23:38','2021-01-24 17:35:04',0,NULL,0,NULL,NULL);
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `vexsol_countrys`
--

DROP TABLE IF EXISTS `vexsol_countrys`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `vexsol_countrys` (
  `COUNTRY_CODE` int(11) NOT NULL AUTO_INCREMENT,
  `COUNTRY_NAME` varchar(100) NOT NULL,
  PRIMARY KEY (`COUNTRY_CODE`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `vexsol_countrys`
--

LOCK TABLES `vexsol_countrys` WRITE;
/*!40000 ALTER TABLE `vexsol_countrys` DISABLE KEYS */;
INSERT INTO `vexsol_countrys` VALUES (1,'Colombia'),(2,'Panama');
/*!40000 ALTER TABLE `vexsol_countrys` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `vexsol_langs`
--

DROP TABLE IF EXISTS `vexsol_langs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `vexsol_langs` (
  `LANG_CODE` varchar(2) NOT NULL,
  `LANG_NAME` varchar(35) DEFAULT NULL,
  PRIMARY KEY (`LANG_CODE`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `vexsol_langs`
--

LOCK TABLES `vexsol_langs` WRITE;
/*!40000 ALTER TABLE `vexsol_langs` DISABLE KEYS */;
INSERT INTO `vexsol_langs` VALUES ('es','Español');
/*!40000 ALTER TABLE `vexsol_langs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `vexsol_shopify_order_status`
--

DROP TABLE IF EXISTS `vexsol_shopify_order_status`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `vexsol_shopify_order_status` (
  `status` varchar(50) NOT NULL,
  `description` varchar(50) NOT NULL,
  `enabled` int(11) DEFAULT 1,
  PRIMARY KEY (`status`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `vexsol_shopify_order_status`
--

LOCK TABLES `vexsol_shopify_order_status` WRITE;
/*!40000 ALTER TABLE `vexsol_shopify_order_status` DISABLE KEYS */;
INSERT INTO `vexsol_shopify_order_status` VALUES ('authorized','authorized',1),('manual','manual',1),('paid','paid',1);
/*!40000 ALTER TABLE `vexsol_shopify_order_status` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `vexsol_shopify_products_metadata`
--

DROP TABLE IF EXISTS `vexsol_shopify_products_metadata`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `vexsol_shopify_products_metadata` (
  `PROD_SHOP` int(10) unsigned NOT NULL DEFAULT 0,
  `PROD_PRODUCT` bigint(20) unsigned NOT NULL,
  `PROD_METADATA_ID` bigint(20) unsigned NOT NULL,
  `PROD_METADATA_KEY` varchar(50) NOT NULL,
  `PROD_METADATA_VALUE` varchar(250) DEFAULT NULL,
  `PROD_METADATA_TYPE` varchar(50) DEFAULT NULL,
  `PROD_CREATED` timestamp NOT NULL DEFAULT current_timestamp(),
  UNIQUE KEY `Índice 1` (`PROD_PRODUCT`,`PROD_METADATA_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `vexsol_shopify_products_metadata`
--

LOCK TABLES `vexsol_shopify_products_metadata` WRITE;
/*!40000 ALTER TABLE `vexsol_shopify_products_metadata` DISABLE KEYS */;
INSERT INTO `vexsol_shopify_products_metadata` VALUES (7,5387195875479,14813268934807,'available_for_servientrega','true','string','2020-09-05 17:09:30'),(7,5387195875479,14864329736343,'dimensions','20x20x20','string','2020-09-05 17:09:30'),(7,5505111621783,14813271425175,'available_for_servientrega','true','string','2020-09-05 17:09:44'),(7,5505111621783,14864331702423,'dimensions','20x20x20','string','2020-09-05 17:09:44'),(7,5505134657687,14813265887383,'available_for_servientrega','true','string','2020-09-05 06:18:45'),(7,5505134657687,14864304406679,'dimensions','10x15x20','string','2020-09-05 06:18:44'),(7,5505142915223,14813268213911,'available_for_servientrega','true','string','2020-09-05 17:10:02'),(7,5505142915223,14864326983831,'dimensions','30x45x25','string','2020-09-05 17:09:56'),(15,5705088925861,14954307977381,'dimensions','10x50x30','string','2020-09-28 19:57:34'),(15,5705088925861,14954308075685,'available_for_servientrega','true','string','2020-09-28 19:57:35');
/*!40000 ALTER TABLE `vexsol_shopify_products_metadata` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `vexsol_store_general`
--

DROP TABLE IF EXISTS `vexsol_store_general`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `vexsol_store_general` (
  `STORE_ID` bigint(20) unsigned NOT NULL,
  `STORE_EMAIL` varchar(1024) DEFAULT NULL,
  `STORE_DOMAIN` varchar(255) NOT NULL,
  `STORE_INSTALLED` tinyint(4) NOT NULL DEFAULT 0,
  `STORE_INSTALED_DATE` datetime DEFAULT NULL,
  `STORE_UNINSTALED` tinyint(4) DEFAULT NULL,
  `STORE_UNINSTALED_DATE` datetime DEFAULT NULL,
  `STORE_CARRIER_ID` bigint(20) unsigned DEFAULT NULL,
  `STORE_SCRIPTTAG` bigint(20) unsigned DEFAULT NULL,
  `STORE_TIMEZONE` varchar(100) DEFAULT NULL,
  `STORE_IANA_TIMEZONE` varchar(100) DEFAULT NULL,
  `STORE_NPRODUCTS` int(10) unsigned DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `vexsol_store_general`
--

LOCK TABLES `vexsol_store_general` WRITE;
/*!40000 ALTER TABLE `vexsol_store_general` DISABLE KEYS */;
INSERT INTO `vexsol_store_general` VALUES (43623907479,NULL,'stuart-api.myshopify.com',1,'2020-09-12 01:11:16',0,'2020-09-12 01:28:26',50248777879,139659509911,'(GMT+01:00) Europe/Paris','Europe/Paris',NULL,'2020-09-12 01:11:16','2020-09-12 01:47:13',NULL),(11445764158,NULL,'vex-soluciones.myshopify.com',0,'2020-09-14 17:16:13',1,'2020-09-14 17:19:31',NULL,NULL,'(GMT-05:00) America/Lima','America/Lima',NULL,'2020-09-14 17:16:13','2020-09-14 17:19:31',NULL),(29128917085,NULL,'crafty-belle.myshopify.com',0,'2020-09-18 15:43:52',1,'2020-10-02 19:15:08',33764606045,123643297885,'(GMT-05:00) America/New_York','America/New_York',NULL,'2020-09-18 15:43:52','2020-10-02 19:15:08',NULL),(48460398743,NULL,'test-store-france.myshopify.com',1,'2020-09-21 15:33:41',NULL,NULL,NULL,NULL,'(GMT+01:00) Europe/Paris','Europe/Paris',NULL,'2020-09-21 15:33:41','2020-09-21 15:33:41',NULL),(23191469,NULL,'appstoretest5.myshopify.com',0,'2020-09-21 17:17:18',1,'2020-09-21 22:06:04',NULL,42415620152,'(GMT-05:00) America/Toronto','America/Toronto',NULL,'2020-09-21 17:17:18','2020-09-21 22:06:04',NULL),(49485316261,NULL,'test-store-colombia.myshopify.com',1,'2020-10-06 18:21:42',0,'2020-10-07 01:49:35',51770982565,141713014949,'(GMT-05:00) Eastern Time (US & Canada)','America/New_York',NULL,'2020-10-06 18:21:42','2020-10-13 17:52:13',NULL),(18377653,NULL,'idealparatucuerpo.myshopify.com',0,'2020-10-13 17:03:46',1,'2020-10-13 17:21:26',NULL,NULL,'(GMT-05:00) America/Bogota','America/Bogota',NULL,'2020-10-13 17:03:46','2020-10-13 17:21:26',NULL),(26509934637,NULL,'allcommercialco.myshopify.com',0,'2020-10-17 23:41:17',1,'2020-10-24 20:59:06',NULL,NULL,'(GMT-05:00) America/Bogota','America/Bogota',NULL,'2020-10-17 23:41:17','2020-10-24 20:59:06',NULL),(50529861808,NULL,'chicvestier.myshopify.com',0,'2020-10-24 17:25:31',1,'2021-02-17 14:31:36',NULL,NULL,'(GMT-05:00) America/Bogota','America/Bogota',NULL,'2020-10-24 17:25:31','2021-02-17 14:31:36',NULL),(47263711399,NULL,'sabor-a-banana.myshopify.com',0,'2020-10-27 18:01:06',1,'2020-10-27 18:03:22',NULL,NULL,'(GMT-05:00) America/Bogota','America/Bogota',NULL,'2020-10-27 18:01:06','2020-10-27 18:03:22',NULL),(43754684566,NULL,'mapacheparts.myshopify.com',1,'2020-10-29 20:55:21',0,'2020-11-18 21:45:27',54091743382,147027755158,'(GMT-05:00) America/Bogota','America/Bogota',NULL,'2020-10-29 20:55:21','2020-12-23 21:58:46',NULL),(22557607,NULL,'rubik-cube-star.myshopify.com',0,'2020-10-31 12:24:11',1,'2020-10-31 12:32:06',NULL,NULL,'(GMT-05:00) America/Bogota','America/Bogota',NULL,'2020-10-31 12:24:11','2020-10-31 12:32:06',NULL),(50893979825,NULL,'minimax-colombia.myshopify.com',0,'2020-11-04 19:27:40',1,'2020-11-04 19:34:08',NULL,NULL,'(GMT-05:00) America/Bogota','America/Bogota',NULL,'2020-11-04 19:27:40','2020-11-04 19:34:08',NULL),(45547258015,NULL,'cool-dry.myshopify.com',1,'2020-11-11 16:22:11',NULL,NULL,52142637215,NULL,'(GMT-05:00) America/Bogota','America/Bogota',NULL,'2020-11-11 16:22:11','2020-12-17 15:09:53',NULL),(36081959052,NULL,'tellenzi.myshopify.com',0,'2020-11-11 17:26:32',1,'2020-11-11 18:44:10',NULL,NULL,'(GMT-05:00) America/Bogota','America/Bogota',NULL,'2020-11-11 17:26:32','2020-11-11 18:44:10',NULL),(51220152499,NULL,'onstockstore.myshopify.com',1,'2020-11-13 23:46:27',NULL,NULL,NULL,NULL,'(GMT-05:00) America/Bogota','America/Bogota',NULL,'2020-11-13 23:46:27','2020-11-13 23:46:27',NULL),(26710704322,NULL,'pintar-por-numeros-colombia.myshopify.com',0,'2020-11-18 06:07:37',1,'2020-11-24 16:49:01',NULL,NULL,'(GMT-05:00) America/Bogota','America/Bogota',NULL,'2020-11-18 06:07:37','2020-11-24 16:49:01',NULL),(9390522465,NULL,'blinkers-store.myshopify.com',0,'2020-11-25 21:15:59',1,'2020-11-25 21:16:57',NULL,NULL,'(GMT-05:00) America/Bogota','America/Bogota',NULL,'2020-11-25 21:15:59','2020-11-25 21:16:57',NULL),(51110903959,NULL,'altamano.myshopify.com',0,'2020-11-26 00:45:07',1,'2020-11-26 03:05:26',NULL,NULL,'(GMT-05:00) America/Toronto','America/Toronto',NULL,'2020-11-26 00:45:07','2020-11-26 03:05:26',NULL),(50662867105,NULL,'cristalvioleta.myshopify.com',0,'2020-11-26 21:54:11',1,'2020-11-28 16:51:21',NULL,NULL,'(GMT-05:00) America/Bogota','America/Bogota',NULL,'2020-11-26 21:54:11','2020-11-28 16:51:21',NULL),(50906202278,NULL,'ropstar-colombia.myshopify.com',1,'2020-11-30 15:04:55',NULL,NULL,NULL,NULL,'(GMT-05:00) America/Bogota','America/Bogota',NULL,'2020-11-30 15:04:55','2020-11-30 15:04:55',NULL),(51532038330,NULL,'mallcolombiano.myshopify.com',1,'2020-12-01 20:22:26',NULL,NULL,53309440186,NULL,'(GMT-05:00) America/Bogota','America/Bogota',NULL,'2020-12-01 20:22:26','2020-12-01 20:22:29',NULL),(51501334706,NULL,'asylum-ecomm-lab.myshopify.com',1,'2020-12-05 23:33:49',NULL,NULL,53598617778,NULL,'(GMT-05:00) Eastern Time (US & Canada)','America/New_York',NULL,'2020-12-05 23:33:49','2020-12-05 23:33:52',NULL),(43751243926,NULL,'imbrastore.myshopify.com',1,'2020-12-30 17:30:57',NULL,NULL,54214197398,NULL,'(GMT-05:00) America/Bogota','America/Bogota',NULL,'2020-12-30 17:30:57','2020-12-30 17:31:00',NULL),(36608770186,NULL,'silent-com-co.myshopify.com',1,'2021-01-06 20:34:56',NULL,NULL,NULL,NULL,'(GMT-05:00) America/Bogota','America/Bogota',NULL,'2021-01-06 20:34:56','2021-01-06 20:34:56',NULL),(50477727911,NULL,'mansion-cat.myshopify.com',1,'2021-01-24 15:21:14',NULL,NULL,NULL,NULL,'(GMT-05:00) America/Bogota','America/Bogota',NULL,'2021-01-24 15:21:14','2021-01-24 15:21:14',NULL),(4870602845,NULL,'ojalu.myshopify.com',1,'2021-01-24 17:35:04',NULL,NULL,33786429533,NULL,'(GMT-05:00) America/Bogota','America/Bogota',NULL,'2021-01-24 17:35:04','2021-01-24 17:35:07',NULL);
/*!40000 ALTER TABLE `vexsol_store_general` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `vexsol_store_hollydays`
--

DROP TABLE IF EXISTS `vexsol_store_hollydays`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `vexsol_store_hollydays` (
  `HODAY_HOLLYDAY` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `HODAY_SETTING` bigint(20) unsigned NOT NULL,
  `HODAY_DAY` varchar(2) NOT NULL,
  `HODAY_MONTH` varchar(2) NOT NULL,
  `HODAY_CREATED_AT` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`HODAY_HOLLYDAY`),
  KEY `IX_HOLLYDAYS_SETTING` (`HODAY_SETTING`),
  CONSTRAINT `FK_HOLLIDAY_SETTING` FOREIGN KEY (`HODAY_SETTING`) REFERENCES `vexsol_store_settings` (`SETT_SETTING`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `vexsol_store_hollydays`
--

LOCK TABLES `vexsol_store_hollydays` WRITE;
/*!40000 ALTER TABLE `vexsol_store_hollydays` DISABLE KEYS */;
INSERT INTO `vexsol_store_hollydays` VALUES (1,15,'1','01','2020-12-17 15:35:53');
/*!40000 ALTER TABLE `vexsol_store_hollydays` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `vexsol_store_hours`
--

DROP TABLE IF EXISTS `vexsol_store_hours`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `vexsol_store_hours` (
  `STHR_HORARIO` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `STHR_SETTING` bigint(20) unsigned NOT NULL,
  `STHR_DAY` varchar(50) NOT NULL COMMENT '1=Lunes, 2=Martes ... 7=Domingo',
  `STHR_ENABLED` tinyint(4) NOT NULL DEFAULT 0,
  `STHR_OPEN` varchar(5) DEFAULT NULL COMMENT 'Format HH:MM',
  `STHR_CLOSE` varchar(5) DEFAULT NULL COMMENT 'Format HH:MM',
  `STHR_OPEN_T2` varchar(5) DEFAULT NULL COMMENT ' Format HH:MM ',
  `STHR_CLOSE_T2` varchar(5) DEFAULT NULL COMMENT 'Format HH:MM',
  `STHR_CREATED_AT` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`STHR_HORARIO`),
  KEY `IX_SETTING_SETTING` (`STHR_SETTING`),
  CONSTRAINT `FK_HORARIOS_SETTING` FOREIGN KEY (`STHR_SETTING`) REFERENCES `vexsol_store_settings` (`SETT_SETTING`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=1226 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `vexsol_store_hours`
--

LOCK TABLES `vexsol_store_hours` WRITE;
/*!40000 ALTER TABLE `vexsol_store_hours` DISABLE KEYS */;
INSERT INTO `vexsol_store_hours` VALUES (806,3,'0',1,'08:00','13:00','18:00','21:00','2020-09-12 01:47:09'),(807,3,'1',1,'08:00','13:00','18:00','21:00','2020-09-12 01:47:09'),(808,3,'2',1,'08:00','13:00','18:00','21:00','2020-09-12 01:47:09'),(809,3,'3',1,'08:00','13:00','18:00','21:00','2020-09-12 01:47:09'),(810,3,'4',1,'08:00','13:00','18:00','21:00','2020-09-12 01:47:09'),(811,3,'5',1,'08:00','13:00','18:00','21:00','2020-09-12 01:47:09'),(812,3,'6',1,'08:00','13:00','18:00','21:00','2020-09-12 01:47:09'),(1037,7,'0',1,'08:00','13:00','18:00','21:00','2020-10-13 17:52:11'),(1038,7,'1',1,'08:00','13:00','18:00','21:00','2020-10-13 17:52:11'),(1039,7,'2',1,'08:00','13:00','18:00','21:00','2020-10-13 17:52:11'),(1040,7,'3',1,'08:00','13:00','18:00','21:00','2020-10-13 17:52:12'),(1041,7,'4',1,'08:00','13:00','18:00','21:00','2020-10-13 17:52:12'),(1042,7,'5',1,'08:00','13:00','18:00','21:00','2020-10-13 17:52:12'),(1043,7,'6',1,'08:00','13:00','18:00','21:00','2020-10-13 17:52:12'),(1100,17,'0',1,'08:00','13:00','18:00','21:00','2020-11-13 23:46:28'),(1101,17,'1',1,'08:00','13:00','18:00','21:00','2020-11-13 23:46:28'),(1102,17,'2',1,'08:00','13:00','18:00','21:00','2020-11-13 23:46:28'),(1103,17,'3',1,'08:00','13:00','18:00','21:00','2020-11-13 23:46:28'),(1104,17,'4',1,'08:00','13:00','18:00','21:00','2020-11-13 23:46:28'),(1105,17,'5',1,'08:00','13:00','18:00','21:00','2020-11-13 23:46:28'),(1106,17,'6',1,'08:00','13:00','18:00','21:00','2020-11-13 23:46:28'),(1135,22,'0',1,'08:00','13:00','18:00','21:00','2020-11-30 15:04:57'),(1136,22,'1',1,'08:00','13:00','18:00','21:00','2020-11-30 15:04:57'),(1137,22,'2',1,'08:00','13:00','18:00','21:00','2020-11-30 15:04:57'),(1138,22,'3',1,'08:00','13:00','18:00','21:00','2020-11-30 15:04:57'),(1139,22,'4',1,'08:00','13:00','18:00','21:00','2020-11-30 15:04:57'),(1140,22,'5',1,'08:00','13:00','18:00','21:00','2020-11-30 15:04:57'),(1141,22,'6',1,'08:00','13:00','18:00','21:00','2020-11-30 15:04:57'),(1142,23,'0',1,'08:00','13:00','18:00','21:00','2020-12-01 20:22:27'),(1143,23,'1',1,'08:00','13:00','18:00','21:00','2020-12-01 20:22:27'),(1144,23,'2',1,'08:00','13:00','18:00','21:00','2020-12-01 20:22:27'),(1145,23,'3',1,'08:00','13:00','18:00','21:00','2020-12-01 20:22:27'),(1146,23,'4',1,'08:00','13:00','18:00','21:00','2020-12-01 20:22:27'),(1147,23,'5',1,'08:00','13:00','18:00','21:00','2020-12-01 20:22:27'),(1148,23,'6',1,'08:00','13:00','18:00','21:00','2020-12-01 20:22:27'),(1149,24,'0',1,'08:00','13:00','18:00','21:00','2020-12-05 23:33:50'),(1150,24,'1',1,'08:00','13:00','18:00','21:00','2020-12-05 23:33:50'),(1151,24,'2',1,'08:00','13:00','18:00','21:00','2020-12-05 23:33:50'),(1152,24,'3',1,'08:00','13:00','18:00','21:00','2020-12-05 23:33:50'),(1153,24,'4',1,'08:00','13:00','18:00','21:00','2020-12-05 23:33:50'),(1154,24,'5',1,'08:00','13:00','18:00','21:00','2020-12-05 23:33:50'),(1155,24,'6',1,'08:00','13:00','18:00','21:00','2020-12-05 23:33:50'),(1184,15,'0',0,NULL,NULL,NULL,NULL,'2020-12-17 15:35:53'),(1185,15,'1',1,'08:00','13:00',NULL,NULL,'2020-12-17 15:35:53'),(1186,15,'2',1,'08:00','13:00',NULL,NULL,'2020-12-17 15:35:53'),(1187,15,'3',1,'08:00','13:00',NULL,NULL,'2020-12-17 15:35:53'),(1188,15,'4',1,'08:00','13:00',NULL,NULL,'2020-12-17 15:35:53'),(1189,15,'5',1,'08:00','13:00',NULL,NULL,'2020-12-17 15:35:53'),(1190,15,'6',0,NULL,NULL,NULL,NULL,'2020-12-17 15:35:53'),(1191,12,'0',1,'08:00','13:00','18:00','21:00','2020-12-23 21:58:43'),(1192,12,'1',1,'08:00','13:00','18:00','21:00','2020-12-23 21:58:43'),(1193,12,'2',1,'08:00','13:00','18:00','21:00','2020-12-23 21:58:43'),(1194,12,'3',1,'08:00','13:00','18:00','21:00','2020-12-23 21:58:43'),(1195,12,'4',1,'08:00','13:00','18:00','21:00','2020-12-23 21:58:43'),(1196,12,'5',1,'08:00','13:00','18:00','21:00','2020-12-23 21:58:43'),(1197,12,'6',1,'08:00','13:00','18:00','21:00','2020-12-23 21:58:43'),(1198,25,'0',1,'08:00','13:00','18:00','21:00','2020-12-30 17:30:59'),(1199,25,'1',1,'08:00','13:00','18:00','21:00','2020-12-30 17:30:59'),(1200,25,'2',1,'08:00','13:00','18:00','21:00','2020-12-30 17:30:59'),(1201,25,'3',1,'08:00','13:00','18:00','21:00','2020-12-30 17:30:59'),(1202,25,'4',1,'08:00','13:00','18:00','21:00','2020-12-30 17:30:59'),(1203,25,'5',1,'08:00','13:00','18:00','21:00','2020-12-30 17:30:59'),(1204,25,'6',1,'08:00','13:00','18:00','21:00','2020-12-30 17:30:59'),(1205,26,'0',1,'08:00','13:00','18:00','21:00','2021-01-06 20:34:58'),(1206,26,'1',1,'08:00','13:00','18:00','21:00','2021-01-06 20:34:58'),(1207,26,'2',1,'08:00','13:00','18:00','21:00','2021-01-06 20:34:58'),(1208,26,'3',1,'08:00','13:00','18:00','21:00','2021-01-06 20:34:58'),(1209,26,'4',1,'08:00','13:00','18:00','21:00','2021-01-06 20:34:58'),(1210,26,'5',1,'08:00','13:00','18:00','21:00','2021-01-06 20:34:58'),(1211,26,'6',1,'08:00','13:00','18:00','21:00','2021-01-06 20:34:58'),(1212,27,'0',1,'08:00','13:00','18:00','21:00','2021-01-24 15:21:16'),(1213,27,'1',1,'08:00','13:00','18:00','21:00','2021-01-24 15:21:16'),(1214,27,'2',1,'08:00','13:00','18:00','21:00','2021-01-24 15:21:16'),(1215,27,'3',1,'08:00','13:00','18:00','21:00','2021-01-24 15:21:16'),(1216,27,'4',1,'08:00','13:00','18:00','21:00','2021-01-24 15:21:16'),(1217,27,'5',1,'08:00','13:00','18:00','21:00','2021-01-24 15:21:16'),(1218,27,'6',1,'08:00','13:00','18:00','21:00','2021-01-24 15:21:16'),(1219,28,'0',1,'08:00','13:00','18:00','21:00','2021-01-24 17:35:06'),(1220,28,'1',1,'08:00','13:00','18:00','21:00','2021-01-24 17:35:06'),(1221,28,'2',1,'08:00','13:00','18:00','21:00','2021-01-24 17:35:06'),(1222,28,'3',1,'08:00','13:00','18:00','21:00','2021-01-24 17:35:06'),(1223,28,'4',1,'08:00','13:00','18:00','21:00','2021-01-24 17:35:06'),(1224,28,'5',1,'08:00','13:00','18:00','21:00','2021-01-24 17:35:06'),(1225,28,'6',1,'08:00','13:00','18:00','21:00','2021-01-24 17:35:06');
/*!40000 ALTER TABLE `vexsol_store_hours` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `vexsol_store_locations`
--

DROP TABLE IF EXISTS `vexsol_store_locations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `vexsol_store_locations` (
  `STLO_ID` bigint(20) NOT NULL COMMENT 'Id of location',
  `STLO_STOREID` bigint(20) NOT NULL COMMENT 'Id of store',
  `STLO_SETTING` bigint(20) unsigned DEFAULT 0,
  `STLO_ENABLE` tinyint(4) DEFAULT 0,
  `STLO_LAT` varchar(50) DEFAULT NULL,
  `STLO_LNG` varchar(50) DEFAULT NULL,
  `STLO_NAME` varchar(1024) DEFAULT NULL,
  `STLO_CITY` varchar(150) DEFAULT NULL,
  `STLO_ADDRESS1` text DEFAULT NULL,
  `STLO_ADDRESS2` text DEFAULT NULL,
  `STLO_POSTCODE` varchar(10) DEFAULT NULL,
  `STLO_PHONE` varchar(20) DEFAULT NULL,
  `STLO_PROVINCE` varchar(50) DEFAULT NULL,
  `STLO_PROVINCE_CODE` varchar(10) DEFAULT NULL,
  `STLO_COUNTRY` varchar(50) DEFAULT NULL,
  `STLO_COUNTRY_CODE` varchar(10) DEFAULT NULL,
  `STLO_COUNTRY_NAME` varchar(50) DEFAULT NULL,
  KEY `IX_LOCATION_SETTING` (`STLO_SETTING`),
  CONSTRAINT `FK_LOCATION_SETTING` FOREIGN KEY (`STLO_SETTING`) REFERENCES `vexsol_store_settings` (`SETT_SETTING`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `vexsol_store_locations`
--

LOCK TABLES `vexsol_store_locations` WRITE;
/*!40000 ALTER TABLE `vexsol_store_locations` DISABLE KEYS */;
INSERT INTO `vexsol_store_locations` VALUES (50632065175,43623907479,3,0,NULL,NULL,'Colombia sucursal','Bogotá','67A-74 Calle 94a',NULL,'111211',NULL,'CUN',NULL,'COLOMBIA',NULL,NULL),(52428439711,45547258015,15,0,NULL,NULL,'Cromatex','Itagüi','67a-151 Carrera 42','Bodega Cromatex','055411',NULL,'ANT',NULL,'COLOMBIA',NULL,NULL);
/*!40000 ALTER TABLE `vexsol_store_locations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `vexsol_store_metadata`
--

DROP TABLE IF EXISTS `vexsol_store_metadata`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `vexsol_store_metadata` (
  `META_SETTING` bigint(20) unsigned NOT NULL,
  `META_ID` bigint(20) unsigned NOT NULL,
  `META_STORE` bigint(20) unsigned NOT NULL,
  `META_KEY` varchar(50) NOT NULL,
  `META_VALUE` varchar(512) NOT NULL,
  `META_TYPE` varchar(32) NOT NULL,
  `META_OWNERID` bigint(20) unsigned NOT NULL,
  `META_OWNER_RESOURCE` varchar(50) DEFAULT NULL,
  `META_ADMIN_GRAPHQL` varchar(1024) DEFAULT NULL,
  `META_CREATED_AT` datetime NOT NULL,
  KEY `IX_METADATA_SETTING` (`META_SETTING`),
  KEY `IX_METADATA_STORE` (`META_STORE`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COMMENT='Meta datos';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `vexsol_store_metadata`
--

LOCK TABLES `vexsol_store_metadata` WRITE;
/*!40000 ALTER TABLE `vexsol_store_metadata` DISABLE KEYS */;
INSERT INTO `vexsol_store_metadata` VALUES (3,14611871137943,43623907479,'settingid','3','string',43623907479,'shop','gid://shopify/Metafield/14611871137943','2020-08-06 20:23:42'),(3,14611871203479,43623907479,'allowscheduled','yes','string',43623907479,'shop','gid://shopify/Metafield/14611871203479','2020-08-06 20:23:43'),(3,14611871236247,43623907479,'gloogleapikey','X','string',43623907479,'shop','gid://shopify/Metafield/14611871236247','2020-08-06 20:23:44'),(3,14611871432855,43623907479,'workingdays','[{\"id\":\"20200912\",\"enable\":false,\"immediately\":true,\"text\":\"Hoy\"},{\"id\":\"20200913\",\"enable\":true,\"text\":\"Ma\\u00f1ana\"},{\"id\":\"20200914\",\"enable\":true,\"text\":\"Lunes, 14\"},{\"id\":\"20200915\",\"enable\":true,\"text\":\"Martes, 15\"},{\"id\":\"20200916\",\"enable\":true,\"text\":\"Mi\\u00e9rcoles, 16\"},{\"id\":\"20200917\",\"enable\":true,\"text\":\"Jueves, 17\"},{\"id\":\"20200918\",\"enable\":true,\"text\":\"Viernes, 18\"}]','string',43623907479,'shop','gid://shopify/Metafield/14611871432855','2020-08-06 20:23:46'),(7,14921039708325,49485316261,'settingid','7','string',49485316261,'shop','gid://shopify/Metafield/14921039708325','2020-09-21 16:31:28'),(7,14921042559141,49485316261,'allowscheduled','yes','string',49485316261,'shop','gid://shopify/Metafield/14921042559141','2020-09-21 16:34:10'),(7,14921042591909,49485316261,'gloogleapikey','X','string',49485316261,'shop','gid://shopify/Metafield/14921042591909','2020-09-21 16:34:11'),(7,14921042624677,49485316261,'workingdays','[{\"id\":\"20201013\",\"enable\":false,\"immediately\":false,\"text\":\"Hoy\"},{\"id\":\"20201014\",\"enable\":false,\"text\":\"Ma\\u00f1ana\"},{\"id\":\"20201015\",\"enable\":false,\"text\":\"Jueves, 15\"},{\"id\":\"20201016\",\"enable\":false,\"text\":\"Viernes, 16\"},{\"id\":\"20201017\",\"enable\":false,\"text\":\"S\\u00e1bado, 17\"},{\"id\":\"20201018\",\"enable\":false,\"text\":\"Domingo, 18\"},{\"id\":\"20201019\",\"enable\":false,\"text\":\"Lunes, 19\"}]','string',49485316261,'shop','gid://shopify/Metafield/14921042624677','2020-09-21 16:34:14'),(15,15452172058783,45547258015,'settingid','15','string',45547258015,'shop','gid://shopify/Metafield/15452172058783','2020-11-11 11:22:12'),(15,15452172157087,45547258015,'allowscheduled','yes','string',45547258015,'shop','gid://shopify/Metafield/15452172157087','2020-11-11 11:22:12'),(15,15452172255391,45547258015,'gloogleapikey','X','string',45547258015,'shop','gid://shopify/Metafield/15452172255391','2020-11-11 11:22:12'),(15,15452172288159,45547258015,'workingdays','[{\"id\":\"20201111\",\"enable\":false,\"immediately\":false,\"text\":\"Hoy\"},{\"id\":\"20201112\",\"enable\":false,\"text\":\"Ma\\u00f1ana\"},{\"id\":\"20201113\",\"enable\":false,\"text\":\"Viernes, 13\"},{\"id\":\"20201114\",\"enable\":false,\"text\":\"S\\u00e1bado, 14\"},{\"id\":\"20201115\",\"enable\":false,\"text\":\"Domingo, 15\"},{\"id\":\"20201116\",\"enable\":false,\"text\":\"Lunes, 16\"},{\"id\":\"20201117\",\"enable\":false,\"text\":\"Martes, 17\"}]','string',45547258015,'shop','gid://shopify/Metafield/15452172288159','2020-11-11 11:22:12'),(17,16777910386867,51220152499,'settingid','17','string',51220152499,'shop','gid://shopify/Metafield/16777910386867','2020-11-13 18:46:28'),(17,16777910419635,51220152499,'allowscheduled','yes','string',51220152499,'shop','gid://shopify/Metafield/16777910419635','2020-11-13 18:46:28'),(17,16777910452403,51220152499,'gloogleapikey','X','string',51220152499,'shop','gid://shopify/Metafield/16777910452403','2020-11-13 18:46:28'),(17,16777910485171,51220152499,'workingdays','[{\"id\":\"20201113\",\"enable\":false,\"immediately\":false,\"text\":\"Hoy\"},{\"id\":\"20201114\",\"enable\":false,\"text\":\"Ma\\u00f1ana\"},{\"id\":\"20201115\",\"enable\":false,\"text\":\"Domingo, 15\"},{\"id\":\"20201116\",\"enable\":false,\"text\":\"Lunes, 16\"},{\"id\":\"20201117\",\"enable\":false,\"text\":\"Martes, 17\"},{\"id\":\"20201118\",\"enable\":false,\"text\":\"Mi\\u00e9rcoles, 18\"},{\"id\":\"20201119\",\"enable\":false,\"text\":\"Jueves, 19\"}]','string',51220152499,'shop','gid://shopify/Metafield/16777910485171','2020-11-13 18:46:28'),(22,15729146822822,50906202278,'settingid','22','string',50906202278,'shop','gid://shopify/Metafield/15729146822822','2020-11-30 10:04:56'),(22,15729146921126,50906202278,'allowscheduled','yes','string',50906202278,'shop','gid://shopify/Metafield/15729146921126','2020-11-30 10:04:56'),(22,15729146953894,50906202278,'gloogleapikey','X','string',50906202278,'shop','gid://shopify/Metafield/15729146953894','2020-11-30 10:04:56'),(22,15729146986662,50906202278,'workingdays','[{\"id\":\"20201130\",\"enable\":false,\"immediately\":false,\"text\":\"Today\"},{\"id\":\"20201201\",\"enable\":false,\"text\":\"Tomorrow\"},{\"id\":\"20201202\",\"enable\":false,\"text\":\"Wednesday, 02\"},{\"id\":\"20201203\",\"enable\":false,\"text\":\"Thursday, 03\"},{\"id\":\"20201204\",\"enable\":false,\"text\":\"Friday, 04\"},{\"id\":\"20201205\",\"enable\":false,\"text\":\"Saturday, 05\"},{\"id\":\"20201206\",\"enable\":false,\"text\":\"Sunday, 06\"}]','string',50906202278,'shop','gid://shopify/Metafield/15729146986662','2020-11-30 10:04:57'),(23,16843436359866,51532038330,'settingid','23','string',51532038330,'shop','gid://shopify/Metafield/16843436359866','2020-12-01 15:22:26'),(23,16843436425402,51532038330,'allowscheduled','yes','string',51532038330,'shop','gid://shopify/Metafield/16843436425402','2020-12-01 15:22:26'),(23,16843436458170,51532038330,'gloogleapikey','X','string',51532038330,'shop','gid://shopify/Metafield/16843436458170','2020-12-01 15:22:27'),(23,16843436523706,51532038330,'workingdays','[{\"id\":\"20201201\",\"enable\":false,\"immediately\":false,\"text\":\"Hoy\"},{\"id\":\"20201202\",\"enable\":false,\"text\":\"Ma\\u00f1ana\"},{\"id\":\"20201203\",\"enable\":false,\"text\":\"Jueves, 03\"},{\"id\":\"20201204\",\"enable\":false,\"text\":\"Viernes, 04\"},{\"id\":\"20201205\",\"enable\":false,\"text\":\"S\\u00e1bado, 05\"},{\"id\":\"20201206\",\"enable\":false,\"text\":\"Domingo, 06\"},{\"id\":\"20201207\",\"enable\":false,\"text\":\"Lunes, 07\"}]','string',51532038330,'shop','gid://shopify/Metafield/16843436523706','2020-12-01 15:22:27'),(24,16868093690034,51501334706,'settingid','24','string',51501334706,'shop','gid://shopify/Metafield/16868093690034','2020-12-05 18:33:49'),(24,16868093722802,51501334706,'allowscheduled','yes','string',51501334706,'shop','gid://shopify/Metafield/16868093722802','2020-12-05 18:33:49'),(24,16868093755570,51501334706,'gloogleapikey','X','string',51501334706,'shop','gid://shopify/Metafield/16868093755570','2020-12-05 18:33:49'),(24,16868093788338,51501334706,'workingdays','[{\"id\":\"20201205\",\"enable\":false,\"immediately\":false,\"text\":\"Today\"},{\"id\":\"20201206\",\"enable\":false,\"text\":\"Tomorrow\"},{\"id\":\"20201207\",\"enable\":false,\"text\":\"Monday, 07\"},{\"id\":\"20201208\",\"enable\":false,\"text\":\"Tuesday, 08\"},{\"id\":\"20201209\",\"enable\":false,\"text\":\"Wednesday, 09\"},{\"id\":\"20201210\",\"enable\":false,\"text\":\"Thursday, 10\"},{\"id\":\"20201211\",\"enable\":false,\"text\":\"Friday, 11\"}]','string',51501334706,'shop','gid://shopify/Metafield/16868093788338','2020-12-05 18:33:50'),(12,15522128003222,43754684566,'settingid','12','string',43754684566,'shop','gid://shopify/Metafield/15522128003222','2020-10-29 15:55:21'),(12,15522128035990,43754684566,'allowscheduled','yes','string',43754684566,'shop','gid://shopify/Metafield/15522128035990','2020-10-29 15:55:22'),(12,15522128068758,43754684566,'gloogleapikey','X','string',43754684566,'shop','gid://shopify/Metafield/15522128068758','2020-10-29 15:55:22'),(12,15522128101526,43754684566,'workingdays','[{\"id\":\"20201223\",\"enable\":false,\"immediately\":false,\"text\":\"Hoy\"},{\"id\":\"20201224\",\"enable\":false,\"text\":\"Ma\\u00f1ana\"},{\"id\":\"20201225\",\"enable\":false,\"text\":\"Viernes, 25\"},{\"id\":\"20201226\",\"enable\":false,\"text\":\"S\\u00e1bado, 26\"},{\"id\":\"20201227\",\"enable\":false,\"text\":\"Domingo, 27\"},{\"id\":\"20201228\",\"enable\":false,\"text\":\"Lunes, 28\"},{\"id\":\"20201229\",\"enable\":false,\"text\":\"Martes, 29\"}]','string',43754684566,'shop','gid://shopify/Metafield/15522128101526','2020-10-29 15:55:22'),(25,15930444480662,43751243926,'settingid','25','string',43751243926,'shop','gid://shopify/Metafield/15930444480662','2020-12-30 12:30:58'),(25,15930444578966,43751243926,'allowscheduled','yes','string',43751243926,'shop','gid://shopify/Metafield/15930444578966','2020-12-30 12:30:58'),(25,15930444611734,43751243926,'gloogleapikey','X','string',43751243926,'shop','gid://shopify/Metafield/15930444611734','2020-12-30 12:30:58'),(25,15930444644502,43751243926,'workingdays','[{\"id\":\"20201230\",\"enable\":false,\"immediately\":false,\"text\":\"Hoy\"},{\"id\":\"20201231\",\"enable\":false,\"text\":\"Ma\\u00f1ana\"},{\"id\":\"20210101\",\"enable\":false,\"text\":\"Viernes, 01\"},{\"id\":\"20210102\",\"enable\":false,\"text\":\"S\\u00e1bado, 02\"},{\"id\":\"20210103\",\"enable\":false,\"text\":\"Domingo, 03\"},{\"id\":\"20210104\",\"enable\":false,\"text\":\"Lunes, 04\"},{\"id\":\"20210105\",\"enable\":false,\"text\":\"Martes, 05\"}]','string',43751243926,'shop','gid://shopify/Metafield/15930444644502','2020-12-30 12:30:59'),(26,15269385175178,36608770186,'settingid','26','string',36608770186,'shop','gid://shopify/Metafield/15269385175178','2021-01-06 15:34:56'),(26,15269385207946,36608770186,'allowscheduled','yes','string',36608770186,'shop','gid://shopify/Metafield/15269385207946','2021-01-06 15:34:57'),(26,15269385240714,36608770186,'gloogleapikey','X','string',36608770186,'shop','gid://shopify/Metafield/15269385240714','2021-01-06 15:34:57'),(26,15269385273482,36608770186,'workingdays','[{\"id\":\"20210106\",\"enable\":false,\"immediately\":false,\"text\":\"Hoy\"},{\"id\":\"20210107\",\"enable\":false,\"text\":\"Ma\\u00f1ana\"},{\"id\":\"20210108\",\"enable\":false,\"text\":\"Viernes, 08\"},{\"id\":\"20210109\",\"enable\":false,\"text\":\"S\\u00e1bado, 09\"},{\"id\":\"20210110\",\"enable\":false,\"text\":\"Domingo, 10\"},{\"id\":\"20210111\",\"enable\":false,\"text\":\"Lunes, 11\"},{\"id\":\"20210112\",\"enable\":false,\"text\":\"Martes, 12\"}]','string',36608770186,'shop','gid://shopify/Metafield/15269385273482','2021-01-06 15:34:57'),(27,16538656571559,50477727911,'settingid','27','string',50477727911,'shop','gid://shopify/Metafield/16538656571559','2021-01-24 10:21:14'),(27,16538656604327,50477727911,'allowscheduled','yes','string',50477727911,'shop','gid://shopify/Metafield/16538656604327','2021-01-24 10:21:15'),(27,16538656833703,50477727911,'gloogleapikey','X','string',50477727911,'shop','gid://shopify/Metafield/16538656833703','2021-01-24 10:21:15'),(27,16538656866471,50477727911,'workingdays','[{\"id\":\"20210124\",\"enable\":false,\"immediately\":false,\"text\":\"Hoy\"},{\"id\":\"20210125\",\"enable\":false,\"text\":\"Ma\\u00f1ana\"},{\"id\":\"20210126\",\"enable\":false,\"text\":\"Martes, 26\"},{\"id\":\"20210127\",\"enable\":false,\"text\":\"Mi\\u00e9rcoles, 27\"},{\"id\":\"20210128\",\"enable\":false,\"text\":\"Jueves, 28\"},{\"id\":\"20210129\",\"enable\":false,\"text\":\"Viernes, 29\"},{\"id\":\"20210130\",\"enable\":false,\"text\":\"S\\u00e1bado, 30\"}]','string',50477727911,'shop','gid://shopify/Metafield/16538656866471','2021-01-24 10:21:16'),(28,13254382977117,4870602845,'settingid','28','string',4870602845,'shop','gid://shopify/Metafield/13254382977117','2021-01-24 12:35:05'),(28,13254383009885,4870602845,'allowscheduled','yes','string',4870602845,'shop','gid://shopify/Metafield/13254383009885','2021-01-24 12:35:05'),(28,13254383042653,4870602845,'gloogleapikey','X','string',4870602845,'shop','gid://shopify/Metafield/13254383042653','2021-01-24 12:35:05'),(28,13254383075421,4870602845,'workingdays','[{\"id\":\"20210124\",\"enable\":false,\"immediately\":false,\"text\":\"Today\"},{\"id\":\"20210125\",\"enable\":false,\"text\":\"Tomorrow\"},{\"id\":\"20210126\",\"enable\":false,\"text\":\"Tuesday, 26\"},{\"id\":\"20210127\",\"enable\":false,\"text\":\"Wednesday, 27\"},{\"id\":\"20210128\",\"enable\":false,\"text\":\"Thursday, 28\"},{\"id\":\"20210129\",\"enable\":false,\"text\":\"Friday, 29\"},{\"id\":\"20210130\",\"enable\":false,\"text\":\"Saturday, 30\"}]','string',4870602845,'shop','gid://shopify/Metafield/13254383075421','2021-01-24 12:35:05');
/*!40000 ALTER TABLE `vexsol_store_metadata` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `vexsol_store_orders`
--

DROP TABLE IF EXISTS `vexsol_store_orders`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `vexsol_store_orders` (
  `shop` int(10) unsigned DEFAULT NULL,
  `store_id` bigint(20) DEFAULT NULL,
  `id` bigint(20) NOT NULL,
  `name` varchar(50) NOT NULL,
  `number` bigint(20) unsigned NOT NULL,
  `order_number` bigint(20) unsigned NOT NULL,
  `currency` varchar(5) DEFAULT NULL,
  `shipping_method` varchar(1024) DEFAULT NULL,
  `financial_status` varchar(32) NOT NULL DEFAULT '',
  `delivery_status` varchar(50) DEFAULT NULL,
  `job_status` varchar(15) DEFAULT NULL,
  `fulfillment_status` varchar(32) DEFAULT '',
  `created_at` datetime DEFAULT NULL COMMENT 'Fecha y hora de creacion del pedido de glovo',
  `delivered_at` datetime DEFAULT NULL,
  `customer` text DEFAULT NULL,
  `shipping_address` text DEFAULT NULL,
  `origin_address` varchar(500) DEFAULT NULL,
  `shipping_id` int(11) DEFAULT NULL,
  `order_status_url` text DEFAULT NULL,
  `glovo_attemp` char(1) DEFAULT 'N',
  `deliverywhen` varchar(50) DEFAULT NULL,
  `scheduletime` varchar(50) DEFAULT NULL,
  `fulfilled` varchar(1) DEFAULT 'N',
  `fulfillment_number` bigint(20) DEFAULT NULL,
  `tracking_url` text DEFAULT NULL,
  `source` text DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `number` (`order_number`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `vexsol_store_orders`
--

LOCK TABLES `vexsol_store_orders` WRITE;
/*!40000 ALTER TABLE `vexsol_store_orders` DISABLE KEYS */;
INSERT INTO `vexsol_store_orders` VALUES (NULL,43623907479,2728404320407,'#1235',235,1235,'COP','Servientrega delivery','paid',NULL,'Finished','','2020-09-05 17:33:09',NULL,'orlando yabiku','67A-74 Calle 94a, 111211 bogota',NULL,388921216,'https://stuart-api.myshopify.com/43623907479/orders/4bf1e82df95d0f66db972edf0e9dfd1a/authenticate?key=e62c3e6d68f848fd85c10917488a83ba','N',NULL,NULL,'N',NULL,NULL,NULL),(NULL,43623907479,2728435515543,'#1236',236,1236,'COP','Servientrega delivery','paid',NULL,'Finished','','2020-09-05 17:45:08',NULL,'orlando yabiku','67A-74 Calle 94a, 111211 bogota',NULL,388921217,'https://stuart-api.myshopify.com/43623907479/orders/7ae9f87b54dc78edcbf7ac70f87c2dec/authenticate?key=a1b93840efbfccd2a30fb1fee879d02b','N',NULL,NULL,'N',NULL,NULL,NULL),(NULL,43623907479,2728440168599,'#1237',237,1237,'COP','Servientrega delivery','paid',NULL,'Finished','','2020-09-05 17:46:54',NULL,'orlando yabiku','67A-74 Calle 94a, 111211 Bogotá',NULL,388921218,'https://stuart-api.myshopify.com/43623907479/orders/bdbb9ee438cb53b205a5e33cfe3b4a98/authenticate?key=0777dd28d024d7b125b61fe5afcedd25','N',NULL,NULL,'N',NULL,NULL,NULL),(NULL,43623907479,2730468769943,'#1238',238,1238,'COP','Servientrega delivery','paid',NULL,'Finished','','2020-09-06 07:21:04',NULL,'orlando yabiku','67A-74 Calle 94a, 111211 Bogotá',NULL,388921220,'https://stuart-api.myshopify.com/43623907479/orders/4d460117c064763ae6a3030729054ffd/authenticate?key=ad50979c6154aa6ab7dbdd4fc29896b6','N',NULL,NULL,'N',NULL,NULL,NULL),(NULL,43623907479,2732820529303,'#1239',239,1239,'COP','Servientrega delivery','paid',NULL,'Finished','','2020-09-07 00:42:21',NULL,'orlando yabiku','67A-74 Calle 94a, 111211 Bogotá',NULL,388921221,'https://stuart-api.myshopify.com/43623907479/orders/087b1882b4fc6ef705e20f8682b52c11/authenticate?key=3f3b02e3b8ed367d1926bacc90e25f60','N',NULL,NULL,'N',NULL,NULL,NULL),(NULL,43623907479,2748351971479,'#1248',248,1248,'COP','Servientrega delivery','paid',NULL,'Finished','','2020-09-12 03:52:35',NULL,'orlando yabiku','67A-74 Calle 94a, 111211 bogota',NULL,388921225,'https://stuart-api.myshopify.com/43623907479/orders/af0e29fe65787f56d22e86a4207a6bda/authenticate?key=d700b3b90da60bf67a6b31623b28f012','N',NULL,NULL,'N',NULL,NULL,NULL),(NULL,49485316261,2749400383653,'#1007',7,1007,'COP','Servientrega delivery','paid',NULL,'Finished','','2020-09-28 17:49:05',NULL,'orlando  yabiku','67A-74 Calle 94a, 111211 bogota',NULL,388921253,'https://test-store-colombia.myshopify.com/49485316261/orders/25d7c8ad06c82084b561ff30c87b5673/authenticate?key=3f5c9524621a5dd9a95dad6504d3aec7','N',NULL,NULL,'N',NULL,NULL,NULL),(NULL,49485316261,2749409394853,'#1008',8,1008,'COP','Servientrega delivery','paid',NULL,'Finished','','2020-09-28 17:55:11',NULL,'orlando yabiku','67A-74 Calle 94a, 111211 bogota',NULL,388921254,'https://test-store-colombia.myshopify.com/49485316261/orders/2fba2feff908533f68fb072d24b5ec8a/authenticate?key=b768763efd513e8fc43a5785effb86ef','N',NULL,NULL,'N',NULL,NULL,NULL);
/*!40000 ALTER TABLE `vexsol_store_orders` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `vexsol_store_settings`
--

DROP TABLE IF EXISTS `vexsol_store_settings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `vexsol_store_settings` (
  `SETT_SETTING` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `SETT_STORE_ID` bigint(20) unsigned NOT NULL,
  `SETT_LANGUAGE` varchar(2) NOT NULL,
  `SETT_COUNTRY` int(11) NOT NULL,
  `SETT_STORE_NAME` varchar(250) DEFAULT NULL,
  `SETT_ENABLE` smallint(6) DEFAULT NULL,
  `SETT_SERVER` varchar(20) DEFAULT NULL,
  `SETT_SERVIENTREGA_API` varchar(150) DEFAULT NULL,
  `SETT_SERVIENTREGA_SECRET` varchar(150) DEFAULT NULL,
  `SETT_SERVIENTREGA_BILLING_CODE` varchar(15) DEFAULT NULL,
  `SETT_GOOGLE_API` varchar(150) DEFAULT NULL,
  `SETT_METHOD_TITLE` varchar(250) DEFAULT NULL,
  `SETT_METHOD_DESCRIPTION` varchar(500) NOT NULL,
  `SETT_COST_TYPE` varchar(150) DEFAULT NULL,
  `SETT_COST_DEFAULT` decimal(10,2) DEFAULT NULL,
  `SETT_PERCENTAGE_DEFAULT` double(10,2) DEFAULT NULL,
  `SETT_FREE_FOR_DEFAULT` double(10,2) DEFAULT NULL,
  `SETT_IMAGE` varchar(255) DEFAULT NULL,
  `SETT_VALIDATED` tinyint(4) DEFAULT 0,
  `SETT_ENABLE_ALL_PRODUCTS` char(1) NOT NULL DEFAULT 'S',
  `SETT_ALLOWSCHEDULED` tinyint(4) DEFAULT 1,
  `SETT_CREATE_STATUS` varchar(32) DEFAULT NULL,
  `DELETED_AT` timestamp NULL DEFAULT NULL,
  `SETT_ALLOWFIRSTWIDGET` tinyint(4) DEFAULT NULL,
  `SETT_ALLOWSECONDWIDGET` tinyint(4) DEFAULT NULL,
  PRIMARY KEY (`SETT_SETTING`),
  KEY `IX-SETTINGS-STOREID` (`SETT_STORE_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `vexsol_store_settings`
--

LOCK TABLES `vexsol_store_settings` WRITE;
/*!40000 ALTER TABLE `vexsol_store_settings` DISABLE KEYS */;
INSERT INTO `vexsol_store_settings` VALUES (3,43623907479,'es',1,'api',1,'Test','Luis1937','MZR0zNqnI/KplFlYXiFk7m8/G/Iqxb3O','SER408','','Servientrega delivery','Servientrega delivery','Calculate',0.00,NULL,NULL,'1599874608.png',1,'S',1,'paid',NULL,1,1),(4,11445764158,'es',1,'vex-soluciones',1,'Production','','','','','Servientrega delivery','Servientrega delivery','Free',0.00,NULL,NULL,NULL,0,'S',1,'paid','2020-09-14 17:19:31',0,0),(5,29128917085,'es',1,'Crafty Belle',1,'Test','Luis1937','MZR0zNqnI/KplFlYXiFk7m8/G/Iqxb3O','SER408','','Servientrega delivery','Servientrega delivery','Calculate',0.00,NULL,NULL,NULL,1,'S',1,'paid','2020-10-02 19:15:08',1,0),(6,23191469,'en',1,'appstoretest5',1,'Production','','','','','Servientrega delivery','Servientrega delivery','Free',0.00,NULL,NULL,NULL,0,'S',1,'paid','2020-09-21 22:06:04',0,0),(7,49485316261,'es',2,'test-store-colombia',1,'Test','Luis1937','MZR0zNqnI/KplFlYXiFk7m8/G/Iqxb3O','SER408','','Servientrega delivery','Servientrega delivery','Calculate',0.00,-6.00,600.50,'1601323168.png',1,'S',1,'paid',NULL,1,1),(8,18377653,'es',1,'IdealParaTucuerpo',1,'Production','','','','','Servientrega delivery','Servientrega delivery','Free',0.00,NULL,NULL,NULL,0,'S',1,'paid','2020-10-13 17:21:26',0,0),(9,26509934637,'es',1,'Allcommercial.co',1,'Production','','','','','Servientrega delivery','Servientrega delivery','Free',0.00,NULL,NULL,NULL,0,'S',1,'paid','2020-10-24 20:59:06',0,0),(10,50529861808,'es',1,'Placer y encanto',1,'Production','','','','','Servientrega delivery','Servientrega delivery','Free',0.00,NULL,NULL,NULL,0,'S',1,'paid','2021-02-17 14:31:36',0,0),(11,47263711399,'es',1,'Sabor a Banana',1,'Production','','','','','Servientrega delivery','Servientrega delivery','Free',0.00,NULL,NULL,NULL,0,'S',1,'paid','2020-10-27 18:03:22',0,0),(12,43754684566,'es',1,'MapacheParts',1,'Production','','','','','Servientrega delivery','Servientrega delivery','Free',0.00,NULL,NULL,NULL,0,'S',1,'paid',NULL,0,0),(13,22557607,'es',1,'Rubik Cube Star',1,'Production','','','','','Servientrega delivery','Servientrega delivery','Free',0.00,NULL,NULL,NULL,0,'S',1,'paid','2020-10-31 12:32:06',0,0),(14,50893979825,'es',1,'Minimax Colombia',1,'Production','','','','','Servientrega delivery','Servientrega delivery','Free',0.00,NULL,NULL,NULL,0,'S',1,'paid','2020-11-04 19:34:08',0,0),(15,45547258015,'es',1,'Cool & Dry',1,'Test','900569305','Tb8Hb+NLWsc=','SER122700','','Servientrega delivery','Servientrega delivery','Free',0.00,NULL,NULL,NULL,0,'S',1,'paid',NULL,0,0),(16,36081959052,'es',1,'Tellenzi',1,'Production','','','','','Servientrega delivery','Servientrega delivery','Free',0.00,NULL,NULL,NULL,0,'S',1,'paid','2020-11-11 18:44:10',0,0),(17,51220152499,'es',1,'OnStockStore',1,'Production','','','','','Servientrega delivery','Servientrega delivery','Free',0.00,NULL,NULL,NULL,0,'S',1,'paid',NULL,0,0),(18,26710704322,'es',1,'Pintar por números Colombia',1,'Production','','','','','Servientrega delivery','Servientrega delivery','Free',0.00,NULL,NULL,NULL,0,'S',1,'paid','2020-11-24 16:49:01',0,0),(19,9390522465,'es',1,'Blinkers Company',1,'Production','','','','','Servientrega delivery','Servientrega delivery','Free',0.00,NULL,NULL,NULL,0,'S',1,'paid','2020-11-25 21:16:57',0,0),(20,51110903959,'es',1,'Alta Mano',1,'Production','','','','','Servientrega delivery','Servientrega delivery','Free',0.00,NULL,NULL,NULL,0,'S',1,'paid','2020-11-26 03:05:26',0,0),(21,50662867105,'es',1,'cristalvioleta',1,'Production','','','','','Servientrega delivery','Servientrega delivery','Free',0.00,NULL,NULL,NULL,0,'S',1,'paid','2020-11-28 16:51:21',0,0),(22,50906202278,'en',1,'Ropstar Colombia',1,'Production','','','','','Servientrega delivery','Servientrega delivery','Free',0.00,NULL,NULL,NULL,0,'S',1,'paid',NULL,0,0),(23,51532038330,'es',1,'MallColombiano',1,'Production','','','','','Servientrega delivery','Servientrega delivery','Free',0.00,NULL,NULL,NULL,0,'S',1,'paid',NULL,0,0),(24,51501334706,'en',1,'Asylum Ecomm Lab',1,'Production','','','','','Servientrega delivery','Servientrega delivery','Free',0.00,NULL,NULL,NULL,0,'S',1,'paid',NULL,0,0),(25,43751243926,'es',1,'Imbra Repuestos',1,'Production','','','','','Servientrega delivery','Servientrega delivery','Free',0.00,NULL,NULL,NULL,0,'S',1,'paid',NULL,0,0),(26,36608770186,'es',1,'SILENT.COM.CO',1,'Production','','','','','Servientrega delivery','Servientrega delivery','Free',0.00,NULL,NULL,NULL,0,'S',1,'paid',NULL,0,0),(27,50477727911,'es',1,'Mansion Cat',1,'Production','','','','','Servientrega delivery','Servientrega delivery','Free',0.00,NULL,NULL,NULL,0,'S',1,'paid',NULL,0,0),(28,4870602845,'en',1,'OJALU',1,'Production','','','','','Servientrega delivery','Servientrega delivery','Free',0.00,NULL,NULL,NULL,0,'S',1,'paid',NULL,0,0);
/*!40000 ALTER TABLE `vexsol_store_settings` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2021-03-13 21:21:52
