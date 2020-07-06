/*
SQLyog Ultimate v12.5.1 (64 bit)
MySQL - 5.6.43-log : Database - test_database
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`test_database` /*!40100 DEFAULT CHARACTER SET utf8 */;

USE `test_database`;

/*Table structure for table `authors` */

DROP TABLE IF EXISTS `authors`;

CREATE TABLE `authors` (
  `id` int(64) NOT NULL AUTO_INCREMENT,
  `name` varchar(128) NOT NULL,
  KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;

/*Data for the table `authors` */

insert  into `authors`(`id`,`name`) values 
(1,'Оруэл'),
(2,'Хаксли'),
(3,'Бредбери'),
(4,'Замятин'),
(8,'Эггерс');

/*Table structure for table `books` */

DROP TABLE IF EXISTS `books`;

CREATE TABLE `books` (
  `id` int(64) NOT NULL AUTO_INCREMENT,
  `name` varchar(128) NOT NULL,
  `author_id` int(64) NOT NULL,
  KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=utf8;

/*Data for the table `books` */

insert  into `books`(`id`,`name`,`author_id`) values 
(1,'Да здравствует фикус',1),
(2,'1984',1),
(3,'О дивный новый мир',2),
(4,'451 градус по фаренгейту',3),
(5,'Мы',4),
(6,'Север',4),
(7,'Ловец человеков',4),
(22,'Вино из одуванчиков',3),
(25,'Сфера',8);

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
