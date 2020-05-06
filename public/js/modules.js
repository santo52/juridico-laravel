function _createForOfIteratorHelper(o) { if (typeof Symbol === "undefined" || o[Symbol.iterator] == null) { if (Array.isArray(o) || (o = _unsupportedIterableToArray(o))) { var i = 0; var F = function F() {}; return { s: F, n: function n() { if (i >= o.length) return { done: true }; return { done: false, value: o[i++] }; }, e: function e(_e) { throw _e; }, f: F }; } throw new TypeError("Invalid attempt to iterate non-iterable instance.\nIn order to be iterable, non-array objects must have a [Symbol.iterator]() method."); } var it, normalCompletion = true, didErr = false, err; return { s: function s() { it = o[Symbol.iterator](); }, n: function n() { var step = it.next(); normalCompletion = step.done; return step; }, e: function e(_e2) { didErr = true; err = _e2; }, f: function f() { try { if (!normalCompletion && it["return"] != null) it["return"](); } finally { if (didErr) throw err; } } }; }

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

        if (!documents.length || !templates.length) {
          this.alert(documents.length, templates.length);
          return false;
        }

        formData.append('documents', documents);
        formData.append('templates', templates);
        $.ajax({
          url: url,
          data: new URLSearchParams(formData),
          success: function success(data) {
            if (data.exists) {
              showErrorPopover($('#nombreActuacion'), 'Ya existe una actuación con este nombre', 'top');
            } else if (data.saved) {
              location.hash = 'actuacion/listar';
            }
          }
        });
      }

      return false;
    }
  }, {
    key: "alert",
    value: function alert(documents, templates) {
      var message = [];

      if (!documents) {
        message.push('un documento');
      }

      if (!templates) {
        message.push('una plantilla');
      }

      var html = "\n        <div class=\"alert alert-danger alert-dismissible fade in\" role=\"alert\">\n            <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\"><span aria-hidden=\"true\">\xD7</span></button>\n            Se debe agregar al menos ".concat(message.join(' y '), "\n        </div>\n  ");
      $('#alertaDocumentos').html(html);
      setTimeout(function () {
        $('#alertaDocumentos').children().alert('close');
      }, 5000);
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

var Documento = /*#__PURE__*/function () {
  function Documento() {
    _classCallCheck(this, Documento);
  }

  _createClass(Documento, [{
    key: "createEditModal",
    value: function createEditModal(id) {
      var title = id ? 'Editar documento' : 'Crear documento';
      $('#createModal').modal();
      $('#createValue').val(id);
      $('#documentoNombre').val('');
      $('#documentoEstado').prop('checked', true).change();
      $('#documentoObligatorio').prop('checked', true).change();
      $('#createTitle').text(title);

      if (id) {
        $.ajax({
          url: '/documento/get/' + id,
          success: function success(_ref) {
            var documento = _ref.documento;
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
    key: "createEditModal",
    value: function createEditModal(id) {
      var title = id ? 'Editar entidad demandada' : 'Crear entidad demandada';
      $('#createModal').modal();
      $('#createValue').val(id);
      $('#etapaNombre').val('');
      $('#etapaEstado').prop('checked', true).change();
      $('#createTitle').text(title);

      if (id) {
        $.ajax({
          url: '/entidades-demandadas/get/' + id,
          success: function success(_ref2) {
            var entidadDemandada = _ref2.entidadDemandada;
            $('#etapaNombre').val(entidadDemandada.nombre_entidad_demandada);
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
    key: "createEditModal",
    value: function createEditModal(id) {
      var title = id ? 'Editar entidad demandada' : 'Crear entidad demandada';
      $('#createModal').modal();
      $('#createValue').val(id);
      $('#etapaNombre').val('');
      $('#etapaEstado').prop('checked', true).change();
      $('#primeraInstancia').prop('checked', false).change();
      $('#segundaInstancia').prop('checked', false).change();
      $('#createTitle').text(title);

      if (id) {
        $.ajax({
          url: '/entidades-de-justicia/get/' + id,
          success: function success(_ref3) {
            var entidadJusticia = _ref3.entidadJusticia;
            $('#etapaNombre').val(entidadJusticia.nombre_entidad_justicia);
            $('#etapaEstado').prop('checked', entidadJusticia.estado_entidad_justicia == 1).change();
            $('#primeraInstancia').prop('checked', entidadJusticia.aplica_primera_instancia == 1).change();
            $('#segundaInstancia').prop('checked', entidadJusticia.aplica_segunda_instancia == 1).change();
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
    key: "createEditModal",
    value: function createEditModal(id) {
      var title = id ? 'Editar etapa' : 'Crear etapa';
      $('#createModal').modal();
      $('#createValue').val(id);
      $('#etapaNombre').val('');
      $('#etapaEstado').prop('checked', true).change();
      $('#createTitle').text(title);

      if (id) {
        $.ajax({
          url: '/etapa-proceso/get/' + id,
          success: function success(_ref4) {
            var etapaProceso = _ref4.etapaProceso;
            $('#etapaNombre').val(etapaProceso.nombre_etapa_proceso);
            $('#etapaEstado').prop('checked', etapaProceso.estado_etapa_proceso == 1).change();
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
        id && formData.append('id_etapa_proceso', id);
        $.ajax({
          url: '/etapa-proceso/upsert',
          data: new URLSearchParams(formData),
          success: function success(data) {
            if (data.saved) {
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
        url: '/etapa-proceso/delete/' + id,
        data: {},
        success: function success() {
          location.reload();
        }
      });
    }
  }]);

  return EtapaProceso;
}();

var etapaProceso = new EtapaProceso();

var Intermediario = /*#__PURE__*/function () {
  function Intermediario() {
    _classCallCheck(this, Intermediario);
  }

  _createClass(Intermediario, [{
    key: "createEditModal",
    value: function createEditModal(id) {
      var title = id ? 'Editar intermediario' : 'Crear intermediario';
      $('#createModal').modal();
      $('#createValue').val(id);
      $('#etapaNombre').val('');
      $('#etapaEstado').prop('checked', true).change();
      $('#createTitle').text(title);

      if (id) {
        $.ajax({
          url: '/etapa-proceso/get/' + id,
          success: function success(_ref5) {
            var intermediario = _ref5.intermediario;
            $('#etapaNombre').val(intermediario.nombre_etapa_proceso);
            $('#etapaEstado').prop('checked', intermediario.estado_etapa_proceso == 1).change();
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
        id && formData.append('id_etapa_proceso', id);
        $.ajax({
          url: '/etapa-proceso/upsert',
          data: new URLSearchParams(formData),
          success: function success(data) {
            if (data.saved) {
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
        url: '/etapa-proceso/delete/' + id,
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
      var _this = this;

      var title = id ? 'Crear' : 'Editar';
      var that = this;
      $('#createModal').modal();
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
            return _this.rowAccion(accion);
          });
          that.renderParents(data.parents);
          $('#tableCreateModal tbody').html(html.join(''));
          $('#tableCreateModal').footable();
          $('#create_parent_id').val(data.parent_id).selectpicker('refresh');
        }
      });
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
    value: function rowAccion(_ref6) {
      var id_accion = _ref6.id_accion,
          nombre_accion = _ref6.nombre_accion,
          observacion = _ref6.observacion;
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
        success: function success(_ref7) {
          var deleted = _ref7.deleted;

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
      var _this2 = this;

      e.preventDefault();
      e.stopPropagation();
      var formData = new FormData(e.target);
      formData.append('id_menu', $('#idCreateElement').val());
      $.ajax({
        url: '/opciones/accion/upsert',
        data: new URLSearchParams(formData),
        success: function success(data) {
          var html = _this2.rowAccion(data);

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
    key: "redrawTableModal",
    value: function redrawTableModal(id) {
      var _this3 = this;

      return $.ajax({
        url: '/perfil/get/' + (id || 0),
        success: function success(data) {
          var html = data.menus.map(function (menu) {
            return "<option value=\"".concat(menu.id_menu, "\">").concat(menu.nombre_menu, "</option>");
          });
          $('#listaMenu').html(html).selectpicker('refresh');
          html = data.selectedMenus.map(function (menu) {
            return _this3.getRow(menu.id_menu_perfil, menu.nombre_menu, menu.acciones);
          });
          $('#tableCreateModal tbody').html(html).children('.footable-empty').remove();
          $('#tableCreateModal').footable();
          $('#tableCreateModal select').selectpicker('refresh');

          _this3.addSelectListener();

          return data;
        }
      });
    }
  }, {
    key: "createEditModal",
    value: function createEditModal(id) {
      var text = id ? 'Editar perfil' : 'Nuevo perfil';
      $('#createModal').modal();
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
          $('#createModal').modal('hide');
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
      var _this4 = this;

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
        success: function success(_ref8) {
          var saved = _ref8.saved;

          if (saved) {
            _this4.redrawTableModal(id_perfil);
          }
        }
      });
    }
  }, {
    key: "deleteMenu",
    value: function deleteMenu(id) {
      $.ajax({
        url: '/perfil/menu/delete/' + id,
        success: function success(_ref9) {
          var deleted = _ref9.deleted,
              menuItem = _ref9.menuItem;

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
        success: function success(_ref10) {
          var deleted = _ref10.deleted;

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

var TipoProceso = /*#__PURE__*/function () {
  function TipoProceso() {
    _classCallCheck(this, TipoProceso);
  }

  _createClass(TipoProceso, [{
    key: "createEditEtapaModal",
    //createEtapaModal
    value: function createEditEtapaModal() {
      $('#createEtapaModal').modal();
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
        id_tipo_proceso: $('#createValue').val() || 0
      };
      $.ajax({
        url: '/tipo-proceso/etapa/update',
        data: new URLSearchParams(params),
        success: function success(data) {
          console.log(data);
        }
      });
    }
  }, {
    key: "renderModalData",
    value: function renderModalData() {
      var _this5 = this;

      var id = arguments.length > 0 && arguments[0] !== undefined ? arguments[0] : 0;
      return $.ajax({
        url: '/tipo-proceso/get/' + id,
        success: function success(data) {
          var htmlListaEtapas = data.etapas.map(function (etapa) {
            return "<option value=\"".concat(etapa.id_etapa_proceso, "\">").concat(etapa.nombre_etapa_proceso, "</option>");
          });
          $('#listaEtapa').html(htmlListaEtapas.join('')).selectpicker('refresh'); //addRow

          var htmlSelectedEtapas = data.selectedEtapas.map(function (e) {
            return _this5.addRow(e.id_etapa_proceso, e.nombre_etapa_proceso);
          });
          $('#tableCreateModal tbody').html(htmlSelectedEtapas.join(''));
          $('#tableCreateModal').footable();
          $("#sortable").sortable({
            start: _this5.sortableStart,
            stop: _this5.sortableStop,
            update: _this5.sortableUpdate
          }).disableSelection();
          return data;
        }
      });
    }
  }, {
    key: "addEtapa",
    value: function addEtapa() {
      var _this6 = this;

      var id_etapa_proceso = $('#listaEtapa').val();
      var id_tipo_proceso = $('#createValue').val() || 0;

      if (!id_etapa_proceso) {
        return false;
      }

      $.ajax({
        url: '/tipo-proceso/etapa/insert',
        data: new URLSearchParams({
          id_etapa_proceso: id_etapa_proceso,
          id_tipo_proceso: id_tipo_proceso
        }),
        success: function success(data) {
          _this6.renderModalData(id_tipo_proceso);
        }
      });
    }
  }, {
    key: "createEditModal",
    value: function createEditModal() {
      var id = arguments.length > 0 && arguments[0] !== undefined ? arguments[0] : 0;
      $('#createModal').modal();
      $('#createValue').val(id);
      var title = id ? 'Nuevo tipo de proceso' : 'Editar tipo de proceso';
      $('#createTitle').text(title);
      this.renderModalData(id).then(function (_ref11) {
        var tipoProceso = _ref11.tipoProceso;

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
          url: '/tipo-proceso/upsert',
          data: new URLSearchParams(formData),
          success: function success(data) {
            if (data.saved) {
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
        url: '/tipo-proceso/delete/' + id,
        data: {},
        success: function success() {
          location.reload();
        }
      });
    }
  }, {
    key: "deleteEtapa",
    value: function deleteEtapa(id) {
      var _this7 = this;

      var id_tipo_proceso = $('#createValue').val() || 0;
      var params = {
        id_etapa_proceso: id,
        id_tipo_proceso: id_tipo_proceso
      };
      $.ajax({
        url: '/tipo-proceso/etapa/delete',
        data: new URLSearchParams(params),
        success: function success(data) {
          _this7.renderModalData(id_tipo_proceso);
        }
      });
    }
  }, {
    key: "addRow",
    value: function addRow(id_etapa_proceso, nombre_etapa_proceso) {
      //
      return "\n            <tr data-id=\"".concat(id_etapa_proceso, "\" class=\"ui-state-default\">\n                <td><span class=\"ui-icon ui-icon-arrowthick-2-n-s\"></span>").concat(nombre_etapa_proceso, "</td>\n                <td width=\"30px\" class=\"sortable-column-delete\" >\n                    <div class=\"flex justify-center table-actions\">\n                        <a class=\"text-danger\" href=\"javascript:void(0)\" class=\"btn text-danger\" type=\"button\"\n                            onclick=\"tipoProceso.deleteEtapa(").concat(id_etapa_proceso, ")\">\n                            <span class=\"glyphicon glyphicon-remove\"></span>\n                        </a>\n                    </div>\n                </td>\n            </tr>\n        ");
    }
  }]);

  return TipoProceso;
}();

var tipoProceso = new TipoProceso();
