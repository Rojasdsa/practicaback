document.addEventListener("DOMContentLoaded", function () {
    /* AGREGAR RETALES */
    // Obtener el formulario y agregar el evento de envío
    const formAgregarRetal = document.getElementById("formAgregarRetal");

    formAgregarRetal.addEventListener("submit", function (event) {
        event.preventDefault(); // Prevenir el comportamiento por defecto de envío del formulario

        // Obtener los valores del formulario
        const tejido = document.getElementById("add-tejido").value;
        const subcategoria = document.getElementById("add-subcategoria").value;
        const colorPrimario = document.getElementById("add-color-primario").value;
        const colorSecundario = document.getElementById("add-color-secundario").value;
        const gama = document.getElementById("add-gama").value;
        const metros = parseFloat(document.getElementById("add-metros").value);
        const precioBase = parseFloat(document.getElementById("add-precio-base").value);
        const precioRetal = parseFloat(document.getElementById("add-precio-retal").value);
        const descripcion = document.getElementById("add-descripcion").value || null;

        // Crear el objeto de datos
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
            estado: 'disponible', // Si no hay estado en el formulario, se asume disponible
        };

        // Enviar la solicitud POST para agregar el nuevo retal
        fetch('/api/retales', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'Accept': 'application/json',
            },
            body: JSON.stringify(newRetal),
        })
        .then(response => response.json())
        .then(data => {
            console.log('Retal agregado:', data);
            if (data.success) {
                // Si se agrega el retal correctamente, puedes actualizar la vista o mostrar un mensaje
                alert('Retal agregado correctamente');
                $('#modalAgregarRetal').modal('hide'); // Cerrar el modal
                // Opcional: Actualiza la tabla de retales en la página
                // Llama a la función que carga los retales nuevamente
                loadRetales();
            } else {
                alert('Error al agregar el retal');
            }
        })
        .catch(error => {
            console.error('Error al agregar el retal:', error);
            alert('Hubo un error, por favor intenta de nuevo');
        });
    });

    // Cargar los retales cuando la página carga
    loadRetales();
});

/* MOSTRAR RETALES */
function loadRetales() {
    fetch('/api/retales')
        .then(response => response.json())
        .then(data => {
            console.log("Respuesta completa de la API:", data);

            if (!data || !data.retales || data.retales.length === 0) {
                console.log("No hay retales disponibles.");
                return;
            }

            const tbody = document.getElementById("retales-table-body");
            tbody.innerHTML = ''; // Limpiar la tabla antes de agregar los nuevos retales

            data.retales.forEach(retal => {
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

                tbody.appendChild(row);
            });
        })
        .catch(error => console.error("Error al obtener los retales:", error));
}
