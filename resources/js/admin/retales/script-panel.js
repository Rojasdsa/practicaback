document.addEventListener("DOMContentLoaded", function () {
    const formAgregarRetal = document.getElementById("formAgregarRetal");
    const formEditarRetal = document.getElementById("formEditarRetal"); // Formulario para editar
    const tbody = document.getElementById("retales-table-body");
    const paginationContainer = document.getElementById("pagination");
    const modalAgregarRetal = document.getElementById('modalAgregarRetal');
    const modalEditarRetal = document.getElementById('modalEditarRetal'); // Modal de editar
    let currentPage = 1;
    let totalPages = 1;
    let currentRetalId = null; // Guardar el id del retal que se está editando

    // Función genérica para manejar errores y respuestas de la API
    function fetchAPI(url, options = {}) {
        return fetch(url, options)
            .then(response => response.json())
            .catch(error => console.error('❌ Error:', error));
    }

    // Agregar un retal a la tabla
    function agregarFilaRetal(retal) {
        const row = document.createElement("tr");
        row.setAttribute("data-id", retal.id); // Para poder actualizar o eliminar esta fila
        row.innerHTML = `
            <td>${retal.tejido}</td>
            <td>${retal.subcategoria}</td>
            <td>${retal.gama}</td>
            <td>${retal.color_primario}</td>
            <td>${retal.color_secundario}</td>
            <td>${retal.metros} m</td>
            <td>${retal.precio_base} €</td>
            <td>${retal.precio_retal} €</td>
            <td>${retal.estado}</td>
            <td>${retal.descripcion || '-'}</td>
            <td>
                <button class="btn btn-warning btn-sm editar-retal-btn" data-id="${retal.id}">
                    <i class="fa-solid fa-pen-to-square"></i>
                </button>
                <button class="btn btn-danger btn-sm" onclick="eliminarRetal(${retal.id})">
                    <i class="fa-solid fa-trash"></i>
                </button>
            </td>
        `;
        tbody.appendChild(row);
    }

    // Actualizar paginación
    function updatePagination(paginationData) {
        paginationContainer.innerHTML = '';
        for (let i = 1; i <= paginationData.last_page; i++) {
            const pageLink = document.createElement('button');
            pageLink.className = 'btn btn-sm btn-dark mx-1';
            pageLink.innerText = i;
            pageLink.onclick = () => loadRetales(i);
            paginationContainer.appendChild(pageLink);
        }
    }

    // Cargar los retales de una página específica
    function loadRetales(page = 1) {
        fetchAPI(`/api/retales?page=${page}`)
            .then(data => {
                if (!data || !data.retales || data.retales.data.length === 0) return;
                tbody.innerHTML = '';
                data.retales.data.forEach(agregarFilaRetal);
                updatePagination(data.retales);
                totalPages = data.retales.last_page;
            });
    }

    // Función para agregar un retal
    function agregarRetalAPI(newRetal) {
        return fetchAPI('/api/retales', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json', 'Accept': 'application/json' },
            body: JSON.stringify(newRetal)
        });
    }

    // Función para editar un retal
    function editarRetalAPI(id, updatedRetal) {
        return fetchAPI(`/api/retales/${id}`, {
            method: 'PUT',
            headers: { 'Content-Type': 'application/json', 'Accept': 'application/json' },
            body: JSON.stringify(updatedRetal)
        });
    }

    // Evento de enviar formulario para agregar un retal
    formAgregarRetal.addEventListener("submit", function (event) {
        event.preventDefault();
        const newRetal = {
            tejido: document.getElementById("add-tejido").value,
            subcategoria: document.getElementById("add-subcategoria").value,
            color_primario: document.getElementById("add-color-primario").value,
            color_secundario: document.getElementById("add-color-secundario").value,
            gama: document.getElementById("add-gama").value,
            metros: parseFloat(document.getElementById("add-metros").value),
            precio_base: parseFloat(document.getElementById("add-precio-base").value),
            precio_retal: parseFloat(document.getElementById("add-precio-retal").value),
            descripcion: document.getElementById("add-descripcion").value || null,
            estado: 'disponible',
        };

        agregarRetalAPI(newRetal)
            .then(data => {
                if (data.retal) {
                    const modalInstance = bootstrap.Modal.getInstance(modalAgregarRetal);
                    modalInstance?.hide() || new bootstrap.Modal(modalAgregarRetal).hide();
                    formAgregarRetal.reset();

                    if (currentPage === totalPages) {
                        agregarFilaRetal(data.retal);
                    } else {
                        currentPage = totalPages;
                        loadRetales(currentPage).then(() => agregarFilaRetal(data.retal));
                    }
                }
            });
    });

    // Función para cargar datos de un retal en el formulario de edición
    function editarRetal(id) {
        currentRetalId = id;
        fetchAPI(`/api/retales/${id}`)
            .then(data => {
                if (data.retal) {
                    const retal = data.retal;
                    document.getElementById("edit-tejido").value = retal.tejido;
                    document.getElementById("edit-subcategoria").value = retal.subcategoria;
                    document.getElementById("edit-color-primario").value = retal.color_primario;
                    document.getElementById("edit-color-secundario").value = retal.color_secundario;
                    document.getElementById("edit-gama").value = retal.gama;
                    document.getElementById("edit-metros").value = retal.metros;
                    document.getElementById("edit-precio-base").value = retal.precio_base;
                    document.getElementById("edit-precio-retal").value = retal.precio_retal;
                    document.getElementById("edit-descripcion").value = retal.descripcion || '';
                    document.getElementById("edit-estado").value = retal.estado;

                    const modalInstance = new bootstrap.Modal(modalEditarRetal);
                    modalInstance.show();
                }
            });
    }

    // Nueva sección de código para manejar el evento de edición con delegación
    tbody.addEventListener('click', function (event) {
        const button = event.target.closest('.editar-retal-btn');
        if (button) {
            const id = button.getAttribute('data-id');
            editarRetal(id);
        }
    });

    // Evento de enviar formulario para editar un retal
    formEditarRetal.addEventListener("submit", function (event) {
        event.preventDefault();
    
        const updatedRetal = {
            tejido: document.getElementById("edit-tejido").value,
            subcategoria: document.getElementById("edit-subcategoria").value,
            color_primario: document.getElementById("edit-color-primario").value,
            color_secundario: document.getElementById("edit-color-secundario").value,
            gama: document.getElementById("edit-gama").value,
            metros: parseFloat(document.getElementById("edit-metros").value),
            precio_base: parseFloat(document.getElementById("edit-precio-base").value),
            precio_retal: parseFloat(document.getElementById("edit-precio-retal").value),
            descripcion: document.getElementById("edit-descripcion").value || null,
            estado: document.getElementById("edit-estado").value,
        };
    
        editarRetalAPI(currentRetalId, updatedRetal)
        .then(data => {
            if (data.retal) {
                // Buscar la fila en la tabla con el data-id
                const row = tbody.querySelector(`tr[data-id="${data.retal.id}"]`);
                if (row) {
                    // Actualizar los valores de las celdas en la fila correspondiente
                    row.innerHTML = `
                        <td>${data.retal.tejido}</td>
                        <td>${data.retal.subcategoria}</td>
                        <td>${data.retal.gama}</td>
                        <td>${data.retal.color_primario}</td>
                        <td>${data.retal.color_secundario}</td>
                        <td>${data.retal.metros} m</td>
                        <td>${data.retal.precio_base} €</td>
                        <td>${data.retal.precio_retal} €</td>
                        <td>${data.retal.estado}</td>
                        <td>${data.retal.descripcion || '-'}</td>
                        <td>
                            <button class="btn btn-warning btn-sm editar-retal-btn" data-id="${data.retal.id}">
                                <i class="fa-solid fa-pen-to-square"></i>
                            </button>
                            <button class="btn btn-danger btn-sm" onclick="eliminarRetal(${data.retal.id})">
                                <i class="fa-solid fa-trash"></i>
                            </button>
                        </td>
                    `;
                }
    
                    // Cerrar el modal
                    const modalInstance = bootstrap.Modal.getInstance(modalEditarRetal);
                    modalInstance.hide();
                }
            })
            .catch(error => {
                console.error("Error en la actualización:", error);
            });
    });
    
    // Cargar la primera página de retales
    loadRetales(currentPage);
});
