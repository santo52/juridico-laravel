function utf8_encode(argString) {
  //  discuss at: http://phpjs.org/functions/utf8_encode/
  // original by: Webtoolkit.info (http://www.webtoolkit.info/)
  // improved by: Kevin van Zonneveld (http://kevin.vanzonneveld.net)
  // improved by: sowberry
  // improved by: Jack
  // improved by: Yves Sucaet
  // improved by: kirilloid
  // bugfixed by: Onno Marsman
  // bugfixed by: Onno Marsman
  // bugfixed by: Ulrich
  // bugfixed by: Rafal Kukawski
  // bugfixed by: kirilloid
  //   example 1: utf8_encode('Kevin van Zonneveld');
  //   returns 1: 'Kevin van Zonneveld'
  if (argString === null || typeof argString === 'undefined') {
    return '';
  } // .replace(/\r\n/g, "\n").replace(/\r/g, "\n");


  var string = argString + '';
  var utftext = '',
      start,
      end,
      stringl = 0;
  start = end = 0;
  stringl = string.length;

  for (var n = 0; n < stringl; n++) {
    var c1 = string.charCodeAt(n);
    var enc = null;

    if (c1 < 128) {
      end++;
    } else if (c1 > 127 && c1 < 2048) {
      enc = String.fromCharCode(c1 >> 6 | 192, c1 & 63 | 128);
    } else if ((c1 & 0xF800) != 0xD800) {
      enc = String.fromCharCode(c1 >> 12 | 224, c1 >> 6 & 63 | 128, c1 & 63 | 128);
    } else {
      // surrogate pairs
      if ((c1 & 0xFC00) != 0xD800) {
        throw new RangeError('Unmatched trail surrogate at ' + n);
      }

      var c2 = string.charCodeAt(++n);

      if ((c2 & 0xFC00) != 0xDC00) {
        throw new RangeError('Unmatched lead surrogate at ' + (n - 1));
      }

      c1 = ((c1 & 0x3FF) << 10) + (c2 & 0x3FF) + 0x10000;
      enc = String.fromCharCode(c1 >> 18 | 240, c1 >> 12 & 63 | 128, c1 >> 6 & 63 | 128, c1 & 63 | 128);
    }

    if (enc !== null) {
      if (end > start) {
        utftext += string.slice(start, end);
      }

      utftext += enc;
      start = end = n + 1;
    }
  }

  if (end > start) {
    utftext += string.slice(start, stringl);
  }

  return utftext;
}

