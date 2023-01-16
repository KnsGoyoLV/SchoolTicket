-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- Schema mydb
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema mydb
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `mydb` DEFAULT CHARACTER SET utf8 ;
USE `mydb` ;

-- -----------------------------------------------------
-- Table `mydb`.`lietotajs`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`lietotajs` (
  `lietotajs_id` INT NOT NULL AUTO_INCREMENT,
  `vards` VARCHAR(45) NOT NULL,
  `uzvards` VARCHAR(45) NOT NULL,
  `epasts` VARCHAR(45) NOT NULL,
  `loma` ENUM("Skolotājs", "Admin", "SU", "Strādnieks") NULL DEFAULT 'Skolotājs',
  PRIMARY KEY (`lietotajs_id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`ticket`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `mydb`.`ticket` (
  `ticket_idt` INT NOT NULL AUTO_INCREMENT,
  `laiks` DATE NOT NULL,
  `iela` ENUM("Vānes iela", "Ventspils iela") NOT NULL DEFAULT 'Ventspils iela',
  `klase` VARCHAR(45) NOT NULL,
  `problema` TEXT NULL,
  `piezimes` VARCHAR(45) NULL,
  `apstiprinats` TINYINT NULL,
  `status` ENUM("Nav iesākts", "Iesākts", "Pabeigts") NULL DEFAULT 'Nav iesākts',
  `id_lietotajs` INT NOT NULL,
  PRIMARY KEY (`ticket_idt`, `id_lietotajs`),
  INDEX `fk_ticket_lietotajs_idx` (`id_lietotajs` ASC) VISIBLE,
  CONSTRAINT `fk_ticket_lietotajs`
    FOREIGN KEY (`id_lietotajs`)
    REFERENCES `mydb`.`lietotajs` (`lietotajs_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
