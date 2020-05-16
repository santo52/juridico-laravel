class Cliente {

    changeMunicipio(self){
        const municipio = $(self).val()
        $.ajax({
            url: '/cliente/municipio/' + municipio,
            success: data => {
                if(data.indicativo){
                    $('#indicativo').show().text('+' + data.indicativo)
                } else {
                    $('#indicativo').hide()
                }
            }
        })
    }

    changeDepartamento(self) {
        const departamento = $(self).val()
        $.ajax({
            url: '/departamento/municipios/' + departamento,
            success: data => {
                $('#id_municipio').val('')
                const html = data.map(item => `<option value="${item.id_municipio}">${item.nombre_municipio}</option>`)
                $('#id_municipio').html(html).selectpicker('refresh')
            }
        })
    }

    onChangeIntermediario(self) {
        const intermediario = $(self).val()
        $.ajax({
            url: '/intermediario/get/' + intermediario,
            success: ({ intermediario }) => {
                $('#documento_intermediario').val(intermediario.numero_documento)
                $('#indicativo_intermediario').text('+' + intermediario.indicativo)
                $('#telefono_intermediario').val(intermediario.telefono)
                $('#email_intermediario').val(intermediario.correo_electronico)
            }
        })
    }

    createEditModal(id) {

        const title = id ? 'Editar cliente' : 'Crear cliente'

        $('#createModal').modal()
        $('#createValue').val(id)
        $('#createTitle').text(title)
        $('#tipoDocumento').val(1).selectpicker('refresh')
        $('#municipio').val(1).selectpicker('refresh')
        $('#numeroDocumento').val('')
        $('#primerApellido').val('')
        $('#segundoApellido').val('')
        $('#primerNombre').val('')
        $('#segundoNombre').val('')
        $('#telefono').val('')
        $('#correoElectronico').val('')
        $('#etapaEstado').prop('checked', true).change()
        $('#retencion').val(0)
        $('#indicativo').show().text('+1')

        if (id) {
            $.ajax({
                url: '/cliente/get/' + id,
                success: ({ cliente }) => {
                    $('#tipoDocumento').val(cliente.id_tipo_documento).selectpicker('refresh')
                    $('#numeroDocumento').val(cliente.numero_documento)
                    $('#primerApellido').val(cliente.primer_apellido)
                    $('#segundoApellido').val(cliente.segundo_apellido)
                    $('#primerNombre').val(cliente.primer_nombre)
                    $('#segundoNombre').val(cliente.segundo_nombre)
                    $('#telefono').val(cliente.telefono)
                    $('#retencion').val(cliente.retencion)
                    $('#municipio').val(cliente.id_municipio).selectpicker('refresh')
                    $('#correoElectronico').val(cliente.correo_electronico)
                    $('#etapaEstado').prop('checked', cliente.estado_cliente == 1).change()

                    if(cliente.indicativo) {
                        $('#indicativo').text('+' + cliente.indicativo)
                    } else {
                        $('#indicativo').hide()
                    }
 }
            })
        }
    }

    upsert(e) {

        e.preventDefault()
        e.stopPropagation()

        if (validateForm(e)) {

            const formData = new FormData(e.target)

            $.ajax({
                url: '/cliente/upsert',
                data: new URLSearchParams(formData),
                success: data => {

                    if(data.clientExists) {
                        $('#numero_documento').parent().addClass('has-error')
                        const text = 'Ya existe un cliente con este número de documento'
                        showErrorPopover($('#numero_documento'), text, 'top')
                    } else if (data.saved) {
                        location.hash = 'cliente/listar'
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
            url: '/cliente/delete/' + id,
            data: {},
            success: () => {
                location.reload()
            }
        })
    }

}

const cliente = new Cliente()
