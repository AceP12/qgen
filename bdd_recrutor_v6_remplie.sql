-- MySQL dump 10.13  Distrib 5.5.35, for debian-linux-gnu (x86_64)
--
-- Host: localhost    Database: recrutor
-- ------------------------------------------------------
-- Server version	5.5.35-0ubuntu0.12.04.2

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
-- Table structure for table `candidats`
--

DROP TABLE IF EXISTS `candidats`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `candidats` (
  `ID_Candidat` smallint(6) NOT NULL AUTO_INCREMENT,
  `nom` varchar(128) NOT NULL,
  `prenom` varchar(128) NOT NULL,
  `email` varchar(128) DEFAULT NULL,
  `score` tinyint(4) DEFAULT NULL,
  `temps` smallint(6) DEFAULT NULL,
  `id_questionnaire` smallint(6) DEFAULT NULL,
  `questions_posees` text,
  `reponses_donnees` text,
  `date` timestamp NULL DEFAULT NULL,
  `visible` tinyint(1) NOT NULL DEFAULT '1',
  `as_deleted` tinyint(1) NOT NULL DEFAULT '0',
  `assoc` text,
  `responsable` varchar(30) NOT NULL,
  PRIMARY KEY (`ID_Candidat`),
  KEY `id_questionnaire` (`id_questionnaire`),
  KEY `responsable` (`responsable`),
  CONSTRAINT `candidats_ibfk_2` FOREIGN KEY (`responsable`) REFERENCES `utilisateurs` (`identifiant`) ON UPDATE CASCADE,
  CONSTRAINT `candidats_ibfk_1` FOREIGN KEY (`id_questionnaire`) REFERENCES `questionnaires` (`ID_Questionnaire`)
) ENGINE=InnoDB AUTO_INCREMENT=181 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `candidats`
--

