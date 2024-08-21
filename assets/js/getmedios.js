function setupDropdown(dropdownId) {
    const dropdown = document.querySelector(`#${dropdownId}`);
    
    if (!dropdown) {
        console.error(`Dropdown with ID ${dropdownId} not found.`);
        return;
    }

    const dropdownButton = dropdown.querySelector('.dropdown-button');
    const dropdownContent = dropdown.querySelector('.dropdown-content');
    const selectedOptionsContainer = dropdown.querySelector('.selected-options');
    const sellElement = dropdown.querySelector('.sell');

    // Manejador de evento para mostrar/ocultar el contenido del dropdown
    function toggleDropdown() {
        dropdown.classList.toggle('open');
        dropdownContent.style.display = dropdown.classList.contains('open') ? 'grid' : 'none';
    }

    // Mostrar el dropdown al hacer clic en el contenedor de opciones seleccionadas
    selectedOptionsContainer.addEventListener('click', function(event) {
        event.stopPropagation();
        toggleDropdown();
    });

    // Mostrar el dropdown al hacer clic en el botón
    dropdownButton.addEventListener('click', function(event) {
        event.stopPropagation();
        toggleDropdown();
    });

    // Cerrar el dropdown al hacer clic fuera de él
    window.addEventListener('click', function(event) {
        if (!dropdown.contains(event.target)) {
            dropdown.classList.remove('open');
            dropdownContent.style.display = 'none';
        }
    });

    // Manejador para actualizar las opciones seleccionadas
    dropdown.querySelectorAll('.dropdown-content input[type="checkbox"]').forEach(checkbox => {
        checkbox.addEventListener('change', function(event) {
            event.stopPropagation();
            updateSelectedOptions();
        });
    });

    // Función para actualizar el contenedor de opciones seleccionadas
    function updateSelectedOptions() {
        selectedOptionsContainer.innerHTML = ''; // Limpia las opciones seleccionadas

        const selectedCheckboxes = dropdown.querySelectorAll('.dropdown-content input[type="checkbox"]:checked');
        if (selectedCheckboxes.length > 0) {
            dropdownButton.style.display = 'none';
            sellElement.style.display = 'none';
            selectedOptionsContainer.style.display = 'flex'; // Mostrar el contenedor si hay opciones seleccionadas
        } else {
            dropdownButton.style.display = 'block';
            sellElement.style.display = 'block';
            selectedOptionsContainer.style.display = 'none'; // Ocultar el contenedor si no hay opciones seleccionadas
        }

        selectedCheckboxes.forEach(checkbox => {
            const label = checkbox.parentElement.textContent.trim();
            const selectedOption = document.createElement('span');
            selectedOption.className = 'selected-option';
            selectedOption.textContent = label;
            selectedOption.dataset.value = checkbox.value;

            const removeButton = document.createElement('button');
            removeButton.textContent = 'x';
            removeButton.addEventListener('click', function(event) {
                event.stopPropagation();
                checkbox.checked = false;
                updateSelectedOptions();
            });

            selectedOption.appendChild(removeButton);
            selectedOptionsContainer.appendChild(selectedOption);
        });
    }

    // Actualizar la vista de las opciones seleccionadas en la inicialización
    updateSelectedOptions();
}

// Inicializa los dropdowns
['dropdown5', 'dropdown6', 'dropdown1', 'dropdown2', 'dropdown3', 'dropdown4'].forEach(id => setupDropdown(id));
