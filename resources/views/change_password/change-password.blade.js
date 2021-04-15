class ChangePassword {

    upsert(e) {

        e.preventDefault()
        e.stopPropagation()

        if (validateForm(e)) {

            const formData = new FormData(e.target)

            $.ajax({
                url: '/cambiar-contrasena/upsert',
                data: new URLSearchParams(formData),
                success: data => {

                    if (data.invalid) {
                        $('#old-password').parent().addClass('has-error')
                        const text = 'La contraseña anterior es invalida'
                        showErrorPopover($('#old-password'), text, 'top')
                    } else if (data.notconfirmed) {
                        $('#confirm-password').parent().addClass('has-error')
                        const text = 'La nueva contraseña y la confirmación no coinciden'
                        showErrorPopover($('#confirm-password'), text, 'top')
                    } else if (data.saved) {
                        alert('Se ha actualizado la contraseña!')
                        location = '/'
                    }
                }
            })
        }

        return false
    }
}


const changePassword = new ChangePassword();
