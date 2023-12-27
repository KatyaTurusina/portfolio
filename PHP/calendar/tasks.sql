CREATE TABLE `types` (
  `id` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(255) NOT NULL,
  PRIMARY KEY(`id`)
);

INSERT INTO `types` (`name`) VALUES
  ('Встреча'), 
  ('Звонок'), 
  ('Совещание'), 
  ('Дело');

CREATE TABLE `tasks` (
  `id` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `theme` VARCHAR(255) NOT NULL,
  `type_id` INT(10) NOT NULL,
  `location` VARCHAR(255) DEFAULT NULL,
  `datetime` TIMESTAMP NOT NULL,
  `hours_dur` TINYINT(5) UNSIGNED NOT NULL,
  `comment` VARCHAR(255) NOT NULL,
  `status` TINYINT(1) UNSIGNED NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`),
  INDEX `type_id` (`type_id`)
);
