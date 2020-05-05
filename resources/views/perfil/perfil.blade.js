class Perfil {

    openDelete(id) {
        $('#deleteModal').modal()
        $('#deleteValue').val(id)
    }

    addSelectListener(){
        $("#tableCreateModal select").on("changed.bs.select", function(e, clickedIndex, newValue, oldValue) {
            const id_menu_perfil = $(this).data('menu-perfil')
            const id_accion = $(this).find('option').eq(clickedIndex).val();
            $.ajax({
                url: '/perfil/menu/accion/addremove',
                data: new URLSearchParams({ id_menu_perfil, id_accion, add: !!newValue })
            })
         });
    }

    redrawTableModal(id){
        return $.ajax({
            url: '/perfil/get/' + (id || 0),
            success: data => {

                let html = data.menus.map(menu => `<option value="${menu.id_menu}">${menu.nombre_menu}</option>`)
                $('#listaMenu').html(html).selectpicker('refresh')

                html = data.selectedMenus.map(menu => this.getRow(menu.id_menu_perfil, menu.nombre_menu, menu.acciones))

                $('#tableCreateModal tbody').html(html).children('.footable-empty').remove()
                $('#tableCreateModal').footable()
                $('#tableCreateModal select').selectpicker('refresh')

                this.addSelectListener()
                return data
            }
        })
    }

    createEditModal(id) {
        const text = id ? 'Editar perfil' : 'Nuevo perfil'
        $('#createModal').modal()
        $('#createValue').val(id)
        $('#createTitle').text(text)
        this.redrawTableModal(id).then(data => {
            $('#perfilNombre').val(data.perfil ? data.perfil.nombre_perfil : '')
            $('#perfilEstado').prop('checked', data.perfil ? data.perfil.inactivo == 0 : true).change()
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

        if(!id_menu) {
            return false
        }

        $.ajax({
            url: '/perfil/menu/insert',
            data: new URLSearchParams(params),
            success: ({ saved }) => {
                if(saved) {
                    this.redrawTableModal(id_perfil)
                }
            }
        })
    }

    deleteMenu(id){
        $.ajax({
            url: '/perfil/menu/delete/' + id,
            success: ({ deleted, menuItem }) => {
                if(deleted){
                    $('#menuRow' + id).remove()
                    const name = menuItem.nombre_menu
                    const value = menuItem.id_menu
                    $('#listaMenu')
                        .append(`<option value="${value}">${name}</option>`)
                        .selectpicker('refresh')
                }
            }
        })
    }

    delete(){
        const id = $('#deleteValue').val()
        $.ajax({
            url: '/perfil/delete/' + id,
            success: ({ deleted }) => {
                if(deleted) {
                    $('#deleteModal').modal('hide')
                    $('#perfilRow' + id).remove()
                }
            }
        })
    }

    getRow(id_menu_perfil, nombre, acciones){

        const html = (acciones || []).map(a =>
            `<option value="${a.id_accion}" ${a.selected ? 'selected' : ''}>${a.nombre_accion}</option>`
        )

        return `
            <tr id="menuRow${id_menu_perfil}">
                <td>${nombre}</td>
                <td>
                <select data-menu-perfil="${id_menu_perfil}" class="selectpicker" title="Seleccionar ..." multiple>
                    ${html.join('')}
                </select>
                </td>
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
