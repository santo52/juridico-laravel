ALTER TABLE `honorario`
ADD COLUMN `numero_factura` VARCHAR(100) NULL DEFAULT '' AFTER `cerrado`,
ADD COLUMN `valor_factura` FLOAT(12,2) NULL DEFAULT 0 AFTER `numero_factura`;

ALTER TABLE `persona`
CHANGE COLUMN `telefono` `telefono` BIGINT(20) NULL ,
CHANGE COLUMN `correo_electronico` `correo_electronico` VARCHAR(60) NULL ;

ALTER TABLE `persona`
CHANGE COLUMN `celular` `celular` VARCHAR(20) NULL DEFAULT '' ,
CHANGE COLUMN `telefono` `telefono` VARCHAR(20) NULL DEFAULT '' ,
CHANGE COLUMN `correo_electronico` `correo_electronico` VARCHAR(60) NULL DEFAULT '' ;

ALTER TABLE `entidad_demandada`
ADD COLUMN `id_municipio` INT NULL AFTER `email_entidad_demandada`;


CREATE TABLE `areas` (
`id_area` INT NOT NULL AUTO_INCREMENT,
`nombre` VARCHAR(45) NULL,
`eliminado` TINYINT(1) NULL DEFAULT 0,
PRIMARY KEY (`id_area`));

INSERT INTO `areas` (`nombre`) VALUES ('Recepción');
INSERT INTO `areas` (`nombre`) VALUES ('Administración');
INSERT INTO `areas` (`nombre`) VALUES ('Agotamientos de Via');
INSERT INTO `areas` (`nombre`) VALUES ('Sustanciación');
INSERT INTO `areas` (`nombre`) VALUES ('Dependencia');
INSERT INTO `areas` (`nombre`) VALUES ('Mensajería');

ALTER TABLE `usuario`
ADD COLUMN `id_area` INT NULL AFTER `eliminado`;


INSERT INTO `grupos_variables` (`nombre_grupo_variable`, `estado_grupo_variable`, `orden`) VALUES ('Usuario', '1', '6');

INSERT INTO `variables` (`nombre_variable`, `valor_variable`, `estado_variable`, `id_grupo_variable`, `orden`, `function_variable`) VALUES ('Area', 'AREA_USUARIO', '1', '6', '0', 'getArea');
INSERT INTO `variables` (`nombre_variable`, `valor_variable`, `estado_variable`, `id_grupo_variable`, `orden`, `function_variable`) VALUES ('Nombre de usuario', 'NOMBRE_DE_USUARIO', '1', '6', '0', 'nombre_usuario');
INSERT INTO `variables` (`nombre_variable`, `valor_variable`, `estado_variable`, `id_grupo_variable`, `orden`, `function_variable`) VALUES ('Tipo de documento', 'TIPO_DOCUMENTO_USUARIO', '1', '6', '0', 'getTipoDocumento');
INSERT INTO `variables` (`nombre_variable`, `valor_variable`, `estado_variable`, `id_grupo_variable`, `orden`, `function_variable`) VALUES ('Nombre completo', 'NOMBRE_COMPLETO_USUARIO', '1', '6', '0', 'getNombreCompleto');
INSERT INTO `variables` (`nombre_variable`, `valor_variable`, `estado_variable`, `id_grupo_variable`, `orden`, `function_variable`) VALUES ('Sede operativa', 'SEDE_OPERATIVA_USUARIO', '1', '6', '0', 'getSedeOperativa');
INSERT INTO `variables` (`nombre_variable`, `valor_variable`, `estado_variable`, `id_grupo_variable`, `orden`, `function_variable`) VALUES ('Dirección', 'DIRECCION_USUARIO', '1', '6', '0', 'getDireccion');
INSERT INTO `variables` (`nombre_variable`, `valor_variable`, `estado_variable`, `id_grupo_variable`, `orden`, `function_variable`) VALUES ('Teléfono', 'TELEFONO_USUARIO', '1', '6', '0', 'getTelefono');
INSERT INTO `variables` (`nombre_variable`, `valor_variable`, `estado_variable`, `id_grupo_variable`, `orden`, `function_variable`) VALUES ('Correo electrónico', 'CORREO_ELECTRONICO_USUARIO', '1', '6', '0', 'getCorreoElectronico');

/*Ultima entregaaaaaa*/

ALTER TABLE `tipo_resultado`
ADD COLUMN `privado` TINYINT(1) NULL DEFAULT 0 AFTER `tipo_campo`;

