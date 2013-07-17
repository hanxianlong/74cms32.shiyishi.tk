/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50130
Source Host           : localhost:3306
Source Database       : ship74cms32

Target Server Type    : MYSQL
Target Server Version : 50130
File Encoding         : 65001

Date: 2013-07-18 00:12:46
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for qs32_ad_category
-- ----------------------------
DROP TABLE IF EXISTS `qs32_ad_category`;
CREATE TABLE `qs32_ad_category` (
  `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `alias` varchar(100) NOT NULL,
  `type_id` int(10) unsigned NOT NULL,
  `categoryname` varchar(100) NOT NULL,
  `admin_set` tinyint(3) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=gbk ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Records of qs32_ad_category
-- ----------------------------
INSERT INTO `qs32_ad_category` VALUES ('1', 'QS_indexbefore_recommend_2', '2', '首页推荐企业上方并排两张图片(473x60)', '1');
INSERT INTO `qs32_ad_category` VALUES ('2', 'QS_indexbefore_recommend_4', '2', '首页推荐企业上方并排四张图片(232x60)', '1');
INSERT INTO `qs32_ad_category` VALUES ('3', 'QS_indexbelow_newjobs_banner', '2', '首页最新招聘下方通栏广告(宽960)', '1');
INSERT INTO `qs32_ad_category` VALUES ('4', 'QS_newsbanner', '2', '资讯首页中间横幅', '1');
INSERT INTO `qs32_ad_category` VALUES ('6', 'QS_indexbelow_news', '2', '首页最新资讯下方每行4个(232x60)', '1');
INSERT INTO `qs32_ad_category` VALUES ('7', 'QS_indexfloat', '5', '首页对联广告', '1');
INSERT INTO `qs32_ad_category` VALUES ('8', 'QS_alltopimg', '2', '全站顶部图片广告位468X60', '1');
INSERT INTO `qs32_ad_category` VALUES ('9', 'QS_indexfootbanner', '2', '首页底部Banner(不可用) 985X80', '1');
