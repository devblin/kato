-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 13, 2020 at 10:47 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `kato`
--

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `CID` int(11) NOT NULL,
  `CITEM` int(11) NOT NULL,
  `CUSTOMER` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`CID`, `CITEM`, `CUSTOMER`) VALUES
(59, 18, 7);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `PID` int(11) NOT NULL,
  `PNAME` varchar(100) NOT NULL,
  `PTYPE` varchar(100) NOT NULL,
  `PSELLER` int(11) NOT NULL,
  `PQTY` int(11) NOT NULL,
  `PPRICE` int(11) NOT NULL,
  `PDESC` varchar(1000) NOT NULL,
  `PIMAGE` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`PID`, `PNAME`, `PTYPE`, `PSELLER`, `PQTY`, `PPRICE`, `PDESC`, `PIMAGE`) VALUES
(2, 'Watch (Fastrack)', 'Watches', 9, 0, 999, 'fastrack watch waterproof tough legend smart rude', '5f5a3db0265b9'),
(5, 'FIFA-2020 Game', 'Software', 9, 5, 1500, 'fifa2020 official game of EA-Sports as part of FIFA franchise .....just kiddding', '5f5a3e2bb1bf5'),
(7, 'Moisturizer', 'Skin Care', 9, 9, 1246, 'mosturizer for dry, oily, do not use in wet skin otherwise you will get burned-out\n', '5f5a556e94e52'),
(10, 'VIP Suitcase', 'Baggage', 9, 20, 2000, 'V.I.P baggage is really a tough bag which is durable and strong and reliable', '5f5dec79de801'),
(11, 'Yonex Badminton', 'Sports', 9, 2, 500, 'Yonex badminton made of carbon fiber , and light wight and has strong fibers of net\n', '5f5b8e19578be'),
(12, 'Concepts of Physics', 'Books', 9, 11, 250, 'concepts of physics is a physics book written by HC Verma', '5f5de65314d96'),
(16, 'Nivia Football', 'Sports', 9, 7, 750, 'nivia football tough solid rough good for wet grounds and hard grounds', '5f5dda9d54249'),
(17, 'MacBook Pro (15 inch 25GB RAM 10TB Storage)', 'Electronics', 9, 4, 2150000, 'macbook pro manufactured by apple inc. in there headquaterters', '5f5ddc07b869b'),
(18, 'SkyBag (Grey-Color)', 'Baggage', 9, 11, 2364, 'skybag', '5f5e54bc7a2b5');

-- --------------------------------------------------------

--
-- Table structure for table `sales`
--

CREATE TABLE `sales` (
  `SID` int(11) NOT NULL,
  `SITEMID` int(11) NOT NULL,
  `SBUYER` int(11) NOT NULL,
  `SSELLER` int(11) NOT NULL,
  `SQTY` int(11) NOT NULL,
  `STAMP` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `sales`
--

INSERT INTO `sales` (`SID`, `SITEMID`, `SBUYER`, `SSELLER`, `SQTY`, `STAMP`) VALUES
(4, 12, 7, 9, 1, '2020-09-11 16:23:06'),
(7, 2, 7, 9, 5, '2020-09-04 16:26:26'),
(8, 11, 7, 9, 10, '2020-09-12 11:27:04'),
(9, 5, 7, 9, 2, '2020-09-13 14:34:45'),
(12, 16, 7, 9, 4, '2020-09-01 16:43:45'),
(13, 5, 7, 9, 3, '2020-09-02 16:48:58'),
(14, 18, 7, 9, 1, '2020-09-13 20:06:24');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `ID` int(11) NOT NULL,
  `NAME` varchar(200) NOT NULL,
  `USERNAME` varchar(100) NOT NULL,
  `ROLE` varchar(20) NOT NULL,
  `EMAIL` varchar(100) NOT NULL,
  `PASSWORD` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`ID`, `NAME`, `USERNAME`, `ROLE`, `EMAIL`, `PASSWORD`) VALUES
(7, 'Dex Dhruw', 'dex', 'Buyer', 'dex@gmail.com', '$2y$10$FPjaCuZZaZXa8JTEuZgRGexOSfvfRNu/bSc3KNpGqw8cKI/EDezpq'),
(9, 'Dev Dhruw', 'Dev', 'Seller', 'dev@gmail.com', '$2y$10$soQHRYcpTafCLps0ob9qCuzR7Cq.NU7PBPyuo8NKQFIeTy569O6Nm');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`CID`),
  ADD KEY `CITEM` (`CITEM`),
  ADD KEY `CUSTOMER` (`CUSTOMER`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`PID`),
  ADD KEY `PSELLER` (`PSELLER`);
ALTER TABLE `products` ADD FULLTEXT KEY `PTYPE` (`PTYPE`);

--
-- Indexes for table `sales`
--
ALTER TABLE `sales`
  ADD PRIMARY KEY (`SID`),
  ADD KEY `SITEMID` (`SITEMID`),
  ADD KEY `SBUYER` (`SBUYER`),
  ADD KEY `SSELLER` (`SSELLER`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `NAME` (`NAME`),
  ADD KEY `USERNAME` (`USERNAME`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `CID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `PID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `sales`
--
ALTER TABLE `sales`
  MODIFY `SID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `cart_ibfk_1` FOREIGN KEY (`CITEM`) REFERENCES `products` (`PID`),
  ADD CONSTRAINT `cart_ibfk_2` FOREIGN KEY (`CUSTOMER`) REFERENCES `users` (`ID`);

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_ibfk_1` FOREIGN KEY (`PSELLER`) REFERENCES `users` (`ID`);

--
-- Constraints for table `sales`
--
ALTER TABLE `sales`
  ADD CONSTRAINT `sales_ibfk_1` FOREIGN KEY (`SITEMID`) REFERENCES `products` (`PID`),
  ADD CONSTRAINT `sales_ibfk_2` FOREIGN KEY (`SBUYER`) REFERENCES `users` (`ID`),
  ADD CONSTRAINT `sales_ibfk_3` FOREIGN KEY (`SSELLER`) REFERENCES `users` (`ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
