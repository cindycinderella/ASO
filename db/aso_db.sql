/*
Navicat MySQL Data Transfer

Source Server         : localhost_3306
Source Server Version : 50717
Source Host           : localhost:3306
Source Database       : aso_db

Target Server Type    : MYSQL
Target Server Version : 50717
File Encoding         : 65001

Date: 2017-08-03 21:24:37
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
INSERT INTO `admin` VALUES ('1', 'admin', '3a03f7ac3b80f88b7eaf95253d5a73e8', null, '0', '1501741748', '12', '0.0.0.0', '1', '1');

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
  `type` tinyint(4) unsigned DEFAULT '1' COMMENT '内容素材类型',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=115 DEFAULT CHARSET=utf8;

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
) ENGINE=InnoDB AUTO_INCREMENT=53 DEFAULT CHARSET=utf8;

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
) ENGINE=InnoDB AUTO_INCREMENT=88 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of request_log
-- ----------------------------
INSERT INTO `request_log` VALUES ('1', '3', 'a:8:{s:4:\"type\";s:1:\"1\";s:7:\"webType\";s:2:\"10\";s:2:\"ip\";s:11:\"47.52.8.223\";s:9:\"server_id\";i:3;s:12:\"request_time\";i:1501667574;s:11:\"template_id\";i:3;s:13:\"template_path\";s:32:\"20170731/watercress_1/index.html\";s:4:\"path\";s:43:\"template\\20170731/watercress_1/index_1.html\";}', '1501667574', '3', '1');
INSERT INTO `request_log` VALUES ('2', '3', 'a:8:{s:4:\"type\";s:1:\"1\";s:7:\"webType\";s:2:\"10\";s:2:\"ip\";s:11:\"47.52.8.223\";s:9:\"server_id\";i:3;s:12:\"request_time\";i:1501667613;s:11:\"template_id\";i:3;s:13:\"template_path\";s:32:\"20170731/watercress_1/index.html\";s:4:\"path\";s:43:\"template\\20170731/watercress_1/index_2.html\";}', '1501667613', '3', '1');
INSERT INTO `request_log` VALUES ('3', '3', 'a:9:{s:3:\"dir\";a:5:{i:0;s:5:\"fXAkz\";i:1;s:5:\"KUqIM\";i:2;s:5:\"ncscb\";i:3;s:5:\"yIC2z\";i:4;s:5:\"b8ftR\";}s:4:\"type\";s:1:\"1\";s:7:\"webType\";s:2:\"10\";s:2:\"ip\";s:11:\"47.52.8.223\";s:9:\"server_id\";i:3;s:12:\"request_time\";i:1501757673;s:11:\"template_id\";i:3;s:13:\"template_path\";s:32:\"20170731/watercress_1/index.html\";s:4:\"path\";s:43:\"template\\20170731/watercress_1/index_3.html\";}', '1501757673', '3', '1');
INSERT INTO `request_log` VALUES ('4', '3', 'a:8:{s:3:\"dir\";a:5:{i:0;s:5:\"TdtV2\";i:1;s:5:\"lSeEp\";i:2;s:5:\"NiYi8\";i:3;s:5:\"lvJ1g\";i:4;s:5:\"VnSeh\";}s:4:\"type\";s:1:\"1\";s:7:\"webType\";s:2:\"10\";s:2:\"ip\";s:11:\"47.52.8.223\";s:9:\"server_id\";i:3;s:12:\"request_time\";i:1501758230;s:11:\"template_id\";i:3;s:13:\"template_path\";s:32:\"20170731/watercress_1/index.html\";}', '1501758230', '3', '1');
INSERT INTO `request_log` VALUES ('5', '3', 'a:8:{s:3:\"dir\";a:5:{i:0;s:5:\"d2vYZ\";i:1;s:5:\"09Wsd\";i:2;s:5:\"gQ8pX\";i:3;s:5:\"K5p6K\";i:4;s:5:\"x48gc\";}s:4:\"type\";s:1:\"1\";s:7:\"webType\";s:2:\"10\";s:2:\"ip\";s:11:\"47.52.8.223\";s:9:\"server_id\";i:3;s:12:\"request_time\";i:1501758260;s:11:\"template_id\";i:3;s:13:\"template_path\";s:32:\"20170731/watercress_1/index.html\";}', '1501758260', '3', '1');
INSERT INTO `request_log` VALUES ('6', '3', 'a:8:{s:3:\"dir\";a:5:{i:0;s:5:\"kympd\";i:1;s:5:\"Nmhph\";i:2;s:5:\"yIdX2\";i:3;s:5:\"kzBqU\";i:4;s:5:\"4zTpn\";}s:4:\"type\";s:1:\"1\";s:7:\"webType\";s:2:\"10\";s:2:\"ip\";s:11:\"47.52.8.223\";s:9:\"server_id\";i:3;s:12:\"request_time\";i:1501758262;s:11:\"template_id\";i:3;s:13:\"template_path\";s:32:\"20170731/watercress_1/index.html\";}', '1501758262', '3', '1');
INSERT INTO `request_log` VALUES ('7', '3', 'a:8:{s:3:\"dir\";a:5:{i:0;s:5:\"Xng8Y\";i:1;s:5:\"GQvsF\";i:2;s:5:\"2arRe\";i:3;s:5:\"AX5HG\";i:4;s:5:\"YUfrC\";}s:4:\"type\";s:1:\"1\";s:7:\"webType\";s:2:\"10\";s:2:\"ip\";s:11:\"47.52.8.223\";s:9:\"server_id\";i:3;s:12:\"request_time\";i:1501758262;s:11:\"template_id\";i:3;s:13:\"template_path\";s:32:\"20170731/watercress_1/index.html\";}', '1501758262', '3', '1');
INSERT INTO `request_log` VALUES ('8', '3', 'a:8:{s:3:\"dir\";a:5:{i:0;s:5:\"s3Lze\";i:1;s:5:\"EtQdg\";i:2;s:5:\"jKUTZ\";i:3;s:5:\"5Wcxx\";i:4;s:5:\"53bWC\";}s:4:\"type\";s:1:\"1\";s:7:\"webType\";s:2:\"10\";s:2:\"ip\";s:11:\"47.52.8.223\";s:9:\"server_id\";i:3;s:12:\"request_time\";i:1501758263;s:11:\"template_id\";i:3;s:13:\"template_path\";s:32:\"20170731/watercress_1/index.html\";}', '1501758263', '3', '1');
INSERT INTO `request_log` VALUES ('9', '3', 'a:8:{s:3:\"dir\";a:5:{i:0;s:5:\"jnaRU\";i:1;s:5:\"eCWRq\";i:2;s:5:\"LIrau\";i:3;s:5:\"jircq\";i:4;s:5:\"Z7CA9\";}s:4:\"type\";s:1:\"1\";s:7:\"webType\";s:2:\"10\";s:2:\"ip\";s:11:\"47.52.8.223\";s:9:\"server_id\";i:3;s:12:\"request_time\";i:1501758264;s:11:\"template_id\";i:3;s:13:\"template_path\";s:32:\"20170731/watercress_1/index.html\";}', '1501758264', '3', '1');
INSERT INTO `request_log` VALUES ('10', '3', 'a:8:{s:3:\"dir\";a:5:{i:0;s:5:\"UpUSV\";i:1;s:5:\"E8ztZ\";i:2;s:5:\"7Dbne\";i:3;s:5:\"5Y5Sr\";i:4;s:5:\"LqwHg\";}s:4:\"type\";s:1:\"1\";s:7:\"webType\";s:2:\"10\";s:2:\"ip\";s:11:\"47.52.8.223\";s:9:\"server_id\";i:3;s:12:\"request_time\";i:1501758265;s:11:\"template_id\";i:3;s:13:\"template_path\";s:32:\"20170731/watercress_1/index.html\";}', '1501758265', '3', '1');
INSERT INTO `request_log` VALUES ('11', '3', 'a:8:{s:3:\"dir\";a:5:{i:0;s:5:\"nFhID\";i:1;s:5:\"tMQE7\";i:2;s:5:\"Irncu\";i:3;s:5:\"DPkQz\";i:4;s:5:\"rcCSe\";}s:4:\"type\";s:1:\"1\";s:7:\"webType\";s:2:\"10\";s:2:\"ip\";s:11:\"47.52.8.223\";s:9:\"server_id\";i:3;s:12:\"request_time\";i:1501758271;s:11:\"template_id\";i:3;s:13:\"template_path\";s:32:\"20170731/watercress_1/index.html\";}', '1501758271', '3', '1');
INSERT INTO `request_log` VALUES ('12', '3', 'a:8:{s:3:\"dir\";a:5:{i:0;s:5:\"J4f3M\";i:1;s:5:\"qFVH4\";i:2;s:5:\"8dhMk\";i:3;s:5:\"HVY1F\";i:4;s:5:\"J5Ywc\";}s:4:\"type\";s:1:\"1\";s:7:\"webType\";s:2:\"10\";s:2:\"ip\";s:11:\"47.52.8.223\";s:9:\"server_id\";i:3;s:12:\"request_time\";i:1501758271;s:11:\"template_id\";i:3;s:13:\"template_path\";s:32:\"20170731/watercress_1/index.html\";}', '1501758271', '3', '1');
INSERT INTO `request_log` VALUES ('13', '3', 'a:8:{s:3:\"dir\";a:5:{i:0;s:5:\"grH8p\";i:1;s:5:\"cnMQf\";i:2;s:5:\"kUt5v\";i:3;s:5:\"RsAeR\";i:4;s:5:\"fhyEc\";}s:4:\"type\";s:1:\"1\";s:7:\"webType\";s:2:\"10\";s:2:\"ip\";s:11:\"47.52.8.223\";s:9:\"server_id\";i:3;s:12:\"request_time\";i:1501758353;s:11:\"template_id\";i:3;s:13:\"template_path\";s:32:\"20170731/watercress_1/index.html\";}', '1501758353', '3', '1');
INSERT INTO `request_log` VALUES ('14', '3', 'a:8:{s:3:\"dir\";a:5:{i:0;s:5:\"BZWXT\";i:1;s:5:\"SkWEK\";i:2;s:5:\"2BFqg\";i:3;s:5:\"nxik6\";i:4;s:5:\"5vZmP\";}s:4:\"type\";s:1:\"1\";s:7:\"webType\";s:2:\"10\";s:2:\"ip\";s:11:\"47.52.8.223\";s:9:\"server_id\";i:3;s:12:\"request_time\";i:1501758448;s:11:\"template_id\";i:3;s:13:\"template_path\";s:32:\"20170731/watercress_1/index.html\";}', '1501758448', '3', '1');
INSERT INTO `request_log` VALUES ('15', '3', 'a:8:{s:3:\"dir\";a:5:{i:0;s:5:\"GHvYW\";i:1;s:5:\"biz6z\";i:2;s:5:\"EcTkN\";i:3;s:5:\"2iZ9b\";i:4;s:5:\"kgbmV\";}s:4:\"type\";s:1:\"1\";s:7:\"webType\";s:2:\"10\";s:2:\"ip\";s:11:\"47.52.8.223\";s:9:\"server_id\";i:3;s:12:\"request_time\";i:1501758953;s:11:\"template_id\";i:3;s:13:\"template_path\";s:32:\"20170731/watercress_1/index.html\";}', '1501758953', '3', '1');
INSERT INTO `request_log` VALUES ('16', '3', 'a:8:{s:3:\"dir\";a:5:{i:0;s:5:\"Ps1th\";i:1;s:5:\"V88tX\";i:2;s:5:\"PQFwt\";i:3;s:5:\"t5KWG\";i:4;s:5:\"I8yFt\";}s:4:\"type\";s:1:\"1\";s:7:\"webType\";s:2:\"10\";s:2:\"ip\";s:11:\"47.52.8.223\";s:9:\"server_id\";i:3;s:12:\"request_time\";i:1501758966;s:11:\"template_id\";i:3;s:13:\"template_path\";s:32:\"20170731/watercress_1/index.html\";}', '1501758966', '3', '1');
INSERT INTO `request_log` VALUES ('17', '3', 'a:8:{s:3:\"dir\";a:5:{i:0;s:5:\"e2Nsj\";i:1;s:5:\"rqqpB\";i:2;s:5:\"ej2Lr\";i:3;s:5:\"epwkR\";i:4;s:5:\"nP2sM\";}s:4:\"type\";s:1:\"1\";s:7:\"webType\";s:2:\"10\";s:2:\"ip\";s:11:\"47.52.8.223\";s:9:\"server_id\";i:3;s:12:\"request_time\";i:1501759050;s:11:\"template_id\";i:3;s:13:\"template_path\";s:32:\"20170731/watercress_1/index.html\";}', '1501759050', '3', '1');
INSERT INTO `request_log` VALUES ('18', '3', 'a:8:{s:3:\"dir\";a:5:{i:0;s:5:\"Qy0Mi\";i:1;s:5:\"3c9xr\";i:2;s:5:\"uPUcS\";i:3;s:5:\"sEge4\";i:4;s:5:\"Up8lL\";}s:4:\"type\";s:1:\"1\";s:7:\"webType\";s:2:\"10\";s:2:\"ip\";s:11:\"47.52.8.223\";s:9:\"server_id\";i:3;s:12:\"request_time\";i:1501759173;s:11:\"template_id\";i:3;s:13:\"template_path\";s:32:\"20170731/watercress_1/index.html\";}', '1501759173', '3', '1');
INSERT INTO `request_log` VALUES ('19', '3', 'a:7:{s:4:\"type\";s:1:\"1\";s:7:\"webType\";s:2:\"10\";s:2:\"ip\";s:11:\"47.52.8.223\";s:9:\"server_id\";i:3;s:12:\"request_time\";i:1501759177;s:11:\"template_id\";i:3;s:13:\"template_path\";s:32:\"20170731/watercress_1/index.html\";}', '1501759177', '3', '1');
INSERT INTO `request_log` VALUES ('20', '3', 'a:7:{s:4:\"type\";s:1:\"1\";s:7:\"webType\";s:2:\"10\";s:2:\"ip\";s:11:\"47.52.8.223\";s:9:\"server_id\";i:3;s:12:\"request_time\";i:1501759518;s:11:\"template_id\";i:3;s:13:\"template_path\";s:32:\"20170731/watercress_1/index.html\";}', '1501759518', '3', '1');
INSERT INTO `request_log` VALUES ('21', '3', 'a:7:{s:4:\"type\";s:1:\"1\";s:7:\"webType\";s:2:\"10\";s:2:\"ip\";s:11:\"47.52.8.223\";s:9:\"server_id\";i:3;s:12:\"request_time\";i:1501760206;s:11:\"template_id\";i:3;s:13:\"template_path\";s:32:\"20170731/watercress_1/index.html\";}', '1501760206', '3', '1');
INSERT INTO `request_log` VALUES ('22', '3', 'a:8:{s:3:\"dir\";a:5:{i:0;s:5:\"HHQe8\";i:1;s:5:\"Yeqkc\";i:2;s:5:\"H5zqI\";i:3;s:5:\"aS2Dw\";i:4;s:5:\"vCdlw\";}s:4:\"type\";s:1:\"1\";s:7:\"webType\";s:2:\"10\";s:2:\"ip\";s:11:\"47.52.8.223\";s:9:\"server_id\";i:3;s:12:\"request_time\";i:1501760262;s:11:\"template_id\";i:3;s:13:\"template_path\";s:32:\"20170731/watercress_1/index.html\";}', '1501760262', '3', '1');
INSERT INTO `request_log` VALUES ('23', '3', 'a:8:{s:3:\"dir\";a:5:{i:0;s:5:\"C3VMv\";i:1;s:5:\"eFvZB\";i:2;s:5:\"fJEMr\";i:3;s:5:\"Uwduw\";i:4;s:5:\"h7Fd1\";}s:4:\"type\";s:1:\"1\";s:7:\"webType\";s:2:\"10\";s:2:\"ip\";s:11:\"47.52.8.223\";s:9:\"server_id\";i:3;s:12:\"request_time\";i:1501760755;s:11:\"template_id\";i:3;s:13:\"template_path\";s:32:\"20170731/watercress_1/index.html\";}', '1501760755', '3', '1');
INSERT INTO `request_log` VALUES ('24', '3', 'a:7:{s:4:\"type\";s:1:\"1\";s:7:\"webType\";s:2:\"10\";s:2:\"ip\";s:11:\"47.52.8.223\";s:9:\"server_id\";i:3;s:12:\"request_time\";i:1501760770;s:11:\"template_id\";i:3;s:13:\"template_path\";s:32:\"20170731/watercress_1/index.html\";}', '1501760770', '3', '1');
INSERT INTO `request_log` VALUES ('25', '3', 'a:7:{s:4:\"type\";s:1:\"1\";s:7:\"webType\";s:2:\"10\";s:2:\"ip\";s:11:\"47.52.8.223\";s:9:\"server_id\";i:3;s:12:\"request_time\";i:1501760826;s:11:\"template_id\";i:3;s:13:\"template_path\";s:32:\"20170731/watercress_1/index.html\";}', '1501760826', '3', '1');
INSERT INTO `request_log` VALUES ('26', '3', 'a:7:{s:4:\"type\";s:1:\"1\";s:7:\"webType\";s:2:\"10\";s:2:\"ip\";s:11:\"47.52.8.223\";s:9:\"server_id\";i:3;s:12:\"request_time\";i:1501760872;s:11:\"template_id\";i:3;s:13:\"template_path\";s:32:\"20170731/watercress_1/index.html\";}', '1501760872', '3', '1');
INSERT INTO `request_log` VALUES ('27', '3', 'a:8:{s:3:\"dir\";a:5:{i:0;s:5:\"AnFaX\";i:1;s:5:\"2mTUb\";i:2;s:5:\"kdWgD\";i:3;s:5:\"skhXn\";i:4;s:5:\"y3DiW\";}s:4:\"type\";s:1:\"1\";s:7:\"webType\";s:2:\"10\";s:2:\"ip\";s:11:\"47.52.8.223\";s:9:\"server_id\";i:3;s:12:\"request_time\";i:1501760891;s:11:\"template_id\";i:3;s:13:\"template_path\";s:32:\"20170731/watercress_1/index.html\";}', '1501760891', '3', '1');
INSERT INTO `request_log` VALUES ('28', '3', 'a:8:{s:3:\"dir\";a:5:{i:0;s:5:\"30nrI\";i:1;s:5:\"jpeWv\";i:2;s:5:\"I2NPS\";i:3;s:5:\"t3948\";i:4;s:5:\"4nQSI\";}s:4:\"type\";s:1:\"1\";s:7:\"webType\";s:2:\"10\";s:2:\"ip\";s:11:\"47.52.8.223\";s:9:\"server_id\";i:3;s:12:\"request_time\";i:1501760964;s:11:\"template_id\";i:3;s:13:\"template_path\";s:32:\"20170731/watercress_1/index.html\";}', '1501760964', '3', '1');
INSERT INTO `request_log` VALUES ('29', '3', 'a:8:{s:3:\"dir\";a:5:{i:0;s:5:\"qlLnU\";i:1;s:5:\"2dD9i\";i:2;s:5:\"DgrRc\";i:3;s:5:\"MpKDE\";i:4;s:5:\"0z6xc\";}s:4:\"type\";s:1:\"1\";s:7:\"webType\";s:2:\"10\";s:2:\"ip\";s:11:\"47.52.8.223\";s:9:\"server_id\";i:3;s:12:\"request_time\";i:1501761120;s:11:\"template_id\";i:3;s:13:\"template_path\";s:32:\"20170731/watercress_1/index.html\";}', '1501761120', '3', '1');
INSERT INTO `request_log` VALUES ('30', '3', 'a:8:{s:3:\"dir\";a:5:{i:0;s:5:\"lnm9k\";i:1;s:5:\"EAMzk\";i:2;s:5:\"52IyL\";i:3;s:5:\"tLEvb\";i:4;s:5:\"vhMt8\";}s:4:\"type\";s:1:\"1\";s:7:\"webType\";s:2:\"10\";s:2:\"ip\";s:11:\"47.52.8.223\";s:9:\"server_id\";i:3;s:12:\"request_time\";i:1501761210;s:11:\"template_id\";i:3;s:13:\"template_path\";s:32:\"20170731/watercress_1/index.html\";}', '1501761210', '3', '1');
INSERT INTO `request_log` VALUES ('31', '3', 'a:8:{s:3:\"dir\";a:5:{i:0;s:5:\"Z1p4P\";i:1;s:5:\"tEXIb\";i:2;s:5:\"SPkQH\";i:3;s:5:\"nM6tL\";i:4;s:5:\"jIi1F\";}s:4:\"type\";s:1:\"1\";s:7:\"webType\";s:2:\"10\";s:2:\"ip\";s:11:\"47.52.8.223\";s:9:\"server_id\";i:3;s:12:\"request_time\";i:1501761246;s:11:\"template_id\";i:3;s:13:\"template_path\";s:32:\"20170731/watercress_1/index.html\";}', '1501761246', '3', '1');
INSERT INTO `request_log` VALUES ('32', '3', 'a:8:{s:3:\"dir\";a:5:{i:0;s:5:\"n0AaC\";i:1;s:5:\"M3sUH\";i:2;s:5:\"JHAKY\";i:3;s:5:\"iDA0x\";i:4;s:5:\"mseIh\";}s:4:\"type\";s:1:\"1\";s:7:\"webType\";s:2:\"10\";s:2:\"ip\";s:11:\"47.52.8.223\";s:9:\"server_id\";i:3;s:12:\"request_time\";i:1501761352;s:11:\"template_id\";i:3;s:13:\"template_path\";s:32:\"20170731/watercress_1/index.html\";}', '1501761352', '3', '1');
INSERT INTO `request_log` VALUES ('33', '3', 'a:8:{s:3:\"dir\";a:5:{i:0;s:5:\"c3PjZ\";i:1;s:5:\"G2Tbj\";i:2;s:5:\"TVTNa\";i:3;s:5:\"fczLU\";i:4;s:5:\"Vzmc8\";}s:4:\"type\";s:1:\"1\";s:7:\"webType\";s:2:\"10\";s:2:\"ip\";s:11:\"47.52.8.223\";s:9:\"server_id\";i:3;s:12:\"request_time\";i:1501761497;s:11:\"template_id\";i:3;s:13:\"template_path\";s:32:\"20170731/watercress_1/index.html\";}', '1501761497', '3', '1');
INSERT INTO `request_log` VALUES ('34', '3', 'a:8:{s:3:\"dir\";a:5:{i:0;s:5:\"qMg9n\";i:1;s:5:\"5NkHw\";i:2;s:5:\"i5fK7\";i:3;s:5:\"xApZA\";i:4;s:5:\"b27fv\";}s:4:\"type\";s:1:\"1\";s:7:\"webType\";s:2:\"10\";s:2:\"ip\";s:11:\"47.52.8.223\";s:9:\"server_id\";i:3;s:12:\"request_time\";i:1501761624;s:11:\"template_id\";i:3;s:13:\"template_path\";s:32:\"20170731/watercress_1/index.html\";}', '1501761624', '3', '1');
INSERT INTO `request_log` VALUES ('35', '3', 'a:8:{s:3:\"dir\";a:5:{i:0;s:5:\"cKyli\";i:1;s:5:\"9ywuw\";i:2;s:5:\"P14kR\";i:3;s:5:\"KNBVY\";i:4;s:5:\"Dw7hM\";}s:4:\"type\";s:1:\"1\";s:7:\"webType\";s:2:\"10\";s:2:\"ip\";s:11:\"47.52.8.223\";s:9:\"server_id\";i:3;s:12:\"request_time\";i:1501761906;s:11:\"template_id\";i:3;s:13:\"template_path\";s:32:\"20170731/watercress_1/index.html\";}', '1501761906', '3', '1');
INSERT INTO `request_log` VALUES ('36', '3', 'a:8:{s:3:\"dir\";a:5:{i:0;s:5:\"MbaLb\";i:1;s:5:\"6EWGb\";i:2;s:5:\"pz1N8\";i:3;s:5:\"0KI82\";i:4;s:5:\"1pyGs\";}s:4:\"type\";s:1:\"1\";s:7:\"webType\";s:2:\"10\";s:2:\"ip\";s:11:\"47.52.8.223\";s:9:\"server_id\";i:3;s:12:\"request_time\";i:1501761926;s:11:\"template_id\";i:3;s:13:\"template_path\";s:32:\"20170731/watercress_1/index.html\";}', '1501761926', '3', '1');
INSERT INTO `request_log` VALUES ('37', '3', 'a:8:{s:3:\"dir\";a:5:{i:0;s:5:\"Q5TuL\";i:1;s:5:\"GBPyG\";i:2;s:5:\"Vps8U\";i:3;s:5:\"auMID\";i:4;s:5:\"MAgRb\";}s:4:\"type\";s:1:\"1\";s:7:\"webType\";s:2:\"10\";s:2:\"ip\";s:11:\"47.52.8.223\";s:9:\"server_id\";i:3;s:12:\"request_time\";i:1501761937;s:11:\"template_id\";i:3;s:13:\"template_path\";s:32:\"20170731/watercress_1/index.html\";}', '1501761937', '3', '1');
INSERT INTO `request_log` VALUES ('38', '3', 'a:8:{s:3:\"dir\";a:5:{i:0;s:5:\"FDHsS\";i:1;s:5:\"bGUyr\";i:2;s:5:\"CkAzj\";i:3;s:5:\"nVi2l\";i:4;s:5:\"IGz1i\";}s:4:\"type\";s:1:\"1\";s:7:\"webType\";s:2:\"10\";s:2:\"ip\";s:11:\"47.52.8.223\";s:9:\"server_id\";i:3;s:12:\"request_time\";i:1501762226;s:11:\"template_id\";i:3;s:13:\"template_path\";s:32:\"20170731/watercress_1/index.html\";}', '1501762226', '3', '1');
INSERT INTO `request_log` VALUES ('39', '3', 'a:8:{s:3:\"dir\";a:5:{i:0;s:5:\"iH69u\";i:1;s:5:\"tKZHI\";i:2;s:5:\"F1TCc\";i:3;s:5:\"enxlm\";i:4;s:5:\"MTuPx\";}s:4:\"type\";s:1:\"1\";s:7:\"webType\";s:2:\"10\";s:2:\"ip\";s:11:\"47.52.8.223\";s:9:\"server_id\";i:3;s:12:\"request_time\";i:1501763006;s:11:\"template_id\";i:3;s:13:\"template_path\";s:32:\"20170731/watercress_1/index.html\";}', '1501763006', '3', '1');
INSERT INTO `request_log` VALUES ('40', '3', 'a:8:{s:3:\"dir\";a:5:{i:0;s:5:\"8fsZy\";i:1;s:5:\"dNfDq\";i:2;s:5:\"nqsqr\";i:3;s:5:\"c99T3\";i:4;s:5:\"UtT0h\";}s:4:\"type\";s:1:\"1\";s:7:\"webType\";s:2:\"10\";s:2:\"ip\";s:11:\"47.52.8.223\";s:9:\"server_id\";i:3;s:12:\"request_time\";i:1501763049;s:11:\"template_id\";i:3;s:13:\"template_path\";s:32:\"20170731/watercress_1/index.html\";}', '1501763049', '3', '1');
INSERT INTO `request_log` VALUES ('41', '3', 'a:8:{s:3:\"dir\";a:5:{i:0;s:5:\"CnR9Y\";i:1;s:5:\"8tQiY\";i:2;s:5:\"jyvAT\";i:3;s:5:\"FqMwI\";i:4;s:5:\"X9yY8\";}s:4:\"type\";s:1:\"1\";s:7:\"webType\";s:2:\"10\";s:2:\"ip\";s:11:\"47.52.8.223\";s:9:\"server_id\";i:3;s:12:\"request_time\";i:1501763061;s:11:\"template_id\";i:3;s:13:\"template_path\";s:32:\"20170731/watercress_1/index.html\";}', '1501763061', '3', '1');
INSERT INTO `request_log` VALUES ('42', '3', 'a:7:{s:4:\"type\";s:1:\"1\";s:7:\"webType\";s:2:\"10\";s:2:\"ip\";s:11:\"47.52.8.223\";s:9:\"server_id\";i:3;s:12:\"request_time\";i:1501763073;s:11:\"template_id\";i:3;s:13:\"template_path\";s:32:\"20170731/watercress_1/index.html\";}', '1501763073', '3', '1');
INSERT INTO `request_log` VALUES ('43', '3', 'a:7:{s:4:\"type\";s:1:\"1\";s:7:\"webType\";s:2:\"10\";s:2:\"ip\";s:11:\"47.52.8.223\";s:9:\"server_id\";i:3;s:12:\"request_time\";i:1501763118;s:11:\"template_id\";i:3;s:13:\"template_path\";s:32:\"20170731/watercress_1/index.html\";}', '1501763118', '3', '1');
INSERT INTO `request_log` VALUES ('44', '3', 'a:8:{s:3:\"dir\";a:5:{i:0;s:5:\"7LiRa\";i:1;s:5:\"muIk8\";i:2;s:5:\"MvrMv\";i:3;s:5:\"03QQ7\";i:4;s:5:\"JsCra\";}s:4:\"type\";s:1:\"1\";s:7:\"webType\";s:2:\"10\";s:2:\"ip\";s:11:\"47.52.8.223\";s:9:\"server_id\";i:3;s:12:\"request_time\";i:1501763368;s:11:\"template_id\";i:3;s:13:\"template_path\";s:32:\"20170731/watercress_1/index.html\";}', '1501763368', '3', '1');
INSERT INTO `request_log` VALUES ('45', '3', 'a:7:{s:4:\"type\";s:1:\"1\";s:7:\"webType\";s:2:\"10\";s:2:\"ip\";s:11:\"47.52.8.223\";s:9:\"server_id\";i:3;s:12:\"request_time\";i:1501763369;s:11:\"template_id\";i:3;s:13:\"template_path\";s:32:\"20170731/watercress_1/index.html\";}', '1501763369', '3', '1');
INSERT INTO `request_log` VALUES ('46', '3', 'a:7:{s:4:\"type\";s:1:\"1\";s:7:\"webType\";s:2:\"10\";s:2:\"ip\";s:11:\"47.52.8.223\";s:9:\"server_id\";i:3;s:12:\"request_time\";i:1501763369;s:11:\"template_id\";i:3;s:13:\"template_path\";s:32:\"20170731/watercress_1/index.html\";}', '1501763369', '3', '1');
INSERT INTO `request_log` VALUES ('47', '3', 'a:8:{s:3:\"dir\";a:5:{i:0;s:5:\"zksNV\";i:1;s:5:\"aaB1y\";i:2;s:5:\"QKRhm\";i:3;s:5:\"fGslm\";i:4;s:5:\"Z38Ri\";}s:4:\"type\";s:1:\"1\";s:7:\"webType\";s:2:\"10\";s:2:\"ip\";s:11:\"47.52.8.223\";s:9:\"server_id\";i:3;s:12:\"request_time\";i:1501763523;s:11:\"template_id\";i:3;s:13:\"template_path\";s:32:\"20170731/watercress_1/index.html\";}', '1501763523', '3', '1');
INSERT INTO `request_log` VALUES ('48', '3', 'a:7:{s:4:\"type\";s:1:\"1\";s:7:\"webType\";s:2:\"10\";s:2:\"ip\";s:11:\"47.52.8.223\";s:9:\"server_id\";i:3;s:12:\"request_time\";i:1501763523;s:11:\"template_id\";i:3;s:13:\"template_path\";s:32:\"20170731/watercress_1/index.html\";}', '1501763523', '3', '1');
INSERT INTO `request_log` VALUES ('49', '3', 'a:7:{s:4:\"type\";s:1:\"1\";s:7:\"webType\";s:2:\"10\";s:2:\"ip\";s:11:\"47.52.8.223\";s:9:\"server_id\";i:3;s:12:\"request_time\";i:1501763523;s:11:\"template_id\";i:3;s:13:\"template_path\";s:32:\"20170731/watercress_1/index.html\";}', '1501763523', '3', '1');
INSERT INTO `request_log` VALUES ('50', '3', 'a:8:{s:3:\"dir\";a:5:{i:0;s:5:\"4xXiD\";i:1;s:5:\"ybfZB\";i:2;s:5:\"fGmu7\";i:3;s:5:\"CmZDs\";i:4;s:5:\"29ure\";}s:4:\"type\";s:1:\"1\";s:7:\"webType\";s:2:\"10\";s:2:\"ip\";s:11:\"47.52.8.223\";s:9:\"server_id\";i:3;s:12:\"request_time\";i:1501764150;s:11:\"template_id\";i:3;s:13:\"template_path\";s:32:\"20170731/watercress_1/index.html\";}', '1501764150', '3', '1');
INSERT INTO `request_log` VALUES ('51', '3', 'a:8:{s:3:\"dir\";a:5:{i:0;s:5:\"wTF6n\";i:1;s:5:\"2jDLs\";i:2;s:5:\"WH3cg\";i:3;s:5:\"13xD4\";i:4;s:5:\"tREka\";}s:4:\"type\";s:1:\"1\";s:7:\"webType\";s:2:\"10\";s:2:\"ip\";s:11:\"47.52.8.223\";s:9:\"server_id\";i:3;s:12:\"request_time\";i:1501764150;s:11:\"template_id\";i:3;s:13:\"template_path\";s:32:\"20170731/watercress_1/index.html\";}', '1501764150', '3', '1');
INSERT INTO `request_log` VALUES ('52', '3', 'a:8:{s:3:\"dir\";a:5:{i:0;s:5:\"73ygV\";i:1;s:5:\"rC6EQ\";i:2;s:5:\"gEenk\";i:3;s:5:\"rNthc\";i:4;s:5:\"M1YRa\";}s:4:\"type\";s:1:\"1\";s:7:\"webType\";s:2:\"10\";s:2:\"ip\";s:11:\"47.52.8.223\";s:9:\"server_id\";i:3;s:12:\"request_time\";i:1501764150;s:11:\"template_id\";i:3;s:13:\"template_path\";s:32:\"20170731/watercress_1/index.html\";}', '1501764150', '3', '1');
INSERT INTO `request_log` VALUES ('53', '3', 'a:8:{s:3:\"dir\";a:5:{i:0;s:5:\"p2kUt\";i:1;s:5:\"QG6aG\";i:2;s:5:\"0E9ID\";i:3;s:5:\"ZuLFv\";i:4;s:5:\"YHjFX\";}s:4:\"type\";s:1:\"1\";s:7:\"webType\";s:2:\"10\";s:2:\"ip\";s:11:\"47.52.8.223\";s:9:\"server_id\";i:3;s:12:\"request_time\";i:1501764208;s:11:\"template_id\";i:3;s:13:\"template_path\";s:32:\"20170731/watercress_1/index.html\";}', '1501764208', '3', '1');
INSERT INTO `request_log` VALUES ('54', '3', 'a:8:{s:3:\"dir\";a:5:{i:0;s:5:\"SJ0MT\";i:1;s:5:\"5X3EB\";i:2;s:5:\"8iQ14\";i:3;s:5:\"80eqK\";i:4;s:5:\"XHViW\";}s:4:\"type\";s:1:\"1\";s:7:\"webType\";s:2:\"10\";s:2:\"ip\";s:11:\"47.52.8.223\";s:9:\"server_id\";i:3;s:12:\"request_time\";i:1501764208;s:11:\"template_id\";i:3;s:13:\"template_path\";s:32:\"20170731/watercress_1/index.html\";}', '1501764208', '3', '1');
INSERT INTO `request_log` VALUES ('55', '3', 'a:8:{s:3:\"dir\";a:5:{i:0;s:5:\"m7kxJ\";i:1;s:5:\"BMPXP\";i:2;s:5:\"SU3xm\";i:3;s:5:\"67Xyt\";i:4;s:5:\"GnjbR\";}s:4:\"type\";s:1:\"1\";s:7:\"webType\";s:2:\"10\";s:2:\"ip\";s:11:\"47.52.8.223\";s:9:\"server_id\";i:3;s:12:\"request_time\";i:1501764208;s:11:\"template_id\";i:3;s:13:\"template_path\";s:32:\"20170731/watercress_1/index.html\";}', '1501764208', '3', '1');
INSERT INTO `request_log` VALUES ('56', '3', 'a:8:{s:3:\"dir\";a:5:{i:0;s:5:\"LIumz\";i:1;s:5:\"xNzFD\";i:2;s:5:\"t5tjT\";i:3;s:5:\"Mp0vh\";i:4;s:5:\"FuD2j\";}s:4:\"type\";s:1:\"1\";s:7:\"webType\";s:2:\"10\";s:2:\"ip\";s:11:\"47.52.8.223\";s:9:\"server_id\";i:3;s:12:\"request_time\";i:1501764483;s:11:\"template_id\";i:3;s:13:\"template_path\";s:32:\"20170731/watercress_1/index.html\";}', '1501764483', '3', '1');
INSERT INTO `request_log` VALUES ('57', '3', 'a:8:{s:3:\"dir\";a:5:{i:0;s:5:\"Gkmbb\";i:1;s:5:\"QVDPh\";i:2;s:5:\"ybv85\";i:3;s:5:\"7YGHe\";i:4;s:5:\"gV6lF\";}s:4:\"type\";s:1:\"1\";s:7:\"webType\";s:2:\"10\";s:2:\"ip\";s:11:\"47.52.8.223\";s:9:\"server_id\";i:3;s:12:\"request_time\";i:1501764483;s:11:\"template_id\";i:3;s:13:\"template_path\";s:32:\"20170731/watercress_1/index.html\";}', '1501764483', '3', '1');
INSERT INTO `request_log` VALUES ('58', '3', 'a:8:{s:3:\"dir\";a:5:{i:0;s:5:\"nzZ8c\";i:1;s:5:\"g0RAd\";i:2;s:5:\"kiP1L\";i:3;s:5:\"cGkFU\";i:4;s:5:\"GNKzN\";}s:4:\"type\";s:1:\"1\";s:7:\"webType\";s:2:\"10\";s:2:\"ip\";s:11:\"47.52.8.223\";s:9:\"server_id\";i:3;s:12:\"request_time\";i:1501764483;s:11:\"template_id\";i:3;s:13:\"template_path\";s:32:\"20170731/watercress_1/index.html\";}', '1501764483', '3', '1');
INSERT INTO `request_log` VALUES ('59', '3', 'a:8:{s:3:\"dir\";a:5:{i:0;s:5:\"H7NQv\";i:1;s:5:\"u5h5C\";i:2;s:5:\"t5QsZ\";i:3;s:5:\"UYjsM\";i:4;s:5:\"LCuxt\";}s:4:\"type\";s:1:\"1\";s:7:\"webType\";s:2:\"10\";s:2:\"ip\";s:11:\"47.52.8.223\";s:9:\"server_id\";i:3;s:12:\"request_time\";i:1501764582;s:11:\"template_id\";i:3;s:13:\"template_path\";s:32:\"20170731/watercress_1/index.html\";}', '1501764582', '3', '1');
INSERT INTO `request_log` VALUES ('60', '3', 'a:7:{s:4:\"type\";s:1:\"1\";s:7:\"webType\";s:2:\"10\";s:2:\"ip\";s:11:\"47.52.8.223\";s:9:\"server_id\";i:3;s:12:\"request_time\";i:1501764582;s:11:\"template_id\";i:3;s:13:\"template_path\";s:32:\"20170731/watercress_1/index.html\";}', '1501764582', '3', '1');
INSERT INTO `request_log` VALUES ('61', '3', 'a:7:{s:4:\"type\";s:1:\"1\";s:7:\"webType\";s:2:\"10\";s:2:\"ip\";s:11:\"47.52.8.223\";s:9:\"server_id\";i:3;s:12:\"request_time\";i:1501764583;s:11:\"template_id\";i:3;s:13:\"template_path\";s:32:\"20170731/watercress_1/index.html\";}', '1501764583', '3', '1');
INSERT INTO `request_log` VALUES ('62', '3', 'a:8:{s:3:\"dir\";a:5:{i:0;s:5:\"hW6AQ\";i:1;s:5:\"u0sbz\";i:2;s:5:\"xNMex\";i:3;s:5:\"gxh7K\";i:4;s:5:\"CCnqH\";}s:4:\"type\";s:1:\"1\";s:7:\"webType\";s:2:\"10\";s:2:\"ip\";s:11:\"47.52.8.223\";s:9:\"server_id\";i:3;s:12:\"request_time\";i:1501764599;s:11:\"template_id\";i:3;s:13:\"template_path\";s:32:\"20170731/watercress_1/index.html\";}', '1501764599', '3', '1');
INSERT INTO `request_log` VALUES ('63', '3', 'a:8:{s:3:\"dir\";a:5:{i:0;s:5:\"ZPwr5\";i:1;s:5:\"NLEpu\";i:2;s:5:\"zIXzQ\";i:3;s:5:\"eUh92\";i:4;s:5:\"sKgqS\";}s:4:\"type\";s:1:\"1\";s:7:\"webType\";s:2:\"10\";s:2:\"ip\";s:11:\"47.52.8.223\";s:9:\"server_id\";i:3;s:12:\"request_time\";i:1501764599;s:11:\"template_id\";i:3;s:13:\"template_path\";s:32:\"20170731/watercress_1/index.html\";}', '1501764599', '3', '1');
INSERT INTO `request_log` VALUES ('64', '3', 'a:8:{s:3:\"dir\";a:5:{i:0;s:5:\"3YMlg\";i:1;s:5:\"6xq0y\";i:2;s:5:\"NTqby\";i:3;s:5:\"Ypveu\";i:4;s:5:\"pnnen\";}s:4:\"type\";s:1:\"1\";s:7:\"webType\";s:2:\"10\";s:2:\"ip\";s:11:\"47.52.8.223\";s:9:\"server_id\";i:3;s:12:\"request_time\";i:1501764599;s:11:\"template_id\";i:3;s:13:\"template_path\";s:32:\"20170731/watercress_1/index.html\";}', '1501764599', '3', '1');
INSERT INTO `request_log` VALUES ('65', '3', 'a:8:{s:3:\"dir\";a:5:{i:0;s:5:\"193f2\";i:1;s:5:\"L7Rsz\";i:2;s:5:\"w5QMK\";i:3;s:5:\"KxRwP\";i:4;s:5:\"CDSzt\";}s:4:\"type\";s:1:\"1\";s:7:\"webType\";s:2:\"10\";s:2:\"ip\";s:11:\"47.52.8.223\";s:9:\"server_id\";i:3;s:12:\"request_time\";i:1501764694;s:11:\"template_id\";i:3;s:13:\"template_path\";s:32:\"20170731/watercress_1/index.html\";}', '1501764694', '3', '1');
INSERT INTO `request_log` VALUES ('66', '3', 'a:8:{s:3:\"dir\";a:5:{i:0;s:5:\"9ZMgt\";i:1;s:5:\"cce3z\";i:2;s:5:\"suTgx\";i:3;s:5:\"Wdx37\";i:4;s:5:\"pFx8C\";}s:4:\"type\";s:1:\"1\";s:7:\"webType\";s:2:\"10\";s:2:\"ip\";s:11:\"47.52.8.223\";s:9:\"server_id\";i:3;s:12:\"request_time\";i:1501764694;s:11:\"template_id\";i:3;s:13:\"template_path\";s:32:\"20170731/watercress_1/index.html\";}', '1501764694', '3', '1');
INSERT INTO `request_log` VALUES ('67', '3', 'a:8:{s:3:\"dir\";a:5:{i:0;s:5:\"g8511\";i:1;s:5:\"M2f3g\";i:2;s:5:\"DgAi2\";i:3;s:5:\"8VRZe\";i:4;s:5:\"Lj9m7\";}s:4:\"type\";s:1:\"1\";s:7:\"webType\";s:2:\"10\";s:2:\"ip\";s:11:\"47.52.8.223\";s:9:\"server_id\";i:3;s:12:\"request_time\";i:1501764694;s:11:\"template_id\";i:3;s:13:\"template_path\";s:32:\"20170731/watercress_1/index.html\";}', '1501764694', '3', '1');
INSERT INTO `request_log` VALUES ('68', '3', 'a:7:{s:4:\"type\";s:1:\"1\";s:7:\"webType\";s:2:\"10\";s:2:\"ip\";s:11:\"47.52.8.223\";s:9:\"server_id\";i:3;s:12:\"request_time\";i:1501764702;s:11:\"template_id\";i:3;s:13:\"template_path\";s:32:\"20170731/watercress_1/index.html\";}', '1501764702', '3', '1');
INSERT INTO `request_log` VALUES ('69', '3', 'a:7:{s:4:\"type\";s:1:\"1\";s:7:\"webType\";s:2:\"10\";s:2:\"ip\";s:11:\"47.52.8.223\";s:9:\"server_id\";i:3;s:12:\"request_time\";i:1501764702;s:11:\"template_id\";i:3;s:13:\"template_path\";s:32:\"20170731/watercress_1/index.html\";}', '1501764702', '3', '1');
INSERT INTO `request_log` VALUES ('70', '3', 'a:7:{s:4:\"type\";s:1:\"1\";s:7:\"webType\";s:2:\"10\";s:2:\"ip\";s:11:\"47.52.8.223\";s:9:\"server_id\";i:3;s:12:\"request_time\";i:1501764717;s:11:\"template_id\";i:3;s:13:\"template_path\";s:32:\"20170731/watercress_1/index.html\";}', '1501764717', '3', '1');
INSERT INTO `request_log` VALUES ('71', '3', 'a:8:{s:3:\"dir\";a:5:{i:0;s:5:\"UCLKX\";i:1;s:5:\"isV1e\";i:2;s:5:\"KAUXb\";i:3;s:5:\"fyN9x\";i:4;s:5:\"qgYRS\";}s:4:\"type\";s:1:\"1\";s:7:\"webType\";s:2:\"10\";s:2:\"ip\";s:11:\"47.52.8.223\";s:9:\"server_id\";i:3;s:12:\"request_time\";i:1501764786;s:11:\"template_id\";i:3;s:13:\"template_path\";s:32:\"20170731/watercress_1/index.html\";}', '1501764786', '3', '1');
INSERT INTO `request_log` VALUES ('72', '3', 'a:8:{s:3:\"dir\";a:5:{i:0;s:5:\"W5kTj\";i:1;s:5:\"VVdtG\";i:2;s:5:\"Z7MJC\";i:3;s:5:\"0Z17S\";i:4;s:5:\"tJ5eD\";}s:4:\"type\";s:1:\"1\";s:7:\"webType\";s:2:\"10\";s:2:\"ip\";s:11:\"47.52.8.223\";s:9:\"server_id\";i:3;s:12:\"request_time\";i:1501764786;s:11:\"template_id\";i:3;s:13:\"template_path\";s:32:\"20170731/watercress_1/index.html\";}', '1501764786', '3', '1');
INSERT INTO `request_log` VALUES ('73', '3', 'a:8:{s:3:\"dir\";a:5:{i:0;s:5:\"WB5mU\";i:1;s:5:\"ttraW\";i:2;s:5:\"nHLNb\";i:3;s:5:\"NRrVx\";i:4;s:5:\"467h8\";}s:4:\"type\";s:1:\"1\";s:7:\"webType\";s:2:\"10\";s:2:\"ip\";s:11:\"47.52.8.223\";s:9:\"server_id\";i:3;s:12:\"request_time\";i:1501764786;s:11:\"template_id\";i:3;s:13:\"template_path\";s:32:\"20170731/watercress_1/index.html\";}', '1501764786', '3', '1');
INSERT INTO `request_log` VALUES ('74', '3', 'a:8:{s:3:\"dir\";a:5:{i:0;s:5:\"U8AyC\";i:1;s:5:\"4Qmms\";i:2;s:5:\"A76kk\";i:3;s:5:\"fexBx\";i:4;s:5:\"m9bqr\";}s:4:\"type\";s:1:\"1\";s:7:\"webType\";s:2:\"10\";s:2:\"ip\";s:11:\"47.52.8.223\";s:9:\"server_id\";i:3;s:12:\"request_time\";i:1501765746;s:11:\"template_id\";i:3;s:13:\"template_path\";s:32:\"20170731/watercress_1/index.html\";}', '1501765746', '3', '1');
INSERT INTO `request_log` VALUES ('75', '3', 'a:7:{s:4:\"type\";s:1:\"1\";s:7:\"webType\";s:2:\"10\";s:2:\"ip\";s:11:\"47.52.8.223\";s:9:\"server_id\";i:3;s:12:\"request_time\";i:1501765746;s:11:\"template_id\";i:3;s:13:\"template_path\";s:32:\"20170731/watercress_1/index.html\";}', '1501765746', '3', '1');
INSERT INTO `request_log` VALUES ('76', '3', 'a:7:{s:4:\"type\";s:1:\"1\";s:7:\"webType\";s:2:\"10\";s:2:\"ip\";s:11:\"47.52.8.223\";s:9:\"server_id\";i:3;s:12:\"request_time\";i:1501765771;s:11:\"template_id\";i:3;s:13:\"template_path\";s:32:\"20170731/watercress_1/index.html\";}', '1501765771', '3', '1');
INSERT INTO `request_log` VALUES ('77', '3', 'a:7:{s:4:\"type\";s:1:\"1\";s:7:\"webType\";s:2:\"10\";s:2:\"ip\";s:11:\"47.52.8.223\";s:9:\"server_id\";i:3;s:12:\"request_time\";i:1501765772;s:11:\"template_id\";i:3;s:13:\"template_path\";s:32:\"20170731/watercress_1/index.html\";}', '1501765772', '3', '1');
INSERT INTO `request_log` VALUES ('78', '3', 'a:7:{s:4:\"type\";s:1:\"1\";s:7:\"webType\";s:2:\"10\";s:2:\"ip\";s:11:\"47.52.8.223\";s:9:\"server_id\";i:3;s:12:\"request_time\";i:1501765919;s:11:\"template_id\";i:3;s:13:\"template_path\";s:32:\"20170731/watercress_1/index.html\";}', '1501765919', '3', '1');
INSERT INTO `request_log` VALUES ('79', '3', 'a:8:{s:3:\"dir\";a:5:{i:0;s:5:\"9fawG\";i:1;s:5:\"9h8FT\";i:2;s:5:\"8YKAt\";i:3;s:5:\"xxEsh\";i:4;s:5:\"ZJS3j\";}s:4:\"type\";s:1:\"1\";s:7:\"webType\";s:2:\"10\";s:2:\"ip\";s:11:\"47.52.8.223\";s:9:\"server_id\";i:3;s:12:\"request_time\";i:1501765933;s:11:\"template_id\";i:3;s:13:\"template_path\";s:32:\"20170731/watercress_1/index.html\";}', '1501765933', '3', '1');
INSERT INTO `request_log` VALUES ('80', '3', 'a:7:{s:4:\"type\";s:1:\"1\";s:7:\"webType\";s:2:\"10\";s:2:\"ip\";s:11:\"47.52.8.223\";s:9:\"server_id\";i:3;s:12:\"request_time\";i:1501766188;s:11:\"template_id\";i:3;s:13:\"template_path\";s:32:\"20170731/watercress_1/index.html\";}', '1501766188', '3', '1');
INSERT INTO `request_log` VALUES ('81', '3', 'a:7:{s:4:\"type\";s:1:\"1\";s:7:\"webType\";s:2:\"10\";s:2:\"ip\";s:11:\"47.52.8.223\";s:9:\"server_id\";i:3;s:12:\"request_time\";i:1501766223;s:11:\"template_id\";i:3;s:13:\"template_path\";s:32:\"20170731/watercress_1/index.html\";}', '1501766223', '3', '1');
INSERT INTO `request_log` VALUES ('82', '3', 'a:7:{s:4:\"type\";s:1:\"1\";s:7:\"webType\";s:2:\"10\";s:2:\"ip\";s:11:\"47.52.8.223\";s:9:\"server_id\";i:3;s:12:\"request_time\";i:1501766275;s:11:\"template_id\";i:3;s:13:\"template_path\";s:32:\"20170731/watercress_1/index.html\";}', '1501766275', '3', '1');
INSERT INTO `request_log` VALUES ('83', '3', 'a:8:{s:3:\"dir\";a:5:{i:0;s:5:\"FPCtB\";i:1;s:5:\"Bs6eN\";i:2;s:5:\"d5GI7\";i:3;s:5:\"Wj0iS\";i:4;s:5:\"dJ8ZB\";}s:4:\"type\";s:1:\"1\";s:7:\"webType\";s:2:\"10\";s:2:\"ip\";s:11:\"47.52.8.223\";s:9:\"server_id\";i:3;s:12:\"request_time\";i:1501766323;s:11:\"template_id\";i:3;s:13:\"template_path\";s:32:\"20170731/watercress_1/index.html\";}', '1501766323', '3', '1');
INSERT INTO `request_log` VALUES ('84', '3', 'a:8:{s:3:\"dir\";a:5:{i:0;s:5:\"y9UEG\";i:1;s:5:\"SlZx6\";i:2;s:5:\"n5FmJ\";i:3;s:5:\"jvQpQ\";i:4;s:5:\"71DdC\";}s:4:\"type\";s:1:\"1\";s:7:\"webType\";s:2:\"10\";s:2:\"ip\";s:11:\"47.52.8.223\";s:9:\"server_id\";i:3;s:12:\"request_time\";i:1501766337;s:11:\"template_id\";i:3;s:13:\"template_path\";s:32:\"20170731/watercress_1/index.html\";}', '1501766337', '3', '1');
INSERT INTO `request_log` VALUES ('85', '3', 'a:8:{s:3:\"dir\";a:5:{i:0;s:5:\"ulDej\";i:1;s:5:\"yjVS6\";i:2;s:5:\"ygpVS\";i:3;s:5:\"rSZKR\";i:4;s:5:\"Bz4s1\";}s:4:\"type\";s:1:\"1\";s:7:\"webType\";s:2:\"10\";s:2:\"ip\";s:11:\"47.52.8.223\";s:9:\"server_id\";i:3;s:12:\"request_time\";i:1501766353;s:11:\"template_id\";i:3;s:13:\"template_path\";s:32:\"20170731/watercress_1/index.html\";}', '1501766353', '3', '1');
INSERT INTO `request_log` VALUES ('86', '3', 'a:8:{s:3:\"dir\";a:5:{i:0;s:5:\"s9A6b\";i:1;s:5:\"bmGpa\";i:2;s:5:\"FXHZS\";i:3;s:5:\"fVSpr\";i:4;s:5:\"4Tbjw\";}s:4:\"type\";s:1:\"1\";s:7:\"webType\";s:2:\"10\";s:2:\"ip\";s:11:\"47.52.8.223\";s:9:\"server_id\";i:3;s:12:\"request_time\";i:1501766365;s:11:\"template_id\";i:3;s:13:\"template_path\";s:32:\"20170731/watercress_1/index.html\";}', '1501766365', '3', '1');
INSERT INTO `request_log` VALUES ('87', '3', 'a:7:{s:4:\"type\";s:1:\"1\";s:7:\"webType\";s:2:\"10\";s:2:\"ip\";s:11:\"47.52.8.223\";s:9:\"server_id\";i:3;s:12:\"request_time\";i:1501766385;s:11:\"template_id\";i:3;s:13:\"template_path\";s:32:\"20170731/watercress_1/index.html\";}', '1501766385', '3', '1');

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
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of server
-- ----------------------------
INSERT INTO `server` VALUES ('3', 'aso1', '47.52.8.223', 'http://test223.findourlove.com/', '65', '1501766385', '1501656608');

-- ----------------------------
-- Table structure for server_url
-- ----------------------------
DROP TABLE IF EXISTS `server_url`;
CREATE TABLE `server_url` (
  `id` int(11) NOT NULL,
  `url` text NOT NULL,
  `type` tinyint(2) unsigned NOT NULL DEFAULT '1' COMMENT '1是客户端生成 2是主服务器生成',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of server_url
-- ----------------------------
INSERT INTO `server_url` VALUES ('1', 'http://test223.findourlove.com/link1_thLBK', '2');
INSERT INTO `server_url` VALUES ('2', 'http://test223.findourlove.com/link2_7fNuZ', '2');
INSERT INTO `server_url` VALUES ('3', 'http://test223.findourlove.com/link3_IMlUe', '2');
INSERT INTO `server_url` VALUES ('4', 'http://test223.findourlove.com/link4_t3b9k', '2');
INSERT INTO `server_url` VALUES ('5', 'http://test223.findourlove.com/link5_XJMub', '2');
INSERT INTO `server_url` VALUES ('6', 'http://test223.findourlove.com/link6_7ChVt', '2');
INSERT INTO `server_url` VALUES ('7', 'http://test223.findourlove.com/link7_Hu3Bq', '2');
INSERT INTO `server_url` VALUES ('8', 'http://test223.findourlove.com/link8_HAL3I', '2');
INSERT INTO `server_url` VALUES ('10', 'http://test223.findourlove.com/6WGVa', '1');
INSERT INTO `server_url` VALUES ('11', 'http://test223.findourlove.com/Jikjv', '1');
INSERT INTO `server_url` VALUES ('12', 'http://test223.findourlove.com/a7KPS', '1');
INSERT INTO `server_url` VALUES ('13', 'http://test223.findourlove.com/TVuM9', '1');
INSERT INTO `server_url` VALUES ('14', 'http://test223.findourlove.com/JNjGc', '1');
INSERT INTO `server_url` VALUES ('16', 'http://test223.findourlove.com/link1_iAL65', '2');
INSERT INTO `server_url` VALUES ('17', 'http://test223.findourlove.com/link2_EtQ38', '2');
INSERT INTO `server_url` VALUES ('18', 'http://test223.findourlove.com/link3_sdSnW', '2');
INSERT INTO `server_url` VALUES ('19', 'http://test223.findourlove.com/link4_CCfRF', '2');
INSERT INTO `server_url` VALUES ('20', 'http://test223.findourlove.com/link5_6x3dT', '2');
INSERT INTO `server_url` VALUES ('21', 'http://test223.findourlove.com/link6_6N0TV', '2');
INSERT INTO `server_url` VALUES ('22', 'http://test223.findourlove.com/link7_igeLH', '2');
INSERT INTO `server_url` VALUES ('23', 'http://test223.findourlove.com/link8_2kqTF', '2');
INSERT INTO `server_url` VALUES ('25', 'http://test223.findourlove.com/link1_1ZMt3', '2');
INSERT INTO `server_url` VALUES ('26', 'http://test223.findourlove.com/link2_mxebF', '2');
INSERT INTO `server_url` VALUES ('27', 'http://test223.findourlove.com/link3_ktATM', '2');
INSERT INTO `server_url` VALUES ('28', 'http://test223.findourlove.com/link4_e7GMB', '2');
INSERT INTO `server_url` VALUES ('29', 'http://test223.findourlove.com/link5_btDD3', '2');
INSERT INTO `server_url` VALUES ('30', 'http://test223.findourlove.com/link6_8j4bT', '2');
INSERT INTO `server_url` VALUES ('31', 'http://test223.findourlove.com/link7_gP7Mr', '2');
INSERT INTO `server_url` VALUES ('32', 'http://test223.findourlove.com/link8_eIqcg', '2');
INSERT INTO `server_url` VALUES ('34', 'http://test223.findourlove.com/link1_7gvNb', '2');
INSERT INTO `server_url` VALUES ('35', 'http://test223.findourlove.com/link2_RnhZA', '2');
INSERT INTO `server_url` VALUES ('36', 'http://test223.findourlove.com/link3_K85T7', '2');
INSERT INTO `server_url` VALUES ('37', 'http://test223.findourlove.com/link4_WQrsR', '2');
INSERT INTO `server_url` VALUES ('38', 'http://test223.findourlove.com/link5_tb8Xb', '2');
INSERT INTO `server_url` VALUES ('39', 'http://test223.findourlove.com/link6_6Ungc', '2');
INSERT INTO `server_url` VALUES ('40', 'http://test223.findourlove.com/link7_EL4Vk', '2');
INSERT INTO `server_url` VALUES ('41', 'http://test223.findourlove.com/link8_aRFAS', '2');
INSERT INTO `server_url` VALUES ('43', 'http://test223.findourlove.com/link1_0jXAl', '2');
INSERT INTO `server_url` VALUES ('44', 'http://test223.findourlove.com/link2_ipETN', '2');
INSERT INTO `server_url` VALUES ('45', 'http://test223.findourlove.com/link3_SjDhj', '2');
INSERT INTO `server_url` VALUES ('46', 'http://test223.findourlove.com/link4_5d16X', '2');
INSERT INTO `server_url` VALUES ('47', 'http://test223.findourlove.com/link5_3DEMs', '2');
INSERT INTO `server_url` VALUES ('48', 'http://test223.findourlove.com/link6_Uzx5l', '2');
INSERT INTO `server_url` VALUES ('49', 'http://test223.findourlove.com/link7_4t8mS', '2');
INSERT INTO `server_url` VALUES ('50', 'http://test223.findourlove.com/link8_7pslA', '2');
INSERT INTO `server_url` VALUES ('52', 'http://test223.findourlove.com/link1_s1TId', '2');
INSERT INTO `server_url` VALUES ('53', 'http://test223.findourlove.com/link2_U1YMu', '2');
INSERT INTO `server_url` VALUES ('54', 'http://test223.findourlove.com/link3_LmzAb', '2');
INSERT INTO `server_url` VALUES ('55', 'http://test223.findourlove.com/link4_Xi3PI', '2');
INSERT INTO `server_url` VALUES ('56', 'http://test223.findourlove.com/link5_UmBYK', '2');
INSERT INTO `server_url` VALUES ('57', 'http://test223.findourlove.com/link6_ape7X', '2');
INSERT INTO `server_url` VALUES ('58', 'http://test223.findourlove.com/link7_U8nqG', '2');
INSERT INTO `server_url` VALUES ('59', 'http://test223.findourlove.com/link8_JYMW4', '2');
INSERT INTO `server_url` VALUES ('61', 'http://test223.findourlove.com/U8AyC', '1');
INSERT INTO `server_url` VALUES ('62', 'http://test223.findourlove.com/4Qmms', '1');
INSERT INTO `server_url` VALUES ('63', 'http://test223.findourlove.com/A76kk', '1');
INSERT INTO `server_url` VALUES ('64', 'http://test223.findourlove.com/fexBx', '1');
INSERT INTO `server_url` VALUES ('65', 'http://test223.findourlove.com/m9bqr', '1');
INSERT INTO `server_url` VALUES ('67', 'http://test223.findourlove.com/link1_JIPnj', '2');
INSERT INTO `server_url` VALUES ('68', 'http://test223.findourlove.com/link2_3FnEj', '2');
INSERT INTO `server_url` VALUES ('69', 'http://test223.findourlove.com/link3_TqcSs', '2');
INSERT INTO `server_url` VALUES ('70', 'http://test223.findourlove.com/link4_wGrLv', '2');
INSERT INTO `server_url` VALUES ('71', 'http://test223.findourlove.com/link5_x4beF', '2');
INSERT INTO `server_url` VALUES ('72', 'http://test223.findourlove.com/link6_eLDAx', '2');
INSERT INTO `server_url` VALUES ('73', 'http://test223.findourlove.com/link7_wpCYz', '2');
INSERT INTO `server_url` VALUES ('74', 'http://test223.findourlove.com/link8_5P66q', '2');
INSERT INTO `server_url` VALUES ('76', 'http://test223.findourlove.com/link1_te09w', '2');
INSERT INTO `server_url` VALUES ('77', 'http://test223.findourlove.com/link2_LHPPT', '2');
INSERT INTO `server_url` VALUES ('78', 'http://test223.findourlove.com/link3_7zwuq', '2');
INSERT INTO `server_url` VALUES ('79', 'http://test223.findourlove.com/link4_YQZsf', '2');
INSERT INTO `server_url` VALUES ('80', 'http://test223.findourlove.com/link5_xuAR3', '2');
INSERT INTO `server_url` VALUES ('81', 'http://test223.findourlove.com/link6_3UEm5', '2');
INSERT INTO `server_url` VALUES ('82', 'http://test223.findourlove.com/link7_hrIcx', '2');
INSERT INTO `server_url` VALUES ('83', 'http://test223.findourlove.com/link8_NJkkK', '2');
INSERT INTO `server_url` VALUES ('85', 'http://test223.findourlove.com/link1_I3N3v', '2');
INSERT INTO `server_url` VALUES ('86', 'http://test223.findourlove.com/link2_ZyNzh', '2');
INSERT INTO `server_url` VALUES ('87', 'http://test223.findourlove.com/link3_p9vCq', '2');
INSERT INTO `server_url` VALUES ('88', 'http://test223.findourlove.com/link4_8r1CE', '2');
INSERT INTO `server_url` VALUES ('89', 'http://test223.findourlove.com/link5_7qM6Y', '2');
INSERT INTO `server_url` VALUES ('90', 'http://test223.findourlove.com/link6_fUQKB', '2');
INSERT INTO `server_url` VALUES ('91', 'http://test223.findourlove.com/link7_tLTQi', '2');
INSERT INTO `server_url` VALUES ('92', 'http://test223.findourlove.com/link8_wqPBR', '2');
INSERT INTO `server_url` VALUES ('94', 'http://test223.findourlove.com/link1_7Yqbn', '2');
INSERT INTO `server_url` VALUES ('95', 'http://test223.findourlove.com/link2_s3VX9', '2');
INSERT INTO `server_url` VALUES ('96', 'http://test223.findourlove.com/link3_sPtCy', '2');
INSERT INTO `server_url` VALUES ('97', 'http://test223.findourlove.com/link4_XFAfz', '2');
INSERT INTO `server_url` VALUES ('98', 'http://test223.findourlove.com/link5_NCsyZ', '2');
INSERT INTO `server_url` VALUES ('99', 'http://test223.findourlove.com/link6_kglwt', '2');
INSERT INTO `server_url` VALUES ('100', 'http://test223.findourlove.com/link7_kxLbZ', '2');
INSERT INTO `server_url` VALUES ('101', 'http://test223.findourlove.com/link8_74VTm', '2');
INSERT INTO `server_url` VALUES ('103', 'http://test223.findourlove.com/link1_5WwK8', '2');
INSERT INTO `server_url` VALUES ('104', 'http://test223.findourlove.com/link2_aU37i', '2');
INSERT INTO `server_url` VALUES ('105', 'http://test223.findourlove.com/link3_84Ggj', '2');
INSERT INTO `server_url` VALUES ('106', 'http://test223.findourlove.com/link4_s8dmI', '2');
INSERT INTO `server_url` VALUES ('107', 'http://test223.findourlove.com/link5_axcEL', '2');
INSERT INTO `server_url` VALUES ('108', 'http://test223.findourlove.com/link6_WU1Fs', '2');
INSERT INTO `server_url` VALUES ('109', 'http://test223.findourlove.com/link7_iZU2L', '2');
INSERT INTO `server_url` VALUES ('110', 'http://test223.findourlove.com/link8_uxByQ', '2');
INSERT INTO `server_url` VALUES ('112', 'http://test223.findourlove.com/link1_H9dFN', '2');
INSERT INTO `server_url` VALUES ('113', 'http://test223.findourlove.com/link2_q6ZsJ', '2');
INSERT INTO `server_url` VALUES ('114', 'http://test223.findourlove.com/link3_ady26', '2');
INSERT INTO `server_url` VALUES ('115', 'http://test223.findourlove.com/link4_H8tHT', '2');
INSERT INTO `server_url` VALUES ('116', 'http://test223.findourlove.com/link5_9maFA', '2');
INSERT INTO `server_url` VALUES ('117', 'http://test223.findourlove.com/link6_x4f0v', '2');
INSERT INTO `server_url` VALUES ('118', 'http://test223.findourlove.com/link7_EVaEe', '2');
INSERT INTO `server_url` VALUES ('119', 'http://test223.findourlove.com/link8_0wkE3', '2');
INSERT INTO `server_url` VALUES ('121', 'http://test223.findourlove.com/7Z9Hd', '1');
INSERT INTO `server_url` VALUES ('122', 'http://test223.findourlove.com/d0rZn', '1');
INSERT INTO `server_url` VALUES ('123', 'http://test223.findourlove.com/i8IrS', '1');
INSERT INTO `server_url` VALUES ('124', 'http://test223.findourlove.com/AWkT8', '1');
INSERT INTO `server_url` VALUES ('125', 'http://test223.findourlove.com/kqAqm', '1');
INSERT INTO `server_url` VALUES ('127', 'http://test223.findourlove.com/link1_s5JcD', '2');
INSERT INTO `server_url` VALUES ('128', 'http://test223.findourlove.com/link2_SeWS4', '2');
INSERT INTO `server_url` VALUES ('129', 'http://test223.findourlove.com/link3_6r8nS', '2');
INSERT INTO `server_url` VALUES ('130', 'http://test223.findourlove.com/link4_sqdDe', '2');
INSERT INTO `server_url` VALUES ('131', 'http://test223.findourlove.com/link5_un93p', '2');
INSERT INTO `server_url` VALUES ('132', 'http://test223.findourlove.com/link6_lnZKV', '2');
INSERT INTO `server_url` VALUES ('133', 'http://test223.findourlove.com/link7_BMmLQ', '2');
INSERT INTO `server_url` VALUES ('134', 'http://test223.findourlove.com/link8_7zW6x', '2');
INSERT INTO `server_url` VALUES ('136', 'http://test223.findourlove.com/link1_T126Y', '2');
INSERT INTO `server_url` VALUES ('137', 'http://test223.findourlove.com/link2_BiTd8', '2');
INSERT INTO `server_url` VALUES ('138', 'http://test223.findourlove.com/link3_4xEN8', '2');
INSERT INTO `server_url` VALUES ('139', 'http://test223.findourlove.com/link4_Dinkl', '2');
INSERT INTO `server_url` VALUES ('140', 'http://test223.findourlove.com/link5_gNBw4', '2');
INSERT INTO `server_url` VALUES ('141', 'http://test223.findourlove.com/link6_pEu6y', '2');
INSERT INTO `server_url` VALUES ('142', 'http://test223.findourlove.com/link7_FaHtY', '2');
INSERT INTO `server_url` VALUES ('143', 'http://test223.findourlove.com/link8_jsJMr', '2');
INSERT INTO `server_url` VALUES ('145', 'http://test223.findourlove.com/9fawG', '1');
INSERT INTO `server_url` VALUES ('146', 'http://test223.findourlove.com/9h8FT', '1');
INSERT INTO `server_url` VALUES ('147', 'http://test223.findourlove.com/8YKAt', '1');
INSERT INTO `server_url` VALUES ('148', 'http://test223.findourlove.com/xxEsh', '1');
INSERT INTO `server_url` VALUES ('149', 'http://test223.findourlove.com/ZJS3j', '1');
INSERT INTO `server_url` VALUES ('151', 'http://test223.findourlove.com/link1_I2w13', '2');
INSERT INTO `server_url` VALUES ('152', 'http://test223.findourlove.com/link2_VeWNy', '2');
INSERT INTO `server_url` VALUES ('153', 'http://test223.findourlove.com/link3_LfGCb', '2');
INSERT INTO `server_url` VALUES ('154', 'http://test223.findourlove.com/link4_LM4wk', '2');
INSERT INTO `server_url` VALUES ('155', 'http://test223.findourlove.com/link5_QVfJK', '2');
INSERT INTO `server_url` VALUES ('156', 'http://test223.findourlove.com/link6_XNbD4', '2');
INSERT INTO `server_url` VALUES ('157', 'http://test223.findourlove.com/link7_AdI0J', '2');
INSERT INTO `server_url` VALUES ('158', 'http://test223.findourlove.com/link8_5nDp1', '2');
INSERT INTO `server_url` VALUES ('160', 'http://test223.findourlove.com/link1_Hp6S2', '2');
INSERT INTO `server_url` VALUES ('161', 'http://test223.findourlove.com/link2_PNXbH', '2');
INSERT INTO `server_url` VALUES ('162', 'http://test223.findourlove.com/link3_bd5c6', '2');
INSERT INTO `server_url` VALUES ('163', 'http://test223.findourlove.com/link4_Csiqs', '2');
INSERT INTO `server_url` VALUES ('164', 'http://test223.findourlove.com/link5_y7MfF', '2');
INSERT INTO `server_url` VALUES ('165', 'http://test223.findourlove.com/link6_CTNjP', '2');
INSERT INTO `server_url` VALUES ('166', 'http://test223.findourlove.com/link7_RVX20', '2');
INSERT INTO `server_url` VALUES ('167', 'http://test223.findourlove.com/link8_Jmsvp', '2');
INSERT INTO `server_url` VALUES ('169', 'http://test223.findourlove.com/link1_w0BKS', '2');
INSERT INTO `server_url` VALUES ('170', 'http://test223.findourlove.com/link2_tP1K5', '2');
INSERT INTO `server_url` VALUES ('171', 'http://test223.findourlove.com/link3_PCqCj', '2');
INSERT INTO `server_url` VALUES ('172', 'http://test223.findourlove.com/link4_FLBwb', '2');
INSERT INTO `server_url` VALUES ('173', 'http://test223.findourlove.com/link5_fewVN', '2');
INSERT INTO `server_url` VALUES ('174', 'http://test223.findourlove.com/link6_Awczj', '2');
INSERT INTO `server_url` VALUES ('175', 'http://test223.findourlove.com/link7_4Yivn', '2');
INSERT INTO `server_url` VALUES ('176', 'http://test223.findourlove.com/link8_VgBnD', '2');
INSERT INTO `server_url` VALUES ('178', 'http://test223.findourlove.com/link1_Qxipf', '2');
INSERT INTO `server_url` VALUES ('179', 'http://test223.findourlove.com/link2_sVxp3', '2');
INSERT INTO `server_url` VALUES ('180', 'http://test223.findourlove.com/link3_v4MWB', '2');
INSERT INTO `server_url` VALUES ('181', 'http://test223.findourlove.com/link4_Bd2iP', '2');
INSERT INTO `server_url` VALUES ('182', 'http://test223.findourlove.com/link5_qnA0u', '2');
INSERT INTO `server_url` VALUES ('183', 'http://test223.findourlove.com/link6_5VhhT', '2');
INSERT INTO `server_url` VALUES ('184', 'http://test223.findourlove.com/link7_dy2Ab', '2');
INSERT INTO `server_url` VALUES ('185', 'http://test223.findourlove.com/link8_rKJuG', '2');
INSERT INTO `server_url` VALUES ('187', 'http://test223.findourlove.com/FPCtB', '1');
INSERT INTO `server_url` VALUES ('188', 'http://test223.findourlove.com/Bs6eN', '1');
INSERT INTO `server_url` VALUES ('189', 'http://test223.findourlove.com/d5GI7', '1');
INSERT INTO `server_url` VALUES ('190', 'http://test223.findourlove.com/Wj0iS', '1');
INSERT INTO `server_url` VALUES ('191', 'http://test223.findourlove.com/dJ8ZB', '1');
INSERT INTO `server_url` VALUES ('193', 'http://test223.findourlove.com/link1_02i1C', '2');
INSERT INTO `server_url` VALUES ('194', 'http://test223.findourlove.com/link2_CXG6g', '2');
INSERT INTO `server_url` VALUES ('195', 'http://test223.findourlove.com/link3_Wv9q1', '2');
INSERT INTO `server_url` VALUES ('196', 'http://test223.findourlove.com/link4_cZxnB', '2');
INSERT INTO `server_url` VALUES ('197', 'http://test223.findourlove.com/link5_ud8e7', '2');
INSERT INTO `server_url` VALUES ('198', 'http://test223.findourlove.com/link6_U5Fh2', '2');
INSERT INTO `server_url` VALUES ('199', 'http://test223.findourlove.com/link7_R0RUK', '2');
INSERT INTO `server_url` VALUES ('200', 'http://test223.findourlove.com/link8_Tvu7x', '2');
INSERT INTO `server_url` VALUES ('202', 'http://test223.findourlove.com/y9UEG', '1');
INSERT INTO `server_url` VALUES ('203', 'http://test223.findourlove.com/SlZx6', '1');
INSERT INTO `server_url` VALUES ('204', 'http://test223.findourlove.com/n5FmJ', '1');
INSERT INTO `server_url` VALUES ('205', 'http://test223.findourlove.com/jvQpQ', '1');
INSERT INTO `server_url` VALUES ('206', 'http://test223.findourlove.com/71DdC', '1');
INSERT INTO `server_url` VALUES ('208', 'http://test223.findourlove.com/link1_0AFN1', '2');
INSERT INTO `server_url` VALUES ('209', 'http://test223.findourlove.com/link2_LCYaK', '2');
INSERT INTO `server_url` VALUES ('210', 'http://test223.findourlove.com/link3_zShFK', '2');
INSERT INTO `server_url` VALUES ('211', 'http://test223.findourlove.com/link4_qpzMZ', '2');
INSERT INTO `server_url` VALUES ('212', 'http://test223.findourlove.com/link5_py0Yp', '2');
INSERT INTO `server_url` VALUES ('213', 'http://test223.findourlove.com/link6_DtWYJ', '2');
INSERT INTO `server_url` VALUES ('214', 'http://test223.findourlove.com/link7_kl8MN', '2');
INSERT INTO `server_url` VALUES ('215', 'http://test223.findourlove.com/link8_FAz92', '2');
INSERT INTO `server_url` VALUES ('217', 'http://test223.findourlove.com/ulDej', '1');
INSERT INTO `server_url` VALUES ('218', 'http://test223.findourlove.com/yjVS6', '1');
INSERT INTO `server_url` VALUES ('219', 'http://test223.findourlove.com/ygpVS', '1');
INSERT INTO `server_url` VALUES ('220', 'http://test223.findourlove.com/rSZKR', '1');
INSERT INTO `server_url` VALUES ('221', 'http://test223.findourlove.com/Bz4s1', '1');
INSERT INTO `server_url` VALUES ('223', 'http://test223.findourlove.com/link1_3MQbp', '2');
INSERT INTO `server_url` VALUES ('224', 'http://test223.findourlove.com/link2_3auEe', '2');
INSERT INTO `server_url` VALUES ('225', 'http://test223.findourlove.com/link3_Tkhri', '2');
INSERT INTO `server_url` VALUES ('226', 'http://test223.findourlove.com/link4_asX18', '2');
INSERT INTO `server_url` VALUES ('227', 'http://test223.findourlove.com/link5_hib3Q', '2');
INSERT INTO `server_url` VALUES ('228', 'http://test223.findourlove.com/link6_MFjKN', '2');
INSERT INTO `server_url` VALUES ('229', 'http://test223.findourlove.com/link7_XaJWE', '2');
INSERT INTO `server_url` VALUES ('230', 'http://test223.findourlove.com/link8_DzBIv', '2');
INSERT INTO `server_url` VALUES ('232', 'http://test223.findourlove.com/s9A6b', '1');
INSERT INTO `server_url` VALUES ('233', 'http://test223.findourlove.com/bmGpa', '1');
INSERT INTO `server_url` VALUES ('234', 'http://test223.findourlove.com/FXHZS', '1');
INSERT INTO `server_url` VALUES ('235', 'http://test223.findourlove.com/fVSpr', '1');
INSERT INTO `server_url` VALUES ('236', 'http://test223.findourlove.com/4Tbjw', '1');
INSERT INTO `server_url` VALUES ('238', 'http://test223.findourlove.com/link1_gzhJF', '2');
INSERT INTO `server_url` VALUES ('239', 'http://test223.findourlove.com/link2_yAxsD', '2');
INSERT INTO `server_url` VALUES ('240', 'http://test223.findourlove.com/link3_vPs8v', '2');
INSERT INTO `server_url` VALUES ('241', 'http://test223.findourlove.com/link4_Z2ZCg', '2');
INSERT INTO `server_url` VALUES ('242', 'http://test223.findourlove.com/link5_ZgiQ8', '2');
INSERT INTO `server_url` VALUES ('243', 'http://test223.findourlove.com/link6_suMUT', '2');
INSERT INTO `server_url` VALUES ('244', 'http://test223.findourlove.com/link7_Pjnc8', '2');
INSERT INTO `server_url` VALUES ('245', 'http://test223.findourlove.com/link8_nJHDP', '2');
INSERT INTO `server_url` VALUES ('247', 'http://test223.findourlove.com/link1_87A3N', '2');
INSERT INTO `server_url` VALUES ('248', 'http://test223.findourlove.com/link2_UQlun', '2');
INSERT INTO `server_url` VALUES ('249', 'http://test223.findourlove.com/link3_kbXdq', '2');
INSERT INTO `server_url` VALUES ('250', 'http://test223.findourlove.com/link4_6bgV2', '2');
INSERT INTO `server_url` VALUES ('251', 'http://test223.findourlove.com/link5_ndykN', '2');
INSERT INTO `server_url` VALUES ('252', 'http://test223.findourlove.com/link6_VPGrC', '2');
INSERT INTO `server_url` VALUES ('253', 'http://test223.findourlove.com/link7_dE4AB', '2');
INSERT INTO `server_url` VALUES ('254', 'http://test223.findourlove.com/link8_NxDsZ', '2');

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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of web_side
-- ----------------------------
INSERT INTO `web_side` VALUES ('1', '3', '1', '1');
