-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';


CREATE TABLE IF NOT EXISTS `risinajums` (
  `risinajums_id` INT NOT NULL AUTO_INCREMENT,
  `daritajs` VARCHAR(45) NOT NULL,
  `status` ENUM("Neatrisināts", "Procesā", "Atrisināts") NOT NULL DEFAULT 'Neatrisināts',
  `apstiprinats` TINYINT NULL DEFAULT 0,
  `piezime` TEXT NULL,
  PRIMARY KEY (`risinajums_id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`pieteikums`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `pieteikums` (
  `ticket_id` INT NOT NULL,
  `laiks` DATE NOT NULL,
  `iela` ENUM("Vānes iela", "Ventspils iela") NOT NULL DEFAULT 'Ventspils iela',
  `problema` TEXT NOT NULL,
  `piezimes` TEXT NULL,
  `risinajums_risinajums_id` INT NOT NULL,
  PRIMARY KEY (`ticket_id`, `risinajums_risinajums_id`),
  INDEX `fk_pieteikums_risinajums1_idx` (`risinajums_risinajums_id` ASC),
  CONSTRAINT `fk_pieteikums_risinajums1`
    FOREIGN KEY (`risinajums_risinajums_id`)
    REFERENCES `risinajums` (`risinajums_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`problema`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `problema` (
  `problema_id` INT NOT NULL AUTO_INCREMENT,
  `it_nodala` VARCHAR(45) NULL,
  `saimniecibas_nodala` VARCHAR(45) NULL,
  `pieteikums_ticket_id` INT NOT NULL,
  PRIMARY KEY (`problema_id`, `pieteikums_ticket_id`),
  INDEX `fk_problema_pieteikums1_idx` (`pieteikums_ticket_id` ASC),
  CONSTRAINT `fk_problema_pieteikums1`
    FOREIGN KEY (`pieteikums_ticket_id`)
    REFERENCES `pieteikums` (`ticket_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`skolotaji`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `skolotaji` (
  `lomas_id` INT NOT NULL AUTO_INCREMENT,
  `it_admins` VARCHAR(45) NULL,
  `saimniecibas_nod_admins` VARCHAR(45) NULL,
  `skolotajs` VARCHAR(45) NULL,
  `kons_sar_admins` VARCHAR(45) NULL,
  `vards` VARCHAR(45) NULL,
  `uzvards` VARCHAR(45) NULL,
  `epasts` VARCHAR(45) NULL,
  `problema_problema_id` INT NOT NULL,
  PRIMARY KEY (`lomas_id`, `problema_problema_id`),
  INDEX `fk_skolotaji_problema1_idx` (`problema_problema_id` ASC),
  CONSTRAINT `fk_skolotaji_problema1`
    FOREIGN KEY (`problema_problema_id`)
    REFERENCES `problema` (`problema_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`konsultacijas`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `konsultacijas` (
  `konsultacijas_id` INT NOT NULL AUTO_INCREMENT,
  `sakums` DATE NOT NULL,
  `beigas` DATE NOT NULL,
  `id_skolotaji` INT NOT NULL,
  PRIMARY KEY (`konsultacijas_id`, `id_skolotaji`),
  INDEX `fk_konsultacijas_skolotaji_idx` (`id_skolotaji` ASC),
  CONSTRAINT `fk_konsultacijas_skolotaji`
    FOREIGN KEY (`id_skolotaji`)
    REFERENCES `skolotaji` (`lomas_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`apstiprinajums`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `apstiprinajums` (
  `apstiprinajums_id` INT NOT NULL AUTO_INCREMENT,
  `apstiprinajums` ENUM("Apstiprināts", "Noliegts") NOT NULL DEFAULT 'Noliegts',
  PRIMARY KEY (`apstiprinajums_id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`pieteikties`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `pieteikties` (
  `pieteikties_id` INT NOT NULL AUTO_INCREMENT,
  `tema` ENUM("") NOT NULL,
  `izvele` ENUM("Mācīties", "Labot") NOT NULL,
  `konsultacijas_konsultacijas_id` INT NOT NULL,
  `konsultacijas_id_skolotaji` INT NOT NULL,
  `apstiprinajums_apstiprinajums_id` INT NOT NULL,
  PRIMARY KEY (`pieteikties_id`, `konsultacijas_konsultacijas_id`, `konsultacijas_id_skolotaji`, `apstiprinajums_apstiprinajums_id`),
  INDEX `fk_pieteikties_konsultacijas1_idx` (`konsultacijas_konsultacijas_id` ASC, `konsultacijas_id_skolotaji` ASC),
  INDEX `fk_pieteikties_apstiprinajums1_idx` (`apstiprinajums_apstiprinajums_id` ASC),
  CONSTRAINT `fk_pieteikties_konsultacijas1`
    FOREIGN KEY (`konsultacijas_konsultacijas_id` , `konsultacijas_id_skolotaji`)
    REFERENCES `konsultacijas` (`konsultacijas_id` , `id_skolotaji`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_pieteikties_apstiprinajums1`
    FOREIGN KEY (`apstiprinajums_apstiprinajums_id`)
    REFERENCES `apstiprinajums` (`apstiprinajums_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`skolnieki`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `skolnieki` (
  `skolnieki_id` INT NOT NULL AUTO_INCREMENT,
  `audzeknis` VARCHAR(45) NULL,
  `vards` VARCHAR(45) NULL,
  `uzvards` VARCHAR(45) NULL,
  `epasts` VARCHAR(45) NULL,
  `kurss` VARCHAR(45) NULL,
  `pieteikties_pieteikties_id` INT NOT NULL,
  PRIMARY KEY (`skolnieki_id`, `pieteikties_pieteikties_id`),
  INDEX `fk_skolnieki_pieteikties1_idx` (`pieteikties_pieteikties_id` ASC),
  CONSTRAINT `fk_skolnieki_pieteikties1`
    FOREIGN KEY (`pieteikties_pieteikties_id`)
    REFERENCES `pieteikties` (`pieteikties_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
