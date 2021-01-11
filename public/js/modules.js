function _createForOfIteratorHelper(o, allowArrayLike) { var it; if (typeof Symbol === "undefined" || o[Symbol.iterator] == null) { if (Array.isArray(o) || (it = _unsupportedIterableToArray(o)) || allowArrayLike && o && typeof o.length === "number") { if (it) o = it; var i = 0; var F = function F() {}; return { s: F, n: function n() { if (i >= o.length) return { done: true }; return { done: false, value: o[i++] }; }, e: function e(_e) { throw _e; }, f: F }; } throw new TypeError("Invalid attempt to iterate non-iterable instance.\nIn order to be iterable, non-array objects must have a [Symbol.iterator]() method."); } var normalCompletion = true, didErr = false, err; return { s: function s() { it = o[Symbol.iterator](); }, n: function n() { var step = it.next(); normalCompletion = step.done; return step; }, e: function e(_e2) { didErr = true; err = _e2; }, f: function f() { try { if (!normalCompletion && it["return"] != null) it["return"](); } finally { if (didErr) throw err; } } }; }

function _unsupportedIterableToArray(o, minLen) { if (!o) return; if (typeof o === "string") return _arrayLikeToArray(o, minLen); var n = Object.prototype.toString.call(o).slice(8, -1); if (n === "Object" && o.constructor) n = o.constructor.name; if (n === "Map" || n === "Set") return Array.from(o); if (n === "Arguments" || /^(?:Ui|I)nt(?:8|16|32)(?:Clamped)?Array$/.test(n)) return _arrayLikeToArray(o, minLen); }

function _arrayLikeToArray(arr, len) { if (len == null || len > arr.length) len = arr.length; for (var i = 0, arr2 = new Array(len); i < len; i++) { arr2[i] = arr[i]; } return arr2; }

function _classCallCheck(instance, Constructor) { if (!(instance instanceof Constructor)) { throw new TypeError("Cannot call a class as a function"); } }

function _defineProperties(target, props) { for (var i = 0; i < props.length; i++) { var descriptor = props[i]; descriptor.enumerable = descriptor.enumerable || false; descriptor.configurable = true; if ("value" in descriptor) descriptor.writable = true; Object.defineProperty(target, descriptor.key, descriptor); } }

function _createClass(Constructor, protoProps, staticProps) { if (protoProps) _defineProperties(Constructor.prototype, protoProps); if (staticProps) _defineProperties(Constructor, staticProps); return Constructor; }

var Actuacion = /*#__PURE__*/function () {
  function Actuacion() {
    _classCallCheck(this, Actuacion);
  }

  _createClass(Actuacion, [{
    key: "pdf",
    value: function pdf() {
      window.open('/actuacion/pdf');
    }
  }, {
    key: "excel",
    value: function excel() {
      window.open('/actuacion/excel');
    }
  }, {
    key: "update",
    value: function update(e) {
      e.preventDefault();
      e.stopPropagation();
      this.save(e, '/actuacion/update/' + getId());
      return false;
    }
  }, {
    key: "create",
    value: function create(e) {
      e.preventDefault();
      e.stopPropagation();
      this.save(e, '/actuacion/insert');
      return false;
    }
  }, {
    key: "delete",
    value: function _delete() {
      var id = $('#deleteValue').val();
      $.ajax({
        url: '/actuacion/delete/' + id,
        data: {},
        success: function success(data) {
          if (data.deleted) {
            $('#actRow' + id).remove();
            $('#deleteModal').modal('hide');
          }
        }
      });
      return false;
    }
  }, {
    key: "openDelete",
    value: function openDelete(id) {
      $('#deleteModal').modal();
      $('#deleteValue').val(id);
      return false;
    }
  }, {
    key: "save",
    value: function save(e, url) {
      e.preventDefault();
      e.stopPropagation();

      if (validateForm(e)) {
        var formData = new FormData(e.target);
        var documents = [];
        var templates = [];
        $('#tblDocumentos tbody tr').toArray().map(function (item) {
          var value = $(item).data('value');
          value && documents.push(value);
        });
        $('#tblPlantillasDocumento tbody tr').toArray().map(function (item) {
          var value = $(item).data('value');
          value && templates.push(value);
        });
        formData.append('documents', documents);
        formData.append('templates', templates);
        $.ajax({
          url: url,
          data: new URLSearchParams(formData),
          success: function success(data) {
            if (data.exists) {
              showErrorPopover($('#nombreActuacion'), 'Ya existe una actuación con este nombre', 'top');
            } else if (data.saved) {
              alert('Se ha guardado satisfactoriamente!');
              $('.validate').removeClass('open');
              window.history.back();
            }
          }
        });
      }

      return false;
    }
  }, {
    key: "removeDocument",
    value: function removeDocument(self) {
      $(self).parents('tr').eq(0).remove();
    }
  }, {
    key: "addDocumentTemplate",
    value: function addDocumentTemplate(self) {
      var _this$getDocumentValu = this.getDocumentValues(self),
          name = _this$getDocumentValu.name,
          value = _this$getDocumentValu.value;

      if (!$("#tmpDocumentRow".concat(value)).length) {
        var html = "\n            <tr id=\"tmpDocumentRow".concat(value, "\" data-value=\"").concat(value, "\">\n                <td class=\"plantillas-documento\">").concat(name, "</td>\n                <td class=\"center\">\n                    <button class=\"btn btn-danger btn-xs\" type=\"button\" onclick=\"actuacion.removeDocument(this);\">\n                        <span class=\"glyphicon glyphicon-minus\"></span>\n                    </button>\n                </td>\n            </tr>\n        ");
        $('#tblPlantillasDocumento').footableAdd(html);
      }
    }
  }, {
    key: "getDocumentValues",
    value: function getDocumentValues(self) {
      var $document = $(self);
      var name = $document.children('option:selected').text().trim();
      var value = $document.val();
      $document.val('');
      return {
        name: name,
        value: value
      };
    }
  }, {
    key: "addDocument",
    value: function addDocument(self) {
      var _this$getDocumentValu2 = this.getDocumentValues(self),
          name = _this$getDocumentValu2.name,
          value = _this$getDocumentValu2.value;

      if (!$("#documentsRow".concat(value)).length) {
        var html = "\n        <tr id=\"documentsRow".concat(value, "\" data-value=\"").concat(value, "\">\n            <td class=\"documentos\">").concat(name, "</td>\n            <td class=\"center\">\n                <button class=\"btn btn-danger btn-xs\" type=\"button\" onclick=\"actuacion.removeDocument(this);\">\n                    <span class=\"glyphicon glyphicon-minus\"></span>\n                </button>\n            </td>\n        </tr>");
        $('#tblDocumentos').footableAdd(html);
      }
    }
  }]);

  return Actuacion;
}();

var actuacion = new Actuacion();

var ChangePassword = /*#__PURE__*/function () {
  function ChangePassword() {
    _classCallCheck(this, ChangePassword);
  }

  _createClass(ChangePassword, [{
    key: "upsert",
    value: function upsert(e) {
      e.preventDefault();
      e.stopPropagation();

      if (validateForm(e)) {
        var formData = new FormData(e.target);
        $.ajax({
          url: '/cambiar-contrasena/upsert',
          data: new URLSearchParams(formData),
          success: function success(data) {
            if (data.invalid) {
              $('#old-password').parent().addClass('has-error');
              var text = 'La contraseña anterior es invalida';
              showErrorPopover($('#old-password'), text, 'top');
            } else if (data.notconfirmed) {
              $('#confirm-password').parent().addClass('has-error');
              var _text = 'La nueva contraseña y la confirmación no coinciden';
              showErrorPopover($('#confirm-password'), _text, 'top');
            } else if (data.saved) {
              alert('Se ha actualizado la contraseña!');
              location = '/';
            }
          }
        });
      }

      return false;
    }
  }]);

  return ChangePassword;
}();

var changePassword = new ChangePassword();

var Cliente = /*#__PURE__*/function () {
  function Cliente() {
    _classCallCheck(this, Cliente);
  }

  _createClass(Cliente, [{
    key: "changePaisContacto",
    value: function changePaisContacto(self) {
      var pais = $(self).val();
      return $.ajax({
        url: '/cliente/departamentos/' + pais,
        success: function success(data) {
          var html = data.map(function (item) {
            return "<option value=\"".concat(item.id_departamento, "\">").concat(item.nombre_departamento, "</option>");
          });
          $('#id_departamento_contacto').html(html).selectpicker('refresh');
          $('#id_municipio_contacto').html('').val('').selectpicker('refresh');
        }
      });
    }
  }, {
    key: "changeDepartamentoContacto",
    value: function changeDepartamentoContacto(self) {
      var departamento = $(self).val();
      $.ajax({
        url: '/cliente/municipios/' + departamento,
        success: function success(data) {
          $('#id_municipio_contacto').val('');
          var html = data.map(function (item) {
            return "<option value=\"".concat(item.id_municipio, "\">").concat(item.nombre_municipio, "</option>");
          });
          $('#id_municipio_contacto').html(html).selectpicker('refresh');
        }
      });
    }
  }, {
    key: "changeMunicipioContacto",
    value: function changeMunicipioContacto(self) {
      var municipio = $(self).val();
      $.ajax({
        url: '/cliente/municipio/' + municipio,
        success: function success(data) {
          if (data.indicativo) {
            $('#indicativo_contacto').show().text('+' + data.indicativo);
          } else {
            $('#indicativo_contacto').hide();
          }
        }
      });
    }
  }, {
    key: "changePais",
    value: function changePais(self) {
      var pais = $(self).val();
      return $.ajax({
        url: '/cliente/departamentos/' + pais,
        success: function success(data) {
          var html = data.map(function (item) {
            return "<option value=\"".concat(item.id_departamento, "\">").concat(item.nombre_departamento, "</option>");
          });
          $('#id_departamento').html(html).selectpicker('refresh');
          $('#id_municipio').html('').val('').selectpicker('refresh');
        }
      });
    }
  }, {
    key: "changeDepartamento",
    value: function changeDepartamento(self) {
      var departamento = $(self).val();
      $.ajax({
        url: '/cliente/municipios/' + departamento,
        success: function success(data) {
          $('#id_municipio').val('');
          var html = data.map(function (item) {
            return "<option value=\"".concat(item.id_municipio, "\">").concat(item.nombre_municipio, "</option>");
          });
          $('#id_municipio').html(html).selectpicker('refresh');
        }
      });
    }
  }, {
    key: "changeMunicipio",
    value: function changeMunicipio(self) {
      var municipio = $(self).val();
      $.ajax({
        url: '/cliente/municipio/' + municipio,
        success: function success(data) {
          if (data.indicativo) {
            $('#indicativo_cliente').show().text('+' + data.indicativo);
          } else {
            $('#indicativo_cliente').hide();
          }
        }
      });
    }
  }, {
    key: "onChangeIntermediario",
    value: function onChangeIntermediario(self) {
      var intermediario = $(self).val();
      $('#documento_intermediario').val('');
      $('#indicativo_intermediario').text('');
      $('#telefono_intermediario').val('');
      $('#email_intermediario').val('');
      $.ajax({
        url: '/intermediario/get/' + intermediario,
        success: function success(_ref) {
          var intermediario = _ref.intermediario;

          if (intermediario) {
            $('#documento_intermediario').val(intermediario.numero_documento);
            $('#indicativo_intermediario').text('+' + intermediario.indicativo);
            $('#telefono_intermediario').val(intermediario.telefono);
            $('#email_intermediario').val(intermediario.correo_electronico);
          }
        }
      });
    }
  }, {
    key: "changeBeneficiario",
    value: function changeBeneficiario(self) {
      var val = $(self).val();
      var fields = ['numero_documento_beneficiario', 'nombre_beneficiario', 'parentesco_beneficiario', 'telefono_beneficiario', 'celular_beneficiario', 'celular2_beneficiario', 'correo_electronico_beneficiario'];
      fields.map(function (field) {
        var $item = $('#' + field);

        if (val == 0) {
          $item.val('').prop('readonly', true);
        } else {
          $item.prop('readonly', false);
        }
      });
    }
  }, {
    key: "createEditModal",
    value: function createEditModal(id) {
      var title = id ? 'Editar cliente' : 'Crear cliente';
      $('#createModal').modal();
      $('#createValue').val(id);
      $('#createTitle').text(title);
      $('#tipoDocumento').val(1).selectpicker('refresh');
      $('#municipio').val(1).selectpicker('refresh');
      $('#numeroDocumento').val('');
      $('#primerApellido').val('');
      $('#segundoApellido').val('');
      $('#primerNombre').val('');
      $('#segundoNombre').val('');
      $('#telefono').val('');
      $('#correoElectronico').val('');
      $('#etapaEstado').prop('checked', true).change();
      $('#retencion').val(0);
      $('#indicativo').show().text('+1');

      if (id) {
        $.ajax({
          url: '/cliente/get/' + id,
          success: function success(_ref2) {
            var cliente = _ref2.cliente;
            $('#tipoDocumento').val(cliente.id_tipo_documento).selectpicker('refresh');
            $('#numeroDocumento').val(cliente.numero_documento);
            $('#primerApellido').val(cliente.primer_apellido);
            $('#segundoApellido').val(cliente.segundo_apellido);
            $('#primerNombre').val(cliente.primer_nombre);
            $('#segundoNombre').val(cliente.segundo_nombre);
            $('#telefono').val(cliente.telefono);
            $('#retencion').val(cliente.retencion);
            $('#municipio').val(cliente.id_municipio).selectpicker('refresh');
            $('#correoElectronico').val(cliente.correo_electronico);
            $('#etapaEstado').prop('checked', cliente.estado_cliente == 1).change();

            if (cliente.indicativo) {
              $('#indicativo').text('+' + cliente.indicativo);
            } else {
              $('#indicativo').hide();
            }
          }
        });
      }
    }
  }, {
    key: "upsert",
    value: function upsert(e) {
      e.preventDefault();
      e.stopPropagation();

      if (validateForm(e)) {
        var formData = new FormData(e.target);
        $.ajax({
          url: '/cliente/upsert',
          data: new URLSearchParams(formData),
          success: function success(data) {
            if (data.clientExists) {
              $('#numero_documento').parent().addClass('has-error');
              var text = 'Ya existe un cliente con este número de documento';
              showErrorPopover($('#numero_documento'), text, 'top');
            } else if (data.saved) {
              alert('Se ha guardado satisfactoriamente!');
              $('.autosave').autosaveRemove();
              $('.validate').removeClass('open');
              location.hash = 'cliente/listar';
            }
          }
        });
      }

      return false;
    }
  }, {
    key: "openDelete",
    value: function openDelete(id) {
      $('#deleteModal').modal();
      $('#deleteValue').val(id);
    }
  }, {
    key: "delete",
    value: function _delete() {
      var id = $('#deleteValue').val();
      $.ajax({
        url: '/cliente/delete/' + id,
        data: {},
        success: function success() {
          location.reload();
        }
      });
    }
  }, {
    key: "pdf",
    value: function pdf() {
      window.open('/cliente/pdf');
    }
  }, {
    key: "excel",
    value: function excel() {
      window.open('/cliente/excel');
    }
  }]);

  return Cliente;
}();

var cliente = new Cliente();

