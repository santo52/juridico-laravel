class EntidadJusticia {

    pdf(){
        window.open('/entidades-de-justicia/pdf')
    }

    excel(){
        window.open('/entidades-de-justicia/excel')
    }

    changePais(self) {
        const pais = $(self).val()
        return $.ajax({
            url: '/entidades-de-justicia/departamentos/' + pais,
            success: data => {
                const html = data.map(item => `<option value="${item.id_departamento}">${item.nombre_departamento}</option>`)
                $('#id_departamento').html(html).selectpicker('refresh')
                $('#id_municipio').html('').val('').selectpicker('refresh')
            }
        })
    }

    changeDepartamento(self) {
        const departamento = $(self).val()
        return $.ajax({
            url: '/entidades-de-justicia/municipios/' + departamento,
            success: data => {
                const html = data.map(item => `<option value="${item.id_municipio}">${item.nombre_municipio}</option>`)
                $('#id_municipio').html(html).selectpicker('refresh')
            }
        })
    }

    createEditModal(id) {

        const title = id ? 'Editar entidad de justicia' : 'Crear entidad de justicia'

        $('#createModal').modal()
        $('#createValue').val(id)
        $('#etapaNombre').val('')
        $('#etapaEstado').prop('checked', true).change()
        $('#primeraInstancia').prop('checked', false).change()
        $('#segundaInstancia').prop('checked', false).change()
        $('#createTitle').text(title)
        $('#id_departamento').html('')
        $('#id_municipio').html('')
        $('#id_pais,#id_departamento,#id_municipio').val('').selectpicker('refresh')

        if (id) {
            $.ajax({
                url: '/entidades-de-justicia/get/' + id,
                success: ({ entidadJusticia }) => {
                    $('#etapaNombre').val(entidadJusticia.nombre_entidad_justicia)
                    $('#etapaCorreo').val(entidadJusticia.email_entidad_justicia)
                    $('#etapaEstado').prop('checked', entidadJusticia.estado_entidad_justicia == 1).change()
                    $('#primeraInstancia').prop('checked', entidadJusticia.aplica_primera_instancia == 1).change()
                    $('#segundaInstancia').prop('checked', entidadJusticia.aplica_segunda_instancia == 1).change()

                    $('#id_pais').val(entidadJusticia.municipio.departamento.id_pais).selectpicker('refresh')
                    this.changePais($('#id_pais'))
                    .then(() => {
                        $('#id_departamento').val(entidadJusticia.municipio.id_departamento).selectpicker('refresh')
                        this.changeDepartamento($('#id_departamento'))
                        .then(() => {
                            $('#id_municipio').val(entidadJusticia.id_municipio).selectpicker('refresh')
                        })
                    })

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
            id && formData.append('id_entidad_justicia', id)

            $.ajax({
                url: '/entidades-de-justicia/upsert',
                data: new URLSearchParams(formData),
                success: data => {
                    if (data.saved) {
                        alert('Se ha guardado satisfactoriamente!');
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
            url: '/entidades-de-justicia/delete/' + id,
            data: {},
            success: () => {
                location.reload()
            }
        })
    }

}

const entidadJusticia = new EntidadJusticia()
