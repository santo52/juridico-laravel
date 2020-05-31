class SeguimientoActuacion {
    openTemplateModal(id = 0) {
        $('#plantillasModal').modal()
    }

    closeTemplateModal() {
        $('#plantillasModal').modal('hide')
    }

    upsert(e) {
        e.preventDefault()
        e.stopPropagation()

        if(validateForm(e)) {

            const $reqDocuments = $('.file-document[data-required=true]').toArray()
            const allDocs = $reqDocuments.every(item => $(item).data('filename'));

            const $fieldList = $(e.target).find('input.form-control, select.form-control, textarea.form-control').toArray()
            const allSaved = $fieldList.every(item => $(item).attr('disabled') || $(item).val().trim());


            const allFields = allDocs && allSaved
            const formData = new FormData(e.target)
            formData.append('all_fields', allFields)

            $.ajax({
                url: '/seguimiento-procesos/actuacion/upsert',
                data: new URLSearchParams(formData),
                success: data => {
                    if(data.saved) {
                        location.hash = 'seguimiento-procesos/' + $('#id_proceso').val()
                    }
                }
            })
        }

        return false
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


                    if(!$('#documentos-generados .file-document').length) {
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
                    fileDocument.init({
                        url: 'proceso/upload',
                        path: 'uploads/documentos',
                        id
                    })
                }
            }
        })

        return false
    }
}

const seguimientoActuacion = new SeguimientoActuacion();
