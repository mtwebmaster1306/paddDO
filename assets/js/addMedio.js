document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('addMedioForm');
    
    form.addEventListener('submit', function(e) {
        e.preventDefault();
        
        const formData = new FormData(form);
        
        fetch('/querys/modulos/addMedio.php', {
            method: 'POST',
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                Swal.fire({
                    title: '¡Éxito!',
                    text: 'El medio ha sido agregado correctamente.',
                    icon: 'success',
                    timer: 1500,
                    showConfirmButton: false
                }).then(() => {
                    $('#modalAdd').modal('hide');
                    form.reset();
                    updateTable(); // Actualizar la tabla inmediatamente después de agregar
                });
            } else {
                Swal.fire({
                    title: 'Error',
                    text: 'No se pudo agregar el medio. Por favor, intente de nuevo.',
                    icon: 'error',
                    confirmButtonText: 'OK'
                });
            }
        })
        .catch(error => {
            console.error('Error:', error);
            Swal.fire({
                title: 'Error',
                text: 'Ocurrió un error al procesar la solicitud.',
                icon: 'error',
                confirmButtonText: 'OK'
            });
        });
    });

    // Iniciar la actualización automática
    startAutoUpdate();
});

function updateTable() {
    console.log('Actualizando tabla...');
    fetch('/querys/modulos/getMedios.php')
        .then(response => {
            console.log('Status de la respuesta:', response.status);
            console.log('Headers de la respuesta:', Object.fromEntries(response.headers));
            return response.text();
        })
        .then(text => {
            console.log('Respuesta cruda:', text);
            if (text.trim() === '') {
                throw new Error('La respuesta está vacía');
            }
            try {
                const data = JSON.parse(text);
                console.log('Datos parseados:', data);
                if (data.error) {
                    throw new Error(`Error del servidor: ${data.error}`);
                }
                // Aquí va el código para actualizar la tabla...
                const tableBody = document.querySelector('#tableExportadora tbody');
                if (!tableBody) {
                    console.error('No se encontró el cuerpo de la tabla');
                    return;
                }
                tableBody.innerHTML = ''; // Limpiar la tabla existente
                
                data.forEach(medio => {
                    const row = `
                        <tr>
                            <td>${medio.id}</td>
                            <td>${medio.NombredelMedio}</td>
                            <td>${medio.codigo}</td>
                            <td>${medio.NombreClasificacion || 'Sin clasificación'}</td>
                            <td>
                                <div class="alineado">
                                    <label class="custom-switch sino" data-toggle="tooltip" 
                                           title="${medio.Estado ? 'Desactivar Medio' : 'Activar Medio'}">
                                        <input type="checkbox" 
                                               class="custom-switch-input estado-switchM"
                                               data-id="${medio.id}" data-tipo="medio" ${medio.Estado ? 'checked' : ''}> 
                                        <span class="custom-switch-indicator"></span>
                                    </label>
                                </div>
                            </td>
                            <td>
                                <a href="views/viewMedio.php?id=${medio.id}" data-toggle="tooltip" title="Ver Medio">
                                    <i class="fas fa-eye btn btn-primary miconoz"></i>
                                </a> 
                                <a href="#" 
                                   class="btn6 open-modal" 
                                   data-bs-toggle="modal" 
                                   data-bs-target="#exampleModal" 
                                   data-toggle="tooltip" 
                                   title="Editar Medio">
                                    <i class="fas fa-pencil-alt btn btn-success miconoz"></i>
                                </a>
                            </td>
                        </tr>
                    `;
                    tableBody.insertAdjacentHTML('beforeend', row);
                });
                
                console.log('Tabla actualizada exitosamente');
                reinitializeTableEvents();
            } catch (error) {
                console.error('Error al procesar la respuesta:', error);
                console.error('Texto que causó el error:', text);
            }
        })
        .catch(error => {
            console.error('Error al actualizar la tabla:', error);
        });
}

function reinitializeTableEvents() {
    // Reinicializar tooltips
    $('[data-toggle="tooltip"]').tooltip();
    
    // Reinicializar eventos de cambio de estado
    $('.estado-switchM').off('change').on('change', function() {
        const id = $(this).data('id');
        const estado = this.checked ? 1 : 0;
        const tipo = $(this).data('tipo');
        
        $.ajax({
            url: '/querys/modulos/toggleEstado.php',
            type: 'POST',
            data: { id: id, estado: estado, tipo: tipo },
            success: function(response) {
                console.log('Estado actualizado exitosamente');
            },
            error: function(xhr, status, error) {
                console.error('Error al cambiar el estado:', error);
            }
        });
    });
    
    // Reinicializar eventos para abrir modal de edición
    $('.open-modal').off('click').on('click', function() {
        const id = $(this).closest('tr').find('td:first').text();
        console.log('Abriendo modal de edición para id:', id);
    });
}

function startAutoUpdate() {
    // Actualizar la tabla cada 30 segundos (ajusta este valor según tus necesidades)
    setInterval(updateTable, 30000);
}

// Llamar a updateTable al cargar la página
updateTable();