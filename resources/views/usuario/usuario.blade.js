class Usuario {

    pdf(){
        window.open('/usuario/pdf')
    }

    excel(){
        window.open('/usuario/excel')
    }

    changeMunicipio(self){
        const municipio = $(self).val()
        $.ajax({
            url: '/usuario/municipio/' + municipio,
            success: data => {
                if(data.indicativo){
                    $('#indicativo').show().text('+' + data.indicativo)
                } else {
                    $('#indicativo').hide()
                }
            }
        })
    }

    createEditModal(id) {

        const title = id ? 'Editar usuario' : 'Crear usuario'

        $('#createModal').modal()
        $('#createValue').val(id)
        $('#createTitle').text(title)
        $('#tipoDocumento').val(1).selectpicker('refresh')
        $('#municipio').val(1).selectpicker('refresh')
        $('#numeroDocumento').val('')
        $('#id_perfil').val('').selectpicker('refresh')
        $('#primerApellido').val('')
        $('#segundoApellido').val('')
        $('#password').val('')
        $('#primerNombre').val('')
        $('#segundoNombre').val('')
        $('#telefono').val('')
        $('#correoElectronico').val('')
        $('#etapaEstado').prop('checked', true).change()
        $('#nombre_usuario').val('')
        $('#direccion').val('')
        $('#id_area').val('').selectpicker('refresh')
        $('#indicativo').show().text('+1')



        if (id) {
            $.ajax({
                url: '/usuario/get/' + id,
                success: ({ usuario }) => {
                    $('#tipoDocumento').val(usuario.id_tipo_documento).selectpicker('refresh')
                    $('#numeroDocumento').val(usuario.numero_documento)
                    $('#primerApellido').val(usuario.primer_apellido)
                    $('#segundoApellido').val(usuario.segundo_apellido)
                    $('#primerNombre').val(usuario.primer_nombre)
                    $('#segundoNombre').val(usuario.segundo_nombre)
                    $('#telefono').val(usuario.telefono)
                    $('#nombre_usuario').val(usuario.nombre_usuario)
                    $('#direccion').val(usuario.direccion)
                    $('#municipio').val(usuario.id_municipio).selectpicker('refresh')
                    $('#correoElectronico').val(usuario.correo_electronico)
                    $('#etapaEstado').prop('checked', usuario.estado_usuario == 1).change()
                    $('#id_perfil').val(usuario.id_perfil).selectpicker('refresh')
                    $('#id_area').val(usuario.id_area).selectpicker('refresh')

                    if(usuario.indicativo) {
                        $('#indicativo').text('+' + usuario.indicativo)
                    } else {
                        $('#indicativo').hide()
                    }

                    if(!$('.input-firma img').length) {
                        $('.input-firma').append('<img src="" />')
                    }

                    $('.input-firma img').attr('src', `/uploads/firmas/${usuario.id_usuario}.png`)
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
            id && formData.append('id_usuario', id)

            // const firma = $('#firma');
            // firma && formData.append('firma', firma[0].files[0])

            $.ajax({
                url: '/usuario/upsert',
                data: formData,
                contentType: false,
                processData: false,
                success: data => {
                    if (data.saved) {
                        location.reload()
                    } else if(data.documentExists || data.invalidDocument) {
                        $('#numeroDocumento').parent().addClass('has-error')
                        const text = data.documentExists ? 'El número de documento ya existe' : 'Documento inválido'
                        showErrorPopover($('#numeroDocumento'), text, 'top')
                    } else if(data.invalidPassword) {
                        $('#password').parent().addClass('has-error')
                        const text = 'La contraseña debe tener al menos 6 caracteres'
                        showErrorPopover($('#password'), text, 'top')
                    } else if(data.userExists) {
                        $('#nombre_usuario').parent().addClass('has-error')
                        const text = 'El nombre de usuario ya existe'
                        showErrorPopover($('#nombre_usuario'), text, 'top')
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
            url: '/usuario/delete/' + id,
            data: {},
            success: () => {
                location.reload()
            }
        })
    }

}

const usuario = new Usuario()
