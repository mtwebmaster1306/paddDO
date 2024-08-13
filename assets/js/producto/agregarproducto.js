document.addEventListener('DOMContentLoaded', function () {
    const searchInput = document.getElementById('search');
    const selectElement = document.getElementById('cliente');
    const options = Array.from(selectElement.options);
    const noResultsMessage = document.getElementById('no-results');

    searchInput.addEventListener('input', function () {
        const searchTerm = searchInput.value.toLowerCase();
        let hasResults = false;

        // Mostrar el select solo si hay más de tres caracteres en el campo de búsqueda
        if (searchTerm.length > 2) {
            options.forEach(option => {
                if (option.text.toLowerCase().includes(searchTerm)) {
                    option.classList.remove('hidden');
                    hasResults = true;
                } else {
                    option.classList.add('hidden');
                }
            });

            // Actualizar el select con las opciones visibles
            selectElement.innerHTML = '';
            options.forEach(option => {
                if (!option.classList.contains('hidden')) {
                    selectElement.appendChild(option);
                }
            });

            // Mostrar u ocultar el mensaje de no resultados
            if (hasResults) {
                noResultsMessage.classList.add('hidden');
                selectElement.classList.remove('hidden');
            } else {
                noResultsMessage.classList.remove('hidden');
                selectElement.classList.add('hidden');
            }
        } else {
            // Ocultar el select y el mensaje de no resultados si hay menos de tres caracteres
            selectElement.classList.add('hidden');
            noResultsMessage.classList.add('hidden');
        }
    });

    // Actualizar el campo de búsqueda cuando se selecciona una opción
    selectElement.addEventListener('change', function () {
        const selectedOption = selectElement.options[selectElement.selectedIndex];
        searchInput.value = selectedOption.text;
    });
});

function cargarTipoCliente() {
    var select = document.getElementById('cliente');
    var selectedOption = select.options[select.selectedIndex];
    var tipoCliente = selectedOption.getAttribute('data-tipocliente');
    var tipoId = selectedOption.getAttribute('data-tipo-id');
    console.log(tipoId)
    document.getElementById('nombreTipoCliente').value = tipoCliente;
    document.getElementById('idTipoCliente').value = tipoId;
  }
  


  
function obtenerValoresFormulario(event) {
    event.preventDefault(); // Evita que el formulario se envíe

    const form = document.getElementById('agregarproducto');
    const valores = {
        id: Math.floor(Math.random() * 1000000000),
        nombreProducto: form.nombreProducto.value,
        Id_Cliente: form.clientes.value
    };

 

    let headersList = {
        "Accept": "*/*",
        "User-Agent": "Thunder Client (https://www.thunderclient.com)",
        "apikey": "eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJpc3MiOiJzdXBhYmFzZSIsInJlZiI6ImVreWp4emp3aHhvdHBkZnpjcGZxIiwicm9sZSI6ImFub24iLCJpYXQiOjE3MjAyNzEwOTMsImV4cCI6MjAzNTg0NzA5M30.Vh4XAp1X6eJlEtqNNzYIoIuTPEweat14VQc9-InHhXc",
        "Authorization": "Bearer eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJpc3MiOiJzdXBhYmFzZSIsInJlZiI6ImVreWp4emp3aHhvdHBkZnpjcGZxIiwicm9sZSI6ImFub24iLCJpYXQiOjE3MjAyNzEwOTMsImV4cCI6MjAzNTg0NzA5M30.Vh4XAp1X6eJlEtqNNzYIoIuTPEweat14VQc9-InHhXc",
        "Content-Type": "application/json"
    }

   

    let bodyContent = JSON.stringify({
        "id": Math.floor(Math.random() * 1000000000),
        "NombreDelProducto": form.nombreProducto.value,
        "Id_Cliente": form.clientes.value
    });

    
    console.log(bodyContent)
    

    let response = fetch("https://ekyjxzjwhxotpdfzcpfq.supabase.co/rest/v1/Productos", {
        method: "POST",
        body: bodyContent,
        headers: headersList
    });

    let data = response;
    console.log(data);
}

document.querySelector('button[type="submit"]').addEventListener('click', obtenerValoresFormulario);