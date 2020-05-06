class Actuacion {

    pdf(){
        window.open('/actuacion/pdf')
    }

    excel(){
        window.open('/actuacion/excel')
    }

    update(e) {
        e.preventDefault()
        e.stopPropagation()
        this.save(e, '/actuacion/update/' + getId())
        return false
    }

    create(e) {
        e.preventDefault()
        e.stopPropagation()
        this.save(e, '/actuacion/insert')
        return false
    }

    delete() {
        const id = $('#deleteValue').val()
        $.ajax({
            url: '/actuacion/delete/' + id,
            data: {},
            success: data => {
                if (data.deleted) {
                    $('#actRow' + id).remove();
                    $('#deleteModal').modal('hide')
                }
            }
        })
        return false
    }

    openDelete(id){
        $('#deleteModal').modal()
        $('#deleteValue').val(id)
        return false;
    }

    save(e, url) {
        e.preventDefault()
        e.stopPropagation()
        if (validateForm(e)) {

            const formData = new FormData(e.target)
            const documents = []
            const templates = []
            $('#tblDocumentos tbody tr').toArray().map(item => {
                const value = $(item).data('value')
                value && documents.push(value)
            })

            $('#tblPlantillasDocumento tbody tr').toArray().map(item => {
                const value = $(item).data('value')
                value && templates.push(value)
            })

            if (!documents.length || !templates.length) {
                this.alert(documents.length, templates.length)
                return false
            }

            formData.append('documents', documents)
            formData.append('templates', templates)

            $.ajax({
                url,
                data: new URLSearchParams(formData),
                success: data => {
                    if (data.exists) {
                        showErrorPopover($('#nombreActuacion'), 'Ya existe una actuación con este nombre', 'top');
                    } else if (data.saved) {
                        location.hash = 'actuacion/listar'
                    }
                }
            })
        }
        return false
    }

    alert(documents, templates) {

        const message = []
        if (!documents) { message.push('un documento') }
        if (!templates) { message.push('una plantilla') }

        const html = `
        <div class="alert alert-danger alert-dismissible fade in" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
            Se debe agregar al menos ${message.join(' y ')}
        </div>
  `
        $('#alertaDocumentos').html(html)
        setTimeout(() => {
            $('#alertaDocumentos').children().alert('close')
        }, 5000)
    }

    removeDocument(self) {
        $(self).parents('tr').eq(0).remove()
    }

    addDocumentTemplate(self) {
        const { name, value } = this.getDocumentValues(self)

        if (!$(`#tmpDocumentRow${value}`).length) {
            const html = `
            <tr id="tmpDocumentRow${value}" data-value="${value}">
                <td class="plantillas-documento">${name}</td>
                <td class="center">
                    <button class="btn btn-danger btn-xs" type="button" onclick="actuacion.removeDocument(this);">
                        <span class="glyphicon glyphicon-minus"></span>
                    </button>
                </td>
            </tr>
        `
            $('#tblPlantillasDocumento').footableAdd(html)
        }
    }

    getDocumentValues(self) {
        const $document = $(self)
        const name = $document.children('option:selected').text().trim()
        const value = $document.val()
        $document.val('')
        return { name, value }
    }

    addDocument(self) {

        const { name, value } = this.getDocumentValues(self)
        if (!$(`#documentsRow${value}`).length) {
            const html = `
        <tr id="documentsRow${value}" data-value="${value}">
            <td class="documentos">${name}</td>
            <td class="center">
                <button class="btn btn-danger btn-xs" type="button" onclick="actuacion.removeDocument(this);">
                    <span class="glyphicon glyphicon-minus"></span>
                </button>
            </td>
        </tr>`
            $('#tblDocumentos').footableAdd(html)
        }
    }

    etapaModal(id = 0) {

        const title = id ? 'Editar etapa' : 'Agregar etapa'
        $('#etapaModalUpsert').modal()
        $('#etapaModalId').val(id)
        $('#etapaModalTitle').text(title)

        $.ajax({
            url: '/actuacion/etapas/get/' + id,
            success: data => {
                const etapasHTML = data.etapasProceso.map(e => `<option value="${e.id_etapa_proceso}">${e.nombre_etapa_proceso}</option>`)
                $('#etapasList').html(etapasHTML.join('')).selectpicker('refresh')
                if(data.actuacionEtapaProceso) {
                    $('#etapasList').val(data.actuacionEtapaProceso.id_etapa_proceso)
                    $('#etapaMaximoTiempo').val(data.actuacionEtapaProceso.tiempo_maximo_proxima_actuacion)
                    $('#etapaUnidadMaximoTiempo').val(data.actuacionEtapaProceso.unidad_tiempo_proxima_actuacion)
                }

                $('#etapasList').selectpicker('refresh')
            }
        })
    }

    etapaUpsert(e) {

        e.preventDefault()
        e.stopPropagation()

        if (validateForm(e)) {

            const formData = new FormData(e.target)
            formData.append('id_actuacion', getId())

            $.ajax({
                url: '/actuacion/etapas/upsert',
                data: new URLSearchParams(formData),
                success: data => {
                    if(data.saved){
                        console.log(data.saved)
                        location.reload()
                    }
                }
            })
        }

        return false
    }

    removeEtapaModal(id){
        $('#deleteEtapaValue').val(id)
        $('#deleteEtapaModal').modal()
    }

    deleteEtapa(){
        const id = $('#deleteEtapaValue').val()
        $.ajax({
            url: '/actuacion/etapas/delete/' + id,
            success: data => {
                if(data.deleted) {
                    location.reload()
                }
            }
        })
    }

    sortableStart(_, ui ) {
        $(ui.item).css('background', '#ccc').children('td').css('visibility', 'hidden')
        $(ui.item).find('.footable-first-visible').css('visibility', 'visible')
    }

    sortableStop(_, ui ) {
        $(ui.item).css('background', 'inherit').children('td').css('visibility', 'visible')
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
            url: '/actuacion/etapas/order/update',
            data: new URLSearchParams(params),
            success: data => {
                console.log(data)
            }
        })
    }
}

const actuacion = new Actuacion()

