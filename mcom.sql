/*
SQLyog Ultimate v11.11 (64 bit)
MySQL - 5.5.5-10.4.24-MariaDB : Database - mecom
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`mecom` /*!40100 DEFAULT CHARACTER SET utf8mb4 */;

USE `mecom`;

/*Table structure for table `brands` */

DROP TABLE IF EXISTS `brands`;

CREATE TABLE `brands` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `brand_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `brand_slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `brand_image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `brands` */

insert  into `brands`(`id`,`created_at`,`updated_at`,`brand_name`,`brand_slug`,`brand_image`) values (4,NULL,'2024-02-03 05:37:19','new brand new 2','new-brand-new-2','upload/brand/1789854873712222.jpeg');

/*Table structure for table `categories` */

DROP TABLE IF EXISTS `categories`;

CREATE TABLE `categories` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `category_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `category_slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `category_image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `categories` */

insert  into `categories`(`id`,`created_at`,`updated_at`,`category_name`,`category_slug`,`category_image`) values (3,NULL,NULL,'Computer','computer','/upload/category/1789934869289176.webp'),(4,NULL,NULL,'Home','home','/upload/category/1789934942861375.webp');

/*Table structure for table `failed_jobs` */

DROP TABLE IF EXISTS `failed_jobs`;

CREATE TABLE `failed_jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `failed_jobs` */

/*Table structure for table `migrations` */

DROP TABLE IF EXISTS `migrations`;

CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `migrations` */

insert  into `migrations`(`id`,`migration`,`batch`) values (1,'2014_10_12_000000_create_users_table',1),(2,'2014_10_12_100000_create_password_reset_tokens_table',1),(3,'2019_08_19_000000_create_failed_jobs_table',1),(4,'2019_12_14_000001_create_personal_access_tokens_table',1),(5,'2024_02_01_104922_create_brands_table',2),(6,'2024_02_03_073946_create_categories_table',3),(7,'2024_02_04_020841_create_subcategories_table',4),(8,'2024_02_19_230502_create_products_table',5),(9,'2024_02_19_232414_create_multi_images_table',5);

/*Table structure for table `multi_images` */

DROP TABLE IF EXISTS `multi_images`;

CREATE TABLE `multi_images` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `product_id` int(11) NOT NULL,
  `photo_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `multi_images` */

insert  into `multi_images`(`id`,`product_id`,`photo_name`,`created_at`,`updated_at`) values (1,1,'upload/products/multi-image/1792046854407816.png','2024-02-24 10:36:14','2024-02-27 10:17:38'),(2,1,'upload/products/multi-image/1792046976554926.jpg','2024-02-24 10:36:14','2024-02-27 10:19:35'),(5,3,'upload/product/multi-img1792343426556656.jpg','2024-03-01 16:51:32',NULL),(6,3,'upload/product/multi-img1792343426762945.jpg','2024-03-01 16:51:32',NULL);

/*Table structure for table `password_reset_tokens` */

DROP TABLE IF EXISTS `password_reset_tokens`;

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `password_reset_tokens` */

/*Table structure for table `personal_access_tokens` */

DROP TABLE IF EXISTS `personal_access_tokens`;

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `personal_access_tokens` */

/*Table structure for table `products` */

DROP TABLE IF EXISTS `products`;

CREATE TABLE `products` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `brand_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `subcategory_id` int(11) NOT NULL,
  `product_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `product_slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `product_tags` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `product_size` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `product_qty` varchar(10) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `product_code` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `product_color` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `selling_price` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `discount_price` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `short_desc` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `long_desc` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `product_thambnail` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `vendor_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `hot_deals` int(11) DEFAULT NULL,
  `featured` int(11) DEFAULT NULL,
  `special_offer` int(11) DEFAULT NULL,
  `special_deals` int(11) DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `products` */

insert  into `products`(`id`,`brand_id`,`category_id`,`subcategory_id`,`product_name`,`product_slug`,`product_tags`,`product_size`,`product_qty`,`product_code`,`product_color`,`selling_price`,`discount_price`,`short_desc`,`long_desc`,`product_thambnail`,`vendor_id`,`hot_deals`,`featured`,`special_offer`,`special_deals`,`status`,`created_at`,`updated_at`) values (1,4,3,1,'frog','frog','new product,top product','Small,Midium,Large','2','52','red','20.00','10','Short Description','<p>Hello, World!<span style=\"background-color: #ffffff; color: #4c5258; font-family: Roboto, sans-serif; font-size: 14px; letter-spacing: 0.5px;\">&nbsp;Long Description</span></p>','upload/product/thambnail/1791776232979724.png','2',1,NULL,NULL,NULL,1,'2024-02-25 15:45:19','2024-03-01 16:48:22'),(3,4,4,2,'pant','pant','top product','Midium,Large','3',NULL,'Blue,Black','450',NULL,'product pant','<p>Hello, World! product pant</p>','upload/product/thambnail/1792343426370696.png','2',NULL,NULL,NULL,NULL,0,'2024-03-01 16:51:31',NULL);

