class Proceso {

    openDelete(id) {
        $('#deleteModal').modal()
        $('#deleteValue').val(id)
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

    changeCliente(self){
        const id = $(self).val()
        $.ajax({
            url: '/cliente/basic/' + id,
            success: cliente => {

                const telefonoCliente = []
                const telefonoIntermediario = []
                if(cliente.celular) {
                    telefonoCliente.push(cliente.celular)
                }

                if(cliente.telefono) {
                    telefonoCliente.push(cliente.telefono)
                }

                if(cliente.celular2) {
                    telefonoCliente.push(cliente.celular2)
                }

                if(cliente.celular_intermediario) {
                    telefonoIntermediario.push(cliente.celular_intermediario)
                }

                if(cliente.telefono_intermediario) {
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

    delete(){
        const id = $('#deleteValue').val()
        $.ajax({
            url: '/proceso/delete/' + id,
            success: ({ deleted }) => {
                if(deleted) {
                    $('#tipoProcesoRow' + id).remove()
                    $('#deleteModal').modal('hide')
                }
            }
        })

        return false
    }
}


const proceso = new Proceso();
