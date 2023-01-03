-- MySQL Script generated by MySQL Workbench
-- Tue Jan  3 17:18:32 2023
-- Model: New Model    Version: 1.0
-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- Schema mydb
-- -----------------------------------------------------
DROP SCHEMA IF EXISTS `mydb` ;

-- -----------------------------------------------------
-- Schema mydb
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `mydb` DEFAULT CHARACTER SET utf8 ;
USE `mydb` ;

-- -----------------------------------------------------
-- Table `mydb`.`acceso`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `mydb`.`acceso` ;

CREATE TABLE IF NOT EXISTS `mydb`.`acceso` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `nombre_acceso` VARCHAR(300) NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = MyISAM;


-- -----------------------------------------------------
-- Table `mydb`.`carrito`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `mydb`.`carrito` ;

CREATE TABLE IF NOT EXISTS `mydb`.`carrito` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `persona_id` INT NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_carrito_persona_idx` (`persona_id` ASC),
  CONSTRAINT `fk_carrito_persona`
    FOREIGN KEY (`persona_id`)
    REFERENCES `mydb`.`persona` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`carrito_has_producto`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `mydb`.`carrito_has_producto` ;

CREATE TABLE IF NOT EXISTS `mydb`.`carrito_has_producto` (
  `carrito_id` INT NOT NULL,
  `producto_id` INT NOT NULL,
  PRIMARY KEY (`carrito_id`, `producto_id`),
  INDEX `fk_carrito_has_producto_producto1_idx` (`producto_id` ASC),
  INDEX `fk_carrito_has_producto_carrito1_idx` (`carrito_id` ASC),
  CONSTRAINT `fk_carrito_has_producto_carrito1`
    FOREIGN KEY (`carrito_id`)
    REFERENCES `mydb`.`carrito` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_carrito_has_producto_producto1`
    FOREIGN KEY (`producto_id`)
    REFERENCES `mydb`.`producto` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`categoria`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `mydb`.`categoria` ;

CREATE TABLE IF NOT EXISTS `mydb`.`categoria` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `nombre_categoria` VARCHAR(200) NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`direccion`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `mydb`.`direccion` ;

CREATE TABLE IF NOT EXISTS `mydb`.`direccion` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `nombre_direccion` VARCHAR(300) NOT NULL,
  `persona_id` INT NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_direccion_persona1_idx` (`persona_id` ASC),
  CONSTRAINT `fk_direccion_persona1`
    FOREIGN KEY (`persona_id`)
    REFERENCES `mydb`.`persona` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`marca`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `mydb`.`marca` ;

CREATE TABLE IF NOT EXISTS `mydb`.`marca` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `nombe_marca` VARCHAR(300) NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`orden_compra`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `mydb`.`orden_compra` ;

CREATE TABLE IF NOT EXISTS `mydb`.`orden_compra` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `precio` DOUBLE NOT NULL,
  `producto_id` INT NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_orden_compra_producto1_idx` (`producto_id` ASC),
  CONSTRAINT `fk_orden_compra_producto1`
    FOREIGN KEY (`producto_id`)
    REFERENCES `mydb`.`producto` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`persona`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `mydb`.`persona` ;

CREATE TABLE IF NOT EXISTS `mydb`.`persona` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `rol_id` INT NOT NULL,
  `nombres` VARCHAR(200) NOT NULL,
  `apellidos` VARCHAR(200) NOT NULL,
  `correo` VARCHAR(300) NOT NULL,
  `celular` VARCHAR(9) NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_persona_rol1_idx` (`rol_id` ASC),
  CONSTRAINT `fk_persona_rol1`
    FOREIGN KEY (`rol_id`)
    REFERENCES `mydb`.`rol` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`producto`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `mydb`.`producto` ;

CREATE TABLE IF NOT EXISTS `mydb`.`producto` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `categoria_id` INT NOT NULL,
  `nombre_producto` VARCHAR(500) NOT NULL,
  `precio` DOUBLE NOT NULL,
  `marca_id` INT NOT NULL,
  `imagen` VARCHAR(500) NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_producto_categoria1_idx` (`categoria_id` ASC),
  INDEX `fk_producto_marca1_idx` (`marca_id` ASC),
  CONSTRAINT `fk_producto_categoria1`
    FOREIGN KEY (`categoria_id`)
    REFERENCES `mydb`.`categoria` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_producto_marca1`
    FOREIGN KEY (`marca_id`)
    REFERENCES `mydb`.`marca` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `mydb`.`rol`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `mydb`.`rol` ;

CREATE TABLE IF NOT EXISTS `mydb`.`rol` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `nombre_rol` VARCHAR(45) NOT NULL,
  `acceso_id` INT NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_rol_acceso1_idx` (`acceso_id` ASC),
  CONSTRAINT `fk_rol_acceso1`
    FOREIGN KEY (`acceso_id`)
    REFERENCES `mydb`.`acceso` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