var Cobro = /*#__PURE__*/function () {
  function Cobro() {
    _classCallCheck(this, Cobro);
  }

  _createClass(Cobro, [{
    key: "pdf",
    value: function pdf() {
      window.open('/etapas-de-proceso/pdf');
    }
  }, {
    key: "excel",
    value: function excel() {
      window.open('/etapas-de-proceso/excel');
    }
  }, {
    key: "changeFormaPago",
    value: function changeFormaPago(value) {
      if (value == 1) {
        $('#informacion_pago_financiero').hide();
        $('#id_entidad_financiera').removeClass('required').val('');
        $('#referencia').removeClass('required').val('');
      } else {
        $('#informacion_pago_financiero').show();
        $('#id_entidad_financiera').addClass('required');
        $('#referencia').addClass('required');
      }
    }
  }, {
    key: "formasPago",
    value: function formasPago(id) {
      switch (id) {
        case 1:
          return 'Efectivo';

        case 2:
          return 'Consignación';

        case 3:
          return 'Cheque';

        default:
          return 'Desconocido';
      }
    }
  }, {
    key: "formatDate",
    value: function formatDate(date) {
      var newDate = new Date(date);
      return newDate.getDate() + '/' + (newDate.getMonth() + 1) + '/' + newDate.getFullYear();
    }
  }, {
    key: "deletePagoModal",
    value: function deletePagoModal(id) {
      $('#deletePagoValue').val(id);
      $('#pagosModal').modal('hide');
      setTimeout(function () {
        $('#deletePagoModal').modal('show');
      }, 500);
    }
  }, {
    key: "deletePagoCancelar",
    value: function deletePagoCancelar() {
      $('#deletePagoValue').val('');
      $('#deletePagoModal').modal('hide');
      setTimeout(function () {
        $('#pagosModal').modal('show');
      }, 500);
    }
  }, {
    key: "deletePagoAceptar",
    value: function deletePagoAceptar() {
      var id = $('#deletePagoValue').val();
      $('#item-pago-' + id).remove();
      this.deletePagoCancelar();
    }
  }, {
    key: "pagoModalOpen",
    value: function pagoModalOpen(id) {
      var _this = this;

      $('#pagosModal').modal('show');
      $('#lista-pagos tbody').html('');
      $('#lista-pagos').footable('refresh');

      if (id) {
        $.ajax({
          url: '/honorarios/pagos/get/' + id,
          success: function success(data) {
            if (data) {
              var html = data.map(function (item) {
                return "<tr id=\"item-pago-".concat(item.id_pago, "\">\n                            <td>").concat(_this.formatDate(item.fecha_pago), "</td>\n                            <td>").concat(_this.formasPago(item.forma_pago), "</td>\n                            <td>").concat(item.referencia || 'Sin referencia', "</td>\n                            <td>").concat(item.valor_pago, "</td>\n                            <td>\n                                <div class=\"flex justify-center table-actions\">\n                                    <a href=\"javascript:void(0)\" title=\"Editar pago\"\n                                        onclick=\"cobro.registrarPagoModalOpen('").concat(item.id_cobro, "', '").concat(item.id_pago, "')\" class=\"btn text-primary\" type=\"button\">\n                                        <span class=\"glyphicon glyphicon-edit\"></span>\n                                    </a>\n                                    <a href=\"javascript:void(0)\" title=\"Eliminar pago\"\n                                        onclick=\"cobro.deletePagoModal('").concat(item.id_pago, "')\" class=\"btn text-danger\" type=\"button\">\n                                        <span class=\"glyphicon glyphicon-trash\"></span>\n                                    </a>\n                                </div>\n\n                            </td>\n                        </tr>");
              });
              $('#lista-pagos tbody').html(html);
            }

            $('#lista-pagos').footable('refresh');
          }
        });
      }
    }
  }, {
    key: "registrarPagoModalOpen",
    value: function registrarPagoModalOpen(id) {
      var _this2 = this;

      var idpago = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : 0;
      $('#editarPagoModal').addClass('open').modal('show');
      this.changeFormaPago(1);
      $('#id_entidad_financiera').val(0).selectpicker('refresh');
      $('#id_cobro_pago').val(id);
      $('#id_pago_pago').val(idpago);

      if (id) {
        $.ajax({
          url: '/honorarios/pago/get/' + idpago,
          success: function success(data) {
            if (data) {
              $('#fecha_pago').val(data.fecha_pago);
              $('#forma_pago').val(data.forma_pago).selectpicker('refresh');
              $('#id_entidad_financiera').val(data.id_entidad_financiera).selectpicker('refresh');
              $('#referencia').val(data.referencia);

              _this2.changeFormaPago(data.forma_pago);

              $('#valor_pago').val(data.valor_pago);
            }
          }
        });
      }
    }
  }, {
    key: "pagoModalClose",
    value: function pagoModalClose() {
      $('#editarPagoModal').removeClass('open').modal('hide');
    }
  }, {
    key: "cobroModalClose",
    value: function cobroModalClose() {
      $('#cobrosModal').removeClass('open').modal('hide');
    }
  }, {
    key: "cobroModalOpen",
    value: function cobroModalOpen(id) {
      $('#cobrosModal').addClass('open').modal('show');
      $('#fecha_cobro').val('');
      $('#accion_cobro').val('');
      $('#etapa_cobro').val('');
      $('#concepto_cobro').val('');
      $('#valor_cobro').val(0);
      $('#valor_pagado').val(0);
      $('#valor_por_pagar').val(0);

      if (id) {
        $.ajax({
          url: '/cobros-y-pagos/cobro/get/' + id,
          success: function success(data) {
            if (data) {
              var procesoActuacion = data.proceso_etapa_actuacion;

              if (procesoActuacion) {
                if (procesoActuacion.actuacion) {
                  var _actuacion = procesoActuacion.actuacion;
                  $('#accion_cobro').val(_actuacion.nombre_actuacion);
                }

                if (procesoActuacion.proceso_etapa) {
                  var procesoEtapa = procesoActuacion.proceso_etapa;

                  if (procesoEtapa.etapa_proceso) {
                    var _etapaProceso = procesoEtapa.etapa_proceso;
                    $('#etapa_cobro').val(_etapaProceso.nombre_etapa_proceso);
                  }
                }
              }

              $('#id_cobro').val(data.id_cobro);
              $('#fecha_cobro').val(data.fecha_cobro);
              $('#valor_cobro').val(data.valor);
              $('#concepto_cobro').val(data.concepto);
              $('#valor_pagado').val(parseFloat(data.valor_cobro || 0));
              $('#valor_por_pagar').val(data.valor - parseFloat(data.valor_cobro || 0));
            }
          }
        });
      }
    }
  }, {
    key: "upsert",
    value: function upsert(e) {
      e.preventDefault();
      e.stopPropagation();

      if (validateForm(e)) {
        var id = $('#id_cobro').val();
        var formData = new FormData(e.target);
        id && formData.append('id_pago', id);
        $.ajax({
          url: '/cobros-y-pagos/upsert',
          data: new URLSearchParams(formData),
          success: function success(data) {
            if (data.saved) {
              $('#cobrosModal').removeClass('open').modal('hide');
              location.reload();
            }
          }
        });
      }

      return false;
    }
  }, {
    key: "upsertPago",
    value: function upsertPago(e) {
      e.preventDefault();
      e.stopPropagation();

      if (validateForm(e)) {
        var id = $('#id_cobro_pago').val();
        var idpago = $('#id_pago_pago').val();
        var formData = new FormData(e.target);
        id && formData.append('id_cobro', id);
        idpago && formData.append('id_pago', idpago);
        $.ajax({
          url: '/cobros-y-pagos/pago/upsert',
          data: new URLSearchParams(formData),
          success: function success(data) {
            if (data.saved) {
              $('#editarPagoModal').removeClass('open').modal('hide');
              location.reload();
            }
          }
        });
      }

      return false;
    } // popoverClose() {
    //     $('#tipoProcesoEtapaPopover').popover('hide')
    // }
    // createEtapa() {
    //     const nombre_etapa_proceso = $('#etapaProcesoNombre').val().trim()
    //     if(nombre_etapa_proceso) {
    //         const data = {
    //             nombre_etapa_proceso,
    //             estado: 1
    //         }
    //         $.ajax({
    //             url: '/etapas-de-proceso/upsert',
    //             data: new URLSearchParams(data),
    //             success: data => {
    //                 const id = $('#createValue').val() || 0
    //                 this.renderModalData(id)
    //                 $('#tipoProcesoEtapaPopover').popover('hide')
    //             }
    //         })
    //     }
    // }
    // sortableStart(_, ui ) {
    //     $(ui.item).find('.footable-last-visible a').hide()
    // }
    // sortableStop(_, ui ) {
    //     $(ui.item).find('.footable-last-visible a').show()
    // }
    // sortableUpdate(event, _ ) {
    //     const $rowList = $(event.target).children('tr') || []
    //     const orderedList = []
    //     for(item of $rowList) {
    //         orderedList.push($(item).data('id'))
    //     }
    //     const params = {
    //         orderedList,
    //         id_tipo_proceso: $('#createValue').val() || 0
    //     }
    //     $.ajax({
    //         url: '/tipos-de-proceso/etapa/update',
    //         data: new URLSearchParams(params),
    //         success: data => {
    //             console.log(data)
    //         }
    //     })
    // }
    // renderModalData(id = 0) {
    //     return $.ajax({
    //         url: '/tipos-de-proceso/get/' + id,
    //         success: data => {
    //             const htmlListaEtapas = data.etapas.map(etapa => `<option value="${etapa.id_etapa_proceso}">${etapa.nombre_etapa_proceso}</option>`)
    //             $('#listaEtapa').html(htmlListaEtapas.join('')).selectpicker('refresh');
    //             //addRow
    //             const htmlSelectedEtapas = data.selectedEtapas.map(e => this.addRow(e.id_etapa_proceso, e.nombre_etapa_proceso))
    //             $('#tableCreateModal tbody').html(htmlSelectedEtapas.join(''))
    //             $('#tableCreateModal').footable()
    //             $("#sortable").sortable({
    //                 start: this.sortableStart,
    //                 stop: this.sortableStop,
    //                 update: this.sortableUpdate,
    //             }).disableSelection()
    //             return data
    //         }
    //     })
    // }
    // addEtapa(self) {
    //     const id_etapa_proceso = $(self).val()
    //     const id_tipo_proceso = $('#createValue').val() || 0
    //     if (!id_etapa_proceso) {
    //         return false
    //     }
    //     $.ajax({
    //         url: '/tipos-de-proceso/etapa/insert',
    //         data: new URLSearchParams({ id_etapa_proceso, id_tipo_proceso }),
    //         success: () => {
    //             this.renderModalData(id_tipo_proceso)
    //         }
    //     })
    // }
    // createEditModal(id = 0) {
    //     $('#createModal').modal()
    //     $('#createValue').val(id)
    //     const title = id ? 'Editar tipo de proceso' : 'Nuevo tipo de proceso'
    //     $('#createTitle').text(title)
    //     $('#tipoNombre').val('')
    //     this.renderModalData(id).then(({ tipoProceso }) => {
    //         if (tipoProceso) {
    //             $('#tipoNombre').val(tipoProceso.nombre_tipo_proceso)
    //             $('#tipoEstado').prop('checked', tipoProceso.estado_tipo_proceso == 1).change()
    //         }
    //     })
    // }
    // openDelete(id) {
    //     $('#deleteModal').modal()
    //     $('#deleteValue').val(id)
    // }
    // upsert(e) {
    //     e.preventDefault()
    //     e.stopPropagation()
    //     if (validateForm(e)) {
    //         const id = $('#createValue').val()
    //         const formData = new FormData(e.target)
    //         id && formData.append('id_tipo_proceso', id)
    //         $.ajax({
    //             url: '/tipos-de-proceso/upsert',
    //             data: new URLSearchParams(formData),
    //             success: data => {
    //                 if (data.saved) {
    //                     location.reload()
    //                 } else if (data.exists) {
    //                     $('#etapaNombre').parent().addClass('has-error')
    //                 }
    //             }
    //         })
    //     }
    //     return false
    // }
    // delete() {
    //     const id = $('#deleteValue').val()
    //     $.ajax({
    //         url: '/tipos-de-proceso/delete/' + id,
    //         data: {},
    //         success: () => {
    //             location.reload()
    //         }
    //     })
    // }
    // deleteEtapa(id) {
    //     const id_tipo_proceso = $('#createValue').val() || 0;
    //     const params = {
    //         id_etapa_proceso: id,
    //         id_tipo_proceso
    //     }
    //     $.ajax({
    //         url: '/tipos-de-proceso/etapa/delete',
    //         data: new URLSearchParams(params),
    //         success: data => {
    //             this.renderModalData(id_tipo_proceso)
    //         }
    //     })
    // }
    // addRow(id_etapa_proceso, nombre_etapa_proceso) {
    //     //
    //     return `
    //         <tr data-id="${id_etapa_proceso}" class="ui-state-default" style="cursor:move">
    //             <td>${nombre_etapa_proceso}</td>
    //             <td width="30px" class="sortable-column-delete" >
    //                 <div class="flex justify-center table-actions">
    //                     <a class="text-danger" href="javascript:void(0)" class="btn text-danger" type="button"
    //                         onclick="tipoProceso.deleteEtapa(${id_etapa_proceso})">
    //                         <span class="glyphicon glyphicon-remove"></span>
    //                     </a>
    //                 </div>
    //             </td>
    //         </tr>
    //     `
    // }

  }]);

  return Cobro;
}();

var cobro = new Cobro();

var Documento = /*#__PURE__*/function () {
  function Documento() {
    _classCallCheck(this, Documento);
  }

  _createClass(Documento, [{
    key: "pdf",
    value: function pdf() {
      window.open('/documento/pdf');
    }
  }, {
    key: "excel",
    value: function excel() {
      window.open('/documento/excel');
    }
  }, {
    key: "closeCreateModal",
    value: function closeCreateModal() {
      $('#createModal').removeClass('open').modal('hide');
    }
  }, {
    key: "createEditModal",
    value: function createEditModal(id) {
      var title = id ? 'Editar documento' : 'Crear documento';
      $('#createModal').addClass('open').modal();
      $('#createValue').val(id);
      $('#documentoNombre').val('');
      $('#documentoEstado').prop('checked', true).change();
      $('#documentoObligatorio').prop('checked', true).change();
      $('#createTitle').text(title);

      if (id) {
        $.ajax({
          url: '/documento/get/' + id,
          success: function success(_ref3) {
            var documento = _ref3.documento;
            $('#documentoNombre').val(documento.nombre_documento);
            $('#documentoEstado').prop('checked', documento.estado_documento == 1).change();
            $('#documentoObligatorio').prop('checked', documento.obligatoriedad_documento == 1).change();
          }
        });
      }
    }
  }, {
    key: "upsert",
    value: function upsert(e) {
      e.preventDefault();
      e.stopPropagation();

      if (validateForm(e)) {
        var id = $('#createValue').val();
        var formData = new FormData(e.target);
        id && formData.append('id_documento', id);
        $.ajax({
          url: '/documento/upsert',
          data: new URLSearchParams(formData),
          success: function success(data) {
            if (data.saved) {
              alert('Se ha guardado satisfactoriamente!');
              $('#createModal').removeClass('open').modal('hide');
              location.reload();
            } else if (data.exists) {
              $('#documentoNombre').parent().addClass('has-error');
            }
          }
        });
      }

      return false;
    }
  }, {
    key: "openDelete",
    value: function openDelete(id) {
      $('#deleteModal').modal();
      $('#deleteValue').val(id);
    }
  }, {
    key: "delete",
    value: function _delete() {
      var id = $('#deleteValue').val();
      $.ajax({
        url: '/documento/delete/' + id,
        data: {},
        success: function success() {
          location.reload();
        }
      });
    }
  }]);

  return Documento;
}();