UPDATE `tipo_resultado` SET `privado` = '1' WHERE (`id_tipo_resultado` = '1');
UPDATE `tipo_resultado` SET `privado` = '1' WHERE (`id_tipo_resultado` = '2');
UPDATE `tipo_resultado` SET `privado` = '1' WHERE (`id_tipo_resultado` = '3');
UPDATE `tipo_resultado` SET `privado` = '1' WHERE (`id_tipo_resultado` = '4');
UPDATE `tipo_resultado` SET `privado` = '1' WHERE (`id_tipo_resultado` = '5');
UPDATE `tipo_resultado` SET `privado` = '1' WHERE (`id_tipo_resultado` = '6');
UPDATE `tipo_resultado` SET `privado` = '1' WHERE (`id_tipo_resultado` = '7');
UPDATE `tipo_resultado` SET `privado` = '1' WHERE (`id_tipo_resultado` = '8');

update entidad_justicia set id_municipio='1' where id_municipio='0';

CREATE TABLE `usuario_contrato` (
  `id_usuario_contrato` INT NOT NULL AUTO_INCREMENT,
  `tipo_contrato` INT NULL COMMENT '1 => Indefinido\n2 => Fijo\n3 => Prestación de servicios\n4 => Obra o Labor\n5 => Aprendizaje\n6 => Ocasional de trabajo',
  `fecha_inicio` DATE NULL,
  `fecha_fin` DATE NULL,
  `id_usuario` INT NULL,
  PRIMARY KEY (`id_usuario_contrato`));

  ALTER TABLE `usuario_contrato`
CHANGE COLUMN `tipo_contrato` `tipo_contrato` INT(11) NULL DEFAULT 1 COMMENT '1 => Indefinido\\n2 => Fijo\\n3 => Prestación de servicios\\n4 => Obra o Labor\\n5 => Aprendizaje\\n6 => Ocasional de trabajo' ;

INSERT INTO `menu` (id_menu, `nombre_menu`, `ruta_menu`, `parent_id`, `tipo_menu`, `orden_menu`, `inactivo`, `fecha_creacion`, `id_usuario_creacion`, `fecha_actualizacion`, `id_usuario_actualizacion`, `estado`) VALUES (60, 'Reportes', '', '0', '1', '2', '0', '2020-08-31 08:19:48', '1', '2020-08-31 08:19:48', '1', '1');
INSERT INTO `menu` (`nombre_menu`, `ruta_menu`, `parent_id`, `tipo_menu`, `orden_menu`, `inactivo`, `fecha_creacion`, `id_usuario_creacion`, `fecha_actualizacion`, `id_usuario_actualizacion`, `estado`) VALUES ('Gestión de procesos activos', 'gestion-procesos-activos', '60', '1', '1', '0', '2020-08-31 08:19:48', '1', '2020-08-31 08:19:48', '1', '1');
INSERT INTO `menu` (`nombre_menu`, `ruta_menu`, `parent_id`, `tipo_menu`, `orden_menu`, `inactivo`, `fecha_creacion`, `id_usuario_creacion`, `fecha_actualizacion`, `id_usuario_actualizacion`, `estado`) VALUES ('Estado de cuenta de procesos', 'estado-de-cuenta-de-procesos', '60', '1', '1', '0', '2020-08-31 08:19:48', '1', '2020-08-31 08:19:48', '1', '1');
INSERT INTO `menu` (`nombre_menu`, `ruta_menu`, `parent_id`, `tipo_menu`, `orden_menu`, `inactivo`, `fecha_creacion`, `id_usuario_creacion`, `fecha_actualizacion`, `id_usuario_actualizacion`, `estado`) VALUES ('Honorarios y gastos procesales', 'honorarios-y-gastos-procesales', '60', '1', '1', '0', '2020-08-31 08:19:48', '1', '2020-08-31 08:19:48', '1', '1');
INSERT INTO `menu` (`nombre_menu`, `ruta_menu`, `parent_id`, `tipo_menu`, `orden_menu`, `inactivo`, `fecha_creacion`, `id_usuario_creacion`, `fecha_actualizacion`, `id_usuario_actualizacion`, `estado`) VALUES ('Gestión organizacional', 'gestion-organizacional', '60', '1', '1', '0', '2020-08-31 08:19:48', '1', '2020-08-31 08:19:48', '1', '1');
