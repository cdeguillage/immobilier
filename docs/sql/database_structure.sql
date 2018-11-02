-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- Schema immobilier
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema immobilier
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `immobilier` DEFAULT CHARACTER SET utf8 ;
USE `immobilier` ;

-- -----------------------------------------------------
-- Table `immobilier`.`type`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `immobilier`.`type` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `typeLogement` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `immobilier`.`logement`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `immobilier`.`logement` (
  `id_logement` INT NOT NULL AUTO_INCREMENT,
  `titre` VARCHAR(45) NOT NULL,
  `adresse` VARCHAR(45) NOT NULL,
  `ville` VARCHAR(45) NOT NULL,
  `cp` VARCHAR(15) NOT NULL,
  `surface` DECIMAL(8,2) NULL,
  `prix` DECIMAL(10,2) NULL,
  `photo` VARCHAR(255) NULL,
  `description` VARCHAR(255) NULL,
  `id_typeLogement` INT NOT NULL,
  PRIMARY KEY (`id_logement`)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
