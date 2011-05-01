CREATE SCHEMA `TaskManager` DEFAULT CHARACTER SET utf8 COLLATE utf8_bin;
CREATE TABLE `TaskManager`.`user_entity` (
 `email` VARCHAR(100) NOT NULL COMMENT 'The preferred way to contact this user. Also works as a login.' ,
 `screenName` VARCHAR(25) NOT NULL COMMENT 'The name the user are shown them selves or others.' ,
 `passwd` TEXT NOT NULL COMMENT 'Hashed with either SHA1 or MD5 encoding.' ,
 `createdAt` DATETIME NOT NULL COMMENT 'When this entity was created. It\'s part since we might want to track this as well as use it for various salts.' ,
 PRIMARY KEY (`email`) )
ENGINE = MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT = 'Defines a user entity in the TaskManager application';
CREATE TABLE `user_contact_data_entity` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT 'Unsigned int ID that autoincs as more are added.',
  `type` enum('PROTOCOL','BIODATA','OTHER') COLLATE utf8_bin NOT NULL,
  `identifier` varchar(15) COLLATE utf8_bin NOT NULL,
  `data` varchar(512) COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='This represents one contact data point about one user.';
ALTER TABLE `TaskManager`.`user_contact_data_entity` ADD COLUMN `fk_user_email` VARCHAR(100) NOT NULL  AFTER `id`;
