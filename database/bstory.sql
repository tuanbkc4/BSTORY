-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 06, 2021 at 10:55 AM
-- Server version: 10.4.20-MariaDB
-- PHP Version: 8.0.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bstory`
--

-- --------------------------------------------------------

--
-- Table structure for table `cat`
--

CREATE TABLE `cat` (
  `cat_id` int(6) UNSIGNED NOT NULL,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cat`
--

INSERT INTO `cat` (`cat_id`, `name`) VALUES
(1, 'Ngôn Tình'),
(2, 'Truyện teen'),
(3, 'Kiếm hiệp'),
(4, 'Truyện ma'),
(5, 'Truyện vui');

-- --------------------------------------------------------

--
-- Table structure for table `contact`
--

CREATE TABLE `contact` (
  `contact_id` int(6) UNSIGNED NOT NULL,
  `name` varchar(250) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(250) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `website` varchar(250) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `content` varchar(250) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `story`
--

CREATE TABLE `story` (
  `story_id` int(6) UNSIGNED NOT NULL,
  `name` varchar(250) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `preview_text` varchar(250) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `detail_text` varchar(250) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `cat_id` int(6) DEFAULT NULL,
  `picture` varchar(250) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `counter` int(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `story`
--

INSERT INTO `story` (`story_id`, `name`, `preview_text`, `detail_text`, `created_at`, `cat_id`, `picture`, `counter`) VALUES
(1, 'Trung Quốc điều thêm 17 tàu đến khu vực giàn khoan', 'Để bảo vệ giàn khoan, Trung Quốc đã điều thêm 17 tàu các loại so với hôm trước, sẵn sàng đâm va vào tàu Việt Nam.\r\n', 'Để bảo vệ giàn khoan, Trung Quốc đã điều thêm 17 tàu các loại so với hôm trước, sẵn sàng đâm va vào tàu Việt Nam. Để bảo vệ giàn khoan, Trung Quốc đã điều thêm 17 tàu các loại so với hôm trước, sẵn sàng đâm va vào tàu Việt Nam.\r\n', '2015-01-14 07:17:42', 1, 'hinh1.jpg', 10),
(2, 'Trọng tài - vết đen của kỳ World Cup sôi động \r\n', 'World Cup 2014 chưa đi hết lượt đầu vòng bảng nhưng các trọng tài đẳng cấp FIFA đã có tới bốn trận bị chỉ trích dữ dội.', 'World Cup 2014 chưa đi hết lượt đầu vòng bảng nhưng các trọng tài đẳng cấp FIFA đã có tới bốn trận bị chỉ trích dữ dội. World Cup 2014 chưa đi hết lượt đầu vòng bảng nhưng các trọng tài đẳng cấp FIFA đã có tới bốn trận bị chỉ trích dữ dội.\r\n', '2015-01-14 07:17:43', 1, 'hinh2.jpg\r\n', 20),
(3, 'Những mỹ nhân Việt duyên dáng ở tuổi tứ tuần', 'Để bảo vệ giàn khoan, Trung Quốc đã điều thêm 17 tàu các loại so với hôm trước, sẵn sàng đâm va vào tàu Việt Nam.\r\n', 'Để bảo vệ giàn khoan, Trung Quốc đã điều thêm 17 tàu các loại so với hôm trước, sẵn sàng đâm va vào tàu Việt Nam. Để bảo vệ giàn khoan, Trung Quốc đã điều thêm 17 tàu các loại so với hôm trước, sẵn sàng đâm va vào tàu Việt Nam.\r\n', '2014-01-14 07:17:44', 2, 'hinh3.jpg\r\n', 30),
(4, 'Chuyển nhượng 17/6: Arsenal mua Balotelli, tráo hàng Man Utd\r\n', 'Đội bóng thành London đang đẩy mạnh việc tuyển lựa những vị trí còn yếu trong đội hình ở cả ba tuyến.\r\n', 'Đội bóng thành London đang đẩy mạnh việc tuyển lựa những vị trí còn yếu trong đội hình ở cả ba tuyến. Đội bóng thành London đang đẩy mạnh việc tuyển lựa những vị trí còn yếu trong đội hình ở cả ba tuyến.\r\n', '2014-01-14 07:17:45', 4, 'hinh4.jpg\r\n', 10),
(5, 'Chuyên gia Anh tin chắc vị trí MH370 rơi\r\n', 'Các chuyên gia thuộc công ty viễn thông Anh Inmarsat cho rằng họ xác định được vị trí chiếc máy bay MH370 đã rơi xuống trên Ấn Độ Dương, tuy nhiên đội.\r\n', 'Các chuyên gia thuộc công ty viễn thông Anh Inmarsat cho rằng họ xác định được vị trí chiếc máy bay MH370 đã rơi xuống trên Ấn Độ Dương, tuy nhiên đội. Các chuyên gia thuộc công ty viễn thông Anh Inmarsat cho rằng họ xác định được vị trí chiếc máy ba', '2013-01-14 07:17:46', 3, 'hinh5.jpg\r\n', 31);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(6) UNSIGNED NOT NULL,
  `username` varchar(250) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(250) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fullname` varchar(250) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `fullname`) VALUES
(1, 'admin', '123456', 'Nguyễn Văn C'),
(2, 'vinaenter', 'vne123', 'VinaenterEDU'),
(3, 'mod', 'mod123', 'MOD hệ thống');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cat`
--
ALTER TABLE `cat`
  ADD PRIMARY KEY (`cat_id`);

--
-- Indexes for table `contact`
--
ALTER TABLE `contact`
  ADD PRIMARY KEY (`contact_id`);

--
-- Indexes for table `story`
--
ALTER TABLE `story`
  ADD PRIMARY KEY (`story_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cat`
--
ALTER TABLE `cat`
  MODIFY `cat_id` int(6) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `contact`
--
ALTER TABLE `contact`
  MODIFY `contact_id` int(6) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `story`
--
ALTER TABLE `story`
  MODIFY `story_id` int(6) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(6) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
