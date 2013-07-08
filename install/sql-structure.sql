 

-- ----------------------------
-- Table structure for qs32_ad
-- ----------------------------
DROP TABLE IF EXISTS `qs_ad`;
CREATE TABLE `qs_ad` (
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
) ENGINE=MyISAM  DEFAULT CHARSET=gbk ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Table structure for qs32_admin
-- ----------------------------
DROP TABLE IF EXISTS `qs_admin`;
CREATE TABLE `qs_admin` (
  `admin_id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `admin_name` varchar(40) NOT NULL,
  `email` varchar(40) NOT NULL,
  `pwd` varchar(32) NOT NULL,
  `pwd_hash` varchar(30) NOT NULL,
  `purview` text NOT NULL,
  `rank` varchar(32) NOT NULL,
  `add_time` int(10) NOT NULL,
  `last_login_time` int(10) NOT NULL,
  `last_login_ip` varchar(15) NOT NULL,
  PRIMARY KEY (`admin_id`)
) ENGINE=MyISAM DEFAULT CHARSET=gbk ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Table structure for qs32_admin_log
-- ----------------------------
DROP TABLE IF EXISTS `qs_admin_log`;
CREATE TABLE `qs_admin_log` (
  `log_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `admin_name` varchar(20) NOT NULL,
  `add_time` int(10) NOT NULL,
  `log_value` varchar(255) NOT NULL,
  `log_ip` varchar(20) NOT NULL,
  `log_type` tinyint(1) unsigned NOT NULL DEFAULT '1',
  PRIMARY KEY (`log_id`)
) ENGINE=MyISAM DEFAULT CHARSET=gbk ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Table structure for qs32_ad_category
-- ----------------------------
DROP TABLE IF EXISTS `qs_ad_category`;
CREATE TABLE `qs_ad_category` (
  `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `alias` varchar(100) NOT NULL,
  `type_id` int(10) unsigned NOT NULL,
  `categoryname` varchar(100) NOT NULL,
  `admin_set` tinyint(3) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=gbk ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Table structure for qs32_article
-- ----------------------------
DROP TABLE IF EXISTS `qs_article`;
CREATE TABLE `qs_article` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `type_id` tinyint(3) unsigned NOT NULL,
  `parentid` smallint(5) unsigned NOT NULL,
  `title` varchar(100) NOT NULL,
  `content` mediumtext NOT NULL,
  `tit_color` varchar(10) DEFAULT NULL,
  `tit_b` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `Small_img` varchar(80) DEFAULT NULL,
  `author` varchar(50) DEFAULT NULL,
  `source` varchar(100) DEFAULT NULL,
  `focos` tinyint(4) unsigned NOT NULL DEFAULT '1',
  `is_display` tinyint(3) unsigned NOT NULL DEFAULT '1',
  `is_url` varchar(200) NOT NULL DEFAULT '0',
  `seo_keywords` varchar(100) DEFAULT NULL,
  `seo_description` varchar(200) DEFAULT NULL,
  `click` int(10) unsigned NOT NULL DEFAULT '1',
  `addtime` int(10) unsigned NOT NULL,
  `article_order` smallint(5) unsigned NOT NULL DEFAULT '0',
  `robot` tinyint(3) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `addtime` (`addtime`),
  KEY `click` (`click`),
  KEY `focos_article_order` (`focos`,`article_order`,`id`),
  KEY `parentid` (`parentid`,`article_order`,`id`),
  KEY `type_id` (`type_id`,`article_order`,`id`)
) ENGINE=MyISAM DEFAULT CHARSET=gbk ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Table structure for qs32_article_category
-- ----------------------------
DROP TABLE IF EXISTS `qs_article_category`;
CREATE TABLE `qs_article_category` (
  `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `parentid` smallint(5) unsigned NOT NULL,
  `categoryname` varchar(80) NOT NULL,
  `category_order` smallint(5) unsigned NOT NULL DEFAULT '0',
  `title` varchar(255) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `keywords` varchar(255) DEFAULT NULL,
  `admin_set` tinyint(3) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=gbk ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Table structure for qs32_article_property
-- ----------------------------
DROP TABLE IF EXISTS `qs_article_property`;
CREATE TABLE `qs_article_property` (
  `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `categoryname` varchar(30) NOT NULL,
  `category_order` smallint(5) unsigned NOT NULL DEFAULT '0',
  `admin_set` tinyint(3) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=gbk ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Table structure for qs32_captcha
-- ----------------------------
DROP TABLE IF EXISTS `qs_captcha`;
CREATE TABLE `qs_captcha` (
  `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `value` varchar(200) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=gbk ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Table structure for qs32_category
-- ----------------------------
DROP TABLE IF EXISTS `qs_category`;
CREATE TABLE `qs_category` (
  `c_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `c_parentid` int(10) unsigned NOT NULL,
  `c_alias` char(30) NOT NULL,
  `c_name` char(30) NOT NULL,
  `c_order` int(10) NOT NULL,
  `c_index` char(1) NOT NULL,
  `c_note` char(60) NOT NULL,
  `stat_jobs` char(15) NOT NULL,
  `stat_resume` char(15) NOT NULL,
  `c_name_en` varchar(50) NOT NULL,
  PRIMARY KEY (`c_id`),
  KEY `c_alias` (`c_alias`)
) ENGINE=MyISAM DEFAULT CHARSET=gbk ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Table structure for qs32_category_district
-- ----------------------------
DROP TABLE IF EXISTS `qs_category_district`;
CREATE TABLE `qs_category_district` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `parentid` int(10) unsigned NOT NULL DEFAULT '0',
  `categoryname` varchar(30) NOT NULL,
  `category_order` smallint(5) unsigned NOT NULL DEFAULT '0',
  `stat_jobs` varchar(15) NOT NULL,
  `stat_resume` varchar(15) NOT NULL,
  `categoryname_en` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=gbk ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Table structure for qs32_category_group
-- ----------------------------
DROP TABLE IF EXISTS `qs_category_group`;
CREATE TABLE `qs_category_group` (
  `g_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `g_alias` varchar(60) NOT NULL,
  `g_name` varchar(100) NOT NULL,
  `g_sys` tinyint(1) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`g_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=gbk ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Table structure for qs32_category_jobs
-- ----------------------------
DROP TABLE IF EXISTS `qs_category_jobs`;
CREATE TABLE `qs_category_jobs` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `parentid` smallint(5) unsigned NOT NULL,
  `categoryname` varchar(80) NOT NULL,
  `category_order` smallint(5) unsigned NOT NULL DEFAULT '0',
  `stat_jobs` varchar(15) NOT NULL,
  `stat_resume` varchar(15) NOT NULL,
  `categoryname_en` varchar(300) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`),
  KEY `parentid` (`parentid`)
) ENGINE=MyISAM DEFAULT CHARSET=gbk ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Table structure for qs32_company_down_resume
-- ----------------------------
DROP TABLE IF EXISTS `qs_company_down_resume`;
CREATE TABLE `qs_company_down_resume` (
  `did` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `resume_id` int(10) unsigned NOT NULL,
  `resume_name` varchar(60) NOT NULL,
  `resume_uid` int(10) unsigned NOT NULL,
  `company_uid` int(10) unsigned NOT NULL,
  `company_name` varchar(60) NOT NULL,
  `down_addtime` int(10) unsigned NOT NULL,
  PRIMARY KEY (`did`),
  KEY `company_uid_addtime` (`company_uid`,`down_addtime`),
  KEY `down_addtime` (`down_addtime`),
  KEY `resume_uid_rid` (`resume_uid`,`resume_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=gbk ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Table structure for qs32_company_favorites
-- ----------------------------
DROP TABLE IF EXISTS `qs_company_favorites`;
CREATE TABLE `qs_company_favorites` (
  `did` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `resume_id` int(10) unsigned NOT NULL,
  `company_uid` int(10) unsigned NOT NULL,
  `favoritesa_ddtime` int(10) unsigned NOT NULL,
  PRIMARY KEY (`did`),
  KEY `company_uid` (`company_uid`)
) ENGINE=MyISAM DEFAULT CHARSET=gbk ROW_FORMAT=FIXED;

-- ----------------------------
-- Table structure for qs32_company_interview
-- ----------------------------
DROP TABLE IF EXISTS `qs_company_interview`;
CREATE TABLE `qs_company_interview` (
  `did` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `resume_id` int(10) unsigned NOT NULL,
  `resume_name` varchar(30) NOT NULL,
  `resume_addtime` int(10) NOT NULL,
  `resume_uid` int(10) unsigned NOT NULL,
  `jobs_id` int(10) unsigned NOT NULL,
  `jobs_name` varchar(60) NOT NULL,
  `jobs_addtime` int(10) NOT NULL,
  `company_id` int(10) unsigned NOT NULL,
  `company_name` varchar(60) NOT NULL,
  `company_addtime` int(10) NOT NULL,
  `company_uid` int(10) unsigned NOT NULL,
  `interview_addtime` int(10) unsigned NOT NULL,
  `notes` varchar(255) NOT NULL DEFAULT '',
  `personal_look` tinyint(3) unsigned NOT NULL DEFAULT '1',
  PRIMARY KEY (`did`),
  KEY `company_uid_jobid` (`company_uid`,`jobs_id`),
  KEY `resume_uid_resumeid` (`resume_uid`,`resume_id`)
) ENGINE=MyISAM DEFAULT CHARSET=gbk ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Table structure for qs32_company_profile
-- ----------------------------
DROP TABLE IF EXISTS `qs_company_profile`;
CREATE TABLE `qs_company_profile` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `uid` int(10) unsigned NOT NULL,
  `tpl` varchar(60) NOT NULL,
  `companyname` varchar(60) NOT NULL,
  `nature` smallint(5) unsigned NOT NULL,
  `nature_cn` varchar(30) NOT NULL,
  `trade` smallint(5) unsigned NOT NULL,
  `trade_cn` varchar(30) NOT NULL,
  `district` smallint(5) unsigned NOT NULL,
  `sdistrict` smallint(5) unsigned NOT NULL,
  `district_cn` varchar(30) NOT NULL,
  `street` smallint(5) unsigned NOT NULL,
  `street_cn` varchar(50) NOT NULL,
  `officebuilding` smallint(5) unsigned NOT NULL,
  `officebuilding_cn` varchar(50) NOT NULL,
  `scale` smallint(5) unsigned NOT NULL,
  `scale_cn` varchar(30) NOT NULL,
  `registered` varchar(150) NOT NULL,
  `currency` varchar(10) NOT NULL,
  `address` varchar(250) NOT NULL,
  `contact` varchar(100) NOT NULL,
  `telephone` varchar(130) NOT NULL,
  `email` varchar(100) NOT NULL,
  `website` varchar(100) NOT NULL,
  `license` varchar(120) NOT NULL,
  `certificate_img` varchar(80) NOT NULL,
  `logo` varchar(400) DEFAULT NULL,
  `contents` text NOT NULL,
  `audit` tinyint(4) unsigned NOT NULL DEFAULT '0',
  `map_open` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `map_x` varchar(50) NOT NULL,
  `map_y` varchar(50) NOT NULL,
  `map_zoom` tinyint(3) unsigned NOT NULL,
  `addtime` int(10) unsigned NOT NULL,
  `refreshtime` int(10) unsigned NOT NULL,
  `click` int(10) unsigned NOT NULL DEFAULT '1',
  `user_status` tinyint(3) unsigned NOT NULL DEFAULT '1',
  `robot` tinyint(3) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `addtime` (`addtime`),
  KEY `audit` (`audit`),
  KEY `companyname` (`companyname`),
  KEY `uid` (`uid`)
) ENGINE=MyISAM DEFAULT CHARSET=gbk ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Table structure for qs32_config
-- ----------------------------
DROP TABLE IF EXISTS `qs_config`;
CREATE TABLE `qs_config` (
  `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `value` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=gbk ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Table structure for qs32_crons
-- ----------------------------
DROP TABLE IF EXISTS `qs_crons`;
CREATE TABLE `qs_crons` (
  `cronid` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `available` tinyint(1) unsigned NOT NULL,
  `admin_set` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `name` varchar(60) NOT NULL,
  `filename` varchar(60) NOT NULL,
  `lastrun` int(10) unsigned NOT NULL,
  `nextrun` int(10) unsigned NOT NULL,
  `weekday` tinyint(1) NOT NULL,
  `day` tinyint(2) NOT NULL,
  `hour` tinyint(2) NOT NULL,
  `minute` varchar(60) NOT NULL,
  PRIMARY KEY (`cronid`)
) ENGINE=MyISAM DEFAULT CHARSET=gbk ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Table structure for qs32_explain
-- ----------------------------
DROP TABLE IF EXISTS `qs_explain`;
CREATE TABLE `qs_explain` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `type_id` smallint(5) unsigned NOT NULL,
  `title` varchar(100) NOT NULL,
  `content` mediumtext NOT NULL,
  `tit_color` varchar(10) DEFAULT NULL,
  `tit_b` tinyint(1) NOT NULL DEFAULT '0',
  `is_display` tinyint(3) unsigned NOT NULL DEFAULT '1',
  `is_url` varchar(200) NOT NULL DEFAULT '0',
  `seo_keywords` varchar(100) DEFAULT NULL,
  `seo_description` varchar(200) DEFAULT NULL,
  `click` int(11) NOT NULL DEFAULT '1',
  `addtime` int(10) NOT NULL,
  `show_order` smallint(5) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `type_id` (`type_id`)
) ENGINE=MyISAM DEFAULT CHARSET=gbk ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Table structure for qs32_explain_category
-- ----------------------------
DROP TABLE IF EXISTS `qs_explain_category`;
CREATE TABLE `qs_explain_category` (
  `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `categoryname` varchar(80) NOT NULL,
  `category_order` smallint(5) unsigned NOT NULL DEFAULT '0',
  `admin_set` tinyint(3) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=gbk ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Table structure for qs32_feedback
-- ----------------------------
DROP TABLE IF EXISTS `qs_feedback`;
CREATE TABLE `qs_feedback` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `uid` int(10) unsigned NOT NULL,
  `replyinfo` tinyint(3) unsigned NOT NULL DEFAULT '1',
  `usertype` tinyint(3) unsigned NOT NULL,
  `username` varchar(80) NOT NULL,
  `infotype` tinyint(3) unsigned NOT NULL,
  `feedback` varchar(250) NOT NULL,
  `reply` varchar(250) NOT NULL,
  `addtime` int(10) NOT NULL,
  `feedbacktime` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `uid` (`uid`)
) ENGINE=MyISAM DEFAULT CHARSET=gbk ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Table structure for qs32_help
-- ----------------------------
DROP TABLE IF EXISTS `qs_help`;
CREATE TABLE `qs_help` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `type_id` tinyint(3) unsigned NOT NULL,
  `parentid` smallint(5) unsigned NOT NULL,
  `title` varchar(100) NOT NULL,
  `content` text NOT NULL,
  `click` int(10) unsigned NOT NULL DEFAULT '1',
  `addtime` int(10) unsigned NOT NULL,
  `order` smallint(5) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `focos_article_order` (`order`,`id`),
  KEY `type_id` (`type_id`,`order`,`id`)
) ENGINE=MyISAM DEFAULT CHARSET=gbk ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Table structure for qs32_help_category
-- ----------------------------
DROP TABLE IF EXISTS `qs_help_category`;
CREATE TABLE `qs_help_category` (
  `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `parentid` smallint(5) unsigned NOT NULL,
  `categoryname` varchar(80) NOT NULL,
  `category_order` smallint(5) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=gbk ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Table structure for qs32_hotword
-- ----------------------------
DROP TABLE IF EXISTS `qs_hotword`;
CREATE TABLE `qs_hotword` (
  `w_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `w_word` varchar(120) NOT NULL,
  `w_hot` int(10) unsigned NOT NULL DEFAULT '1',
  PRIMARY KEY (`w_id`),
  KEY `w_hot` (`w_hot`),
  KEY `w_word` (`w_word`)
) ENGINE=MyISAM DEFAULT CHARSET=gbk ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Table structure for qs32_hrtools
-- ----------------------------
DROP TABLE IF EXISTS `qs_hrtools`;
CREATE TABLE `qs_hrtools` (
  `h_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `h_typeid` smallint(5) unsigned NOT NULL,
  `h_filename` varchar(200) NOT NULL,
  `h_fileurl` varchar(200) NOT NULL,
  `h_order` int(10) NOT NULL DEFAULT '0',
  `h_color` varchar(7) NOT NULL,
  `h_strong` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`h_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=gbk ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Table structure for qs32_hrtools_category
-- ----------------------------
DROP TABLE IF EXISTS `qs_hrtools_category`;
CREATE TABLE `qs_hrtools_category` (
  `c_id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `c_name` varchar(80) NOT NULL,
  `c_order` int(11) NOT NULL DEFAULT '0',
  `c_adminset` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`c_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=gbk ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Table structure for qs32_jobs
-- ----------------------------
DROP TABLE IF EXISTS `qs_jobs`;
CREATE TABLE `qs_jobs` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `subsite_id` smallint(5) unsigned NOT NULL DEFAULT '0',
  `uid` int(10) unsigned NOT NULL,
  `jobs_name` varchar(30) NOT NULL,
  `companyname` varchar(50) NOT NULL,
  `company_id` int(10) unsigned NOT NULL,
  `company_addtime` int(10) unsigned NOT NULL,
  `company_audit` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `recommend` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `emergency` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `highlight` varchar(7) NOT NULL,
  `stick` tinyint(1) NOT NULL,
  `nature` tinyint(3) unsigned NOT NULL,
  `nature_cn` varchar(30) NOT NULL,
  `sex` tinyint(1) unsigned NOT NULL DEFAULT '3',
  `sex_cn` varchar(3) NOT NULL,
  `amount` smallint(5) unsigned NOT NULL,
  `category` smallint(5) unsigned NOT NULL,
  `subclass` smallint(5) unsigned NOT NULL,
  `category_cn` varchar(30) NOT NULL,
  `trade` smallint(5) unsigned NOT NULL,
  `trade_cn` varchar(30) NOT NULL,
  `scale` smallint(5) unsigned NOT NULL,
  `scale_cn` varchar(30) NOT NULL,
  `district` smallint(5) unsigned NOT NULL,
  `sdistrict` smallint(5) unsigned NOT NULL,
  `district_cn` varchar(30) NOT NULL,
  `street` int(10) unsigned NOT NULL,
  `street_cn` varchar(50) NOT NULL,
  `officebuilding` int(10) unsigned NOT NULL,
  `officebuilding_cn` varchar(50) NOT NULL,
  `tag` varchar(160) NOT NULL,
  `education` smallint(5) unsigned NOT NULL,
  `education_cn` varchar(30) NOT NULL,
  `experience` smallint(5) unsigned NOT NULL,
  `experience_cn` varchar(30) NOT NULL,
  `wage` smallint(5) unsigned NOT NULL,
  `wage_cn` varchar(30) NOT NULL,
  `graduate` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `contents` varchar(1800) NOT NULL,
  `addtime` int(10) unsigned NOT NULL,
  `deadline` int(10) unsigned NOT NULL,
  `refreshtime` int(10) unsigned NOT NULL,
  `setmeal_deadline` int(10) unsigned NOT NULL DEFAULT '0',
  `setmeal_id` smallint(5) unsigned NOT NULL,
  `setmeal_name` varchar(60) NOT NULL,
  `audit` tinyint(1) unsigned NOT NULL DEFAULT '1',
  `display` tinyint(1) unsigned NOT NULL DEFAULT '1',
  `click` int(10) unsigned NOT NULL DEFAULT '1',
  `key` text NOT NULL,
  `user_status` tinyint(1) unsigned NOT NULL DEFAULT '1',
  `robot` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `tpl` varchar(60) NOT NULL,
  `map_x` double(9,6) NOT NULL,
  `map_y` double(9,6) NOT NULL,
  `add_mode` tinyint(1) unsigned NOT NULL DEFAULT '1',
  `is_deleted` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `addtime` (`addtime`),
  KEY `company_id` (`company_id`),
  KEY `deadline` (`deadline`),
  KEY `refreshtime` (`refreshtime`),
  KEY `setmeal_deadline` (`setmeal_deadline`),
  KEY `uid` (`uid`)
) ENGINE=MyISAM DEFAULT CHARSET=gbk ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Table structure for qs32_jobs_contact
-- ----------------------------
DROP TABLE IF EXISTS `qs_jobs_contact`;
CREATE TABLE `qs_jobs_contact` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `pid` int(10) unsigned NOT NULL,
  `contact` varchar(80) NOT NULL,
  `qq` varchar(20) DEFAULT NULL,
  `telephone` varchar(80) NOT NULL,
  `address` varchar(80) NOT NULL,
  `email` varchar(80) NOT NULL,
  `notify` tinyint(3) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `pid` (`pid`)
) ENGINE=MyISAM DEFAULT CHARSET=gbk ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Table structure for qs32_jobs_search_hot
-- ----------------------------
DROP TABLE IF EXISTS `qs_jobs_search_hot`;
CREATE TABLE `qs_jobs_search_hot` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `uid` int(10) unsigned NOT NULL,
  `subsite_id` int(10) unsigned NOT NULL DEFAULT '0',
  `recommend` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `emergency` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `nature` tinyint(3) unsigned NOT NULL,
  `sex` tinyint(1) unsigned NOT NULL DEFAULT '3',
  `category` smallint(5) unsigned NOT NULL,
  `subclass` smallint(5) unsigned NOT NULL,
  `trade` smallint(5) unsigned NOT NULL,
  `district` smallint(5) unsigned NOT NULL,
  `sdistrict` smallint(5) unsigned NOT NULL,
  `street` smallint(5) unsigned NOT NULL,
  `officebuilding` smallint(5) unsigned NOT NULL,
  `education` smallint(5) unsigned NOT NULL,
  `experience` smallint(5) unsigned NOT NULL,
  `wage` smallint(5) unsigned NOT NULL,
  `scale` smallint(5) unsigned NOT NULL DEFAULT '0',
  `refreshtime` int(10) unsigned NOT NULL,
  `click` int(10) unsigned NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `category_hot` (`category`,`click`),
  KEY `click` (`click`),
  KEY `district_hot` (`district`,`click`),
  KEY `officebuilding_hot` (`officebuilding`,`click`),
  KEY `refreshtime` (`refreshtime`),
  KEY `sdistrict_hot` (`sdistrict`,`click`),
  KEY `street_hot` (`street`,`click`),
  KEY `subclass_hot` (`subclass`,`click`),
  KEY `trade_hot` (`trade`,`click`),
  KEY `uid` (`uid`)
) ENGINE=MyISAM DEFAULT CHARSET=gbk ROW_FORMAT=FIXED;

-- ----------------------------
-- Table structure for qs32_jobs_search_key
-- ----------------------------
DROP TABLE IF EXISTS `qs_jobs_search_key`;
CREATE TABLE `qs_jobs_search_key` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `uid` int(10) unsigned NOT NULL,
  `subsite_id` int(10) unsigned NOT NULL DEFAULT '0',
  `recommend` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `emergency` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `nature` tinyint(3) unsigned NOT NULL,
  `sex` tinyint(1) unsigned NOT NULL DEFAULT '3',
  `category` smallint(5) unsigned NOT NULL,
  `subclass` smallint(5) unsigned NOT NULL,
  `trade` smallint(5) unsigned NOT NULL,
  `district` smallint(5) unsigned NOT NULL,
  `sdistrict` smallint(5) unsigned NOT NULL,
  `street` smallint(5) unsigned NOT NULL,
  `officebuilding` smallint(5) unsigned NOT NULL,
  `education` smallint(5) unsigned NOT NULL,
  `experience` smallint(5) unsigned NOT NULL,
  `wage` smallint(5) unsigned NOT NULL,
  `scale` smallint(5) unsigned NOT NULL DEFAULT '0',
  `map_x` double(9,6) NOT NULL,
  `map_y` double(9,6) NOT NULL,
  `refreshtime` int(10) unsigned NOT NULL,
  `key` text NOT NULL,
  PRIMARY KEY (`id`),
  KEY `category` (`category`),
  KEY `district` (`district`),
  KEY `refreshtime` (`refreshtime`),
  KEY `sdistrict` (`sdistrict`),
  KEY `subclass` (`subclass`),
  KEY `uid` (`uid`),
  FULLTEXT KEY `key` (`key`)
) ENGINE=MyISAM DEFAULT CHARSET=gbk ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Table structure for qs32_jobs_search_rtime
-- ----------------------------
DROP TABLE IF EXISTS `qs_jobs_search_rtime`;
CREATE TABLE `qs_jobs_search_rtime` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `subsite_id` int(10) unsigned NOT NULL DEFAULT '0',
  `uid` int(10) unsigned NOT NULL,
  `recommend` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `emergency` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `nature` tinyint(3) unsigned NOT NULL,
  `sex` tinyint(1) unsigned NOT NULL DEFAULT '3',
  `category` smallint(5) unsigned NOT NULL,
  `subclass` smallint(5) unsigned NOT NULL,
  `trade` smallint(5) unsigned NOT NULL,
  `district` smallint(5) unsigned NOT NULL,
  `sdistrict` smallint(5) unsigned NOT NULL,
  `street` smallint(5) unsigned NOT NULL,
  `officebuilding` smallint(5) unsigned NOT NULL,
  `education` smallint(5) unsigned NOT NULL,
  `experience` smallint(5) unsigned NOT NULL,
  `wage` smallint(5) unsigned NOT NULL,
  `scale` smallint(5) unsigned NOT NULL DEFAULT '0',
  `map_x` double(9,6) NOT NULL,
  `map_y` double(9,6) NOT NULL,
  `refreshtime` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `category_rtime` (`category`,`refreshtime`),
  KEY `district_rtime` (`district`,`refreshtime`),
  KEY `emergency_rtime` (`emergency`,`refreshtime`),
  KEY `map` (`map_x`,`map_y`),
  KEY `officebuilding_rtime` (`officebuilding`,`refreshtime`),
  KEY `recommend_rtime` (`recommend`,`refreshtime`),
  KEY `refreshtime` (`refreshtime`),
  KEY `sdistrict_rtime` (`sdistrict`,`refreshtime`),
  KEY `street_rtime` (`street`,`refreshtime`),
  KEY `subclass_rtime` (`subclass`,`refreshtime`),
  KEY `trade_rtime` (`trade`,`refreshtime`),
  KEY `uid` (`uid`)
) ENGINE=MyISAM DEFAULT CHARSET=gbk ROW_FORMAT=FIXED;

-- ----------------------------
-- Table structure for qs32_jobs_search_scale
-- ----------------------------
DROP TABLE IF EXISTS `qs_jobs_search_scale`;
CREATE TABLE `qs_jobs_search_scale` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `uid` int(10) unsigned NOT NULL,
  `subsite_id` int(10) unsigned NOT NULL DEFAULT '0',
  `recommend` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `emergency` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `nature` tinyint(3) unsigned NOT NULL,
  `sex` tinyint(1) unsigned NOT NULL DEFAULT '3',
  `category` smallint(5) unsigned NOT NULL,
  `subclass` smallint(5) unsigned NOT NULL,
  `trade` smallint(5) unsigned NOT NULL,
  `scale` smallint(5) unsigned NOT NULL,
  `district` smallint(5) unsigned NOT NULL,
  `sdistrict` smallint(5) unsigned NOT NULL,
  `street` smallint(5) unsigned NOT NULL,
  `officebuilding` smallint(5) unsigned NOT NULL,
  `education` smallint(5) unsigned NOT NULL,
  `experience` smallint(5) unsigned NOT NULL,
  `wage` smallint(5) unsigned NOT NULL,
  `refreshtime` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `category_scale` (`category`,`scale`,`refreshtime`),
  KEY `district_scale` (`district`,`scale`,`refreshtime`),
  KEY `office_scale` (`officebuilding`,`scale`,`refreshtime`),
  KEY `scale` (`scale`,`refreshtime`),
  KEY `sdistrict_scale` (`sdistrict`,`scale`,`refreshtime`),
  KEY `street_scale` (`street`,`scale`,`refreshtime`),
  KEY `subclass_scale` (`subclass`,`scale`,`refreshtime`),
  KEY `trade_scale` (`trade`,`scale`,`refreshtime`),
  KEY `uid` (`uid`)
) ENGINE=MyISAM DEFAULT CHARSET=gbk ROW_FORMAT=FIXED;

-- ----------------------------
-- Table structure for qs32_jobs_search_stickrtime
-- ----------------------------
DROP TABLE IF EXISTS `qs_jobs_search_stickrtime`;
CREATE TABLE `qs_jobs_search_stickrtime` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `uid` int(10) unsigned NOT NULL,
  `subsite_id` int(10) unsigned NOT NULL DEFAULT '0',
  `recommend` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `emergency` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `stick` tinyint(1) NOT NULL DEFAULT '0',
  `nature` tinyint(3) unsigned NOT NULL,
  `sex` tinyint(1) unsigned NOT NULL DEFAULT '3',
  `category` smallint(5) unsigned NOT NULL,
  `subclass` smallint(5) unsigned NOT NULL,
  `trade` smallint(5) unsigned NOT NULL,
  `district` smallint(5) unsigned NOT NULL,
  `sdistrict` smallint(5) unsigned NOT NULL,
  `street` smallint(5) unsigned NOT NULL,
  `officebuilding` smallint(5) unsigned NOT NULL,
  `education` smallint(5) unsigned NOT NULL,
  `experience` smallint(5) unsigned NOT NULL,
  `wage` smallint(5) unsigned NOT NULL,
  `scale` smallint(5) unsigned NOT NULL DEFAULT '0',
  `refreshtime` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `category_rtime` (`category`,`stick`,`refreshtime`),
  KEY `district_rtime` (`district`,`stick`,`refreshtime`),
  KEY `sdistrict_rtime` (`sdistrict`,`stick`,`refreshtime`),
  KEY `stick_office` (`officebuilding`,`stick`,`refreshtime`),
  KEY `stick_rtime` (`stick`,`refreshtime`),
  KEY `stick_street` (`street`,`stick`,`refreshtime`),
  KEY `subclass_rtime` (`subclass`,`stick`,`refreshtime`),
  KEY `trade_rtime` (`trade`,`stick`,`refreshtime`),
  KEY `uid` (`uid`)
) ENGINE=MyISAM DEFAULT CHARSET=gbk ROW_FORMAT=FIXED;

-- ----------------------------
-- Table structure for qs32_jobs_search_tag
-- ----------------------------
DROP TABLE IF EXISTS `qs_jobs_search_tag`;
CREATE TABLE `qs_jobs_search_tag` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `uid` int(10) unsigned NOT NULL DEFAULT '0',
  `tag1` smallint(5) unsigned NOT NULL DEFAULT '0',
  `tag2` smallint(5) unsigned NOT NULL DEFAULT '0',
  `tag3` smallint(5) unsigned NOT NULL DEFAULT '0',
  `tag4` smallint(5) unsigned NOT NULL DEFAULT '0',
  `tag5` smallint(5) unsigned NOT NULL DEFAULT '0',
  `category` smallint(5) unsigned NOT NULL DEFAULT '0',
  `subclass` smallint(5) unsigned NOT NULL DEFAULT '0',
  `district` smallint(5) unsigned NOT NULL DEFAULT '0',
  `sdistrict` smallint(5) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `tag` (`tag1`,`tag2`,`tag3`,`tag4`,`tag5`)
) ENGINE=MyISAM DEFAULT CHARSET=gbk ROW_FORMAT=FIXED;

-- ----------------------------
-- Table structure for qs32_jobs_search_wage
-- ----------------------------
DROP TABLE IF EXISTS `qs_jobs_search_wage`;
CREATE TABLE `qs_jobs_search_wage` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `uid` int(10) unsigned NOT NULL,
  `subsite_id` int(10) unsigned NOT NULL DEFAULT '0',
  `recommend` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `emergency` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `nature` tinyint(3) unsigned NOT NULL,
  `sex` tinyint(1) unsigned NOT NULL DEFAULT '3',
  `category` smallint(5) unsigned NOT NULL,
  `subclass` smallint(5) unsigned NOT NULL,
  `trade` smallint(5) unsigned NOT NULL,
  `district` smallint(5) unsigned NOT NULL,
  `sdistrict` smallint(5) unsigned NOT NULL,
  `street` smallint(5) unsigned NOT NULL,
  `officebuilding` smallint(5) unsigned NOT NULL,
  `education` smallint(5) unsigned NOT NULL,
  `experience` smallint(5) unsigned NOT NULL,
  `wage` smallint(5) unsigned NOT NULL,
  `scale` smallint(5) unsigned NOT NULL DEFAULT '0',
  `refreshtime` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `category_wage` (`category`,`wage`,`refreshtime`),
  KEY `district_wage` (`district`,`wage`,`refreshtime`),
  KEY `officebuilding_wage` (`officebuilding`,`wage`,`refreshtime`),
  KEY `rtime_wage` (`refreshtime`,`wage`),
  KEY `sdistrict_wage` (`sdistrict`,`wage`,`refreshtime`),
  KEY `street_wage` (`street`,`wage`,`refreshtime`),
  KEY `subclass_wage` (`subclass`,`wage`,`refreshtime`),
  KEY `trade_wage` (`trade`,`wage`,`refreshtime`),
  KEY `uid` (`uid`)
) ENGINE=MyISAM DEFAULT CHARSET=gbk ROW_FORMAT=FIXED;

-- ----------------------------
-- Table structure for qs32_jobs_tmp
-- ----------------------------
DROP TABLE IF EXISTS `qs_jobs_tmp`;
CREATE TABLE `qs_jobs_tmp` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `subsite_id` smallint(5) unsigned NOT NULL DEFAULT '0',
  `uid` int(10) unsigned NOT NULL,
  `jobs_name` varchar(30) NOT NULL,
  `companyname` varchar(50) NOT NULL,
  `company_id` int(10) unsigned NOT NULL,
  `company_addtime` int(10) unsigned NOT NULL,
  `company_audit` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `recommend` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `emergency` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `highlight` varchar(7) NOT NULL,
  `stick` tinyint(1) NOT NULL,
  `nature` tinyint(3) unsigned NOT NULL,
  `nature_cn` varchar(30) NOT NULL,
  `sex` tinyint(1) unsigned NOT NULL DEFAULT '3',
  `sex_cn` varchar(3) NOT NULL,
  `amount` smallint(5) unsigned NOT NULL,
  `category` smallint(5) unsigned NOT NULL,
  `subclass` smallint(5) unsigned NOT NULL,
  `category_cn` varchar(30) NOT NULL,
  `trade` smallint(5) unsigned NOT NULL,
  `trade_cn` varchar(30) NOT NULL,
  `scale` smallint(5) unsigned NOT NULL,
  `scale_cn` varchar(30) NOT NULL,
  `district` smallint(5) unsigned NOT NULL,
  `sdistrict` smallint(5) unsigned NOT NULL,
  `district_cn` varchar(30) NOT NULL,
  `street` int(10) unsigned NOT NULL,
  `street_cn` varchar(50) NOT NULL,
  `officebuilding` int(10) unsigned NOT NULL,
  `officebuilding_cn` varchar(50) NOT NULL,
  `tag` varchar(160) NOT NULL,
  `education` smallint(5) unsigned NOT NULL,
  `education_cn` varchar(30) NOT NULL,
  `experience` smallint(5) unsigned NOT NULL,
  `experience_cn` varchar(30) NOT NULL,
  `wage` smallint(5) unsigned NOT NULL,
  `wage_cn` varchar(30) NOT NULL,
  `graduate` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `contents` varchar(1800) NOT NULL,
  `addtime` int(10) unsigned NOT NULL,
  `deadline` int(10) unsigned NOT NULL,
  `refreshtime` int(10) unsigned NOT NULL,
  `setmeal_deadline` int(10) unsigned NOT NULL DEFAULT '0',
  `setmeal_id` smallint(5) unsigned NOT NULL,
  `setmeal_name` varchar(60) NOT NULL,
  `audit` tinyint(1) unsigned NOT NULL DEFAULT '1',
  `display` tinyint(1) unsigned NOT NULL DEFAULT '1',
  `click` int(10) unsigned NOT NULL DEFAULT '1',
  `key` text NOT NULL,
  `user_status` tinyint(1) unsigned NOT NULL DEFAULT '1',
  `robot` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `tpl` varchar(60) NOT NULL,
  `map_x` double(9,6) NOT NULL,
  `map_y` double(9,6) NOT NULL,
  `add_mode` tinyint(1) unsigned NOT NULL DEFAULT '1',
  `is_deleted` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `addtime` (`addtime`),
  KEY `audit` (`audit`),
  KEY `company_id` (`company_id`),
  KEY `deadline` (`deadline`),
  KEY `refreshtime` (`refreshtime`),
  KEY `uid` (`uid`)
) ENGINE=MyISAM DEFAULT CHARSET=gbk ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Table structure for qs32_link
-- ----------------------------
DROP TABLE IF EXISTS `qs_link`;
CREATE TABLE `qs_link` (
  `link_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `type_id` tinyint(3) unsigned NOT NULL,
  `display` tinyint(1) unsigned NOT NULL DEFAULT '1',
  `alias` varchar(30) NOT NULL,
  `link_name` varchar(255) NOT NULL,
  `link_url` varchar(255) NOT NULL,
  `link_logo` varchar(255) NOT NULL,
  `show_order` smallint(5) unsigned NOT NULL DEFAULT '50',
  `Notes` varchar(255) DEFAULT NULL,
  `app_notes` varchar(300) NOT NULL,
  PRIMARY KEY (`link_id`),
  KEY `show_order` (`show_order`)
) ENGINE=MyISAM DEFAULT CHARSET=gbk ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Table structure for qs32_link_category
-- ----------------------------
DROP TABLE IF EXISTS `qs_link_category`;
CREATE TABLE `qs_link_category` (
  `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `categoryname` varchar(80) NOT NULL,
  `c_sys` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `c_alias` varchar(30) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=gbk ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Table structure for qs32_locoyspider
-- ----------------------------
DROP TABLE IF EXISTS `qs_locoyspider`;
CREATE TABLE `qs_locoyspider` (
  `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `value` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=gbk ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Table structure for qs32_mailconfig
-- ----------------------------
DROP TABLE IF EXISTS `qs_mailconfig`;
CREATE TABLE `qs_mailconfig` (
  `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `value` varchar(200) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=gbk ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Table structure for qs32_mailqueue
-- ----------------------------
DROP TABLE IF EXISTS `qs_mailqueue`;
CREATE TABLE `qs_mailqueue` (
  `m_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `m_type` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `m_addtime` int(10) unsigned NOT NULL,
  `m_sendtime` int(10) unsigned NOT NULL DEFAULT '0',
  `m_mail` varchar(80) NOT NULL,
  `m_subject` varchar(200) NOT NULL,
  `m_body` text NOT NULL,
  PRIMARY KEY (`m_id`)
) ENGINE=MyISAM DEFAULT CHARSET=gbk ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Table structure for qs32_mail_templates
-- ----------------------------
DROP TABLE IF EXISTS `qs_mail_templates`;
CREATE TABLE `qs_mail_templates` (
  `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `value` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=gbk ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Table structure for qs32_members
-- ----------------------------
DROP TABLE IF EXISTS `qs_members`;
CREATE TABLE `qs_members` (
  `uid` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `utype` tinyint(1) unsigned NOT NULL DEFAULT '1',
  `username` varchar(100) NOT NULL,
  `email` varchar(80) NOT NULL,
  `email_audit` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `mobile` varchar(11) NOT NULL,
  `mobile_audit` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `password` varchar(100) NOT NULL,
  `pwd_hash` varchar(30) NOT NULL,
  `reg_time` int(10) NOT NULL,
  `reg_ip` varchar(15) NOT NULL,
  `last_login_time` int(10) NOT NULL,
  `last_login_ip` varchar(15) NOT NULL,
  `qq_openid` varchar(60) NOT NULL,
  `status` tinyint(3) unsigned NOT NULL DEFAULT '1',
  `robot` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `attach_resume_path` varchar(100) NOT NULL,
  PRIMARY KEY (`uid`),
  KEY `email` (`email`),
  KEY `mobile` (`mobile`),
  KEY `qq_openid` (`qq_openid`),
  KEY `username` (`username`)
) ENGINE=MyISAM DEFAULT CHARSET=gbk ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Table structure for qs32_members_handsel
-- ----------------------------
DROP TABLE IF EXISTS `qs_members_handsel`;
CREATE TABLE `qs_members_handsel` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `uid` int(10) unsigned NOT NULL,
  `htype` varchar(60) NOT NULL,
  `addtime` int(10) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `uid` (`uid`,`htype`,`addtime`)
) ENGINE=MyISAM DEFAULT CHARSET=gbk ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Table structure for qs32_members_info
-- ----------------------------
DROP TABLE IF EXISTS `qs_members_info`;
CREATE TABLE `qs_members_info` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `uid` int(10) unsigned NOT NULL,
  `realname` varchar(30) NOT NULL,
  `sex` varchar(10) NOT NULL,
  `birthday` varchar(30) NOT NULL,
  `addresses` varchar(120) NOT NULL,
  `phone` varchar(50) NOT NULL,
  `qq` varchar(30) NOT NULL,
  `msn` varchar(60) NOT NULL,
  `profile` varchar(200) NOT NULL,
  `avatars` varchar(30) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `uid` (`uid`)
) ENGINE=MyISAM DEFAULT CHARSET=gbk ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Table structure for qs32_members_log
-- ----------------------------
DROP TABLE IF EXISTS `qs_members_log`;
CREATE TABLE `qs_members_log` (
  `log_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `log_uid` int(10) NOT NULL,
  `log_username` varchar(60) NOT NULL,
  `log_addtime` int(10) NOT NULL,
  `log_value` varchar(255) NOT NULL,
  `log_ip` varchar(20) NOT NULL,
  `log_utype` tinyint(1) unsigned NOT NULL DEFAULT '1',
  `log_type` smallint(5) unsigned NOT NULL DEFAULT '1',
  PRIMARY KEY (`log_id`),
  KEY `log_addtime` (`log_addtime`),
  KEY `log_username` (`log_username`),
  KEY `type_addtime` (`log_type`,`log_addtime`),
  KEY `uid_addtime` (`log_uid`,`log_addtime`),
  KEY `utype_addtime` (`log_utype`,`log_addtime`)
) ENGINE=MyISAM DEFAULT CHARSET=gbk ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Table structure for qs32_members_points
-- ----------------------------
DROP TABLE IF EXISTS `qs_members_points`;
CREATE TABLE `qs_members_points` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `uid` int(10) unsigned NOT NULL,
  `points` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `unique_uid` (`uid`),
  KEY `uid` (`uid`)
) ENGINE=MyISAM DEFAULT CHARSET=gbk ROW_FORMAT=FIXED;

-- ----------------------------
-- Table structure for qs32_members_points_rule
-- ----------------------------
DROP TABLE IF EXISTS `qs_members_points_rule`;
CREATE TABLE `qs_members_points_rule` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `operation` tinyint(1) NOT NULL DEFAULT '2',
  `value` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=gbk ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Table structure for qs32_members_setmeal
-- ----------------------------
DROP TABLE IF EXISTS `qs_members_setmeal`;
CREATE TABLE `qs_members_setmeal` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `effective` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `uid` int(10) unsigned NOT NULL,
  `setmeal_id` int(10) unsigned NOT NULL,
  `setmeal_name` varchar(200) NOT NULL,
  `days` int(10) unsigned NOT NULL,
  `expense` int(10) unsigned NOT NULL,
  `jobs_ordinary` int(10) unsigned NOT NULL,
  `download_resume_ordinary` int(10) unsigned NOT NULL,
  `download_resume_senior` int(10) unsigned NOT NULL,
  `interview_ordinary` int(10) unsigned NOT NULL,
  `interview_senior` int(10) unsigned NOT NULL,
  `talent_pool` int(10) unsigned NOT NULL,
  `added` varchar(250) NOT NULL,
  `starttime` int(10) unsigned NOT NULL,
  `endtime` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `unique_uid` (`uid`),
  KEY `effective_endtime` (`effective`,`endtime`),
  KEY `effective_setmealid` (`effective`,`setmeal_id`),
  KEY `uid` (`uid`)
) ENGINE=MyISAM DEFAULT CHARSET=gbk ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Table structure for qs32_navigation
-- ----------------------------
DROP TABLE IF EXISTS `qs_navigation`;
CREATE TABLE `qs_navigation` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `alias` varchar(100) NOT NULL,
  `urltype` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `display` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `title` varchar(100) NOT NULL,
  `color` varchar(30) NOT NULL,
  `pagealias` varchar(100) NOT NULL,
  `list_id` varchar(30) NOT NULL,
  `tag` varchar(100) NOT NULL,
  `url` varchar(200) NOT NULL,
  `target` varchar(100) NOT NULL,
  `navigationorder` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=gbk ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Table structure for qs32_navigation_category
-- ----------------------------
DROP TABLE IF EXISTS `qs_navigation_category`;
CREATE TABLE `qs_navigation_category` (
  `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `alias` varchar(100) NOT NULL,
  `categoryname` varchar(30) NOT NULL,
  `admin_set` tinyint(3) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=gbk ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Table structure for qs32_notice
-- ----------------------------
DROP TABLE IF EXISTS `qs_notice`;
CREATE TABLE `qs_notice` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `type_id` smallint(5) unsigned NOT NULL,
  `title` varchar(100) NOT NULL,
  `content` mediumtext NOT NULL,
  `tit_color` varchar(10) DEFAULT NULL,
  `tit_b` tinyint(1) NOT NULL DEFAULT '0',
  `is_display` tinyint(3) unsigned NOT NULL DEFAULT '1',
  `is_url` varchar(200) NOT NULL DEFAULT '0',
  `seo_keywords` varchar(100) DEFAULT NULL,
  `seo_description` varchar(200) DEFAULT NULL,
  `click` int(11) NOT NULL DEFAULT '1',
  `addtime` int(10) NOT NULL,
  `sort` smallint(5) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `type_id` (`type_id`,`sort`,`id`)
) ENGINE=MyISAM DEFAULT CHARSET=gbk ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Table structure for qs32_notice_category
-- ----------------------------
DROP TABLE IF EXISTS `qs_notice_category`;
CREATE TABLE `qs_notice_category` (
  `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `categoryname` varchar(80) NOT NULL,
  `sort` smallint(5) unsigned NOT NULL DEFAULT '0',
  `admin_set` tinyint(3) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=gbk ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Table structure for qs32_order
-- ----------------------------
DROP TABLE IF EXISTS `qs_order`;
CREATE TABLE `qs_order` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `uid` int(10) unsigned NOT NULL,
  `is_paid` tinyint(3) unsigned NOT NULL DEFAULT '1',
  `oid` varchar(200) NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `payment_name` varchar(20) NOT NULL,
  `points` int(10) unsigned NOT NULL,
  `addtime` int(11) unsigned NOT NULL,
  `payment_time` int(10) unsigned NOT NULL,
  `description` varchar(150) NOT NULL,
  `setmeal` int(10) unsigned NOT NULL,
  `notes` varchar(150) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `addtime` (`addtime`),
  KEY `oid` (`oid`),
  KEY `payment_name` (`payment_name`),
  KEY `uid` (`uid`)
) ENGINE=MyISAM DEFAULT CHARSET=gbk ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Table structure for qs32_page
-- ----------------------------
DROP TABLE IF EXISTS `qs_page`;
CREATE TABLE `qs_page` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `systemclass` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `pagetpye` tinyint(3) unsigned NOT NULL DEFAULT '1',
  `alias` varchar(60) NOT NULL,
  `pname` varchar(12) NOT NULL,
  `file` varchar(100) NOT NULL,
  `tpl` varchar(100) NOT NULL,
  `rewrite` varchar(100) NOT NULL,
  `html` varchar(100) NOT NULL,
  `url` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `caching` int(10) unsigned NOT NULL DEFAULT '0',
  `tag` varchar(60) NOT NULL,
  `title` varchar(200) NOT NULL,
  `description` varchar(200) NOT NULL,
  `keywords` varchar(200) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=gbk ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Table structure for qs32_payment
-- ----------------------------
DROP TABLE IF EXISTS `qs_payment`;
CREATE TABLE `qs_payment` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `listorder` int(10) unsigned NOT NULL DEFAULT '50',
  `typename` varchar(15) NOT NULL,
  `byname` varchar(50) NOT NULL,
  `p_introduction` varchar(100) NOT NULL,
  `notes` text,
  `partnerid` varchar(80) DEFAULT NULL,
  `ytauthkey` varchar(100) DEFAULT NULL,
  `fee` varchar(6) NOT NULL DEFAULT '0',
  `parameter1` varchar(50) DEFAULT NULL,
  `parameter2` varchar(50) DEFAULT NULL,
  `parameter3` varchar(50) DEFAULT NULL,
  `p_install` tinyint(3) unsigned NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=gbk ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Table structure for qs32_personal_favorites
-- ----------------------------
DROP TABLE IF EXISTS `qs_personal_favorites`;
CREATE TABLE `qs_personal_favorites` (
  `did` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `personal_uid` int(10) unsigned NOT NULL,
  `jobs_id` int(10) unsigned NOT NULL,
  `jobs_name` varchar(100) NOT NULL,
  `addtime` int(10) unsigned NOT NULL,
  PRIMARY KEY (`did`),
  KEY `personal_uid` (`personal_uid`)
) ENGINE=MyISAM  DEFAULT CHARSET=gbk ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Table structure for qs32_personal_jobs_apply
-- ----------------------------
DROP TABLE IF EXISTS `qs_personal_jobs_apply`;
CREATE TABLE `qs_personal_jobs_apply` (
  `did` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `resume_id` int(10) unsigned NOT NULL,
  `resume_name` varchar(60) NOT NULL,
  `personal_uid` int(10) unsigned NOT NULL,
  `jobs_id` int(10) unsigned NOT NULL,
  `jobs_name` varchar(60) NOT NULL,
  `company_id` int(10) unsigned NOT NULL,
  `company_name` varchar(60) NOT NULL,
  `company_uid` int(10) unsigned NOT NULL,
  `apply_addtime` int(10) unsigned NOT NULL,
  `personal_look` tinyint(3) unsigned NOT NULL DEFAULT '1',
  `notes` varchar(200) NOT NULL,
  PRIMARY KEY (`did`),
  KEY `company_uid_jobid` (`company_uid`,`jobs_id`),
  KEY `company_uid_look` (`company_uid`,`personal_look`),
  KEY `personal_uid_addtime` (`personal_uid`,`apply_addtime`),
  KEY `personal_uid_id` (`personal_uid`,`resume_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=gbk ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Table structure for qs32_promotion
-- ----------------------------
DROP TABLE IF EXISTS `qs_promotion`;
CREATE TABLE `qs_promotion` (
  `cp_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `cp_available` tinyint(1) NOT NULL DEFAULT '1',
  `cp_promotionid` int(10) unsigned NOT NULL,
  `cp_uid` int(10) unsigned NOT NULL,
  `cp_jobid` int(10) unsigned NOT NULL,
  `cp_days` int(10) unsigned NOT NULL,
  `cp_starttime` int(10) unsigned NOT NULL,
  `cp_endtime` int(10) unsigned NOT NULL,
  `cp_val` varchar(160) NOT NULL,
  PRIMARY KEY (`cp_id`),
  KEY `cp_endtime` (`cp_endtime`),
  KEY `cp_uid` (`cp_uid`)
) ENGINE=MyISAM DEFAULT CHARSET=gbk ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Table structure for qs32_promotion_category
-- ----------------------------
DROP TABLE IF EXISTS `qs_promotion_category`;
CREATE TABLE `qs_promotion_category` (
  `cat_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `cat_available` tinyint(1) NOT NULL DEFAULT '1',
  `cat_name` varchar(30) NOT NULL,
  `cat_type` tinyint(3) unsigned NOT NULL,
  `cat_minday` smallint(5) unsigned NOT NULL DEFAULT '0',
  `cat_maxday` int(10) unsigned NOT NULL DEFAULT '0',
  `cat_points` int(10) NOT NULL DEFAULT '0',
  `cat_notes` text NOT NULL,
  `cat_order` int(10) NOT NULL DEFAULT '0',
  PRIMARY KEY (`cat_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=gbk ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Table structure for qs32_report
-- ----------------------------
DROP TABLE IF EXISTS `qs_report`;
CREATE TABLE `qs_report` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `uid` int(10) unsigned NOT NULL,
  `jobs_id` int(10) unsigned NOT NULL,
  `jobs_name` varchar(150) NOT NULL,
  `jobs_addtime` int(10) unsigned NOT NULL,
  `content` varchar(250) NOT NULL,
  `addtime` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `uid` (`uid`)
) ENGINE=MyISAM DEFAULT CHARSET=gbk ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Table structure for qs32_resume
-- ----------------------------
DROP TABLE IF EXISTS `qs_resume`;
CREATE TABLE `qs_resume` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `subsite_id` smallint(5) unsigned NOT NULL DEFAULT '0',
  `uid` int(10) unsigned NOT NULL,
  `display` tinyint(3) unsigned NOT NULL DEFAULT '1',
  `display_name` tinyint(3) unsigned NOT NULL DEFAULT '1',
  `audit` tinyint(3) unsigned NOT NULL DEFAULT '1',
  `title` varchar(80) NOT NULL,
  `fullname` varchar(15) NOT NULL,
  `sex` tinyint(3) unsigned NOT NULL,
  `sex_cn` varchar(20) DEFAULT NULL,
  `nature` tinyint(3) unsigned NOT NULL,
  `nature_cn` varchar(30) NOT NULL,
  `trade` varchar(60) NOT NULL,
  `trade_cn` varchar(100) NOT NULL,
  `birthdate` smallint(4) unsigned NOT NULL,
  `height` tinyint(3) unsigned NOT NULL,
  `marriage` tinyint(3) unsigned NOT NULL,
  `marriage_cn` varchar(5) NOT NULL,
  `experience` smallint(5) unsigned NOT NULL,
  `experience_cn` varchar(30) NOT NULL,
  `district` smallint(5) unsigned NOT NULL,
  `sdistrict` smallint(5) unsigned NOT NULL,
  `district_cn` varchar(30) NOT NULL,
  `wage` tinyint(5) unsigned NOT NULL,
  `wage_cn` varchar(30) NOT NULL,
  `householdaddress` varchar(80) NOT NULL,
  `education` smallint(5) unsigned NOT NULL,
  `education_cn` varchar(30) NOT NULL,
  `tag` varchar(160) NOT NULL,
  `telephone` varchar(50) NOT NULL,
  `email` varchar(60) NOT NULL,
  `email_notify` tinyint(1) unsigned NOT NULL DEFAULT '1',
  `qq` varchar(25) NOT NULL,
  `address` varchar(100) NOT NULL,
  `website` varchar(100) NOT NULL,
  `recentjobs` varchar(200) NOT NULL,
  `intention_jobs` varchar(100) NOT NULL,
  `specialty` varchar(200) NOT NULL,
  `photo` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `photo_img` varchar(80) NOT NULL,
  `photo_audit` tinyint(1) unsigned NOT NULL DEFAULT '1',
  `photo_display` tinyint(1) unsigned NOT NULL DEFAULT '1',
  `addtime` int(10) unsigned NOT NULL,
  `refreshtime` int(10) unsigned NOT NULL,
  `talent` tinyint(1) unsigned NOT NULL DEFAULT '1',
  `complete` tinyint(3) unsigned NOT NULL DEFAULT '2',
  `complete_percent` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `user_status` tinyint(1) unsigned NOT NULL DEFAULT '1',
  `key` text NOT NULL,
  `click` int(10) unsigned NOT NULL DEFAULT '1',
  `tpl` varchar(60) NOT NULL,
  `resume_type` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `addtime` (`addtime`),
  KEY `refreshtime` (`refreshtime`),
  KEY `uid` (`uid`)
) ENGINE=MyISAM  DEFAULT CHARSET=gbk ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Table structure for qs32_resume_education
-- ----------------------------
DROP TABLE IF EXISTS `qs_resume_education`;
CREATE TABLE `qs_resume_education` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `pid` int(10) unsigned NOT NULL,
  `uid` int(10) unsigned NOT NULL,
  `start` varchar(20) NOT NULL,
  `endtime` varchar(20) NOT NULL,
  `school` varchar(50) NOT NULL,
  `speciality` varchar(50) NOT NULL,
  `education` smallint(5) unsigned NOT NULL,
  `education_cn` varchar(30) NOT NULL,
  `education_remark` varchar(5000) NOT NULL COMMENT '教育经历文字版',
  PRIMARY KEY (`id`),
  KEY `uid` (`uid`)
) ENGINE=MyISAM  DEFAULT CHARSET=gbk ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Table structure for qs32_resume_jobs
-- ----------------------------
DROP TABLE IF EXISTS `qs_resume_jobs`;
CREATE TABLE `qs_resume_jobs` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `uid` int(10) unsigned NOT NULL,
  `pid` int(10) unsigned NOT NULL,
  `category` int(10) unsigned NOT NULL,
  `subclass` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `category` (`category`,`subclass`),
  KEY `pid` (`pid`)
) ENGINE=MyISAM  DEFAULT CHARSET=gbk ROW_FORMAT=FIXED;

