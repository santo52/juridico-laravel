ALTER TABLE `usuario`
ADD COLUMN `id_municipio` INT NULL DEFAULT 1 AFTER `id_usuario_actualizacion`,
ADD COLUMN `eliminado` TINYINT(1) NULL DEFAULT 0 AFTER `id_municipio`;

ALTER TABLE `usuario`
DROP COLUMN `id_municipio`;

ALTER TABLE `cliente`
ADD COLUMN `eliminado` TINYINT(1) NULL DEFAULT 0 AFTER `id_usuario_actualizacion`;

UPDATE `menu` SET `ruta_menu` = 'cliente/listar' WHERE (`id_menu` = '35');

ALTER TABLE `contacto`
DROP INDEX `IX_contacto_numero_documento` ;

ALTER TABLE `contacto`
ADD COLUMN `informacion_adicional` TEXT NULL AFTER `correo_electronico`;

ALTER TABLE `contacto`
ADD COLUMN `id_municipio` INT NULL DEFAULT 0 AFTER `informacion_adicional`;

ALTER TABLE `cliente`
ADD COLUMN `celular2` VARCHAR(10) NULL DEFAULT '' AFTER `eliminado`;
