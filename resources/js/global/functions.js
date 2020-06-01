
function validateForm(e){
    e.preventDefault();
    e.stopPropagation();
    const $form = $(e.target)
    $form.find('.has-error').removeClass('has-error')
    const required = validateRequired($form)
    if(required){
        const numeric = validateNumeric($form)
        return numeric
    }

    return required
}

function validateNumeric($form) {
    const numericFields = $form.find('.form-control.numeric, .form-control.money').toArray()
    let completed = true
    numericFields.map(item => {
        const value = $(item).val()
        if(isNaN(value)) {
            if(completed){
                $(item).focus();
                completed = false
            }
            const tagName = $(item).prop('tagName')
            if(tagName === 'SELECT') {
                $(item).parent().parent().addClass('has-error')
            } else {
                $(item).parent().addClass('has-error')
            }
            const message = $(item).hasClass('money') ? 'Debe ser un valor monetario válido.' : 'No es un número válido.'
            showErrorPopover($(item), message, 'top')
        }
    })
    return completed
}

function validateRequired($form){
    const requiredFields = $form.find('select.required, input.required, textarea.required').toArray()
    let completed = true
    requiredFields.map(item => {
        const value = $(item).val()
        if(!value || !value.trim()) {
            if(completed){
                $(item).focus();
                completed = false
            }
            const tagName = $(item).prop('tagName')
            if(tagName === 'SELECT') {
                $(item).parent().parent().addClass('has-error')
            } else {
                $(item).parent().addClass('has-error')
            }
            showErrorPopover($(item), 'Esta información es obligatoria.', 'top')
        }
    })

    return completed;
}



