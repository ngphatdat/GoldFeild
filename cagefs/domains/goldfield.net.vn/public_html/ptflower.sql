
CREATE TABLE `chucvu` (
  `staff_id` int(11) NOT NULL AUTO_INCREMENT,
  `staff_name` varchar(50) NOT NULL DEFAULT '',
  PRIMARY KEY (`cv_ma`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4;
CREATE TABLE `order` (
  `order_id` int(11) NOT NULL AUTO_INCREMENT,
  `order_date_start` datetime NOT NULL,
  `order_date_end` varchar(50) NOT NULL DEFAULT '',
  `dh_noigiao` varchar(500) NOT NULL,
  `httt_ma` int(11) NOT NULL,
  `custumer_name` varchar(50) NOT NULL,
  `phone_number` int(10) NOT NULL DEFAULT '0',
  `custumer_name_re` varchar(50) DEFAULT NULL,
  `phone_number_re` int(10) NOT NULL DEFAULT '0',
  PRIMARY KEY (`dh_ma`),
  KEY `FK__hinhthucthanhtoan` (`httt_ma`),
  CONSTRAINT `FK__hinhthucthanhtoan` FOREIGN KEY (`httt_ma`) REFERENCES `hinhthucthanhtoan` (`httt_ma`)
) ENGINE=InnoDB AUTO_INCREMENT=35 DEFAULT CHARSET=utf8mb4;

LOCK TABLES `dondathang` WRITE;
DROP TABLE IF EXISTS `hinhsanpham`;
CREATE TABLE `hinhsanpham` (
  `hsp_ma` int(11) NOT NULL AUTO_INCREMENT,
  `hsp_tentaptin` varchar(50) DEFAULT NULL,
  `product_ma` int(11) DEFAULT NULL,
  PRIMARY KEY (`hsp_ma`),
  KEY `FK__product` (`product_ma`),
  CONSTRAINT `FK__product` FOREIGN KEY (`product_ma`) REFERENCES `product` (`product_ma`)
) ENGINE=InnoDB AUTO_INCREMENT=61 DEFAULT CHARSET=utf8mb4;

DROP TABLE IF EXISTS `pay`;
CREATE TABLE `hinhthucthanhtoan` (
  `httt_ma` int(11) NOT NULL AUTO_INCREMENT,
  `httt_ten` varchar(50) NOT NULL DEFAULT '0',
  PRIMARY KEY (`httt_ma`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;

CREATE TABLE `product` (
  `product_ma` int(11) NOT NULL AUTO_INCREMENT,
  `product_ten` varchar(50) DEFAULT NULL,
  `product_mota` varchar(500) DEFAULT NULL,
  `product_soluong` int(11) DEFAULT NULL,
  `product_gia` int(11) DEFAULT NULL,
  `product_giacu` int(11) DEFAULT NULL,
  `product_ngaycapnhat` datetime DEFAULT NULL,
  `category_ma` int(11) DEFAULT NULL,
  PRIMARY KEY (`product_ma`) USING BTREE,
  KEY `FK_product_category` (`category_ma`),
  CONSTRAINT `FK_product_category` FOREIGN KEY (`category_ma`) REFERENCES `category` (`category_ma`)
) ENGINE=InnoDB AUTO_INCREMENT=74 DEFAULT CHARSET=utf8mb4;

DROP TABLE IF EXISTS `product_dondathang`;
CREATE TABLE `product_dondathang` (
  `product_ma` int(11) NOT NULL,
  `dh_ma` int(11) NOT NULL,
  `product_dh_soluong` int(11) NOT NULL,
  `product_dh_dongia` int(11) NOT NULL,
  PRIMARY KEY (`product_ma`,`dh_ma`) USING BTREE,
  KEY `dh_ma` (`dh_ma`),
  CONSTRAINT `FK_product_dondathang_dondathang` FOREIGN KEY (`dh_ma`) REFERENCES `dondathang` (`dh_ma`),
  CONSTRAINT `FK_product_dondathang_product` FOREIGN KEY (`product_ma`) REFERENCES `product` (`product_ma`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE `category` (
  `category_ma` int(11) NOT NULL AUTO_INCREMENT,
  `category_ten` varchar(50) DEFAULT NULL,
  `category_mota` varchar(500) DEFAULT NULL,
  PRIMARY KEY (`category_ma`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4;

CREATE TABLE `staff` (
  `staff_ma` int(11) NOT NULL AUTO_INCREMENT,
  `staff_ten` varchar(50) NOT NULL,
  `staff_diachi` varchar(500) NOT NULL,
  `staff_taikhoan` varchar(20) NOT NULL,
  `staff_matkhau` varchar(32) NOT NULL,
  `staff_chucvu` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`staff_ma`),
  KEY `FK_staff_chucvu` (`staff_chucvu`),
  CONSTRAINT `FK_staff_chucvu` FOREIGN KEY (`staff_chucvu`) REFERENCES `chucvu` (`cv_ma`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4;

LOCK TABLES `staff` WRITE;
/*!40000 ALTER TABLE `staff` DISABLE KEYS */;
INSERT INTO `staff` VALUES (2,'Nguyễn Đặng Phương Nhi','GoldFeild','admin','goldfield2019',1),(3,'Ho&agrave;i Phương','GoldFeild','hoaiphuong','Phuong12345',4);
/*!40000 ALTER TABLE `staff` ENABLE KEYS */;
UNLOCK TABLES;
