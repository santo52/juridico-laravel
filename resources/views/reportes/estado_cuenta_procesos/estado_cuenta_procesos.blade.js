class EstadoCuentaReporte {
    generatePDF(e) {

        if (validateForm(e)) {

            const formData = new FormData(e.target);
            const data = new URLSearchParams(formData).toString()
            window.open('/estado-de-cuenta-de-procesos/pdf?' + data)
        }
    }

    generateExcel(e) {

        if (validateForm(e)) {

            const formData = new FormData(e.target);

            $.ajax({
                url: '/estado-de-cuenta-de-procesos/excel',
                data: new URLSearchParams(formData),
                success: data => {
                    console.log('data', data)
                }
            })
        }
    }
}

const estadoCuentaReporte = new EstadoCuentaReporte()
