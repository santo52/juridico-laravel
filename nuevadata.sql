CREATE TABLE `error_log` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `user_id` INT(10) NULL,
  `xhr` TEXT NULL,
  `status` TEXT NULL,
  `error` TEXT NULL,
  `created_at` DATETIME NULL,
  `updated_at` DATETIME NULL,
  PRIMARY KEY (`id`));

CREATE TABLE `accion_menu_perfil` (
  `id_accion_menu` INT NOT NULL AUTO_INCREMENT,
  `id_menu_perfil` INT NOT NULL,
  `id_accion` INT NOT NULL,
  PRIMARY KEY (`id_accion_menu`),
  INDEX `id_menu_perfil` (`id_menu_perfil` ASC),
  INDEX `id_accion` (`id_accion` ASC))
ENGINE = InnoDB
COMMENT = 'Relación entre accion y menu_perfil';

CREATE TABLE `etapas_proceso_tipo_proceso` (
  `id_etapas_proceso_tipo_proceso` INT NOT NULL AUTO_INCREMENT,
  `id_tipo_proceso` INT NOT NULL,
  `id_etapa_proceso` INT NOT NULL,
  PRIMARY KEY (`id_etapas_proceso_tipo_proceso`));

CREATE TABLE `actuacion_etapa_proceso` (
  `id_actuacion_etapa_proceso` int(11) NOT NULL AUTO_INCREMENT,
  `id_etapa_proceso` varchar(45) DEFAULT NULL,
  `id_actuacion` varchar(45) DEFAULT NULL,
  `tiempo_maximo_proxima_actuacion` int(11) DEFAULT NULL,
  `unidad_tiempo_proxima_actuacion` int(1) DEFAULT '1',
  `id_usuario_creacion` int(11) DEFAULT '0',
  `order` int(3) DEFAULT '0',
  PRIMARY KEY (`id_actuacion_etapa_proceso`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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

ALTER TABLE `menu`
ADD COLUMN `estado` TINYINT(1) NULL DEFAULT 1;

ALTER TABLE `accion`
DROP FOREIGN KEY `FK_accion_menu`;

ALTER TABLE `accion`
DROP INDEX `IX_accion_inactivo` ,
DROP INDEX `UQ_accion` ;

ALTER TABLE `accion`
ADD COLUMN `eliminado` TINYINT(1) NULL DEFAULT 0;

ALTER TABLE `accion`
ADD COLUMN `global` TINYINT(1) NULL DEFAULT 0 COMMENT 'Indica si es una acción relacionada con cualquier módulo de la aplicación' AFTER `eliminado`;

ALTER TABLE `menu_perfil`
DROP FOREIGN KEY `FK_menu_perfil_perfil`,
DROP FOREIGN KEY `FK_menu_perfil_menu`;

ALTER TABLE `menu_perfil`
DROP INDEX `FK_menu_perfil_menu` ,
DROP INDEX `IX_menu_perfil_inactivo` ,
DROP INDEX `UQ_menu_perfil` ;

ALTER TABLE `perfil`
ADD COLUMN `eliminado` TINYINT(1) NULL DEFAULT 0 AFTER `id_usuario_actualizacion`;

ALTER TABLE `tipo_proceso`
ADD COLUMN `eliminado` TINYINT(1) NULL DEFAULT 0 AFTER `id_usuario_actualizacion`;

ALTER TABLE `etapa_proceso`
ADD COLUMN `eliminado` TINYINT(1) NULL DEFAULT 0 AFTER `id_usuario_actualizacion`,
DROP INDEX `IX_etapa_proceso_id_etapa_proceso_siguiente` ,
DROP INDEX `IX_etapa_proceso_id_etapa_proceso_anterior` ,
DROP INDEX `IX_etapa_proceso_posicion_etapa_proceso` ;

ALTER TABLE `etapas_proceso_tipo_proceso`
ADD COLUMN `order` INT(3) NULL DEFAULT 0 AFTER `id_etapa_proceso`;

ALTER TABLE `etapas_proceso_tipo_proceso`
ADD COLUMN `id_usuario_creacion` INT(11) NULL DEFAULT 0 AFTER `order`;

ALTER TABLE `documento`
ADD COLUMN `eliminado` TINYINT(1) NULL DEFAULT 0 AFTER `id_usuario_actualizacion`;

UPDATE `menu` SET `ruta_menu` = 'TipoProceso/listar' WHERE (`id_menu` = '2');
UPDATE `menu` SET `ruta_menu` = 'Perfil/listar' WHERE (`id_menu` = '6');
UPDATE `menu` SET `ruta_menu` = 'Usuario/listar' WHERE (`id_menu` = '8');
UPDATE `menu` SET `ruta_menu` = 'EtapaProceso/listar' WHERE (`id_menu` = '11');
UPDATE `menu` SET `ruta_menu` = 'Proceso/listar' WHERE (`id_menu` = '39');
UPDATE `menu` SET `ruta_menu` = 'Documento/listar' WHERE (`id_menu` = '14');
UPDATE `menu` SET `ruta_menu` = 'PlantillaDocumento/listar', `inactivo` = '0' WHERE (`id_menu` = '17');
UPDATE `menu` SET `ruta_menu` = 'EntidadPension/listar' WHERE (`id_menu` = '20');
UPDATE `menu` SET `ruta_menu` = 'EntidadJusticia/listar' WHERE (`id_menu` = '23');
UPDATE `menu` SET `ruta_menu` = 'Intermediario/listar' WHERE (`id_menu` = '26');
UPDATE `menu` SET `ruta_menu` = 'Actuacion/listar' WHERE (`id_menu` = '29');
UPDATE `menu` SET `ruta_menu` = 'ActuacionEtapaProceso/asociar' WHERE (`id_menu` = '32');
UPDATE `menu` SET `ruta_menu` = 'Cliente/listar' WHERE (`id_menu` = '35');


UPDATE `menu` SET `estado` = '0' WHERE (`id_menu` = '3');
UPDATE `menu` SET `estado` = '0' WHERE (`id_menu` = '4');
UPDATE `menu` SET `estado` = '0' WHERE (`id_menu` = '7');
UPDATE `menu` SET `estado` = '0' WHERE (`id_menu` = '9');
UPDATE `menu` SET `estado` = '0' WHERE (`id_menu` = '10');
UPDATE `menu` SET `estado` = '0' WHERE (`id_menu` = '12');
UPDATE `menu` SET `estado` = '0' WHERE (`id_menu` = '13');
UPDATE `menu` SET `estado` = '0' WHERE (`id_menu` = '15');
UPDATE `menu` SET `estado` = '0' WHERE (`id_menu` = '16');
UPDATE `menu` SET `estado` = '0' WHERE (`id_menu` = '18');
UPDATE `menu` SET `estado` = '0' WHERE (`id_menu` = '19');
UPDATE `menu` SET `estado` = '0' WHERE (`id_menu` = '21');
UPDATE `menu` SET `estado` = '0' WHERE (`id_menu` = '22');
UPDATE `menu` SET `estado` = '0' WHERE (`id_menu` = '24');
UPDATE `menu` SET `estado` = '0' WHERE (`id_menu` = '25');
UPDATE `menu` SET `estado` = '0' WHERE (`id_menu` = '27');
UPDATE `menu` SET `estado` = '0' WHERE (`id_menu` = '28');
UPDATE `menu` SET `estado` = '0' WHERE (`id_menu` = '30');
UPDATE `menu` SET `estado` = '0' WHERE (`id_menu` = '31');
UPDATE `menu` SET `estado` = '0' WHERE (`id_menu` = '33');
UPDATE `menu` SET `estado` = '0' WHERE (`id_menu` = '34');
UPDATE `menu` SET `estado` = '0' WHERE (`id_menu` = '36');
UPDATE `menu` SET `estado` = '0' WHERE (`id_menu` = '37');
UPDATE `menu` SET `estado` = '0' WHERE (`id_menu` = '40');
UPDATE `menu` SET `estado` = '0' WHERE (`id_menu` = '41');

INSERT INTO `menu` (`nombre_menu`, `ruta_menu`, `parent_id`, `tipo_menu`, `orden_menu`, `inactivo`, `fecha_creacion`, `id_usuario_creacion`, `id_usuario_actualizacion`) VALUES ('Opciones', 'opciones/listar', '1', '1', '44', '0', '', '1', '1');

INSERT INTO `accion` (`id_menu`, `nombre_accion`, `observacion`, `inactivo`, `fecha_creacion`, `id_usuario_creacion`, `fecha_actualizacion`, `eliminado`, `global`) VALUES ('0', 'crear', 'Permisos para crear un registro en la base de datos', '0', '2020-05-03 00:25:00', '1', '2020-05-03 00:25:00', '0', '1');
INSERT INTO `accion` (`id_menu`, `nombre_accion`, `observacion`, `inactivo`, `fecha_creacion`, `id_usuario_creacion`, `fecha_actualizacion`, `eliminado`, `global`) VALUES ('0', 'editar', 'Permisos para editar un registro en la base de datos', '0', '2020-05-03 00:25:00', '1', '2020-05-03 00:25:00', '0', '1');
INSERT INTO `accion` (`id_menu`, `nombre_accion`, `observacion`, `inactivo`, `fecha_creacion`, `id_usuario_creacion`, `fecha_actualizacion`, `eliminado`, `global`) VALUES ('0', 'consultar', 'Permisos para consultar un registro en la base de datos', '0', '2020-05-03 00:25:00', '1', '2020-05-03 00:25:00', '0', '1');
INSERT INTO `accion` (`id_menu`, `nombre_accion`, `observacion`, `inactivo`, `fecha_creacion`, `id_usuario_creacion`, `fecha_actualizacion`, `eliminado`, `global`) VALUES ('0', 'eliminar', 'Permisos para eliminar un registro en la base de datos', '0', '2020-05-03 00:25:00', '1', '2020-05-03 00:25:00', '0', '1');


UPDATE `menu` SET `ruta_menu` = 'tipos-de-proceso' WHERE (`id_menu` = '2');
UPDATE `menu` SET `ruta_menu` = 'perfil' WHERE (`id_menu` = '6');
UPDATE `menu` SET `ruta_menu` = 'usuario' WHERE (`id_menu` = '8');
UPDATE `menu` SET `ruta_menu` = 'etapas-de-proceso' WHERE (`id_menu` = '11');
UPDATE `menu` SET `ruta_menu` = 'documento' WHERE (`id_menu` = '14');
UPDATE `menu` SET `ruta_menu` = 'plantilla-documento' WHERE (`id_menu` = '17');
UPDATE `menu` SET `ruta_menu` = 'entidad-pension' WHERE (`id_menu` = '20');
UPDATE `menu` SET `ruta_menu` = 'entidad-justicia' WHERE (`id_menu` = '23');
UPDATE `menu` SET `ruta_menu` = 'intermediario' WHERE (`id_menu` = '26');
UPDATE `menu` SET `ruta_menu` = 'actuacion' WHERE (`id_menu` = '29');
UPDATE `menu` SET `ruta_menu` = 'actuacion-etapa-proceso' WHERE (`id_menu` = '32');
UPDATE `menu` SET `ruta_menu` = 'cliente' WHERE (`id_menu` = '35');
UPDATE `menu` SET `ruta_menu` = 'proceso' WHERE (`id_menu` = '39');
UPDATE `menu` SET `ruta_menu` = 'opciones' WHERE (`id_menu` = '42');
UPDATE `menu` SET `nombre_menu` = 'Entidades demandadas', `ruta_menu` = 'entidades-demandadas' WHERE (`id_menu` = '20');
UPDATE `menu` SET `ruta_menu` = 'entidades-de-justicia' WHERE (`id_menu` = '23');
UPDATE `menu` SET `estado` = '1', `ruta_menu` = 'actuaciones-y-etapas-de-proceso' WHERE (`id_menu` = '32');


ALTER TABLE `entidad_pension`
CHANGE COLUMN `id_entidad_pension` `id_entidad_demandada` INT(11) NOT NULL AUTO_INCREMENT ,
CHANGE COLUMN `nombre_entidad_pension` `nombre_entidad_demandada` VARCHAR(100) NOT NULL ,
CHANGE COLUMN `estado_entidad_pension` `estado_entidad_demandada` ENUM('1', '2') NOT NULL DEFAULT '1' , RENAME TO  `entidad_demandada` ;

ALTER TABLE `entidad_demandada`
ADD COLUMN `eliminado` TINYINT(1) NULL DEFAULT 0 AFTER `id_usuario_actualizacion`;

ALTER TABLE `entidad_justicia`
ADD COLUMN `eliminado` TINYINT(1) NULL DEFAULT 0 AFTER `id_usuario_actualizacion`;

ALTER TABLE `intermediario`
ADD COLUMN `eliminado` TINYINT(1) NULL DEFAULT 0 AFTER `id_usuario_actualizacion`;

ALTER TABLE `tipo_documento`
ADD COLUMN `eliminado` TINYINT(1) NULL DEFAULT 0 AFTER `id_usuario_creacion`;

ALTER TABLE `persona`
DROP FOREIGN KEY `FK_persona_tipo_documento`,
DROP FOREIGN KEY `FK_persona_municipio`;

ALTER TABLE `persona`
DROP INDEX `FK_persona_municipio` ,
DROP INDEX `IX_persona_estado_persona` ,
DROP INDEX `UQ_persona_documento` ,
DROP INDEX `UQ_persona` ;
;

ALTER TABLE `intermediario`
DROP FOREIGN KEY `FK_intermediario_persona`;

ALTER TABLE `intermediario`
DROP INDEX `IX_intermediario_estado_intermediario` ,
DROP INDEX `IX_intermediario_id_persona` ;

ALTER TABLE `intermediario`
ADD COLUMN `retencion` INT(3) NULL DEFAULT 0 AFTER `eliminado`;

insert into actuacion_etapa_proceso
(id_actuacion,id_etapa_proceso,tiempo_maximo_proxima_actuacion,unidad_tiempo_proxima_actuacion)
(select id_actuacion,id_etapa_proceso,tiempo_maximo_proxima_actuacion,unidad_tiempo_proxima_actuacion from actuacion_etapa_proceso_maestro m
left join actuacion_etapa_proceso_detalle d
on d.id_actuacion_etapa_proceso_maestro = m.id_actuacion_etapa_proceso_maestro
order by id_actuacion_proxima,d.id_actuacion_etapa_proceso_maestro);

ALTER TABLE `municipio`
ADD COLUMN `indicativo` INT(2) NULL AFTER `nombre_municipio`;

UPDATE `municipio` SET `indicativo` = '1' WHERE (`id_municipio` = '1');
UPDATE `municipio` SET `indicativo` = '1' WHERE (`id_municipio` = '2');
UPDATE `municipio` SET `indicativo` = '1' WHERE (`id_municipio` = '3');
UPDATE `municipio` SET `indicativo` = '4' WHERE (`id_municipio` = '4');
UPDATE `municipio` SET `indicativo` = '4' WHERE (`id_municipio` = '5');
UPDATE `municipio` SET `indicativo` = '4' WHERE (`id_municipio` = '6');
UPDATE `municipio` SET `indicativo` = '2' WHERE (`id_municipio` = '7');
UPDATE `municipio` SET `indicativo` = '2' WHERE (`id_municipio` = '8');
