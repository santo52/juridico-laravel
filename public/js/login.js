class Login {

    send(e) {

        e.preventDefault()
        e.stopPropagation()

        if (validateForm(e)) {

            const $form = $(e.target);
            const arrayForm = new URLSearchParams(new FormData($form[0]));

            $.ajax({
                url: "/login",
                data: arrayForm,
                success: ({ auth }) => {
                    if (auth) {
                        location.reload();
                    } else {
                        $('#user, #password')
                            .parents('.form-group')
                            .addClass('has-error')
                    }
                }
            })
        }

        return false;

    }

}

const login = new Login()
