console.log('addMedio.js cargado');

document.addEventListener('DOMContentLoaded', function() {
    console.log('DOM cargado');
    const addForm = document.getElementById('addMedioForm');
    const alertElement = document.getElementById('updateAlert2');
    console.log('Formulario encontrado:', addForm);

    if (addForm) {
        addForm.addEventListener('submit', function(e) {
            console.log('Formulario enviado');
            e.preventDefault();

            const formData = new FormData(this);
            console.log('Datos del formulario:', Object.fromEntries(formData));

            console.log('Enviando solicitud a:', '../querys/modulos/addMedio.php');
            fetch('../querys/modulos/addMedio.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.text())
            .then(text => {
                console.log('Respuesta del servidor:', text);
                return JSON.parse(text);
            })
            .then(data => {
                console.log('Datos parseados:', data);
                if (data.success) {
                    // Mostrar alerta de éxito
                    alertElement.className = 'alert alert-success';
                    alertElement.style.display = 'block';
                    alertElement.textContent = 'El registro se agregó correctamente.';

                    // Limpiar el formulario
                    addForm.reset();

                    // Mantener la alerta visible y retrasar el cierre del modal y la recarga de la página
                    setTimeout(() => {
                        // Cerrar el modal
                        $('#modalAdd').modal('hide');
                        // Recargar la página
                        window.location.reload();
                    }, 1000); // 2000 milisegundos = 2 segundos
                } else {
                    alertElement.className = 'alert alert-danger';
                    alertElement.style.display = 'block';
                    alertElement.textContent = 'Error: ' + data.message;
                    if (data.details) {
                        console.error('Detalles del error:', data.details);
                    }
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alertElement.className = 'alert alert-danger';
                alertElement.style.display = 'block';
                alertElement.textContent = 'Ocurrió un error al agregar el medio: ' + error.message;
            });
        });
    } else {
        console.error('El formulario con ID "addMedioForm" no se encontró en el DOM');
    }
});