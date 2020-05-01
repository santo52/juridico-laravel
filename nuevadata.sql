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
ADD COLUMN `password` varchar(300) COLLATE utf8_spanish_ci DEFAULT NULL,
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



UPDATE `menu` SET `ruta_menu` = 'TipoProceso/listar' WHERE (`id_menu` = '2');
UPDATE `menu` SET `inactivo` = '1' WHERE (`id_menu` = '4');
UPDATE `menu` SET `inactivo` = '1' WHERE (`id_menu` = '3');
UPDATE `menu` SET `ruta_menu` = 'Perfil/listar' WHERE (`id_menu` = '6');
UPDATE `menu` SET `inactivo` = '1' WHERE (`id_menu` = '7');
UPDATE `menu` SET `ruta_menu` = 'Usuario/listar' WHERE (`id_menu` = '8');
UPDATE `menu` SET `inactivo` = '1' WHERE (`id_menu` = '9');
UPDATE `menu` SET `inactivo` = '1' WHERE (`id_menu` = '10');
UPDATE `menu` SET `ruta_menu` = 'EtapaProceso/listar' WHERE (`id_menu` = '11');
UPDATE `menu` SET `inactivo` = '1' WHERE (`id_menu` = '12');
UPDATE `menu` SET `inactivo` = '1' WHERE (`id_menu` = '13');
UPDATE `menu` SET `ruta_menu` = 'Proceso/listar' WHERE (`id_menu` = '39');
UPDATE `menu` SET `ruta_menu` = 'Documento/listar' WHERE (`id_menu` = '14');
UPDATE `menu` SET `inactivo` = '1' WHERE (`id_menu` = '15');
UPDATE `menu` SET `inactivo` = '1' WHERE (`id_menu` = '16');
UPDATE `menu` SET `ruta_menu` = 'PlantillaDocumento/listar', `inactivo` = '0' WHERE (`id_menu` = '17');
UPDATE `menu` SET `inactivo` = '1' WHERE (`id_menu` = '18');
UPDATE `menu` SET `inactivo` = '1' WHERE (`id_menu` = '19');
UPDATE `menu` SET `inactivo` = '1' WHERE (`id_menu` = '21');
UPDATE `menu` SET `inactivo` = '1' WHERE (`id_menu` = '22');
UPDATE `menu` SET `ruta_menu` = 'EntidadPension/listar' WHERE (`id_menu` = '20');
UPDATE `menu` SET `ruta_menu` = 'EntidadJusticia/listar' WHERE (`id_menu` = '23');
UPDATE `menu` SET `inactivo` = '1' WHERE (`id_menu` = '24');
UPDATE `menu` SET `inactivo` = '1' WHERE (`id_menu` = '25');
UPDATE `menu` SET `ruta_menu` = 'Intermediario/listar' WHERE (`id_menu` = '26');
UPDATE `menu` SET `inactivo` = '1' WHERE (`id_menu` = '27');
UPDATE `menu` SET `inactivo` = '1' WHERE (`id_menu` = '28');
UPDATE `menu` SET `ruta_menu` = 'Actuacion/listar' WHERE (`id_menu` = '29');
UPDATE `menu` SET `inactivo` = '1' WHERE (`id_menu` = '30');
UPDATE `menu` SET `inactivo` = '1' WHERE (`id_menu` = '31');
UPDATE `menu` SET `ruta_menu` = 'ActuacionEtapaProceso/asociar' WHERE (`id_menu` = '32');
UPDATE `menu` SET `inactivo` = '1' WHERE (`id_menu` = '33');
UPDATE `menu` SET `inactivo` = '1' WHERE (`id_menu` = '34');
UPDATE `menu` SET `ruta_menu` = 'Cliente/listar' WHERE (`id_menu` = '35');
UPDATE `menu` SET `inactivo` = '1' WHERE (`id_menu` = '37');
UPDATE `menu` SET `inactivo` = '1' WHERE (`id_menu` = '36');