-- ----------------------------
-- Table structure for qs32_resume_search_key
-- ----------------------------
DROP TABLE IF EXISTS `qs_resume_search_key`;
CREATE TABLE `qs_resume_search_key` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `subsite_id` int(10) unsigned NOT NULL DEFAULT '0',
  `uid` int(10) unsigned NOT NULL DEFAULT '0',
  `sex` tinyint(3) unsigned NOT NULL DEFAULT '1',
  `nature` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `marriage` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `experience` smallint(5) unsigned NOT NULL DEFAULT '0',
  `district` smallint(5) unsigned NOT NULL DEFAULT '0',
  `sdistrict` smallint(5) unsigned NOT NULL DEFAULT '0',
  `wage` tinyint(5) unsigned NOT NULL DEFAULT '0',
  `education` smallint(5) unsigned NOT NULL DEFAULT '0',
  `photo` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `refreshtime` int(10) unsigned NOT NULL,
  `talent` tinyint(1) unsigned NOT NULL DEFAULT '1',
  `key` text NOT NULL,
  PRIMARY KEY (`id`),
  KEY `uid` (`uid`),
  FULLTEXT KEY `key` (`key`)
) ENGINE=MyISAM  DEFAULT CHARSET=gbk ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Table structure for qs32_resume_search_rtime
-- ----------------------------
DROP TABLE IF EXISTS `qs_resume_search_rtime`;
CREATE TABLE `qs_resume_search_rtime` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `subsite_id` int(10) unsigned NOT NULL DEFAULT '0',
  `uid` int(10) unsigned NOT NULL DEFAULT '0',
  `sex` tinyint(3) unsigned NOT NULL DEFAULT '1',
  `nature` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `marriage` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `experience` smallint(5) unsigned NOT NULL DEFAULT '0',
  `district` smallint(5) unsigned NOT NULL DEFAULT '0',
  `sdistrict` smallint(5) unsigned NOT NULL DEFAULT '0',
  `wage` tinyint(5) unsigned NOT NULL DEFAULT '0',
  `education` smallint(5) unsigned NOT NULL DEFAULT '0',
  `photo` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `refreshtime` int(10) unsigned NOT NULL,
  `talent` tinyint(1) unsigned NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `district_rtime` (`district`,`refreshtime`),
  KEY `photo_rtime` (`photo`,`refreshtime`),
  KEY `refreshtime` (`refreshtime`),
  KEY `sdistrict_rtime` (`sdistrict`,`refreshtime`),
  KEY `talent_rtime` (`talent`,`refreshtime`),
  KEY `uid` (`uid`)
) ENGINE=MyISAM  DEFAULT CHARSET=gbk ROW_FORMAT=FIXED;