var documento = new Documento();

var EntidadDemandada = /*#__PURE__*/function () {
  function EntidadDemandada() {
    _classCallCheck(this, EntidadDemandada);
  }

  _createClass(EntidadDemandada, [{
    key: "pdf",
    value: function pdf() {
      window.open('/entidades-demandadas/pdf');
    }
  }, {
    key: "excel",
    value: function excel() {
      window.open('/entidades-demandadas/excel');
    }
  }, {
    key: "closeCreateModal",
    value: function closeCreateModal() {
      $('#createModal').removeClass('open').modal('hide');
    }
  }, {
    key: "createEditModal",
    value: function createEditModal(id) {
      var title = id ? 'Editar entidad demandada' : 'Crear entidad demandada';
      $('#createModal').addClass('open').modal();
      $('#createValue').val(id);
      $('#etapaNombre').val('');
      $('#etapaEstado').prop('checked', true).change();
      $('#createTitle').text(title);

      if (id) {
        $.ajax({
          url: '/entidades-demandadas/get/' + id,
          success: function success(_ref4) {
            var entidadDemandada = _ref4.entidadDemandada;
            $('#etapaNombre').val(entidadDemandada.nombre_entidad_demandada);
            $('#etapaCorreo').val(entidadDemandada.email_entidad_demandada);
            $('#etapaEstado').prop('checked', entidadDemandada.estado_entidad_demandada == 1).change();
          }
        });
      }
    }
  }, {
    key: "upsert",
    value: function upsert(e) {
      e.preventDefault();
      e.stopPropagation();

      if (validateForm(e)) {
        var id = $('#createValue').val();
        var formData = new FormData(e.target);
        id && formData.append('id_entidad_demandada', id);
        $.ajax({
          url: '/entidades-demandadas/upsert',
          data: new URLSearchParams(formData),
          success: function success(data) {
            if (data.saved) {
              alert('Se ha guardado satisfactoriamente!');
              $('#createModal').removeClass('open').modal('hide');
              location.reload();
            } else if (data.exists) {
              $('#etapaNombre').parent().addClass('has-error');
            }
          }
        });
      }

      return false;
    }
  }, {
    key: "openDelete",
    value: function openDelete(id) {
      $('#deleteModal').modal();
      $('#deleteValue').val(id);
    }
  }, {
    key: "delete",
    value: function _delete() {
      var id = $('#deleteValue').val();
      $.ajax({
        url: '/entidades-demandadas/delete/' + id,
        data: {},
        success: function success() {
          location.reload();
        }
      });
    }
  }]);

  return EntidadDemandada;
}();

var entidadDemandada = new EntidadDemandada();

var EntidadJusticia = /*#__PURE__*/function () {
  function EntidadJusticia() {
    _classCallCheck(this, EntidadJusticia);
  }

  _createClass(EntidadJusticia, [{
    key: "pdf",
    value: function pdf() {
      window.open('/entidades-de-justicia/pdf');
    }
  }, {
    key: "excel",
    value: function excel() {
      window.open('/entidades-de-justicia/excel');
    }
  }, {
    key: "closeCreateModal",
    value: function closeCreateModal() {
      $('#createModal').removeClass('open').modal('hide');
    }
  }, {
    key: "changePais",
    value: function changePais(self) {
      var pais = $(self).val();
      return $.ajax({
        url: '/entidades-de-justicia/departamentos/' + pais,
        success: function success(data) {
          var html = data.map(function (item) {
            return "<option value=\"".concat(item.id_departamento, "\">").concat(item.nombre_departamento, "</option>");
          });
          $('#id_departamento').html(html).selectpicker('refresh');
          $('#id_municipio').html('').val('').selectpicker('refresh');
        }
      });
    }
  }, {
    key: "changeDepartamento",
    value: function changeDepartamento(self) {
      var departamento = $(self).val();
      return $.ajax({
        url: '/entidades-de-justicia/municipios/' + departamento,
        success: function success(data) {
          var html = data.map(function (item) {
            return "<option value=\"".concat(item.id_municipio, "\">").concat(item.nombre_municipio, "</option>");
          });
          $('#id_municipio').html(html).selectpicker('refresh');
        }
      });
    }
  }, {
    key: "createEditModal",
    value: function createEditModal(id) {
      var _this3 = this;

      var title = id ? 'Editar entidad de justicia' : 'Crear entidad de justicia';
      $('#createModal').addClass('open').modal();
      $('#createValue').val(id);
      $('#etapaNombre').val('');
      $('#etapaEstado').prop('checked', true).change();
      $('#primeraInstancia').prop('checked', false).change();
      $('#segundaInstancia').prop('checked', false).change();
      $('#createTitle').text(title);
      $('#id_departamento').html('');
      $('#id_municipio').html('');
      $('#id_pais,#id_departamento,#id_municipio').val('').selectpicker('refresh');

      if (id) {
        $.ajax({
          url: '/entidades-de-justicia/get/' + id,
          success: function success(_ref5) {
            var entidadJusticia = _ref5.entidadJusticia;
            $('#etapaNombre').val(entidadJusticia.nombre_entidad_justicia);
            $('#etapaCorreo').val(entidadJusticia.email_entidad_justicia);
            $('#etapaEstado').prop('checked', entidadJusticia.estado_entidad_justicia == 1).change();
            $('#primeraInstancia').prop('checked', entidadJusticia.aplica_primera_instancia == 1).change();
            $('#segundaInstancia').prop('checked', entidadJusticia.aplica_segunda_instancia == 1).change();
            $('#id_pais').val(entidadJusticia.municipio.departamento.id_pais).selectpicker('refresh');

            _this3.changePais($('#id_pais')).then(function () {
              $('#id_departamento').val(entidadJusticia.municipio.id_departamento).selectpicker('refresh');

              _this3.changeDepartamento($('#id_departamento')).then(function () {
                $('#id_municipio').val(entidadJusticia.id_municipio).selectpicker('refresh');
              });
            });
          }
        });
      }
    }
  }, {
    key: "upsert",
    value: function upsert(e) {
      e.preventDefault();
      e.stopPropagation();

      if (validateForm(e)) {
        var id = $('#createValue').val();
        var formData = new FormData(e.target);
        id && formData.append('id_entidad_justicia', id);
        $.ajax({
          url: '/entidades-de-justicia/upsert',
          data: new URLSearchParams(formData),
          success: function success(data) {
            if (data.saved) {
              alert('Se ha guardado satisfactoriamente!');
              $('#createModal').removeClass('open').modal('hide');
              location.reload();
            } else if (data.exists) {
              $('#etapaNombre').parent().addClass('has-error');
            }
          }
        });
      }

      return false;
    }
  }, {
    key: "openDelete",
    value: function openDelete(id) {
      $('#deleteModal').modal();
      $('#deleteValue').val(id);
    }
  }, {
    key: "delete",
    value: function _delete() {
      var id = $('#deleteValue').val();
      $.ajax({
        url: '/entidades-de-justicia/delete/' + id,
        data: {},
        success: function success() {
          location.reload();
        }
      });
    }
  }]);

  return EntidadJusticia;
}();

var entidadJusticia = new EntidadJusticia();

var EtapaProceso = /*#__PURE__*/function () {
  function EtapaProceso() {
    _classCallCheck(this, EtapaProceso);
  }

  _createClass(EtapaProceso, [{
    key: "pdf",
    value: function pdf() {
      window.open('/etapas-de-proceso/pdf');
    }
  }, {
    key: "excel",
    value: function excel() {
      window.open('/etapas-de-proceso/excel');
    }
  }, {
    key: "createActuacion",
    value: function createActuacion() {
      $('#createModal').modal('hide');
      $('.modal-backdrop').remove();
      $('body').removeClass('modal-open');
      window.open('/#actuacion/crear');
    }
  }, {
    key: "closeCreateModal",
    value: function closeCreateModal() {
      $('#createModal').removeClass('open').modal('hide');
    }
  }, {
    key: "renderModalData",
    value: function renderModalData(id) {
      var _this4 = this;

      return $.ajax({
        url: '/etapas-de-proceso/get/' + (id || 0),
        success: function success(data) {
          var actuaciones = data.actuaciones,
              selectedActuaciones = data.selectedActuaciones;
          var htmlActuaciones = actuaciones.map(function (a) {
            return "<option value=\"".concat(a.id_actuacion, "\">").concat(a.nombre_actuacion, "</option>");
          });
          $('#actuacionesList').html(htmlActuaciones).selectpicker('refresh');
          var htmlSelected = selectedActuaciones.map(function (a) {
            return _this4.addRow(a.id_actuacion_etapa_proceso, a.nombre_actuacion, a.tiempo_maximo_proxima_actuacion, a.unidad_tiempo_proxima_actuacion);
          });
          $('#sortable').html(htmlSelected);
          $('#tableCreateModal').footable();
          $("#sortable").sortable({
            start: _this4.sortableStart,
            stop: _this4.sortableStop,
            update: _this4.sortableUpdate
          }).disableSelection();
          return data;
        }
      });
    }
  }, {
    key: "asociarActuacionModal",
    value: function asociarActuacionModal() {
      var type = arguments.length > 0 && arguments[0] !== undefined ? arguments[0] : 'show';
      $('#idActuacionEtapaProceso').val('');
      $('#actuacionesList').val('').selectpicker('refresh');
      $('#UnidadTiempoProximaActuacion').val(1).selectpicker('refresh');
      $('#tiempoMaximoProximaActuacion').val('');
      $('#createModal').css('opacity', type === 'show' ? .7 : 1);
      $('#actuacionModal').modal(type);
      setTimeout(function () {
        $('body').addClass('modal-open');
      }, 500);
    }
  }, {
    key: "addActuacion",
    value: function addActuacion(e) {
      var _this5 = this;

      e.preventDefault();
      e.stopPropagation();
      var id_actuacion = $('#actuacionesList').val();
      var id_etapa_proceso = $('#createValue').val() || 0;

      if (!id_actuacion) {
        return false;
      }

      var formData = new FormData(e.target);
      formData.append('id_etapa_proceso', id_etapa_proceso);
      $.ajax({
        url: '/etapas-de-proceso/actuacion/insert',
        data: new URLSearchParams(formData),
        success: function success() {
          _this5.renderModalData(id_etapa_proceso);

          _this5.asociarActuacionModal('hide');
        }
      });
      return false;
    }
  }, {
    key: "createEditModal",
    value: function createEditModal(id) {
      var title = id ? 'Editar etapa' : 'Crear etapa';
      $('#createModal').addClass('open').modal();
      $('#createValue').val(id);
      $('#etapaNombre').val('');
      $('#etapaEstado').prop('checked', true).change();
      $('#createTitle').text(title);
      this.renderModalData(id).then(function (_ref6) {
        var etapaProceso = _ref6.etapaProceso;
        $('#etapaNombre').val(etapaProceso.nombre_etapa_proceso);
        $('#etapaEstado').prop('checked', etapaProceso.estado_etapa_proceso == 1).change();
      });
    }
  }, {
    key: "upsert",
    value: function upsert(e) {
      e.preventDefault();
      e.stopPropagation();

      if (validateForm(e)) {
        var id = $('#createValue').val();
        var formData = new FormData(e.target);
        id && formData.append('id_etapa_proceso', id);
        $.ajax({
          url: '/etapas-de-proceso/upsert',
          data: new URLSearchParams(formData),
          success: function success(data) {
            if (data.saved) {
              alert('Se ha guardado satisfactoriamente!');
              $('#createModal').removeClass('open').modal('hide');
              location.reload();
            } else if (data.exists) {
              $('#etapaNombre').parent().addClass('has-error');
            }
          }
        });
      }

      return false;
    }
  }, {
    key: "openDelete",
    value: function openDelete(id) {
      $('#deleteModal').modal();
      $('#deleteValue').val(id);
    }
  }, {
    key: "delete",
    value: function _delete() {
      var id = $('#deleteValue').val();
      $.ajax({
        url: '/etapas-de-proceso/delete/' + id,
        data: {},
        success: function success() {
          location.reload();
        }
      });
    }
  }, {
    key: "deleteActuacion",
    value: function deleteActuacion(id) {
      $.ajax({
        url: '/etapas-de-proceso/actuacion/delete/' + id,
        data: {},
        success: function success(_ref7) {
          var deleted = _ref7.deleted;

          if (deleted) {
            $('#actuacionRow' + id).remove();
          }
        }
      });
    }
  }, {
    key: "editActuacion",
    value: function editActuacion(id) {
      this.asociarActuacionModal('show');
      $.ajax({
        url: '/etapas-de-proceso/actuacion/get/' + id,
        success: function success(data) {
          $('#tiempoMaximoProximaActuacion').val(data.tiempo_maximo_proxima_actuacion);
          $('#UnidadTiempoProximaActuacion').val(data.unidad_tiempo_proxima_actuacion).selectpicker('refresh');
          $('#idActuacionEtapaProceso').val(data.id_actuacion_etapa_proceso);
          $('#actuacionesList').append("<option value=\"".concat(data.id_actuacion, "\">").concat(data.nombre_actuacion, "</option>"));
          $('#actuacionesList').val(data.id_actuacion).selectpicker('refresh');
        }
      });
    }
  }, {
    key: "getUnityName",
    value: function getUnityName(unity) {
      switch (unity) {
        case 1:
          return 'Días';

        case 2:
          return 'Semanas';

        case 3:
          return 'Meses';

        case 4:
          return 'Años';

        default:
          return 'Días';
      }
    }
  }, {
    key: "addRow",
    value: function addRow(id, name, time, unity) {
      return "\n            <tr id=\"actuacionRow".concat(id, "\" data-id=\"").concat(id, "\" class=\"ui-state-default\">\n                <td><span class=\"ui-icon ui-icon-arrowthick-2-n-s\"></span>").concat(name, "</td>\n                <td><span class=\"ui-icon ui-icon-arrowthick-2-n-s\"></span>").concat(time || 0, " ").concat(this.getUnityName(unity), "</td>\n                <td width=\"30px\" class=\"sortable-column-delete\" >\n                    <div class=\"flex justify-center table-actions\">\n                        <a  href=\"javascript:void(0)\" class=\"text-primary btn\" type=\"button\"\n                            onclick=\"etapaProceso.editActuacion(").concat(id, ")\">\n                            <span class=\"glyphicon glyphicon-pencil\"></span>\n                        </a>\n                        <a href=\"javascript:void(0)\" class=\"text-danger btn\" type=\"button\"\n                            onclick=\"etapaProceso.deleteActuacion(").concat(id, ")\">\n                            <span class=\"glyphicon glyphicon-remove\"></span>\n                        </a>\n                    </div>\n                </td>\n            </tr>\n        ");
    }
  }, {
    key: "sortableStart",
    value: function sortableStart(_, ui) {
      $(ui.item).css('background', '#ccc').children('td').css('visibility', 'hidden');
      $(ui.item).find('.footable-first-visible').css('visibility', 'visible');
    }
  }, {
    key: "sortableStop",
    value: function sortableStop(_, ui) {
      $(ui.item).css('background', 'inherit').children('td').css('visibility', 'visible');
    }
  }, {
    key: "sortableUpdate",
    value: function sortableUpdate(event, _) {
      var $rowList = $(event.target).children('tr') || [];
      var orderedList = [];

      var _iterator = _createForOfIteratorHelper($rowList),
          _step;

      try {
        for (_iterator.s(); !(_step = _iterator.n()).done;) {
          item = _step.value;
          orderedList.push($(item).data('id'));
        }
      } catch (err) {
        _iterator.e(err);
      } finally {
        _iterator.f();
      }

      var params = {
        orderedList: orderedList,
        id_etapa_proceso: $('#createValue').val()
      };
      $.ajax({
        url: '/etapas-de-proceso/actuacion/order/update',
        data: new URLSearchParams(params),
        success: function success(data) {
          console.log(data);
        }
      });
    }
  }]);

  return EtapaProceso;
}();

