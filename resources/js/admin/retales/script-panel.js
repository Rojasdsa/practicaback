document.addEventListener("DOMContentLoaded", function () {
    const formAgregarRetal = document.getElementById("formAgregarRetal");

    formAgregarRetal.addEventListener("submit", function (event) {
        event.preventDefault();

        const tejido = document.getElementById("add-tejido").value;
        const subcategoria = document.getElementById("add-subcategoria").value;
        const colorPrimario = document.getElementById("add-color-primario").value;
        const colorSecundario = document.getElementById("add-color-secundario").value;
        const gama = document.getElementById("add-gama").value;
        const metros = parseFloat(document.getElementById("add-metros").value);
        const precioBase = parseFloat(document.getElementById("add-precio-base").value);
        const precioRetal = parseFloat(document.getElementById("add-precio-retal").value);
        const descripcion = document.getElementById("add-descripcion").value || null;

        const newRetal = {
            tejido,
            subcategoria,
            color_primario: colorPrimario,
            color_secundario: colorSecundario,
            gama,
            metros,
            precio_base: precioBase,
            precio_retal: precioRetal,
            descripcion,
            estado: 'disponible',
        };

        fetch('/api/retales', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'Accept': 'application/json',
            },
            body: JSON.stringify(newRetal),
        })
        .then(response => {
            if (!response.ok) {
                return response.json().then(errorData => {
                    throw new Error(errorData.message || 'Error al agregar el retal');
                });
            }
            return response.json();
        })
        .then(data => {
            console.log('✅ Retal agregado correctamente:', data);

            // Verificar si data tiene el objeto retal
            if (data.retal) {
                console.log("✔️ Datos del retal:", data.retal);
                
                // Cerrar el modal correctamente
                const modalElement = document.getElementById('modalAgregarRetal');
                const modalInstance = bootstrap.Modal.getInstance(modalElement);

                if (modalInstance) {
                    modalInstance.hide();
                    console.log("✅ Modal cerrado correctamente.");
                } else {
                    console.warn("⚠️ No se encontró una instancia del modal. Intentando con otro método...");
                    new bootstrap.Modal(modalElement).hide();
                }

                formAgregarRetal.reset(); // Limpia el formulario
                agregarFilaRetal(data.retal); // Añadir el retal a la tabla sin recargar
            } else {
                console.error("❌ La API no devolvió un retal válido.");
            }
        })
        .catch(error => {
            console.error('❌ Error al agregar el retal:', error);
        });
    });

    /* FUNCIÓN PARA AGREGAR EL NUEVO RETAL A LA TABLA */
    function agregarFilaRetal(retal) {
        const tbody = document.getElementById("retales-table-body");

        const row = document.createElement("tr");
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
                <button class="btn btn-warning btn-sm" onclick="editarRetal(${retal.id})">
                <i class="fa-solid fa-pen-to-square"></i>
                </button>
                <button class="btn btn-danger btn-sm" onclick="eliminarRetal(${retal.id})">
                <i class="fa-solid fa-trash"></i>
                </button>
            </td>
        `;

        tbody.appendChild(row); // Agregar la nueva fila sin recargar la página
    }

    /* CARGAR RETALES INICIALES Y PAGINACIÓN */
    let currentPage = 1; // Página inicial
    function loadRetales(page = 1) {
        fetch(`/api/retales?page=${page}`)
            .then(response => response.json())
            .then(data => {
                console.log("🔍 Respuesta de la API al cargar retales:", data);

                if (!data || !data.retales || data.retales.data.length === 0) {
                    console.log("ℹ️ No hay retales disponibles.");
                    return;
                }

                const tbody = document.getElementById("retales-table-body");
                tbody.innerHTML = ''; // Limpiar tabla antes de insertar nuevos datos

                // Insertar los retales de la página actual
                data.retales.data.forEach(retal => {
                    agregarFilaRetal(retal);
                });

                // Actualizar la paginación
                updatePagination(data.retales);
            })
            .catch(error => console.error("❌ Error al obtener los retales:", error));
    }

    /* ACTUALIZAR LA Paginación */
    function updatePagination(paginationData) {
        const paginationContainer = document.getElementById("pagination");
        paginationContainer.innerHTML = '';

        const totalPages = paginationData.last_page;
        
        for (let i = 1; i <= totalPages; i++) {
            const pageLink = document.createElement('button');
            pageLink.className = 'btn btn-sm btn-dark mx-1';
            pageLink.innerText = i;
            pageLink.onclick = () => loadRetales(i);
            paginationContainer.appendChild(pageLink);
        }
    }

    // Cargar la primera página de retales
    loadRetales(currentPage);
});
