-- phpMyAdmin SQL Dump
-- version 3.3.10
-- http://www.phpmyadmin.net
--
-- 主机: localhost
-- 生成日期: 2016 年 04 月 07 日 16:36
-- 服务器版本: 5.1.57
-- PHP 版本: 5.2.17

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- 数据库: `yun_fwdl`
--

-- --------------------------------------------------------

--
-- 表的结构 `tgs_admin`
--

CREATE TABLE IF NOT EXISTS `tgs_admin` (
  `id` tinyint(3) NOT NULL AUTO_INCREMENT,
  `username` varchar(20) NOT NULL,
  `password` varchar(40) NOT NULL,
  `logins` mediumint(8) DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- 转存表中的数据 `tgs_admin`
--

INSERT INTO `tgs_admin` (`id`, `username`, `password`, `logins`) VALUES
(1, 'admin', '7fef6171469e80d32c0559f88b377245', 27);

-- --------------------------------------------------------

--
-- 表的结构 `tgs_agent`
--

CREATE TABLE IF NOT EXISTS `tgs_agent` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `agentid` varchar(50) DEFAULT NULL,
  `product` varchar(100) DEFAULT NULL,
  `quyu` varchar(100) DEFAULT NULL,
  `shuyu` varchar(100) DEFAULT NULL,
  `qudao` varchar(100) DEFAULT NULL,
  `url` varchar(100) DEFAULT NULL,
  `about` varchar(250) DEFAULT NULL,
  `addtime` date DEFAULT NULL,
  `jietime` date DEFAULT NULL,
  `name` varchar(100) DEFAULT NULL,
  `tel` varchar(100) DEFAULT NULL,
  `fax` varchar(100) DEFAULT NULL,
  `phone` varchar(100) DEFAULT NULL,
  `danwei` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `qq` varchar(100) DEFAULT NULL,
  `weixin` varchar(100) DEFAULT NULL,
  `wangwang` varchar(100) DEFAULT NULL,
  `paipai` varchar(100) DEFAULT NULL,
  `zip` varchar(100) DEFAULT NULL,
  `dizhi` varchar(250) DEFAULT NULL,
  `beizhu` varchar(250) DEFAULT NULL,
  `hits` int(8) DEFAULT '0',
  `query_time` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- 转存表中的数据 `tgs_agent`
--


-- --------------------------------------------------------

--
-- 表的结构 `tgs_code`
--

CREATE TABLE IF NOT EXISTS `tgs_code` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `bianhao` varchar(50) DEFAULT NULL,
  `riqi` varchar(30) DEFAULT NULL,
  `product` varchar(100) DEFAULT NULL,
  `zd1` varchar(250) DEFAULT NULL,
  `zd2` varchar(250) DEFAULT NULL,
  `hits` int(8) DEFAULT '0',
  `query_time` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- 转存表中的数据 `tgs_code`
--


-- --------------------------------------------------------

--
-- 表的结构 `tgs_config`
--

CREATE TABLE IF NOT EXISTS `tgs_config` (
  `id` mediumint(6) NOT NULL AUTO_INCREMENT,
  `parentid` smallint(5) NOT NULL DEFAULT '1',
  `code` varchar(30) NOT NULL,
  `code_name` varchar(30) NOT NULL,
  `code_value` text,
  `store_range` varchar(50) DEFAULT NULL,
  `type` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=24 ;

--
-- 转存表中的数据 `tgs_config`
--

INSERT INTO `tgs_config` (`id`, `parentid`, `code`, `code_name`, `code_value`, `store_range`, `type`) VALUES
(1, 1, 'site_url', 'ç³»ç»Ÿç½‘å€', 'http://fwdl.ew80.com', NULL, 'text'),
(2, 1, 'site_name', 'ç³»ç»Ÿåç§°', 'äº§å“é˜²ä¼ªå’Œä»£ç†å•†æŽˆæƒæŸ¥è¯¢ç³»ç»Ÿ', NULL, 'text'),
(3, 1, 'timezone', 'ç³»ç»Ÿæ‰€åœ¨æ—¶åŒº', '0', NULL, 'text'),
(4, 1, 'time_format', 'æ—¶é—´æ ¼å¼', 'Y-m-d H:i:s', NULL, 'text'),
(5, 1, 'site_lang', 'ç³»ç»Ÿè¯­è¨€åŒ…', 'zh_cn', NULL, 'text'),
(6, 1, 'text_type', 'ç³»ç»Ÿç±»åž‹', '1', NULL, 'text'),
(7, 1, 'site_themes', 'ç³»ç»Ÿç•Œé¢è·¯å¾„', 'default', NULL, 'text'),
(8, 1, 'agent_themes', 'ä»£ç†ç•Œé¢è·¯å¾„', 'agent', NULL, 'text'),
(9, 1, 'yzm_status', 'æŸ¥è¯¢æ—¶æ˜¯å¦ä½¿ç”¨éªŒè¯ç ', '0', NULL, 'checkbox'),
(10, 1, 'page_title', 'ç½‘é¡µæ ‡é¢˜', NULL, NULL, 'text'),
(11, 1, 'page_keywords', 'ç½‘é¡µå…³é”®å­—', 'æ˜“ç½‘è½¯ä»¶,ä»£ç†æŽˆæƒæŸ¥è¯¢,å¾®å•†ä»£ç†æŸ¥è¯¢,å¾®å•†æŽˆæƒæŸ¥è¯¢,é˜²ä¼ªæŸ¥è¯¢,äº§å“é˜²ä¼ªæŸ¥è¯¢,æ˜“ç½‘è½¯ä»¶ï¼Œç®€å•æ˜“ç”¨.', NULL, 'text'),
(12, 1, 'page_desc', 'ç½‘é¡µæè¿°', 'æ˜“ç½‘è½¯ä»¶-ä»£ç†æŽˆæƒæŸ¥è¯¢+äº§å“é˜²ä¼ªæŸ¥è¯¢ç³»ç»Ÿ', NULL, 'text'),
(13, 1, 'site_close', 'ç½‘ç«™å…³é—­çŠ¶æ€', NULL, NULL, 'text'),
(14, 1, 'site_close_reason', 'ç½‘ç«™å…³é—­åŽŸå› ', NULL, NULL, 'text'),
(15, 1, 'notices', 'é˜²ä¼ªç ä¿¡æ¯é€šçŸ¥', 'æµ‹è¯•é˜²ä¼ªç ï¼šSN11672841117185<br>è¯·ä¾æ¬¡è¾“å…¥æ‚¨è¦æŸ¥è¯¢çš„é˜²ä¼ªç .<br>æŸ¥è¯¢ç•Œé¢æ¨¡æ¿å¯æ ¹æ®ç”¨æˆ·éœ€æ±‚éšæ„è®¢åˆ¶<br>ä¸ºé˜²æ­¢æ¶æ„æˆ–é”™è¯¯è¾“å…¥ï¼Œæ¯æ¬¡æŸ¥è¯¢ç»“æŸåŽè¯·åˆ·æ–°é‡æŸ¥ã€‚', NULL, 'text'),
(16, 1, 'notice_1', 'æŸ¥è¯¢ç»“æžœä¸ºçœŸæ—¶', '<div style=&quot;width:350px; line-height: 2; text-align: left;&quot;><span style=&quot;font-size: 14px;color: #ffffff; font-family:Microsoft YaHei; &quot;>âˆš æ‚¨æŸ¥è¯¢çš„é˜²ä¼ªç æ˜¯ï¼š<span style=&quot;font-size: 14px;color: #FF0000; font-family:Microsoft YaHei; &quot;>{{bianhao}}</span><br>æ˜¯æœ¬å…¬å¸åŽŸè£…æ­£å“ã€‚<br>äº§å“åç§°ï¼š{{product}} <br>ä»£ç†å•†ï¼š{{zd1}}<br>ä»£ç†åŒºåŸŸï¼š{{zd2}} <br>æ„Ÿè°¢æ‚¨å¯¹æœ¬å…¬å¸çš„æ”¯æŒã€‚</div>', NULL, 'text'),
(17, 1, 'notice_2', 'æŸ¥è¯¢ç»“æžœä¸ºçœŸä¸”éžç¬¬ä¸€', '<div style=&quot;width:350px; line-height: 2; text-align: left;&quot;><span style=&quot;font-size: 14px;color: #ffffff; font-family:Microsoft YaHei; &quot;>âˆš æ‚¨æŸ¥è¯¢çš„é˜²ä¼ªç æ˜¯ï¼š<span style=&quot;font-size: 14px;color: #FF0000; font-family:Microsoft YaHei; &quot;>{{bianhao}}</span><br>æ˜¯æœ¬å…¬å¸åŽŸè£…æ­£å“ã€‚<br>äº§å“åç§°ï¼š{{product}} <br>ä»£ç†å•†ï¼š{{zd1}}<br>ä»£ç†åŒºåŸŸï¼š{{zd2}} <br>è¯¥é˜²ä¼ªç è¢«æŸ¥è¯¢è¿‡<span style=&quot;font-size: 14px;color: #FF0000; font-family:Microsoft YaHei; &quot;>{{hits}}</span>æ¬¡ï¼Œå¦‚ä¸æ˜¯æ‚¨æœ¬äººæŸ¥è¯¢ï¼Œè¯·è°¨é˜²å‡å†’ï¼</span></div>', NULL, 'text'),
(18, 1, 'notice_3', 'æŸ¥è¯¢ç»“æžœä¸ºç©ºæ—¶', '<div style=&quot;width:350px; line-height:2; text-align:left;&quot;><span style=&quot;font-size: 16px;color: #ffffff; font-family:Microsoft YaHei;&quot;>Ã— å¯¹ä¸èµ·ï¼Œæ‚¨è¾“å…¥çš„é˜²ä¼ªç {{bianhao}}ä¸å­˜åœ¨ï¼Œæ‚¨å¯èƒ½æ˜¯å‡å†’äº§å“çš„å—å®³è€…ï¼</span></div>', NULL, 'text'),
(19, 1, 'agents', 'ä»£ç†å•†ä¿¡æ¯é€šçŸ¥', 'æµ‹è¯•ä»£ç†å•†ç¼–å·ï¼šWS002  æ‰‹æœºå·ï¼š18170521585  QQï¼š270012912  å¾®ä¿¡å·ï¼šew80com <br>æ”¯æŒå¾®ä¿¡å·/æ‰‹æœºå·/ä»£ç†ç¼–å·/QQå·ç­‰ä»»æ„æŸ¥è¯¢<br>æŸ¥è¯¢ç•Œé¢å¯è®¢åˆ¶ã€‚', NULL, 'text'),
(20, 1, 'agent_1', 'æŸ¥è¯¢ç»“æžœä¸ºçœŸæ—¶', '<div style=&quot; width:640px; height:905px; position:relative; z-index:99999; background:url(themes/agent/skin/zs/bg.png); margin-top: -10px; margin-right: auto;margin-bottom: 0px;margin-left: -150px; line-height: 1.5;text-align: left;&quot;>\r\n\r\n  <div style=&quot;padding-top:300px;padding-left: 50px;padding-right: 50px;padding-bottom: 30px; line-height: 2;&quot; >\r\n  <span style=&quot;font-size: 26px;color: #925F25; font-family:Microsoft YaHei;&quot;>å…¹æŽˆæƒ</span>\r\n  <span style=&quot;font-size: 26px;color: #925F25; font-family:Microsoft YaHei; text-decoration: underline;&quot;> {{name}}</span>\r\n  <span style=&quot;font-size: 26px;color: #925F25; font-family:Microsoft YaHei;&quot;>ä¸ºæˆ‘å…¬å¸</span> \r\n  <span style=&quot;font-size: 26px;color: #925F25; font-family:Microsoft YaHei; text-decoration: underline;&quot;>{{product}}</span>\r\n  <span style=&quot;font-size: 26px;color: #925F25; font-family:Microsoft YaHei;&quot;>äº§å“</span>\r\n  <span style=&quot;font-size: 26px;color: #925F25; font-family:Microsoft YaHei; text-decoration: underline;&quot;>{{qudao}}</span>\r\n  <span style=&quot;font-size: 26px;color: #925F25; font-family:Microsoft YaHei;&quot;>,å…¨æƒä»£ç†äº§å“é”€å”®å’Œå”®åŽæœåŠ¡ã€‚</span>\r\n  <br>\r\n  <span style=&quot;font-size: 26px;color: #925F25; font-family:Microsoft YaHei;&quot;>æ‰‹æœºï¼š</span>\r\n  <span style=&quot;font-size: 26px;color: #925F25; font-family:Microsoft YaHei; &quot;>{{phone}} </span>\r\n  <span style=&quot;font-size: 26px;color: #925F25; font-family:Microsoft YaHei;&quot;>å¾®ä¿¡å·ï¼š</span>\r\n  <span style=&quot;font-size: 26px;color: #925F25; font-family:Microsoft YaHei; &quot;>{{weixin}}</span>\r\n  <br />\r\n  <span style=&quot;font-size: 26px;color: #925F25; font-family:Microsoft YaHei;&quot;>ç‰¹æ­¤æŽˆæƒ</span>\r\n  </div>\r\n  \r\n  <div style=&quot;padding-top:20px;padding-left: 50px;padding-right: 50px;font-size: 20px;color: #925F25; font-family:Microsoft YaHei;&quot;>æŽˆæƒæœŸé™ï¼š{{addtime}} è‡³ {{jietime}}</div>\r\n  <div style=&quot;padding-top:0px;padding-left: 50px;padding-right: 50px;font-size: 20px;color: #925F25; font-family:Microsoft YaHei;&quot;>æŽˆæƒç¼–å·ï¼š{{agentid}}</div>\r\n  <div style=&quot;padding-top:0px;padding-left: 50Px;padding-right: 50px;font-size: 20px;color: #925F25; font-family:Microsoft YaHei;&quot;>ç­¾å‘æ—¥æœŸï¼š{{addtime}}</div>\r\n</div>\r\n\r\n</div>', NULL, 'text'),
(21, 1, 'agent_2', 'æŸ¥è¯¢ç»“æžœä¸ºçœŸä¸”éžç¬¬ä¸€', '<div style=&quot; width:640px; height:905px; position:relative; z-index:99999; background:url(themes/agent/skin/zs/bg.png); margin-top: -10px; margin-right: auto;margin-bottom: 0px;margin-left: -150px; line-height: 1.5;text-align: left;&quot;>\r\n\r\n  <div style=&quot;padding-top:300px;padding-left: 50px;padding-right: 50px;padding-bottom: 30px; line-height: 2;&quot; >\r\n  <span style=&quot;font-size: 26px;color: #925F25; font-family:Microsoft YaHei;&quot;>å…¹æŽˆæƒ</span>\r\n  <span style=&quot;font-size: 26px;color: #925F25; font-family:Microsoft YaHei; text-decoration: underline;&quot;> {{name}}</span>\r\n  <span style=&quot;font-size: 26px;color: #925F25; font-family:Microsoft YaHei;&quot;>ä¸ºæˆ‘å…¬å¸</span> \r\n  <span style=&quot;font-size: 26px;color: #925F25; font-family:Microsoft YaHei; text-decoration: underline;&quot;>{{product}}</span>\r\n  <span style=&quot;font-size: 26px;color: #925F25; font-family:Microsoft YaHei;&quot;>äº§å“</span>\r\n  <span style=&quot;font-size: 26px;color: #925F25; font-family:Microsoft YaHei; text-decoration: underline;&quot;>{{qudao}}</span>\r\n  <span style=&quot;font-size: 26px;color: #925F25; font-family:Microsoft YaHei;&quot;>,å…¨æƒä»£ç†äº§å“é”€å”®å’Œå”®åŽæœåŠ¡ã€‚</span>\r\n  <br>\r\n  <span style=&quot;font-size: 26px;color: #925F25; font-family:Microsoft YaHei;&quot;>æ‰‹æœºï¼š</span>\r\n  <span style=&quot;font-size: 26px;color: #925F25; font-family:Microsoft YaHei; &quot;>{{phone}} </span>\r\n  <span style=&quot;font-size: 26px;color: #925F25; font-family:Microsoft YaHei;&quot;>å¾®ä¿¡å·ï¼š</span>\r\n  <span style=&quot;font-size: 26px;color: #925F25; font-family:Microsoft YaHei; &quot;>{{weixin}}</span>\r\n  <br />\r\n  <span style=&quot;font-size: 26px;color: #925F25; font-family:Microsoft YaHei;&quot;>ç‰¹æ­¤æŽˆæƒ</span>\r\n  </div>\r\n  \r\n  <div style=&quot;padding-top:20px;padding-left: 50px;padding-right: 50px;font-size: 20px;color: #925F25; font-family:Microsoft YaHei;&quot;>æŽˆæƒæœŸé™ï¼š{{addtime}} è‡³ {{jietime}}</div>\r\n  <div style=&quot;padding-top:0px;padding-left: 50px;padding-right: 50px;font-size: 20px;color: #925F25; font-family:Microsoft YaHei;&quot;>æŽˆæƒç¼–å·ï¼š{{agentid}}</div>\r\n  <div style=&quot;padding-top:0px;padding-left: 50Px;padding-right: 50px;font-size: 20px;color: #925F25; font-family:Microsoft YaHei;&quot;>ç­¾å‘æ—¥æœŸï¼š{{addtime}}</div>\r\n</div>\r\n\r\n</div>', NULL, 'text'),
(22, 1, 'agent_3', 'æŸ¥è¯¢ç»“æžœä¸ºç©ºæ—¶', '<div style=&quot;width:350px; height:100px; background:url(themes/default/skin/img/no.png); text-indent: 30px; background-repeat: no-repeat; background-position: left top;&quot;><span style=&quot;font-size: 16px;color: #ffffff; font-family:Microsoft YaHei; &quot;>æŠ±æ­‰ï¼Œç³»ç»Ÿæ²¡æœ‰æ‰¾åˆ°ç›¸åº”çš„ä»£ç†æŽˆæƒä¿¡æ¯ï¼</span></div>', NULL, 'text'),
(23, 1, 'list_num', 'åŽå°åˆ—è¡¨è®°å½•æ•°', '100', NULL, 'text');

-- --------------------------------------------------------

--
-- 表的结构 `tgs_hisagent`
--

CREATE TABLE IF NOT EXISTS `tgs_hisagent` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `keyword` varchar(50) DEFAULT NULL,
  `addtime` datetime DEFAULT '0000-00-00 00:00:00',
  `addip` varchar(40) DEFAULT NULL,
  `results` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- 转存表中的数据 `tgs_hisagent`
--


-- --------------------------------------------------------

--
-- 表的结构 `tgs_history`
--

CREATE TABLE IF NOT EXISTS `tgs_history` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `keyword` varchar(50) DEFAULT NULL,
  `addtime` datetime DEFAULT '0000-00-00 00:00:00',
  `addip` varchar(40) DEFAULT NULL,
  `results` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- 转存表中的数据 `tgs_history`
--

