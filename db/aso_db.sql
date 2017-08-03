/*
Navicat MySQL Data Transfer

Source Server         : localhost_3306
Source Server Version : 50717
Source Host           : localhost:3306
Source Database       : aso_db

Target Server Type    : MYSQL
Target Server Version : 50717
File Encoding         : 65001

Date: 2017-08-03 09:19:43
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
INSERT INTO `admin` VALUES ('1', 'admin', '3a03f7ac3b80f88b7eaf95253d5a73e8', null, '0', '1501656795', '11', '0.0.0.0', '1', '1');

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
  `path` varchar(255) DEFAULT NULL COMMENT '生成的HTML保存路径',
  `type` tinyint(4) unsigned DEFAULT '1' COMMENT '请求类型',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of request_log
-- ----------------------------
INSERT INTO `request_log` VALUES ('1', '3', 'a:8:{s:4:\"type\";s:1:\"1\";s:7:\"webType\";s:2:\"10\";s:2:\"ip\";s:11:\"47.52.8.223\";s:9:\"server_id\";i:3;s:12:\"request_time\";i:1501667574;s:11:\"template_id\";i:3;s:13:\"template_path\";s:32:\"20170731/watercress_1/index.html\";s:4:\"path\";s:43:\"template\\20170731/watercress_1/index_1.html\";}', '1501667574', '3', 'template\\20170731/watercress_1/index_1.html', '1');
INSERT INTO `request_log` VALUES ('2', '3', 'a:8:{s:4:\"type\";s:1:\"1\";s:7:\"webType\";s:2:\"10\";s:2:\"ip\";s:11:\"47.52.8.223\";s:9:\"server_id\";i:3;s:12:\"request_time\";i:1501667613;s:11:\"template_id\";i:3;s:13:\"template_path\";s:32:\"20170731/watercress_1/index.html\";s:4:\"path\";s:43:\"template\\20170731/watercress_1/index_2.html\";}', '1501667613', '3', 'template\\20170731/watercress_1/index_2.html', '1');

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
  `next_url` varchar(255) DEFAULT NULL COMMENT '下一次请求访问url',
  `folder` varchar(15) DEFAULT NULL COMMENT '生成的文件夹名称',
  `addtime` int(11) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of server
-- ----------------------------
INSERT INTO `server` VALUES ('3', 'aso1', '47.52.8.223', 'test223.findourlove.com', '2', '1501667613', 'test223.findourlove.comindex/index/index.php', 'index', '1501656608');
INSERT INTO `server` VALUES ('4', 'aso2', '47.52.9.54', 'test54.findourlove.com', '0', '0', null, 'index', '1501656620');

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
