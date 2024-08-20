// Función para obtener el último ID de proveedor y sumarle 1
async function obtenerNuevoIdProveedor() {
    try {
        let response = await fetch("https://ekyjxzjwhxotpdfzcpfq.supabase.co/rest/v1/Proveedores?select=id_proveedor&order=id_proveedor.desc&limit=1", {
            method: "GET",
            headers: {
                "Content-Type": "application/json",
                     "apikey": "eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJpc3MiOiJzdXBhYmFzZSIsInJlZiI6ImVreWp4emp3aHhvdHBkZnpjcGZxIiwicm9sZSI6ImFub24iLCJpYXQiOjE3MjAyNzEwOTMsImV4cCI6MjAzNTg0NzA5M30.Vh4XAp1X6eJlEtqNNzYIoIuTPEweat14VQc9-InHhXc",
        "Authorization": "Bearer eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJpc3MiOiJzdXBhYmFzZSIsInJlZiI6ImVreWp4emp3aHhvdHBkZnpjcGZxIiwicm9sZSI6ImFub24iLCJpYXQiOjE3MjAyNzEwOTMsImV4cCI6MjAzNTg0NzA5M30.Vh4XAp1X6eJlEtqNNzYIoIuTPEweat14VQc9-InHhXc"
            }
        });

        if (response.ok) {
            const proveedores = await response.json();
            const ultimoProveedor = proveedores[0];
            const nuevoIdProveedor = ultimoProveedor ? ultimoProveedor.id_proveedor + 1 : 1;
            return nuevoIdProveedor;
        } else {
            console.error("Error al obtener el último ID de proveedor:", await response.text());
            throw new Error("Error al obtener el último ID de proveedor");
        }
    } catch (error) {
        console.error("Error en la solicitud:", error);
        throw error;
    }
}
function getFormData2() {
    const formData2 = new FormData(document.getElementById('formularioAgregarProveedor'));
    const dataObject2 = {};
    formData2.forEach((value, key) => {
        if (key === 'id_medios[]') {
            if (!dataObject2[key]) {
                dataObject2[key] = [];
            }
            dataObject2[key].push(value);
        } else {
            dataObject2[key] = value;
        }
    });

    return {
        created_at: new Date().toISOString(),
        nombreIdentificador: dataObject2.nombreIdentificador,
        nombreProveedor: dataObject2.nombreProveedor,
        nombreFantasia: dataObject2.nombreFantasia,
        rutProveedor: dataObject2.rutProveedor,
        giroProveedor: dataObject2.giroProveedor,
        nombreRepresentante: dataObject2.nombreRepresentante,
        rutRepresentante: dataObject2.rutRepresentante,
        razonSocial: dataObject2.razonSocial,
        direccionFacturacion: dataObject2.direccionFacturacion,
        id_medios: dataObject2['id_medios[]'], // Array of selected medios
        id_region: dataObject2.id_region,
        id_comuna: dataObject2.id_comuna,
        telCelular: dataObject2.telCelular,
        telFijo: dataObject2.telFijo,
        email: dataObject2.email || null,
        bonificacion_ano: dataObject2.bonificacion_ano,
        escala_rango: dataObject2.escala_rango,
        estado: true
    };
}

