class SeguimientoActuacion {
    openTemplateModal(id = 0) {
        $('#plantillasModal').modal()
    }

    closeTemplateModal() {
        $('#plantillasModal').modal('hide')
    }

    deletePlantilla(id) {
        $.ajax({
            url: '/seguimiento-procesos/actuacion/plantilla/delete/' + id,
            success: ({ deleted, data }) => {
                if (deleted) {
                    $('#plantillaDocumento')
                        .append(`<option value="${data.plantilla_documento.id_plantilla_documento}">${data.plantilla_documento.nombre_plantilla_documento}</option>`)
                        .selectpicker('refresh')

                    $(`.file-document[data-id=${data.id_proceso_etapa_actuacion_plantillas}]`).remove()
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
