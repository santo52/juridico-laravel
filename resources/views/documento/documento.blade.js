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
