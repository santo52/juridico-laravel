function _toConsumableArray(arr) { return _arrayWithoutHoles(arr) || _iterableToArray(arr) || _unsupportedIterableToArray(arr) || _nonIterableSpread(); }

function _nonIterableSpread() { throw new TypeError("Invalid attempt to spread non-iterable instance.\nIn order to be iterable, non-array objects must have a [Symbol.iterator]() method."); }

function _iterableToArray(iter) { if (typeof Symbol !== "undefined" && Symbol.iterator in Object(iter)) return Array.from(iter); }

function _arrayWithoutHoles(arr) { if (Array.isArray(arr)) return _arrayLikeToArray(arr); }

function ownKeys(object, enumerableOnly) { var keys = Object.keys(object); if (Object.getOwnPropertySymbols) { var symbols = Object.getOwnPropertySymbols(object); if (enumerableOnly) symbols = symbols.filter(function (sym) { return Object.getOwnPropertyDescriptor(object, sym).enumerable; }); keys.push.apply(keys, symbols); } return keys; }

function _objectSpread(target) { for (var i = 1; i < arguments.length; i++) { var source = arguments[i] != null ? arguments[i] : {}; if (i % 2) { ownKeys(Object(source), true).forEach(function (key) { _defineProperty(target, key, source[key]); }); } else if (Object.getOwnPropertyDescriptors) { Object.defineProperties(target, Object.getOwnPropertyDescriptors(source)); } else { ownKeys(Object(source)).forEach(function (key) { Object.defineProperty(target, key, Object.getOwnPropertyDescriptor(source, key)); }); } } return target; }

function _defineProperty(obj, key, value) { if (key in obj) { Object.defineProperty(obj, key, { value: value, enumerable: true, configurable: true, writable: true }); } else { obj[key] = value; } return obj; }

function _slicedToArray(arr, i) { return _arrayWithHoles(arr) || _iterableToArrayLimit(arr, i) || _unsupportedIterableToArray(arr, i) || _nonIterableRest(); }

function _nonIterableRest() { throw new TypeError("Invalid attempt to destructure non-iterable instance.\nIn order to be iterable, non-array objects must have a [Symbol.iterator]() method."); }

function _unsupportedIterableToArray(o, minLen) { if (!o) return; if (typeof o === "string") return _arrayLikeToArray(o, minLen); var n = Object.prototype.toString.call(o).slice(8, -1); if (n === "Object" && o.constructor) n = o.constructor.name; if (n === "Map" || n === "Set") return Array.from(o); if (n === "Arguments" || /^(?:Ui|I)nt(?:8|16|32)(?:Clamped)?Array$/.test(n)) return _arrayLikeToArray(o, minLen); }

function _arrayLikeToArray(arr, len) { if (len == null || len > arr.length) len = arr.length; for (var i = 0, arr2 = new Array(len); i < len; i++) { arr2[i] = arr[i]; } return arr2; }

function _iterableToArrayLimit(arr, i) { if (typeof Symbol === "undefined" || !(Symbol.iterator in Object(arr))) return; var _arr = []; var _n = true; var _d = false; var _e = undefined; try { for (var _i = arr[Symbol.iterator](), _s; !(_n = (_s = _i.next()).done); _n = true) { _arr.push(_s.value); if (i && _arr.length === i) break; } } catch (err) { _d = true; _e = err; } finally { try { if (!_n && _i["return"] != null) _i["return"](); } finally { if (_d) throw _e; } } return _arr; }

function _arrayWithHoles(arr) { if (Array.isArray(arr)) return arr; }

var $ = jQuery;

jQuery.fn.exists = function () {
  return this.length > 0;
};

showLoading();
jQuery(document).ready(function () {
  hideLoading();
});

$.fn.currency = function () {
  var val = $(this).val();
  $(this).val(numberToMoney(val));
};

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
  $('input[type=checkbox].checkbox-toogle').bootstrapToggle({
    size: 'mini',
    height: 32,
    onstyle: 'success'
  });
  $('select').selectpicker();
  $('.table').asyncFootable();
  $('.datepicker-here').datepicker({
    language: 'es',
    autoClose: true
  }).attr('readOnly', true).css('background-color', '#fff');
  var requiredFields = $('form').find('.form-control.required').toArray();
  requiredFields.map(function (item) {
    var $label = $(item).siblings('label');
    $label.html('* ' + $label.html());
  });
}

