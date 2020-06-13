/*
SQLyog Ultimate v11.11 (64 bit)
MySQL - 5.5.5-10.1.38-MariaDB : Database - joshuafinkel
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`joshuafinkel` /*!40100 DEFAULT CHARACTER SET utf8mb4 */;

USE `joshuafinkel`;

/*Table structure for table `menus` */

DROP TABLE IF EXISTS `menus`;

CREATE TABLE `menus` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `module_id` int(10) unsigned NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `icon` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `position` tinyint(4) NOT NULL DEFAULT '0',
  `is_protected` tinyint(4) NOT NULL DEFAULT '0',
  `static` tinyint(4) NOT NULL DEFAULT '0',
  `status` tinyint(4) NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `menus_module_id_foreign` (`module_id`),
  CONSTRAINT `menus_module_id_foreign` FOREIGN KEY (`module_id`) REFERENCES `modules` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `menus` */

insert  into `menus`(`id`,`module_id`,`name`,`icon`,`slug`,`position`,`is_protected`,`static`,`status`,`created_at`,`updated_at`,`deleted_at`) values (1,1,'Dashboard','fa fa-dashboard','dashboard',1,1,0,1,'2020-06-01 23:59:15','2020-06-01 23:59:15',NULL),(2,3,'Users','fa fa-user','users',2,1,0,1,'2020-06-01 23:59:15','2020-06-01 23:59:15',NULL),(3,4,'Roles','fa fa-edit','roles',3,1,0,1,'2020-06-01 23:59:15','2020-06-01 23:59:15',NULL),(4,5,'Permissions','fa fa-check-square-o','permissions',4,1,0,1,'2020-06-01 23:59:15','2020-06-01 23:59:15',NULL),(5,6,'Modules','fa fa-database','modules',5,1,0,1,'2020-06-01 23:59:15','2020-06-01 23:59:15',NULL),(6,7,'Languages','fa fa-comments-o','languages',6,1,0,1,'2020-06-01 23:59:15','2020-06-01 23:59:15',NULL),(7,8,'Pages','fa fa-wpforms','pages',7,1,0,1,'2020-06-01 23:59:15','2020-06-01 23:59:15',NULL),(8,9,'Menus','fa fa-th','menus',8,1,0,1,'2020-06-01 23:59:15','2020-06-01 23:59:15',NULL),(9,10,'Contact us','fa fa-mail-forward','contactus',9,1,0,1,'2020-06-01 23:59:15','2020-06-01 23:59:15',NULL),(10,11,'Notifications','fa fa-bell','notifications',10,1,0,1,'2020-06-01 23:59:15','2020-06-01 23:59:15',NULL),(11,12,'Settings','fa fa-gears','settings',11,1,0,1,'2020-06-01 23:59:15','2020-06-01 23:59:15',NULL),(13,14,'Email Templates','fa fa-glass','email-templates',12,0,0,1,'2020-06-01 19:17:45','2020-06-01 19:17:45',NULL),(14,15,'Slots','fa fa-table','slots',13,0,0,1,'2020-06-05 06:55:02','2020-06-06 11:14:50',NULL),(15,16,'Products','fa fa-product-hunt','products',14,0,0,1,'2020-06-06 10:01:58','2020-06-06 10:01:58',NULL);

/*Table structure for table `migrations` */

DROP TABLE IF EXISTS `migrations`;

CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `migrations` */

insert  into `migrations`(`id`,`migration`,`batch`) values (1,'2014_10_12_000000_create_users_table',1),(2,'2014_10_12_100000_create_password_resets_table',1),(3,'2018_04_06_081644_entrust_setup_tables',1),(4,'2018_04_06_134936_create_modules_table',1),(5,'2018_04_09_111106_add_soft_delete_in_users_table',1),(6,'2018_04_09_152013_create_menus_table',1),(7,'2018_07_12_083021_create_locales_table',1),(8,'2018_07_12_084644_create_pages_table',1),(9,'2018_07_13_181040_create_notification_table',1),(10,'2018_07_13_191027_create_admin_query_table',1),(11,'2018_10_02_055325_create_settings_table',1);