-- ----------------------------
-- Table structure for qs32_resume_search_tag
-- ----------------------------
DROP TABLE IF EXISTS `qs_resume_search_tag`;
CREATE TABLE `qs_resume_search_tag` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `subsite_id` int(10) unsigned NOT NULL DEFAULT '0',
  `uid` int(10) unsigned NOT NULL,
  `experience` smallint(5) unsigned NOT NULL,
  `district` smallint(5) unsigned NOT NULL,
  `sdistrict` smallint(5) unsigned NOT NULL,
  `education` smallint(5) unsigned NOT NULL,
  `tag1` smallint(5) unsigned NOT NULL DEFAULT '0',
  `tag2` smallint(5) unsigned NOT NULL DEFAULT '0',
  `tag3` smallint(5) unsigned NOT NULL DEFAULT '0',
  `tag4` smallint(5) unsigned NOT NULL DEFAULT '0',
  `tag5` smallint(5) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `tag` (`tag1`,`tag2`,`tag3`,`tag4`,`tag5`),
  KEY `uid` (`uid`)
) ENGINE=MyISAM  DEFAULT CHARSET=gbk ROW_FORMAT=FIXED;

-- ----------------------------
-- Table structure for qs32_resume_tmp
-- ----------------------------
DROP TABLE IF EXISTS `qs_resume_tmp`;
CREATE TABLE `qs_resume_tmp` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `subsite_id` smallint(5) unsigned NOT NULL DEFAULT '0',
  `uid` int(10) unsigned NOT NULL,
  `display` tinyint(3) unsigned NOT NULL DEFAULT '1',
  `display_name` tinyint(3) unsigned NOT NULL DEFAULT '1',
  `audit` tinyint(3) unsigned NOT NULL DEFAULT '1',
  `title` varchar(80) NOT NULL,
  `fullname` varchar(15) NOT NULL,
  `sex` tinyint(3) unsigned NOT NULL,
  `sex_cn` varchar(3) NOT NULL,
  `nature` tinyint(3) unsigned NOT NULL,
  `nature_cn` varchar(30) NOT NULL,
  `trade` varchar(60) NOT NULL,
  `trade_cn` varchar(100) NOT NULL,
  `birthdate` smallint(4) unsigned NOT NULL,
  `height` tinyint(3) unsigned NOT NULL,
  `marriage` tinyint(3) unsigned NOT NULL,
  `marriage_cn` varchar(5) NOT NULL,
  `experience` smallint(5) unsigned NOT NULL,
  `experience_cn` varchar(30) NOT NULL,
  `district` smallint(5) unsigned NOT NULL,
  `sdistrict` smallint(5) unsigned NOT NULL,
  `district_cn` varchar(30) NOT NULL,
  `wage` tinyint(5) unsigned NOT NULL,
  `wage_cn` varchar(30) NOT NULL,
  `householdaddress` varchar(80) NOT NULL,
  `education` smallint(5) unsigned NOT NULL,
  `education_cn` varchar(30) NOT NULL,
  `tag` varchar(160) NOT NULL,
  `telephone` varchar(50) NOT NULL,
  `email` varchar(60) NOT NULL,
  `email_notify` tinyint(1) unsigned NOT NULL DEFAULT '1',
  `qq` varchar(25) NOT NULL,
  `address` varchar(100) NOT NULL,
  `website` varchar(100) NOT NULL,
  `recentjobs` varchar(200) NOT NULL,
  `intention_jobs` varchar(100) NOT NULL,
  `specialty` varchar(200) NOT NULL,
  `photo` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `photo_img` varchar(80) NOT NULL,
  `photo_audit` tinyint(1) unsigned NOT NULL DEFAULT '1',
  `photo_display` tinyint(1) unsigned NOT NULL DEFAULT '1',
  `addtime` int(10) unsigned NOT NULL,
  `refreshtime` int(10) unsigned NOT NULL,
  `talent` tinyint(1) unsigned NOT NULL DEFAULT '1',
  `complete` tinyint(3) unsigned NOT NULL DEFAULT '2',
  `complete_percent` tinyint(3) unsigned NOT NULL DEFAULT '0',
  `user_status` tinyint(1) unsigned NOT NULL DEFAULT '1',
  `key` text NOT NULL,
  `click` int(10) unsigned NOT NULL DEFAULT '1',
  `tpl` varchar(60) NOT NULL,
  `resume_type` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `addtime` (`addtime`),
  KEY `audit` (`audit`),
  KEY `refreshtime` (`refreshtime`),
  KEY `uid` (`uid`)
) ENGINE=MyISAM DEFAULT CHARSET=gbk ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Table structure for qs32_resume_training
-- ----------------------------
DROP TABLE IF EXISTS `qs_resume_training`;
CREATE TABLE `qs_resume_training` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `pid` int(10) unsigned NOT NULL,
  `uid` int(10) unsigned NOT NULL,
  `start` varchar(20) NOT NULL,
  `endtime` varchar(20) NOT NULL,
  `agency` varchar(50) NOT NULL,
  `course` varchar(50) NOT NULL,
  `description` varchar(255) NOT NULL,
  `training_remark` varchar(5000) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `uid` (`uid`)
) ENGINE=MyISAM  DEFAULT CHARSET=gbk ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Table structure for qs32_resume_work
-- ----------------------------
DROP TABLE IF EXISTS `qs_resume_work`;
CREATE TABLE `qs_resume_work` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `pid` int(10) unsigned NOT NULL,
  `uid` int(10) unsigned NOT NULL,
  `start` varchar(20) NOT NULL,
  `endtime` varchar(20) NOT NULL,
  `companyname` varchar(50) NOT NULL,
  `companyprofile` varchar(255) NOT NULL,
  `jobs` varchar(30) NOT NULL,
  `achievements` varchar(255) NOT NULL,
  `work_remark` varchar(5000) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `uid` (`uid`)
) ENGINE=MyISAM  DEFAULT CHARSET=gbk ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Table structure for qs32_setmeal
-- ----------------------------
DROP TABLE IF EXISTS `qs_setmeal`;
CREATE TABLE `qs_setmeal` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `display` tinyint(3) unsigned NOT NULL DEFAULT '1',
  `apply` tinyint(3) unsigned NOT NULL DEFAULT '1',
  `setmeal_name` varchar(200) NOT NULL,
  `days` int(10) unsigned NOT NULL DEFAULT '0',
  `expense` int(10) unsigned NOT NULL,
  `jobs_ordinary` int(10) unsigned NOT NULL DEFAULT '0',
  `download_resume_ordinary` int(10) unsigned NOT NULL DEFAULT '0',
  `download_resume_senior` int(10) unsigned NOT NULL DEFAULT '0',
  `interview_ordinary` int(10) unsigned NOT NULL DEFAULT '0',
  `interview_senior` int(10) unsigned NOT NULL DEFAULT '0',
  `talent_pool` int(10) unsigned NOT NULL DEFAULT '0',
  `added` varchar(255) NOT NULL,
  `show_order` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=gbk ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Table structure for qs32_simple
