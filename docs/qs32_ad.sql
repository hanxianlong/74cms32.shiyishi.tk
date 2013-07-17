/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50130
Source Host           : localhost:3306
Source Database       : ship74cms32

Target Server Type    : MYSQL
Target Server Version : 50130
File Encoding         : 65001

Date: 2013-07-18 00:12:53
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for qs32_ad
-- ----------------------------
DROP TABLE IF EXISTS `qs32_ad`;
CREATE TABLE `qs32_ad` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `alias` varchar(80) NOT NULL,
  `is_display` tinyint(4) NOT NULL DEFAULT '1',
  `category_id` smallint(5) NOT NULL,
  `type_id` smallint(5) NOT NULL,
  `title` varchar(100) NOT NULL,
  `note` varchar(230) NOT NULL,
  `show_order` int(10) unsigned NOT NULL DEFAULT '50',
  `addtime` int(10) unsigned NOT NULL,
  `starttime` int(10) unsigned NOT NULL,
  `deadline` int(11) NOT NULL DEFAULT '0',
  `text_content` varchar(250) NOT NULL,
  `text_url` varchar(250) NOT NULL,
  `text_color` varchar(60) NOT NULL,
  `img_path` varchar(250) NOT NULL,
  `img_url` varchar(250) NOT NULL,
  `img_explain` varchar(250) NOT NULL,
  `img_uid` int(10) NOT NULL DEFAULT '0',
  `code_content` text NOT NULL,
  `flash_path` varchar(250) NOT NULL,
  `flash_width` int(10) unsigned NOT NULL,
  `flash_height` int(10) unsigned NOT NULL,
  `floating_type` tinyint(3) unsigned NOT NULL DEFAULT '1',
  `floating_width` int(10) unsigned NOT NULL,
  `floating_height` int(10) unsigned NOT NULL,
  `floating_url` varchar(250) NOT NULL,
  `floating_path` varchar(250) NOT NULL,
  `floating_left` varchar(10) NOT NULL,
  `floating_right` varchar(10) NOT NULL,
  `floating_top` int(11) NOT NULL,
  `video_path` varchar(250) NOT NULL,
  `video_width` int(10) unsigned NOT NULL,
  `video_height` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `alias_starttime_deadline` (`alias`,`starttime`,`deadline`)
) ENGINE=MyISAM AUTO_INCREMENT=14 DEFAULT CHARSET=gbk ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Records of qs32_ad
-- ----------------------------
INSERT INTO `qs32_ad` VALUES ('1', 'QS_indexfocus', '1', '1', '2', '软件商业授权', '', '50', '0', '0', '0', '', '', '', 'http://www.74cms.com/74ad_280x135.jpg', 'http://www.74cms.com/', '骑士CMS商业授权', '0', '', '', '0', '0', '1', '0', '0', '', '', '0', '0', '0', '', '0', '0');
INSERT INTO `qs32_ad` VALUES ('2', 'QS_indexfocus', '1', '1', '2', '新广告', '新广告', '50', '1370616502', '1370534400', '0', '', '', '', 'http://shiphr.com/show/tmarine.jpg', 'http://www.baidu.com', '', '0', '', '', '0', '0', '1', '0', '0', '', '', '', '', '0', '', '0', '0');
INSERT INTO `qs32_ad` VALUES ('3', 'QS_indexbefore_recommend_2', '1', '1', '2', '北京太仓招收新职工！', '设置广告广告结束的时间，格式 yyyy-mm-dd，留空为不限制结束时间', '50', '1374074110', '1370793600', '1374768000', '', '', '', 'http://shiphr.com/uploads/1368435366WBJz0L.jpg', 'http://www.74cms.com', '众人', '0', '', '', '0', '0', '1', '0', '0', '', '', '', '', '0', '', '0', '0');
INSERT INTO `qs32_ad` VALUES ('4', 'QS_indexbefore_recommend_2', '1', '1', '2', '广告标题只为识别辨认不同广告条目之用，并不在广告中显示', '设置广告广告结束的时间，格式 yyyy-mm-dd，留空为不限制结束时间', '50', '1374074101', '1370793600', '1374940800', '', '', '', 'http://img03.51jobcdn.com/im/images/2013/sh/renming0314bb_8797wh.gif', 'http://www.baiddu.com', '', '0', '', '', '0', '0', '1', '0', '0', '', '', '', '', '0', '', '0', '0');
INSERT INTO `qs32_ad` VALUES ('5', 'QS_indexbelow_news', '1', '9', '2', '北京人民大会堂', '', '50', '1374077097', '1370793600', '0', '', '', '', 'http://shiphr.com/uploads/1370413563U39BW5.jpg', 'http://shiphr.com/uploads/1370413563U39BW5.jpg', '图片说明文字', '0', '', '', '0', '0', '1', '0', '0', '', '', '', '', '0', '', '0', '0');
INSERT INTO `qs32_ad` VALUES ('6', 'QS_indexfloat', '1', '7', '5', '首页对联广告', '', '50', '1370867267', '1370793600', '0', '', '', '', '', '', '', '0', '', '', '0', '0', '1', '120', '240', 'http://img01.51jobcdn.com/im/images/2013/careerpost/banner/guzhufyb/120250.jpg', 'http://img01.51jobcdn.com/im/images/2013/careerpost/banner/guzhufyb/120250.jpg', '', '0', '45', '', '0', '0');
INSERT INTO `qs32_ad` VALUES ('7', 'QS_indexbelow_newjobs_banner', '1', '3', '2', '通栏', '', '50', '1374073837', '1373990400', '0', '', '', '', 'http://shiphr.com/show/2012/1.gif', 'http://www.baiddu.com', '', '0', '', '', '0', '0', '1', '0', '0', '', '', '', '', '0', '', '0', '0');
INSERT INTO `qs32_ad` VALUES ('8', 'QS_indexbefore_recommend_4', '1', '2', '2', '广告', '', '50', '1374075507', '1373990400', '0', '', '', '', 'http://shiphr.com/uploads/13674834469L8p58.jpg', 'http://shiphr.com/uploads/13674834469L8p58.jpg', '', '0', '', '', '0', '0', '1', '0', '0', '', '', '', '', '0', '', '0', '0');
INSERT INTO `qs32_ad` VALUES ('9', 'QS_indexbefore_recommend_4', '1', '2', '2', '33', '', '50', '1374075518', '1373990400', '0', '', '', '', 'http://shiphr.com/uploads/13674834469L8p58.jpg', 'http://shiphr.com/uploads/13674834469L8p58.jpg', '', '0', '', '', '0', '0', '1', '0', '0', '', '', '', '', '0', '', '0', '0');
INSERT INTO `qs32_ad` VALUES ('10', 'QS_indexbefore_recommend_4', '1', '2', '2', '44', '', '50', '1374075528', '1373990400', '0', '', '', '', 'http://shiphr.com/uploads/13674834469L8p58.jpg', 'http://shiphr.com/uploads/13674834469L8p58.jpg', '', '0', '', '', '0', '0', '1', '0', '0', '', '', '', '', '0', '', '0', '0');
INSERT INTO `qs32_ad` VALUES ('11', 'QS_indexbefore_recommend_4', '1', '2', '2', '55', '', '50', '1374075548', '1373990400', '0', '', '', '', 'http://shiphr.com/uploads/13674834469L8p58.jpg', 'http://shiphr.com/uploads/13674834469L8p58.jpg', '', '0', '', '', '0', '0', '1', '0', '0', '', '', '', '', '0', '', '0', '0');
INSERT INTO `qs32_ad` VALUES ('12', 'QS_indexbefore_recommend_2', '1', '1', '2', '66', '', '50', '1374075554', '1373990400', '0', '', '', '', 'http://shiphr.com/uploads/13674834469L8p58.jpg', 'http://shiphr.com/uploads/13674834469L8p58.jpg', '', '0', '', '', '0', '0', '1', '0', '0', '', '', '', '', '0', '', '0', '0');
INSERT INTO `qs32_ad` VALUES ('13', 'QS_indexbefore_recommend_2', '1', '1', '2', '77', '', '50', '1374075560', '1373990400', '0', '', '', '', 'http://shiphr.com/uploads/13674834469L8p58.jpg', '', '', '0', '', '', '0', '0', '1', '0', '0', '', '', '', '', '0', '', '0', '0');