function md5(str) {
  //  discuss at: http://phpjs.org/functions/md5/
  // original by: Webtoolkit.info (http://www.webtoolkit.info/)
  // improved by: Michael White (http://getsprink.com)
  // improved by: Jack
  // improved by: Kevin van Zonneveld (http://kevin.vanzonneveld.net)
  //    input by: Brett Zamir (http://brett-zamir.me)
  // bugfixed by: Kevin van Zonneveld (http://kevin.vanzonneveld.net)
  //  depends on: utf8_encode
  //   example 1: md5('Kevin van Zonneveld');
  //   returns 1: '6e658d4bfcb59cc13f96c14450ac40b9'
  var xl;

  var rotateLeft = function rotateLeft(lValue, iShiftBits) {
    return lValue << iShiftBits | lValue >>> 32 - iShiftBits;
  };

  var addUnsigned = function addUnsigned(lX, lY) {
    var lX4, lY4, lX8, lY8, lResult;
    lX8 = lX & 0x80000000;
    lY8 = lY & 0x80000000;
    lX4 = lX & 0x40000000;
    lY4 = lY & 0x40000000;
    lResult = (lX & 0x3FFFFFFF) + (lY & 0x3FFFFFFF);

    if (lX4 & lY4) {
      return lResult ^ 0x80000000 ^ lX8 ^ lY8;
    }

    if (lX4 | lY4) {
      if (lResult & 0x40000000) {
        return lResult ^ 0xC0000000 ^ lX8 ^ lY8;
      } else {
        return lResult ^ 0x40000000 ^ lX8 ^ lY8;
      }
    } else {
      return lResult ^ lX8 ^ lY8;
    }
  };

  var _F = function _F(x, y, z) {
    return x & y | ~x & z;
  };

  var _G = function _G(x, y, z) {
    return x & z | y & ~z;
  };

  var _H = function _H(x, y, z) {
    return x ^ y ^ z;
  };

  var _I = function _I(x, y, z) {
    return y ^ (x | ~z);
  };

  var _FF = function _FF(a, b, c, d, x, s, ac) {
    a = addUnsigned(a, addUnsigned(addUnsigned(_F(b, c, d), x), ac));
    return addUnsigned(rotateLeft(a, s), b);
  };

  var _GG = function _GG(a, b, c, d, x, s, ac) {
    a = addUnsigned(a, addUnsigned(addUnsigned(_G(b, c, d), x), ac));
    return addUnsigned(rotateLeft(a, s), b);
  };

  var _HH = function _HH(a, b, c, d, x, s, ac) {
    a = addUnsigned(a, addUnsigned(addUnsigned(_H(b, c, d), x), ac));
    return addUnsigned(rotateLeft(a, s), b);
  };

  var _II = function _II(a, b, c, d, x, s, ac) {
    a = addUnsigned(a, addUnsigned(addUnsigned(_I(b, c, d), x), ac));
    return addUnsigned(rotateLeft(a, s), b);
  };

  var convertToWordArray = function convertToWordArray(str) {
    var lWordCount;
    var lMessageLength = str.length;
    var lNumberOfWords_temp1 = lMessageLength + 8;
    var lNumberOfWords_temp2 = (lNumberOfWords_temp1 - lNumberOfWords_temp1 % 64) / 64;
    var lNumberOfWords = (lNumberOfWords_temp2 + 1) * 16;
    var lWordArray = new Array(lNumberOfWords - 1);
    var lBytePosition = 0;
    var lByteCount = 0;

    while (lByteCount < lMessageLength) {
      lWordCount = (lByteCount - lByteCount % 4) / 4;
      lBytePosition = lByteCount % 4 * 8;
      lWordArray[lWordCount] = lWordArray[lWordCount] | str.charCodeAt(lByteCount) << lBytePosition;
      lByteCount++;
    }

    lWordCount = (lByteCount - lByteCount % 4) / 4;
    lBytePosition = lByteCount % 4 * 8;
    lWordArray[lWordCount] = lWordArray[lWordCount] | 0x80 << lBytePosition;
    lWordArray[lNumberOfWords - 2] = lMessageLength << 3;
    lWordArray[lNumberOfWords - 1] = lMessageLength >>> 29;
    return lWordArray;
  };

  var wordToHex = function wordToHex(lValue) {
    var wordToHexValue = '',
        wordToHexValue_temp = '',
        lByte,
        lCount;

    for (lCount = 0; lCount <= 3; lCount++) {
      lByte = lValue >>> lCount * 8 & 255;
      wordToHexValue_temp = '0' + lByte.toString(16);
      wordToHexValue = wordToHexValue + wordToHexValue_temp.substr(wordToHexValue_temp.length - 2, 2);
    }

    return wordToHexValue;
  };

  var x = [],
      k,
      AA,
      BB,
      CC,
      DD,
      a,
      b,
      c,
      d,
      S11 = 7,
      S12 = 12,
      S13 = 17,
      S14 = 22,
      S21 = 5,
      S22 = 9,
      S23 = 14,
      S24 = 20,
      S31 = 4,
      S32 = 11,
      S33 = 16,
      S34 = 23,
      S41 = 6,
      S42 = 10,
      S43 = 15,
      S44 = 21;
  str = this.utf8_encode(str);
  x = convertToWordArray(str);
  a = 0x67452301;
  b = 0xEFCDAB89;
  c = 0x98BADCFE;
  d = 0x10325476;
  xl = x.length;

  for (k = 0; k < xl; k += 16) {
    AA = a;
    BB = b;
    CC = c;
    DD = d;
    a = _FF(a, b, c, d, x[k + 0], S11, 0xD76AA478);
    d = _FF(d, a, b, c, x[k + 1], S12, 0xE8C7B756);
    c = _FF(c, d, a, b, x[k + 2], S13, 0x242070DB);
    b = _FF(b, c, d, a, x[k + 3], S14, 0xC1BDCEEE);
    a = _FF(a, b, c, d, x[k + 4], S11, 0xF57C0FAF);
    d = _FF(d, a, b, c, x[k + 5], S12, 0x4787C62A);
    c = _FF(c, d, a, b, x[k + 6], S13, 0xA8304613);
    b = _FF(b, c, d, a, x[k + 7], S14, 0xFD469501);
    a = _FF(a, b, c, d, x[k + 8], S11, 0x698098D8);
    d = _FF(d, a, b, c, x[k + 9], S12, 0x8B44F7AF);
    c = _FF(c, d, a, b, x[k + 10], S13, 0xFFFF5BB1);
    b = _FF(b, c, d, a, x[k + 11], S14, 0x895CD7BE);
    a = _FF(a, b, c, d, x[k + 12], S11, 0x6B901122);
    d = _FF(d, a, b, c, x[k + 13], S12, 0xFD987193);
    c = _FF(c, d, a, b, x[k + 14], S13, 0xA679438E);
    b = _FF(b, c, d, a, x[k + 15], S14, 0x49B40821);
    a = _GG(a, b, c, d, x[k + 1], S21, 0xF61E2562);
    d = _GG(d, a, b, c, x[k + 6], S22, 0xC040B340);
    c = _GG(c, d, a, b, x[k + 11], S23, 0x265E5A51);
    b = _GG(b, c, d, a, x[k + 0], S24, 0xE9B6C7AA);
    a = _GG(a, b, c, d, x[k + 5], S21, 0xD62F105D);
    d = _GG(d, a, b, c, x[k + 10], S22, 0x2441453);
    c = _GG(c, d, a, b, x[k + 15], S23, 0xD8A1E681);
    b = _GG(b, c, d, a, x[k + 4], S24, 0xE7D3FBC8);
    a = _GG(a, b, c, d, x[k + 9], S21, 0x21E1CDE6);
    d = _GG(d, a, b, c, x[k + 14], S22, 0xC33707D6);
    c = _GG(c, d, a, b, x[k + 3], S23, 0xF4D50D87);
    b = _GG(b, c, d, a, x[k + 8], S24, 0x455A14ED);
    a = _GG(a, b, c, d, x[k + 13], S21, 0xA9E3E905);
    d = _GG(d, a, b, c, x[k + 2], S22, 0xFCEFA3F8);
    c = _GG(c, d, a, b, x[k + 7], S23, 0x676F02D9);
    b = _GG(b, c, d, a, x[k + 12], S24, 0x8D2A4C8A);
    a = _HH(a, b, c, d, x[k + 5], S31, 0xFFFA3942);
    d = _HH(d, a, b, c, x[k + 8], S32, 0x8771F681);
    c = _HH(c, d, a, b, x[k + 11], S33, 0x6D9D6122);
    b = _HH(b, c, d, a, x[k + 14], S34, 0xFDE5380C);
    a = _HH(a, b, c, d, x[k + 1], S31, 0xA4BEEA44);
    d = _HH(d, a, b, c, x[k + 4], S32, 0x4BDECFA9);
    c = _HH(c, d, a, b, x[k + 7], S33, 0xF6BB4B60);
    b = _HH(b, c, d, a, x[k + 10], S34, 0xBEBFBC70);
    a = _HH(a, b, c, d, x[k + 13], S31, 0x289B7EC6);
    d = _HH(d, a, b, c, x[k + 0], S32, 0xEAA127FA);
    c = _HH(c, d, a, b, x[k + 3], S33, 0xD4EF3085);
    b = _HH(b, c, d, a, x[k + 6], S34, 0x4881D05);
    a = _HH(a, b, c, d, x[k + 9], S31, 0xD9D4D039);
    d = _HH(d, a, b, c, x[k + 12], S32, 0xE6DB99E5);
    c = _HH(c, d, a, b, x[k + 15], S33, 0x1FA27CF8);
    b = _HH(b, c, d, a, x[k + 2], S34, 0xC4AC5665);
    a = _II(a, b, c, d, x[k + 0], S41, 0xF4292244);
    d = _II(d, a, b, c, x[k + 7], S42, 0x432AFF97);
    c = _II(c, d, a, b, x[k + 14], S43, 0xAB9423A7);
    b = _II(b, c, d, a, x[k + 5], S44, 0xFC93A039);
    a = _II(a, b, c, d, x[k + 12], S41, 0x655B59C3);
    d = _II(d, a, b, c, x[k + 3], S42, 0x8F0CCC92);
    c = _II(c, d, a, b, x[k + 10], S43, 0xFFEFF47D);
    b = _II(b, c, d, a, x[k + 1], S44, 0x85845DD1);
    a = _II(a, b, c, d, x[k + 8], S41, 0x6FA87E4F);
    d = _II(d, a, b, c, x[k + 15], S42, 0xFE2CE6E0);
    c = _II(c, d, a, b, x[k + 6], S43, 0xA3014314);
    b = _II(b, c, d, a, x[k + 13], S44, 0x4E0811A1);
    a = _II(a, b, c, d, x[k + 4], S41, 0xF7537E82);
    d = _II(d, a, b, c, x[k + 11], S42, 0xBD3AF235);
    c = _II(c, d, a, b, x[k + 2], S43, 0x2AD7D2BB);
    b = _II(b, c, d, a, x[k + 9], S44, 0xEB86D391);
    a = addUnsigned(a, AA);
    b = addUnsigned(b, BB);
    c = addUnsigned(c, CC);
    d = addUnsigned(d, DD);
  }

  var temp = wordToHex(a) + wordToHex(b) + wordToHex(c) + wordToHex(d);
  return temp.toLowerCase();
}

