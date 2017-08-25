/*
Navicat MySQL Data Transfer

Source Server         : 47.52.9.54_3306
Source Server Version : 50719
Source Host           : 47.52.9.54:3306
Source Database       : aso_db

Target Server Type    : MYSQL
Target Server Version : 50719
File Encoding         : 65001

Date: 2017-08-04 15:40:20
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
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of admin
-- ----------------------------
INSERT INTO `admin` VALUES ('1', 'admin', '3a03f7ac3b80f88b7eaf95253d5a73e8', null, '0', '1501820308', '14', '183.14.31.165', '1', '1');

-- ----------------------------
-- Table structure for config
-- ----------------------------
DROP TABLE IF EXISTS `config`;
CREATE TABLE `config` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` char(20) NOT NULL COMMENT '配置名称',
  `value` varchar(50) NOT NULL COMMENT '配置内容',
  `remarks` varchar(50) DEFAULT NULL,
  `note` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of config
-- ----------------------------
INSERT INTO `config` VALUES ('1', 'config_link', '2', '轮链设置', '(1是单站点，2是跨站点)');
INSERT INTO `config` VALUES ('2', 'config_baidu', '1', '百度搜索引擎', '(0是关闭，1是开启)');
INSERT INTO `config` VALUES ('3', 'config_360', '1', '360搜索引擎', '(0是关闭，1是开启)');

-- ----------------------------
-- Table structure for group
-- ----------------------------
DROP TABLE IF EXISTS `group`;
CREATE TABLE `group` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `group_name` varchar(15) DEFAULT NULL COMMENT '权限组名称',
  `group_list` text,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

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
  `type` tinyint(4) unsigned DEFAULT '1' COMMENT '内容素材类型',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=115 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of material
-- ----------------------------
INSERT INTO `material` VALUES ('8', '十六夜膳房', '书籍详情页', '1501493701', '1', '13');
INSERT INTO `material` VALUES ('9', '十六夜膳房 (豆瓣)', '书籍详情页', '1501493910', '1', '24');
INSERT INTO `material` VALUES ('10', '毛無', '书籍详情页', '1501493963', '1', '25');
INSERT INTO `material` VALUES ('11', '地狱膳房', '书籍详情页', '1501494008', '1', '26');
INSERT INTO `material` VALUES ('12', '2017-4', '书籍详情页', '1501494028', '1', '27');
INSERT INTO `material` VALUES ('13', '39.8元', '书籍详情页', '1501494072', '1', '28');
INSERT INTO `material` VALUES ('14', '9.3', '书籍详情页', '1501494153', '1', '14');
INSERT INTO `material` VALUES ('15', '278', '书籍详情页', '1501494204', '1', '16');
INSERT INTO `material` VALUES ('16', 'https://www.douban.com/accounts/register?reason=collect', '书籍详情页', '1501494253', '1', '43');
INSERT INTO `material` VALUES ('17', '这是一家开在忘川河边的料理店，名叫“地狱膳房”。<br />\r\n每天都有客人沿河而来， 带着一段段或满足或遗憾的记忆， 在孟婆这里留下他的故事用以交换， 重温一生当中最无法忘怀的味道。<br />\r\n走马灯亮，一世回望，嬉笑怒骂，贪恋嗔痴。<br />\r\n一餐终了，客人们将回忆卸下，悠然远去。<br />\r\n孔明灯升起，这一生流离终得慰藉。<br />\r\n如果，你的人生已到终点，最想吃的那道菜，又会是什么呢？<br />\r\n【编辑推荐】<br />\r\n这一碗人间烟火，可以知道你灵魂的去处。《十六夜膳房》采用独特的叙述方式，巧妙借用食物等元素，来剖析人生百态。 《十六夜膳房》巧妙借用民间耳熟能详的孟婆、忘川河等元素，以生死之命题搭建美食与情感之间的桥梁，将现代都市人的诸般情感体悟作为丰富食材，烹制出各类让人或感动、或失落、或悲戚、或愉悦的人间料理。 你我的错失、爱恨、遗憾、生死，都蕴于每一道食物之中，杂陈人生百味。它在试图还原一个热气腾腾的真相：只...', '书籍详情页', '1501494310', '1', '29');
INSERT INTO `material` VALUES ('18', '上海人', '书籍详情页', '1501494370', '1', '18');
INSERT INTO `material` VALUES ('19', '本科中山大学医学系', '书籍详情页', '1501494394', '1', '19');
INSERT INTO `material` VALUES ('20', '硕士早稻田大学医疗新闻科。<br />\r\n曾获得第十二届新概念作文大赛第一名。<br />\r\n现居东京研究妖怪、异文化与美学。<br />\r\n选材标新立异，风格细腻柔美。<br />\r\n比起故事，她认为美更重要。<br />\r\n2015年，成为StoryBook故事平台签约作者，<br />\r\n同年4月，开始发布“地狱膳房”系列故事。<br />', '书籍详情页', '1501494438', '1', '20');
INSERT INTO `material` VALUES ('21', '第一夜：雪菜毛豆肉丝面<br />\r\n第二夜：毛血旺<br />\r\n第三夜：速溶咖啡<br />\r\n第四夜：姜撞奶<br />\r\n第五夜：炸油墩子<br />\r\n第六夜：黄油啤酒<br />', '书籍详情页', '1501494613', '1', '21');
INSERT INTO `material` VALUES ('22', 'uploads/20170731\\2e2c371db86dd36136f689c6debcfde3.jpg', '书籍详情页', '1501495569', '1', '34');
INSERT INTO `material` VALUES ('23', '人活到极致，一定是素与简', '书籍详情页', '1501554476', '1', '13');
INSERT INTO `material` VALUES ('24', '今生为你，花开荼靡：陆小曼传', '书籍详情页', '1501554496', '1', '13');
INSERT INTO `material` VALUES ('25', '清爽', '书籍详情页', '1501554513', '1', '13');
INSERT INTO `material` VALUES ('26', '你可以跑得更快', '书籍详情页', '1501554526', '1', '13');
INSERT INTO `material` VALUES ('27', '生命向前', '书籍详情页', '1501554541', '1', '13');
INSERT INTO `material` VALUES ('28', '精神分析', '书籍详情页', '1501554555', '1', '13');
INSERT INTO `material` VALUES ('29', '极致引流', '书籍详情页', '1501554658', '1', '13');
INSERT INTO `material` VALUES ('30', '黎明破晓的世界', '书籍详情页', '1501554681', '1', '13');
INSERT INTO `material` VALUES ('34', '深度工作', '书籍详情页', '1501554748', '1', '13');
INSERT INTO `material` VALUES ('35', '斜杠创业家', '书籍详情页', '1501554772', '1', '13');
INSERT INTO `material` VALUES ('36', '胜利的法则', '书籍详情页', '1501554786', '1', '13');
INSERT INTO `material` VALUES ('37', '自恋时代', '书籍详情页', '1501554802', '1', '13');
INSERT INTO `material` VALUES ('38', '维多利亚时代的互联网', '书籍详情页', '1501554815', '1', '13');
INSERT INTO `material` VALUES ('39', '历史、物质性与遗产', '书籍详情页', '1501554826', '1', '13');
INSERT INTO `material` VALUES ('40', '乌托邦', '书籍详情页', '1501554851', '1', '13');
INSERT INTO `material` VALUES ('41', '关于豆瓣', '书籍详情页', '1501558641', '1', '47');
INSERT INTO `material` VALUES ('42', 'https://www.douban.com/about', '书籍详情页', '1501558652', '1', '33');
INSERT INTO `material` VALUES ('43', '在豆瓣工作', '书籍详情页', '1501558677', '1', '47');
INSERT INTO `material` VALUES ('44', 'https://www.douban.com/jobs', '书籍详情页', '1501558690', '1', '33');
INSERT INTO `material` VALUES ('45', '联系我们', '书籍详情页', '1501558729', '1', '47');
INSERT INTO `material` VALUES ('46', 'https://www.douban.com/about?topic=contactus', '书籍详情页', '1501558740', '1', '33');
INSERT INTO `material` VALUES ('47', '免责声明', '书籍详情页', '1501558759', '1', '47');
INSERT INTO `material` VALUES ('48', 'https://www.douban.com/about?policy=disclaimer', '书籍详情页', '1501558770', '1', '33');
INSERT INTO `material` VALUES ('49', '帮助中心', '书籍详情页', '1501558797', '1', '47');
INSERT INTO `material` VALUES ('50', 'https://help.douban.com/?app=book', '书籍详情页', '1501558807', '1', '33');
INSERT INTO `material` VALUES ('51', '图书馆合作', '书籍详情页', '1501558831', '1', '47');
INSERT INTO `material` VALUES ('52', 'https://book.douban.com/library_invitation', '书籍详情页', '1501558841', '1', '33');
INSERT INTO `material` VALUES ('53', '移动应用', '书籍详情页', '1501558867', '1', '47');
INSERT INTO `material` VALUES ('54', 'https://www.douban.com/doubanapp/', '书籍详情页', '1501558881', '1', '33');
INSERT INTO `material` VALUES ('55', '豆瓣广告', '书籍详情页', '1501558909', '1', '47');
INSERT INTO `material` VALUES ('56', 'https://www.douban.com/partner/', '书籍详情页', '1501558918', '1', '33');
INSERT INTO `material` VALUES ('57', '完美爱情标本店', '书籍详情页', '1501559800', '1', '30');
INSERT INTO `material` VALUES ('58', '重启人：终结篇', '书籍详情页', '1501559821', '1', '30');
INSERT INTO `material` VALUES ('59', '春天对樱桃树做的事', '书籍详情页', '1501559842', '1', '30');
INSERT INTO `material` VALUES ('60', '愿你迷路到我身旁', '书籍详情页', '1501568916', '1', '30');
INSERT INTO `material` VALUES ('61', '知更鸟女孩3', '书籍详情页', '1501568971', '1', '30');
INSERT INTO `material` VALUES ('62', '两个她的奇幻之旅', '书籍详情页', '1501568992', '1', '30');
INSERT INTO `material` VALUES ('63', '31.8元', '书籍详情页', '1501569168', '1', '15');
INSERT INTO `material` VALUES ('64', '京东商城', '书籍详情页', '1501569232', '1', '36');
INSERT INTO `material` VALUES ('65', '当当网', '书籍详情页', '1501569249', '1', '36');
INSERT INTO `material` VALUES ('66', '中国图书网', '书籍详情页', '1501569265', '1', '36');
INSERT INTO `material` VALUES ('67', '21世纪中文小说杰作', '书籍详情页', '1501569313', '1', '35');
INSERT INTO `material` VALUES ('68', '37°暖书单（二）', '书籍详情页', '1501569329', '1', '35');
INSERT INTO `material` VALUES ('69', '我的身体里有一个游荡的未来', '书籍详情页', '1501569351', '1', '35');
INSERT INTO `material` VALUES ('70', '这几本有点意思', '书籍详情页', '1501569369', '1', '35');
INSERT INTO `material` VALUES ('71', '购书单', '书籍详情页', '1501569382', '1', '35');
INSERT INTO `material` VALUES ('72', '夏童', '书籍详情页', '1501569418', '1', '31');
INSERT INTO `material` VALUES ('73', 'S', '书籍详情页', '1501569439', '1', '31');
INSERT INTO `material` VALUES ('74', '阳台观陌', '书籍详情页', '1501569461', '1', '31');
INSERT INTO `material` VALUES ('75', 'LOEYSAJI', '书籍详情页', '1501569517', '1', '31');
INSERT INTO `material` VALUES ('76', 'uploads/20170801\\8c9853e97a9785aeb102e635e9f24a33.jpg', '书籍详情页', '1501569593', '1', '34');
INSERT INTO `material` VALUES ('77', 'uploads/20170801\\46d187e3608e950e3b87e02bc70253d3.jpg', '书籍详情页', '1501569607', '1', '34');
INSERT INTO `material` VALUES ('78', '想读', '书籍详情页', '1501570009', '1', '37');
INSERT INTO `material` VALUES ('79', '创意独特，很生活，读起来舒服。 美中不足的是部分篇章无法塑造生动的人物，但这不是问题，其他部分能给予我更多我想要的。 期待作者下一本书。', '书籍详情页', '1501570028', '1', '37');
INSERT INTO `material` VALUES ('80', '想读\r\n', '书籍详情页', '1501570044', '1', '37');
INSERT INTO `material` VALUES ('81', '好书，值得一读', '书籍详情页', '1501570451', '1', '22');
INSERT INTO `material` VALUES ('82', '治愈', '书籍详情页', '1501570467', '1', '22');
INSERT INTO `material` VALUES ('83', '青春文学', '书籍详情页', '1501570483', '1', '22');
INSERT INTO `material` VALUES ('84', '故事', '书籍详情页', '1501570499', '1', '22');
INSERT INTO `material` VALUES ('85', '食物与记忆', '书籍详情页', '1501570542', '1', '22');
INSERT INTO `material` VALUES ('86', '美食与情感', '书籍详情页', '1501570555', '1', '22');
INSERT INTO `material` VALUES ('87', '人生', '书籍详情页', '1501570572', '1', '22');
INSERT INTO `material` VALUES ('88', '我想读这本书', '书籍详情页', '1501570601', '1', '22');
INSERT INTO `material` VALUES ('89', 'LOEYSAJI', '书籍详情页', '1501570902', '1', '48');
INSERT INTO `material` VALUES ('90', '猪猪很爱燕姿', '书籍详情页', '1501570915', '1', '48');
INSERT INTO `material` VALUES ('91', '神奇蘑蘑菇', '书籍详情页', '1501570927', '1', '48');
INSERT INTO `material` VALUES ('92', '冰冷的空气像火', '书籍详情页', '1501570940', '1', '48');
INSERT INTO `material` VALUES ('93', 'Ragnarök', '书籍详情页', '1501570954', '1', '48');
INSERT INTO `material` VALUES ('94', '138 应该最喜欢第八夜吧 因为强烈的共感 没有答案的烦恼 有的人说这本书温柔 但我感受到的只有孟婆有节制的温柔了 都是和死亡有关的故事 不是黑色也许是灰色吧 心若寒灰 人世间的各种痛楚 看的很难过 /阎王与白无常的互动觉着可爱 两人的关系 耐人寻味 前世的故事 也蛮好奇 ', '书籍详情页', '1501570984', '1', '45');
INSERT INTO `material` VALUES ('95', '读书使人得到一种优雅和风味，这就是读书的整个目的，而只有抱着这种目的的读书才可以叫做艺术。一人读书的目的并不是要“改进心智”，因为当他开始想要改进心智的时候，一切读书的乐趣便丧失净尽了。', '书籍详情页', '1501571002', '1', '45');
INSERT INTO `material` VALUES ('96', '被食物照顾的感觉真的太好，就像书里的人，一道菜就是一段人生轨迹，吃完了无遗憾离去。佩服作者这么年轻却能对这么多人生遗憾深有感触，但这样的人往往自己经历诸多，或许笔下某个人物有自己的影子。所以，希望你一切都好。', '书籍详情页', '1501571013', '1', '45');
INSERT INTO `material` VALUES ('97', '终于开始预售了，等了很久。一篇篇连载看下来，十分喜欢。美食在深夜总是那么地吸引人，更吸引人的是每个人的走马灯，那些曲折奇妙或是温暖的故事。常给我带来深夜的感慨。', '书籍详情页', '1501571023', '1', '45');
INSERT INTO `material` VALUES ('98', '其实个人最喜欢炸油墩子。', '书籍详情页', '1501571037', '1', '45');
INSERT INTO `material` VALUES ('99', 'CWW', '书籍详情页', '1501571371', '1', '31');
INSERT INTO `material` VALUES ('100', '小资爱情观扣一分，折衷主义扣一分，人物单薄扣一分', '书籍详情页', '1501571386', '1', '37');
INSERT INTO `material` VALUES ('101', 'uploads/20170801\\586ba8cc88e9448cdacfe89548d4e094.jpg', '书籍详情页', '1501571418', '1', '34');
INSERT INTO `material` VALUES ('106', 'uploads/20170801\\39330e3e0a0f1977fdceb1a36a23bdae.jpg', '书籍详情页', '1501571858', '1', '46');
INSERT INTO `material` VALUES ('107', 'uploads/20170801\\f27729ea8b873face90151a4502de497.jpg', '书籍详情页', '1501571872', '1', '46');
INSERT INTO `material` VALUES ('108', 'uploads/20170801\\e56510801224e4585d33b26e20d456b7.jpg', '书籍详情页', '1501571883', '1', '46');
INSERT INTO `material` VALUES ('109', '陈二灰', '书籍详情页', '1501571941', '1', '49');
INSERT INTO `material` VALUES ('110', '林亦霖', '书籍详情页', '1501571954', '1', '49');
INSERT INTO `material` VALUES ('111', '佩玖词', '书籍详情页', '1501571967', '1', '49');
INSERT INTO `material` VALUES ('112', '在看到这本书的书名之时，自己作为一个吃货的本性就暴露出来了，我想：《十六夜膳房》里面肯定是有很多好吃的，事实也正是如此。 首先，什么是膳呢？在《广雅》之中就有对于膳的解释：“膳，肉也。”膳的意思在古代其实就是肉，但膳房却不是指存放肉的房间。那么，什么又是膳房...                      ', '书籍详情页', '1501572034', '1', '32');
INSERT INTO `material` VALUES ('113', ' 文/小灰灰 “我希望自己可以自由的来去，却被困在紫禁城中一生，死后，我再也不要任何束缚，我要随风而逝，埋在地下，有什么好，还要被虫子咬。我会向孟婆多要几碗汤，把你们都忘了。”此语出自《步步惊心》中马尔泰若曦弥留之际所说的最后一句话，每个人在迎接死亡的时候，心...                      ', '书籍详情页', '1501572051', '1', '32');
INSERT INTO `material` VALUES ('114', '倘若你见过我，你会吃惊，“孟婆竟然长得这样！”倘若你没见我，你会好奇，“孟婆到底长什么样？” 三生石旁，忘川河畔，我就一直在哪里，不知道多少年，也不知道接待了多少路人。只知道，在这里，见到我的，都尊我为“孟婆”。世间的恩怨情仇，都难逃我的汤，喝下我汤的路人，...                      ', '书籍详情页', '1501572072', '1', '32');

-- ----------------------------
-- Table structure for nav
-- ----------------------------
DROP TABLE IF EXISTS `nav`;
CREATE TABLE `nav` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `pid` int(11) unsigned DEFAULT '0' COMMENT '父级ID',
  `name` varchar(50) DEFAULT NULL COMMENT '导航栏名称',
  `url` varchar(40) DEFAULT NULL COMMENT '路由',
  `status` tinyint(4) DEFAULT '1' COMMENT '状态1显示,-1不显示',
  `asc` tinyint(4) unsigned DEFAULT '0' COMMENT '排序',
  `css_img` varchar(50) DEFAULT NULL,
  `is_file` tinyint(4) DEFAULT '-1' COMMENT '内容是否是图片或者视频之类的',
  PRIMARY KEY (`id`),
  UNIQUE KEY `name_idx` (`name`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=54 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of nav
-- ----------------------------
INSERT INTO `nav` VALUES ('1', '0', '内容素材', 'index/material/index', '1', '0', 'icon-folder-close-alt', '-1');
INSERT INTO `nav` VALUES ('9', '0', '网站模板', 'index/template/index', '1', '0', 'icon-tasks', '-1');
INSERT INTO `nav` VALUES ('10', '9', 'PC端', 'index/template/webSide', '1', '0', null, '-1');
INSERT INTO `nav` VALUES ('11', '9', 'H5端(WAP)', 'index/template/webSide', '1', '0', null, '-1');
INSERT INTO `nav` VALUES ('12', '1', '自定义标签', 'index/material/customLabel', '1', '0', null, '-1');
INSERT INTO `nav` VALUES ('13', '1', 'article_title', 'index/material/title', '1', '0', null, '-1');
INSERT INTO `nav` VALUES ('14', '1', 'grade', 'index/material/title', '-1', '0', null, '-1');
INSERT INTO `nav` VALUES ('15', '1', 'sellprice', 'index/material/title', '-1', '0', null, '-1');
INSERT INTO `nav` VALUES ('16', '1', 'evaluate', 'index/material/title', '-1', '0', null, '-1');
INSERT INTO `nav` VALUES ('18', '1', 'writer_home', 'index/material/title', '-1', '0', null, '-1');
INSERT INTO `nav` VALUES ('19', '1', 'writer_school', 'index/material/title', '-1', '0', null, '-1');
INSERT INTO `nav` VALUES ('20', '1', 'writerIntroduction', 'index/material/title', '-1', '0', null, '-1');
INSERT INTO `nav` VALUES ('21', '1', 'catalogue', 'index/material/title', '-1', '0', null, '-1');
INSERT INTO `nav` VALUES ('22', '1', 'label', 'index/material/title', '-1', '0', null, '-1');
INSERT INTO `nav` VALUES ('24', '1', 'web_title', 'index/material/title', '1', '0', null, '-1');
INSERT INTO `nav` VALUES ('25', '1', 'writer', 'index/material/title', '-1', '0', null, '-1');
INSERT INTO `nav` VALUES ('26', '1', 'subhead', 'index/material/title', '-1', '0', null, '-1');
INSERT INTO `nav` VALUES ('27', '1', 'publicationDate', 'index/material/title', '-1', '0', null, '-1');
INSERT INTO `nav` VALUES ('28', '1', 'price', 'index/material/title', '-1', '0', null, '-1');
INSERT INTO `nav` VALUES ('29', '1', 'article_content', 'index/material/title', '-1', '0', null, '-1');
INSERT INTO `nav` VALUES ('30', '1', 'bookname', 'index/material/title', '-1', '0', null, '-1');
INSERT INTO `nav` VALUES ('31', '1', 'username', 'index/material/title', '-1', '0', null, '-1');
INSERT INTO `nav` VALUES ('32', '1', 'userheight', 'index/material/title', '-1', '0', null, '-1');
INSERT INTO `nav` VALUES ('33', '1', 'link', 'index/material/title', '-1', '0', null, '-1');
INSERT INTO `nav` VALUES ('34', '1', 'username_img', 'index/material/title', '-1', '0', null, '1');
INSERT INTO `nav` VALUES ('35', '1', 'recommendURL', 'index/material/title', '-1', '0', null, '-1');
INSERT INTO `nav` VALUES ('36', '1', 'bookshop', 'index/material/title', '-1', '0', null, '-1');
INSERT INTO `nav` VALUES ('37', '1', 'userevaluate', 'index/material/title', '-1', '0', null, '-1');
INSERT INTO `nav` VALUES ('38', '1', 'bookshopURL', 'index/material/title', '-1', '0', null, '-1');
INSERT INTO `nav` VALUES ('39', '1', 'takeNotes', 'index/material/title', '-1', '0', null, '-1');
INSERT INTO `nav` VALUES ('40', '1', 'takeEvaluate', 'index/material/title', '-1', '0', null, '-1');
INSERT INTO `nav` VALUES ('41', '1', 'addcar', 'index/material/title', '-1', '0', null, '-1');
INSERT INTO `nav` VALUES ('42', '1', 'share', 'index/material/title', '-1', '0', null, '-1');
INSERT INTO `nav` VALUES ('43', '1', 'recommend', 'index/material/title', '-1', '0', null, '-1');
INSERT INTO `nav` VALUES ('45', '1', 'usershort', 'index/material/title', '-1', '0', null, '-1');
INSERT INTO `nav` VALUES ('46', '1', 'user_img', 'index/material/title', '-1', '0', null, '1');
INSERT INTO `nav` VALUES ('47', '1', 'link_words', 'index/material/title', '-1', '0', null, '-1');
INSERT INTO `nav` VALUES ('48', '1', 'user_name', 'index/material/title', '-1', '0', null, '-1');
INSERT INTO `nav` VALUES ('49', '1', 'user', 'index/material/title', '-1', '0', null, '-1');
INSERT INTO `nav` VALUES ('50', '0', '服务器管理', 'index/server/index', '1', '0', 'icon-film', '-1');
INSERT INTO `nav` VALUES ('52', '50', '服务器列表', 'index/server/index', '1', '0', null, '-1');
INSERT INTO `nav` VALUES ('53', '0', '服务器配置', 'index/index/home', '1', '1', 'icon-briefcase', '-1');

-- ----------------------------
-- Table structure for request_log
-- ----------------------------
DROP TABLE IF EXISTS `request_log`;
CREATE TABLE `request_log` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `server_id` int(11) unsigned NOT NULL,
  `post_data` text,
  `request_time` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '请求时间',
  `template_id` int(11) unsigned NOT NULL DEFAULT '0' COMMENT '使用的模板',
  `type` tinyint(4) unsigned DEFAULT '1' COMMENT '请求类型',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=228 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of request_log
-- ----------------------------
INSERT INTO `request_log` VALUES ('212', '3', 'a:8:{s:3:\"dir\";a:5:{i:0;s:6:\"USqW8/\";i:1;s:6:\"rqyug/\";i:2;s:6:\"sUVHq/\";i:3;s:6:\"tDufZ/\";i:4;s:6:\"58eBD/\";}s:4:\"type\";s:1:\"1\";s:7:\"webType\";s:2:\"10\";s:2:\"ip\";s:11:\"47.52.8.223\";s:9:\"server_id\";i:3;s:12:\"request_time\";i:1501829993;s:11:\"template_id\";i:3;s:13:\"template_path\";s:32:\"20170731/watercress_1/index.html\";}', '1501829993', '3', '1');
INSERT INTO `request_log` VALUES ('213', '3', 'a:7:{s:4:\"type\";s:1:\"1\";s:7:\"webType\";s:2:\"10\";s:2:\"ip\";s:11:\"47.52.8.223\";s:9:\"server_id\";i:3;s:12:\"request_time\";i:1501829995;s:11:\"template_id\";i:3;s:13:\"template_path\";s:32:\"20170731/watercress_1/index.html\";}', '1501829995', '3', '1');
INSERT INTO `request_log` VALUES ('214', '3', 'a:7:{s:4:\"type\";s:1:\"1\";s:7:\"webType\";s:2:\"10\";s:2:\"ip\";s:11:\"47.52.8.223\";s:9:\"server_id\";i:3;s:12:\"request_time\";i:1501830039;s:11:\"template_id\";i:3;s:13:\"template_path\";s:32:\"20170731/watercress_1/index.html\";}', '1501830039', '3', '1');
INSERT INTO `request_log` VALUES ('215', '3', 'a:7:{s:4:\"type\";s:1:\"1\";s:7:\"webType\";s:2:\"10\";s:2:\"ip\";s:11:\"47.52.8.223\";s:9:\"server_id\";i:3;s:12:\"request_time\";i:1501830283;s:11:\"template_id\";i:3;s:13:\"template_path\";s:32:\"20170731/watercress_1/index.html\";}', '1501830283', '3', '1');
INSERT INTO `request_log` VALUES ('216', '3', 'a:7:{s:4:\"type\";s:1:\"1\";s:7:\"webType\";s:2:\"10\";s:2:\"ip\";s:11:\"47.52.8.223\";s:9:\"server_id\";i:3;s:12:\"request_time\";i:1501830502;s:11:\"template_id\";i:3;s:13:\"template_path\";s:32:\"20170731/watercress_1/index.html\";}', '1501830502', '3', '1');
INSERT INTO `request_log` VALUES ('217', '3', 'a:7:{s:4:\"type\";s:1:\"1\";s:7:\"webType\";s:2:\"10\";s:2:\"ip\";s:11:\"47.52.8.223\";s:9:\"server_id\";i:3;s:12:\"request_time\";i:1501830555;s:11:\"template_id\";i:3;s:13:\"template_path\";s:32:\"20170731/watercress_1/index.html\";}', '1501830555', '3', '1');
INSERT INTO `request_log` VALUES ('218', '3', 'a:7:{s:4:\"type\";s:1:\"1\";s:7:\"webType\";s:2:\"10\";s:2:\"ip\";s:11:\"47.52.8.223\";s:9:\"server_id\";i:3;s:12:\"request_time\";i:1501830556;s:11:\"template_id\";i:3;s:13:\"template_path\";s:32:\"20170731/watercress_1/index.html\";}', '1501830556', '3', '1');
INSERT INTO `request_log` VALUES ('219', '3', 'a:7:{s:4:\"type\";s:1:\"1\";s:7:\"webType\";s:2:\"10\";s:2:\"ip\";s:11:\"47.52.8.223\";s:9:\"server_id\";i:3;s:12:\"request_time\";i:1501830906;s:11:\"template_id\";i:3;s:13:\"template_path\";s:32:\"20170731/watercress_1/index.html\";}', '1501830906', '3', '1');
INSERT INTO `request_log` VALUES ('220', '3', 'a:7:{s:4:\"type\";s:1:\"1\";s:7:\"webType\";s:2:\"10\";s:2:\"ip\";s:11:\"47.52.8.223\";s:9:\"server_id\";i:3;s:12:\"request_time\";i:1501830907;s:11:\"template_id\";i:3;s:13:\"template_path\";s:32:\"20170731/watercress_1/index.html\";}', '1501830907', '3', '1');
INSERT INTO `request_log` VALUES ('221', '3', 'a:7:{s:4:\"type\";s:1:\"1\";s:7:\"webType\";s:2:\"10\";s:2:\"ip\";s:11:\"47.52.8.223\";s:9:\"server_id\";i:3;s:12:\"request_time\";i:1501830908;s:11:\"template_id\";i:3;s:13:\"template_path\";s:32:\"20170731/watercress_1/index.html\";}', '1501830908', '3', '1');
INSERT INTO `request_log` VALUES ('222', '3', 'a:7:{s:4:\"type\";s:1:\"1\";s:7:\"webType\";s:2:\"10\";s:2:\"ip\";s:11:\"47.52.8.223\";s:9:\"server_id\";i:3;s:12:\"request_time\";i:1501830909;s:11:\"template_id\";i:3;s:13:\"template_path\";s:32:\"20170731/watercress_1/index.html\";}', '1501830909', '3', '1');
INSERT INTO `request_log` VALUES ('223', '3', 'a:7:{s:4:\"type\";s:1:\"1\";s:7:\"webType\";s:2:\"10\";s:2:\"ip\";s:11:\"47.52.8.223\";s:9:\"server_id\";i:3;s:12:\"request_time\";i:1501831330;s:11:\"template_id\";i:3;s:13:\"template_path\";s:32:\"20170731/watercress_1/index.html\";}', '1501831330', '3', '1');
INSERT INTO `request_log` VALUES ('224', '3', 'a:7:{s:4:\"type\";s:1:\"1\";s:7:\"webType\";s:2:\"10\";s:2:\"ip\";s:11:\"47.52.8.223\";s:9:\"server_id\";i:3;s:12:\"request_time\";i:1501831330;s:11:\"template_id\";i:3;s:13:\"template_path\";s:32:\"20170731/watercress_1/index.html\";}', '1501831330', '3', '1');
INSERT INTO `request_log` VALUES ('225', '3', 'a:7:{s:4:\"type\";s:1:\"1\";s:7:\"webType\";s:2:\"10\";s:2:\"ip\";s:11:\"47.52.8.223\";s:9:\"server_id\";i:3;s:12:\"request_time\";i:1501831508;s:11:\"template_id\";i:3;s:13:\"template_path\";s:32:\"20170731/watercress_1/index.html\";}', '1501831508', '3', '1');
INSERT INTO `request_log` VALUES ('226', '3', 'a:7:{s:4:\"type\";s:1:\"1\";s:7:\"webType\";s:2:\"10\";s:2:\"ip\";s:11:\"47.52.8.223\";s:9:\"server_id\";i:3;s:12:\"request_time\";i:1501832066;s:11:\"template_id\";i:3;s:13:\"template_path\";s:32:\"20170731/watercress_1/index.html\";}', '1501832066', '3', '1');
INSERT INTO `request_log` VALUES ('227', '3', 'a:7:{s:4:\"type\";s:1:\"1\";s:7:\"webType\";s:2:\"10\";s:2:\"ip\";s:11:\"47.52.8.223\";s:9:\"server_id\";i:3;s:12:\"request_time\";i:1501832268;s:11:\"template_id\";i:3;s:13:\"template_path\";s:32:\"20170731/watercress_1/index.html\";}', '1501832268', '3', '1');

-- ----------------------------
-- Table structure for server
-- ----------------------------
DROP TABLE IF EXISTS `server`;
CREATE TABLE `server` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `server_name` varchar(25) DEFAULT NULL COMMENT '服务器名称',
  `server_ip` char(15) DEFAULT NULL COMMENT '服务器IP',
  `server_host` varchar(50) DEFAULT NULL COMMENT '服务器域名',
  `request_num` tinyint(4) unsigned DEFAULT '0' COMMENT '请求次数',
  `request_time` int(11) unsigned DEFAULT '0' COMMENT '最后次请求时间',
  `addtime` int(11) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of server
-- ----------------------------
INSERT INTO `server` VALUES ('3', 'aso1', '47.52.8.223', 'http://test223.findourlove.com/', '16', '1501832268', '1501656608');

-- ----------------------------
-- Table structure for server_url
-- ----------------------------
DROP TABLE IF EXISTS `server_url`;
CREATE TABLE `server_url` (
  `id` int(11) NOT NULL,
  `url` text NOT NULL,
  `type` tinyint(2) unsigned NOT NULL DEFAULT '1' COMMENT '1是客户端生成 2是主服务器生成',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of server_url
-- ----------------------------
INSERT INTO `server_url` VALUES ('1', 'http://test223.findourlove.com/USqW8/', '1');
INSERT INTO `server_url` VALUES ('2', 'http://test223.findourlove.com/rqyug/', '1');
INSERT INTO `server_url` VALUES ('3', 'http://test223.findourlove.com/sUVHq/', '1');
INSERT INTO `server_url` VALUES ('4', 'http://test223.findourlove.com/tDufZ/', '1');
INSERT INTO `server_url` VALUES ('5', 'http://test223.findourlove.com/58eBD/', '1');
INSERT INTO `server_url` VALUES ('7', 'http://test223.findourlove.com/link1_7uUXn/', '2');
INSERT INTO `server_url` VALUES ('8', 'http://test223.findourlove.com/link2_MLjqG/', '2');
INSERT INTO `server_url` VALUES ('9', 'http://test223.findourlove.com/link3_CbhbL/', '2');
INSERT INTO `server_url` VALUES ('10', 'http://test223.findourlove.com/link4_K7MhU/', '2');
INSERT INTO `server_url` VALUES ('11', 'http://test223.findourlove.com/link5_3DDqR/', '2');
INSERT INTO `server_url` VALUES ('12', 'http://test223.findourlove.com/link6_Z0aXD/', '2');
INSERT INTO `server_url` VALUES ('13', 'http://test223.findourlove.com/link7_PD4lk/', '2');
INSERT INTO `server_url` VALUES ('14', 'http://test223.findourlove.com/link8_61HNI/', '2');
INSERT INTO `server_url` VALUES ('16', 'http://test223.findourlove.com/link1_krrck/', '2');
INSERT INTO `server_url` VALUES ('17', 'http://test223.findourlove.com/link2_bua42/', '2');
INSERT INTO `server_url` VALUES ('18', 'http://test223.findourlove.com/link3_wlnfj/', '2');
INSERT INTO `server_url` VALUES ('19', 'http://test223.findourlove.com/link4_7Pu7F/', '2');
INSERT INTO `server_url` VALUES ('20', 'http://test223.findourlove.com/link5_EGZyp/', '2');
INSERT INTO `server_url` VALUES ('21', 'http://test223.findourlove.com/link6_FsI9G/', '2');
INSERT INTO `server_url` VALUES ('22', 'http://test223.findourlove.com/link7_xWIKk/', '2');
INSERT INTO `server_url` VALUES ('23', 'http://test223.findourlove.com/link8_BsHEz/', '2');
INSERT INTO `server_url` VALUES ('25', 'http://test223.findourlove.com/link1_QL9yE/', '2');
INSERT INTO `server_url` VALUES ('26', 'http://test223.findourlove.com/link2_zr5i1/', '2');
INSERT INTO `server_url` VALUES ('27', 'http://test223.findourlove.com/link3_Kb54w/', '2');
INSERT INTO `server_url` VALUES ('28', 'http://test223.findourlove.com/link4_Kd6Un/', '2');
INSERT INTO `server_url` VALUES ('29', 'http://test223.findourlove.com/link5_EFNPQ/', '2');
INSERT INTO `server_url` VALUES ('30', 'http://test223.findourlove.com/link6_QSYYw/', '2');
INSERT INTO `server_url` VALUES ('31', 'http://test223.findourlove.com/link7_cNPj2/', '2');
INSERT INTO `server_url` VALUES ('32', 'http://test223.findourlove.com/link8_ESzyx/', '2');
INSERT INTO `server_url` VALUES ('34', 'http://test223.findourlove.com/link1_bEcCs/', '2');
INSERT INTO `server_url` VALUES ('35', 'http://test223.findourlove.com/link2_clu3I/', '2');
INSERT INTO `server_url` VALUES ('36', 'http://test223.findourlove.com/link3_9v9BF/', '2');
INSERT INTO `server_url` VALUES ('37', 'http://test223.findourlove.com/link4_aDRB6/', '2');
INSERT INTO `server_url` VALUES ('38', 'http://test223.findourlove.com/link5_iDlPz/', '2');
INSERT INTO `server_url` VALUES ('39', 'http://test223.findourlove.com/link6_q3YQb/', '2');
INSERT INTO `server_url` VALUES ('40', 'http://test223.findourlove.com/link7_L2IQ8/', '2');
INSERT INTO `server_url` VALUES ('41', 'http://test223.findourlove.com/link8_gi6Vu/', '2');
INSERT INTO `server_url` VALUES ('43', 'http://test223.findourlove.com/link1_ai9ug/', '2');
INSERT INTO `server_url` VALUES ('44', 'http://test223.findourlove.com/link2_chEzb/', '2');
INSERT INTO `server_url` VALUES ('45', 'http://test223.findourlove.com/link3_EnmMH/', '2');
INSERT INTO `server_url` VALUES ('46', 'http://test223.findourlove.com/link4_XSpYk/', '2');
INSERT INTO `server_url` VALUES ('47', 'http://test223.findourlove.com/link5_32fpA/', '2');
INSERT INTO `server_url` VALUES ('48', 'http://test223.findourlove.com/link6_8yDEd/', '2');
INSERT INTO `server_url` VALUES ('49', 'http://test223.findourlove.com/link7_emYQ6/', '2');
INSERT INTO `server_url` VALUES ('50', 'http://test223.findourlove.com/link8_FYEFC/', '2');
INSERT INTO `server_url` VALUES ('52', 'http://test223.findourlove.com/link1_Nk34x/', '2');
INSERT INTO `server_url` VALUES ('53', 'http://test223.findourlove.com/link2_2k1RA/', '2');
INSERT INTO `server_url` VALUES ('54', 'http://test223.findourlove.com/link3_3J5E9/', '2');
INSERT INTO `server_url` VALUES ('55', 'http://test223.findourlove.com/link4_4nVXD/', '2');
INSERT INTO `server_url` VALUES ('56', 'http://test223.findourlove.com/link5_xB7p8/', '2');
INSERT INTO `server_url` VALUES ('57', 'http://test223.findourlove.com/link6_Vdatb/', '2');
INSERT INTO `server_url` VALUES ('58', 'http://test223.findourlove.com/link7_1d6mR/', '2');
INSERT INTO `server_url` VALUES ('59', 'http://test223.findourlove.com/link8_sMQmR/', '2');
INSERT INTO `server_url` VALUES ('61', 'http://test223.findourlove.com/link1_9H0KE/', '2');
INSERT INTO `server_url` VALUES ('62', 'http://test223.findourlove.com/link2_ya4qC/', '2');
INSERT INTO `server_url` VALUES ('63', 'http://test223.findourlove.com/link3_eiQEx/', '2');
INSERT INTO `server_url` VALUES ('64', 'http://test223.findourlove.com/link4_icer0/', '2');
INSERT INTO `server_url` VALUES ('65', 'http://test223.findourlove.com/link5_5sYXF/', '2');
INSERT INTO `server_url` VALUES ('66', 'http://test223.findourlove.com/link6_MhKdi/', '2');
INSERT INTO `server_url` VALUES ('67', 'http://test223.findourlove.com/link7_qGYnb/', '2');
INSERT INTO `server_url` VALUES ('68', 'http://test223.findourlove.com/link8_JyfJY/', '2');
INSERT INTO `server_url` VALUES ('70', 'http://test223.findourlove.com/link1_QjNcE/', '2');
INSERT INTO `server_url` VALUES ('71', 'http://test223.findourlove.com/link2_H0BCS/', '2');
INSERT INTO `server_url` VALUES ('72', 'http://test223.findourlove.com/link3_CsBAH/', '2');
INSERT INTO `server_url` VALUES ('73', 'http://test223.findourlove.com/link4_Fgf42/', '2');
INSERT INTO `server_url` VALUES ('74', 'http://test223.findourlove.com/link5_TLvVn/', '2');
INSERT INTO `server_url` VALUES ('75', 'http://test223.findourlove.com/link6_bjqif/', '2');
INSERT INTO `server_url` VALUES ('76', 'http://test223.findourlove.com/link7_WZRaK/', '2');
INSERT INTO `server_url` VALUES ('77', 'http://test223.findourlove.com/link8_ydGxn/', '2');
INSERT INTO `server_url` VALUES ('79', 'http://test223.findourlove.com/link1_mSYlV/', '2');
INSERT INTO `server_url` VALUES ('80', 'http://test223.findourlove.com/link2_CwLni/', '2');
INSERT INTO `server_url` VALUES ('81', 'http://test223.findourlove.com/link3_gyS0C/', '2');
INSERT INTO `server_url` VALUES ('82', 'http://test223.findourlove.com/link4_6DJMQ/', '2');
INSERT INTO `server_url` VALUES ('83', 'http://test223.findourlove.com/link5_8EN6m/', '2');
INSERT INTO `server_url` VALUES ('84', 'http://test223.findourlove.com/link6_cKtp7/', '2');
INSERT INTO `server_url` VALUES ('85', 'http://test223.findourlove.com/link7_QRnDg/', '2');
INSERT INTO `server_url` VALUES ('86', 'http://test223.findourlove.com/link8_22RwE/', '2');
INSERT INTO `server_url` VALUES ('88', 'http://test223.findourlove.com/link1_HSi6C/', '2');
INSERT INTO `server_url` VALUES ('89', 'http://test223.findourlove.com/link2_ndb5I/', '2');
INSERT INTO `server_url` VALUES ('90', 'http://test223.findourlove.com/link3_MX9jb/', '2');
INSERT INTO `server_url` VALUES ('91', 'http://test223.findourlove.com/link4_hE5Ky/', '2');
INSERT INTO `server_url` VALUES ('92', 'http://test223.findourlove.com/link5_nXLIm/', '2');
INSERT INTO `server_url` VALUES ('93', 'http://test223.findourlove.com/link6_1YVkt/', '2');
INSERT INTO `server_url` VALUES ('94', 'http://test223.findourlove.com/link7_hBR1i/', '2');
INSERT INTO `server_url` VALUES ('95', 'http://test223.findourlove.com/link8_JM7yX/', '2');
INSERT INTO `server_url` VALUES ('97', 'http://test223.findourlove.com/link1_uwbV3/', '2');
INSERT INTO `server_url` VALUES ('98', 'http://test223.findourlove.com/link2_StbTq/', '2');
INSERT INTO `server_url` VALUES ('99', 'http://test223.findourlove.com/link3_CnFb5/', '2');
INSERT INTO `server_url` VALUES ('100', 'http://test223.findourlove.com/link4_fwCMt/', '2');
INSERT INTO `server_url` VALUES ('101', 'http://test223.findourlove.com/link5_SywSI/', '2');
INSERT INTO `server_url` VALUES ('102', 'http://test223.findourlove.com/link6_ZUtYY/', '2');
INSERT INTO `server_url` VALUES ('103', 'http://test223.findourlove.com/link7_GNBYq/', '2');
INSERT INTO `server_url` VALUES ('104', 'http://test223.findourlove.com/link8_6PmhQ/', '2');
INSERT INTO `server_url` VALUES ('106', 'http://test223.findourlove.com/link1_m5pwX/', '2');
INSERT INTO `server_url` VALUES ('107', 'http://test223.findourlove.com/link2_FfDYL/', '2');
INSERT INTO `server_url` VALUES ('108', 'http://test223.findourlove.com/link3_xhHmQ/', '2');
INSERT INTO `server_url` VALUES ('109', 'http://test223.findourlove.com/link4_8VK3L/', '2');
INSERT INTO `server_url` VALUES ('110', 'http://test223.findourlove.com/link5_1BeH8/', '2');
INSERT INTO `server_url` VALUES ('111', 'http://test223.findourlove.com/link6_qG2ka/', '2');
INSERT INTO `server_url` VALUES ('112', 'http://test223.findourlove.com/link7_PDACY/', '2');
INSERT INTO `server_url` VALUES ('113', 'http://test223.findourlove.com/link8_QjrR1/', '2');
INSERT INTO `server_url` VALUES ('115', 'http://test223.findourlove.com/link1_Kj7aD/', '2');
INSERT INTO `server_url` VALUES ('116', 'http://test223.findourlove.com/link2_R3N4x/', '2');
INSERT INTO `server_url` VALUES ('117', 'http://test223.findourlove.com/link3_8xIlE/', '2');
INSERT INTO `server_url` VALUES ('118', 'http://test223.findourlove.com/link4_uzJVT/', '2');
INSERT INTO `server_url` VALUES ('119', 'http://test223.findourlove.com/link5_uHdyH/', '2');
INSERT INTO `server_url` VALUES ('120', 'http://test223.findourlove.com/link6_4bnpg/', '2');
INSERT INTO `server_url` VALUES ('121', 'http://test223.findourlove.com/link7_jxRGR/', '2');
INSERT INTO `server_url` VALUES ('122', 'http://test223.findourlove.com/link8_5zW0b/', '2');
INSERT INTO `server_url` VALUES ('124', 'http://test223.findourlove.com/link1_DqBjT/', '2');
INSERT INTO `server_url` VALUES ('125', 'http://test223.findourlove.com/link2_BWcyA/', '2');
INSERT INTO `server_url` VALUES ('126', 'http://test223.findourlove.com/link3_g4aiE/', '2');
INSERT INTO `server_url` VALUES ('127', 'http://test223.findourlove.com/link4_r7cUb/', '2');
INSERT INTO `server_url` VALUES ('128', 'http://test223.findourlove.com/link5_KDMrA/', '2');
INSERT INTO `server_url` VALUES ('129', 'http://test223.findourlove.com/link6_CzYxt/', '2');
INSERT INTO `server_url` VALUES ('130', 'http://test223.findourlove.com/link7_Afird/', '2');
INSERT INTO `server_url` VALUES ('131', 'http://test223.findourlove.com/link8_1Q5xz/', '2');
INSERT INTO `server_url` VALUES ('133', 'http://test223.findourlove.com/link1_sfq2i/', '2');
INSERT INTO `server_url` VALUES ('134', 'http://test223.findourlove.com/link2_zTYqQ/', '2');
INSERT INTO `server_url` VALUES ('135', 'http://test223.findourlove.com/link3_XbT6Q/', '2');
INSERT INTO `server_url` VALUES ('136', 'http://test223.findourlove.com/link4_qYrMv/', '2');
INSERT INTO `server_url` VALUES ('137', 'http://test223.findourlove.com/link5_M9SYq/', '2');
INSERT INTO `server_url` VALUES ('138', 'http://test223.findourlove.com/link6_BnGnE/', '2');
INSERT INTO `server_url` VALUES ('139', 'http://test223.findourlove.com/link7_UBmEE/', '2');
INSERT INTO `server_url` VALUES ('140', 'http://test223.findourlove.com/link8_bnfDI/', '2');
INSERT INTO `server_url` VALUES ('142', 'http://test223.findourlove.com/link1_weUSL/', '2');
INSERT INTO `server_url` VALUES ('143', 'http://test223.findourlove.com/link2_NI7nP/', '2');
INSERT INTO `server_url` VALUES ('144', 'http://test223.findourlove.com/link3_BudTH/', '2');
INSERT INTO `server_url` VALUES ('145', 'http://test223.findourlove.com/link4_zUHsY/', '2');
INSERT INTO `server_url` VALUES ('146', 'http://test223.findourlove.com/link5_7JbiA/', '2');
INSERT INTO `server_url` VALUES ('147', 'http://test223.findourlove.com/link6_EZTYA/', '2');
INSERT INTO `server_url` VALUES ('148', 'http://test223.findourlove.com/link7_4EfFP/', '2');
INSERT INTO `server_url` VALUES ('149', 'http://test223.findourlove.com/link8_lzraS/', '2');

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
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of template
-- ----------------------------
INSERT INTO `template` VALUES ('3', '豆瓣书籍', '20170731/watercress_1/index.html', '10', '书籍详情页', '1', '1501234436');

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
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of web_side
-- ----------------------------
INSERT INTO `web_side` VALUES ('1', '3', '1', '1');
