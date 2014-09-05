#DROP TABLE IF EXISTS `#__lbportfolio_cat`;
CREATE TABLE IF NOT EXISTS `#__lbportfolio_cat` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `published` tinyint(4) DEFAULT NULL,
  `description` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8

#DROP TABLE IF EXISTS `#__lbportfolio_item`;
CREATE TABLE IF NOT EXISTS `#__lbportfolio_item` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `description` text,
  `url` varchar(255) DEFAULT NULL,
  `published` tinyint(4) DEFAULT NULL,
  `img` varchar(255) DEFAULT NULL,
  `thumb` varchar(255) DEFAULT NULL,
  `cat_id` int(11),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8