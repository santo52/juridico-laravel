class EtapaProceso {

    createEditModal(id) {

        const title = id ? 'Editar etapa' : 'Crear etapa'

        $('#createModal').modal()
        $('#createValue').val(id)
        $('#etapaNombre').val('')
        $('#etapaEstado').prop('checked', true).change()
        $('#createTitle').text(title)

        if (id) {
            $.ajax({
                url: '/etapa-proceso/get/' + id,
                success: ({ etapaProceso }) => {
                    $('#etapaNombre').val(etapaProceso.nombre_etapa_proceso)
                    $('#etapaEstado').prop('checked', etapaProceso.estado_etapa_proceso == 1).change()
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
            id && formData.append('id_etapa_proceso', id)

            $.ajax({
                url: '/etapa-proceso/upsert',
                data: new URLSearchParams(formData),
                success: data => {
                    if (data.saved) {
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
            url: '/etapa-proceso/delete/' + id,
            data: {},
            success: () => {
                location.reload()
            }
        })
    }

}

const etapaProceso = new EtapaProceso()
