CREATE DATABASE IF NOT EXISTS `foodie` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `foodie`;

-- MySQL dump 10.13  Distrib 5.5.49, for debian-linux-gnu (x86_64)
--
-- Host: 127.0.0.1    Database: shoplt
-- ------------------------------------------------------
-- Server version	5.5.49-0ubuntu0.14.04.1

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `cms_binhchon_cauhoi`
--

#chl*
DROP TABLE IF EXISTS `fd_chungloai`;
CREATE table if NOT EXISTS `fd_chungloai` (
	`id_chl` int(11) NOT NULL AUTO_INCREMENT,
	`ten_chl` varchar(1000) CHARACTER SET utf8 NOT NULL,
	`slug_chl` varchar(1000) CHARACTER SET utf8 NOT NULL,
	`mota_chl` longtext CHARACTER SET utf8 NOT NULL,
	`trangthai_chl` int(1) NOT NULL,
	`url_thumb_chl` varchar(200) CHARACTER SET utf8 NOT NULL,
	PRIMARY KEY (`id_chl`)
) ENGINE MyISAM AUTO_INCREMENT=0 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
INSERT INTO `fd_chungloai` VALUES('', 'Đồ ăn', 'do-an', '', 1, '');

#nha san xuat
DROP TABLE IF EXISTS `fd_nhasanxuat`;
CREATE table IF NOT EXISTS `fd_nhasanxuat` (
	`id_nsx` int(11) NOT NULL AUTO_INCREMENT,
	`ten_nsx` varchar(1000) CHARACTER SET utf8 NOT NULL,
	`diachi_nsx` longtext CHARACTER SET utf8 NOT NULL,
	`mota_nsx` longtext CHARACTER SET utf8 NOT NULL,
	`url_thumb_nsx` varchar(1000) CHARACTER SET utf8 NOT NULL,
	`slug_nsx` varchar(1000) CHARACTER SET utf8 NOT NULL,
	`trangthai_nsx` int(1) NOT NULL,
	PRIMARY KEY (`id_nsx`)
) ENGINE MyISAM AUTO_INCREMENT=0 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
INSERT INTO `fd_nhasanxuat` VALUES('', 'Star', '', '', '', 'star', 1);

#san pham*
DROP TABLE IF EXISTS `fd_sanpham`;
CREATE table IF NOT EXISTS `fd_sanpham` (
	`id_sp` int(11) NOT NULL AUTO_INCREMENT,
	`id_nsx` int(11) NOT NULL,
	`id_chl` int(11) NOT NULL,
	`ten_sp` varchar(1000) CHARACTER SET utf8 NOT NULL,
	`mota_sp` longtext CHARACTER SET utf8 NOT NULL,
	`chitiet_sp` longtext CHARACTER SET utf8 NOT NULL,
	`slug_sp` varchar(1000) CHARACTER SET utf8 NOT NULL,
	`giagoc_sp` int(15) NOT NULL,
	`giamgia_sp` float(20, 1) NOT NULL,
	`giamoi_sp` int(11) NOT NULL,
	`url_thumb_sp` varchar(1000) CHARACTER SET utf8 NOT NULL,
	`ngaydang_sp` datetime NOT NULL,
	`tonkho_sp` int(11) NOT NULL,
	`ghichu_sp` text CHARACTER SET utf8 NOT NULL,
	`solanmua_sp` int(11) NOT NULL,
	`solanxem_sp` int(11) NOT NULL,
	`sodanhgia_sp` int(11) NOT NULL,
	`sosao_sp` float(20, 5) NOT NULL,
	`trangthai_sp` int(1) NOT NULL,
	`nutri_sp` longtext CHARACTER SET utf8 NOT null,
	`url_avt_sp` varchar(300) CHARACTER SET utf8 not null,
	`tukhoa_sp` varchar(200) CHARACTER SET utf8 not null,
	PRIMARY KEY (`id_sp`)
) ENGINE MyISAM AUTO_INCREMENT=0 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

#slider*
DROP TABLE IF EXISTS `fd_slider`;
CREATE table IF NOT EXISTS `fd_slider` (
	`id_slider` int(11) NOT NULL AUTO_INCREMENT,
	`url_thumb_slider` varchar(1000) CHARACTER SET utf8 NOT NULL,
	`mota_slider` longtext CHARACTER SET utf8 NOT NULL,
	`trangthai_slider` int(1) NOT NULL,
	`title_sp` varchar(200) CHARACTER SET utf8 NOT NULL,
	`id_sp` int(11) NOT NULL,
	PRIMARY KEY (`id_slider`)
) ENGINE MyISAM AUTO_INCREMENT=0 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

