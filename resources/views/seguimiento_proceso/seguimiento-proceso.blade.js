class SeguimientoProceso {

    openDelete(id) {
        $('#deleteModal').modal()
        $('#deleteValue').val(id)
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
                if(!data.length) {
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
                fileDocument.init({
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

                const telefonoCliente = []
                const telefonoIntermediario = []
                if (cliente.celular) {
                    telefonoCliente.push(cliente.celular)
                }

                if (cliente.telefono) {
                    telefonoCliente.push(cliente.telefono)
                }

                if (cliente.celular2) {
                    telefonoCliente.push(cliente.celular2)
                }

                if (cliente.celular_intermediario) {
                    telefonoIntermediario.push(cliente.celular_intermediario)
                }

                if (cliente.telefono_intermediario) {
                    telefonoIntermediario.push(cliente.telefono_intermediario)
                }

                $('#documento_cliente').val(cliente.numero_documento)
                $('#telefono_cliente').val(telefonoCliente.join(' | '))
                $('#indicativo_cliente').text('+' + cliente.indicativo)

                $('#nombre_intermediario').val(
                    (cliente.intermediario_p_nombre || '') + ' ' +
                    (cliente.intermediario_s_nombre || '') + ' ' +
                    (cliente.intermediario_p_apellido || '') + ' ' +
                    (cliente.intermediario_s_apellido || '')
                )
                $('#telefono_intermediario').val(telefonoIntermediario.join(' | '))
                $('#indicativo_intermediario').val(cliente.indicativo_intermediario)
                $('#email_intermediario').val(cliente.correo_electronico_intermediario)
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
}


const seguimientoProceso = new SeguimientoProceso();
