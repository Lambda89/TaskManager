delimiter $$

CREATE DATABASE `TaskManager` /*!40100 DEFAULT CHARACTER SET utf8 COLLATE utf8_bin */$$

delimiter $$

CREATE TABLE `user_contact_data_entity` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT 'Unsigned int ID that autoincs as more are added.',
  `fk_user_email` varchar(100) COLLATE utf8_bin NOT NULL,
  `type` enum('PROTOCOL','BIODATA','OTHER') COLLATE utf8_bin NOT NULL,
  `identifier` varchar(15) COLLATE utf8_bin NOT NULL,
  `data` varchar(512) COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='This represents one contact data point about one user.'$$

delimiter $$

CREATE TABLE `user_entity` (
  `email` varchar(100) COLLATE utf8_bin NOT NULL COMMENT 'The preferred way to contact this user. Also works as a login.',
  `login` varchar(25) COLLATE utf8_bin NOT NULL COMMENT 'The name the user are shown them selves or others.',
  `passwd` text COLLATE utf8_bin NOT NULL COMMENT 'Hashed with either SHA1 or MD5 encoding.',
  `createdAt` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'When this entity was created. It''s part since we might want to track this as well as use it for various salts.',
  `status` enum('ACTIVE','INACTIVE','BANNED','REGISTERED','NOUSER') COLLATE utf8_bin NOT NULL,
  `loggedIn` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Defines a user entity in the TaskManager application'$$