function localStringToNumber(s) {
  var comma = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : false;

  if (comma) {
    return Number(String(s).replace(',', '.').replace(/[^0-9.-]+/g, ""));
  }

  return Number(String(s).replace(/[^0-9,-]+/g, "").replace(',', '.'));
}

var compileCurrencyInputsBlur = false;
var compileCurrencyInputsFocus = false;

function numberToMoney(value) {
  var options = {
    maximumFractionDigits: 2,
    currency: 'COP',
    style: "currency",
    currencyDisplay: "symbol"
  };
  return value || value === 0 ? localStringToNumber(value, true).toLocaleString(undefined, options) : '';
}

function moneyToNumber(value) {
  return value ? localStringToNumber(value) : '';
}

function resetCompiledInputs() {
  $('.currency-clon').each(function (_, target) {
    var name = $(target).attr('name');
    var id = $(target).attr('id');
    var val = $(target).val();
    $(target).remove();
    var $input = $("[data-name=".concat(name, "]"));
    $input.val(val).attr('name', name).removeAttr('data-name');
    $input.attr('id', id).removeAttr('data-id');
  });
}

function compileCurrencyInputs() {
  var currencyInput = $('input[type=currency]');
  currencyInput.each(function (_, target) {
    var val = $(target).val();

    if (val.indexOf('$') !== -1) {
      $(target).val(moneyToNumber(val));
    }

    onBlur({
      target: target
    }, false);
    var name = $(target).attr('name');
    var id = $(target).attr('id');

    if (name) {
      var onchange = $(target).attr('data-onchange');
      $(target).parent().append("<input type=\"hidden\" class=\"currency-clon\" name=\"".concat(name, "\" ").concat(id ? "id=\"".concat(id, "\"") : '', " />"));
      $(target).removeAttr('name').attr('data-name', name);
      $(target).removeAttr('id').attr('data-id', id);
      onchange && $(target).on('keyup', function () {
        var func = eval(onchange);
        func(this);
      });
    }
  }); // bind event listeners

  currencyInput.on('focus', onFocus);
  currencyInput.on('blur', onBlur);

  function onFocus(e) {
    if (compileCurrencyInputsFocus) {
      return false;
    }

    e.target.value = moneyToNumber(e.target.value);
    compileCurrencyInputsFocus = true;
    compileCurrencyInputsBlur = false;
  }

  function onBlur(e) {
    var validate = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : true;

    if (compileCurrencyInputsBlur && validate) {
      return false;
    }

    e.target.value = numberToMoney(e.target.value);
    var name = $(e.target).attr('data-name');
    $('input[name=' + name + ']').eq(0).val(moneyToNumber(e.target.value));

    if (validate) {
      compileCurrencyInputsFocus = false;
      compileCurrencyInputsBlur = true;
    }
  }
}

jQuery(function () {
  compileLibraries();
});

function addAutosaveClass($item) {
  var val = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : false;
  val && $item.val(val);
  $item.addClass('autosave-input');

  if ($item.is('select')) {
    $item.selectpicker();
    $item.siblings('button').addClass('autosave-input');
  }
}

$.fn.autosaveRemove = function () {
  var _location$hash$split = location.hash.split('?'),
      _location$hash$split2 = _slicedToArray(_location$hash$split, 1),
      hash = _location$hash$split2[0];

  sessionStorage.removeItem(hash);
};

