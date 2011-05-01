SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL';

DROP SCHEMA IF EXISTS `TaskManager` ;
CREATE SCHEMA IF NOT EXISTS `TaskManager` DEFAULT CHARACTER SET utf8 COLLATE utf8_bin ;
USE `TaskManager` ;

-- -----------------------------------------------------
-- Table `TaskManager`.`user_contact_data_entity`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `TaskManager`.`user_contact_data_entity` ;

CREATE  TABLE IF NOT EXISTS `TaskManager`.`user_contact_data_entity` (
  `id` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'Unsigned int ID that autoincs as more are added.' ,
  `fk_user_email` VARCHAR(100) CHARACTER SET 'utf8' COLLATE 'utf8_bin' NOT NULL ,
  `type` ENUM('PROTOCOL','BIODATA','OTHER') CHARACTER SET 'utf8' COLLATE 'utf8_bin' NOT NULL ,
  `identifier` VARCHAR(15) CHARACTER SET 'utf8' COLLATE 'utf8_bin' NOT NULL ,
  `data` VARCHAR(512) CHARACTER SET 'utf8' COLLATE 'utf8_bin' NOT NULL ,
  PRIMARY KEY (`id`) )
ENGINE = MyISAM
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_bin
COMMENT = 'This represents one contact data point about one user.';


-- -----------------------------------------------------
-- Table `TaskManager`.`user_entity`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `TaskManager`.`user_entity` ;

CREATE  TABLE IF NOT EXISTS `TaskManager`.`user_entity` (
  `email` VARCHAR(100) CHARACTER SET 'utf8' COLLATE 'utf8_bin' NOT NULL COMMENT 'The preferred way to contact this user. Also works as a login.' ,
  `screenName` VARCHAR(25) CHARACTER SET 'utf8' COLLATE 'utf8_bin' NOT NULL COMMENT 'The name the user are shown them selves or others.' ,
  `passwd` TEXT CHARACTER SET 'utf8' COLLATE 'utf8_bin' NOT NULL COMMENT 'Hashed with either SHA1 or MD5 encoding.' ,
  `createdAt` DATETIME NOT NULL COMMENT 'When this entity was created. It\'s part since we might want to track this as well as use it for various salts.' ,
  PRIMARY KEY (`email`) )
ENGINE = MyISAM
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_bin
COMMENT = 'Defines a user entity in the TaskManager application';



SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
