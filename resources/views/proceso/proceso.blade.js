class Proceso {

    openDelete(id) {
        $('#deleteModal').modal()
        $('#deleteValue').val(id)
    }

    delete(){
        const id = $('#deleteValue').val()
        $.ajax({
            url: '/proceso/delete/' + id,
            success: ({ deleted }) => {
                if(deleted) {
                    $('#tipoProcesoRow' + id).remove()
                    $('#deleteModal').modal('hide')
                }
            }
        })

        return false
    }
}


const proceso = new Proceso();
