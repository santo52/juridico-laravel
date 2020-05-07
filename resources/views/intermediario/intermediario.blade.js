class Intermediario {

    createEditModal(id) {

        const title = id ? 'Editar intermediario' : 'Crear intermediario'

        $('#createModal').modal()
        $('#createValue').val(id)
        $('#createTitle').text(title)
        $('#tipoDocumento').val(1).selectpicker('refresh')
        $('#numeroDocumento').val('')
        $('#primerApellido').val('')
        $('#segundoApellido').val('')
        $('#primerNombre').val('')
        $('#segundoNombre').val('')
        $('#telefono').val('')
        $('#correoElectronico').val('')
        $('#etapaEstado').prop('checked', true).change()
        $('#retencion').val(0)

        if (id) {
            $.ajax({
                url: '/intermediario/get/' + id,
                success: ({ intermediario }) => {
                    $('#tipoDocumento').val(intermediario.id_tipo_documento).selectpicker('refresh')
                    $('#numeroDocumento').val(intermediario.numero_documento)
                    $('#primerApellido').val(intermediario.primer_apellido)
                    $('#segundoApellido').val(intermediario.segundo_apellido)
                    $('#primerNombre').val(intermediario.primer_nombre)
                    $('#segundoNombre').val(intermediario.segundo_nombre)
                    $('#telefono').val(intermediario.telefono)
                    $('#retencion').val(intermediario.retencion)
                    $('#correoElectronico').val(intermediario.correo_electronico)
                    $('#etapaEstado').prop('checked', intermediario.estado_intermediario == 1).change()
                }
            })
        }
    }

    upsert(e) {

        e.preventDefault()
        e.stopPropagation()

        if (validateForm(e)) {

            const id = $('#createValue').val()
            const formData = new FormData(e.target)
            id && formData.append('id_intermediario', id)

            $.ajax({
                url: '/intermediario/upsert',
                data: new URLSearchParams(formData),
                success: data => {
                    if (data.saved) {
                        location.reload()
                    } else if(data.documentExists || data.invalidDocument) {
                        $('#numeroDocumento').parent().addClass('has-error')
                        const text = data.documentExists ? 'El número de documento ya existe' : 'Documento inválido'
                        showErrorPopover($('#numeroDocumento'), text, 'top')
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
            url: '/intermediario/delete/' + id,
            data: {},
            success: () => {
                location.reload()
            }
        })
    }

}

const intermediario = new Intermediario()