LOCK TABLES `candidats` WRITE;
/*!40000 ALTER TABLE `candidats` DISABLE KEYS */;
INSERT INTO `candidats` VALUES (2,'Berger','Sylvain','sylkun.graphx@live.fr',3,0,2,'1,2,3','1,1,1,','2014-05-19 12:33:09',0,0,'0','Sylkun'),(7,'Berger','Sylvain','mail@mail.fr',3,0,2,'1,2,3','1,1,1,','2014-05-19 14:55:25',0,0,'0','Sylkun'),(8,'Marx','Karl','xptdrrr@hotmail.com',NULL,NULL,2,'1,2,3','0,0,0','2014-05-19 14:57:05',1,0,'123432142314','Sylkun'),(9,'man','super','gaetanrossi@msn.com',2,0,2,'1,2,3','1,2,1,','2014-05-19 15:46:42',0,0,'0','Sylkun'),(10,'Senna','Ayrton','imol@rrg.it',NULL,1,2,'1,2,3','0,0,0','2014-05-19 15:50:15',1,0,'0','Sylkun'),(11,'Kenobi','Obi-Wan','knb@ben.sw',0,0,2,'1,2,3','5,5,5,','2014-05-19 16:06:44',0,0,'0','Sylkun'),(12,'Solo','Han','han@solo.sw',1,0,2,'1,2,3','1,2,3,','2014-05-19 16:11:25',0,0,'0','Sylkun'),(13,'Princesse','Leïa','leia@organa.pr',0,1,2,'1,2,3','4,0,0,','2014-05-19 16:14:42',0,0,'0','Sylkun'),(20,'Simpson','Homer','doh@doh.do',1,0,2,'1,2,3','5,1,2','2014-05-19 18:19:05',0,0,'321424313214','Sylkun'),(21,'Crash','Dummy','crash@test.eu',1,1,2,'1,2,3','4,2,1','2014-05-19 18:41:44',0,0,'0','Sylkun'),(22,'chirac','jacques','jacqueschirac@msn.com',3,0,2,'1,2,3','1,1,1','2014-05-19 21:40:04',0,0,'0','Sylkun'),(24,'Marx','Karl','xptdrrr@hotmail.com',NULL,NULL,2,'1,2,3','0,0,0','2014-05-20 07:19:04',0,0,'243141321342','Sylkun'),(25,'Marx','Karl','xptdrrr@hotmail.com',NULL,NULL,2,'1,2,3','0,0,0','2014-05-20 07:23:27',0,0,'214343121432','Sylkun'),(26,'mathieu','mireille','mireille@hotmail.fr',1,0,2,'1,2,3','1,4,2','2014-05-20 08:56:46',0,0,'0','Sylkun'),(27,'Marx','Karl','xptdrrr@hotmail.fr',2,0,2,'1,2,3','4,1,1','2014-05-20 10:58:13',0,0,'0','Sylkun'),(30,'De la Villardière','Bernard','bdlv@m6.fr',NULL,1,2,'1,2,3','0,0,0','2014-05-20 11:53:29',0,0,'0','Sylkun'),(31,'Epergola','Pipolino','pipo@eper.go',NULL,1,2,'1,2,3','0,0,0','2014-05-20 11:57:55',0,0,'0','Sylkun'),(33,'John','John','john@jj.us',NULL,15,3,'1,2,3','0,0,0','2014-05-20 12:26:05',0,0,'0','Sylkun'),(34,'Connors','Sarah','t1@t2.t3',0,0,3,'1,2,3','4,0,0','2014-05-20 13:57:57',0,0,'312441321234','Sylkun'),(35,'Internet','Explhorreur','im@ffraid.com',NULL,NULL,4,'3,2,1','0,0,0','2014-05-20 14:05:04',1,0,'431224314312','Sylkun'),(37,'Cette fois','C\'est bon','bon@bon.bo',3,12,3,'1,2,3','1,1,1','2014-05-20 14:19:27',0,0,'0','Sylkun'),(38,'douglas','micheal','micheldouglas@hotmail.fr',0,0,3,'1,2,3','4,4,2','2014-05-20 15:18:58',0,0,'0','Sylkun'),(39,'Yo','Mc','yomc@google.fr',3,0,4,'3,2,1','1,1,1','2014-05-21 10:53:41',0,0,'0','Sylkun'),(44,'Marx','Karl','xptdrrrr@hotmail.fr',0,0,2,'1,2,3','3,3,2','2014-05-21 12:00:53',0,0,'0','Sylkun'),(45,'Da Maniak','Mak','mdmk@gmail.com',18,3,5,'23,22,26,24,26,10,7,6,5,15,13,14,17,18,19,9,8,20,12,4','3,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,4,1','2014-05-21 13:19:12',0,0,'0','Sylkun'),(46,'DaManiak','Mak','mdmk@gmail.com',20,13,5,'23,22,26,24,26,10,7,6,5,15,13,14,17,18,19,9,8,20,12,4','1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1,1','2014-05-21 13:29:32',0,0,'0','Sylkun'),(47,'Moi','Commedab','commedab@dab.com',1,0,6,'27','1','2014-05-21 14:00:24',0,0,'0','Sylkun'),(48,'Commedab','Moi','commedab@dab.com',NULL,NULL,6,'27','0','2014-05-21 14:09:13',1,0,'2134','Sylkun'),(51,'Jaa','Tony','tony_jaa@hotmail.com',4,1,5,'23,22,26,24,26,10,7,6,5,15,13,14,17,18,19,9,8,20,12,4','2,3,3,3,1,2,4,3,1,2,2,3,4,5,1,1,4,2,2,5','2014-05-22 06:48:52',0,0,'0','Sylkun'),(52,'One','Jake','jake_uno@206.com',NULL,0,5,'23,22,26,24,26,10,7,6,5,15,13,14,17,18,19,9,8,20,12,4','0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0','2014-05-22 06:53:40',1,0,'0','Sylkun'),(55,'Samassa','Mamadou','mds@hotmail.sk',NULL,0,5,'23,22,26,24,26,10,7,6,5,15,13,14,17,18,19,9,8,20,12,4','0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0','2014-05-22 09:41:15',1,0,'0','Sylkun '),(56,'Marx','Karl','karlito@kk.fr',0,0,5,'23,22,26,24,26,10,7,6,5,15,13,14,17,18,19,9,8,20,12,4','2,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0','2014-05-22 12:01:33',0,0,'0','Sylkun'),(73,'Chacha','Cocorico','iziizi_life@chill.us',NULL,0,5,'23,22,26,24,26,10,7,6,5,15,13,14,17,18,19,9,8,20,12,4','0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0','2014-05-23 09:12:52',1,0,'0','Sylkun'),(75,'Berger','Sylvain','mail@mm.com',NULL,0,5,'23,22,26,24,26,10,7,6,5,15,13,14,17,18,19,9,8,20,12,4','0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0','2014-05-23 09:31:38',1,0,'0','Sylkun'),(76,'blabla','blabla','bla@bla.com',0,0,5,'23,22,26,24,26,10,7,6,5,15,13,14,17,18,19,9,8,20,12,4','0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0','2014-05-23 09:46:13',0,0,'0','Sylkun'),(77,'Polo','Marco','path@bk-t.dot.com',0,0,5,'23,22,26,24,26,10,7,6,5,15,13,14,17,18,19,9,8,20,12,4','0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0','2014-05-23 09:56:01',0,0,'0','Sylkun'),(79,'Wax','Master C','djpremier@blog.com',0,15,5,'23,22,26,24,26,10,7,6,5,15,13,14,17,18,19,9,8,20,12,4','0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0','2014-05-23 10:12:07',0,0,'0','Sylkun'),(81,'Buster','Rhymes','bbbs@oultook.com',0,0,5,'23,22,26,24,26,10,7,6,5,15,13,14,17,18,19,9,8,20,12,4','0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0','2014-05-23 10:54:57',0,0,'31241243314242134123134212432143412313421243342132141324324131244132234114232143','Sylkun'),(82,'L\'Eventeur','Jacques','jacques-vent@chlass.com',0,0,5,'23,22,26,24,26,10,7,6,5,15,13,14,17,18,19,9,8,20,12,4','0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0','2014-05-23 11:20:16',0,0,'0','Sylkun'),(86,'Travolta','John','jt@jt.us',NULL,NULL,5,'23,22,26,24,26,10,7,6,5,15,13,14,17,18,19,9,8,20,12,4','0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0','2014-05-23 12:20:19',0,0,'14231342321441321432432143214123214323412143134223141243123421431342124341232314','Sylkun'),(90,'Connery','Sean','cs@cs.cs',1,0,5,'23,22,26,24,26,10,7,6,5,15,13,14,17,18,19,9,8,20,12,4','3,0,2,0,0,0,0,0,0,0,1,0,0,0,0,0,0,0,0,0','2014-05-23 21:50:28',0,0,'13242431324141232314432143121234312441322413431221434321213442314213213412432413','Sylkun'),(91,'Lecter','Hannibal','silence@aa.com',0,15,5,'23,22,26,24,26,10,7,6,5,15,13,14,17,18,19,9,8,20,12,4','2,0,0,0,0,0,1,0,0,0,0,0,0,0,0,0,0,0,0,0','2014-05-23 23:10:05',0,0,'0','Sylkun'),(103,'Schultz','Papa','stalag@13.de',0,15,5,'23,22,26,24,26,10,7,6,5,15,13,14,17,18,19,9,8,20,12,4','0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0','2014-05-25 18:53:57',0,0,'0','Sylkun'),(104,'Loeb','Sebastien','citrono@wrc.com',0,4,5,'23,22,26,24,26,10,7,6,5,15,13,14,17,18,19,9,8,20,12,4','3,0,0,0,0,5,0,0,0,4,0,0,0,0,0,0,0,0,0,5','2014-05-25 20:15:30',0,0,'32413124321441233241132442314123234114324123432141233124312443213142413212432143','Sylkun'),(162,'Yippi','Khaye','jmcl@dh.com',8,0,7,'24,10,13,14,19,8,25,26,21,20','1,1,1,1,1,1,0,1,1,0','2014-06-16 11:43:37',0,0,'0','Sylkun '),(163,'Ludo','Leclerc','lclhjj@gofast.com',5,2,7,'24,10,13,14,19,8,25,26,21,20','1,1,1,0,0,1,0,5,5,1','2014-06-16 12:05:41',0,0,'0','Sylkun'),(164,'MacGyver','Angus','do-it-yourself@phoenix.foundation.org',3,0,7,'24,10,13,14,19,8,25,26,21,20','3,4,4,5,5,5,1,1,1,0','2014-06-16 13:51:47',0,0,'0','Sylkun'),(165,'Pat','Hibulaire','pathblr@mickeymouse.com',14,4,5,'23,22,26,24,26,10,7,6,5,15,13,14,17,18,19,9,8,20,12,4','4,1,1,1,1,1,1,1,1,1,1,1,1,1,1,0,0,0,0,0','2014-06-17 08:43:01',0,0,'0','Sylkun '),(166,'Marvin','Martian','mar_mar@ltns.com',NULL,NULL,5,'23,22,26,24,26,10,7,6,5,15,13,14,17,18,19,9,8,20,12,4','0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0','2014-06-18 13:43:38',1,0,'12341234421331422413142331421342143241323142143234214132413234123214132424314213','Sylkun'),(167,'Luda','DTP','luda.dtp@dtpnn.com',NULL,NULL,5,'23,22,26,24,26,10,7,6,5,15,13,14,17,18,19,9,8,20,12,4','0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0','2014-06-18 14:07:25',1,0,'23143412324114234123314213422143142313243241341242132314132432411423312424134132','Sylkun '),(168,'Yo','Mec','yomec@htomial.fr',1,0,7,'24,10,13,14,19,8,25,26,21,20','1,0,0,0,0,0,0,0,0,0','2014-06-18 23:13:36',0,0,'0','Sylkun'),(169,'Pierre','Jacquot','ppjakk@hotmail.com',14,2,5,'23,22,26,24,26,10,7,6,5,15,13,14,17,18,19,9,8,20,12,4','1,1,1,1,1,1,1,1,1,1,1,1,1,1,0,0,0,0,0,0','2014-06-19 08:46:05',1,0,'0','Sylkun'),(170,'Samba','Lele','smblele@hotmail.com',3,1,5,'23,22,26,24,26,10,7,6,5,15,13,14,17,18,19,9,8,20,12,4','1,1,0,0,0,0,0,0,0,0,0,1,0,0,0,0,0,0,0,5','2014-06-19 11:55:50',1,0,'0','Sylkun'),(171,'Hemingway','Ernest','ern@hotmail.com',0,0,5,'23,22,26,24,26,10,7,6,5,15,13,14,17,18,19,9,8,20,12,4','0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0','2014-06-19 12:16:20',1,0,'0','Sylkun'),(172,'Simon','Simon','simsim@hotmail.com',11,6,5,'23,22,26,24,26,10,7,6,5,15,13,14,17,18,19,9,8,20,12,4','1,1,1,1,0,5,1,0,0,1,4,3,1,1,5,5,1,1,4,1','2014-06-19 12:19:40',1,0,'0','Sylkun'),(173,'Gerin','Merlin','merlin@gerin.mg',NULL,NULL,7,'24,10,13,14,19,8,25,26,21,20','0,0,0,0,0,0,0,0,0,0','2014-06-21 19:02:09',1,0,'4213312424312341421343212431324131242413','Sylkun'),(174,'May','James','bbc@jm.jm',1,1,7,'24,10,13,14,19,8,25,26,21,20','4,0,1,0,0,0,0,0,0,0','2014-06-21 19:43:37',0,0,'0','Sylkun'),(175,'Bolt','Usain','running@man.wr',5,2,7,'24,10,13,14,19,8,25,26,21,20','4,1,1,1,1,1,5,5,0,0','2014-06-21 20:39:35',1,0,'0','Sylkun'),(176,'Tenma','Kenzo','monster@dr.jp',10,4,7,'24,10,13,14,19,8,25,26,21,20','1,1,1,1,1,1,1,1,1,1','2014-06-21 23:14:29',1,0,'0','Sylkun'),(177,'MacFly','Marty','rttf@rvf.re',1,4,7,'24,10,13,14,19,8,25,26,21,20','1,0,0,0,0,0,0,0,0,0','2014-06-21 23:24:50',1,0,'0','Sylkun'),(178,'','<span>non inscrit...</span>',NULL,NULL,NULL,7,NULL,NULL,NULL,1,0,NULL,'Sylkun'),(179,'Hey Hey','Hey','heyheyhey@hotmail.com',NULL,NULL,5,'23,22,26,24,26,10,7,6,5,15,13,14,17,18,19,9,8,20,12,4','0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0','2014-07-10 10:20:24',1,0,'23142143134224132341214312344123214334211243132424311324412314234132421312434213','Sylkun'),(180,'Newman','Paul','pn@new.mn',0,5,7,'24,10,13,14,19,8,25,26,21,20','0,0,0,0,0,0,0,0,0,0','2014-07-18 11:59:21',1,0,'0','Sylkun');
/*!40000 ALTER TABLE `candidats` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `categories`
--

DROP TABLE IF EXISTS `categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `categories` (
  `id_domaine` smallint(6) NOT NULL,
  `ID_Categorie` smallint(6) NOT NULL AUTO_INCREMENT,
  `label` varchar(128) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `visible` tinyint(1) NOT NULL DEFAULT '1',
  `as_deleted` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`ID_Categorie`),
  KEY `id_domaine` (`id_domaine`),
  CONSTRAINT `categories_ibfk_1` FOREIGN KEY (`id_domaine`) REFERENCES `domaines` (`ID_Domaine`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `categories`
--

LOCK TABLES `categories` WRITE;
/*!40000 ALTER TABLE `categories` DISABLE KEYS */;
INSERT INTO `categories` VALUES (1,1,'Catégorie 1','2014-06-16 10:06:51',0,0),(2,2,'Windows','2014-06-06 08:36:05',1,0),(2,3,'Suite bureautique','2014-06-06 04:04:04',1,0),(2,4,'Applicatif','2014-06-06 08:36:02',1,0),(3,5,'Société','2014-06-06 04:04:05',1,0),(3,6,'Organisation','2014-06-06 08:36:04',1,0),(2,7,'Connexion réseau','2014-06-06 04:04:03',1,0),(2,8,'Matériel','2014-06-06 08:36:03',1,0),(1,9,'Catégorie 2','2014-06-16 10:06:52',0,0);
/*!40000 ALTER TABLE `categories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `domaines`
--

DROP TABLE IF EXISTS `domaines`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `domaines` (
  `ID_Domaine` smallint(6) NOT NULL AUTO_INCREMENT,
  `label` varchar(128) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `visible` tinyint(1) NOT NULL DEFAULT '1',
  `as_deleted` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`ID_Domaine`),
  UNIQUE KEY `label` (`label`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `domaines`
--

LOCK TABLES `domaines` WRITE;
/*!40000 ALTER TABLE `domaines` DISABLE KEYS */;
INSERT INTO `domaines` VALUES (1,'Domaine 1','2014-06-16 11:48:00',0,0),(2,'Technique','2014-05-26 20:50:49',1,0),(3,'Société','2014-06-05 00:40:05',1,0);
/*!40000 ALTER TABLE `domaines` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `permissions`
--

DROP TABLE IF EXISTS `permissions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `permissions` (
  `Permission` varchar(50) NOT NULL,
  PRIMARY KEY (`Permission`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `permissions`
--

LOCK TABLES `permissions` WRITE;
/*!40000 ALTER TABLE `permissions` DISABLE KEYS */;
INSERT INTO `permissions` VALUES ('Administration'),('Administration + Recrutement'),('Recrutement');
/*!40000 ALTER TABLE `permissions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `questionnaires`
--

DROP TABLE IF EXISTS `questionnaires`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `questionnaires` (
  `ID_Questionnaire` smallint(6) NOT NULL AUTO_INCREMENT,
  `label` varchar(128) NOT NULL,
  `liste_questions` text NOT NULL,
  `temps_imparti` smallint(6) DEFAULT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `visible` tinyint(1) NOT NULL DEFAULT '1',
  `as_deleted` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`ID_Questionnaire`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `questionnaires`
--

LOCK TABLES `questionnaires` WRITE;
/*!40000 ALTER TABLE `questionnaires` DISABLE KEYS */;
INSERT INTO `questionnaires` VALUES (1,'Questionnaire 1','1,2,3',0,'2014-05-19 14:24:17',0,0),(2,'Questionnaire 2','1,2,3',1,'2014-05-22 09:43:43',0,0),(3,'Questionnaire 3','1,2,3',15,'2014-05-22 09:43:42',0,0),(4,'Questionnaire inversé','3,2,1',3,'2014-05-22 09:43:45',0,0),(5,'Q. Zéro','23,22,26,24,26,10,7,6,5,15,13,14,17,18,19,9,8,20,12,4',15,'2014-06-16 13:19:06',1,0),(6,'Questionnaireeee','27',1,'2014-05-22 09:43:40',0,0),(7,'Test','24,10,13,14,19,8,25,26,21,20',5,'2014-06-10 06:27:46',1,0);
/*!40000 ALTER TABLE `questionnaires` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `questions`
--

DROP TABLE IF EXISTS `questions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `questions` (
  `id_categorie` smallint(6) NOT NULL,
  `ID_Question` smallint(6) NOT NULL AUTO_INCREMENT,
  `question` tinytext NOT NULL,
  `rep_1` tinytext NOT NULL,
  `rep_2` tinytext NOT NULL,
  `rep_3` tinytext NOT NULL,
  `rep_4` tinytext NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `visible` tinyint(1) NOT NULL DEFAULT '1',
  `as_deleted` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`ID_Question`),
  KEY `id_sousdomaine` (`id_categorie`),
  CONSTRAINT `questions_ibfk_1` FOREIGN KEY (`id_categorie`) REFERENCES `categories` (`ID_Categorie`)
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `questions`
--

LOCK TABLES `questions` WRITE;
/*!40000 ALTER TABLE `questions` DISABLE KEYS */;
INSERT INTO `questions` VALUES (1,1,'Question 1','Réponse 1','Réponse 2','Réponse 3','Réponse 4','2014-05-21 10:16:35',0,0),(1,2,'Question 2','Réponse 1','Réponse 2','Réponse 3','Réponse 4','2014-05-21 10:16:37',0,0),(1,3,'Question 3','Réponse 1','Réponse 2','Réponse 3','Réponse 4','2014-05-21 10:16:53',0,0),(4,4,'Qu\'est-ce qu\'un système d\'exploitation ? ','Un logiciel de pilotage qui s\'exécute lors de la mise en route de l\'ordinateur.  ','Un logiciel de traitement de texte.','Un système de gestion de base de données.  ','Un logiciel de pilotage d\'une imprimante.','2014-05-21 10:16:20',1,0),(4,5,'Le système MS-DOS fut le premier utilisé sur le micro-ordinateur compatible PC. Peut-on utiliser la souris pour passer une commande MS-DOS ?','Non','Oui','Le clavier','Il n\'existe que lui','2014-05-21 10:20:38',1,0),(4,6,'Le hardware désigne la partie matérielle d\'un ordinateur. Que désigne le mot anglais software ?','Logiciel','Microprocesseur','Malware','Progiciel','2014-05-21 10:22:28',1,0),(4,7,'Dans une liste de fichiers, à quoi reconnaît-on un programme ?','Le nom du fichier a une extension exe.','Le nom du fichier est précédé des lettres PROG.','Le nom du fichier est en majuscule. ','Le nom du fichier a une extension sys.','2014-05-21 10:24:25',1,0),(2,8,'Dans un environnement graphique (par exemple Windows) les applications sont représentées par des icônes (petites images). Que doit-on faire à l\'icône pour lancer l\'application ?','Cliquer deux fois sur l\'icône. ','En cliquant sur le bouton.','En appuyant sur le bouton droit de la souris.','Appuyer sur l\'écran. ','2014-05-21 10:26:20',1,0),(3,9,'Word est un logiciel comportant une partie traitement de texte. Quelle est la commande qui permet d\'obtenir un texte droit des deux côtés ?','Menu Format puis Justifier. ','Clic sur le bouton Impression.','Menu Format puis Aligner le texte à gauche.','Menu Fichier puis Ouvrir.  ','2014-05-21 10:28:19',1,0),(4,10,'Dans un logiciel, comment peut-on faire pour obtenir la solution à un problème rencontré ?\r\n','En cliquant sur le menu Aide puis sur Index et Recherche par mots clés.  ','En appuyant sur la touche F2.','En parcourant tous les menus et en essayant une commande qui parait convenir.','En appuyant sur la touche F4.','2014-05-21 10:32:49',1,0),(4,11,'Que doit-on faire avant d\'éteindre un ordinateur ?','Enregistrer le travail effectué dans un fichier puis Quitter le logiciel (Fichier Quitter). ','Appuyer conjointement sur les touches Ctrl, Alt et Suppr. ','Quitter le logiciel (Fichier Quitter) et cliquer sur le bouton \'NON\' à la question \'Le fichier a été modifié, voulez-vous l\'enregistrer ?\'. ','Ne rien faire.','2014-05-21 10:35:44',1,0),(2,12,'Qu\'est-ce que le bureau Windows ?','C\'est la zone d?écran principale qui s?affiche une fois que vous avez allumé l?ordinateur.','C\'est la table qui se trouve devant l\'utilisateur.','C\'est un accessoire qui sert à trier un fichier.','C\'est un programme informatique qui permet de réaliser une action spécifique sur l\'ordinateur.','2014-05-21 10:43:39',1,0),(7,13,'Qu\'est-ce qu\'un modem ?','C\'est un périphérique servant à communiquer avec des utilisateurs distants par l\'intermédiaire d\'un réseau analogique.','Un modem est un compteur qui permet de relever le temps de communication.','Un modem est un boîtier qui remplace la ligne de téléphone.','C\'est un MOuvement DE Mécanique.','2014-05-21 10:46:41',1,0),(8,14,'Qu\'est-ce qu\'un driver ?','C\'est un programme qui sert d\'intermédiaire entre un logiciel et un matériel.','C\'est un conducteur électrique.','C\'est un pilote de techniciens sur site.','C\'est un programme qui permet de dessiner.','2014-05-21 11:03:57',1,0),(4,15,'Où est né le World Wide Web ?','Aux Etats-Unis.','En Angleterre.','En Suisse.','En France.','2014-05-21 11:05:22',1,0),(4,16,'Qu\'est-ce que précise la licence d\'un logiciel ou d\'un fichier de données ?','Son droit d\'utilisation.','Son droit de modification.','Son droit de copie.','Son droit de vente.','2014-05-21 11:07:50',1,0),(8,17,'Quelle est la signification de l\'acronyme RAM ?','Random Access Memory.','Really-fast Access Memory.','Read And Modify. ','Read All Memory.','2014-05-21 11:09:18',1,0),(8,18,'Quelle est la signification de l\'acronyme USB ?','Universal Serial Bus.','Unity Serial Bombardier.','Union des Systèmes Baroques.','University of System Basic.','2014-05-21 11:11:29',1,0),(3,19,'Quelle est l\'action associée à la combinaison des touches : Ctrl + C ?','Copier la sélection dans le presse-papiers.','Coller le contenu du presse-papier dans la fenêtre active.','Sélectionner la totalité du contenu de la fenêtre active.','Annuler la dernière action.','2014-05-21 11:13:45',1,0),(2,20,'Le gestionnaire de fichiers Windows permet de :','Accéder à tous les supports de stockage directement accessibles à l\'ordinateur. ','Gérer mes comptes.','Modifier les icônes du bureau. ','Gérer les tâches en cours. ','2014-05-21 11:15:19',1,0),(5,21,'Quelle est la date de création d\'E-Os ?','12/09/2013','13/11/1989','01/1/98','20/07/1969','2014-05-21 11:18:59',1,0),(5,22,'Combien de collaborateurs sommes-nous ?','8200','3400','2600','4500','2014-05-21 11:21:55',1,0),(6,23,'E-OS est directement implanté dans combien de pays ?','10','2','5','6','2014-05-21 11:23:01',1,0),(6,24,'Que signifie BU ?','Business Unit.','Bien Unitaire.','Bien Utilisé.','Business University.','2014-05-21 11:24:40',1,0),(6,25,'Que signifie DRH ?','Directeur des Ressources Humaines.','Dormir au Random Hotel.','Direction de la Remise de l\'Humanité.','Droit de Recevoir l\'Hôte.','2014-05-21 11:26:16',1,0),(6,26,'Que signifie ITIL ?','Information Technology Infrastructure Library.','Information Totalement Intelligente et Libre.','Interne Technicité Information Locale.','Imagination Totalement Interne et Locale.','2014-05-21 11:29:13',1,0),(9,27,'Pourquoi y a-t\'il autant de problèmes là où il ne devrait pas y en avoir, ni sur un navigateur, ni sur un autre navigateur ?','Parce qu\'il n\'y en a pas','faux1','faux2','faux3','2014-05-27 10:41:01',0,0);
/*!40000 ALTER TABLE `questions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `utilisateurs`
--

DROP TABLE IF EXISTS `utilisateurs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `utilisateurs` (
  `ID_Utilisateur` smallint(6) NOT NULL AUTO_INCREMENT,
  `identifiant` varchar(30) NOT NULL,
  `mdp` varchar(16) NOT NULL DEFAULT '12345',
  `email` varchar(128) NOT NULL,
  `nom` varchar(128) NOT NULL,
  `prenom` varchar(128) NOT NULL,
  `permission` varchar(50) NOT NULL DEFAULT 'Recrutement',
  PRIMARY KEY (`ID_Utilisateur`),
  UNIQUE KEY `email` (`email`,`identifiant`),
  KEY `level` (`permission`),
  KEY `pseudo` (`identifiant`),
  CONSTRAINT `utilisateurs_ibfk_1` FOREIGN KEY (`permission`) REFERENCES `permissions` (`Permission`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `utilisateurs`
--

LOCK TABLES `utilisateurs` WRITE;
/*!40000 ALTER TABLE `utilisateurs` DISABLE KEYS */;
INSERT INTO `utilisateurs` VALUES (1,'Sylkun','813nv3nu3','sylkun@hotmail.fr','Berger','Sylvain','Administration + Recrutement'),(2,'admin','4dm1n','admin@admin.admin','Admin','Admin','Administration');
/*!40000 ALTER TABLE `utilisateurs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Temporary table structure for view `v_dcq`
--

DROP TABLE IF EXISTS `v_dcq`;
/*!50001 DROP VIEW IF EXISTS `v_dcq`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE TABLE `v_dcq` (
  `ID_Domaine` tinyint NOT NULL,
  `domaine` tinyint NOT NULL,
  `visible_domaine` tinyint NOT NULL,
  `ID_Categorie` tinyint NOT NULL,
  `categorie` tinyint NOT NULL,
  `visible_categorie` tinyint NOT NULL,
  `ID_Question` tinyint NOT NULL,
  `question` tinyint NOT NULL,
  `visible_question` tinyint NOT NULL
) ENGINE=MyISAM */;
SET character_set_client = @saved_cs_client;

