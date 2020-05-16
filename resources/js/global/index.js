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
    beforeSend: function (xhr) {
        showLoading();
    },
    error: errorLog,
    complete: function (xhr, status) {
        console.log(xhr.responseJSON)
        hideLoading();
    }
});

function compileLibraries() {
    $('input[type=checkbox]').bootstrapToggle({
        size: 'mini',
        height: 32,
        onstyle: 'success'
    })

    $('select').selectpicker();
    $('.table').footable();
    const requiredFields = $('form').find('.form-control.required').toArray()
    requiredFields.map(item => {
        const $label = $(item).siblings('label')
        $label.html('* ' + $label.html())
    })
}

jQuery(function () {
    compileLibraries()
});

function isMobile() {
    return ((navigator.userAgent.match(/Android/i)) ||
        (navigator.userAgent.match(/webOS/i)) ||
        (navigator.userAgent.match(/iPhone/i)) ||
        (navigator.userAgent.match(/iPod/i)) ||
        (navigator.userAgent.match(/iPad/i)) ||
        (navigator.userAgent.match(/BlackBerry/))) ? true : false;
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
        if (objError.exists())
            objError.popover('destroy').removeClass('error');
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
    if (!objError.is('button'))
        objError.addClass('error');
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
        show: { effect: "fade" },
        hide: { effect: "fade" },
        resizable: false,
        modal: true,
        buttons: {
            "Aceptar": function () {
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
        show: { effect: "fade" },
        hide: { effect: "fade" },
        resizable: false,
        width: 'auto',
        height: 'auto',
        modal: true,
        buttons: {
            "S\u00ED": function () {
                jQuery(this).dialog("close");
                funcionalidadSI();
            },
            "No": function () {
                if (!funcionalidadNO)
                    jQuery(this).dialog("close");
                else
                    funcionalidadNO();
            }
        }
    });
    jQuery('div.ui-dialog-buttonset > button').addClass('btn btn-default');
    jQuery('button.ui-dialog-titlebar-close').addClass('btn btn-success').html('X');
}

function modal(titulo, funcionalidad, numModal, valorWidth, valorHeigth) {
    if (!valorWidth)
        valorWidth = 'auto';
    if (!valorHeigth)
        valorHeigth = 'auto';

    funcionalidad();
    jQuery("#dvModal" + numModal).attr('title', titulo);
    jQuery('#dvModal' + numModal).dialog({
        closeOnEscape: true,
        draggable: true,
        show: { effect: "fade" },
        hide: { effect: "fade" },
        resizable: false,
        width: valorWidth,
        height: valorHeigth,
        position: { my: "top", at: "top", of: window },
        modal: true,
        close: function (event, ui) {
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
        _create: function () {
            this.wrapper = jQuery("<span>").addClass("custom-combobox").insertAfter(this.element);
            this.element.hide();
            this._createAutocomplete();
            this._createShowAllButton();
        },
        _createAutocomplete: function () {
            var selected = this.element.children(":selected"),
                select = this.element.hide();
            var selected = this.element.children(":selected"),
                value = selected.val() ? selected.text() : "";
            var disabled = select.is(':disabled');
            this.input = jQuery("<input>").appendTo(this.wrapper).val(value).addClass("custom-combobox-input form-control")
                .attr('disabled', disabled)
                .autocomplete({
                    delay: 0,
                    minLength: 0,
                    source: jQuery.proxy(this, "_source")
                });
            this.input.attr('id', 'input_' + idInput);
            this.input.attr('name', 'input_' + idInput);
            if (required) {
                this.input.attr('data-rule-required', 'true');
                this.input.attr('data-msg-required', 'Esta informaci\u00F3n es obligatoria');
            }
            this._on(this.input, {
                autocompleteselect: function (event, ui) {
                    ui.item.option.selected = true;
                    this._trigger("select", event, {
                        item: ui.item.option
                    });
                },
                autocompletechange: "_removeIfInvalid"
            });
        },
        _createShowAllButton: function () {
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
        _source: function (request, response) {
            var matcher = new RegExp(jQuery.ui.autocomplete.escapeRegex(request.term), "i");
            response(this.element.children("option").map(function () {
                var text = jQuery(this).text();
                if (this.value && (!request.term || matcher.test(text)))
                    return {
                        label: text,
                        value: text,
                        option: this
                    };
            }));
        },
        _removeIfInvalid: function (event, ui) {
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
                content: 'El dato ingresado no es v\u00E1lido',
                container: 'body'
            }).popover('show');
            this.element.val("xx");
            this._delay(function () {
                this.input.popover('destroy').removeClass('error');
            }, 800);
            this.input.data("ui-autocomplete").term = "";
        },
        _destroy: function () {
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
    jQuery("html:not(:animated), body:not(:animated)").animate({ scrollTop: jQuery('#' + idElemento).offset().top }, 1500);
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
            for (var c = 0; c < (newRow.cells.length - 1); c++) {
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
                    if (jQuery('#' + idCampoValor).is('select'))
                        valorCampo = jQuery("#" + idCampoValor + " option:selected").val();
                    else if (jQuery("#" + idCampoValor).is('input'))
                        valorCampo = jQuery("#" + idCampoValor).val();

                    jQuery(newRow.cells[c]).attr("valor", valorCampo);
                } else {
                    jQuery(newRow.cells[c]).attr("valor", valorCampoReferencia);
                }

            }
        }

        /*Construye la fila "inicio", dejando el último ingreso  como primera fila de la tabla o "final" , dejando el último ingreso como último elemento de la tabla*/
        if (position == 'inicio')
            jQuery('#' + idFilaOculta).after(newRow);
        else if (position == 'final')
            jQuery('#' + idFilaOculta).before(newRow);
        else
            jQuery('#' + idFilaOculta).after(newRow);

        var nuevaFilaObject = newRow;
        var nuevaFilaHTML = jQuery(newRow).html();
        var nuevaFilaArray = new Array();

        jQuery(newRow).find("td").each(function () {
            if (jQuery(this).is("[campo-referencia-val]")) {
                nuevaFilaArray[jQuery(this).attr("campo-referencia-val")] = jQuery(this).attr("valor");
            }
        });

        if (typeof callback === 'function')
            callback(nuevaFilaArray, nuevaFilaObject, nuevaFilaHTML);

    } catch (e) {
        console.log(e);
    }
}