$.fn.autosave = function () {
  var _this = this;

  var $elems = $(this).find('input,textarea,select');

  var _location$hash$split3 = location.hash.split('?'),
      _location$hash$split4 = _slicedToArray(_location$hash$split3, 1),
      hash = _location$hash$split4[0];

  var values = JSON.parse(sessionStorage.getItem(hash) || '{}'); // $(this).on('submit', function(e) {
  //     e.preventDefault();
  //     const [hash] = location.hash.split('?')
  //     sessionStorage.removeItem(hash)
  //     $(this).unbind('submit').submit();
  // })

  Object.keys(values).map(function (key) {
    var $item = $(_this).find('[name=' + key + ']');
    addAutosaveClass($item, values[key]);
  });
  $elems.on('change keyup', function () {
    var val = $(this).val();
    var name = $(this).attr('name');

    if (name) {
      var _values = JSON.parse(sessionStorage.getItem(hash) || '{}');

      var newValues = JSON.stringify(_objectSpread(_objectSpread({}, _values), {}, _defineProperty({}, name, val)));
      addAutosaveClass($(this));
      sessionStorage.setItem(hash, newValues);
    }
  });
};

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
      "S\xED": function Sí() {
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

  if (error === 'unknown status') {
    location.reload();
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
      if (!data.message || data.message.indexOf('CSRF') !== -1) {
        alerta("ERROR - Ocurri\xF3 un problema con el servidor; por favor intenta de nuevo o comun\xEDcate con un agente de soporte t\xE9cnico.");
      } else {
        location.reload();
      }
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
  return isNaN(id) ? 0 : id;
}

function initSummernoteVariables() {
  $.ajax({
    url: '/variables/all',
    async: false,
    success: function success(variables) {
      return window.summernoteVariableList = variables || [];
    }
  });
  return window.summernoteVariableList.reduce(function (initial, item) {
    var key = item.nombre_grupo_variable.toLowerCase().replace(' ', '_');
    var func = buildSummernoteFunction(key, item);
    return _objectSpread(_objectSpread({}, initial), {}, _defineProperty({}, key, func));
  }, {});
}

function buildSummernoteFunction(key, item) {
  return function (context) {
    var ui = $.summernote.ui;

    if (item.children && item.children.length) {
      context.memo('button.' + key, function () {
        // create button
        var list = item.children.map(function (child) {
          return "<div class=\"summernote-variables-item\" data-slug=\"".concat(child.valor_variable, "\" >").concat(child.nombre_variable, "</div>");
        }).join('');
        var button = ui.buttonGroup([ui.button({
          className: 'dropdown-toggle',
          contents: '<span class="fa fa-database"></span><span style="padding: 10px;">' + item.nombre_grupo_variable + '</span><span class="caret"></span>',
          tooltip: 'Variables ' + item.nombre_grupo_variable,
          data: {
            toggle: 'dropdown'
          }
        }), ui.dropdown({
          className: 'drop-default summernote-list',
          contents: "<div class='summernote-variables-container'>" + list + "</div>",
          callback: function callback($dropdown) {
            $dropdown.find('.summernote-variables-item').each(function () {
              $(this).click(function () {
                context.invoke('editor.saveRange');
                context.invoke('editor.restoreRange');
                context.invoke('editor.focus');
                context.invoke("insertText", ' {!!' + $(this).data("slug") + '!!} ');
              });
            });
          }
        })]); // create jQuery object from button instance.

        return button.render();
      });
    }
  };
}

$.fn.richText = function () {
  var config = arguments.length > 0 && arguments[0] !== undefined ? arguments[0] : {};
  var placeholder = $(this).attr('placeholder') || config.placeholder || '';
  var toolbar = [["style", ["style"]], ["font", ["bold", "underline", "clear"]], ["fontname", ["fontname"]], ["color", ["color"]], ["para", ["ul", "ol", "paragraph"]], ["table", ["table"]], ["insert", ["link", "picture", "video"]]];

  if (config.variables) {
    var plugins = initSummernoteVariables();
    $.extend($.summernote.plugins, plugins);
    toolbar.push(['variables', Object.keys(plugins)]);
  }

  $(this).summernote(_objectSpread(_objectSpread({}, config), {}, {
    lang: 'es-ES',
    minHeight: 200,
    tabsize: 2,
    placeholder: placeholder,
    toolbar: toolbar
  }));
};

$.fn.footableAdd = function (html) {
  $(this).find('tbody .footable-empty').remove();
  $(this).find('tbody').append(html);
  $(this).asyncFootable();
};

function submitFilterSearch(e) {
  e.preventDefault();
  e.stopPropagation();
  var jsonParams = hashQueryToJSON();
  jsonParams.page = 1;
  jsonParams.search = $(e.target).find('input[name=search]').val() || '';
  jsonParams.searchby = $(e.target).find('input[name*=searchby]:checked').toArray().map(function (item) {
    return $(item).val();
  }).join(',') || '';
  location.hash = JSONToHash(jsonParams);
}

function hashQueryToJSON() {
  var params = location.hash.split('&').reduce(function (initial, item) {
    return [].concat(_toConsumableArray(initial), _toConsumableArray(item.split('?')));
  }, []);
  params.splice(0, 1);
  return params.reduce(function (initial, item) {
    var _item$split = item.split('='),
        _item$split2 = _slicedToArray(_item$split, 2),
        key = _item$split2[0],
        value = _item$split2[1];

    return _objectSpread(_objectSpread({}, initial), {}, _defineProperty({}, key, value));
  }, {});
}

function JSONToHash(json) {
  var queryString = Object.keys(json).map(function (key) {
    return "".concat(key, "=").concat(json[key]);
  }).join('&');

  var _location$hash$split5 = location.hash.split('?'),
      _location$hash$split6 = _slicedToArray(_location$hash$split5, 1),
      url = _location$hash$split6[0];

  return url + '?' + queryString;
}

function handleClickButtonSearch(self, search) {
  if (search) {
    $(self).children().removeClass('fooicon-remove').addClass('fooicon-remove');
    $("#form-sumbit-filter-search").find('input[name=search]').val('');
  }

  $("#form-sumbit-filter-search").trigger('submit');
}

function submitTotalRegisters(self) {
  var val = $(self).val();
  var jsonParams = hashQueryToJSON();
  jsonParams.paginate = val;
  jsonParams.page = 1;
  location.hash = JSONToHash(jsonParams);
}

Number.prototype.money = function (n, x) {
  var re = '\\d(?=(\\d{' + (x || 3) + '})+' + (n > 0 ? '\\,' : '$') + ')';
  return '$ ' + this.toFixed(Math.max(0, ~~n)).replace('.', ',').replace(new RegExp(re, 'g'), '$&.');
};

String.prototype.number = function () {
  return Number(this.replace(/[$.]/g, '').replace(',', '.'));
};

function addShowTotalRegisters() {
  var _hashQueryToJSON = hashQueryToJSON(),
      _hashQueryToJSON$pagi = _hashQueryToJSON.paginate,
      paginate = _hashQueryToJSON$pagi === void 0 ? 10 : _hashQueryToJSON$pagi;

  var options = [10, 50, 100];
  var html = "\n        <span class=\"footable-pagination-select\">\n            <div class=\"form-container\">\n                <label>Registros a mostrar</label>\n                <div class=\"footable-pagination-options\">\n                    <select class=\"form-control input-sm\" onchange=\"submitTotalRegisters(this)\">\n                        ".concat(options.map(function (option) {
    return "<option ".concat(option == paginate ? 'selected' : '', " value=\"").concat(option, "\">").concat(option, "</option>");
  }).join(''), "\n                    </select>\n                </div>\n            </div>\n        </span>\n    ");
  $('.footable-pagination-wrapper').parent().append(html);
  $('.footable-pagination-options select').selectpicker();
}

function addFilterActive(self) {
  var filterContainer = $(self).data('filter-container');

  if ($(filterContainer).length) {
    var sortIDs = [];
    var items = $(self).find('[data-sort-id]');

    for (var i = 0; i < items.length; i++) {
      var item = items.eq(i);
      var field = item.data('sort-id');
      var text = item.text();

      if (field && text) {
        sortIDs.push({
          field: field,
          text: text
        });
      }
    }

    if (sortIDs.length) {
      var _hashQueryToJSON2 = hashQueryToJSON(),
          _hashQueryToJSON2$sea = _hashQueryToJSON2.search,
          search = _hashQueryToJSON2$sea === void 0 ? '' : _hashQueryToJSON2$sea,
          _hashQueryToJSON2$sea2 = _hashQueryToJSON2.searchby,
          searchby = _hashQueryToJSON2$sea2 === void 0 ? '' : _hashQueryToJSON2$sea2;

      var html = "\n            <form class=\"form-inline\" onsubmit=\"submitFilterSearch(event)\" id=\"form-sumbit-filter-search\">\n                <div class=\"form-group footable-filtering-search\">\n                    <label class=\"sr-only\">Buscar</label>\n                    <div class=\"input-group\">\n                        <input type=\"text\" name=\"search\" class=\"form-control\" placeholder=\"Buscar ...\" value=\"".concat(search, "\">\n                        <div class=\"input-group-btn\">\n                            <button type=\"button\" class=\"btn btn-primary\" onclick=\"handleClickButtonSearch(this, '").concat(search, "')\">\n                                <span class=\"fooicon fooicon-").concat(search ? 'remove' : 'search', "\"></span>\n                            </button>\n                            <button class=\"btn btn-default dropdown-toggle\" type=\"button\" id=\"dropdownMenuFromSubmitFilterSearch\" data-toggle=\"dropdown\" aria-haspopup=\"true\" aria-expanded=\"true\">\n                                <span class=\"caret\"></span>\n                            </button>\n                            <ul class=\"dropdown-menu dropdown-menu-right\" aria-labelledby=\"dropdownMenuFromSubmitFilterSearch\">\n                                ").concat(sortIDs.map(function (item) {
        return "<li><a onclick=\"event.stopPropagation()\" class=\"flex items-center\"><input type=\"checkbox\" id=\"searchby[".concat(item.field, "]\" name=\"searchby[").concat(item.field, "]\" ").concat(!searchby || searchby.indexOf(item.field) !== -1 ? 'checked="checked"' : '', " value=\"").concat(item.field, "\" ><label for=\"searchby[").concat(item.field, "]\">").concat(item.text, "</label></a></li>");
      }).join(''), "\n                            </ul>\n                        </div>\n                    </div>\n                </div>\n            </form>");
      $(filterContainer).addClass('footable-filtering-external footable-filtering-left').append(html);
    }
  }
}

$.fn.asyncFootable = function (data) {
  $(this).footable();
  addShowTotalRegisters();
  var filterActive = $(this).data('filter-active');

  if (filterActive) {
    addFilterActive(this);
  }

  var orderItem = $(this).find('.fooicon').parents('th');
  orderItem.on('click', function (e) {
    e.preventDefault();
    e.stopPropagation();
    asyncFootableOnSort(e, function (type) {
      data && data.onSort && data.onSort(e, type);
    });
  });
};

function asyncFootableOnSort(e, callback) {
  var jsonParams = hashQueryToJSON();
  jsonParams.order = $(e.target).data('sort-id') || $(e.target).parents('th').data('sort-id');
  jsonParams.page = jsonParams.page ? jsonParams.page : 1;
  jsonParams.type = jsonParams.type && jsonParams.type === 'desc' ? 'asc' : 'desc';
  location.hash = JSONToHash(jsonParams);
  callback(type);
}

jQuery.fn.fileDocument = function (data) {
  var fileDocument = {
    data: '',
    disponible: [],
    init: function init(data) {
      this.data = data;
      this.disponible = ['image/jpeg', 'image/png', 'image/jpg', 'application/pdf', 'application/vnd.ms-powerpoint', 'application/vnd.ms-excel', 'application/msword', 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document'];
    },
    getImage: function getImage(extention) {
      var docs = ['doc', 'docx'];
      var excel = ['xls', 'xlsx'];
      var pdf = ['pdf'];

      if (docs.includes(extention)) {
        return 'word.svg';
      } else if (excel.includes(extention)) {
        return 'xlsx.svg';
      } else if (pdf.includes(extention)) {
        return 'pdf.svg';
      } else {
        return 'image.svg';
      }
    },
    addFile: function addFile(self) {
      var $item = $(self);
      var filename = $item.data('filename');

      if (filename) {
        var $input = $item.find('input');

        if (!$input.length) {
          var name = $item.data('name');
          $input = $("<input accept=\"".concat(this.disponible.join(', '), "\" type=\"file\" ").concat(name ? "name=\"".concat(name, "\"") : '', " />"));
        }

        var filenameSplit = filename.split('.');
        var ext = filenameSplit[filenameSplit.length - 1];
        var image = this.getImage(ext);
        var title = $item.data('title');
        var html = "\n                    <span class=\"no-empty-message\">\n                        <span class=\"remove-file glyphicon glyphicon-remove\"></span>\n                        <div class=\"file-document-icon\">\n                            <img src=\"/images/".concat(image, "\" />\n                        </div>\n                        <div class=\"file-document-content\">\n                            <a target=\"_blank\" href=\"").concat(filename, "\" class=\"file-document-name\">").concat(title, "</a>\n                            <div class=\"progress\">\n                                <div class=\"progress-bar progress-bar-striped\" role=\"progressbar\"\n                                    aria-valuenow=\"50\" aria-valuemin=\"0\" aria-valuemax=\"100\"\n                                    style=\"width: 100%;\"></div>\n                            </div>\n                        </div>\n                    </span>");
        $item.addClass('not-empty').html($input).append(html).find('.remove-file').on('click', function () {
          return fileDocument.onRemove($item);
        });
      }
    },
    removeFile: function removeFile(self) {
      var $item = $(self);
      var filename = $item.data('filename');

      if (!filename) {
        var name = $item.data('name');
        var title = $item.data('title');
        var required = $item.data('required');
        $item.removeClass('not-empty').html("<input accept=\"".concat(this.disponible.join(', '), "\" type=\"file\" ").concat(name ? "name=\"".concat(name, "\"") : '', " />")).append("<span class=\"empty-message\">Subir ".concat(title ? title : 'el documento').concat(required ? ' <b>(requerido)</b>' : '', "</span>"));
        $item.children('input[type=file]').on('change', function () {
          return fileDocument.onChange($item);
        });
      }

      return $item;
    },
    onRemove: function onRemove(self) {
      var $parent = $(self);
      var file_id = $parent.data('id');
      var customOnRemove = $parent.data('remove');

      if (customOnRemove) {
        eval(customOnRemove);
        return false;
      }

      $parent.removeClass('not-empty').data('filename', '');
      this.removeFile($parent);

      if (this.data && this.data.url) {
        $.ajax({
          url: this.data.url + '/delete',
          data: new URLSearchParams({
            id: this.data.id,
            file_id: file_id
          })
        });
      }
    },
    onChange: function onChange(self) {
      var $parent = $(self);
      var file = $parent.find('input[type=file]')[0].files[0];

      if (!file || !this.disponible.includes(file.type)) {
        console.log(file ? file.type : null);
        return false;
      }

      $parent.addClass('not-empty');
      $parent.data('filename', file.name);
      this.addFile($parent);
      var $progress = $parent.find('.progress-bar');

      if (this.data && this.data.url) {
        var path = this.data.path;
        var formData = new FormData();
        formData.append('file', file);
        formData.append('id', this.data.id);
        formData.append('file_id', $parent.data('id'));
        $.ajax({
          url: this.data.url,
          data: formData,
          processData: false,
          contentType: false,
          beforeSend: function beforeSend() {
            $progress.addClass('active').css('width', '20%');
          },
          success: function success(data) {
            $progress.removeClass('active').css('width', '100%');
            $link = $parent.find('.file-document-content a');

            if (path) {
              $link.attr('href', path + '/' + data.path);
              $link.attr('target', '_blank');
            } else {
              $link.attr('href', 'javascript:void(0)');
              $link.removeAttr('target');
            }
          }
        });
      }
    }
  };
  fileDocument.init(data);
  var $container = $(this);
  $container.toArray().map(function (item) {
    return fileDocument.removeFile(item);
  }).map(function (item) {
    return fileDocument.addFile(item);
  });
};

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

      var tagName = $(item).prop('tagName');

      if (tagName === 'SELECT') {
        $(item).parent().parent().addClass('has-error');
      } else {
        $(item).parent().addClass('has-error');
      }

      var message = $(item).hasClass('money') ? 'Debe ser un valor monetario válido.' : 'No es un número válido.';
      showErrorPopover($(item), message, 'top');
    }
  });
  return completed;
}

function validateRequired($form) {
  var requiredFields = $form.find('select.required, input.required, textarea.required').toArray();
  var completed = true;
  requiredFields.map(function (item) {
    var value = $(item).val();

    if (!value || !value.trim()) {
      if (completed) {
        $(item).focus();
        completed = false;
      }

      var tagName = $(item).prop('tagName');

      if (tagName === 'SELECT') {
        $(item).parent().parent().addClass('has-error');
      } else {
        $(item).parent().addClass('has-error');
      }

      showErrorPopover($(item), 'Esta información es obligatoria.', 'top');
    }
  });
  return completed;
}
