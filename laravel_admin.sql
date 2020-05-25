-- MySQL dump 10.13  Distrib 8.0.19, for macos10.15 (x86_64)
--
-- Host: localhost    Database: laravel_admin
-- ------------------------------------------------------
-- Server version	8.0.19

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Current Database: `laravel_admin`
--

CREATE DATABASE /*!32312 IF NOT EXISTS*/ `laravel_admin` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;

USE `laravel_admin`;

--
-- Table structure for table `admin_menu`
--

DROP TABLE IF EXISTS `admin_menu`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `admin_menu` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `parent_id` int NOT NULL DEFAULT '0',
  `order` int NOT NULL DEFAULT '0',
  `title` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `icon` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `uri` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `permission` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `admin_menu`
--

LOCK TABLES `admin_menu` WRITE;
/*!40000 ALTER TABLE `admin_menu` DISABLE KEYS */;
INSERT INTO `admin_menu` VALUES (1,0,1,'Dashboard','fa-bar-chart','/',NULL,NULL,NULL),(2,0,2,'Admin','fa-tasks','',NULL,NULL,NULL),(3,2,4,'Users','fa-users','auth/users',NULL,NULL,'2020-03-17 07:13:46'),(4,2,5,'Roles','fa-user','auth/roles',NULL,NULL,'2020-03-17 07:13:46'),(5,2,6,'Permission','fa-ban','auth/permissions',NULL,NULL,'2020-03-17 07:13:47'),(6,2,7,'Menu','fa-bars','auth/menu',NULL,NULL,'2020-03-17 07:13:47'),(7,2,8,'Operation log','fa-history','auth/logs',NULL,NULL,'2020-03-17 07:13:47'),(8,2,3,'Staff','fa-users','users','*','2020-03-17 07:12:43','2020-03-17 07:46:44');
/*!40000 ALTER TABLE `admin_menu` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `admin_operation_log`
--

DROP TABLE IF EXISTS `admin_operation_log`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `admin_operation_log` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `path` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `method` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ip` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `input` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `admin_operation_log_user_id_index` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=260 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `admin_operation_log`
--

LOCK TABLES `admin_operation_log` WRITE;
/*!40000 ALTER TABLE `admin_operation_log` DISABLE KEYS */;
INSERT INTO `admin_operation_log` VALUES (1,1,'admin','GET','127.0.0.1','[]','2020-02-16 22:38:50','2020-02-16 22:38:50'),(2,1,'admin/auth/users','GET','127.0.0.1','{\"_pjax\":\"#pjax-container\"}','2020-02-16 22:50:39','2020-02-16 22:50:39'),(3,1,'admin/auth/users/create','GET','127.0.0.1','{\"_pjax\":\"#pjax-container\"}','2020-02-16 22:50:43','2020-02-16 22:50:43'),(4,1,'admin/auth/users','POST','127.0.0.1','{\"username\":\"test\",\"name\":\"test\",\"password\":\"test\",\"password_confirmation\":\"test\",\"roles\":[null],\"permissions\":[null],\"_token\":\"VP50lR1xcxyo5VhOdeY44UAEs76O1NFUg9zkawxE\",\"_previous_\":\"http:\\/\\/127.0.0.1:8000\\/admin\\/auth\\/users\"}','2020-02-16 22:50:54','2020-02-16 22:50:54'),(5,1,'admin/auth/users','GET','127.0.0.1','[]','2020-02-16 22:50:54','2020-02-16 22:50:54'),(6,1,'admin/auth/users/1/edit','GET','127.0.0.1','{\"_pjax\":\"#pjax-container\"}','2020-02-16 22:52:35','2020-02-16 22:52:35'),(7,1,'admin/auth/users','GET','127.0.0.1','{\"_pjax\":\"#pjax-container\"}','2020-02-16 22:52:48','2020-02-16 22:52:48'),(8,1,'admin','GET','127.0.0.1','{\"_pjax\":\"#pjax-container\"}','2020-02-16 22:52:54','2020-02-16 22:52:54'),(9,1,'admin/auth/users','GET','127.0.0.1','{\"_pjax\":\"#pjax-container\"}','2020-02-16 22:53:06','2020-02-16 22:53:06'),(10,1,'admin/auth/users','GET','127.0.0.1','[]','2020-02-17 06:54:25','2020-02-17 06:54:25'),(11,1,'admin/auth/users/2','GET','127.0.0.1','{\"_pjax\":\"#pjax-container\"}','2020-02-17 06:54:33','2020-02-17 06:54:33'),(12,1,'admin/auth/users/2','DELETE','127.0.0.1','{\"_method\":\"delete\",\"_token\":\"VP50lR1xcxyo5VhOdeY44UAEs76O1NFUg9zkawxE\"}','2020-02-17 06:54:37','2020-02-17 06:54:37'),(13,1,'admin/auth/users/2','DELETE','127.0.0.1','{\"_method\":\"delete\",\"_token\":\"VP50lR1xcxyo5VhOdeY44UAEs76O1NFUg9zkawxE\"}','2020-02-17 06:54:47','2020-02-17 06:54:47'),(14,1,'admin','GET','127.0.0.1','{\"_pjax\":\"#pjax-container\"}','2020-02-17 06:56:58','2020-02-17 06:56:58'),(15,1,'admin/auth/users','GET','127.0.0.1','{\"_pjax\":\"#pjax-container\"}','2020-02-17 06:57:03','2020-02-17 06:57:03'),(16,1,'admin/_handle_action_','POST','127.0.0.1','{\"_key\":\"2\",\"_model\":\"Encore_Admin_Auth_Database_Administrator\",\"_token\":\"VP50lR1xcxyo5VhOdeY44UAEs76O1NFUg9zkawxE\",\"_action\":\"Encore_Admin_Grid_Actions_Delete\",\"_input\":\"true\"}','2020-02-17 06:57:08','2020-02-17 06:57:08'),(17,1,'admin/auth/users','GET','127.0.0.1','{\"_pjax\":\"#pjax-container\"}','2020-02-17 06:57:08','2020-02-17 06:57:08'),(18,1,'admin','GET','127.0.0.1','{\"_pjax\":\"#pjax-container\"}','2020-02-17 06:57:17','2020-02-17 06:57:17'),(19,1,'admin/auth/menu','GET','127.0.0.1','[]','2020-02-17 07:05:15','2020-02-17 07:05:15'),(20,1,'admin/auth/menu/1/edit','GET','127.0.0.1','{\"_pjax\":\"#pjax-container\"}','2020-02-17 07:05:51','2020-02-17 07:05:51'),(21,1,'admin/auth/menu','GET','127.0.0.1','{\"_pjax\":\"#pjax-container\"}','2020-02-17 07:06:02','2020-02-17 07:06:02'),(22,1,'admin','GET','127.0.0.1','{\"_pjax\":\"#pjax-container\"}','2020-02-17 07:06:12','2020-02-17 07:06:12'),(23,1,'admin/auth/users','GET','127.0.0.1','{\"_pjax\":\"#pjax-container\"}','2020-02-17 07:06:22','2020-02-17 07:06:22'),(24,1,'admin','GET','127.0.0.1','{\"_pjax\":\"#pjax-container\"}','2020-02-17 07:06:25','2020-02-17 07:06:25'),(25,1,'admin/auth/users','GET','127.0.0.1','{\"_pjax\":\"#pjax-container\"}','2020-02-17 07:06:28','2020-02-17 07:06:28'),(26,1,'admin','GET','127.0.0.1','{\"_pjax\":\"#pjax-container\"}','2020-02-17 07:06:28','2020-02-17 07:06:28'),(27,1,'admin/auth/menu','GET','127.0.0.1','{\"_pjax\":\"#pjax-container\"}','2020-02-17 07:06:29','2020-02-17 07:06:29'),(28,1,'admin','GET','127.0.0.1','{\"_pjax\":\"#pjax-container\"}','2020-02-17 07:06:43','2020-02-17 07:06:43'),(29,1,'admin','GET','127.0.0.1','{\"_pjax\":\"#pjax-container\"}','2020-02-17 07:06:45','2020-02-17 07:06:45'),(30,1,'admin','GET','127.0.0.1','{\"_pjax\":\"#pjax-container\"}','2020-02-17 07:07:20','2020-02-17 07:07:20'),(31,1,'admin/auth/users','GET','127.0.0.1','{\"_pjax\":\"#pjax-container\"}','2020-02-17 07:07:23','2020-02-17 07:07:23'),(32,1,'admin/auth/users/1/edit','GET','127.0.0.1','{\"_pjax\":\"#pjax-container\"}','2020-02-17 07:07:28','2020-02-17 07:07:28'),(33,1,'admin/auth/users/1/edit','GET','127.0.0.1','[]','2020-02-17 07:09:31','2020-02-17 07:09:31'),(34,1,'admin/auth/users/1/edit','GET','127.0.0.1','[]','2020-02-17 07:14:02','2020-02-17 07:14:02'),(35,1,'admin/auth/users','GET','127.0.0.1','{\"_pjax\":\"#pjax-container\"}','2020-02-17 07:14:49','2020-02-17 07:14:49'),(36,1,'admin','GET','127.0.0.1','{\"_pjax\":\"#pjax-container\"}','2020-02-17 07:25:41','2020-02-17 07:25:41'),(37,1,'admin','GET','127.0.0.1','[]','2020-02-17 07:27:15','2020-02-17 07:27:15'),(38,1,'admin','GET','127.0.0.1','[]','2020-02-17 07:27:58','2020-02-17 07:27:58'),(39,1,'admin','GET','127.0.0.1','[]','2020-02-17 07:30:15','2020-02-17 07:30:15'),(40,1,'admin','GET','127.0.0.1','[]','2020-02-17 07:30:38','2020-02-17 07:30:38'),(41,1,'admin','GET','127.0.0.1','[]','2020-02-17 07:31:15','2020-02-17 07:31:15'),(42,1,'admin','GET','127.0.0.1','[]','2020-02-17 07:36:03','2020-02-17 07:36:03'),(43,1,'admin','GET','127.0.0.1','[]','2020-02-17 07:38:50','2020-02-17 07:38:50'),(44,1,'admin','GET','127.0.0.1','{\"_pjax\":\"#pjax-container\"}','2020-02-17 07:38:53','2020-02-17 07:38:53'),(45,1,'admin','GET','127.0.0.1','[]','2020-02-17 07:39:29','2020-02-17 07:39:29'),(46,1,'admin','GET','127.0.0.1','{\"_pjax\":\"#pjax-container\"}','2020-02-17 07:39:33','2020-02-17 07:39:33'),(47,1,'admin','GET','127.0.0.1','{\"_pjax\":\"#pjax-container\"}','2020-02-17 07:39:34','2020-02-17 07:39:34'),(48,1,'admin','GET','127.0.0.1','[]','2020-02-17 08:05:36','2020-02-17 08:05:36'),(49,1,'admin/auth/menu','GET','127.0.0.1','[]','2020-02-17 08:05:43','2020-02-17 08:05:43'),(50,1,'admin','GET','127.0.0.1','[]','2020-02-17 08:44:30','2020-02-17 08:44:30'),(51,1,'admin/auth/menu','GET','127.0.0.1','[]','2020-02-17 08:47:05','2020-02-17 08:47:05'),(52,1,'admin/auth/menu','GET','127.0.0.1','[]','2020-02-17 08:47:20','2020-02-17 08:47:20'),(53,1,'admin/auth/menu','GET','127.0.0.1','[]','2020-02-17 08:47:34','2020-02-17 08:47:34'),(54,1,'admin/auth/menu','GET','127.0.0.1','[]','2020-02-17 08:48:18','2020-02-17 08:48:18'),(55,1,'admin','GET','127.0.0.1','[]','2020-02-17 08:53:29','2020-02-17 08:53:29'),(56,1,'admin/auth/logout','GET','127.0.0.1','{\"_pjax\":\"#pjax-container\"}','2020-02-17 08:53:36','2020-02-17 08:53:36'),(57,1,'admin/auth/menu','GET','127.0.0.1','[]','2020-02-17 08:57:31','2020-02-17 08:57:31'),(58,1,'admin','GET','127.0.0.1','[]','2020-03-16 09:08:23','2020-03-16 09:08:23'),(59,1,'admin/auth/users','GET','127.0.0.1','{\"_pjax\":\"#pjax-container\"}','2020-03-16 09:08:30','2020-03-16 09:08:30'),(60,1,'admin','GET','127.0.0.1','{\"_pjax\":\"#pjax-container\"}','2020-03-16 09:08:34','2020-03-16 09:08:34'),(61,1,'admin/auth/users','GET','127.0.0.1','{\"_pjax\":\"#pjax-container\"}','2020-03-16 09:11:56','2020-03-16 09:11:56'),(62,1,'admin','GET','127.0.0.1','{\"_pjax\":\"#pjax-container\"}','2020-03-16 09:11:59','2020-03-16 09:11:59'),(63,1,'admin/auth/login','GET','127.0.0.1','[]','2020-03-16 09:12:00','2020-03-16 09:12:00'),(64,1,'admin','GET','127.0.0.1','[]','2020-03-16 10:00:47','2020-03-16 10:00:47'),(65,1,'admin/auth/users','GET','127.0.0.1','{\"_pjax\":\"#pjax-container\"}','2020-03-16 10:00:52','2020-03-16 10:00:52'),(66,1,'admin','GET','127.0.0.1','{\"_pjax\":\"#pjax-container\"}','2020-03-16 10:01:09','2020-03-16 10:01:09'),(67,1,'admin/auth/menu','GET','127.0.0.1','{\"_pjax\":\"#pjax-container\"}','2020-03-16 10:01:37','2020-03-16 10:01:37'),(68,1,'admin/auth/permissions','GET','127.0.0.1','{\"_pjax\":\"#pjax-container\"}','2020-03-16 10:02:04','2020-03-16 10:02:04'),(69,1,'admin/auth/permissions/create','GET','127.0.0.1','{\"_pjax\":\"#pjax-container\"}','2020-03-16 10:02:12','2020-03-16 10:02:12'),(70,1,'admin/auth/permissions','GET','127.0.0.1','{\"_pjax\":\"#pjax-container\"}','2020-03-16 10:02:16','2020-03-16 10:02:16'),(71,1,'admin/auth/menu','GET','127.0.0.1','{\"_pjax\":\"#pjax-container\"}','2020-03-16 10:02:25','2020-03-16 10:02:25'),(72,1,'admin','GET','127.0.0.1','{\"_pjax\":\"#pjax-container\"}','2020-03-16 10:03:35','2020-03-16 10:03:35'),(73,1,'admin/auth/users','GET','127.0.0.1','{\"_pjax\":\"#pjax-container\"}','2020-03-16 10:08:54','2020-03-16 10:08:54'),(74,1,'admin/auth/roles','GET','127.0.0.1','{\"_pjax\":\"#pjax-container\"}','2020-03-16 10:08:58','2020-03-16 10:08:58'),(75,1,'admin/auth/permissions','GET','127.0.0.1','{\"_pjax\":\"#pjax-container\"}','2020-03-16 10:09:01','2020-03-16 10:09:01'),(76,1,'admin','GET','127.0.0.1','{\"_pjax\":\"#pjax-container\"}','2020-03-17 06:03:51','2020-03-17 06:03:51'),(77,1,'admin/auth/permissions','GET','127.0.0.1','{\"_pjax\":\"#pjax-container\"}','2020-03-17 06:17:13','2020-03-17 06:17:13'),(78,1,'admin/auth/roles','GET','127.0.0.1','{\"_pjax\":\"#pjax-container\"}','2020-03-17 06:17:14','2020-03-17 06:17:14'),(79,1,'admin/auth/users','GET','127.0.0.1','{\"_pjax\":\"#pjax-container\"}','2020-03-17 06:17:15','2020-03-17 06:17:15'),(80,1,'admin','GET','127.0.0.1','{\"_pjax\":\"#pjax-container\"}','2020-03-17 06:17:16','2020-03-17 06:17:16'),(81,1,'admin/auth/menu','GET','127.0.0.1','{\"_pjax\":\"#pjax-container\"}','2020-03-17 06:17:16','2020-03-17 06:17:16'),(82,1,'admin','GET','127.0.0.1','{\"_pjax\":\"#pjax-container\"}','2020-03-17 06:17:17','2020-03-17 06:17:17'),(83,1,'admin/auth/users','GET','127.0.0.1','{\"_pjax\":\"#pjax-container\"}','2020-03-17 06:17:18','2020-03-17 06:17:18'),(84,1,'admin','GET','127.0.0.1','{\"_pjax\":\"#pjax-container\"}','2020-03-17 06:17:18','2020-03-17 06:17:18'),(85,1,'admin','GET','127.0.0.1','[]','2020-03-17 06:18:54','2020-03-17 06:18:54'),(86,1,'admin','GET','127.0.0.1','{\"_pjax\":\"#pjax-container\"}','2020-03-17 06:19:16','2020-03-17 06:19:16'),(87,1,'admin/auth/menu','GET','127.0.0.1','{\"_pjax\":\"#pjax-container\"}','2020-03-17 06:19:27','2020-03-17 06:19:27'),(88,1,'admin','GET','127.0.0.1','{\"_pjax\":\"#pjax-container\"}','2020-03-17 06:19:35','2020-03-17 06:19:35'),(89,1,'admin/auth/users','GET','127.0.0.1','{\"_pjax\":\"#pjax-container\"}','2020-03-17 06:19:55','2020-03-17 06:19:55'),(90,1,'admin/auth/users/create','GET','127.0.0.1','{\"_pjax\":\"#pjax-container\"}','2020-03-17 06:20:01','2020-03-17 06:20:01'),(91,1,'admin/auth/users','POST','127.0.0.1','{\"username\":\"admin\",\"name\":\"subadmin\",\"password\":\"123456\",\"password_confirmation\":\"123456\",\"roles\":[null],\"permissions\":[null],\"_token\":\"cEErqE80lrttIg1u9y9jDSaXyDdY5bZz8DByWvpj\",\"after-save\":\"3\",\"_previous_\":\"http:\\/\\/localhost:8000\\/admin\\/auth\\/users\"}','2020-03-17 06:20:35','2020-03-17 06:20:35'),(92,1,'admin/auth/users/create','GET','127.0.0.1','[]','2020-03-17 06:20:35','2020-03-17 06:20:35'),(93,1,'admin/auth/users','POST','127.0.0.1','{\"username\":\"subadmin\",\"name\":\"subadmin\",\"password\":\"123456\",\"password_confirmation\":\"123456\",\"roles\":[null],\"permissions\":[null],\"_token\":\"cEErqE80lrttIg1u9y9jDSaXyDdY5bZz8DByWvpj\"}','2020-03-17 06:20:48','2020-03-17 06:20:48'),(94,1,'admin/auth/users','GET','127.0.0.1','[]','2020-03-17 06:20:48','2020-03-17 06:20:48'),(95,1,'admin','GET','127.0.0.1','{\"_pjax\":\"#pjax-container\"}','2020-03-17 06:20:57','2020-03-17 06:20:57'),(96,1,'admin','GET','127.0.0.1','{\"_pjax\":\"#pjax-container\"}','2020-03-17 06:21:00','2020-03-17 06:21:00'),(97,1,'admin','GET','127.0.0.1','{\"_pjax\":\"#pjax-container\"}','2020-03-17 06:21:01','2020-03-17 06:21:01'),(98,1,'admin/auth/logout','GET','127.0.0.1','{\"_pjax\":\"#pjax-container\"}','2020-03-17 06:21:09','2020-03-17 06:21:09'),(99,3,'admin','GET','127.0.0.1','[]','2020-03-17 06:21:18','2020-03-17 06:21:18'),(100,3,'admin','GET','127.0.0.1','{\"_pjax\":\"#pjax-container\"}','2020-03-17 06:21:24','2020-03-17 06:21:24'),(101,3,'admin/auth/logout','GET','127.0.0.1','{\"_pjax\":\"#pjax-container\"}','2020-03-17 06:21:32','2020-03-17 06:21:32'),(102,1,'admin','GET','127.0.0.1','[]','2020-03-17 06:21:38','2020-03-17 06:21:38'),(103,1,'admin/auth/users','GET','127.0.0.1','{\"_pjax\":\"#pjax-container\"}','2020-03-17 06:21:42','2020-03-17 06:21:42'),(104,1,'admin/auth/users/3/edit','GET','127.0.0.1','{\"_pjax\":\"#pjax-container\"}','2020-03-17 06:21:49','2020-03-17 06:21:49'),(105,1,'admin/auth/users/3','PUT','127.0.0.1','{\"username\":\"subadmin\",\"name\":\"subadmin\",\"password\":\"$2y$10$dT0ltx5WkgLdG1kJCyyYTuujruKRjsiHbrWIjxOd6Ay34vOGIMMxC\",\"password_confirmation\":\"$2y$10$dT0ltx5WkgLdG1kJCyyYTuujruKRjsiHbrWIjxOd6Ay34vOGIMMxC\",\"roles\":[null],\"permissions\":[null],\"_token\":\"2r5GrwE64eAfcq159BxPXAvBzqPFE4hFcJuWg9pU\",\"_method\":\"PUT\",\"_previous_\":\"http:\\/\\/localhost:8000\\/admin\\/auth\\/users\"}','2020-03-17 06:22:13','2020-03-17 06:22:13'),(106,1,'admin/auth/users','GET','127.0.0.1','[]','2020-03-17 06:22:13','2020-03-17 06:22:13'),(107,1,'admin/auth/users','GET','127.0.0.1','{\"_pjax\":\"#pjax-container\"}','2020-03-17 06:22:19','2020-03-17 06:22:19'),(108,1,'admin/auth/logout','GET','127.0.0.1','{\"_pjax\":\"#pjax-container\"}','2020-03-17 06:22:23','2020-03-17 06:22:23'),(109,3,'admin','GET','127.0.0.1','[]','2020-03-17 06:22:33','2020-03-17 06:22:33'),(110,3,'admin/auth/setting','GET','127.0.0.1','{\"_pjax\":\"#pjax-container\"}','2020-03-17 06:22:44','2020-03-17 06:22:44'),(111,3,'admin/auth/logout','GET','127.0.0.1','{\"_pjax\":\"#pjax-container\"}','2020-03-17 06:22:50','2020-03-17 06:22:50'),(112,1,'admin','GET','127.0.0.1','[]','2020-03-17 06:22:55','2020-03-17 06:22:55'),(113,1,'admin/auth/users','GET','127.0.0.1','{\"_pjax\":\"#pjax-container\"}','2020-03-17 06:22:59','2020-03-17 06:22:59'),(114,1,'admin/auth/users/3/edit','GET','127.0.0.1','{\"_pjax\":\"#pjax-container\"}','2020-03-17 06:23:02','2020-03-17 06:23:02'),(115,1,'admin/auth/users/3','PUT','127.0.0.1','{\"username\":\"subadmin\",\"name\":\"subadmin\",\"password\":\"$2y$10$dT0ltx5WkgLdG1kJCyyYTuujruKRjsiHbrWIjxOd6Ay34vOGIMMxC\",\"password_confirmation\":\"$2y$10$dT0ltx5WkgLdG1kJCyyYTuujruKRjsiHbrWIjxOd6Ay34vOGIMMxC\",\"roles\":[null],\"permissions\":[null],\"_token\":\"oyGSWqfpGYPTsCl0OHJhNCHIqAhy8etqQl8FpP1E\",\"_method\":\"PUT\",\"_previous_\":\"http:\\/\\/localhost:8000\\/admin\\/auth\\/users\"}','2020-03-17 06:25:21','2020-03-17 06:25:21'),(116,1,'admin/auth/users','GET','127.0.0.1','[]','2020-03-17 06:25:21','2020-03-17 06:25:21'),(117,1,'admin/auth/users/3/edit','GET','127.0.0.1','{\"_pjax\":\"#pjax-container\"}','2020-03-17 06:25:24','2020-03-17 06:25:24'),(118,1,'admin/auth/users/3/edit','GET','127.0.0.1','[]','2020-03-17 06:35:02','2020-03-17 06:35:02'),(119,1,'admin/auth/users/3','PUT','127.0.0.1','{\"username\":\"subadmin\",\"name\":\"subadmin\",\"password\":\"$2y$10$dT0ltx5WkgLdG1kJCyyYTuujruKRjsiHbrWIjxOd6Ay34vOGIMMxC\",\"password_confirmation\":\"$2y$10$dT0ltx5WkgLdG1kJCyyYTuujruKRjsiHbrWIjxOd6Ay34vOGIMMxC\",\"roles\":[null],\"permissions\":[null],\"_token\":\"oyGSWqfpGYPTsCl0OHJhNCHIqAhy8etqQl8FpP1E\",\"_method\":\"PUT\"}','2020-03-17 06:35:19','2020-03-17 06:35:19'),(120,1,'admin/auth/users','GET','127.0.0.1','[]','2020-03-17 06:35:19','2020-03-17 06:35:19'),(121,1,'admin/auth/users/3/edit','GET','127.0.0.1','{\"_pjax\":\"#pjax-container\"}','2020-03-17 06:35:23','2020-03-17 06:35:23'),(122,1,'admin/auth/users/3/edit','GET','127.0.0.1','[]','2020-03-17 06:38:28','2020-03-17 06:38:28'),(123,1,'admin/auth/users/3/edit','GET','127.0.0.1','[]','2020-03-17 06:40:37','2020-03-17 06:40:37'),(124,1,'admin/auth/users/3/edit','GET','127.0.0.1','[]','2020-03-17 06:53:08','2020-03-17 06:53:08'),(125,1,'admin/auth/users/3/edit','GET','127.0.0.1','[]','2020-03-17 06:53:46','2020-03-17 06:53:46'),(126,1,'admin','GET','127.0.0.1','{\"_pjax\":\"#pjax-container\"}','2020-03-17 06:54:00','2020-03-17 06:54:00'),(127,1,'admin','GET','127.0.0.1','{\"_pjax\":\"#pjax-container\"}','2020-03-17 06:54:03','2020-03-17 06:54:03'),(128,1,'admin','GET','127.0.0.1','[]','2020-03-17 07:07:04','2020-03-17 07:07:04'),(129,1,'admin/auth/users','GET','127.0.0.1','{\"_pjax\":\"#pjax-container\"}','2020-03-17 07:07:09','2020-03-17 07:07:09'),(130,1,'admin/auth/menu','GET','127.0.0.1','{\"_pjax\":\"#pjax-container\"}','2020-03-17 07:07:31','2020-03-17 07:07:31'),(131,1,'admin/auth/menu','POST','127.0.0.1','{\"parent_id\":\"2\",\"title\":\"staff\",\"icon\":\"fa-users\",\"uri\":null,\"roles\":[null],\"permission\":null,\"_token\":\"N79f8Rinqg4U1e5l8kfPp7bKv9HjQ6z5vPCSCtAh\"}','2020-03-17 07:12:43','2020-03-17 07:12:43'),(132,1,'admin/auth/menu','GET','127.0.0.1','[]','2020-03-17 07:12:43','2020-03-17 07:12:43'),(133,1,'admin/auth/menu/8/edit','GET','127.0.0.1','{\"_pjax\":\"#pjax-container\"}','2020-03-17 07:12:50','2020-03-17 07:12:50'),(134,1,'admin/auth/menu/8','PUT','127.0.0.1','{\"parent_id\":\"2\",\"title\":\"staff\",\"icon\":\"fa-users\",\"uri\":\"user\",\"roles\":[null],\"permission\":null,\"_token\":\"N79f8Rinqg4U1e5l8kfPp7bKv9HjQ6z5vPCSCtAh\",\"_method\":\"PUT\",\"_previous_\":\"http:\\/\\/127.0.0.1:8000\\/admin\\/auth\\/menu\"}','2020-03-17 07:13:02','2020-03-17 07:13:02'),(135,1,'admin/auth/menu','GET','127.0.0.1','[]','2020-03-17 07:13:02','2020-03-17 07:13:02'),(136,1,'admin','GET','127.0.0.1','{\"_pjax\":\"#pjax-container\"}','2020-03-17 07:13:10','2020-03-17 07:13:10'),(137,1,'admin/auth/users','GET','127.0.0.1','{\"_pjax\":\"#pjax-container\"}','2020-03-17 07:13:13','2020-03-17 07:13:13'),(138,1,'admin/auth/users','GET','127.0.0.1','{\"_pjax\":\"#pjax-container\"}','2020-03-17 07:13:14','2020-03-17 07:13:14'),(139,1,'admin/auth/roles','GET','127.0.0.1','{\"_pjax\":\"#pjax-container\"}','2020-03-17 07:13:15','2020-03-17 07:13:15'),(140,1,'admin/auth/permissions','GET','127.0.0.1','{\"_pjax\":\"#pjax-container\"}','2020-03-17 07:13:17','2020-03-17 07:13:17'),(141,1,'admin/auth/menu','GET','127.0.0.1','{\"_pjax\":\"#pjax-container\"}','2020-03-17 07:13:25','2020-03-17 07:13:25'),(142,1,'admin/auth/menu/8/edit','GET','127.0.0.1','{\"_pjax\":\"#pjax-container\"}','2020-03-17 07:13:31','2020-03-17 07:13:31'),(143,1,'admin/auth/menu/8','PUT','127.0.0.1','{\"parent_id\":\"2\",\"title\":\"staff\",\"icon\":\"fa-users\",\"uri\":\"user\",\"roles\":[null],\"permission\":\"*\",\"_token\":\"N79f8Rinqg4U1e5l8kfPp7bKv9HjQ6z5vPCSCtAh\",\"_method\":\"PUT\",\"_previous_\":\"http:\\/\\/127.0.0.1:8000\\/admin\\/auth\\/menu\"}','2020-03-17 07:13:40','2020-03-17 07:13:40'),(144,1,'admin/auth/menu','GET','127.0.0.1','[]','2020-03-17 07:13:40','2020-03-17 07:13:40'),(145,1,'admin/auth/menu','POST','127.0.0.1','{\"_token\":\"N79f8Rinqg4U1e5l8kfPp7bKv9HjQ6z5vPCSCtAh\",\"_order\":\"[{\\\"id\\\":1},{\\\"id\\\":2,\\\"children\\\":[{\\\"id\\\":8},{\\\"id\\\":3},{\\\"id\\\":4},{\\\"id\\\":5},{\\\"id\\\":6},{\\\"id\\\":7}]}]\"}','2020-03-17 07:13:46','2020-03-17 07:13:46'),(146,1,'admin/auth/menu','GET','127.0.0.1','{\"_pjax\":\"#pjax-container\"}','2020-03-17 07:13:47','2020-03-17 07:13:47'),(147,1,'admin/auth/menu','GET','127.0.0.1','[]','2020-03-17 07:13:52','2020-03-17 07:13:52'),(148,1,'admin/auth/users','GET','127.0.0.1','{\"_pjax\":\"#pjax-container\"}','2020-03-17 07:14:17','2020-03-17 07:14:17'),(149,1,'admin/auth/menu','GET','127.0.0.1','{\"_pjax\":\"#pjax-container\"}','2020-03-17 07:14:21','2020-03-17 07:14:21'),(150,1,'admin/auth/menu/8/edit','GET','127.0.0.1','{\"_pjax\":\"#pjax-container\"}','2020-03-17 07:29:59','2020-03-17 07:29:59'),(151,1,'admin/auth/menu/8/edit','GET','127.0.0.1','[]','2020-03-17 07:30:14','2020-03-17 07:30:14'),(152,1,'admin/auth/menu','GET','127.0.0.1','{\"_pjax\":\"#pjax-container\"}','2020-03-17 07:30:18','2020-03-17 07:30:18'),(153,1,'admin/auth/menu/8/edit','GET','127.0.0.1','{\"_pjax\":\"#pjax-container\"}','2020-03-17 07:30:22','2020-03-17 07:30:22'),(154,1,'admin/auth/menu/8','PUT','127.0.0.1','{\"parent_id\":\"2\",\"title\":\"auth\\/staff\",\"icon\":\"fa-users\",\"uri\":\"user\",\"roles\":[null],\"permission\":\"*\",\"_token\":\"N79f8Rinqg4U1e5l8kfPp7bKv9HjQ6z5vPCSCtAh\",\"_method\":\"PUT\",\"_previous_\":\"http:\\/\\/127.0.0.1:8000\\/admin\\/auth\\/menu\"}','2020-03-17 07:30:29','2020-03-17 07:30:29'),(155,1,'admin/auth/menu','GET','127.0.0.1','[]','2020-03-17 07:30:29','2020-03-17 07:30:29'),(156,1,'admin/auth/menu','GET','127.0.0.1','{\"_pjax\":\"#pjax-container\"}','2020-03-17 07:30:40','2020-03-17 07:30:40'),(157,1,'admin/auth/menu','POST','127.0.0.1','{\"_token\":\"N79f8Rinqg4U1e5l8kfPp7bKv9HjQ6z5vPCSCtAh\",\"_order\":\"[{\\\"id\\\":1},{\\\"id\\\":2,\\\"children\\\":[{\\\"id\\\":8},{\\\"id\\\":3},{\\\"id\\\":4},{\\\"id\\\":5},{\\\"id\\\":6},{\\\"id\\\":7}]}]\"}','2020-03-17 07:30:46','2020-03-17 07:30:46'),(158,1,'admin/auth/menu','GET','127.0.0.1','{\"_pjax\":\"#pjax-container\"}','2020-03-17 07:30:46','2020-03-17 07:30:46'),(159,1,'admin/auth/menu','GET','127.0.0.1','{\"_pjax\":\"#pjax-container\"}','2020-03-17 07:30:48','2020-03-17 07:30:48'),(160,1,'admin/auth/menu/8/edit','GET','127.0.0.1','{\"_pjax\":\"#pjax-container\"}','2020-03-17 07:30:51','2020-03-17 07:30:51'),(161,1,'admin/auth/menu/8','PUT','127.0.0.1','{\"parent_id\":\"2\",\"title\":\"staff\",\"icon\":\"fa-users\",\"uri\":\"auth\\/staff\",\"roles\":[null],\"permission\":\"*\",\"_token\":\"N79f8Rinqg4U1e5l8kfPp7bKv9HjQ6z5vPCSCtAh\",\"_method\":\"PUT\",\"_previous_\":\"http:\\/\\/127.0.0.1:8000\\/admin\\/auth\\/menu\"}','2020-03-17 07:31:09','2020-03-17 07:31:09'),(162,1,'admin/auth/menu','GET','127.0.0.1','[]','2020-03-17 07:31:10','2020-03-17 07:31:10'),(163,1,'admin/auth/menu','GET','127.0.0.1','[]','2020-03-17 07:33:34','2020-03-17 07:33:34'),(164,1,'admin/staff','GET','127.0.0.1','[]','2020-03-17 07:36:23','2020-03-17 07:36:23'),(165,1,'admin/staff/1/edit','GET','127.0.0.1','{\"_pjax\":\"#pjax-container\"}','2020-03-17 07:37:24','2020-03-17 07:37:24'),(166,1,'admin/auth/users','GET','127.0.0.1','{\"_pjax\":\"#pjax-container\"}','2020-03-17 07:37:35','2020-03-17 07:37:35'),(167,1,'admin/auth/users','GET','127.0.0.1','[]','2020-03-17 07:37:42','2020-03-17 07:37:42'),(168,1,'admin/staff','GET','127.0.0.1','{\"_pjax\":\"#pjax-container\"}','2020-03-17 07:37:47','2020-03-17 07:37:47'),(169,1,'admin/staff/1/edit','GET','127.0.0.1','{\"_pjax\":\"#pjax-container\"}','2020-03-17 07:37:52','2020-03-17 07:37:52'),(170,1,'admin/staff/1/edit','GET','127.0.0.1','[]','2020-03-17 07:37:54','2020-03-17 07:37:54'),(171,1,'admin/staff','GET','127.0.0.1','{\"_pjax\":\"#pjax-container\"}','2020-03-17 07:38:00','2020-03-17 07:38:00'),(172,1,'admin/auth/users','GET','127.0.0.1','{\"_pjax\":\"#pjax-container\"}','2020-03-17 07:38:20','2020-03-17 07:38:20'),(173,1,'admin/users','GET','127.0.0.1','[]','2020-03-17 07:38:25','2020-03-17 07:38:25'),(174,1,'admin/users','GET','127.0.0.1','[]','2020-03-17 07:38:42','2020-03-17 07:38:42'),(175,1,'admin/users','GET','127.0.0.1','[]','2020-03-17 07:38:47','2020-03-17 07:38:47'),(176,1,'admin/users/1/edit','GET','127.0.0.1','{\"_pjax\":\"#pjax-container\"}','2020-03-17 07:43:47','2020-03-17 07:43:47'),(177,1,'admin/users','GET','127.0.0.1','{\"_pjax\":\"#pjax-container\"}','2020-03-17 07:43:54','2020-03-17 07:43:54'),(178,1,'admin/users/1/edit','GET','127.0.0.1','{\"_pjax\":\"#pjax-container\"}','2020-03-17 07:43:59','2020-03-17 07:43:59'),(179,1,'admin/users/1','PUT','127.0.0.1','{\"name\":\"\\u601d\\u6db5\",\"email\":\"test@gmail.com\",\"password\":null,\"remember_token\":null,\"_token\":\"N79f8Rinqg4U1e5l8kfPp7bKv9HjQ6z5vPCSCtAh\",\"_method\":\"PUT\",\"_previous_\":\"http:\\/\\/127.0.0.1:8000\\/admin\\/users\"}','2020-03-17 07:44:03','2020-03-17 07:44:03'),(180,1,'admin/users/1/edit','GET','127.0.0.1','[]','2020-03-17 07:44:04','2020-03-17 07:44:04'),(181,1,'admin/users/1','PUT','127.0.0.1','{\"name\":\"\\u601d\\u6db5\",\"email\":\"test@gmail.com\",\"password\":\"123456\",\"remember_token\":\"123456\",\"_token\":\"N79f8Rinqg4U1e5l8kfPp7bKv9HjQ6z5vPCSCtAh\",\"_method\":\"PUT\"}','2020-03-17 07:44:24','2020-03-17 07:44:24'),(182,1,'admin/users','GET','127.0.0.1','[]','2020-03-17 07:44:24','2020-03-17 07:44:24'),(183,1,'admin/users/1/edit','GET','127.0.0.1','{\"_pjax\":\"#pjax-container\"}','2020-03-17 07:44:30','2020-03-17 07:44:30'),(184,1,'admin/users/1','PUT','127.0.0.1','{\"name\":\"\\u601d\\u6db5\",\"email\":\"test@gmail.com\",\"password\":null,\"remember_token\":null,\"_token\":\"N79f8Rinqg4U1e5l8kfPp7bKv9HjQ6z5vPCSCtAh\",\"_method\":\"PUT\",\"_previous_\":\"http:\\/\\/127.0.0.1:8000\\/admin\\/users\"}','2020-03-17 07:44:35','2020-03-17 07:44:35'),(185,1,'admin/users/1/edit','GET','127.0.0.1','[]','2020-03-17 07:44:35','2020-03-17 07:44:35'),(186,1,'admin/users','GET','127.0.0.1','{\"_pjax\":\"#pjax-container\"}','2020-03-17 07:44:42','2020-03-17 07:44:42'),(187,1,'admin/auth/users','GET','127.0.0.1','{\"_pjax\":\"#pjax-container\"}','2020-03-17 07:44:50','2020-03-17 07:44:50'),(188,1,'admin/auth/menu','GET','127.0.0.1','{\"_pjax\":\"#pjax-container\"}','2020-03-17 07:45:23','2020-03-17 07:45:23'),(189,1,'admin/auth/menu/8/edit','GET','127.0.0.1','{\"_pjax\":\"#pjax-container\"}','2020-03-17 07:45:27','2020-03-17 07:45:27'),(190,1,'admin/auth/menu/8','PUT','127.0.0.1','{\"parent_id\":\"2\",\"title\":\"staff\",\"icon\":\"fa-users\",\"uri\":\"users\",\"roles\":[null],\"permission\":\"*\",\"_token\":\"N79f8Rinqg4U1e5l8kfPp7bKv9HjQ6z5vPCSCtAh\",\"_method\":\"PUT\",\"_previous_\":\"http:\\/\\/127.0.0.1:8000\\/admin\\/auth\\/menu\"}','2020-03-17 07:45:33','2020-03-17 07:45:33'),(191,1,'admin/auth/menu','GET','127.0.0.1','[]','2020-03-17 07:45:34','2020-03-17 07:45:34'),(192,1,'admin/auth/menu','GET','127.0.0.1','[]','2020-03-17 07:45:39','2020-03-17 07:45:39'),(193,1,'admin/users','GET','127.0.0.1','{\"_pjax\":\"#pjax-container\"}','2020-03-17 07:45:43','2020-03-17 07:45:43'),(194,1,'admin/auth/users','GET','127.0.0.1','{\"_pjax\":\"#pjax-container\"}','2020-03-17 07:45:48','2020-03-17 07:45:48'),(195,1,'admin/users','GET','127.0.0.1','{\"_pjax\":\"#pjax-container\"}','2020-03-17 07:45:50','2020-03-17 07:45:50'),(196,1,'admin/auth/menu','GET','127.0.0.1','{\"_pjax\":\"#pjax-container\"}','2020-03-17 07:45:54','2020-03-17 07:45:54'),(197,1,'admin/auth/menu/8/edit','GET','127.0.0.1','{\"_pjax\":\"#pjax-container\"}','2020-03-17 07:45:58','2020-03-17 07:45:58'),(198,1,'admin/auth/menu/8','PUT','127.0.0.1','{\"parent_id\":\"2\",\"title\":\"\\u54e1\\u5de5\",\"icon\":\"fa-users\",\"uri\":\"users\",\"roles\":[null],\"permission\":\"*\",\"_token\":\"N79f8Rinqg4U1e5l8kfPp7bKv9HjQ6z5vPCSCtAh\",\"_method\":\"PUT\",\"_previous_\":\"http:\\/\\/127.0.0.1:8000\\/admin\\/auth\\/menu\"}','2020-03-17 07:46:09','2020-03-17 07:46:09'),(199,1,'admin/auth/menu','GET','127.0.0.1','[]','2020-03-17 07:46:10','2020-03-17 07:46:10'),(200,1,'admin/users','GET','127.0.0.1','{\"_pjax\":\"#pjax-container\"}','2020-03-17 07:46:15','2020-03-17 07:46:15'),(201,1,'admin/auth/roles','GET','127.0.0.1','{\"_pjax\":\"#pjax-container\"}','2020-03-17 07:46:19','2020-03-17 07:46:19'),(202,1,'admin/users','GET','127.0.0.1','{\"_pjax\":\"#pjax-container\"}','2020-03-17 07:46:21','2020-03-17 07:46:21'),(203,1,'admin/auth/menu','GET','127.0.0.1','{\"_pjax\":\"#pjax-container\"}','2020-03-17 07:46:27','2020-03-17 07:46:27'),(204,1,'admin/auth/menu/8/edit','GET','127.0.0.1','{\"_pjax\":\"#pjax-container\"}','2020-03-17 07:46:29','2020-03-17 07:46:29'),(205,1,'admin/auth/menu/8','PUT','127.0.0.1','{\"parent_id\":\"2\",\"title\":\"Staff\",\"icon\":\"fa-users\",\"uri\":\"users\",\"roles\":[null],\"permission\":\"*\",\"_token\":\"N79f8Rinqg4U1e5l8kfPp7bKv9HjQ6z5vPCSCtAh\",\"_method\":\"PUT\",\"_previous_\":\"http:\\/\\/127.0.0.1:8000\\/admin\\/auth\\/menu\"}','2020-03-17 07:46:44','2020-03-17 07:46:44'),(206,1,'admin/auth/menu','GET','127.0.0.1','[]','2020-03-17 07:46:45','2020-03-17 07:46:45'),(207,1,'admin/auth/menu','GET','127.0.0.1','[]','2020-03-17 07:46:58','2020-03-17 07:46:58'),(208,1,'admin/users','GET','127.0.0.1','{\"_pjax\":\"#pjax-container\"}','2020-03-17 07:47:01','2020-03-17 07:47:01'),(209,1,'admin/auth/users','GET','127.0.0.1','{\"_pjax\":\"#pjax-container\"}','2020-03-17 07:47:03','2020-03-17 07:47:03'),(210,1,'admin/users','GET','127.0.0.1','{\"_pjax\":\"#pjax-container\"}','2020-03-17 07:47:04','2020-03-17 07:47:04'),(211,1,'admin/users','GET','127.0.0.1','[]','2020-03-17 07:47:20','2020-03-17 07:47:20'),(212,1,'admin/auth/users','GET','127.0.0.1','{\"_pjax\":\"#pjax-container\"}','2020-03-17 07:47:56','2020-03-17 07:47:56'),(213,1,'admin/users','GET','127.0.0.1','{\"_pjax\":\"#pjax-container\"}','2020-03-17 07:47:58','2020-03-17 07:47:58'),(214,1,'admin/users','GET','127.0.0.1','[]','2020-03-17 07:48:28','2020-03-17 07:48:28'),(215,1,'admin/users','GET','127.0.0.1','[]','2020-03-17 07:49:09','2020-03-17 07:49:09'),(216,1,'admin','GET','127.0.0.1','{\"_pjax\":\"#pjax-container\"}','2020-03-17 07:49:22','2020-03-17 07:49:22'),(217,1,'admin/auth/users','GET','127.0.0.1','{\"_pjax\":\"#pjax-container\"}','2020-03-17 07:49:25','2020-03-17 07:49:25'),(218,1,'admin/auth/users/1/edit','GET','127.0.0.1','{\"_pjax\":\"#pjax-container\"}','2020-03-17 07:49:29','2020-03-17 07:49:29'),(219,1,'admin/auth/users/1','PUT','127.0.0.1','{\"username\":\"admin\",\"name\":\"Administrator\",\"password\":\"$2y$10$kRXTuvHULVe3z3PpeSzyjOAPv0AFxySDnzPAqTQ\\/.hLmZ8YCg6WFi\",\"password_confirmation\":\"$2y$10$kRXTuvHULVe3z3PpeSzyjOAPv0AFxySDnzPAqTQ\\/.hLmZ8YCg6WFi\",\"roles\":[\"1\",null],\"permissions\":[null],\"_token\":\"N79f8Rinqg4U1e5l8kfPp7bKv9HjQ6z5vPCSCtAh\",\"_method\":\"PUT\",\"_previous_\":\"http:\\/\\/127.0.0.1:8000\\/admin\\/auth\\/users\"}','2020-03-17 07:49:56','2020-03-17 07:49:56'),(220,1,'admin/auth/users','GET','127.0.0.1','[]','2020-03-17 07:49:57','2020-03-17 07:49:57'),(221,1,'admin/auth/users','GET','127.0.0.1','{\"_pjax\":\"#pjax-container\"}','2020-03-17 07:50:02','2020-03-17 07:50:02'),(222,1,'admin/auth/users/1','GET','127.0.0.1','{\"_pjax\":\"#pjax-container\"}','2020-03-17 07:50:12','2020-03-17 07:50:12'),(223,1,'admin/auth/users/1/edit','GET','127.0.0.1','{\"_pjax\":\"#pjax-container\"}','2020-03-17 07:50:18','2020-03-17 07:50:18'),(224,1,'admin/auth/logout','GET','127.0.0.1','{\"_pjax\":\"#pjax-container\"}','2020-03-17 07:50:25','2020-03-17 07:50:25'),(225,1,'admin','GET','127.0.0.1','[]','2020-03-17 07:50:32','2020-03-17 07:50:32'),(226,1,'admin/auth/menu','GET','127.0.0.1','{\"_pjax\":\"#pjax-container\"}','2020-03-17 07:50:39','2020-03-17 07:50:39'),(227,1,'admin/users','GET','127.0.0.1','{\"_pjax\":\"#pjax-container\"}','2020-03-17 07:50:42','2020-03-17 07:50:42'),(228,1,'admin/users','GET','127.0.0.1','[]','2020-03-17 07:51:32','2020-03-17 07:51:32'),(229,1,'admin/users','GET','127.0.0.1','{\"_pjax\":\"#pjax-container\"}','2020-03-17 07:52:06','2020-03-17 07:52:06'),(230,1,'admin/auth/users','GET','127.0.0.1','{\"_pjax\":\"#pjax-container\"}','2020-03-17 07:52:08','2020-03-17 07:52:08'),(231,1,'admin/users','GET','127.0.0.1','{\"_pjax\":\"#pjax-container\"}','2020-03-17 07:52:10','2020-03-17 07:52:10'),(232,1,'admin/users/1/edit','GET','127.0.0.1','{\"_pjax\":\"#pjax-container\"}','2020-03-17 07:53:23','2020-03-17 07:53:23'),(233,1,'admin/users','GET','127.0.0.1','{\"_pjax\":\"#pjax-container\"}','2020-03-17 07:53:43','2020-03-17 07:53:43'),(234,1,'admin/users/1/edit','GET','127.0.0.1','{\"_pjax\":\"#pjax-container\"}','2020-03-17 07:54:02','2020-03-17 07:54:02'),(235,1,'admin/users','GET','127.0.0.1','{\"_pjax\":\"#pjax-container\"}','2020-03-17 07:54:23','2020-03-17 07:54:23'),(236,1,'admin/users','GET','127.0.0.1','[]','2020-03-17 08:03:36','2020-03-17 08:03:36'),(237,1,'admin/users','GET','127.0.0.1','[]','2020-03-17 08:04:51','2020-03-17 08:04:51'),(238,1,'admin/users','GET','127.0.0.1','[]','2020-03-17 08:05:21','2020-03-17 08:05:21'),(239,1,'admin/users/1/edit','GET','127.0.0.1','[]','2020-03-17 08:05:45','2020-03-17 08:05:45'),(240,1,'admin/users/1/edit','GET','127.0.0.1','[]','2020-03-17 08:05:54','2020-03-17 08:05:54'),(241,1,'admin/users','GET','127.0.0.1','{\"_pjax\":\"#pjax-container\"}','2020-03-17 08:06:11','2020-03-17 08:06:11'),(242,1,'admin/users','GET','127.0.0.1','[]','2020-03-17 08:06:12','2020-03-17 08:06:12'),(243,1,'admin/users','GET','127.0.0.1','[]','2020-03-17 08:06:26','2020-03-17 08:06:26'),(244,1,'admin/users','GET','127.0.0.1','[]','2020-03-17 08:06:28','2020-03-17 08:06:28'),(245,1,'admin/users','GET','127.0.0.1','[]','2020-03-17 08:06:42','2020-03-17 08:06:42'),(246,1,'admin/users','GET','127.0.0.1','[]','2020-03-17 08:08:41','2020-03-17 08:08:41'),(247,1,'admin/users','GET','127.0.0.1','[]','2020-03-17 08:10:47','2020-03-17 08:10:47'),(248,1,'admin/users','GET','127.0.0.1','[]','2020-03-18 05:56:03','2020-03-18 05:56:03'),(249,1,'admin/users/1/edit','GET','127.0.0.1','{\"_pjax\":\"#pjax-container\"}','2020-03-18 06:13:30','2020-03-18 06:13:30'),(250,1,'admin/users','GET','127.0.0.1','{\"_pjax\":\"#pjax-container\"}','2020-03-18 06:13:35','2020-03-18 06:13:35'),(251,1,'admin/users/2/edit','GET','127.0.0.1','{\"_pjax\":\"#pjax-container\"}','2020-03-18 06:13:39','2020-03-18 06:13:39'),(252,1,'admin/users','GET','127.0.0.1','{\"_pjax\":\"#pjax-container\"}','2020-03-18 06:13:47','2020-03-18 06:13:47'),(253,1,'admin/users','GET','127.0.0.1','[]','2020-03-19 07:16:03','2020-03-19 07:16:03'),(254,1,'admin/users','GET','127.0.0.1','[]','2020-03-20 05:56:04','2020-03-20 05:56:04'),(255,1,'admin/users/create','GET','127.0.0.1','{\"_pjax\":\"#pjax-container\"}','2020-03-20 05:56:12','2020-03-20 05:56:12'),(256,1,'admin/users','POST','127.0.0.1','{\"name\":\"test\",\"email\":\"aa@gmail.com\",\"password\":\"123456\",\"remember_token\":\"a\",\"_token\":\"cLI5QVy3YUrLgwsSiNWvGHo3Rhemef4NtGwYUI67\",\"_previous_\":\"http:\\/\\/127.0.0.1:8000\\/admin\\/users\"}','2020-03-20 05:56:31','2020-03-20 05:56:31'),(257,1,'admin/users','GET','127.0.0.1','[]','2020-03-20 05:56:32','2020-03-20 05:56:32'),(258,1,'admin/_handle_action_','POST','127.0.0.1','{\"_key\":\"4\",\"_model\":\"App_User\",\"_token\":\"cLI5QVy3YUrLgwsSiNWvGHo3Rhemef4NtGwYUI67\",\"_action\":\"Encore_Admin_Grid_Actions_Delete\",\"_input\":\"true\"}','2020-03-20 05:57:04','2020-03-20 05:57:04'),(259,1,'admin/users','GET','127.0.0.1','{\"_pjax\":\"#pjax-container\"}','2020-03-20 05:57:05','2020-03-20 05:57:05');
/*!40000 ALTER TABLE `admin_operation_log` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `admin_permissions`
--

DROP TABLE IF EXISTS `admin_permissions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `admin_permissions` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `http_method` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `http_path` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `admin_permissions_name_unique` (`name`),
  UNIQUE KEY `admin_permissions_slug_unique` (`slug`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `admin_permissions`
--

LOCK TABLES `admin_permissions` WRITE;
/*!40000 ALTER TABLE `admin_permissions` DISABLE KEYS */;
INSERT INTO `admin_permissions` VALUES (1,'All permission','*','','*',NULL,NULL),(2,'Dashboard','dashboard','GET','/',NULL,NULL),(3,'Login','auth.login','','/auth/login\r\n/auth/logout',NULL,NULL),(4,'User setting','auth.setting','GET,PUT','/auth/setting',NULL,NULL),(5,'Auth management','auth.management','','/auth/roles\r\n/auth/permissions\r\n/auth/menu\r\n/auth/logs',NULL,NULL);
/*!40000 ALTER TABLE `admin_permissions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `admin_role_menu`
--

DROP TABLE IF EXISTS `admin_role_menu`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `admin_role_menu` (
  `role_id` int NOT NULL,
  `menu_id` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  KEY `admin_role_menu_role_id_menu_id_index` (`role_id`,`menu_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `admin_role_menu`
--

LOCK TABLES `admin_role_menu` WRITE;
/*!40000 ALTER TABLE `admin_role_menu` DISABLE KEYS */;
INSERT INTO `admin_role_menu` VALUES (1,2,NULL,NULL);
/*!40000 ALTER TABLE `admin_role_menu` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `admin_role_permissions`
--

DROP TABLE IF EXISTS `admin_role_permissions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `admin_role_permissions` (
  `role_id` int NOT NULL,
  `permission_id` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  KEY `admin_role_permissions_role_id_permission_id_index` (`role_id`,`permission_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `admin_role_permissions`
--

LOCK TABLES `admin_role_permissions` WRITE;
/*!40000 ALTER TABLE `admin_role_permissions` DISABLE KEYS */;
INSERT INTO `admin_role_permissions` VALUES (1,1,NULL,NULL);
/*!40000 ALTER TABLE `admin_role_permissions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `admin_role_users`
--

DROP TABLE IF EXISTS `admin_role_users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `admin_role_users` (
  `role_id` int NOT NULL,
  `user_id` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  KEY `admin_role_users_role_id_user_id_index` (`role_id`,`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `admin_role_users`
--

LOCK TABLES `admin_role_users` WRITE;
/*!40000 ALTER TABLE `admin_role_users` DISABLE KEYS */;
INSERT INTO `admin_role_users` VALUES (1,1,NULL,NULL);
/*!40000 ALTER TABLE `admin_role_users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `admin_roles`
--

DROP TABLE IF EXISTS `admin_roles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `admin_roles` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `admin_roles_name_unique` (`name`),
  UNIQUE KEY `admin_roles_slug_unique` (`slug`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `admin_roles`
--

LOCK TABLES `admin_roles` WRITE;
/*!40000 ALTER TABLE `admin_roles` DISABLE KEYS */;
INSERT INTO `admin_roles` VALUES (1,'Administrator','administrator','2020-02-16 22:37:23','2020-02-16 22:37:23');
/*!40000 ALTER TABLE `admin_roles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `admin_user_permissions`
--

DROP TABLE IF EXISTS `admin_user_permissions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `admin_user_permissions` (
  `user_id` int NOT NULL,
  `permission_id` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  KEY `admin_user_permissions_user_id_permission_id_index` (`user_id`,`permission_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `admin_user_permissions`
--

LOCK TABLES `admin_user_permissions` WRITE;
/*!40000 ALTER TABLE `admin_user_permissions` DISABLE KEYS */;
/*!40000 ALTER TABLE `admin_user_permissions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `admin_users`
--

DROP TABLE IF EXISTS `admin_users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `admin_users` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(190) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(60) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `avatar` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `admin_users_username_unique` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `admin_users`
--

LOCK TABLES `admin_users` WRITE;
/*!40000 ALTER TABLE `admin_users` DISABLE KEYS */;
INSERT INTO `admin_users` VALUES (1,'admin','$2y$10$kRXTuvHULVe3z3PpeSzyjOAPv0AFxySDnzPAqTQ/.hLmZ8YCg6WFi','Administrator','images/11a3adbcfc7e2b804406e6f724f188c6.jpg','UmqGPztzEpM7UdIagTwsBHTA0jQSXcFgD7qt8H9ifVzgYvt9EBeijkPzB2hB','2020-02-16 22:37:23','2020-03-17 07:49:57'),(3,'subadmin','$2y$10$dT0ltx5WkgLdG1kJCyyYTuujruKRjsiHbrWIjxOd6Ay34vOGIMMxC','subadmin','images/0f91264f4a4247a4afdffb2825d0238e.jpg','um4dqoLLQY1a3TlMeTrTO1v7qhJ0BbzQBGTTleLl9btv4udPnwhXs7XES9d7','2020-03-17 06:20:48','2020-03-17 06:35:19');
/*!40000 ALTER TABLE `admin_users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `migrations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (1,'2014_10_12_000000_create_users_table',1),(2,'2014_10_12_100000_create_password_resets_table',1),(3,'2016_01_04_173148_create_admin_tables',1),(4,'2020_02_18_143927_create_punch_table',2),(5,'2020_02_19_143118_create_punches_table',3),(6,'2020_02_20_222123_create_punches_table',4),(7,'2020_02_21_170141_create_punches_table',5),(8,'2020_03_16_141729_create_punches_table',6),(9,'2020_03_16_142146_create_punches_table',7),(11,'2020_03_16_143825_create_punches_table',8);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `password_resets`
--

DROP TABLE IF EXISTS `password_resets`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `password_resets`
--

LOCK TABLES `password_resets` WRITE;
/*!40000 ALTER TABLE `password_resets` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_resets` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `punches`
--

DROP TABLE IF EXISTS `punches`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `punches` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `userid` int NOT NULL,
  `punch_year_month` int NOT NULL,
  `punch_date` int NOT NULL,
  `punch_time` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `punch_end_year_month` int DEFAULT NULL,
  `punch_end_date` int DEFAULT NULL,
  `punch_end_time` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=52 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `punches`
--

LOCK TABLES `punches` WRITE;
/*!40000 ALTER TABLE `punches` DISABLE KEYS */;
INSERT INTO `punches` VALUES (29,1,202003,18,'22:32',NULL,NULL,NULL,'1','2020-03-18 14:32:17','2020-03-18 14:32:17'),(30,2,202003,18,'22:32',NULL,NULL,NULL,'1','2020-03-18 14:32:18','2020-03-18 14:32:18'),(31,3,202003,18,'22:32',NULL,NULL,NULL,'1','2020-03-18 14:32:19','2020-03-18 14:32:19'),(32,1,202003,19,'13:39',NULL,NULL,NULL,'1','2020-03-19 05:39:03','2020-03-19 05:39:03'),(33,2,202003,19,'13:39',NULL,NULL,NULL,'1','2020-03-19 05:39:04','2020-03-19 05:39:04'),(34,3,202003,19,'13:39',NULL,NULL,NULL,'1','2020-03-19 05:39:05','2020-03-19 05:39:05'),(44,1,202003,20,'08:00',202003,20,'17:30','3','2020-03-19 06:11:00','2020-03-19 06:11:00'),(45,1,202003,2,'08:00',202003,3,'17:30','3','2020-03-19 06:11:22','2020-03-19 06:11:22'),(46,1,202003,4,'08:00',202003,6,'17:30','3','2020-03-19 06:11:41','2020-03-19 06:11:41'),(47,1,202003,9,'08:00',202003,10,'12:00','3','2020-03-19 06:12:11','2020-03-19 06:12:11'),(48,1,202003,19,'14:24',NULL,NULL,NULL,'2','2020-03-19 06:24:45','2020-03-19 06:24:45'),(49,1,202003,20,'13:55',NULL,NULL,NULL,'1','2020-03-20 05:55:20','2020-03-20 05:55:20'),(50,2,202003,20,'13:55',NULL,NULL,NULL,'1','2020-03-20 05:55:21','2020-03-20 05:55:21'),(51,3,202003,20,'13:55',NULL,NULL,NULL,'1','2020-03-20 05:55:23','2020-03-20 05:55:23');
/*!40000 ALTER TABLE `punches` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'思涵','test@gmail.com','123456','123456',NULL,'2020-03-17 07:44:24'),(2,'英娟','2@gmail.com','1234',NULL,NULL,NULL),(3,'小芳','3@gmail.com','1234',NULL,NULL,NULL);
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

-- Dump completed on 2020-03-20 16:13:19
