class Perfil {

    openDelete(id) {
        $('#deleteModal').modal()
        $('#deleteValue').val(id)
    }

    createEditModal(id) {
        const text = id ? 'Editar perfil' : 'Nuevo perfil'
        const that = this

        $('#createModal').modal()
        $('#createValue').val(id)
        $('#createTitle').text(text)

        $.ajax({
            url: '/perfil/get/' + (id || 0),
            success: data => {
                let html = data.menus.map(menu => `<option value="${menu.id_menu}">${menu.nombre_menu}</option>`)
                $('#listaMenu').html(html).selectpicker('refresh')
                html = data.selectedMenus.map(menu => that.getRow(menu.id_menu_perfil, menu.nombre_menu))
                $('#tableCreateModal tbody').html(html)
                $('#tableCreateModal').footable()
                $('#perfilNombre').val(data.perfil ? data.perfil.nombre_perfil : '')
                $('#perfilEstado').prop('checked', data.perfil ? data.perfil.inactivo == 0 : true).change()
            }
        })
    }

    create(e){

        e.preventDefault()
        e.stopPropagation()

        const id = $('#createValue').val()
        const $formData = new FormData(e.target)
        $formData.append('id_perfil', id)

        $.ajax({
            url: '/perfil/create',
            data: new URLSearchParams($formData),
            success: data => {
                $('#createModal').modal('hide')
                setTimeout(() => {
                    location.reload()
                }, 500);
            }
        })

        return false
    }

    addMenu() {
        const id_menu = $('#listaMenu').val()
        const id_perfil = $('#createValue').val() || 0
        const params = { id_menu, id_perfil }
        $.ajax({
            url: '/perfil/menu/insert',
            data: new URLSearchParams(params),
            success: ({ saved, menu_perfil }) => {
                if(saved) {
                    const $selected = $('#listaMenu').children('option:selected')
                    const nombre = $selected.text().trim()
                    $selected.remove()

                    const html = this.getRow(menu_perfil.id_menu_perfil, nombre)
                    $('#tableCreateModal tbody').append(html).children('.footable-empty').remove()
                    $('#tableCreateModal').footable()
                    $('#listaMenu').selectpicker('refresh')
                }
            }
        })
    }

    deleteMenu(id){
        $.ajax({
            url: '/perfil/menu/delete/' + id,
            success: ({ deleted }) => {
                if(deleted){
                    $('#menuRow' + id).remove()
                }
            }
        })
    }

    getRow(id_menu_perfil, nombre){
        return `
            <tr id="menuRow${id_menu_perfil}">
                <td>${nombre}</td>
                <td width="30px">
                    <div class="flex justify-center table-actions">
                        <a href="javascript:void(0)" class="btn text-danger" type="button" onclick="perfil.deleteMenu(${id_menu_perfil})">
                            <span class="glyphicon glyphicon-remove"></span>
                        </a>
                    </div>
                </td>
            </tr>
        `
    }
}

const perfil = new Perfil()
