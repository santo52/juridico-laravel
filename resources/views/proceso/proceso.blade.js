class Proceso {

    pdf(){
        window.open('/proceso/pdf')
    }

    excel(){
        window.open('/proceso/excel')
    }

    openDelete(id) {
        $('#deleteModal').modal()
        $('#deleteValue').val(id)
    }

    formatTelefonoIntermediario(data){
        const telefonoIntermediario = []

        if (data.telefono_intermediario) {
            telefonoIntermediario.push(data.telefono_intermediario)
        }

        if (data.celular_intermediario) {
            telefonoIntermediario.push(data.celular_intermediario)
        }

        return telefonoIntermediario.join(' | ')
    }

    formatTelefonoBeneficiario(data){
        const telefonoBeneficiario = []
        if (data.telefono_beneficiario) {
            telefonoBeneficiario.push(data.telefono_beneficiario)
        }

        if (data.celular_beneficiario) {
            telefonoBeneficiario.push(data.celular_beneficiario)
        }

        if (data.celular2_beneficiario) {
            telefonoBeneficiario.push(data.celular2_beneficiario)
        }

        return telefonoBeneficiario.join(' | ')
    }

    formatTelefonoCliente(data){
        const telefonoCliente = []

        if (data.telefono) {
            telefonoCliente.push(data.telefono)
        }

        if (data.celular) {
            telefonoCliente.push(data.celular)
        }

        if (data.celular2) {
            telefonoCliente.push(data.celular2)
        }

        return telefonoCliente.join(' | ')
    }

    changeTipoProceso(self) {

        const id = $(self).val()

        const params = {
            id_proceso: getId(),
            id_tipo_proceso: id
        }

        $.ajax({
            url: '/proceso/tipo-proceso/documentos',
            data: new URLSearchParams(params),
            success: data => {
                if (!data.length) {
                    $('#documentos-proceso-tab').hide()
                    return
                }

                const html = data.map(item => `
                <div class="file-document"
                    data-filename="${item.filename ? item.filename : ''}"
                    data-id="${item.id_documento}"
                    data-title="${item.nombre_documento}"
                    data-required="${item.obligatoriedad_documento == 1 ? 'true' : 'false'}">
                </div>`)

                $('#documentos-proceso-tab').show()
                $('#documentos-requeridos').html(html)

                const id = getId()
                $('.file-document').fileDocument({
                    url: 'proceso/upload',
                    path: 'uploads/documentos',
                    id
                })

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

    upsert(e) {

        e.preventDefault()
        e.stopPropagation()

        if (validateForm(e)) {

            const formData = new FormData(e.target)

            $.ajax({
                url: '/proceso/upsert',
                data: new URLSearchParams(formData),
                success: data => {

                    if (data.procesoExists) {
                        $('#numero_proceso').parent().addClass('has-error')
                        const text = 'Ya existe un proceso con este número'
                        showErrorPopover($('#numero_proceso'), text, 'top')
                    } else if (data.folderExists) {
                        $('#id_carpeta').parent().addClass('has-error')
                        const text = 'Ya existe un proceso con esta identificación'
                        showErrorPopover($('#id_carpeta'), text, 'top')
                    } else if (data.saved) {
                        alert('Se ha guardado satisfactoriamente!');
                        location.hash = 'proceso/listar'
                    }
                }
            })
        }

        return false
    }

    changeCliente(self) {
        const id = $(self).val()
        $.ajax({
            url: '/cliente/basic/' + id,
            success: cliente => {

                $('#documento_cliente').val(cliente.numero_documento)
                $('#telefono_cliente').val(this.formatTelefonoCliente(cliente))
                $('#indicativo_cliente').text('+' + cliente.indicativo)

                $('#nombre_intermediario').val(
                    (cliente.intermediario_p_apellido || '') + ' ' +
                    (cliente.intermediario_s_apellido || '') + ' ' +
                    (cliente.intermediario_p_nombre || '') + ' ' +
                    (cliente.intermediario_s_nombre || '')
                )

                $('#nombre_beneficiario').val(cliente.nombre_beneficiario)
                $('#indicativo_beneficiario').val(cliente.indicativo_beneficiario)
                $('#telefono_beneficiario').val(this.formatTelefonoBeneficiario(cliente))
                $('#email_beneficiario').val(cliente.correo_electronico_beneficiario)

                $('#email_cliente').val(cliente.correo_electronico_cliente)
                $('#estado_vital_cliente').val(cliente.estado_vital_cliente == 1 ? 'vivo' : 'fallecido')
                $('#telefono_intermediario').val(this.formatTelefonoIntermediario(cliente))
                $('#indicativo_intermediario').val(cliente.indicativo_intermediario)
                $('#email_intermediario').val(cliente.correo_electronico_intermediario)

                $('#id_municipio_cliente').val(cliente.nombre_municipio_cliente)
                $('#id_departamento_cliente').val(cliente.nombre_departamento_cliente)
                $('#id_pais_cliente').val(cliente.nombre_pais_cliente)

            }
        })
    }

    delete() {
        const id = $('#deleteValue').val()
        $.ajax({
            url: '/proceso/delete/' + id,
            success: ({ deleted }) => {
                if (deleted) {
                    $('#tipoProcesoRow' + id).remove()
                    $('#deleteModal').modal('hide')
                }
            }
        })

        return false
    }

    openComments(id) {
        $.ajax({
            url: '/seguimiento-procesos/comentarios/' + id,
            beforeSend: () => $('#comentariosTable tbody').html(''),
            success: data => {
                if (data.length) {
                    const html = data.map(item => `
                        <tr>
                            <td>${item.fechaCreacion}</td>
                            <td>${item.nombreUsuario}</td>
                            <td>${item.comentario}</td>
                        </tr>
                    `)

                    $('#comentariosTable tbody').html(html)
                    $('#comentariosModalTitle').text('Comentarios proceso n° ' + data[0].numero_proceso)
                }

                $('#comentariosTable').footable();
                $('#comentariosModal').modal()
            }
        })


    }
}


const proceso = new Proceso();