function eliminarFila(objetoFila, callback) {
    jQuery(objetoFila).parent().parent().remove();
    if (typeof callback == 'function')
        callback();
}

function getJsonTable(idTable) {
    var jsonTable = '[';
    jQuery('#' + idTable + ' tbody tr:not(.oculto)').each(function (index, obj) {

        jsonTable += '{';
        jQuery(obj).children("[campo-referencia-val]").each(function (index, obj) {
            jsonTable += '"' + jQuery(obj).attr('campo-referencia-val') + '": "' + jQuery(obj).attr('valor') + '",';
        });

        jsonTable = jsonTable.substring(0, (jsonTable.length) - 1);
        jsonTable += '},';

    });

    jsonTable = jsonTable.substring(0, (jsonTable.length) - 1);
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
        location.pathname = '/'
        location.hash = ''
        return false;
    }

    console.log({ xhr: xhr, status, error })
    $.ajax({
        url: "/error/submit",
        data: new URLSearchParams({ xhr: xhr.responseText, status, error }),
        success: data => {
            alerta('ERROR - Ocurri\u00F3 un problema con el servidor; por favor intenta de nuevo o comun\u00EDcate con un agente de soporte t\u00E9cnico.');
        },
        error: () => {
            alerta('ERROR FATAL - Ocurri\u00F3 un problema con el servidor; por favor intenta de nuevo o comun\u00EDcate con un agente de soporte t\u00E9cnico.');
        }
    })
}

function getId() {
    const split = location.hash.split('/')
    const index = split.length - 1
    return split[index];
}


$.fn.footableAdd = function (html) {
    $(this).find('tbody .footable-empty').remove()
    $(this).find('tbody').append(html)
    $(this).footable();
}


$.fn.asyncFootable = function (data) {
    const orderItem = $(this).find('.fooicon')

    orderItem.on('click', function (e) {
        e.preventDefault();
        e.stopPropagation();
        asyncFootableOnSort(e, function (type) {
            data && data.onSort && data.onSort(e, type)
        });
    })
}


function asyncFootableOnSort(e, callback) {
    let type = '';
    const $sorting = $(e.target)
    const sortClass = 'fooicon-sort'

    $sorting.parents('th')
        .siblings()
        .children()
        .removeClass(`${sortClass}-asc ${sortClass}-desc`)
        .addClass(sortClass)

    if ($sorting.hasClass(`${sortClass}-asc`) || $sorting.hasClass(sortClass)) {

        type = 'desc';

        $sorting
            .removeClass(`${sortClass}-asc ${sortClass}`)
            .addClass(`${sortClass}-desc`)

    } else if ($sorting.hasClass(`${sortClass}-desc`)) {

        type = 'asc';
        $sorting
            .removeClass(`${sortClass}-desc`)
            .addClass(`${sortClass}-asc`)
    }

    callback(type);
}
