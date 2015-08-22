-- MySQL dump 10.13  Distrib 5.5.40, for Linux (x86_64)
--
-- Host: localhost    Database: gulosity
-- ------------------------------------------------------
-- Server version	5.5.40

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
-- Table structure for table `address`
--

DROP TABLE IF EXISTS `address`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `address` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `address` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `user_id` int(11) NOT NULL,
  `tel` varchar(18) COLLATE utf8_unicode_ci NOT NULL,
  `user_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=212 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `address`
--

LOCK TABLES `address` WRITE;
/*!40000 ALTER TABLE `address` DISABLE KEYS */;
/*!40000 ALTER TABLE `address` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `admin`
--

DROP TABLE IF EXISTS `admin`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `admin` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `admin`
--

LOCK TABLES `admin` WRITE;
/*!40000 ALTER TABLE `admin` DISABLE KEYS */;
INSERT INTO `admin` VALUES (1,'admin','1234','0000-00-00 00:00:00','2014-04-28 08:52:27');
/*!40000 ALTER TABLE `admin` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `delivery`
--

DROP TABLE IF EXISTS `delivery`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `delivery` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `order_no` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `address_id` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `delivery_man` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `delivery_tel` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `delivery`
--

LOCK TABLES `delivery` WRITE;
/*!40000 ALTER TABLE `delivery` DISABLE KEYS */;
/*!40000 ALTER TABLE `delivery` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `food`
--

DROP TABLE IF EXISTS `food`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `food` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `ename` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `type` tinyint(4) NOT NULL,
  `price` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `image_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `status` tinyint(4) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `order_by` int(10) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `food_name_unique` (`name`)
) ENGINE=MyISAM AUTO_INCREMENT=312 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `food`
--

