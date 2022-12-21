/*
SQLyog Ultimate v12.5.0 (64 bit)
MySQL - 10.4.19-MariaDB : Database - 15380_shawal_khan
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`lms` /*!40100 DEFAULT CHARACTER SET utf8mb4 */;

USE `lms`;

/*Table structure for table `batch_course` */

DROP TABLE IF EXISTS `batch_course`;

CREATE TABLE `batch_course` (
  `batch_course_id` int(11) NOT NULL AUTO_INCREMENT,
  `batch_id` int(11) DEFAULT NULL,
  `course_id` int(11) DEFAULT NULL,
  `status_id` int(11) DEFAULT NULL,
  `number_of_topics` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`batch_course_id`),
  KEY `batch_id` (`batch_id`),
  KEY `course_id` (`course_id`),
  CONSTRAINT `batch_course_ibfk_1` FOREIGN KEY (`batch_id`) REFERENCES `batches` (`batch_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `batch_course_ibfk_2` FOREIGN KEY (`course_id`) REFERENCES `courses` (`course_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=utf8mb4;

/*Data for the table `batch_course` */

insert  into `batch_course`(`batch_course_id`,`batch_id`,`course_id`,`status_id`,`number_of_topics`,`created_at`,`updated_at`) values 
(22,3,1,1,12,'2021-10-15 20:48:18','2021-10-20 12:10:09'),
(23,3,2,1,5,'2021-10-16 00:56:07','2021-10-20 12:14:31'),
(24,4,1,2,4,'2021-10-16 01:39:50','2021-10-20 11:46:22'),
(25,5,3,1,5,'2021-10-26 12:17:12','2021-10-26 12:29:00'),
(26,6,8,1,5,'2021-10-27 10:56:11',NULL);

/*Table structure for table `batch_course_topic` */

DROP TABLE IF EXISTS `batch_course_topic`;

CREATE TABLE `batch_course_topic` (
  `batch_course_topic_id` int(11) NOT NULL AUTO_INCREMENT,
  `batch_course_id` int(11) DEFAULT NULL,
  `topic_id` int(11) DEFAULT NULL,
  `status_id` int(11) DEFAULT NULL,
  `topic_priority` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`batch_course_topic_id`),
  KEY `batch_course_id` (`batch_course_id`),
  KEY `topic_id` (`topic_id`),
  KEY `status_id` (`status_id`),
  CONSTRAINT `batch_course_topic_ibfk_1` FOREIGN KEY (`batch_course_id`) REFERENCES `batch_course` (`batch_course_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `batch_course_topic_ibfk_2` FOREIGN KEY (`topic_id`) REFERENCES `topics` (`topic_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `batch_course_topic_ibfk_3` FOREIGN KEY (`status_id`) REFERENCES `status` (`status_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=66 DEFAULT CHARSET=utf8mb4;

/*Data for the table `batch_course_topic` */

insert  into `batch_course_topic`(`batch_course_topic_id`,`batch_course_id`,`topic_id`,`status_id`,`topic_priority`,`created_at`,`updated_at`) values 
(1,23,1,1,1,'2021-10-16 10:11:16',NULL),
(2,23,2,1,2,'2021-10-16 10:11:16',NULL),
(3,23,3,1,3,'2021-10-16 10:11:16',NULL),
(4,23,4,1,4,'2021-10-16 10:11:16',NULL),
(5,23,12,1,5,'2021-10-16 10:11:16',NULL),
(6,22,1,1,1,'2021-10-16 10:28:35',NULL),
(7,22,2,1,2,'2021-10-16 10:28:35',NULL),
(8,22,3,1,3,'2021-10-16 10:28:35',NULL),
(9,22,4,1,4,'2021-10-16 10:28:35',NULL),
(10,22,5,1,5,'2021-10-16 10:28:35',NULL),
(11,22,6,1,6,'2021-10-16 10:28:35',NULL),
(12,22,7,1,7,'2021-10-16 10:28:35',NULL),
(13,22,8,1,8,'2021-10-16 10:28:35',NULL),
(14,22,9,1,9,'2021-10-16 10:28:35',NULL),
(15,22,10,1,10,'2021-10-16 10:28:35',NULL),
(16,22,11,1,11,'2021-10-16 10:28:35',NULL),
(17,22,12,1,12,'2021-10-16 10:28:35',NULL),
(18,24,1,1,1,'2021-10-16 10:31:11',NULL),
(19,24,2,1,2,'2021-10-16 10:31:11',NULL),
(20,24,3,1,3,'2021-10-16 10:31:11',NULL),
(21,24,6,1,4,'2021-10-16 10:31:11',NULL),
(22,25,5,1,1,'2021-10-26 12:17:57',NULL),
(23,25,3,1,2,'2021-10-26 12:17:57',NULL),
(24,25,9,1,3,'2021-10-26 12:17:57',NULL),
(25,25,7,1,4,'2021-10-26 12:17:57',NULL),
(26,25,13,1,5,'2021-10-26 12:17:57',NULL),
(61,26,1,1,1,'2021-10-27 12:10:41',NULL),
(62,26,2,1,2,'2021-10-27 12:10:41',NULL),
(63,26,3,1,3,'2021-10-27 12:10:41',NULL),
(64,26,4,1,4,'2021-10-27 12:10:41',NULL),
(65,26,5,1,5,'2021-10-27 12:10:41',NULL);

/*Table structure for table `batches` */

DROP TABLE IF EXISTS `batches`;

CREATE TABLE `batches` (
  `batch_id` int(11) NOT NULL AUTO_INCREMENT,
  `status_id` int(11) DEFAULT NULL,
  `batch_title` varchar(100) DEFAULT NULL,
  `batch_description` text DEFAULT NULL,
  `batch_start_date` date DEFAULT NULL,
  `batch_end_date` date DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`batch_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4;

/*Data for the table `batches` */

insert  into `batches`(`batch_id`,`status_id`,`batch_title`,`batch_description`,`batch_start_date`,`batch_end_date`,`created_at`,`updated_at`) values 
(3,1,'2K21-JULY-NOVEMBER','THIS IS BATCH DESCRIPTION','2021-07-01','2021-11-30','2021-10-15 20:47:34','2021-10-20 01:22:54'),
(4,1,'2K21-JULY-SEPTEMBER','THIS IS DESCRIPTION','2021-09-27','2021-12-31','2021-10-16 01:39:17','2021-10-20 01:21:58'),
(5,1,'FEB-MAY','THIS IS FEB TO MAY BATCH','2021-02-01','2021-05-31','2021-10-26 12:16:43',NULL),
(6,1,'JANUARY-MAY','JANUARY TO MAY BATCH','2021-01-01','2021-05-30','2021-10-27 10:54:43',NULL);

/*Table structure for table `courses` */

DROP TABLE IF EXISTS `courses`;

CREATE TABLE `courses` (
  `course_id` int(11) NOT NULL AUTO_INCREMENT,
  `status_id` int(11) DEFAULT NULL,
  `course_title` varchar(100) DEFAULT NULL,
  `course_description` text DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`course_id`),
  KEY `status_id` (`status_id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4;

/*Data for the table `courses` */

insert  into `courses`(`course_id`,`status_id`,`course_title`,`course_description`,`created_at`,`updated_at`) values 
(1,1,'Web Development Using PHP With MySQL (Basic Level)','This hands-on course provides the knowledge necessary to design and develop dynamic, database-driven web pages using PHP version 8. PHP is a language written for the web, quick to learn, easy to deploy and provides substantial functionality required for e-commerce. This course introduces the PHP framework and syntax and covers in-depth the most important techniques used to build dynamic web sites. Comprehensive lab exercises provide facilitated hands on practise crucial to developing competence and confidence with the new skills being learned.','2021-10-12 00:03:22',NULL),
(2,1,'WEB DEVELOPMENT USING PHP WITH MYSQL (ADVANCE LEVEL)','This training is for those candidates who have completed PHP Basic Training from Hidaya Institute of Science and Technology(HIST) Jamshoro.','2021-10-12 01:11:43',NULL),
(3,1,'AsP.NET ','ASP.NET CORE WIATH AZURE DEVOPS','2021-10-12 01:13:16',NULL),
(4,2,'IOS APP DEVELOPMENT','IOS APP DEVELOPMENT WITH ADVANCE MODULES qweqe','2021-10-12 01:57:05',NULL),
(5,2,'English Language ','English Writing and Speaking Skills','2021-10-12 09:15:52',NULL),
(6,2,'English','Grammar','2021-10-12 12:38:13',NULL),
(7,2,'english Speakiing','english Speaking','2021-10-12 12:39:12',NULL),
(8,1,'ENGLISH LANGUAGE','ENGLISH LANGUAGE COURSE ','2021-10-27 09:13:11',NULL);

/*Table structure for table `roles` */

DROP TABLE IF EXISTS `roles`;

CREATE TABLE `roles` (
  `role_id` int(11) NOT NULL AUTO_INCREMENT,
  `status_id` int(11) DEFAULT NULL,
  `role_type` varchar(50) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`role_id`),
  KEY `status_id` (`status_id`),
  CONSTRAINT `roles_ibfk_1` FOREIGN KEY (`status_id`) REFERENCES `status` (`status_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;

/*Data for the table `roles` */

insert  into `roles`(`role_id`,`status_id`,`role_type`,`created_at`,`updated_at`) values 
(1,1,'Admin',NULL,NULL),
(2,1,'Teacher',NULL,NULL),
(3,1,'Student',NULL,NULL);

/*Table structure for table `status` */

DROP TABLE IF EXISTS `status`;

CREATE TABLE `status` (
  `status_id` int(11) NOT NULL AUTO_INCREMENT,
  `status` enum('Active','InActive','Enrolled','Disenrolled','InProcess','Completed') DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`status_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4;

/*Data for the table `status` */

insert  into `status`(`status_id`,`status`,`created_at`,`updated_at`) values 
(1,'Active',NULL,NULL),
(2,'InActive',NULL,NULL),
(3,'Completed',NULL,NULL),
(4,'InProcess',NULL,NULL),
(5,'Enrolled',NULL,NULL),
(6,'Disenrolled',NULL,NULL);

/*Table structure for table `topic_file` */

DROP TABLE IF EXISTS `topic_file`;

CREATE TABLE `topic_file` (
  `topic_file_id` int(11) NOT NULL AUTO_INCREMENT,
  `topic_id` int(11) DEFAULT NULL,
  `status_id` int(11) DEFAULT NULL,
  `file_name` varchar(100) DEFAULT NULL,
  `file_path` text DEFAULT NULL,
  `file_type` enum('doc','ppt','pdf','png','jpg','jpeg','pptx','docx') DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`topic_file_id`),
  KEY `topic_id` (`topic_id`),
  CONSTRAINT `topic_file_ibfk_1` FOREIGN KEY (`topic_id`) REFERENCES `topics` (`topic_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=utf8mb4;

/*Data for the table `topic_file` */

insert  into `topic_file`(`topic_file_id`,`topic_id`,`status_id`,`file_name`,`file_path`,`file_type`,`created_at`,`updated_at`) values 
(1,1,1,'file-sample_100kB.docx','../Topic Files/916583929file-sample_100kB.docx','docx','2021-10-27 09:35:38',NULL),
(2,1,1,'file-sample_100kB.doc','../Topic Files/1376209399file-sample_100kB.doc','doc','2021-10-27 09:35:38',NULL),
(3,1,1,'doc.jpg','../Topic Files/842360008doc.jpg','jpg','2021-10-27 09:35:38',NULL),
(4,1,1,'samplepptx.pptx','../Topic Files/1718168182samplepptx.pptx','pptx','2021-10-27 09:35:38',NULL),
(5,4,1,'1957021788doc.jpg','../Topic Files/4149522181957021788doc.jpg','jpg','2021-10-27 09:36:02',NULL),
(6,4,1,'user_record(12).doc','../Topic Files/782835679user_record(12).doc','doc','2021-10-27 09:36:02',NULL),
(7,2,1,'user_record(12).doc','../Topic Files/620435683user_record(12).doc','doc','2021-10-27 09:36:19',NULL),
(8,3,1,'Filling (Day-3)(1).ppt','../Topic Files/201712921Filling (Day-3)(1).ppt','ppt','2021-10-27 09:37:03',NULL),
(9,3,1,'Filling (Day-2)(1).ppt','../Topic Files/1745344108Filling (Day-2)(1).ppt','ppt','2021-10-27 09:37:03',NULL),
(10,12,1,'1571839725Database (Day-1)(1).pptx','../Topic Files/18994060071571839725Database (Day-1)(1).pptx','pptx','2021-10-27 09:37:19',NULL),
(11,12,1,'20864432samplepptx.pptx','../Topic Files/18511682520864432samplepptx.pptx','pptx','2021-10-27 09:37:19',NULL),
(12,12,1,'1957021788doc.jpg','../Topic Files/7223991771957021788doc.jpg','jpg','2021-10-27 09:37:19',NULL),
(13,12,1,'602560883file-sample_100kB.doc','../Topic Files/1449684330602560883file-sample_100kB.doc','doc','2021-10-27 09:37:19',NULL),
(14,7,2,'image.png','../Topic Files/144339738image.png','png','2021-10-27 09:55:22',NULL),
(15,7,2,'pdf.png','../Topic Files/1030569258pdf.png','png','2021-10-27 09:55:22',NULL),
(16,7,1,'ppt.png','../Topic Files/207598564ppt.png','png','2021-10-27 09:55:22',NULL),
(17,5,1,'user_record(13).doc','../Topic Files/900174031user_record(13).doc','doc','2021-10-27 09:56:05',NULL),
(18,5,1,'20864432samplepptx.pptx','../Topic Files/113641412620864432samplepptx.pptx','pptx','2021-10-27 09:56:05',NULL),
(19,9,1,'user_record(13).doc','../Topic Files/1193157775user_record(13).doc','doc','2021-10-27 09:56:20',NULL),
(20,7,1,'user_record(8).doc','../Topic Files/2144286699user_record(8).doc','doc','2021-10-27 09:56:33',NULL),
(21,13,1,'user_record(9).doc','../Topic Files/125720user_record(9).doc','doc','2021-10-27 09:56:51',NULL),
(22,6,1,'Learning Management System (SRS).pptx','../Topic Files/2044113973Learning Management System (SRS).pptx','pptx','2021-10-27 10:27:20',NULL),
(23,6,1,'sample-1.png','../Topic Files/454026492sample-1.png','png','2021-10-27 10:27:20',NULL),
(24,8,1,'Learning Management System (SRS).pptx','../Topic Files/625440325Learning Management System (SRS).pptx','pptx','2021-10-27 10:27:50',NULL),
(25,8,1,'sample-1.png','../Topic Files/1671746316sample-1.png','png','2021-10-27 10:27:50',NULL),
(26,11,1,'new.jpg','../Topic Files/892691934new.jpg','jpg','2021-10-27 12:34:00',NULL);

/*Table structure for table `topics` */

DROP TABLE IF EXISTS `topics`;

CREATE TABLE `topics` (
  `topic_id` int(11) NOT NULL AUTO_INCREMENT,
  `status_id` int(11) DEFAULT NULL,
  `topic_title` varchar(100) DEFAULT NULL,
  `topic_description` text DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`topic_id`),
  KEY `status_id` (`status_id`),
  CONSTRAINT `topics_ibfk_1` FOREIGN KEY (`status_id`) REFERENCES `status` (`status_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=40 DEFAULT CHARSET=utf8mb4;

/*Data for the table `topics` */

insert  into `topics`(`topic_id`,`status_id`,`topic_title`,`topic_description`,`created_at`,`updated_at`) values 
(1,1,'CSS',NULL,NULL,'2021-10-27 10:01:51'),
(2,1,'HTML',NULL,NULL,'2021-10-27 10:39:56'),
(3,1,'JAVASCRIPTS',NULL,NULL,NULL),
(4,1,'FUNCTIONS',NULL,NULL,NULL),
(5,1,'MODULES',NULL,NULL,'2021-10-26 12:39:33'),
(6,1,'LOOPS',NULL,NULL,NULL),
(7,1,'BRANCHING',NULL,NULL,'2021-10-22 09:13:38'),
(8,1,'VARIABLES',NULL,NULL,NULL),
(9,1,'EMAILING',NULL,NULL,NULL),
(10,1,'FILING',NULL,NULL,NULL),
(11,1,'ARRAY',NULL,NULL,'2021-10-24 17:30:33'),
(12,1,'SESSION',NULL,NULL,NULL),
(13,1,'COOKIES',NULL,NULL,NULL),
(14,1,'DATABASE',NULL,NULL,NULL),
(15,1,'OOP',NULL,NULL,NULL),
(16,1,'topic 2',NULL,NULL,NULL),
(17,1,'toopi 3',NULL,NULL,NULL),
(18,1,'topic 4',NULL,NULL,NULL),
(19,1,'topic 5',NULL,NULL,NULL),
(20,1,'topic 6',NULL,NULL,NULL),
(21,1,'OOP',NULL,NULL,NULL),
(22,1,'topic 2',NULL,NULL,NULL),
(23,1,'toopi 3',NULL,NULL,NULL),
(24,1,'topic 4',NULL,NULL,NULL),
(25,1,'topic 5',NULL,NULL,NULL),
(26,1,'topic 6',NULL,NULL,NULL),
(27,1,'OOP',NULL,NULL,NULL),
(28,1,'topic 2',NULL,NULL,NULL),
(29,1,'toopi 3',NULL,NULL,NULL),
(30,1,'topic 4',NULL,NULL,NULL),
(31,1,'topic 5',NULL,NULL,NULL),
(32,1,'topic 6',NULL,NULL,NULL),
(38,1,'hosting','hosting and trailsafnfa','2021-10-14 10:05:49',NULL),
(39,1,'BOOTSRAP VUE','SKHADASKDHLAS','2021-10-16 01:31:55',NULL);

/*Table structure for table `user_role` */

DROP TABLE IF EXISTS `user_role`;

CREATE TABLE `user_role` (
  `user_role_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `role_id` int(11) DEFAULT NULL,
  `status_id` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`user_role_id`),
  KEY `user_id` (`user_id`),
  KEY `role_id` (`role_id`),
  KEY `status_id` (`status_id`),
  CONSTRAINT `user_role_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `user_role_ibfk_2` FOREIGN KEY (`role_id`) REFERENCES `roles` (`role_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `user_role_ibfk_3` FOREIGN KEY (`status_id`) REFERENCES `status` (`status_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=134 DEFAULT CHARSET=utf8mb4;

/*Data for the table `user_role` */

insert  into `user_role`(`user_role_id`,`user_id`,`role_id`,`status_id`,`created_at`,`updated_at`) values 
(97,51,3,1,NULL,NULL),
(98,50,3,1,NULL,NULL),
(99,49,3,1,NULL,NULL),
(100,48,3,1,NULL,NULL),
(101,47,3,1,NULL,NULL),
(102,46,3,1,NULL,NULL),
(103,44,3,1,NULL,NULL),
(104,36,2,1,NULL,'2021-10-25 11:55:58'),
(105,37,1,1,NULL,NULL),
(106,37,2,1,NULL,NULL),
(107,42,2,1,NULL,'2021-10-25 12:02:43'),
(108,42,3,1,NULL,NULL),
(109,37,3,1,NULL,NULL),
(110,36,3,1,'2021-10-21 10:12:47',NULL),
(115,72,3,1,'2021-10-25 10:05:50',NULL),
(116,73,3,1,'2021-10-25 10:20:34',NULL),
(117,74,3,1,'2021-10-25 10:26:28',NULL),
(118,75,3,1,'2021-10-25 10:27:18',NULL),
(119,77,3,1,'2021-10-25 10:30:07',NULL),
(120,78,3,1,'2021-10-25 10:31:04',NULL),
(121,79,3,1,'2021-10-25 10:33:21',NULL),
(122,36,1,2,'2021-10-25 12:03:41','2021-10-27 09:11:54'),
(123,80,2,1,'2021-10-26 12:19:09',NULL),
(124,81,2,1,'2021-10-26 12:19:59',NULL),
(125,82,3,1,'2021-10-26 12:20:26',NULL),
(126,83,3,1,'2021-10-26 12:20:37',NULL),
(127,84,3,1,'2021-10-26 12:20:58',NULL),
(128,85,3,1,'2021-10-26 12:21:21',NULL),
(129,86,3,1,'2021-10-26 12:21:40',NULL),
(130,87,3,1,'2021-10-26 12:22:21',NULL),
(131,88,3,1,'2021-10-26 12:22:41',NULL),
(132,89,3,1,'2021-10-27 09:42:03',NULL);

/*Table structure for table `user_role_batch_course_enrollment` */

DROP TABLE IF EXISTS `user_role_batch_course_enrollment`;

CREATE TABLE `user_role_batch_course_enrollment` (
  `enrollment_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_role_id` int(11) DEFAULT NULL,
  `batch_course_id` int(11) DEFAULT NULL,
  `status_id` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`enrollment_id`),
  KEY `user_role_id` (`user_role_id`),
  KEY `batch_course_id` (`batch_course_id`),
  KEY `status_id` (`status_id`),
  CONSTRAINT `user_role_batch_course_enrollment_ibfk_1` FOREIGN KEY (`user_role_id`) REFERENCES `user_role` (`user_role_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `user_role_batch_course_enrollment_ibfk_2` FOREIGN KEY (`batch_course_id`) REFERENCES `batch_course` (`batch_course_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `user_role_batch_course_enrollment_ibfk_3` FOREIGN KEY (`status_id`) REFERENCES `status` (`status_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=35 DEFAULT CHARSET=utf8mb4;

/*Data for the table `user_role_batch_course_enrollment` */

insert  into `user_role_batch_course_enrollment`(`enrollment_id`,`user_role_id`,`batch_course_id`,`status_id`,`created_at`,`updated_at`) values 
(1,104,22,5,'2021-10-20 12:18:03',NULL),
(2,106,22,5,'2021-10-20 12:18:10',NULL),
(3,108,22,5,'2021-10-20 12:18:16',NULL),
(4,103,22,5,'2021-10-20 12:18:26',NULL),
(5,102,22,5,'2021-10-20 12:18:36',NULL),
(6,101,22,5,'2021-10-20 12:18:41',NULL),
(7,100,22,5,'2021-10-20 12:18:45',NULL),
(8,104,23,5,'2021-10-20 12:34:35',NULL),
(9,106,23,5,'2021-10-20 12:34:44',NULL),
(12,121,23,5,'2021-10-25 10:37:19',NULL),
(13,120,23,5,'2021-10-25 10:37:31',NULL),
(14,119,23,5,'2021-10-25 10:37:42',NULL),
(15,118,23,5,'2021-10-25 10:37:50',NULL),
(16,117,23,5,'2021-10-25 10:37:57',NULL),
(17,116,22,5,'2021-10-25 10:38:02',NULL),
(18,115,22,5,'2021-10-25 10:38:09',NULL),
(19,97,23,5,'2021-10-25 10:38:23',NULL),
(20,98,23,5,'2021-10-25 10:38:31',NULL),
(21,123,25,5,'2021-10-26 12:23:42',NULL),
(22,124,25,5,'2021-10-26 12:23:51',NULL),
(23,125,25,5,'2021-10-26 12:24:00',NULL),
(24,126,25,5,'2021-10-26 12:24:40',NULL),
(25,127,25,5,'2021-10-26 12:24:46',NULL),
(26,128,25,5,'2021-10-26 12:24:52',NULL),
(27,129,25,5,'2021-10-26 12:24:58',NULL),
(28,130,25,3,'2021-10-26 12:25:05','2021-10-27 09:30:02'),
(29,131,25,5,'2021-10-26 12:25:15',NULL),
(30,130,22,3,'2021-10-27 09:19:30','2021-10-27 09:32:13'),
(31,130,23,5,'2021-10-27 09:33:12',NULL),
(32,132,25,5,'2021-10-27 09:43:04','2021-10-27 09:48:26');

/*Table structure for table `users` */

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `approved_by` int(11) DEFAULT NULL,
  `status_id` int(11) DEFAULT NULL,
  `first_name` varchar(100) DEFAULT NULL,
  `last_name` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `password` text DEFAULT NULL,
  `gender` enum('Male','Female') DEFAULT NULL,
  `date_of_birth` date DEFAULT NULL,
  `image` varchar(255) DEFAULT '../images/profile images/dummy.png',
  `home_town` text DEFAULT NULL,
  `is_approve` enum('Pending','Approved','Rejected') DEFAULT 'Pending',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `email` (`email`),
  KEY `approved_by` (`approved_by`),
  CONSTRAINT `users_ibfk_1` FOREIGN KEY (`approved_by`) REFERENCES `user_role` (`user_role_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=91 DEFAULT CHARSET=utf8mb4;

/*Data for the table `users` */

insert  into `users`(`user_id`,`approved_by`,`status_id`,`first_name`,`last_name`,`email`,`password`,`gender`,`date_of_birth`,`image`,`home_town`,`is_approve`,`created_at`,`updated_at`) values 
(36,NULL,1,'Ali','Asad','aliasad@gmail.com','pass123','Male',NULL,'../images/profile images/dummy.png',NULL,'Approved','2021-10-08 09:48:21','2021-10-27 09:11:06'),
(37,NULL,1,'Shawal ','Khan ','shawalsahito@gmail.com','pass123','Male','1997-02-22','../images/profile images/1948661135index.jpg','Nawabshah','Approved','2021-10-08 11:32:18','2021-10-21 10:52:53'),
(42,NULL,1,'Muhammad','Yousif','myousifburiro201@gmail.com','pass123','Male',NULL,'../images/profile images/dummy.png',NULL,'Approved','2021-10-11 09:20:52',NULL),
(44,NULL,1,'Aftab','Kamboh','aftabkamboh5@gmail.com','pass123','Male',NULL,'../images/profile images/dummy.png',NULL,'Approved','2021-10-11 11:50:03',NULL),
(46,NULL,1,'shoaib','ahmed','shoiabahmed@gmail.com','pass123','Male',NULL,'../images/profile images/dummy.png',NULL,'Approved','2021-10-16 12:16:01',NULL),
(47,NULL,1,'shahzad','ahmed','shahzadahmed@gmail.com','pass123','Male',NULL,'../images/profile images/dummy.png',NULL,'Approved','2021-10-16 12:16:25',NULL),
(48,NULL,1,'zaheer','khan','zaheerkhan@gmail.com','pass123','Male',NULL,'../images/profile images/dummy.png',NULL,'Approved','2021-10-16 12:16:47',NULL),
(49,NULL,1,'rafique','khan','rafiquekhan@gmail.com','pass123','Male',NULL,'../images/profile images/dummy.png',NULL,'Approved','2021-10-16 12:17:10',NULL),
(50,NULL,1,'shahid ','afridi','shahidafridi@gmail.com','pass123','Male',NULL,'../images/profile images/dummy.png',NULL,'Approved','2021-10-16 12:17:41',NULL),
(51,NULL,1,'Muhammad','Hafiz','mhafeez@gmail.com','pass123','Male',NULL,'../images/profile images/dummy.png',NULL,'Approved','2021-10-16 12:18:21',NULL),
(72,105,1,'shakeel','ahmed','shakeel@gmail.com','pass123','Male','1997-09-22','../images/profile images/dummy.png','Nawabshah','Approved','2021-10-25 10:05:50','2021-10-25 10:06:23'),
(73,105,1,'shoaib','khan','shoaib@gmail.com','pass123','Male','2001-02-02','../images/profile images/dummy.png','Hyderabad','Approved','2021-10-25 10:20:34','2021-10-25 10:34:26'),
(74,105,1,'Hitesh','Kumar','hiteshkumarkunri@gmail.com','pass123','Male','1997-12-09','../images/profile images/dummy.png','Kunri','Approved','2021-10-25 10:26:28','2021-10-25 10:34:29'),
(75,105,1,'farhan','farhan','farhanarain@gmail.com','pass123','Male','1998-02-22','../images/profile images/dummy.png','Nawabshah','Approved','2021-10-25 10:27:18','2021-10-25 10:34:32'),
(77,105,1,'Naveed','Ahmed','Naved@gmail.com','pass123','Male','1998-02-21','../images/profile images/927631905598837978index.jpg','Nawabshah','Approved','2021-10-25 10:30:07','2021-10-25 10:34:35'),
(78,105,1,'Zaheer','Ali','zaheerali@gmail.com','pass123','Male','1999-02-22','../images/profile images/195906430024476414index.jpg','Jamshoro','Approved','2021-10-25 10:31:04','2021-10-25 10:34:44'),
(79,105,1,'Shahzeb','Gull','Shahzeb@gmail.com','pass123','Male','1997-02-22','../images/profile images/403541302195906430024476414index.jpg','Nawabshah','Approved','2021-10-25 10:33:21','2021-10-25 10:34:49'),
(80,NULL,1,'Shaheer','Channa','shaheer@gmail.com','pass123','Male',NULL,'../images/profile images/94298122index.jpg',NULL,'Approved','2021-10-26 12:19:09',NULL),
(81,NULL,1,'Majeed','Ahmed','majeed@gmail.com','pass123','Male',NULL,'../images/profile images/663719696index.jpg',NULL,'Approved','2021-10-26 12:19:59',NULL),
(82,NULL,1,'shahzain','Ahmed','shahzain@gmail.com','pass123','Male',NULL,'../images/profile images/1906826973index.jpg',NULL,'Approved','2021-10-26 12:20:26',NULL),
(83,NULL,1,'shahzaman','Ahmed','shahzaman@gmail.com','pass123','Male',NULL,'../images/profile images/1588448244index.jpg',NULL,'Approved','2021-10-26 12:20:37',NULL),
(84,NULL,1,'Rizwan','Ahmed','rizwan@gmail.com','pass123','Male',NULL,'../images/profile images/2044805931index.jpg',NULL,'Approved','2021-10-26 12:20:58',NULL),
(85,NULL,1,'Hassan','Ali','hassan@gmail.com','pass123','Male',NULL,'../images/profile images/1849785904index.jpg',NULL,'Approved','2021-10-26 12:21:21',NULL),
(86,NULL,1,'Muhammad','Ali','mali@gmail.com','pass123','Male',NULL,'../images/profile images/885550149index.jpg',NULL,'Approved','2021-10-26 12:21:40',NULL),
(87,NULL,1,'Muhammad','Hassan','mhassan@gmail.com','pass123','Male',NULL,'../images/profile images/38418989index.jpg',NULL,'Approved','2021-10-26 12:22:21',NULL),
(88,NULL,1,'Shahzaib','Hassan','shassan@gmail.com','pass123','Male',NULL,'../images/profile images/1094168088index.jpg',NULL,'Approved','2021-10-26 12:22:41',NULL),
(89,105,1,'Jahangir','Khan','jahangir@gmail.com','pass123','Male','1996-10-28','../images/profile images/299274605image.png','jacobabad','Approved','2021-10-27 09:42:03','2021-10-27 09:42:37');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
