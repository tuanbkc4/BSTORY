-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 27, 2021 at 03:24 PM
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
  `name` varchar(250) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cat`
--

INSERT INTO `cat` (`cat_id`, `name`) VALUES
(1, 'Ngôn tình'),
(2, 'Truyện teen'),
(3, 'Kiếm hiệp'),
(4, 'Truyện ma'),
(5, 'Truyện vui');

-- --------------------------------------------------------

--
-- Table structure for table `comment`
--

CREATE TABLE `comment` (
  `comment_id` int(6) UNSIGNED NOT NULL,
  `story_id` int(6) NOT NULL,
  `user_id` int(6) NOT NULL,
  `content` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `create_at` datetime NOT NULL,
  `counter_like` int(11) NOT NULL,
  `user_liked` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `comment`
--

INSERT INTO `comment` (`comment_id`, `story_id`, `user_id`, `content`, `create_at`, `counter_like`, `user_liked`) VALUES
(149, 30, 1, 'Truyện hay', '2021-11-16 08:33:46', 1, ',1'),
(154, 32, 1, 'Tuyện hay', '2021-11-18 09:00:03', 1, ',1'),
(165, 34, 1, 'Truyện hay', '2021-11-25 03:26:52', 1, ',1');

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

--
-- Dumping data for table `contact`
--

INSERT INTO `contact` (`contact_id`, `name`, `email`, `website`, `content`) VALUES
(46, 'Đức Tuấn', 'tuan@gmail.com', 'https://www.facebook.com/tuanbkc4.74', 'noi dung 1'),
(47, 'Tuấn Bùi', 'tuan@gmail.com', 'https://www.24h.com.vn/', 'noi dung 1'),
(61, 'Tuan', 'tuan@gmail.com', 'https://www.24h.com.vn/', 'noi dung 1'),
(62, 'tuan', 'tuan@gmail.com', 'https://www.24h.com.vn/', 'dfgdfg'),
(63, 'Tuan', 'tuan@gmail.com', 'https://www.24h.com.vn/', 'nd 1'),
(64, 'Duc Tuan', 'tuan@gmail.com', 'https://www.24h.com.vn/', 'nd 1'),
(65, 'Duc Tuan', 'tuan@gmail.com', 'https://www.24h.com.vn/', 'nd 1');

-- --------------------------------------------------------

--
-- Table structure for table `story`
--

CREATE TABLE `story` (
  `story_id` int(6) UNSIGNED NOT NULL,
  `name` varchar(250) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `preview_text` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `detail_text` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` date DEFAULT NULL,
  `cat_id` int(6) DEFAULT NULL,
  `picture` varchar(250) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `counter` int(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `story`
--

INSERT INTO `story` (`story_id`, `name`, `preview_text`, `detail_text`, `created_at`, `cat_id`, `picture`, `counter`) VALUES
(27, 'Chuyện tình một đêm', '<p>Chỉ trong một ng&agrave;y, từ thi&ecirc;n kim tiểu thư nh&agrave; họ Đỗ, Đỗ Phương v&agrave; em g&aacute;i Đỗ Minh đ&atilde; kh&ocirc;ng c&ograve;n g&igrave; nữa...</p>\r\n', '<p>Chỉ trong một ng&agrave;y, từ thi&ecirc;n kim tiểu thư nh&agrave; họ Đỗ, Đỗ Phương v&agrave; em g&aacute;i Đỗ Minh đ&atilde; kh&ocirc;ng c&ograve;n g&igrave; nữa.</p>\r\n\r\n<p>Cha mẹ cả hai gặp tai nạn qua đời, c&ocirc;ng ty đ&aacute;ng lẽ thuộc quyền quản l&yacute; của hai người, nhưng v&igrave; cả hai c&ograve;n trẻ, d&ugrave; biết bản di ch&uacute;c bị chỉnh sửa nhưng lại kh&ocirc;ng c&oacute; chứng cứ, kh&ocirc;ng c&oacute; c&aacute;ch n&agrave;o chứng minh.</p>\r\n\r\n<p>V&igrave; thế cả hai phải cắn răng, cực khổ sinh hoạt. Chưa hết, Đỗ Phương c&ograve;n bị ch&iacute;nh bạn th&acirc;n v&agrave; người y&ecirc;u m&igrave;nh phản bội.</p>\r\n', '2021-10-17', 1, 'VNE - 1634442037.webp', 5),
(28, 'Chú cá voi cô đơn', '<p>. Chi&ecirc;m Hỉ từ trước đến nay đều r&otilde; r&agrave;ng h&igrave;nh tượng bạn đời m&igrave;nh t&igrave;m kiếm sẽ như thế n&agrave;o...</p>\r\n', '\r\n<p>C&ocirc; kh&ocirc;ng cần cao ph&uacute; so&aacute;i, c&ocirc; chỉ cần bạn trai tương lai c&oacute; một c&ocirc;ng việc ổn định, quan trọng nhất phải l&agrave; một người t&iacute;nh c&aacute;ch th&uacute; vị, c&oacute; thể ăn n&oacute;i, biết l&agrave;m c&ocirc; vui vẻ.</p>\r\n\r\n<p>Haiii, tất cả cũng v&igrave; b&ugrave; đắp cho sự thiếu hụt &quot;độ mặn&quot; trong người c&ocirc; m&agrave; th&ocirc;i!</p>\r\n\r\n<p>Ai ngờ, c&ocirc; t&igrave;m tới t&igrave;m lui, kết quả lại chọn tr&uacute;ng một người tr&aacute;i ngược ho&agrave;n to&agrave;n so với h&igrave;nh tượng ban đầu c&ocirc; đặt ra!</p>\r\n\r\n<p>Người n&agrave;y vừa cao vừa so&aacute;i, c&ocirc;ng việc l&agrave; c&ocirc;ng nghệ l&agrave;m trang sức, lu&ocirc;n mỉm cười nh&igrave;n c&ocirc;, kh&ocirc;ng n&oacute;i lời n&agrave;o.</p>\r\n', '2021-10-17', 1, 'VNE - 1634442846.webp', 2),
(29, 'Mối tình đầu của anh', '<p>Kh&ocirc;ng ai trong trường cấp ba Thịnh Hoa kh&ocirc;ng biết rằng l&atilde;o đại của họ rất kh&ocirc;ng th&iacute;ch nữ sinh Đồng Miểu mới chuyển tới...</p>\r\n', '\r\n<p>Kh&ocirc;ng ai trong trường cấp ba Thịnh Hoa kh&ocirc;ng biết rằng l&atilde;o đại của họ rất kh&ocirc;ng th&iacute;ch nữ sinh Đồng Miểu mới chuyển tới. Chả phải gh&eacute;t th&igrave; l&agrave;m sao m&agrave; cứ c&oacute; người khen &quot;tiểu Miểu&quot; thế n&agrave;y, &quot;tiểu Miểu&quot; thế nọ, l&atilde;o đại họ ngay lập tức biến</p>\r\n\r\n<p>M&atilde;i đến một ng&agrave;y, họ mới vỡ lẽ ra một sự thật bị họ hiểu nhầm.</p>\r\n\r\n<p>Th&aacute;ng ch&iacute;n khai giảng, thời tiết kh&ocirc; n&oacute;ng ngay cả một ngọn gi&oacute; c&ograve;n kh&ocirc;ng c&oacute;,hoa lan bạc nở khắp, mặt đất được trang điểm một tầng m&agrave;u trắng của c&aacute;nh hoa.</p>\r\n\r\n<p>Kh&ocirc;ng kh&iacute; mềm như b&ocirc;ng ngọt giống như được lẫn v&agrave;o kẹo b&ocirc;ng g&ograve;n.</p>\r\n\r\n<p>Tr&ecirc;n con đường đ&aacute; cuội của cao trung Thịnh Hoa, c&oacute; hai con bồ c&acirc;u trắng b&eacute;o đang tung tăng nhảy nh&oacute;t ăn hạt c&acirc;y, giương cổ tinh thần phấn chấn.</p>\r\n', '2021-10-17', 1, 'VNE - 1634443017.webp', 4),
(30, 'Vụng trộm yêu anh', '<p>Nữ ch&iacute;nh y&ecirc;u thầm nhiều năm nhưng nhỏ tuổi kh&ocirc;ng d&aacute;m n&oacute;i, nam ch&iacute;nh chỉ biết nu&ocirc;i vợ từ b&eacute;,cưng chiều nữ ch&iacute;nh...</p>\r\n', '<p>&Aacute;nh mặt trời ch&oacute;i chang, tiếng ve k&ecirc;u như x&eacute; r&aacute;ch ch&acirc;n trời.</p>\r\n\r\n<p>Trần Minh H&uacute;c đứng tr&ecirc;n bục giảng, tay cầm c&acirc;y thước ba g&oacute;c d&ugrave;ng để giảng b&agrave;i. Hơn nửa chiếc &aacute;o ướt đẫm mồ h&ocirc;i.</p>\r\n\r\n<p>Trời n&oacute;ng như muốn bốc hơi. Chiếc quạt trần vẫn quay đều tạo ra tiếng ồn lớn. Dưới nền nhiệt độ cao thế n&agrave;y, ngay cả những cơn gi&oacute; cũng l&agrave; gi&oacute; n&oacute;ng.</p>\r\n\r\n<p>Học sinh b&ecirc;n dưới đều b&agrave;y ra d&aacute;ng vẻ mệt mỏi.</p>\r\n\r\n<p>&Ocirc;ng kh&ocirc;ng khỏi c&oacute; ch&uacute;t gắt gỏng.</p>\r\n\r\n<p>&quot;Nh&igrave;n l&ecirc;n bảng.&quot; Thấy trạng th&aacute;i của một nữ sinh ngồi ở h&agrave;ng thứ ba, Trần Minh H&uacute;c nh&iacute;u m&agrave;y, đập mạnh c&acirc;y thước v&agrave;o bảng đen: &quot;C&oacute; nghe thấy kh&ocirc;ng! Nh&igrave;n l&ecirc;n bảng!&quot;</p>\r\n', '2021-10-17', 1, 'VNE - 1634443135.webp', 116),
(31, 'Thiếu gia bị ruồng bỏ', '<p>Trung Quốc, kể về nh&acirc;n vật Diệp Phong - Anh l&agrave; người chồng v&ocirc; dụng trong mắt vợ, l&agrave; h&ograve;n đ&aacute; ng&aacute;ng đường trong mắt mẹ vợ...</p>\r\n', '<p>Trung Quốc, kể về nh&acirc;n vật Diệp Phong - Anh l&agrave; người chồng v&ocirc; dụng trong mắt vợ, l&agrave; h&ograve;n đ&aacute; ng&aacute;ng đường trong mắt mẹ vợ, l&agrave; thằng ngh&egrave;o kiết x&aacute;c trong mắt họ h&agrave;ng, l&agrave; tr&ograve; cười trong c&acirc;u chuyện của tất cả mọi người. Ba năm ở rể, anh chịu đủ mọi nhục nh&atilde;, cho đến một h&ocirc;m, bố mẹ đẻ t&igrave;m tới cửa, n&oacute;i với anh rằng, chỉ cần anh đồng &yacute;, anh sẽ c&oacute; cả thế giới, anh mới l&agrave; con nh&agrave; h&agrave;o m&ocirc;n đ&iacute;ch thực. &quot;Khi bạn đứng l&ecirc;n, cả thế giới đều nằm dưới ch&acirc;n bạn!&quot;</p>\r\n', '2021-10-17', 2, 'VNE - 1634443337.webp', 2),
(32, 'Đẳng cấp người thừa kế', '<p>Bạn g&aacute;i ch&ecirc; ngh&egrave;o, chạy theo ph&uacute; nhị đại, kết quả tự nhi&ecirc;n ở đ&acirc;u ra &ocirc;ng ngoại tỷ ph&uacute; tới nhận ch&aacute;u. &quot;Sao b&acirc;y giờ &ocirc;ng mới xuất hiện...</p>\r\n', '<p>Bạn g&aacute;i ch&ecirc; ngh&egrave;o, chạy theo ph&uacute; nhị đại, kết quả tự nhi&ecirc;n ở đ&acirc;u ra &ocirc;ng ngoại tỷ ph&uacute; tới nhận ch&aacute;u. &quot;Sao b&acirc;y giờ &ocirc;ng mới xuất hiện, cho d&ugrave; ch&aacute;u c&oacute; chết đ&oacute;i, cũng sẽ kh&ocirc;ng nhận &ocirc;ng đ&acirc;u.&quot; &quot;Tinh, t&agrave;i khoản nhận được 100 triệu.&quot; &quot;Ừm, thật tuyệt...&quot;</p>\r\n\r\n<p>L&uacute;c n&agrave;y, một nam một nữ bước ra khỏi t&ograve;a nh&agrave;, ch&agrave;ng trai mặc vest, tay đeo đồng hồ Vacheron Constantin, giắt ch&igrave;a kh&oacute;a BMW ở thắt lưng, c&ocirc; g&aacute;i c&oacute; d&aacute;ng người kh&aacute; đẹp, xinh xắn, hai người cười cười n&oacute;i n&oacute;i.</p>\r\n', '2021-10-17', 2, 'VNE - 1634443426.webp', 15),
(33, 'Ấn công đức', '<p>Khi tỉnh lại, T&ocirc; L&acirc;m An ph&aacute;t hiện nguy&ecirc;n thần m&igrave;nh bị giam trong một thanh kiếm gỉ c&ugrave;ng với ấn C&ocirc;ng Đức...</p>\r\n', '<p>Khi tỉnh lại, T&ocirc; L&acirc;m An ph&aacute;t hiện nguy&ecirc;n thần m&igrave;nh bị giam trong một thanh kiếm gỉ c&ugrave;ng với ấn C&ocirc;ng Đức. N&agrave;ng gặp được Mục Cẩm V&acirc;n - một thiếu ni&ecirc;n kỳ lạ, bề ngo&agrave;i th&igrave; thiện lương nhưng bản chất lại xấu xa kh&ocirc;ng từ thủ đoạn. Nhưng chỉ hắn mới nh&igrave;n thấy v&agrave; nghe được m&igrave;nh n&oacute;i, v&igrave; thế m&agrave; T&ocirc; L&acirc;m An đ&agrave;nh phải nhẫn nhịn, đi theo hắn h&ograve;ng t&igrave;m cơ hội trở m&igrave;nh.</p>\r\n\r\n<p>Hai người đến trấn Thanh Thủy, l&ecirc;n n&uacute;i t&igrave;m bảo vật v&agrave; t&igrave;nh cờ cứu gi&uacute;p hai &ocirc;ng ch&aacute;u nọ, ch&iacute;nh v&igrave; vậy m&agrave; đắc tội với Trương gia. Sau đ&oacute;, hai người đi v&agrave;o một c&aacute;i giếng c&acirc;y v&agrave; li&ecirc;n tiếp gặp phải những chuyện ly kỳ.</p>\r\n\r\n<p>H&agrave;nh tr&igrave;nh d&agrave;i ph&iacute;a trước c&oacute; những điều g&igrave; mới lạ chờ đ&oacute;n hai người? Tại sao chỉ c&oacute; Mục Cẩm V&acirc;n c&oacute; thể nh&igrave;n thấy T&ocirc; L&acirc;m An?</p>\r\n', '2021-10-17', 3, 'VNE - 1634443610.webp', 7),
(34, 'Luật kiếm toàn cầu', '<p>Theo đuổi &ldquo;Nhất Đế&rdquo; &ldquo;Nhị Hậu&rdquo; &ldquo;Tam Vương&rdquo; &ldquo;Thất Hầu&rdquo; &ldquo;Thập Tam H&agrave;o&rdquo; ba năm d&agrave;i, trước đ&ecirc;m &ldquo;Luận kiếm to&agrave;n cầu ở Hoa Sơn&rdquo;...</p>\r\n', '<p>Theo đuổi &ldquo;Nhất Đế&rdquo; &ldquo;Nhị Hậu&rdquo; &ldquo;Tam Vương&rdquo; &ldquo;Thất Hầu&rdquo; &ldquo;Thập Tam H&agrave;o&rdquo; ba năm d&agrave;i, trước đ&ecirc;m &ldquo;Luận kiếm to&agrave;n cầu ở Hoa Sơn&rdquo;, Trần Khải T&acirc;m bất ngờ bị t&ecirc;n tiểu nh&acirc;n &acirc;m hiểm chuốc say kh&ocirc;ng thể tham gia luận kiếm, h&ocirc;m sau lại bị mai phục dưới ch&acirc;n n&uacute;i Thiếu Thất, cảnh giới rớt kh&ocirc;ng ngừng.</p>\r\n<p>Ho&agrave;n to&agrave;n mất đi cơ hội chen ch&acirc;n v&agrave;o h&agrave;ng ngũ cường giả đứng đầu &ldquo;Giang hồ&rdquo;, Khải T&acirc;m ch&aacute;n nản đăng xuất game, rời khỏi &ldquo;Giang hồ&rdquo; từ đ&acirc;y. Thế nhưng&hellip; điều khiến hắn kh&ocirc;ng ngờ l&agrave;, trong c&aacute;i đ&ecirc;m gi&ocirc;ng tố mơ m&agrave;ng ấy, hắn lại tỉnh mộng, trở về thời sinh vi&ecirc;n ba năm trước, khi &ldquo;Giang hồ&rdquo; mới ra mắt chưa đầy một th&aacute;ng.</p>\r\n', '2021-10-17', 3, 'VNE - 1634443703.webp', 1029),
(35, 'Vong ám', '<p>Chuyện xảy ra hơn hai năm rồi. Tôi còn nhớ hôm ấy ba mẹ tôi cãi nhau, tôi chán nản với tất cả những gì đang diễn ra...</p>\r\n', '<p>Chuyện xảy ra hơn hai năm rồi. T&ocirc;i c&ograve;n nhớ h&ocirc;m ấy ba mẹ t&ocirc;i c&atilde;i nhau, t&ocirc;i ch&aacute;n nản với tất cả những g&igrave; đang diễn ra,c&oacute; lẽ rượu sẽ l&agrave;m t&ocirc;i thoải m&aacute;i hơn, thế l&agrave; t&ocirc;i hẹn một v&agrave;i người bạn đi uống rượu, sẽ chẳng c&oacute; g&igrave; bất thường khi&hellip; Kh&ocirc;ng c&oacute; sự xuất hiện của c&ocirc; ta&hellip; C&ocirc; ta&hellip; Một c&ocirc; g&aacute;i kh&aacute; k&igrave; lạ</p>\r\n\r\n<p>V&agrave;o qu&aacute;n t&ocirc;i v&agrave; lũ bạn vẫn như cũ, một hai lon bia v&agrave; v&agrave;i ba m&oacute;n đồ nhấm, t&ocirc;i kh&ocirc;ng vui lũ bạn t&ocirc;i đều biết, tất cả cảm x&uacute;c đều hằn l&ecirc;n từng cơ mặt của t&ocirc;i, một trong số bạn t&ocirc;i c&oacute; hai ba đứa l&agrave; con g&aacute;i, ch&uacute;ng n&oacute; kh&aacute; xinh, mỗi l&uacute;c thế n&agrave;y tụi n&oacute; b&agrave;y ra mu&ocirc;n v&agrave;n l&agrave; tr&ograve; bẩn bựa chủ yếu l&agrave; chọc t&ocirc;i, nhưng b&acirc;y giờ t&ocirc;i kh&ocirc;ng kh&aacute; l&ecirc;n được, cảm gi&aacute;c ch&aacute;n nản bao tr&ugrave;m, cộng với căng thẳng, t&ocirc;i r&iacute;t điếu thuốc rồi từ từ nhả kh&oacute;i, một l&uacute;c sau khi đ&atilde; uống gần hết gần chục lon mới bắt đầu thấy l&acirc;ng l&acirc;ng, nhưng t&ocirc;i lại c&oacute; một cảm gi&aacute;c g&igrave; đ&oacute; bất an, cảm gi&aacute;c n&agrave;y kh&aacute; l&agrave; mạnh mẽ, t&ocirc;i theo phản xạ ng&oacute; nghi&ecirc;ng khắp qu&aacute;n, lũ bạn t&ocirc;i b&acirc;y giờ đ&atilde; bắt đầu la c&agrave;, khắp qu&aacute;n mọi người uống rượu n&oacute;i chuyện một c&aacute;ch ầm ĩ, t&ocirc;i thở hắc ra rồi quay lại b&agrave;n cầm ly bia uống, chưa kịp đưa l&ecirc;n miệng đ&atilde; c&oacute; một đứa giơ ly ra cụng v&agrave;o ly t&ocirc;i c&aacute;i mạnh, t&ocirc;i hơi giật m&igrave;nh v&igrave; kh&aacute; l&agrave; bất ngờ với cả kh&ocirc;ng lường trước được, kết quả l&agrave; ly bia &agrave;o ph&aacute;t l&ecirc;n quần &aacute;o t&ocirc;i, t&ocirc;i bật dậy rồi vẫy mạnh bia tr&ecirc;n &aacute;o xuống, n&oacute; cũng giật m&igrave;nh rồi giơ ta phủi cho t&ocirc;i, t&ocirc;i xua tay rồi bảo đi v&agrave;o nh&agrave; vệ sinh, tụi n&oacute; lại uống tiếp</p>\r\n\r\n<p><img alt=\"\" src=\"/files/images/avt.JPG\" style=\"height:496px; width:491px\" /></p>\r\n', '2021-10-17', 4, 'VNE - 1634443873.webp', 46);

-- --------------------------------------------------------

--
-- Table structure for table `sub_comment`
--

CREATE TABLE `sub_comment` (
  `sub_comment_id` int(6) UNSIGNED NOT NULL,
  `comment_id` int(6) NOT NULL,
  `user_id` int(6) NOT NULL,
  `content` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `create_at` datetime NOT NULL,
  `counter_like` int(11) NOT NULL,
  `user_liked` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sub_comment`
--

INSERT INTO `sub_comment` (`sub_comment_id`, `comment_id`, `user_id`, `content`, `create_at`, `counter_like`, `user_liked`) VALUES
(185, 149, 1, 'Cảm ơn bạn', '2021-11-25 08:41:27', 1, ',1');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(6) UNSIGNED NOT NULL,
  `username` varchar(250) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(250) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `fullname` varchar(250) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `role` int(1) DEFAULT NULL,
  `avt` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `username`, `password`, `fullname`, `role`, `avt`) VALUES
(1, 'admin', 'e10adc3949ba59abbe56e057f20f883e', 'Vinaenter', 1, NULL),
(43, 'tuan1', 'dc483e80a7a0bd9ef71d8cf973673924', 'Duc Tuan', 1, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cat`
--
ALTER TABLE `cat`
  ADD PRIMARY KEY (`cat_id`);

--
-- Indexes for table `comment`
--
ALTER TABLE `comment`
  ADD PRIMARY KEY (`comment_id`);

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
-- Indexes for table `sub_comment`
--
ALTER TABLE `sub_comment`
  ADD PRIMARY KEY (`sub_comment_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cat`
--
ALTER TABLE `cat`
  MODIFY `cat_id` int(6) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `comment`
--
ALTER TABLE `comment`
  MODIFY `comment_id` int(6) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=170;

--
-- AUTO_INCREMENT for table `contact`
--
ALTER TABLE `contact`
  MODIFY `contact_id` int(6) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=66;

--
-- AUTO_INCREMENT for table `story`
--
ALTER TABLE `story`
  MODIFY `story_id` int(6) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- AUTO_INCREMENT for table `sub_comment`
--
ALTER TABLE `sub_comment`
  MODIFY `sub_comment_id` int(6) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=191;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(6) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
