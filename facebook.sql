-- Adminer 4.1.0 MySQL dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

DROP TABLE IF EXISTS `posts`;
CREATE TABLE `posts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `content` text NOT NULL,
  `date` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `posts` (`id`, `content`, `date`) VALUES
(12,	'<script>alert(1);</script>',	'2014-11-29 18:31:43'),
(13,	'<b>test</b>',	'2014-11-29 18:31:53'),
(14,	'<a onclick=\"alert(1);\">test</a>',	'2014-11-29 18:39:26'),
(15,	'<a href=\"#\">test</a>',	'2014-11-29 18:39:45');

-- 2014-11-29 18:12:11
