class GestionOrganizacionalReporte {
    generatePDF(e) {

        if (validateForm(e)) {

            const formData = new FormData(e.target);
            const data = new URLSearchParams(formData).toString()
            window.open('/gestion-organizacional/pdf?' + data)
        }
    }

    generateExcel(e) {

        if (validateForm(e)) {

            const formData = new FormData(e.target);

            $.ajax({
                url: '/gestion-organizacional/excel',
                data: new URLSearchParams(formData),
                success: data => {
                    console.log('data', data)
                }
            })
        }
    }
}

const gestionOrganizacionalReporte = new GestionOrganizacionalReporte()
