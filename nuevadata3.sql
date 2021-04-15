ALTER TABLE `plantilla_documento`
ADD COLUMN `eliminado` TINYINT(1) NULL DEFAULT 0 AFTER `id_usuario_actualizacion`;

ALTER TABLE `plantilla_documento`
CHANGE COLUMN `contenido_plantilla_documento` `contenido_plantilla_documento` LONGTEXT NOT NULL ;

UPDATE `menu` SET `ruta_menu` = 'plantillas', `estado` = '1' WHERE (`id_menu` = '17');

CREATE TABLE `variables` (
  `id_variable` INT NOT NULL AUTO_INCREMENT,
  `nombre_variable` VARCHAR(45) NULL,
  `valor_variable` VARCHAR(45) NOT NULL,
  `estado_variable` TINYINT(1) NULL DEFAULT 1,
  `id_grupo_variable` INT NOT NULL,
  PRIMARY KEY (`id_variable`),
  UNIQUE INDEX `valor_variable_UNIQUE` (`valor_variable` ASC))
ENGINE = InnoDB;

ALTER TABLE `variables`
ADD COLUMN `orden` INT(3) NULL DEFAULT 0 AFTER `id_grupo_variable`;

CREATE TABLE `grupos_variables` (
`id_grupo_variable` INT NOT NULL AUTO_INCREMENT,
`nombre_grupo_variable` VARCHAR(45) NULL,
`estado_grupo_variable` TINYINT(1) NULL DEFAULT 1,
PRIMARY KEY (`id_grupo_variable`));

ALTER TABLE `grupos_variables`
ADD COLUMN `orden` INT(2) NULL DEFAULT 0 AFTER `estado_grupo_variable`;

ALTER TABLE `proceso`
ADD COLUMN `id_etapa_proceso` INT NULL DEFAULT 0 COMMENT 'Etapa en la que se encuentra el proceso' AFTER `dar_informacion_caso`;

CREATE TABLE `proceso_etapa` (
  `id_proceso_etapa` INT NOT NULL AUTO_INCREMENT,
  `id_etapa_proceso` INT NOT NULL,
  `id_proceso` INT NOT NULL,
  `porcentaje` INT(3) DEFAULT 0,
  PRIMARY KEY (`id_proceso_etapa`));

ALTER TABLE `proceso_etapa`
ADD COLUMN `fecha_creacion` DATETIME NULL AFTER `porcentaje`,
ADD COLUMN `fecha_actualizacion` DATETIME NULL AFTER `fecha_creacion`,
ADD COLUMN `id_usuario_creacion` INT NULL AFTER `fecha_actualizacion`,
ADD COLUMN `id_usuario_actualizacion` INT NULL AFTER `id_usuario_creacion`;


CREATE TABLE `proceso_etapa_actuacion` (
  `id_proceso_etapa_actuacion` INT NOT NULL AUTO_INCREMENT,
  `id_proceso_etapa` INT NOT NULL,
  `id_actuacion` INT NOT NULL,
  `fecha_inicio` DATETIME NULL,
  `fecha_fin` DATETIME NULL,
  `fecha_radicado` DATETIME NULL,
  `numero_radicado` DATETIME NULL,
  `fecha_vencimiento` DATETIME NULL,
  `fecha_respuesta` DATETIME NULL,
  `id_entidad_justicia` INT NULL,
  `nombre_juez` VARCHAR(45) NULL,
  `numero_proceso` VARCHAR(45) NULL,
  `instancia` VARCHAR(45) NULL,
  `resultado` TINYINT(1) NULL COMMENT 'Favorable y en contra',
  `fecha_notificacion` DATETIME NULL,
  `tipo_resultado` INT(1) NULL COMMENT 'Resolución y auto',
  `entidad_profirio_respuesta` VARCHAR(45) NULL,
  `fecha_audiencia` DATETIME NULL,
  `lugar_audiencia` VARCHAR(45) NULL,
  `apela_resultado` TINYINT(1) NULL,
  `motivo` TEXT NULL,
  `comentario` TEXT NULL,
  PRIMARY KEY (`id_proceso_etapa_actuacion`));

ALTER TABLE `proceso_etapa_actuacion`
ADD COLUMN `fecha_creacion` DATETIME NULL,
ADD COLUMN `fecha_actualizacion` DATETIME NULL,
ADD COLUMN `id_usuario_creacion` INT NULL,
ADD COLUMN `id_usuario_actualizacion` INT NULL;