/*Table structure for table `modules` */

DROP TABLE IF EXISTS `modules`;

CREATE TABLE `modules` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `table_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `icon` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '0',
  `is_module` tinyint(4) NOT NULL DEFAULT '0',
  `config` text COLLATE utf8mb4_unicode_ci,
  `is_protected` tinyint(4) NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `modules` */

insert  into `modules`(`id`,`name`,`slug`,`table_name`,`icon`,`status`,`is_module`,`config`,`is_protected`,`created_at`,`updated_at`,`deleted_at`) values (1,'Admin Panel','adminpanel','-','fa fa-dashboard',1,0,'null',1,'2020-06-01 23:59:15','2020-06-01 23:59:15',NULL),(2,'Dashboard','dashboard','-','fa fa-dashboard',1,0,'null',1,'2020-06-01 23:59:15','2020-06-01 23:59:15',NULL),(3,'Users','users','users','fa fa-user',1,1,'null',1,'2020-06-01 23:59:15','2020-06-01 23:59:15',NULL),(4,'Roles','roles','roles','fa fa-edit',1,1,'null',1,'2020-06-01 23:59:15','2020-06-01 23:59:15',NULL),(5,'Permissions','permissions','permissions','fa fa-check-square-o',1,1,'null',1,'2020-06-01 23:59:15','2020-06-01 23:59:15',NULL),(6,'Modules','modules','modules','fa fa-database',1,1,'null',1,'2020-06-01 23:59:15','2020-06-01 23:59:15',NULL),(7,'Languages','languages','locales','fa fa-comments-o',1,1,'null',1,'2020-06-01 23:59:15','2020-06-01 23:59:15',NULL),(8,'Page','pages','pages','fa fa-wpforms',1,1,'null',1,'2020-06-01 23:59:15','2020-06-01 23:59:15',NULL),(9,'ContactUs','contactus','admin_queries','fa fa-mail-forward',1,1,'null',1,'2020-06-01 23:59:15','2020-06-01 23:59:15',NULL),(10,'Notification','notifications','notifications','fa fa-bell',1,1,'null',1,'2020-06-01 23:59:15','2020-06-01 23:59:15',NULL),(11,'Menu','menus','menus','fa fa-th',1,1,'null',1,'2020-06-01 23:59:15','2020-06-01 23:59:15',NULL),(12,'Setting','settings','app_settings','fa fa-gears',1,1,'[{\"name\":\"id\",\"primary\":true,\"dbType\":\"increments\",\"fillable\":false,\"inForm\":false,\"htmlType\":false,\"validations\":false,\"inIndex\":false,\"searchable\":false},{\"name\":\"default_language\",\"primary\":false,\"dbType\":\"string,191\",\"fillable\":true,\"inForm\":true,\"htmlType\":\"select\",\"validations\":\"required|exists:locales,code\",\"inIndex\":true,\"searchable\":true},{\"name\":\"email\",\"primary\":false,\"dbType\":\"string,191\",\"fillable\":true,\"inForm\":true,\"htmlType\":\"email\",\"validations\":\"required|email\",\"inIndex\":true,\"searchable\":true},{\"name\":\"logo\",\"primary\":false,\"dbType\":\"string,191\",\"fillable\":true,\"inForm\":true,\"htmlType\":\"text\",\"validations\":\"required|image|mimetypes:text\\/plain,...\",\"inIndex\":true,\"searchable\":true},{\"name\":\"phone\",\"primary\":false,\"dbType\":\"string,191\",\"fillable\":true,\"inForm\":true,\"htmlType\":\"text\",\"validations\":\"required\",\"inIndex\":true,\"searchable\":true},{\"name\":\"latitude\",\"primary\":false,\"dbType\":\"string,191\",\"fillable\":true,\"inForm\":true,\"htmlType\":\"number\",\"validations\":\"required\",\"inIndex\":false,\"searchable\":false},{\"name\":\"longitude\",\"primary\":false,\"dbType\":\"string,191\",\"fillable\":true,\"inForm\":true,\"htmlType\":\"number\",\"validations\":\"required\",\"inIndex\":false,\"searchable\":false},{\"name\":\"playstore\",\"primary\":false,\"dbType\":\"string,191\",\"fillable\":true,\"inForm\":true,\"htmlType\":\"text\",\"validations\":\"required\",\"inIndex\":false,\"searchable\":false},{\"name\":\"appstore\",\"primary\":false,\"dbType\":\"string,191\",\"fillable\":true,\"inForm\":true,\"htmlType\":\"text\",\"validations\":\"required\",\"inIndex\":false,\"searchable\":false},{\"name\":\"social_links\",\"primary\":false,\"dbType\":\"text,65535\",\"fillable\":true,\"inForm\":true,\"htmlType\":\"text\",\"validations\":\"required\",\"inIndex\":false,\"searchable\":false},{\"name\":\"app_version\",\"primary\":false,\"dbType\":\"float\",\"fillable\":true,\"inForm\":true,\"htmlType\":\"number\",\"validations\":\"required\",\"inIndex\":true,\"searchable\":true},{\"name\":\"force_update\",\"primary\":false,\"dbType\":\"string,191\",\"fillable\":true,\"inForm\":true,\"htmlType\":\"checkbox\",\"validations\":\"required\",\"inIndex\":true,\"searchable\":true},{\"name\":\"created_at\",\"primary\":false,\"dbType\":\"datetime\",\"fillable\":false,\"inForm\":false,\"htmlType\":false,\"validations\":false,\"inIndex\":true,\"searchable\":true},{\"name\":\"updated_at\",\"primary\":false,\"dbType\":\"datetime\",\"fillable\":false,\"inForm\":false,\"htmlType\":false,\"validations\":false,\"inIndex\":false,\"searchable\":false},{\"name\":\"deleted_at\",\"primary\":false,\"dbType\":\"datetime\",\"fillable\":false,\"inForm\":false,\"htmlType\":false,\"validations\":false,\"inIndex\":false,\"searchable\":false}]',1,'2020-06-01 23:59:15','2020-06-01 23:59:15',NULL),(14,'EmailTemplate','email-templates','email_template','fa fa-glass',1,1,'[{\"name\":\"id\",\"primary\":true,\"dbType\":\"increments\",\"fillable\":false,\"inForm\":false,\"htmlType\":false,\"validations\":false,\"inIndex\":false,\"searchable\":false},{\"name\":\"title\",\"primary\":false,\"dbType\":\"string,255\",\"fillable\":true,\"inForm\":true,\"htmlType\":\"text\",\"validations\":\"required\",\"inIndex\":true,\"searchable\":true},{\"name\":\"subject\",\"primary\":false,\"dbType\":\"text,65535\",\"fillable\":true,\"inForm\":true,\"htmlType\":\"text\",\"validations\":\"required\",\"inIndex\":true,\"searchable\":true},{\"name\":\"body\",\"primary\":false,\"dbType\":\"text,65535\",\"fillable\":true,\"inForm\":true,\"htmlType\":\"text\",\"validations\":\"required\",\"inIndex\":true,\"searchable\":true},{\"name\":\"created_at\",\"primary\":false,\"dbType\":\"datetime\",\"fillable\":false,\"inForm\":false,\"htmlType\":false,\"validations\":false,\"inIndex\":false,\"searchable\":false},{\"name\":\"updated_at\",\"primary\":false,\"dbType\":\"datetime\",\"fillable\":false,\"inForm\":false,\"htmlType\":false,\"validations\":false,\"inIndex\":false,\"searchable\":false},{\"name\":\"deleted_at\",\"primary\":false,\"dbType\":\"datetime\",\"fillable\":false,\"inForm\":false,\"htmlType\":false,\"validations\":false,\"inIndex\":false,\"searchable\":false}]',0,'2020-06-01 19:17:31','2020-06-01 19:17:44',NULL),(15,'Slot','slots','slots','fa fa-table',1,1,'[{\"name\":\"id\",\"primary\":true,\"dbType\":\"increments\",\"fillable\":false,\"inForm\":false,\"htmlType\":false,\"validations\":false,\"inIndex\":false,\"searchable\":false},{\"name\":\"title\",\"primary\":false,\"dbType\":\"string,11\",\"fillable\":true,\"inForm\":true,\"htmlType\":\"text\",\"validations\":\"required\",\"inIndex\":true,\"searchable\":true},{\"name\":\"time\",\"primary\":false,\"dbType\":\"datetime\",\"fillable\":true,\"inForm\":true,\"htmlType\":\"text\",\"validations\":\"required\",\"inIndex\":true,\"searchable\":true},{\"name\":\"created_at\",\"primary\":false,\"dbType\":\"datetime\",\"fillable\":false,\"inForm\":false,\"htmlType\":false,\"validations\":false,\"inIndex\":false,\"searchable\":false},{\"name\":\"updated_at\",\"primary\":false,\"dbType\":\"datetime\",\"fillable\":false,\"inForm\":false,\"htmlType\":false,\"validations\":false,\"inIndex\":false,\"searchable\":false},{\"name\":\"deleted_at\",\"primary\":false,\"dbType\":\"datetime\",\"fillable\":false,\"inForm\":false,\"htmlType\":false,\"validations\":false,\"inIndex\":false,\"searchable\":false}]',0,'2020-06-05 06:54:50','2020-06-05 06:55:02',NULL),(16,'Product','products','products','fa fa-product-hunt',1,1,'[{\"name\":\"id\",\"primary\":true,\"dbType\":\"increments\",\"fillable\":false,\"inForm\":false,\"htmlType\":false,\"validations\":false,\"inIndex\":false,\"searchable\":false},{\"name\":\"title\",\"primary\":false,\"dbType\":\"string,199\",\"fillable\":true,\"inForm\":true,\"htmlType\":\"text\",\"validations\":\"required\",\"inIndex\":true,\"searchable\":true},{\"name\":\"created_at\",\"primary\":false,\"dbType\":\"datetime\",\"fillable\":false,\"inForm\":false,\"htmlType\":false,\"validations\":false,\"inIndex\":false,\"searchable\":false},{\"name\":\"updated_at\",\"primary\":false,\"dbType\":\"datetime\",\"fillable\":false,\"inForm\":false,\"htmlType\":false,\"validations\":false,\"inIndex\":false,\"searchable\":false},{\"name\":\"deleted_at\",\"primary\":false,\"dbType\":\"datetime\",\"fillable\":false,\"inForm\":false,\"htmlType\":false,\"validations\":false,\"inIndex\":false,\"searchable\":false}]',0,'2020-06-06 10:01:41','2020-06-06 10:01:58',NULL);

/*Table structure for table `permission_role` */

DROP TABLE IF EXISTS `permission_role`;

CREATE TABLE `permission_role` (
  `permission_id` int(10) unsigned NOT NULL,
  `role_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`permission_id`,`role_id`),
  KEY `permission_role_role_id_foreign` (`role_id`),
  CONSTRAINT `permission_role_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `permission_role_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `permission_role` */

