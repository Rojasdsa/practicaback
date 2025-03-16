@extends('layouts.app')

@section('content')
    <div class="d-flex">
        @include('admin.partials.sidebar')

        <div class="container-fluid col-10 p-3 custom-panel">
            <h2 class="mb-4">Lista de Retales</h2>

            <!-- Botón para añadir retal -->
            <button class="btn btn-success mb-3" data-bs-toggle="modal" data-bs-target="#modalAgregarRetal">
                <i class="fa-solid fa-file-circle-plus"></i>
            </button>
            
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Tejido</th>
                        <th>Subcategoría</th>
                        <th>Gama</th>
                        <th>Color Primario</th>
                        <th>Color Secundario</th>
                        <th>Metros</th>
                        <th>Precio Base</th>
                        <th>Precio Retal</th>
                        <th>Estado</th>
                        <th>Descripción</th>
                        <th>Acciones</th> <!-- Nueva columna -->
                    </tr>
                </thead>
                <tbody id="retales-table-body">
                    <!-- Datos insertados con JavaScript -->
                </tbody>
            </table>
        </div>
    </div>

    <!-- Modales -->
    @include('admin.partials.modals-retales')

    @vite('resources/js/admin/retales/script-panel.js')
@endsection
