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
            url: '/seguimiento-procesos/etapas-de-proceso/actuacion/all/' + id_etapa_proceso,
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
            url: '/seguimiento-procesos/etapas-de-proceso/get/' + id_etapa_proceso,
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
                url: '/seguimiento-procesos/etapas-de-proceso/actuacion/insert',
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

    addComentarioModal(id) {
        $('#comentariosModal').modal();
        $('#idProcesoBitacora').val(id || '')
        $('#comentarioProceso').val('')
        $.ajax({
            url: '/seguimiento-procesos/comentario/get/' + id,
            success: data => {
                $('#comentarioProceso').val(data.comentario)
            }
        })
    }

    closeComentarioModal() {
        $('#comentariosModal').modal('hide');
    }

    closeActuacionModal() {
        $('#actuacionModal').modal('hide');
    }

    openDeleteComentario(id) {
        $('#deleteModal').modal()
        $('#deleteValue').val(id)
    }

    deleteComentario() {
        const id = $('#deleteValue').val()
        $.ajax({
            url: '/seguimiento-procesos/comentario/delete/' + id,
            success: ({ deleted }) => {
                if(deleted) {
                    $('#comentarioRow' + id).remove();
                }
            }
        })

        $('#deleteModal').modal('hide')
    }

    saveComentario(e) {
        e.preventDefault()
        e.stopPropagation()

        const formData = new FormData(e.target)
        formData.append('id_proceso', getId());
        $.ajax({
            url: '/seguimiento-procesos/comentario/upsert',
            data: new URLSearchParams(formData),
            success: ({ saved }) => {
                if(saved) {
                    const $table = $('#comentariosTable')
                    const $row = $('#comentarioRow' + saved.id_proceso_bitacora)
                    const html = `
                        <tr id="comentarioRow${saved.id_proceso_bitacora}">
                            <td>${saved.fechaCreacion}</td>
                            <td>${saved.nombreUsuario}</td>
                            <td>${saved.comentario}</td>
                            <td>
                            <div class="flex justify-center table-actions">
                                <a onClick="seguimientoProceso.addComentarioModal('${saved.id_proceso_bitacora}')" class="btn text-primary" type="button">
                                    <span class="glyphicon glyphicon-pencil"></span>
                                </a>
                                <a onclick="seguimientoProceso.openDeleteComentario('${saved.id_proceso_bitacora}')" href="javascript:void(0)" class="btn text-danger" type="button">
                                    <span class="glyphicon glyphicon-remove"></span>
                                </a>
                            </div>
                            </td>
                        </tr>
                    `
                    $table.find('.footable-empty').remove();
                    if($row.length) {
                        $row.replaceWith(html)
                    } else {
                        $table.find('tbody').prepend(html)
                    }

                    $table.footable();
                }
                this.closeComentarioModal()
            }
        })

        return false
    }
}


const seguimientoProceso = new SeguimientoProceso();
