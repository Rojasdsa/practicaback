{{-- NAVBAR responsive --}}
<nav class="navbar navbar-expand-lg custom-nav py-0">
    {{-- Centramos el nav --}}
    <div class="container">
        {{-- Logo + redirección a inicio --}}
        <a class="navbar-brand" href="{{ url('/') }}">
            <img src="https://pbs.twimg.com/profile_images/947504948765450240/nZtFY4Lb_400x400.jpg"
                class="rounded-circle custom-nav-logo">
        </a>
        {{-- Toggler para móviles --}}
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav me-auto">
                {{-- HOME --}}
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('/') || request()->is('dashboard') ? 'custom-active-link' : '' }}"
                        href="{{ auth()->check() ? route('dashboard') : route('welcome') }}">
                        <i class="fa-solid fa-house"></i>
                    </a>
                </li>
                {{-- TIENDA --}}
                @auth
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('productos') ? 'custom-active-link' : '' }}"
                            href="{{ url('/productos') }}">Productos</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('pedidos') ? 'custom-active-link' : '' }}"
                            href="{{ url('/pedidos') }}">Pedidos</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('clientes') ? 'custom-active-link' : '' }}"
                            href="{{ url('/clientes') }}">Clientes</a>
                    </li>
                @endauth
            </ul>

            @auth
                <div class="text-white">Bienvenido, {{ Auth::user()->name }}</div>
            @endauth

            <ul class="navbar-nav ms-auto">
                <div class="d-flex justify-content-center align-items-center">
                    {{-- PANEL ADMIN --}}
                    @can('panel admin')
                        <li class="nav-item mx-2">
                            <div class="btn btn-info p-0">
                                <a class="nav-link" href="{{ route('admin.panel') }}">
                                    <i class="fa-solid fa-toolbox"></i>
                                </a>
                            </div>
                        </li>
                    @endcan

                    {{-- Menú USUARIO --}}
                    @auth
                        <li class="nav-item mx-1">
                            <a class="nav-link" href="#">
                                <i class="fa-solid fa-user"></i>
                            </a>
                        </li>
                        <li class="nav-item mx-1">
                            <form action="{{ route('logout') }}" method="POST" class="d-inline">
                                @csrf
                                <button type="submit" class="nav-link btn btn-link">
                                    <i class="fa-solid fa-power-off"></i>
                                </button>
                            </form>
                        </li>
                    @else
                        <li class="nav-item mx-1">
                            <a class="nav-link text-white" href="{{ route('login') }}">Iniciar Sesión</a>
                        </li>
                        <li class="nav-item mx-1">
                            <a class="nav-link text-white" href="{{ route('register') }}">Registrarse</a>
                        </li>
                    @endauth
                </div>
            </ul>
        </div>
    </div>
</nav>
