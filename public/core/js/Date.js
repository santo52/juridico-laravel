jQuery(function ($) {
	jQuery.datepicker.regional['es'] = {
		closeText: 'Cerrar',
		prevText: 'Anterior',
		nextText: 'Siguiente',
		currentText: 'Hoy',
		monthNames: ["Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre"],
		monthNamesShort: ["Ene", "Feb", "Mar", "Abr", "May", "Jun", "Jul", "Ago", "Sep", "Oct", "Nov", "Dic"],
		dayNames: ['domingo', 'lunes', 'martes', 'mi\u00E9rcoles', 'jueves', 'viernes', 's\u00E1bado'],
		dayNamesShort: ['dom', 'lun', 'mar', 'mi\u00E9', 'jue', 'vie', 's\u00E1b'],
		dayNamesMin: ['Do', 'Lu', 'Ma', 'Mi', 'Ju', 'Vi', 'S\u00E1'],
		weekHeader: 'Sem',
		/*dateFormat: 'yy-mm-dd',*/
		dateFormat: 'dd/mm/yy',
		firstDay: 1,
		showWeek: true,
		changeMonth: true,
		changeYear: true,
		showButtonPanel: true,
		showOtherMonths: true,
		selectOtherMonths: true
	};
	jQuery.datepicker.setDefaults(jQuery.datepicker.regional['es']);
	jQuery.datepicker.setDefaults({ "yearRange": "-50:+20" });
});

function inicializarDatePicker(objFecha) {
	objFecha.datepicker();
}

jQuery.validator.addMethod(
	"dateDataAMD",
	function (value, element) {
		var check = false;
		var re = /^\d{4}\-?\d{2}\-?\d{2}$/
		if (re.test(value)) {
			check = validarDateDataAMD(value);
		} else {
			check = false;
		}
		return this.optional(element) || check;
	},
	"Fecha incorrecta"
);

function validarDateDataAMD(fecha) {
	if (fecha.indexOf('-') != -1) {
		/* Con guion */
		var adata = fecha.split('-');
		var dd = parseInt(adata[2], 10);
		var mm = parseInt(adata[1], 10);
		var aaaa = parseInt(adata[0], 10);
		var xdata = new Date(aaaa, mm - 1, dd);
		if ((xdata.getFullYear() == aaaa) && (xdata.getMonth() == mm - 1) && (xdata.getDate() == dd)) {
			check = true;
		} else {
			check = false;
		}
	} else {
		/* Sin guion */
		var dd = parseInt(fecha.substr(6, 2), 10);
		var mm = parseInt(fecha.substr(4, 2), 10);
		var aaaa = parseInt(fecha.substr(0, 4), 10);
		var xdata = new Date(aaaa, mm - 1, dd);
		if ((xdata.getFullYear() == aaaa) && (xdata.getMonth() == mm - 1) && (xdata.getDate() == dd))
			check = true;
		else
			check = false;
	}
	return check;
}

jQuery.validator.addMethod(
	"patternDateDMA",
	function (value, element) {
		var check = false;
		var re = /^\d{2}\/?\d{2}\/?\d{4}$/
		if (re.test(value)) {
			check = validarDateDataDMA(value);
		} else {
			check = false;
		}
		return this.optional(element) || check;
	},
	"Fecha incorrecta"
);

function validarDateDataDMA(fecha) {
	if (fecha.indexOf('/') != -1) {
		/* Con slash */
		var adata = fecha.split('/');
		var dd = parseInt(adata[0], 10);
		var mm = parseInt(adata[1], 10);
		var aaaa = parseInt(adata[2], 10);
		var xdata = new Date(aaaa, mm - 1, dd);
		if ((xdata.getFullYear() == aaaa) && (xdata.getMonth() == mm - 1) && (xdata.getDate() == dd))
			check = true;
		else
			check = false;

	} else {
		/* Sin slash */
		var dd = parseInt(fecha.substr(0, 2), 10);
		var mm = parseInt(fecha.substr(2, 2), 10);
		var aaaa = parseInt(fecha.substr(4, 4), 10);;
		var xdata = new Date(aaaa, mm - 1, dd);
		if ((xdata.getFullYear() == aaaa) && (xdata.getMonth() == mm - 1) && (xdata.getDate() == dd))
			check = true;
		else
			check = false;
	}
	return check;
}

function quitarCaracterFecha(fecha, caracter) {
	var resultado = '';
	var ExpFecha = fecha.split(caracter);
	for (var i = 0; i < ExpFecha.length; i++) {
		resultado = resultado + ExpFecha[i];
	}
	return resultado;
}

