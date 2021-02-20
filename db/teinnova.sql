-- phpMyAdmin SQL Dump
-- version 5.0.0-dev
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1:3306
-- Tiempo de generación: 28-09-2020 a las 01:04:04
-- Versión del servidor: 5.7.23
-- Versión de PHP: 7.2.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `teinnova`
--
CREATE DATABASE IF NOT EXISTS `teinnova` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `teinnova`;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `brands`
--

DROP TABLE IF EXISTS `brands`;
CREATE TABLE IF NOT EXISTS `brands` (
  `bId` int(11) NOT NULL AUTO_INCREMENT,
  `bName` varchar(50) NOT NULL,
  PRIMARY KEY (`bId`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `category`
--

DROP TABLE IF EXISTS `category`;
CREATE TABLE IF NOT EXISTS `category` (
  `cId` int(11) NOT NULL AUTO_INCREMENT,
  `cName` varchar(250) NOT NULL,
  `cDoc` double NOT NULL,
  `cTelf` double NOT NULL,
  `cDir` varchar(250) NOT NULL,
  `cViewInv` int(2) NOT NULL,
  `cAddedBy` varchar(4) NOT NULL,
  `cEntryDate` datetime NOT NULL,
  PRIMARY KEY (`cId`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `customer`
--

DROP TABLE IF EXISTS `customer`;
CREATE TABLE IF NOT EXISTS `customer` (
  `cmId` int(11) NOT NULL AUTO_INCREMENT,
  `invId` int(11) NOT NULL,
  `pId` int(11) NOT NULL,
  `cId` int(11) NOT NULL,
  `pPrice` int(11) NOT NULL,
  `pQty` int(11) NOT NULL,
  `inCost` int(11) NOT NULL,
  `pMount` int(11) NOT NULL,
  `cPayment` int(11) NOT NULL,
  `bDate` datetime NOT NULL,
  `inSerial` varchar(15000) NOT NULL,
  PRIMARY KEY (`cmId`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `items`
--

DROP TABLE IF EXISTS `items`;
CREATE TABLE IF NOT EXISTS `items` (
  `pId` int(11) NOT NULL AUTO_INCREMENT,
  `pBarCode` varchar(50) NOT NULL,
  `pName` varchar(250) NOT NULL,
  `pIdBrand` varchar(50) NOT NULL,
  `pQuantity` int(11) NOT NULL,
  `pCost` int(11) NOT NULL,
  `pPrice` int(11) NOT NULL,
  `pEnable` int(2) NOT NULL DEFAULT '1',
  PRIMARY KEY (`pId`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `logintime`
--

DROP TABLE IF EXISTS `logintime`;
CREATE TABLE IF NOT EXISTS `logintime` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uId` int(4) NOT NULL,
  `loginTime` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `logouttime`
--

DROP TABLE IF EXISTS `logouttime`;
CREATE TABLE IF NOT EXISTS `logouttime` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uId` int(4) NOT NULL,
  `logoutTime` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `notification`
--

DROP TABLE IF EXISTS `notification`;
CREATE TABLE IF NOT EXISTS `notification` (
  `nId` int(11) NOT NULL AUTO_INCREMENT,
  `nToWhom` varchar(10) NOT NULL,
  `nFromWhom` int(4) NOT NULL,
  `newUserId` int(4) NOT NULL,
  `nMessage` varchar(255) NOT NULL,
  `nDate` datetime NOT NULL,
  `delete` int(1) NOT NULL,
  PRIMARY KEY (`nId`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `product`
--

DROP TABLE IF EXISTS `product`;
CREATE TABLE IF NOT EXISTS `product` (
  `iId` int(11) NOT NULL AUTO_INCREMENT,
  `cId` int(11) NOT NULL,
  `pId` int(11) NOT NULL,
  `pPrice` varchar(10) NOT NULL,
  `pAddedBy` int(4) NOT NULL,
  `pEntryDate` datetime NOT NULL,
  PRIMARY KEY (`iId`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `purchases`
--

DROP TABLE IF EXISTS `purchases`;
CREATE TABLE IF NOT EXISTS `purchases` (
  `puId` int(11) NOT NULL AUTO_INCREMENT,
  `suId` int(7) NOT NULL,
  `puTotal` int(11) NOT NULL,
  `puPayment` int(11) NOT NULL,
  `puAddedBy` varchar(6) NOT NULL,
  `puDate` datetime NOT NULL,
  `puInvPurchase` varchar(20) NOT NULL,
  `puDetail` varchar(100) NOT NULL,
  PRIMARY KEY (`puId`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `serials`
--

DROP TABLE IF EXISTS `serials`;
CREATE TABLE IF NOT EXISTS `serials` (
  `seId` int(7) NOT NULL AUTO_INCREMENT,
  `pId` int(7) NOT NULL,
  `sId` int(7) NOT NULL,
  `seSerial` varchar(30) NOT NULL,
  `seAddedBy` varchar(6) NOT NULL,
  `seDate` datetime NOT NULL,
  `seDateSale` datetime DEFAULT NULL,
  PRIMARY KEY (`seId`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `suppliers`
--

DROP TABLE IF EXISTS `suppliers`;
CREATE TABLE IF NOT EXISTS `suppliers` (
  `sId` int(11) NOT NULL AUTO_INCREMENT,
  `sName` varchar(250) NOT NULL,
  `sDoc` double NOT NULL,
  `sTelf` double NOT NULL,
  `sDir` varchar(250) NOT NULL,
  `sAddedBy` varchar(7) NOT NULL,
  `sEntryDate` datetime NOT NULL,
  PRIMARY KEY (`sId`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uId` int(3) NOT NULL,
  `uName` varchar(50) NOT NULL,
  `uPassword` varchar(50) NOT NULL,
  `uType` varchar(10) NOT NULL,
  `uFlag` tinyint(1) NOT NULL,
  `softDelete` int(1) NOT NULL,
  `uAddedBy` int(4) NOT NULL,
  `uEntryDate` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `uId`, `uName`, `uPassword`, `uType`, `uFlag`, `softDelete`, `uAddedBy`, `uEntryDate`) VALUES
(1, 1000, 'admin', '5f4dcc3b5aa765d61d8327deb882cf99', 'admin', 1, 0, 1000, '2015-05-14'),
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
