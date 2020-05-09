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
                url: '/etapas-de-proceso/get/' + id,
                success: ({ etapaProceso, actuaciones }) => {
                    $('#etapaNombre').val(etapaProceso.nombre_etapa_proceso)
                    $('#etapaEstado').prop('checked', etapaProceso.estado_etapa_proceso == 1).change()

                    const html = actuaciones.map(a => `<option value="${a.id_actuacion}">${a.nombre_actuacion}</option>`)
                    $('#actuacionesList').html(html).selectpicker('refresh')


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
                url: '/etapas-de-proceso/upsert',
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
            url: '/etapas-de-proceso/delete/' + id,
            data: {},
            success: () => {
                location.reload()
            }
        })
    }

    addRow(id, name) {
        return `
            <tr data-id="${id}" class="ui-state-default">
                <td><span class="ui-icon ui-icon-arrowthick-2-n-s"></span>${name}</td>
                <td width="30px" class="sortable-column-delete" >
                    <div class="flex justify-center table-actions">
                        <a class="text-danger" href="javascript:void(0)" class="btn text-danger" type="button"
                            onclick="etapaProceso.deleteActuacion(${id})">
                            <span class="glyphicon glyphicon-remove"></span>
                        </a>
                    </div>
                </td>
            </tr>
        `
    }

    sortableStart(_, ui) {
        $(ui.item).css('background', '#ccc').children('td').css('visibility', 'hidden');
        $(ui.item).find('.footable-first-visible').css('visibility', 'visible');
    }

    sortableStop(_, ui) {
        $(ui.item).css('background', 'inherit').children('td').css('visibility', 'visible');
    }

    sortableUpdate(event, _ ) {
        const $rowList = $(event.target).children('tr') || []
        const orderedList = []

        for(item of $rowList) {
            orderedList.push($(item).data('id'))
        }

        const params = {
            orderedList,
            id_actuacion: getId()
        }

        $.ajax({
            url: '/etapas-de-proceso/actuacion/order/update',
            data: new URLSearchParams(params),
            success: data => {
                console.log(data)
            }
        })
    }

}

const etapaProceso = new EtapaProceso()
