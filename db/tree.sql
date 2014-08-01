/*
SQLyog Ultimate v11.52 (64 bit)
MySQL - 5.5.37-log : Database - tree_st
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`tree_st` /*!40100 DEFAULT CHARACTER SET utf8 */;

USE `tree_st`;

/*Table structure for table `st_elements` */

DROP TABLE IF EXISTS `st_elements`;

CREATE TABLE `st_elements` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `level` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=utf8;

/*Data for the table `st_elements` */

insert  into `st_elements`(`id`,`name`,`description`,`level`) values (14,'ROOT 1',' ',NULL),(15,'root 2',' ',NULL),(16,'root 3',' ',NULL),(17,'root 4',' ',NULL),(18,'root 5',' ',NULL),(19,'root 6',' ',0),(20,'root 6',' ',0),(21,'root7',' ',0),(22,'root7',' ',0),(23,'root7',' ',0),(24,'root7',' ',0),(25,'root7',' ',0),(26,'root7',' ',0),(27,'root7',' ',0),(28,'dgdfg',' ',0),(29,'dgdfg',' ',0),(30,'dgdfg',' ',0);

/*Table structure for table `st_parent` */

DROP TABLE IF EXISTS `st_parent`;

CREATE TABLE `st_parent` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `idName` int(10) unsigned NOT NULL,
  `idParent` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `nameChild_idChild` (`idName`),
  KEY `nameParent_idParent` (`idParent`),
  CONSTRAINT `nameChild_idChild` FOREIGN KEY (`idName`) REFERENCES `st_elements` (`id`),
  CONSTRAINT `nameParent_idParent` FOREIGN KEY (`idParent`) REFERENCES `st_elements` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8;

/*Data for the table `st_parent` */

insert  into `st_parent`(`id`,`idName`,`idParent`) values (6,14,NULL),(7,15,NULL),(8,16,NULL),(9,17,NULL),(10,18,NULL),(11,19,NULL),(12,20,NULL),(13,21,NULL),(14,22,NULL),(15,23,NULL),(16,24,NULL),(17,25,NULL),(18,26,NULL),(19,27,NULL),(20,28,NULL),(21,29,NULL),(22,30,NULL);

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