-- ----------------------------
DROP TABLE IF EXISTS `qs_simple`;
CREATE TABLE `qs_simple` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `audit` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `pwd` varchar(60) NOT NULL,
  `pwd_hash` varchar(30) NOT NULL,
  `jobname` varchar(100) NOT NULL,
  `amount` smallint(3) unsigned NOT NULL DEFAULT '0',
  `comname` varchar(100) NOT NULL,
  `contact` varchar(30) NOT NULL,
  `tel` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `qq` varchar(30) NOT NULL,
  `address` varchar(180) NOT NULL,
  `detailed` text NOT NULL,
  `addtime` int(10) unsigned NOT NULL,
  `deadline` int(10) unsigned NOT NULL,
  `refreshtime` int(10) unsigned NOT NULL,
  `click` int(10) unsigned NOT NULL DEFAULT '1',
  `addip` varchar(80) NOT NULL,
  `key` text NOT NULL,
  PRIMARY KEY (`id`),
  KEY `audit_click` (`audit`,`click`),
  KEY `audit_refreshtime` (`audit`,`refreshtime`),
  KEY `deadline` (`deadline`),
  KEY `tel` (`tel`),
  FULLTEXT KEY `key` (`key`)
) ENGINE=MyISAM DEFAULT CHARSET=gbk ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Table structure for qs32_sms_config
-- ----------------------------
DROP TABLE IF EXISTS `qs_sms_config`;
CREATE TABLE `qs_sms_config` (
  `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `value` varchar(200) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=gbk ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Table structure for qs32_sms_templates
-- ----------------------------
DROP TABLE IF EXISTS `qs_sms_templates`;
CREATE TABLE `qs_sms_templates` (
  `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `value` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=gbk ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Table structure for qs32_syslog
-- ----------------------------
DROP TABLE IF EXISTS `qs_syslog`;
CREATE TABLE `qs_syslog` (
  `l_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `l_type` tinyint(1) unsigned NOT NULL,
  `l_type_name` varchar(30) NOT NULL,
  `l_time` int(10) unsigned NOT NULL,
  `l_ip` varchar(20) NOT NULL,
  `l_page` text NOT NULL,
  `l_str` text NOT NULL,
  PRIMARY KEY (`l_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=gbk ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Table structure for qs32_text
-- ----------------------------
DROP TABLE IF EXISTS `qs_text`;
CREATE TABLE `qs_text` (
  `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `value` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=gbk ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Table structure for qs32_tpl
-- ----------------------------
DROP TABLE IF EXISTS `qs_tpl`;
CREATE TABLE `qs_tpl` (
  `tpl_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `tpl_type` tinyint(1) NOT NULL,
  `tpl_name` varchar(80) NOT NULL,
  `tpl_display` tinyint(1) NOT NULL DEFAULT '1',
  `tpl_dir` varchar(80) NOT NULL,
  `tpl_val` int(10) NOT NULL DEFAULT '0',
  PRIMARY KEY (`tpl_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=gbk ROW_FORMAT=DYNAMIC;
