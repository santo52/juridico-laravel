function Message() {

	this._MESSAGES = {
		'LOGI_INIC_1': 'La sesión ha vencido.',

		'USUA_CREA_1': 'Esta información es obligatoria.',
		'USUA_CREA_2': 'Las contrase\u00F1as no coinciden.',
		'USUA_CREA_3': '\u00BFConfirma que desea crear este usuario?',

		'USUA_LIST_1': '\u00BFConfirma que desea eliminar el usuario x::0?',
		'USUA_LIST_2': '\u00BFConfirma que desea recuperar el usuario x::0?',
		'USUA_LIST_3': 'Sedes operativas asignadas al usuario x::0',
		'USUA_LIST_4': 'Será redireccionado a la pantalla de modificación del usuario.',
		'USUA_LIST_5': 'Modificación de contrase\u00f1a para el usuario x::0.',

		'USUA_MODI_1': '\u00BFConfirma que desea modificar el usuario?',
		'USUA_MODI_2': 'Esta información es obligatoria.',
		'USUA_MODI_3': 'Las contrase\u00F1as no coinciden.',
		'USUA_MODI_4': '\u00BFConfirma que desea modificar la contraseña de este usuario?',

		'TIPO_PROCESO_CREA_1': 'Esta información es obligatoria.',
		'TIPO_PROCESO_CREA_2': '\u00BFConfirma que desea crear el tipo de proceso?',

		'TIPO_PROCESO_LIST_1': 'Será redireccionado a la pantalla de modificación del tipo de proceso.',
		'TIPO_PROCESO_LIST_2': '\u00BFConfirma que desea eliminar el tipo de proceso x::0?',
		'TIPO_PROCESO_LIST_3': '\u00BFConfirma que desea recuperar el tipo de proceso x::0?',

		'TIPO_PROCESO_MODI_1': 'Esta información es obligatoria.',
		'TIPO_PROCESO_MODI_2': '\u00BFConfirma que desea modificar el tipo de proceso?',

		'ETAPA_PROCESO_CREA_1': 'Esta información es obligatoria.',
		'ETAPA_PROCESO_CREA_2': '\u00BFConfirma que desea crear la etapa de proceso?',
		'ETAPA_PROCESO_CREA_3': 'Debe elegir etapas diferentes.',

		'ETAPA_PROCESO_LIST_1': 'Será redireccionado a la pantalla de modificación de la etapa de proceso.',
		'ETAPA_PROCESO_LIST_2': '\u00BFConfirma que desea eliminar la etapa de proceso x::0?',
		'ETAPA_PROCESO_LIST_3': '\u00BFConfirma que desea recuperar la etapa de proceso x::0?',

		'ETAPA_PROCESO_MODI_1': 'Esta información es obligatoria.',
		'ETAPA_PROCESO_MODI_2': '\u00BFConfirma que desea modificar la etapa de proceso?',

		'PLANTILLA_DOCUMENTO_CREA_1': 'Esta información es obligatoria.',
		'PLANTILLA_DOCUMENTO_CREA_2': '\u00BFConfirma que desea crear la plantilla de documento?',

		'PLANTILLA_DOCUMENTO_LIST_1': 'Será redireccionado a la pantalla de modificación de la plantilla de documento.',
		'PLANTILLA_DOCUMENTO_LIST_2': '\u00BFConfirma que desea eliminar la plantilla de documento x::0?',
		'PLANTILLA_DOCUMENTO_LIST_3': '\u00BFConfirma que desea recuperar la plantilla de documento x::0?',

		'PLANTILLA_DOCUMENTO_MODI_1': 'Esta información es obligatoria.',
		'PLANTILLA_DOCUMENTO_MODI_2': '\u00BFConfirma que desea modificar la plantilla de documento?',

		'ENTIDAD_PENSION_CREA_1': 'Esta información es obligatoria.',
		'ENTIDAD_PENSION_CREA_2': '\u00BFConfirma que desea crear la entidad de pensión?',

		'ENTIDAD_PENSION_LIST_1': 'Será redireccionado a la pantalla de modificación de la entidad de pensión.',
		'ENTIDAD_PENSION_LIST_2': '\u00BFConfirma que desea eliminar la entidad de pensión x::0?',
		'ENTIDAD_PENSION_LIST_3': '\u00BFConfirma que desea recuperar la entidad de pensión x::0?',

		'ENTIDAD_PENSION_MODI_1': 'Esta información es obligatoria.',
		'ENTIDAD_PENSION_MODI_2': '\u00BFConfirma que desea modificar la entidad de pensión?',

		'ENTIDAD_JUSTICIA_CREA_1': 'Esta información es obligatoria.',
		'ENTIDAD_JUSTICIA_CREA_2': '\u00BFConfirma que desea crear la entidad de justicia?',

		'ENTIDAD_JUSTICIA_LIST_1': 'Será redireccionado a la pantalla de modificación de la entidad de justicia.',
		'ENTIDAD_JUSTICIA_LIST_2': '\u00BFConfirma que desea eliminar la entidad de justicia x::0?',
		'ENTIDAD_JUSTICIA_LIST_3': '\u00BFConfirma que desea recuperar la entidad de justicia x::0?',

		'ENTIDAD_JUSTICIA_MODI_1': 'Esta información es obligatoria.',
		'ENTIDAD_JUSTICIA_MODI_2': '\u00BFConfirma que desea modificar la entidad de justicia?',

		'INTERMEDIARIO_CREA_1': 'Esta información es obligatoria.',
		'INTERMEDIARIO_CREA_2': '\u00BFConfirma que desea crear el intermediario?',

		'INTERMEDIARIO_LIST_1': 'Será redireccionado a la pantalla de modificación del intermediario.',
		'INTERMEDIARIO_LIST_2': '\u00BFConfirma que desea eliminar el intermediario x::0?',
		'INTERMEDIARIO_LIST_3': '\u00BFConfirma que desea recuperar el intermediario x::0?',

		'INTERMEDIARIO_MODI_1': 'Esta información es obligatoria.',
		'INTERMEDIARIO_MODI_2': '\u00BFConfirma que desea modificar el intermediario?',

		'DOCUMENTO_CREA_1': 'Esta información es obligatoria.',
		'DOCUMENTO_CREA_2': '\u00BFConfirma que desea crear el documento?',

		'DOCUMENTO_LIST_1': 'Será redireccionado a la pantalla de modificación del documento.',
		'DOCUMENTO_LIST_2': '\u00BFConfirma que desea eliminar el documento x::0?',
		'DOCUMENTO_LIST_3': '\u00BFConfirma que desea recuperar el documento x::0?',

		'DOCUMENTO_MODI_1': 'Esta información es obligatoria.',
		'DOCUMENTO_MODI_2': '\u00BFConfirma que desea modificar el documento?',

		'ACTUACION_CREA_1': 'Esta información es obligatoria.',
		'ACTUACION_CREA_2': '\u00BFConfirma que desea crear la actuación?',
		'ACTUACION_CREA_3': 'Este documento ya se adicionó',
		'ACTUACION_CREA_4': 'Esta plantilla de documento ya se adicionó',
		'ACTUACION_CREA_5': 'Debe adicionar por lo menos un documento',
		'ACTUACION_CREA_6': 'Debe adicionar por lo menos una plantilla de documento',
		'ACTUACION_CREA_7': 'Este debe ser un número válido.',
		'ACTUACION_CREA_8': 'Este debe ser un valor monetario válido.',

		'ACTUACION_LIST_1': 'Será redireccionado a la pantalla de modificación de la actuación.',
		'ACTUACION_LIST_2': '\u00BFConfirma que desea eliminar la actuación x::0?',
		'ACTUACION_LIST_3': '\u00BFConfirma que desea recuperar la actuación x::0?',

		'ACTUACION_MODI_1': 'Esta información es obligatoria.',
		'ACTUACION_MODI_2': '\u00BFConfirma que desea modificar la actuación?',
		'ACTUACION_MODI_3': 'Este documento ya se adicionó',
		'ACTUACION_MODI_4': 'Esta plantilla de documento ya se adicionó',
		'ACTUACION_MODI_5': 'Debe adicionar por lo menos un documento',
		'ACTUACION_MODI_6': 'Debe adicionar por lo menos una plantilla de documento',

		'ACTUACION_ETAPA_PROCESO_ASOCIA_1': 'Esta información es obligatoria.',
		'ACTUACION_ETAPA_PROCESO_ASOCIA_2': '\u00BFConfirma que desea crear la asociación entre actuación y etapa de proceso?',
		'ACTUACION_ETAPA_PROCESO_ASOCIA_3': 'Esta próxima acción ya se adicionó.',
		'ACTUACION_ETAPA_PROCESO_ASOCIA_4': 'Debe adicionar por lo menos una próxima actuación.',
		'ACTUACION_ETAPA_PROCESO_ASOCIA_5': 'Debe indicar un tiempo válido (solo enteros mayores a 0).',
		'ACTUACION_ETAPA_PROCESO_ASOCIA_6': 'Está pendiente adicionar esta próxima actuación.',

		'ACTUACION_ETAPA_PROCESO_LIST_1': 'Será redireccionado a la pantalla de modificación de la asociación entre actuación y etapa de proceso.',

		'ACTUACION_ETAPA_PROCESO_MODI_1': 'Esta información es obligatoria.',
		'ACTUACION_ETAPA_PROCESO_MODI_2': '\u00BFConfirma que desea modificar la asociación entre actuación y etapa de proceso?',
		'ACTUACION_ETAPA_PROCESO_MODI_3': 'Esta próxima acción ya se adicionó.',
		'ACTUACION_ETAPA_PROCESO_MODI_4': 'Debe adicionar por lo menos una próxima actuación.',
		'ACTUACION_ETAPA_PROCESO_MODI_5': 'Debe indicar un tiempo válido (solo enteros mayores a 0).',
		'ACTUACION_ETAPA_PROCESO_MODI_6': 'Está pendiente adicionar esta próxima actuación.',

		'CLIENTE_CREA_1': 'Esta información es obligatoria.',
		'CLIENTE_CREA_2': '\u00BFConfirma que desea crear el cliente?',
		'CLIENTE_CREA_3': 'La fecha del fallecimiento no puede ser superior a la fecha actual.',

		'CLIENTE_LIST_1': 'Será redireccionado a la pantalla de modificación del cliente.',
		'CLIENTE_LIST_2': '\u00BFConfirma que desea eliminar el cliente x::0?',
		'CLIENTE_LIST_3': '\u00BFConfirma que desea recuperar el cliente x::0?',

		'CLIENTE_MODI_1': 'Esta información es obligatoria.',
		'CLIENTE_MODI_2': '\u00BFConfirma que desea modificar el cliente?',
		'CLIENTE_MODI_3': 'La fecha del fallecimiento no puede ser superior a la fecha actual.',

		'UPLOAD_FILES_1': 'Busca...',
		'UPLOAD_FILES_2': 'Abortar',
		'UPLOAD_FILES_3': 'Cancelar',
		'UPLOAD_FILES_4': 'Eliminar',
		'UPLOAD_FILES_5': '<span class="spnHereDragDrop">... o arrastra tus archivos aquí...</span>',
		'UPLOAD_FILES_6': 'Cantidad de archivos permitidos: ',
		'UPLOAD_FILES_7': 'No se permite la carga de múltiples archivos.',
		'UPLOAD_FILES_8': 'Solo se permite la carga de archivos con formato ',
		'UPLOAD_FILES_9': 'El archivo ya fue adicionado.',
		'UPLOAD_FILES_10': 'La carga no está permitida.',
		'UPLOAD_FILES_11': 'Ver documento',

		'PROCESO_CREA_1': 'Esta información es obligatoria.',
		'PROCESO_CREA_2': '\u00BFConfirma que desea crear el proceso?',
		'PROCESO_CREA_3': 'La fecha de retiro del servicio no puede ser superior a la fecha actual.',
		'PROCESO_CREA_4': 'Este debe ser un valor monetario válido.',

		'PROCESO_LIST_1': 'Será redireccionado a la pantalla de modificación del proceso.',
		'PROCESO_LIST_2': '\u00BFConfirma que desea eliminar el proceso para el cliente x::0?',
		'PROCESO_LIST_3': '\u00BFConfirma que desea recuperar el proceso para el cliente x::0?',

		'PROCESO_MODI_1': 'Esta información es obligatoria.',
		'PROCESO_MODI_2': '\u00BFConfirma que desea modificar el proceso?',
		'PROCESO_MODI_3': 'La fecha de retiro del servicio no puede ser superior a la fecha actual.',
		'PROCESO_MODI_4': 'Este debe ser un valor monetario válido.',
	};

	this.get = function (codigo, datos) {
		let mensaje = this._MESSAGES[codigo];
		if (typeof datos !== 'undefined' && mensaje.length > 0) {
			for (const p in datos) {
				mensaje = mensaje.replace('x::' + p + '', datos[p]);
			}
		}
		return mensaje;
	};

};

var Message = new Message();
