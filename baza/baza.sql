START TRANSACTION;
-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- Schema WebDiP2020x057
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema WebDiP2020x057
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `WebDiP2020x057` DEFAULT CHARACTER SET utf8 ;
USE `WebDiP2020x057` ;

-- -----------------------------------------------------
-- Table `WebDiP2020x057`.`uloga`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `WebDiP2020x057`.`uloga` (
  `id_uloga` INT NOT NULL AUTO_INCREMENT,
  `naziv` VARCHAR(25) CHARACTER SET 'utf8' COLLATE 'utf8_general_ci' NOT NULL,
  PRIMARY KEY (`id_uloga`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `WebDiP2020x057`.`korisnik`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `WebDiP2020x057`.`korisnik` (
  `id_korisnik` INT NOT NULL AUTO_INCREMENT,
  `ime` VARCHAR(25) CHARACTER SET 'utf8' COLLATE 'utf8_general_ci' NOT NULL,
  `prezime` VARCHAR(50) CHARACTER SET 'utf8' COLLATE 'utf8_general_ci' NOT NULL,
  `korisnicko_ime` VARCHAR(20) CHARACTER SET 'utf8' COLLATE 'utf8_general_ci' NOT NULL,
  `email` VARCHAR(45) CHARACTER SET 'utf8' COLLATE 'utf8_general_ci' NOT NULL,
  `lozinka_citljiva` VARCHAR(50) CHARACTER SET 'utf8' COLLATE 'utf8_general_ci' NOT NULL,
  `lozinka_sha256` CHAR(64) CHARACTER SET 'utf8' COLLATE 'utf8_general_ci' NOT NULL,
  `uvjeti` TIMESTAMP NULL,
  `datum_registracije` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
  `status_blokade` TINYINT NULL,
  `broj_neuspjesnih_prijava` INT NULL,
  `id_uloga` INT NOT NULL DEFAULT 3,
  PRIMARY KEY (`id_korisnik`),
  INDEX `fk_korisnik_uloga_idx` (`id_uloga` ASC),
  CONSTRAINT `fk_korisnik_uloga`
    FOREIGN KEY (`id_uloga`)
    REFERENCES `WebDiP2020x057`.`uloga` (`id_uloga`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `WebDiP2020x057`.`tip_radnje`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `WebDiP2020x057`.`tip_radnje` (
  `id_tip` INT NOT NULL AUTO_INCREMENT,
  `naziv` VARCHAR(25) CHARACTER SET 'utf8' COLLATE 'utf8_general_ci' NOT NULL,
  PRIMARY KEY (`id_tip`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `WebDiP2020x057`.`dnevnik`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `WebDiP2020x057`.`dnevnik` (
  `id_dnevnik` INT NOT NULL AUTO_INCREMENT,
  `url` VARCHAR(45) NOT NULL,
  `datum_vrijeme` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `upit` TEXT NULL,
  `opis_radnje` TEXT NULL,
  `id_radnja` INT NOT NULL,
  `id_izvrsitelj` INT NOT NULL,
  PRIMARY KEY (`id_dnevnik`),
  INDEX `fk_dnevnik_tip_radnje1_idx` (`id_radnja` ASC),
  INDEX `fk_dnevnik_korisnik1_idx` (`id_izvrsitelj` ASC),
  CONSTRAINT `fk_dnevnik_tip_radnje`
    FOREIGN KEY (`id_radnja`)
    REFERENCES `WebDiP2020x057`.`tip_radnje` (`id_tip`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_dnevnik_korisnik`
    FOREIGN KEY (`id_izvrsitelj`)
    REFERENCES `WebDiP2020x057`.`korisnik` (`id_korisnik`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `WebDiP2020x057`.`kategorija_stete`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `WebDiP2020x057`.`kategorija_stete` (
  `id_kategorija_stete` INT NOT NULL AUTO_INCREMENT,
  `naziv` VARCHAR(45) CHARACTER SET 'utf8' COLLATE 'utf8_general_ci' NOT NULL,
  `opis` TEXT CHARACTER SET 'utf8' COLLATE 'utf8_general_ci' NOT NULL,
  `kolicina_prijava` INT NOT NULL DEFAULT 0,
  `kolicina_javnih_poziva` INT NOT NULL DEFAULT 0,
  `ilustracija` VARCHAR(100) CHARACTER SET 'utf8' COLLATE 'utf8_general_ci' NULL,
  PRIMARY KEY (`id_kategorija_stete`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `WebDiP2020x057`.`javni_poziv`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `WebDiP2020x057`.`javni_poziv` (
  `id_javni_poziv` INT NOT NULL AUTO_INCREMENT,
  `naziv` VARCHAR(45) CHARACTER SET 'utf8' COLLATE 'utf8_general_ci' NOT NULL,
  `opis` TEXT CHARACTER SET 'utf8' COLLATE 'utf8_general_ci' NOT NULL,
  `datum_otvaranja` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `datum_zatvaranja` TIMESTAMP NULL,
  `skupljeno_sredstava` FLOAT NOT NULL DEFAULT 0,
  `zatvoren` TINYINT NOT NULL DEFAULT 0,
  `id_odgovorna_osoba` INT NOT NULL,
  `id_kategorija_stete` INT NOT NULL,
  PRIMARY KEY (`id_javni_poziv`),
  INDEX `fk_javni_poziv_korisnik1_idx` (`id_odgovorna_osoba` ASC),
  INDEX `fk_javni_poziv_kategorija_stete1_idx` (`id_kategorija_stete` ASC),
  CONSTRAINT `fk_javni_poziv_korisnik`
    FOREIGN KEY (`id_odgovorna_osoba`)
    REFERENCES `WebDiP2020x057`.`korisnik` (`id_korisnik`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_javni_poziv_kategorija_stete`
    FOREIGN KEY (`id_kategorija_stete`)
    REFERENCES `WebDiP2020x057`.`kategorija_stete` (`id_kategorija_stete`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `WebDiP2020x057`.`status_stete`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `WebDiP2020x057`.`status_stete` (
  `id_status_stete` INT NOT NULL AUTO_INCREMENT,
  `naziv` VARCHAR(45) CHARACTER SET 'utf8' COLLATE 'utf8_general_ci' NOT NULL,
  PRIMARY KEY (`id_status_stete`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `WebDiP2020x057`.`steta`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `WebDiP2020x057`.`steta` (
  `id_steta` INT NOT NULL AUTO_INCREMENT,
  `naziv` VARCHAR(45) CHARACTER SET 'utf8' COLLATE 'utf8_general_ci' NOT NULL,
  `opis` TEXT CHARACTER SET 'utf8' COLLATE 'utf8_general_ci' NOT NULL,
  `oznake` VARCHAR(100) CHARACTER SET 'utf8' COLLATE 'utf8_general_ci' NOT NULL,
  `datum_prijave` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `datum_potvrde` TIMESTAMP NULL DEFAULT NULL,
  `subvencija_hrk` FLOAT NULL,
  `id_status_stete` INT NOT NULL,
  `id_kategorija_stete` INT NOT NULL,
  `id_prijavitelj` INT NOT NULL,
  `id_javni_poziv` INT NOT NULL,
  PRIMARY KEY (`id_steta`),
  INDEX `fk_steta_javni_poziv1_idx` (`id_javni_poziv` ASC),
  INDEX `fk_steta_korisnik1_idx` (`id_prijavitelj` ASC),
  INDEX `fk_steta_kategorija_stete1_idx` (`id_kategorija_stete` ASC),
  INDEX `fk_steta_status_stete1_idx` (`id_status_stete` ASC),
  CONSTRAINT `fk_steta_javni_poziv`
    FOREIGN KEY (`id_javni_poziv`)
    REFERENCES `WebDiP2020x057`.`javni_poziv` (`id_javni_poziv`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_steta_korisnik`
    FOREIGN KEY (`id_prijavitelj`)
    REFERENCES `WebDiP2020x057`.`korisnik` (`id_korisnik`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_steta_kategorija_stete`
    FOREIGN KEY (`id_kategorija_stete`)
    REFERENCES `WebDiP2020x057`.`kategorija_stete` (`id_kategorija_stete`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_steta_status_stete`
    FOREIGN KEY (`id_status_stete`)
    REFERENCES `WebDiP2020x057`.`status_stete` (`id_status_stete`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `WebDiP2020x057`.`vrsta_materijala`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `WebDiP2020x057`.`vrsta_materijala` (
  `id_vrsta_materijala` INT NOT NULL AUTO_INCREMENT,
  `naziv` VARCHAR(45) CHARACTER SET 'utf8' COLLATE 'utf8_general_ci' NOT NULL,
  `opis` TEXT CHARACTER SET 'utf8' COLLATE 'utf8_general_ci' NOT NULL,
  `upute_za_upload` TEXT NOT NULL,
  `ekstenzija` VARCHAR(45) CHARACTER SET 'utf8' COLLATE 'utf8_general_ci' NOT NULL,
  `najveca_velicina_mb` INT NOT NULL,
  PRIMARY KEY (`id_vrsta_materijala`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `WebDiP2020x057`.`dokazni_materijali`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `WebDiP2020x057`.`dokazni_materijali` (
  `id_materijala` INT NOT NULL AUTO_INCREMENT,
  `putanja_disk` VARCHAR(200) CHARACTER SET 'utf8' COLLATE 'utf8_general_ci' NOT NULL,
  `naziv` VARCHAR(30) CHARACTER SET 'utf8' COLLATE 'utf8_general_ci' NOT NULL,
  `datum_postavljanja` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `opaska` VARCHAR(500) CHARACTER SET 'utf8' COLLATE 'utf8_general_ci' NULL,
  `id_vrsta_materijala` INT NOT NULL,
  PRIMARY KEY (`id_materijala`),
  INDEX `fk_dokazni_materijali_vrsta_materijala1_idx` (`id_vrsta_materijala` ASC),
  CONSTRAINT `fk_dokazni_materijali_vrsta_materijala`
    FOREIGN KEY (`id_vrsta_materijala`)
    REFERENCES `WebDiP2020x057`.`vrsta_materijala` (`id_vrsta_materijala`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `WebDiP2020x057`.`donacije`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `WebDiP2020x057`.`donacije` (
  `id_donacije` INT NOT NULL AUTO_INCREMENT,
  `iznos` FLOAT NOT NULL,
  `id_steta` INT NOT NULL,
  `id_donator` INT NOT NULL,
  PRIMARY KEY (`id_donacije`),
  INDEX `fk_donacije_steta1_idx` (`id_steta` ASC),
  INDEX `fk_donacije_korisnik1_idx` (`id_donator` ASC),
  CONSTRAINT `fk_donacije_steta`
    FOREIGN KEY (`id_steta`)
    REFERENCES `WebDiP2020x057`.`steta` (`id_steta`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_donacije_korisnik`
    FOREIGN KEY (`id_donator`)
    REFERENCES `WebDiP2020x057`.`korisnik` (`id_korisnik`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `WebDiP2020x057`.`moderator_kategorije`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `WebDiP2020x057`.`moderator_kategorije` (
  `id_moderator` INT NOT NULL,
  `id_kategorija_stete` INT NOT NULL,
  PRIMARY KEY (`id_moderator`, `id_kategorija_stete`),
  INDEX `fk_kategorija_stete_has_korisnik_korisnik1_idx` (`id_moderator` ASC),
  INDEX `fk_kategorija_stete_has_korisnik_kategorija_stete1_idx` (`id_kategorija_stete` ASC),
  CONSTRAINT `fk_kategorija_stete_has_korisnik_kategorija_stete`
    FOREIGN KEY (`id_kategorija_stete`)
    REFERENCES `WebDiP2020x057`.`kategorija_stete` (`id_kategorija_stete`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_kategorija_stete_has_korisnik_korisnik`
    FOREIGN KEY (`id_moderator`)
    REFERENCES `WebDiP2020x057`.`korisnik` (`id_korisnik`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `WebDiP2020x057`.`steta_dokazi`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `WebDiP2020x057`.`steta_dokazi` (
  `id_steta` INT NOT NULL,
  `id_materijala` INT NOT NULL,
  PRIMARY KEY (`id_steta`, `id_materijala`),
  INDEX `fk_steta_has_dokazni_materijali_dokazni_materijali1_idx` (`id_materijala` ASC),
  INDEX `fk_steta_has_dokazni_materijali_steta1_idx` (`id_steta` ASC),
  CONSTRAINT `fk_steta_has_dokazni_materijali_steta`
    FOREIGN KEY (`id_steta`)
    REFERENCES `WebDiP2020x057`.`steta` (`id_steta`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_steta_has_dokazni_materijali_dokazni_materijali`
    FOREIGN KEY (`id_materijala`)
    REFERENCES `WebDiP2020x057`.`dokazni_materijali` (`id_materijala`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;

COMMIT;