CREATE TABLE `proceso_bitacora` (
  `id_proceso_bitacora` INT NOT NULL AUTO_INCREMENT,
  `id_usuario` INT NOT NULL,
  `comentario` TEXT NULL,
  `fecha_creacion` DATETIME NULL,
  `fecha_actualizacion` DATETIME NULL,
  PRIMARY KEY (`id_proceso_bitacora`));

ALTER TABLE `proceso_bitacora`
ADD COLUMN `id_proceso` INT NOT NULL AFTER `fecha_actualizacion`;

CREATE TABLE `proceso_etapa_bitacora` (
  `id_proceso_etapa_bitacora` INT NOT NULL AUTO_INCREMENT,
  `id_usuario` INT NOT NULL,
  `comentario` TEXT NULL,
  `fecha_creacion` DATETIME NULL,
  `fecha_actualizacion` DATETIME NULL,
  PRIMARY KEY (`id_proceso_etapa_bitacora`));

ALTER TABLE `proceso_etapa_bitacora`
ADD COLUMN `proceso_etapa` INT NOT NULL AFTER `fecha_actualizacion`;


CREATE TABLE `proceso_etapa_actuacion_bitacora` (
  `id_proceso_etapa_actuacion_bitacora` INT NOT NULL AUTO_INCREMENT,
  `id_usuario` INT NOT NULL,
  `comentario` TEXT NULL,
  `fecha_creacion` DATETIME NULL,
  `fecha_actualizacion` DATETIME NULL,
  PRIMARY KEY (`id_proceso_etapa_actuacion_bitacora`));

ALTER TABLE `proceso_etapa_actuacion_bitacora`
ADD COLUMN `id_proceso_etapa_actuacion` INT NOT NULL AFTER `fecha_actualizacion`;

ALTER TABLE `proceso_etapa_actuacion`
ADD COLUMN `id_usuario_responsable` INT NOT NULL AFTER `id_usuario_actualizacion`;

ALTER TABLE `proceso_etapa_actuacion`
ADD COLUMN `finalizado` TINYINT(1) NULL DEFAULT 0 AFTER `id_usuario_responsable`;

ALTER TABLE `proceso_etapa_actuacion_bitacora`
ADD COLUMN `sesion_id` VARCHAR(45) NULL DEFAULT '' AFTER `id_proceso_etapa_actuacion`;

ALTER TABLE `proceso_etapa_bitacora`
ADD COLUMN `sesion_id` VARCHAR(45) NULL DEFAULT '';

ALTER TABLE `proceso_bitacora`
ADD COLUMN `sesion_id` VARCHAR(45) NULL DEFAULT '';

ALTER TABLE `cliente`
DROP INDEX `FK_cliente_intermediario` ;

ALTER TABLE `proceso`
ADD COLUMN `acto_administrativo` VARCHAR(45) NULL AFTER `id_etapa_proceso`;

ALTER TABLE `proceso`
ADD COLUMN `ultima_entidad_retiro` VARCHAR(45) NULL AFTER `acto_administrativo`;

ALTER TABLE `proceso_etapa_actuacion`
ADD COLUMN `valor_pago` FLOAT(11,2) NULL DEFAULT 0 AFTER `finalizado`;

ALTER TABLE `proceso_etapa_actuacion`
ADD COLUMN `id_usuario_asigna` INT(11) NULL AFTER `valor_pago`;

ALTER TABLE `proceso`
CHANGE COLUMN `fecha_retiro_servicio` `fecha_retiro_servicio` DATE NULL ;

ALTER TABLE `actuacion`
ADD COLUMN `dias_vencimiento_unidad` INT(1) NULL DEFAULT 1 AFTER `eliminado`;

ALTER TABLE `actuacion`
ADD COLUMN `tipo_actuacion` INT(1) NULL DEFAULT 2 AFTER `dias_vencimiento_unidad`,
ADD COLUMN `area_responsable` INT(1) NULL DEFAULT 1 COMMENT ' 1 = Recepción 2 = Administración 3= Agotamientos de Via 4 = Sustanciación 5 = Dependencia 6 = Mensajería ' AFTER `tipo_actuacion`,
ADD COLUMN `dias_vencimiento_tipo` INT(1) NULL DEFAULT 1 COMMENT '1 = calendario 2 = habiles' AFTER `area_responsable`,
ADD COLUMN `tipo_resultado` INT(1) NULL DEFAULT 2 COMMENT '1 = documento 2 = dato alfanumerico 3 = fecha ' AFTER `dias_vencimiento_tipo`,
CHANGE COLUMN `dias_vencimiento_unidad` `dias_vencimiento_unidad` INT(1) NULL DEFAULT '1' COMMENT '1 = dias 2 = meses' ;

