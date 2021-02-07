class Usuario {

    timeout = 500

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

    closeCreateContractModal() {
        $('#createContractModal').modal('hide')
        setTimeout(() => {
            $('#createModal').modal('show')
        }, this.timeout)
    }

    openEditContract(id = 0) {
        $('#createModal').modal('hide')
        setTimeout(() => {
            $('#createContractModal').modal()
            $('#createContractValue').val(id)
        }, this.timeout)

        $('#id_tipo_contrato').val('').selectpicker('refresh')
        $('#fecha_inicio').val('')
        $('#fecha_fin').val('')

        if(id) {
            $.ajax({
                url: '/usuario/contrato/' + id,
                success: ({ contrato }) => {
                    $('#id_tipo_contrato').val(contrato.tipo_contrato).selectpicker('refresh')
                    $('#fecha_inicio').val(contrato.fecha_inicio)
                    $('#fecha_fin').val(contrato.fecha_fin)
                }
            })
        }
    }

    closeDeleteContract() {
        $('#deleteContractModal').modal('hide')
        setTimeout(() => {
            $('#createModal').modal('show')
        }, this.timeout)
    }

    openDeleteContract(id) {
        $('#createModal').modal('hide')
        setTimeout(() => {
            $('#deleteContractModal').modal()
            $('#deleteContractValue').val(id)
        }, this.timeout)
    }

    changeContractType(self) {
        const id = $(self).val()
        if(id == 1) {
            $('#fecha_inicio_container').removeClass('col-xs-6').addClass('col-xs-12')
            $('#fecha_fin_container').hide().children('input').removeClass('required').siblings('label').text('Fecha fin')
            return
        }

        $('#fecha_inicio_container').removeClass('col-xs-12').addClass('col-xs-6')
        $('#fecha_fin_container').show().children('input').addClass('required').siblings('label').text('* Fecha fin')
    }

    upsertContract(e) {
        e.preventDefault()
        e.stopPropagation()

        if (validateForm(e)) {
            const that = this
            const id = $('#createContractValue').val()
            const idUser = $('#createValue').val()

            const formData = new FormData(e.target)
            id && formData.append('id_usuario_contrato', id)
            formData.append('id_usuario', idUser)

            $.ajax({
                url: '/usuario/contrato/upsert',
                data: new URLSearchParams(formData),
                success: data => {
                    if (data.saved) {
                        that.loadUserContracts(data.saved.id_usuario)
                        that.closeCreateContractModal()
                    }
                }
            })
        }
    }

    deleteContract() {
        const id = $('#deleteContractValue').val()
        $.ajax({
            url: '/usuario/contrato/delete/' + id,
            success: ({ deleted }) => {
                $('#deleteContractModal').modal('hide')
                setTimeout(() => {
                    $('#createModal').modal('show')
                    if(deleted) {
                        $('#usuarioContratoRow' + id).remove()
                        $('#table-contract').footable()
                    }
                }, this.timeout)
            }
        })
    }

    loadUserContracts(idUser) {

        $.ajax({
            url: '/usuario/contratos/' + idUser,
            success: ({ contratos, permissions }) => {
                const html = contratos.map(item => `
                    <tr id="usuarioContratoRow${item.id_usuario_contrato}">
                        <td>${item.tipo_contrato}</td>
                        <td>${item.fecha_inicio}</td>
                        <td>${item.fecha_fin}</td>
                        <td style="width:75px">
                            ${permissions.editar && `
                                <a href="javascript:void(0)" style="padding:5px" class="btn text-primary" type="button"
                                    onclick="usuario.openEditContract(${item.id_usuario_contrato})">
                                    <span class="glyphicon glyphicon-pencil"></span>
                                </a>
                            `}

                            ${permissions.eliminar && `
                                <a href="javascript:void(0)" style="padding:5px" class="btn text-danger" type="button"
                                    onclick="usuario.openDeleteContract(${item.id_usuario_contrato})">
                                    <span class="glyphicon glyphicon-remove"></span>
                                </a>
                            `}
                        </td>
                    </tr>`)

                    $('#table-contracts tbody').html(html)
                    $('#table-contracts').footable()
            }
        })


    }

    closeCreateModal() {
        $('#createModal')
            .removeClass('open')
            .modal('hide')
    }

    createEditModal(id) {

        const title = id ? 'Editar usuario' : 'Crear usuario'
        const that = this
        $('#createModal').modal()
        $('#createModal').addClass('open')

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
        $('.hidden-new-user').hide()



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
                    $('.hidden-new-user').show()

                    if(usuario.indicativo) {
                        $('#indicativo').text('+' + usuario.indicativo)
                    } else {
                        $('#indicativo').hide()
                    }

                    if(!$('.input-firma img').length) {
                        $('.input-firma').append('<img src="" />')
                    }

                    $('.input-firma img').attr('src', `/uploads/firmas/${usuario.id_usuario}.png`)

                    that.loadUserContracts(usuario.id_usuario)
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
                        $('#createModal').removeClass('open')
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
