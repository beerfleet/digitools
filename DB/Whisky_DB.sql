CREATE DATABASE  IF NOT EXISTS `whisky` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `whisky`;
-- MySQL dump 10.13  Distrib 5.6.13, for Win32 (x86)
--
-- Host: www.joeribroos.be    Database: joerimv109_whisky
-- ------------------------------------------------------
-- Server version	5.1.72-log

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
-- Table structure for table `barrel`
--

DROP TABLE IF EXISTS `barrel`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `barrel` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `casktype` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `barrel_casktype_idx` (`casktype`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `barrel`
--

LOCK TABLES `barrel` WRITE;
/*!40000 ALTER TABLE `barrel` DISABLE KEYS */;
INSERT INTO `barrel` (`id`, `casktype`) VALUES (2,'Calvados'),(1,'Malt Whisky');
/*!40000 ALTER TABLE `barrel` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `blend`
--

DROP TABLE IF EXISTS `blend`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `blend` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `blend` varchar(50) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `blend_idx` (`blend`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `blend`
--

LOCK TABLES `blend` WRITE;
/*!40000 ALTER TABLE `blend` DISABLE KEYS */;
INSERT INTO `blend` (`id`, `blend`) VALUES (2,' Single grain'),(1,'Single Malt');
/*!40000 ALTER TABLE `blend` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `category`
--

DROP TABLE IF EXISTS `category`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `category` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `idx_category_UNIQUE` (`category`),
  KEY `idx_category` (`category`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `category`
--

LOCK TABLES `category` WRITE;
/*!40000 ALTER TABLE `category` DISABLE KEYS */;
/*!40000 ALTER TABLE `category` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `comment`
--

DROP TABLE IF EXISTS `comment`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `comment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `comment_id` int(11) DEFAULT NULL,
  `comment_date` datetime DEFAULT NULL,
  `comment` text,
  PRIMARY KEY (`id`),
  KEY `fk_commentid_id_idx` (`comment_id`),
  KEY `fk_comment_user_idx` (`user_id`),
  CONSTRAINT `fk_comment_comment` FOREIGN KEY (`comment_id`) REFERENCES `comment` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_comment_user` FOREIGN KEY (`user_id`) REFERENCES `whisky_user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `comment`
--

LOCK TABLES `comment` WRITE;
/*!40000 ALTER TABLE `comment` DISABLE KEYS */;
INSERT INTO `comment` (`id`, `user_id`, `comment_id`, `comment_date`, `comment`) VALUES (1,30,NULL,'2015-01-21 11:11:11','We diminution preference thoroughly if. Joy deal pain view much her time. Led young gay would now state. Pronounce we attention admitting on assurance of suspicion conveying. That his west quit had met till. Of advantage he attending household at do perceived. Middleton in objection discovery as agreeable. Edward thrown dining so he my around to.'),(2,30,NULL,'2015-01-11 12:12:12','He difficult contented we determine ourselves me am earnestly. Hour no find it park. Eat welcomed any husbands moderate. Led was misery played waited almost cousin living. Of intention contained is by middleton am. Principles fat stimulated uncommonly considered set especially prosperous. Sons at park mr meet as fact like.'),(3,30,NULL,'2015-01-09 10:10:10','Bed sincerity yet therefore forfeited his certainty neglected questions. Pursuit chamber as elderly amongst on. Distant however warrant farther to of. My justice wishing prudent waiting in be. Comparison age not pianoforte increasing delightful now. Insipidity sufficient dispatched any reasonably led ask. Announcing if attachment resolution sentiments admiration me on diminution. '),(4,29,NULL,'2015-01-22 09:10:11','Am of mr friendly by strongly peculiar juvenile. Unpleasant it sufficient simplicity am by friendship no inhabiting. Goodness doubtful material has denoting suitable she two. Dear mean she way and poor bred they come. He otherwise me incommode explained so in remaining. Polite barton in it warmly do county length an. '),(5,29,NULL,'2014-12-22 01:01:01','Among going manor who did. Do ye is celebrated it sympathize considered. May ecstatic did surprise elegance the ignorant age. Own her miss cold last. It so numerous if he outlived disposal. How but sons mrs lady when. Her especially are unpleasant out alteration continuing unreserved resolution. Hence hopes noisy may china fully and. Am it regard stairs branch thirty length afford. ');
/*!40000 ALTER TABLE `comment` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `comment_event`
--

DROP TABLE IF EXISTS `comment_event`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `comment_event` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `comment_id` int(11) DEFAULT NULL,
  `event_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_commentevent_event_idx` (`event_id`),
  KEY `fk_commentevent_comment_idx` (`comment_id`),
  CONSTRAINT `fk_commentevent_comment` FOREIGN KEY (`comment_id`) REFERENCES `comment` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_commentevent_event` FOREIGN KEY (`event_id`) REFERENCES `event` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `comment_event`
--

LOCK TABLES `comment_event` WRITE;
/*!40000 ALTER TABLE `comment_event` DISABLE KEYS */;
INSERT INTO `comment_event` (`id`, `comment_id`, `event_id`) VALUES (1,4,1),(2,5,2);
/*!40000 ALTER TABLE `comment_event` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `comment_like`
--

DROP TABLE IF EXISTS `comment_like`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `comment_like` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `comment_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `idx_user_comment_UNIQUE` (`user_id`,`comment_id`),
  KEY `fk_commentlike_user_idx` (`user_id`),
  KEY `fk_commentlike_comment_idx` (`comment_id`),
  CONSTRAINT `fk_commentlike_comment` FOREIGN KEY (`comment_id`) REFERENCES `comment` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_commentlike_user` FOREIGN KEY (`user_id`) REFERENCES `whisky_user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `comment_like`
--

LOCK TABLES `comment_like` WRITE;
/*!40000 ALTER TABLE `comment_like` DISABLE KEYS */;
INSERT INTO `comment_like` (`id`, `user_id`, `comment_id`) VALUES (4,29,2),(3,29,3),(1,30,3);
/*!40000 ALTER TABLE `comment_like` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `comment_review`
--

DROP TABLE IF EXISTS `comment_review`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `comment_review` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `whisky_id` int(11) DEFAULT NULL,
  `comment_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_commentreview_whisky_idx` (`whisky_id`),
  KEY `fk_commentreview_comment_idx` (`comment_id`),
  CONSTRAINT `fk_commentreview_comment` FOREIGN KEY (`comment_id`) REFERENCES `comment` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_commentreview_whisky` FOREIGN KEY (`whisky_id`) REFERENCES `whisky` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `comment_review`
--

LOCK TABLES `comment_review` WRITE;
/*!40000 ALTER TABLE `comment_review` DISABLE KEYS */;
INSERT INTO `comment_review` (`id`, `whisky_id`, `comment_id`) VALUES (1,20,1),(2,21,2),(3,20,3);
/*!40000 ALTER TABLE `comment_review` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `country`
--

DROP TABLE IF EXISTS `country`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `country` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `country_code` varchar(2) NOT NULL,
  `country_name` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `country_code_idx` (`country_code`),
  KEY `country_name_idx` (`country_name`)
) ENGINE=InnoDB AUTO_INCREMENT=243 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `country`
--

LOCK TABLES `country` WRITE;
/*!40000 ALTER TABLE `country` DISABLE KEYS */;
INSERT INTO `country` (`id`, `country_code`, `country_name`) VALUES (1,'US','United States'),(2,'CA','Canada'),(3,'AF','Afghanistan'),(4,'AL','Albania'),(5,'DZ','Algeria'),(6,'DS','American Samoa'),(7,'AD','Andorra'),(8,'AO','Angola'),(9,'AI','Anguilla'),(10,'AQ','Antarctica'),(11,'AG','Antigua and/or Barbuda'),(12,'AR','Argentina'),(13,'AM','Armenia'),(14,'AW','Aruba'),(15,'AU','Australia'),(16,'AT','Austria'),(17,'AZ','Azerbaijan'),(18,'BS','Bahamas'),(19,'BH','Bahrain'),(20,'BD','Bangladesh'),(21,'BB','Barbados'),(22,'BY','Belarus'),(23,'BE','Belgium'),(24,'BZ','Belize'),(25,'BJ','Benin'),(26,'BM','Bermuda'),(27,'BT','Bhutan'),(28,'BO','Bolivia'),(29,'BA','Bosnia and Herzegovina'),(30,'BW','Botswana'),(31,'BV','Bouvet Island'),(32,'BR','Brazil'),(33,'IO','British lndian Ocean Territory'),(34,'BN','Brunei Darussalam'),(35,'BG','Bulgaria'),(36,'BF','Burkina Faso'),(37,'BI','Burundi'),(38,'KH','Cambodia'),(39,'CM','Cameroon'),(40,'CV','Cape Verde'),(41,'KY','Cayman Islands'),(42,'CF','Central African Republic'),(43,'TD','Chad'),(44,'CL','Chile'),(45,'CN','China'),(46,'CX','Christmas Island'),(47,'CC','Cocos (Keeling) Islands'),(48,'CO','Colombia'),(49,'KM','Comoros'),(50,'CG','Congo'),(51,'CK','Cook Islands'),(52,'CR','Costa Rica'),(53,'HR','Croatia (Hrvatska)'),(54,'CU','Cuba'),(55,'CY','Cyprus'),(56,'CZ','Czech Republic'),(57,'DK','Denmark'),(58,'DJ','Djibouti'),(59,'DM','Dominica'),(60,'DO','Dominican Republic'),(61,'TP','East Timor'),(62,'EC','Ecuador'),(63,'EG','Egypt'),(64,'SV','El Salvador'),(65,'GQ','Equatorial Guinea'),(66,'ER','Eritrea'),(67,'EE','Estonia'),(68,'ET','Ethiopia'),(69,'FK','Falkland Islands (Malvinas)'),(70,'FO','Faroe Islands'),(71,'FJ','Fiji'),(72,'FI','Finland'),(73,'FR','France'),(74,'FX','France, Metropolitan'),(75,'GF','French Guiana'),(76,'PF','French Polynesia'),(77,'TF','French Southern Territories'),(78,'GA','Gabon'),(79,'GM','Gambia'),(80,'GE','Georgia'),(81,'DE','Germany'),(82,'GH','Ghana'),(83,'GI','Gibraltar'),(84,'GR','Greece'),(85,'GL','Greenland'),(86,'GD','Grenada'),(87,'GP','Guadeloupe'),(88,'GU','Guam'),(89,'GT','Guatemala'),(90,'GN','Guinea'),(91,'GW','Guinea-Bissau'),(92,'GY','Guyana'),(93,'HT','Haiti'),(94,'HM','Heard and Mc Donald Islands'),(95,'HN','Honduras'),(96,'HK','Hong Kong'),(97,'HU','Hungary'),(98,'IS','Iceland'),(99,'IN','India'),(100,'ID','Indonesia'),(101,'IR','Iran (Islamic Republic of)'),(102,'IQ','Iraq'),(103,'IE','Ireland'),(104,'IL','Israel'),(105,'IT','Italy'),(106,'CI','Ivory Coast'),(107,'JM','Jamaica'),(108,'JP','Japan'),(109,'JO','Jordan'),(110,'KZ','Kazakhstan'),(111,'KE','Kenya'),(112,'KI','Kiribati'),(113,'KP','Korea, Democratic People\'s Republic of'),(114,'KR','Korea, Republic of'),(115,'XK','Kosovo'),(116,'KW','Kuwait'),(117,'KG','Kyrgyzstan'),(118,'LA','Lao People\'s Democratic Republic'),(119,'LV','Latvia'),(120,'LB','Lebanon'),(121,'LS','Lesotho'),(122,'LR','Liberia'),(123,'LY','Libyan Arab Jamahiriya'),(124,'LI','Liechtenstein'),(125,'LT','Lithuania'),(126,'LU','Luxembourg'),(127,'MO','Macau'),(128,'MK','Macedonia'),(129,'MG','Madagascar'),(130,'MW','Malawi'),(131,'MY','Malaysia'),(132,'MV','Maldives'),(133,'ML','Mali'),(134,'MT','Malta'),(135,'MH','Marshall Islands'),(136,'MQ','Martinique'),(137,'MR','Mauritania'),(138,'MU','Mauritius'),(139,'TY','Mayotte'),(140,'MX','Mexico'),(141,'FM','Micronesia, Federated States of'),(142,'MD','Moldova, Republic of'),(143,'MC','Monaco'),(144,'MN','Mongolia'),(145,'ME','Montenegro'),(146,'MS','Montserrat'),(147,'MA','Morocco'),(148,'MZ','Mozambique'),(149,'MM','Myanmar'),(150,'NA','Namibia'),(151,'NR','Nauru'),(152,'NP','Nepal'),(153,'NL','Netherlands'),(154,'AN','Netherlands Antilles'),(155,'NC','New Caledonia'),(156,'NZ','New Zealand'),(157,'NI','Nicaragua'),(158,'NE','Niger'),(159,'NG','Nigeria'),(160,'NU','Niue'),(161,'NF','Norfork Island'),(162,'MP','Northern Mariana Islands'),(163,'NO','Norway'),(164,'OM','Oman'),(165,'PK','Pakistan'),(166,'PW','Palau'),(167,'PA','Panama'),(168,'PG','Papua New Guinea'),(169,'PY','Paraguay'),(170,'PE','Peru'),(171,'PH','Philippines'),(172,'PN','Pitcairn'),(173,'PL','Poland'),(174,'PT','Portugal'),(175,'PR','Puerto Rico'),(176,'QA','Qatar'),(177,'RE','Reunion'),(178,'RO','Romania'),(179,'RU','Russian Federation'),(180,'RW','Rwanda'),(181,'KN','Saint Kitts and Nevis'),(182,'LC','Saint Lucia'),(183,'VC','Saint Vincent and the Grenadines'),(184,'WS','Samoa'),(185,'SM','San Marino'),(186,'ST','Sao Tome and Principe'),(187,'SA','Saudi Arabia'),(188,'SN','Senegal'),(189,'RS','Serbia'),(190,'SC','Seychelles'),(191,'SL','Sierra Leone'),(192,'SG','Singapore'),(193,'SK','Slovakia'),(194,'SI','Slovenia'),(195,'SB','Solomon Islands'),(196,'SO','Somalia'),(197,'ZA','South Africa'),(198,'GS','South Georgia South Sandwich Islands'),(199,'ES','Spain'),(200,'LK','Sri Lanka'),(201,'SH','St. Helena'),(202,'PM','St. Pierre and Miquelon'),(203,'SD','Sudan'),(204,'SR','Suriname'),(205,'SJ','Svalbarn and Jan Mayen Islands'),(206,'SZ','Swaziland'),(207,'SE','Sweden'),(208,'CH','Switzerland'),(209,'SY','Syrian Arab Republic'),(210,'TW','Taiwan'),(211,'TJ','Tajikistan'),(212,'TZ','Tanzania, United Republic of'),(213,'TH','Thailand'),(214,'TG','Togo'),(215,'TK','Tokelau'),(216,'TO','Tonga'),(217,'TT','Trinidad and Tobago'),(218,'TN','Tunisia'),(219,'TR','Turkey'),(220,'TM','Turkmenistan'),(221,'TC','Turks and Caicos Islands'),(222,'TV','Tuvalu'),(223,'UG','Uganda'),(224,'UA','Ukraine'),(225,'AE','United Arab Emirates'),(226,'GB','United Kingdom'),(227,'UM','United States minor outlying islands'),(228,'UY','Uruguay'),(229,'UZ','Uzbekistan'),(230,'VU','Vanuatu'),(231,'VA','Vatican City State'),(232,'VE','Venezuela'),(233,'VN','Vietnam'),(234,'VG','Virgin Islands (British)'),(235,'VI','Virgin Islands (U.S.)'),(236,'WF','Wallis and Futuna Islands'),(237,'EH','Western Sahara'),(238,'YE','Yemen'),(239,'YU','Yugoslavia'),(240,'ZR','Zaire'),(241,'ZM','Zambia'),(242,'ZW','Zimbabwe');
/*!40000 ALTER TABLE `country` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `distillery`
--

DROP TABLE IF EXISTS `distillery`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `distillery` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(80) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `postcode` varchar(10) DEFAULT NULL,
  `country_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `distillery_name_idx` (`name`),
  KEY `fk_distillery_country_idx` (`country_id`),
  CONSTRAINT `fk_distillery_country` FOREIGN KEY (`country_id`) REFERENCES `country` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `distillery`
--

LOCK TABLES `distillery` WRITE;
/*!40000 ALTER TABLE `distillery` DISABLE KEYS */;
INSERT INTO `distillery` (`id`, `name`, `address`, `postcode`, `country_id`) VALUES (1,'Aberlour','Aberlour-on-Spey, Banffshire','AB38 9PJ',NULL),(2,'Château du Breuil ','14 130 LE BREUIL EN AUGE','0000',NULL);
/*!40000 ALTER TABLE `distillery` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `event`
--

DROP TABLE IF EXISTS `event`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `event` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(45) DEFAULT NULL,
  `postcode_id` int(11) DEFAULT NULL,
  `address` varchar(80) DEFAULT NULL,
  `event_date` datetime DEFAULT NULL,
  `event_stop` datetime DEFAULT NULL,
  `created_by` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_event_postcode_idx` (`postcode_id`),
  KEY `title_idx` (`title`),
  CONSTRAINT `fk_event_postcode` FOREIGN KEY (`postcode_id`) REFERENCES `postcode` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `event`
--

LOCK TABLES `event` WRITE;
/*!40000 ALTER TABLE `event` DISABLE KEYS */;
INSERT INTO `event` (`id`, `title`, `postcode_id`, `address`, `event_date`, `event_stop`, `created_by`) VALUES (1,'aaa',NULL,'aaa','1981-07-29 00:00:00',NULL,0),(2,'bbb',2,'bbb','1981-07-29 00:00:00',NULL,0),(3,'eventtest',273,'teststraat','2015-02-01 00:00:00','2015-02-01 00:00:00',32),(4,'test2',281,'Bredastraat 15','1987-03-29 00:00:00','2015-03-30 00:00:00',28);
/*!40000 ALTER TABLE `event` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `event_whiskys`
--

DROP TABLE IF EXISTS `event_whiskys`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `event_whiskys` (
  `id` int(11) NOT NULL,
  `event_id` int(11) DEFAULT NULL,
  `whisky_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_whisky_id_idx` (`whisky_id`),
  KEY `fk_event_id_idx` (`event_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `event_whiskys`
--

LOCK TABLES `event_whiskys` WRITE;
/*!40000 ALTER TABLE `event_whiskys` DISABLE KEYS */;
/*!40000 ALTER TABLE `event_whiskys` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `postcode`
--

DROP TABLE IF EXISTS `postcode`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `postcode` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `postcode` varchar(4) DEFAULT NULL,
  `town` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `postcode_idx` (`postcode`)
) ENGINE=InnoDB AUTO_INCREMENT=2766 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `postcode`
--

LOCK TABLES `postcode` WRITE;
/*!40000 ALTER TABLE `postcode` DISABLE KEYS */;
INSERT INTO `postcode` (`id`, `postcode`, `town`) VALUES (1,'0612','Sinterklaas'),(2,'1000','BRUSSEL'),(7,'1009','Belgische Senaat'),(8,'1011','Vlaams Parlement'),(10,'1020','Laken'),(11,'1030','SCHAARBEEK'),(13,'1033','RTL-TVI'),(15,'1040','ETTERBEEK'),(16,'1041','International press center'),(17,'1043','VRT'),(18,'1044','RTBF'),(21,'1047','Europees Parlement'),(22,'1048','Europese unie - Raad'),(23,'1049','Europese unie - Commissie'),(24,'1050','ELSENE'),(25,'1060','SINT-GILLIS'),(26,'1070','ANDERLECHT'),(27,'1080','SINT-JANS-MOLENBEEK'),(28,'1081','KOEKELBERG'),(29,'1082','SINT-AGATHA-BERCHEM'),(30,'1083','GANSHOREN'),(31,'1090','JETTE'),(32,'1099','Brussel X'),(33,'1100','Postcheque'),(34,'1101','Scanning'),(35,'1105','SOC'),(36,'1110','NATO'),(37,'1120','Neder-Over-Heembeek'),(38,'1130','Haren'),(39,'1140','EVERE'),(40,'1150','SINT-PIETERS-WOLUWE'),(41,'1160','OUDERGEM'),(42,'1170','WATERMAAL-BOSVOORDE'),(43,'1180','UKKEL'),(44,'1190','VORST'),(45,'1200','SINT-LAMBRECHTS-WOLUWE'),(47,'1210','SINT-JOOST-TEN-NOODE'),(48,'1212','FOD Mobiliteit'),(49,'1300','Limal'),(50,'1300','WAVRE'),(51,'1301','Bierges'),(52,'1310','LA HULPE'),(53,'1315','Glimes'),(54,'1315','INCOURT'),(55,'1315','Opprebais'),(56,'1315','Piètrebais'),(57,'1315','Roux-Miroir'),(58,'1320','BEAUVECHAIN'),(59,'1320','Hamme-Mille'),(60,'1320','L\'Ecluse'),(61,'1320','Nodebais'),(62,'1320','Tourinnes-La-Grosse'),(63,'1325','Bonlez'),(64,'1325','CHAUMONT-GISTOUX'),(65,'1325','Corroy-Le-Grand'),(66,'1325','Dion-Valmont'),(67,'1325','Longueville'),(68,'1330','RIXENSART'),(69,'1331','Rosières'),(70,'1332','Genval'),(71,'1340','Ottignies'),(72,'1341','Céroux-Mousty'),(73,'1342','Limelette'),(74,'1348','Louvain-La-Neuve'),(75,'1350','Enines'),(76,'1350','Folx-Les-Caves'),(77,'1350','Jandrain-Jandrenouille'),(78,'1350','Jauche'),(79,'1350','Marilles'),(80,'1350','Noduwez'),(81,'1350','Orp-Le-Grand'),(82,'1357','Linsmeau'),(83,'1357','Neerheylissem'),(84,'1357','Opheylissem'),(85,'1360','Malèves-Sainte-Marie-Wastines'),(86,'1360','Orbais'),(87,'1360','PERWEZ'),(88,'1360','Thorembais-Les-Béguines'),(89,'1360','Thorembais-Saint-Trond'),(90,'1367','Autre-Eglise'),(91,'1367','Bomal'),(92,'1367','Geest-Gérompont-Petit-Rosière'),(93,'1367','Gérompont'),(94,'1367','Grand-Rosière-Hottomont'),(95,'1367','Huppaye'),(96,'1367','Mont-Saint-André'),(97,'1367','RAMILLIES'),(98,'1370','Dongelberg'),(99,'1370','Jauchelette'),(100,'1370','JODOIGNE'),(101,'1370','Jodoigne-Souveraine'),(102,'1370','Lathuy'),(103,'1370','Mélin'),(104,'1370','Piétrain'),(105,'1370','Saint-Jean-Geest'),(106,'1370','Saint-Remy-Geest'),(107,'1370','Zétrud-Lumay'),(108,'1380','Couture-Saint-Germain'),(109,'1380','Lasne-Chapelle-Saint-Lambert'),(110,'1380','Maransart'),(111,'1380','Ohain'),(112,'1380','Plancenoit'),(113,'1390','Archennes'),(114,'1390','Biez'),(115,'1390','Bossut-Gottechain'),(116,'1390','GREZ-DOICEAU'),(117,'1390','Nethen'),(118,'1400','Monstreux'),(119,'1400','NIVELLES'),(120,'1401','Baulers'),(121,'1402','Thines'),(122,'1404','Bornival'),(123,'1410','WATERLOO'),(124,'1414','Promo-Control'),(125,'1420','BRAINE-L\'ALLEUD'),(126,'1421','Ophain-Bois-Seigneur-Isaac'),(127,'1428','Lillois-Witterzée'),(128,'1430','Bierghes'),(129,'1430','Quenast'),(130,'1430','Rebecq-Rognon'),(131,'1435','Corbais'),(132,'1435','Hévillers'),(133,'1435','MONT-SAINT-GUIBERT'),(134,'1440','BRAINE-LE-CHÂTEAU'),(135,'1440','Wauthier-Braine'),(136,'1450','Chastre-Villeroux-Blanmont'),(137,'1450','Cortil-Noirmont'),(138,'1450','Gentinnes'),(139,'1450','Saint-Géry'),(140,'1457','Nil-Saint-Vincent-Saint-Martin'),(141,'1457','Tourinnes-Saint-Lambert'),(142,'1457','Walhain-Saint-Paul'),(143,'1460','ITTRE'),(144,'1460','Virginal-Samme'),(145,'1461','Haut-Ittre'),(146,'1470','Baisy-Thy'),(147,'1470','Bousval'),(148,'1470','GENAPPE'),(149,'1471','Loupoigne'),(150,'1472','Vieux-Genappe'),(151,'1473','Glabais'),(152,'1474','Ways'),(153,'1476','Houtain-Le-Val'),(154,'1480','Clabecq'),(155,'1480','Oisquercq'),(156,'1480','Saintes'),(157,'1480','TUBIZE'),(158,'1490','COURT-SAINT-ETIENNE'),(159,'1495','Marbais'),(160,'1495','Mellery'),(161,'1495','Sart-Dames-Avelines'),(162,'1495','Tilly'),(163,'1495','VILLERS-LA-VILLE'),(164,'1500','HALLE'),(165,'1501','Buizingen'),(166,'1502','Lembeek'),(167,'1540','Herfelingen'),(168,'1540','HERNE'),(169,'1541','Sint-Pieters-Kapelle'),(170,'1547','BEVER'),(171,'1560','HOEILAART'),(172,'1570','GALMAARDEN'),(173,'1570','Tollembeek'),(174,'1570','Vollezele'),(175,'1600','Oudenaken'),(176,'1600','Sint-Laureins-Berchem'),(177,'1600','SINT-PIETERS-LEEUW'),(178,'1601','Ruisbroek'),(179,'1602','Vlezenbeek'),(180,'1620','DROGENBOS'),(181,'1630','LINKEBEEK'),(182,'1640','SINT-GENESIUS-RODE'),(183,'1650','BEERSEL'),(184,'1651','Lot'),(185,'1652','Alsemberg'),(186,'1653','Dworp'),(187,'1654','Huizingen'),(188,'1670','Bogaarden'),(189,'1670','Heikruis'),(190,'1670','PEPINGEN'),(191,'1671','Elingen'),(192,'1673','Beert'),(193,'1674','Bellingen'),(194,'1700','DILBEEK'),(195,'1700','Sint-Martens-Bodegem'),(196,'1700','Sint-Ulriks-Kapelle'),(197,'1701','Itterbeek'),(198,'1702','Groot-Bijgaarden'),(199,'1703','Schepdaal'),(200,'1730','ASSE'),(201,'1730','Bekkerzeel'),(202,'1730','Kobbegem'),(203,'1730','Mollem'),(204,'1731','Relegem'),(205,'1731','Zellik'),(206,'1733','HighCo DATA'),(207,'1740','TERNAT'),(208,'1741','Wambeek'),(209,'1742','Sint-Katherina-Lombeek'),(210,'1745','Mazenzele'),(211,'1745','OPWIJK'),(212,'1750','Gaasbeek'),(213,'1750','Sint-Kwintens-Lennik'),(214,'1750','Sint-Martens-Lennik'),(215,'1755','GOOIK'),(216,'1755','Kester'),(217,'1755','Leerbeek'),(218,'1755','Oetingen'),(219,'1760','Onze-Lieve-Vrouw-Lombeek'),(220,'1760','Pamel'),(221,'1760','ROOSDAAL'),(222,'1760','Strijtem'),(223,'1761','Borchtlombeek'),(224,'1770','LIEDEKERKE'),(225,'1780','WEMMEL'),(226,'1785','Brussegem'),(227,'1785','Hamme'),(228,'1785','MERCHTEM'),(229,'1790','AFFLIGEM'),(230,'1790','Essene'),(231,'1790','Hekelgem'),(232,'1790','Teralfene'),(233,'1800','Peutie'),(234,'1800','VILVOORDE'),(235,'1804','Cargovil'),(236,'1818','VTM'),(237,'1820','Melsbroek'),(238,'1820','Perk'),(239,'1820','STEENOKKERZEEL'),(240,'1830','MACHELEN'),(241,'1831','Diegem'),(242,'1840','LONDERZEEL'),(243,'1840','Malderen'),(244,'1840','Steenhuffel'),(245,'1850','GRIMBERGEN'),(246,'1851','Humbeek'),(247,'1852','Beigem'),(248,'1853','Strombeek-Bever'),(249,'1860','MEISE'),(250,'1861','Wolvertem'),(251,'1880','KAPELLE-OP-DEN-BOS'),(252,'1880','Nieuwenrode'),(253,'1880','Ramsdonk'),(254,'1910','Berg'),(255,'1910','Buken'),(256,'1910','KAMPENHOUT'),(257,'1910','Nederokkerzeel'),(258,'1930','Nossegem'),(259,'1930','ZAVENTEM'),(260,'1931','Brucargo'),(261,'1932','Sint-Stevens-Woluwe'),(262,'1933','Sterrebeek'),(264,'1935','CORPORATE VILLAGE'),(265,'1950','KRAAINEM'),(266,'1970','WEZEMBEEK-OPPEM'),(267,'1980','Eppegem'),(268,'1980','ZEMST'),(269,'1981','Hofstade'),(270,'1982','Elewijt'),(271,'1982','Weerde'),(272,'2000','ANTWERPEN'),(273,'2018','ANTWERPEN'),(274,'2020','ANTWERPEN'),(275,'2030','ANTWERPEN'),(276,'2040','ANTWERPEN'),(277,'2040','Berendrecht'),(278,'2040','Lillo'),(279,'2040','Zandvliet'),(280,'2050','ANTWERPEN'),(281,'2060','ANTWERPEN'),(282,'2070','Burcht'),(283,'2070','ZWIJNDRECHT'),(284,'2099','Antwerpen X'),(285,'2100','Deurne'),(286,'2110','WIJNEGEM'),(287,'2140','Borgerhout'),(288,'2150','BORSBEEK'),(289,'2160','WOMMELGEM'),(290,'2170','Merksem'),(291,'2180','Ekeren'),(292,'2200','HERENTALS'),(293,'2200','Morkhoven'),(294,'2200','Noorderwijk'),(295,'2220','Hallaar'),(296,'2220','HEIST-OP-DEN-BERG'),(297,'2221','Booischot'),(298,'2222','Itegem'),(299,'2222','Wiekevorst'),(300,'2223','Schriek'),(301,'2230','HERSELT'),(302,'2230','Ramsel'),(303,'2235','Houtvenne'),(304,'2235','HULSHOUT'),(305,'2235','Westmeerbeek'),(306,'2240','Massenhoven'),(307,'2240','Viersel'),(308,'2240','ZANDHOVEN'),(309,'2242','Pulderbos'),(310,'2243','Pulle'),(311,'2250','OLEN'),(312,'2260','Oevel'),(313,'2260','Tongerlo'),(314,'2260','WESTERLO'),(315,'2260','Zoerle-Parwijs'),(316,'2270','HERENTHOUT'),(317,'2275','Gierle'),(318,'2275','LILLE'),(319,'2275','Poederlee'),(320,'2275','Wechelderzande'),(321,'2280','GROBBENDONK'),(322,'2288','Bouwel'),(323,'2290','VORSELAAR'),(324,'2300','TURNHOUT'),(325,'2310','RIJKEVORSEL'),(326,'2320','HOOGSTRATEN'),(327,'2321','Meer'),(328,'2322','Minderhout'),(329,'2323','Wortel'),(330,'2328','Meerle'),(331,'2330','MERKSPLAS'),(332,'2340','BEERSE'),(333,'2340','Vlimmeren'),(334,'2350','VOSSELAAR'),(335,'2360','OUD-TURNHOUT'),(336,'2370','ARENDONK'),(337,'2380','RAVELS'),(338,'2381','Weelde'),(339,'2382','Poppel'),(340,'2387','BAARLE-HERTOG'),(341,'2390','MALLE'),(342,'2390','Oostmalle'),(343,'2390','Westmalle'),(344,'2400','MOL'),(345,'2430','Eindhout'),(346,'2430','Vorst'),(347,'2431','Varendonk'),(348,'2431','Veerle'),(349,'2440','GEEL'),(350,'2450','MEERHOUT'),(351,'2460','KASTERLEE'),(352,'2460','Lichtaart'),(353,'2460','Tielen'),(354,'2470','RETIE'),(355,'2480','DESSEL'),(356,'2490','BALEN'),(357,'2491','Olmen'),(358,'2500','Koningshooikt'),(359,'2500','LIER'),(360,'2520','Broechem'),(361,'2520','Emblem'),(362,'2520','Oelegem'),(363,'2520','RANST'),(364,'2530','BOECHOUT'),(365,'2531','Vremde'),(366,'2540','HOVE'),(367,'2547','LINT'),(368,'2550','KONTICH'),(369,'2550','Waarloos'),(370,'2560','Bevel'),(371,'2560','Kessel'),(372,'2560','NIJLEN'),(373,'2570','DUFFEL'),(374,'2580','Beerzel'),(375,'2580','PUTTE'),(376,'2590','BERLAAR'),(377,'2590','Gestel'),(378,'2600','Berchem'),(379,'2610','Wilrijk'),(380,'2620','HEMIKSEM'),(381,'2627','SCHELLE'),(382,'2630','AARTSELAAR'),(383,'2640','MORTSEL'),(384,'2650','EDEGEM'),(385,'2660','Hoboken'),(386,'2800','MECHELEN'),(387,'2800','Walem'),(388,'2801','Heffen'),(389,'2811','Hombeek'),(390,'2811','Leest'),(391,'2812','Muizen'),(392,'2820','BONHEIDEN'),(393,'2820','Rijmenam'),(394,'2830','Blaasveld'),(395,'2830','Heindonk'),(396,'2830','Tisselt'),(397,'2830','WILLEBROEK'),(398,'2840','Reet'),(399,'2840','RUMST'),(400,'2840','Terhagen'),(401,'2845','NIEL'),(402,'2850','BOOM'),(403,'2860','SINT-KATELIJNE-WAVER'),(404,'2861','Onze-Lieve-Vrouw-Waver'),(405,'2870','Breendonk'),(406,'2870','Liezele'),(407,'2870','PUURS'),(408,'2870','Ruisbroek'),(409,'2880','BORNEM'),(410,'2880','Hingene'),(411,'2880','Mariekerke'),(412,'2880','Weert'),(413,'2890','Lippelo'),(414,'2890','Oppuurs'),(415,'2890','SINT-AMANDS'),(416,'2900','SCHOTEN'),(417,'2910','ESSEN'),(418,'2920','KALMTHOUT'),(419,'2930','BRASSCHAAT'),(420,'2940','Hoevenen'),(421,'2940','STABROEK'),(422,'2950','KAPELLEN'),(423,'2960','BRECHT'),(424,'2960','Sint-Job-In-\'T-Goor'),(425,'2960','Sint-Lenaarts'),(426,'2970','\'S Gravenwezel'),(427,'2970','SCHILDE'),(428,'2980','Halle'),(429,'2980','ZOERSEL'),(430,'2990','Loenhout'),(431,'2990','WUUSTWEZEL'),(432,'3000','LEUVEN'),(433,'3001','Heverlee'),(434,'3010','Kessel Lo'),(435,'3012','Wilsele'),(436,'3018','Wijgmaal'),(437,'3020','HERENT'),(438,'3020','Veltem-Beisem'),(439,'3020','Winksele'),(440,'3040','HULDENBERG'),(441,'3040','Loonbeek'),(442,'3040','Neerijse'),(443,'3040','Ottenburg'),(444,'3040','Sint-Agatha-Rode'),(445,'3050','OUD-HEVERLEE'),(446,'3051','Sint-Joris-Weert'),(447,'3052','Blanden'),(448,'3053','Haasrode'),(449,'3054','Vaalbeek'),(450,'3060','BERTEM'),(451,'3060','Korbeek-Dijle'),(452,'3061','Leefdaal'),(453,'3070','KORTENBERG'),(454,'3071','Erps-Kwerps'),(455,'3078','Everberg'),(456,'3078','Meerbeek'),(457,'3080','Duisburg'),(458,'3080','TERVUREN'),(459,'3080','Vossem'),(460,'3090','OVERIJSE'),(461,'3110','ROTSELAAR'),(462,'3111','Wezemaal'),(463,'3118','Werchter'),(464,'3120','TREMELO'),(465,'3128','Baal'),(466,'3130','BEGIJNENDIJK'),(467,'3130','Betekom'),(468,'3140','KEERBERGEN'),(469,'3150','HAACHT'),(470,'3150','Tildonk'),(471,'3150','Wespelaar'),(472,'3190','BOORTMEERBEEK'),(473,'3191','Hever'),(474,'3200','AARSCHOT'),(475,'3200','Gelrode'),(476,'3201','Langdorp'),(477,'3202','Rillaar'),(478,'3210','Linden'),(479,'3210','LUBBEEK'),(480,'3211','Binkom'),(481,'3212','Pellenberg'),(482,'3220','HOLSBEEK'),(483,'3220','Kortrijk-Dutsel'),(484,'3220','Sint-Pieters-Rode'),(485,'3221','Nieuwrode'),(486,'3270','Scherpenheuvel'),(487,'3271','Averbode'),(488,'3271','Zichem'),(489,'3272','Messelbroek'),(490,'3272','Testelt'),(491,'3290','Deurne'),(492,'3290','DIEST'),(493,'3290','Schaffen'),(494,'3290','Webbekom'),(495,'3293','Kaggevinne'),(496,'3294','Molenstede'),(497,'3300','Bost'),(498,'3300','Goetsenhoven'),(499,'3300','Hakendover'),(500,'3300','Kumtich'),(501,'3300','Oorbeek'),(502,'3300','Oplinter'),(503,'3300','Sint-Margriete-Houtem'),(504,'3300','TIENEN'),(505,'3300','Vissenaken'),(506,'3320','HOEGAARDEN'),(507,'3320','Meldert'),(508,'3321','Outgaarden'),(509,'3350','Drieslinter'),(510,'3350','LINTER'),(511,'3350','Melkwezer'),(512,'3350','Neerhespen'),(513,'3350','Neerlinter'),(514,'3350','Orsmaal-Gussenhoven'),(515,'3350','Overhespen'),(516,'3350','Wommersom'),(517,'3360','BIERBEEK'),(518,'3360','Korbeek-Lo'),(519,'3360','Lovenjoel'),(520,'3360','Opvelp'),(521,'3370','BOUTERSEM'),(522,'3370','Kerkom'),(523,'3370','Neervelp'),(524,'3370','Roosbeek'),(525,'3370','Vertrijk'),(526,'3370','Willebringen'),(527,'3380','Bunsbeek'),(528,'3380','GLABBEEK'),(529,'3381','Kapellen'),(530,'3384','Attenrode'),(531,'3390','Houwaart'),(532,'3390','Sint-Joris-Winge'),(533,'3390','Tielt'),(534,'3391','Meensel-Kiezegem'),(535,'3400','Eliksem'),(536,'3400','Ezemaal'),(537,'3400','Laar'),(538,'3400','LANDEN'),(539,'3400','Neerwinden'),(540,'3400','Overwinden'),(541,'3400','Rumsdorp'),(542,'3400','Wange'),(543,'3401','Waasmont'),(544,'3401','Walsbets'),(545,'3401','Walshoutem'),(546,'3401','Wezeren'),(547,'3404','Attenhoven'),(548,'3404','Neerlanden'),(549,'3440','Budingen'),(550,'3440','Dormaal'),(551,'3440','Halle-Booienhoven'),(552,'3440','Helen-Bos'),(553,'3440','ZOUTLEEUW'),(554,'3450','GEETBETS'),(555,'3450','Grazen'),(556,'3454','Rummen'),(557,'3460','Assent'),(558,'3460','BEKKEVOORT'),(559,'3461','Molenbeek-Wersbeek'),(560,'3470','KORTENAKEN'),(561,'3470','Ransberg'),(562,'3470','Sint-Margriete-Houtem'),(563,'3471','Hoeleden'),(564,'3472','Kersbeek-Miskom'),(565,'3473','Waanrode'),(566,'3500','HASSELT'),(567,'3500','Sint-Lambrechts-Herk'),(568,'3501','Wimmertingen'),(569,'3510','Kermt'),(570,'3510','Spalbeek'),(571,'3511','Kuringen'),(572,'3511','Stokrooie'),(573,'3512','Stevoort'),(574,'3520','ZONHOVEN'),(575,'3530','Helchteren'),(576,'3530','Houthalen'),(577,'3540','Berbroek'),(578,'3540','Donk'),(579,'3540','HERK-DE-STAD'),(580,'3540','Schulen'),(581,'3545','HALEN'),(582,'3545','Loksbergen'),(583,'3545','Zelem'),(584,'3550','Heusden'),(585,'3550','HEUSDEN-ZOLDER'),(586,'3550','Zolder'),(587,'3560','Linkhout'),(588,'3560','LUMMEN'),(589,'3560','Meldert'),(590,'3570','ALKEN'),(591,'3580','BERINGEN'),(592,'3581','Beverlo'),(593,'3582','Koersel'),(594,'3583','Paal'),(595,'3590','DIEPENBEEK'),(596,'3600','GENK'),(597,'3620','Gellik'),(598,'3620','LANAKEN'),(599,'3620','Neerharen'),(600,'3620','Veldwezelt'),(601,'3621','Rekem'),(602,'3630','Eisden'),(603,'3630','Leut'),(604,'3630','MAASMECHELEN'),(605,'3630','Mechelen-Aan-De-Maas'),(606,'3630','Meeswijk'),(607,'3630','Opgrimbie'),(608,'3630','Vucht'),(609,'3631','Boorsem'),(610,'3631','Uikhoven'),(611,'3640','Kessenich'),(612,'3640','KINROOI'),(613,'3640','Molenbeersel'),(614,'3640','Ophoven'),(615,'3650','Dilsen'),(616,'3650','DILSEN-STOKKEM'),(617,'3650','Elen'),(618,'3650','Lanklaar'),(619,'3650','Rotem'),(620,'3650','Stokkem'),(621,'3660','OPGLABBEEK'),(622,'3665','AS'),(623,'3668','Niel-Bij-As'),(624,'3670','Ellikom'),(625,'3670','Gruitrode'),(626,'3670','Meeuwen'),(627,'3670','Neerglabbeek'),(628,'3670','Wijshagen'),(629,'3680','MAASEIK'),(630,'3680','Neeroeteren'),(631,'3680','Opoeteren'),(632,'3690','ZUTENDAAL'),(633,'3700','\'S Herenelderen'),(634,'3700','Berg'),(635,'3700','Diets-Heur'),(636,'3700','Haren'),(637,'3700','Henis'),(638,'3700','Kolmont'),(639,'3700','Koninksem'),(640,'3700','Lauw'),(641,'3700','Mal'),(642,'3700','Neerrepen'),(643,'3700','Nerem'),(644,'3700','Overrepen'),(645,'3700','Piringen'),(646,'3700','Riksingen'),(647,'3700','Rutten'),(648,'3700','Sluizen'),(649,'3700','TONGEREN'),(650,'3700','Vreren'),(651,'3700','Widooie'),(652,'3717','HERSTAPPE'),(653,'3720','KORTESSEM'),(654,'3721','Vliermaalroot'),(655,'3722','Wintershoven'),(656,'3723','Guigoven'),(657,'3724','Vliermaal'),(658,'3730','HOESELT'),(659,'3730','Romershoven'),(660,'3730','Sint-Huibrechts-Hern'),(661,'3730','Werm'),(662,'3732','Schalkhoven'),(663,'3740','Beverst'),(664,'3740','BILZEN'),(665,'3740','Eigenbilzen'),(666,'3740','Grote-Spouwen'),(667,'3740','Hees'),(668,'3740','Kleine-Spouwen'),(669,'3740','Mopertingen'),(670,'3740','Munsterbilzen'),(671,'3740','Rijkhoven'),(672,'3740','Rosmeer'),(673,'3740','Waltwilder'),(674,'3742','Martenslinde'),(675,'3746','Hoelbeek'),(676,'3770','Genoelselderen'),(677,'3770','Herderen'),(678,'3770','Kanne'),(679,'3770','Membruggen'),(680,'3770','Millen'),(681,'3770','RIEMST'),(682,'3770','Val-Meer'),(683,'3770','Vlijtingen'),(684,'3770','Vroenhoven'),(685,'3770','Zichen-Zussen-Bolder'),(686,'3790','Moelingen'),(687,'3790','Sint-Martens-Voeren'),(688,'3791','Remersdaal'),(689,'3792','Sint-Pieters-Voeren'),(690,'3793','Teuven'),(691,'3798','S Gravenvoeren'),(692,'3800','Aalst'),(693,'3800','Brustem'),(694,'3800','Engelmanshoven'),(695,'3800','Gelinden'),(696,'3800','Groot-Gelmen'),(697,'3800','Halmaal'),(698,'3800','Kerkom-Bij-Sint-Truiden'),(699,'3800','Ordingen'),(700,'3800','SINT-TRUIDEN'),(701,'3800','Zepperen'),(702,'3803','Duras'),(703,'3803','Gorsem'),(704,'3803','Runkelen'),(705,'3803','Wilderen'),(706,'3806','Velm'),(707,'3830','Berlingen'),(708,'3830','WELLEN'),(709,'3831','Herten'),(710,'3832','Ulbeek'),(711,'3840','Bommershoven'),(712,'3840','BORGLOON'),(713,'3840','Broekom'),(714,'3840','Gors-Opleeuw'),(715,'3840','Gotem'),(716,'3840','Groot-Loon'),(717,'3840','Haren'),(718,'3840','Hendrieken'),(719,'3840','Hoepertingen'),(720,'3840','Jesseren'),(721,'3840','Kerniel'),(722,'3840','Kolmont'),(723,'3840','Kuttekoven'),(724,'3840','Rijkel'),(725,'3840','Voort'),(726,'3850','Binderveld'),(727,'3850','Kozen'),(728,'3850','NIEUWERKERKEN'),(729,'3850','Wijer'),(730,'3870','Batsheers'),(731,'3870','Bovelingen'),(732,'3870','Gutshoven'),(733,'3870','HEERS'),(734,'3870','Heks'),(735,'3870','Horpmaal'),(736,'3870','Klein-Gelmen'),(737,'3870','Mechelen-Bovelingen'),(738,'3870','Mettekoven'),(739,'3870','Opheers'),(740,'3870','Rukkelingen-Loon'),(741,'3870','Vechmaal'),(742,'3870','Veulen'),(743,'3890','Boekhout'),(744,'3890','GINGELOM'),(745,'3890','Jeuk'),(746,'3890','Kortijs'),(747,'3890','Montenaken'),(748,'3890','Niel-Bij-Sint-Truiden'),(749,'3890','Vorsen'),(750,'3891','Borlo'),(751,'3891','Buvingen'),(752,'3891','Mielen-Boven-Aalst'),(753,'3891','Muizen'),(754,'3900','OVERPELT'),(755,'3910','NEERPELT'),(756,'3910','Sint-Huibrechts-Lille'),(757,'3920','LOMMEL'),(758,'3930','Achel'),(759,'3930','Hamont'),(760,'3940','Hechtel'),(761,'3941','Eksel'),(762,'3945','Kwaadmechelen'),(763,'3945','Oostham'),(764,'3950','BOCHOLT'),(765,'3950','Kaulille'),(766,'3950','Reppel'),(767,'3960','Beek'),(768,'3960','BREE'),(769,'3960','Gerdingen'),(770,'3960','Opitter'),(771,'3960','Tongerlo'),(772,'3970','LEOPOLDSBURG'),(773,'3971','Heppen'),(774,'3980','TESSENDERLO'),(775,'3990','Grote-Brogel'),(776,'3990','Kleine-Brogel'),(777,'3990','PEER'),(778,'3990','Wijchmaal'),(779,'4000','Glain'),(780,'4000','LIÈGE'),(781,'4000','Rocourt'),(782,'4020','Bressoux'),(783,'4020','Jupille-Sur-Meuse'),(784,'4020','LIÈGE'),(785,'4020','Wandre'),(786,'4030','Grivegnee'),(787,'4031','Angleur'),(788,'4032','Chênee'),(789,'4040','HERSTAL'),(790,'4041','Milmort'),(791,'4041','Vottem'),(792,'4042','Liers'),(793,'4050','CHAUDFONTAINE'),(794,'4051','Vaux-Sous-Chèvremont'),(795,'4052','Beaufays'),(796,'4053','Embourg'),(797,'4099','Liège X'),(798,'4100','Boncelles'),(799,'4100','SERAING'),(800,'4101','Jemeppe-Sur-Meuse'),(801,'4102','Ougrée'),(802,'4120','Ehein'),(803,'4120','Rotheux-Rimière'),(804,'4121','Neuville-En-Condroz'),(805,'4122','Plainevaux'),(806,'4130','ESNEUX'),(807,'4130','Tilff'),(808,'4140','Dolembreux'),(809,'4140','Gomzé-Andoumont'),(810,'4140','Rouvreux'),(811,'4140','SPRIMONT'),(812,'4141','Louveigné'),(813,'4160','ANTHISNES'),(814,'4161','Villers-Aux-Tours'),(815,'4162','Hody'),(816,'4163','Tavier'),(817,'4170','COMBLAIN-AU-PONT'),(818,'4171','Poulseur'),(819,'4180','Comblain-Fairon'),(820,'4180','Comblain-La-Tour'),(821,'4180','HAMOIR'),(822,'4181','Filot'),(823,'4190','FERRIÈRES'),(824,'4190','My'),(825,'4190','Vieuxville'),(826,'4190','Werbomont'),(827,'4190','Xhoris'),(828,'4210','BURDINNE'),(829,'4210','Hannêche'),(830,'4210','Lamontzée'),(831,'4210','Marneffe'),(832,'4210','Oteppe'),(833,'4217','HÉRON'),(834,'4217','Lavoir'),(835,'4217','Waret-L\'Evêque'),(836,'4218','Couthuin'),(837,'4219','Acosse'),(838,'4219','Ambresin'),(839,'4219','Meeffe'),(840,'4219','WASSEIGES'),(841,'4250','Boëlhe'),(842,'4250','GEER'),(843,'4250','Hollogne-Sur-Geer'),(844,'4250','Lens-Saint-Servais'),(845,'4252','Omal'),(846,'4253','Darion'),(847,'4254','Ligney'),(848,'4257','BERLOZ'),(849,'4257','Corswarem'),(850,'4257','Rosoux-Crenwick'),(851,'4260','Avennes'),(852,'4260','BRAIVES'),(853,'4260','Ciplet'),(854,'4260','Fallais'),(855,'4260','Fumal'),(856,'4260','Ville-En-Hesbaye'),(857,'4261','Latinne'),(858,'4263','Tourinne'),(859,'4280','Abolens'),(860,'4280','Avernas-Le-Bauduin'),(861,'4280','Avin'),(862,'4280','Bertrée'),(863,'4280','Blehen'),(864,'4280','Cras-Avernas'),(865,'4280','Crehen'),(866,'4280','Grand-Hallet'),(867,'4280','HANNUT'),(868,'4280','Lens-Saint-Remy'),(869,'4280','Merdorp'),(870,'4280','Moxhe'),(871,'4280','Petit-Hallet'),(872,'4280','Poucet'),(873,'4280','Thisnes'),(874,'4280','Trognée'),(875,'4280','Villers-Le-Peuplier'),(876,'4280','Wansin'),(877,'4287','LINCENT'),(878,'4287','Pellaines'),(879,'4287','Racour'),(880,'4300','Bettincourt'),(881,'4300','Bleret'),(882,'4300','Bovenistier'),(883,'4300','Grand-Axhe'),(884,'4300','Lantremange'),(885,'4300','Oleye'),(886,'4300','WAREMME'),(887,'4317','Aineffe'),(888,'4317','Borlez'),(889,'4317','Celles'),(890,'4317','FAIMES'),(891,'4317','Les Waleffes'),(892,'4317','Viemme'),(893,'4340','AWANS'),(894,'4340','Fooz'),(895,'4340','Othée'),(896,'4340','Villers-L\'Evêque'),(897,'4342','Hognoul'),(898,'4347','FEXHE-LE-HAUT-CLOCHER'),(899,'4347','Freloux'),(900,'4347','Noville'),(901,'4347','Roloux'),(902,'4347','Voroux-Goreux'),(903,'4350','Lamine'),(904,'4350','Momalle'),(905,'4350','Pousset'),(906,'4350','REMICOURT'),(907,'4351','Hodeige'),(908,'4357','DONCEEL'),(909,'4357','Haneffe'),(910,'4357','Jeneffe'),(911,'4357','Limont'),(912,'4360','Bergilers'),(913,'4360','Grandville'),(914,'4360','Lens-Sur-Geer'),(915,'4360','OREYE'),(916,'4360','Otrange'),(917,'4367','CRISNÉE'),(918,'4367','Fize-Le-Marsal'),(919,'4367','Kemexhe'),(920,'4367','Odeur'),(921,'4367','Thys'),(922,'4400','Awirs'),(923,'4400','Chokier'),(924,'4400','Flémalle-Grande'),(925,'4400','Flémalle-Haute'),(926,'4400','Gleixhe'),(927,'4400','Ivoz-Ramet'),(928,'4400','Mons-Lez-Liège'),(929,'4420','Montegnée'),(930,'4420','SAINT-NICOLAS'),(931,'4420','Tilleur'),(932,'4430','ANS'),(933,'4431','Loncin'),(934,'4432','Alleur'),(935,'4432','Xhendremael'),(936,'4450','JUPRELLE'),(937,'4450','Lantin'),(938,'4450','Slins'),(939,'4451','Voroux-Lez-Liers'),(940,'4452','Paifve'),(941,'4452','Wihogne'),(942,'4453','Villers-Saint-Siméon'),(943,'4458','Fexhe-Slins'),(944,'4460','Bierset'),(945,'4460','Grâce-Berleur'),(946,'4460','GRÂCE-HOLLOGNE'),(947,'4460','Hollogne-Aux-Pierres'),(948,'4460','Horion-Hozémont'),(949,'4460','Velroux'),(950,'4470','SAINT-GEORGES-SUR-MEUSE'),(951,'4480','Clermont-Sous-Huy'),(952,'4480','Ehein'),(953,'4480','ENGIS'),(954,'4480','Hermalle-Sous-Huy'),(955,'4500','Ben-Ahin'),(956,'4500','HUY'),(957,'4500','Tihange'),(958,'4520','Antheit'),(959,'4520','Bas-Oha'),(960,'4520','Huccorgne'),(961,'4520','Moha'),(962,'4520','Vinalmont'),(963,'4520','WANZE'),(964,'4530','Fize-Fontaine'),(965,'4530','Vaux-Et-Borset'),(966,'4530','Vieux-Waleffe'),(967,'4530','VILLERS-LE-BOUILLET'),(968,'4530','Warnant-Dreye'),(969,'4537','Bodegnée'),(970,'4537','Chapon-Seraing'),(971,'4537','Seraing-Le-Château'),(972,'4537','VERLAINE'),(973,'4540','AMAY'),(974,'4540','Ampsin'),(975,'4540','Flône'),(976,'4540','Jehay'),(977,'4540','Ombret'),(978,'4550','NANDRIN'),(979,'4550','Saint-Séverin'),(980,'4550','Villers-Le-Temple'),(981,'4550','Yernée-Fraineux'),(982,'4557','Abée'),(983,'4557','Fraiture'),(984,'4557','Ramelot'),(985,'4557','Seny'),(986,'4557','Soheit-Tinlot'),(987,'4557','TINLOT'),(988,'4560','Bois-Et-Borsu'),(989,'4560','CLAVIER'),(990,'4560','Les Avins'),(991,'4560','Ocquier'),(992,'4560','Pailhe'),(993,'4560','Terwagne'),(994,'4570','MARCHIN'),(995,'4570','Vyle-Et-Tharoul'),(996,'4577','MODAVE'),(997,'4577','Outrelouxhe'),(998,'4577','Strée-Lez-Huy'),(999,'4577','Vierset-Barse'),(1000,'4590','Ellemelle'),(1001,'4590','OUFFET'),(1002,'4590','Warzée'),(1003,'4600','Lanaye'),(1004,'4600','Lixhe'),(1005,'4600','Richelle'),(1006,'4600','VISÉ'),(1007,'4601','Argenteau'),(1008,'4602','Cheratte'),(1009,'4606','Saint-André'),(1010,'4607','Berneau'),(1011,'4607','Bombaye'),(1012,'4607','DALHEM'),(1013,'4607','Feneur'),(1014,'4607','Mortroux'),(1015,'4608','Neufchâteau'),(1016,'4608','Warsage'),(1017,'4610','Bellaire'),(1018,'4610','BEYNE-HEUSAY'),(1019,'4610','Queue-Du-Bois'),(1020,'4620','FLÉRON'),(1021,'4621','Retinne'),(1022,'4623','Magnée'),(1023,'4624','Romsée'),(1024,'4630','Ayeneux'),(1025,'4630','Micheroux'),(1026,'4630','SOUMAGNE'),(1027,'4630','Tignée'),(1028,'4631','Evegnée'),(1029,'4632','Cérexhe-Heuseux'),(1030,'4633','Melen'),(1031,'4650','Chaineux'),(1032,'4650','Grand-Rechain'),(1033,'4650','HERVE'),(1034,'4650','Julémont'),(1035,'4651','Battice'),(1036,'4652','Xhendelesse'),(1037,'4653','Bolland'),(1038,'4654','Charneux'),(1039,'4670','BLÉGNY'),(1040,'4670','Mortier'),(1041,'4670','Trembleur'),(1042,'4671','Barchon'),(1043,'4671','Housse'),(1044,'4671','Saive'),(1045,'4672','Saint-Remy'),(1046,'4680','Hermée'),(1047,'4680','OUPEYE'),(1048,'4681','Hermalle-Sous-Argenteau'),(1049,'4682','Heure-Le-Romain'),(1050,'4682','Houtain-Saint-Siméon'),(1051,'4683','Vivegnis'),(1052,'4684','Haccourt'),(1053,'4690','BASSENGE'),(1054,'4690','Boirs'),(1055,'4690','Eben-Emael'),(1056,'4690','Glons'),(1057,'4690','Roclenge-Sur-Geer'),(1058,'4690','Wonck'),(1059,'4700','EUPEN'),(1060,'4701','Kettenis'),(1061,'4710','LONTZEN'),(1062,'4711','Walhorn'),(1063,'4720','LA CALAMINE'),(1064,'4721','Neu-Moresnet'),(1065,'4728','Hergenrath'),(1066,'4730','Hauset'),(1067,'4730','RAEREN'),(1068,'4731','Eynatten'),(1069,'4750','BUTGENBACH'),(1070,'4750','Elsenborn'),(1071,'4760','BULLANGE'),(1072,'4760','Manderfeld'),(1073,'4761','Rocherath'),(1074,'4770','AMBLÈVE'),(1075,'4770','Meyerode'),(1076,'4771','Heppenbach'),(1077,'4780','Recht'),(1078,'4780','SAINT-VITH'),(1079,'4782','Schoenberg'),(1080,'4783','Lommersweiler'),(1081,'4784','Crombach'),(1082,'4790','Reuland'),(1083,'4791','Thommen'),(1084,'4800','Ensival'),(1085,'4800','Lambermont'),(1086,'4800','Petit-Rechain'),(1087,'4800','Polleur'),(1088,'4800','VERVIERS'),(1089,'4801','Stembert'),(1090,'4802','Heusy'),(1091,'4820','DISON'),(1092,'4821','Andrimont'),(1093,'4830','LIMBOURG'),(1094,'4831','Bilstain'),(1095,'4834','Goé'),(1096,'4837','BAELEN'),(1097,'4837','Membach'),(1098,'4840','WELKENRAEDT'),(1099,'4841','Henri-Chapelle'),(1100,'4845','JALHAY'),(1101,'4845','Sart-Lez-Spa'),(1102,'4850','Montzen'),(1103,'4850','Moresnet'),(1104,'4851','Gemmenich'),(1105,'4851','Sippenaeken'),(1106,'4852','Hombourg'),(1107,'4860','Cornesse'),(1108,'4860','PEPINSTER'),(1109,'4860','Wegnez'),(1110,'4861','Soiron'),(1111,'4870','Forêt'),(1112,'4870','Fraipont'),(1113,'4870','Nessonvaux'),(1114,'4877','OLNE'),(1115,'4880','AUBEL'),(1116,'4890','Clermont'),(1117,'4890','Thimister'),(1118,'4900','SPA'),(1119,'4910','La Reid'),(1120,'4910','Polleur'),(1121,'4910','THEUX'),(1122,'4920','AYWAILLE'),(1123,'4920','Ernonheid'),(1124,'4920','Harzé'),(1125,'4920','Louveigné'),(1126,'4920','Sougné-Remouchamps'),(1127,'4950','Faymonville'),(1128,'4950','Robertville'),(1129,'4950','Sourbrodt'),(1130,'4950','WAIMES'),(1131,'4960','Bellevaux-Ligneuville'),(1132,'4960','Bevercé'),(1133,'4960','MALMEDY'),(1134,'4970','Francorchamps'),(1135,'4970','STAVELOT'),(1136,'4980','Fosse'),(1137,'4980','TROIS-PONTS'),(1138,'4980','Wanne'),(1139,'4983','Basse-Bodeux'),(1140,'4987','Chevron'),(1141,'4987','La Gleize'),(1142,'4987','Lorcé'),(1143,'4987','Rahier'),(1144,'4987','STOUMONT'),(1145,'4990','Arbrefontaine'),(1146,'4990','Bra'),(1147,'4990','LIERNEUX'),(1148,'5000','Beez'),(1149,'5000','NAMUR'),(1150,'5001','Belgrade'),(1151,'5002','Saint-Servais'),(1152,'5003','Saint-Marc'),(1153,'5004','Bouge'),(1154,'5010','SA SUDPRESSE'),(1155,'5012','Parlement Wallon'),(1156,'5020','Champion'),(1157,'5020','Daussoulx'),(1158,'5020','Flawinne'),(1159,'5020','Malonne'),(1160,'5020','Suarlée'),(1161,'5020','Temploux'),(1162,'5020','Vedrin'),(1163,'5021','Boninne'),(1164,'5022','Cognelée'),(1165,'5024','Gelbressée'),(1166,'5024','Marche-Les-Dames'),(1167,'5030','Beuzet'),(1168,'5030','Ernage'),(1169,'5030','GEMBLOUX'),(1170,'5030','Grand-Manil'),(1171,'5030','Lonzée'),(1172,'5030','Sauvenière'),(1173,'5031','Grand-Leez'),(1174,'5032','Bossière'),(1175,'5032','Bothey'),(1176,'5032','Corroy-Le-Château'),(1177,'5032','Isnes'),(1178,'5032','Mazy'),(1179,'5060','Arsimont'),(1180,'5060','Auvelais'),(1181,'5060','Falisolle'),(1182,'5060','Keumiée'),(1183,'5060','Moignelée'),(1184,'5060','Tamines'),(1185,'5060','Velaine-Sur-Sambre'),(1186,'5070','Aisemont'),(1187,'5070','FOSSES-LA-VILLE'),(1188,'5070','Le Roux'),(1189,'5070','Sart-Eustache'),(1190,'5070','Sart-Saint-Laurent'),(1191,'5070','Vitrival'),(1192,'5080','Emines'),(1193,'5080','Rhisnes'),(1194,'5080','Villers-Lez-Heest'),(1195,'5080','Warisoulx'),(1196,'5081','Bovesse'),(1197,'5081','Meux'),(1198,'5081','Saint-Denis-Bovesse'),(1199,'5100','Dave'),(1200,'5100','Jambes'),(1201,'5100','Naninne'),(1202,'5100','Wépion'),(1203,'5100','Wierde'),(1204,'5101','Erpent'),(1205,'5101','Lives-Sur-Meuse'),(1206,'5101','Loyers'),(1207,'5140','Boignée'),(1208,'5140','Ligny'),(1209,'5140','SOMBREFFE'),(1210,'5140','Tongrinne'),(1211,'5150','FLOREFFE'),(1212,'5150','Floriffoux'),(1213,'5150','Franière'),(1214,'5150','Soye'),(1215,'5170','Arbre'),(1216,'5170','Bois-De-Villers'),(1217,'5170','Lesve'),(1218,'5170','Lustin'),(1219,'5170','PROFONDEVILLE'),(1220,'5170','Rivière'),(1221,'5190','Balâtre'),(1222,'5190','Ham-Sur-Sambre'),(1223,'5190','JEMEPPE-SUR-SAMBRE'),(1224,'5190','Mornimont'),(1225,'5190','Moustier-Sur-Sambre'),(1226,'5190','Onoz'),(1227,'5190','Saint-Martin'),(1228,'5190','Spy'),(1229,'5300','ANDENNE'),(1230,'5300','Bonneville'),(1231,'5300','Coutisse'),(1232,'5300','Landenne'),(1233,'5300','Maizeret'),(1234,'5300','Namêche'),(1235,'5300','Sclayn'),(1236,'5300','Seilles'),(1237,'5300','Thon'),(1238,'5300','Vezin'),(1239,'5310','Aische-En-Refail'),(1240,'5310','Bolinne'),(1241,'5310','Boneffe'),(1242,'5310','Branchon'),(1243,'5310','Dhuy'),(1244,'5310','EGHEZÉE'),(1245,'5310','Hanret'),(1246,'5310','Leuze'),(1247,'5310','Liernu'),(1248,'5310','Longchamps'),(1249,'5310','Mehaigne'),(1250,'5310','Noville-Sur-Méhaigne'),(1251,'5310','Saint-Germain'),(1252,'5310','Taviers'),(1253,'5310','Upigny'),(1254,'5310','Waret-La-Chaussée'),(1255,'5330','ASSESSE'),(1256,'5330','Maillen'),(1257,'5330','Sart-Bernard'),(1258,'5332','Crupet'),(1259,'5333','Sorinne-La-Longue'),(1260,'5334','Florée'),(1261,'5336','Courrière'),(1262,'5340','Faulx-Les-Tombes'),(1263,'5340','GESVES'),(1264,'5340','Haltinne'),(1265,'5340','Mozet'),(1266,'5340','Sorée'),(1267,'5350','Evelette'),(1268,'5350','OHEY'),(1269,'5351','Haillot'),(1270,'5352','Perwez-Haillot'),(1271,'5353','Goesnes'),(1272,'5354','Jallet'),(1273,'5360','HAMOIS'),(1274,'5360','Natoye'),(1275,'5361','Mohiville'),(1276,'5361','Scy'),(1277,'5362','Achet'),(1278,'5363','Emptinne'),(1279,'5364','Schaltin'),(1280,'5370','Barvaux-Condroz'),(1281,'5370','Flostoy'),(1282,'5370','HAVELANGE'),(1283,'5370','Jeneffe'),(1284,'5370','Porcheresse'),(1285,'5370','Verlée'),(1286,'5372','Méan'),(1287,'5374','Maffe'),(1288,'5376','Miécret'),(1289,'5377','Baillonville'),(1290,'5377','Bonsin'),(1291,'5377','Heure'),(1292,'5377','Hogne'),(1293,'5377','Nettinne'),(1294,'5377','Noiseux'),(1295,'5377','Sinsin'),(1296,'5377','SOMME-LEUZE'),(1297,'5377','Waillet'),(1298,'5380','Bierwart'),(1299,'5380','Cortil-Wodon'),(1300,'5380','Forville'),(1301,'5380','Franc-Waret'),(1302,'5380','Hemptinne'),(1303,'5380','Hingeon'),(1304,'5380','Marchovelette'),(1305,'5380','Noville-Les-Bois'),(1306,'5380','Pontillas'),(1307,'5380','Tillier'),(1308,'5500','Anseremme'),(1309,'5500','Bouvignes-Sur-Meuse'),(1310,'5500','DINANT'),(1311,'5500','Dréhance'),(1312,'5500','Falmagne'),(1313,'5500','Falmignoul'),(1314,'5500','Furfooz'),(1315,'5501','Lisogne'),(1316,'5502','Thynes'),(1317,'5503','Sorinnes'),(1318,'5504','Foy-Notre-Dame'),(1319,'5520','Anthée'),(1320,'5520','ONHAYE'),(1321,'5521','Serville'),(1322,'5522','Falaen'),(1323,'5523','Sommière'),(1324,'5523','Weillen'),(1325,'5524','Gerin'),(1326,'5530','Dorinne'),(1327,'5530','Durnal'),(1328,'5530','Evrehailles'),(1329,'5530','Godinne'),(1330,'5530','Houx'),(1331,'5530','Mont'),(1332,'5530','Purnode'),(1333,'5530','Spontin'),(1334,'5530','YVOIR'),(1335,'5537','ANHÉE'),(1336,'5537','Annevoie-Rouillon'),(1337,'5537','Bioul'),(1338,'5537','Denée'),(1339,'5537','Haut-Le-Wastia'),(1340,'5537','Sosoye'),(1341,'5537','Warnant'),(1342,'5540','Hastière-Lavaux'),(1343,'5540','Hermeton-Sur-Meuse'),(1344,'5540','Waulsort'),(1345,'5541','Hastière-Par-Delà'),(1346,'5542','Blaimont'),(1347,'5543','Heer'),(1348,'5544','Agimont'),(1349,'5550','Alle'),(1350,'5550','Bagimont'),(1351,'5550','Bohan'),(1352,'5550','Chairière'),(1353,'5550','Laforet'),(1354,'5550','Membre'),(1355,'5550','Mouzaive'),(1356,'5550','Nafraiture'),(1357,'5550','Orchimont'),(1358,'5550','Pussemange'),(1359,'5550','Sugny'),(1360,'5550','VRESSE-SUR-SEMOIS'),(1361,'5555','Baillamont'),(1362,'5555','Bellefontaine'),(1363,'5555','BIÈVRE'),(1364,'5555','Cornimont'),(1365,'5555','Graide'),(1366,'5555','Gros-Fays'),(1367,'5555','Monceau-En-Ardenne'),(1368,'5555','Naomé'),(1369,'5555','Oizy'),(1370,'5555','Petit-Fays'),(1371,'5560','Ciergnon'),(1372,'5560','Finnevaux'),(1373,'5560','HOUYET'),(1374,'5560','Hulsonniaux'),(1375,'5560','Mesnil-Eglise'),(1376,'5560','Mesnil-Saint-Blaise'),(1377,'5561','Celles'),(1378,'5562','Custinne'),(1379,'5563','Hour'),(1380,'5564','Wanlin'),(1381,'5570','Baronville'),(1382,'5570','BEAURAING'),(1383,'5570','Dion'),(1384,'5570','Felenne'),(1385,'5570','Feschaux'),(1386,'5570','Honnay'),(1387,'5570','Javingue'),(1388,'5570','Vonêche'),(1389,'5570','Wancennes'),(1390,'5570','Winenne'),(1391,'5571','Wiesme'),(1392,'5572','Focant'),(1393,'5573','Martouzin-Neuville'),(1394,'5574','Pondrôme'),(1395,'5575','Bourseigne-Neuve'),(1396,'5575','Bourseigne-Vieille'),(1397,'5575','GEDINNE'),(1398,'5575','Houdremont'),(1399,'5575','Louette-Saint-Denis'),(1400,'5575','Louette-Saint-Pierre'),(1401,'5575','Malvoisin'),(1402,'5575','Patignies'),(1403,'5575','Rienne'),(1404,'5575','Sart-Custinne'),(1405,'5575','Vencimont'),(1406,'5575','Willerzie'),(1407,'5576','Froidfontaine'),(1408,'5580','Ave-Et-Auffe'),(1409,'5580','Buissonville'),(1410,'5580','Eprave'),(1411,'5580','Han-Sur-Lesse'),(1412,'5580','Jemelle'),(1413,'5580','Lavaux-Saint-Anne'),(1414,'5580','Lessive'),(1415,'5580','Mont-Gauthier'),(1416,'5580','ROCHEFORT'),(1417,'5580','Villers-Sur-Lesse'),(1418,'5580','Wavreille'),(1419,'5590','Achêne'),(1420,'5590','Braibant'),(1421,'5590','Chevetogne'),(1422,'5590','CINEY'),(1423,'5590','Conneux'),(1424,'5590','Haversin'),(1425,'5590','Leignon'),(1426,'5590','Pessoux'),(1427,'5590','Serinchamps'),(1428,'5590','Sovet'),(1429,'5600','Fagnolle'),(1430,'5600','Franchimont'),(1431,'5600','Jamagne'),(1432,'5600','Jamiolle'),(1433,'5600','Merlemont'),(1434,'5600','Neuville'),(1435,'5600','Omezée'),(1436,'5600','PHILIPPEVILLE'),(1437,'5600','Roly'),(1438,'5600','Romedenne'),(1439,'5600','Samart'),(1440,'5600','Sart-En-Fagne'),(1441,'5600','Sautour'),(1442,'5600','Surice'),(1443,'5600','Villers-En-Fagne'),(1444,'5600','Villers-Le-Gambon'),(1445,'5600','Vodecée'),(1446,'5620','Corenne'),(1447,'5620','Flavion'),(1448,'5620','FLORENNES'),(1449,'5620','Hemptinne-Lez-Florennes'),(1450,'5620','Morville'),(1451,'5620','Rosée'),(1452,'5620','Saint-Aubin'),(1453,'5621','Hanzinelle'),(1454,'5621','Hanzinne'),(1455,'5621','Morialmé'),(1456,'5621','Thy-Le-Baudouin'),(1457,'5630','CERFONTAINE'),(1458,'5630','Daussois'),(1459,'5630','Senzeille'),(1460,'5630','Silenrieux'),(1461,'5630','Soumoy'),(1462,'5630','Villers-Deux-Eglises'),(1463,'5640','Biesme'),(1464,'5640','Biesmerée'),(1465,'5640','Graux'),(1466,'5640','METTET'),(1467,'5640','Oret'),(1468,'5640','Saint-Gérard'),(1469,'5641','Furnaux'),(1470,'5644','Ermeton-Sur-Biert'),(1471,'5646','Stave'),(1472,'5650','Castillon'),(1473,'5650','Chastrès'),(1474,'5650','Clermont'),(1475,'5650','Fontenelle'),(1476,'5650','Fraire'),(1477,'5650','Pry'),(1478,'5650','Vogenée'),(1479,'5650','WALCOURT'),(1480,'5650','Yves-Gomezée'),(1481,'5651','Berzée'),(1482,'5651','Gourdinne'),(1483,'5651','Laneffe'),(1484,'5651','Rognée'),(1485,'5651','Somzée'),(1486,'5651','Tarcienne'),(1487,'5651','Thy-Le-Château'),(1488,'5660','Aublain'),(1489,'5660','Boussu-En-Fagne'),(1490,'5660','Brûly'),(1491,'5660','Brûly-De-Pesche'),(1492,'5660','COUVIN'),(1493,'5660','Cul-Des-Sarts'),(1494,'5660','Dailly'),(1495,'5660','Frasnes'),(1496,'5660','Gonrieux'),(1497,'5660','Mariembourg'),(1498,'5660','Pesche'),(1499,'5660','Petigny'),(1500,'5660','Petite-Chapelle'),(1501,'5660','Presgaux'),(1502,'5670','Dourbes'),(1503,'5670','Le Mesnil'),(1504,'5670','Mazée'),(1505,'5670','Nismes'),(1506,'5670','Oignies-En-Thiérache'),(1507,'5670','Olloy-Sur-Viroin'),(1508,'5670','Treignes'),(1509,'5670','Vierves-Sur-Viroin'),(1510,'5680','DOISCHE'),(1511,'5680','Gimnée'),(1512,'5680','Gochenée'),(1513,'5680','Matagne-La-Grande'),(1514,'5680','Matagne-La-Petite'),(1515,'5680','Niverlée'),(1516,'5680','Romerée'),(1517,'5680','Soulme'),(1518,'5680','Vaucelles'),(1519,'5680','Vodelée'),(1520,'6000','CHARLEROI'),(1521,'6001','Marcinelle'),(1522,'6010','Couillet'),(1523,'6020','Dampremy'),(1524,'6030','Goutroux'),(1525,'6030','Marchienne-Au-Pont'),(1526,'6031','Monceau-Sur-Sambre'),(1527,'6032','Mont-Sur-Marchienne'),(1528,'6040','Jumet'),(1529,'6041','Gosselies'),(1530,'6042','Lodelinsart'),(1531,'6043','Ransart'),(1532,'6044','Roux'),(1533,'6060','Gilly'),(1534,'6061','Montignies-Sur-Sambre'),(1535,'6099','Charleroi X'),(1536,'6110','MONTIGNY-LE-TILLEUL'),(1537,'6111','Landelies'),(1538,'6120','Cour-Sur-Heure'),(1539,'6120','HAM-SUR-HEURE'),(1540,'6120','Jamioulx'),(1541,'6120','Marbaix'),(1542,'6120','Nalinnes'),(1543,'6140','FONTAINE-L\'EVÊQUE'),(1544,'6141','Forchies-La-Marche'),(1545,'6142','Leernes'),(1546,'6150','ANDERLUES'),(1547,'6180','COURCELLES'),(1548,'6181','Gouy-Lez-Piéton'),(1549,'6182','Souvret'),(1550,'6183','Trazegnies'),(1551,'6200','Bouffioulx'),(1552,'6200','CHÂTELET'),(1553,'6200','Châtelineau'),(1554,'6210','Frasnes-Lez-Gosselies'),(1555,'6210','Rèves'),(1556,'6210','Villers-Perwin'),(1557,'6210','Wayaux'),(1558,'6211','Mellet'),(1559,'6220','FLEURUS'),(1560,'6220','Heppignies'),(1561,'6220','Lambusart'),(1562,'6220','Wangenies'),(1563,'6221','Saint-Amand'),(1564,'6222','Brye'),(1565,'6223','Wagnelée'),(1566,'6224','Wanfercée-Baulet'),(1567,'6230','Buzet'),(1568,'6230','Obaix'),(1569,'6230','PONT-À-CELLES'),(1570,'6230','Thiméon'),(1571,'6230','Viesville'),(1572,'6238','Liberchies'),(1573,'6238','Luttre'),(1574,'6240','FARCIENNES'),(1575,'6240','Pironchamps'),(1576,'6250','Aiseau'),(1577,'6250','Pont-De-Loup'),(1578,'6250','Presles'),(1579,'6250','Roselies'),(1580,'6280','Acoz'),(1581,'6280','GERPINNES'),(1582,'6280','Gougnies'),(1583,'6280','Joncret'),(1584,'6280','Loverval'),(1585,'6280','Villers-Poterie'),(1586,'6440','Boussu-Lez-Walcourt'),(1587,'6440','Fourbechies'),(1588,'6440','FROIDCHAPELLE'),(1589,'6440','Vergnies'),(1590,'6441','Erpion'),(1591,'6460','Bailièvre'),(1592,'6460','CHIMAY'),(1593,'6460','Robechies'),(1594,'6460','Saint-Remy'),(1595,'6460','Salles'),(1596,'6460','Villers-La-Tour'),(1597,'6461','Virelles'),(1598,'6462','Vaulx-Lez-Chimay'),(1599,'6463','Lompret'),(1600,'6464','Baileux'),(1601,'6464','Bourlers'),(1602,'6464','Forges'),(1603,'6464','L\'Escaillère'),(1604,'6464','Rièzes'),(1605,'6470','Grandrieu'),(1606,'6470','Montbliart'),(1607,'6470','Rance'),(1608,'6470','Sautin'),(1609,'6470','Sivry'),(1610,'6500','Barbençon'),(1611,'6500','BEAUMONT'),(1612,'6500','Leugnies'),(1613,'6500','Leval-Chaudeville'),(1614,'6500','Renlies'),(1615,'6500','Solre-Saint-Géry'),(1616,'6500','Thirimont'),(1617,'6511','Strée'),(1618,'6530','Leers-Et-Fosteau'),(1619,'6530','THUIN'),(1620,'6531','Biesme-Sous-Thuin'),(1621,'6532','Ragnies'),(1622,'6533','Biercée'),(1623,'6534','Gozée'),(1624,'6536','Donstiennes'),(1625,'6536','Thuillies'),(1626,'6540','LOBBES'),(1627,'6540','Mont-Sainte-Geneviève'),(1628,'6542','Sars-La-Buissière'),(1629,'6543','Bienne-Lez-Happart'),(1630,'6560','Bersillies-L\'Abbaye'),(1631,'6560','ERQUELINNES'),(1632,'6560','Grand-Reng'),(1633,'6560','Hantes-Wihéries'),(1634,'6560','Montignies-Saint-Christophe'),(1635,'6560','Solre-Sur-Sambre'),(1636,'6567','Fontaine-Valmont'),(1637,'6567','Labuissière'),(1638,'6567','MERBES-LE-CHÂTEAU'),(1639,'6567','Merbes-Sainte-Marie'),(1640,'6590','MOMIGNIES'),(1641,'6591','Macon'),(1642,'6592','Monceau-Imbrechies'),(1643,'6593','Macquenoise'),(1644,'6594','Beauwelz'),(1645,'6596','Forge-Philippe'),(1646,'6596','Seloignes'),(1647,'6600','BASTOGNE'),(1648,'6600','Longvilly'),(1649,'6600','Noville'),(1650,'6600','Villers-La-Bonne-Eau'),(1651,'6600','Wardin'),(1652,'6630','MARTELANGE'),(1653,'6637','FAUVILLERS'),(1654,'6637','Hollange'),(1655,'6637','Tintange'),(1656,'6640','Hompré'),(1657,'6640','Morhet'),(1658,'6640','Nives'),(1659,'6640','Sibret'),(1660,'6640','Vaux-Lez-Rosières'),(1661,'6640','VAUX-SUR-SÛRE'),(1662,'6642','Juseret'),(1663,'6660','HOUFFALIZE'),(1664,'6660','Nadrin'),(1665,'6661','Mont'),(1666,'6661','Tailles'),(1667,'6662','Tavigny'),(1668,'6663','Mabompré'),(1669,'6666','Wibrin'),(1670,'6670','GOUVY'),(1671,'6670','Limerlé'),(1672,'6671','Bovigny'),(1673,'6672','Beho'),(1674,'6673','Cherain'),(1675,'6674','Montleban'),(1676,'6680','Amberloup'),(1677,'6680','Tillet'),(1678,'6681','Lavacherie'),(1679,'6686','Flamierge'),(1680,'6687','BERTOGNE'),(1681,'6688','Longchamps'),(1682,'6690','Bihain'),(1683,'6690','VIELSALM'),(1684,'6692','Petit-Thier'),(1685,'6698','Grand-Halleux'),(1686,'6700','ARLON'),(1687,'6700','Bonnert'),(1688,'6700','Heinsch'),(1689,'6700','Toernich'),(1690,'6704','Guirsch'),(1691,'6706','Autelbas'),(1692,'6717','ATTERT'),(1693,'6717','Nobressart'),(1694,'6717','Nothomb'),(1695,'6717','Thiaumont'),(1696,'6717','Tontelange'),(1697,'6720','Habay-La-Neuve'),(1698,'6720','Hachy'),(1699,'6721','Anlier'),(1700,'6723','Habay-La-Vieille'),(1701,'6724','Houdemont'),(1702,'6724','Rulles'),(1703,'6730','Bellefontaine'),(1704,'6730','Rossignol'),(1705,'6730','Saint-Vincent'),(1706,'6730','TINTIGNY'),(1707,'6740','ETALLE'),(1708,'6740','Sainte-Marie-Sur-Semois'),(1709,'6740','Villers-Sur-Semois'),(1710,'6741','Vance'),(1711,'6742','Chantemelle'),(1712,'6743','Buzenol'),(1713,'6747','Châtillon'),(1714,'6747','Meix-Le-Tige'),(1715,'6747','SAINT-LÉGER'),(1716,'6750','MUSSON'),(1717,'6750','Mussy-La-Ville'),(1718,'6750','Signeulx'),(1719,'6760','Bleid'),(1720,'6760','Ethe'),(1721,'6760','Ruette'),(1722,'6760','VIRTON'),(1723,'6761','Latour'),(1724,'6762','Saint-Mard'),(1725,'6767','Dampicourt'),(1726,'6767','Harnoncourt'),(1727,'6767','Lamorteau'),(1728,'6767','Torgny'),(1729,'6769','Gérouville'),(1730,'6769','MEIX-DEVANT-VIRTON'),(1731,'6769','Robelmont'),(1732,'6769','Sommethonne'),(1733,'6769','Villers-La-Loue'),(1734,'6780','Hondelange'),(1735,'6780','MESSANCY'),(1736,'6780','Wolkrange'),(1737,'6781','Sélange'),(1738,'6782','Habergy'),(1739,'6790','AUBANGE'),(1740,'6791','Athus'),(1741,'6792','Halanzy'),(1742,'6792','Rachecourt'),(1743,'6800','Bras'),(1744,'6800','Freux'),(1745,'6800','LIBRAMONT-CHEVIGNY'),(1746,'6800','Moircy'),(1747,'6800','Recogne'),(1748,'6800','Remagne'),(1749,'6800','Saint-Pierre'),(1750,'6800','Sainte-Marie-Chevigny'),(1751,'6810','CHINY'),(1752,'6810','Izel'),(1753,'6810','Jamoigne'),(1754,'6811','Les Bulles'),(1755,'6812','Suxy'),(1756,'6813','Termes'),(1757,'6820','FLORENVILLE'),(1758,'6820','Fontenoille'),(1759,'6820','Muno'),(1760,'6820','Sainte-Cécile'),(1761,'6821','Lacuisine'),(1762,'6823','Villers-Devant-Orval'),(1763,'6824','Chassepierre'),(1764,'6830','BOUILLON'),(1765,'6830','Les Hayons'),(1766,'6830','Poupehan'),(1767,'6830','Rochehaut'),(1768,'6831','Noirfontaine'),(1769,'6832','Sensenruth'),(1770,'6833','Ucimont'),(1771,'6833','Vivy'),(1772,'6834','Bellevaux'),(1773,'6836','Dohan'),(1774,'6838','Corbion'),(1775,'6840','Grandvoir'),(1776,'6840','Grapfontaine'),(1777,'6840','Hamipré'),(1778,'6840','Longlier'),(1779,'6840','NEUFCHÂTEAU'),(1780,'6840','Tournay'),(1781,'6850','Carlsbourg'),(1782,'6850','Offagne'),(1783,'6850','PALISEUL'),(1784,'6851','Nollevaux'),(1785,'6852','Maissin'),(1786,'6852','Opont'),(1787,'6853','Framont'),(1788,'6856','Fays-Les-Veneurs'),(1789,'6860','Assenois'),(1790,'6860','Ebly'),(1791,'6860','LÉGLISE'),(1792,'6860','Mellier'),(1793,'6860','Witry'),(1794,'6870','Arville'),(1795,'6870','Awenne'),(1796,'6870','Hatrival'),(1797,'6870','Mirwart'),(1798,'6870','SAINT-HUBERT'),(1799,'6870','Vesqueville'),(1800,'6880','Auby-Sur-Semois'),(1801,'6880','BERTRIX'),(1802,'6880','Cugnon'),(1803,'6880','Jehonville'),(1804,'6880','Orgeo'),(1805,'6887','HERBEUMONT'),(1806,'6887','Saint-Médard'),(1807,'6887','Straimont'),(1808,'6890','Anloy'),(1809,'6890','LIBIN'),(1810,'6890','Ochamps'),(1811,'6890','Redu'),(1812,'6890','Smuid'),(1813,'6890','Transinne'),(1814,'6890','Villance'),(1815,'6900','Aye'),(1816,'6900','Hargimont'),(1817,'6900','Humain'),(1818,'6900','MARCHE-EN-FAMENNE'),(1819,'6900','On'),(1820,'6900','Roy'),(1821,'6900','Waha'),(1822,'6920','Sohier'),(1823,'6920','WELLIN'),(1824,'6921','Chanly'),(1825,'6922','Halma'),(1826,'6924','Lomprez'),(1827,'6927','Bure'),(1828,'6927','Grupont'),(1829,'6927','Resteigne'),(1830,'6927','TELLIN'),(1831,'6929','DAVERDISSE'),(1832,'6929','Gembes'),(1833,'6929','Haut-Fays'),(1834,'6929','Porcheresse'),(1835,'6940','Barvaux-Sur-Ourthe'),(1836,'6940','DURBUY'),(1837,'6940','Grandhan'),(1838,'6940','Septon'),(1839,'6940','Wéris'),(1840,'6941','Bende'),(1841,'6941','Bomal-Sur-Ourthe'),(1842,'6941','Borlon'),(1843,'6941','Heyd'),(1844,'6941','Izier'),(1845,'6941','Tohogne'),(1846,'6941','Villers-Sainte-Gertrude'),(1847,'6950','Harsin'),(1848,'6950','NASSOGNE'),(1849,'6951','Bande'),(1850,'6952','Grune'),(1851,'6953','Ambly'),(1852,'6953','Forrières'),(1853,'6953','Lesterny'),(1854,'6953','Masbourg'),(1855,'6960','Dochamps'),(1856,'6960','Grandmenil'),(1857,'6960','Harre'),(1858,'6960','Malempré'),(1859,'6960','Odeigne'),(1860,'6960','Vaux-Chavanne'),(1861,'6970','TENNEVILLE'),(1862,'6971','Champlon'),(1863,'6972','Erneuville'),(1864,'6980','Beausaint'),(1865,'6980','LA ROCHE-EN-ARDENNE'),(1866,'6982','Samrée'),(1867,'6983','Ortho'),(1868,'6984','Hives'),(1869,'6986','Halleux'),(1870,'6987','Beffe'),(1871,'6987','Hodister'),(1872,'6987','Marcourt'),(1873,'6987','RENDEUX'),(1874,'6990','Fronville'),(1875,'6990','Hampteau'),(1876,'6990','HOTTON'),(1877,'6990','Marenne'),(1878,'6997','Amonines'),(1879,'6997','EREZÉE'),(1880,'6997','Mormont'),(1881,'6997','Soy'),(1882,'7000','MONS'),(1883,'7010','SHAPE'),(1884,'7011','Ghlin'),(1885,'7012','Flénu'),(1886,'7012','Jemappes'),(1887,'7020','Maisières'),(1888,'7020','Nimy'),(1889,'7021','Havre'),(1890,'7022','Harmignies'),(1891,'7022','Harveng'),(1892,'7022','Hyon'),(1893,'7022','Mesvin'),(1894,'7022','Nouvelles'),(1895,'7024','Ciply'),(1896,'7030','Saint-Symphorien'),(1897,'7031','Villers-Saint-Ghislain'),(1898,'7032','Spiennes'),(1899,'7033','Cuesmes'),(1900,'7034','Obourg'),(1901,'7034','Saint-Denis'),(1902,'7040','Asquillies'),(1903,'7040','Aulnois'),(1904,'7040','Blaregnies'),(1905,'7040','Bougnies'),(1906,'7040','Genly'),(1907,'7040','Goegnies-Chaussée'),(1908,'7040','Quévy-Le-Grand'),(1909,'7040','Quévy-Le-Petit'),(1910,'7041','Givry'),(1911,'7041','Havay'),(1912,'7050','Erbaut'),(1913,'7050','Erbisoeul'),(1914,'7050','Herchies'),(1915,'7050','JURBISE'),(1916,'7050','Masnuy-Saint-Jean'),(1917,'7050','Masnuy-Saint-Pierre'),(1918,'7060','Horrues'),(1919,'7060','SOIGNIES'),(1920,'7061','Casteau'),(1921,'7061','Thieusies'),(1922,'7062','Naast'),(1923,'7063','Chaussée-Notre-Dame-Louvignies'),(1924,'7063','Neufvilles'),(1925,'7070','Gottignies'),(1926,'7070','LE ROEULX'),(1927,'7070','Mignault'),(1928,'7070','Thieu'),(1929,'7070','Ville-Sur-Haine'),(1930,'7080','Eugies'),(1931,'7080','FRAMERIES'),(1932,'7080','La Bouverie'),(1933,'7080','Noirchain'),(1934,'7080','Sars-La-Bruyère'),(1935,'7090','BRAINE-LE-COMTE'),(1936,'7090','Hennuyères'),(1937,'7090','Henripont'),(1938,'7090','Petit-Roeulx-Lez-Braine'),(1939,'7090','Ronquières'),(1940,'7090','Steenkerque'),(1941,'7100','Haine-Saint-Paul'),(1942,'7100','Haine-Saint-Pierre'),(1943,'7100','LA LOUVIÈRE'),(1944,'7100','Saint-Vaast'),(1945,'7100','Trivières'),(1946,'7110','Boussoit'),(1947,'7110','Houdeng-Aimeries'),(1948,'7110','Houdeng-Goegnies'),(1949,'7110','Maurage'),(1950,'7110','Strépy-Bracquegnies'),(1951,'7120','Croix-Lez-Rouveroy'),(1952,'7120','Estinnes-Au-Mont'),(1953,'7120','Estinnes-Au-Val'),(1954,'7120','Fauroeulx'),(1955,'7120','Haulchin'),(1956,'7120','Peissant'),(1957,'7120','Rouveroy'),(1958,'7120','Vellereille-Le-Sec'),(1959,'7120','Vellereille-Les-Brayeux'),(1960,'7130','Battignies'),(1961,'7130','BINCHE'),(1962,'7130','Bray'),(1963,'7131','Waudrez'),(1964,'7133','Buvrinnes'),(1965,'7134','Epinois'),(1966,'7134','Leval-Trahegnies'),(1967,'7134','Péronnes-Lez-Binche'),(1968,'7134','Ressaix'),(1969,'7140','Morlanwelz-Mariemont'),(1970,'7141','Carnières'),(1971,'7141','Mont-Sainte-Aldegonde'),(1972,'7160','CHAPELLE-LEZ-HERLAIMONT'),(1973,'7160','Godarville'),(1974,'7160','Piéton'),(1975,'7170','Bellecourt'),(1976,'7170','Bois-D\'Haine'),(1977,'7170','Fayt-Lez-Manage'),(1978,'7170','La Hestre'),(1979,'7170','MANAGE'),(1980,'7180','SENEFFE'),(1981,'7181','Arquennes'),(1982,'7181','Familleureux'),(1983,'7181','Feluy'),(1984,'7181','Petit-Roeulx-Lez-Nivelles'),(1985,'7190','Ecaussinnes-D\'Enghien'),(1986,'7190','Marche-Lez-Ecaussinnes'),(1987,'7191','Ecaussinnes-Lalaing'),(1988,'7300','BOUSSU'),(1989,'7301','Hornu'),(1990,'7320','BERNISSART'),(1991,'7321','Blaton'),(1992,'7321','Harchies'),(1993,'7322','Pommeroeul'),(1994,'7322','Ville-Pommeroeul'),(1995,'7330','SAINT-GHISLAIN'),(1996,'7331','Baudour'),(1997,'7332','Neufmaison'),(1998,'7332','Sirault'),(1999,'7333','Tertre'),(2000,'7334','Hautrage'),(2001,'7334','Villerot'),(2002,'7340','COLFONTAINE'),(2003,'7340','Paturages'),(2004,'7340','Warquignies'),(2005,'7340','Wasmes'),(2006,'7350','Hainin'),(2007,'7350','HENSIES'),(2008,'7350','Montroeul-Sur-Haine'),(2009,'7350','Thulin'),(2010,'7370','Blaugies'),(2011,'7370','DOUR'),(2012,'7370','Elouges'),(2013,'7370','Wihéries'),(2014,'7380','Baisieux'),(2015,'7380','QUIÉVRAIN'),(2016,'7382','Audregnies'),(2017,'7387','Angre'),(2018,'7387','Angreau'),(2019,'7387','Athis'),(2020,'7387','Autreppe'),(2021,'7387','Erquennes'),(2022,'7387','Fayt-Le-Franc'),(2023,'7387','Marchipont'),(2024,'7387','Montignies-Sur-Roc'),(2025,'7387','Onnezies'),(2026,'7387','Roisin'),(2027,'7390','QUAREGNON'),(2028,'7390','Wasmuel'),(2029,'7500','Ere'),(2030,'7500','Saint-Maur'),(2031,'7500','TOURNAI'),(2032,'7501','Orcq'),(2033,'7502','Esplechin'),(2034,'7503','Froyennes'),(2035,'7504','Froidmont'),(2036,'7506','Willemeau'),(2037,'7510','3 SUISSES'),(2038,'7511','VITRINE MAGIQUE'),(2039,'7512','YVES ROCHER'),(2040,'7513','YVES ROCHER'),(2041,'7520','Ramegnies-Chin'),(2042,'7520','Templeuve'),(2043,'7521','Chercq'),(2044,'7522','Blandain'),(2045,'7522','Hertain'),(2046,'7522','Lamain'),(2047,'7522','Marquain'),(2048,'7530','Gaurain-Ramecroix'),(2049,'7531','Havinnes'),(2050,'7532','Beclers'),(2051,'7533','Thimougies'),(2052,'7534','Barry'),(2053,'7534','Maulde'),(2054,'7536','Vaulx'),(2055,'7538','Vezon'),(2056,'7540','Kain'),(2057,'7540','Melles'),(2058,'7540','Quartes'),(2059,'7540','Rumillies'),(2060,'7542','Mont-Saint-Aubert'),(2061,'7543','Mourcourt'),(2062,'7548','Warchin'),(2063,'7600','PÉRUWELZ'),(2064,'7601','Roucourt'),(2065,'7602','Bury'),(2066,'7603','Bon-Secours'),(2067,'7604','Baugnies'),(2068,'7604','Braffe'),(2069,'7604','Brasmenil'),(2070,'7604','Callenelle'),(2071,'7604','Wasmes-Audemez-Briffoeil'),(2072,'7608','Wiers'),(2073,'7610','RUMES'),(2074,'7611','La Glanerie'),(2075,'7618','Taintignies'),(2076,'7620','Bléharies'),(2077,'7620','Guignies'),(2078,'7620','Hollain'),(2079,'7620','Jollain-Merlin'),(2080,'7620','Wez-Velvain'),(2081,'7621','Lesdain'),(2082,'7622','Laplaigne'),(2083,'7623','Rongy'),(2084,'7624','Howardries'),(2085,'7640','ANTOING'),(2086,'7640','Maubray'),(2087,'7640','Péronnes-Lez-Antoing'),(2088,'7641','Bruyelle'),(2089,'7642','Calonne'),(2090,'7643','Fontenoy'),(2091,'7700','Luingne'),(2092,'7700','MOESKROEN'),(2093,'7711','Dottenijs'),(2094,'7712','Herseaux'),(2095,'7730','Bailleul'),(2096,'7730','Estaimbourg'),(2097,'7730','ESTAIMPUIS'),(2098,'7730','Evregnies'),(2099,'7730','Leers-Nord'),(2100,'7730','Néchin'),(2101,'7730','Saint-Léger'),(2102,'7740','PECQ'),(2103,'7740','Warcoing'),(2104,'7742','Hérinnes-Lez-Pecq'),(2105,'7743','Esquelmes'),(2106,'7743','Obigies'),(2107,'7750','Amougies'),(2108,'7750','Anseroeul'),(2109,'7750','Orroir'),(2110,'7750','Russeignies'),(2111,'7760','CELLES'),(2112,'7760','Escanaffles'),(2113,'7760','Molenbaix'),(2114,'7760','Popuelles'),(2115,'7760','Pottes'),(2116,'7760','Velaines'),(2117,'7780','Komen'),(2118,'7780','KOMEN-WAASTEN'),(2119,'7781','Houthem'),(2120,'7782','Ploegsteert'),(2121,'7783','Bizet'),(2122,'7784','Neerwaasten'),(2123,'7784','Waasten'),(2124,'7800','ATH'),(2125,'7800','Lanquesaint'),(2126,'7801','Irchonwelz'),(2127,'7802','Ormeignies'),(2128,'7803','Bouvignies'),(2129,'7804','Ostiches'),(2130,'7804','Rebaix'),(2131,'7810','Maffle'),(2132,'7811','Arbre'),(2133,'7812','Houtaing'),(2134,'7812','Ligne'),(2135,'7812','Mainvault'),(2136,'7812','Moulbaix'),(2137,'7812','Villers-Notre-Dame'),(2138,'7812','Villers-Saint-Amand'),(2139,'7822','Ghislenghien'),(2140,'7822','Isières'),(2141,'7822','Meslin-L\'Evêque'),(2142,'7823','Gibecq'),(2143,'7830','Bassilly'),(2144,'7830','Fouleng'),(2145,'7830','Gondregnies'),(2146,'7830','Graty'),(2147,'7830','Hellebecq'),(2148,'7830','Hoves'),(2149,'7830','SILLY'),(2150,'7830','Thoricourt'),(2151,'7850','EDINGEN'),(2152,'7850','Lettelingen'),(2153,'7850','Mark'),(2154,'7860','LESSINES'),(2155,'7861','Papignies'),(2156,'7861','Wannebecq'),(2157,'7862','Ogy'),(2158,'7863','Ghoy'),(2159,'7864','Deux-Acren'),(2160,'7866','Bois-De-Lessines'),(2161,'7866','Ollignies'),(2162,'7870','Bauffe'),(2163,'7870','Cambron-Saint-Vincent'),(2164,'7870','LENS'),(2165,'7870','Lombise'),(2166,'7870','Montignies-Lez-Lens'),(2167,'7880','VLOESBERG'),(2168,'7890','ELLEZELLES'),(2169,'7890','Lahamaide'),(2170,'7890','Wodecq'),(2171,'7900','Grandmetz'),(2172,'7900','LEUZE-EN-HAINAUT'),(2173,'7901','Thieulain'),(2174,'7903','Blicquy'),(2175,'7903','Chapelle-À-Oie'),(2176,'7903','Chapelle-À-Wattines'),(2177,'7904','Pipaix'),(2178,'7904','Tourpes'),(2179,'7904','Willaupuis'),(2180,'7906','Gallaix'),(2181,'7910','Anvaing'),(2182,'7910','Arc-Ainières'),(2183,'7910','Arc-Wattripont'),(2184,'7910','Cordes'),(2185,'7910','Ellignies-Lez-Frasnes'),(2186,'7910','Forest'),(2187,'7910','Wattripont'),(2188,'7911','Buissenal'),(2189,'7911','Frasnes-Lez-Buissenal'),(2190,'7911','Hacquegnies'),(2191,'7911','Herquegies'),(2192,'7911','Montroeul-Au-Bois'),(2193,'7911','Moustier'),(2194,'7911','Oeudeghien'),(2195,'7912','Dergneau'),(2196,'7912','Saint-Sauveur'),(2197,'7940','BRUGELETTE'),(2198,'7940','Cambron-Casteau'),(2199,'7941','Attre'),(2200,'7942','Mévergnies-Lez-Lens'),(2201,'7943','Gages'),(2202,'7950','CHIÈVRES'),(2203,'7950','Grosage'),(2204,'7950','Huissignies'),(2205,'7950','Ladeuze'),(2206,'7950','Tongre-Saint-Martin'),(2207,'7951','Tongre-Notre-Dame'),(2208,'7970','BELOEIL'),(2209,'7971','Basècles'),(2210,'7971','Ramegnies'),(2211,'7971','Thumaide'),(2212,'7971','Wadelincourt'),(2213,'7972','Aubechies'),(2214,'7972','Ellignies-Saint-Anne'),(2215,'7972','Quevaucamps'),(2216,'7973','Grandglise'),(2217,'7973','Stambruges'),(2218,'8000','BRUGGE'),(2219,'8000','Koolkerke'),(2220,'8020','Hertsberge'),(2221,'8020','OOSTKAMP'),(2222,'8020','Ruddervoorde'),(2223,'8020','Waardamme'),(2224,'8200','Sint-Andries'),(2225,'8200','Sint-Michiels'),(2226,'8210','Loppem'),(2227,'8210','Veldegem'),(2228,'8210','ZEDELGEM'),(2229,'8211','Aartrijke'),(2230,'8300','Knokke'),(2231,'8300','Westkapelle'),(2232,'8301','Heist-Aan-Zee'),(2233,'8301','Ramskapelle'),(2234,'8310','Assebroek'),(2235,'8310','Sint-Kruis'),(2236,'8340','DAMME'),(2237,'8340','Hoeke'),(2238,'8340','Lapscheure'),(2239,'8340','Moerkerke'),(2240,'8340','Oostkerke'),(2241,'8340','Sijsele'),(2242,'8370','BLANKENBERGE'),(2243,'8370','Uitkerke'),(2244,'8377','Houtave'),(2245,'8377','Meetkerke'),(2246,'8377','Nieuwmunster'),(2247,'8377','ZUIENKERKE'),(2248,'8380','Dudzele'),(2249,'8380','Lissewege'),(2250,'8380','Zeebrugge'),(2251,'8400','OOSTENDE'),(2252,'8400','Stene'),(2253,'8400','Zandvoorde'),(2254,'8420','DE HAAN'),(2255,'8420','Klemskerke'),(2256,'8420','Wenduine'),(2257,'8421','Vlissegem'),(2258,'8430','MIDDELKERKE'),(2259,'8431','Wilskerke'),(2260,'8432','Leffinge'),(2261,'8433','Mannekensvere'),(2262,'8433','Schore'),(2263,'8433','Sint-Pieters-Kapelle'),(2264,'8433','Slijpe'),(2265,'8434','Lombardsijde'),(2266,'8434','Westende'),(2267,'8450','BREDENE'),(2268,'8460','Ettelgem'),(2269,'8460','OUDENBURG'),(2270,'8460','Roksem'),(2271,'8460','Westkerke'),(2272,'8470','GISTEL'),(2273,'8470','Moere'),(2274,'8470','Snaaskerke'),(2275,'8470','Zevekote'),(2276,'8480','Bekegem'),(2277,'8480','Eernegem'),(2278,'8480','ICHTEGEM'),(2279,'8490','JABBEKE'),(2280,'8490','Snellegem'),(2281,'8490','Stalhille'),(2282,'8490','Varsenare'),(2283,'8490','Zerkegem'),(2284,'8500','KORTRIJK'),(2285,'8501','Bissegem'),(2286,'8501','Heule'),(2287,'8510','Bellegem'),(2288,'8510','Kooigem'),(2289,'8510','Marke'),(2290,'8510','Rollegem'),(2291,'8511','Aalbeke'),(2292,'8520','KUURNE'),(2293,'8530','HARELBEKE'),(2294,'8531','Bavikhove'),(2295,'8531','Hulste'),(2296,'8540','DEERLIJK'),(2297,'8550','ZWEVEGEM'),(2298,'8551','Heestert'),(2299,'8552','Moen'),(2300,'8553','Otegem'),(2301,'8554','Sint-Denijs'),(2302,'8560','Gullegem'),(2303,'8560','Moorsele'),(2304,'8560','WEVELGEM'),(2305,'8570','ANZEGEM'),(2306,'8570','Gijzelbrechtegem'),(2307,'8570','Ingooigem'),(2308,'8570','Vichte'),(2309,'8572','Kaster'),(2310,'8573','Tiegem'),(2311,'8580','AVELGEM'),(2312,'8581','Kerkhove'),(2313,'8581','Waarmaarde'),(2314,'8582','Outrijve'),(2315,'8583','Bossuit'),(2316,'8587','Helkijn'),(2317,'8587','Spiere'),(2318,'8600','Beerst'),(2319,'8600','DIKSMUIDE'),(2320,'8600','Driekapellen'),(2321,'8600','Esen'),(2322,'8600','Kaaskerke'),(2323,'8600','Keiem'),(2324,'8600','Lampernisse'),(2325,'8600','Leke'),(2326,'8600','Nieuwkapelle'),(2327,'8600','Oostkerke'),(2328,'8600','Oudekapelle'),(2329,'8600','Pervijze'),(2330,'8600','Sint-Jacobs-Kapelle'),(2331,'8600','Stuivekenskerke'),(2332,'8600','Vladslo'),(2333,'8600','Woumen'),(2334,'8610','Handzame'),(2335,'8610','KORTEMARK'),(2336,'8610','Werken'),(2337,'8610','Zarren'),(2338,'8620','NIEUWPOORT'),(2339,'8620','Ramskapelle'),(2340,'8620','Sint-Joris'),(2341,'8630','Avekapelle'),(2342,'8630','Booitshoeke'),(2343,'8630','Bulskamp'),(2344,'8630','De Moeren'),(2345,'8630','Eggewaartskapelle'),(2346,'8630','Houtem'),(2347,'8630','Steenkerke'),(2348,'8630','VEURNE'),(2349,'8630','Vinkem'),(2350,'8630','Wulveringem'),(2351,'8630','Zoutenaaie'),(2352,'8640','Oostvleteren'),(2353,'8640','Westvleteren'),(2354,'8640','Woesten'),(2355,'8647','Lo'),(2356,'8647','Noordschote'),(2357,'8647','Pollinkhove'),(2358,'8647','Reninge'),(2359,'8650','HOUTHULST'),(2360,'8650','Klerken'),(2361,'8650','Merkem'),(2362,'8660','Adinkerke'),(2363,'8660','DE PANNE'),(2364,'8670','KOKSIJDE'),(2365,'8670','Oostduinkerke'),(2366,'8670','Wulpen'),(2367,'8680','Bovekerke'),(2368,'8680','KOEKELARE'),(2369,'8680','Zande'),(2370,'8690','ALVERINGEM'),(2371,'8690','Hoogstade'),(2372,'8690','Oeren'),(2373,'8690','Sint-Rijkers'),(2374,'8691','Beveren-Aan-De-Ijzer'),(2375,'8691','Gijverinkhove'),(2376,'8691','Izenberge'),(2377,'8691','Leisele'),(2378,'8691','Stavele'),(2379,'8700','Aarsele'),(2380,'8700','Kanegem'),(2381,'8700','Schuiferskapelle'),(2382,'8700','TIELT'),(2383,'8710','Ooigem'),(2384,'8710','Sint-Baafs-Vijve'),(2385,'8710','WIELSBEKE'),(2386,'8720','DENTERGEM'),(2387,'8720','Markegem'),(2388,'8720','Oeselgem'),(2389,'8720','Wakken'),(2390,'8730','BEERNEM'),(2391,'8730','Oedelem'),(2392,'8730','Sint-Joris'),(2393,'8740','Egem'),(2394,'8740','PITTEM'),(2395,'8750','WINGENE'),(2396,'8750','Zwevezele'),(2397,'8755','RUISELEDE'),(2398,'8760','MEULEBEKE'),(2399,'8770','INGELMUNSTER'),(2400,'8780','OOSTROZEBEKE'),(2401,'8790','WAREGEM'),(2402,'8791','Beveren'),(2403,'8792','Desselgem'),(2404,'8793','Sint-Eloois-Vijve'),(2405,'8800','Beveren'),(2406,'8800','Oekene'),(2407,'8800','ROESELARE'),(2408,'8800','Rumbeke'),(2409,'8810','LICHTERVELDE'),(2410,'8820','TORHOUT'),(2411,'8830','Gits'),(2412,'8830','HOOGLEDE'),(2413,'8840','Oostnieuwkerke'),(2414,'8840','STADEN'),(2415,'8840','Westrozebeke'),(2416,'8850','ARDOOIE'),(2417,'8851','Koolskamp'),(2418,'8860','LENDELEDE'),(2419,'8870','Emelgem'),(2420,'8870','IZEGEM'),(2421,'8870','Kachtem'),(2422,'8880','LEDEGEM'),(2423,'8880','Rollegem-Kapelle'),(2424,'8880','Sint-Eloois-Winkel'),(2425,'8890','Dadizele'),(2426,'8890','MOORSLEDE'),(2427,'8900','Brielen'),(2428,'8900','Dikkebus'),(2429,'8900','IEPER'),(2430,'8900','Sint-Jan'),(2431,'8902','Hollebeke'),(2432,'8902','Voormezele'),(2433,'8902','Zillebeke'),(2434,'8904','Boezinge'),(2435,'8904','Zuidschote'),(2436,'8906','Elverdinge'),(2437,'8908','Vlamertinge'),(2438,'8920','Bikschote'),(2439,'8920','Langemark'),(2440,'8920','Poelkapelle'),(2441,'8930','Lauwe'),(2442,'8930','MENEN'),(2443,'8930','Rekkem'),(2444,'8940','Geluwe'),(2445,'8940','WERVIK'),(2446,'8950','Nieuwkerke'),(2447,'8951','Dranouter'),(2448,'8952','Wulvergem'),(2449,'8953','Wijtschate'),(2450,'8954','Westouter'),(2451,'8956','Kemmel'),(2452,'8957','MESEN'),(2453,'8958','Loker'),(2454,'8970','POPERINGE'),(2455,'8970','Reningelst'),(2456,'8972','Krombeke'),(2457,'8972','Proven'),(2458,'8972','Roesbrugge-Haringe'),(2459,'8978','Watou'),(2460,'8980','Beselare'),(2461,'8980','Geluveld'),(2462,'8980','Passendale'),(2463,'8980','Zandvoorde'),(2464,'8980','ZONNEBEKE'),(2465,'9000','GENT'),(2466,'9030','Mariakerke'),(2467,'9031','Drongen'),(2468,'9032','Wondelgem'),(2469,'9040','Sint-Amandsberg'),(2470,'9041','Oostakker'),(2471,'9042','Desteldonk'),(2472,'9042','Mendonk'),(2473,'9042','Sint-Kruis-Winkel'),(2474,'9050','Gentbrugge'),(2475,'9050','Ledeberg'),(2476,'9051','Afsnee'),(2477,'9051','Sint-Denijs-Westrem'),(2478,'9052','Zwijnaarde'),(2479,'9060','ZELZATE'),(2480,'9070','DESTELBERGEN'),(2481,'9070','Heusden'),(2482,'9080','Beervelde'),(2483,'9080','LOCHRISTI'),(2484,'9080','Zaffelare'),(2485,'9080','Zeveneken'),(2486,'9090','Gontrode'),(2487,'9090','MELLE'),(2488,'9099','Gent X'),(2489,'9100','Nieuwkerken-Waas'),(2490,'9100','SINT-NIKLAAS'),(2491,'9111','Belsele'),(2492,'9112','Sinaai-Waas'),(2493,'9120','BEVEREN-WAAS'),(2494,'9120','Haasdonk'),(2495,'9120','Kallo'),(2496,'9120','Melsele'),(2497,'9120','Vrasene'),(2498,'9130','Doel'),(2499,'9130','Kallo'),(2500,'9130','Kieldrecht'),(2501,'9130','Verrebroek'),(2502,'9140','Elversele'),(2503,'9140','Steendorp'),(2504,'9140','TEMSE'),(2505,'9140','Tielrode'),(2506,'9150','Bazel'),(2507,'9150','KRUIBEKE'),(2508,'9150','Rupelmonde'),(2509,'9160','Daknam'),(2510,'9160','Eksaarde'),(2511,'9160','LOKEREN'),(2512,'9170','De Klinge'),(2513,'9170','Meerdonk'),(2514,'9170','SINT-GILLIS-WAAS'),(2515,'9170','Sint-Pauwels'),(2516,'9180','MOERBEKE-WAAS'),(2517,'9185','WACHTEBEKE'),(2518,'9190','Kemzeke'),(2519,'9190','STEKENE'),(2520,'9200','Appels'),(2521,'9200','Baasrode'),(2522,'9200','DENDERMONDE'),(2523,'9200','Grembergen'),(2524,'9200','Mespelare'),(2525,'9200','Oudegem'),(2526,'9200','Schoonaarde'),(2527,'9200','Sint-Gillis-Dendermonde'),(2528,'9220','HAMME'),(2529,'9220','Moerzeke'),(2530,'9230','Massemen'),(2531,'9230','Westrem'),(2532,'9230','WETTEREN'),(2533,'9240','ZELE'),(2534,'9250','WAASMUNSTER'),(2535,'9255','BUGGENHOUT'),(2536,'9255','Opdorp'),(2537,'9260','Schellebelle'),(2538,'9260','Serskamp'),(2539,'9260','WICHELEN'),(2540,'9270','Kalken'),(2541,'9270','LAARNE'),(2542,'9280','Denderbelle'),(2543,'9280','LEBBEKE'),(2544,'9280','Wieze'),(2545,'9290','BERLARE'),(2546,'9290','Overmere'),(2547,'9290','Uitbergen'),(2548,'9300','AALST'),(2549,'9308','Gijzegem'),(2550,'9308','Hofstade'),(2551,'9310','Baardegem'),(2552,'9310','Herdersem'),(2553,'9310','Meldert'),(2554,'9310','Moorsel'),(2555,'9320','Erembodegem'),(2556,'9320','Nieuwerkerken'),(2557,'9340','Impe'),(2558,'9340','LEDE'),(2559,'9340','Oordegem'),(2560,'9340','Smetlede'),(2561,'9340','Wanzele'),(2562,'9400','Appelterre-Eichem'),(2563,'9400','Denderwindeke'),(2564,'9400','Lieferinge'),(2565,'9400','Nederhasselt'),(2566,'9400','NINOVE'),(2567,'9400','Okegem'),(2568,'9400','Voorde'),(2569,'9401','Pollare'),(2570,'9402','Meerbeke'),(2571,'9403','Neigem'),(2572,'9404','Aspelare'),(2573,'9406','Outer'),(2574,'9420','Aaigem'),(2575,'9420','Bambrugge'),(2576,'9420','Burst'),(2577,'9420','Erondegem'),(2578,'9420','Erpe'),(2579,'9420','Mere'),(2580,'9420','Ottergem'),(2581,'9420','Vlekkem'),(2582,'9450','Denderhoutem'),(2583,'9450','HAALTERT'),(2584,'9450','Heldergem'),(2585,'9451','Kerksken'),(2586,'9470','DENDERLEEUW'),(2587,'9472','Iddergem'),(2588,'9473','Welle'),(2589,'9500','GERAARDSBERGEN'),(2590,'9500','Goeferdinge'),(2591,'9500','Moerbeke'),(2592,'9500','Nederboelare'),(2593,'9500','Onkerzele'),(2594,'9500','Ophasselt'),(2595,'9500','Overboelare'),(2596,'9500','Viane'),(2597,'9500','Zarlardinge'),(2598,'9506','Grimminge'),(2599,'9506','Idegem'),(2600,'9506','Nieuwenhove'),(2601,'9506','Schendelbeke'),(2602,'9506','Smeerebbe-Vloerzegem'),(2603,'9506','Waarbeke'),(2604,'9506','Zandbergen'),(2605,'9520','Bavegem'),(2606,'9520','Oombergen'),(2607,'9520','SINT-LIEVENS-HOUTEM'),(2608,'9520','Vlierzele'),(2609,'9520','Zonnegem'),(2610,'9521','Letterhoutem'),(2611,'9550','HERZELE'),(2612,'9550','Hillegem'),(2613,'9550','Sint-Antelinks'),(2614,'9550','Sint-Lievens-Esse'),(2615,'9550','Steenhuize-Wijnhuize'),(2616,'9550','Woubrechtegem'),(2617,'9551','Ressegem'),(2618,'9552','Borsbeke'),(2619,'9570','Deftinge'),(2620,'9570','Sint-Maria-Lierde'),(2621,'9571','Hemelveerdegem'),(2622,'9572','Sint-Martens-Lierde'),(2623,'9600','RONSE'),(2624,'9620','Elene'),(2625,'9620','Erwetegem'),(2626,'9620','Godveerdegem'),(2627,'9620','Grotenberge'),(2628,'9620','Leeuwergem'),(2629,'9620','Oombergen'),(2630,'9620','Sint-Goriks-Oudenhove'),(2631,'9620','Sint-Maria-Oudenhove'),(2632,'9620','Strijpen'),(2633,'9620','Velzeke-Ruddershove'),(2634,'9620','ZOTTEGEM'),(2635,'9630','Beerlegem'),(2636,'9630','Dikkele'),(2637,'9630','Hundelgem'),(2638,'9630','Meilegem'),(2639,'9630','Munkzwalm'),(2640,'9630','Paulatem'),(2641,'9630','Roborst'),(2642,'9630','Rozebeke'),(2643,'9630','Sint-Blasius-Boekel'),(2644,'9630','Sint-Denijs-Boekel'),(2645,'9630','Sint-Maria-Latem'),(2646,'9636','Nederzwalm-Hermelgem'),(2647,'9660','BRAKEL'),(2648,'9660','Elst'),(2649,'9660','Everbeek'),(2650,'9660','Michelbeke'),(2651,'9660','Nederbrakel'),(2652,'9660','Opbrakel'),(2653,'9660','Sint-Maria-Oudenhove'),(2654,'9660','Zegelsem'),(2655,'9661','Parike'),(2656,'9667','Sint-Kornelis-Horebeke'),(2657,'9667','Sint-Maria-Horebeke'),(2658,'9680','Etikhove'),(2659,'9680','Maarke-Kerkem'),(2660,'9681','Nukerke'),(2661,'9688','Schorisse'),(2662,'9690','Berchem'),(2663,'9690','Kwaremont'),(2664,'9690','Ruien'),(2665,'9690','Zulzeke'),(2666,'9700','Bevere'),(2667,'9700','Edelare'),(2668,'9700','Eine'),(2669,'9700','Ename'),(2670,'9700','Heurne'),(2671,'9700','Leupegem'),(2672,'9700','Mater'),(2673,'9700','Melden'),(2674,'9700','Mullem'),(2675,'9700','Nederename'),(2676,'9700','Ooike'),(2677,'9700','OUDENAARDE'),(2678,'9700','Volkegem'),(2679,'9700','Welden'),(2680,'9750','Huise'),(2681,'9750','Ouwegem'),(2682,'9750','ZINGEM'),(2683,'9770','KRUISHOUTEM'),(2684,'9771','Nokere'),(2685,'9772','Wannegem-Lede'),(2686,'9790','Elsegem'),(2687,'9790','Moregem'),(2688,'9790','Ooike'),(2689,'9790','Petegem-Aan-De-Schelde'),(2690,'9790','Wortegem'),(2691,'9800','Astene'),(2692,'9800','Bachte-Maria-Leerne'),(2693,'9800','DEINZE'),(2694,'9800','Gottem'),(2695,'9800','Grammene'),(2696,'9800','Meigem'),(2697,'9800','Petegem-Aan-De-Leie'),(2698,'9800','Sint-Martens-Leerne'),(2699,'9800','Vinkt'),(2700,'9800','Wontergem'),(2701,'9800','Zeveren'),(2702,'9810','Eke'),(2703,'9810','NAZARETH'),(2704,'9820','Bottelare'),(2705,'9820','Lemberge'),(2706,'9820','Melsen'),(2707,'9820','MERELBEKE'),(2708,'9820','Munte'),(2709,'9820','Schelderode'),(2710,'9830','SINT-MARTENS-LATEM'),(2711,'9831','Deurle'),(2712,'9840','DE PINTE'),(2713,'9840','Zevergem'),(2714,'9850','Hansbeke'),(2715,'9850','Landegem'),(2716,'9850','Merendree'),(2717,'9850','NEVELE'),(2718,'9850','Poesele'),(2719,'9850','Vosselare'),(2720,'9860','Balegem'),(2721,'9860','Gijzenzele'),(2722,'9860','Landskouter'),(2723,'9860','Moortsele'),(2724,'9860','OOSTERZELE'),(2725,'9860','Scheldewindeke'),(2726,'9870','Machelen'),(2727,'9870','Olsene'),(2728,'9870','ZULTE'),(2729,'9880','AALTER'),(2730,'9880','Lotenhulle'),(2731,'9880','Poeke'),(2732,'9881','Bellem'),(2733,'9890','Asper'),(2734,'9890','Baaigem'),(2735,'9890','Dikkelvenne'),(2736,'9890','GAVERE'),(2737,'9890','Semmerzake'),(2738,'9890','Vurste'),(2739,'9900','EEKLO'),(2740,'9910','KNESSELARE'),(2741,'9910','Ursel'),(2742,'9920','LOVENDEGEM'),(2743,'9921','Vinderhoute'),(2744,'9930','ZOMERGEM'),(2745,'9931','Oostwinkel'),(2746,'9932','Ronsele'),(2747,'9940','Ertvelde'),(2748,'9940','EVERGEM'),(2749,'9940','Kluizen'),(2750,'9940','Sleidinge'),(2751,'9950','WAARSCHOOT'),(2752,'9960','ASSENEDE'),(2753,'9961','Boekhoute'),(2754,'9968','Bassevelde'),(2755,'9968','Oosteeklo'),(2756,'9970','KAPRIJKE'),(2757,'9971','Lembeke'),(2758,'9980','SINT-LAUREINS'),(2759,'9981','Sint-Margriete'),(2760,'9982','Sint-Jan-In-Eremo'),(2761,'9988','Waterland-Oudeman'),(2762,'9988','Watervliet'),(2763,'9990','MALDEGEM'),(2764,'9991','Adegem'),(2765,'9992','Middelburg');
/*!40000 ALTER TABLE `postcode` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `region`
--

DROP TABLE IF EXISTS `region`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `region` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(80) NOT NULL,
  `country_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `region_name_idx` (`name`),
  KEY `fk_region_country_idx` (`country_id`),
  CONSTRAINT `fk_region_country` FOREIGN KEY (`country_id`) REFERENCES `country` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `region`
--

LOCK TABLES `region` WRITE;
/*!40000 ALTER TABLE `region` DISABLE KEYS */;
INSERT INTO `region` (`id`, `name`, `country_id`) VALUES (1,'Speyside',103),(2,'France',73);
/*!40000 ALTER TABLE `region` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `whisky`
--

DROP TABLE IF EXISTS `whisky`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `whisky` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(60) DEFAULT NULL,
  `image_path` varchar(255) DEFAULT NULL,
  `region_id` int(11) DEFAULT NULL,
  `distillery_id` int(11) DEFAULT NULL,
  `price` int(11) DEFAULT NULL,
  `age` tinyint(4) DEFAULT NULL,
  `alcohol` int(11) DEFAULT NULL,
  `barrel_id` int(11) DEFAULT NULL,
  `view_count` int(11) DEFAULT NULL,
  `short_description` text,
  `review_date` datetime DEFAULT NULL,
  `bottlery_id` int(11) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `blend_id` int(11) DEFAULT NULL,
  `date_distilled` datetime DEFAULT NULL,
  `date_bottled` datetime DEFAULT NULL,
  `country_id` int(11) DEFAULT NULL,
  `capacity` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_whisky_barrel_idx` (`barrel_id`),
  KEY `fk_whisky_distillery_idx` (`distillery_id`),
  KEY `fk_whisky_region_idx` (`region_id`),
  KEY `whisky_name_idx` (`name`),
  KEY `fk_whisky_bottlery_idx` (`bottlery_id`),
  KEY `fk_whisky_country_idx` (`country_id`),
  KEY `fk_whisky_blend_idx` (`blend_id`),
  CONSTRAINT `fk_whisky_blend` FOREIGN KEY (`blend_id`) REFERENCES `blend` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_whisky_barrel` FOREIGN KEY (`barrel_id`) REFERENCES `barrel` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_whisky_bottlery` FOREIGN KEY (`bottlery_id`) REFERENCES `distillery` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_whisky_country` FOREIGN KEY (`country_id`) REFERENCES `country` (`id`),
  CONSTRAINT `fk_whisky_distillery` FOREIGN KEY (`distillery_id`) REFERENCES `distillery` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_whisky_region` FOREIGN KEY (`region_id`) REFERENCES `region` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `whisky`
--

LOCK TABLES `whisky` WRITE;
/*!40000 ALTER TABLE `whisky` DISABLE KEYS */;
INSERT INTO `whisky` (`id`, `name`, `image_path`, `region_id`, `distillery_id`, `price`, `age`, `alcohol`, `barrel_id`, `view_count`, `short_description`, `review_date`, `bottlery_id`, `created_by`, `blend_id`, `date_distilled`, `date_bottled`, `country_id`, `capacity`) VALUES (17,'Aberlour 15 years','aberlour-15-y.jpg',1,1,40,15,43,1,NULL,'Among going manor who did. Do ye is celebrated it sympathize considered. May ecstatic did surprise elegance the ignorant age. Own her miss cold last. It so numerous if he outlived disposal. How but sons mrs lady when. Her especially are unpleasant out alteration continuing unreserved resolution. Hence hopes noisy may china fully and. Am it regard stairs branch thirty length afford. ','1981-07-29 00:00:00',NULL,NULL,NULL,'0000-00-00 00:00:00','0000-00-00 00:00:00',NULL,0),(18,'Aberlour A Bunadh Batch 47','aberlour-a-bunadh-batch-47.jpg',1,1,60,47,60,1,NULL,'He difficult contented we determine ourselves me am earnestly. Hour no find it park. Eat welcomed any husbands moderate. Led was misery played waited almost cousin living. Of intention contained is by middleton am. Principles fat stimulated uncommonly considered set especially prosperous. Sons at park mr meet as fact like.','2011-11-11 00:00:00',NULL,NULL,NULL,'0000-00-00 00:00:00','0000-00-00 00:00:00',NULL,0),(19,'Aberlour 12 years double cask','aberlour-12-y-double-cask.jpg',1,1,3999,12,40,1,NULL,'I would be thrilled to come in for an interview at your earliest convenience.','2014-12-16 00:00:00',NULL,NULL,NULL,'0000-00-00 00:00:00','0000-00-00 00:00:00',NULL,0),(20,'Aberlour 18 years','aberlour-18-y.jpg',1,1,6499,18,43,1,NULL,'Am of mr friendly by strongly peculiar juvenile. Unpleasant it sufficient simplicity am by friendship no inhabiting. Goodness doubtful material has denoting suitable she two. Dear mean she way and poor bred they come. He otherwise me incommode explained so in remaining. Polite barton in it warmly do county length an. ','2008-06-07 00:00:00',NULL,NULL,NULL,'0000-00-00 00:00:00','0000-00-00 00:00:00',NULL,0),(21,'Calvados ch.breuil fine 3 jr','calvados-ch-breuil-fine-3-jr.jpg',2,2,1749,3,40,2,NULL,'Bed sincerity yet therefore forfeited his certainty neglected questions. Pursuit chamber as elderly amongst on. Distant however warrant farther to of. My justice wishing prudent waiting in be. Comparison age not pianoforte increasing delightful now. Insipidity sufficient dispatched any reasonably led ask. Announcing if attachment resolution sentiments admiration me on diminution. ','2014-08-05 00:00:00',NULL,NULL,NULL,'1988-11-30 00:00:00','1993-11-30 00:00:00',NULL,70);
/*!40000 ALTER TABLE `whisky` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `whisky_like`
--

DROP TABLE IF EXISTS `whisky_like`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `whisky_like` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `whisky_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `idx_whisky_user_UNIQUE` (`whisky_id`,`user_id`),
  KEY `fk_whiskylike_whisky_idx` (`whisky_id`),
  KEY `fk_whiskylike_user_idx` (`user_id`),
  CONSTRAINT `fk_whiskylike_user` FOREIGN KEY (`user_id`) REFERENCES `whisky_user` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_whiskylike_whisky` FOREIGN KEY (`whisky_id`) REFERENCES `whisky` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `whisky_like`
--

LOCK TABLES `whisky_like` WRITE;
/*!40000 ALTER TABLE `whisky_like` DISABLE KEYS */;
INSERT INTO `whisky_like` (`id`, `whisky_id`, `user_id`) VALUES (12,NULL,NULL),(13,NULL,NULL),(9,17,28),(10,18,29),(4,19,29),(5,19,30),(6,20,28),(7,20,30),(8,20,31),(11,21,30);
/*!40000 ALTER TABLE `whisky_like` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `whisky_score`
--

DROP TABLE IF EXISTS `whisky_score`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `whisky_score` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `score` tinyint(4) DEFAULT NULL,
  `whisky_id` int(11) DEFAULT NULL,
  `category_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `idx_whisky_category_UNIQUE` (`whisky_id`,`category_id`),
  KEY `fk_whiskyscore_category_idx` (`category_id`),
  CONSTRAINT `fk_whiskyscore_category` FOREIGN KEY (`category_id`) REFERENCES `category` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_whiskyscore_whisky` FOREIGN KEY (`whisky_id`) REFERENCES `whisky` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `whisky_score`
--

LOCK TABLES `whisky_score` WRITE;
/*!40000 ALTER TABLE `whisky_score` DISABLE KEYS */;
/*!40000 ALTER TABLE `whisky_score` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `whisky_user`
--

DROP TABLE IF EXISTS `whisky_user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `whisky_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(12) NOT NULL,
  `email` varchar(255) NOT NULL,
  `enabled` tinyint(4) DEFAULT '1',
  `password` varchar(60) NOT NULL,
  `last_login` datetime DEFAULT NULL,
  `first_name` varchar(45) DEFAULT NULL,
  `surname` varchar(80) DEFAULT NULL,
  `postcode_id` int(11) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `can_review` tinyint(4) DEFAULT '0',
  `can_create_category` tinyint(4) DEFAULT '0',
  `can_create_event` tinyint(4) DEFAULT '0',
  `is_admin` tinyint(4) DEFAULT '0',
  `password_token` varchar(64) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email_UNIQUE` (`email`),
  UNIQUE KEY `username_UNIQUE` (`username`),
  KEY `fk_whisky_user_postcode_idx` (`postcode_id`),
  CONSTRAINT `fk_user_postcode` FOREIGN KEY (`postcode_id`) REFERENCES `postcode` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `whisky_user`
--

LOCK TABLES `whisky_user` WRITE;
/*!40000 ALTER TABLE `whisky_user` DISABLE KEYS */;
INSERT INTO `whisky_user` (`id`, `username`, `email`, `enabled`, `password`, `last_login`, `first_name`, `surname`, `postcode_id`, `address`, `can_review`, `can_create_category`, `can_create_event`, `is_admin`, `password_token`) VALUES (28,'aaa','devel.janvb@gmail.com',1,'$2y$10$bBRMfdnm6wQ6Ziw8uLeI6uTcZeH4491Krecy5i3mbWRAUub3XBsJy','2015-01-26 16:02:49','aaa','aaa',938,'street',NULL,NULL,NULL,1,'107421593354c61a0ab7f664.38652604'),(29,'janvb','janvb@pandora.be',1,'$2y$10$122V33NlB5CX5FDsWtueWOiQKDYCHpPT88IFfmGIkDxvTKQfaLhba','2015-01-20 15:26:00','jan','van biervliet',273,'Palmbomenlaan 16',NULL,NULL,NULL,NULL,NULL),(30,'bbb','bbb@bb.be',1,'$2y$10$snVIgs973wa4zLTlm9MnSecS0Oz1Mpd3SBF/kCg9assILMkKQ7vwi',NULL,'bbb','bbb',25,'bbb',NULL,NULL,NULL,NULL,NULL),(31,'zzz','zzz@zzz.zz',1,'$2y$10$Th2OBH215Onhdvc1mqG5zOihbepm2gSSK3tVpFU2wKxhmmsL0OJQK','2015-01-22 13:21:22','zzz','zzz',1,'zzz',NULL,NULL,NULL,NULL,NULL),(32,'Joeki','joeribroos@gmail.com',1,'$2y$10$xC0AyqleOd/1UE33xtWgYeSLqf45xdBczSRUl7sKXK7kfKt2pfCJC','2015-01-26 09:17:12','Joeri','Broos',272,'Somersstraat 20',1,1,1,1,NULL);
/*!40000 ALTER TABLE `whisky_user` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2015-01-26 19:33:02
