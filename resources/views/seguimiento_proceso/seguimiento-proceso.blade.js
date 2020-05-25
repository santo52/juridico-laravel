class SeguimientoProceso {


    addActuacion(id_etapa_proceso) {
        $('#actuacionModal').modal()
        $('#idEtapaProceso').val(id_etapa_proceso)
        $('#nombre_actuacion').val('')
        $('#etapaPrimeraActuacion').prop('checked', false).change()
        $('#orderActuacion').val(1)
        $('#tiempoMaximoProximaActuacion').val('')
        $('#UnidadTiempoProximaActuacion').val(1).selectpicker('refresh')
        $('#agregarActuacionDespuesDe').show().val('').addClass('required').selectpicker('refresh')

        $.ajax({
            url: '/etapas-de-proceso/actuacion/all/' + id_etapa_proceso,
            success: actuaciones => {
                if (actuaciones.length) {
                    const html = actuaciones.map(actuacion => `<option value="${actuacion.id_actuacion}">${actuacion.nombre_actuacion}</option>`)
                    $('#actuacionesAfterList').addClass('required').html(html).parents('.form-group').show()
                } else {
                    $('#actuacionesAfterList').removeClass('required').html('').parents('.form-group').hide()
                }

                $('#actuacionesAfterList').val('').selectpicker('refresh')
                $('#orderActuacion').val(actuaciones.length + 1)
            }
        })

        $.ajax({
            url: '/etapas-de-proceso/get/' + id_etapa_proceso,
            success: ({ actuaciones }) => {
                const html = actuaciones.map(data => `<option value="${data.id_actuacion}">${data.nombre_actuacion}</option>`)
                $('#actuacionesList').html(html).val('').selectpicker('refresh')
            }
        })
    }

    saveActuacion(e) {
        e.preventDefault()
        e.stopPropagation()

        if (validateForm(e)) {

            const formData = new FormData(e.target)
            $.ajax({
                url: '/etapas-de-proceso/actuacion/insert',
                data: new URLSearchParams(formData),
                success: data => {
                    location.reload()
                }
            })
        }

        return false
    }

    changeEtapa(self) {
        const $self = $(self)
        const position = $self.data('position')
        const id = $self.data('id')
        const currentPosition = $('#position').val()
        if (position == 0 && currentPosition == 0) {

            const params = new FormData();
            params.append('id_etapa_proceso', id)
            params.append('id_proceso', getId())

            $.ajax({
                url: '/seguimiento-procesos/set-etapa',
                data: new URLSearchParams(params)
            })
        }
    }
}


const seguimientoProceso = new SeguimientoProceso();