function adicionarCaracterFecha(fecha, caracter, formato) {
	if (formato == 'AMD') {
		fecha = quitarCaracterFecha(fecha, caracter);
		var anio = fecha.substr(0, 4);
		var mes = fecha.substr(4, 2);
		var dia = fecha.substr(6, 2);
		return anio + caracter + mes + caracter + dia;

	} else if (formato == 'DMA') {
		fecha = quitarCaracterFecha(fecha, caracter);
		var dia = fecha.substr(0, 2);
		var mes = fecha.substr(2, 2);
		var anio = fecha.substr(4, 4);
		return dia + caracter + mes + caracter + anio;
	}
}

function inicializarFechaAMD(objFecha) {
	objFecha.focus(function () {
		if (jQuery.trim(objFecha.val()) != '')
			objFecha.val(quitarCaracterFecha(objFecha.val(), '-'));
	});
	objFecha.blur(function () {
		if (jQuery.trim(objFecha.val()) != '')
			objFecha.val(adicionarCaracterFecha(objFecha.val(), '-', 'AMD'));
	});
	jQuery(document).keypress(function (tecla) {
		/* Detectar la tecla ENTER */
		if (tecla.which == 13) {
			if (jQuery.trim(objFecha.val()) != '')
				objFecha.val(adicionarCaracterFecha(objFecha.val(), '-', 'AMD'));
			objFecha.blur();
		}
	});
}

function inicializarFechaDMA(objFecha) {
	objFecha.focus(function () {
		if (jQuery.trim(objFecha.val()) != '')
			objFecha.val(quitarCaracterFecha(objFecha.val(), '/'));
	});
	objFecha.blur(function () {
		if (jQuery.trim(objFecha.val()) != '')
			objFecha.val(adicionarCaracterFecha(objFecha.val(), '/', 'DMA'));
	});
	jQuery(document).keypress(function (tecla) {
		/* Detectar la tecla ENTER */
		if (tecla.which == 13) {
			if (jQuery.trim(objFecha.val()) != '')
				objFecha.val(adicionarCaracterFecha(objFecha.val(), '/', 'DMA'));
			objFecha.blur();
		}
	});
}

jQuery.validator.addMethod("patternHora", function (value, element) {
	exp = /^[0-2][0-9]:[0-5][0-9]$/;
	return this.optional(element) || exp.test(value);
}, "");

function quitarDosPuntosHora(hora) {
	var resultado = '';
	var ExpHora = hora.split(":");
	for (var i = 0; i < ExpHora.length; i++) {
		resultado = resultado + ExpHora[i];
	}
	return resultado;
}

function adicionarDosPuntosHora(hora) {
	hora = quitarDosPuntosHora(hora);
	var hour = hora.substr(0, 2);
	var minute = hora.substr(2, 2);
	return hour + ':' + minute;
}

function inicializarHora(objHora) {
	objHora.focus(function () {
		if (jQuery.trim(objHora.val()) != '')
			objHora.val(quitarDosPuntosHora(objHora.val()));
	});
	objHora.blur(function () {
		if (jQuery.trim(objHora.val()) != '')
			objHora.val(adicionarDosPuntosHora(objHora.val()));
	});
	jQuery(document).keypress(function (tecla) {
		/* Detectar la tecla ENTER */
		if (tecla.which == 13) {
			if (jQuery.trim(objHora.val()) != '')
				objHora.val(adicionarDosPuntosHora(objHora.val()));
			objHora.blur();
		}
	});
}
/**
 * Compara fechas (dd/mm/aaaa) devolviendo false cuando fechaInicial sea mayor que fechaFinal.
 */
function compararFechas(fechaInicial, fechaFinal) {
	const iniDia = parseInt(fechaInicial.substr(0, 2));
	const iniMes = parseInt(fechaInicial.substr(3, 2));
	const iniAnio = parseInt(fechaInicial.substr(6, 4));
	const finDia = parseInt(fechaFinal.substr(0, 2));
	const finMes = parseInt(fechaFinal.substr(3, 2));
	const finAnio = parseInt(fechaFinal.substr(6, 4));

	if (finAnio > iniAnio) {
		return true;
	} else if (finAnio === iniAnio) {
		if (finMes > iniMes) {
			return true;
		} else if (finMes === iniMes) {
			return finDia >= iniDia;
		} else
			return false;
	} else
		return false;
}

function validarFechaIniMayorFechaFin(objFechaInicial, objFechaFinal) {
	if (objFechaInicial.val() != '' && objFechaFinal.val() != '') {
		if (!compararFechas(objFechaInicial.val(), objFechaFinal.val())) {
			objFechaInicial.popover({
				animation: true,
				placement: 'right',
				trigger: 'focus',
				title: '',
				content: 'La fecha inicial no puede ser mayor a la fecha final',
				container: 'body'
			});
			objFechaInicial.addClass('error');
			objFechaInicial.focus();
			return false;
		}
	}
	objFechaInicial.removeClass('error');
	return true;
}