ALTER TABLE `proceso_etapa_actuacion`
ADD COLUMN `resultado_actuacion` VARCHAR(100) NULL DEFAULT '' AFTER `id_usuario_asigna`;

CREATE TABLE `proceso_etapa_actuacion_plantillas` (
  `id_proceso_etapa_actuacion_plantillas` INT NOT NULL AUTO_INCREMENT,
  `id_proceso_etapa_actuacion` INT NULL DEFAULT 0,
  `id_proceso_etapa` INT NULL DEFAULT 0,
  `id_proceso` INT NULL DEFAULT 0,
  `id_plantilla_documento` INT NOT NULL,
  PRIMARY KEY (`id_proceso_etapa_actuacion_plantillas`));

ALTER TABLE `variables`
ADD COLUMN `function_variable` VARCHAR(100) NOT NULL AFTER `orden`;

ALTER TABLE `persona`
ADD COLUMN `id_lugar_expedicion` INT(11) NULL AFTER `id_usuario_actualizacion`;

CREATE TABLE `proceso_etapa_actuacion_documento` (
  `id_proceso_etapa_actuacion_documento` INT NOT NULL AUTO_INCREMENT,
  `id_proceso_etapa_actuacion` INT NULL,
  `id_documento` INT NOT NULL,
  `ruta_fisica_archivo` VARCHAR(45) NULL,
  `ruta_http_archivo` VARCHAR(45) NULL,
  `nombre_archivo` VARCHAR(45) NULL,
  `id_usuario_creacion` INT NOT NULL DEFAULT 0,
  PRIMARY KEY (`id_proceso_etapa_actuacion_documento`));

ALTER TABLE `proceso`
ADD COLUMN `entidad_justicia_primera_instancia` INT(11) NULL AFTER `caducidad`,
ADD COLUMN `entidad_justicia_segunda_instancia` INT(11) NULL AFTER `entidad_justicia_primera_instancia`,
ADD COLUMN `cuantia_demandada` FLOAT(11,2) NULL AFTER `entidad_justicia_segunda_instancia`,
ADD COLUMN `estimacion_pretenciones` FLOAT(11,2) NULL AFTER `cuantia_demandada`;

ALTER TABLE `proceso`
ADD COLUMN `valor_final_sentencia` FLOAT(11,2) NULL AFTER `estimacion_pretenciones`;

ALTER TABLE `proceso_etapa_actuacion`
CHANGE COLUMN `numero_radicado` `numero_radicado` VARCHAR(45) NULL DEFAULT NULL ;

INSERT INTO `grupos_variables` (`id_grupo_variable`, `nombre_grupo_variable`) VALUES ('1', 'Cliente');
INSERT INTO `grupos_variables` (`id_grupo_variable`, `nombre_grupo_variable`) VALUES ('2', 'Proceso');
INSERT INTO `grupos_variables` (`id_grupo_variable`, `nombre_grupo_variable`) VALUES ('3', 'Globales');
INSERT INTO `grupos_variables` (`id_grupo_variable`, `nombre_grupo_variable`) VALUES ('4', 'Beneficiario');
INSERT INTO `grupos_variables` (`id_grupo_variable`, `nombre_grupo_variable`) VALUES ('5', 'Contacto');


