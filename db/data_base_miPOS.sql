-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jan 29, 2026 at 07:52 PM
-- Server version: 10.11.15-MariaDB-cll-lve
-- PHP Version: 8.4.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mipospro_mipos`
--
CREATE DATABASE IF NOT EXISTS `mipospro_mipos` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `mipospro_mipos`;

-- --------------------------------------------------------

--
-- Table structure for table `brands`
--

CREATE TABLE `brands` (
  `bId` int(11) NOT NULL,
  `bName` varchar(50) NOT NULL DEFAULT 'Sin Marca',
  `shId` int(8) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `client`
--

CREATE TABLE `client` (
  `cId` int(11) NOT NULL,
  `cName` varchar(120) NOT NULL,
  `cDoc` varchar(20) NOT NULL DEFAULT '000000000',
  `cTelf` varchar(20) NOT NULL DEFAULT '3200000000',
  `cDir` varchar(250) NOT NULL DEFAULT 'Local',
  `cEmail` varchar(50) NOT NULL DEFAULT 'email@mipos.pro',
  `cViewInv` int(2) NOT NULL DEFAULT 1,
  `cAddedBy` varchar(4) NOT NULL DEFAULT '1002',
  `cEntryDate` datetime NOT NULL DEFAULT current_timestamp(),
  `clEnable` int(2) NOT NULL DEFAULT 1,
  `shId` int(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `items`
--

CREATE TABLE `items` (
  `pId` int(11) NOT NULL,
  `pBarCode` varchar(50) NOT NULL,
  `pName` varchar(350) NOT NULL,
  `pIdBrand` varchar(50) NOT NULL,
  `pQuantity` int(11) NOT NULL,
  `pCost` int(11) NOT NULL,
  `pPrice` int(11) NOT NULL,
  `pEnable` int(2) NOT NULL DEFAULT 1,
  `shId` int(8) NOT NULL,
  `idStore` int(9) NOT NULL DEFAULT 1,
  `idAux` int(11) NOT NULL DEFAULT 1
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `localvalues`
--

CREATE TABLE `localvalues` (
  `vaId` int(11) NOT NULL,
  `vaData` varchar(50) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `logintime`
--

CREATE TABLE `logintime` (
  `id` int(11) NOT NULL,
  `uId` int(4) NOT NULL,
  `loginTime` datetime NOT NULL,
  `shId` int(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `logouttime`
--

CREATE TABLE `logouttime` (
  `id` int(11) NOT NULL,
  `uId` int(4) NOT NULL,
  `logoutTime` datetime NOT NULL,
  `shId` int(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `notification`
--

CREATE TABLE `notification` (
  `nId` int(11) NOT NULL,
  `nToWhom` varchar(10) NOT NULL,
  `nFromWhom` int(4) NOT NULL,
  `newUserId` int(4) NOT NULL,
  `nMessage` varchar(255) NOT NULL,
  `nDate` datetime NOT NULL,
  `delete` int(1) NOT NULL,
  `shId` int(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `cmId` int(11) NOT NULL,
  `invId` int(11) NOT NULL,
  `pId` int(11) NOT NULL,
  `cId` int(11) NOT NULL,
  `pPrice` int(11) NOT NULL,
  `pQty` int(11) NOT NULL,
  `inCost` int(11) NOT NULL,
  `pMount` int(11) NOT NULL,
  `cPayment` int(11) NOT NULL,
  `tPayment` int(2) NOT NULL DEFAULT 1,
  `bDate` datetime NOT NULL,
  `inSerial` varchar(15000) NOT NULL,
  `orEnable` int(2) NOT NULL DEFAULT 1,
  `shId` int(8) NOT NULL,
  `idSeller` int(9) NOT NULL DEFAULT 0,
  `idStore` int(9) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `purchases`
--

CREATE TABLE `purchases` (
  `puId` int(11) NOT NULL,
  `suId` int(7) NOT NULL,
  `puTotal` int(11) NOT NULL,
  `puPayment` int(11) NOT NULL,
  `puAddedBy` varchar(6) NOT NULL,
  `puDate` datetime NOT NULL,
  `puInvPurchase` varchar(20) NOT NULL,
  `puDetail` varchar(100) NOT NULL,
  `shId` int(8) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `serials`
--

CREATE TABLE `serials` (
  `seId` int(7) NOT NULL,
  `pId` int(7) NOT NULL,
  `sId` int(7) NOT NULL,
  `seSerial` varchar(30) NOT NULL,
  `seAddedBy` varchar(6) NOT NULL,
  `seDate` datetime NOT NULL,
  `seDateSale` datetime DEFAULT NULL,
  `shId` int(8) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `shop`
--

CREATE TABLE `shop` (
  `shId` int(9) NOT NULL,
  `shName` varchar(50) NOT NULL DEFAULT 'Nombre Comercio',
  `shAuxName` varchar(50) NOT NULL DEFAULT '',
  `shDoc` varchar(15) NOT NULL DEFAULT '88888888-0',
  `shTelf` varchar(50) NOT NULL DEFAULT '3200000000',
  `shDir` varchar(80) NOT NULL DEFAULT 'Dirección',
  `shMail` varchar(50) NOT NULL,
  `shWeb` varchar(50) NOT NULL DEFAULT 'www.mipaginaweb.com',
  `shDesc` varchar(80) NOT NULL DEFAULT 'Descripción para la factura',
  `shColor` varchar(10) NOT NULL DEFAULT '#158DCF	',
  `shEnable` int(2) NOT NULL DEFAULT 1,
  `shSearch` int(2) NOT NULL DEFAULT 0,
  `shPrinterName` varchar(50) NOT NULL DEFAULT 'POS-80C',
  `shPrinterType` int(2) NOT NULL DEFAULT 0,
  `shLogo` varchar(100) DEFAULT NULL,
  `shTerms` varchar(1024) NOT NULL DEFAULT 'Mis terminos y condiciones',
  `shInvoiceType` int(2) NOT NULL DEFAULT 0,
  `shInventory` int(2) NOT NULL DEFAULT 0,
  `shClientDefault` int(2) NOT NULL DEFAULT 1,
  `shSetSeller` int(2) DEFAULT 0,
  `shPlan` int(2) NOT NULL DEFAULT 1,
  `shDatePlan` datetime GENERATED ALWAYS AS (`shCreatedOn` + interval 1 month) VIRTUAL,
  `shCostPlan` int(10) NOT NULL DEFAULT 29000,
  `shReference` varchar(20) NOT NULL DEFAULT '''''',
  `shCreatedOn` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `stockin`
--

CREATE TABLE `stockin` (
  `stId` int(11) NOT NULL,
  `pId` int(9) NOT NULL,
  `stOldQuantity` int(11) NOT NULL DEFAULT 0,
  `stQuantity` int(11) NOT NULL,
  `stOldCost` int(11) NOT NULL DEFAULT 0,
  `stNewCost` int(11) NOT NULL,
  `stPrice` int(11) NOT NULL,
  `stIdSupplier` int(9) NOT NULL,
  `stAddedBy` int(5) NOT NULL,
  `stDate` datetime NOT NULL DEFAULT current_timestamp(),
  `shId` int(8) NOT NULL,
  `idStore` int(9) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `store`
--

CREATE TABLE `store` (
  `stId` int(9) NOT NULL,
  `stName` varchar(30) NOT NULL DEFAULT 'Principal',
  `stType` int(2) NOT NULL DEFAULT 1,
  `stStatus` int(2) NOT NULL DEFAULT 1,
  `stDesc` text NOT NULL DEFAULT '',
  `shId` int(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `suppliers`
--

CREATE TABLE `suppliers` (
  `sId` int(11) NOT NULL,
  `sName` varchar(100) NOT NULL DEFAULT 'Sin Proveedor',
  `sDoc` varchar(15) NOT NULL DEFAULT '888888888-0',
  `sTelf` varchar(20) NOT NULL DEFAULT '0000000000',
  `sDir` varchar(200) NOT NULL DEFAULT 'Dirección Proveedor',
  `sAddedBy` int(4) NOT NULL DEFAULT 1002,
  `sEntryDate` datetime NOT NULL DEFAULT current_timestamp(),
  `shId` int(8) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

CREATE TABLE `transactions` (
  `trId` int(10) NOT NULL,
  `trIdBank` varchar(30) NOT NULL,
  `trReference` varchar(20) NOT NULL,
  `trCustomerEmail` varchar(50) NOT NULL,
  `trAmountInCents` int(10) NOT NULL,
  `trCreatedAt` datetime NOT NULL,
  `tdPaymentMethodType` varchar(30) NOT NULL,
  `trStatus` varchar(20) NOT NULL,
  `shId` int(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `uId` int(4) NOT NULL DEFAULT 1002,
  `uFullName` varchar(150) NOT NULL DEFAULT 'Nombre Usuario',
  `uName` varchar(50) NOT NULL,
  `uPassword` varchar(50) NOT NULL DEFAULT 'password',
  `uType` varchar(15) NOT NULL DEFAULT 'admin',
  `uFlag` tinyint(1) NOT NULL DEFAULT 1,
  `softDelete` int(1) NOT NULL DEFAULT 0,
  `uAddedBy` int(4) NOT NULL DEFAULT 1002,
  `uEntryDate` datetime NOT NULL DEFAULT current_timestamp(),
  `shId` int(8) NOT NULL,
  `idStore` int(9) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `brands`
--
ALTER TABLE `brands`
  ADD PRIMARY KEY (`bId`);

--
-- Indexes for table `client`
--
ALTER TABLE `client`
  ADD PRIMARY KEY (`cId`);

--
-- Indexes for table `items`
--
ALTER TABLE `items`
  ADD PRIMARY KEY (`pId`);

--
-- Indexes for table `localvalues`
--
ALTER TABLE `localvalues`
  ADD PRIMARY KEY (`vaId`),
  ADD UNIQUE KEY `vaData` (`vaData`);

--
-- Indexes for table `logintime`
--
ALTER TABLE `logintime`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `logouttime`
--
ALTER TABLE `logouttime`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notification`
--
ALTER TABLE `notification`
  ADD PRIMARY KEY (`nId`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`cmId`);