#khach hang*
DROP TABLE IF EXISTS `fd_khachhang`;
CREATE table IF NOT EXISTS `fd_khachhang` (
	`id_kh` int(11) NOT NULL AUTO_INCREMENT,
	`username_kh` varchar(50) CHARACTER SET utf8 NOT NULL,
	`displayname_kh` varchar(50) CHARACTER SET utf8 NOT NULL,
	`password_kh` varchar(50) CHARACTER SET utf8 NOT NULL,
	`slug_kh` varchar(100) CHARACTER SET utf8 NOT NULL,
	`diachi_kh` longtext CHARACTER SET utf8 NOT NULL,
	`sdt_kh` varchar(15) CHARACTER SET utf8 NOT NULL,
	`email_kh` varchar(100) CHARACTER SET utf8 NOT NULL,
	`ngaythamgia_kh` datetime NOT NULL,
	`xeploai_kh` int(11) NOT NULL COMMENT '1=VIP,2=Thuong',
	`trangthai_kh` int(1) NOT NULL,
	`fbid` varchar(200) CHARACTER SET utf8 NOT NULL,
	`ggid` varchar(200) CHARACTER SET utf8 NOT NULL,
	`url_thumb_kh` varchar(250) CHARACTER SET utf8 NOT NULL,
	PRIMARY KEY (`id_kh`) 
) ENGINE MyISAM AUTO_INCREMENT=0 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

#admin*
DROP TABLE IF EXISTS `fd_admin`;
CREATE table IF NOT EXISTS `fd_admin` (
	`id_ad` int(11) NOT NULL AUTO_INCREMENT,
	`username_ad` varchar(50) CHARACTER SET utf8 NOT NULL,
	`displayname_ad` varchar(50) CHARACTER SET utf8 NOT NULL,
	`password_ad` varchar(50) CHARACTER SET utf8 NOT NULL,
	`slugdname_ad` varchar(100) CHARACTER SET utf8 NOT NULL,
	`diachi_ad` longtext CHARACTER SET utf8 NOT NULL,
	`sdt_ad` varchar(15) CHARACTER SET utf8 NOT NULL,
	`email_ad` varchar(100) CHARACTER SET utf8 NOT NULL,
	`vitri_ad` int(5) NOT NULL COMMENT '1=SuperAd,2=Ad',
	`trangthai_ad` int(1) NOT NULL,
	`url_avt_ad` varchar(255) CHARACTER SET utf8 NOT NULL,
	PRIMARY KEY (`id_ad`)
) ENGINE MyISAM AUTO_INCREMENT=0 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
INSERT INTO `fd_admin` VALUES ('', 'huy', 'Anh Huy', '11967d5e9addc5416ea9224eee0e91fc', 'anh-huy', '', '', '', 1, 1, '');

#donhang*
DROP TABLE IF EXISTS `fd_donhang`;
CREATE table IF NOT EXISTS `fd_donhang` (
	`id_dh` int(11) NOT NULL AUTO_INCREMENT,
	`id_kh` int(11) NOT NULL,
	`id_sp` int(11) NOT NULL,
	`dcnh_dh` int(11) NOT NULL,
	`ngaydat_dh` datetime NOT NULL,
	`ngaynhan_dh` datetime NOT NULL,
	`soluong_dh` int(255) NOT NULL,
	`thanhtien_dh` int(11) NOT NULL,
	`trangthai_dh` int(1) NOT NULL COMMENT '1=DaTiepNhan,2=DangXuLy,3=DaGiao,4=DaHuy',
	`sdtnh_dh` varchar(20) CHARACTER SET utf8 NOT NULL,
	PRIMARY KEY (`id_dh`)
) ENGINE MyISAM AUTO_INCREMENT=0 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

#khuyen mai
DROP TABLE IF EXISTS `fd_khuyenmai`;
CREATE table IF NOT EXISTS `fd_khuyenmai` (
	`id_km` int(11) NOT NULL AUTO_INCREMENT,
	`id_kh` int(11) NOT NULL,
	`magiamgia_km` int(11) NOT NULL,
	`soluotdung_km` int(11) NOT NULL,
	`handung_km` datetime NOT NULL,
	`tilegiam_km` int(3) NOT NULL,
	`dasudung_km` int(11) NOT NULL,
	`trangthai_km` int(1) NOT NULL COMMENT '1=ConHan,2=HetHan',
	PRIMARY KEY (`id_km`)
) ENGINE MyISAM AUTO_INCREMENT=0 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

#website*
DROP TABLE IF EXISTS `fd_website`;
CREATE table IF NOT EXISTS `fd_website` (
	`tieude_ws` varchar(1000) CHARACTER SET utf8 NOT NULL,
	`mota_ws` text CHARACTER SET utf8 NOT NULL,
	`trangthai_ws` int(1) NOT NULL,
	`keyword_ws` varchar(1000) CHARACTER SET utf8 NOT NULL
) ENGINE MyISAM CHARSET=utf8 COLLATE=utf8_unicode_ci;