insert  into `permission_role`(`permission_id`,`role_id`) values (1,1),(1,2),(2,1),(2,2),(3,1),(3,2),(4,1),(4,2),(5,1),(5,2),(6,1),(6,2),(7,1),(7,2),(8,1),(8,2),(9,1),(9,2),(10,1),(10,2),(11,1),(11,2),(12,1),(12,2),(13,1),(14,1),(15,1),(16,1),(17,1),(18,1),(19,1),(20,1),(21,1),(22,1),(23,1),(23,2),(24,1),(24,2),(25,1),(25,2),(26,1),(26,2),(27,1),(27,2),(28,1),(28,2),(29,1),(29,2),(30,1),(30,2),(31,1),(31,2),(32,1),(32,2),(33,1),(33,2),(34,1),(34,2),(35,1),(35,2),(36,1),(36,2),(37,1),(37,2),(38,1),(38,2),(39,1),(39,2),(40,1),(40,2),(41,1),(41,2),(42,1),(42,2),(43,1),(43,2),(44,1),(44,2),(45,1),(45,2),(46,1),(46,2),(47,1),(47,2),(48,1),(49,1),(50,1),(51,1),(52,1),(58,1),(59,1),(60,1),(61,1),(62,1),(63,1),(64,1),(65,1),(66,1),(67,1),(68,1),(69,1),(70,1),(71,1),(72,1);