--
-- Indexes for table `purchases`
--
ALTER TABLE `purchases`
  ADD PRIMARY KEY (`puId`);

--
-- Indexes for table `serials`
--
ALTER TABLE `serials`
  ADD PRIMARY KEY (`seId`);

--
-- Indexes for table `shop`
--
ALTER TABLE `shop`
  ADD PRIMARY KEY (`shId`);

--
-- Indexes for table `stockin`
--
ALTER TABLE `stockin`
  ADD PRIMARY KEY (`stId`);

--
-- Indexes for table `store`
--
ALTER TABLE `store`
  ADD PRIMARY KEY (`stId`);

--
-- Indexes for table `suppliers`
--
ALTER TABLE `suppliers`
  ADD PRIMARY KEY (`sId`);

--
-- Indexes for table `transactions`
--
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`trId`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `brands`
--
ALTER TABLE `brands`
  MODIFY `bId` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `client`
--
ALTER TABLE `client`
  MODIFY `cId` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `items`
--
ALTER TABLE `items`
  MODIFY `pId` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `localvalues`
--
ALTER TABLE `localvalues`
  MODIFY `vaId` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `logintime`
--
ALTER TABLE `logintime`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `logouttime`
--
ALTER TABLE `logouttime`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `notification`
--
ALTER TABLE `notification`
  MODIFY `nId` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `cmId` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `purchases`
--
ALTER TABLE `purchases`
  MODIFY `puId` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `serials`
--
ALTER TABLE `serials`
  MODIFY `seId` int(7) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `shop`
--
ALTER TABLE `shop`
  MODIFY `shId` int(9) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `stockin`
--
ALTER TABLE `stockin`
  MODIFY `stId` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `store`
--
ALTER TABLE `store`
  MODIFY `stId` int(9) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `suppliers`
--
ALTER TABLE `suppliers`
  MODIFY `sId` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `transactions`
--
ALTER TABLE `transactions`
  MODIFY `trId` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
