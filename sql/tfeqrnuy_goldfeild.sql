-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Aug 26, 2024 at 07:09 PM
-- Server version: 5.7.41-cll-lve
-- PHP Version: 7.2.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tfeqrnuy_goldfeild`
--

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL DEFAULT '1',
  `added_at` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL DEFAULT '' COMMENT 'Tên danh mục, vd: đồ điện tử'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`) VALUES
(1, 'DINH DƯỠNG CHO CÂY'),
(2, 'THUỐC BỆNH'),
(3, 'THUỐC TRỊ SÂU RẦY');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `fullname` varchar(100) DEFAULT '',
  `email` varchar(100) DEFAULT '',
  `phone_number` varchar(20) NOT NULL,
  `address` varchar(200) NOT NULL,
  `note` varchar(100) DEFAULT '',
  `order_date` datetime DEFAULT CURRENT_TIMESTAMP,
  `status` enum('pending','processing','shipped','delivered','cancelled') DEFAULT NULL COMMENT 'Trạng thái đơn hàng',
  `total_money` float DEFAULT NULL,
  `shipping_method` varchar(100) DEFAULT NULL,
  `shipping_address` varchar(200) DEFAULT NULL,
  `shipping_date` date DEFAULT NULL,
  `tracking_number` varchar(100) DEFAULT NULL,
  `payment_method` varchar(100) DEFAULT NULL,
  `active` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `fullname`, `email`, `phone_number`, `address`, `note`, `order_date`, `status`, `total_money`, `shipping_method`, `shipping_address`, `shipping_date`, `tracking_number`, `payment_method`, `active`) VALUES