INSERT INTO `variables` (`nombre_variable`, `valor_variable`, `id_grupo_variable`, `function_variable`) VALUES ('Teléfono', 'TELEFONO_CLIENTE', '1', '');
INSERT INTO `variables` (`nombre_variable`, `valor_variable`, `id_grupo_variable`, `function_variable`) VALUES ('Celular 1', 'CELULAR_PRINCIPAL_CLIENTE', '1', '');
INSERT INTO `variables` (`nombre_variable`, `valor_variable`, `id_grupo_variable`, `function_variable`) VALUES ('Celular 2', 'CELULAR_SECUNDARIO_CLIENTE', '1', '');
INSERT INTO `variables` (`nombre_variable`, `valor_variable`, `id_grupo_variable`, `function_variable`) VALUES ('Correo electrónico', 'CORREO_ELECTRONICO_CLIENTE', '1', '');
INSERT INTO `variables` (`nombre_variable`, `valor_variable`, `id_grupo_variable`, `function_variable`) VALUES ('Nombre completo', 'NOMBRE_COMPLETO_CLIENTE', '1', '');
INSERT INTO `variables` (`nombre_variable`, `valor_variable`, `id_grupo_variable`, `function_variable`) VALUES ('Primer nombre', 'PRIMER_NOMBRE_CLIENTE', '1', '');
INSERT INTO `variables` (`nombre_variable`, `valor_variable`, `id_grupo_variable`, `function_variable`) VALUES ('Primer apellido', 'PRIMER_APELLIDO_CLIENTE', '1', '');
INSERT INTO `variables` (`nombre_variable`, `valor_variable`, `id_grupo_variable`, `function_variable`) VALUES ('Segundo nombre', 'SEGUNDO_NOMBRE_CLIENTE', '1', '');
INSERT INTO `variables` (`nombre_variable`, `valor_variable`, `id_grupo_variable`, `function_variable`) VALUES ('Segundo apellido', 'SEGUNDO_APELLIDO_CLIENTE', '1', '');
INSERT INTO `variables` (`nombre_variable`, `valor_variable`, `id_grupo_variable`, `function_variable`) VALUES ('Número de documento', 'NUMERO_DOCUMENTO_CLIENTE', '1', '');
INSERT INTO `variables` (`nombre_variable`, `valor_variable`, `id_grupo_variable`, `function_variable`) VALUES ('Tipo de documento', 'TIPO_DOCUMENTO_CLIENTE', '1', '');
INSERT INTO `variables` (`nombre_variable`, `valor_variable`, `id_grupo_variable`, `function_variable`) VALUES ('Tipo de documento abreviado', 'TIPO_DOCUMENTO_ABREVIADO_CLIENTE', '1', '');
INSERT INTO `variables` (`nombre_variable`, `valor_variable`, `id_grupo_variable`, `function_variable`) VALUES ('Lugar de expedicion del documento', 'LUGAR_EXPEDICION_DOCUMENTO_CLIENTE', '1', '');
INSERT INTO `variables` (`nombre_variable`, `valor_variable`, `id_grupo_variable`, `function_variable`) VALUES ('Estado vital', 'ESTADO_VITAL_CLIENTE', '1', '');
INSERT INTO `variables` (`nombre_variable`, `valor_variable`, `id_grupo_variable`, `function_variable`) VALUES ('Direccion de residencia', 'DIRECCION_RESIDENCIA_CLIENTE', '1', '');
INSERT INTO `variables` (`nombre_variable`, `valor_variable`, `id_grupo_variable`, `function_variable`) VALUES ('Barrio de residencia', 'BARRIO_RESIDENCIA_CLIENTE', '1', '');

INSERT INTO `variables` (`nombre_variable`, `valor_variable`, `id_grupo_variable`, `function_variable`) VALUES ('Número del proceso', 'NUMERO_PROCESO', '2', '');
INSERT INTO `variables` (`nombre_variable`, `valor_variable`, `id_grupo_variable`, `function_variable`) VALUES ('Fecha de creación', 'FECHA_CREACION_PROCESO', '2', '');
INSERT INTO `variables` (`nombre_variable`, `valor_variable`, `id_grupo_variable`, `function_variable`) VALUES ('Hora de creación', 'HORA_CREACION_PROCESO', '2', '');
INSERT INTO `variables` (`nombre_variable`, `valor_variable`, `id_grupo_variable`, `function_variable`) VALUES ('Pais', 'PAIS_PROCESO', '2', '');
INSERT INTO `variables` (`nombre_variable`, `valor_variable`, `id_grupo_variable`, `function_variable`) VALUES ('Departamento', 'DEPARTAMENTO_PROCESO', '2', '');
INSERT INTO `variables` (`nombre_variable`, `valor_variable`, `id_grupo_variable`, `function_variable`) VALUES ('Municipio', 'MUNICIPIO_PROCESO', '2', '');
INSERT INTO `variables` (`nombre_variable`, `valor_variable`, `id_grupo_variable`, `function_variable`) VALUES ('Entidad demandada', 'ENTIDAD_DEMANDADA', '2', '');
INSERT INTO `variables` (`nombre_variable`, `valor_variable`, `id_grupo_variable`, `function_variable`) VALUES ('Fecha de retiro del servicio', 'FECHA_RETIRO_SERVICIO_PROCESO', '2', '');
INSERT INTO `variables` (`nombre_variable`, `valor_variable`, `id_grupo_variable`, `function_variable`) VALUES ('Entidad de justicia', 'ENTIDAD_JUSTICIA', '2', '');
INSERT INTO `variables` (`nombre_variable`, `valor_variable`, `id_grupo_variable`, `function_variable`) VALUES ('Acto administrativo del retiro', 'ACTO_ADMINISTRATIVO_RETIRO', '2', '');

