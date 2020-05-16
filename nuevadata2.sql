ALTER TABLE `usuario`
ADD COLUMN `id_municipio` INT NULL DEFAULT 1 AFTER `id_usuario_actualizacion`,
ADD COLUMN `eliminado` TINYINT(1) NULL DEFAULT 0 AFTER `id_municipio`;

ALTER TABLE `usuario`
DROP COLUMN `id_municipio`;
