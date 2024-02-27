-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               8.0.31 - MySQL Community Server - GPL
-- Server OS:                    Win64
-- HeidiSQL Version:             12.6.0.6765
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Dumping database structure for hotel_db
CREATE DATABASE IF NOT EXISTS `hotel_db` /*!40100 DEFAULT CHARACTER SET utf8mb3 */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `hotel_db`;

-- Dumping structure for table hotel_db.booking
CREATE TABLE IF NOT EXISTS `booking` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_name` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `email` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `contact` varchar(10) NOT NULL,
  `days` int NOT NULL,
  `no_of_guests` int NOT NULL,
  `package_id` int NOT NULL,
  `payment_id` int NOT NULL,
  `status_id` int NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `FK__package` (`package_id`),
  KEY `FK_booking_payment` (`payment_id`),
  KEY `FK_booking_status` (`status_id`),
  CONSTRAINT `FK__package` FOREIGN KEY (`package_id`) REFERENCES `package` (`id`),
  CONSTRAINT `FK_booking_payment` FOREIGN KEY (`payment_id`) REFERENCES `payment` (`id`),
  CONSTRAINT `FK_booking_status` FOREIGN KEY (`status_id`) REFERENCES `status` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb3;

-- Dumping data for table hotel_db.booking: ~4 rows (approximately)
INSERT INTO `booking` (`id`, `user_name`, `email`, `contact`, `days`, `no_of_guests`, `package_id`, `payment_id`, `status_id`) VALUES
	(1, 'Sulochana', 'sula@gmail.com', '0767081491', 3, 5, 1, 1, 2),
	(2, 'Sulochana', 'sula@gmail.com', '0767081491', 3, 5, 2, 2, 3),
	(3, 'Sulochana Rathnayaka', 'sula@gmail.com', '0767081491', 5, 4, 6, 1, 1),
	(4, 'Sulochana Rathnayaka', 'sula@gmail.com', '0767081491', 8, 5, 8, 3, 1),
	(5, 'Sulochana Rathnayaka', 'sula@gmail.com', 'sadf', 5, 8, 3, 2, 1);

-- Dumping structure for table hotel_db.gallery
CREATE TABLE IF NOT EXISTS `gallery` (
  `id` int NOT NULL AUTO_INCREMENT,
  `path` varchar(255) NOT NULL,
  `hotel_id` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_gallery_hotel` (`hotel_id`),
  CONSTRAINT `FK_gallery_hotel` FOREIGN KEY (`hotel_id`) REFERENCES `hotel` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb3;

-- Dumping data for table hotel_db.gallery: ~10 rows (approximately)
INSERT INTO `gallery` (`id`, `path`, `hotel_id`) VALUES
	(1, 'assets/images/gallerty4.jpg', 1),
	(2, 'assets/images/gallery2.jpg', 2),
	(3, 'assets/images/gallery1.jpg', 3),
	(4, 'assets/images/gallery5.jpg', 4),
	(5, 'assets/images/gallery6.jpg', 5),
	(6, 'assets/images/package1.jpg', 1),
	(7, 'assets/images/package4.jpg', 2),
	(8, 'assets/images/package2.jpg', 3),
	(9, 'assets/images/package3.jpg', 4),
	(10, 'assets/images/package5.jpg', 5);

-- Dumping structure for table hotel_db.hotel
CREATE TABLE IF NOT EXISTS `hotel` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `location` varchar(255) NOT NULL,
  `username` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `password` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `main_img` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb3;

-- Dumping data for table hotel_db.hotel: ~0 rows (approximately)
INSERT INTO `hotel` (`id`, `name`, `location`, `username`, `password`, `main_img`) VALUES
	(1, 'Hotel OnTheWay', 'Colombo 05', 'theway', '1234', 'assets/images/package1.jpg'),
	(2, 'Henz Steps', 'Moratuwa', 'steps', '12345', 'assets/images/package4.jpg'),
	(3, 'Hotel Cameela', 'Colombo 12', 'cameela', '123456', 'assets/images/package2.jpg'),
	(4, 'Shangeez Resort', 'Mount Lavinia', 'resort', '1234567', 'assets/images/package3.jpg'),
	(5, 'Hotel BlueBerry', 'Colombo 07', 'blueberry', '12345678', 'assets/images/package5.jpg');

-- Dumping structure for table hotel_db.package
CREATE TABLE IF NOT EXISTS `package` (
  `id` int NOT NULL AUTO_INCREMENT,
  `package` varchar(255) NOT NULL,
  `details` varchar(255) NOT NULL,
  `price` double NOT NULL DEFAULT (0),
  `hotel_id` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_package_hotel` (`hotel_id`),
  CONSTRAINT `FK_package_hotel` FOREIGN KEY (`hotel_id`) REFERENCES `hotel` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb3;

-- Dumping data for table hotel_db.package: ~0 rows (approximately)
INSERT INTO `package` (`id`, `package`, `details`, `price`, `hotel_id`) VALUES
	(1, 'Package 1', '1 Person', 5000, 1),
	(2, 'Package 2', '2 Person', 10000, 1),
	(3, 'Package 3', '4 Person', 20000, 1),
	(4, 'Package 1', '1 Person', 6000, 2),
	(5, 'Package 2', '2 Person', 11000, 2),
	(6, 'Package 3', '4 Person', 23000, 2),
	(7, 'Package 1', '1 Person', 4000, 3),
	(8, 'Package 2', '2 Person', 8000, 3),
	(9, 'Package 3', '4 Person', 15000, 3),
	(10, 'Package 1', '1 Person', 8000, 4),
	(11, 'Package 2', '2 Person', 15000, 4),
	(12, 'Package 3', '4 Person', 30000, 4),
	(13, 'Package 1', '1 Person', 7000, 5),
	(14, 'Package 2', '2 Person', 14000, 5),
	(15, 'Package 3', '4  Person', 26000, 5);

-- Dumping structure for table hotel_db.payment
CREATE TABLE IF NOT EXISTS `payment` (
  `id` int NOT NULL AUTO_INCREMENT,
  `method` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb3;

-- Dumping data for table hotel_db.payment: ~0 rows (approximately)
INSERT INTO `payment` (`id`, `method`) VALUES
	(1, 'Credit Card'),
	(2, 'PayPal'),
	(3, 'Bank Transfer');

-- Dumping structure for table hotel_db.status
CREATE TABLE IF NOT EXISTS `status` (
  `id` int NOT NULL AUTO_INCREMENT,
  `status` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb3;

-- Dumping data for table hotel_db.status: ~0 rows (approximately)
INSERT INTO `status` (`id`, `status`) VALUES
	(1, 'pending'),
	(2, 'Accepted'),
	(3, 'Rejected');

-- Dumping structure for table hotel_db.user
CREATE TABLE IF NOT EXISTS `user` (
  `id` int NOT NULL AUTO_INCREMENT,
  `email` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `password` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb3;

-- Dumping data for table hotel_db.user: ~0 rows (approximately)
INSERT INTO `user` (`id`, `email`, `password`) VALUES
	(1, 'tharu@gmail.com', '1234'),
	(2, 'sula@gmail.com', '1234');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
