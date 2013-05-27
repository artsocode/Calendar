/*
Navicat MySQL Data Transfer

Source Server         : database
Source Server Version : 50525
Source Host           : localhost:3306
Source Database       : calendar

Target Server Type    : MYSQL
Target Server Version : 50525
File Encoding         : 65001

Date: 2013-05-27 15:48:42
*/

SET FOREIGN_KEY_CHECKS=0;
-- ----------------------------
-- Table structure for `event`
-- ----------------------------
DROP TABLE IF EXISTS `event`;
CREATE TABLE `event` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT 'Id записи',
  `user_id` int(10) unsigned NOT NULL COMMENT 'Id пользователя добавившего запись',
  `create_date` date NOT NULL DEFAULT '0000-00-00' COMMENT 'Дата и время создания',
  `event_date` date NOT NULL DEFAULT '0000-00-00' COMMENT 'Дата и время будущего события',
  `title` varchar(150) NOT NULL COMMENT 'Заголовок события',
  `link_user` int(10) unsigned DEFAULT NULL COMMENT 'Пользователь связанный с этим событием',
  `event_type` enum('деловое','личное','прочее') DEFAULT 'личное' COMMENT 'Тип события',
  `event_text` varchar(140) DEFAULT NULL COMMENT 'Текст события',
  PRIMARY KEY (`id`),
  KEY `users_fk` (`user_id`),
  KEY `user_link_fk` (`link_user`),
  CONSTRAINT `users_fk` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE,
  CONSTRAINT `user_link_fk` FOREIGN KEY (`link_user`) REFERENCES `users` (`user_id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=54 DEFAULT CHARSET=utf8 COMMENT='Таблица событий, создаваемые пользователями';

-- ----------------------------
-- Table structure for `users`
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `user_id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT 'Id пользователя',
  `username` varchar(50) NOT NULL COMMENT 'Username пользователя',
  `email` varchar(255) NOT NULL COMMENT 'Email пользователя',
  `password` varchar(255) NOT NULL COMMENT 'Пароль',
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8 COMMENT='Таблица пользователей';

-- ----------------------------
-- Records of users
-- ----------------------------
INSERT INTO `users` VALUES ('5', 'andreySkripin', 'a@artcream.ru', '$1$Qi3.Za1.$aCW3RUoyymmWBYS/yokdq1');
INSERT INTO `users` VALUES ('11', 'infernall666', 'infernall@inbox.ru', '$1$Dn4.QN/.$Ff3z9zKKlD7Ar3013J4Fu1');

-- ----------------------------
-- View structure for `event_type`
-- ----------------------------
DROP VIEW IF EXISTS `event_type`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `event_type` AS select '0' AS `id`,'Деловое' AS `type_name` union all select '1' AS `id`,'Личное' AS `type_name` union all select '2' AS `id`,'Прочее' AS `type_name`;
