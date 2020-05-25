class EntidadJusticia {

    pdf(){
        window.open('/entidades-de-justicia/pdf')
    }

    excel(){
        window.open('/entidades-de-justicia/excel')
    }

    createEditModal(id) {

        const title = id ? 'Editar entidad de justicia' : 'Crear entidad de justicia'

        $('#createModal').modal()
        $('#createValue').val(id)
        $('#etapaNombre').val('')
        $('#etapaEstado').prop('checked', true).change()
        $('#primeraInstancia').prop('checked', false).change()
        $('#segundaInstancia').prop('checked', false).change()
        $('#createTitle').text(title)

        if (id) {
            $.ajax({
                url: '/entidades-de-justicia/get/' + id,
                success: ({ entidadJusticia }) => {
                    $('#etapaNombre').val(entidadJusticia.nombre_entidad_justicia)
                    $('#etapaEstado').prop('checked', entidadJusticia.estado_entidad_justicia == 1).change()
                    $('#primeraInstancia').prop('checked', entidadJusticia.aplica_primera_instancia == 1).change()
                    $('#segundaInstancia').prop('checked', entidadJusticia.aplica_segunda_instancia == 1).change()
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
