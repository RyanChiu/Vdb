cars	CREATE TABLE `cars` (
 `id` int(11) NOT NULL AUTO_INCREMENT,
 `name` varchar(128) NOT NULL,
 `make` varchar(128) NOT NULL,
 `model` varchar(128) NOT NULL,
 `style` varchar(128) NOT NULL,
 `brief` varchar(512) DEFAULT NULL,
 `detail` text,
 `image` varchar(128) NOT NULL,
 PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1
locals	CREATE TABLE `locals` (
 `id` int(11) NOT NULL AUTO_INCREMENT,
 `carid` int(11) NOT NULL,
 `price` decimal(10,0) NOT NULL,
 `discount` decimal(10,0) NOT NULL DEFAULT '0',
 `zip` varchar(16) NOT NULL,
 PRIMARY KEY (`id`),
 UNIQUE KEY `carid` (`carid`,`zip`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1
makes	CREATE TABLE `makes` (
 `id` int(11) NOT NULL,
 `name` varchar(128) NOT NULL,
 `niceName` varchar(128) NOT NULL,
 UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1
models	CREATE TABLE `models` (
 `id` varchar(128) NOT NULL,
 `makeid` int(11) NOT NULL,
 `name` varchar(128) NOT NULL,
 `niceName` varchar(128) NOT NULL,
 `year` char(4) NOT NULL,
 UNIQUE KEY `id` (`id`,`year`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1
pre_makes	CREATE TABLE `pre_makes` (
 `id` int(11) NOT NULL,
 `name` varchar(128) NOT NULL,
 `niceName` varchar(128) NOT NULL,
 `updateTime` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1
pre_models	CREATE TABLE `pre_models` (
 `id` varchar(128) NOT NULL,
 `makeid` int(11) NOT NULL,
 `name` varchar(128) NOT NULL,
 `niceName` varchar(128) NOT NULL,
 `year` char(4) NOT NULL,
 `updateTime` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1
users	CREATE TABLE `users` (
 `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
 `username` varchar(50) DEFAULT NULL,
 `password` varchar(255) DEFAULT NULL,
 `role` tinyint(20) DEFAULT NULL,
 `created` datetime DEFAULT NULL,
 `modified` datetime DEFAULT NULL,
 PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1