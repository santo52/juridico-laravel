class Cliente {

    changePaisContacto(self) {
        const pais = $(self).val()
        return $.ajax({
            url: '/cliente/departamentos/' + pais,
            success: data => {
                const html = data.map(item => `<option value="${item.id_departamento}">${item.nombre_departamento}</option>`)
                $('#id_departamento_contacto').html(html).selectpicker('refresh')
                $('#id_municipio_contacto').html('').val('').selectpicker('refresh')
            }
        })
    }

    changeDepartamentoContacto(self) {
        const departamento = $(self).val()
        $.ajax({
            url: '/cliente/municipios/' + departamento,
            success: data => {
                $('#id_municipio_contacto').val('')
                const html = data.map(item => `<option value="${item.id_municipio}">${item.nombre_municipio}</option>`)
                $('#id_municipio_contacto').html(html).selectpicker('refresh')
            }
        })
    }

    changeMunicipioContacto(self) {
        const municipio = $(self).val()
        $.ajax({
            url: '/cliente/municipio/' + municipio,
            success: data => {
                if (data.indicativo) {
                    $('#indicativo_contacto').show().text('+' + data.indicativo)
                } else {
                    $('#indicativo_contacto').hide()
                }
            }
        })
    }

    changePais(self) {
        const pais = $(self).val()
        return $.ajax({
            url: '/cliente/departamentos/' + pais,
            success: data => {
                const html = data.map(item => `<option value="${item.id_departamento}">${item.nombre_departamento}</option>`)
                $('#id_departamento').html(html).selectpicker('refresh')
                $('#id_municipio').html('').val('').selectpicker('refresh')
            }
        })
    }

    changeDepartamento(self) {
        const departamento = $(self).val()
        $.ajax({
            url: '/cliente/municipios/' + departamento,
            success: data => {
                $('#id_municipio').val('')
                const html = data.map(item => `<option value="${item.id_municipio}">${item.nombre_municipio}</option>`)
                $('#id_municipio').html(html).selectpicker('refresh')
            }
        })
    }

    changeMunicipio(self) {
        const municipio = $(self).val()
        $.ajax({
            url: '/cliente/municipio/' + municipio,
            success: data => {
                if (data.indicativo) {
                    $('#indicativo_cliente').show().text('+' + data.indicativo)
                } else {
                    $('#indicativo_cliente').hide()
                }
            }
        })
    }

    onChangeIntermediario(self) {
        const intermediario = $(self).val()
        $('#documento_intermediario').val('')
        $('#indicativo_intermediario').text('')
        $('#telefono_intermediario').val('')
        $('#email_intermediario').val('')
        $.ajax({
            url: '/intermediario/get/' + intermediario,
            success: ({ intermediario }) => {
                if (intermediario) {
                    $('#documento_intermediario').val(intermediario.numero_documento)
                    $('#indicativo_intermediario').text('+' + intermediario.indicativo)
                    $('#telefono_intermediario').val(intermediario.telefono)
                    $('#email_intermediario').val(intermediario.correo_electronico)
                }
            }
        })
    }

    changeBeneficiario(self) {
        const val = $(self).val()
        const fields = [
            'numero_documento_beneficiario',
            'nombre_beneficiario',
            'parentesco_beneficiario',
            'telefono_beneficiario',
            'celular_beneficiario',
            'celular2_beneficiario',
            'correo_electronico_beneficiario'
        ];

        fields.map(field => {
            const $item = $('#' + field)
            if(val == 0) {
                $item.val('').prop('readonly', true)
            } else {
                $item.prop('readonly', false)
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

                    if (cliente.indicativo) {
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

                    if (data.clientExists) {
                        $('#numero_documento').parent().addClass('has-error')
                        const text = 'Ya existe un cliente con este número de documento'
                        showErrorPopover($('#numero_documento'), text, 'top')
                    } else if (data.saved) {
                        alert('Se ha guardado satisfactoriamente!');
                        $('.validate').removeClass('open')
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

    pdf(){
        window.open('/cliente/pdf')
    }

    excel(){
        window.open('/cliente/excel')
    }

}

const cliente = new Cliente()
