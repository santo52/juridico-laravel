INSERT INTO `menu` (`nombre_menu`, `ruta_menu`, `parent_id`, `tipo_menu`, `orden_menu`, `inactivo`, `fecha_creacion`, `id_usuario_creacion`, `fecha_actualizacion`, `id_usuario_actualizacion`, `estado`) VALUES ('Honorarios', 'honorarios', '38', '1', '6', '0', '2020-05-23 20:37:57', '1', '2020-05-23 20:37:57', '1', '1');

CREATE TABLE `honorario` (
  `id_honorario` INT NOT NULL AUTO_INCREMENT,
  `id_proceso` INT NULL DEFAULT 0,
  `id_cliente` INT NOT NULL,
  `numero_caso` VARCHAR(45) NULL,
  `valor_pagado_cliente` FLOAT(10,2) NULL DEFAULT 0,
  `id_intermediario` INT NULL,
  `fecha_pago` DATE NULL,
  `observacion` TEXT NULL,
  `porcentaje_honorarios` INT(2) NULL,
  `valor_honorarios` FLOAT(10,2) NULL,
  `valor_comision` FLOAT(10,2) NULL,
  PRIMARY KEY (`id_honorario`));

ALTER TABLE `honorario`
ADD COLUMN `fecha_actualizacion` DATETIME NULL,
ADD COLUMN `id_usuario_actualizacion` INT(11) NULL,
ADD COLUMN `fecha_creacion` DATETIME NULL,
ADD COLUMN `id_usuario_creacion` INT(11) NULL;

ALTER TABLE `honorario`
ADD COLUMN `eliminado` TINYINT(1) NULL DEFAULT 0 AFTER `id_usuario_creacion`;

CREATE TABLE `pago_honorario` (
  `id_pago_honorario` INT NOT NULL AUTO_INCREMENT,
  `fecha_consignacion` DATE NULL,
  `id_entidad_financiera` INT(3) NULL,
  `numero_cuenta` VARCHAR(100) NULL DEFAULT '',
  `valor_pago` FLOAT(11,2) NULL DEFAULT 0,
  `eliminado` TINYINT(1) NULL DEFAULT 0,
  PRIMARY KEY (`id_pago_honorario`));

ALTER TABLE `pago_honorario`
ADD COLUMN `id_honorario` INT NULL AFTER `eliminado`;

INSERT INTO `menu` (`nombre_menu`, `ruta_menu`, `parent_id`, `tipo_menu`, `orden_menu`, `inactivo`, `id_usuario_creacion`, `id_usuario_actualizacion`, `estado`) VALUES ('Cambiar contraseña', 'cambiar-contrasena', '0', '0', '0', '0', '1', '1', '1');

ALTER TABLE `entidad_justicia`
ADD COLUMN `id_municipio` INT NULL DEFAULT 0 AFTER `eliminado`;

ALTER TABLE `cliente`
ADD COLUMN `observaciones` TEXT NULL AFTER `correo_electronico_beneficiario`;


CREATE TABLE `tipo_resultado` (
  `id_tipo_resultado` INT NOT NULL AUTO_INCREMENT,
  `nombre_tipo_resultado` VARCHAR(100) NOT NULL,
  `unico_tipo_resultado` TINYINT(1) NULL DEFAULT 0,
  `eliminado` TINYINT(1) NULL DEFAULT 0,
  PRIMARY KEY (`id_tipo_resultado`));

ALTER TABLE `tipo_resultado`
ADD COLUMN `tipo_campo` INT(2) NULL COMMENT '1. Alfanumerico\n2. Documento\n3. Fecha\n4. Numero\n5. Moneda\n6. Historico de sentencias' AFTER `eliminado`;

INSERT INTO `menu` (`nombre_menu`, `ruta_menu`, `parent_id`, `tipo_menu`, `orden_menu`, `inactivo`, `id_usuario_creacion`, `id_usuario_actualizacion`, `estado`) VALUES ('Tipos de resultado', 'tipos-de-resultado', '1', '1', '43', '0', '1', '1', '1');

