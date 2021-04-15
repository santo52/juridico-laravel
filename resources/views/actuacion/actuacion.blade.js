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

            formData.append('documents', documents)
            formData.append('templates', templates)

            $.ajax({
                url,
                data: new URLSearchParams(formData),
                success: data => {
                    if (data.exists) {
                        showErrorPopover($('#nombreActuacion'), 'Ya existe una actuación con este nombre', 'top');
                    } else if (data.saved) {
                        alert('Se ha guardado satisfactoriamente!');
                        $('.validate').removeClass('open')
                        window.history.back();
                    }
                }
            })
        }
        return false
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
}

const actuacion = new Actuacion()

