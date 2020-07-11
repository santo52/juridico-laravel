class TipoResultado {

    pdf(){
        window.open('/tipos-de-resultado/pdf')
    }

    excel(){
        window.open('/tipos-de-resultado/excel')
    }

    createEtapaOpen(){
        $('#tipoProcesoEtapaPopover').popover('show')
    }

    popoverClose() {
        $('#tipoProcesoEtapaPopover').popover('hide')
    }

    createEtapa() {

        const nombre_etapa_proceso = $('#etapaProcesoNombre').val().trim()
        if(nombre_etapa_proceso) {
            const data = {
                nombre_etapa_proceso,
                estado: 1
            }

            $.ajax({
                url: '/tipos-de-resultado/upsert',
                data: new URLSearchParams(data),
                success: data => {
                    const id = $('#createValue').val() || 0
                    this.renderModalData(id)
                    $('#tipoProcesoEtapaPopover').popover('hide')
                }
            })
        }
    }

    sortableStart(_, ui ) {
        $(ui.item).find('.footable-last-visible a').hide()
    }

    sortableStop(_, ui ) {
        $(ui.item).find('.footable-last-visible a').show()
    }

    sortableUpdate(event, _ ) {
        const $rowList = $(event.target).children('tr') || []
        const orderedList = []

        for(item of $rowList) {
            orderedList.push($(item).data('id'))
        }

        const params = {
            orderedList,
            id_tipo_proceso: $('#createValue').val() || 0
        }

        $.ajax({
            url: '/tipos-de-resultado/etapa/update',
            data: new URLSearchParams(params),
            success: data => {
                console.log(data)
            }
        })
    }

    renderModalData(id = 0) {
        return $.ajax({
            url: '/tipos-de-resultado/get/' + id,
            success: data => {
                return data
            }
        })
    }

    createEditModal(id = 0) {
        $('#createModal').modal()
        $('#createValue').val(id)
        const title = id ? 'Editar tipo de resultado' : 'Nuevo tipo de resultado'
        $('#createTitle').text(title)
        $('#tipoNombre').val('')
        this.renderModalData(id).then(({ tipoResultado }) => {
            if (tipoResultado) {
                $('#tipoNombre').val(tipoResultado.nombre_tipo_resultado)
                $('#tipoCampo').val(tipoResultado.tipo_campo).selectpicker('refresh')
                $('#tipoEstado').prop('checked', tipoResultado.unico_tipo_resultado == 1).change()
            }
        })

    }

    openDelete(id) {
        $('#deleteModal').modal()
        $('#deleteValue').val(id)
    }

    upsert(e) {

        e.preventDefault()
        e.stopPropagation()

        if (validateForm(e)) {

            const id = $('#createValue').val()
            const formData = new FormData(e.target)
            id && formData.append('id_tipo_resultado', id)

            $.ajax({
                url: '/tipos-de-resultado/upsert',
                data: new URLSearchParams(formData),
                success: data => {
                    if (data.saved) {
                        alert('Se ha guardado satisfactoriamente!');
                        location.hash = "#tipos-de-resultado"
                        location.reload()
                    } else if (data.exists) {
                        $('#etapaNombre').parent().addClass('has-error')
                    }
                }
            })
        }

        return false
    }

    delete() {
        const id = $('#deleteValue').val()
        $.ajax({
            url: '/tipos-de-resultado/delete/' + id,
            data: {},
            success: () => {
                location.hash = "#tipos-de-resultado"
                location.reload()
            }
        })
    }

    deleteEtapa(id) {
        const id_tipo_proceso = $('#createValue').val() || 0;
        const params = {
            id_etapa_proceso: id,
            id_tipo_proceso
        }

        $.ajax({
            url: '/tipos-de-resultado/etapa/delete',
            data: new URLSearchParams(params),
            success: data => {
                this.renderModalData(id_tipo_proceso)
            }
        })
    }

    addRow(id_etapa_proceso, nombre_etapa_proceso) {
        //
        return `
            <tr data-id="${id_etapa_proceso}" class="ui-state-default" style="cursor:move">
                <td>${nombre_etapa_proceso}</td>
                <td width="30px" class="sortable-column-delete" >
                    <div class="flex justify-center table-actions">
                        <a class="text-danger" href="javascript:void(0)" class="btn text-danger" type="button"
                            onclick="tipoProceso.deleteEtapa(${id_etapa_proceso})">
                            <span class="glyphicon glyphicon-remove"></span>
                        </a>
                    </div>
                </td>
            </tr>
        `
    }
}


const tipoResultado = new TipoResultado()
