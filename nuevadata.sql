ALTER TABLE `usuario`
ADD COLUMN `fecha_actualizacion` DATETIME NULL AFTER `id_usuario_creacion`;

CREATE TABLE `error_log` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `user_id` INT(10) NULL,
  `xhr` TEXT NULL,
  `status` TEXT NULL,
  `error` TEXT NULL,
  `created_at` DATETIME NULL,
  `updated_at` DATETIME NULL,
  PRIMARY KEY (`id`));
