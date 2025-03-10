document.addEventListener('DOMContentLoaded', function () {
    // Asegúrate de que la variable retalesData esté disponible
    if (typeof retalesData !== 'undefined') {
        // Obtener el contenedor donde se insertarán las filas de la tabla
        const tableBody = document.getElementById('retales-table-body');

        // Iterar sobre los retales y agregar las filas a la tabla
        retalesData.forEach(retal => {
            const row = document.createElement('tr');
            row.innerHTML = `
                <td>${retal.tejido}</td>
                <td>${retal.subcategoria}</td>
                <td>${retal.gama}</td>
                <td>${retal.color_primario}</td>
                <td>${retal.color_secundario}</td>
                <td>${retal.metros}</td>
                <td>${retal.precio_base}</td>
                <td>${retal.precio_retal}</td>
                <td>${retal.estado}</td>
                <td>${retal.descripcion}</td>
            `;
            tableBody.appendChild(row);
        });
    }
});
