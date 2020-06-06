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
            const allSaved = $fieldList.every(item => $(item).attr('disabled') || $(item).val().trim());
            const idProcesoEtapaActuacion = $('#id_proceso_etapa_actuacion').val()
            const finalizado = $('#finalizado').val() == 1

            const allFields = allDocs && allSaved && !finalizado && idProcesoEtapaActuacion != ''
            if (allFields) {

                const valorPago = $('#valor_pago').val()
                const siguienteEtapaActuacion = $('#id_siguiente_etapa_actuacion').val()
                const siguienteActuacion = $('#id_siguiente_actuacion').val()
                const usuarioSiguienteActuacion = $('#id_usuario_siguiente_actuacion').val()

                if (parseInt(valorPago) > 0 && (!siguienteActuacion || !usuarioSiguienteActuacion || !siguienteEtapaActuacion)) {
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
