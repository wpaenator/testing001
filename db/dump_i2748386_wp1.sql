/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50617
Source Host           : localhost:3306
Source Database       : db_watch

Target Server Type    : MYSQL
Target Server Version : 50617
File Encoding         : 65001

Date: 2017-04-29 11:03:04
*/

SET FOREIGN_KEY_CHECKS=0;
-- ----------------------------
-- Table structure for `tbl_admin`
-- ----------------------------
DROP TABLE IF EXISTS `tbl_admin`;
CREATE TABLE `tbl_admin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(200) DEFAULT NULL,
  `password` varchar(200) DEFAULT NULL,
  `email` varchar(200) DEFAULT NULL,
  `role` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of tbl_admin
-- ----------------------------
INSERT INTO `tbl_admin` VALUES ('6', 'user', '123', 'admin@mail.com', 'admin');
INSERT INTO `tbl_admin` VALUES ('7', 'kyaw', '123', 'kyaw@mail.com', 'admin');
INSERT INTO `tbl_admin` VALUES ('8', 'htun', '123', 'htun@mail.com', 'Admin');

-- ----------------------------
-- Table structure for `tbl_category`
-- ----------------------------
DROP TABLE IF EXISTS `tbl_category`;
CREATE TABLE `tbl_category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(225) DEFAULT NULL,
  `desp` varchar(225) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of tbl_category
-- ----------------------------
INSERT INTO `tbl_category` VALUES ('1', 'Alexender Christen', 'Alexender Christen');
INSERT INTO `tbl_category` VALUES ('2', 'Citzen', 'Citzen');
INSERT INTO `tbl_category` VALUES ('3', 'G-Shock', 'G-Shock');
INSERT INTO `tbl_category` VALUES ('4', 'Omega', 'Omega');

-- ----------------------------
-- Table structure for `tbl_order`
-- ----------------------------
DROP TABLE IF EXISTS `tbl_order`;
CREATE TABLE `tbl_order` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `orderID` varchar(225) DEFAULT NULL,
  `date` varchar(225) DEFAULT NULL,
  `contactInfo` varchar(225) DEFAULT NULL,
  `status` varchar(225) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of tbl_order
-- ----------------------------
INSERT INTO `tbl_order` VALUES ('17', 'orderCode_1', '29/04/2017', '0954032000', 'pending');

-- ----------------------------
-- Table structure for `tbl_order_detail`
-- ----------------------------
DROP TABLE IF EXISTS `tbl_order_detail`;
CREATE TABLE `tbl_order_detail` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `orderID` varchar(100) DEFAULT NULL,
  `productID` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of tbl_order_detail
-- ----------------------------
INSERT INTO `tbl_order_detail` VALUES ('17', 'orderCode_1', '2');

-- ----------------------------
-- Table structure for `tbl_watch_product`
-- ----------------------------
DROP TABLE IF EXISTS `tbl_watch_product`;
CREATE TABLE `tbl_watch_product` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pName` varchar(225) DEFAULT NULL,
  `desp` varchar(225) DEFAULT NULL,
  `price` varchar(225) DEFAULT NULL,
  `discount` varchar(225) DEFAULT NULL,
  `catID` int(11) DEFAULT NULL,
  `img` varchar(225) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

-- ----------------------------
-- Records of tbl_watch_product
-- ----------------------------
INSERT INTO `tbl_watch_product` VALUES ('1', 'one', 'one', '2000', 'Nill', '1', 'a.jpg');
INSERT INTO `tbl_watch_product` VALUES ('2', 'Product Two', 'Desp Two', '100,000', '10%', '2', 'b.jpg');
INSERT INTO `tbl_watch_product` VALUES ('3', 'Product Three', 'Type', '200,000', '10', '3', 'c.jpg');
INSERT INTO `tbl_watch_product` VALUES ('4', 'Gold Watch', 'Gold Watch', '300,000', '', '0', '');
INSERT INTO `tbl_watch_product` VALUES ('5', 'Gold Watch', 'Gold Watch', '300,000', '6%', '4', 'img01');