var $ = jQuery;

jQuery.fn.exists = function () {
  return this.length > 0;
};

showLoading();
jQuery(document).ready(function () {
  hideLoading();
});
jQuery.ajaxSetup({
  headers: {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
  },
  type: 'POST',
  dataType: "json",
  processData: false,
  beforeSend: function beforeSend(xhr) {
    showLoading();
  },
  error: errorLog,
  complete: function complete(xhr, status) {
    console.log(xhr.responseJSON);
    hideLoading();
  }
});

function compileLibraries() {
  $('input[type=checkbox]').bootstrapToggle({
    size: 'mini',
    height: 32,
    onstyle: 'success'
  });
  $('select').selectpicker();
  $('.table').footable();
}

jQuery(function () {
  compileLibraries();
});

function isMobile() {
  return navigator.userAgent.match(/Android/i) || navigator.userAgent.match(/webOS/i) || navigator.userAgent.match(/iPhone/i) || navigator.userAgent.match(/iPod/i) || navigator.userAgent.match(/iPad/i) || navigator.userAgent.match(/BlackBerry/) ? true : false;
}

function validarFormulario(errorMap, errorList, validElements) {
  jQuery.each(validElements, function (index, element) {
    jQuery(element).removeClass("error").popover("destroy");
  });
  jQuery.each(errorList, function (index, error) {
    jQuery(error.element).popover('destroy').addClass('error').popover({
      animation: true,
      placement: 'top',
      trigger: 'focus',
      title: '',
      content: error.message,
      container: 'body'
    });
  });
}

