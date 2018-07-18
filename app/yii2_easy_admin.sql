-- MySQL dump 10.13  Distrib 5.7.22, for Linux (x86_64)
--
-- Host: localhost    Database: yii2_easy_admin
-- ------------------------------------------------------
-- Server version	5.7.22-0ubuntu0.16.04.1

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
-- Table structure for table `yea_auth_assignment`
--

DROP TABLE IF EXISTS `yea_auth_assignment`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `yea_auth_assignment` (
  `item_name` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`item_name`,`user_id`),
  KEY `auth_assignment_user_id_idx` (`user_id`),
  CONSTRAINT `yea_auth_assignment_ibfk_1` FOREIGN KEY (`item_name`) REFERENCES `yea_auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `yea_auth_assignment`
--

LOCK TABLES `yea_auth_assignment` WRITE;
/*!40000 ALTER TABLE `yea_auth_assignment` DISABLE KEYS */;
INSERT INTO `yea_auth_assignment` VALUES ('admin','1',NULL),('admin','2',1528699351),('author','16',1528876557),('contributor','23',1528876589),('editor','18',1528575561),('editor','19',NULL),('subscriber','17',NULL),('subscriber','24',1528313661),('subscriber','26',1529407872);
/*!40000 ALTER TABLE `yea_auth_assignment` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `yea_auth_item`
--

DROP TABLE IF EXISTS `yea_auth_item`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `yea_auth_item` (
  `name` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` smallint(6) NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `rule_name` varchar(64) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `data` blob,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`name`),
  KEY `rule_name` (`rule_name`),
  KEY `idx-auth_item-type` (`type`),
  CONSTRAINT `yea_auth_item_ibfk_1` FOREIGN KEY (`rule_name`) REFERENCES `yea_auth_rule` (`name`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `yea_auth_item`
--

LOCK TABLES `yea_auth_item` WRITE;
/*!40000 ALTER TABLE `yea_auth_item` DISABLE KEYS */;
INSERT INTO `yea_auth_item` VALUES ('admin',1,'admin can manage website settings',NULL,NULL,1528099706,1528099706),('author',1,'author can publish own post',NULL,NULL,1528099706,1528099706),('contributor',1,'contributor can edit own post and delete own post',NULL,NULL,1528099706,1528099706),('editor',1,'editor can manage all content, include page and others',NULL,NULL,1528099706,1528099706),('subscriber',1,'subscriber can only read and edit profile',NULL,NULL,1528099706,1528099706);
/*!40000 ALTER TABLE `yea_auth_item` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `yea_auth_item_child`
--

DROP TABLE IF EXISTS `yea_auth_item_child`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `yea_auth_item_child` (
  `parent` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `child` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`parent`,`child`),
  KEY `child` (`child`),
  CONSTRAINT `yea_auth_item_child_ibfk_1` FOREIGN KEY (`parent`) REFERENCES `yea_auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `yea_auth_item_child_ibfk_2` FOREIGN KEY (`child`) REFERENCES `yea_auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `yea_auth_item_child`
--

LOCK TABLES `yea_auth_item_child` WRITE;
/*!40000 ALTER TABLE `yea_auth_item_child` DISABLE KEYS */;
INSERT INTO `yea_auth_item_child` VALUES ('editor','author'),('author','contributor'),('admin','editor'),('contributor','subscriber');
/*!40000 ALTER TABLE `yea_auth_item_child` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `yea_auth_rule`
--

DROP TABLE IF EXISTS `yea_auth_rule`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `yea_auth_rule` (
  `name` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `data` blob,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `yea_auth_rule`
--

LOCK TABLES `yea_auth_rule` WRITE;
/*!40000 ALTER TABLE `yea_auth_rule` DISABLE KEYS */;
/*!40000 ALTER TABLE `yea_auth_rule` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `yea_category`
--

DROP TABLE IF EXISTS `yea_category`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `yea_category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `desc` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` smallint(6) DEFAULT NULL,
  `parent_id` int(11) DEFAULT '0',
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `idx-category-status` (`status`),
  KEY `idx-category-parent_id` (`parent_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `yea_category`
--

LOCK TABLES `yea_category` WRITE;
/*!40000 ALTER TABLE `yea_category` DISABLE KEYS */;
INSERT INTO `yea_category` VALUES (2,'china','a big country',1,0,1530425271,1530425271),(3,'USA','the most powerful country',2,0,1530425303,1530425314),(4,'guangdong','Guangdong Province',1,2,1530427219,1530427219),(5,'guangzhou','Guangzhou',1,4,1530427319,1530427319),(6,'Washington','Washington 123',2,3,1530427363,1530427363);
/*!40000 ALTER TABLE `yea_category` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `yea_category_post`
--

DROP TABLE IF EXISTS `yea_category_post`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `yea_category_post` (
  `category_id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL,
  PRIMARY KEY (`category_id`,`post_id`),
  KEY `fk-category_post-post_id` (`post_id`),
  CONSTRAINT `fk-category_post-category_id` FOREIGN KEY (`category_id`) REFERENCES `yea_category` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk-category_post-post_id` FOREIGN KEY (`post_id`) REFERENCES `yea_post` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `yea_category_post`
--

LOCK TABLES `yea_category_post` WRITE;
/*!40000 ALTER TABLE `yea_category_post` DISABLE KEYS */;
INSERT INTO `yea_category_post` VALUES (2,3),(4,3),(2,4);
/*!40000 ALTER TABLE `yea_category_post` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `yea_feedback`
--

DROP TABLE IF EXISTS `yea_feedback`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `yea_feedback` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `content` longtext COLLATE utf8mb4_unicode_ci,
  `score` smallint(6) DEFAULT NULL,
  `created_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `idx-feedback-user_id` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `yea_feedback`
--

LOCK TABLES `yea_feedback` WRITE;
/*!40000 ALTER TABLE `yea_feedback` DISABLE KEYS */;
INSERT INTO `yea_feedback` VALUES (5,1,'vvv','<p>sss<strong>fff</strong></p>',5,1528552144),(6,1,'ggg','<p><img src=\"../upload/avatar/dog.jpg\" alt=\"dog.jpg (66 KB)\" width=\"120\" height=\"120\" /><img class=\"emojione\" title=\":tractor:\" src=\"https://cdn.jsdelivr.net/emojione/assets/3.1/png/32/1f69c.png\" alt=\"?\" /><img class=\"emojione\" title=\":star_of_david:\" src=\"https://cdn.jsdelivr.net/emojione/assets/3.1/png/32/2721.png\" alt=\"✡️\" />aaa bbb<img class=\"emojione\" title=\":accept:\" src=\"https://cdn.jsdelivr.net/emojione/assets/3.1/png/32/1f251.png\" alt=\"?\" /><img class=\"emojione\" title=\":grinning:\" src=\"https://cdn.jsdelivr.net/emojione/assets/3.1/png/32/1f600.png\" alt=\"?\" /><img class=\"emojione\" title=\":monkey_face:\" src=\"https://cdn.jsdelivr.net/emojione/assets/3.1/png/32/1f435.png\" alt=\"?\" /><img class=\"emojione\" title=\":metro:\" src=\"https://cdn.jsdelivr.net/emojione/assets/3.1/png/32/1f687.png\" alt=\"?\" /><img class=\"emojione\" title=\":rabbit:\" src=\"https://cdn.jsdelivr.net/emojione/assets/3.1/png/32/1f430.png\" alt=\"?\" /><img class=\"emojione\" title=\":unicorn:\" src=\"https://cdn.jsdelivr.net/emojione/assets/3.1/png/32/1f984.png\" alt=\"?\" /><img src=\"../upload/avatar/00.jpg\" alt=\"00.jpg (8 KB)\" width=\"80\" height=\"80\" /><a title=\"cat.jpg (5 KB)\" href=\"../upload/avatar/cat.jpg\">cat.jpg (5 KB)<img class=\"emojione\" title=\":heart_eyes:\" src=\"https://cdn.jsdelivr.net/emojione/assets/3.1/png/32/1f60d.png\" alt=\"?\" /><img class=\"emojione\" title=\":rage:\" src=\"https://cdn.jsdelivr.net/emojione/assets/3.1/png/32/1f621.png\" alt=\"?\" /></a></p>\r\n<p><a title=\"cat.jpg (5 KB)\" href=\"../upload/avatar/cat.jpg\"><img src=\"../upload/avatar/c__5b227dbb84ed7.jpg\" alt=\"girl\" width=\"161\" height=\"161\" /><strong>aaabbb</strong></a></p>\r\n<h2><strong>aaabbbccc</strong></h2>\r\n<p><strong><video controls=\"controls\" width=\"600\" height=\"300\">\r\n<source src=\"../upload/temp/xvideos.com_54178f96cb485f6ad7ffce8914e75f9d.mp4\" type=\"video/mp4\" /></video></strong></p>',4,1528552442);
/*!40000 ALTER TABLE `yea_feedback` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `yea_inmail`
--

DROP TABLE IF EXISTS `yea_inmail`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `yea_inmail` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sender` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `receivers` text COLLATE utf8mb4_unicode_ci,
  `subject` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `content` longtext COLLATE utf8mb4_unicode_ci,
  `created_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `idx-inmail-sender` (`sender`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `yea_inmail`
--

LOCK TABLES `yea_inmail` WRITE;
/*!40000 ALTER TABLE `yea_inmail` DISABLE KEYS */;
INSERT INTO `yea_inmail` VALUES (3,'qqq','vvv1:nnn','Are you ok?','<p>Yes, I am.</p>',1529488564),(4,'aaa','qqq:sdf','how do you do','<p>yes</p>',1529488708),(5,'aaa','qqq:www','prepare for test env','<p>test env is important<img src=\"../upload/avatar/c__5b227dbb84ed7.jpg\" alt=\"c__5b227dbb84ed7.jpg (156 KB)\" width=\"130\" height=\"130\" /></p>\r\n<p><img class=\"emojione\" title=\":grin:\" src=\"https://cdn.jsdelivr.net/emojione/assets/3.1/png/32/1f601.png\" alt=\"?\" /><img class=\"emojione\" title=\":grin:\" src=\"https://cdn.jsdelivr.net/emojione/assets/3.1/png/32/1f601.png\" alt=\"?\" /><img class=\"emojione\" title=\":laughing:\" src=\"https://cdn.jsdelivr.net/emojione/assets/3.1/png/32/1f606.png\" alt=\"?\" /></p>',1529505624);
/*!40000 ALTER TABLE `yea_inmail` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `yea_inmail_received`
--

DROP TABLE IF EXISTS `yea_inmail_received`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `yea_inmail_received` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sent_id` int(11) DEFAULT NULL,
  `sender` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `receivers` text COLLATE utf8mb4_unicode_ci,
  `receiver` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `subject` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `content` longtext COLLATE utf8mb4_unicode_ci,
  `created_at` int(11) DEFAULT NULL,
  `read_at` int(11) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `idx-inmail_received-sent_id` (`sent_id`),
  KEY `idx-inmail_received-sender` (`sender`),
  KEY `idx-inmail_received-receiver` (`receiver`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `yea_inmail_received`
--

LOCK TABLES `yea_inmail_received` WRITE;
/*!40000 ALTER TABLE `yea_inmail_received` DISABLE KEYS */;
INSERT INTO `yea_inmail_received` VALUES (1,2,'qqq','hhh:www','hhh','hello','<p>world</p>',1529488054,0),(2,2,'qqq','hhh:www','www','hello','<p>world</p>',1529488054,1529505863),(3,3,'qqq','vvv1:nnn','vvv1','Are you ok?','<p>Yes, I am.</p>',1529488564,0),(4,3,'qqq','vvv1:nnn','nnn','Are you ok?','<p>Yes, I am.</p>',1529488564,0),(5,4,'aaa','qqq:sdf','qqq','how do you do','<p>yes</p>',1529488708,1529505808),(6,4,'aaa','qqq:sdf','sdf','how do you do','<p>yes</p>',1529488708,0),(7,5,'aaa','qqq:www','qqq','prepare for test env','<p>test env is important<img src=\"../upload/avatar/c__5b227dbb84ed7.jpg\" alt=\"c__5b227dbb84ed7.jpg (156 KB)\" width=\"130\" height=\"130\" /></p>\r\n<p><img class=\"emojione\" title=\":grin:\" src=\"https://cdn.jsdelivr.net/emojione/assets/3.1/png/32/1f601.png\" alt=\"?\" /><img class=\"emojione\" title=\":grin:\" src=\"https://cdn.jsdelivr.net/emojione/assets/3.1/png/32/1f601.png\" alt=\"?\" /><img class=\"emojione\" title=\":laughing:\" src=\"https://cdn.jsdelivr.net/emojione/assets/3.1/png/32/1f606.png\" alt=\"?\" /></p>',1529505624,1529505681),(8,5,'aaa','qqq:www','www','prepare for test env','<p>test env is important<img src=\"../upload/avatar/c__5b227dbb84ed7.jpg\" alt=\"c__5b227dbb84ed7.jpg (156 KB)\" width=\"130\" height=\"130\" /></p>\r\n<p><img class=\"emojione\" title=\":grin:\" src=\"https://cdn.jsdelivr.net/emojione/assets/3.1/png/32/1f601.png\" alt=\"?\" /><img class=\"emojione\" title=\":grin:\" src=\"https://cdn.jsdelivr.net/emojione/assets/3.1/png/32/1f601.png\" alt=\"?\" /><img class=\"emojione\" title=\":laughing:\" src=\"https://cdn.jsdelivr.net/emojione/assets/3.1/png/32/1f606.png\" alt=\"?\" /></p>',1529505624,1529505870);
/*!40000 ALTER TABLE `yea_inmail_received` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `yea_media`
--

DROP TABLE IF EXISTS `yea_media`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `yea_media` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` smallint(6) DEFAULT NULL,
  `visibility` smallint(6) DEFAULT NULL,
  `author_id` int(11) DEFAULT NULL,
  `upload_path` varchar(1000) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mime` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `caption` text COLLATE utf8mb4_unicode_ci,
  `alt` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `desc` text COLLATE utf8mb4_unicode_ci,
  `width` int(11) DEFAULT NULL,
  `height` int(11) DEFAULT NULL,
  `size` int(11) DEFAULT NULL,
  `originName` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `thumb_path` varchar(1000) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mime_icon` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `idx-media-author_id` (`author_id`),
  KEY `idx-media-status` (`status`),
  KEY `idx-media-visibility` (`visibility`),
  KEY `idx-media-mime` (`mime`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `yea_media`
--

LOCK TABLES `yea_media` WRITE;
/*!40000 ALTER TABLE `yea_media` DISABLE KEYS */;
INSERT INTO `yea_media` VALUES (11,'阿里巴巴Java开发手册',1,1,2,'/upload/media/阿里巴巴Java开发手册_5b3f60d753a74.pdf','application/pdf',NULL,NULL,NULL,NULL,NULL,985403,'阿里巴巴Java开发手册.pdf',NULL,'pdf',1530880215,1530880215),(12,'php',1,1,2,'/upload/media/php_5b3f60ddb0a72.jpg','image/jpeg',NULL,NULL,NULL,300,440,22044,'php.jpg','/upload/media/.thumb/php_5b3f60ddb0a72.jpg','jpeg',1530880221,1530880221),(13,'FastDFS介绍与部署',1,1,2,'/upload/media/FastDFS介绍与部署_5b3f60f217289.docx','application/vnd.openxmlformats-officedocument.wordprocessingml.document',NULL,NULL,NULL,NULL,NULL,707086,'FastDFS介绍与部署.docx',NULL,'docx',1530880242,1530880242),(14,'hello',1,1,2,'/upload/media/hello_5b3f60fc07f5a.txt','text/plain',NULL,NULL,NULL,NULL,NULL,6,'hello.txt',NULL,'txt',1530880252,1530880252),(15,'cat',1,1,2,'/upload/media/cat_5b3f6111b3018.jpg','image/jpeg',NULL,NULL,NULL,200,200,4991,'cat.jpg','/upload/media/.thumb/cat_5b3f6111b3018.jpg','jpeg',1530880273,1530880273),(16,'00',1,1,2,'/upload/media/00_5b3f61719b4dd.jpg','image/jpeg',NULL,NULL,NULL,121,121,8117,'00.jpg','/upload/media/.thumb/00_5b3f61719b4dd.jpg','jpeg',1530880369,1530880369);
/*!40000 ALTER TABLE `yea_media` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `yea_menu`
--

DROP TABLE IF EXISTS `yea_menu`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `yea_menu` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `label` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `icon` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `url` varchar(1000) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `order` smallint(6) DEFAULT '0',
  `parent_id` int(11) DEFAULT '0',
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `idx_menu_parent_id` (`parent_id`)
) ENGINE=InnoDB AUTO_INCREMENT=35 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `yea_menu`
--

LOCK TABLES `yea_menu` WRITE;
/*!40000 ALTER TABLE `yea_menu` DISABLE KEYS */;
INSERT INTO `yea_menu` VALUES (10,'Gii','file-code-o','/gii',1,0,1528730261,1528801488),(11,'Debug','dashboard','/debug',2,0,1528730303,1528801516),(12,'Some tools','wrench','#',3,0,1528730344,1528801527),(13,'Gii','file-code-o','/gii',1,12,1528730381,1528802148),(14,'Debug','dashboard','/debug',2,12,1528730415,1528802148),(15,'Level One','circle-o','#',3,12,1528730460,1528802138),(16,'Level Two','circle-o','#',0,15,1528740012,1528740012),(17,'Level Two','circle-o','#',0,15,1528740047,1528740047),(18,'Users','user-circle','/user/index',4,0,1528740089,1528802098),(19,'Menus','bars','/menu/index',6,0,1528740138,1528802110),(20,'Feedback','comment','/feedback/index',7,0,1528740174,1528802110),(21,'Roles','users','/role/index',5,0,1528751256,1528802098),(22,'OperationLogs','file','/operation-log/index',8,0,1529403230,1529403277),(23,'Inmails','envelope','#',9,0,1529419218,1529419253),(24,'Inbox','inbox','/inmail-received/index',1,23,1529419354,1529486621),(25,'Sent','send','/inmail/index',2,23,1529419450,1529486580),(26,'CMS','newspaper-o','#',10,0,1529578277,1529579009),(27,'Category','navicon','/category/index',1,26,1529578379,1529578584),(28,'Tag','tags','/tag/index',2,26,1529578626,1529578626),(29,'Post','file-text-o','/post/index',3,26,1529579162,1529579282),(30,'Page','file-o','/page/index',4,26,1529579251,1529579251),(31,'Media','file-image-o','/media/index',5,26,1529579377,1530798393),(32,'Comment','commenting-o','/comment/index',6,26,1529579508,1529579508),(33,'Like','thumbs-o-up','/like/index',7,26,1529579596,1529579596),(34,'NavigationMenu','navicon','/nav-menu/index',8,26,1530785056,1530785099);
/*!40000 ALTER TABLE `yea_menu` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `yea_migration`
--

DROP TABLE IF EXISTS `yea_migration`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `yea_migration` (
  `version` varchar(180) COLLATE utf8mb4_unicode_ci NOT NULL,
  `apply_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`version`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `yea_migration`
--

LOCK TABLES `yea_migration` WRITE;
/*!40000 ALTER TABLE `yea_migration` DISABLE KEYS */;
INSERT INTO `yea_migration` VALUES ('m000000_000000_base',1527693560),('m140506_102106_rbac_init',1528047398),('m170907_052038_rbac_add_index_on_auth_assignment_user_id',1528047398),('m180530_151123_create_user_table',1527708310),('m180601_023634_create_option_table',1527826086),('m180603_160553_create_menu_table',1528047410),('m180603_163240_create_junction_role_and_menu',1528047411),('m180603_181812_create_operation_log_table',1528052414),('m180603_190137_create_user_profile_table',1528053383),('m180604_065513_init_rbac_data',1528099706),('m180609_125201_create_feedback_table',1528549733),('m180619_095106_create_inmail_table',1529485349),('m180620_090337_create_inmail_received_table',1529485784),('m180622_164251_create_tag_table',1529688080),('m180701_055136_create_category_table',1530424979),('m180701_090907_create_post_table',1530436650),('m180701_092010_create_junction_tag_and_post',1530437735),('m180701_094655_create_junction_category_and_post',1530438559),('m180705_115450_create_media_table',1530873769),('m180706_191412_create_nav_menu_table',1530970569),('m180708_184248_create_nav_menu_item_table',1531204297);
/*!40000 ALTER TABLE `yea_migration` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `yea_nav_menu`
--

DROP TABLE IF EXISTS `yea_nav_menu`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `yea_nav_menu` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `desc` text COLLATE utf8mb4_unicode_ci,
  `location` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` smallint(6) DEFAULT NULL,
  `item_tree` json DEFAULT NULL,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `idx-nav_menu-status` (`status`),
  KEY `idx-nav_menu-location` (`location`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `yea_nav_menu`
--

LOCK TABLES `yea_nav_menu` WRITE;
/*!40000 ALTER TABLE `yea_nav_menu` DISABLE KEYS */;
INSERT INTO `yea_nav_menu` VALUES (4,'top menu','show at top','top',1,'[{\"id\": 1531074783315, \"children\": [{\"id\": 1531074644847}]}, {\"id\": 1531074782735, \"children\": [{\"id\": 1531074645606}]}]',1531074649,1531206549),(5,'top menu','menu at top','top',1,'[{\"id\": 1531207646451, \"children\": [{\"id\": 1531207732931}]}, {\"id\": 1531207660804}, {\"id\": 1531207661258}]',1531207763,1531207763);
/*!40000 ALTER TABLE `yea_nav_menu` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `yea_nav_menu_item`
--

DROP TABLE IF EXISTS `yea_nav_menu_item`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `yea_nav_menu_item` (
  `pk_id` int(11) NOT NULL AUTO_INCREMENT,
  `id` bigint(20) DEFAULT NULL,
  `label` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `icon` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `action` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `target` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `extra` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `menu_id` int(11) DEFAULT NULL,
  `status` smallint(6) DEFAULT NULL,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`pk_id`),
  KEY `idx-nav_menu_item-id` (`id`),
  KEY `idx-nav_menu_item-status` (`status`),
  KEY `fk-nav_menu_item-menu_id` (`menu_id`),
  CONSTRAINT `fk-nav_menu_item-menu_id` FOREIGN KEY (`menu_id`) REFERENCES `yea_nav_menu` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `yea_nav_menu_item`
--

LOCK TABLES `yea_nav_menu_item` WRITE;
/*!40000 ALTER TABLE `yea_nav_menu_item` DISABLE KEYS */;
INSERT INTO `yea_nav_menu_item` VALUES (18,1531074783315,'ee','rr','','','',4,NULL,1531206549,1531206549),(19,1531074644847,'xx','zz','','','',4,NULL,1531206549,1531206549),(20,1531074782735,'gg','hh','','','',4,NULL,1531206549,1531206549),(21,1531074645606,'hh','jj','','','',4,NULL,1531206549,1531206549),(22,1531207646451,'home','home','','','',5,NULL,1531207763,1531207763),(23,1531207732931,'latest','latest','','','',5,NULL,1531207763,1531207763),(24,1531207660804,'archive','archive','','','',5,NULL,1531207763,1531207763),(25,1531207661258,'about','about','','','',5,NULL,1531207763,1531207763);
/*!40000 ALTER TABLE `yea_nav_menu_item` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `yea_operation_log`
--

DROP TABLE IF EXISTS `yea_operation_log`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `yea_operation_log` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `created_at` int(11) DEFAULT NULL,
  `ip` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `path` varchar(1000) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `input` text COLLATE utf8mb4_unicode_ci,
  `method` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `idx-operation_log-user_id` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=198 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `yea_operation_log`
--

LOCK TABLES `yea_operation_log` WRITE;
/*!40000 ALTER TABLE `yea_operation_log` DISABLE KEYS */;
INSERT INTO `yea_operation_log` VALUES (3,2,1529406133,'127.0.0.1','site/login','{\"LoginForm\":{\"username\":\"qqq\",\"password\":\"111\",\"rememberMe\":\"1\"}}','POST','User qqq is logged in'),(4,2,1529406402,'127.0.0.1','site/logout','[]','POST','User qqq is logged out.'),(5,17,1529406438,'127.0.0.1','site/login','{\"LoginForm\":{\"username\":\"www\",\"password\":\"111\",\"rememberMe\":\"1\"}}','POST','User www is logged in.'),(6,17,1529406453,'127.0.0.1','site/logout','[]','POST','User www is logged out.'),(7,2,1529406458,'127.0.0.1','site/login','{\"LoginForm\":{\"username\":\"qqq\",\"password\":\"111\",\"rememberMe\":\"1\"}}','POST','User qqq is logged in.'),(8,2,1529407471,'127.0.0.1','site/logout','[]','POST','User qqq is logged out.'),(9,25,1529407507,'127.0.0.1','site/register','{\"RegisterForm\":{\"username\":\"kkk\",\"email\":\"kkk@111.com\",\"password\":\"111\",\"passwordRepeat\":\"111\"},\"register-button\":\"\"}','POST','User kkk registers.'),(13,2,1529407913,'127.0.0.1','site/login','{\"LoginForm\":{\"username\":\"qqq\",\"password\":\"111\",\"rememberMe\":\"1\"}}','POST','User qqq is logged in.'),(14,2,1529419480,'127.0.0.1','site/logout','[]','POST','User qqq is logged out.'),(15,2,1529419486,'127.0.0.1','site/login','{\"LoginForm\":{\"username\":\"qqq\",\"password\":\"111\",\"rememberMe\":\"1\"}}','POST','User qqq is logged in.'),(16,2,1529419587,'127.0.0.1','site/logout','[]','POST','User qqq is logged out.'),(17,2,1529419594,'127.0.0.1','site/login','{\"LoginForm\":{\"username\":\"qqq\",\"password\":\"111\",\"rememberMe\":\"1\"}}','POST','User qqq is logged in.'),(18,2,1529421497,'127.0.0.1','site/logout','[]','POST','User qqq is logged out.'),(19,2,1529421502,'127.0.0.1','site/login','{\"LoginForm\":{\"username\":\"qqq\",\"password\":\"111\",\"rememberMe\":\"1\"}}','POST','User qqq is logged in.'),(20,2,1529486642,'127.0.0.1','site/logout','[]','POST','User qqq is logged out.'),(21,2,1529486647,'127.0.0.1','site/login','{\"LoginForm\":{\"username\":\"qqq\",\"password\":\"111\",\"rememberMe\":\"1\"}}','POST','User qqq is logged in.'),(22,2,1529488671,'127.0.0.1','site/logout','[]','POST','User qqq is logged out.'),(23,1,1529488679,'127.0.0.1','site/login','{\"LoginForm\":{\"username\":\"aaa\",\"password\":\"111\",\"rememberMe\":\"1\"}}','POST','User aaa is logged in.'),(24,1,1529488721,'127.0.0.1','site/logout','[]','POST','User aaa is logged out.'),(25,2,1529488727,'127.0.0.1','site/login','{\"LoginForm\":{\"username\":\"qqq\",\"password\":\"111\",\"rememberMe\":\"1\"}}','POST','User qqq is logged in.'),(26,2,1529505535,'127.0.0.1','site/logout','[]','POST','User qqq is logged out.'),(27,1,1529505541,'127.0.0.1','site/login','{\"LoginForm\":{\"username\":\"aaa\",\"password\":\"111\",\"rememberMe\":\"1\"}}','POST','User aaa is logged in.'),(28,1,1529505659,'127.0.0.1','site/logout','[]','POST','User aaa is logged out.'),(29,2,1529505664,'127.0.0.1','site/login','{\"LoginForm\":{\"username\":\"qqq\",\"password\":\"111\",\"rememberMe\":\"1\"}}','POST','User qqq is logged in.'),(30,2,1529505847,'127.0.0.1','site/logout','[]','POST','User qqq is logged out.'),(31,17,1529505854,'127.0.0.1','site/login','{\"LoginForm\":{\"username\":\"www\",\"password\":\"111\",\"rememberMe\":\"1\"}}','POST','User www is logged in.'),(32,17,1529505877,'127.0.0.1','site/logout','[]','POST','User www is logged out.'),(33,2,1529505883,'127.0.0.1','site/login','{\"LoginForm\":{\"username\":\"qqq\",\"password\":\"111\",\"rememberMe\":\"1\"}}','POST','User qqq is logged in.'),(34,2,1529577916,'127.0.0.1','site/logout','[]','POST','User qqq is logged out.'),(35,2,1529577922,'127.0.0.1','site/login','{\"LoginForm\":{\"username\":\"qqq\",\"password\":\"111\",\"rememberMe\":\"1\"}}','POST','User qqq is logged in.'),(36,2,1529578665,'127.0.0.1','site/logout','[]','POST','User qqq is logged out.'),(37,2,1529578670,'127.0.0.1','site/login','{\"LoginForm\":{\"username\":\"qqq\",\"password\":\"111\",\"rememberMe\":\"1\"}}','POST','User qqq is logged in.'),(38,2,1529578687,'127.0.0.1','site/logout','[]','POST','User qqq is logged out.'),(39,2,1529578693,'127.0.0.1','site/login','{\"LoginForm\":{\"username\":\"qqq\",\"password\":\"111\",\"rememberMe\":\"1\"}}','POST','User qqq is logged in.'),(40,2,1530649736,'127.0.0.1','site/logout','[]','POST','User qqq is logged out.'),(41,1,1530649743,'127.0.0.1','site/login','{\"LoginForm\":{\"username\":\"aaa\",\"password\":\"111\",\"rememberMe\":\"1\"}}','POST','User aaa is logged in.'),(42,1,1530649757,'127.0.0.1','site/logout','[]','POST','User aaa is logged out.'),(43,17,1530649763,'127.0.0.1','site/login','{\"LoginForm\":{\"username\":\"www\",\"password\":\"111\",\"rememberMe\":\"1\"}}','POST','User www is logged in.'),(44,17,1530650542,'127.0.0.1','site/logout','[]','POST','User www is logged out.'),(45,2,1530650548,'127.0.0.1','site/login','{\"LoginForm\":{\"username\":\"qqq\",\"password\":\"111\",\"rememberMe\":\"1\"}}','POST','User qqq is logged in.'),(46,2,1530650743,'127.0.0.1','site/logout','[]','POST','User qqq is logged out.'),(47,17,1530650751,'127.0.0.1','site/login','{\"LoginForm\":{\"username\":\"www\",\"password\":\"111\",\"rememberMe\":\"1\"}}','POST','User www is logged in.'),(48,17,1530650760,'127.0.0.1','site/logout','[]','POST','User www is logged out.'),(49,2,1530650767,'127.0.0.1','site/login','{\"LoginForm\":{\"username\":\"qqq\",\"password\":\"111\",\"rememberMe\":\"1\"}}','POST','User qqq is logged in.'),(50,2,1531765303,'127.0.0.1','site/logout','[]','POST','User qqq is logged out.'),(51,2,1531768149,'127.0.0.1','site/login','{\"LoginForm\":{\"username\":\"qqq\",\"password\":\"111\"}}','POST','User qqq is logged in.'),(52,2,1531768207,'127.0.0.1','site/login','{\"LoginForm\":{\"username\":\"qqq\",\"password\":\"111\"}}','POST','User qqq is logged in.'),(53,2,1531768320,'127.0.0.1','site/login','{\"LoginForm\":{\"username\":\"qqq\",\"password\":\"111\",\"rememberMe\":\"1\"}}','POST','User qqq is logged in.'),(54,2,1531768450,'127.0.0.1','site/login','{\"LoginForm\":{\"username\":\"qqq\",\"password\":\"111\"}}','POST','User qqq is logged in.'),(55,2,1531768493,'127.0.0.1','site/login','{\"LoginForm\":{\"username\":\"qqq\",\"password\":\"111\"}}','POST','User qqq is logged in.'),(56,2,1531768670,'127.0.0.1','site/login','{\"LoginForm\":{\"username\":\"qqq\",\"password\":\"111\"}}','POST','User qqq is logged in.'),(57,2,1531769114,'127.0.0.1','site/login','{\"LoginForm\":{\"username\":\"qqq\",\"password\":\"111\"}}','POST','User qqq is logged in.'),(58,2,1531770203,'127.0.0.1','site/login','{\"LoginForm\":{\"username\":\"qqq\",\"password\":\"111\"}}','POST','User qqq is logged in.'),(59,2,1531770204,'127.0.0.1','site/login','{\"LoginForm\":{\"username\":\"qqq\",\"password\":\"111\"}}','POST','User qqq is logged in.'),(60,2,1531770204,'127.0.0.1','site/login','{\"LoginForm\":{\"username\":\"qqq\",\"password\":\"111\"}}','POST','User qqq is logged in.'),(61,2,1531770205,'127.0.0.1','site/login','{\"LoginForm\":{\"username\":\"qqq\",\"password\":\"111\"}}','POST','User qqq is logged in.'),(62,2,1531770206,'127.0.0.1','site/login','{\"LoginForm\":{\"username\":\"qqq\",\"password\":\"111\"}}','POST','User qqq is logged in.'),(63,2,1531770207,'127.0.0.1','site/login','{\"LoginForm\":{\"username\":\"qqq\",\"password\":\"111\"}}','POST','User qqq is logged in.'),(64,2,1531770208,'127.0.0.1','site/login','{\"LoginForm\":{\"username\":\"qqq\",\"password\":\"111\"}}','POST','User qqq is logged in.'),(65,2,1531770209,'127.0.0.1','site/login','{\"LoginForm\":{\"username\":\"qqq\",\"password\":\"111\"}}','POST','User qqq is logged in.'),(66,2,1531770209,'127.0.0.1','site/login','{\"LoginForm\":{\"username\":\"qqq\",\"password\":\"111\"}}','POST','User qqq is logged in.'),(67,2,1531770210,'127.0.0.1','site/login','{\"LoginForm\":{\"username\":\"qqq\",\"password\":\"111\"}}','POST','User qqq is logged in.'),(68,2,1531770660,'127.0.0.1','site/login','{\"LoginForm\":{\"username\":\"qqq\",\"password\":\"111\"}}','POST','User qqq is logged in.'),(69,2,1531770661,'127.0.0.1','site/login','{\"LoginForm\":{\"username\":\"qqq\",\"password\":\"111\"}}','POST','User qqq is logged in.'),(70,2,1531770662,'127.0.0.1','site/login','{\"LoginForm\":{\"username\":\"qqq\",\"password\":\"111\"}}','POST','User qqq is logged in.'),(71,2,1531770663,'127.0.0.1','site/login','{\"LoginForm\":{\"username\":\"qqq\",\"password\":\"111\"}}','POST','User qqq is logged in.'),(72,2,1531770664,'127.0.0.1','site/login','{\"LoginForm\":{\"username\":\"qqq\",\"password\":\"111\"}}','POST','User qqq is logged in.'),(73,2,1531770664,'127.0.0.1','site/login','{\"LoginForm\":{\"username\":\"qqq\",\"password\":\"111\"}}','POST','User qqq is logged in.'),(74,2,1531770665,'127.0.0.1','site/login','{\"LoginForm\":{\"username\":\"qqq\",\"password\":\"111\"}}','POST','User qqq is logged in.'),(75,2,1531770666,'127.0.0.1','site/login','{\"LoginForm\":{\"username\":\"qqq\",\"password\":\"111\"}}','POST','User qqq is logged in.'),(76,2,1531770666,'127.0.0.1','site/login','{\"LoginForm\":{\"username\":\"qqq\",\"password\":\"111\"}}','POST','User qqq is logged in.'),(77,2,1531770667,'127.0.0.1','site/login','{\"LoginForm\":{\"username\":\"qqq\",\"password\":\"111\"}}','POST','User qqq is logged in.'),(78,2,1531770845,'127.0.0.1','site/login','{\"LoginForm\":{\"username\":\"qqq\",\"password\":\"111\"}}','POST','User qqq is logged in.'),(79,2,1531770846,'127.0.0.1','site/login','{\"LoginForm\":{\"username\":\"qqq\",\"password\":\"111\"}}','POST','User qqq is logged in.'),(80,2,1531770847,'127.0.0.1','site/login','{\"LoginForm\":{\"username\":\"qqq\",\"password\":\"111\"}}','POST','User qqq is logged in.'),(81,2,1531770847,'127.0.0.1','site/login','{\"LoginForm\":{\"username\":\"qqq\",\"password\":\"111\"}}','POST','User qqq is logged in.'),(82,2,1531770848,'127.0.0.1','site/login','{\"LoginForm\":{\"username\":\"qqq\",\"password\":\"111\"}}','POST','User qqq is logged in.'),(83,2,1531770849,'127.0.0.1','site/login','{\"LoginForm\":{\"username\":\"qqq\",\"password\":\"111\"}}','POST','User qqq is logged in.'),(84,2,1531770849,'127.0.0.1','site/login','{\"LoginForm\":{\"username\":\"qqq\",\"password\":\"111\"}}','POST','User qqq is logged in.'),(85,2,1531770850,'127.0.0.1','site/login','{\"LoginForm\":{\"username\":\"qqq\",\"password\":\"111\"}}','POST','User qqq is logged in.'),(86,2,1531770851,'127.0.0.1','site/login','{\"LoginForm\":{\"username\":\"qqq\",\"password\":\"111\"}}','POST','User qqq is logged in.'),(87,2,1531770852,'127.0.0.1','site/login','{\"LoginForm\":{\"username\":\"qqq\",\"password\":\"111\"}}','POST','User qqq is logged in.'),(88,2,1531770942,'127.0.0.1','site/login','{\"LoginForm\":{\"username\":\"qqq\",\"password\":\"111\"}}','POST','User qqq is logged in.'),(89,2,1531770943,'127.0.0.1','site/login','{\"LoginForm\":{\"username\":\"qqq\",\"password\":\"111\"}}','POST','User qqq is logged in.'),(90,2,1531770943,'127.0.0.1','site/login','{\"LoginForm\":{\"username\":\"qqq\",\"password\":\"111\"}}','POST','User qqq is logged in.'),(91,2,1531770944,'127.0.0.1','site/login','{\"LoginForm\":{\"username\":\"qqq\",\"password\":\"111\"}}','POST','User qqq is logged in.'),(92,2,1531770945,'127.0.0.1','site/login','{\"LoginForm\":{\"username\":\"qqq\",\"password\":\"111\"}}','POST','User qqq is logged in.'),(93,2,1531770946,'127.0.0.1','site/login','{\"LoginForm\":{\"username\":\"qqq\",\"password\":\"111\"}}','POST','User qqq is logged in.'),(94,2,1531770947,'127.0.0.1','site/login','{\"LoginForm\":{\"username\":\"qqq\",\"password\":\"111\"}}','POST','User qqq is logged in.'),(95,2,1531770947,'127.0.0.1','site/login','{\"LoginForm\":{\"username\":\"qqq\",\"password\":\"111\"}}','POST','User qqq is logged in.'),(96,2,1531770949,'127.0.0.1','site/login','{\"LoginForm\":{\"username\":\"qqq\",\"password\":\"111\"}}','POST','User qqq is logged in.'),(97,2,1531770951,'127.0.0.1','site/login','{\"LoginForm\":{\"username\":\"qqq\",\"password\":\"111\"}}','POST','User qqq is logged in.'),(98,2,1531770951,'127.0.0.1','site/login','{\"LoginForm\":{\"username\":\"qqq\",\"password\":\"111\"}}','POST','User qqq is logged in.'),(99,2,1531770952,'127.0.0.1','site/login','{\"LoginForm\":{\"username\":\"qqq\",\"password\":\"111\"}}','POST','User qqq is logged in.'),(100,2,1531770953,'127.0.0.1','site/login','{\"LoginForm\":{\"username\":\"qqq\",\"password\":\"111\"}}','POST','User qqq is logged in.'),(101,2,1531770953,'127.0.0.1','site/login','{\"LoginForm\":{\"username\":\"qqq\",\"password\":\"111\"}}','POST','User qqq is logged in.'),(102,2,1531770954,'127.0.0.1','site/login','{\"LoginForm\":{\"username\":\"qqq\",\"password\":\"111\"}}','POST','User qqq is logged in.'),(103,2,1531770955,'127.0.0.1','site/login','{\"LoginForm\":{\"username\":\"qqq\",\"password\":\"111\"}}','POST','User qqq is logged in.'),(104,2,1531770955,'127.0.0.1','site/login','{\"LoginForm\":{\"username\":\"qqq\",\"password\":\"111\"}}','POST','User qqq is logged in.'),(105,2,1531770956,'127.0.0.1','site/login','{\"LoginForm\":{\"username\":\"qqq\",\"password\":\"111\"}}','POST','User qqq is logged in.'),(106,2,1531770957,'127.0.0.1','site/login','{\"LoginForm\":{\"username\":\"qqq\",\"password\":\"111\"}}','POST','User qqq is logged in.'),(107,2,1531770957,'127.0.0.1','site/login','{\"LoginForm\":{\"username\":\"qqq\",\"password\":\"111\"}}','POST','User qqq is logged in.'),(108,2,1531770958,'127.0.0.1','site/login','{\"LoginForm\":{\"username\":\"qqq\",\"password\":\"111\"}}','POST','User qqq is logged in.'),(109,2,1531770959,'127.0.0.1','site/login','{\"LoginForm\":{\"username\":\"qqq\",\"password\":\"111\"}}','POST','User qqq is logged in.'),(110,2,1531770960,'127.0.0.1','site/login','{\"LoginForm\":{\"username\":\"qqq\",\"password\":\"111\"}}','POST','User qqq is logged in.'),(111,2,1531770960,'127.0.0.1','site/login','{\"LoginForm\":{\"username\":\"qqq\",\"password\":\"111\"}}','POST','User qqq is logged in.'),(112,2,1531770961,'127.0.0.1','site/login','{\"LoginForm\":{\"username\":\"qqq\",\"password\":\"111\"}}','POST','User qqq is logged in.'),(113,2,1531770962,'127.0.0.1','site/login','{\"LoginForm\":{\"username\":\"qqq\",\"password\":\"111\"}}','POST','User qqq is logged in.'),(114,2,1531770962,'127.0.0.1','site/login','{\"LoginForm\":{\"username\":\"qqq\",\"password\":\"111\"}}','POST','User qqq is logged in.'),(115,2,1531770963,'127.0.0.1','site/login','{\"LoginForm\":{\"username\":\"qqq\",\"password\":\"111\"}}','POST','User qqq is logged in.'),(116,2,1531770964,'127.0.0.1','site/login','{\"LoginForm\":{\"username\":\"qqq\",\"password\":\"111\"}}','POST','User qqq is logged in.'),(117,2,1531770964,'127.0.0.1','site/login','{\"LoginForm\":{\"username\":\"qqq\",\"password\":\"111\"}}','POST','User qqq is logged in.'),(118,2,1531770965,'127.0.0.1','site/login','{\"LoginForm\":{\"username\":\"qqq\",\"password\":\"111\"}}','POST','User qqq is logged in.'),(119,2,1531770966,'127.0.0.1','site/login','{\"LoginForm\":{\"username\":\"qqq\",\"password\":\"111\"}}','POST','User qqq is logged in.'),(120,2,1531770967,'127.0.0.1','site/login','{\"LoginForm\":{\"username\":\"qqq\",\"password\":\"111\"}}','POST','User qqq is logged in.'),(121,2,1531770967,'127.0.0.1','site/login','{\"LoginForm\":{\"username\":\"qqq\",\"password\":\"111\"}}','POST','User qqq is logged in.'),(122,2,1531770968,'127.0.0.1','site/login','{\"LoginForm\":{\"username\":\"qqq\",\"password\":\"111\"}}','POST','User qqq is logged in.'),(123,2,1531770969,'127.0.0.1','site/login','{\"LoginForm\":{\"username\":\"qqq\",\"password\":\"111\"}}','POST','User qqq is logged in.'),(124,2,1531770970,'127.0.0.1','site/login','{\"LoginForm\":{\"username\":\"qqq\",\"password\":\"111\"}}','POST','User qqq is logged in.'),(125,2,1531770970,'127.0.0.1','site/login','{\"LoginForm\":{\"username\":\"qqq\",\"password\":\"111\"}}','POST','User qqq is logged in.'),(126,2,1531770971,'127.0.0.1','site/login','{\"LoginForm\":{\"username\":\"qqq\",\"password\":\"111\"}}','POST','User qqq is logged in.'),(127,2,1531770972,'127.0.0.1','site/login','{\"LoginForm\":{\"username\":\"qqq\",\"password\":\"111\"}}','POST','User qqq is logged in.'),(128,2,1531770973,'127.0.0.1','site/login','{\"LoginForm\":{\"username\":\"qqq\",\"password\":\"111\"}}','POST','User qqq is logged in.'),(129,2,1531770973,'127.0.0.1','site/login','{\"LoginForm\":{\"username\":\"qqq\",\"password\":\"111\"}}','POST','User qqq is logged in.'),(130,2,1531770974,'127.0.0.1','site/login','{\"LoginForm\":{\"username\":\"qqq\",\"password\":\"111\"}}','POST','User qqq is logged in.'),(131,2,1531770975,'127.0.0.1','site/login','{\"LoginForm\":{\"username\":\"qqq\",\"password\":\"111\"}}','POST','User qqq is logged in.'),(132,2,1531770976,'127.0.0.1','site/login','{\"LoginForm\":{\"username\":\"qqq\",\"password\":\"111\"}}','POST','User qqq is logged in.'),(133,2,1531770976,'127.0.0.1','site/login','{\"LoginForm\":{\"username\":\"qqq\",\"password\":\"111\"}}','POST','User qqq is logged in.'),(134,2,1531770977,'127.0.0.1','site/login','{\"LoginForm\":{\"username\":\"qqq\",\"password\":\"111\"}}','POST','User qqq is logged in.'),(135,2,1531770978,'127.0.0.1','site/login','{\"LoginForm\":{\"username\":\"qqq\",\"password\":\"111\"}}','POST','User qqq is logged in.'),(136,2,1531770978,'127.0.0.1','site/login','{\"LoginForm\":{\"username\":\"qqq\",\"password\":\"111\"}}','POST','User qqq is logged in.'),(137,2,1531770979,'127.0.0.1','site/login','{\"LoginForm\":{\"username\":\"qqq\",\"password\":\"111\"}}','POST','User qqq is logged in.'),(138,2,1531770980,'127.0.0.1','site/login','{\"LoginForm\":{\"username\":\"qqq\",\"password\":\"111\"}}','POST','User qqq is logged in.'),(139,2,1531770980,'127.0.0.1','site/login','{\"LoginForm\":{\"username\":\"qqq\",\"password\":\"111\"}}','POST','User qqq is logged in.'),(140,2,1531770981,'127.0.0.1','site/login','{\"LoginForm\":{\"username\":\"qqq\",\"password\":\"111\"}}','POST','User qqq is logged in.'),(141,2,1531770982,'127.0.0.1','site/login','{\"LoginForm\":{\"username\":\"qqq\",\"password\":\"111\"}}','POST','User qqq is logged in.'),(142,2,1531770983,'127.0.0.1','site/login','{\"LoginForm\":{\"username\":\"qqq\",\"password\":\"111\"}}','POST','User qqq is logged in.'),(143,2,1531770983,'127.0.0.1','site/login','{\"LoginForm\":{\"username\":\"qqq\",\"password\":\"111\"}}','POST','User qqq is logged in.'),(144,2,1531770984,'127.0.0.1','site/login','{\"LoginForm\":{\"username\":\"qqq\",\"password\":\"111\"}}','POST','User qqq is logged in.'),(145,2,1531770985,'127.0.0.1','site/login','{\"LoginForm\":{\"username\":\"qqq\",\"password\":\"111\"}}','POST','User qqq is logged in.'),(146,2,1531770985,'127.0.0.1','site/login','{\"LoginForm\":{\"username\":\"qqq\",\"password\":\"111\"}}','POST','User qqq is logged in.'),(147,2,1531770986,'127.0.0.1','site/login','{\"LoginForm\":{\"username\":\"qqq\",\"password\":\"111\"}}','POST','User qqq is logged in.'),(148,2,1531770987,'127.0.0.1','site/login','{\"LoginForm\":{\"username\":\"qqq\",\"password\":\"111\"}}','POST','User qqq is logged in.'),(149,2,1531770988,'127.0.0.1','site/login','{\"LoginForm\":{\"username\":\"qqq\",\"password\":\"111\"}}','POST','User qqq is logged in.'),(150,2,1531770989,'127.0.0.1','site/login','{\"LoginForm\":{\"username\":\"qqq\",\"password\":\"111\"}}','POST','User qqq is logged in.'),(151,2,1531770991,'127.0.0.1','site/login','{\"LoginForm\":{\"username\":\"qqq\",\"password\":\"111\"}}','POST','User qqq is logged in.'),(152,2,1531770992,'127.0.0.1','site/login','{\"LoginForm\":{\"username\":\"qqq\",\"password\":\"111\"}}','POST','User qqq is logged in.'),(153,2,1531770993,'127.0.0.1','site/login','{\"LoginForm\":{\"username\":\"qqq\",\"password\":\"111\"}}','POST','User qqq is logged in.'),(154,2,1531770993,'127.0.0.1','site/login','{\"LoginForm\":{\"username\":\"qqq\",\"password\":\"111\"}}','POST','User qqq is logged in.'),(155,2,1531770994,'127.0.0.1','site/login','{\"LoginForm\":{\"username\":\"qqq\",\"password\":\"111\"}}','POST','User qqq is logged in.'),(156,2,1531770995,'127.0.0.1','site/login','{\"LoginForm\":{\"username\":\"qqq\",\"password\":\"111\"}}','POST','User qqq is logged in.'),(157,2,1531770996,'127.0.0.1','site/login','{\"LoginForm\":{\"username\":\"qqq\",\"password\":\"111\"}}','POST','User qqq is logged in.'),(158,2,1531770997,'127.0.0.1','site/login','{\"LoginForm\":{\"username\":\"qqq\",\"password\":\"111\"}}','POST','User qqq is logged in.'),(159,2,1531770997,'127.0.0.1','site/login','{\"LoginForm\":{\"username\":\"qqq\",\"password\":\"111\"}}','POST','User qqq is logged in.'),(160,2,1531770998,'127.0.0.1','site/login','{\"LoginForm\":{\"username\":\"qqq\",\"password\":\"111\"}}','POST','User qqq is logged in.'),(161,2,1531770999,'127.0.0.1','site/login','{\"LoginForm\":{\"username\":\"qqq\",\"password\":\"111\"}}','POST','User qqq is logged in.'),(162,2,1531770999,'127.0.0.1','site/login','{\"LoginForm\":{\"username\":\"qqq\",\"password\":\"111\"}}','POST','User qqq is logged in.'),(163,2,1531771000,'127.0.0.1','site/login','{\"LoginForm\":{\"username\":\"qqq\",\"password\":\"111\"}}','POST','User qqq is logged in.'),(164,2,1531771001,'127.0.0.1','site/login','{\"LoginForm\":{\"username\":\"qqq\",\"password\":\"111\"}}','POST','User qqq is logged in.'),(165,2,1531771001,'127.0.0.1','site/login','{\"LoginForm\":{\"username\":\"qqq\",\"password\":\"111\"}}','POST','User qqq is logged in.'),(166,2,1531771002,'127.0.0.1','site/login','{\"LoginForm\":{\"username\":\"qqq\",\"password\":\"111\"}}','POST','User qqq is logged in.'),(167,2,1531771003,'127.0.0.1','site/login','{\"LoginForm\":{\"username\":\"qqq\",\"password\":\"111\"}}','POST','User qqq is logged in.'),(168,2,1531771004,'127.0.0.1','site/login','{\"LoginForm\":{\"username\":\"qqq\",\"password\":\"111\"}}','POST','User qqq is logged in.'),(169,2,1531771005,'127.0.0.1','site/login','{\"LoginForm\":{\"username\":\"qqq\",\"password\":\"111\"}}','POST','User qqq is logged in.'),(170,2,1531771006,'127.0.0.1','site/login','{\"LoginForm\":{\"username\":\"qqq\",\"password\":\"111\"}}','POST','User qqq is logged in.'),(171,2,1531771007,'127.0.0.1','site/login','{\"LoginForm\":{\"username\":\"qqq\",\"password\":\"111\"}}','POST','User qqq is logged in.'),(172,2,1531771007,'127.0.0.1','site/login','{\"LoginForm\":{\"username\":\"qqq\",\"password\":\"111\"}}','POST','User qqq is logged in.'),(173,2,1531771008,'127.0.0.1','site/login','{\"LoginForm\":{\"username\":\"qqq\",\"password\":\"111\"}}','POST','User qqq is logged in.'),(174,2,1531771009,'127.0.0.1','site/login','{\"LoginForm\":{\"username\":\"qqq\",\"password\":\"111\"}}','POST','User qqq is logged in.'),(175,2,1531771009,'127.0.0.1','site/login','{\"LoginForm\":{\"username\":\"qqq\",\"password\":\"111\"}}','POST','User qqq is logged in.'),(176,2,1531771010,'127.0.0.1','site/login','{\"LoginForm\":{\"username\":\"qqq\",\"password\":\"111\"}}','POST','User qqq is logged in.'),(177,2,1531771011,'127.0.0.1','site/login','{\"LoginForm\":{\"username\":\"qqq\",\"password\":\"111\"}}','POST','User qqq is logged in.'),(178,2,1531771011,'127.0.0.1','site/login','{\"LoginForm\":{\"username\":\"qqq\",\"password\":\"111\"}}','POST','User qqq is logged in.'),(179,2,1531771012,'127.0.0.1','site/login','{\"LoginForm\":{\"username\":\"qqq\",\"password\":\"111\"}}','POST','User qqq is logged in.'),(180,2,1531771013,'127.0.0.1','site/login','{\"LoginForm\":{\"username\":\"qqq\",\"password\":\"111\"}}','POST','User qqq is logged in.'),(181,2,1531771013,'127.0.0.1','site/login','{\"LoginForm\":{\"username\":\"qqq\",\"password\":\"111\"}}','POST','User qqq is logged in.'),(182,2,1531771014,'127.0.0.1','site/login','{\"LoginForm\":{\"username\":\"qqq\",\"password\":\"111\"}}','POST','User qqq is logged in.'),(183,2,1531771015,'127.0.0.1','site/login','{\"LoginForm\":{\"username\":\"qqq\",\"password\":\"111\"}}','POST','User qqq is logged in.'),(184,2,1531771015,'127.0.0.1','site/login','{\"LoginForm\":{\"username\":\"qqq\",\"password\":\"111\"}}','POST','User qqq is logged in.'),(185,2,1531771016,'127.0.0.1','site/login','{\"LoginForm\":{\"username\":\"qqq\",\"password\":\"111\"}}','POST','User qqq is logged in.'),(186,2,1531771017,'127.0.0.1','site/login','{\"LoginForm\":{\"username\":\"qqq\",\"password\":\"111\"}}','POST','User qqq is logged in.'),(187,2,1531771017,'127.0.0.1','site/login','{\"LoginForm\":{\"username\":\"qqq\",\"password\":\"111\"}}','POST','User qqq is logged in.'),(188,2,1531771648,'127.0.0.1','site/login','{\"LoginForm\":{\"username\":\"qqq\",\"password\":\"111\"}}','POST','User qqq is logged in.'),(189,2,1531771649,'127.0.0.1','site/login','{\"LoginForm\":{\"username\":\"qqq\",\"password\":\"111\"}}','POST','User qqq is logged in.'),(190,2,1531771650,'127.0.0.1','site/login','{\"LoginForm\":{\"username\":\"qqq\",\"password\":\"111\"}}','POST','User qqq is logged in.'),(191,2,1531771650,'127.0.0.1','site/login','{\"LoginForm\":{\"username\":\"qqq\",\"password\":\"111\"}}','POST','User qqq is logged in.'),(192,2,1531771651,'127.0.0.1','site/login','{\"LoginForm\":{\"username\":\"qqq\",\"password\":\"111\"}}','POST','User qqq is logged in.'),(193,2,1531771652,'127.0.0.1','site/login','{\"LoginForm\":{\"username\":\"qqq\",\"password\":\"111\"}}','POST','User qqq is logged in.'),(194,2,1531771652,'127.0.0.1','site/login','{\"LoginForm\":{\"username\":\"qqq\",\"password\":\"111\"}}','POST','User qqq is logged in.'),(195,2,1531771653,'127.0.0.1','site/login','{\"LoginForm\":{\"username\":\"qqq\",\"password\":\"111\"}}','POST','User qqq is logged in.'),(196,2,1531771654,'127.0.0.1','site/login','{\"LoginForm\":{\"username\":\"qqq\",\"password\":\"111\"}}','POST','User qqq is logged in.'),(197,2,1531771655,'127.0.0.1','site/login','{\"LoginForm\":{\"username\":\"qqq\",\"password\":\"111\"}}','POST','User qqq is logged in.');
/*!40000 ALTER TABLE `yea_operation_log` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `yea_option`
--

DROP TABLE IF EXISTS `yea_option`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `yea_option` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `key` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `value` longtext COLLATE utf8mb4_unicode_ci,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk-option-user_id` (`user_id`),
  KEY `idx_option_type` (`type`),
  KEY `idx_option_key` (`key`),
  CONSTRAINT `fk-option-user_id` FOREIGN KEY (`user_id`) REFERENCES `yea_user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `yea_option`
--

LOCK TABLES `yea_option` WRITE;
/*!40000 ALTER TABLE `yea_option` DISABLE KEYS */;
INSERT INTO `yea_option` VALUES (7,'grid_cols',2,'user/index','email:role:status',1527869508,1530649014),(8,'grid_cols',1,'user/index','email:role:status',1528014055,1528136588);
/*!40000 ALTER TABLE `yea_option` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `yea_post`
--

DROP TABLE IF EXISTS `yea_post`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `yea_post` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `content` longtext COLLATE utf8mb4_unicode_ci,
  `cover` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `commentStatus` smallint(6) DEFAULT NULL,
  `status` smallint(6) DEFAULT NULL,
  `visibility` smallint(6) DEFAULT NULL,
  `author_id` int(11) DEFAULT NULL,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `idx-post-status` (`status`),
  KEY `idx-post-author_id` (`author_id`),
  KEY `idx-post-visibility` (`visibility`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `yea_post`
--

LOCK TABLES `yea_post` WRITE;
/*!40000 ALTER TABLE `yea_post` DISABLE KEYS */;
INSERT INTO `yea_post` VALUES (3,'333','<p>2<em><strong>2</strong></em>2</p>','/upload/post/img_0320_5b3bd8f11e37c.jpg',1,1,1,2,1530555658,1530729298),(4,'play','<p>game</p>','/upload/post/bestproductmanager_5b3c878043bd6.jpg',2,3,2,2,1530693504,1530730872);
/*!40000 ALTER TABLE `yea_post` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `yea_role_menu`
--

DROP TABLE IF EXISTS `yea_role_menu`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `yea_role_menu` (
  `role_name` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `menu_id` int(11) NOT NULL,
  `created_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`role_name`,`menu_id`),
  KEY `fk-role_menu-menu_id` (`menu_id`),
  CONSTRAINT `fk-role_menu-menu_id` FOREIGN KEY (`menu_id`) REFERENCES `yea_menu` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk-role_menu-role_name` FOREIGN KEY (`role_name`) REFERENCES `yea_auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `yea_role_menu`
--

LOCK TABLES `yea_role_menu` WRITE;
/*!40000 ALTER TABLE `yea_role_menu` DISABLE KEYS */;
INSERT INTO `yea_role_menu` VALUES ('admin',10,1530785144),('admin',18,1530785144),('admin',19,1530785144),('admin',20,1530785144),('admin',21,1530785144),('admin',22,1530785144),('admin',23,1530785144),('admin',24,1530785144),('admin',25,1530785144),('admin',26,1530785144),('admin',27,1530785144),('admin',28,1530785144),('admin',29,1530785144),('admin',30,1530785144),('admin',31,1530785144),('admin',32,1530785144),('admin',33,1530785144),('admin',34,1530785144),('author',10,1528876423),('author',11,1528876423),('author',13,1528876423),('author',14,1528876423),('author',18,1528876423),('author',19,1528876423),('author',20,1528876423),('author',21,1528876423),('contributor',10,1528876448),('contributor',11,1528876448),('contributor',18,1528876448),('contributor',19,1528876448),('contributor',20,1528876448),('contributor',21,1528876448),('editor',10,1528876401),('editor',11,1528876401),('editor',13,1528876401),('editor',16,1528876401),('editor',18,1528876401),('editor',19,1528876401),('editor',20,1528876401),('editor',21,1528876401),('subscriber',10,1528897948),('subscriber',11,1528897948),('subscriber',13,1528897948),('subscriber',14,1528897948);
/*!40000 ALTER TABLE `yea_role_menu` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `yea_tag`
--

DROP TABLE IF EXISTS `yea_tag`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `yea_tag` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `desc` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` smallint(6) DEFAULT NULL,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `idx-tag-status` (`status`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `yea_tag`
--

LOCK TABLES `yea_tag` WRITE;
/*!40000 ALTER TABLE `yea_tag` DISABLE KEYS */;
INSERT INTO `yea_tag` VALUES (1,'joke','jokes',1,1530423931,1530423931),(2,'news','news list',2,1530423951,1530423951),(3,'notice','notice123',1,1530721383,1530721383),(4,'play together','play together',1,1530721425,1530721425);
/*!40000 ALTER TABLE `yea_tag` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `yea_tag_post`
--

DROP TABLE IF EXISTS `yea_tag_post`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `yea_tag_post` (
  `tag_id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL,
  PRIMARY KEY (`tag_id`,`post_id`),
  KEY `fk-tag_post-post_id` (`post_id`),
  CONSTRAINT `fk-tag_post-post_id` FOREIGN KEY (`post_id`) REFERENCES `yea_post` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk-tag_post-tag_id` FOREIGN KEY (`tag_id`) REFERENCES `yea_tag` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `yea_tag_post`
--

LOCK TABLES `yea_tag_post` WRITE;
/*!40000 ALTER TABLE `yea_tag_post` DISABLE KEYS */;
INSERT INTO `yea_tag_post` VALUES (1,3),(4,3),(3,4),(4,4);
/*!40000 ALTER TABLE `yea_tag_post` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `yea_user`
--

DROP TABLE IF EXISTS `yea_user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `yea_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password_hash` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password_reset_token` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `auth_key` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` smallint(6) DEFAULT NULL,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`),
  KEY `idx-user-email` (`email`),
  KEY `idx-user-status` (`status`)
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `yea_user`
--

LOCK TABLES `yea_user` WRITE;
/*!40000 ALTER TABLE `yea_user` DISABLE KEYS */;
INSERT INTO `yea_user` VALUES (1,'aaa','hgkmail11@133.com','$2y$13$XYbfPyD6Iuj8dgSNTEYO4uame7VN8uCCcDx07Uz.sY6Dwk/RslLxm','sICo','-4n4NtNU',1,1527715986,1529505291),(2,'qqq','hgkmail@163.com','$2y$13$tMImnNqfJxH/mG5c0ByvX.zz/3bnm.oNpbIYDPnO2gtnBeuKYq2y2','ACRg','kpwV3XVQ',1,1527837669,1528715703),(16,'hhh','hgkmail@999.com','$2y$13$bcTJ1cGIDiseExYvCpLVN.RkC//zavv5n6focUYXvndfd9LH7VRY6','DZRg','QJo179j7',1,1527972430,1528876557),(17,'www','aaa@bbb.com','$2y$13$wfiVMaRK4XfUjpTKR.2fCOhXi7ter1QjGAvOQlJMlTYnaALZiyFlS','7W0R','0d9cQ3iq',1,1527972641,1528663022),(18,'vvv1','vvv2@111.com','$2y$13$c0IvW5LOV7JJuzJpKRVDr.ZBPKkSGQFKjr.9jZqs9fQC/BSJok.hG','9SR1','FHEvQkbi',1,1528013207,1528575561),(19,'nnn','nnn111@qqq.com','$2y$13$Of68E/eu06j2Slkb5XWQseXy.RrTj2EV1UJcg7BXkjf//24nL337O','54Nk','hZrIrYle',1,1528013238,1528663057),(23,'sdf','sdf@11.com','$2y$13$m7Z/SaaHO1ZNjJ5L5M6y2.dichKUIE02yHzpYOCLksbzm2WJdxgZq','g6h5','NSTfSehW',1,1528134145,1528876589),(24,'xcv','xcv@11.com','$2y$13$saWhDVH3Mrh4jESltZDUP.AZL0M14mgX.bp/4TzSeP7eHElD87cmm','GavG','Iqfu8azB',2,1528313661,1528750869),(26,'ppp','ppp@111.com','$2y$13$xATbuYpeEeoihg9ybZCDLOiKypG1MNadPVx.bCeY8vbMiWtJbzIfO','i6in','QKeUDCQp',1,1529407872,1529407872);
/*!40000 ALTER TABLE `yea_user` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `yea_user_profile`
--

DROP TABLE IF EXISTS `yea_user_profile`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `yea_user_profile` (
  `user_id` int(11) NOT NULL,
  `nickname` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gender` smallint(6) DEFAULT NULL,
  `avatar` varchar(1000) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone_number` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `birthday` date DEFAULT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`user_id`),
  CONSTRAINT `fk-user_profile-user_id` FOREIGN KEY (`user_id`) REFERENCES `yea_user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `yea_user_profile`
--

LOCK TABLES `yea_user_profile` WRITE;
/*!40000 ALTER TABLE `yea_user_profile` DISABLE KEYS */;
INSERT INTO `yea_user_profile` VALUES (1,'kim',2,'/upload/avatar/00_5b2a6607accd0.jpg','',NULL,'i am aaa.',1528577212,1529505291),(2,'qqq888admin',1,'/upload/avatar/img_0320_5b3bd9dec281a.jpg','123','2018-06-13','i am <strong>qqq</strong>.',1528577074,1530649054),(16,'',1,'','',NULL,'',1528876557,1528876557),(17,'',1,'/upload/avatar/c___5b1d8be9cb1f0.jpg','',NULL,'',1528663022,1528663022),(19,'',1,'/upload/avatar/capture20180211_5b1d8c0b12cfa.png','',NULL,'',1528663057,1528663057),(23,'',1,'/upload/avatar/Gradle_5b1d8b1ee11b8.gif','',NULL,'',1528662945,1528876589),(24,'cv',2,'/upload/avatar/00_5b1ee310845e3.jpg','','2018-06-21','',1528577877,1528750869);
/*!40000 ALTER TABLE `yea_user_profile` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2018-07-18 12:05:04
