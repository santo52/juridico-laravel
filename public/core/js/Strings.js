function Strings() {

	this.limpiar = function (cadena) {
		var caracteres = "!@#$^&%*()+=-[]\/{}|:<>?,.";
		for (var i = 0; i < caracteres.length; i++) {
			cadena = cadena.replace(new RegExp("\\" + caracteres[i], 'gi'), '');
		}
		cadena = cadena.toLowerCase();
		cadena = cadena.replace(/ /g, "_");
		cadena = cadena.replace(/á/gi, "a");
		cadena = cadena.replace(/é/gi, "e");
		cadena = cadena.replace(/í/gi, "i");
		cadena = cadena.replace(/ó/gi, "o");
		cadena = cadena.replace(/ú/gi, "u");
		cadena = cadena.replace(/ñ/gi, "n");
		return cadena;
	}

}

var Strings = new Strings();