var etapaProceso = new EtapaProceso();

var Honorario = /*#__PURE__*/function () {
  function Honorario() {
    _classCallCheck(this, Honorario);
  }

  _createClass(Honorario, [{
    key: "pdf",
    value: function pdf() {
      window.open('/honorarios/pdf');
    }
  }, {
    key: "excel",
    value: function excel() {
      window.open('/honorarios/excel');
    }
  }, {
    key: "openDelete",
    value: function openDelete(id) {
      $('#deleteModal').modal();
      $('#deleteValue').val(id);
    }
  }, {
    key: "closePagoModal",
    value: function closePagoModal() {
      $('#editarPagoModal').removeClass('open').modal('hide');
    }
  }, {
    key: "closeCreateModal",
    value: function closeCreateModal() {
      $('#createModal').removeClass('open').modal('hide');
    }
  }, {
    key: "createEditModal",
    value: function createEditModal() {
      var id = arguments.length > 0 && arguments[0] !== undefined ? arguments[0] : 0;
      var that = this;
      $('#createModal').addClass('open').modal();
      $('#createValue').val(id);
      var title = id ? 'Editar honorarios' : 'Nuevo cobro de honorarios';
      $('#createTitle').text(title);
      $('#tipoNombre').val('');
      that.resetForm();

      if (id) {
        $.ajax({
          url: '/honorarios/get/' + id,
          success: function success(data) {
            $('#id_proceso').val(data.id_proceso).selectpicker('refresh');
            that.onChangeProceso($('#id_proceso')).then(function () {
              $('#porcentaje_honorarios').val(data.porcentaje_honorarios);
              $('#retefuente').val(data.retefuente);
              $('#reteica').val(data.reteica);
              $('#valor_comision').val(data.valor_comision);
              $('#numero_factura').val(data.numero_factura);
              $('#valor_factura').val(data.valor_factura);
              that.onChangeComisiones();
              that.onChangePorcentajeHonorarios($('#porcentaje_honorarios'));
            });
          }
        });
      }
    }
  }, {
    key: "changeFormaPago",
    value: function changeFormaPago(value) {
      if (value == 1) {
        $('#informacion_pago_financiero').hide();
        $('#id_entidad_financiera').removeClass('required').val('');
        $('#referencia').removeClass('required').val('');
      } else {
        $('#informacion_pago_financiero').show();
        $('#id_entidad_financiera').addClass('required');
        $('#referencia').addClass('required');
      }
    }
  }, {
    key: "formasPago",
    value: function formasPago(id) {
      switch (id) {
        case 1:
          return 'Efectivo';

        case 2:
          return 'Consignación';

        case 3:
          return 'Cheque';

        default:
          return 'Desconocido';
      }
    }
  }, {
    key: "formatDate",
    value: function formatDate(date) {
      var newDate = new Date(date);
      return newDate.getDate() + '/' + (newDate.getMonth() + 1) + '/' + newDate.getFullYear();
    }
  }, {
    key: "deletePagoModal",
    value: function deletePagoModal(id) {
      $('#deletePagoValue').val(id);
      $('#pagosModal').modal('hide');
      setTimeout(function () {
        $('#deletePagoModal').modal('show');
      }, 500);
    }
  }, {
    key: "deletePagoCancelar",
    value: function deletePagoCancelar() {
      $('#deletePagoValue').val('');
      $('#deletePagoModal').modal('hide');
      setTimeout(function () {
        $('#pagosModal').modal('show');
      }, 500);
    }
  }, {
    key: "deletePagoAceptar",
    value: function deletePagoAceptar() {
      var id = $('#deletePagoValue').val();
      $('#item-pago-' + id).remove();
      this.deletePagoCancelar();
    }
  }, {
    key: "pagoModalOpen",
    value: function pagoModalOpen(id) {
      var _this6 = this;

      $('#pagosModal').modal('show');
      $('#lista-pagos tbody').html('');
      $('#lista-pagos').footable('refresh');

      if (id) {
        $.ajax({
          url: '/honorarios/pagos/get/' + id,
          success: function success(data) {
            if (data) {
              var html = data.map(function (item) {
                return "<tr id=\"item-pago-".concat(item.id_pago_honorario, "\">\n                            <td>").concat(_this6.formatDate(item.fecha_consignacion), "</td>\n                            <td>").concat(_this6.formasPago(item.forma_pago), "</td>\n                            <td>").concat(item.numero_cuenta || 'En efectivo', "</td>\n                            <td>").concat(item.valor_pago, "</td>\n                            <td>\n                                <div class=\"flex justify-center table-actions\">\n                                    <a href=\"javascript:void(0)\" title=\"Editar pago\"\n                                        onclick=\"honorario.registrarPagoModalOpen('").concat(item.id_honorario, "', '").concat(item.id_pago_honorario, "')\" class=\"btn text-primary\" type=\"button\">\n                                        <span class=\"glyphicon glyphicon-edit\"></span>\n                                    </a>\n                                    <a href=\"javascript:void(0)\" title=\"Eliminar pago\"\n                                        onclick=\"honorario.deletePagoModal('").concat(item.id_pago_honorario, "')\" class=\"btn text-danger\" type=\"button\">\n                                        <span class=\"glyphicon glyphicon-trash\"></span>\n                                    </a>\n                                </div>\n\n                            </td>\n                        </tr>");
              });
              $('#lista-pagos tbody').html(html);
            }

            $('#lista-pagos').footable('refresh');
          }
        });
      }
    }
  }, {
    key: "upsertPago",
    value: function upsertPago(e) {
      e.preventDefault();
      e.stopPropagation();

      if (validateForm(e)) {
        var id = $('#id_cobro_pago').val();
        var idpago = $('#id_pago_pago').val();
        var formData = new FormData(e.target);
        id && formData.append('id_honorario', id);
        idpago && formData.append('id_pago', idpago);
        $.ajax({
          url: '/honorarios/pago/upsert',
          data: new URLSearchParams(formData),
          success: function success(data) {
            if (data.saved) {
              $('#editarPagoModal').removeClass('open').modal('hide');
              location.reload();
            }
          }
        });
      }

      return false;
    }
  }, {
    key: "registrarPagoModalOpen",
    value: function registrarPagoModalOpen(id) {
      var _this7 = this;

      var idpago = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : 0;
      $('#editarPagoModal').addClass('open').modal('show');
      this.changeFormaPago(1);
      $('#id_entidad_financiera').val(0).selectpicker('refresh');
      $('#id_cobro_pago').val(id);
      $('#id_pago_pago').val(idpago);

      if (id) {
        $.ajax({
          url: '/honorarios/pago/get/' + idpago,
          success: function success(data) {
            if (data) {
              $('#fecha_pago').val(data.fecha_consignacion);
              $('#forma_pago').val(data.forma_pago).selectpicker('refresh');
              $('#id_entidad_financiera').val(data.id_entidad_financiera).selectpicker('refresh');
              $('#referencia').val(data.numero_cuenta);

              _this7.changeFormaPago(data.forma_pago);

              $('#valor_pago').val(data.valor_pago);
            }
          }
        });
      }
    }
  }, {
    key: "onChangeComisiones",
    value: function onChangeComisiones() {
      var valorComision = parseFloat($('#valor_comision').val()) || 0;
      var retefuente = parseFloat($('#retefuente').val()) || 0;
      var reteica = parseFloat($('#reteica').val()) || 0;
      var totalReteica = (valorComision * reteica / 100).toFixed(2);
      var totalRetefuente = (valorComision * retefuente / 100).toFixed(2);
      var totalComision = (valorComision - totalReteica - totalRetefuente).toFixed(2);
      $('#valor_retefuente').val(totalRetefuente);
      $('#valor_reteica').val(totalReteica);
      $('#total_comision').val(totalComision);
    }
  }, {
    key: "resetForm",
    value: function resetForm() {
      $('#id_proceso').val('').selectpicker('refresh');
      $('#campos-honorarios').hide();
      $('#documento_cliente').val('');
      $('#nombre_cliente').val('');
      $('#valor_pagado_cliente').val(0);
      $('#fecha_pago_cliente').val('');
      $('#documento_intermediario').val('');
      $('#nombre_intermediario').val('');
      $('#porcentaje_honorarios').val(0);
      $('#valor_honorarios').val(0);
    }
  }, {
    key: "onChangeProceso",
    value: function onChangeProceso(self) {
      var $self = $(self);
      var id = $self.val();

      if (id) {
        return $.ajax({
          url: '/honorarios/proceso/' + id,
          success: function success(data) {
            console.log(data);

            if (data) {
              var getNombreCompleto = function getNombreCompleto(data) {
                var nombreCliente = [];

                if (data) {
                  if (data.primer_apellido) {
                    nombreCliente.push(data.primer_apellido);
                  }

                  if (data.segundo_apellido) {
                    nombreCliente.push(data.segundo_apellido);
                  }

                  if (data.primer_nombre) {
                    nombreCliente.push(data.primer_nombre);
                  }

                  if (data.segundo_nombre) {
                    nombreCliente.push(data.segundo_nombre);
                  }
                }

                return nombreCliente.join(' ');
              };

              $('#campos-honorarios').show();
              $('#documento_cliente').val(data.cliente.persona.numero_documento);
              $('#nombre_cliente').val(getNombreCompleto(data.cliente.persona));
              $('#valor_pagado_cliente').val(data.valor_final_sentencia);
              $('#fecha_pago_cliente').val(data.fecha_pago);
              $('#documento_intermediario').val(data.cliente.intermediario.persona.numero_documento);
              $('#nombre_intermediario').val(getNombreCompleto(data.cliente.intermediario.persona));
            }
          }
        });
      }

      return new Promise();
    }
  }, {
    key: "onChangePorcentajeHonorarios",
    value: function onChangePorcentajeHonorarios(self) {
      var $self = $(self);
      var value = parseFloat($self.val() || 0);

      if (value > 100) {
        value = 100;
        $self.val(100);
      } else if (value < 0) {
        value = 0;
        $self.val(0);
      }

      var valorPagado = parseFloat($('#valor_pagado_cliente').val() || 0);
      $('#valor_honorarios').val(valorPagado * value / 100);
    }
  }, {
    key: "onChangeClient",
    value: function onChangeClient(self) {
      var $self = $(self);
      var id = $self.val();

      if ($self.is('#documento_cliente')) {
        $('#nombre_cliente').val(id).selectpicker('refresh');
      } else {
        $('#documento_cliente').val(id).selectpicker('refresh');
      }

      $('#documento_intermediario').val('');
      $('#nombre_intermediario').val('');
      $.ajax({
        url: '/honorarios/cliente/' + id,
        success: function success(data) {
          $('#documento_intermediario').val(data.numero_documento_intermediario);
          var nombreIntermediario = [];

          if (data.intermediario_p_apellido) {
            nombreIntermediario.push(data.intermediario_p_apellido);
          }

          if (data.intermediario_s_apellido) {
            nombreIntermediario.push(data.intermediario_s_apellido);
          }

          if (data.intermediario_p_nombre) {
            nombreIntermediario.push(data.intermediario_p_nombre);
          }

          if (data.intermediario_s_nombre) {
            nombreIntermediario.push(data.intermediario_s_nombre);
          }

          $('#nombre_intermediario').val(nombreIntermediario.join(' '));
        }
      });
    }
  }, {
    key: "formatTelefonoIntermediario",
    value: function formatTelefonoIntermediario(data) {
      var telefonoIntermediario = [];

      if (data.telefono_intermediario) {
        telefonoIntermediario.push(data.telefono_intermediario);
      }

      if (data.celular_intermediario) {
        telefonoIntermediario.push(data.celular_intermediario);
      }

      return telefonoIntermediario.join(' | ');
    }
  }, {
    key: "formatTelefonoBeneficiario",
    value: function formatTelefonoBeneficiario(data) {
      var telefonoBeneficiario = [];

      if (data.telefono_beneficiario) {
        telefonoBeneficiario.push(data.telefono_beneficiario);
      }

      if (data.celular_beneficiario) {
        telefonoBeneficiario.push(data.celular_beneficiario);
      }

      if (data.celular2_beneficiario) {
        telefonoBeneficiario.push(data.celular2_beneficiario);
      }

      return telefonoBeneficiario.join(' | ');
    }
  }, {
    key: "formatTelefonoCliente",
    value: function formatTelefonoCliente(data) {
      var telefonoCliente = [];

      if (data.telefono) {
        telefonoCliente.push(data.telefono);
      }

      if (data.celular) {
        telefonoCliente.push(data.celular);
      }

      if (data.celular2) {
        telefonoCliente.push(data.celular2);
      }

      return telefonoCliente.join(' | ');
    }
  }, {
    key: "changeTipoProceso",
    value: function changeTipoProceso(self) {
      var id = $(self).val();
      var params = {
        id_proceso: getId(),
        id_tipo_proceso: id
      };
      $.ajax({
        url: '/honorarios/tipo-proceso/documentos',
        data: new URLSearchParams(params),
        success: function success(data) {
          if (!data.length) {
            $('#documentos-proceso-tab').hide();
            return;
          }

          var html = data.map(function (item) {
            return "\n                <div class=\"file-document\"\n                    data-filename=\"".concat(item.filename ? item.filename : '', "\"\n                    data-id=\"").concat(item.id_documento, "\"\n                    data-title=\"").concat(item.nombre_documento, "\"\n                    data-required=\"").concat(item.obligatoriedad_documento == 1 ? 'true' : 'false', "\">\n                </div>");
          });
          $('#documentos-proceso-tab').show();
          $('#documentos-requeridos').html(html);
          var id = getId();
          $('.file-document').fileDocument({
            url: 'proceso/upload',
            path: 'uploads/documentos',
            id: id
          });
        }
      });
    }
  }, {
    key: "changeDepartamento",
    value: function changeDepartamento(self) {
      var departamento = $(self).val();
      $.ajax({
        url: '/departamento/municipios/' + departamento,
        success: function success(data) {
          $('#id_municipio').val('');
          var html = data.map(function (item) {
            return "<option value=\"".concat(item.id_municipio, "\">").concat(item.nombre_municipio, "</option>");
          });
          $('#id_municipio').html(html).selectpicker('refresh');
        }
      });
    }
  }, {
    key: "upsert",
    value: function upsert(e) {
      e.preventDefault();
      e.stopPropagation();

      if (validateForm(e)) {
        var id = $('#createValue').val();
        var formData = new FormData(e.target);
        id && formData.append('id_honorario', id);
        $.ajax({
          url: '/honorarios/upsert',
          data: new URLSearchParams(formData),
          success: function success(data) {
            if (data.saved) {
              alert('Se ha guardado satisfactoriamente!');
              $('#createModal').removeClass('open').modal('hide');
              location.reload();
            }
          }
        });
      }

      return false;
    }
  }, {
    key: "changeCliente",
    value: function changeCliente(self) {
      var _this8 = this;

      var id = $(self).val();
      $.ajax({
        url: '/cliente/basic/' + id,
        success: function success(cliente) {
          $('#documento_cliente').val(cliente.numero_documento);
          $('#telefono_cliente').val(_this8.formatTelefonoCliente(cliente));
          $('#indicativo_cliente').text('+' + cliente.indicativo);
          $('#nombre_intermediario').val((cliente.intermediario_p_apellido || '') + ' ' + (cliente.intermediario_s_apellido || '') + ' ' + (cliente.intermediario_p_nombre || '') + ' ' + (cliente.intermediario_s_nombre || ''));
          $('#nombre_beneficiario').val(cliente.nombre_beneficiario);
          $('#indicativo_beneficiario').val(cliente.indicativo_beneficiario);
          $('#telefono_beneficiario').val(_this8.formatTelefonoBeneficiario(cliente));
          $('#email_beneficiario').val(cliente.correo_electronico_beneficiario);
          $('#email_cliente').val(cliente.correo_electronico_cliente);
          $('#estado_vital_cliente').val(cliente.estado_vital_cliente == 1 ? 'vivo' : 'fallecido');
          $('#telefono_intermediario').val(_this8.formatTelefonoIntermediario(cliente));
          $('#indicativo_intermediario').val(cliente.indicativo_intermediario);
          $('#email_intermediario').val(cliente.correo_electronico_intermediario);
        }
      });
    }
  }, {
    key: "delete",
    value: function _delete() {
      var id = $('#deleteValue').val();
      $.ajax({
        url: '/honorarios/delete/' + id,
        success: function success(_ref8) {
          var deleted = _ref8.deleted;

          if (deleted) {
            $('#tipoProcesoRow' + id).remove();
            $('#deleteModal').modal('hide');
          }
        }
      });
      return false;
    }
  }, {
    key: "openComments",
    value: function openComments(id) {
      $.ajax({
        url: '/seguimiento-procesos/comentarios/' + id,
        beforeSend: function beforeSend() {
          return $('#comentariosTable tbody').html('');
        },
        success: function success(data) {
          if (data.length) {
            var html = data.map(function (item) {
              return "\n                        <tr>\n                            <td>".concat(item.fechaCreacion, "</td>\n                            <td>").concat(item.nombreUsuario, "</td>\n                            <td>").concat(item.comentario, "</td>\n                        </tr>\n                    ");
            });
            $('#comentariosTable tbody').html(html);
            $('#comentariosModalTitle').text('Comentarios proceso n° ' + data[0].numero_proceso);
          }

          $('#comentariosTable').footable();
          $('#comentariosModal').modal();
        }
      });
    }
  }]);

  return Honorario;
}();

