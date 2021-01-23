class Honorario {

    pdf(){
        window.open('/honorarios/pdf')
    }

    excel(){
        window.open('/honorarios/excel')
    }

    openDelete(id) {
        $('#deleteModal').modal()
        $('#deleteValue').val(id)
    }

    closePagoModal() {
        $('#editarPagoModal')
            .removeClass('open')
            .modal('hide')
    }

    closeCreateModal() {
        $('#createModal')
            .removeClass('open')
            .modal('hide')
    }

    createEditModal(id = 0) {
        const that = this
        $('#createModal').addClass('open').modal()
        $('#createValue').val(id)
        const title = id ? 'Editar honorarios' : 'Nuevo cobro de honorarios'
        $('#createTitle').text(title)
        $('#tipoNombre').val('')
        that.resetForm()
        if(id) {
            $.ajax({
                url: '/honorarios/get/' + id,
                success: data => {
                    $('#id_proceso').val(data.id_proceso).selectpicker('refresh')
                    that.onChangeProceso($('#id_proceso'), function() {
                        $('#porcentaje_honorarios').val(data.porcentaje_honorarios)
                        $('#retefuente').val(data.retefuente)
                        $('#reteica').val(data.reteica)
                        $('#valor_comision').val(data.valor_comision)
                        $('#numero_factura').val(data.numero_factura)
                        $('#valor_factura').val(data.valor_factura)
                    })
                }
            })
        }
    }

    changeFormaPago(value) {
        if (value == 1) {
            $('#informacion_pago_financiero').hide()
            $('#id_entidad_financiera').removeClass('required').val('')
            $('#referencia').removeClass('required').val('')
        } else {
            $('#informacion_pago_financiero').show()
            $('#id_entidad_financiera').addClass('required')
            $('#referencia').addClass('required')
        }
    }

    formasPago(id) {
        switch (id) {
            case 1:
                return 'Efectivo'
            case 2:
                return 'Consignación'
            case 3:
                return 'Cheque'
            default:
                return 'Desconocido'
        }
    }

    formatDate(date) {
        const newDate = new Date(date)
        return newDate.getDate() + '/' + (newDate.getMonth() + 1) + '/' + newDate.getFullYear()
    }

    deletePagoModal(id) {
        $('#deletePagoValue').val(id)
        $('#pagosModal').modal('hide')
        setTimeout(() => {
            $('#deletePagoModal').modal('show')
        }, 500);
    }

    deletePagoCancelar() {
        $('#deletePagoValue').val('')
        $('#deletePagoModal').modal('hide')
        setTimeout(() => {
            $('#pagosModal').modal('show')
        }, 500);
    }

    deletePagoAceptar() {
        const id = $('#deletePagoValue').val()
        if (id) {
            $.ajax({
                url: '/honorarios/pagos/delete/' + id,
                success: data => {
                    if (data.saved) {
                        honorario.rerenderRow(data.id_honorario)
                        $('#item-pago-' + id).remove()
                    }
                }
            })
        }

        this.deletePagoCancelar()
    }

    pagoModalOpen(id) {

        $('#pagosModal').modal('show')
        $('#pagosModalNewButton').data('id', id)
        $('#lista-pagos tbody').html('')
        $('#lista-pagos').footable('refresh')

        if (id) {
            $.ajax({
                url: '/honorarios/pagos/get/' + id,
                success: data => {
                    if (data) {

                        const html = data.map(item => `<tr id="item-pago-${item.id_pago_honorario}">
                            <td>${this.formatDate(item.fecha_consignacion)}</td>
                            <td>${this.formasPago(item.forma_pago)}</td>
                            <td>${item.numero_cuenta || 'En efectivo'}</td>
                            <td>${numberToMoney(item.valor_pago)}</td>
                            <td>
                                <div class="flex justify-center table-actions">
                                    <a href="javascript:void(0)" title="Editar pago"
                                        data-id="${item.id_honorario}"
                                        onclick="honorario.registrarPagoModalOpen(this, '${item.id_pago_honorario}')" class="btn text-primary" type="button">
                                        <span class="glyphicon glyphicon-edit"></span>
                                    </a>
                                    <a href="javascript:void(0)" title="Eliminar pago"
                                        onclick="honorario.deletePagoModal('${item.id_pago_honorario}')" class="btn text-danger" type="button">
                                        <span class="glyphicon glyphicon-trash"></span>
                                    </a>
                                </div>

                            </td>
                        </tr>`)
                        $('#lista-pagos tbody').html(html)
                    }

                    $('#lista-pagos').footable('refresh')
                }
            })
        }
    }

    rerenderRow(id) {
        $.ajax({
            url: '/honorarios/get/' + id,
            success: data => {
                console.log(data, 'dataaaa')
                const $row = $('#honorarioRow' + id)
                $row.find('.valorAPagar').text(numberToMoney(data.valorAPagar))
                $row.find('.valorPagado').text(numberToMoney(data.valorPagado))
                $row.find('.totalHonorarios').text(numberToMoney(data.totalHonorarios))
                $row.find('.totalComisiones').text(numberToMoney(data.totalComisiones))
                $row.find('.estadoPagos').text(data.cerrado ? 'Pagado' : 'Pendiente')

            }
        })
    }

    upsertPago(e) {
        e.preventDefault()
        e.stopPropagation()

        if (validateForm(e)) {

            const id = $('#id_cobro_pago').val()
            const idpago = $('#id_pago_pago').val()
            const formData = new FormData(e.target)
            id && formData.append('id_honorario', id)
            idpago && formData.append('id_pago', idpago)

            $.ajax({
                url: '/honorarios/pago/upsert',
                data: new URLSearchParams(formData),
                success: data => {
                    if (data.saved) {
                        $('#editarPagoModal').removeClass('open').modal('hide')
                        honorario.pagoModalOpen(data.saved.id_honorario)
                        honorario.rerenderRow(data.saved.id_honorario)
                    }
                }
            })
        }

        return false
    }

    registrarPagoModalOpen(self, idpago = 0) {
        const id = $(self).data('id')
        $('#editarPagoModal').addClass('open').modal('show')
        this.changeFormaPago(1)
        $('#id_entidad_financiera').val(0).selectpicker('refresh')
        $('#id_cobro_pago').val(id)
        $('#id_pago_pago').val(idpago)
        if (id) {
            $.ajax({
                url: '/honorarios/pago/get/' + idpago,
                success: data => {
                    if (data) {
                        $('#fecha_pago').val(data.fecha_consignacion)
                        $('#forma_pago').val(data.forma_pago).selectpicker('refresh')
                        $('#id_entidad_financiera').val(data.id_entidad_financiera).selectpicker('refresh')
                        $('#referencia').val(data.numero_cuenta)
                        this.changeFormaPago(data.forma_pago)
                        $('#valor_pago').val(data.valor_pago).currency()
                    }
                }
            })
        }
    }

    onChangeComisiones(id = false) {
        const valorComision = (id ? parseFloat($('#valor_comision').val()) : parseFloat($('[name=valor_comision]').val())) || 0
        const retefuente = parseFloat($('#retefuente').val()) || 0
        const reteica = parseFloat($('#reteica').val()) || 0

        const totalReteica = (valorComision * reteica / 100).toFixed(2)
        const totalRetefuente = (valorComision * retefuente / 100).toFixed(2)
        const totalComision = (valorComision - totalReteica - totalRetefuente).toFixed(2)

        $('#valor_retefuente').val(numberToMoney(totalRetefuente))
        $('#valor_reteica').val(numberToMoney(totalReteica))
        $('#total_comision').val(numberToMoney(totalComision))
    }

    resetForm() {
        $('#id_proceso').val('').selectpicker('refresh')
        $('#campos-honorarios').hide()
        $('#documento_cliente').val('')
        $('#nombre_cliente').val('')
        $('#valor_pagado_cliente').val(0)
        $('#fecha_pago_cliente').val('')
        $('#documento_intermediario').val('')
        $('#nombre_intermediario').val('')
        $('#porcentaje_honorarios').val(0)
        $('#valor_honorarios').val(0)
    }

    onChangeProceso(self, callback) {
        const $self = $(self)
        const that = this
        const id = $self.val()

        function onChange() {
            compileCurrencyInputs()
            that.onChangeComisiones()
            that.onChangePorcentajeHonorarios($('#porcentaje_honorarios'))
            compileCurrencyInputs()
        }

        if(id) {

            return $.ajax({
                url: '/honorarios/proceso/' + id,
                success: data => {
                    if(data) {

                        function getNombreCompleto(data) {
                            const nombreCliente = [];
                            if(data ) {
                                if(data.primer_apellido) {
                                    nombreCliente.push(data.primer_apellido)
                                }

                                if(data.segundo_apellido) {
                                    nombreCliente.push(data.segundo_apellido)
                                }

                                if(data.primer_nombre) {
                                    nombreCliente.push(data.primer_nombre)
                                }

                                if(data.segundo_nombre) {
                                    nombreCliente.push(data.segundo_nombre)
                                }
                            }

                            return nombreCliente.join(' ')
                        }

                        $('#campos-honorarios').show()
                        $('#documento_cliente').val(data.cliente.persona.numero_documento)
                        $('#nombre_cliente').val(getNombreCompleto(data.cliente.persona))
                        $('#valor_pagado_cliente').val(data.valor_final_sentencia)
                        $('#fecha_pago_cliente').val(data.fecha_pago)
                        $('#documento_intermediario').val(data.cliente.intermediario.persona.numero_documento)
                        $('#nombre_intermediario').val(getNombreCompleto(data.cliente.intermediario.persona))
                    }
                }
            })
            .then(() => callback && callback())
            .then(() => onChange())

        }

        return new Promise()
            .then(() => callback && callback())
            .then(() => onChange())

    }

    onChangePorcentajeHonorarios(self) {
        const $self = $(self)
        let value = parseFloat($self.val() || 0)
        if(value > 100) {
            value = 100
            $self.val(100)
        } else if(value < 0) {
            value = 0
            $self.val(0)
        }

        const valorPagado = parseFloat($('[name=valor_pagado_cliente]').val() || 0)
        $('#valor_honorarios').val(numberToMoney(valorPagado * value / 100))
    }

    onChangeClient(self) {
        const $self = $(self)
        const id = $self.val()
        if($self.is('#documento_cliente')) {
            $('#nombre_cliente').val(id).selectpicker('refresh')
        } else {
            $('#documento_cliente').val(id).selectpicker('refresh')
        }

        $('#documento_intermediario').val('')
        $('#nombre_intermediario').val('')

        $.ajax({
            url: '/honorarios/cliente/' + id,
            success: data => {
                $('#documento_intermediario').val(data.numero_documento_intermediario)
                const nombreIntermediario = []

                if(data.intermediario_p_apellido) {
                    nombreIntermediario.push(data.intermediario_p_apellido)
                }

                if(data.intermediario_s_apellido) {
                    nombreIntermediario.push(data.intermediario_s_apellido)
                }

                if(data.intermediario_p_nombre) {
                    nombreIntermediario.push(data.intermediario_p_nombre)
                }

                if(data.intermediario_s_nombre) {
                    nombreIntermediario.push(data.intermediario_s_nombre)
                }

                $('#nombre_intermediario').val(nombreIntermediario.join(' '))
            }
        })
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
            url: '/honorarios/tipo-proceso/documentos',
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

            const id = $('#createValue').val()
            const formData = new FormData(e.target)
            id && formData.append('id_honorario', id)

            $.ajax({
                url: '/honorarios/upsert',
                data: new URLSearchParams(formData),
                success: data => {
                    if (data.saved) {
                        alert('Se ha guardado satisfactoriamente!');
                        $('#createModal').removeClass('open').modal('hide')
                        location.reload()
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
            }
        })
    }

    delete() {
        const id = $('#deleteValue').val()
        $.ajax({
            url: '/honorarios/delete/' + id,
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


const honorario = new Honorario();