function adicionarCeroIzq(texto) {
  if (String(texto).length == 1) {
    return '0' + texto;
  }

  return texto;
}

function hideErrorPopover(objError) {
  if (objError) {
    if (objError.exists()) objError.popover('destroy').removeClass('error');
  } else {
    jQuery('input, select, button').each(function (index, obj) {
      jQuery(obj).popover('destroy').removeClass('error');
    });
  }
}

function showErrorPopover(objError, mensaje, posicion) {
  objError.popover({
    animation: true,
    placement: posicion,
    trigger: 'focus',
    title: '',
    content: mensaje,
    container: 'body'
  });
  if (!objError.is('button')) objError.addClass('error');
  objError.focus();
  setTimeout(function () {
    hideErrorPopover(objError);
  }, 4000);
  return false;
}

function showLoading() {
  NProgress.start();
}

function hideLoading() {
  NProgress.done();
}

function alerta(mensaje) {
  jQuery("#dvConfirmacion").html(mensaje);
  jQuery('#dvConfirmacion').dialog({
    closeOnEscape: false,
    draggable: false,
    show: {
      effect: "fade"
    },
    hide: {
      effect: "fade"
    },
    resizable: false,
    modal: true,
    buttons: {
      "Aceptar": function Aceptar() {
        jQuery(this).dialog("close");
      }
    }
  });
  jQuery('div.ui-dialog-buttonset > button').addClass('btn btn-default');
  jQuery('button.ui-dialog-titlebar-close').addClass('btn btn-success').html('X');
}