--
-- Temporary table structure for view `v_dom_cat`
--

DROP TABLE IF EXISTS `v_dom_cat`;
/*!50001 DROP VIEW IF EXISTS `v_dom_cat`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE TABLE `v_dom_cat` (
  `ID_Domaine` tinyint NOT NULL,
  `label_domaine` tinyint NOT NULL,
  `ID_Categorie` tinyint NOT NULL,
  `label_categorie` tinyint NOT NULL,
  `date` tinyint NOT NULL,
  `visible` tinyint NOT NULL,
  `as_deleted` tinyint NOT NULL
) ENGINE=MyISAM */;
SET character_set_client = @saved_cs_client;

--
-- Temporary table structure for view `v_dom_cat_quest`
--

DROP TABLE IF EXISTS `v_dom_cat_quest`;
/*!50001 DROP VIEW IF EXISTS `v_dom_cat_quest`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE TABLE `v_dom_cat_quest` (
  `ID_Domaine` tinyint NOT NULL,
  `label_domaine` tinyint NOT NULL,
  `ID_Categorie` tinyint NOT NULL,
  `label_categorie` tinyint NOT NULL,
  `ID_Question` tinyint NOT NULL,
  `question` tinyint NOT NULL,
  `rep_1` tinyint NOT NULL,
  `rep_2` tinyint NOT NULL,
  `rep_3` tinyint NOT NULL,
  `rep_4` tinyint NOT NULL,
  `date` tinyint NOT NULL,
  `visible` tinyint NOT NULL,
  `as_deleted` tinyint NOT NULL
) ENGINE=MyISAM */;
SET character_set_client = @saved_cs_client;

