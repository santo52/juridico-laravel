
function validateForm(e){
    e.preventDefault();
    e.stopPropagation();
    $(e.target).find('.has-error').removeClass('has-error')
    const requiredFields = $(e.target).find('.required').toArray()

    let completed = true
    requiredFields.map(item => {
        const value = $(item).val()
        if(!value.trim()) {
            if(completed){
                $(item).focus();
                completed = false
            }
            $(item).parents('.form-group').eq(0).addClass('has-error')
        }
    })

    return completed;
}




