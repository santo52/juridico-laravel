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
        $ruta.val('').removeClass('required').parent('.form-group').hide();
      } else {
        $ruta.val('').addClass('required').parent('.form-group').show();
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
          setTimeout(function () {
            that.toggleRutaMenu(data.parent_id);
            $('#create_nombre_menu').val(data.nombre_menu);
            $('#create_ruta_menu').val(data.ruta_menu);
            $('#create_orden_menu').val(data.orden_menu);
            $('#create_parent_id').val(data.parent_id || 0).selectpicker('refresh');
            var html = (data.acciones || []).map(function (accion) {
              return _this.rowAccion(accion);
            });
            that.renderParents(data.parents);
            $('#tableCreateModal tbody').html(html.join(''));
            $('#tableCreateModal').footable();
          }, 500);
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
    value: function rowAccion(_ref) {
      var id_accion = _ref.id_accion,
          nombre_accion = _ref.nombre_accion,
          observacion = _ref.observacion;
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
        success: function success(_ref2) {
          var deleted = _ref2.deleted;

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
    key: "delete",
    value: function _delete() {
      var id = $('#deleteValue').val();
    }
  }, {
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
    key: "createEditModal",
    value: function createEditModal(id) {
      var text = id ? 'Editar perfil' : 'Nuevo perfil';
      $('#createModal').modal();
      $('#createValue').val(id);
      $('#createTitle').text(text);
    }
  }, {
    key: "editModal",
    value: function editModal() {}
  }]);

  return Perfil;
}();

var perfil = new Perfil(); // $(document).ready(function(){
//     setTimeout(() => {
//         const id = null;
//         const text = id ? 'Editar perfil' : 'Nuevo perfil'
//         $('#createModal').modal()
//         $('#createValue').val(id)
//         $('#createTitle').text(text)
//     }, 1000);
// })
