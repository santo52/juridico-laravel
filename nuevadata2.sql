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

ALTER TABLE `proceso`
DROP FOREIGN KEY `FK_proceso_entidad_pension`;
ALTER TABLE `proceso`
DROP INDEX `FK_proceso_entidad_pension` ;

ALTER TABLE `proceso`
DROP FOREIGN KEY `FK_proceso_usuario`,
DROP FOREIGN KEY `FK_proceso_tipo_proceso`,
DROP FOREIGN KEY `FK_proceso_municipio`,
DROP FOREIGN KEY `FK_proceso_entidad_justicia`,
DROP FOREIGN KEY `FK_proceso_cliente`,
DROP FOREIGN KEY `FK_proceso_actuacion`;

ALTER TABLE `proceso`
DROP INDEX `FK_proceso_municipio` ,
DROP INDEX `FK_proceso_actuacion` ,
DROP INDEX `FK_proceso_entidad_justicia` ,
DROP INDEX `FK_proceso_usuario` ,
DROP INDEX `FK_proceso_tipo_proceso` ,
DROP INDEX `FK_proceso_cliente` ;
;