--
-- Temporary table structure for view `v_scores`
--

DROP TABLE IF EXISTS `v_scores`;
/*!50001 DROP VIEW IF EXISTS `v_scores`*/;
SET @saved_cs_client     = @@character_set_client;
SET character_set_client = utf8;
/*!50001 CREATE TABLE `v_scores` (
  `ID_Candidat` tinyint NOT NULL,
  `nom` tinyint NOT NULL,
  `prenom` tinyint NOT NULL,
  `score` tinyint NOT NULL,
  `temps` tinyint NOT NULL,
  `id_questionnaire` tinyint NOT NULL,
  `questions_posees` tinyint NOT NULL,
  `reponses_donnees` tinyint NOT NULL,
  `date` tinyint NOT NULL,
  `visible` tinyint NOT NULL,
  `responsable` tinyint NOT NULL,
  `label` tinyint NOT NULL,
  `temps_imparti` tinyint NOT NULL,
  `q_visible` tinyint NOT NULL
) ENGINE=MyISAM */;
SET character_set_client = @saved_cs_client;

--
-- Dumping events for database 'recrutor'
--

--
-- Dumping routines for database 'recrutor'
--

--
-- Final view structure for view `v_dcq`
--

/*!50001 DROP TABLE IF EXISTS `v_dcq`*/;
/*!50001 DROP VIEW IF EXISTS `v_dcq`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8 */;
/*!50001 SET character_set_results     = utf8 */;
/*!50001 SET collation_connection      = utf8_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `v_dcq` AS select `d`.`ID_Domaine` AS `ID_Domaine`,`d`.`label` AS `domaine`,`d`.`visible` AS `visible_domaine`,`c`.`ID_Categorie` AS `ID_Categorie`,`c`.`label` AS `categorie`,`c`.`visible` AS `visible_categorie`,`q`.`ID_Question` AS `ID_Question`,`q`.`question` AS `question`,`q`.`visible` AS `visible_question` from (`questions` `q` left join (`domaines` `d` left join `categories` `c` on((`d`.`ID_Domaine` = `c`.`id_domaine`))) on((`c`.`ID_Categorie` = `q`.`id_categorie`))) order by `d`.`label`,`d`.`ID_Domaine`,`c`.`label`,`c`.`ID_Categorie`,`q`.`question`,`q`.`ID_Question` */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `v_dom_cat`
--