INSERT INTO `variables` (`nombre_variable`, `valor_variable`, `id_grupo_variable`, `function_variable`) VALUES ('Fecha actual', 'FECHA_ACTUAL', '3', 'date("d/m/Y")');
INSERT INTO `variables` (`nombre_variable`, `valor_variable`, `id_grupo_variable`, `function_variable`) VALUES ('Hora actual', 'HORA_ACTUAL', '3', 'date("h:i A")');

INSERT INTO `variables` (`nombre_variable`, `valor_variable`, `id_grupo_variable`, `function_variable`) VALUES ('Tipo de documento', 'TIPO_DOCUMENTO_BENEFICIARIO', '4', '');
INSERT INTO `variables` (`nombre_variable`, `valor_variable`, `id_grupo_variable`, `function_variable`) VALUES ('Número de documento', 'DOCUMENTO_BENEFICIARIO', '4', '');
INSERT INTO `variables` (`nombre_variable`, `valor_variable`, `id_grupo_variable`, `function_variable`) VALUES ('Nombre completo', 'NOMBRE_COMPLETO_BENEFICIARIO', '4', '');
INSERT INTO `variables` (`nombre_variable`, `valor_variable`, `id_grupo_variable`, `function_variable`) VALUES ('Parentesco con el cliente', 'PARENTESCO_CLIENTE_BENEFICIARIO', '4', '');

INSERT INTO `variables` (`nombre_variable`, `valor_variable`, `id_grupo_variable`, `function_variable`) VALUES ('Nombre completo', 'NOMBRE_COMPLETO_CONTACTO', '5', '');
INSERT INTO `variables` (`nombre_variable`, `valor_variable`, `id_grupo_variable`, `function_variable`) VALUES ('Parentesco con el cliente', 'PARENTESCO_CONTACTO', '5', '');
INSERT INTO `variables` (`nombre_variable`, `valor_variable`, `id_grupo_variable`, `function_variable`) VALUES ('Municipio', 'MUNICIPIO_CONTACTO', '5', '');
INSERT INTO `variables` (`nombre_variable`, `valor_variable`, `id_grupo_variable`, `function_variable`) VALUES ('Departamento', 'DEPARTAMENTO_CONTACTO', '5', '');
INSERT INTO `variables` (`nombre_variable`, `valor_variable`, `id_grupo_variable`, `function_variable`) VALUES ('Pais', 'PAIS_CONTACTO', '5', '');
INSERT INTO `variables` (`nombre_variable`, `valor_variable`, `id_grupo_variable`, `function_variable`) VALUES ('Barrio', 'BARRIO_CONTACTO', '5', '');
INSERT INTO `variables` (`nombre_variable`, `valor_variable`, `id_grupo_variable`, `function_variable`) VALUES ('Dirección', 'DIRECCION_CONTACTO', '5', '');
INSERT INTO `variables` (`nombre_variable`, `valor_variable`, `id_grupo_variable`, `function_variable`) VALUES ('Celular', 'CELULAR_CONTACTO', '5', '');
INSERT INTO `variables` (`nombre_variable`, `valor_variable`, `id_grupo_variable`, `function_variable`) VALUES ('Teléfono', 'TELEFONO_CONTACTO', '5', '');
INSERT INTO `variables` (`nombre_variable`, `valor_variable`, `id_grupo_variable`, `function_variable`) VALUES ('Correo electrónico', 'CORREO_ELECTRONICO_CONTACTO', '5', '');