function confirmacion(mensaje, funcionalidadSI, funcionalidadNO) {
  jQuery("#dvConfirmacion").html(mensaje);
  jQuery('#dvConfirmacion').dialog({
    closeOnEscape: false,
    draggable: false,
    show: {
      effect: "fade"
    },
    hide: {
      effect: "fade"
    },
    resizable: false,
    width: 'auto',
    height: 'auto',
    modal: true,
    buttons: {
      "S\xED": function S() {
        jQuery(this).dialog("close");
        funcionalidadSI();
      },
      "No": function No() {
        if (!funcionalidadNO) jQuery(this).dialog("close");else funcionalidadNO();
      }
    }
  });
  jQuery('div.ui-dialog-buttonset > button').addClass('btn btn-default');
  jQuery('button.ui-dialog-titlebar-close').addClass('btn btn-success').html('X');
}

function modal(titulo, funcionalidad, numModal, valorWidth, valorHeigth) {
  if (!valorWidth) valorWidth = 'auto';
  if (!valorHeigth) valorHeigth = 'auto';
  funcionalidad();
  jQuery("#dvModal" + numModal).attr('title', titulo);
  jQuery('#dvModal' + numModal).dialog({
    closeOnEscape: true,
    draggable: true,
    show: {
      effect: "fade"
    },
    hide: {
      effect: "fade"
    },
    resizable: false,
    width: valorWidth,
    height: valorHeigth,
    position: {
      my: "top",
      at: "top",
      of: window
    },
    modal: true,
    close: function close(event, ui) {
      jQuery("#dvModal" + numModal).html('');
      jQuery(this).dialog('destroy');
    }
  });
  jQuery('div.ui-dialog-buttonset > button').addClass('btn btn-success');
  jQuery('button.ui-dialog-titlebar-close').addClass('btn-success').html('X');
}

function cerrarModal(numModal) {
  jQuery("#dvModal" + numModal).dialog("close");
}

function combobox(idInput, required) {
  jQuery.widget("custom.combobox", {
    _create: function _create() {
      this.wrapper = jQuery("<span>").addClass("custom-combobox").insertAfter(this.element);
      this.element.hide();

      this._createAutocomplete();

      this._createShowAllButton();
    },
    _createAutocomplete: function _createAutocomplete() {
      var selected = this.element.children(":selected"),
          select = this.element.hide();
      var selected = this.element.children(":selected"),
          value = selected.val() ? selected.text() : "";
      var disabled = select.is(':disabled');
      this.input = jQuery("<input>").appendTo(this.wrapper).val(value).addClass("custom-combobox-input form-control").attr('disabled', disabled).autocomplete({
        delay: 0,
        minLength: 0,
        source: jQuery.proxy(this, "_source")
      });
      this.input.attr('id', 'input_' + idInput);
      this.input.attr('name', 'input_' + idInput);

      if (required) {
        this.input.attr('data-rule-required', 'true');
        this.input.attr('data-msg-required', "Esta informaci\xF3n es obligatoria");
      }

      this._on(this.input, {
        autocompleteselect: function autocompleteselect(event, ui) {
          ui.item.option.selected = true;

          this._trigger("select", event, {
            item: ui.item.option
          });
        },
        autocompletechange: "_removeIfInvalid"
      });
    },
    _createShowAllButton: function _createShowAllButton() {
      var input = this.input,
          wasOpen = false;
      jQuery("#" + idInput).prev().click(function () {
        if (jQuery("#" + idInput).is(':disabled')) {
          return false;
        } else {
          jQuery("#input_" + idInput).attr("disabled", false);
          jQuery("#input_" + idInput).removeClass("disabled");
        }

        input.focus();
        /* Close if already visible */

        if (wasOpen) {
          return;
        }
        /* Pass empty string as value to search for, displaying all results */


        input.autocomplete("search", "");
      });
    },
    _source: function _source(request, response) {
      var matcher = new RegExp(jQuery.ui.autocomplete.escapeRegex(request.term), "i");
      response(this.element.children("option").map(function () {
        var text = jQuery(this).text();
        if (this.value && (!request.term || matcher.test(text))) return {
          label: text,
          value: text,
          option: this
        };
      }));
    },
    _removeIfInvalid: function _removeIfInvalid(event, ui) {
      /* Selected an item, nothing to do */
      if (ui.item) {
        return;
      }
      /* Search for a match (case-insensitive) */


      var value = this.input.val(),
          valueLowerCase = value.toLowerCase(),
          valid = false;
      this.element.children("option").each(function () {
        if (jQuery(this).text().toLowerCase() === valueLowerCase) {
          this.selected = valid = true;
          return false;
        }
      });
      /* Found a match, nothing to do */

      if (valid) {
        return;
      }
      /* Remove invalid value */


      this.input.val("").popover('destroy').addClass('error').popover({
        animation: true,
        placement: 'top',
        trigger: 'focus',
        title: '',
        content: "El dato ingresado no es v\xE1lido",
        container: 'body'
      }).popover('show');
      this.element.val("xx");

      this._delay(function () {
        this.input.popover('destroy').removeClass('error');
      }, 800);

      this.input.data("ui-autocomplete").term = "";
    },
    _destroy: function _destroy() {
      this.wrapper.remove();
      this.element.show();
    }
  });
  jQuery("#" + idInput).combobox();
}

