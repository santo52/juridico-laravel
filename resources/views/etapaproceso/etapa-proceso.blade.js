class EtapaProceso {

    pdf(){
        window.open('/etapas-de-proceso/pdf')
    }

    excel(){
        window.open('/etapas-de-proceso/excel')
    }

    createActuacion(){
        $('#createModal').modal('hide')
        $('.modal-backdrop').remove()
        $('body').removeClass('modal-open')
        window.open('/#actuacion/crear')
    }

    closeCreateModal() {
        $('#createModal')
            .removeClass('open')
            .modal('hide')
    }

    renderModalData(id){
        return $.ajax({
            url: '/etapas-de-proceso/get/' + (id || 0),
            success: data => {
                const { actuaciones, selectedActuaciones } = data

                const htmlActuaciones = actuaciones.map(a => `<option value="${a.id_actuacion}">${a.nombre_actuacion}</option>`)
                $('#actuacionesList').html(htmlActuaciones).selectpicker('refresh')

                const htmlSelected = selectedActuaciones.map(a => this.addRow(a.id_actuacion_etapa_proceso, a.nombre_actuacion, a.tiempo_maximo_proxima_actuacion, a.unidad_tiempo_proxima_actuacion))
                $('#sortable').html(htmlSelected)

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

    asociarActuacionModal(type = 'show') {
        $('#idActuacionEtapaProceso').val('')
        $('#actuacionesList').val('').selectpicker('refresh')
        $('#UnidadTiempoProximaActuacion').val(1).selectpicker('refresh')
        $('#tiempoMaximoProximaActuacion').val('')
        $('#createModal').css('opacity', type === 'show' ? .7 : 1)
        $('#actuacionModal').modal(type)
        setTimeout(() => {
            $('body').addClass('modal-open')
        }, 500)
    }

    addActuacion(e) {

        e.preventDefault()
        e.stopPropagation()

        const id_actuacion = $('#actuacionesList').val()
        const id_etapa_proceso = $('#createValue').val() || 0
        if (!id_actuacion) {
            return false
        }

        const formData = new FormData(e.target)
        formData.append('id_etapa_proceso', id_etapa_proceso)

        $.ajax({
            url: '/etapas-de-proceso/actuacion/insert',
            data: new URLSearchParams(formData),
            success: () => {
                this.renderModalData(id_etapa_proceso)
                this.asociarActuacionModal('hide')
            }
        })

        return false
    }

    createEditModal(id) {

        const title = id ? 'Editar etapa' : 'Crear etapa'

        $('#createModal').addClass('open').modal()
        $('#createValue').val(id)
        $('#etapaNombre').val('')
        $('#etapaEstado').prop('checked', true).change()
        $('#createTitle').text(title)

        this.renderModalData(id)
        .then(({ etapaProceso }) => {
            $('#etapaNombre').val(etapaProceso.nombre_etapa_proceso)
            $('#etapaEstado').prop('checked', etapaProceso.estado_etapa_proceso == 1).change()
        })
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
                        alert('Se ha guardado satisfactoriamente!');
                        $('#createModal').removeClass('open').modal('hide')
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

    deleteActuacion(id) {
        $.ajax({
            url: '/etapas-de-proceso/actuacion/delete/' + id,
            data: {},
            success: ({ deleted }) => {
                if(deleted){
                    $('#actuacionRow' + id).remove()
                }
            }
        })
    }

    editActuacion(id) {
        this.asociarActuacionModal('show')
        $.ajax({
            url: '/etapas-de-proceso/actuacion/get/' + id,
            success: data => {
                $('#tiempoMaximoProximaActuacion').val(data.tiempo_maximo_proxima_actuacion)
                $('#UnidadTiempoProximaActuacion').val(data.unidad_tiempo_proxima_actuacion).selectpicker('refresh')
                $('#idActuacionEtapaProceso').val(data.id_actuacion_etapa_proceso)
                $('#actuacionesList').append(`<option value="${data.id_actuacion}">${data.nombre_actuacion}</option>`)
                $('#actuacionesList').val(data.id_actuacion).selectpicker('refresh')
            }
        })
    }

    getUnityName(unity){
        switch(unity) {
            case 1: return 'Días'
            case 2: return 'Semanas'
            case 3: return 'Meses'
            case 4: return 'Años'
            default: return 'Días'
        }

    }

    addRow(id, name, time, unity) {
        return `
            <tr id="actuacionRow${id}" data-id="${id}" class="ui-state-default">
                <td><span class="ui-icon ui-icon-arrowthick-2-n-s"></span>${name}</td>
                <td><span class="ui-icon ui-icon-arrowthick-2-n-s"></span>${time || 0} ${this.getUnityName(unity)}</td>
                <td width="30px" class="sortable-column-delete" >
                    <div class="flex justify-center table-actions">
                        <a  href="javascript:void(0)" class="text-primary btn" type="button"
                            onclick="etapaProceso.editActuacion(${id})">
                            <span class="glyphicon glyphicon-pencil"></span>
                        </a>
                        <a href="javascript:void(0)" class="text-danger btn" type="button"
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
            id_etapa_proceso: $('#createValue').val()
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
