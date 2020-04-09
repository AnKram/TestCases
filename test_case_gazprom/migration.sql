/*
SQLyog Ultimate v12.5.1 (64 bit)
MySQL - 5.6.43 : Database - test_database
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

/*Table structure for table `tree` */

DROP TABLE IF EXISTS `tree`;

CREATE TABLE `tree` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `row_position` varchar(128) DEFAULT NULL,
  `title` varchar(150) DEFAULT NULL,
  `price` varchar(128) DEFAULT NULL,
  KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=47 DEFAULT CHARSET=utf8;

/*Data for the table `tree` */

insert  into `tree`(`id`,`row_position`,`title`,`price`) values 
(1,'1.2','test','689.00'),
(2,'2.7','op','12.00'),
(3,'1.1','работы по дому','2333.00'),
(4,'2.1','уборка','450.00'),
(5,'2.1.4','уборка на предприятии','3450.00'),
(9,'1.1.7','сварка','390.23'),
(17,'13','ddfgdfg','32432.00'),
(19,'14','vxcv','xcvx'),
(20,'15','sfsdf','123'),
(37,'3','Безопасность','235.00'),
(38,'3.1','Пожарная безопасность','1020.00'),
(39,'3.1.1.','Огнетушители','1000.00'),
(40,'3.2','Радиационная безопасность','1200.00'),
(41,'6.1.5','sdgd','12'),
(42,'6.1.2','fgdfg','234'),
(43,'6.2.1','fdf','655'),
(44,'6.1.4','sdfsd','2334'),
(45,'7.5','sdf','345'),
(46,'6.2','sdfgdf','3453');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
