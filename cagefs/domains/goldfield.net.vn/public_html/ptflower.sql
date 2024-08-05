-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 29, 2021 at 05:06 AM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.2.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ptflower`
--

-- --------------------------------------------------------

--
-- Table structure for table `chucvu`
--

CREATE TABLE `chucvu` (
  `cv_ma` int(11) NOT NULL,
  `cv_ten` varchar(50) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `chucvu`
--

INSERT INTO `chucvu` (`cv_ma`, `cv_ten`) VALUES
(1, 'Admin'),
(4, 'Nh&acirc;n vi&ecirc;n b&aacute;n h&agrave;ng');

-- --------------------------------------------------------

--
-- Table structure for table `dondathang`
--

CREATE TABLE `dondathang` (
  `dh_ma` int(11) NOT NULL,
  `dh_ngaylap` datetime NOT NULL,
  `dh_ngaygiao` varchar(50) NOT NULL DEFAULT '',
  `dh_noigiao` varchar(500) NOT NULL,
  `httt_ma` int(11) NOT NULL,
  `tenkhachhang` varchar(50) NOT NULL,
  `sodienthoaimua` int(10) NOT NULL DEFAULT 0,
  `tennguoinhan` varchar(50) DEFAULT NULL,
  `sodienthoainhan` int(10) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `dondathang`
--

INSERT INTO `dondathang` (`dh_ma`, `dh_ngaylap`, `dh_ngaygiao`, `dh_noigiao`, `httt_ma`, `tenkhachhang`, `sodienthoaimua`, `tennguoinhan`, `sodienthoainhan`) VALUES
(24, '2021-05-20 13:42:44', '21/05/20219-12.', '216/6, Phường Hưng Lợi, Quận Ninh Kiều, Thành phố Cần Thơ', 1, 'Nguyễn Ngọc Lợi', 388810316, 'Nguyễn Ngọc Lợi', 388810316),
(25, '2021-05-21 07:03:12', '21/05/202115-18.', '216/6, Phường Hưng Lợi, Quận Ninh Kiều, Thành phố Cần Thơ', 1, 'Nguyễn Ngọc Lợi', 388810316, 'Nguyễn Ngọc Lợi', 388810316),
(26, '2021-05-21 07:09:58', '21/05/202115-18.', '216/6, Phường Hưng Lợi, Quận Ninh Kiều, Thành phố Cần Thơ', 1, 'Nguyễn Ngọc Lợi', 388810316, 'Nguyễn Ngọc Lợi', 388810316),
(27, '2021-05-22 10:17:34', '28/05/20219-12.', '216/6, Phường Hưng Lợi, Quận Ninh Kiều, Thành phố Cần Thơ', 1, 'Nguyễn Ngọc Lợi', 388810316, 'Nguyễn Ngọc Lợi', 388810316),
(28, '2021-05-24 10:09:47', '28/05/20219-12.', '216/6, Phường Phúc Xá, Quận Ba Đình, Thành phố Hà Nội', 1, 'Nguyễn Ngọc Lợi', 1312314123, 'Nguyễn Ngọc Lợi', 2131313123),
(30, '2021-05-27 13:30:06', '28/05/20219-12.', '216/6, Phường Trúc Bạch, Quận Ba Đình, Thành phố Hà Nội', 1, 'Nguyễn Ngọc Lợi', 388810316, 'Nguyễn Ngọc Lợi', 388810316),
(33, '2021-05-28 05:18:59', '29/05/20219-12.', '216/6, Phường Hưng Lợi, Quận Ninh Kiều, Thành phố Cần Thơ', 1, 'Nguyễn Ngọc Lợi', 388810316, 'Nguyễn Ngọc Lợi', 388810316);

-- --------------------------------------------------------

--
-- Table structure for table `hinhsanpham`
--

CREATE TABLE `hinhsanpham` (
  `hsp_ma` int(11) NOT NULL,
  `hsp_tentaptin` varchar(50) DEFAULT NULL,
  `hoa_ma` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `hinhsanpham`
--

INSERT INTO `hinhsanpham` (`hsp_ma`, `hsp_tentaptin`, `hoa_ma`) VALUES
(21, '20210518151154_20210412132250_hinh2.png', 17),
(22, '20210518151306_20210412132257_hinh3.png', 18),
(23, '20210518151523_sn3.png', 19),
(24, '20210518151640_FWM.png', 20),
(25, '20210518151821_FB.png', 21),
(26, '20210518152152_hinh8.png', 22),
(27, '20210518152322_hinh9.png', 23),
(28, '20210518152433_hinh10.png', 24),
(29, '20210518152535_hinh11.png', 25),
(30, '20210518152627_hinh12.png', 26),
(31, '20210521064434_hc1.png', 27),
(32, '20210521064636_hc2.png', 28),
(33, '20210521065014_hcm1.png', 29),
(34, '20210521065140_hcm2.png', 30),
(35, '20210521065636_hty1.png', 31),
(36, '20210521065642_hty2.png', 32),
(37, '20210521070035_hcb1.png', 33),
(38, '20210521070042_hcb2.png', 34);

-- --------------------------------------------------------

--
-- Table structure for table `hinhthucthanhtoan`
--

CREATE TABLE `hinhthucthanhtoan` (
  `httt_ma` int(11) NOT NULL,
  `httt_ten` varchar(50) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `hinhthucthanhtoan`
--

INSERT INTO `hinhthucthanhtoan` (`httt_ma`, `httt_ten`) VALUES
(1, 'Thanh toán khi nhận'),
(2, 'Chuyển khoản');

-- --------------------------------------------------------

--
-- Table structure for table `hoa`
--

CREATE TABLE `hoa` (
  `hoa_ma` int(11) NOT NULL,
  `hoa_ten` varchar(50) DEFAULT NULL,
  `hoa_mota` varchar(500) DEFAULT NULL,
  `hoa_soluong` int(11) DEFAULT NULL,
  `hoa_gia` int(11) DEFAULT NULL,
  `hoa_giacu` int(11) DEFAULT NULL,
  `hoa_ngaycapnhat` datetime DEFAULT NULL,
  `lh_ma` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `hoa`
--

INSERT INTO `hoa` (`hoa_ma`, `hoa_ten`, `hoa_mota`, `hoa_soluong`, `hoa_gia`, `hoa_giacu`, `hoa_ngaycapnhat`, `lh_ma`) VALUES
(17, 'Crystal Pearl', 'B&oacute; hoa nhẹ nh&agrave;ng v&agrave; thanh khiết với hoa Cẩm T&uacute; Cầu đan xen với những đ&oacute;a hoa C&uacute;c Tana được g&oacute;i xinh xắn bằng giấy Kraft. Đ&acirc;y sẽ l&agrave; m&oacute;n qu&agrave; xinh xắn v&agrave; ho&agrave;n hảo d&agrave;nh tặng người thương, gia đ&igrave;nh hoặc bạn b&egrave;.', 5, 499000, 600000, '2021-05-18 20:11:21', 2),
(18, 'Combo Reply Me', 'Bắt đầu tuổi mới bằng to&agrave;n sự đ&aacute;ng y&ecirc;u? Lựa chọn thấu đ&aacute;o cho người bạn y&ecirc;u qu&yacute;!', 5, 699000, 800000, '2021-05-18 20:12:55', 2),
(19, 'Tune In For Love', 'Bắt đầu tuổi mới bằng to&agrave;n sự đ&aacute;ng y&ecirc;u? Lựa chọn thấu đ&aacute;o cho người bạn y&ecirc;u qu&yacute;!', 10, 699000, 1200000, '2021-05-18 20:18:51', 2),
(20, 'Fly With Me', 'Bắt đầu tuổi mới bằng to&agrave;n sự đ&aacute;ng y&ecirc;u? Lựa chọn thấu đ&aacute;o cho người bạn y&ecirc;u qu&yacute;!', 10, 699000, 870000, '2021-05-18 20:18:58', 2),
(21, 'For The Beautiful', 'Những đ&oacute;a hoa hồng phấn được g&oacute;i đặc biệt bằng giấy kraft với d&ograve;ng chữ &quot;Gorgeous You - For The Beautiful&quot; thể hiện th&ocirc;ng điệp một c&aacute;ch tinh tế cho người thương y&ecirc;u của bạn, ph&ugrave; hợp để bạn gửi tặng v&agrave;o những dịp đặc biệt.', 10, 519000, 690000, '2021-05-18 20:17:27', 2),
(22, 'Captivating', 'Kệ hoa to, tươi tắn v&agrave; sang trọng với sự kết hợp của nhiều loại hoa.\r\nĐ&acirc;y sẽ l&agrave; m&oacute;n qu&agrave; tặng đầy &yacute; nghĩa thay cho lời ch&uacute;c mừng trong dịp khai trương hoặc c&aacute;c ng&agrave;y lễ trọng đại.', 5, 1249000, 1550000, '2021-05-18 20:21:11', 4),
(23, 'Magnificient', 'Kệ hoa to, tươi tắn v&agrave; sang trọng với sự kết hợp của nhiều loại hoa.\r\nĐ&acirc;y sẽ l&agrave; m&oacute;n qu&agrave; tặng đầy &yacute; nghĩa thay cho lời ch&uacute;c mừng trong dịp khai trương hoặc c&aacute;c ng&agrave;y lễ trọng đại.', 5, 999000, 1490000, '2021-05-18 20:22:57', 4),
(24, 'Marvellous', 'Kệ hoa to, tươi tắn v&agrave; sang trọng với sự kết hợp của nhiều loại hoa.\r\nĐ&acirc;y sẽ l&agrave; m&oacute;n qu&agrave; tặng đầy &yacute; nghĩa thay cho lời ch&uacute;c mừng trong dịp khai trương hoặc c&aacute;c ng&agrave;y lễ trọng đại.', 5, 929000, 1290000, '2021-05-18 20:24:09', 4),
(25, 'Spectacular', 'Kệ hoa to, tươi tắn v&agrave; sang trọng với sự kết hợp của nhiều loại hoa.\r\nĐ&acirc;y sẽ l&agrave; m&oacute;n qu&agrave; tặng đầy &yacute; nghĩa thay cho lời ch&uacute;c mừng trong dịp khai trương hoặc c&aacute;c ng&agrave;y lễ trọng đại.', 5, 1049000, 1590000, '2021-05-18 20:25:07', 4),
(26, 'Amazing', 'Kệ hoa to, tươi tắn v&agrave; sang trọng với sự kết hợp của nhiều loại hoa.\r\nĐ&acirc;y sẽ l&agrave; m&oacute;n qu&agrave; tặng đầy &yacute; nghĩa thay cho lời ch&uacute;c mừng trong dịp khai trương hoặc c&aacute;c ng&agrave;y lễ trọng đại.', 10, 1290000, 1690000, '2021-05-18 20:26:07', 4),
(27, 'Cherish Bridal', 'B&oacute; hoa lạ mắt với b&ocirc;ng bi m&agrave;u t&iacute;m sẽ l&agrave; người bạn đồng h&agrave;nh trong ng&agrave;y quan trọng của hai bạn.', 5, 789000, 1200000, '2021-05-21 11:42:20', 1),
(28, 'Wholeheartedly', 'B&oacute; hoa hồng nh&atilde; nhặn, tinh khiết v&agrave; thanh lịch sẽ t&ocirc; điểm th&ecirc;m cho bạn trong ng&agrave;y trọng đại của m&igrave;nh.', 5, 429000, 630000, '2021-05-21 11:47:00', 1),
(29, 'Blooming Lily', 'Hộp hoa gỗ với sự kết hợp h&agrave;i h&ograve;a giữa hai t&ocirc;ng m&agrave;u hồng của Lily v&agrave; m&agrave;u xanh của l&aacute;.\r\nĐ&acirc;y sẽ l&agrave; m&oacute;n qu&agrave; bất ngờ v&agrave; ho&agrave;n hảo d&agrave;nh tặng người thương, gia đ&igrave;nh hoặc bạn b&egrave;.', 5, 1529000, 1990000, '2021-05-21 11:49:46', 5),
(30, 'Sweet Blossom', 'Hộp hoa gỗ với sự g&oacute;p mặt của hoa hồng, hoa cẩm t&uacute; cầu v&agrave; cẩm chướng - mang gửi gắm những điều tốt l&agrave;nh đến người nhận.\r\nGiỏ hoa Sweet Blossom trang nh&atilde; v&agrave; thanh lịch th&iacute;ch hợp để tặng trong bất kỳ dịp quan trọng n&agrave;o. ', 5, 769000, 990000, '2021-05-21 11:51:10', 5),
(31, 'First Date', 'B&oacute; hoa C&uacute;c Tana được g&oacute;i đặc biệt bằng giấy kraft với d&ograve;ng chữ &quot;Gorgeous You - For The Beautiful&quot; thể hiện th&ocirc;ng điệp một c&aacute;ch tinh tế cho người thương y&ecirc;u của bạn, ph&ugrave; hợp để bạn gửi tặng v&agrave;o những dịp đặc biệt.', 5, 349000, 590000, '2021-05-21 11:53:54', 6),
(32, 'Roseanne', 'B&oacute; hoa  rực rỡ v&agrave; đầy sức sống với hoa Hồng &amp; Cẩm Chướng tươi tắn. Đ&acirc;y sẽ l&agrave; m&oacute;n qu&agrave; bất ngờ v&agrave; ho&agrave;n hảo d&agrave;nh tặng người thương.', 5, 569000, 749000, '2021-05-21 11:56:20', 6),
(33, 'Relief', 'Gửi lời chia sẻ tới người nhận với V&ograve;ng Hoa Chia Buồn Relief', 5, 1969000, 2450000, '2021-05-21 11:59:37', 7),
(34, 'Farewell', 'Gửi lời chia sẻ tới người nhận với V&ograve;ng Hoa Chia Buồn Farewell.', 10, 1498000, 1890000, '2021-05-28 09:34:47', 7);

-- --------------------------------------------------------

--
-- Table structure for table `hoa_dondathang`
--

CREATE TABLE `hoa_dondathang` (
  `hoa_ma` int(11) NOT NULL,
  `dh_ma` int(11) NOT NULL,
  `hoa_dh_soluong` int(11) NOT NULL,
  `hoa_dh_dongia` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `hoa_dondathang`
--

INSERT INTO `hoa_dondathang` (`hoa_ma`, `dh_ma`, `hoa_dh_soluong`, `hoa_dh_dongia`) VALUES
(17, 33, 1, 499000),
(18, 30, 1, 699000),
(19, 25, 1, 699000),
(19, 26, 1, 699000),
(19, 27, 1, 699000),
(26, 24, 1, 1290000),
(32, 28, 1, 569000);

-- --------------------------------------------------------

--
-- Table structure for table `loaihoa`
--

CREATE TABLE `loaihoa` (
  `lh_ma` int(11) NOT NULL,
  `lh_ten` varchar(50) DEFAULT NULL,
  `lh_mota` varchar(500) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `loaihoa`
--

INSERT INTO `loaihoa` (`lh_ma`, `lh_ten`, `lh_mota`) VALUES
(1, 'Hoa cưới', 'Hoa trưng bày trong đám cưới'),
(2, 'Hoa sinh nhật', 'Hoa tặng dịp sinh nhật'),
(4, 'Hoa khai trương', 'Hoa khai trương'),
(5, 'Hoa ch&uacute;c mừng', 'Hoa ch&uacute;c mừng'),
(6, 'Hoa t&igrave;nh y&ecirc;u', 'Hoa tặng người y&ecirc;u'),
(7, 'Hoa chia buồn', 'Hoa viếng');

-- --------------------------------------------------------

--
-- Table structure for table `nhanvien`
--

CREATE TABLE `nhanvien` (
  `nv_ma` int(11) NOT NULL,
  `nv_ten` varchar(50) NOT NULL,
  `nv_diachi` varchar(500) NOT NULL,
  `nv_taikhoan` varchar(20) NOT NULL,
  `nv_matkhau` varchar(32) NOT NULL,
  `nv_chucvu` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `nhanvien`
--

INSERT INTO `nhanvien` (`nv_ma`, `nv_ten`, `nv_diachi`, `nv_taikhoan`, `nv_matkhau`, `nv_chucvu`) VALUES
(2, 'Nguyễn Ngọc Lợi', '216/6 Hưng Lợi, Ninh Kiều, Cần Thơ', 'admin', '123456', 1),
(11, 'loi', '216/6, Phường Hưng Lợi, Quận Ninh Kiều, Th&agrave;nh phố Cần Thơ', 'loi123', 'loi123', 4);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `chucvu`
--
ALTER TABLE `chucvu`
  ADD PRIMARY KEY (`cv_ma`);

--
-- Indexes for table `dondathang`
--
ALTER TABLE `dondathang`
  ADD PRIMARY KEY (`dh_ma`),
  ADD KEY `FK__hinhthucthanhtoan` (`httt_ma`);

--
-- Indexes for table `hinhsanpham`
--
ALTER TABLE `hinhsanpham`
  ADD PRIMARY KEY (`hsp_ma`),
  ADD KEY `FK__hoa` (`hoa_ma`);

--
-- Indexes for table `hinhthucthanhtoan`
--
ALTER TABLE `hinhthucthanhtoan`
  ADD PRIMARY KEY (`httt_ma`);

--
-- Indexes for table `hoa`
--
ALTER TABLE `hoa`
  ADD PRIMARY KEY (`hoa_ma`) USING BTREE,
  ADD KEY `FK_hoa_loaihoa` (`lh_ma`);

--
-- Indexes for table `hoa_dondathang`
--
ALTER TABLE `hoa_dondathang`
  ADD PRIMARY KEY (`hoa_ma`,`dh_ma`) USING BTREE,
  ADD KEY `dh_ma` (`dh_ma`);

--
-- Indexes for table `loaihoa`
--
ALTER TABLE `loaihoa`
  ADD PRIMARY KEY (`lh_ma`);

--
-- Indexes for table `nhanvien`
--
ALTER TABLE `nhanvien`
  ADD PRIMARY KEY (`nv_ma`),
  ADD KEY `FK_nhanvien_chucvu` (`nv_chucvu`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `chucvu`
--
ALTER TABLE `chucvu`
  MODIFY `cv_ma` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `dondathang`
--
ALTER TABLE `dondathang`
  MODIFY `dh_ma` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `hinhsanpham`
--
ALTER TABLE `hinhsanpham`
  MODIFY `hsp_ma` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `hinhthucthanhtoan`
--
ALTER TABLE `hinhthucthanhtoan`
  MODIFY `httt_ma` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `hoa`
--
ALTER TABLE `hoa`
  MODIFY `hoa_ma` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `loaihoa`
--
ALTER TABLE `loaihoa`
  MODIFY `lh_ma` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `nhanvien`
--
ALTER TABLE `nhanvien`
  MODIFY `nv_ma` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `dondathang`
--
ALTER TABLE `dondathang`
  ADD CONSTRAINT `FK__hinhthucthanhtoan` FOREIGN KEY (`httt_ma`) REFERENCES `hinhthucthanhtoan` (`httt_ma`);

--
-- Constraints for table `hinhsanpham`
--
ALTER TABLE `hinhsanpham`
  ADD CONSTRAINT `FK__hoa` FOREIGN KEY (`hoa_ma`) REFERENCES `hoa` (`hoa_ma`);

--
-- Constraints for table `hoa`
--
ALTER TABLE `hoa`
  ADD CONSTRAINT `FK_hoa_loaihoa` FOREIGN KEY (`lh_ma`) REFERENCES `loaihoa` (`lh_ma`);

--
-- Constraints for table `hoa_dondathang`
--
ALTER TABLE `hoa_dondathang`
  ADD CONSTRAINT `FK_hoa_dondathang_dondathang` FOREIGN KEY (`dh_ma`) REFERENCES `dondathang` (`dh_ma`),
  ADD CONSTRAINT `FK_hoa_dondathang_hoa` FOREIGN KEY (`hoa_ma`) REFERENCES `hoa` (`hoa_ma`);

--
-- Constraints for table `nhanvien`
--
ALTER TABLE `nhanvien`
  ADD CONSTRAINT `FK_nhanvien_chucvu` FOREIGN KEY (`nv_chucvu`) REFERENCES `chucvu` (`cv_ma`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
