class Actuacion {

    pdf(){
        window.open('/actuacion/pdf')
    }

    excel(){
        window.open('/actuacion/excel')
    }

    update(e) {
        e.preventDefault()
        e.stopPropagation()
        this.save(e, '/actuacion/update/' + getId())
        return false
    }

    create(e) {
        e.preventDefault()
        e.stopPropagation()
        this.save(e, '/actuacion/insert')
        return false
    }

    delete() {
        const id = $('#deleteValue').val()
        $.ajax({
            url: '/actuacion/delete/' + id,
            data: {},
            success: data => {
                if (data.deleted) {
                    $('#actRow' + id).remove();
                    $('#deleteModal').modal('hide')
                }
            }
        })
        return false
    }

    openDelete(id){
        $('#deleteModal').modal()
        $('#deleteValue').val(id)
        return false;
    }

    save(e, url) {
        e.preventDefault()
        e.stopPropagation()
        if (validateForm(e)) {

            const formData = new FormData(e.target)
            const documents = []
            const templates = []
            $('#tblDocumentos tbody tr').toArray().map(item => {
                const value = $(item).data('value')
                value && documents.push(value)
            })

            $('#tblPlantillasDocumento tbody tr').toArray().map(item => {
                const value = $(item).data('value')
                value && templates.push(value)
            })

            formData.append('documents', documents)
            formData.append('templates', templates)

            $.ajax({
                url,
                data: new URLSearchParams(formData),
                success: data => {
                    if (data.exists) {
                        showErrorPopover($('#nombreActuacion'), 'Ya existe una actuación con este nombre', 'top');
                    } else if (data.saved) {
                        alert('Se ha guardado satisfactoriamente!');
                        $('.validate').removeClass('open')
                        window.history.back();
                    }
                }
            })
        }
        return false
    }

    removeDocument(self) {
        $(self).parents('tr').eq(0).remove()
    }

    addDocumentTemplate(self) {
        const { name, value } = this.getDocumentValues(self)

        if (!$(`#tmpDocumentRow${value}`).length) {
            const html = `
            <tr id="tmpDocumentRow${value}" data-value="${value}">
                <td class="plantillas-documento">${name}</td>
                <td class="center">
                    <button class="btn btn-danger btn-xs" type="button" onclick="actuacion.removeDocument(this);">
                        <span class="glyphicon glyphicon-minus"></span>
                    </button>
                </td>
            </tr>
        `
            $('#tblPlantillasDocumento').footableAdd(html)
        }
    }

    getDocumentValues(self) {
        const $document = $(self)
        const name = $document.children('option:selected').text().trim()
        const value = $document.val()
        $document.val('')
        return { name, value }
    }

    addDocument(self) {

        const { name, value } = this.getDocumentValues(self)
        if (!$(`#documentsRow${value}`).length) {
            const html = `
        <tr id="documentsRow${value}" data-value="${value}">
            <td class="documentos">${name}</td>
            <td class="center">
                <button class="btn btn-danger btn-xs" type="button" onclick="actuacion.removeDocument(this);">
                    <span class="glyphicon glyphicon-minus"></span>
                </button>
            </td>
        </tr>`
            $('#tblDocumentos').footableAdd(html)
        }
    }
}

const actuacion = new Actuacion()


class ChangePassword {

    upsert(e) {

        e.preventDefault()
        e.stopPropagation()

        if (validateForm(e)) {

            const formData = new FormData(e.target)

            $.ajax({
                url: '/cambiar-contrasena/upsert',
                data: new URLSearchParams(formData),
                success: data => {

                    if (data.invalid) {
                        $('#old-password').parent().addClass('has-error')
                        const text = 'La contraseña anterior es invalida'
                        showErrorPopover($('#old-password'), text, 'top')
                    } else if (data.notconfirmed) {
                        $('#confirm-password').parent().addClass('has-error')
                        const text = 'La nueva contraseña y la confirmación no coinciden'
                        showErrorPopover($('#confirm-password'), text, 'top')
                    } else if (data.saved) {
                        alert('Se ha actualizado la contraseña!')
                        location = '/'
                    }
                }
            })
        }

        return false
    }
}


const changePassword = new ChangePassword();

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
                        $('.autosave').autosaveRemove()
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

class Documento {

    pdf(){
        window.open('/documento/pdf')
    }

    excel(){
        window.open('/documento/excel')
    }

    closeCreateModal() {
        $('#createModal')
            .removeClass('open')
            .modal('hide')
    }

