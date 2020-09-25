class GestionProcesosActivos {
    generatePDF(e) {

        if (validateForm(e)) {

            const formData = new FormData(e.target);

            $.ajax({
                url: '/gestion-procesos-activos/pdf',
                data: new URLSearchParams(formData),
                success: data => {
                    console.log('data', data)
                }
            })
        }
    }

    generateExcel(e) {

        if (validateForm(e)) {

            const formData = new FormData(e.target);

            $.ajax({
                url: '/gestion-procesos-activos/excel',
                data: new URLSearchParams(formData),
                success: data => {
                    console.log('data', data)
                }
            })
        }
    }
}

const gestionProcesosActivos = new GestionProcesosActivos()