// Función para enviar el formulario de agregar proveedor y registrar medios
async function submitForm2(event) {
    event.preventDefault(); // Evita la recarga de la página

    const formData = getFormData2();
    const nuevoIdProveedor = await obtenerNuevoIdProveedor(); // Obtener el nuevo ID

    const proveedorData = {
        id_proveedor: nuevoIdProveedor, // Incluir el ID generado
        created_at: formData.created_at,
        nombreIdentificador: formData.nombreIdentificador,
        nombreProveedor: formData.nombreProveedor,
        nombreFantasia: formData.nombreFantasia,
        rutProveedor: formData.rutProveedor,
        giroProveedor: formData.giroProveedor,
        nombreRepresentante: formData.nombreRepresentante,
        rutRepresentante: formData.rutRepresentante,
        razonSocial: formData.razonSocial,
        direccionFacturacion: formData.direccionFacturacion,
        id_region: formData.id_region,
        id_comuna: formData.id_comuna,
        telCelular: formData.telCelular,
        telFijo: formData.telFijo,
        email: formData.email,
        bonificacion_ano: formData.bonificacion_ano,
        escala_rango: formData.escala_rango,
        estado: formData.estado
    };

    try {
        // Registrar el proveedor
        let responseProveedor = await fetch("https://ekyjxzjwhxotpdfzcpfq.supabase.co/rest/v1/Proveedores", {
            method: "POST",
            body: JSON.stringify(proveedorData),
            headers: {
                "Content-Type": "application/json",
                     "apikey": "eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJpc3MiOiJzdXBhYmFzZSIsInJlZiI6ImVreWp4emp3aHhvdHBkZnpjcGZxIiwicm9sZSI6ImFub24iLCJpYXQiOjE3MjAyNzEwOTMsImV4cCI6MjAzNTg0NzA5M30.Vh4XAp1X6eJlEtqNNzYIoIuTPEweat14VQc9-InHhXc",
        "Authorization": "Bearer eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJpc3MiOiJzdXBhYmFzZSIsInJlZiI6ImVreWp4emp3aHhvdHBkZnpjcGZxIiwicm9sZSI6ImFub24iLCJpYXQiOjE3MjAyNzEwOTMsImV4cCI6MjAzNTg0NzA5M30.Vh4XAp1X6eJlEtqNNzYIoIuTPEweat14VQc9-InHhXc"
            }
        });

        if (responseProveedor.ok) {
            console.log("Proveedor registrado correctamente");

            // Continuar con el registro de medios
            const proveedorMediosData = formData.id_medios.map(id_medio => ({
                id_proveedor: nuevoIdProveedor, // Usar el ID generado
                id_medio: id_medio
            }));

            let responseProveedorMedios = await fetch("https://ekyjxzjwhxotpdfzcpfq.supabase.co/rest/v1/proveedor_medios", {
                method: "POST",
                body: JSON.stringify(proveedorMediosData),
                headers: {
                    "Content-Type": "application/json",
                         "apikey": "eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJpc3MiOiJzdXBhYmFzZSIsInJlZiI6ImVreWp4emp3aHhvdHBkZnpjcGZxIiwicm9sZSI6ImFub24iLCJpYXQiOjE3MjAyNzEwOTMsImV4cCI6MjAzNTg0NzA5M30.Vh4XAp1X6eJlEtqNNzYIoIuTPEweat14VQc9-InHhXc",
        "Authorization": "Bearer eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJpc3MiOiJzdXBhYmFzZSIsInJlZiI6ImVreWp4emp3aHhvdHBkZnpjcGZxIiwicm9sZSI6ImFub24iLCJpYXQiOjE3MjAyNzEwOTMsImV4cCI6MjAzNTg0NzA5M30.Vh4XAp1X6eJlEtqNNzYIoIuTPEweat14VQc9-InHhXc"
                }
            });

            if (responseProveedorMedios.ok) {
                mostrarExito('Comisión agregada correctamente');

                location.reload();
            } else {
                const errorData = await responseProveedorMedios.text(); // Obtener respuesta como texto
                console.error("Error en proveedor_medios:", errorData);
                alert("Error al registrar los medios, intente nuevamente");
            }
        } else {
            const errorData = await responseProveedor.text(); // Obtener respuesta como texto
            console.error("Error en proveedor:", errorData);
            alert("Error al registrar el proveedor, intente nuevamente");
        }
    } catch (error) {
        console.error("Error en la solicitud:", error);
        alert("Error en la solicitud, intente nuevamente");
    }
}
function mostrarExito(mensaje) {
    Swal.fire({
        icon: 'success',
        title: 'Éxito',
        text: mensaje,
        showConfirmButton: false,
        timer: 1500
    });
}


function agregarEventListeners() {
    document.querySelectorAll('.editar-comision').forEach(btn => {
        btn.onclick = (e) => cargarDatosComision(e.currentTarget.dataset.id);
    });
    document.querySelectorAll('.eliminar-comision').forEach(btn => {
        btn.onclick = (e) => eliminarComision(e.currentTarget.dataset.id);
    });
}



// Asigna el evento de envío al formulario de agregar proveedor
document.getElementById('formularioAgregarProveedor').addEventListener('submit', submitForm2);