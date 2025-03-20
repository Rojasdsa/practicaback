document.addEventListener("DOMContentLoaded", function () {
    const formAgregarRetal = document.getElementById("formAgregarRetal");
    const formEditarRetal = document.getElementById("formEditarRetal");
    const tbody = document.getElementById("retales-table-body");
    const paginationContainer = document.getElementById("pagination");
    const modalAgregarRetal = new bootstrap.Modal(document.getElementById('modalAgregarRetal'));
    const modalEditarRetal = new bootstrap.Modal(document.getElementById('modalEditarRetal'));
    const modalEliminarRetal = new bootstrap.Modal(document.getElementById('modalEliminarRetal'));

    let currentPage = 1;
    let totalPages = 1;
    let currentRetalId = null;
    let retalIdAEliminar = null;


    // Función para realizar peticiones a la API
    async function fetchAPI(url, options = {}) {
        try {
            const response = await fetch(url, options);
    
            if (response.status === 204) {
                return null; // No hay contenido, pero no es un error
            }
    
            const text = await response.text();
            const data = text ? JSON.parse(text) : null;
    
            if (!response.ok) {
                console.error("❌ Error en la API:", data);
                throw new Error(data?.message || `Error desconocido (${response.status})`);
            }
    
            return data;
        } catch (error) {
            console.error('❌ Error en fetchAPI:', error);
            return null;
        }
    }
    


    // Agregar un retal a la tabla
    function agregarFilaRetal(retal) {
        const row = document.createElement("tr");
        row.setAttribute("data-id", retal.id);
        row.innerHTML = `
            <td>${retal.id}</td>
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
                <button class="btn btn-danger btn-sm eliminar-retal-btn" data-id="${retal.id}">
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
            pageLink.className = `btn btn-sm ${i === currentPage ? 'btn-primary' : 'btn-dark'} mx-1`;
            pageLink.innerText = i;
            pageLink.onclick = () => {
                currentPage = i; // Actualizar currentPage antes de cargar los datos
                loadRetales(i);
            };
            paginationContainer.appendChild(pageLink);
        }
    }

    // Cargar los retales
    async function loadRetales(page = 1) {
        const data = await fetchAPI(`/api/retales?page=${page}`);
        if (data && data.retales && data.retales.data.length > 0) {
            tbody.innerHTML = '';
            data.retales.data.forEach(agregarFilaRetal);
            updatePagination(data.retales);
            totalPages = data.retales.last_page;
        } else {
            tbody.innerHTML = "<tr><td colspan='11' class='text-center'>No hay retales disponibles.</td></tr>";
        }
    }

    // Enviar nuevo retal
    formAgregarRetal.addEventListener("submit", async function (event) {
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

        const data = await fetchAPI('/api/retales', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify(newRetal)
        });

        if (data && data.retal) {
            loadRetales(currentPage);
            modalAgregarRetal.hide();
            formAgregarRetal.reset();
        }
    });

    // Cargar datos en formulario de edición
    async function editarRetal(id) {
        currentRetalId = id;
        const data = await fetchAPI(`/api/retales/${id}`);
        if (data && data.retal) {
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

            modalEditarRetal.show();
        }
    }

    // Evento para abrir modal de edición
    tbody.addEventListener('click', function (event) {
        const button = event.target.closest('.editar-retal-btn');
        if (button) {
            editarRetal(button.getAttribute('data-id'));
        }
    });

    // Evento de guardar cambios en edición
    formEditarRetal.addEventListener("submit", async function (event) {
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

        await fetchAPI(`/api/retales/${currentRetalId}`, {
            method: 'PUT',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify(updatedRetal)
        });

        modalEditarRetal.hide();
        loadRetales(currentPage);
    });

    // Abrir modal de eliminación
    tbody.addEventListener('click', function (event) {
        const button = event.target.closest('.eliminar-retal-btn');
        if (button) {
            retalIdAEliminar = button.getAttribute('data-id');
            const fila = button.closest('tr');
            const tejido = fila.children[1].textContent;
            const metros = fila.children[6].textContent;

            document.getElementById("retal-info").textContent = `${tejido} - ${metros}`;
            modalEliminarRetal.show();
        }
    });

    // Confirmar eliminación
    document.getElementById("confirmarEliminarRetal").addEventListener("click", async function () {
        if (retalIdAEliminar) {
            const response = await fetchAPI(`/api/retales/${retalIdAEliminar}`, {
                method: 'DELETE'
            });
    
            if (response !== null) {
                modalEliminarRetal.hide();
                loadRetales(currentPage); // Recargar retales después de eliminar
            }
        }
    });
    
    loadRetales(currentPage);
});