/*!50001 DROP TABLE IF EXISTS `v_dom_cat`*/;
/*!50001 DROP VIEW IF EXISTS `v_dom_cat`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8 */;
/*!50001 SET character_set_results     = utf8 */;
/*!50001 SET collation_connection      = utf8_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `v_dom_cat` AS select `d`.`ID_Domaine` AS `ID_Domaine`,`d`.`label` AS `label_domaine`,`c`.`ID_Categorie` AS `ID_Categorie`,`c`.`label` AS `label_categorie`,`c`.`date` AS `date`,`c`.`visible` AS `visible`,`c`.`as_deleted` AS `as_deleted` from (`domaines` `d` left join `categories` `c` on((`d`.`ID_Domaine` = `c`.`id_domaine`))) order by `d`.`label`,`d`.`ID_Domaine`,`c`.`label`,`c`.`ID_Categorie` */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `v_dom_cat_quest`
--

/*!50001 DROP TABLE IF EXISTS `v_dom_cat_quest`*/;
/*!50001 DROP VIEW IF EXISTS `v_dom_cat_quest`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8 */;
/*!50001 SET character_set_results     = utf8 */;
/*!50001 SET collation_connection      = utf8_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `v_dom_cat_quest` AS select `v`.`ID_Domaine` AS `ID_Domaine`,`v`.`label_domaine` AS `label_domaine`,`v`.`ID_Categorie` AS `ID_Categorie`,`v`.`label_categorie` AS `label_categorie`,`q`.`ID_Question` AS `ID_Question`,`q`.`question` AS `question`,`q`.`rep_1` AS `rep_1`,`q`.`rep_2` AS `rep_2`,`q`.`rep_3` AS `rep_3`,`q`.`rep_4` AS `rep_4`,`q`.`date` AS `date`,`q`.`visible` AS `visible`,`q`.`as_deleted` AS `as_deleted` from (`v_dom_cat` `v` left join `questions` `q` on((`v`.`ID_Categorie` = `q`.`id_categorie`))) order by `v`.`label_domaine`,`v`.`ID_Domaine`,`v`.`label_categorie`,`v`.`ID_Categorie`,`q`.`question`,`q`.`ID_Question` */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;

--
-- Final view structure for view `v_scores`
--

/*!50001 DROP TABLE IF EXISTS `v_scores`*/;
/*!50001 DROP VIEW IF EXISTS `v_scores`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = latin1 */;
/*!50001 SET character_set_results     = latin1 */;
/*!50001 SET collation_connection      = latin1_swedish_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `v_scores` AS select `c`.`ID_Candidat` AS `ID_Candidat`,`c`.`nom` AS `nom`,`c`.`prenom` AS `prenom`,`c`.`score` AS `score`,`c`.`temps` AS `temps`,`c`.`id_questionnaire` AS `id_questionnaire`,`c`.`questions_posees` AS `questions_posees`,`c`.`reponses_donnees` AS `reponses_donnees`,`c`.`date` AS `date`,`c`.`visible` AS `visible`,`c`.`responsable` AS `responsable`,`q`.`label` AS `label`,`q`.`temps_imparti` AS `temps_imparti`,`q`.`visible` AS `q_visible` from (`candidats` `c` left join `questionnaires` `q` on((`c`.`id_questionnaire` = `q`.`ID_Questionnaire`))) */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2014-07-19 18:34:36
