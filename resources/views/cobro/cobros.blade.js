class Cobro {

    pdf() {
        window.open('/etapas-de-proceso/pdf')
    }

    excel() {
        window.open('/etapas-de-proceso/excel')
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
        $('#item-pago-' + id).remove()
        this.deletePagoCancelar()
    }

    pagoModalOpen(id) {

        $('#pagosModal').modal('show')
        $('#lista-pagos tbody').html('')
        $('#lista-pagos').footable('refresh')

        if (id) {
            $.ajax({
                url: '/honorarios/pagos/get/' + id,
                success: data => {
                    if (data) {

                        const html = data.map(item => `<tr id="item-pago-${item.id_pago}">
                            <td>${this.formatDate(item.fecha_pago)}</td>
                            <td>${this.formasPago(item.forma_pago)}</td>
                            <td>${item.referencia || 'Sin referencia'}</td>
                            <td>${item.valor_pago}</td>
                            <td>
                                <div class="flex justify-center table-actions">
                                    <a href="javascript:void(0)" title="Editar pago"
                                        onclick="cobro.registrarPagoModalOpen('${item.id_cobro}', '${item.id_pago}')" class="btn text-primary" type="button">
                                        <span class="glyphicon glyphicon-edit"></span>
                                    </a>
                                    <a href="javascript:void(0)" title="Eliminar pago"
                                        onclick="cobro.deletePagoModal('${item.id_pago}')" class="btn text-danger" type="button">
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

    registrarPagoModalOpen(id, idpago = 0) {
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
                        $('#fecha_pago').val(data.fecha_pago)
                        $('#forma_pago').val(data.forma_pago).selectpicker('refresh')
                        $('#id_entidad_financiera').val(data.id_entidad_financiera).selectpicker('refresh')
                        $('#referencia').val(data.referencia)
                        this.changeFormaPago(data.forma_pago)
                        $('#valor_pago').val(data.valor_pago)
                    }
                }
            })
        }
    }

    pagoModalClose() {
        $('#editarPagoModal').removeClass('open').modal('hide')
    }

    cobroModalClose() {
        $('#cobrosModal').removeClass('open').modal('hide')
    }

    cobroModalOpen(id) {
        $('#cobrosModal').addClass('open').modal('show')
        $('#fecha_cobro').val('')
        $('#accion_cobro').val('')
        $('#etapa_cobro').val('')
        $('#concepto_cobro').val('')
        $('#valor_cobro').val(0)
        $('#valor_pagado').val(0)
        $('#valor_por_pagar').val(0)

        if (id) {
            $.ajax({
                url: '/cobros-y-pagos/cobro/get/' + id,
                success: data => {
                    if (data) {
                        const procesoActuacion = data.proceso_etapa_actuacion
                        if (procesoActuacion) {
                            if (procesoActuacion.actuacion) {
                                const actuacion = procesoActuacion.actuacion
                                $('#accion_cobro').val(actuacion.nombre_actuacion)
                            }

                            if (procesoActuacion.proceso_etapa) {
                                const procesoEtapa = procesoActuacion.proceso_etapa
                                if (procesoEtapa.etapa_proceso) {
                                    const etapaProceso = procesoEtapa.etapa_proceso
                                    $('#etapa_cobro').val(etapaProceso.nombre_etapa_proceso)
                                }
                            }
                        }

                        $('#id_cobro').val(data.id_cobro)
                        $('#fecha_cobro').val(data.fecha_cobro)
                        $('#valor_cobro').val(data.valor)
                        $('#concepto_cobro').val(data.concepto)
                        $('#valor_pagado').val(parseFloat(data.valor_cobro || 0))
                        $('#valor_por_pagar').val(data.valor - parseFloat(data.valor_cobro || 0))
                    }
                }
            })
        }

    }

    upsert(e) {
        e.preventDefault()
        e.stopPropagation()

        if (validateForm(e)) {

            const id = $('#id_cobro').val()
            const formData = new FormData(e.target)
            id && formData.append('id_pago', id)

            $.ajax({
                url: '/cobros-y-pagos/upsert',
                data: new URLSearchParams(formData),
                success: data => {
                    if (data.saved) {
                        $('#cobrosModal').removeClass('open').modal('hide')
                        location.reload()
                    }
                }
            })
        }

        return false
    }

    upsertPago(e) {
        e.preventDefault()
        e.stopPropagation()

        if (validateForm(e)) {

            const id = $('#id_cobro_pago').val()
            const idpago = $('#id_pago_pago').val()
            const formData = new FormData(e.target)
            id && formData.append('id_cobro', id)
            idpago && formData.append('id_pago', idpago)

            $.ajax({
                url: '/cobros-y-pagos/pago/upsert',
                data: new URLSearchParams(formData),
                success: data => {
                    if (data.saved) {
                        $('#editarPagoModal').removeClass('open').modal('hide')
                        location.reload()
                    }
                }
            })
        }

        return false
    }

    // popoverClose() {
    //     $('#tipoProcesoEtapaPopover').popover('hide')
    // }

    // createEtapa() {

    //     const nombre_etapa_proceso = $('#etapaProcesoNombre').val().trim()
    //     if(nombre_etapa_proceso) {
    //         const data = {
    //             nombre_etapa_proceso,
    //             estado: 1
    //         }

    //         $.ajax({
    //             url: '/etapas-de-proceso/upsert',
    //             data: new URLSearchParams(data),
    //             success: data => {
    //                 const id = $('#createValue').val() || 0
    //                 this.renderModalData(id)
    //                 $('#tipoProcesoEtapaPopover').popover('hide')
    //             }
    //         })
    //     }
    // }

    // sortableStart(_, ui ) {
    //     $(ui.item).find('.footable-last-visible a').hide()
    // }

    // sortableStop(_, ui ) {
    //     $(ui.item).find('.footable-last-visible a').show()
    // }

    // sortableUpdate(event, _ ) {
    //     const $rowList = $(event.target).children('tr') || []
    //     const orderedList = []

    //     for(item of $rowList) {
    //         orderedList.push($(item).data('id'))
    //     }

    //     const params = {
    //         orderedList,
    //         id_tipo_proceso: $('#createValue').val() || 0
    //     }

    //     $.ajax({
    //         url: '/tipos-de-proceso/etapa/update',
    //         data: new URLSearchParams(params),
    //         success: data => {
    //             console.log(data)
    //         }
    //     })
    // }

    // renderModalData(id = 0) {
    //     return $.ajax({
    //         url: '/tipos-de-proceso/get/' + id,
    //         success: data => {

    //             const htmlListaEtapas = data.etapas.map(etapa => `<option value="${etapa.id_etapa_proceso}">${etapa.nombre_etapa_proceso}</option>`)
    //             $('#listaEtapa').html(htmlListaEtapas.join('')).selectpicker('refresh');

    //             //addRow
    //             const htmlSelectedEtapas = data.selectedEtapas.map(e => this.addRow(e.id_etapa_proceso, e.nombre_etapa_proceso))
    //             $('#tableCreateModal tbody').html(htmlSelectedEtapas.join(''))

    //             $('#tableCreateModal').footable()
    //             $("#sortable").sortable({
    //                 start: this.sortableStart,
    //                 stop: this.sortableStop,
    //                 update: this.sortableUpdate,
    //             }).disableSelection()

    //             return data
    //         }
    //     })
    // }

    // addEtapa(self) {
    //     const id_etapa_proceso = $(self).val()
    //     const id_tipo_proceso = $('#createValue').val() || 0
    //     if (!id_etapa_proceso) {
    //         return false
    //     }

    //     $.ajax({
    //         url: '/tipos-de-proceso/etapa/insert',
    //         data: new URLSearchParams({ id_etapa_proceso, id_tipo_proceso }),
    //         success: () => {
    //             this.renderModalData(id_tipo_proceso)
    //         }
    //     })
    // }

    // createEditModal(id = 0) {
    //     $('#createModal').modal()
    //     $('#createValue').val(id)
    //     const title = id ? 'Editar tipo de proceso' : 'Nuevo tipo de proceso'
    //     $('#createTitle').text(title)
    //     $('#tipoNombre').val('')
    //     this.renderModalData(id).then(({ tipoProceso }) => {
    //         if (tipoProceso) {
    //             $('#tipoNombre').val(tipoProceso.nombre_tipo_proceso)
    //             $('#tipoEstado').prop('checked', tipoProceso.estado_tipo_proceso == 1).change()
    //         }
    //     })

    // }

    // openDelete(id) {
    //     $('#deleteModal').modal()
    //     $('#deleteValue').val(id)
    // }

    // upsert(e) {

    //     e.preventDefault()
    //     e.stopPropagation()

    //     if (validateForm(e)) {

    //         const id = $('#createValue').val()
    //         const formData = new FormData(e.target)
    //         id && formData.append('id_tipo_proceso', id)

    //         $.ajax({
    //             url: '/tipos-de-proceso/upsert',
    //             data: new URLSearchParams(formData),
    //             success: data => {
    //                 if (data.saved) {
    //                     location.reload()
    //                 } else if (data.exists) {
    //                     $('#etapaNombre').parent().addClass('has-error')
    //                 }
    //             }
    //         })
    //     }

    //     return false
    // }

    // delete() {
    //     const id = $('#deleteValue').val()
    //     $.ajax({
    //         url: '/tipos-de-proceso/delete/' + id,
    //         data: {},
    //         success: () => {
    //             location.reload()
    //         }
    //     })
    // }

    // deleteEtapa(id) {
    //     const id_tipo_proceso = $('#createValue').val() || 0;
    //     const params = {
    //         id_etapa_proceso: id,
    //         id_tipo_proceso
    //     }

    //     $.ajax({
    //         url: '/tipos-de-proceso/etapa/delete',
    //         data: new URLSearchParams(params),
    //         success: data => {
    //             this.renderModalData(id_tipo_proceso)
    //         }
    //     })
    // }

    // addRow(id_etapa_proceso, nombre_etapa_proceso) {
    //     //
    //     return `
    //         <tr data-id="${id_etapa_proceso}" class="ui-state-default" style="cursor:move">
    //             <td>${nombre_etapa_proceso}</td>
    //             <td width="30px" class="sortable-column-delete" >
    //                 <div class="flex justify-center table-actions">
    //                     <a class="text-danger" href="javascript:void(0)" class="btn text-danger" type="button"
    //                         onclick="tipoProceso.deleteEtapa(${id_etapa_proceso})">
    //                         <span class="glyphicon glyphicon-remove"></span>
    //                     </a>
    //                 </div>
    //             </td>
    //         </tr>
    //     `
    // }
}


const cobro = new Cobro()
