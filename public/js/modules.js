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
        success: function success(_ref3) {
          var saved = _ref3.saved;

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
        success: function success(_ref4) {
          var deleted = _ref4.deleted,
              menuItem = _ref4.menuItem;

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
        success: function success(_ref5) {
          var deleted = _ref5.deleted;

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
