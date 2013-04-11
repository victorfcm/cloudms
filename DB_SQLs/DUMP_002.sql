-- MySQL dump 10.13  Distrib 5.5.29, for debian-linux-gnu (i686)
--
-- Host: localhost    Database: cms
-- ------------------------------------------------------
-- Server version	5.5.29-0ubuntu0.12.04.2

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
-- Table structure for table `Post`
--

DROP TABLE IF EXISTS `Post`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Post` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `post_type_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `daddy_id` int(11) DEFAULT NULL,
  `header` longtext COLLATE utf8_unicode_ci,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `content` longtext COLLATE utf8_unicode_ci NOT NULL,
  `footer` longtext COLLATE utf8_unicode_ci,
  `postTypeId` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_FAB8C3B3F8A43BA0` (`post_type_id`),
  KEY `IDX_FAB8C3B3A76ED395` (`user_id`),
  KEY `IDX_FAB8C3B36CA2598C` (`daddy_id`),
  CONSTRAINT `FK_FAB8C3B36CA2598C` FOREIGN KEY (`daddy_id`) REFERENCES `Post` (`id`) ON DELETE CASCADE,
  CONSTRAINT `FK_FAB8C3B3A76ED395` FOREIGN KEY (`user_id`) REFERENCES `User` (`id`) ON DELETE SET NULL,
  CONSTRAINT `FK_FAB8C3B3F8A43BA0` FOREIGN KEY (`post_type_id`) REFERENCES `PostType` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Post`
--

