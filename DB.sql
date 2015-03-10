-- MySQL Script generated by MySQL Workbench
-- Mon Mar  9 17:57:57 2015
-- Model: New Model    Version: 1.0
-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

-- -----------------------------------------------------
-- Schema DojoPong
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema DojoPong
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `DojoPong` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci ;
USE `DojoPong` ;

-- -----------------------------------------------------
-- Table `DojoPong`.`players`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `DojoPong`.`players` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(45) NULL,
  `created_at` DATETIME NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `DojoPong`.`table1`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `DojoPong`.`table1` (
)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `DojoPong`.`player2`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `DojoPong`.`player2` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(45) NULL,
  `created_at` DATETIME NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `DojoPong`.`games`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `DojoPong`.`games` (
  `player1_id` INT NOT NULL,
  `player2_id` INT NOT NULL,
  `player1_score` INT NULL,
  `player2_score` INT NULL,
  PRIMARY KEY (`player1_id`, `player2_id`),
  INDEX `fk_player1_has_player2_player21_idx` (`player2_id` ASC),
  INDEX `fk_player1_has_player2_player1_idx` (`player1_id` ASC),
  CONSTRAINT `fk_player1_has_player2_player1`
    FOREIGN KEY (`player1_id`)
    REFERENCES `DojoPong`.`players` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_player1_has_player2_player21`
    FOREIGN KEY (`player2_id`)
    REFERENCES `DojoPong`.`player2` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
