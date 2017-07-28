/*
Navicat MySQL Data Transfer

Source Server         : localhost_3306
Source Server Version : 50717
Source Host           : localhost:3306
Source Database       : aso_db

Target Server Type    : MYSQL
Target Server Version : 50717
File Encoding         : 65001

Date: 2017-07-28 18:02:26
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for admin
-- ----------------------------
DROP TABLE IF EXISTS `admin`;
CREATE TABLE `admin` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `username` char(25) NOT NULL,
  `password` char(32) NOT NULL,
  `nick_name` char(15) DEFAULT NULL COMMENT '真实姓名',
  `mobile` int(11) unsigned DEFAULT '0' COMMENT '联系电话',
  `login_time` int(11) unsigned DEFAULT '0' COMMENT '最后次登录时间',
  `login_num` tinyint(4) unsigned DEFAULT '0' COMMENT '登录次数',
  `login_ip` varchar(15) DEFAULT NULL COMMENT '最后次登录IP',
  `status` tinyint(2) DEFAULT '1' COMMENT '(状态 1是正常 -1是删除或者禁用)',
  `group_id` tinyint(4) unsigned DEFAULT '1' COMMENT '权限组ID',
  PRIMARY KEY (`id`),
  UNIQUE KEY `username_idx` (`username`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of admin
-- ----------------------------
INSERT INTO `admin` VALUES ('1', 'admin', '3a03f7ac3b80f88b7eaf95253d5a73e8', null, '0', '1501204986', '4', '0.0.0.0', '1', '1');

-- ----------------------------
-- Table structure for group
-- ----------------------------
DROP TABLE IF EXISTS `group`;
CREATE TABLE `group` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `group_name` varchar(15) DEFAULT NULL COMMENT '权限组名称',
  `group_list` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of group
-- ----------------------------

-- ----------------------------
-- Table structure for material
-- ----------------------------
DROP TABLE IF EXISTS `material`;
CREATE TABLE `material` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `content` text,
  `tag` varchar(15) DEFAULT NULL COMMENT '标签',
  `addtime` int(11) unsigned DEFAULT NULL,
  `status` tinyint(4) DEFAULT '1' COMMENT 'status(状态 1是正常 -1是删除)',
  `type` tinyint(4) unsigned DEFAULT '1' COMMENT '内容素材类型 1是title 2是keyword 3是descrption 4是content 5是image 6是video 7是advertise',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of material
-- ----------------------------
INSERT INTO `material` VALUES ('1', '主要推荐中高配车型 长安CS55购车手册', '汽车', '1501141882', '1', '1');
INSERT INTO `material` VALUES ('2', '证监会：确保资本市场稳健运行各项改革稳步推进', '金融', '1501141968', '1', '1');
INSERT INTO `material` VALUES ('3', '功夫不负有心人 陕西咸阳女彩民中得足彩569万', '彩票', '1501141968', '1', '1');
INSERT INTO `material` VALUES ('4', '特色投资项目、商机投资网、小资本投资、市场投资、投资项目网', '金融', '1501208380', '1', '2');
INSERT INTO `material` VALUES ('5', '设备融资、供应链融资、项目融资、融资理财、企业融资、个人融资、内源融资', '金融', '1501208432', '1', '2');
INSERT INTO `material` VALUES ('6', '融资方式、直接融资、供应链融资、融资融券业务、融资方案', '金融', '1501208484', '1', '2');
INSERT INTO `material` VALUES ('7', '企业融资渠道、企业融资方案、项目融资公司、公司融资、短期融资', '金融', '1501209592', '1', '2');

-- ----------------------------
-- Table structure for nav
-- ----------------------------
DROP TABLE IF EXISTS `nav`;
CREATE TABLE `nav` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `pid` int(11) unsigned DEFAULT '0' COMMENT '父级ID',
  `name` varchar(15) DEFAULT NULL COMMENT '导航栏名称',
  `url` char(25) DEFAULT NULL COMMENT '路由',
  `status` tinyint(4) DEFAULT '1' COMMENT '状态1显示,-1不显示',
  `asc` tinyint(4) unsigned DEFAULT '0' COMMENT '排序',
  `css_img` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of nav
-- ----------------------------
INSERT INTO `nav` VALUES ('1', '0', '内容素材', 'index/material/index', '1', '0', 'icon-folder-close-alt');
INSERT INTO `nav` VALUES ('2', '1', 'Title', 'index/material/title', '1', '0', null);
INSERT INTO `nav` VALUES ('3', '1', 'Keyword', 'index/material/title', '1', '0', null);
INSERT INTO `nav` VALUES ('4', '1', 'Descrption', 'index/material/title', '1', '0', null);
INSERT INTO `nav` VALUES ('5', '1', 'Content', 'index/material/title', '1', '0', null);
INSERT INTO `nav` VALUES ('6', '1', 'Image', 'index/material/title', '1', '0', null);
INSERT INTO `nav` VALUES ('7', '1', 'Video', 'index/material/title', '1', '0', null);
INSERT INTO `nav` VALUES ('8', '1', 'Advertise', 'index/material/title', '1', '0', null);
INSERT INTO `nav` VALUES ('9', '0', '网站模板', 'index/template/index', '1', '0', 'glyphicons-icon more_items white');
INSERT INTO `nav` VALUES ('10', '9', 'PC端', 'index/template/webSide', '1', '0', null);
INSERT INTO `nav` VALUES ('11', '9', 'H5端(WAP)', 'index/template/webSide', '1', '0', null);

-- ----------------------------
-- Table structure for template
-- ----------------------------
DROP TABLE IF EXISTS `template`;
CREATE TABLE `template` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(25) DEFAULT NULL COMMENT '模板名称',
  `path` varchar(100) DEFAULT NULL COMMENT '存储路径',
  `type` tinyint(4) unsigned DEFAULT '1' COMMENT '模板类型PC--10或者H5---11',
  `tag` varchar(50) DEFAULT NULL COMMENT '标签',
  `status` tinyint(4) DEFAULT '1' COMMENT '模板状态1是正常 -1是删除',
  `addtime` int(11) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of template
-- ----------------------------
INSERT INTO `template` VALUES ('3', '后台模板', 'public/template/20170728/calendar/calendar.html', '10', '金融', '1', '1501234436');

-- ----------------------------
-- Table structure for web_side
-- ----------------------------
DROP TABLE IF EXISTS `web_side`;
CREATE TABLE `web_side` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `template_id` int(11) NOT NULL,
  `type` tinyint(4) unsigned DEFAULT '1' COMMENT '模板类别 1爬虫模板 2是前端模板',
  `pertain_type` tinyint(4) unsigned DEFAULT '1' COMMENT '具体属于哪种模板 i.爬虫模块分 1是详情页模板、2是首页模板、3是聚合页模块 ii.前端模板分 4是客户官网模板、5是流量优化页面',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of web_side
-- ----------------------------
INSERT INTO `web_side` VALUES ('1', '3', '1', '1');
