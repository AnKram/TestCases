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

/*Table structure for table `credits` */

DROP TABLE IF EXISTS `credits`;

CREATE TABLE `credits` (
  `id` int(128) NOT NULL AUTO_INCREMENT,
  `cred_no` float NOT NULL,
  `cred_date` date NOT NULL,
  `cred_sum` float NOT NULL,
  KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

/*Data for the table `credits` */

insert  into `credits`(`id`,`cred_no`,`cred_date`,`cred_sum`) values 
(1,124,'2020-06-09',343),
(2,233,'2020-06-03',234.45),
(3,432,'2020-06-01',343),
(4,235,'2020-06-16',343),
(5,236,'2020-06-12',2343),
(6,237,'2020-06-02',23423),
(7,238,'2020-06-06',23534);

/*Table structure for table `payments` */

DROP TABLE IF EXISTS `payments`;

CREATE TABLE `payments` (
  `id` int(64) NOT NULL AUTO_INCREMENT,
  `cred_id` int(64) DEFAULT NULL,
  `data_set` blob NOT NULL,
  KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;

/*Data for the table `payments` */

insert  into `payments`(`id`,`cred_id`,`data_set`) values 
(1,1,'{\"data\":45}'),
(2,2,'{\"data\":23}'),
(3,3,'{\"data\":2}'),
(4,NULL,'{\"data\":2}'),
(5,7,'{\"data\":2}'),
(6,4,''),
(7,6,''),
(8,NULL,'{\"data\":2}'),
(9,NULL,'{\"data\":232}'),
(10,5,'');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