var honorario = new Honorario();

var Intermediario = /*#__PURE__*/function () {
  function Intermediario() {
    _classCallCheck(this, Intermediario);
  }

  _createClass(Intermediario, [{
    key: "pdf",
    value: function pdf() {
      window.open('/intermediario/pdf');
    }
  }, {
    key: "excel",
    value: function excel() {
      window.open('/intermediario/excel');
    }
  }, {
    key: "closeCreateModal",
    value: function closeCreateModal() {
      $('#createModal').removeClass('open').modal('hide');
    }
  }, {
    key: "changeMunicipio",
    value: function changeMunicipio(self) {
      var municipio = $(self).val();
      $.ajax({
        url: '/intermediario/municipio/' + municipio,
        success: function success(data) {
          if (data.indicativo) {
            $('#indicativo').show().text('+' + data.indicativo);
          } else {
            $('#indicativo').hide();
          }
        }
      });
    }
  }, {
    key: "createEditModal",
    value: function createEditModal(id) {
      var title = id ? 'Editar intermediario' : 'Crear intermediario';
      $('#createModal').addClass('open').modal();
      $('#createValue').val(id);
      $('#createTitle').text(title);
      $('#tipoDocumento').val(1).selectpicker('refresh');
      $('#municipio').val(1).selectpicker('refresh');
      $('#numeroDocumento').val('');
      $('#primerApellido').val('');
      $('#segundoApellido').val('');
      $('#primerNombre').val('');
      $('#segundoNombre').val('');
      $('#telefono').val('');
      $('#correoElectronico').val('');
      $('#etapaEstado').prop('checked', true).change();
      $('#retencion').val(0);
      $('#indicativo').show().text('+1');

      if (id) {
        $.ajax({
          url: '/intermediario/get/' + id,
          success: function success(_ref9) {
            var intermediario = _ref9.intermediario;
            $('#tipoDocumento').val(intermediario.id_tipo_documento).selectpicker('refresh');
            $('#numeroDocumento').val(intermediario.numero_documento);
            $('#primerApellido').val(intermediario.primer_apellido);
            $('#segundoApellido').val(intermediario.segundo_apellido);
            $('#primerNombre').val(intermediario.primer_nombre);
            $('#segundoNombre').val(intermediario.segundo_nombre);
            $('#telefono').val(intermediario.telefono);
            $('#retencion').val(intermediario.retencion);
            $('#municipio').val(intermediario.id_municipio).selectpicker('refresh');
            $('#correoElectronico').val(intermediario.correo_electronico);
            $('#etapaEstado').prop('checked', intermediario.estado_intermediario == 1).change();

            if (intermediario.indicativo) {
              $('#indicativo').text('+' + intermediario.indicativo);
            } else {
              $('#indicativo').hide();
            }
          }
        });
      }
    }
  }, {
    key: "upsert",
    value: function upsert(e) {
      e.preventDefault();
      e.stopPropagation();

      if (validateForm(e)) {
        var id = $('#createValue').val();
        var formData = new FormData(e.target);
        id && formData.append('id_intermediario', id);
        $.ajax({
          url: '/intermediario/upsert',
          data: new URLSearchParams(formData),
          success: function success(data) {
            if (data.saved) {
              alert('Se ha guardado satisfactoriamente!');
              $('#createModal').removeClass('open').modal('hide');
              location.reload();
            } else if (data.documentExists || data.invalidDocument) {
              $('#numeroDocumento').parent().addClass('has-error');
              var text = data.documentExists ? 'El número de documento ya existe' : 'Documento inválido';
              showErrorPopover($('#numeroDocumento'), text, 'top');
            }
          }
        });
      }

      return false;
    }
  }, {
    key: "openDelete",
    value: function openDelete(id) {
      $('#deleteModal').modal();
      $('#deleteValue').val(id);
    }
  }, {
    key: "delete",
    value: function _delete() {
      var id = $('#deleteValue').val();
      $.ajax({
        url: '/intermediario/delete/' + id,
        data: {},
        success: function success() {
          location.reload();
        }
      });
    }
  }]);

  return Intermediario;
}();

var intermediario = new Intermediario();

var Menu = /*#__PURE__*/function () {
  function Menu() {
    _classCallCheck(this, Menu);
  }

  _createClass(Menu, [{
    key: "pdf",
    value: function pdf() {
      window.open('/opciones/menu/pdf');
    }
  }, {
    key: "excel",
    value: function excel() {
      window.open('/opciones/menu/excel');
    }
  }, {
    key: "renderParents",
    value: function renderParents(parents) {
      var html = [];
      html.push('<option value="0">Sin padre</option>');
      parents.map(function (parent) {
        return html.push("<option value=\"".concat(parent.id_menu, "\">").concat(parent.nombre_menu, "</option>"));
      });
      $('#create_parent_id').html(html.join('')).selectpicker('refresh');
    }
  }, {
    key: "toggleRutaMenu",
    value: function toggleRutaMenu(value) {
      var $ruta = $('#create_ruta_menu');

      if (!parseInt(value)) {
        $ruta.prop('disabled', true).removeClass('required').parent('.form-group').hide();
      } else {
        $ruta.prop('disabled', false).addClass('required').parent('.form-group').show();
      }
    }
  }, {
    key: "onChangeSelect",
    value: function onChangeSelect(self) {
      var value = $(self).val();
      this.toggleRutaMenu(value);
    }
  }, {
    key: "createModal",
    value: function createModal(id) {
      var _this9 = this;

      var title = id ? 'Crear' : 'Editar';
      var that = this;
      $('#createModal').addClass('open').modal();
      $('#createTitle').text(title);
      $('#idCreateElement').val(id);
      $('#create_nombre_menu').val('');
      $('#create_ruta_menu').val('');
      $('#create_orden_menu').val('');
      $('#create_parent_id').val('').selectpicker('refresh');
      $.ajax({
        url: '/opciones/menu/' + (id || 0),
        data: {},
        success: function success(data) {
          that.toggleRutaMenu(data.parent_id);
          $('#create_nombre_menu').val(data.nombre_menu);
          $('#create_ruta_menu').val(data.ruta_menu);
          $('#create_orden_menu').val(data.orden_menu);
          var html = (data.acciones || []).map(function (accion) {
            return _this9.rowAccion(accion);
          });
          that.renderParents(data.parents);
          $('#tableCreateModal tbody').html(html.join(''));
          $('#tableCreateModal').footable();
          $('#create_parent_id').val(data.parent_id).selectpicker('refresh');
        }
      });
    }
  }, {
    key: "closeCreateModal",
    value: function closeCreateModal() {
      $('#createModal').removeClass('open').modal('hide');
    }
  }, {
    key: "upsert",
    value: function upsert(e) {
      e.preventDefault();
      e.stopPropagation();

      if (validateForm(e)) {
        var id = $('#idCreateElement').val();
        var formData = new FormData(e.target);
        id && formData.append('id_menu', id);
        $.ajax({
          url: '/opciones/menu/upsert',
          data: new URLSearchParams(formData),
          success: function success(data) {
            if (data.saved) {
              alert('Se ha guardado satisfactoriamente!');
              $('#createModal').removeClass('open');
              location.reload();
            } else if (data.exists) {
              $('#create_nombre_menu').parent().addClass('has-error');
            }
          }
        });
      }

      return false;
    }
  }, {
    key: "openDelete",
    value: function openDelete(id) {
      $('#deleteModal').modal();
      $('#deleteValue').val(id);
    }
  }, {
    key: "delete",
    value: function _delete() {
      var id = $('#deleteValue').val();
      $.ajax({
        url: '/opciones/menu/delete/' + id,
        data: {},
        success: function success() {
          location.reload();
        }
      });
    }
  }, {
    key: "createActionModal",
    value: function createActionModal(id) {
      $('#createActionModal').modal();
      $('#id_accion').val('');
      $('#accion_nombre_accion').val('');
      $('#accion_observacion').val('');

      if (id) {
        $.ajax({
          url: '/opciones/accion/' + id,
          data: {},
          success: function success(data) {
            $('#id_accion').val(data.id_accion);
            $('#accion_nombre_accion').val(data.nombre_accion);
            $('#accion_observacion').val(data.observacion);
          }
        });
      }
    }
  }, {
    key: "rowAccion",
    value: function rowAccion(_ref10) {
      var id_accion = _ref10.id_accion,
          nombre_accion = _ref10.nombre_accion,
          observacion = _ref10.observacion;
      return "\n            <tr id=\"accionRow".concat(id_accion, "\">\n                <td>").concat(nombre_accion, "</td>\n                <td>").concat(observacion || '', "</td>\n                <td width=\"30px\">\n                    <div class=\"flex justify-center table-actions\">\n                        <a href=\"javascript:void(0)\" onclick=\"menu.createActionModal(").concat(id_accion, ")\" class=\"btn text-primary\" type=\"button\">\n                            <span class=\"glyphicon glyphicon-pencil\"></span>\n                        </a>\n                        <a href=\"javascript:void(0)\" class=\"btn text-danger\" type=\"button\" onclick=\"menu.deleteActionModal(").concat(id_accion, ")\">\n                            <span class=\"glyphicon glyphicon-remove\"></span>\n                        </a>\n                    </div>\n                </td>\n            </tr>\n        ");
    }
  }, {
    key: "deleteActionModal",
    value: function deleteActionModal(id) {
      $('#deleteActionModal').modal();
      $('#deleteActionID').val(id);
    }
  }, {
    key: "deleteAction",
    value: function deleteAction() {
      var id = $('#deleteActionID').val();
      $.ajax({
        url: '/opciones/accion/delete/' + id,
        data: {},
        success: function success(_ref11) {
          var deleted = _ref11.deleted;

          if (deleted) {
            $('#accionRow' + id).remove();
          }

          $('#deleteActionModal').modal('hide');
        }
      });
    }
  }, {
    key: "upsertAccion",
    value: function upsertAccion(e) {
      var _this10 = this;

      e.preventDefault();
      e.stopPropagation();
      var formData = new FormData(e.target);
      formData.append('id_menu', $('#idCreateElement').val());
      $.ajax({
        url: '/opciones/accion/upsert',
        data: new URLSearchParams(formData),
        success: function success(data) {
          var html = _this10.rowAccion(data);

          var $item = $('#accionRow' + data.id_accion);

          if ($item.length) {
            $item.replaceWith(html);
          } else {
            $('#tableCreateModal tbody').append(html);
          }

          $('#tableCreateModal .footable-empty').remove();
          $('#tableCreateModal').footable();
          $('#createActionModal').modal('hide');
        }
      });
      return false;
    }
  }]);

  return Menu;
}();

var menu = new Menu();