LOCK TABLES `Post` WRITE;
/*!40000 ALTER TABLE `Post` DISABLE KEYS */;
INSERT INTO `Post` VALUES (11,NULL,1,NULL,NULL,'Pedro Paulo','Teste',NULL,NULL,'2013-03-21 14:29:43','2013-03-21 14:29:43'),(12,NULL,1,NULL,NULL,'test','testeee',NULL,NULL,'2013-03-21 14:30:42','2013-03-21 14:30:42'),(16,3,2,11,NULL,'Notícia Teste','<p>Teste HAHAHA</p>',NULL,NULL,'2013-03-21 14:39:30','2013-04-10 14:42:56'),(17,NULL,NULL,NULL,NULL,'Demo','demo',NULL,NULL,'2013-03-21 14:43:31','2013-03-22 11:17:01'),(29,1,3,NULL,NULL,'Página 1','<p>p&aacute;gina 1</p>',NULL,NULL,'2013-04-10 13:10:32','2013-04-10 13:10:32'),(30,1,3,29,NULL,'Sub Página 1','<p>sub p&aacute;gina 1</p>',NULL,NULL,'2013-04-10 13:10:45','2013-04-10 13:10:45');
/*!40000 ALTER TABLE `Post` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `PostAttachment`
--

DROP TABLE IF EXISTS `PostAttachment`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `PostAttachment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `post_id` int(11) NOT NULL,
  `path` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `file_name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `mime` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_17947D594B89032C` (`post_id`),
  CONSTRAINT `FK_17947D594B89032C` FOREIGN KEY (`post_id`) REFERENCES `Post` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `PostAttachment`
--

LOCK TABLES `PostAttachment` WRITE;
/*!40000 ALTER TABLE `PostAttachment` DISABLE KEYS */;
/*!40000 ALTER TABLE `PostAttachment` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `PostRelashionship`
--

DROP TABLE IF EXISTS `PostRelashionship`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `PostRelashionship` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `post_id` int(11) DEFAULT NULL,
  `daddy_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_BDA794224B89032C` (`post_id`),
  KEY `IDX_BDA794226CA2598C` (`daddy_id`),
  CONSTRAINT `FK_BDA794224B89032C` FOREIGN KEY (`post_id`) REFERENCES `Post` (`id`),
  CONSTRAINT `FK_BDA794226CA2598C` FOREIGN KEY (`daddy_id`) REFERENCES `Post` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `PostRelashionship`
--

LOCK TABLES `PostRelashionship` WRITE;
/*!40000 ALTER TABLE `PostRelashionship` DISABLE KEYS */;
/*!40000 ALTER TABLE `PostRelashionship` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `PostTermRelashionship`
--

DROP TABLE IF EXISTS `PostTermRelashionship`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `PostTermRelashionship` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `term_id` int(11) DEFAULT NULL,
  `post_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_362E9EC3E2C35FC` (`term_id`),
  KEY `IDX_362E9EC34B89032C` (`post_id`),
  CONSTRAINT `FK_362E9EC34B89032C` FOREIGN KEY (`post_id`) REFERENCES `Post` (`id`),
  CONSTRAINT `FK_362E9EC3E2C35FC` FOREIGN KEY (`term_id`) REFERENCES `Term` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `PostTermRelashionship`
--

LOCK TABLES `PostTermRelashionship` WRITE;
/*!40000 ALTER TABLE `PostTermRelashionship` DISABLE KEYS */;
/*!40000 ALTER TABLE `PostTermRelashionship` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `PostType`
--

DROP TABLE IF EXISTS `PostType`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `PostType` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8_unicode_ci NOT NULL,
  `in_menu` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `PostType`
--

LOCK TABLES `PostType` WRITE;
/*!40000 ALTER TABLE `PostType` DISABLE KEYS */;
INSERT INTO `PostType` VALUES (1,'page','tipo Página',1),(3,'News','tipo de post para notícias',1),(4,'Médicos','teste',1),(5,'TESTE','teste',1),(6,'imagem','<p>Post type de imagens</p>',0),(7,'arquivo','<p>Post type de arquivo</p>',0);
/*!40000 ALTER TABLE `PostType` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `PostTypeTaxonomyRelashionship`
--

DROP TABLE IF EXISTS `PostTypeTaxonomyRelashionship`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `PostTypeTaxonomyRelashionship` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `taxonomy_id` int(11) DEFAULT NULL,
  `postType_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_E7D2680CC3E0B6E9` (`postType_id`),
  KEY `IDX_E7D2680C9557E6F6` (`taxonomy_id`),
  CONSTRAINT `FK_E7D2680C9557E6F6` FOREIGN KEY (`taxonomy_id`) REFERENCES `Taxonomy` (`id`),
  CONSTRAINT `FK_E7D2680CC3E0B6E9` FOREIGN KEY (`postType_id`) REFERENCES `PostType` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `PostTypeTaxonomyRelashionship`
--

LOCK TABLES `PostTypeTaxonomyRelashionship` WRITE;
/*!40000 ALTER TABLE `PostTypeTaxonomyRelashionship` DISABLE KEYS */;
INSERT INTO `PostTypeTaxonomyRelashionship` VALUES (1,2,4),(2,1,3),(3,3,5);
/*!40000 ALTER TABLE `PostTypeTaxonomyRelashionship` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Taxonomy`
--

DROP TABLE IF EXISTS `Taxonomy`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Taxonomy` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Taxonomy`
--

LOCK TABLES `Taxonomy` WRITE;
/*!40000 ALTER TABLE `Taxonomy` DISABLE KEYS */;
INSERT INTO `Taxonomy` VALUES (1,'Categoria','Categorias'),(2,'Especialidade','especialidade de cada médico'),(3,'Tipo de teste','testeteste'),(4,'Teste','<p>teste</p>');
/*!40000 ALTER TABLE `Taxonomy` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Term`
--

DROP TABLE IF EXISTS `Term`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Term` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `daddy_id` int(11) DEFAULT NULL,
  `name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_53D48B36CA2598C` (`daddy_id`),
  CONSTRAINT `FK_53D48B36CA2598C` FOREIGN KEY (`daddy_id`) REFERENCES `Term` (`id`) ON DELETE SET NULL
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Term`
--

LOCK TABLES `Term` WRITE;
/*!40000 ALTER TABLE `Term` DISABLE KEYS */;
INSERT INTO `Term` VALUES (1,NULL,'Blusa','teste'),(3,NULL,'Shorts Jeans','shorts jeans!');
/*!40000 ALTER TABLE `Term` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `TermTaxonomyRelashionship`
--

DROP TABLE IF EXISTS `TermTaxonomyRelashionship`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `TermTaxonomyRelashionship` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `term_id` int(11) DEFAULT NULL,
  `taxonomy_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_F80A604E2C35FC` (`term_id`),
  KEY `IDX_F80A6049557E6F6` (`taxonomy_id`),
  CONSTRAINT `FK_F80A6049557E6F6` FOREIGN KEY (`taxonomy_id`) REFERENCES `Taxonomy` (`id`),
  CONSTRAINT `FK_F80A604E2C35FC` FOREIGN KEY (`term_id`) REFERENCES `Term` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `TermTaxonomyRelashionship`
--

LOCK TABLES `TermTaxonomyRelashionship` WRITE;
/*!40000 ALTER TABLE `TermTaxonomyRelashionship` DISABLE KEYS */;
INSERT INTO `TermTaxonomyRelashionship` VALUES (1,1,1),(3,3,1);
/*!40000 ALTER TABLE `TermTaxonomyRelashionship` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `User`
--

DROP TABLE IF EXISTS `User`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `User` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `username_canonical` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email_canonical` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `enabled` tinyint(1) NOT NULL,
  `salt` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `last_login` datetime DEFAULT NULL,
  `locked` tinyint(1) NOT NULL,
  `expired` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL,
  `confirmation_token` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `password_requested_at` datetime DEFAULT NULL,
  `roles` longtext COLLATE utf8_unicode_ci NOT NULL COMMENT '(DC2Type:array)',
  `credentials_expired` tinyint(1) NOT NULL,
  `credentials_expire_at` datetime DEFAULT NULL,
  `name` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_2DA1797792FC23A8` (`username_canonical`),
  UNIQUE KEY `UNIQ_2DA17977A0D96FBF` (`email_canonical`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `User`
--

LOCK TABLES `User` WRITE;
/*!40000 ALTER TABLE `User` DISABLE KEYS */;
INSERT INTO `User` VALUES (1,'admin','admin','admin@admin.com','admin@admin.com',1,'7z4h7o3rla4gc88c40cscw4ws84ss8c','pIJyv4Go4/sb6XYx5eW6Fku8dYcBg7wOYUKrAine0CepX+IkDx4NEUkEXf6jk7Jdpj2zQ/AyYg5JJsdLCPFIZw==','2013-04-10 14:52:18',0,0,NULL,NULL,NULL,'a:1:{i:0;s:10:\"ROLE_ADMIN\";}',0,NULL,NULL),(2,'editor','editor','editor@teste.com','editor@teste.com',1,'sv2d3gksv8ggko4sgkww88kksowcg0g','jAQdhthOa3e4XPRBinulEU8e7XY3VmQ5pxT0p5xE7YpGdoQhyt3qO2roZAfEJZnWC4VL2GpB/QGlws+eoY5+dw==','2013-03-21 14:38:43',0,0,NULL,NULL,NULL,'a:1:{i:0;s:10:\"ROLE_ADMIN\";}',0,NULL,NULL),(3,'master','master','asd@asd.com','asd@asd.com',1,'p4xo88ovjiss084k4o84ockowsc4cgc','pSlU4PoHwvaXfSJYim0bhaczQvZM3HdmlWfV91ePxKxfalDCvk4I4YNu8hwjP1uXFYTq/mY5hwLc/WNxIfkGGA==','2013-04-10 11:48:24',0,0,NULL,NULL,NULL,'a:1:{i:0;s:16:\"ROLE_SUPER_ADMIN\";}',0,NULL,NULL);
/*!40000 ALTER TABLE `User` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `UserPermission`
--

DROP TABLE IF EXISTS `UserPermission`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `UserPermission` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `permissions` longtext COLLATE utf8_unicode_ci NOT NULL COMMENT '(DC2Type:object)',
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_2F0CC55BA76ED395` (`user_id`),
  CONSTRAINT `FK_2F0CC55BA76ED395` FOREIGN KEY (`user_id`) REFERENCES `User` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `UserPermission`
--

LOCK TABLES `UserPermission` WRITE;
/*!40000 ALTER TABLE `UserPermission` DISABLE KEYS */;
/*!40000 ALTER TABLE `UserPermission` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `post_post`
--

DROP TABLE IF EXISTS `post_post`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `post_post` (
  `post_id` int(11) NOT NULL,
  KEY `IDX_93DF0B864B89032C` (`post_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `post_post`
--

LOCK TABLES `post_post` WRITE;
/*!40000 ALTER TABLE `post_post` DISABLE KEYS */;
/*!40000 ALTER TABLE `post_post` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2013-04-10 15:04:15