#lien he
DROP TABLE IF EXISTS `fd_lienhe`;
CREATE table IF NOT EXISTS `fd_lienhe` (
	`id_lh` int(11) NOT NULL AUTO_INCREMENT,
	`hoten_lh` text CHARACTER SET utf8 NOT NULL,
	`diachi_lh` text CHARACTER SET utf8 NOT NULL,
	`email_lh` varchar(100) CHARACTER SET utf8 NOT NULL,
	`noidung_lh` varchar(1000) CHARACTER SET utf8 NOT NULL,
	`sdt_lh` varchar(15) CHARACTER SET utf8 NOT NULL,
	`trangthai_lh` int(1) NOT NULL,
	PRIMARY KEY (`id_lh`)
)ENGINE MyISAM AUTO_INCREMENT=0 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
INSERT INTO `fd_lienhe` VALUES('', 'HUY MEE', '', '', '', '');

#chinh sach
DROP TABLE IF EXISTS `fd_chinhsach`;
CREATE table IF NOT EXISTS `fd_chinhsach` (
	`id_chs` int(11) NOT NULL AUTO_INCREMENT,
	`ten_chs` varchar(100) CHARACTER SET utf8 NOT NULL,
	`noidung_chs` longtext CHARACTER SET utf8 NOT NULL,
	PRIMARY KEY (`id_chs`)
)ENGINE MyISAM AUTO_INCREMENT=0 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
INSERT INTO `fd_chinhsach` VALUES('', 'Chính sách', '');

#dieu khoan
DROP TABLE IF EXISTS `fd_dieukhoan`;
CREATE table IF NOT EXISTS `fd_dieukhoan` (
	`id_dk` int(11) NOT NULL AUTO_INCREMENT,
	`ten_dk` varchar(100) CHARACTER SET utf8 NOT NULL,
	`noidung_dk` longtext CHARACTER SET utf8 NOT NULL,
	`trangthai_dk` int(1) NOT NULL,
	PRIMARY KEY (`id_dk`)
)ENGINE MyISAM AUTO_INCREMENT=0 CHARSET=utf8 COLLATE=utf8_unicode_ci;
INSERT INTO `fd_dieukhoan` VALUES('', 'Điều khoản', '');

#dia chi nhan hang
DROP TABLE IF EXISTS `fd_diachinhanhang`;
CREATE table IF NOT EXISTS `fd_diachinhanhang` (
	`id_dcnh` int(11) NOT NULL AUTO_INCREMENT,
	`id_kh` int(11) not NULL,
	`ten_dcnh` text CHARACTER SET utf8 not NULL,
	PRIMARY KEY (`id_dcnh`)
) ENGINE MyISAM AUTO_INCREMENT=0 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

#tinh thanh nhan hang
DROP TABLE IF EXISTS `fd_tinhthanhnhanhang`;
CREATE table IF NOT EXISTS `fd_tinhthanhnhanhang` (
	`id_tp` int(11) not NULL AUTO_INCREMENT,
	`ten_tp` varchar(50) CHARACTER SET utf8 not NULL,
	PRIMARY KEY (`id_tp`)
) ENGINE MyISAM AUTO_INCREMENT=0 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

#quan huyen nhan hang
DROP TABLE IF EXISTS `fd_quanhuyennhanhang`;
CREATE table IF NOT EXISTS `fd_quanhuyennhanhang` (
	`id_qh` int(11) not NULL AUTO_INCREMENT,
	`ten_qh` varchar(50) CHARACTER SET utf8 not NULL,
	`id_tp` int(11) not NULL,
	PRIMARY KEY (`id_qh`)
)ENGINE MyISAM AUTO_INCREMENT=0 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

#thong tin trang web *
DROP table if EXISTS 'fd_siteinfo';
CREATE table IF NOT EXISTS `fd_siteinfo`(
	`id_si` int(11) not null AUTO_INCREMENT,
	`tieude_si` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci not null,
	`noidung_si` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci not null,
	`idcha_si` int (11) not null,
	`slug_info_si` varchar(200) CHARACTER SET utf8 NOT NULL,
	`url_thumb_si` varchar(300) CHARACTER SET utf8 NOT NULL,
	PRIMARY KEY (`id_si`)
)ENGINE MyISAM AUTO_INCREMENT =0 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

#social media*
DROP table if EXISTS 'fd_socialmedia';
CREATE table IF NOT EXISTS `fd_socialmedia`(
	`id_sm` int(11) not null AUTO_INCREMENT,
	`tieude_sm` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci not null,
	`link_sm` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci not null,
	`icon_sm` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci not null,
	PRIMARY KEY (`id_sm`)
)ENGINE MyISAM AUTO_INCREMENT =0 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
INSERT INTO `fd_socialmedia` VALUES ('', 'Facebook', '', '');