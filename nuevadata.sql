CREATE TABLE `error_log` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `user_id` INT(10) NULL,
  `xhr` TEXT NULL,
  `status` TEXT NULL,
  `error` TEXT NULL,
  `created_at` DATETIME NULL,
  `updated_at` DATETIME NULL,
  PRIMARY KEY (`id`));

ALTER TABLE `usuario`
ADD COLUMN `fecha_actualizacion` DATETIME NULL,
ADD COLUMN `id_usuario_actualizacion` INT(11) NULL;

ALTER TABLE `accion`
ADD COLUMN `fecha_actualizacion` DATETIME NULL,
ADD COLUMN `id_usuario_actualizacion` INT(11) NULL;

ALTER TABLE `accion_perfil`
ADD COLUMN `fecha_actualizacion` DATETIME NULL,
ADD COLUMN `id_usuario_actualizacion` INT(11) NULL;

ALTER TABLE `actuacion`
ADD COLUMN `fecha_actualizacion` DATETIME NULL,
ADD COLUMN `id_usuario_actualizacion` INT(11) NULL;

ALTER TABLE `cliente`
ADD COLUMN `fecha_actualizacion` DATETIME NULL,
ADD COLUMN `id_usuario_actualizacion` INT(11) NULL;

ALTER TABLE `documento`
ADD COLUMN `fecha_actualizacion` DATETIME NULL,
ADD COLUMN `id_usuario_actualizacion` INT(11) NULL;

ALTER TABLE `entidad_justicia`
ADD COLUMN `fecha_actualizacion` DATETIME NULL,
ADD COLUMN `id_usuario_actualizacion` INT(11) NULL;

ALTER TABLE `entidad_pension`
ADD COLUMN `fecha_actualizacion` DATETIME NULL,
ADD COLUMN `id_usuario_actualizacion` INT(11) NULL;

ALTER TABLE `etapa_proceso`
ADD COLUMN `fecha_actualizacion` DATETIME NULL,
ADD COLUMN `id_usuario_actualizacion` INT(11) NULL;

ALTER TABLE `intermediario`
ADD COLUMN `fecha_actualizacion` DATETIME NULL,
ADD COLUMN `id_usuario_actualizacion` INT(11) NULL;

ALTER TABLE `menu`
ADD COLUMN `fecha_actualizacion` DATETIME NULL,
ADD COLUMN `id_usuario_actualizacion` INT(11) NULL;

ALTER TABLE `menu_perfil`
ADD COLUMN `fecha_actualizacion` DATETIME NULL,
ADD COLUMN `id_usuario_actualizacion` INT(11) NULL;

ALTER TABLE `perfil`
ADD COLUMN `fecha_actualizacion` DATETIME NULL,
ADD COLUMN `id_usuario_actualizacion` INT(11) NULL;

ALTER TABLE `persona`
ADD COLUMN `fecha_actualizacion` DATETIME NULL,
ADD COLUMN `id_usuario_actualizacion` INT(11) NULL;

ALTER TABLE `plantilla_documento`
ADD COLUMN `fecha_actualizacion` DATETIME NULL,
ADD COLUMN `id_usuario_actualizacion` INT(11) NULL;

ALTER TABLE `proceso`
ADD COLUMN `fecha_actualizacion` DATETIME NULL,
ADD COLUMN `id_usuario_actualizacion` INT(11) NULL;

ALTER TABLE `sede_operativa`
ADD COLUMN `fecha_actualizacion` DATETIME NULL,
ADD COLUMN `id_usuario_actualizacion` INT(11) NULL;

ALTER TABLE `tipo_proceso`
ADD COLUMN `fecha_actualizacion` DATETIME NULL,
ADD COLUMN `id_usuario_actualizacion` INT(11) NULL;

ALTER TABLE `usuario_sede_operativa`
ADD COLUMN `fecha_actualizacion` DATETIME NULL,
ADD COLUMN `id_usuario_actualizacion` INT(11) NULL;
