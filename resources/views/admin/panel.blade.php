@extends('layouts.app')

@section('content')
    <div class="d-flex">
        @include('admin.partials.sidebar')

        <div class="container-fluid col-10 p-3 custom-panel">
            <h2 class="mb-4">Lista de Retales</h2>

            {{-- AÑADIR RETAL --}}
            <button class="btn btn-success mb-3" data-bs-toggle="modal" data-bs-target="#modalAgregarRetal">
                <i class="fa-solid fa-file-circle-plus"></i>
            </button>

            {{-- TABLA RETALES --}}
            <table class="table table-striped table-hover table-bordered">
                <thead class="table-dark">
                    <tr>
                        <th>ID</th>
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
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody id="retales-table-body">
                    <!-- Datos insertados por petición API con JS -->
                </tbody>
            </table>
            {{-- PAGINACIÓN --}}
            <div class="d-flex justify-content-center align-items-center">
                <div id="pagination" class="mt-1">
                    <!-- Botones insertados con JS -->
                </div>
            </div>
        </div>
    </div>

    <!-- MODALES (Crear, editar, eliminar) -->
    @include('admin.partials.modals-retales')

    @vite('resources/js/admin/retales/script-panel.js')
@endsection