function validarFechaMenorHoy(objHoy, objFechaInicial) {
	if (objFechaInicial.val() != '' && objHoy.val() != '') {
		if (!compararFechas(objHoy.val(), objFechaInicial.val())) {
			objFechaInicial.popover({
				animation: true,
				placement: 'right',
				trigger: 'focus',
				title: '',
				content: 'La fecha establecida no puede ser menor a la fecha actual',
				container: 'body'
			});
			objFechaInicial.addClass('error');
			objFechaInicial.focus();
			return false;
		}
	}
	objFechaInicial.removeClass('error');
	return true;
}

/**
 * Valida si la fecha establecida (dd/mm/aaaa) es MAYOR a hoy (dd/mm/aaaa).
 */
function validarFechaMayorHoy(objFecha, objHoy) {
	if (objFecha.val() != '' && objHoy.val() != '')
		if (!compararFechas(objFecha.val(), objHoy.val()))
			return true;
	return false;
}

function compararHoras(fechaInicial, horaInicial, fechaFinal, horaFinal) {
	var iniDia = parseInt(fechaInicial.substr(0, 2));
	var iniMes = parseInt(fechaInicial.substr(3, 2));
	var iniAnio = parseInt(fechaInicial.substr(6, 4));
	var iniHora = parseInt(horaInicial.substr(0, 2));
	var iniMinuto = parseInt(horaInicial.substr(3, 2));
	var finDia = parseInt(fechaFinal.substr(0, 2));
	var finMes = parseInt(fechaFinal.substr(3, 2));
	var finAnio = parseInt(fechaFinal.substr(6, 4));
	var finHora = parseInt(horaFinal.substr(0, 2));
	var finMinuto = parseInt(horaFinal.substr(3, 2));

	if (finAnio == iniAnio && finMes == iniMes && finDia == iniDia) {
		if (finHora > iniHora) {
			return true;
		} else if (iniHora == finHora) {
			if (finMinuto > iniMinuto)
				return true;
			else
				return false;
		} else
			return false;
	} else
		return true;
}

function validarHoras(objFechaInicial, objHoraInicial, objFechaFinal, objHoraFinal, mensajeOpc) {
	if (objHoraInicial.val() != '' && objHoraFinal.val() != '') {
		if (mensajeOpc)
			mensaje = mensajeOpc;
		else
			mensaje = 'La hora inicial no puede ser mayor o igual a la hora final en un mismo d\u00EDa';

		if (!compararHoras(objFechaInicial.val(), objHoraInicial.val(), objFechaFinal.val(), objHoraFinal.val())) {
			objHoraInicial.popover({
				animation: true,
				placement: 'top',
				trigger: 'focus',
				title: '',
				content: mensaje,
				container: 'body'
			});
			objHoraInicial.addClass('error');
			objHoraInicial.focus();
			return false;
		}
	}
	objHoraInicial.removeClass('error');
	return true;
}

function validarHoraActual(objFecha, objHora, objFechaHoy, objHoraHoy, mensajeOpc) {
	if (objHora.val() != '' && objHoraHoy.val() != '') {
		if (mensajeOpc)
			mensaje = mensajeOpc;
		else
			mensaje = 'La hora establecida no puede ser menor a la hora actual para el d\u00eda de hoy';

		if (!compararHoras(objFechaHoy.val(), objHoraHoy.val(), objFecha.val(), objHora.val())) {
			objHora.popover({
				animation: true,
				placement: 'right',
				trigger: 'focus',
				title: '',
				content: mensaje,
				container: 'body'
			});
			objHora.addClass('error');
			objHora.focus();
			return false;
		}
	}
	objHora.removeClass('error');
	return true;
}

function getMmSs(segundos) {
	var d = new Date(segundos * 1000);
	var mm = (d.getMinutes() < 10) ? '0' + d.getMinutes() : d.getMinutes();
	var ss = (d.getSeconds() < 10) ? '0' + d.getSeconds() : d.getSeconds();
	return mm + ':' + ss;
}

function getDiferenciaDias(fechaInicial, fechaFinal) {
	var arraFI = fechaInicial.split('/');
	var arraFF = fechaFinal.split('/');
	var fI = new Date(arraFI[2] + '-' + arraFI[1] + '-' + arraFI[0]).getTime();
	var fF = new Date(arraFF[2] + '-' + arraFF[1] + '-' + arraFF[0]).getTime();
	return (fF - fI) / (1000 * 60 * 60 * 24);
}
