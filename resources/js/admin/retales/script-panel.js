document.addEventListener("DOMContentLoaded", function () {
    const tableBody = document.getElementById("retales-table-body");

    fetch('/api/retales')
        .then(response => response.json())
        .then(data => {
            console.log("Respuesta completa de la API:", data);

            if (!data || !data.retales || data.retales.length === 0) {
                console.log("No hay retales disponibles.");
                return;
            }

            const tbody = document.getElementById("retales-table-body");

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
            `;

                tbody.appendChild(row);
            });
        })
        .catch(error => console.error("Error al obtener los retales:", error));
});
