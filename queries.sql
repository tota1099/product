CREATE TABLE `market`.`product_type` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(255) NOT NULL,
  PRIMARY KEY (`id`));

CREATE TABLE `market`.`product` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(255) NULL,
  `value` DOUBLE NOT NULL,
  `type` INT UNSIGNED NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `type_idx` (`type` ASC),
  CONSTRAINT `type`
    FOREIGN KEY (`type`)
    REFERENCES `market`.`product_type` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION);

CREATE TABLE `market`.`tax` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(45) NOT NULL,
  `value` DOUBLE NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `name_UNIQUE` (`name` ASC));



CREATE TABLE `market`.`product_type_tax` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `product_type_id` INT UNSIGNED NOT NULL,
  `tax_id` INT UNSIGNED NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `product_type_idx` (`product_type_id` ASC),
  INDEX `tax_idx` (`tax_id` ASC),
  CONSTRAINT `product_type`
    FOREIGN KEY (`product_type_id`)
    REFERENCES `market`.`product_type` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `tax`
    FOREIGN KEY (`tax_id`)
    REFERENCES `market`.`tax` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION);