INSERT INTO `tipo_resultado` (`id_tipo_resultado`,`nombre_tipo_resultado`, `unico_tipo_resultado`, `tipo_campo`) VALUES (1, 'Documento', '0', '2');
INSERT INTO `tipo_resultado` (`id_tipo_resultado`, `nombre_tipo_resultado`, `unico_tipo_resultado`, `tipo_campo`) VALUES (2,'Dato alfanumerico', '0', '1');
INSERT INTO `tipo_resultado` (`id_tipo_resultado`,`nombre_tipo_resultado`, `unico_tipo_resultado`, `tipo_campo`) VALUES (3, 'Fecha', '0', '3');
INSERT INTO `tipo_resultado` (`id_tipo_resultado`,`nombre_tipo_resultado`, `unico_tipo_resultado`, `tipo_campo`) VALUES (4, 'Historico de sentencias', '1', '6');
INSERT INTO `tipo_resultado` (`id_tipo_resultado`, `nombre_tipo_resultado`, `unico_tipo_resultado`, `tipo_campo`) VALUES (5,'Número del Radicado', '1', '1');
INSERT INTO `tipo_resultado` (`id_tipo_resultado`, `nombre_tipo_resultado`, `unico_tipo_resultado`, `tipo_campo`) VALUES (6,'Entidad de Justicia en primera instancia', '1', '1');
INSERT INTO `tipo_resultado` (`id_tipo_resultado`, `nombre_tipo_resultado`, `unico_tipo_resultado`, `tipo_campo`) VALUES (7,'Entidad de justicia en segunda instancia', '1', '1');
INSERT INTO `tipo_resultado` (`id_tipo_resultado`, `nombre_tipo_resultado`, `unico_tipo_resultado`, `tipo_campo`) VALUES (8,'Cuantía de la demanda', '1', '4');
INSERT INTO `tipo_resultado` (`id_tipo_resultado`, `nombre_tipo_resultado`, `unico_tipo_resultado`, `tipo_campo`) VALUES (9,'Estimación de pretensiones', '1', '4');
INSERT INTO `tipo_resultado` (`id_tipo_resultado`, `nombre_tipo_resultado`, `unico_tipo_resultado`, `tipo_campo`) VALUES (10,'Fecha de radicación del cumplimiento', '1', '3');
INSERT INTO `tipo_resultado` (`id_tipo_resultado`, `nombre_tipo_resultado`, `unico_tipo_resultado`, `tipo_campo`) VALUES (11,'Fecha de pago', '1', '3');
INSERT INTO `tipo_resultado` (`id_tipo_resultado`, `nombre_tipo_resultado`, `unico_tipo_resultado`, `tipo_campo`) VALUES (12,'Ubicación física del archivo muerto', '1', '1');
INSERT INTO `tipo_resultado` (`id_tipo_resultado`, `nombre_tipo_resultado`, `unico_tipo_resultado`, `tipo_campo`) VALUES (13,'Valor final sentencia', '1', '3');
INSERT INTO `tipo_resultado` (`id_tipo_resultado`, `nombre_tipo_resultado`, `unico_tipo_resultado`, `tipo_campo`) VALUES (14,'Magistrado ponente', '1', '1');


CREATE TABLE `proceso_tipo_resultado` (
  `id_proceso_tipo_resultado` INT NOT NULL,
  `id_tipo_resultado` INT NOT NULL,
  `valor_proceso_tipo_resultado` VARCHAR(100) NULL,
  PRIMARY KEY (`id_proceso_tipo_resultado`));

ALTER TABLE `proceso_tipo_resultado`
ADD COLUMN `id_proceso` INT NOT NULL AFTER `valor_proceso_tipo_resultado`;

ALTER TABLE `proceso_tipo_resultado`
CHANGE COLUMN `id_proceso_tipo_resultado` `id_proceso_tipo_resultado` INT(11) NOT NULL AUTO_INCREMENT ;
