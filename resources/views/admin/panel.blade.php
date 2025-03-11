@extends('layouts.app')

@section('content')
    <div class="d-flex">
        @include('admin.partials.sidebar') <!-- Aquí incluyes el sidebar -->

        <div class="container-fluid col-10 p-3 custom-panel">
            <h2 class="mb-4">Lista de Retales</h2>
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
                    </tr>
                </thead>
                <tbody id="retales-table-body">
                    <!-- Los datos se insertarán aquí mediante JavaScript -->
                </tbody>
            </table>
        </div>
    </div>

    @vite('resources/js/admin/retales/script-panel.js')
@endsection