/*Table structure for table `permissions` */

DROP TABLE IF EXISTS `permissions`;

CREATE TABLE `permissions` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `module_id` int(10) unsigned DEFAULT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `display_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_protected` tinyint(4) NOT NULL DEFAULT '0',
  `description` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `permissions_name_unique` (`name`),
  KEY `permissions_module_id_foreign` (`module_id`),
  CONSTRAINT `permissions_module_id_foreign` FOREIGN KEY (`module_id`) REFERENCES `modules` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=73 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `permissions` */

insert  into `permissions`(`id`,`module_id`,`name`,`display_name`,`is_protected`,`description`,`created_at`,`updated_at`,`deleted_at`) values (1,1,'adminpanel','Admin Panel',1,'Admin Panel','2020-06-01 23:59:16','2020-06-01 23:59:16',NULL),(2,2,'dashboard','Dashboard',1,'Dashboard','2020-06-01 23:59:16','2020-06-01 23:59:16',NULL),(3,3,'users.index','List Users',1,'List Roles','2020-06-01 23:59:16','2020-06-01 23:59:16',NULL),(4,3,'users.create','Create Users',1,'Create Users','2020-06-01 23:59:16','2020-06-01 23:59:16',NULL),(5,3,'users.show','View User',1,'View User','2020-06-01 23:59:16','2020-06-01 23:59:16',NULL),(6,3,'users.edit','Edit User',1,'Edit User','2020-06-01 23:59:16','2020-06-01 23:59:16',NULL),(7,3,'users.destroy','Delete User',1,'Delete User','2020-06-01 23:59:16','2020-06-01 23:59:16',NULL),(8,4,'roles.index','List Roles',1,'List Roles','2020-06-01 23:59:16','2020-06-01 23:59:16',NULL),(9,4,'roles.create','Create Role',1,'Create Role','2020-06-01 23:59:16','2020-06-01 23:59:16',NULL),(10,4,'roles.show','View Role',1,'View Role','2020-06-01 23:59:16','2020-06-01 23:59:16',NULL),(11,4,'roles.edit','Edit Role',1,'Edit Role','2020-06-01 23:59:16','2020-06-01 23:59:16',NULL),(12,4,'roles.destroy','Delete Role',1,'Delete Role','2020-06-01 23:59:16','2020-06-01 23:59:16',NULL),(13,5,'permissions.index','List Permissions',1,'List Permissions','2020-06-01 23:59:16','2020-06-01 23:59:16',NULL),(14,5,'permissions.create','Create Permission',1,'Create Permission','2020-06-01 23:59:16','2020-06-01 23:59:16',NULL),(15,5,'permissions.show','View Permission',1,'View Permission','2020-06-01 23:59:16','2020-06-01 23:59:16',NULL),(16,5,'permissions.edit','Edit Permission',1,'Edit Permission','2020-06-01 23:59:16','2020-06-01 23:59:16',NULL),(17,5,'permissions.destroy','Delete Permission',1,'Delete Permission','2020-06-01 23:59:16','2020-06-01 23:59:16',NULL),(18,6,'modules.index','List Modules',1,'List Modules','2020-06-01 23:59:16','2020-06-01 23:59:16',NULL),(19,6,'modules.create','Create Module',1,'Create Module','2020-06-01 23:59:16','2020-06-01 23:59:16',NULL),(20,6,'modules.show','View Module',1,'View Module','2020-06-01 23:59:16','2020-06-01 23:59:16',NULL),(21,6,'modules.edit','Edit Module',1,'Edit Module','2020-06-01 23:59:16','2020-06-01 23:59:16',NULL),(22,6,'modules.destroy','Delete Module',1,'Delete Module','2020-06-01 23:59:16','2020-06-01 23:59:16',NULL),(23,7,'languages.index','List Languages',1,'List Languages','2020-06-01 23:59:16','2020-06-01 23:59:16',NULL),(24,7,'languages.create','Create Languages',1,'Create Languages','2020-06-01 23:59:16','2020-06-01 23:59:16',NULL),(25,7,'languages.show','View Languages',1,'View Languages','2020-06-01 23:59:16','2020-06-01 23:59:16',NULL),(26,7,'languages.edit','Edit Languages',1,'Edit Languages','2020-06-01 23:59:16','2020-06-01 23:59:16',NULL),(27,7,'languages.destroy','Delete Languages',1,'Delete Languages','2020-06-01 23:59:16','2020-06-01 23:59:16',NULL),(28,8,'pages.index','List Pages',1,'List Pages','2020-06-01 23:59:16','2020-06-01 23:59:16',NULL),(29,8,'pages.create','Create Pages',1,'Create Pages','2020-06-01 23:59:16','2020-06-01 23:59:16',NULL),(30,8,'pages.show','View Pages',1,'View Pages','2020-06-01 23:59:16','2020-06-01 23:59:16',NULL),(31,8,'pages.edit','Edit Pages',1,'Edit Pages','2020-06-01 23:59:16','2020-06-01 23:59:16',NULL),(32,8,'pages.destroy','Delete Pages',1,'Delete Pages','2020-06-01 23:59:16','2020-06-01 23:59:16',NULL),(33,9,'contactus.index','List Contact Us',1,'List Contact Us Record','2020-06-01 23:59:16','2020-06-01 23:59:16',NULL),(34,9,'contactus.create','Create Contact Us',1,'Create Contact Us Record','2020-06-01 23:59:16','2020-06-01 23:59:16',NULL),(35,9,'contactus.show','View Contact Us',1,'View Contact Us Record','2020-06-01 23:59:16','2020-06-01 23:59:16',NULL),(36,9,'contactus.edit','Edit Contact Us',1,'Edit Contact Us Record','2020-06-01 23:59:16','2020-06-01 23:59:16',NULL),(37,9,'contactus.destroy','Delete Contact Us',1,'Delete Contact Us Record','2020-06-01 23:59:16','2020-06-01 23:59:16',NULL),(38,10,'notifications.index','List Notification',1,'List Notification','2020-06-01 23:59:16','2020-06-01 23:59:16',NULL),(39,10,'notifications.create','Create Notification',1,'Create Notification','2020-06-01 23:59:16','2020-06-01 23:59:16',NULL),(40,10,'notifications.show','View Notification',1,'View Notification','2020-06-01 23:59:16','2020-06-01 23:59:16',NULL),(41,10,'notifications.edit','Edit Notification',1,'Edit Notification','2020-06-01 23:59:16','2020-06-01 23:59:16',NULL),(42,10,'notifications.destroy','Delete Notification',1,'Delete Notification','2020-06-01 23:59:16','2020-06-01 23:59:16',NULL),(43,11,'menus.index','List Menu',1,'List Menu','2020-06-01 23:59:16','2020-06-01 23:59:16',NULL),(44,11,'menus.create','Create Menu',1,'Create Menu','2020-06-01 23:59:16','2020-06-01 23:59:16',NULL),(45,11,'menus.show','View Menu',1,'View Menu','2020-06-01 23:59:16','2020-06-01 23:59:16',NULL),(46,11,'menus.edit','Edit Menu',1,'Edit Menu','2020-06-01 23:59:16','2020-06-01 23:59:16',NULL),(47,11,'menus.destroy','Delete Menu',1,'Delete Menu','2020-06-01 23:59:16','2020-06-01 23:59:16',NULL),(48,12,'settings.index','Settings',1,'Index Settings','2020-06-01 23:59:16','2020-06-01 23:59:16',NULL),(49,12,'settings.create','Settings',1,'Create Settings','2020-06-01 23:59:16','2020-06-01 23:59:16',NULL),(50,12,'settings.show','Settings',1,'Show Settings','2020-06-01 23:59:16','2020-06-01 23:59:16',NULL),(51,12,'settings.edit','Settings',1,'Edit Settings','2020-06-01 23:59:16','2020-06-01 23:59:16',NULL),(52,12,'settings.destroy','Settings',1,'Destroy Settings','2020-06-01 23:59:16','2020-06-01 23:59:16',NULL),(58,14,'email-templates.index','Email Templates',0,'Index Email Templates','2020-06-02 00:17:45','2020-06-02 00:17:45',NULL),(59,14,'email-templates.create','Email Templates',0,'Create Email Templates','2020-06-02 00:17:45','2020-06-02 00:17:45',NULL),(60,14,'email-templates.show','Email Templates',0,'Show Email Templates','2020-06-02 00:17:45','2020-06-02 00:17:45',NULL),(61,14,'email-templates.edit','Email Templates',0,'Edit Email Templates','2020-06-02 00:17:45','2020-06-02 00:17:45',NULL),(62,14,'email-templates.destroy','Email Templates',0,'Destroy Email Templates','2020-06-02 00:17:45','2020-06-02 00:17:45',NULL),(63,15,'slots.index','Slots',0,'Index Slots','2020-06-05 11:55:02','2020-06-05 11:55:02',NULL),(64,15,'slots.create','Slots',0,'Create Slots','2020-06-05 11:55:02','2020-06-05 11:55:02',NULL),(65,15,'slots.show','Slots',0,'Show Slots','2020-06-05 11:55:02','2020-06-05 11:55:02',NULL),(66,15,'slots.edit','Slots',0,'Edit Slots','2020-06-05 11:55:02','2020-06-05 11:55:02',NULL),(67,15,'slots.destroy','Slots',0,'Destroy Slots','2020-06-05 11:55:02','2020-06-05 11:55:02',NULL),(68,16,'products.index','Products',0,'Index Products','2020-06-06 15:01:58','2020-06-06 15:01:58',NULL),(69,16,'products.create','Products',0,'Create Products','2020-06-06 15:01:58','2020-06-06 15:01:58',NULL),(70,16,'products.show','Products',0,'Show Products','2020-06-06 15:01:58','2020-06-06 15:01:58',NULL),(71,16,'products.edit','Products',0,'Edit Products','2020-06-06 15:01:58','2020-06-06 15:01:58',NULL),(72,16,'products.destroy','Products',0,'Destroy Products','2020-06-06 15:01:58','2020-06-06 15:01:58',NULL);