LOCK TABLES `food` WRITE;
/*!40000 ALTER TABLE `food` DISABLE KEYS */;
INSERT INTO `food` VALUES (7,'炙烤鸡排饭','Grilled Chicken Steak with Rice',1,'28','images/jipa.png','images/jipa_name.png',0,'0000-00-00 00:00:00','0000-00-00 00:00:00',7),(8,'照烧鳗鱼饭','Grilled Eel Rice',1,'38','images/manyu.png','images/manyu_name.png',0,'0000-00-00 00:00:00','0000-00-00 00:00:00',8),(9,'咖喱牛肉饭','Curry Beef Rice',1,'29','images/niurou.jpg','images/niurou_name.png',0,'0000-00-00 00:00:00','0000-00-00 00:00:00',9),(10,'泡菜猪肉饭','Pickled Vegetable and Pork with Rice',1,'25','images/zhurou.png','images/zhurou_name.png',0,'0000-00-00 00:00:00','0000-00-00 00:00:00',10),(11,'咖喱鸡肉饭','Curry Chicken Rice',1,'25','images/jirou.png','images/jirou_name.png',0,'0000-00-00 00:00:00','0000-00-00 00:00:00',11),(12,'香菇焖鸭饭','Stewed Duck and Mushroom with Rice',1,'18','images/menya.png','images/menya_name.png',0,'0000-00-00 00:00:00','0000-00-00 00:00:00',12),(13,'卤汁鸡腿饭','Stewed Chicken Drumstick with Rice',1,'18','images/jitui.png','images/jitui_name.png',0,'0000-00-00 00:00:00','0000-00-00 00:00:00',13),(14,'肥肠米线','Rice Noodles with Vegetables',2,'18','images/feichang.png','images/feichang_name.png',0,'0000-00-00 00:00:00','0000-00-00 00:00:00',14),(15,'肥牛米线','Rice Noodles with Stewed Pork Intestines',2,'18','images/feiniu.png','images/feiniu_name.png',0,'0000-00-00 00:00:00','0000-00-00 00:00:00',15),(16,'肥羊米线','Rice Noodles with Beef',2,'18','images/feiyang.png','images/feiyang_name.png',0,'0000-00-00 00:00:00','0000-00-00 00:00:00',16),(17,'海鲜米线','Rice Noodles with Lamb',2,'18','images/haixian.png','images/haixian_name.png',0,'0000-00-00 00:00:00','0000-00-00 00:00:00',17),(18,'鸡块米线','Rice Noodles with Meatballs',2,'16','images/jikuai.png','images/jikuai_name.png',0,'0000-00-00 00:00:00','0000-00-00 00:00:00',18),(19,'猪里脊米线','Rice Noodles with Pork Tenderloin',2,'16','images/liji.png','images/liji_name.png',0,'0000-00-00 00:00:00','0000-00-00 00:00:00',19),(20,'牛肉丸米线','Rice Noodles with Seafood',2,'16','images/niurouwan.png','images/niurouwan_name.png',0,'0000-00-00 00:00:00','0000-00-00 00:00:00',20),(21,'素菜米线','Rice Noodles with Chicken',2,'14','images/sucai.png','images/sucai_name.png',0,'0000-00-00 00:00:00','0000-00-00 00:00:00',21),(220,'(单点) 米饭','',1,'3','','',0,'0000-00-00 00:00:00','0000-00-00 00:00:00',220),(23,'蔬菜沙拉','',1,'12','','',0,'0000-00-00 00:00:00','0000-00-00 00:00:00',23),(24,'(单点) 鸡腿','',1,'15','','',0,'0000-00-00 00:00:00','0000-00-00 00:00:00',24),(25,'米线','',6,'3','','',0,'0000-00-00 00:00:00','0000-00-00 00:00:00',25),(26,'青菜','',6,'2','','',0,'0000-00-00 00:00:00','0000-00-00 00:00:00',26),(27,'豆芽','',6,'3','','',0,'0000-00-00 00:00:00','0000-00-00 00:00:00',27),(28,'美式咖啡','Americano',3,'10','','',0,'0000-00-00 00:00:00','0000-00-00 00:00:00',28),(29,'冰咖啡','Iced Coffee',3,'12','','',0,'0000-00-00 00:00:00','0000-00-00 00:00:00',29),(30,'拿铁','Latte',3,'14','','',0,'0000-00-00 00:00:00','0000-00-00 00:00:00',30),(31,'现榨纯梨汁','Pear Juice(100% Natural)',3,'14','','',0,'0000-00-00 00:00:00','0000-00-00 00:00:00',31),(32,'香蕉奶昔','Banana Milkshake',3,'12','','',0,'0000-00-00 00:00:00','0000-00-00 00:00:00',32),(33,'巧克力奶昔','Chocolate Milkshake',3,'15','','',0,'0000-00-00 00:00:00','0000-00-00 00:00:00',33),(34,'蓝莓奶昔','Blueberry Milkshake',3,'15','','',0,'0000-00-00 00:00:00','0000-00-00 00:00:00',34),(35,'蜂蜜柚子茶','Honey Lemon Citrus Tea',3,'10','','',0,'0000-00-00 00:00:00','0000-00-00 00:00:00',35),(36,'红糖生姜茶','Brown Sugar Ginger Tea ',3,'10','','',0,'0000-00-00 00:00:00','0000-00-00 00:00:00',36),(38,'可口可乐','Coca-Cola',3,'3','','',0,'0000-00-00 00:00:00','0000-00-00 00:00:00',38),(39,'雪碧','Sprite',3,'3','','',0,'0000-00-00 00:00:00','0000-00-00 00:00:00',39),(40,'加多宝凉茶','JDB Herbal Tea',3,'4','','',0,'0000-00-00 00:00:00','0000-00-00 00:00:00',40),(41,'康师傅红茶','Master Kong Ice Black Tea',3,'3','','',0,'0000-00-00 00:00:00','0000-00-00 00:00:00',41),(42,'椰树椰汁','Coconut Palm',3,'4','','',0,'0000-00-00 00:00:00','0000-00-00 00:00:00',42),(43,'农夫山泉','Nongfu Spring',3,'2','','',0,'0000-00-00 00:00:00','0000-00-00 00:00:00',43),(44,'龟苓膏','Herbal Jelly',3,'5','','',0,'0000-00-00 00:00:00','0000-00-00 00:00:00',44),(45,'南瓜羹','Pumpkin Soup',3,'5','','',0,'0000-00-00 00:00:00','0000-00-00 00:00:00',45),(230,'水果沙拉','',1,'15','','',0,'0000-00-00 00:00:00','0000-00-00 00:00:00',23),(221,'豆皮','',6,'3','','',0,'0000-00-00 00:00:00','0000-00-00 00:00:00',221),(222,'肥牛','',4,'6','','',0,'0000-00-00 00:00:00','0000-00-00 00:00:00',222),(223,'肥羊','',4,'6','','',0,'0000-00-00 00:00:00','0000-00-00 00:00:00',223),(224,'肥肠','',4,'6','','',0,'0000-00-00 00:00:00','0000-00-00 00:00:00',224),(225,'海鲜','',4,'6','','',0,'0000-00-00 00:00:00','0000-00-00 00:00:00',225),(226,'牛肉丸','',4,'4','','',0,'0000-00-00 00:00:00','0000-00-00 00:00:00',226),(227,'猪里脊','',4,'4','','',0,'0000-00-00 00:00:00','0000-00-00 00:00:00',227),(228,'鸡块','',4,'4','','',0,'0000-00-00 00:00:00','0000-00-00 00:00:00',228),(310,'现榨西瓜汁','Watermelon Juice(100% Natural)',3,'14','','',0,'0000-00-00 00:00:00','0000-00-00 00:00:00',31),(311,'黑椒牛柳饭','Black Pepper Beef Steak with Rice',1,'32','images/heijiaoniuliu.png','images/heijiaoniuliu_name.png',1,'0000-00-00 00:00:00','0000-00-00 00:00:00',13);
/*!40000 ALTER TABLE `food` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `log`
--

DROP TABLE IF EXISTS `log`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `log` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `log` text COLLATE utf8_unicode_ci NOT NULL,
  `type` tinyint(4) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `order_id` int(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=7982 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `log`
--

LOCK TABLES `log` WRITE;
/*!40000 ALTER TABLE `log` DISABLE KEYS */;
/*!40000 ALTER TABLE `log` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `lottery`
--

DROP TABLE IF EXISTS `lottery`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `lottery` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `prize` int(5) NOT NULL,
  `count` int(3) NOT NULL,
  `used` tinyint(1) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=588 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `lottery`
--

LOCK TABLES `lottery` WRITE;
/*!40000 ALTER TABLE `lottery` DISABLE KEYS */;
/*!40000 ALTER TABLE `lottery` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `order`
--

DROP TABLE IF EXISTS `order`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `order` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `order_no` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `num` int(10) NOT NULL,
  `user_id` int(11) NOT NULL,
  `delivery_id` int(11) NOT NULL,
  `status` tinyint(4) NOT NULL,
  `pay_type` tinyint(4) NOT NULL,
  `pay_status` tinyint(4) NOT NULL,
  `total_price` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `prize` int(4) NOT NULL,
  `delivery_time` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `fapiao_type` tinyint(1) NOT NULL,
  `fapiao_title` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `address_id` int(11) NOT NULL,
  `comment` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `operator` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `wx_transaction_id` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `order_order_no_unique` (`order_no`)
) ENGINE=MyISAM AUTO_INCREMENT=396 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `order`
--

LOCK TABLES `order` WRITE;
/*!40000 ALTER TABLE `order` DISABLE KEYS */;
/*!40000 ALTER TABLE `order` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `order_food`
--

DROP TABLE IF EXISTS `order_food`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `order_food` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `order_id` int(11) NOT NULL,
  `food_id` int(11) NOT NULL,
  `allplus` varchar(256) COLLATE utf8_unicode_ci NOT NULL,
  `count` int(11) NOT NULL,
  `comment` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=877 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `order_food`
--

LOCK TABLES `order_food` WRITE;
/*!40000 ALTER TABLE `order_food` DISABLE KEYS */;
/*!40000 ALTER TABLE `order_food` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `wechat_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `mobile` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=MyISAM AUTO_INCREMENT=473 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `vip`
--

DROP TABLE IF EXISTS `vip`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `vip` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `mobile` varchar(15) NOT NULL,
  `email` varchar(30) NOT NULL,
  `pay_password` varchar(30) NOT NULL,
  `balance` decimal(10,0) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  UNIQUE KEY `mobile` (`mobile`)
) ENGINE=MyISAM AUTO_INCREMENT=18 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `vip`
--

LOCK TABLES `vip` WRITE;
/*!40000 ALTER TABLE `vip` DISABLE KEYS */;
/*!40000 ALTER TABLE `vip` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `vip_pay_log`
--

DROP TABLE IF EXISTS `vip_pay_log`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `vip_pay_log` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `vip_id` int(11) NOT NULL,
  `money` decimal(10,0) NOT NULL,
  `type` tinyint(4) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `pay_status` tinyint(1) NOT NULL DEFAULT '0',
  `wx_transaction_id` varchar(50) NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=28 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `vip_pay_log`
--

LOCK TABLES `vip_pay_log` WRITE;
/*!40000 ALTER TABLE `vip_pay_log` DISABLE KEYS */;
/*!40000 ALTER TABLE `vip_pay_log` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `vip_pwd_reset`
--

DROP TABLE IF EXISTS `vip_pwd_reset`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `vip_pwd_reset` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `vip_id` int(11) NOT NULL,
  `status` tinyint(4) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `pwd` varchar(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=24 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `vip_pwd_reset`
--

LOCK TABLES `vip_pwd_reset` WRITE;
/*!40000 ALTER TABLE `vip_pwd_reset` DISABLE KEYS */;
/*!40000 ALTER TABLE `vip_pwd_reset` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2015-04-06 11:20:55