(16, 7, 'Nguyễn Phát Đạt', NULL, '0947014309', 'Cần Thơ', '', '2024-08-18 19:26:55', 'delivered', 180000, NULL, NULL, NULL, NULL, NULL, NULL),
(17, 13, 'Ngô Trần Đình Bão', NULL, '0939939622', '37 ấp bình hòa xã phương phú huyện phụng hiệp tỉnh hậu giang', '', '2024-08-19 10:06:51', NULL, 290000, NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `order_details`
--

CREATE TABLE `order_details` (
  `id` int(11) NOT NULL,
  `order_id` int(11) DEFAULT NULL,
  `product_id` int(11) DEFAULT NULL,
  `price` float DEFAULT NULL,
  `number_of_products` int(11) DEFAULT NULL,
  `total_money` float DEFAULT NULL,
  `color` varchar(20) DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `order_details`
--

INSERT INTO `order_details` (`id`, `order_id`, `product_id`, `price`, `number_of_products`, `total_money`, `color`) VALUES
(13, 16, 16, 90000, 2, 180000, ''),
(14, 17, 25, 220000, 1, 220000, ''),
(15, 17, 6, 70000, 1, 70000, '');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `name` varchar(350) DEFAULT NULL COMMENT 'Tên sản phẩm',
  `price` float NOT NULL,
  `thumbnail` varchar(300) DEFAULT '',
  `description` longtext,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `category_id` int(11) DEFAULT NULL,
  `count` int(11) DEFAULT '0',
  `price_old` float DEFAULT NULL,
  `promotion` tinyint(1) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `price`, `thumbnail`, `description`, `created_at`, `updated_at`, `category_id`, `count`, `price_old`, `promotion`) VALUES
(1, 'Max root soil - cal 10 lit', 2100000, 'ddbbd18fbfaf43faaaec216f792a9c3f.jpeg', '•	Thành phần: Chất hữu cơ: 45%, Fulvic Acid: 38%, N: 4%, K₂O: 4%, Amino tự do: 2%, IBA: 250 ppm, Cu, Fe, Zn, Mn,...\r\n•	Công dụng: Cải thiện chất lượng đất, cung cấp dưỡng chất và vi lượng cho cây trồng, giúp cây phát triển khỏe mạnh.', '2024-08-06 08:49:42', NULL, 1, 100, 2500000, 0),
(2, 'Max root soil - chai 1 lit', 220000, '9c7bf876ee19c2d4945971c8c144d07e.jpg', '•	Thành phần: Chất hữu cơ: 45%, Fulvic Acid: 38%, N: 4%, K₂O: 4%, Amino tự do: 2%, IBA: 250 ppm, Cu, Fe, Zn, Mn,...\r\n•	Công dụng: Cải thiện chất lượng đất, cung cấp dưỡng chất và vi lượng cho cây trồng, giúp cây phát triển khỏe mạnh.\r\n•	Quy cách/Khối lượng tịnh: 10 lít/can', '2024-08-06 08:50:45', NULL, 1, 100, 250000, 0),
(3, 'Phos-Kali (0.45.45) ĐỨC', 420000, 'deb245be778f07d4562669be553bb6af.png', '•	Thành phần: P₂O₅: 450g/l, K₂O: 450g/l, ...\r\n•	Công dụng: Cung cấp Photpho và Kali cho cây trồng, giúp cây phát triển mạnh mẽ, tăng cường khả năng ra hoa và đậu quả.', '2024-08-06 09:10:42', NULL, 1, 100, 450000, 0),
(4, 'Fuit Hormon Roost', 1900000, 'c4b1b453616a2518cc772b46f1c659f7.png', '•	Thành phần: Chất hữu cơ: 45%, IBA: 250ppm, Cu, Fe, Zn, Mn, Amino Tự Do: 2%, Fulvic Acid: 38%, N: 4%, K₂O: 4%\r\n•	Công dụng: Cải thiện chất lượng đất, cung cấp dưỡng chất và vi lượng cho cây trồng, giúp cây phát triển khỏe mạnh.\r\n•	Quy cách/Khối lượng tịnh: 1 lít/chai', '2024-08-06 09:31:45', NULL, 1, 100, 2500000, 0),
(5, 'MBZ Italia', 125000, '469a2d332acca2d2bc9f9a58982e8683.png', '•	Thành phần: Bo: 4.9%, Zn: 10%, MgO: 8%, N: 4%\r\n•	Công dụng: Bổ sung Bo, Kẽm, Magiê và Đạm cho cây trồng, giúp cải thiện sức khỏe và năng suất cây trồng.\r\n•	Quy cách/Khối lượng tịnh: 220 ml/chai', '2024-08-06 09:29:06', NULL, 1, 500, 150000, 0),
(6, 'BOMBI GOLD 500WG', 70000, 'a2c73521758c7988786adf880513408e.jpg', '•	Thành phần: Dinotefuran 100g/kg, Imidacloprid 150g/kg, Thiamethoxam 250g/kg\r\n•	Công dụng: Bảo vệ cây trồng khỏi sâu bệnh, tăng cường sức đề kháng và năng suất.\r\n•	Quy cách/Khối lượng tịnh: 100 gram/gói', '2024-08-06 09:07:24', NULL, 3, 100, 75000, 0),
(7, 'Đại Bàng Lửa (rầy)', 45000, '6519bf42b3db4773d3e094092d5814ae.jpg', '•	Thành phần: Thiamethoxam: 35% w/w\r\n•	Công dụng: Bảo vệ cây trồng khỏi rầy, tăng cường sức đề kháng và năng suất.\r\n•	Quy cách/Khối lượng tịnh: 100 gram/gói', '2024-08-06 09:09:30', NULL, 3, 100, 40000, 0),
(8, 'Siêu Sâu 777', 160000, 'c5006a86505e845024b71ab978d78ebf.jpg', '•	Thành phần: Profenofos 400g/L, Cypermthrin 40g/L\r\n•	Công dụng: Diệt trừ sâu bọ, bảo vệ cây trồng.\r\n•	Quy cách: 450 ml/chai', '2024-08-06 09:12:06', NULL, 3, 100, 165000, 0),
(9, 'BROWCO 50WG', 75000, 'edbbd95f5dbc748dc71d656600a151af.jpg', '•	Thành phần: Emamectin benzoate 50g/kg\r\n•	Công dụng: Diệt sâu hiệu quả, bảo vệ mùa màng.\r\n•	Quy cách: 75 gram/gói, 150 gram/gói', '2024-08-06 09:14:03', NULL, 3, 100, 80000, 0),
(10, 'Neko 69WP 100gr', 35000, '336c093c60150ebb1da75d900a2537d3.jpg', '•	Thành phần: Dimethomorph 9%, Mancozeb 60%\r\n•	Công dụng: Phòng trừ nấm bệnh, bảo vệ cây trồng.\r\n•	Quy cách: 100 gram/gói, 500 gram/gói', '2024-08-06 09:17:43', NULL, 2, 100, 40000, 0),
(15, 'IMMUNITY BOSSTROOTM 700 ( Root soil)', 410000, 'c3deaff69ee29b4e1dbf142d05dd11fd.png', '•	Thành phần: Hữu cơ: 35%\r\n•	Công dụng: Cung cấp chất hữu cơ, cải thiện sức khỏe cây trồng.\r\n•	Quy cách: 5 lit/can', '2024-08-06 09:30:55', NULL, 1, 100, 450000, 0),
(16, 'AV-IDA-ZN', 90000, '83cdfd095f98e4c585685a621ee86cc6.png', '•	Thành phần: Zn: 25.000 ppm, Sulfur: 700.000 ppm\r\n•	Công dụng: Cung cấp kẽm và lưu huỳnh, giúp cây phát triển tốt hơn.\r\n•	Quy cách: 250 ml/chai', '2024-08-06 09:25:42', NULL, 1, 100, 100000, 0),
(17, 'MAX DEEP', 65000, '937fa741c405cb8ec4e7b5fd60ca17a5.jpeg', '•	Thành phần: B: 2.000 ppm, Zn: 200 ppm, Fe: 100 ppm, Cu: 50 ppm, Phụ gia đặc biệt: 100%\r\n•	Công dụng: Cung cấp vi lượng cần thiết cho cây trồng.\r\n•	Quy cách: 120 ml/chai\r\n', '2024-08-06 09:26:30', NULL, 3, 100, 100000, 0),
(18, 'Newriver - Fosfo', 350000, '8d08426ebd1b02e8726c414a98489e4d.jpg', '•	Thành phần: P2O5HH 450g/L, K2OHH 300g/L\r\n•	Công dụng: Cung cấp phốt pho và kali cho cây trồng.\r\n•	Quy cách: 1 lit/chai', '2024-08-06 09:27:04', NULL, 1, 100, 400000, 0),
(19, 'KBS - Italia', 120000, 'bb887890707d4610d6fec331b2865aa2.jpg', '•	Thành phần: N: 4%, K₂O: 47%, SO₃: 31%, Bo: 0.3%\r\n•	Công dụng: Cung cấp Đạm, Kali và Lưu huỳnh, giúp cây trồng phát triển toàn diện và tăng cường sức đề kháng.\r\n•	Quy cách/Khối lượng tịnh: 220 gram/hũ', '2024-08-06 09:30:28', NULL, 1, 500, 150000, 0),
(20, 'Epnon Phos 600', 305000, 'b40b133d2029a49d1038402a70c04c6e.png', '•	Thành phần: P2O5HH 40,7%, K2OHH 5,3%, Sắt 500 mg/L, Kẽm 500 mg/L, Molipđen 100 mg/L\r\n•	Công dụng: Cung cấp phốt pho, kali, sắt, kẽm và molipđen cho cây trồng.\r\n•	Quy cách: 1 lit/chai', '2024-08-06 09:31:35', NULL, 1, 100, 350000, 0),
(21, 'Kamycinusa 75SL', 140000, 'a676386c77de0eb33a4a029c7e80b743.jpg', '•	Thành phần: Kasugamycin 10g/L, Ningnamicin 65g/L\r\n•	Công dụng: Diệt vi khuẩn gây bệnh cho cây.\r\n•	Quy cách: 200 ml/chai', '2024-08-06 09:32:30', NULL, 2, 100, 160000, 0),
(22, 'ET-Funpro 20SL', 140000, '27443cd27be77a03e64cbfe4cc33ee45.jpg', '•	Thành phần: Fungous Proteoglycan 20g/L\r\n•	Công dụng: Diệt trừ nấm bệnh, bảo vệ cây trồng.\r\n•	Quy cách: 250 ml/chai', '2024-08-06 09:33:46', NULL, 2, 100, 160000, 0),
(23, 'Nano gold', 95000, '01ffacd1dc6bb7d7f27ac0ebf9881261.jpg', '•	Thành phần: Organic matter: 25%, pH H2O: 5\r\n•	Công dụng: Cải thiện chất lượng đất, cung cấp dinh dưỡng hữu cơ cho cây.\r\n•	Quy cách: 100 ml/chai', '2024-08-06 09:34:20', NULL, 1, 100, 100000, 0),
(24, 'King sullong', 1450000, '96929eda68a4e4638f05201f39de94cc.png', '•	Thành phần: Zn: 25.000 ppm, Liquid Elemental Sulfur: 700.000 ppm\r\n•	Công dụng: Cung cấp kẽm và lưu huỳnh, giúp cây trồng phát triển.\r\n•	Quy cách: 5 lit/can', '2024-08-06 09:35:27', NULL, 2, 100, 1500000, 0),
(25, 'Baclolac 250SC (sữa)', 220000, '0107dbfa1ee301c406089eb47c1324fe.jpg', '•	Thành phần: Paclobutrazole 250g/L\r\n•	Công dụng: Điều hòa sinh trưởng, kiểm soát kích thước cây.\r\n•	Quy cách: 1 lit/chai', '2024-08-06 09:36:00', NULL, 1, 100, 250000, 0),
(26, 'Lân 86', 110000, 'f50ce52bd28014dafb56189b801a63b1.png', '•	Thành phần: N: 10%, P2O5: 50%\r\n•	Công dụng: Cung cấp phốt pho và đạm cho cây.\r\n•	Quy cách: 1 kg/gói', '2024-08-06 09:36:46', NULL, 1, 100, 150000, 0),
(27, '10-60-10 Plus', 110000, '5624cb19d65fe52782c2b6ecd3e87ac7.jpg', '•	Thành phần: N: 10%, P2O5: 60%, K: 10%\r\n•	Công dụng: Phân bón hỗn hợp cung cấp dinh dưỡng đa dạng cho cây trồng.\r\n•	Quy cách: 1 kg/hộp', '2024-08-06 09:37:35', NULL, 1, 100, 150000, 0),
(28, 'MKP (0.52.34)', 110000, '4ea2cf4491e4b27516edfedcbc1b33cb.png', '•	Thành phần: K: 52%, P2O5: 34%\r\n•	Công dụng: Cung cấp kali cho cây trồng.\r\n•	Quy cách: 1 kg/gói', '2024-08-06 09:38:08', NULL, 1, 100, 150000, 0),
(29, 'Le Dan 95Sp', 60000, '87459b25150cc45a737f7f1313a29a7d.jpg', '•	Thành phần: Cartap Hydrochloride: 95%\r\n•	Công dụng: Bảo vệ cây trồng khỏi sâu bệnh, tăng cường sức đề kháng và năng suất.\r\n•	Quy cách/Khối lượng tịnh: 100 gram/gói', '2024-08-06 09:38:53', NULL, 2, 100, 100000, 0),
(30, 'Canci Bo (Mỹ)', 140000, '13a14e473fafa79afd1419ebed4d1460.png', '•	Thành phần: B: 14.9%, Ca: 26%\r\n•	Công dụng: Bổ sung Bo và Canxi, giúp cây trồng tăng cường sức đề kháng và phát triển mạnh mẽ.\r\n•	Quy cách/Khối lượng tịnh: 500 ml/chai', '2024-08-06 09:39:34', NULL, 1, 100, 150000, 0),
(31, 'CaNit (Ba Lan)', 105000, 'a08027fff08ee476c9bf4e8e04d88c54.jpeg', '•	Thành phần: Ca: 17%, NO₃: 8.5%\r\n•	Công dụng: Cung cấp canxi và nitrat, giúp cây trồng phát triển mạnh mẽ và cải thiện chất lượng quả.\r\n•	Quy cách/Khối lượng tịnh: 500 ml/chai', '2024-08-06 09:40:09', NULL, 1, 100, 150000, 0),
(32, 'Gold 999', 140000, 'a634dc6e028cd88c07029427ad19d710.jpg', '•	Thành phần: Fe: 1000 ppm\r\n•	Công dụng: Bổ sung sắt, giúp cây trồng cải thiện quá trình quang hợp và phát triển khỏe mạnh.\r\n•	Quy cách/Khối lượng tịnh: 500 ml/chai', '2024-08-06 09:40:47', NULL, 1, 100, 150000, 0),
(33, 'Kali Silic', 140000, '2cafa48b2dc03e9587b2e453d8ff0797.jpg', '•	Thành phần: Kali: 12.3%, Silic: 26.3%\r\n•	Công dụng: Cung cấp Kali và Silic, giúp cây trồng tăng cường sức khỏe, cải thiện độ bền của cây và chất lượng quả.\r\n•	Quy cách/Khối lượng tịnh: 500 ml/chai', '2024-08-06 09:41:22', NULL, 1, 100, 150000, 0),
(34, 'ILSAMIN 450ml ( Ý)', 239000, NULL, '•	Thành phần: Amino acids: 16.5%, B: 5%, N: 4%\r\n•	Công dụng: Cung cấp amino acids và vi lượng, giúp cây trồng phát triển khỏe mạnh, cải thiện năng suất và chất lượng.\r\n•	Quy cách/Khối lượng tịnh: 450 ml/chai', '2024-08-06 09:41:54', NULL, 1, 100, 250000, 0),
(35, 'Doctor', 125000, 'a536a87bd1bd283ab88aaa3d24a0570b.jpeg', '•	Thành phần: Zn hữu cơ: 10%, Polyphenols hữu cơ: 10%\r\n•	Công dụng: Bổ sung kẽm và polyphenol hữu cơ, giúp cây trồng tăng cường sức đề kháng và khả năng chống lại bệnh tật.\r\n•	Quy cách/Khối lượng tịnh: 200 ml/chai', '2024-08-06 09:42:25', NULL, 1, 100, 150000, 0),
(36, 'Siêu Lân Bo Italia', 120000, '284b07d7730fb099a028fffbbe948753.jpg', '•	Thành phần: N: 7.5%, P₂O₅: 27%, B: 8.5%, Zn: 1.5%\r\n•	Công dụng: Cung cấp Đạm, Photpho, Bo và Kẽm cho cây trồng, giúp cây phát triển mạnh mẽ và tăng cường năng suất.\r\n•	Quy cách/Khối lượng tịnh: 250 gram/hũ', '2024-08-06 09:43:32', NULL, 1, 100, 150000, 0);

-- --------------------------------------------------------

--
-- Table structure for table `product_images`
--

CREATE TABLE `product_images` (
  `id` int(11) NOT NULL,
  `product_id` int(11) DEFAULT NULL,
  `image_url` varchar(300) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `product_images`
--

INSERT INTO `product_images` (`id`, `product_id`, `image_url`) VALUES
(55, 7, '6519bf42b3db4773d3e094092d5814ae.jpg'),
(57, 3, 'cf946244fff02ee4b5ffc49fb9ecdc9b.jpg'),
(58, 5, 'cafcb2941f7eba4f12a179ec448b661c.jpg'),
(59, 6, '10b336d965d0562ffed1b7ed8aaf765c.jpg'),
(60, 6, 'a8304d572281f623785372418ce97ae3.jpg'),
(61, 6, '1b24910c278eed493c09c0db781b6bb6.jpg'),
(63, 10, '4c5fdcc258d136298fe532e021972f97.jpg'),
(65, 17, 'abb9aacd9fc3899ea7911ea09a07e5dd.heic'),
(68, 22, 'e1cd743dd28a4204f9cd4a22b9445121.jpg'),
(69, 29, '87459b25150cc45a737f7f1313a29a7d.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` int(11) NOT NULL,
  `name` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`) VALUES
(1, 'User'),
(99, 'Admin');

-- --------------------------------------------------------

--
-- Table structure for table `social_accounts`
--

CREATE TABLE `social_accounts` (
  `id` int(11) NOT NULL,
  `provider` varchar(20) NOT NULL COMMENT 'Tên nhà social network',
  `provider_id` varchar(50) NOT NULL,
  `email` varchar(150) NOT NULL COMMENT 'Email tài khoản',
  `name` varchar(100) NOT NULL COMMENT 'Tên người dùng',
  `user_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `tokens`
--

CREATE TABLE `tokens` (
  `id` int(11) NOT NULL,
  `token` varchar(255) NOT NULL,
  `token_type` varchar(50) NOT NULL,
  `expiration_date` datetime DEFAULT NULL,
  `revoked` tinyint(1) NOT NULL,
  `expired` tinyint(1) NOT NULL,
  `user_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `fullname` varchar(100) DEFAULT '',
  `phone_number` varchar(10) NOT NULL,
  `address` varchar(200) DEFAULT '',
  `password` varchar(100) NOT NULL DEFAULT '',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `is_active` tinyint(1) DEFAULT '1',
  `date_of_birth` date DEFAULT NULL,
  `facebook_account_id` int(11) DEFAULT '0',
  `google_account_id` int(11) DEFAULT '0',
  `role_id` int(11) DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `fullname`, `phone_number`, `address`, `password`, `created_at`, `updated_at`, `is_active`, `date_of_birth`, `facebook_account_id`, `google_account_id`, `role_id`) VALUES
(7, 'Nguyễn Phát Đạt', '0947014309', 'Cần Thơ', '18d47b459d5882f3a1fabb89071a8f4554a391ea4234c7dfb42b1ae98dd46bb7', '2024-08-11 18:34:46', '2024-08-11 18:34:46', 1, '1998-06-15', 0, 0, 99),
(10, 'Nguyễn Đặng Phương Nhi', '0975116307', '391 đường 30/4, Ninh Kiều, Cần Thơ', '15221a319eb50afd440bc3b244e4b24c89abf36d32ab1462d204b8004126490b', '2024-08-15 23:32:12', NULL, 1, '1999-09-22', 0, 0, 99),
(12, 'Nguyễn Phát Đạt', '0559955783', 'Cà Mau', 'd01dcadaaf22670e001e10aecf5626a84161018c8a2603c252ad51499b733a97', '2024-08-16 10:21:08', NULL, 1, '1998-06-15', 0, 0, 1),
(13, 'Ngô Trần Đình Bão', '0939939622', '37 ấp bình hòa, xã phương phú, huyện phụng hiệp, tỉnh hậu giang', '325f89ee09e69974754392664e1fbc6b91a048d45bbbc0005b32d422be35ea02', '2024-08-19 10:03:11', NULL, 1, '1996-10-01', 0, 0, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `order_details`
--
ALTER TABLE `order_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_id` (`order_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `category_id` (`category_id`);

--
-- Indexes for table `product_images`
--
ALTER TABLE `product_images`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_product_images_product_id` (`product_id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `social_accounts`
--
ALTER TABLE `social_accounts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `tokens`
--
ALTER TABLE `tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `token` (`token`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `role_id` (`role_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `order_details`
--
ALTER TABLE `order_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `product_images`
--
ALTER TABLE `product_images`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=70;

--
-- AUTO_INCREMENT for table `social_accounts`
--
ALTER TABLE `social_accounts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tokens`
--
ALTER TABLE `tokens`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `cart_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `cart_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `order_details`
--
ALTER TABLE `order_details`
  ADD CONSTRAINT `order_details_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`),
  ADD CONSTRAINT `order_details_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`);

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`);

--
-- Constraints for table `product_images`
--
ALTER TABLE `product_images`
  ADD CONSTRAINT `fk_product_images_product_id` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `product_images_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`);

--
-- Constraints for table `social_accounts`
--
ALTER TABLE `social_accounts`
  ADD CONSTRAINT `social_accounts_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `tokens`
--
ALTER TABLE `tokens`
  ADD CONSTRAINT `tokens_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
