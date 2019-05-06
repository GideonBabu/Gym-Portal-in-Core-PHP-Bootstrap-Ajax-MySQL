/*
SQLyog Community v9.63 
MySQL - 5.5.5-10.1.38-MariaDB : Database - virtuagym
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`virtuagym` /*!40100 DEFAULT CHARACTER SET latin1 */;

USE `virtuagym`;

/*Table structure for table `exercise` */

DROP TABLE IF EXISTS `exercise`;

CREATE TABLE `exercise` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `exercise_name` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

/*Data for the table `exercise` */

insert  into `exercise`(`id`,`exercise_name`) values (1,'Crunch'),(2,'Air squat'),(3,'Windmill'),(4,'Push-up'),(5,'Rowing Machine'),(6,'Walking'),(7,'Running');

/*Table structure for table `exercise_instances` */

DROP TABLE IF EXISTS `exercise_instances`;

CREATE TABLE `exercise_instances` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `exercise_id` int(11) NOT NULL,
  `day_id` int(11) NOT NULL COMMENT 'optional, filled when this is part of a trainingplan (day)',
  `exercise_duration` int(11) NOT NULL DEFAULT '0' COMMENT 'duration in seconds',
  `order` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=latin1;

/*Data for the table `exercise_instances` */

insert  into `exercise_instances`(`id`,`exercise_id`,`day_id`,`exercise_duration`,`order`) values (4,1,2,150,1),(5,2,2,300,2),(6,3,2,300,3),(7,4,2,500,4),(8,4,4,0,0),(9,5,17,0,0),(13,4,1,1,0),(14,5,1,300,0),(15,6,1,900,0),(16,7,1,900,0);

/*Table structure for table `plan` */

DROP TABLE IF EXISTS `plan`;

CREATE TABLE `plan` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `plan_name` varchar(150) NOT NULL COMMENT 'contains plan name',
  `plan_description` text NOT NULL COMMENT 'contains plan description (optional)',
  `plan_difficulty` int(1) NOT NULL DEFAULT '1' COMMENT '1=beginner,2=intermediate,3=expert',
  `user_id` int(11) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1 COMMENT='contains basic plan data';

/*Data for the table `plan` */

insert  into `plan`(`id`,`plan_name`,`plan_description`,`plan_difficulty`,`user_id`) values (1,'Gideon\'s plan for March 2019','work out plan description',2,3);

/*Table structure for table `plan_days` */

DROP TABLE IF EXISTS `plan_days`;

CREATE TABLE `plan_days` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `plan_id` int(11) NOT NULL COMMENT 'id from plan table',
  `day_name` varchar(100) NOT NULL DEFAULT '' COMMENT 'name for this day, optional',
  `order` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=latin1;

/*Data for the table `plan_days` */

insert  into `plan_days`(`id`,`plan_id`,`day_name`,`order`) values (1,1,'Day 1 - Cardio',1),(2,1,'Day 2 - Other exercises',2),(4,1,'Day 3 - Chest',2),(17,1,'Day 4 - Wings',4);

/*Table structure for table `user` */

DROP TABLE IF EXISTS `user`;

CREATE TABLE `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `firstname` varchar(100) NOT NULL,
  `lastname` varchar(100) DEFAULT NULL,
  `email` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

/*Data for the table `user` */

insert  into `user`(`id`,`firstname`,`lastname`,`email`) values (3,'Gideon','Babu','gideonvbabu@gmail.com');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
