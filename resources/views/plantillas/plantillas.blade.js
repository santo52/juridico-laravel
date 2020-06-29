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