var Perfil = /*#__PURE__*/function () {
  function Perfil() {
    _classCallCheck(this, Perfil);
  }

  _createClass(Perfil, [{
    key: "pdf",
    value: function pdf() {
      window.open('/perfil/pdf');
    }
  }, {
    key: "excel",
    value: function excel() {
      window.open('/perfil/excel');
    }
  }, {
    key: "openDelete",
    value: function openDelete(id) {
      $('#deleteModal').modal();
      $('#deleteValue').val(id);
    }
  }, {
    key: "addSelectListener",
    value: function addSelectListener() {
      $("#tableCreateModal select").on("changed.bs.select", function (e, clickedIndex, newValue, oldValue) {
        var id_menu_perfil = $(this).data('menu-perfil');
        var id_accion = $(this).find('option').eq(clickedIndex).val();
        $.ajax({
          url: '/perfil/menu/accion/addremove',
          data: new URLSearchParams({
            id_menu_perfil: id_menu_perfil,
            id_accion: id_accion,
            add: !!newValue
          })
        });
      });
    }
  }, {
    key: "closeCreateModal",
    value: function closeCreateModal() {
      $('#createModal').removeClass('open').modal('hide');
    }
  }, {
    key: "redrawTableModal",
    value: function redrawTableModal(id) {
      var _this11 = this;

      return $.ajax({
        url: '/perfil/get/' + (id || 0),
        success: function success(data) {
          var html = data.menus.map(function (menu) {
            return "<option value=\"".concat(menu.id_menu, "\">").concat(menu.nombre_menu, "</option>");
          });
          $('#listaMenu').html(html).selectpicker('refresh');
          html = data.selectedMenus.map(function (menu) {
            return _this11.getRow(menu.id_menu_perfil, menu.nombre_menu, menu.acciones);
          });
          $('#tableCreateModal tbody').html(html).children('.footable-empty').remove();
          $('#tableCreateModal').footable();
          $('#tableCreateModal select').selectpicker('refresh');

          _this11.addSelectListener();

          return data;
        }
      });
    }
  }, {
    key: "createEditModal",
    value: function createEditModal(id) {
      var text = id ? 'Editar perfil' : 'Nuevo perfil';
      $('#createModal').addClass('open').modal();
      $('#createValue').val(id);
      $('#createTitle').text(text);
      this.redrawTableModal(id).then(function (data) {
        $('#perfilNombre').val(data.perfil ? data.perfil.nombre_perfil : '');
        $('#perfilEstado').prop('checked', data.perfil ? data.perfil.inactivo == 0 : true).change();
      });
    }
  }, {
    key: "create",
    value: function create(e) {
      e.preventDefault();
      e.stopPropagation();
      var id = $('#createValue').val();
      var $formData = new FormData(e.target);
      $formData.append('id_perfil', id);
      $.ajax({
        url: '/perfil/create',
        data: new URLSearchParams($formData),
        success: function success(data) {
          $('#createModal').removeClass('open').modal('hide');
          setTimeout(function () {
            location.reload();
          }, 500);
        }
      });
      return false;
    }
  }, {
    key: "addMenu",
    value: function addMenu() {
      var _this12 = this;

      var id_menu = $('#listaMenu').val();
      var id_perfil = $('#createValue').val() || 0;
      var params = {
        id_menu: id_menu,
        id_perfil: id_perfil
      };

      if (!id_menu) {
        return false;
      }

      $.ajax({
        url: '/perfil/menu/insert',
        data: new URLSearchParams(params),
        success: function success(_ref12) {
          var saved = _ref12.saved;

          if (saved) {
            _this12.redrawTableModal(id_perfil);
          }
        }
      });
    }
  }, {
    key: "deleteMenu",
    value: function deleteMenu(id) {
      $.ajax({
        url: '/perfil/menu/delete/' + id,
        success: function success(_ref13) {
          var deleted = _ref13.deleted,
              menuItem = _ref13.menuItem;

          if (deleted) {
            $('#menuRow' + id).remove();
            var name = menuItem.nombre_menu;
            var value = menuItem.id_menu;
            $('#listaMenu').append("<option value=\"".concat(value, "\">").concat(name, "</option>")).selectpicker('refresh');
          }
        }
      });
    }
  }, {
    key: "delete",
    value: function _delete() {
      var id = $('#deleteValue').val();
      $.ajax({
        url: '/perfil/delete/' + id,
        success: function success(_ref14) {
          var deleted = _ref14.deleted;

          if (deleted) {
            $('#deleteModal').modal('hide');
            $('#perfilRow' + id).remove();
          }
        }
      });
    }
  }, {
    key: "getRow",
    value: function getRow(id_menu_perfil, nombre, acciones) {
      var html = (acciones || []).map(function (a) {
        return "<option value=\"".concat(a.id_accion, "\" ").concat(a.selected ? 'selected' : '', ">").concat(a.nombre_accion, "</option>");
      });
      return "\n            <tr id=\"menuRow".concat(id_menu_perfil, "\">\n                <td>").concat(nombre, "</td>\n                <td>\n                <select data-menu-perfil=\"").concat(id_menu_perfil, "\" class=\"selectpicker\" title=\"Seleccionar ...\" multiple>\n                    ").concat(html.join(''), "\n                </select>\n                </td>\n                <td width=\"30px\">\n                    <div class=\"flex justify-center table-actions\">\n                        <a href=\"javascript:void(0)\" class=\"btn text-danger\" type=\"button\" onclick=\"perfil.deleteMenu(").concat(id_menu_perfil, ")\">\n                            <span class=\"glyphicon glyphicon-remove\"></span>\n                        </a>\n                    </div>\n                </td>\n            </tr>\n        ");
    }
  }]);

  return Perfil;
}();

var perfil = new Perfil();

var Plantilla = /*#__PURE__*/function () {
  function Plantilla() {
    _classCallCheck(this, Plantilla);
  }

  _createClass(Plantilla, [{
    key: "pdf",
    value: function pdf() {
      window.open('/plantillas/pdf');
    }
  }, {
    key: "excel",
    value: function excel() {
      window.open('/plantillas/excel');
    }
  }, {
    key: "openDelete",
    value: function openDelete(id) {
      $('#deleteModal').modal();
      $('#deleteValue').val(id);
    }
  }, {
    key: "upsert",
    value: function upsert(e) {
      e.preventDefault();
      e.stopPropagation();

      if (validateForm(e)) {
        var formData = new FormData(e.target);
        $.ajax({
          url: '/plantillas/upsert',
          data: new URLSearchParams(formData),
          success: function success(data) {
            if (data.plantillaExists) {
              $('#nombre_plantilla_documento').parent().addClass('has-error');
              var text = 'Ya existe un plantilla con este nombre';
              showErrorPopover($('#nombre_plantilla_documento'), text, 'top');
            } else if (data.saved) {
              alert('Se ha guardado satisfactoriamente!');
              $('.validate').removeClass('open');
              location.hash = 'plantillas/listar';
            }
          }
        });
      }

      return false;
    }
  }, {
    key: "delete",
    value: function _delete() {
      var id = $('#deleteValue').val();
      $.ajax({
        url: '/plantillas/delete/' + id,
        success: function success(_ref15) {
          var deleted = _ref15.deleted;

          if (deleted) {
            $('#tipoplantillaRow' + id).remove();
            $('#deleteModal').modal('hide');
          }
        }
      });
      return false;
    }
  }]);

  return Plantilla;
}();

var plantilla = new Plantilla();

var Proceso = /*#__PURE__*/function () {
  function Proceso() {
    _classCallCheck(this, Proceso);
  }

  _createClass(Proceso, [{
    key: "pdf",
    value: function pdf() {
      window.open('/proceso/pdf');
    }
  }, {
    key: "excel",
    value: function excel() {
      window.open('/proceso/excel');
    }
  }, {
    key: "openDelete",
    value: function openDelete(id) {
      $('#deleteModal').modal();
      $('#deleteValue').val(id);
    }
  }, {
    key: "formatTelefonoIntermediario",
    value: function formatTelefonoIntermediario(data) {
      var telefonoIntermediario = [];

      if (data.telefono_intermediario) {
        telefonoIntermediario.push(data.telefono_intermediario);
      }

      if (data.celular_intermediario) {
        telefonoIntermediario.push(data.celular_intermediario);
      }

      return telefonoIntermediario.join(' | ');
    }
  }, {
    key: "formatTelefonoBeneficiario",
    value: function formatTelefonoBeneficiario(data) {
      var telefonoBeneficiario = [];

      if (data.telefono_beneficiario) {
        telefonoBeneficiario.push(data.telefono_beneficiario);
      }

      if (data.celular_beneficiario) {
        telefonoBeneficiario.push(data.celular_beneficiario);
      }

      if (data.celular2_beneficiario) {
        telefonoBeneficiario.push(data.celular2_beneficiario);
      }

      return telefonoBeneficiario.join(' | ');
    }
  }, {
    key: "formatTelefonoCliente",
    value: function formatTelefonoCliente(data) {
      var telefonoCliente = [];

      if (data.telefono) {
        telefonoCliente.push(data.telefono);
      }

      if (data.celular) {
        telefonoCliente.push(data.celular);
      }

      if (data.celular2) {
        telefonoCliente.push(data.celular2);
      }

      return telefonoCliente.join(' | ');
    }
  }, {
    key: "changeTipoProceso",
    value: function changeTipoProceso(self) {
      var id = $(self).val();
      var params = {
        id_proceso: getId(),
        id_tipo_proceso: id
      };
      $.ajax({
        url: '/proceso/tipo-proceso/documentos',
        data: new URLSearchParams(params),
        success: function success(data) {
          if (!data.length) {
            $('#documentos-proceso-tab').hide();
            return;
          }

          var html = data.map(function (item) {
            return "\n                <div class=\"file-document\"\n                    data-filename=\"".concat(item.filename ? item.filename : '', "\"\n                    data-id=\"").concat(item.id_documento, "\"\n                    data-title=\"").concat(item.nombre_documento, "\"\n                    data-required=\"").concat(item.obligatoriedad_documento == 1 ? 'true' : 'false', "\">\n                </div>");
          });
          $('#documentos-proceso-tab').show();
          $('#documentos-requeridos').html(html);
          var id = getId();
          $('.file-document').fileDocument({
            url: 'proceso/upload',
            path: 'uploads/documentos',
            id: id
          });
        }
      });
    }
  }, {
    key: "changeDepartamento",
    value: function changeDepartamento(self) {
      var departamento = $(self).val();
      $.ajax({
        url: '/departamento/municipios/' + departamento,
        success: function success(data) {
          $('#id_municipio').val('');
          var html = data.map(function (item) {
            return "<option value=\"".concat(item.id_municipio, "\">").concat(item.nombre_municipio, "</option>");
          });
          $('#id_municipio').html(html).selectpicker('refresh');
        }
      });
    }
  }, {
    key: "upsert",
    value: function upsert(e) {
      e.preventDefault();
      e.stopPropagation();

      if (validateForm(e)) {
        var formData = new FormData(e.target);
        $.ajax({
          url: '/proceso/upsert',
          data: new URLSearchParams(formData),
          success: function success(data) {
            if (data.procesoExists) {
              $('#numero_proceso').parent().addClass('has-error');
              var text = 'Ya existe un proceso con este número';
              showErrorPopover($('#numero_proceso'), text, 'top');
            } else if (data.folderExists) {
              $('#id_carpeta').parent().addClass('has-error');
              var _text2 = 'Ya existe un proceso con esta identificación';
              showErrorPopover($('#id_carpeta'), _text2, 'top');
            } else if (data.saved) {
              alert('Se ha guardado satisfactoriamente!');
              $('.autosave').autosaveRemove();
              $('.validate').removeClass('open');
              location.hash = 'proceso/listar';
            }
          }
        });
      }

      return false;
    }
  }, {
    key: "changeCliente",
    value: function changeCliente(self) {
      var _this13 = this;

      var id = $(self).val();
      $.ajax({
        url: '/cliente/basic/' + id,
        success: function success(cliente) {
          $('#documento_cliente').val(cliente.numero_documento);
          $('#telefono_cliente').val(_this13.formatTelefonoCliente(cliente));
          $('#indicativo_cliente').text('+' + cliente.indicativo);
          $('#nombre_intermediario').val((cliente.intermediario_p_apellido || '') + ' ' + (cliente.intermediario_s_apellido || '') + ' ' + (cliente.intermediario_p_nombre || '') + ' ' + (cliente.intermediario_s_nombre || ''));
          $('#nombre_beneficiario').val(cliente.nombre_beneficiario);
          $('#indicativo_beneficiario').val(cliente.indicativo_beneficiario);
          $('#telefono_beneficiario').val(_this13.formatTelefonoBeneficiario(cliente));
          $('#email_beneficiario').val(cliente.correo_electronico_beneficiario);
          $('#email_cliente').val(cliente.correo_electronico_cliente);
          $('#estado_vital_cliente').val(cliente.estado_vital_cliente == 1 ? 'vivo' : 'fallecido');
          $('#telefono_intermediario').val(_this13.formatTelefonoIntermediario(cliente));
          $('#indicativo_intermediario').val(cliente.indicativo_intermediario);
          $('#email_intermediario').val(cliente.correo_electronico_intermediario);
          $('#id_municipio_cliente').val(cliente.nombre_municipio_cliente);
          $('#id_departamento_cliente').val(cliente.nombre_departamento_cliente);
          $('#id_pais_cliente').val(cliente.nombre_pais_cliente);
        }
      });
    }
  }, {
    key: "delete",
    value: function _delete() {
      var id = $('#deleteValue').val();
      $.ajax({
        url: '/proceso/delete/' + id,
        success: function success(_ref16) {
          var deleted = _ref16.deleted;

          if (deleted) {
            $('#tipoProcesoRow' + id).remove();
            $('#deleteModal').modal('hide');
          }
        }
      });
      return false;
    }
  }, {
    key: "openComments",
    value: function openComments(id) {
      $.ajax({
        url: '/seguimiento-procesos/comentarios/' + id,
        beforeSend: function beforeSend() {
          return $('#comentariosTable tbody').html('');
        },
        success: function success(data) {
          if (data.length) {
            var html = data.map(function (item) {
              return "\n                        <tr>\n                            <td>".concat(item.fechaCreacion, "</td>\n                            <td>").concat(item.nombreUsuario, "</td>\n                            <td>").concat(item.comentario, "</td>\n                        </tr>\n                    ");
            });
            $('#comentariosTable tbody').html(html);
            $('#comentariosModalTitle').text('Comentarios proceso n° ' + data[0].numero_proceso);
          }

          $('#comentariosTable').footable();
          $('#comentariosModal').modal();
        }
      });
    }
  }]);

  return Proceso;
}();

var proceso = new Proceso();

var GestionProcesosActivos = /*#__PURE__*/function () {
  function GestionProcesosActivos() {
    _classCallCheck(this, GestionProcesosActivos);
  }

  _createClass(GestionProcesosActivos, [{
    key: "generatePDF",
    value: function generatePDF(e) {
      if (validateForm(e)) {
        var formData = new FormData(e.target);
        $.ajax({
          url: '/gestion-procesos-activos/pdf',
          data: new URLSearchParams(formData),
          success: function success(data) {
            console.log('data', data);
          }
        });
      }
    }
  }, {
    key: "generateExcel",
    value: function generateExcel(e) {
      if (validateForm(e)) {
        var formData = new FormData(e.target);
        $.ajax({
          url: '/gestion-procesos-activos/excel',
          data: new URLSearchParams(formData),
          success: function success(data) {
            console.log('data', data);
          }
        });
      }
    }
  }]);

  return GestionProcesosActivos;
}();

var gestionProcesosActivos = new GestionProcesosActivos();

