{{-- Incluimos todo el código de APP.BLADE --}}
@extends('layouts.app')

{{-- En el bloque CONTENT añadiremos el siguiente código--}}
@section('content')
    <header class="bg-primary text-white text-center py-5">
        <div class="container">
            <h1>Bienvenidos a Tejidos Violeta</h1>
            <p class="lead">La mejor tienda de telas y tejidos con stock disponible por metro</p>
            <a href="{{ url('/productos') }}" class="btn btn-light btn-lg mt-3">Ver Productos</a>
        </div>
    </header>

    <section class="container my-5">
        <h2 class="text-center mb-4">Catálogo de Productos</h2>
        <div class="row">
            {{-- @foreach ($productos as $producto)
                <div class="col-md-4">
                    <div class="card shadow-sm mb-4">
                        <img src="{{ $producto->imagen }}" class="card-img-top" alt="{{ $producto->nombre }}">
                        <div class="card-body">
                            <h5 class="card-title">{{ $producto->nombre }}</h5>
                            <p class="card-text">{{ Str::limit($producto->descripcion, 80) }}</p>
                            <p class="fw-bold">Precio: ${{ $producto->precio_por_metro }} por metro</p>
                            <a href="#" class="btn btn-primary">Ver detalles</a>
                        </div>
                    </div>
                </div>
            @endforeach --}}
        </div>
    </section>
@endsection
