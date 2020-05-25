class TipoProceso {

    pdf(){
        window.open('/etapas-de-proceso/pdf')
    }

    excel(){
        window.open('/etapas-de-proceso/excel')
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
                url: '/etapas-de-proceso/upsert',
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
            url: '/tipos-de-proceso/etapa/update',
            data: new URLSearchParams(params),
            success: data => {
                console.log(data)
            }
        })
    }

    renderModalData(id = 0) {
        return $.ajax({
            url: '/tipos-de-proceso/get/' + id,
            success: data => {

                const htmlListaEtapas = data.etapas.map(etapa => `<option value="${etapa.id_etapa_proceso}">${etapa.nombre_etapa_proceso}</option>`)
                $('#listaEtapa').html(htmlListaEtapas.join('')).selectpicker('refresh');

                //addRow
                const htmlSelectedEtapas = data.selectedEtapas.map(e => this.addRow(e.id_etapa_proceso, e.nombre_etapa_proceso))
                $('#tableCreateModal tbody').html(htmlSelectedEtapas.join(''))

                $('#tableCreateModal').footable()
                $("#sortable").sortable({
                    start: this.sortableStart,
                    stop: this.sortableStop,
                    update: this.sortableUpdate,
                }).disableSelection()

                return data
            }
        })
    }

    addEtapa(self) {
        const id_etapa_proceso = $(self).val()
        const id_tipo_proceso = $('#createValue').val() || 0
        if (!id_etapa_proceso) {
            return false
        }

        $.ajax({
            url: '/tipos-de-proceso/etapa/insert',
            data: new URLSearchParams({ id_etapa_proceso, id_tipo_proceso }),
            success: () => {
                this.renderModalData(id_tipo_proceso)
            }
        })
    }

    createEditModal(id = 0) {
        $('#createModal').modal()
        $('#createValue').val(id)
        const title = id ? 'Editar tipo de proceso' : 'Nuevo tipo de proceso'
        $('#createTitle').text(title)
        $('#tipoNombre').val('')
        this.renderModalData(id).then(({ tipoProceso }) => {
            if (tipoProceso) {
                $('#tipoNombre').val(tipoProceso.nombre_tipo_proceso)
                $('#tipoEstado').prop('checked', tipoProceso.estado_tipo_proceso == 1).change()
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
            id && formData.append('id_tipo_proceso', id)

            $.ajax({
                url: '/tipos-de-proceso/upsert',
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

    delete() {
        const id = $('#deleteValue').val()
        $.ajax({
            url: '/tipos-de-proceso/delete/' + id,
            data: {},
            success: () => {
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
            url: '/tipos-de-proceso/etapa/delete',
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


const tipoProceso = new TipoProceso()