var SeguimientoActuacion = /*#__PURE__*/function () {
  function SeguimientoActuacion() {
    _classCallCheck(this, SeguimientoActuacion);
  }

  _createClass(SeguimientoActuacion, [{
    key: "openTemplateModal",
    value: function openTemplateModal() {
      var id = arguments.length > 0 && arguments[0] !== undefined ? arguments[0] : 0;
      $('#plantillasModal').modal();
    }
  }, {
    key: "closeTemplateModal",
    value: function closeTemplateModal() {
      $('#plantillasModal').modal('hide');
    }
  }, {
    key: "finalizarActuacion",
    value: function finalizarActuacion(e) {
      e.preventDefault();
      e.stopPropagation();

      if (validateForm(e)) {
        var hasFinalizarProceso = $('#finalizar_proceso').length;

        if (hasFinalizarProceso) {
          $('#formularioActuacion').append("<input type=\"hidden\" name=\"finalizar_proceso\" value=\"1\" />").trigger('submit');
        }

        var etapa = $('#siguienteEtapaActuacion').val();

        var _actuacion2 = $('#siguienteActuacion').val();

        var _usuario = $('#usuarioSiguienteActuacion').val();

        $('#formularioActuacion').append("<input type=\"hidden\" name=\"id_siguiente_etapa_actuacion\" id=\"id_siguiente_etapa_actuacion\" value=\"".concat(etapa, "\" />")).append("<input type=\"hidden\" name=\"id_siguiente_actuacion\" id=\"id_siguiente_actuacion\" value=\"".concat(_actuacion2, "\" />")).append("<input type=\"hidden\" name=\"id_usuario_siguiente_actuacion\" id=\"id_usuario_siguiente_actuacion\" value=\"".concat(_usuario, "\" />")).trigger('submit');
      }

      return false;
    }
  }, {
    key: "guardarActuacion",
    value: function guardarActuacion(e) {
      e.preventDefault();
      e.stopPropagation();

      if (validateForm(e)) {
        var $reqDocuments = $('.file-document[data-required=true]').toArray();
        var allDocs = $reqDocuments.every(function (item) {
          return $(item).data('filename');
        });
        var $fieldList = $(e.target).find('input.form-control, select.form-control, textarea.form-control').toArray();
        var allSaved = $fieldList.every(function (item) {
          return $(item).attr('disabled') || $(item).val().trim() || $(item).attr('type') == 'search';
        });
        var idProcesoEtapaActuacion = $('#id_proceso_etapa_actuacion').val();
        var finalizado = $('#finalizado').val() == 1;
        var valorPago = $('#valor_pago').val();
        var valorPagoExists = $('#valor_pago').length > 0;
        var valorPagoPass = valorPago === 'No genera cobro' || parseInt(valorPago) > 0;
        var allFields = allDocs && allSaved && !finalizado && valorPagoExists && valorPagoPass && idProcesoEtapaActuacion != '';

        if (allFields) {
          var siguienteEtapaActuacion = $('#id_siguiente_etapa_actuacion').val();
          var siguienteActuacion = $('#id_siguiente_actuacion').val();
          var usuarioSiguienteActuacion = $('#id_usuario_siguiente_actuacion').val();

          if (valorPagoExists && valorPagoPass && (!siguienteActuacion || !usuarioSiguienteActuacion || !siguienteEtapaActuacion)) {
            $('#cerrarActuacion').modal();
            return false;
          }
        }

        var params = [];
        params.push({
          name: 'all_fields',
          value: allFields
        });
        this.upsert(e, params);
      }

      return false;
    }
  }, {
    key: "upsert",
    value: function upsert(e, params) {
      var formData = new FormData(e.target);
      params.map(function (_ref17) {
        var name = _ref17.name,
            value = _ref17.value;
        formData.append(name, value);
      });
      $.ajax({
        url: '/seguimiento-procesos/actuacion/upsert',
        data: new URLSearchParams(formData),
        success: function success(data) {
          $('#cerrarActuacion').modal('hide');
          setTimeout(function () {
            alert('Se ha guardado satisfactoriamente!');
            $('.validate').removeClass('open');
            location.hash = 'seguimiento-procesos/' + $('#id_proceso').val();
          }, 1000);
        }
      });
    }
  }, {
    key: "deletePlantilla",
    value: function deletePlantilla(id) {
      $.ajax({
        url: '/seguimiento-procesos/actuacion/plantilla/delete/' + id,
        success: function success(_ref18) {
          var deleted = _ref18.deleted,
              data = _ref18.data;

          if (deleted) {
            $('#plantillaDocumento').append("<option value=\"".concat(data.plantilla_documento.id_plantilla_documento, "\">").concat(data.plantilla_documento.nombre_plantilla_documento, "</option>")).selectpicker('refresh');
            $("#documentos-generados .file-document[data-id=".concat(data.id_proceso_etapa_actuacion_plantillas, "]")).remove();

            if (!$('#documentos-generados .file-document').length) {
              $('#documentos-generados').append("<div class=\"file-document-empty\">No se han agregado documentos</div>");
            }
          }
        }
      });
    }
  }, {
    key: "savePlantilla",
    value: function savePlantilla(e) {
      e.preventDefault();
      e.stopPropagation();
      var formData = new FormData(e.target);
      formData.append('id_proceso', $('#id_proceso').val());
      formData.append('id_proceso_etapa', $('#id_proceso_etapa').val());
      formData.append('id_proceso_etapa_actuacion', $('#id_proceso_etapa_actuacion').val());
      $.ajax({
        url: '/seguimiento-procesos/actuacion/plantilla/upsert',
        data: new URLSearchParams(formData),
        success: function success(_ref19) {
          var saved = _ref19.saved,
              url = _ref19.url;

          if (saved) {
            var value = $('#plantillaDocumento').val();
            $("#plantillaDocumento option[value=".concat(value, "]")).remove();
            $('#plantillaDocumento').selectpicker('refresh');
            var html = "<div class=\"file-document\" data-title=\"".concat(saved.plantilla_documento.nombre_plantilla_documento, "\"\n                    data-remove=\"seguimientoActuacion.deletePlantilla('").concat(saved.id_proceso_etapa_actuacion_plantillas, "')\"\n                    data-id=\"").concat(saved.id_proceso_etapa_actuacion_plantillas, "\"\n                    data-filename=\"").concat(url, "\"></div>");
            $('#documentos-generados').append(html);
            $('#documentos-generados .file-document-empty').remove();
            var id = getId();
            $('.file-document').fileDocument({
              url: 'proceso/upload',
              path: 'uploads/documentos',
              id: id
            });
          }
        }
      });
      return false;
    }
  }, {
    key: "refreshActuaciones",
    value: function refreshActuaciones(self) {
      var id_etapa_proceso = $(self).val();

      if (id_etapa_proceso) {
        $.ajax({
          url: '/seguimiento-procesos/etapa/actuaciones/' + id_etapa_proceso,
          data: new URLSearchParams({
            id_actuacion: $('#id_actuacion').val(),
            id_proceso_etapa: $('#id_proceso_etapa').val(),
            id_proceso: $('#id_proceso').val(),
            id_etapa_proceso: id_etapa_proceso
          }),
          success: function success(data) {
            var html = data.map(function (item) {
              return "<option value=\"".concat(item.id_actuacion, "\">").concat(item.nombre_actuacion, "</option>");
            });
            $('#siguienteActuacion').html(html);

            if (data.length) {
              $('#siguienteActuacion').val(data[0].id_actuacion);
            }

            $('#siguienteActuacion').selectpicker('refresh');
          }
        });
      } else {
        $('#siguienteActuacion').html('').selectpicker('refresh');
      }
    }
  }]);

  return SeguimientoActuacion;
}();

var seguimientoActuacion = new SeguimientoActuacion();

var SeguimientoProceso = /*#__PURE__*/function () {
  function SeguimientoProceso() {
    _classCallCheck(this, SeguimientoProceso);
  }

  _createClass(SeguimientoProceso, [{
    key: "addActuacion",
    value: function addActuacion(id_etapa_proceso) {
      $('#actuacionModal').modal();
      $('#idEtapaProceso').val(id_etapa_proceso);
      $('#nombre_actuacion').val('');
      $('#etapaPrimeraActuacion').prop('checked', false).change();
      $('#orderActuacion').val(1);
      $('#tiempoMaximoProximaActuacion').val('');
      $('#UnidadTiempoProximaActuacion').val(1).selectpicker('refresh');
      $('#agregarActuacionDespuesDe').show().val('').addClass('required').selectpicker('refresh');
      $.ajax({
        url: '/seguimiento-procesos/etapas-de-proceso/actuacion/all/' + id_etapa_proceso,
        success: function success(actuaciones) {
          if (actuaciones.length) {
            var html = actuaciones.map(function (actuacion) {
              return "<option value=\"".concat(actuacion.id_actuacion, "\">").concat(actuacion.nombre_actuacion, "</option>");
            });
            $('#actuacionesAfterList').addClass('required').html(html).parents('.form-group').show();
          } else {
            $('#actuacionesAfterList').removeClass('required').html('').parents('.form-group').hide();
          }

          $('#actuacionesAfterList').val('').selectpicker('refresh');
          $('#orderActuacion').val(actuaciones.length + 1);
        }
      });
      $.ajax({
        url: '/seguimiento-procesos/etapas-de-proceso/get/' + id_etapa_proceso,
        success: function success(_ref20) {
          var actuaciones = _ref20.actuaciones;
          var html = actuaciones.map(function (data) {
            return "<option value=\"".concat(data.id_actuacion, "\">").concat(data.nombre_actuacion, "</option>");
          });
          $('#actuacionesList').html(html).val('').selectpicker('refresh');
        }
      });
    }
  }, {
    key: "saveActuacion",
    value: function saveActuacion(e) {
      e.preventDefault();
      e.stopPropagation();

      if (validateForm(e)) {
        var formData = new FormData(e.target);
        $.ajax({
          url: '/seguimiento-procesos/etapas-de-proceso/actuacion/insert',
          data: new URLSearchParams(formData),
          success: function success(data) {
            location.reload();
          }
        });
      }

      return false;
    }
  }, {
    key: "changeEtapa",
    value: function changeEtapa(self) {
      var $self = $(self);
      var procesoetapa = $self.data('procesoetapa');
      var id = $self.data('id');

      if (!procesoetapa) {
        var params = new FormData();
        params.append('id_etapa_proceso', id);
        params.append('id_proceso', getId());
        $.ajax({
          url: '/seguimiento-procesos/set-etapa',
          data: new URLSearchParams(params),
          success: function success(data) {
            $self.data('procesoetapa', data.id_proceso_etapa);
            $list = $('#etapa-' + data.id_etapa_proceso + ' table .seguimiento-sin-url');
            $list.toArray().map(function (item) {
              var idActuacion = $(item).data('actuacion');
              $(item).attr('href', "#seguimiento-procesos/actuacion/crear/".concat(data.id_proceso_etapa, "/").concat(idActuacion));
            });
            $list.removeClass('seguimiento-sin-url');
          }
        });
      }
    }
  }, {
    key: "addComentarioModal",
    value: function addComentarioModal(id) {
      $('#comentariosModal').addClass('open').modal();
      $('#idProcesoBitacora').val(id || '');
      $('#comentarioProceso').val('');
      $.ajax({
        url: '/seguimiento-procesos/comentario/get/' + id,
        success: function success(data) {
          $('#comentarioProceso').val(data.comentario);
        }
      });
    }
  }, {
    key: "closeComentarioModal",
    value: function closeComentarioModal() {
      $('#comentariosModal').removeClass('open').modal('hide');
    }
  }, {
    key: "closeActuacionModal",
    value: function closeActuacionModal() {
      $('#actuacionModal').modal('hide');
    }
  }, {
    key: "openDeleteComentario",
    value: function openDeleteComentario(id) {
      $('#deleteModal').modal();
      $('#deleteValue').val(id);
    }
  }, {
    key: "deleteComentario",
    value: function deleteComentario() {
      var id = $('#deleteValue').val();
      $.ajax({
        url: '/seguimiento-procesos/comentario/delete/' + id,
        success: function success(_ref21) {
          var deleted = _ref21.deleted;

          if (deleted) {
            $('#comentarioRow' + id).remove();
          }
        }
      });
      $('#deleteModal').modal('hide');
    }
  }, {
    key: "saveComentario",
    value: function saveComentario(e) {
      var _this14 = this;

      e.preventDefault();
      e.stopPropagation();
      var formData = new FormData(e.target);
      formData.append('id_proceso', getId());
      $.ajax({
        url: '/seguimiento-procesos/comentario/upsert',
        data: new URLSearchParams(formData),
        success: function success(_ref22) {
          var saved = _ref22.saved;

          if (saved) {
            var $table = $('#comentariosTable');
            var $row = $('#comentarioRow' + saved.id_proceso_bitacora);
            var html = "\n                        <tr id=\"comentarioRow".concat(saved.id_proceso_bitacora, "\">\n                            <td>").concat(saved.fechaCreacion, "</td>\n                            <td>").concat(saved.nombreUsuario, "</td>\n                            <td>").concat(saved.comentario, "</td>\n                            <td>\n                            <div class=\"flex justify-center table-actions\">\n                                <a onClick=\"seguimientoProceso.addComentarioModal('").concat(saved.id_proceso_bitacora, "')\" class=\"btn text-primary\" type=\"button\">\n                                    <span class=\"glyphicon glyphicon-pencil\"></span>\n                                </a>\n                                <a onclick=\"seguimientoProceso.openDeleteComentario('").concat(saved.id_proceso_bitacora, "')\" href=\"javascript:void(0)\" class=\"btn text-danger\" type=\"button\">\n                                    <span class=\"glyphicon glyphicon-remove\"></span>\n                                </a>\n                            </div>\n                            </td>\n                        </tr>\n                    ");
            $table.find('.footable-empty').remove();

            if ($row.length) {
              $row.replaceWith(html);
            } else {
              $table.find('tbody').prepend(html);
            }

            $table.footable();
          }

          _this14.closeComentarioModal();
        }
      });
      return false;
    }
  }]);

  return SeguimientoProceso;
}();

var seguimientoProceso = new SeguimientoProceso();

