var Type = {

	'TIPOS_IDENTIFICACION': {
		'idCedulaCiudadania': 1,
		'idRegistroUnicoContribuyente': 2,
		'idPasaporte': 3,
		'idCredencial': 4,
		'idDocumentoMigratorio': 5,
		'idTarjetaAndinaMigracion': 6
	},
	'POSICION_ETAPA_PROCESO': {
		'inicial': 1,
		'intermedia': 2,
		'final': 3
	},
	'OBLIGATORIEDAD_DOCUMENTO': {
		's': 1,
		'n': 2
	},
	'APLICA_PRIMERA_INSTANCIA_ENTIDAD_DE_JUSTICIA': {
		's': 1,
		'n': 2
	},
	'APLICA_SEGUNDA_INSTANCIA_ENTIDAD_DE_JUSTICIA': {
		's': 1,
		'n': 2
	},
	'GENERA_ALERTAS_ACTUACION': {
		's': 1,
		'n': 2
	},
	'APLICA_CONTROL_VENCIMIENTO_ACTUACION': {
		's': 1,
		'n': 2
	},
	'REQUIERE_ESTUDIO_FAVORABILIDAD_ACTUACION': {
		's': 1,
		'n': 2
	},
	'ACTUACION_TIENE_COBRO': {
		's': 1,
		'n': 2
	},
	'ACTUACION_CREACION_CLIENTE': {
		's': 1,
		'n': 2
	},
	'MOSTRAR_DATOS_RADICADO_ACTUACION': {
		's': 1,
		'n': 2
	},
	'MOSTRAR_DATOS_JUZGADO_ACTUACION': {
		's': 1,
		'n': 2
	},
	'MOSTRAR_DATOS_RESPUESTA_ACTUACION': {
		's': 1,
		'n': 2
	},
	'MOSTRAR_DATOS_APELACION_ACTUACION': {
		's': 1,
		'n': 2
	},
	'MOSTRAR_DATOS_COBROS_ACTUACION': {
		's': 1,
		'n': 2
	},
	'PROGRAMAR_AUDIENCIA_ACTUACION': {
		's': 1,
		'n': 2
	},
	'CONTROL_ENTREGA_DOCUMENTOS_ACTUACION': {
		's': 1,
		'n': 2
	},
	'GENERAR_DOCUMENTOS_ACTUACION': {
		's': 1,
		'n': 2
	},
	'UNIDAD_TIEMPO': {
		'dias': 1,
		'semanas': 2,
		'meses': 3,
		'anios': 4
	},
	'AUTORIZA_DAR_INFO_ESTADO_PROCESO': {
		's': 1,
		'n': 2
	}

}

jQuery.validator.addMethod("patternTipoIdentificacion", function (value, element) {
	var exp = '';
	switch (jQuery.trim(jQuery('#tipoIdentificacion option:selected').val())) {
		case Type.TIPOS_IDENTIFICACION.idCedulaCiudadania.toString():
			/* Formato del tipo de identificación Cédula de Ciudadanía */
			exp = /^[0-9]{3,12}$/;
			break;
		case Type.TIPOS_IDENTIFICACION.idRegistroUnicoContribuyente.toString():
			/* Formato del tipo de identificación Registro Único de Contribuyente */
			exp = /^[0-9]{6,15}$/;
			break;
		case Type.TIPOS_IDENTIFICACION.idPasaporte.toString():
			/* Formato del tipo de identificación Pasaporte */
			exp = /^[0-9a-zA-Z]{1,20}$/;
			break;
		case Type.TIPOS_IDENTIFICACION.idCredencial.toString():
			/* Formato del tipo de identificación Credencial */
			exp = /^[0-9a-zA-Z]{10,11}$/;
			break;
		case Type.TIPOS_IDENTIFICACION.idDocumentoMigratorio.toString():
			/* Formato del tipo de identificación Documento Migratorio */
			exp = /^[0-9a-zA-Z]{6,15}$/;
			break;
		case Type.TIPOS_IDENTIFICACION.idTarjetaAndinaMigracion.toString():
			/* Formato del tipo de identificación Tarjeta Andina de Migración */
			exp = /^[0-9a-zA-Z]{3,11}$/;
			break;
		case '':
			exp = /^[]{0}$/;
	}
	return this.optional(element) || exp.test(value);
}, "");
