/*
Navicat MySQL Data Transfer

Source Server         : database
Source Server Version : 50525
Source Host           : localhost:3306
Source Database       : calendar

Target Server Type    : MYSQL
Target Server Version : 50525
File Encoding         : 65001

Date: 2013-05-20 21:03:21
*/

SET FOREIGN_KEY_CHECKS=0;
-- ----------------------------
-- Table structure for `event`
-- ----------------------------
DROP TABLE IF EXISTS `event`;
CREATE TABLE `event` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT 'Id записи',
  `user_id` int(10) unsigned NOT NULL COMMENT 'Id пользователя добавившего запись',
  `create_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT 'Дата и время создания',
  `event_date` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' COMMENT 'Дата и время будущего события',
  `title` varchar(150) NOT NULL COMMENT 'Заголовок события',
  `link_user` int(10) unsigned DEFAULT NULL COMMENT 'Пользователь связанный с этим событием',
  `event_type` enum('деловое','личное','прочее') DEFAULT 'личное' COMMENT 'Тип события',
  `event_text` text COMMENT 'Текст события',
  PRIMARY KEY (`id`),
  KEY `users_fk` (`user_id`),
  KEY `user_link_fk` (`link_user`),
  CONSTRAINT `users_fk` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE,
  CONSTRAINT `user_link_fk` FOREIGN KEY (`link_user`) REFERENCES `users` (`user_id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COMMENT='Таблица событий, создаваемые пользователями';

-- ----------------------------
-- Records of event
-- ----------------------------
INSERT INTO `event` VALUES ('4', '3', '2013-05-20 00:00:00', '2013-05-23 11:37:49', 'Первая запись', '5', 'личное', 'Тут будет текст события');
INSERT INTO `event` VALUES ('5', '3', '2013-05-20 00:00:00', '2013-05-26 11:40:10', 'Вторая запись', '6', 'личное', 'Тут тоже текст');

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
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COMMENT='Таблица пользователей';

-- ----------------------------
-- Records of users
-- ----------------------------
INSERT INTO `users` VALUES ('3', 'UserOne', 'user@mail.ru', 'admin');
