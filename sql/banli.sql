-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Anamakine: 127.0.0.1:3306
-- Üretim Zamanı: 27 Ara 2019, 17:59:36
-- Sunucu sürümü: 5.7.24
-- PHP Sürümü: 7.3.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Veritabanı: `moobi`
--

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `categories`
--

DROP TABLE IF EXISTS `categories`;
CREATE TABLE IF NOT EXISTS `categories` (
  `categories_id` int(11) NOT NULL AUTO_INCREMENT,
  `categories_name` varchar(255) NOT NULL,
  PRIMARY KEY (`categories_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

--
-- Tablo döküm verisi `categories`
--

INSERT INTO `categories` (`categories_id`, `categories_name`) VALUES
(4, 'Elektronik Eşya'),
(5, 'Kişisel Bakım');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `clients`
--

DROP TABLE IF EXISTS `clients`;
CREATE TABLE IF NOT EXISTS `clients` (
  `clients_id` int(11) NOT NULL AUTO_INCREMENT,
  `users_id` int(11) NOT NULL,
  `clients_name` varchar(255) NOT NULL,
  `clients_address` varchar(255) NOT NULL,
  PRIMARY KEY (`clients_id`),
  KEY `users_id` (`users_id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

--
-- Tablo döküm verisi `clients`
--

INSERT INTO `clients` (`clients_id`, `users_id`, `clients_name`, `clients_address`) VALUES
(1, 1, 'Deneme Müşteri', 'Ankara / TÜRKİYE'),
(2, 1, 'Deneme 2', 'deneme 2 müşterisinin adresi'),
(6, 5, 'Deneme yeni müşteri', 'adresi yaz');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `products`
--

DROP TABLE IF EXISTS `products`;
CREATE TABLE IF NOT EXISTS `products` (
  `products_id` int(11) NOT NULL AUTO_INCREMENT,
  `categories_id` int(11) NOT NULL,
  `products_name` varchar(255) NOT NULL,
  `products_price` varchar(20) NOT NULL,
  PRIMARY KEY (`products_id`),
  KEY `categories_id` (`categories_id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

--
-- Tablo döküm verisi `products`
--

INSERT INTO `products` (`products_id`, `categories_id`, `products_name`, `products_price`) VALUES
(3, 4, 'samsung galaksi', '5699'),
(4, 4, 'iphone 5s', '8000'),
(5, 4, 'Iphone X', '8990'),
(6, 5, 'Şampuan', '19'),
(7, 5, 'Bakım Kremi', '26,99');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `roles`
--

DROP TABLE IF EXISTS `roles`;
CREATE TABLE IF NOT EXISTS `roles` (
  `roles_id` int(2) NOT NULL AUTO_INCREMENT,
  `roles_name` varchar(100) NOT NULL,
  PRIMARY KEY (`roles_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Tablo döküm verisi `roles`
--

INSERT INTO `roles` (`roles_id`, `roles_name`) VALUES
(1, 'admin'),
(2, 'user');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `sales`
--

DROP TABLE IF EXISTS `sales`;
CREATE TABLE IF NOT EXISTS `sales` (
  `sales_id` int(11) NOT NULL AUTO_INCREMENT,
  `clients_id` int(11) NOT NULL,
  `products_id` int(11) NOT NULL,
  `sales_prim` float NOT NULL,
  `sales_status` enum('0','1') NOT NULL,
  PRIMARY KEY (`sales_id`),
  KEY `clients_id` (`clients_id`),
  KEY `products_id` (`products_id`)
) ENGINE=InnoDB AUTO_INCREMENT=35 DEFAULT CHARSET=utf8;

--
-- Tablo döküm verisi `sales`
--

INSERT INTO `sales` (`sales_id`, `clients_id`, `products_id`, `sales_prim`, `sales_status`) VALUES
(34, 1, 5, 899, '1');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `users_id` int(11) NOT NULL AUTO_INCREMENT,
  `roles_id` int(2) NOT NULL,
  `users_name` varchar(100) NOT NULL,
  `users_surname` varchar(100) NOT NULL,
  `users_email` varchar(100) NOT NULL,
  `users_password` varchar(255) NOT NULL,
  `users_registered` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `users_login` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`users_id`),
  KEY `roles_id` (`roles_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

--
-- Tablo döküm verisi `users`
--

INSERT INTO `users` (`users_id`, `roles_id`, `users_name`, `users_surname`, `users_email`, `users_password`, `users_registered`, `users_login`) VALUES
(1, 2, 'User', 'Deneme', 'deneme@deneme.com', 'e10adc3949ba59abbe56e057f20f883e', '2019-12-27 06:24:30', '2019-12-27 06:24:30'),
(2, 1, 'Admin', '1', 'admin@admin.com', 'e10adc3949ba59abbe56e057f20f883e', '2019-12-27 06:26:21', '2019-12-27 06:26:21'),
(5, 2, 'Yeni', 'Kullanıcı', 'deneme2@deneme.com', 'e10adc3949ba59abbe56e057f20f883e', '2019-12-27 17:07:54', '2019-12-27 17:07:54');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
