-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- 主机： 127.0.0.1
-- 生成日期： 2019-11-13 21:43:21
-- 服务器版本： 10.4.8-MariaDB
-- PHP 版本： 7.3.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- 数据库： `vege`
--

-- --------------------------------------------------------

--
-- 表的结构 `admin`
--
CREATE DATABASE `vege`;
USE   `vege`;

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `UserName` varchar(100) DEFAULT NULL,
  `Password` varchar(100) DEFAULT NULL,
  `localtion` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- 转存表中的数据 `admin`
--

INSERT INTO `admin` (`id`, `UserName`, `Password`, `localtion`) VALUES
(1, 'admin', 'limgwei000', NULL);

-- --------------------------------------------------------

--
-- 表的结构 `cart`
--

CREATE TABLE `cart` (
  `id` int(11) NOT NULL,
  `farmerID` int(11) DEFAULT NULL,
  `customerID` varchar(11) DEFAULT NULL,
  `productID` int(11) NOT NULL,
  `unitPrice` double(11,2) DEFAULT NULL,
  `quantity` int(11) NOT NULL,
  `CreationDate` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- 表的结构 `customer`
--

CREATE TABLE `customer` (
  `id` int(11) NOT NULL,
  `pid` varchar(12) DEFAULT NULL,
  `FullName` varchar(100) DEFAULT NULL,
  `UserName` varchar(100) DEFAULT NULL,
  `Password` varchar(100) DEFAULT NULL,
  `wallet` double(10,2) NOT NULL,
  `address` text DEFAULT NULL,
  `PhoneNumber` int(11) DEFAULT NULL,
  `ICNumber` varchar(11) DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `gmail` varchar(100) DEFAULT NULL,
  `picture` varchar(100) DEFAULT NULL,
  `CreationDate` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- 转存表中的数据 `customer`
--

INSERT INTO `customer` (`id`, `pid`, `FullName`, `UserName`, `Password`, `wallet`, `address`, `PhoneNumber`, `ICNumber`, `status`, `gmail`, `picture`, `CreationDate`) VALUES
(1, 'C1', 'Lim G Wei', NULL, NULL, 0.00, NULL, NULL, NULL, 1, NULL, 'kato.jpg', '2019-11-10 09:15:41');

-- --------------------------------------------------------

--
-- 表的结构 `farmer`
--

CREATE TABLE `farmer` (
  `id` int(11) NOT NULL,
  `pid` varchar(12) DEFAULT NULL,
  `FullName` varchar(100) DEFAULT NULL,
  `UserName` varchar(100) DEFAULT NULL,
  `wallet` double(10,2) NOT NULL,
  `deliveryCompany` int(11) NOT NULL,
  `Password` varchar(100) DEFAULT NULL,
  `adress` text DEFAULT NULL,
  `PhoneNumber` int(11) DEFAULT NULL,
  `ICNumber` varchar(11) DEFAULT NULL,
  `shopName` varchar(100) DEFAULT NULL,
  `shopAddress` text DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `logisticID` int(11) NOT NULL,
  `gmail` varchar(100) DEFAULT NULL,
  `picture` varchar(100) DEFAULT NULL,
  `CreationDate` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- 转存表中的数据 `farmer`
--

INSERT INTO `farmer` (`id`, `pid`, `FullName`, `UserName`, `wallet`, `deliveryCompany`, `Password`, `adress`, `PhoneNumber`, `ICNumber`, `shopName`, `shopAddress`, `status`, `logisticID`, `gmail`, `picture`, `CreationDate`) VALUES
(1, 'F1', 'Cing ni', NULL, 0.00, 1, NULL, NULL, NULL, NULL, NULL, NULL, 1, 0, NULL, NULL, '2019-11-10 09:15:41'),
(12, 'F2', 'dd', 'dd', 0.00, 0, 'dd', NULL, 11, '11', 'dd', 'dd', 0, 0, 'dd', 'upload/kato.jpg', '2019-11-11 09:15:35');

-- --------------------------------------------------------

--
-- 表的结构 `logistic`
--

CREATE TABLE `logistic` (
  `id` int(11) NOT NULL,
  `UserName` varchar(100) DEFAULT NULL,
  `Password` varchar(100) DEFAULT NULL,
  `personInCharge` varchar(255) NOT NULL,
  `license` varchar(255) NOT NULL,
  `PhoneNumber` int(11) NOT NULL,
  `companyName` varchar(100) DEFAULT NULL,
  `companyAddress` text DEFAULT NULL,
  `CreationDate` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- 转存表中的数据 `logistic`
--

INSERT INTO `logistic` (`id`, `UserName`, `Password`, `personInCharge`, `license`, `PhoneNumber`, `companyName`, `companyAddress`, `CreationDate`) VALUES
(1, 'admin', 'f925916e2754e5e03f75dd58a5733251', 'LIM G WEI', 'JOHOR', 189774458, 'southern', '49,LANDAK MAMAN,, TAMAN CENTURY GARDEN', '2019-11-13 17:28:54');

-- --------------------------------------------------------

--
-- 表的结构 `orderdetails`
--

CREATE TABLE `orderdetails` (
  `id` int(11) NOT NULL,
  `customerID` varchar(11) NOT NULL,
  `farmerID` int(11) NOT NULL,
  `productID` int(11) DEFAULT NULL,
  `buyByName` varchar(255) NOT NULL,
  `quantity` int(11) NOT NULL,
  `unitPrice` double(11,2) NOT NULL,
  `status` int(3) NOT NULL,
  `paymentID` int(11) NOT NULL,
  `shipmentDate` date NOT NULL,
  `phoneNumber` int(11) NOT NULL,
  `customerAddress` text DEFAULT NULL,
  `CreationDate` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- 转存表中的数据 `orderdetails`
--

INSERT INTO `orderdetails` (`id`, `customerID`, `farmerID`, `productID`, `buyByName`, `quantity`, `unitPrice`, `status`, `paymentID`, `shipmentDate`, `phoneNumber`, `customerAddress`, `CreationDate`) VALUES
(1, 'F1', 1, 1, 'g dick\r\n', 20, 20.00, 0, 0, '0000-00-00', 0, 'My house', '2019-11-10 09:15:41'),
(2, 'C1', 1, 1, '', 11, 12.00, 1, 0, '0000-00-00', 0, NULL, '2019-11-10 09:36:13');

-- --------------------------------------------------------

--
-- 表的结构 `payment`
--

CREATE TABLE `payment` (
  `id` int(11) NOT NULL,
  `customerID` varchar(255) NOT NULL,
  `totalPrice` double(10,2) NOT NULL,
  `customerAddress` text NOT NULL,
  `status` int(10) NOT NULL,
  `shipmentDate` date NOT NULL,
  `creationDate` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `receiveDate` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- 表的结构 `product`
--

CREATE TABLE `product` (
  `id` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `category` varchar(100) DEFAULT NULL,
  `farmerID` int(11) NOT NULL,
  `picture` varchar(11) DEFAULT NULL,
  `details` text DEFAULT NULL,
  `quantity` int(11) NOT NULL,
  `weight` double(10,2) NOT NULL,
  `unitPrice` double(10,2) NOT NULL,
  `CreationDate` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- 转存表中的数据 `product`
--

INSERT INTO `product` (`id`, `name`, `category`, `farmerID`, `picture`, `details`, `quantity`, `weight`, `unitPrice`, `CreationDate`) VALUES
(1, 'bla', NULL, 1, NULL, NULL, 12, 0.00, 20.00, '2019-11-10 09:15:41');

-- --------------------------------------------------------

--
-- 表的结构 `rating`
--

CREATE TABLE `rating` (
  `id` int(11) NOT NULL,
  `customerID` varchar(11) NOT NULL,
  `rates` int(1) DEFAULT NULL,
  `comment` text DEFAULT NULL,
  `CreationDate` timestamp NULL DEFAULT current_timestamp(),
  `productID` int(11) NOT NULL,
  `commentByName` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- 转存表中的数据 `rating`
--

INSERT INTO `rating` (`id`, `customerID`, `rates`, `comment`, `CreationDate`, `productID`, `commentByName`) VALUES
(1, 'C1', 1, 'love you', '2019-11-10 10:28:21', 1, 'G hong\r\n');

-- --------------------------------------------------------

--
-- 表的结构 `receipt`
--

CREATE TABLE `receipt` (
  `id` int(11) NOT NULL,
  `customerID` varchar(11) NOT NULL,
  `farmerID` int(11) NOT NULL,
  `logisticID` int(11) NOT NULL,
  `customerLocation` text NOT NULL,
  `productID` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `receiveBy(Name)` varchar(100) NOT NULL,
  `receiveBy(IC)` varchar(100) NOT NULL,
  `CreationDate` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- 表的结构 `sales`
--

CREATE TABLE `sales` (
  `id` int(11) NOT NULL,
  `farmerID` int(11) NOT NULL,
  `profit` double(11,2) NOT NULL,
  `productID` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `CreationDate` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- 表的结构 `transaction_history`
--

CREATE TABLE `transaction_history` (
  `id` int(11) NOT NULL,
  `userPID` varchar(12) NOT NULL,
  `amount` double(10,2) NOT NULL,
  `CreationDate` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- 表的结构 `verifying_user`
--

CREATE TABLE `verifying_user` (
  `id` int(11) NOT NULL,
  `FullName` varchar(100) DEFAULT NULL,
  `UserName` varchar(100) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `PhoneNumber` int(11) DEFAULT NULL,
  `ICNumber` varchar(11) DEFAULT NULL,
  `shopName` varchar(100) DEFAULT NULL,
  `shopAddress` text DEFAULT NULL,
  `deliveryCompany` varchar(255) NOT NULL,
  `gmail` varchar(100) DEFAULT NULL,
  `picture` varchar(100) DEFAULT NULL,
  `CreationDate` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- 转存表中的数据 `verifying_user`
--

INSERT INTO `verifying_user` (`id`, `FullName`, `UserName`, `password`, `PhoneNumber`, `ICNumber`, `shopName`, `shopAddress`, `deliveryCompany`, `gmail`, `picture`, `CreationDate`) VALUES
(1, 'dd', 'dd', 'dd', 11, '000', 'dd', 'dd', '', 'dd', 'kato.jpg', '2019-11-13 13:57:42');

--
-- 转储表的索引
--

--
-- 表的索引 `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- 表的索引 `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`),
  ADD KEY `farmerID` (`farmerID`),
  ADD KEY `productID` (`productID`);

--
-- 表的索引 `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`id`);

--
-- 表的索引 `farmer`
--
ALTER TABLE `farmer`
  ADD PRIMARY KEY (`id`);

--
-- 表的索引 `logistic`
--
ALTER TABLE `logistic`
  ADD PRIMARY KEY (`id`);

--
-- 表的索引 `orderdetails`
--
ALTER TABLE `orderdetails`
  ADD PRIMARY KEY (`id`),
  ADD KEY `farmerID` (`farmerID`),
  ADD KEY `productID` (`productID`);

--
-- 表的索引 `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`),
  ADD KEY `farmerID` (`farmerID`);

--
-- 表的索引 `rating`
--
ALTER TABLE `rating`
  ADD PRIMARY KEY (`id`),
  ADD KEY `productID` (`productID`);

--
-- 表的索引 `receipt`
--
ALTER TABLE `receipt`
  ADD PRIMARY KEY (`id`),
  ADD KEY `farmerID` (`farmerID`),
  ADD KEY `logisticID` (`logisticID`),
  ADD KEY `productID` (`productID`);

--
-- 表的索引 `sales`
--
ALTER TABLE `sales`
  ADD PRIMARY KEY (`id`),
  ADD KEY `farmerID` (`farmerID`),
  ADD KEY `productID` (`productID`);

--
-- 表的索引 `transaction_history`
--
ALTER TABLE `transaction_history`
  ADD PRIMARY KEY (`id`);

--
-- 表的索引 `verifying_user`
--
ALTER TABLE `verifying_user`
  ADD PRIMARY KEY (`id`);

--
-- 在导出的表使用AUTO_INCREMENT
--

--
-- 使用表AUTO_INCREMENT `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- 使用表AUTO_INCREMENT `customer`
--
ALTER TABLE `customer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- 使用表AUTO_INCREMENT `farmer`
--
ALTER TABLE `farmer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- 使用表AUTO_INCREMENT `logistic`
--
ALTER TABLE `logistic`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- 使用表AUTO_INCREMENT `orderdetails`
--
ALTER TABLE `orderdetails`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- 使用表AUTO_INCREMENT `product`
--
ALTER TABLE `product`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- 使用表AUTO_INCREMENT `rating`
--
ALTER TABLE `rating`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- 使用表AUTO_INCREMENT `receipt`
--
ALTER TABLE `receipt`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- 使用表AUTO_INCREMENT `sales`
--
ALTER TABLE `sales`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- 使用表AUTO_INCREMENT `transaction_history`
--
ALTER TABLE `transaction_history`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- 使用表AUTO_INCREMENT `verifying_user`
--
ALTER TABLE `verifying_user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- 限制导出的表
--

--
-- 限制表 `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `cart_ibfk_1` FOREIGN KEY (`farmerID`) REFERENCES `farmer` (`id`),
  ADD CONSTRAINT `cart_ibfk_2` FOREIGN KEY (`productID`) REFERENCES `product` (`id`);

--
-- 限制表 `orderdetails`
--
ALTER TABLE `orderdetails`
  ADD CONSTRAINT `orderdetails_ibfk_1` FOREIGN KEY (`farmerID`) REFERENCES `farmer` (`id`),
  ADD CONSTRAINT `orderdetails_ibfk_2` FOREIGN KEY (`productID`) REFERENCES `product` (`id`);

--
-- 限制表 `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `product_ibfk_1` FOREIGN KEY (`farmerID`) REFERENCES `farmer` (`id`);

--
-- 限制表 `rating`
--
ALTER TABLE `rating`
  ADD CONSTRAINT `rating_ibfk_1` FOREIGN KEY (`productID`) REFERENCES `product` (`id`);

--
-- 限制表 `receipt`
--
ALTER TABLE `receipt`
  ADD CONSTRAINT `receipt_ibfk_1` FOREIGN KEY (`farmerID`) REFERENCES `farmer` (`id`),
  ADD CONSTRAINT `receipt_ibfk_2` FOREIGN KEY (`logisticID`) REFERENCES `logistic` (`id`),
  ADD CONSTRAINT `receipt_ibfk_3` FOREIGN KEY (`productID`) REFERENCES `product` (`id`);

--
-- 限制表 `sales`
--
ALTER TABLE `sales`
  ADD CONSTRAINT `sales_ibfk_1` FOREIGN KEY (`farmerID`) REFERENCES `farmer` (`id`),
  ADD CONSTRAINT `sales_ibfk_2` FOREIGN KEY (`productID`) REFERENCES `product` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
