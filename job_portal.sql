-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Feb 18, 2022 at 09:24 AM
-- Server version: 5.7.36
-- PHP Version: 7.4.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `job_portal`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

DROP TABLE IF EXISTS `admin`;
CREATE TABLE IF NOT EXISTS `admin` (
  `id_admin` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  PRIMARY KEY (`id_admin`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id_admin`, `username`, `password`) VALUES
(1, 'admin', '123456');

-- --------------------------------------------------------

--
-- Table structure for table `apply_job_post`
--

DROP TABLE IF EXISTS `apply_job_post`;
CREATE TABLE IF NOT EXISTS `apply_job_post` (
  `id_apply` int(11) NOT NULL AUTO_INCREMENT,
  `id_jobpost` int(11) NOT NULL,
  `id_company` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id_apply`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `apply_job_post`
--

INSERT INTO `apply_job_post` (`id_apply`, `id_jobpost`, `id_company`, `id_user`, `status`) VALUES
(8, 107, 108, 108, 0);

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

DROP TABLE IF EXISTS `comments`;
CREATE TABLE IF NOT EXISTS `comments` (
  `id_comment` int(6) NOT NULL AUTO_INCREMENT,
  `id_company` int(6) NOT NULL,
  `comment` varchar(2000) NOT NULL,
  `rating` int(1) NOT NULL,
  PRIMARY KEY (`id_comment`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id_comment`, `id_company`, `comment`, `rating`) VALUES
(7, 106, 'Super', 4),
(8, 108, 'Super', 3);

-- --------------------------------------------------------

--
-- Table structure for table `company`
--

DROP TABLE IF EXISTS `company`;
CREATE TABLE IF NOT EXISTS `company` (
  `id_company` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `companyname` varchar(255) NOT NULL,
  `country` varchar(255) NOT NULL,
  `state` varchar(255) NOT NULL,
  `city` varchar(255) NOT NULL,
  `contactno` varchar(255) NOT NULL,
  `website` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `aboutme` varchar(255) DEFAULT NULL,
  `logo` varchar(255) NOT NULL,
  `createdAt` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `active` int(11) NOT NULL DEFAULT '2',
  PRIMARY KEY (`id_company`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=109 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `company`
--

INSERT INTO `company` (`id_company`, `name`, `companyname`, `country`, `state`, `city`, `contactno`, `website`, `email`, `password`, `aboutme`, `logo`, `createdAt`, `active`) VALUES
(105, 'Milan VikuÄ‡eviÄ‡', 'Kostolac InÅ¾enjering', 'Srbija', 'BraniÄevski', 'Kostolac', '0606060799', 'google.com', 'kostolac@gmail.com', 'ZTM4OGYwMmY3NTBlNjVlYmJhOTVhYjk0OTNjZGEwMWU=', 'Kostolac inÅ¾enjering je firma osnovana 1989. godine i bavi se proizvodnjom ÄeliÄnih konstrukcija.', '620e62a8e74e0.jpg', '2022-02-17 14:58:48', 1),
(106, 'Mirko OstojiÄ‡', 'Advokatska kancelarija OstojiÄ‡', 'Srbija', 'Podunavski', 'Smederevo', '0661231231', 'google.com', 'advokat.ostojic@gmail.com', 'ZTM4OGYwMmY3NTBlNjVlYmJhOTVhYjk0OTNjZGEwMWU=', 'Advokatska kancelarija koja posluje od 1976. godine i radi sa najekskluzivnijim klijentima.', '620e6481ab950.png', '2022-02-17 15:06:41', 1),
(107, 'SneÅ¾ana PetroviÄ‡', 'ACC', 'Srbija', 'Pomoravski', 'ParaÄ‡in', '0621321546', 'google.com', 'acc@gmail.com', 'ZTM4OGYwMmY3NTBlNjVlYmJhOTVhYjk0OTNjZGEwMWU=', '', '620e65d0d85b8.jpg', '2022-02-17 15:12:16', 2),
(108, 'Slavko StanisavljeviÄ‡', 'BigSoftver', 'Srbija', 'Okrug', 'Novi Sad', '0663564568', 'google.com', 'bigsoftver@gmail.com', 'ZTM4OGYwMmY3NTBlNjVlYmJhOTVhYjk0OTNjZGEwMWU=', 'VodeÄ‡a softverska kompanija u regionu.', '620e66b037619.png', '2022-02-17 15:16:00', 1);

-- --------------------------------------------------------

--
-- Table structure for table `job_post`
--

DROP TABLE IF EXISTS `job_post`;
CREATE TABLE IF NOT EXISTS `job_post` (
  `id_jobpost` int(11) NOT NULL AUTO_INCREMENT,
  `id_company` int(11) NOT NULL,
  `jobtitle` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `minimumsalary` varchar(255) NOT NULL,
  `maximumsalary` varchar(255) NOT NULL,
  `experience` varchar(255) NOT NULL,
  `qualification` varchar(255) NOT NULL,
  `createdat` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_jobpost`)
) ENGINE=InnoDB AUTO_INCREMENT=111 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `job_post`
--

INSERT INTO `job_post` (`id_jobpost`, `id_company`, `jobtitle`, `description`, `minimumsalary`, `maximumsalary`, `experience`, `qualification`, `createdat`) VALUES
(105, 106, 'Potreban advokat', '<p>TraÅ¾i se advokat sa bar 5 godina iskustva. Fleksibilni radni sati. Posao u uglednoj firmi.</p>', '70000', '79999', '5', 'viÅ¡a struÄna sprema', '2022-02-17 15:08:52'),
(106, 108, 'Programer', '<p>Potreban junior programer. Poznavanje C/C++ i Jave neophodno.</p>', '70000', '85000', '1', 'nema', '2022-02-17 15:18:33'),
(107, 108, 'Programer 2', '', '150000', '200000', '5', '111', '2022-02-17 15:19:28'),
(108, 108, 'RaÄunovoÄ‘a', '<p>Potreban raÄunovoÄ‘a.</p>', '50000', '56000', '2', 'nema', '2022-02-17 15:20:19'),
(109, 108, 'TraÅ¾i se advokat', '<p>Firmi BigSoftver potreban mladi advokat</p>', '60000', '65000', '1', 'no', '2022-02-17 15:22:10'),
(110, 108, 'Ful stek developer', '<p>Potreban ful stek developer</p>', '12000', '15000', '3', 'ne', '2022-02-17 15:22:49');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id_user` int(11) NOT NULL AUTO_INCREMENT,
  `firstname` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `address` text,
  `city` varchar(255) DEFAULT NULL,
  `state` varchar(255) DEFAULT NULL,
  `contactno` varchar(255) DEFAULT NULL,
  `qualification` varchar(255) DEFAULT NULL,
  `stream` varchar(255) DEFAULT NULL,
  `passingyear` varchar(255) DEFAULT NULL,
  `dob` varchar(255) DEFAULT NULL,
  `age` varchar(255) DEFAULT NULL,
  `designation` varchar(255) DEFAULT NULL,
  `resume` varchar(255) DEFAULT NULL,
  `hash` varchar(255) DEFAULT NULL,
  `active` int(11) NOT NULL DEFAULT '2',
  `aboutme` text,
  `skills` text,
  PRIMARY KEY (`id_user`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=116 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id_user`, `firstname`, `lastname`, `email`, `password`, `address`, `city`, `state`, `contactno`, `qualification`, `stream`, `passingyear`, `dob`, `age`, `designation`, `resume`, `hash`, `active`, `aboutme`, `skills`) VALUES
(108, 'Petar', 'PetroviÄ‡', 'pera@gmail.com', 'ZTM4OGYwMmY3NTBlNjVlYmJhOTVhYjk0OTNjZGEwMWU=', 'KaraÄ‘orÄ‘eva  35', 'Smederevo', 'Srbija', '0601111111', 'dipl. maÅ¡inski inÅ¾enjer ', '3 godine u GoÅ¡a montaÅ¾i', '2007-08-26', '1988-06-20', '33', '', '620e5ac4b75d6.pdf', 'ff3ec132b550f18e1a6defea58305fb9', 1, 'U slobodno vreme volim da idem na pecanje.', 'Excel, Word'),
(109, 'Marko', 'MarkoviÄ‡', 'marko@gmail.com', 'ZTM4OGYwMmY3NTBlNjVlYmJhOTVhYjk0OTNjZGEwMWU=', 'Adresa 25', 'KruÅ¡evac', 'Srbija', '0611111111', 'dipl. maÅ¡inski inÅ¾enjer', '5 godina ', '1998-06-29', '1976-02-06', '46', '', '620e5d4a666d3.pdf', '6657c59e0977c01925c4a2179f478502', 2, 'Pozdrav', ''),
(110, 'Zoran', 'ArsiÄ‡', 'zoran@gmail.com', 'ZTM4OGYwMmY3NTBlNjVlYmJhOTVhYjk0OTNjZGEwMWU=', 'UstniÄka bb', 'Svilajnac', 'Srbija', '0631111111', 'dipl. ekonomista', 'nema', '2016-03-06', '1994-09-24', '27', '', '620e5dc3e593b.pdf', 'a3324cd03fee038084adb4e3db359c49', 2, 'Pozdrav', 'upotreba raÄunara'),
(111, 'Milica', 'ZdravkoviÄ‡', 'mica@gmail.com', 'ZTM4OGYwMmY3NTBlNjVlYmJhOTVhYjk0OTNjZGEwMWU=', 'Kosovska 30', 'Kragujevac', 'Srbija', '0612222222', 'dipl. advokat', 'nema', '2022-06-16', '2000-08-24', '21', '', '620e5ecd32d96.pdf', '0fe133cf8b425c11898a4488f5a37bfe', 2, 'Ä†ao svima', ''),
(112, 'Mihailo', 'PantiÄ‡', 'mihailo.pantic01@gmail.com', 'ZTM4OGYwMmY3NTBlNjVlYmJhOTVhYjk0OTNjZGEwMWU=', 'Kneza Mihaila bb', 'Kragujevac', 'Srbija', '0634242555', 'dipl. inÅ¾enjer elektrotehnike', 'nema', '2021-07-24', '1999-01-13', '23', '', '620e5f883eccc.pdf', 'de1c54b16b8ae15db2f4a0be3a3e35e4', 2, 'Ja sam Mihailo ', 'vozi auto'),
(113, 'Stevan', 'PopoviÄ‡', 'stevanp2000@gmail.com', 'ZTM4OGYwMmY3NTBlNjVlYmJhOTVhYjk0OTNjZGEwMWU=', 'Kneza MiloÅ¡a 134', 'Velika Plana', 'Srbija', '0613339922', 'dipl. inÅ¾enjer elektrotehnike', '1 godina', '2021-07-30', '1998-12-26', '23', '', '620e60296c565.pdf', 'e215397a527553d4afe8f2d63360392e', 2, 'Ä†ao, ja sam Stevan!', ''),
(114, 'Sanja', 'MilenkoviÄ‡', 'sanja@gmail.com', 'YjdlNDhmMTk4NjFhNDNjNGM2MDdhOGFlZTBiY2M3Mjg=', '', '', '', '0696987654', 'dipl. ekonomista', '4 godine', '2013-07-18', '1990-08-21', '31', '', '620e60c4ca63f.pdf', '64c27d90a1f789805c09e83a3feddc63', 2, 'Volim da radim u timu!', ''),
(115, 'Nikola', 'StankoviÄ‡', 'nikola@gmail.com', 'ZTM4OGYwMmY3NTBlNjVlYmJhOTVhYjk0OTNjZGEwMWU=', 'Ulica bez broja', 'Kragujevac', 'Srbija', '0637556981', 'dipl. ekonomista', '3 godine', '2009-07-20', '1989-04-09', '32', '0904989564848', '620f4a19b09a4.pdf', '33c9ef47399984132132eb8d9c7f5baf', 2, 'Pozdrav', '');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