    createEditModal(id) {

        const title = id ? 'Editar documento' : 'Crear documento'

        $('#createModal').addClass('open').modal()
        $('#createValue').val(id)
        $('#documentoNombre').val('')
        $('#documentoEstado').prop('checked', true).change()
        $('#documentoObligatorio').prop('checked', true).change()
        $('#createTitle').text(title)

        if (id) {
            $.ajax({
                url: '/documento/get/' + id,
                success: ({ documento }) => {
                    $('#documentoNombre').val(documento.nombre_documento)
                    $('#documentoEstado').prop('checked', documento.estado_documento == 1).change()
                    $('#documentoObligatorio').prop('checked', documento.obligatoriedad_documento == 1).change()
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
            id && formData.append('id_documento', id)

            $.ajax({
                url: '/documento/upsert',
                data: new URLSearchParams(formData),
                success: data => {
                    if (data.saved) {
                        alert('Se ha guardado satisfactoriamente!');
                        $('#createModal').removeClass('open').modal('hide')
                        location.reload()
                    } else if (data.exists) {
                        $('#documentoNombre').parent().addClass('has-error')
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
            url: '/documento/delete/' + id,
            data: {},
            success: () => {
                location.reload()
            }
        })
    }

}

const documento = new Documento()

class EntidadDemandada {

    pdf(){
        window.open('/entidades-demandadas/pdf')
    }

    excel(){
        window.open('/entidades-demandadas/excel')
    }

    closeCreateModal() {
        $('#createModal')
            .removeClass('open')
            .modal('hide')
    }

    createEditModal(id) {

        const title = id ? 'Editar entidad demandada' : 'Crear entidad demandada'

        $('#createModal').addClass('open').modal()
        $('#createValue').val(id)
        $('#etapaNombre').val('')
        $('#etapaEstado').prop('checked', true).change()
        $('#createTitle').text(title)

        if (id) {
            $.ajax({
                url: '/entidades-demandadas/get/' + id,
                success: ({ entidadDemandada }) => {
                    $('#etapaNombre').val(entidadDemandada.nombre_entidad_demandada)
                    $('#etapaCorreo').val(entidadDemandada.email_entidad_demandada)
                    $('#etapaEstado').prop('checked', entidadDemandada.estado_entidad_demandada == 1).change()
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
            id && formData.append('id_entidad_demandada', id)

            $.ajax({
                url: '/entidades-demandadas/upsert',
                data: new URLSearchParams(formData),
                success: data => {
                    if (data.saved) {
                        alert('Se ha guardado satisfactoriamente!');
                        $('#createModal').removeClass('open').modal('hide')
                        location.reload()
                    } else if (data.exists) {
                        $('#etapaNombre').parent().addClass('has-error')
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
            url: '/entidades-demandadas/delete/' + id,
            data: {},
            success: () => {
                location.reload()
            }
        })
    }

}

const entidadDemandada = new EntidadDemandada()

class EntidadJusticia {

    pdf(){
        window.open('/entidades-de-justicia/pdf')
    }

    excel(){
        window.open('/entidades-de-justicia/excel')
    }

    closeCreateModal() {
        $('#createModal')
            .removeClass('open')
            .modal('hide')
    }

    changePais(self) {
        const pais = $(self).val()
        return $.ajax({
            url: '/entidades-de-justicia/departamentos/' + pais,
            success: data => {
                const html = data.map(item => `<option value="${item.id_departamento}">${item.nombre_departamento}</option>`)
                $('#id_departamento').html(html).selectpicker('refresh')
                $('#id_municipio').html('').val('').selectpicker('refresh')
            }
        })
    }

    changeDepartamento(self) {
        const departamento = $(self).val()
        return $.ajax({
            url: '/entidades-de-justicia/municipios/' + departamento,
            success: data => {
                const html = data.map(item => `<option value="${item.id_municipio}">${item.nombre_municipio}</option>`)
                $('#id_municipio').html(html).selectpicker('refresh')
            }
        })
    }

    createEditModal(id) {

        const title = id ? 'Editar entidad de justicia' : 'Crear entidad de justicia'

        $('#createModal').addClass('open').modal()
        $('#createValue').val(id)
        $('#etapaNombre').val('')
        $('#etapaEstado').prop('checked', true).change()
        $('#primeraInstancia').prop('checked', false).change()
        $('#segundaInstancia').prop('checked', false).change()
        $('#createTitle').text(title)
        $('#id_departamento').html('')
        $('#id_municipio').html('')
        $('#id_pais,#id_departamento,#id_municipio').val('').selectpicker('refresh')

        if (id) {
            $.ajax({
                url: '/entidades-de-justicia/get/' + id,
                success: ({ entidadJusticia }) => {
                    $('#etapaNombre').val(entidadJusticia.nombre_entidad_justicia)
                    $('#etapaCorreo').val(entidadJusticia.email_entidad_justicia)
                    $('#etapaEstado').prop('checked', entidadJusticia.estado_entidad_justicia == 1).change()
                    $('#primeraInstancia').prop('checked', entidadJusticia.aplica_primera_instancia == 1).change()
                    $('#segundaInstancia').prop('checked', entidadJusticia.aplica_segunda_instancia == 1).change()

                    $('#id_pais').val(entidadJusticia.municipio.departamento.id_pais).selectpicker('refresh')
                    this.changePais($('#id_pais'))
                    .then(() => {
                        $('#id_departamento').val(entidadJusticia.municipio.id_departamento).selectpicker('refresh')
                        this.changeDepartamento($('#id_departamento'))
                        .then(() => {
                            $('#id_municipio').val(entidadJusticia.id_municipio).selectpicker('refresh')
                        })
                    })

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
            id && formData.append('id_entidad_justicia', id)

            $.ajax({
                url: '/entidades-de-justicia/upsert',
                data: new URLSearchParams(formData),
                success: data => {
                    if (data.saved) {
                        alert('Se ha guardado satisfactoriamente!');
                        $('#createModal').removeClass('open').modal('hide')
                        location.reload()
                    } else if (data.exists) {
                        $('#etapaNombre').parent().addClass('has-error')
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
            url: '/entidades-de-justicia/delete/' + id,
            data: {},
            success: () => {
                location.reload()
            }
        })
    }

}

const entidadJusticia = new EntidadJusticia()

class EtapaProceso {

    pdf(){
        window.open('/etapas-de-proceso/pdf')
    }

    excel(){
        window.open('/etapas-de-proceso/excel')
    }

    createActuacion(){
        $('#createModal').modal('hide')
        $('.modal-backdrop').remove()
        $('body').removeClass('modal-open')
        window.open('/#actuacion/crear')
    }

    closeCreateModal() {
        $('#createModal')
            .removeClass('open')
            .modal('hide')
    }

    renderModalData(id){
        return $.ajax({
            url: '/etapas-de-proceso/get/' + (id || 0),
            success: data => {
                const { actuaciones, selectedActuaciones } = data

                const htmlActuaciones = actuaciones.map(a => `<option value="${a.id_actuacion}">${a.nombre_actuacion}</option>`)
                $('#actuacionesList').html(htmlActuaciones).selectpicker('refresh')

                const htmlSelected = selectedActuaciones.map(a => this.addRow(a.id_actuacion_etapa_proceso, a.nombre_actuacion, a.tiempo_maximo_proxima_actuacion, a.unidad_tiempo_proxima_actuacion))
                $('#sortable').html(htmlSelected)

                $('#tableCreateModal').footable()
                $("#sortable").sortable({
                    start: this.sortableStart,
                    stop: this.sortableStop,
                    update: this.sortableUpdate,
                }).disableSelection()

                return data
            }
        })
    }

    asociarActuacionModal(type = 'show') {
        $('#idActuacionEtapaProceso').val('')
        $('#actuacionesList').val('').selectpicker('refresh')
        $('#UnidadTiempoProximaActuacion').val(1).selectpicker('refresh')
        $('#tiempoMaximoProximaActuacion').val('')
        $('#createModal').css('opacity', type === 'show' ? .7 : 1)
        $('#actuacionModal').modal(type)
        setTimeout(() => {
            $('body').addClass('modal-open')
        }, 500)
    }

    addActuacion(e) {

        e.preventDefault()
        e.stopPropagation()

        const id_actuacion = $('#actuacionesList').val()
        const id_etapa_proceso = $('#createValue').val() || 0
        if (!id_actuacion) {
            return false
        }

        const formData = new FormData(e.target)
        formData.append('id_etapa_proceso', id_etapa_proceso)

        $.ajax({
            url: '/etapas-de-proceso/actuacion/insert',
            data: new URLSearchParams(formData),
            success: () => {
                this.renderModalData(id_etapa_proceso)
                this.asociarActuacionModal('hide')
            }
        })

        return false
    }

    createEditModal(id) {

        const title = id ? 'Editar etapa' : 'Crear etapa'

        $('#createModal').addClass('open').modal()
        $('#createValue').val(id)
        $('#etapaNombre').val('')
        $('#etapaEstado').prop('checked', true).change()
        $('#createTitle').text(title)

        this.renderModalData(id)
        .then(({ etapaProceso }) => {
            $('#etapaNombre').val(etapaProceso.nombre_etapa_proceso)
            $('#etapaEstado').prop('checked', etapaProceso.estado_etapa_proceso == 1).change()
        })
    }

    upsert(e) {

        e.preventDefault()
        e.stopPropagation()

        if (validateForm(e)) {

            const id = $('#createValue').val()
            const formData = new FormData(e.target)
            id && formData.append('id_etapa_proceso', id)

            $.ajax({
                url: '/etapas-de-proceso/upsert',
                data: new URLSearchParams(formData),
                success: data => {
                    if (data.saved) {
                        alert('Se ha guardado satisfactoriamente!');
                        $('#createModal').removeClass('open').modal('hide')
                        location.reload()
                    } else if (data.exists) {
                        $('#etapaNombre').parent().addClass('has-error')
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
            url: '/etapas-de-proceso/delete/' + id,
            data: {},
            success: () => {
                location.reload()
            }
        })
    }

    deleteActuacion(id) {
        $.ajax({
            url: '/etapas-de-proceso/actuacion/delete/' + id,
            data: {},
            success: ({ deleted }) => {
                if(deleted){
                    $('#actuacionRow' + id).remove()
                }
            }
        })
    }

    editActuacion(id) {
        this.asociarActuacionModal('show')
        $.ajax({
            url: '/etapas-de-proceso/actuacion/get/' + id,
            success: data => {
                $('#tiempoMaximoProximaActuacion').val(data.tiempo_maximo_proxima_actuacion)
                $('#UnidadTiempoProximaActuacion').val(data.unidad_tiempo_proxima_actuacion).selectpicker('refresh')
                $('#idActuacionEtapaProceso').val(data.id_actuacion_etapa_proceso)
                $('#actuacionesList').append(`<option value="${data.id_actuacion}">${data.nombre_actuacion}</option>`)
                $('#actuacionesList').val(data.id_actuacion).selectpicker('refresh')
            }
        })
    }

    getUnityName(unity){
        switch(unity) {
            case 1: return 'Días'
            case 2: return 'Semanas'
            case 3: return 'Meses'
            case 4: return 'Años'
            default: return 'Días'
        }

    }

    addRow(id, name, time, unity) {
        return `
            <tr id="actuacionRow${id}" data-id="${id}" class="ui-state-default">
                <td><span class="ui-icon ui-icon-arrowthick-2-n-s"></span>${name}</td>
                <td><span class="ui-icon ui-icon-arrowthick-2-n-s"></span>${time || 0} ${this.getUnityName(unity)}</td>
                <td width="30px" class="sortable-column-delete" >
                    <div class="flex justify-center table-actions">
                        <a  href="javascript:void(0)" class="text-primary btn" type="button"
                            onclick="etapaProceso.editActuacion(${id})">
                            <span class="glyphicon glyphicon-pencil"></span>
                        </a>
                        <a href="javascript:void(0)" class="text-danger btn" type="button"
                            onclick="etapaProceso.deleteActuacion(${id})">
                            <span class="glyphicon glyphicon-remove"></span>
                        </a>
                    </div>
                </td>
            </tr>
        `
    }

    sortableStart(_, ui) {
        $(ui.item).css('background', '#ccc').children('td').css('visibility', 'hidden');
        $(ui.item).find('.footable-first-visible').css('visibility', 'visible');
    }

    sortableStop(_, ui) {
        $(ui.item).css('background', 'inherit').children('td').css('visibility', 'visible');
    }

    sortableUpdate(event, _ ) {
        const $rowList = $(event.target).children('tr') || []
        const orderedList = []

        for(item of $rowList) {
            orderedList.push($(item).data('id'))
        }

        const params = {
            orderedList,
            id_etapa_proceso: $('#createValue').val()
        }

        $.ajax({
            url: '/etapas-de-proceso/actuacion/order/update',
            data: new URLSearchParams(params),
            success: data => {
                console.log(data)
            }
        })
    }

}

const etapaProceso = new EtapaProceso()

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

class Intermediario {

    pdf(){
        window.open('/intermediario/pdf')
    }

    excel(){
        window.open('/intermediario/excel')
    }

    closeCreateModal() {
        $('#createModal')
            .removeClass('open')
            .modal('hide')
    }

    changeMunicipio(self){
        const municipio = $(self).val()
        $.ajax({
            url: '/intermediario/municipio/' + municipio,
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

        const title = id ? 'Editar intermediario' : 'Crear intermediario'

        $('#createModal').addClass('open').modal()
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
                    $('#municipio').val(intermediario.id_municipio).selectpicker('refresh')
                    $('#correoElectronico').val(intermediario.correo_electronico)
                    $('#etapaEstado').prop('checked', intermediario.estado_intermediario == 1).change()

                    if(intermediario.indicativo) {
                        $('#indicativo').text('+' + intermediario.indicativo)
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

            const id = $('#createValue').val()
            const formData = new FormData(e.target)
            id && formData.append('id_intermediario', id)

            $.ajax({
                url: '/intermediario/upsert',
                data: new URLSearchParams(formData),
                success: data => {
                    if (data.saved) {
                        alert('Se ha guardado satisfactoriamente!');
                        $('#createModal').removeClass('open').modal('hide')
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

class Menu {

    pdf(){
        window.open('/opciones/menu/pdf')
    }

    excel(){
        window.open('/opciones/menu/excel')
    }

    renderParents(parents) {
        let html = [];
        html.push('<option value="0">Sin padre</option>')
        parents.map(parent => html.push(`<option value="${parent.id_menu}">${parent.nombre_menu}</option>`))
        $('#create_parent_id').html(html.join('')).selectpicker('refresh');
    }

    toggleRutaMenu(value) {
        const $ruta = $('#create_ruta_menu');
        if (!parseInt(value)) {
            $ruta.prop('disabled', true).removeClass('required').parent('.form-group').hide()
        } else {
            $ruta.prop('disabled', false).addClass('required').parent('.form-group').show()
        }
    }

    onChangeSelect(self) {
        const value = $(self).val()
        this.toggleRutaMenu(value)
    }

    createModal(id) {
        const title = id ? 'Crear' : 'Editar'
        const that = this

        $('#createModal').addClass('open').modal()
        $('#createTitle').text(title)
        $('#idCreateElement').val(id)
        $('#create_nombre_menu').val('')
        $('#create_ruta_menu').val('')
        $('#create_orden_menu').val('')
        $('#create_parent_id').val('')
            .selectpicker('refresh')

        $.ajax({
            url: '/opciones/menu/' + (id || 0),
            data: {},
            success: data => {
                that.toggleRutaMenu(data.parent_id)
                $('#create_nombre_menu').val(data.nombre_menu)
                $('#create_ruta_menu').val(data.ruta_menu)
                $('#create_orden_menu').val(data.orden_menu)

                const html = (data.acciones || []).map(accion => {
                    return this.rowAccion(accion);
                })

                that.renderParents(data.parents);
                $('#tableCreateModal tbody').html(html.join(''))
                $('#tableCreateModal').footable()
                $('#create_parent_id').val(data.parent_id).selectpicker('refresh')
            }
        })
    }

    closeCreateModal() {
        $('#createModal')
            .removeClass('open')
            .modal('hide')
    }

    upsert(e) {

        e.preventDefault()
        e.stopPropagation()

        if (validateForm(e)) {

            const id = $('#idCreateElement').val()
            const formData = new FormData(e.target)
            id && formData.append('id_menu', id)

            $.ajax({
                url: '/opciones/menu/upsert',
                data: new URLSearchParams(formData),
                success: data => {
                    if (data.saved) {
                        alert('Se ha guardado satisfactoriamente!');
                        $('#createModal').removeClass('open')
                        location.reload()
                    } else if (data.exists) {
                        $('#create_nombre_menu').parent().addClass('has-error')
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
            url: '/opciones/menu/delete/' + id,
            data: {},
            success: () => {
                location.reload()
            }
        })
    }

    createActionModal(id) {
        $('#createActionModal').modal()
        $('#id_accion').val('')
        $('#accion_nombre_accion').val('')
        $('#accion_observacion').val('')

        if (id) {
            $.ajax({
                url: '/opciones/accion/' + id,
                data: {},
                success: data => {
                    $('#id_accion').val(data.id_accion)
                    $('#accion_nombre_accion').val(data.nombre_accion)
                    $('#accion_observacion').val(data.observacion)
                }
            })
        }
    }

    rowAccion({ id_accion, nombre_accion, observacion }) {
        return `
            <tr id="accionRow${id_accion}">
                <td>${nombre_accion}</td>
                <td>${observacion || ''}</td>
                <td width="30px">
                    <div class="flex justify-center table-actions">
                        <a href="javascript:void(0)" onclick="menu.createActionModal(${id_accion})" class="btn text-primary" type="button">
                            <span class="glyphicon glyphicon-pencil"></span>
                        </a>
                        <a href="javascript:void(0)" class="btn text-danger" type="button" onclick="menu.deleteActionModal(${id_accion})">
                            <span class="glyphicon glyphicon-remove"></span>
                        </a>
                    </div>
                </td>
            </tr>
        `
    }

    deleteActionModal(id) {
        $('#deleteActionModal').modal()
        $('#deleteActionID').val(id)
    }

    deleteAction() {
        const id = $('#deleteActionID').val()
        $.ajax({
            url: '/opciones/accion/delete/' + id,
            data: {},
            success: ({ deleted }) => {
                if (deleted) {
                    $('#accionRow' + id).remove()
                }
                $('#deleteActionModal').modal('hide')
            }
        })
    }

    upsertAccion(e) {
        e.preventDefault()
        e.stopPropagation()

        const formData = new FormData(e.target);
        formData.append('id_menu', $('#idCreateElement').val())

        $.ajax({
            url: '/opciones/accion/upsert',
            data: new URLSearchParams(formData),
            success: data => {
                const html = this.rowAccion(data)
                const $item = $('#accionRow' + data.id_accion)
                if ($item.length) {
                    $item.replaceWith(html)
                } else {
                    $('#tableCreateModal tbody').append(html)
                }

                $('#tableCreateModal .footable-empty').remove()
                $('#tableCreateModal').footable()
                $('#createActionModal').modal('hide')
            }
        })

        return false
    }

}

const menu = new Menu()

class Perfil {

    pdf(){
        window.open('/perfil/pdf')
    }

    excel(){
        window.open('/perfil/excel')
    }

    openDelete(id) {
        $('#deleteModal').modal()
        $('#deleteValue').val(id)
    }

    addSelectListener(){
        $("#tableCreateModal select").on("changed.bs.select", function(e, clickedIndex, newValue, oldValue) {
            const id_menu_perfil = $(this).data('menu-perfil')
            const id_accion = $(this).find('option').eq(clickedIndex).val();
            $.ajax({
                url: '/perfil/menu/accion/addremove',
                data: new URLSearchParams({ id_menu_perfil, id_accion, add: !!newValue })
            })
         });
    }

    closeCreateModal() {
        $('#createModal')
            .removeClass('open')
            .modal('hide')
    }

    redrawTableModal(id){
        return $.ajax({
            url: '/perfil/get/' + (id || 0),
            success: data => {

                let html = data.menus.map(menu => `<option value="${menu.id_menu}">${menu.nombre_menu}</option>`)
                $('#listaMenu').html(html).selectpicker('refresh')

                html = data.selectedMenus.map(menu => this.getRow(menu.id_menu_perfil, menu.nombre_menu, menu.acciones))

                $('#tableCreateModal tbody').html(html).children('.footable-empty').remove()
                $('#tableCreateModal').footable()
                $('#tableCreateModal select').selectpicker('refresh')

                this.addSelectListener()
                return data
            }
        })
    }

    createEditModal(id) {
        const text = id ? 'Editar perfil' : 'Nuevo perfil'
        $('#createModal').addClass('open').modal()
        $('#createValue').val(id)
        $('#createTitle').text(text)
        this.redrawTableModal(id).then(data => {
            $('#perfilNombre').val(data.perfil ? data.perfil.nombre_perfil : '')
            $('#perfilEstado').prop('checked', data.perfil ? data.perfil.inactivo == 0 : true).change()
        })
    }

    create(e){

        e.preventDefault()
        e.stopPropagation()

        const id = $('#createValue').val()
        const $formData = new FormData(e.target)
        $formData.append('id_perfil', id)

        $.ajax({
            url: '/perfil/create',
            data: new URLSearchParams($formData),
            success: data => {
                $('#createModal').removeClass('open').modal('hide')
                setTimeout(() => {
                    location.reload()
                }, 500);
            }
        })

        return false
    }

    addMenu() {
        const id_menu = $('#listaMenu').val()
        const id_perfil = $('#createValue').val() || 0
        const params = { id_menu, id_perfil }

        if(!id_menu) {
            return false
        }

        $.ajax({
            url: '/perfil/menu/insert',
            data: new URLSearchParams(params),
            success: ({ saved }) => {
                if(saved) {
                    this.redrawTableModal(id_perfil)
                }
            }
        })
    }

    deleteMenu(id){
        $.ajax({
            url: '/perfil/menu/delete/' + id,
            success: ({ deleted, menuItem }) => {
                if(deleted){
                    $('#menuRow' + id).remove()
                    const name = menuItem.nombre_menu
                    const value = menuItem.id_menu
                    $('#listaMenu')
                        .append(`<option value="${value}">${name}</option>`)
                        .selectpicker('refresh')
                }
            }
        })
    }

    delete(){
        const id = $('#deleteValue').val()
        $.ajax({
            url: '/perfil/delete/' + id,
            success: ({ deleted }) => {
                if(deleted) {
                    $('#deleteModal').modal('hide')
                    $('#perfilRow' + id).remove()
                }
            }
        })
    }

    getRow(id_menu_perfil, nombre, acciones){

        const html = (acciones || []).map(a =>
            `<option value="${a.id_accion}" ${a.selected ? 'selected' : ''}>${a.nombre_accion}</option>`
        )

        return `
            <tr id="menuRow${id_menu_perfil}">
                <td>${nombre}</td>
                <td>
                <select data-menu-perfil="${id_menu_perfil}" class="selectpicker" title="Seleccionar ..." multiple>
                    ${html.join('')}
                </select>
                </td>
                <td width="30px">
                    <div class="flex justify-center table-actions">
                        <a href="javascript:void(0)" class="btn text-danger" type="button" onclick="perfil.deleteMenu(${id_menu_perfil})">
                            <span class="glyphicon glyphicon-remove"></span>
                        </a>
                    </div>
                </td>
            </tr>
        `
    }
}

const perfil = new Perfil()

class Plantilla {

    pdf(){
        window.open('/plantillas/pdf')
    }

    excel(){
        window.open('/plantillas/excel')
    }

    openDelete(id) {
        $('#deleteModal').modal()
        $('#deleteValue').val(id)
    }

    upsert(e) {

        e.preventDefault()
        e.stopPropagation()

        if (validateForm(e)) {

            const formData = new FormData(e.target)

            $.ajax({
                url: '/plantillas/upsert',
                data: new URLSearchParams(formData),
                success: data => {

                    if (data.plantillaExists) {
                        $('#nombre_plantilla_documento').parent().addClass('has-error')
                        const text = 'Ya existe un plantilla con este nombre'
                        showErrorPopover($('#nombre_plantilla_documento'), text, 'top')
                    } else if (data.saved) {
                        alert('Se ha guardado satisfactoriamente!');
                        $('.validate').removeClass('open')
                        location.hash = 'plantillas/listar'
                    }
                }
            })
        }

        return false
    }

    delete() {
        const id = $('#deleteValue').val()
        $.ajax({
            url: '/plantillas/delete/' + id,
            success: ({ deleted }) => {
                if (deleted) {
                    $('#tipoplantillaRow' + id).remove()
                    $('#deleteModal').modal('hide')
                }
            }
        })

        return false
    }
}


const plantilla = new Plantilla();

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
                        $('.autosave').autosaveRemove()
                        $('.validate').removeClass('open')
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



class GestionProcesosActivos {
    generatePDF(e) {

        if (validateForm(e)) {

            const formData = new FormData(e.target);

            $.ajax({
                url: '/gestion-procesos-activos/pdf',
                data: new URLSearchParams(formData),
                success: data => {
                    console.log('data', data)
                }
            })
        }
    }

    generateExcel(e) {

        if (validateForm(e)) {

            const formData = new FormData(e.target);

            $.ajax({
                url: '/gestion-procesos-activos/excel',
                data: new URLSearchParams(formData),
                success: data => {
                    console.log('data', data)
                }
            })
        }
    }
}

const gestionProcesosActivos = new GestionProcesosActivos()


class SeguimientoActuacion {
    openTemplateModal(id = 0) {
        $('#plantillasModal').modal()
    }

    closeTemplateModal() {
        $('#plantillasModal').modal('hide')
    }

    finalizarActuacion(e) {
        e.preventDefault()
        e.stopPropagation()

        if (validateForm(e)) {

            const hasFinalizarProceso = $('#finalizar_proceso').length
            if (hasFinalizarProceso) {
                $('#formularioActuacion')
                    .append(`<input type="hidden" name="finalizar_proceso" value="1" />`)
                    .trigger('submit')
            }

            const etapa = $('#siguienteEtapaActuacion').val()
            const actuacion = $('#siguienteActuacion').val()
            const usuario = $('#usuarioSiguienteActuacion').val()

            $('#formularioActuacion')
                .append(`<input type="hidden" name="id_siguiente_etapa_actuacion" id="id_siguiente_etapa_actuacion" value="${etapa}" />`)
                .append(`<input type="hidden" name="id_siguiente_actuacion" id="id_siguiente_actuacion" value="${actuacion}" />`)
                .append(`<input type="hidden" name="id_usuario_siguiente_actuacion" id="id_usuario_siguiente_actuacion" value="${usuario}" />`)
                .trigger('submit')
        }

        return false
    }

    guardarActuacion(e) {
        e.preventDefault()
        e.stopPropagation()

        if (validateForm(e)) {

            const $reqDocuments = $('.file-document[data-required=true]').toArray()
            const allDocs = $reqDocuments.every(item => $(item).data('filename'));

            const $fieldList = $(e.target).find('input.form-control, select.form-control, textarea.form-control').toArray()
            const allSaved = $fieldList.every(item => $(item).attr('disabled') || $(item).val().trim() || $(item).attr('type') == 'search');
            const idProcesoEtapaActuacion = $('#id_proceso_etapa_actuacion').val()
            const finalizado = $('#finalizado').val() == 1

            const valorPago = $('#valor_pago').val()
            const valorPagoExists = $('#valor_pago').length > 0
            const valorPagoPass = valorPago === 'No genera cobro' || parseInt(valorPago) > 0



            const allFields = allDocs && allSaved && !finalizado && valorPagoExists && valorPagoPass && idProcesoEtapaActuacion != ''

            if (allFields) {
                const siguienteEtapaActuacion = $('#id_siguiente_etapa_actuacion').val()
                const siguienteActuacion = $('#id_siguiente_actuacion').val()
                const usuarioSiguienteActuacion = $('#id_usuario_siguiente_actuacion').val()

                if (valorPagoExists && valorPagoPass && (!siguienteActuacion || !usuarioSiguienteActuacion || !siguienteEtapaActuacion)) {
                    $('#cerrarActuacion').modal()
                    return false
                }
            }

            const params = []
            params.push({ name: 'all_fields', value: allFields })
            this.upsert(e, params)
        }

        return false
    }

    upsert(e, params) {

        const formData = new FormData(e.target)
        params.map(({ name, value }) => {
            formData.append(name, value)
        })

        $.ajax({
            url: '/seguimiento-procesos/actuacion/upsert',
            data: new URLSearchParams(formData),
            success: data => {
                $('#cerrarActuacion').modal('hide')
                setTimeout(() => {
                    alert('Se ha guardado satisfactoriamente!');
                    $('.validate').removeClass('open')
                    location.hash = 'seguimiento-procesos/' + $('#id_proceso').val()
                }, 1000);
            }
        })
    }

    deletePlantilla(id) {
        $.ajax({
            url: '/seguimiento-procesos/actuacion/plantilla/delete/' + id,
            success: ({ deleted, data }) => {
                if (deleted) {
                    $('#plantillaDocumento')
                        .append(`<option value="${data.plantilla_documento.id_plantilla_documento}">${data.plantilla_documento.nombre_plantilla_documento}</option>`)
                        .selectpicker('refresh')

                    $(`#documentos-generados .file-document[data-id=${data.id_proceso_etapa_actuacion_plantillas}]`).remove()


                    if (!$('#documentos-generados .file-document').length) {
                        $('#documentos-generados').append(`<div class="file-document-empty">No se han agregado documentos</div>`);
                    }
                }
            }
        })
    }

    savePlantilla(e) {
        e.preventDefault()
        e.stopPropagation()

        const formData = new FormData(e.target)
        formData.append('id_proceso', $('#id_proceso').val())
        formData.append('id_proceso_etapa', $('#id_proceso_etapa').val())
        formData.append('id_proceso_etapa_actuacion', $('#id_proceso_etapa_actuacion').val())

        $.ajax({
            url: '/seguimiento-procesos/actuacion/plantilla/upsert',
            data: new URLSearchParams(formData),
            success: ({ saved, url }) => {
                if (saved) {
                    const value = $('#plantillaDocumento').val()
                    $(`#plantillaDocumento option[value=${value}]`).remove()
                    $('#plantillaDocumento').selectpicker('refresh')

                    const html = `<div class="file-document" data-title="${saved.plantilla_documento.nombre_plantilla_documento}"
                    data-remove="seguimientoActuacion.deletePlantilla('${saved.id_proceso_etapa_actuacion_plantillas}')"
                    data-id="${saved.id_proceso_etapa_actuacion_plantillas}"
                    data-filename="${url}"></div>`

                    $('#documentos-generados').append(html)
                    $('#documentos-generados .file-document-empty').remove()

                    const id = getId()
                    $('.file-document').fileDocument({
                        url: 'proceso/upload',
                        path: 'uploads/documentos',
                        id
                    })
                }
            }
        })

        return false
    }

    refreshActuaciones(self) {
        const id_etapa_proceso = $(self).val()
        if (id_etapa_proceso) {
            $.ajax({
                url: '/seguimiento-procesos/etapa/actuaciones/' + id_etapa_proceso,
                data: new URLSearchParams({
                    id_actuacion: $('#id_actuacion').val(),
                    id_proceso_etapa: $('#id_proceso_etapa').val(),
                    id_proceso: $('#id_proceso').val(),
                    id_etapa_proceso
                }),
                success: data => {
                    const html = data.map(item => `<option value="${item.id_actuacion}">${item.nombre_actuacion}</option>`)
                    $('#siguienteActuacion')
                        .html(html)

                    if (data.length) {
                        $('#siguienteActuacion').val(data[0].id_actuacion)
                    }

                    $('#siguienteActuacion')
                        .selectpicker('refresh')
                }
            })
        } else {
            $('#siguienteActuacion')
                .html('')
                .selectpicker('refresh')
        }
    }
}

const seguimientoActuacion = new SeguimientoActuacion();

class SeguimientoProceso {

    addActuacion(id_etapa_proceso) {
        $('#actuacionModal').modal()
        $('#idEtapaProceso').val(id_etapa_proceso)
        $('#nombre_actuacion').val('')
        $('#etapaPrimeraActuacion').prop('checked', false).change()
        $('#orderActuacion').val(1)
        $('#tiempoMaximoProximaActuacion').val('')
        $('#UnidadTiempoProximaActuacion').val(1).selectpicker('refresh')
        $('#agregarActuacionDespuesDe').show().val('').addClass('required').selectpicker('refresh')

        $.ajax({
            url: '/seguimiento-procesos/etapas-de-proceso/actuacion/all/' + id_etapa_proceso,
            success: actuaciones => {
                if (actuaciones.length) {
                    const html = actuaciones.map(actuacion => `<option value="${actuacion.id_actuacion}">${actuacion.nombre_actuacion}</option>`)
                    $('#actuacionesAfterList').addClass('required').html(html).parents('.form-group').show()
                } else {
                    $('#actuacionesAfterList').removeClass('required').html('').parents('.form-group').hide()
                }

                $('#actuacionesAfterList').val('').selectpicker('refresh')
                $('#orderActuacion').val(actuaciones.length + 1)
            }
        })

        $.ajax({
            url: '/seguimiento-procesos/etapas-de-proceso/get/' + id_etapa_proceso,
            success: ({ actuaciones }) => {
                const html = actuaciones.map(data => `<option value="${data.id_actuacion}">${data.nombre_actuacion}</option>`)
                $('#actuacionesList').html(html).val('').selectpicker('refresh')
            }
        })
    }

    saveActuacion(e) {
        e.preventDefault()
        e.stopPropagation()

        if (validateForm(e)) {

            const formData = new FormData(e.target)
            $.ajax({
                url: '/seguimiento-procesos/etapas-de-proceso/actuacion/insert',
                data: new URLSearchParams(formData),
                success: data => {
                    location.reload()
                }
            })
        }

        return false
    }

    changeEtapa(self) {
        const $self = $(self)
        const procesoetapa = $self.data('procesoetapa')
        const id = $self.data('id')

        if (!procesoetapa) {

            const params = new FormData();
            params.append('id_etapa_proceso', id)
            params.append('id_proceso', getId())

            $.ajax({
                url: '/seguimiento-procesos/set-etapa',
                data: new URLSearchParams(params),
                success: data => {
                    $self.data('procesoetapa', data.id_proceso_etapa)
                    $list = $('#etapa-' + data.id_etapa_proceso + ' table .seguimiento-sin-url')
                    $list.toArray().map(item => {
                        const idActuacion = $(item).data('actuacion')
                        $(item).attr('href', `#seguimiento-procesos/actuacion/crear/${data.id_proceso_etapa}/${idActuacion}`)
                    })
                    $list.removeClass('seguimiento-sin-url')
                }
            })
        }
    }

    addComentarioModal(id) {
        $('#comentariosModal').addClass('open').modal();
        $('#idProcesoBitacora').val(id || '')
        $('#comentarioProceso').val('')
        $.ajax({
            url: '/seguimiento-procesos/comentario/get/' + id,
            success: data => {
                $('#comentarioProceso').val(data.comentario)
            }
        })
    }

    closeComentarioModal() {
        $('#comentariosModal').removeClass('open').modal('hide');
    }

    closeActuacionModal() {
        $('#actuacionModal').modal('hide');
    }

    openDeleteComentario(id) {
        $('#deleteModal').modal()
        $('#deleteValue').val(id)
    }

    deleteComentario() {
        const id = $('#deleteValue').val()
        $.ajax({
            url: '/seguimiento-procesos/comentario/delete/' + id,
            success: ({ deleted }) => {
                if(deleted) {
                    $('#comentarioRow' + id).remove();
                }
            }
        })

        $('#deleteModal').modal('hide')
    }

    saveComentario(e) {
        e.preventDefault()
        e.stopPropagation()

        const formData = new FormData(e.target)
        formData.append('id_proceso', getId());
        $.ajax({
            url: '/seguimiento-procesos/comentario/upsert',
            data: new URLSearchParams(formData),
            success: ({ saved }) => {
                if(saved) {
                    const $table = $('#comentariosTable')
                    const $row = $('#comentarioRow' + saved.id_proceso_bitacora)
                    const html = `
                        <tr id="comentarioRow${saved.id_proceso_bitacora}">
                            <td>${saved.fechaCreacion}</td>
                            <td>${saved.nombreUsuario}</td>
                            <td>${saved.comentario}</td>
                            <td>
                            <div class="flex justify-center table-actions">
                                <a onClick="seguimientoProceso.addComentarioModal('${saved.id_proceso_bitacora}')" class="btn text-primary" type="button">
                                    <span class="glyphicon glyphicon-pencil"></span>
                                </a>
                                <a onclick="seguimientoProceso.openDeleteComentario('${saved.id_proceso_bitacora}')" href="javascript:void(0)" class="btn text-danger" type="button">
                                    <span class="glyphicon glyphicon-remove"></span>
                                </a>
                            </div>
                            </td>
                        </tr>
                    `
                    $table.find('.footable-empty').remove();
                    if($row.length) {
                        $row.replaceWith(html)
                    } else {
                        $table.find('tbody').prepend(html)
                    }

                    $table.footable();
                }
                this.closeComentarioModal()
            }
        })

        return false
    }
}


const seguimientoProceso = new SeguimientoProceso();

class TipoProceso {

    pdf(){
        window.open('/tipos-de-proceso/pdf')
    }

    excel(){
        window.open('/tipos-de-proceso/excel')
    }

    createEtapaOpen(){
        $('#tipoProcesoEtapaPopover').popover('show')
    }

    popoverClose() {
        $('#tipoProcesoEtapaPopover').popover('hide')
    }

    createEtapa() {

        const nombre_etapa_proceso = $('#etapaProcesoNombre').val().trim()
        if(nombre_etapa_proceso) {
            const data = {
                nombre_etapa_proceso,
                estado: 1
            }

            $.ajax({
                url: '/etapas-de-proceso/upsert',
                data: new URLSearchParams(data),
                success: data => {
                    const id = $('#createValue').val() || 0
                    this.renderModalData(id)
                    $('#tipoProcesoEtapaPopover').popover('hide')
                }
            })
        }
    }

    sortableStart(_, ui ) {
        $(ui.item).find('.footable-last-visible a').hide()
    }

    sortableStop(_, ui ) {
        $(ui.item).find('.footable-last-visible a').show()
    }

    sortableUpdate(event, _ ) {
        const $rowList = $(event.target).children('tr') || []
        const orderedList = []

        for(item of $rowList) {
            orderedList.push($(item).data('id'))
        }

        const params = {
            orderedList,
            id_tipo_proceso: $('#createValue').val() || 0
        }

        $.ajax({
            url: '/tipos-de-proceso/etapa/update',
            data: new URLSearchParams(params),
            success: data => {
                console.log(data)
            }
        })
    }

    closeCreateModal() {
        $('#createModal')
            .removeClass('open')
            .modal('hide')
    }

    renderModalData(id = 0) {
        return $.ajax({
            url: '/tipos-de-proceso/get/' + id,
            success: data => {

                const htmlListaEtapas = data.etapas.map(etapa => `<option value="${etapa.id_etapa_proceso}">${etapa.nombre_etapa_proceso}</option>`)
                $('#listaEtapa').html(htmlListaEtapas.join('')).selectpicker('refresh');

                //addRow
                const htmlSelectedEtapas = data.selectedEtapas.map(e => this.addRow(e.id_etapa_proceso, e.nombre_etapa_proceso))
                $('#tableCreateModal tbody').html(htmlSelectedEtapas.join(''))

                $('#tableCreateModal').footable()
                $("#sortable").sortable({
                    start: this.sortableStart,
                    stop: this.sortableStop,
                    update: this.sortableUpdate,
                }).disableSelection()

                return data
            }
        })
    }

    addEtapa(self) {
        const id_etapa_proceso = $(self).val()
        const id_tipo_proceso = $('#createValue').val() || 0
        if (!id_etapa_proceso) {
            return false
        }

        $.ajax({
            url: '/tipos-de-proceso/etapa/insert',
            data: new URLSearchParams({ id_etapa_proceso, id_tipo_proceso }),
            success: () => {
                this.renderModalData(id_tipo_proceso)
            }
        })
    }

    createEditModal(id = 0) {
        $('#createModal').addClass('open').modal()
        $('#createValue').val(id)
        const title = id ? 'Editar tipo de proceso' : 'Nuevo tipo de proceso'
        $('#createTitle').text(title)
        $('#tipoNombre').val('')
        this.renderModalData(id).then(({ tipoProceso }) => {
            if (tipoProceso) {
                $('#tipoNombre').val(tipoProceso.nombre_tipo_proceso)
                $('#tipoEstado').prop('checked', tipoProceso.estado_tipo_proceso == 1).change()
            }
        })

    }

    openDelete(id) {
        $('#deleteModal').modal()
        $('#deleteValue').val(id)
    }

    upsert(e) {

        e.preventDefault()
        e.stopPropagation()

        if (validateForm(e)) {

            const id = $('#createValue').val()
            const formData = new FormData(e.target)
            id && formData.append('id_tipo_proceso', id)

            $.ajax({
                url: '/tipos-de-proceso/upsert',
                data: new URLSearchParams(formData),
                success: data => {
                    if (data.saved) {
                        alert('Se ha guardado satisfactoriamente!');
                        $('#createModal').removeClass('open').modal('hide')
                        location.reload()
                    } else if (data.exists) {
                        $('#etapaNombre').parent().addClass('has-error')
                    }
                }
            })
        }

        return false
    }

    delete() {
        const id = $('#deleteValue').val()
        $.ajax({
            url: '/tipos-de-proceso/delete/' + id,
            data: {},
            success: () => {
                location.reload()
            }
        })
    }

    deleteEtapa(id) {
        const id_tipo_proceso = $('#createValue').val() || 0;
        const params = {
            id_etapa_proceso: id,
            id_tipo_proceso
        }

        $.ajax({
            url: '/tipos-de-proceso/etapa/delete',
            data: new URLSearchParams(params),
            success: data => {
                this.renderModalData(id_tipo_proceso)
            }
        })
    }

    addRow(id_etapa_proceso, nombre_etapa_proceso) {
        //
        return `
            <tr data-id="${id_etapa_proceso}" class="ui-state-default" style="cursor:move">
                <td>${nombre_etapa_proceso}</td>
                <td width="30px" class="sortable-column-delete" >
                    <div class="flex justify-center table-actions">
                        <a class="text-danger" href="javascript:void(0)" class="btn text-danger" type="button"
                            onclick="tipoProceso.deleteEtapa(${id_etapa_proceso})">
                            <span class="glyphicon glyphicon-remove"></span>
                        </a>
                    </div>
                </td>
            </tr>
        `
    }
}


const tipoProceso = new TipoProceso()

class TipoResultado {

    pdf(){
        window.open('/tipos-de-resultado/pdf')
    }

    excel(){
        window.open('/tipos-de-resultado/excel')
    }

    createEtapaOpen(){
        $('#tipoProcesoEtapaPopover').popover('show')
    }

    popoverClose() {
        $('#tipoProcesoEtapaPopover').popover('hide')
    }

    createEtapa() {

        const nombre_etapa_proceso = $('#etapaProcesoNombre').val().trim()
        if(nombre_etapa_proceso) {
            const data = {
                nombre_etapa_proceso,
                estado: 1
            }

            $.ajax({
                url: '/tipos-de-resultado/upsert',
                data: new URLSearchParams(data),
                success: data => {
                    const id = $('#createValue').val() || 0
                    this.renderModalData(id)
                    $('#tipoProcesoEtapaPopover').popover('hide')
                }
            })
        }
    }

    sortableStart(_, ui ) {
        $(ui.item).find('.footable-last-visible a').hide()
    }

    sortableStop(_, ui ) {
        $(ui.item).find('.footable-last-visible a').show()
    }

    sortableUpdate(event, _ ) {
        const $rowList = $(event.target).children('tr') || []
        const orderedList = []

        for(item of $rowList) {
            orderedList.push($(item).data('id'))
        }

        const params = {
            orderedList,
            id_tipo_proceso: $('#createValue').val() || 0
        }

        $.ajax({
            url: '/tipos-de-resultado/etapa/update',
            data: new URLSearchParams(params),
            success: data => {
                console.log(data)
            }
        })
    }

    renderModalData(id = 0) {
        return $.ajax({
            url: '/tipos-de-resultado/get/' + id,
            success: data => {
                return data
            }
        })
    }

    closeCreateModal() {
        $('#createModal')
            .removeClass('open')
            .modal('hide')
    }

    createEditModal(id = 0) {
        $('#createModal').addClass('open').modal()
        $('#createValue').val(id)
        const title = id ? 'Editar tipo de resultado' : 'Nuevo tipo de resultado'
        $('#createTitle').text(title)
        $('#tipoNombre').val('')
        this.renderModalData(id).then(({ tipoResultado }) => {
            if (tipoResultado) {
                $('#tipoNombre').val(tipoResultado.nombre_tipo_resultado)
                $('#tipoCampo').val(tipoResultado.tipo_campo).selectpicker('refresh')
                $('#tipoEstado').prop('checked', tipoResultado.unico_tipo_resultado == 1).change()
            }
        })

    }

    openDelete(id) {
        $('#deleteModal').modal()
        $('#deleteValue').val(id)
    }

    upsert(e) {

        e.preventDefault()
        e.stopPropagation()

        if (validateForm(e)) {

            const id = $('#createValue').val()
            const formData = new FormData(e.target)
            id && formData.append('id_tipo_resultado', id)

            $.ajax({
                url: '/tipos-de-resultado/upsert',
                data: new URLSearchParams(formData),
                success: data => {
                    if (data.saved) {
                        alert('Se ha guardado satisfactoriamente!');
                        $('#createModal').removeClass('open').modal('hide')
                        location.hash = "#tipos-de-resultado"
                        location.reload()
                    } else if (data.exists) {
                        $('#etapaNombre').parent().addClass('has-error')
                    }
                }
            })
        }

        return false
    }

    delete() {
        const id = $('#deleteValue').val()
        $.ajax({
            url: '/tipos-de-resultado/delete/' + id,
            data: {},
            success: () => {
                location.hash = "#tipos-de-resultado"
                location.reload()
            }
        })
    }

    deleteEtapa(id) {
        const id_tipo_proceso = $('#createValue').val() || 0;
        const params = {
            id_etapa_proceso: id,
            id_tipo_proceso
        }

        $.ajax({
            url: '/tipos-de-resultado/etapa/delete',
            data: new URLSearchParams(params),
            success: data => {
                this.renderModalData(id_tipo_proceso)
            }
        })
    }

    addRow(id_etapa_proceso, nombre_etapa_proceso) {
        //
        return `
            <tr data-id="${id_etapa_proceso}" class="ui-state-default" style="cursor:move">
                <td>${nombre_etapa_proceso}</td>
                <td width="30px" class="sortable-column-delete" >
                    <div class="flex justify-center table-actions">
                        <a class="text-danger" href="javascript:void(0)" class="btn text-danger" type="button"
                            onclick="tipoProceso.deleteEtapa(${id_etapa_proceso})">
                            <span class="glyphicon glyphicon-remove"></span>
                        </a>
                    </div>
                </td>
            </tr>
        `
    }
}


const tipoResultado = new TipoResultado()

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
        // const id = $(self).val()
        // if(id == 1) {
        //     $('#fecha_inicio_container').removeClass('col-xs-6').addClass('col-xs-12')
        //     $('#fecha_fin_container').hide().children('input').removeClass('required').siblings('label').text('Fecha fin')
        //     return
        // }

        // $('#fecha_inicio_container').removeClass('col-xs-12').addClass('col-xs-6')
        // $('#fecha_fin_container').show().children('input').addClass('required').siblings('label').text('* Fecha fin')
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
