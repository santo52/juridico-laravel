ALTER TABLE `proceso`
CHANGE COLUMN `entidad_justicia_primera_instancia` `entidad_justicia_primera_instancia` INT NULL DEFAULT 0 ,
CHANGE COLUMN `entidad_justicia_segunda_instancia` `entidad_justicia_segunda_instancia` INT NULL DEFAULT 0 ;

UPDATE `tipo_resultado` SET `id_tipo_resultado` = '16' WHERE (`id_tipo_resultado` = '14');
UPDATE `tipo_resultado` SET `id_tipo_resultado` = '14' WHERE (`id_tipo_resultado` = '13');
UPDATE `tipo_resultado` SET `id_tipo_resultado` = '13' WHERE (`id_tipo_resultado` = '12');
UPDATE `tipo_resultado` SET `id_tipo_resultado` = '12' WHERE (`id_tipo_resultado` = '11');
UPDATE `tipo_resultado` SET `id_tipo_resultado` = '11' WHERE (`id_tipo_resultado` = '10');
UPDATE `tipo_resultado` SET `id_tipo_resultado` = '10' WHERE (`id_tipo_resultado` = '9');
UPDATE `tipo_resultado` SET `id_tipo_resultado` = '9' WHERE (`id_tipo_resultado` = '8');
UPDATE `tipo_resultado` SET `id_tipo_resultado` = '8' WHERE (`id_tipo_resultado` = '7');
UPDATE `tipo_resultado` SET `id_tipo_resultado` = '7' WHERE (`id_tipo_resultado` = '6');
UPDATE `tipo_resultado` SET `id_tipo_resultado` = '6' WHERE (`id_tipo_resultado` = '5');
UPDATE `tipo_resultado` SET `id_tipo_resultado` = '5' WHERE (`id_tipo_resultado` = '15');
UPDATE `tipo_resultado` SET `id_tipo_resultado` = '15' WHERE (`id_tipo_resultado` = '16');
UPDATE `tipo_resultado` SET `id_tipo_resultado` = '155' WHERE (`id_tipo_resultado` = '5');
UPDATE `tipo_resultado` SET `id_tipo_resultado` = '5' WHERE (`id_tipo_resultado` = '4');
UPDATE `tipo_resultado` SET `id_tipo_resultado` = '4' WHERE (`id_tipo_resultado` = '155');





DROP TABLE `honorario`;
CREATE TABLE `honorario` (
  `id_honorario` int(11) NOT NULL AUTO_INCREMENT,
  `id_proceso` int(11) DEFAULT '0',
  `porcentaje_honorarios` int(2) DEFAULT NULL,
  `valor_comision` float(10,2) DEFAULT NULL,
  `retefuente` float(5,2) DEFAULT '0.00',
  `reteica` float(5,2) DEFAULT '0.00',
  `fecha_actualizacion` datetime DEFAULT NULL,
  `id_usuario_actualizacion` int(11) DEFAULT NULL,
  `fecha_creacion` datetime DEFAULT NULL,
  `id_usuario_creacion` int(11) DEFAULT NULL,
  `eliminado` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`id_honorario`)
);

UPDATE `tipo_resultado` SET `nombre_tipo_resultado` = 'Documento', `tipo_campo` = '2' WHERE (`id_tipo_resultado` = '2');
UPDATE `tipo_resultado` SET `nombre_tipo_resultado` = 'Dato alfanumerico', `tipo_campo` = '1' WHERE (`id_tipo_resultado` = '1');

SET SQL_SAFE_UPDATES = 0;
UPDATE actuacion SET tipo_resultado=2222 where tipo_resultado=1;
UPDATE actuacion SET tipo_resultado=1 where tipo_resultado=2;
UPDATE actuacion SET tipo_resultado=2 where tipo_resultado=2222;

ALTER TABLE `pago_honorario`
ADD COLUMN `forma_pago` INT(1) NULL DEFAULT 1;
