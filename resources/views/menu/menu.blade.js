class Menu {

    pdf(){
        window.open('/opciones/menu/pdf')
    }

    excel(){
        window.open('/opciones/menu/excel')
    }

    renderParents(parents) {
        let html = [];
        html.push('<option value="0">Sin padre</option>')
        parents.map(parent => html.push(`<option value="${parent.id_menu}">${parent.nombre_menu}</option>`))
        $('#create_parent_id').html(html.join('')).selectpicker('refresh');
    }

    toggleRutaMenu(value) {
        const $ruta = $('#create_ruta_menu');
        if (!parseInt(value)) {
            $ruta.prop('disabled', true).removeClass('required').parent('.form-group').hide()
        } else {
            $ruta.prop('disabled', false).addClass('required').parent('.form-group').show()
        }
    }

    onChangeSelect(self) {
        const value = $(self).val()
        this.toggleRutaMenu(value)
    }

    createModal(id) {
        const title = id ? 'Crear' : 'Editar'
        const that = this

        $('#createModal').modal()
        $('#createTitle').text(title)
        $('#idCreateElement').val(id)
        $('#create_nombre_menu').val('')
        $('#create_ruta_menu').val('')
        $('#create_orden_menu').val('')
        $('#create_parent_id').val('')
            .selectpicker('refresh')

        $.ajax({
            url: '/opciones/menu/' + (id || 0),
            data: {},
            success: data => {
                that.toggleRutaMenu(data.parent_id)
                $('#create_nombre_menu').val(data.nombre_menu)
                $('#create_ruta_menu').val(data.ruta_menu)
                $('#create_orden_menu').val(data.orden_menu)

                const html = (data.acciones || []).map(accion => {
                    return this.rowAccion(accion);
                })

                that.renderParents(data.parents);
                $('#tableCreateModal tbody').html(html.join(''))
                $('#tableCreateModal').footable()
                $('#create_parent_id').val(data.parent_id).selectpicker('refresh')
            }
        })
    }

    upsert(e) {

        e.preventDefault()
        e.stopPropagation()

        if (validateForm(e)) {

            const id = $('#idCreateElement').val()
            const formData = new FormData(e.target)
            id && formData.append('id_menu', id)

            $.ajax({
                url: '/opciones/menu/upsert',
                data: new URLSearchParams(formData),
                success: data => {
                    if (data.saved) {
                        alert('Se ha guardado satisfactoriamente!');
                        location.reload()
                    } else if (data.exists) {
                        $('#create_nombre_menu').parent().addClass('has-error')
                    }
                }
            })
        }

        return false
    }


    openDelete(id) {
        $('#deleteModal').modal()
        $('#deleteValue').val(id)
    }

    delete() {
        const id = $('#deleteValue').val()
        $.ajax({
            url: '/opciones/menu/delete/' + id,
            data: {},
            success: () => {
                location.reload()
            }
        })
    }

    createActionModal(id) {
        $('#createActionModal').modal()
        $('#id_accion').val('')
        $('#accion_nombre_accion').val('')
        $('#accion_observacion').val('')

        if (id) {
            $.ajax({
                url: '/opciones/accion/' + id,
                data: {},
                success: data => {
                    $('#id_accion').val(data.id_accion)
                    $('#accion_nombre_accion').val(data.nombre_accion)
                    $('#accion_observacion').val(data.observacion)
                }
            })
        }
    }

    rowAccion({ id_accion, nombre_accion, observacion }) {
        return `
            <tr id="accionRow${id_accion}">
                <td>${nombre_accion}</td>
                <td>${observacion || ''}</td>
                <td width="30px">
                    <div class="flex justify-center table-actions">
                        <a href="javascript:void(0)" onclick="menu.createActionModal(${id_accion})" class="btn text-primary" type="button">
                            <span class="glyphicon glyphicon-pencil"></span>
                        </a>
                        <a href="javascript:void(0)" class="btn text-danger" type="button" onclick="menu.deleteActionModal(${id_accion})">
                            <span class="glyphicon glyphicon-remove"></span>
                        </a>
                    </div>
                </td>
            </tr>
        `
    }

    deleteActionModal(id) {
        $('#deleteActionModal').modal()
        $('#deleteActionID').val(id)
    }

    deleteAction() {
        const id = $('#deleteActionID').val()
        $.ajax({
            url: '/opciones/accion/delete/' + id,
            data: {},
            success: ({ deleted }) => {
                if (deleted) {
                    $('#accionRow' + id).remove()
                }
                $('#deleteActionModal').modal('hide')
            }
        })
    }

    upsertAccion(e) {
        e.preventDefault()
        e.stopPropagation()

        const formData = new FormData(e.target);
        formData.append('id_menu', $('#idCreateElement').val())

        $.ajax({
            url: '/opciones/accion/upsert',
            data: new URLSearchParams(formData),
            success: data => {
                const html = this.rowAccion(data)
                const $item = $('#accionRow' + data.id_accion)
                if ($item.length) {
                    $item.replaceWith(html)
                } else {
                    $('#tableCreateModal tbody').append(html)
                }

                $('#tableCreateModal .footable-empty').remove()
                $('#tableCreateModal').footable()
                $('#createActionModal').modal('hide')
            }
        })

        return false
    }

}

const menu = new Menu()