function deshabilitarFormulario(objFormulario) {
  objFormulario.find('input, textarea, button, select').prop('disabled', 'disabled');
  objFormulario.find('a, .slider').css('display', 'none');
}

function buscarElementoAnimacion(idElemento) {
  jQuery("html:not(:animated), body:not(:animated)").animate({
    scrollTop: jQuery('#' + idElemento).offset().top
  }, 1500);
}

jQuery.fn.resetFormulario = function () {
  jQuery(this).each(function () {
    this.reset();
  });
};

function adicionarFila(idFilaOculta, position, callback, htmlFilaInsertar) {
  try {
    var newRow = document.createElement("tr");
    var cloneTr = typeof htmlFilaInsertar != 'undefined' ? htmlFilaInsertar : jQuery('#' + idFilaOculta).html();
    jQuery(newRow).html(cloneTr);

    if (typeof htmlFilaInsertar == 'undefined') {
      for (var c = 0; c < newRow.cells.length - 1; c++) {
        if (jQuery(newRow.cells[c]).is("[campo-referencia-txt]")) {
          /* Se toma el id del campo-referencia-txt de cada columna para imprimir el texto que contiene el objeto referenciado*/
          idCampoReferencia = jQuery(newRow.cells[c]).attr("campo-referencia-txt");
          valorCampoReferencia = jQuery("#" + idCampoReferencia).val();
          jQuery(newRow.cells[c]).text(valorCampoReferencia);
        }

        if (jQuery(newRow.cells[c]).is("[campo-referencia-val]")) {
          /* Se toma el atributo "campo-referencia-val" para asignar al atributo "valor" el valor que contenga el objeto referenciado*/
          idCampoValor = jQuery(newRow.cells[c]).attr("campo-referencia-val");
          /* Dependiendo del tipo de campo referenciado se accede a su valor*/

          if (jQuery('#' + idCampoValor).is('select')) valorCampo = jQuery("#" + idCampoValor + " option:selected").val();else if (jQuery("#" + idCampoValor).is('input')) valorCampo = jQuery("#" + idCampoValor).val();
          jQuery(newRow.cells[c]).attr("valor", valorCampo);
        } else {
          jQuery(newRow.cells[c]).attr("valor", valorCampoReferencia);
        }
      }
    }
    /*Construye la fila "inicio", dejando el último ingreso  como primera fila de la tabla o "final" , dejando el último ingreso como último elemento de la tabla*/


    if (position == 'inicio') jQuery('#' + idFilaOculta).after(newRow);else if (position == 'final') jQuery('#' + idFilaOculta).before(newRow);else jQuery('#' + idFilaOculta).after(newRow);
    var nuevaFilaObject = newRow;
    var nuevaFilaHTML = jQuery(newRow).html();
    var nuevaFilaArray = new Array();
    jQuery(newRow).find("td").each(function () {
      if (jQuery(this).is("[campo-referencia-val]")) {
        nuevaFilaArray[jQuery(this).attr("campo-referencia-val")] = jQuery(this).attr("valor");
      }
    });
    if (typeof callback === 'function') callback(nuevaFilaArray, nuevaFilaObject, nuevaFilaHTML);
  } catch (e) {
    console.log(e);
  }
}

function eliminarFila(objetoFila, callback) {
  jQuery(objetoFila).parent().parent().remove();
  if (typeof callback == 'function') callback();
}