UPDATE `variables` SET `function_variable` = 'id_proceso' WHERE (`id_variable` = '17');
UPDATE `variables` SET `function_variable` = 'getFechaCreacion' WHERE (`id_variable` = '18');
UPDATE `variables` SET `function_variable` = 'getHoraCreacion' WHERE (`id_variable` = '19');
UPDATE `variables` SET `function_variable` = 'getPais' WHERE (`id_variable` = '20');
UPDATE `variables` SET `function_variable` = 'getDepartamento' WHERE (`id_variable` = '21');
UPDATE `variables` SET `function_variable` = 'getMunicipio' WHERE (`id_variable` = '22');
UPDATE `variables` SET `function_variable` = 'getEntidadDemandada' WHERE (`id_variable` = '23');
UPDATE `variables` SET `function_variable` = 'getFechaRetiroServicioString' WHERE (`id_variable` = '24');
UPDATE `variables` SET `function_variable` = 'getEntidadJusticia' WHERE (`id_variable` = '25');
UPDATE `variables` SET `function_variable` = 'acto_administrativo' WHERE (`id_variable` = '26');

UPDATE `variables` SET `function_variable` = 'getTelefono' WHERE (`id_variable` = '1');
UPDATE `variables` SET `function_variable` = 'getCelular' WHERE (`id_variable` = '2');
UPDATE `variables` SET `function_variable` = 'celular2' WHERE (`id_variable` = '3');
UPDATE `variables` SET `function_variable` = 'getEmail' WHERE (`id_variable` = '4');
UPDATE `variables` SET `function_variable` = 'getNombreCompleto' WHERE (`id_variable` = '5');
UPDATE `variables` SET `function_variable` = 'getPrimerNombre' WHERE (`id_variable` = '6');
UPDATE `variables` SET `function_variable` = 'getPrimerApellido' WHERE (`id_variable` = '7');
UPDATE `variables` SET `function_variable` = 'getSegundoNombre' WHERE (`id_variable` = '8');
UPDATE `variables` SET `function_variable` = 'getSegundoApellido' WHERE (`id_variable` = '9');
UPDATE `variables` SET `function_variable` = 'getNumeroDocumento' WHERE (`id_variable` = '10');
UPDATE `variables` SET `function_variable` = 'getSiglasTipoDocumento' WHERE (`id_variable` = '12');
UPDATE `variables` SET `function_variable` = 'getTipoDocumento' WHERE (`id_variable` = '11');
UPDATE `variables` SET `function_variable` = 'getLugarExpedicionDocumento' WHERE (`id_variable` = '13');
UPDATE `variables` SET `function_variable` = 'getEstadoVital' WHERE (`id_variable` = '14');
UPDATE `variables` SET `function_variable` = 'getDireccion' WHERE (`id_variable` = '15');
UPDATE `variables` SET `function_variable` = 'getBarrio' WHERE (`id_variable` = '16');

UPDATE `variables` SET `function_variable` = 'correo_electronico' WHERE (`id_variable` = '42');
UPDATE `variables` SET `function_variable` = 'telefono' WHERE (`id_variable` = '41');
UPDATE `variables` SET `function_variable` = 'celular' WHERE (`id_variable` = '40');
UPDATE `variables` SET `function_variable` = 'direccion' WHERE (`id_variable` = '39');
UPDATE `variables` SET `function_variable` = 'barrio' WHERE (`id_variable` = '38');
UPDATE `variables` SET `function_variable` = 'parentesco' WHERE (`id_variable` = '34');
UPDATE `variables` SET `function_variable` = 'nombre_contacto' WHERE (`id_variable` = '33');
UPDATE `variables` SET `function_variable` = 'getMunicipio' WHERE (`id_variable` = '35');
UPDATE `variables` SET `function_variable` = 'getDepartamento' WHERE (`id_variable` = '36');
UPDATE `variables` SET `function_variable` = 'getPais' WHERE (`id_variable` = '37');


UPDATE `variables` SET `function_variable` = 'getTipoDocumentoBeneficiario' WHERE (`id_variable` = '29');
UPDATE `variables` SET `function_variable` = 'getDocumentoBeneficiario' WHERE (`id_variable` = '30');
UPDATE `variables` SET `function_variable` = 'getParentescoBeneficiario' WHERE (`id_variable` = '32');
UPDATE `variables` SET `function_variable` = 'getNombreBeneficiario' WHERE (`id_variable` = '31');

