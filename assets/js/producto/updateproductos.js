const SUPABASE_URL = 'https://ekyjxzjwhxotpdfzcpfq.supabase.co/rest/v1/Productos';
const SUPABASE_URL_CLIENTE = 'https://ekyjxzjwhxotpdfzcpfq.supabase.co/rest/v1/Clientes';

const SUPABASE_KEY = 'eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJpc3MiOiJzdXBhYmFzZSIsInJlZiI6ImVreWp4emp3aHhvdHBkZnpjcGZxIiwicm9sZSI6ImFub24iLCJpYXQiOjE3MjAyNzEwOTMsImV4cCI6MjAzNTg0NzA5M30.Vh4XAp1X6eJlEtqNNzYIoIuTPEweat14VQc9-InHhXc';

const headersList = {
    "Accept": "*/*",
    "User-Agent": "Thunder Client (https://www.thunderclient.com)",
    "apikey": SUPABASE_KEY,
    "Authorization": `Bearer ${SUPABASE_KEY}`,
    "Content-Type": "application/json"
};

function cargarDatosProducto(idProducto) {
    console.log(`Cargando datos para el producto con ID: ${idProducto}`);

    fetch(`${SUPABASE_URL}?id=eq.${idProducto}&select=*`, {
        method: 'GET',
        headers: headersList
    })
    .then(response => {
        if (!response.ok) {
            throw new Error(`Error al obtener el producto: ${response.statusText}`);
        }
        return response.json();
    })
    .then(data => {
        console.log('Datos recibidos:', data);

        if (data && data.length > 0) {
            const producto = data[0];

            // Realizar la segunda solicitud para obtener todos los clientes
            return fetch(`${SUPABASE_URL_CLIENTE}?select=*`, {
                method: 'GET',
                headers: headersList
            })
            .then(response => {
                if (!response.ok) {
                    throw new Error(`Error al obtener los clientes: ${response.statusText}`);
                }
                return response.json();
            })
            .then(clientesData => {
                console.log('Datos de los clientes recibidos:', clientesData);

                // Asignar los valores a los campos correspondientes
                document.getElementById('updateId').value = producto.id || '';
                document.getElementById('updateProductName').value = producto.NombreDelProducto || '';

                // Cargar el select con el cliente asociado y los demás clientes
                const selectElement = document.getElementById('updateClientName');
                selectElement.innerHTML = ''; // Limpiar el select antes de llenarlo

                // Agregar el cliente asociado primero
                selectElement.innerHTML += `
                    <option value="${producto.Id_Cliente}" selected>
                        ${clientesData.find(cliente => cliente.id_cliente === producto.Id_Cliente)?.nombreCliente || 'Cliente no encontrado'}
                    </option>
                `;

                // Agregar los demás clientes
                clientesData.forEach(cliente => {
                    if (cliente.id_cliente !== producto.Id_Cliente) {
                        selectElement.innerHTML += `
                            <option value="${cliente.id_cliente}">
                                ${cliente.nombreCliente}
                            </option>
                        `;
                    }
                });
            });
        } else {
            console.log('No se encontraron datos para el ID proporcionado');
        }
    })
    .catch(error => console.error('Error:', error));
}



document.getElementById('updateForm').addEventListener('submit', function(e) {
    e.preventDefault();
    const formData = new FormData(this);
    const idProducto = formData.get('id');
    const form = document.getElementById('updateForm');
    
    console.log(form.updateProductName.value);

    const productoActualizado = {
        NombreDelProducto: form.updateProductName.value
    };

    fetch(`${SUPABASE_URL}?id=eq.${idProducto}`, {
        method: 'PATCH',
        headers: {
            ...headersList,
            'Prefer': 'return=minimal'
        },
        body: JSON.stringify(productoActualizado)
    })
    .then(response => {
        if (response.ok) {
            console.log('Producto actualizado correctamente');
            $('#modalupdate').modal('hide');
       
            // Recargar sitio
        location.reload();
        } else {
            throw new Error('Error al actualizar el producto');
        }
    })
    .catch(error => {
        console.error('Error:', error);
    });
});