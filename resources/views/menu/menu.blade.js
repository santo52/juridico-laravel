class Menu {

    getParents() {
        $.ajax({
            url: '/opciones/menu/parents',
            data: {},
            success: ({ parents }) => {
                let html = [];
                html.push('<option value="0">Sin padre</option>')
                parents.map(parent => html.push(`<option value="${parent.id_menu}">${parent.nombre_menu}</option>`))
                $('#create_parent_id').html(html.join('')).selectpicker('refresh');
            }
        })
    }

    toggleRutaMenu(value){
        const $ruta = $('#create_ruta_menu');
        if(!parseInt(value)) {
            $ruta.val('').removeClass('required').parent('.form-group').hide()
        } else {
            $ruta.val('').addClass('required').parent('.form-group').show()
        }
    }

    onChangeSelect(self){
        const value = $(self).val()
        this.toggleRutaMenu(value)
    }

    createModal(id) {
        const title = id ? 'Crear' : 'Editar'
        this.getParents()

        $('#createModal').modal()
        $('#createTitle').text(title)
        $('#idCreateElement').val(id)
        $('#create_nombre_menu').val('')
        $('#create_ruta_menu').val('')
        $('#create_orden_menu').val('')
        $('#create_parent_id').val('')
        .selectpicker('refresh')

        if(id) {
            $.ajax({
                url: '/opciones/menu/' + id,
                data: {},
                success: data => {
                    setTimeout(() => {
                        this.toggleRutaMenu(data.parent_id)
                        $('#create_nombre_menu').val(data.nombre_menu)
                        $('#create_ruta_menu').val(data.ruta_menu)
                        $('#create_orden_menu').val(data.orden_menu)
                        $('#create_parent_id').val(data.parent_id || 0).selectpicker('refresh')
                    }, 500);
                }
            })
        }
    }

    upsert(e) {

        e.preventDefault()
        e.stopPropagation()

        if(validateForm(e)){

            const id = $('#idCreateElement').val()
            const formData = new FormData(e.target)
            id && formData.append('id_menu', id)

            $.ajax({
                url: '/opciones/menu/upsert',
                data: new URLSearchParams(formData),
                success: data => {
                    if(data.saved){
                        location.reload()
                    } else if(data.exists) {
                        $('#create_nombre_menu').parent().addClass('has-error')
                    }
                }
            })
        }

        return false
    }


    openDelete(id){
        $('#deleteModal').modal()
        $('#deleteValue').val(id)
    }

    delete(){
        const id = $('#deleteValue').val()
        $.ajax({
            url: '/opciones/menu/delete/' + id,
            data: { id },
            success: () => {
                location.reload()
            }
        })
    }

}

const menu = new Menu()