ALTER TABLE `cliente`
ADD COLUMN `telefono_beneficiario` VARCHAR(45) NULL AFTER `id_tipo_documento_beneficiario`,
ADD COLUMN `celular_beneficiario` VARCHAR(45) NULL AFTER `telefono_beneficiario`,
ADD COLUMN `celular2_beneficiario` VARCHAR(45) NULL AFTER `celular_beneficiario`,
ADD COLUMN `correo_electronico_beneficiario` VARCHAR(45) NULL AFTER `celular2_beneficiario`;

ALTER TABLE `proceso`
ADD COLUMN `caducidad` TINYINT(1) NULL DEFAULT 0 AFTER `ultima_entidad_retiro`;

ALTER TABLE `proceso_etapa_actuacion`
ADD COLUMN `fecha_actuacion_rama` DATETIME NULL AFTER `resultado_actuacion`,
ADD COLUMN `fecha_notificacion_rama` DATETIME NULL AFTER `fecha_actuacion_rama`,
ADD COLUMN `fecha_inicio_termino_rama` DATETIME NULL AFTER `fecha_notificacion_rama`,
ADD COLUMN `anotacion_rama` VARCHAR(45) NULL DEFAULT '' AFTER `fecha_inicio_termino_rama`;

ALTER TABLE `proceso_etapa_actuacion`
CHANGE COLUMN `fecha_actuacion_rama` `fecha_actuacion_rama` DATE NULL DEFAULT NULL ,
CHANGE COLUMN `fecha_notificacion_rama` `fecha_notificacion_rama` DATE NULL DEFAULT NULL ,
CHANGE COLUMN `fecha_inicio_termino_rama` `fecha_inicio_termino_rama` DATE NULL DEFAULT NULL ;

ALTER TABLE `proceso`
ADD COLUMN `fecha_radicacion_cumplimineto` DATE NULL AFTER `valor_final_sentencia`,
ADD COLUMN `fecha_pago` DATE NULL AFTER `fecha_radicacion_cumplimineto`,
ADD COLUMN `ubicacion_fisica_archivo_muerto` VARCHAR(50) NULL DEFAULT '' AFTER `fecha_pago`;

ALTER TABLE `proceso_etapa_actuacion`
ADD COLUMN `historico` TINYINT(1) NULL DEFAULT 0 AFTER `anotacion_rama`;

ALTER TABLE `proceso_etapa_actuacion`
ADD COLUMN `fecha_resultado` DATETIME NULL AFTER `historico`;

ALTER TABLE `proceso_etapa_actuacion`
CHANGE COLUMN `fecha_resultado` `fecha_resultado` DATE NULL DEFAULT NULL ;

ALTER TABLE `proceso`
CHANGE COLUMN `entidad_justicia_primera_instancia` `entidad_justicia_primera_instancia` VARCHAR(60) NULL DEFAULT NULL ,
CHANGE COLUMN `entidad_justicia_segunda_instancia` `entidad_justicia_segunda_instancia` VARCHAR(60) NULL DEFAULT NULL ;

CREATE TABLE `cobro` (
  `id_cobro` INT NOT NULL AUTO_INCREMENT,
  `id_proceso_etapa_actuacion` INT NULL,
  `concepto` VARCHAR(100) NULL,
  `valor` FLOAT(11,2) NULL,
  `fecha_cobro` DATE NULL,
  `id_cliente` INT NULL,
  `id_usuario_creacion` INT NULL,
  `fecha_creacion` DATETIME NULL,
  `fecha_actualizacion` DATETIME NULL,
  PRIMARY KEY (`id_cobro`));

ALTER TABLE `cobro`
CHANGE COLUMN `concepto` `concepto` VARCHAR(100) NULL DEFAULT '' ;

ALTER TABLE `cobro`
ADD COLUMN `id_usuario_actualizacion` INT NULL AFTER `fecha_actualizacion`;

INSERT INTO `menu` (`nombre_menu`, `ruta_menu`, `parent_id`, `tipo_menu`, `orden_menu`, `inactivo`, `fecha_creacion`, `id_usuario_creacion`, `fecha_actualizacion`, `id_usuario_actualizacion`, `estado`) VALUES ('Cobros y pagos', 'cobros-y-pagos', '38', '1', '5', '0', '2020-05-23 20:37:57', '1', '2020-05-23 20:37:57', '1', '1');

ALTER TABLE `cobro`
ADD COLUMN `eliminado` TINYINT(1) NULL DEFAULT 0 AFTER `id_usuario_actualizacion`,
ADD COLUMN `cerrado` TINYINT(1) NULL DEFAULT 0 AFTER `eliminado`;

