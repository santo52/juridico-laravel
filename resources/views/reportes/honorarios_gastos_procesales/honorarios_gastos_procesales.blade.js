class HonorariosReportes {
    generatePDF(e) {

        if (validateForm(e)) {

            const formData = new FormData(e.target);
            const data = new URLSearchParams(formData).toString()
            window.open('/honorarios-y-gastos-procesales/pdf?' + data)
        }
    }

    generateExcel(e) {

        if (validateForm(e)) {

            const formData = new FormData(e.target);

            $.ajax({
                url: '/honorarios-y-gastos-procesales/excel',
                data: new URLSearchParams(formData),
                success: data => {
                    console.log('data', data)
                }
            })
        }
    }
}

const honorariosReportes = new HonorariosReportes()
