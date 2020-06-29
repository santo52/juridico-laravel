class EntidadDemandada {

    pdf(){
        window.open('/entidades-demandadas/pdf')
    }

    excel(){
        window.open('/entidades-demandadas/excel')
    }

    createEditModal(id) {

        const title = id ? 'Editar entidad demandada' : 'Crear entidad demandada'

        $('#createModal').modal()
        $('#createValue').val(id)
        $('#etapaNombre').val('')
        $('#etapaEstado').prop('checked', true).change()
        $('#createTitle').text(title)

        if (id) {
            $.ajax({
                url: '/entidades-demandadas/get/' + id,
                success: ({ entidadDemandada }) => {
                    $('#etapaNombre').val(entidadDemandada.nombre_entidad_demandada)
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