function getJsonTable(idTable) {
  var jsonTable = '[';
  jQuery('#' + idTable + ' tbody tr:not(.oculto)').each(function (index, obj) {
    jsonTable += '{';
    jQuery(obj).children("[campo-referencia-val]").each(function (index, obj) {
      jsonTable += '"' + jQuery(obj).attr('campo-referencia-val') + '": "' + jQuery(obj).attr('valor') + '",';
    });
    jsonTable = jsonTable.substring(0, jsonTable.length - 1);
    jsonTable += '},';
  });
  jsonTable = jsonTable.substring(0, jsonTable.length - 1);
  jsonTable += ']';
  return jsonTable;
}

function detectarAbandonoPagina() {
  window.addEventListener("beforeunload", function (e) {
    var confirmationMessage = "\o/";
    e.returnValue = confirmationMessage;
    return confirmationMessage;
  });
}

function errorLog(xhr, status, error) {
  if (error === 'Not Found') {
    location.pathname = '/';
    location.hash = '';
    return false;
  }

  console.log({
    xhr: xhr,
    status: status,
    error: error
  });
  $.ajax({
    url: "/error/submit",
    data: new URLSearchParams({
      xhr: xhr.responseText,
      status: status,
      error: error
    }),
    success: function success(data) {
      alerta("ERROR - Ocurri\xF3 un problema con el servidor; por favor intenta de nuevo o comun\xEDcate con un agente de soporte t\xE9cnico.");
    },
    error: function error() {
      alerta("ERROR FATAL - Ocurri\xF3 un problema con el servidor; por favor intenta de nuevo o comun\xEDcate con un agente de soporte t\xE9cnico.");
    }
  });
}

function getId() {
  var split = location.hash.split('/');
  var index = split.length - 1;
  var id = split[index];

  if (isNaN(id)) {
    return 0;
  }

  return id;
}

$.fn.footableAdd = function (html) {
  $(this).find('tbody .footable-empty').remove();
  $(this).find('tbody').append(html);
  $(this).footable();
};

$.fn.asyncFootable = function (data) {
  var orderItem = $(this).find('.fooicon');
  orderItem.on('click', function (e) {
    e.preventDefault();
    e.stopPropagation();
    asyncFootableOnSort(e, function (type) {
      data && data.onSort && data.onSort(e, type);
    });
  });
};

function asyncFootableOnSort(e, callback) {
  var type = '';
  var $sorting = $(e.target);
  var sortClass = 'fooicon-sort';
  $sorting.parents('th').siblings().children().removeClass("".concat(sortClass, "-asc ").concat(sortClass, "-desc")).addClass(sortClass);

  if ($sorting.hasClass("".concat(sortClass, "-asc")) || $sorting.hasClass(sortClass)) {
    type = 'desc';
    $sorting.removeClass("".concat(sortClass, "-asc ").concat(sortClass)).addClass("".concat(sortClass, "-desc"));
  } else if ($sorting.hasClass("".concat(sortClass, "-desc"))) {
    type = 'asc';
    $sorting.removeClass("".concat(sortClass, "-desc")).addClass("".concat(sortClass, "-asc"));
  }

  callback(type);
}

function validateForm(e) {
  e.preventDefault();
  e.stopPropagation();
  var $form = $(e.target);
  $form.find('.has-error').removeClass('has-error');
  var required = validateRequired($form);

  if (required) {
    var numeric = validateNumeric($form);
    return numeric;
  }

  return required;
}

function validateNumeric($form) {
  var numericFields = $form.find('.form-control.numeric, .form-control.money').toArray();
  var completed = true;
  numericFields.map(function (item) {
    var value = $(item).val();

    if (isNaN(value)) {
      if (completed) {
        $(item).focus();
        completed = false;
      }

      $(item).parents('.form-group').eq(0).addClass('has-error');
      var message = $(item).hasClass('money') ? 'Debe ser un valor monetario válido.' : 'No es un número válido.';
      showErrorPopover($(item), message, 'top');
    }
  });
  return completed;
}

function validateRequired($form) {
  var requiredFields = $form.find('.form-control.required').toArray();
  var completed = true;
  requiredFields.map(function (item) {
    var value = $(item).val();

    if (!value.trim()) {
      if (completed) {
        $(item).focus();
        completed = false;
      }

      $(item).parents('.form-group').eq(0).addClass('has-error');
      showErrorPopover($(item), 'Esta información es obligatoria.', 'top');
    }
  });
  return completed;
}