CREATE TABLE `pago` (
  `id_pago` INT NOT NULL AUTO_INCREMENT,
  `fecha_pago` DATE NULL,
  `forma_pago` INT(1) NULL DEFAULT 1 COMMENT '1 => Efectivo\n2 => Tarjeta de credito\n3 => Tarjeta debito\n4 => Consignacion',
  `id_entidad_financiera` INT(3) NULL,
  `referencia` VARCHAR(100) NULL DEFAULT '',
  `valor_pago` FLOAT(11,2) NULL DEFAULT 0,
  `eliminado` TINYINT(1) NULL DEFAULT 0,
  PRIMARY KEY (`id_pago`));


ALTER TABLE `pago`
ADD COLUMN `fecha_creacion` DATE NULL AFTER `eliminado`,
ADD COLUMN `fecha_actualizacion` DATE NULL AFTER `fecha_creacion`,
ADD COLUMN `id_usuario_actualizacion` INT(11) NULL AFTER `fecha_actualizacion`,
ADD COLUMN `id_usuario_creacion` INT(11) NULL AFTER `id_usuario_actualizacion`,
ADD COLUMN `id_cobro` INT(11) NULL AFTER `id_usuario_creacion`;

CREATE TABLE `entidad_financiera` (
  `id_entidad_financiera` INT NOT NULL AUTO_INCREMENT,
  `nombre_entidad_financiera` VARCHAR(100) NULL DEFAULT '',
  `eliminado` TINYINT(1) NULL DEFAULT 0,
  PRIMARY KEY (`id_entidad_financiera`));

ALTER TABLE `pago`
CHANGE COLUMN `forma_pago` `forma_pago` INT(1) NULL DEFAULT '1' COMMENT '1 => Efectivo\n2 => Consignacion\n3 => Cheque\n4 => Tarjeta de credito\n5 => Tarjeta debito' ;

ALTER TABLE `pago`
CHANGE COLUMN `fecha_creacion` `fecha_creacion` DATETIME NULL DEFAULT NULL ,
CHANGE COLUMN `fecha_actualizacion` `fecha_actualizacion` DATETIME NULL DEFAULT NULL ;

ALTER TABLE `proceso`
ADD COLUMN `cerrado` TINYINT(1) NULL DEFAULT 0 AFTER `ubicacion_fisica_archivo_muerto`;

INSERT INTO `entidad_financiera` (`nombre_entidad_financiera`) VALUES ('Banco Falabella');
INSERT INTO `entidad_financiera` (`nombre_entidad_financiera`) VALUES ('Banco de Bogotá');
INSERT INTO `entidad_financiera` (`nombre_entidad_financiera`) VALUES ('Banco Finandina');
INSERT INTO `entidad_financiera` (`nombre_entidad_financiera`) VALUES ('Banco Popular');
INSERT INTO `entidad_financiera` (`nombre_entidad_financiera`) VALUES ('Banco Santander de Negocios Colombia S.A.');
INSERT INTO `entidad_financiera` (`nombre_entidad_financiera`) VALUES ('Banco Itaú Corpbanca Colombia S.A.');
INSERT INTO `entidad_financiera` (`nombre_entidad_financiera`) VALUES ('Banco Coopcentral');
INSERT INTO `entidad_financiera` (`nombre_entidad_financiera`) VALUES ('Bancolombia');
INSERT INTO `entidad_financiera` (`nombre_entidad_financiera`) VALUES ('Banco Citibank');
INSERT INTO `entidad_financiera` (`nombre_entidad_financiera`) VALUES ('Banco BBVA');
INSERT INTO `entidad_financiera` (`nombre_entidad_financiera`) VALUES ('Banco AV Villas');
INSERT INTO `entidad_financiera` (`nombre_entidad_financiera`) VALUES ('Banco de Occidente');
INSERT INTO `entidad_financiera` (`nombre_entidad_financiera`) VALUES ('Banco Davivienda');
INSERT INTO `entidad_financiera` (`nombre_entidad_financiera`) VALUES ('Banco Pichincha');
INSERT INTO `entidad_financiera` (`nombre_entidad_financiera`) VALUES ('Bancoomeva');
INSERT INTO `entidad_financiera` (`nombre_entidad_financiera`) VALUES ('Banco Mundo Mujer');