/*Table structure for table `product_details` */

DROP TABLE IF EXISTS `product_details`;

CREATE TABLE `product_details` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `product_id` int(11) unsigned NOT NULL,
  `description` text,
  `price` float DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `product_id` (`product_id`),
  CONSTRAINT `product_details_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;

/*Data for the table `product_details` */

insert  into `product_details`(`id`,`product_id`,`description`,`price`,`created_at`,`updated_at`,`deleted_at`) values (1,1,'Description 1',123,'2020-06-06 10:14:45','2020-06-06 10:14:45',NULL);

/*Table structure for table `product_slots` */

DROP TABLE IF EXISTS `product_slots`;

CREATE TABLE `product_slots` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `slot_id` int(11) unsigned DEFAULT NULL,
  `product_id` int(11) unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `slot_id` (`slot_id`),
  KEY `product_id` (`product_id`),
  CONSTRAINT `product_slots_ibfk_1` FOREIGN KEY (`slot_id`) REFERENCES `slots` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `product_slots_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

/*Data for the table `product_slots` */

/*Table structure for table `products` */

DROP TABLE IF EXISTS `products`;

CREATE TABLE `products` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(199) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;

/*Data for the table `products` */

insert  into `products`(`id`,`title`,`created_at`,`updated_at`,`deleted_at`) values (1,'Product 1','2020-06-06 10:14:45','2020-06-06 10:14:45',NULL);

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