/*Table structure for table `subcategories` */

DROP TABLE IF EXISTS `subcategories`;

CREATE TABLE `subcategories` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `category_id` int(11) NOT NULL,
  `subcategory_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `subcategories` */

insert  into `subcategories`(`id`,`created_at`,`updated_at`,`category_id`,`subcategory_name`) values (1,NULL,NULL,3,'desktop'),(2,NULL,'2024-02-05 17:16:13',4,'chair'),(4,NULL,NULL,3,'pendrive');

/*Table structure for table `users` */

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `photo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `vendor_join` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `vendor_short_info` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `role` enum('admin','vendor','user') COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` enum('active','inactive') COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `users` */

insert  into `users`(`id`,`name`,`username`,`email`,`email_verified_at`,`password`,`photo`,`phone`,`address`,`vendor_join`,`vendor_short_info`,`role`,`status`,`remember_token`,`created_at`,`updated_at`) values (1,'admin','admin','admin@gmail.com',NULL,'$2y$12$ZxCfOIcUMAQFwfsYhX375u/5YBhGCjXF4Cm42iZWaYL16aN3H6qAW',NULL,NULL,NULL,NULL,NULL,'admin','active',NULL,NULL,NULL),(2,'vendor','vendor','abhiramsahoo@gmail.com','2024-01-30 10:59:14','$2y$12$ZxCfOIcUMAQFwfsYhX375u/5YBhGCjXF4Cm42iZWaYL16aN3H6qAW','202401301234Professor Roland.jpeg','07978161967',NULL,'2024-01-30','long text','vendor','active',NULL,NULL,'2024-02-09 16:25:07'),(3,'user','user','user@gmail.com',NULL,'$2y$12$7xptCBBMvyC/Wtl00OAI0uHXN0QQeGC3sZuFVdSxtUmGiEkW57gHa',NULL,NULL,NULL,NULL,NULL,'user','active',NULL,NULL,NULL),(4,'Verdie Parker',NULL,'russel.sabrina@example.org','2024-01-30 10:59:14','$2y$12$GDbrJ31sznjFy2Wa/CG0Zezu4r3.QCaeTgmNrY3V8bEQ8CveZvBTK','https://via.placeholder.com/60x60.png/0055dd?text=provident','1-301-743-1033','60316 Block Flats\nKeonfort, TN 50331-4926',NULL,NULL,'user','active','839aRkYkft','2024-01-30 10:59:16','2024-01-30 10:59:16'),(5,'Dr. Meaghan Hessel MD',NULL,'toni.reinger@example.org','2024-01-30 10:59:15','$2y$12$GDbrJ31sznjFy2Wa/CG0Zezu4r3.QCaeTgmNrY3V8bEQ8CveZvBTK','https://via.placeholder.com/60x60.png/00cc22?text=accusamus','+1.848.426.7829','414 Wyman Flat\nSouth Greggshire, VT 21558',NULL,NULL,'admin','inactive','S2G2PoSSsJ','2024-01-30 10:59:16','2024-01-30 10:59:16'),(6,'Susana Paucek DDS',NULL,'xdicki@example.com','2024-01-30 10:59:15','$2y$12$GDbrJ31sznjFy2Wa/CG0Zezu4r3.QCaeTgmNrY3V8bEQ8CveZvBTK','https://via.placeholder.com/60x60.png/004444?text=voluptatibus','909-442-0809','32456 Simone Square Suite 186\nJasonport, AZ 34213',NULL,NULL,'user','inactive','rsyen9HFj6','2024-01-30 10:59:16','2024-01-30 10:59:16'),(7,'Kaylin Lueilwitz PhD',NULL,'harber.adolfo@example.net','2024-01-30 10:59:15','$2y$12$GDbrJ31sznjFy2Wa/CG0Zezu4r3.QCaeTgmNrY3V8bEQ8CveZvBTK','https://via.placeholder.com/60x60.png/006622?text=et','+1 (424) 885-6135','85756 Jamaal Spurs\nNew Yesseniahaven, ID 63189',NULL,NULL,'admin','inactive','TaNIl8ZTbq','2024-01-30 10:59:16','2024-01-30 10:59:16'),(8,'Elta Terry',NULL,'steuber.bernita@example.com','2024-01-30 10:59:15','$2y$12$GDbrJ31sznjFy2Wa/CG0Zezu4r3.QCaeTgmNrY3V8bEQ8CveZvBTK','https://via.placeholder.com/60x60.png/0000cc?text=rem','1-202-783-3343','46752 Myrl Fields\nLake Delphinefurt, MI 82977-0538',NULL,NULL,'vendor','active','sb0WiA44nL','2024-01-30 10:59:16','2024-02-09 16:27:05'),(9,'Felicita Stehr',NULL,'gutmann.georgette@example.net','2024-01-30 10:59:15','$2y$12$GDbrJ31sznjFy2Wa/CG0Zezu4r3.QCaeTgmNrY3V8bEQ8CveZvBTK','https://via.placeholder.com/60x60.png/00aa88?text=commodi','(351) 858-1894','48233 Glover Stravenue Suite 322\nPort Todville, VA 10786-4303',NULL,NULL,'user','active','VNkCKqLwiB','2024-01-30 10:59:16','2024-01-30 10:59:16'),(10,'Ms. Ruthe Gorczany DDS',NULL,'kayla01@example.com','2024-01-30 10:59:15','$2y$12$GDbrJ31sznjFy2Wa/CG0Zezu4r3.QCaeTgmNrY3V8bEQ8CveZvBTK','https://via.placeholder.com/60x60.png/00aaee?text=velit','+1-470-647-9530','5378 Wisoky Flat\nSouth Stephenfort, SC 93788-6225',NULL,NULL,'admin','inactive','CwNWSC4W02','2024-01-30 10:59:16','2024-01-30 10:59:16'),(11,'Adell Swaniawski I',NULL,'xpredovic@example.net','2024-01-30 10:59:15','$2y$12$GDbrJ31sznjFy2Wa/CG0Zezu4r3.QCaeTgmNrY3V8bEQ8CveZvBTK','https://via.placeholder.com/60x60.png/0066bb?text=et','352-648-6361','85472 Rosina Flat Apt. 980\nNew Vaughn, WY 11647-9248',NULL,NULL,'admin','active','BxD9LaooEU','2024-01-30 10:59:16','2024-01-30 10:59:16'),(12,'Prof. Ashtyn Rippin',NULL,'feest.vilma@example.com','2024-01-30 10:59:15','$2y$12$GDbrJ31sznjFy2Wa/CG0Zezu4r3.QCaeTgmNrY3V8bEQ8CveZvBTK','https://via.placeholder.com/60x60.png/0099aa?text=non','+1-406-236-6299','3331 Kerluke Lodge Apt. 658\nEast Haileefort, HI 86858-8432',NULL,NULL,'vendor','active','ewQMielkzP','2024-01-30 10:59:16','2024-02-09 16:24:37'),(13,'Hipolito Schumm',NULL,'bert33@example.com','2024-01-30 10:59:15','$2y$12$GDbrJ31sznjFy2Wa/CG0Zezu4r3.QCaeTgmNrY3V8bEQ8CveZvBTK','https://via.placeholder.com/60x60.png/00bbff?text=maxime','+1-505-924-4636','525 Sawayn Walks Suite 361\nNorth Izaiah, GA 62917',NULL,NULL,'user','inactive','LjdmXSXIdu','2024-01-30 10:59:16','2024-01-30 10:59:16'),(14,'me',NULL,'me@gmail.com',NULL,'$2y$12$TM0DMxkz1Yg82AnYIdGYPuovZ1LK1trEj/11Y6UwZ95Iq6gMC94cy',NULL,NULL,NULL,NULL,NULL,'admin','active',NULL,'2024-02-09 02:07:05','2024-02-09 02:07:05'),(15,'demovendor',NULL,'demo@gmail.com',NULL,'$2y$12$.VhtZW/RstYgQsG9TLPyLu9n.BMkmf6CAGz8gf8v/ZMUBNfo6Jbby',NULL,NULL,NULL,NULL,NULL,'admin','active',NULL,'2024-02-09 02:24:09','2024-02-09 02:24:09'),(16,'Grand Son',NULL,'qwert@gmail.com',NULL,'$2y$12$eAHXrV9lwGehd6DCWUe8s.b6gWqWvfsz.ZqAOGDZWgSOgfBr6YcWq',NULL,'07978161967',NULL,'2024-02-09',NULL,'vendor','active',NULL,NULL,'2024-02-09 16:26:29');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