var TipoProceso = /*#__PURE__*/function () {
  function TipoProceso() {
    _classCallCheck(this, TipoProceso);
  }

  _createClass(TipoProceso, [{
    key: "pdf",
    value: function pdf() {
      window.open('/tipos-de-proceso/pdf');
    }
  }, {
    key: "excel",
    value: function excel() {
      window.open('/tipos-de-proceso/excel');
    }
  }, {
    key: "createEtapaOpen",
    value: function createEtapaOpen() {
      $('#tipoProcesoEtapaPopover').popover('show');
    }
  }, {
    key: "popoverClose",
    value: function popoverClose() {
      $('#tipoProcesoEtapaPopover').popover('hide');
    }
  }, {
    key: "createEtapa",
    value: function createEtapa() {
      var _this15 = this;

      var nombre_etapa_proceso = $('#etapaProcesoNombre').val().trim();

      if (nombre_etapa_proceso) {
        var data = {
          nombre_etapa_proceso: nombre_etapa_proceso,
          estado: 1
        };
        $.ajax({
          url: '/etapas-de-proceso/upsert',
          data: new URLSearchParams(data),
          success: function success(data) {
            var id = $('#createValue').val() || 0;

            _this15.renderModalData(id);

            $('#tipoProcesoEtapaPopover').popover('hide');
          }
        });
      }
    }
  }, {
    key: "sortableStart",
    value: function sortableStart(_, ui) {
      $(ui.item).find('.footable-last-visible a').hide();
    }
  }, {
    key: "sortableStop",
    value: function sortableStop(_, ui) {
      $(ui.item).find('.footable-last-visible a').show();
    }
  }, {
    key: "sortableUpdate",
    value: function sortableUpdate(event, _) {
      var $rowList = $(event.target).children('tr') || [];
      var orderedList = [];

      var _iterator2 = _createForOfIteratorHelper($rowList),
          _step2;

      try {
        for (_iterator2.s(); !(_step2 = _iterator2.n()).done;) {
          item = _step2.value;
          orderedList.push($(item).data('id'));
        }
      } catch (err) {
        _iterator2.e(err);
      } finally {
        _iterator2.f();
      }

      var params = {
        orderedList: orderedList,
        id_tipo_proceso: $('#createValue').val() || 0
      };
      $.ajax({
        url: '/tipos-de-proceso/etapa/update',
        data: new URLSearchParams(params),
        success: function success(data) {
          console.log(data);
        }
      });
    }
  }, {
    key: "closeCreateModal",
    value: function closeCreateModal() {
      $('#createModal').removeClass('open').modal('hide');
    }
  }, {
    key: "renderModalData",
    value: function renderModalData() {
      var _this16 = this;

      var id = arguments.length > 0 && arguments[0] !== undefined ? arguments[0] : 0;
      return $.ajax({
        url: '/tipos-de-proceso/get/' + id,
        success: function success(data) {
          var htmlListaEtapas = data.etapas.map(function (etapa) {
            return "<option value=\"".concat(etapa.id_etapa_proceso, "\">").concat(etapa.nombre_etapa_proceso, "</option>");
          });
          $('#listaEtapa').html(htmlListaEtapas.join('')).selectpicker('refresh'); //addRow

          var htmlSelectedEtapas = data.selectedEtapas.map(function (e) {
            return _this16.addRow(e.id_etapa_proceso, e.nombre_etapa_proceso);
          });
          $('#tableCreateModal tbody').html(htmlSelectedEtapas.join(''));
          $('#tableCreateModal').footable();
          $("#sortable").sortable({
            start: _this16.sortableStart,
            stop: _this16.sortableStop,
            update: _this16.sortableUpdate
          }).disableSelection();
          return data;
        }
      });
    }
  }, {
    key: "addEtapa",
    value: function addEtapa(self) {
      var _this17 = this;

      var id_etapa_proceso = $(self).val();
      var id_tipo_proceso = $('#createValue').val() || 0;

      if (!id_etapa_proceso) {
        return false;
      }

      $.ajax({
        url: '/tipos-de-proceso/etapa/insert',
        data: new URLSearchParams({
          id_etapa_proceso: id_etapa_proceso,
          id_tipo_proceso: id_tipo_proceso
        }),
        success: function success() {
          _this17.renderModalData(id_tipo_proceso);
        }
      });
    }
  }, {
    key: "createEditModal",
    value: function createEditModal() {
      var id = arguments.length > 0 && arguments[0] !== undefined ? arguments[0] : 0;
      $('#createModal').addClass('open').modal();
      $('#createValue').val(id);
      var title = id ? 'Editar tipo de proceso' : 'Nuevo tipo de proceso';
      $('#createTitle').text(title);
      $('#tipoNombre').val('');
      this.renderModalData(id).then(function (_ref23) {
        var tipoProceso = _ref23.tipoProceso;

        if (tipoProceso) {
          $('#tipoNombre').val(tipoProceso.nombre_tipo_proceso);
          $('#tipoEstado').prop('checked', tipoProceso.estado_tipo_proceso == 1).change();
        }
      });
    }
  }, {
    key: "openDelete",
    value: function openDelete(id) {
      $('#deleteModal').modal();
      $('#deleteValue').val(id);
    }
  }, {
    key: "upsert",
    value: function upsert(e) {
      e.preventDefault();
      e.stopPropagation();

      if (validateForm(e)) {
        var id = $('#createValue').val();
        var formData = new FormData(e.target);
        id && formData.append('id_tipo_proceso', id);
        $.ajax({
          url: '/tipos-de-proceso/upsert',
          data: new URLSearchParams(formData),
          success: function success(data) {
            if (data.saved) {
              alert('Se ha guardado satisfactoriamente!');
              $('#createModal').removeClass('open').modal('hide');
              location.reload();
            } else if (data.exists) {
              $('#etapaNombre').parent().addClass('has-error');
            }
          }
        });
      }

      return false;
    }
  }, {
    key: "delete",
    value: function _delete() {
      var id = $('#deleteValue').val();
      $.ajax({
        url: '/tipos-de-proceso/delete/' + id,
        data: {},
        success: function success() {
          location.reload();
        }
      });
    }
  }, {
    key: "deleteEtapa",
    value: function deleteEtapa(id) {
      var _this18 = this;

      var id_tipo_proceso = $('#createValue').val() || 0;
      var params = {
        id_etapa_proceso: id,
        id_tipo_proceso: id_tipo_proceso
      };
      $.ajax({
        url: '/tipos-de-proceso/etapa/delete',
        data: new URLSearchParams(params),
        success: function success(data) {
          _this18.renderModalData(id_tipo_proceso);
        }
      });
    }
  }, {
    key: "addRow",
    value: function addRow(id_etapa_proceso, nombre_etapa_proceso) {
      //
      return "\n            <tr data-id=\"".concat(id_etapa_proceso, "\" class=\"ui-state-default\" style=\"cursor:move\">\n                <td>").concat(nombre_etapa_proceso, "</td>\n                <td width=\"30px\" class=\"sortable-column-delete\" >\n                    <div class=\"flex justify-center table-actions\">\n                        <a class=\"text-danger\" href=\"javascript:void(0)\" class=\"btn text-danger\" type=\"button\"\n                            onclick=\"tipoProceso.deleteEtapa(").concat(id_etapa_proceso, ")\">\n                            <span class=\"glyphicon glyphicon-remove\"></span>\n                        </a>\n                    </div>\n                </td>\n            </tr>\n        ");
    }
  }]);

  return TipoProceso;
}();

var tipoProceso = new TipoProceso();

var TipoResultado = /*#__PURE__*/function () {
  function TipoResultado() {
    _classCallCheck(this, TipoResultado);
  }

  _createClass(TipoResultado, [{
    key: "pdf",
    value: function pdf() {
      window.open('/tipos-de-resultado/pdf');
    }
  }, {
    key: "excel",
    value: function excel() {
      window.open('/tipos-de-resultado/excel');
    }
  }, {
    key: "createEtapaOpen",
    value: function createEtapaOpen() {
      $('#tipoProcesoEtapaPopover').popover('show');
    }
  }, {
    key: "popoverClose",
    value: function popoverClose() {
      $('#tipoProcesoEtapaPopover').popover('hide');
    }
  }, {
    key: "createEtapa",
    value: function createEtapa() {
      var _this19 = this;

      var nombre_etapa_proceso = $('#etapaProcesoNombre').val().trim();

      if (nombre_etapa_proceso) {
        var data = {
          nombre_etapa_proceso: nombre_etapa_proceso,
          estado: 1
        };
        $.ajax({
          url: '/tipos-de-resultado/upsert',
          data: new URLSearchParams(data),
          success: function success(data) {
            var id = $('#createValue').val() || 0;

            _this19.renderModalData(id);

            $('#tipoProcesoEtapaPopover').popover('hide');
          }
        });
      }
    }
  }, {
    key: "sortableStart",
    value: function sortableStart(_, ui) {
      $(ui.item).find('.footable-last-visible a').hide();
    }
  }, {
    key: "sortableStop",
    value: function sortableStop(_, ui) {
      $(ui.item).find('.footable-last-visible a').show();
    }
  }, {
    key: "sortableUpdate",
    value: function sortableUpdate(event, _) {
      var $rowList = $(event.target).children('tr') || [];
      var orderedList = [];

      var _iterator3 = _createForOfIteratorHelper($rowList),
          _step3;

      try {
        for (_iterator3.s(); !(_step3 = _iterator3.n()).done;) {
          item = _step3.value;
          orderedList.push($(item).data('id'));
        }
      } catch (err) {
        _iterator3.e(err);
      } finally {
        _iterator3.f();
      }

      var params = {
        orderedList: orderedList,
        id_tipo_proceso: $('#createValue').val() || 0
      };
      $.ajax({
        url: '/tipos-de-resultado/etapa/update',
        data: new URLSearchParams(params),
        success: function success(data) {
          console.log(data);
        }
      });
    }
  }, {
    key: "renderModalData",
    value: function renderModalData() {
      var id = arguments.length > 0 && arguments[0] !== undefined ? arguments[0] : 0;
      return $.ajax({
        url: '/tipos-de-resultado/get/' + id,
        success: function success(data) {
          return data;
        }
      });
    }
  }, {
    key: "closeCreateModal",
    value: function closeCreateModal() {
      $('#createModal').removeClass('open').modal('hide');
    }
  }, {
    key: "createEditModal",
    value: function createEditModal() {
      var id = arguments.length > 0 && arguments[0] !== undefined ? arguments[0] : 0;
      $('#createModal').addClass('open').modal();
      $('#createValue').val(id);
      var title = id ? 'Editar tipo de resultado' : 'Nuevo tipo de resultado';
      $('#createTitle').text(title);
      $('#tipoNombre').val('');
      this.renderModalData(id).then(function (_ref24) {
        var tipoResultado = _ref24.tipoResultado;

        if (tipoResultado) {
          $('#tipoNombre').val(tipoResultado.nombre_tipo_resultado);
          $('#tipoCampo').val(tipoResultado.tipo_campo).selectpicker('refresh');
          $('#tipoEstado').prop('checked', tipoResultado.unico_tipo_resultado == 1).change();
        }
      });
    }
  }, {
    key: "openDelete",
    value: function openDelete(id) {
      $('#deleteModal').modal();
      $('#deleteValue').val(id);
    }
  }, {
    key: "upsert",
    value: function upsert(e) {
      e.preventDefault();
      e.stopPropagation();

      if (validateForm(e)) {
        var id = $('#createValue').val();
        var formData = new FormData(e.target);
        id && formData.append('id_tipo_resultado', id);
        $.ajax({
          url: '/tipos-de-resultado/upsert',
          data: new URLSearchParams(formData),
          success: function success(data) {
            if (data.saved) {
              alert('Se ha guardado satisfactoriamente!');
              $('#createModal').removeClass('open').modal('hide');
              location.hash = "#tipos-de-resultado";
              location.reload();
            } else if (data.exists) {
              $('#etapaNombre').parent().addClass('has-error');
            }
          }
        });
      }

      return false;
    }
  }, {
    key: "delete",
    value: function _delete() {
      var id = $('#deleteValue').val();
      $.ajax({
        url: '/tipos-de-resultado/delete/' + id,
        data: {},
        success: function success() {
          location.hash = "#tipos-de-resultado";
          location.reload();
        }
      });
    }
  }, {
    key: "deleteEtapa",
    value: function deleteEtapa(id) {
      var _this20 = this;

      var id_tipo_proceso = $('#createValue').val() || 0;
      var params = {
        id_etapa_proceso: id,
        id_tipo_proceso: id_tipo_proceso
      };
      $.ajax({
        url: '/tipos-de-resultado/etapa/delete',
        data: new URLSearchParams(params),
        success: function success(data) {
          _this20.renderModalData(id_tipo_proceso);
        }
      });
    }
  }, {
    key: "addRow",
    value: function addRow(id_etapa_proceso, nombre_etapa_proceso) {
      //
      return "\n            <tr data-id=\"".concat(id_etapa_proceso, "\" class=\"ui-state-default\" style=\"cursor:move\">\n                <td>").concat(nombre_etapa_proceso, "</td>\n                <td width=\"30px\" class=\"sortable-column-delete\" >\n                    <div class=\"flex justify-center table-actions\">\n                        <a class=\"text-danger\" href=\"javascript:void(0)\" class=\"btn text-danger\" type=\"button\"\n                            onclick=\"tipoProceso.deleteEtapa(").concat(id_etapa_proceso, ")\">\n                            <span class=\"glyphicon glyphicon-remove\"></span>\n                        </a>\n                    </div>\n                </td>\n            </tr>\n        ");
    }
  }]);

  return TipoResultado;
}();

var tipoResultado = new TipoResultado();

var Usuario = /*#__PURE__*/function () {
  function Usuario() {
    _classCallCheck(this, Usuario);
  }

  _createClass(Usuario, [{
    key: "pdf",
    value: function pdf() {
      window.open('/usuario/pdf');
    }
  }, {
    key: "excel",
    value: function excel() {
      window.open('/usuario/excel');
    }
  }, {
    key: "changeMunicipio",
    value: function changeMunicipio(self) {
      var municipio = $(self).val();
      $.ajax({
        url: '/usuario/municipio/' + municipio,
        success: function success(data) {
          if (data.indicativo) {
            $('#indicativo').show().text('+' + data.indicativo);
          } else {
            $('#indicativo').hide();
          }
        }
      });
    }
  }, {
    key: "closeCreateModal",
    value: function closeCreateModal() {
      $('#createModal').removeClass('open').modal('hide');
    }
  }, {
    key: "createEditModal",
    value: function createEditModal(id) {
      var title = id ? 'Editar usuario' : 'Crear usuario';
      $('#createModal').modal();
      $('#createModal').addClass('open');
      $('#createValue').val(id);
      $('#createTitle').text(title);
      $('#tipoDocumento').val(1).selectpicker('refresh');
      $('#municipio').val(1).selectpicker('refresh');
      $('#numeroDocumento').val('');
      $('#id_perfil').val('').selectpicker('refresh');
      $('#primerApellido').val('');
      $('#segundoApellido').val('');
      $('#password').val('');
      $('#primerNombre').val('');
      $('#segundoNombre').val('');
      $('#telefono').val('');
      $('#correoElectronico').val('');
      $('#etapaEstado').prop('checked', true).change();
      $('#nombre_usuario').val('');
      $('#direccion').val('');
      $('#id_area').val('').selectpicker('refresh');
      $('#indicativo').show().text('+1');

      if (id) {
        $.ajax({
          url: '/usuario/get/' + id,
          success: function success(_ref25) {
            var usuario = _ref25.usuario;
            $('#tipoDocumento').val(usuario.id_tipo_documento).selectpicker('refresh');
            $('#numeroDocumento').val(usuario.numero_documento);
            $('#primerApellido').val(usuario.primer_apellido);
            $('#segundoApellido').val(usuario.segundo_apellido);
            $('#primerNombre').val(usuario.primer_nombre);
            $('#segundoNombre').val(usuario.segundo_nombre);
            $('#telefono').val(usuario.telefono);
            $('#nombre_usuario').val(usuario.nombre_usuario);
            $('#direccion').val(usuario.direccion);
            $('#municipio').val(usuario.id_municipio).selectpicker('refresh');
            $('#correoElectronico').val(usuario.correo_electronico);
            $('#etapaEstado').prop('checked', usuario.estado_usuario == 1).change();
            $('#id_perfil').val(usuario.id_perfil).selectpicker('refresh');
            $('#id_area').val(usuario.id_area).selectpicker('refresh');

            if (usuario.indicativo) {
              $('#indicativo').text('+' + usuario.indicativo);
            } else {
              $('#indicativo').hide();
            }

            if (!$('.input-firma img').length) {
              $('.input-firma').append('<img src="" />');
            }

            $('.input-firma img').attr('src', "/uploads/firmas/".concat(usuario.id_usuario, ".png"));
          }
        });
      }
    }
  }, {
    key: "upsert",
    value: function upsert(e) {
      e.preventDefault();
      e.stopPropagation();

      if (validateForm(e)) {
        var id = $('#createValue').val();
        var formData = new FormData(e.target);
        id && formData.append('id_usuario', id); // const firma = $('#firma');
        // firma && formData.append('firma', firma[0].files[0])

        $.ajax({
          url: '/usuario/upsert',
          data: formData,
          contentType: false,
          processData: false,
          success: function success(data) {
            if (data.saved) {
              $('#createModal').removeClass('open');
              location.reload();
            } else if (data.documentExists || data.invalidDocument) {
              $('#numeroDocumento').parent().addClass('has-error');
              var text = data.documentExists ? 'El número de documento ya existe' : 'Documento inválido';
              showErrorPopover($('#numeroDocumento'), text, 'top');
            } else if (data.invalidPassword) {
              $('#password').parent().addClass('has-error');
              var _text3 = 'La contraseña debe tener al menos 6 caracteres';
              showErrorPopover($('#password'), _text3, 'top');
            } else if (data.userExists) {
              $('#nombre_usuario').parent().addClass('has-error');
              var _text4 = 'El nombre de usuario ya existe';
              showErrorPopover($('#nombre_usuario'), _text4, 'top');
            }
          }
        });
      }

      return false;
    }
  }, {
    key: "openDelete",
    value: function openDelete(id) {
      $('#deleteModal').modal();
      $('#deleteValue').val(id);
    }
  }, {
    key: "delete",
    value: function _delete() {
      var id = $('#deleteValue').val();
      $.ajax({
        url: '/usuario/delete/' + id,
        data: {},
        success: function success() {
          location.reload();
        }
      });
    }
  }]);

  return Usuario;
}();

var usuario = new Usuario();
